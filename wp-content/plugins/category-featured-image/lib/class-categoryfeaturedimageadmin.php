<?php
/**
 * Category Featured Image
 *
 * @package    Category Featured Image
 * @subpackage CategoryFeaturedImageAdmin Management screen
/*
	Copyright (c) 2019- Katsushi Kawamori (email : dodesyoswift312@gmail.com)
	This program is free software; you can redistribute it and/or modify
	it under the terms of the GNU General Public License as published by
	the Free Software Foundation; version 2 of the License.

	This program is distributed in the hope that it will be useful,
	but WITHOUT ANY WARRANTY; without even the implied warranty of
	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
	GNU General Public License for more details.

	You should have received a copy of the GNU General Public License
	along with this program; if not, write to the Free Software
	Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
 */

$categoryfeaturedimageadmin = new CategoryFeaturedImageAdmin();

/** ==================================================
 * Management screen
 */
class CategoryFeaturedImageAdmin {

	/** ==================================================
	 * Construct
	 *
	 * @since 1.00
	 */
	public function __construct() {

		add_action( 'admin_menu', array( $this, 'plugin_menu' ) );
		add_filter( 'plugin_action_links', array( $this, 'settings_link' ), 10, 2 );

	}

	/** ==================================================
	 * Add a "Settings" link to the plugins page
	 *
	 * @param  array  $links  links array.
	 * @param  string $file   file.
	 * @return array  $links  links array.
	 * @since 1.00
	 */
	public function settings_link( $links, $file ) {
		static $this_plugin;
		if ( empty( $this_plugin ) ) {
			$this_plugin = 'category-featured-image/categoryfeaturedimage.php';
		}
		if ( $file == $this_plugin ) {
			$links[] = '<a href="' . admin_url( 'edit.php?page=categoryfeaturedimage' ) . '">' . __( 'Settings' ) . '</a>';
		}
			return $links;
	}

	/** ==================================================
	 * Settings page
	 *
	 * @since 1.00
	 */
	public function plugin_menu() {
		add_posts_page( 'Category Featured Image Options', 'Category Featured Image', 'manage_options', 'categoryfeaturedimage', array( $this, 'plugin_options' ) );
	}

	/** ==================================================
	 * Settings page
	 *
	 * @since 1.00
	 */
	public function plugin_options() {

		if ( ! current_user_can( 'manage_options' ) ) {
			wp_die( esc_html__( 'You do not have sufficient permissions to access this page.' ) );
		}

		$category_link = '<a style="text-decoration: none;" href="' . admin_url( 'edit-tags.php?taxonomy=category' ) . '">' . __( 'Category' ) . '</a>';
		?>

		<div class="wrap">
		<h2>Category Featured Image</h2>
			<?php $this->credit(); ?>
			<hr>
			<h3><?php esc_html_e( 'Set when saving a post', 'category-featured-image' ); ?></h3>
			<div style="margin: 5px; padding: 5px;">
				<p class="description">
				<?php
				/* translators: admin category link */
				echo wp_kses_post( sprintf( __( 'When you save each individual post, an featured image will be set for the category of the post. The featured image is set by %s.', 'category-featured-image' ), $category_link ) );
				?>
				</p>
			</div>
		</div>
		<?php
	}

