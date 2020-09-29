<?php
/**
 * Single member.
 *
 * @package WP_Team
 * @since 2.0.0
 */

$member_info = get_post_meta( $member->ID, '_sptp_add_member', true );

if ( has_post_thumbnail( $member->ID ) ) {
	$member_image_src       = get_the_post_thumbnail_url( $member->ID, $image_size );
	$member_image_thumbnail = get_the_post_thumbnail_url( $member->ID, 'full' );
} else {
	
	if ( empty( $gallery_attachment ) ) {
		$member_image_src = SPT_PLUGIN_ROOT . 'public/img/Placeholder-Image.png';
	} 
	
	$img_member_id_path = $_SERVER['DOCUMENT_ROOT'].'/r_html/beta/wp-content/uploads/2020/06' ."/". $member->ID.".jpg";
	//echo $img_member_id_path;
	if ( file_exists( $img_member_id_path) ) {
		$member_image_src = home_url('/wp-content/uploads/2020/06') ."/". $member->ID.".jpg";
	}	
}

$image_alt = get_post_meta( get_post_thumbnail_id( $member->ID ), '_wp_attachment_image_alt', true );
?>


<div class="col-md-4">
	<a class='team-member' href = "<?php echo esc_html( get_permalink( $member->ID ) ) . '&team=' . $generator_id; ?>" target="<?php echo esc_html( $new_page_target ); ?>">
		<div class="img-effect">
			<img src="<?php echo esc_html( $member_image_src ); ?>" alt="<?php echo ( $image_alt ) ? esc_html( $image_alt ) : esc_html( get_the_title( $generator_id ) ); ?>" data-member="<?php echo esc_html( $member->ID ); ?>" class="img-fluid w-100" > 
		
			<div class="border-img"></div>
		</div>
		<h4 class=""><?php echo esc_html( $member->post_title ); ?></h4>
		<h5><?php echo esc_html( $member_info['sptp_job_title'] ); ?></h5>
		<p>
			<?php if ( ( ! empty( $member_info['sptp_short_bio'] ) ) && $bio_switch ) :
			$allowed_html = WP_Team_Public::sptp_allowed_html();
			echo nl2br( wp_kses( $member_info['sptp_short_bio'], $allowed_html ) ) ;
			?>
			<?php endif; ?>
		</p>
	  </a>
	  
	</div>


