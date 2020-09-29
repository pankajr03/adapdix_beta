(function( $ ) {
	'use strict';

	/**
	 * All of the code for your admin-facing JavaScript source
	 * should reside in this file.
	 *
	 * Note: It has been assumed you will write jQuery code here, so the
	 * $ function reference has been prepared for usage within the scope
	 * of this function.
	 *
	 * This enables you to define handlers, for when the DOM is ready:
	 *
	 * $(function() {
	 *
	 * });
	 *
	 * When the window is loaded:
	 *
	 * $( window ).load(function() {
	 *
	 * });
	 *
	 * ...and/or other possibilities.
	 *
	 * Ideally, it is not considered best practise to attach more than a
	 * single DOM-ready or window-load handler for a particular page.
	 * Although scripts in the WordPress core, Plugins and Themes may be
	 * practising this, we should strive to set a better example in our own work.
	 */
	
	$(function(){
    	$('.column-is_featured input[name=is_post_featured]').change(function(){
	    	//console.log(this.checked);
	    	var postId = $(this).attr('data-id');
	    	var isFeatured = this.checked ? 1 : 0;
			$.post(ajaxurl, 'action=featured_posts_pro_is_featured_post&post_id='+postId+'&is_post_featured='+isFeatured);
	    });
    	
    	
    	//sortable
    	if($( "#admin-featured-posts-pro-list" ).length > 0){
	    	$( "#admin-featured-posts-pro-list" ).sortable({
	    		update: function(event, ui){
	    			var postIds = [];
	    			$( "#admin-featured-posts-pro-list > tr" ).each(function(){
	    				postIds.push($(this).attr('data-id'));
	    			})
	    			postIds = postIds.join(',');
	    			$.get(ajaxurl, 'action=featured_posts_pro_order&post_ids='+postIds)
	    		}
	    	});
    	}
    	
	})
	
	

})( jQuery );