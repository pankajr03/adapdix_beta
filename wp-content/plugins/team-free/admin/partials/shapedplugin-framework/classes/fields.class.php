<?php if ( ! defined( 'ABSPATH' ) ) {
	die; } // Cannot access directly.
/**
 *
 * Fields Class
 *
 * @since 2.0
 * @version 2.0.0
 */

if ( ! class_exists( 'SPF_Fields' ) ) {
	abstract class SPF_Fields extends SPF_Abstract {

		public function __construct( $field = array(), $value = '', $unique = '', $where = '', $parent = '' ) {
			$this->field  = $field;
			$this->value  = $value;
			$this->unique = $unique;
			$this->where  = $where;
			$this->parent = $parent;
		}

		public function field_name( $nested_name = '' ) {

			$field_id   = ( ! empty( $this->field['id'] ) ) ? $this->field['id'] : '';
			$unique_id  = ( ! empty( $this->unique ) ) ? $this->unique . '[' . $field_id . ']' : $field_id;
			$field_name = ( ! empty( $this->field['name'] ) ) ? $this->field['name'] : $unique_id;
			$tag_prefix = ( ! empty( $this->field['tag_prefix'] ) ) ? $this->field['tag_prefix'] : '';

			if ( ! empty( $tag_prefix ) ) {
				$nested_name = str_replace( '[', '[' . $tag_prefix, $nested_name );
			}

			return $field_name . $nested_name;

		}

		public function field_attributes( $custom_atts = array() ) {

			$field_id   = ( ! empty( $this->field['id'] ) ) ? $this->field['id'] : '';
			$attributes = ( ! empty( $this->field['attributes'] ) ) ? $this->field['attributes'] : array();

			if ( ! empty( $field_id ) ) {
				$attributes['data-depend-id'] = $field_id;
			}

			if ( ! empty( $this->field['placeholder'] ) ) {
				$attributes['placeholder'] = $this->field['placeholder'];
			}

			$attributes = wp_parse_args( $attributes, $custom_atts );

			$atts = '';

			if ( ! empty( $attributes ) ) {
				foreach ( $attributes as $key => $value ) {
					if ( $value === 'only-key' ) {
						$atts .= ' ' . $key;
					} else {
						$atts .= ' ' . $key . '="' . $value . '"';
					}
				}
			}

			return $atts;

		}

		public function field_before() {
			return ( ! empty( $this->field['before'] ) ) ? $this->field['before'] : '';
		}

		public function field_after() {

			$output  = ( ! empty( $this->field['desc'] ) ) ? '<p class="spf-text-desc">' . $this->field['desc'] . '</p>' : '';
			$output .= ( ! empty( $this->field['after'] ) ) ? $this->field['after'] : '';
			$output .= ( ! empty( $this->field['help'] ) ) ? '<span class="spf-help"><span class="spf-help-text">' . $this->field['help'] . '</span><span class="fa fa-question-circle"></span></span>' : '';
			$output .= ( ! empty( $this->field['_error'] ) ) ? '<p class="spf-text-error">' . $this->field['_error'] . '</p>' : '';

			return $output;

		}

		public function field_data( $type = '' ) {

			$options    = array();
			$query_args = ( ! empty( $this->field['query_args'] ) ) ? $this->field['query_args'] : array();

			switch ( $type ) {

				case 'page':
				case 'pages':
					$pages = get_pages( $query_args );

					if ( ! is_wp_error( $pages ) && ! empty( $pages ) ) {
						foreach ( $pages as $page ) {
							$options[ $page->ID ] = $page->post_title;
						}
					}

					break;

				case 'post':
				case 'posts':
					$posts = get_posts( $query_args );

					if ( ! is_wp_error( $posts ) && ! empty( $posts ) ) {
						foreach ( $posts as $post ) {
							  $options[ $post->ID ] = $post->post_title;
						}
					}

					break;

				case 'category':
				case 'categories':
					$categories = get_categories( $query_args );

					if ( ! is_wp_error( $categories ) && ! empty( $categories ) && ! isset( $categories['errors'] ) ) {
						foreach ( $categories as $category ) {
							  $options[ $category->term_id ] = $category->name . "( $category->count )";
						}
					}

					break;

				case 'tag':
				case 'tags':
					$taxonomies = ( isset( $query_args['taxonomies'] ) ) ? $query_args['taxonomies'] : 'post_tag';
					$tags       = get_terms( $taxonomies, $query_args );

					if ( ! is_wp_error( $tags ) && ! empty( $tags ) ) {
						foreach ( $tags as $tag ) {
							  $options[ $tag->term_id ] = $tag->name;
						}
					}

					break;

				case 'menu':
				case 'menus':
					$menus = wp_get_nav_menus( $query_args );

					if ( ! is_wp_error( $menus ) && ! empty( $menus ) ) {
						foreach ( $menus as $menu ) {
							  $options[ $menu->term_id ] = $menu->name;
						}
					}

					break;

				case 'post_type':
				case 'post_types':
					$post_types = get_post_types(
						array(
							'show_in_nav_menus' => true,
						)
					);

					if ( ! is_wp_error( $post_types ) && ! empty( $post_types ) ) {
						foreach ( $post_types as $post_type ) {
							$options[ $post_type ] = ucfirst( $post_type );
						}
					}

					break;

				case 'sidebar':
				case 'sidebars':
					global $wp_registered_sidebars;

					if ( ! empty( $wp_registered_sidebars ) ) {
						foreach ( $wp_registered_sidebars as $sidebar ) {
							$options[ $sidebar['id'] ] = $sidebar['name'];
						}
					}

					break;

				case 'user':
				case 'users':
					$users          = get_users( array( 'fields' => array( 'ID' ) ) );
					$options['n/a'] = __( 'N/A', 'wp-team' );
					foreach ( $users as $key => $user_id ) {
						$options[ $user_id->ID ] = get_user_meta( $user_id->ID, 'nickname', true );
					}

					break;

				case 'img_sizes':
					global $_wp_additional_image_sizes;
					$image_sizes = get_intermediate_image_sizes();
					// print_r($image_sizes);
					foreach ( $image_sizes as $size_name ) {
						if ( in_array( $size_name, array( 'thumbnail', 'medium', 'medium_large', 'large' ) ) ) {
							$options[ $size_name ] = ucfirst( $size_name ) . '- ' . ( get_option( "{$size_name}_crop" ) ? 'hard:' : 'soft:' ) . get_option( "{$size_name}_size_w" ) . 'x' . get_option( "{$size_name}_size_h" );
						} elseif ( isset( $_wp_additional_image_sizes[ $size_name ] ) ) {
							$options[ $size_name ] = ucfirst( $size_name ) . '- ' . ( ( $_wp_additional_image_sizes[ $size_name ]['crop'] ) ? 'hard:' : 'soft:' ) . $_wp_additional_image_sizes[ $size_name ]['width'] . 'x' . $_wp_additional_image_sizes[ $size_name ]['height'];
						}
					}
					$options['original'] = __( 'Original uploaded Image', 'wp-team' );
					break;

				default:
					if ( function_exists( $type ) ) {
						$options = call_user_func( $type, $this->value, $this->field );
					}
					break;

			}

			return $options;

		}

	}
}