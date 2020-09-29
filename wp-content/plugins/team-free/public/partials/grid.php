<?php
/**
* Grid layout.
*
* @package WP_Team
* @since 2.0.0
*/

?>

<?php
if ( $pagination ) {
	$cookie_name = $generator_id . 'sptpPagination';
	if ( isset( $_COOKIE[ "$cookie_name" ] ) && $_COOKIE[ "$cookie_name" ] ) {
		$page_numb = (int) $_COOKIE[ "$cookie_name" ];
	} else {
	$page_numb = 1;
	}
	if ( 'pagination_number' === $pagination_type ) {
		$filter_members_chunk = array_chunk( $filter_members, $show_per_page );
		$members_array        = $filter_members_chunk[0];
		if ( $page_numb > 1 ) {
			$members_array = $filter_members_chunk[ $page_numb - 1 ];
		}
	} else {
		$members_array = $filter_members;
	}
} else {
	$members_array = $filter_members;
}
?>
<?php foreach ( $members_array as $key => $member ) : ?>
<?php
include 'single-member.php';
?>
<?php endforeach; ?>
		