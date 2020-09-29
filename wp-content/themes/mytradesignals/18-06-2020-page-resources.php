<?php
// mts_home.php
/**
 * Template Name: Adapdix Resources
 */

get_header('home'); ?>

	<div class="section-contact">			  
	<?php get_template_part('content', 'homepage'); ?>
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

         });

         $('#alltypes').on('click',function(){
            $('#filtertypes').css('display','block');
         });
      </script>	  
<?php get_footer('home'); ?>