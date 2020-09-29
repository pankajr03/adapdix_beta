<?php
// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

if ( ! class_exists( 'SPTP_TermOrder' ) ) :
	/**
	 * Main SPTP_TermOrder class
	 *
	 * @since 2.0
	 */
	final class SPTP_TermOrder {


		/**
		 * @var string File for plugin
		 */
		public $file = '';

		/**
		 * @var string URL to plugin
		 */
		public $url = '';

		/**
		 * @var string Path to plugin
		 */
		public $path = '';

		/**
		 * @var string Basename for plugin
		 */
		public $basename = '';

		/**
		 * @var array Which taxonomies are being targeted?
		 */
		public $taxonomies = array();

		/**
		 * Hook into queries, admin screens, and more!
		 *
		 * @since 2.0
		 */
		public function __construct() {

			// Setup plugin.
			$this->file     = __FILE__;
			$this->url      = plugin_dir_url( $this->file );
			$this->path     = plugin_dir_path( $this->file );
			$this->basename = plugin_basename( $this->file );

			// Queries.
			add_filter( 'get_terms_orderby', array( $this, 'get_terms_orderby' ), 10, 2 );

			// Get visible taxonomies.
			$this->taxonomies = $this->get_taxonomies();

			// Ajax actions.
			add_action( 'wp_ajax_reordering_terms', array( $this, 'ajax_reordering_terms' ) );

			// Only blog admin screens.
			if ( is_blog_admin() || doing_action( 'wp_ajax_inline_save_tax' ) ) {

				// Bail if taxonomy does not include colors.
				if ( ! empty( $_REQUEST['taxonomy'] ) && in_array( $_REQUEST['taxonomy'], $this->taxonomies, true ) ) {
					add_action( 'load-edit-tags.php', array( $this, 'edit_tags' ) );
				}
			}

			// Pass ths object into an action.
			do_action( 'wp_term_meta_order_init', $this );
		}

		/**
		 * Administration area hooks
		 *
		 * @since 2.0
		 */
		public function edit_tags() {
			add_action( 'admin_print_scripts-edit-tags.php', array( $this, 'enqueue_scripts' ) );
		}

		/**
		 * Enqueue quick-edit JS
		 *
		 * @since 2.0
		 */
		public function enqueue_scripts() {
			wp_enqueue_script( 'term-order-quick-edit', SPTP_PLUGIN_ROOT . 'admin/js/quick-edit.js', array( 'jquery' ), SPTP_PLUGIN_VERSION, true );
			wp_enqueue_script( 'term-order-reorder', SPTP_PLUGIN_ROOT . 'admin/js/reorder.js', array( 'jquery-ui-sortable' ), SPTP_PLUGIN_VERSION, true );
		}

		/**
		 * Get taxonomies.
		 *
		 * @since 2.0
		 *
		 * @param array $args
		 * @return array
		 */
		private static function get_taxonomies( $args = array() ) {

			// Parse arguments.
			$r = wp_parse_args(
				$args,
				array(
					'show_ui' => true,
					'name'    => 'sptp_group',
				)
			);

			// Get & return the taxonomies.
			$taxonomies = get_taxonomies( $r );

			// Filter taxonomies & return.
			return apply_filters( 'wp_term_order_get_taxonomies', $taxonomies, $r, $args );
		}

		/**
		 * Add `order` to term when updating
		 *
		 * @since 2.0
		 *
		 * @param  int    $term_id   The ID of the term.
		 * @param  int    $tt_id     Not used.
		 * @param  string $taxonomy  Taxonomy of the term.
		 */
		public function add_term_order( $term_id = 0, $tt_id = 0, $taxonomy = '' ) {
			if ( ! isset( $_POST['order'] ) ) {
				return;
			}

			// Sanitize the value.
			$order = ! empty( $_POST['order'] )
			? (int) $_POST['order']
			: 0;

			self::set_term_order( $term_id, $taxonomy, $order );
		}

		/**
		 * Set order of a specific term
		 *
		 * @since 2.0
		 *
		 * @global object  $wpdb
		 * @param  int    $term_id
		 * @param  string $taxonomy
		 * @param  int    $order
		 * @param  bool   $clean_cache
		 */
		public static function set_term_order( $term_id = 0, $taxonomy = '', $order = 0, $clean_cache = false ) {
			global $wpdb;

			// Update the database row.
			$wpdb->update(
				$wpdb->term_taxonomy,
				array(
					'order' => $order,
				),
				array(
					'term_id'  => $term_id,
					'taxonomy' => $taxonomy,
				)
			);

			// Maybe clean the term cache.
			if ( true === $clean_cache ) {
				clean_term_cache( $term_id, $taxonomy );
			}
		}

		/**
		 * Return the order of a term
		 *
		 * @since 2.0
		 *
		 * @param int $term_id
		 */
		public function get_term_order( $term_id = 0 ) {

			// Get the term, probably from cache at this point.
			$term = get_term( $term_id, $_REQUEST['taxonomy'] );

			// Assume default order.
			$retval = 0;

			// Use term order if set.
			if ( isset( $term->order ) ) {
				$retval = $term->order;
			}

			// Check for option order.
			if ( empty( $retval ) ) {
				$key    = "term_order_{$term->taxonomy}";
				$orders = get_option( $key, array() );

				if ( ! empty( $orders ) ) {
					foreach ( $orders as $position => $value ) {
						if ( $value === $term->term_id ) {
							$retval = $position;
							break;
						}
					}
				}
			}

			// Cast & return
			return (int) $retval;
		}

		/** Query Filters *********************************************************/

		/**
		 * Force `orderby` to `tt.order` if not explicitly set to something else
		 *
		 * @since 0.1.0
		 *
		 * @param  string $orderby
		 * @return string
		 */
		public function get_terms_orderby( $orderby = 'name', $args = array() ) {

			// Do not override if being manually controlled.
			if ( ! empty( $_GET['orderby'] ) && ! empty( $_GET['taxonomy'] ) ) {
				return $orderby;
			}

			// Maybe force `orderby`.
			if ( ! empty( $args['taxonomy'] ) ) {
				foreach ( $args['taxonomy'] as $key => $value ) {
					if ( $value == 'nav_menu' ) {
						return;
					}
				}
			}
			if ( empty( $args['orderby'] ) || empty( $orderby ) || ( 'order' === $args['orderby'] ) || in_array( $orderby, array( 'name', 't.name' ) ) ) {
				$orderby = 'tt.order';
			} elseif ( 't.name' === $orderby ) {
				$orderby = 'tt.order, t.name';
			}

			// Return possibly modified `orderby` value.
			return $orderby;
		}
		/**
		 * Handle ajax term reordering
		 *
		 * @since 2.0
		 */
		public static function ajax_reordering_terms() {

			// Bail if required term data is missing.
			if ( empty( $_POST['id'] ) || empty( $_POST['tax'] ) || ( ! isset( $_POST['previd'] ) && ! isset( $_POST['nextid'] ) ) ) {
				die( -1 );
			}

			// Attempt to get the taxonomy.
			$tax = get_taxonomy( $_POST['tax'] );

			// Bail if taxonomy does not exist.
			if ( empty( $tax ) ) {
				die( -1 );
			}

			// Bail if current user cannot assign terms.
			if ( ! current_user_can( $tax->cap->edit_terms ) ) {
				die( -1 );
			}

			// Bail if term cannot be found.
			$term = get_term( $_POST['id'], $_POST['tax'] );
			if ( empty( $term ) ) {
				die( -1 );
			}

			// Sanitize positions.
			$taxonomy = $_POST['tax'];
			$previd   = empty( $_POST['previd'] ) ? false : (int) $_POST['previd'];
			$nextid   = empty( $_POST['nextid'] ) ? false : (int) $_POST['nextid'];
			$start    = empty( $_POST['start'] ) ? 1 : (int) $_POST['start'];
			$excluded = empty( $_POST['excluded'] ) ?
			array( $term->term_id ) :
			array_filter( (array) $_POST['excluded'], 'intval' );

			// Define return values.
			$new_pos     = array();
			$return_data = new stdClass();

			// attempt to get the intended parent...
			$parent_id        = $term->parent;
			$next_term_parent = $nextid
			? wp_get_term_taxonomy_parent_id( $nextid, $taxonomy )
			: false;

			// If the preceding term is the parent of the next term, move it inside.
			if ( $previd === $next_term_parent ) {
				$parent_id = $next_term_parent;

				// If the next term's parent isn't the same as our parent, we need more info.
			} elseif ( $next_term_parent !== $parent_id ) {
				$prev_term_parent = $previd
				? wp_get_term_taxonomy_parent_id( $nextid, $taxonomy )
				: false;

				// If the previous term is not our parent now, set it.
				if ( $prev_term_parent !== $parent_id ) {
					$parent_id = ( $prev_term_parent !== false )
					? $prev_term_parent
					: $next_term_parent;
				}
			}

			// If the next term's parent isn't our parent, set to false.
			if ( $next_term_parent !== $parent_id ) {
				$nextid = false;
			}

			// Get term siblings for relative ordering.
			$siblings = get_terms(
				$taxonomy,
				array(
					'depth'      => 1,
					'number'     => 100,
					'parent'     => $parent_id,
					'orderby'    => 'order',
					'order'      => 'ASC',
					'hide_empty' => false,
					'exclude'    => $excluded,
				)
			);

			// Loop through siblings and update terms.
			foreach ( $siblings as $sibling ) {

				// Skip the actual term if it's in the array.
				if ( $sibling->term_id === (int) $term->term_id ) {
					continue;
				}

				// If this is the term that comes after our repositioned term, set
				// our repositioned term position and increment order.
				if ( $nextid === (int) $sibling->term_id ) {
					self::set_term_order( $term->term_id, $taxonomy, $start, true );

					$ancestors = get_ancestors( $term->term_id, $taxonomy, 'taxonomy' );

					$new_pos[ $term->term_id ] = array(
						'order'  => $start,
						'parent' => $parent_id,
						'depth'  => count( $ancestors ),
					);

					$start++;
				}

				// If repositioned term has been set and new items are already in
				// the right order, we can stop looping.
				if ( isset( $new_pos[ $term->term_id ] ) && (int) $sibling->order >= $start ) {
					$return_data->next = false;
					break;
				}

				// Set order of current sibling and increment the order.
				if ( $start !== (int) $sibling->order ) {
					self::set_term_order( $sibling->term_id, $taxonomy, $start, true );
				}

				$new_pos[ $sibling->term_id ] = $start;
				$start++;

				if ( empty( $nextid ) && ( $previd === (int) $sibling->term_id ) ) {
					self::set_term_order( $term->term_id, $taxonomy, $start, true );

					$ancestors = get_ancestors( $term->term_id, $taxonomy, 'taxonomy' );

					$new_pos[ $term->term_id ] = array(
						'order'  => $start,
						'parent' => $parent_id,
						'depth'  => count( $ancestors ),
					);

					$start++;
				}
			}

			// max per request.
			if ( ! isset( $return_data->next ) && count( $siblings ) > 1 ) {
				$return_data->next = array(
					'id'       => $term->term_id,
					'previd'   => $previd,
					'nextid'   => $nextid,
					'start'    => $start,
					'excluded' => array_merge( array_keys( $new_pos ), $excluded ),
					'taxonomy' => $taxonomy,
				);
			} else {
				$return_data->next = false;
			}

			if ( empty( $return_data->next ) ) {

				// If the moved term has children, refresh the page for UI reasons.
				$children = get_terms(
					$taxonomy,
					array(
						'number'     => 1,
						'depth'      => 1,
						'orderby'    => 'order',
						'order'      => 'ASC',
						'parent'     => $term->term_id,
						'fields'     => 'ids',
						'hide_empty' => false,
					)
				);

				if ( ! empty( $children ) ) {
					die( 'children' );
				}
			}

			$return_data->new_pos = $new_pos;

			die( json_encode( $return_data ) );
		}
	}
endif;

/**
 * Instantiate the main WordPress Term Order class
 *
 * @since 0.1.0
 */
function _wp_term_order() {
	new SPTP_TermOrder();
}
add_action( 'init', '_wp_term_order', 99 );