	/** ==================================================
	 * Credit
	 *
	 * @since 1.00
	 */
	private function credit() {

		$plugin_name    = null;
		$plugin_ver_num = null;
		$plugin_path    = plugin_dir_path( __DIR__ );
		$plugin_dir     = untrailingslashit( $plugin_path );
		$slugs          = explode( '/', $plugin_dir );
		$slug           = end( $slugs );
		$files          = scandir( $plugin_dir );
		foreach ( $files as $file ) {
			if ( '.' === $file || '..' === $file || is_dir( $plugin_path . $file ) ) {
				continue;
			} else {
				$exts = explode( '.', $file );
				$ext  = strtolower( end( $exts ) );
				if ( 'php' === $ext ) {
					$plugin_datas = get_file_data(
						$plugin_path . $file,
						array(
							'name'    => 'Plugin Name',
							'version' => 'Version',
						)
					);
					if ( array_key_exists( 'name', $plugin_datas ) && ! empty( $plugin_datas['name'] ) && array_key_exists( 'version', $plugin_datas ) && ! empty( $plugin_datas['version'] ) ) {
						$plugin_name    = $plugin_datas['name'];
						$plugin_ver_num = $plugin_datas['version'];
						break;
					}
				}
			}
		}
		$plugin_version = __( 'Version:' ) . ' ' . $plugin_ver_num;
		/* translators: FAQ Link & Slug */
		$faq       = sprintf( esc_html__( 'https://wordpress.org/plugins/%s/faq', '%s' ), $slug );
		$support   = 'https://wordpress.org/support/plugin/' . $slug;
		$review    = 'https://wordpress.org/support/view/plugin-reviews/' . $slug;
		$translate = 'https://translate.wordpress.org/projects/wp-plugins/' . $slug;
		$facebook  = 'https://www.facebook.com/katsushikawamori/';
		$twitter   = 'https://twitter.com/dodesyo312';
		$youtube   = 'https://www.youtube.com/channel/UC5zTLeyROkvZm86OgNRcb_w';
		$donate    = sprintf( esc_html__( 'https://shop.riverforest-wp.info/donate/', '%s' ), $slug );

		?>
			<span style="font-weight: bold;">
			<div>
		<?php echo esc_html( $plugin_version ); ?> | 
			<a style="text-decoration: none;" href="<?php echo esc_url( $faq ); ?>" target="_blank" rel="noopener noreferrer"><?php esc_html_e( 'FAQ' ); ?></a> | <a style="text-decoration: none;" href="<?php echo esc_url( $support ); ?>" target="_blank" rel="noopener noreferrer"><?php esc_html_e( 'Support Forums' ); ?></a> | <a style="text-decoration: none;" href="<?php echo esc_url( $review ); ?>" target="_blank" rel="noopener noreferrer"><?php sprintf( esc_html_e( 'Reviews', '%s' ), $slug ); ?></a>
			</div>
			<div>
			<a style="text-decoration: none;" href="<?php echo esc_url( $translate ); ?>" target="_blank" rel="noopener noreferrer">
			<?php
			/* translators: Plugin translation link */
			echo sprintf( esc_html__( 'Translations for %s' ), esc_html( $plugin_name ) );
			?>
			</a> | <a style="text-decoration: none;" href="<?php echo esc_url( $facebook ); ?>" target="_blank" rel="noopener noreferrer"><span class="dashicons dashicons-facebook"></span></a> | <a style="text-decoration: none;" href="<?php echo esc_url( $twitter ); ?>" target="_blank" rel="noopener noreferrer"><span class="dashicons dashicons-twitter"></span></a> | <a style="text-decoration: none;" href="<?php echo esc_url( $youtube ); ?>" target="_blank" rel="noopener noreferrer"><span class="dashicons dashicons-video-alt3"></span></a>
			</div>
			</span>

			<div style="width: 250px; height: 180px; margin: 5px; padding: 5px; border: #CCC 2px solid;">
			<h3><?php sprintf( esc_html_e( 'Please make a donation if you like my work or would like to further the development of this plugin.', '%s' ), $slug ); ?></h3>
			<div style="text-align: right; margin: 5px; padding: 5px;"><span style="padding: 3px; color: #ffffff; background-color: #008000">Plugin Author</span> <span style="font-weight: bold;">Katsushi Kawamori</span></div>
			<button type="button" style="margin: 5px; padding: 5px;" onclick="window.open('<?php echo esc_url( $donate ); ?>')"><?php esc_html_e( 'Donate to this plugin &#187;' ); ?></button>
			</div>

			<?php

	}

}


