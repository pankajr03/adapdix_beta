<?php
// mts_home.php
/**
 * Template Name: Adapdix Resources
 */

get_header('home'); ?>
	<div class="spacer-mobi"></div>
	<div class="section-contact resources-mob">
		
	<?php //get_template_part('content', 'homepage'); ?>
	<?php dynamic_sidebar('company-info-content');	?>
	
	</div>

<!-- jQuery first, then Popper.js, then Bootstrap JS -->
      <script
         src="https://code.jquery.com/jquery-3.4.1.min.js"
         integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
         crossorigin="anonymous"></script>
      <script
         src="  https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.5.9/slick.js"></script>
      <script src="js/bootstrap.min.js"></script>
      <script src="js/video-popup.js"></script>
      <script>
	   var $btns = $('.btn').click(function() {
		   if (this.id == 'all') {
			$('#parent > div').fadeIn(450);
		   } else {
		   var $el = $('.' + this.id).fadeIn(450);
			$('#parent > div').not($el).hide();
		   }
		   $btns.removeClass('active');
		   $(this).addClass('active');
	   })

	   $('.filterbtns').on('click', function(){
		  var abc = $(this).text();
		  $('#all1').html(abc);
		  
	   });
	   $('.filterreset').on('click', function(){
		
		  $('#all1').html('All Types');
		  $('#filtertypes').css('display','none');
		  show_limited_box();

	   });

	   $('#alltypes').on('click',function(){
		  $('#filtertypes').css('display','flex');
		});
	   
	   function show_limited_box() {
		   var parent_div_length = $('#parent> div').length ;
		   $('#parent> div').hide();
		   $('#parent> div#child-1').show();
		   $('#parent> div#child-2').show();
		   $('#parent> div#child-3').show();
		   $('#parent> div#child-4').show();
		   $('#parent> div#child-5').show();
		   $('#parent> div#child-6').show();
		   var parent_display_count = $('#parent').children("div.col-md-4").filter(function() {
					return $(this).css('display') !== 'none';
			  }).length;
		   if ( parent_div_length >= parent_display_count ) {
			console.log ('yese...') ; 
			$('#parent> div#show_more').show();
		   }
		   
	   }
	   
	   $('#parent> div#show_more button#show_more_button').click(function(){
			 var parent_div_length = $('#parent> div').length ;
		   
			 var parent_display_count = $('#parent').children("div.col-md-4").filter(function() {
					return $(this).css('display') !== 'none';
			  }).length;
			  console.log ("Show::" + parent_display_count) ;
			  console.log ("Total Show::" + parent_div_length) ;	  
			 var add_three_event = parent_display_count + 3;
			 if ( parent_div_length >= parent_display_count ) {
			 console.log ('Inner..') ; 
				for (var u=parent_display_count+1; u <= add_three_event; u++ ) {
				   var cr_div_ch_id = '#parent> div#child-'+u;
					$(cr_div_ch_id).show();
				}
				
				var parent_display_count_s_time = $('#parent').children("div.col-md-4").filter(function() {
					return $(this).css('display') !== 'none';
				}).length;
				
				if ( parent_div_length <= (parent_display_count_s_time+1 ) ) {
					$('#parent> div#show_more button#show_more_button').hide();
				}
				console.log ( "Second Time: " + parent_display_count_s_time ) ; 
				
			 } else {
				$('#parent> div#show_more button#show_more_button').hide();
			 }
			 
		});
	   $(document).ready(function(){
		show_limited_box();
	   });
	</script>	  
<?php get_footer('home'); ?>