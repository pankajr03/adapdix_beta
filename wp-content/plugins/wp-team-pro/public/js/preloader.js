; (function ($) {
    'use strict'
    $('body').find('.sp-team-pro.sptp-section').each(function () {
        $(".wp-team-pro-preloader").css("opacity", "1");
        var wp_team_pro_id = $(this).attr('id'),
            parents_class = jQuery('#' + wp_team_pro_id).parent('.sp-wp-team-pro-wrapper'),
            parents_siblings_id = parents_class.find('.page-loading-image').attr('id');
        $(window).load(function () {
            $('#' + parents_siblings_id).animate({ opacity: 0 }, 600).remove();
            
        })
    })
})(jQuery)