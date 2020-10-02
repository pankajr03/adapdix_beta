<?php
/**
 * The template for displaying the footer.
 *
 * Contains footer content and the closing of the
 * #main and #page div elements.
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */
?>

	
	<div class="spacer partner-spacer"></div>
                  <div class="footer">
                      <div class="custom-container">
                      <div class="row hide-m">
                          <div class="col-md-4">
                              <div class="foot-left">
                                <div class="footer-logo">
                                    <img src="<?php echo get_template_directory_uri(); ?>/img/logo.png">
                                </div> 
                                <div class="policy">
                                    <ul>
                                        <li>
                                            &copy; 2020 Adapdix.
                                        </li>
                                        <li>
                                            Privacy Policy
                                        </li>
                                    </ul>
                                </div>   
                            </div>
                          </div>
                          <div class="col-md-8">
                            <div class="footer-menu">
                                
								<?php echo wp_nav_menu(array(
									'menu' => 'Footer Menu',
									'container_class' => 'footer-menu',
									'container' => false,
									'items_wrap'=>'<ul>%3$s</ul>',
									'walker' => new MenuCustomizer));
								?>
                            </div>   
                            <div class="social-menu">
                                <ul>        
                                    <li>
                                        <a><i class="fa fa-twitter" aria-hidden="true"></i></a>
                                      </li>                        
                                      <li>
                                        <a><i class="fa fa-facebook" aria-hidden="true"></i></a>
                                      </li>
                                     
                                        <li>
                                          <a href="https://www.linkedin.com/company/adapdix/"><i class="fa fa-linkedin" aria-hidden="true"></i></a>
                                        </li>
										<li>
                                          <a>
                                            <img src="<?php echo get_template_directory_uri(); ?>/img/medium.png" class="medium-icon">
                                          </a>
                                        </li>
                                        
                                      
                                </ul>
                            </div> 
                        </div>
                      </div>
					  <div class="row hide-dt">
                              <div class="foot-left">
                                <div class="footer-logo">
                                    <img src="<?php echo get_template_directory_uri(); ?>/img/logo.png">
									  <a class="action-btn-footer" href="https://www.adapdix.com/r_html/beta/?page_id=49">Get Started</a>
                                </div> 
                                <div class="footer-bottom">
                                <div class="policy">
                                    <ul>
                                        <li>
                                            &copy; 2020 Adapdix.
                                        </li>
                                        <li>
                                            Privacy Policy
                                        </li>
										
                                    </ul>
                                </div>   
								<div class="social-menu">
                                
                                <ul>        
                                    <li>
                                        <a><i class="fa fa-twitter" aria-hidden="true"></i></a>
                                      </li>                        
                                      <li>
                                        <a><i class="fa fa-facebook" aria-hidden="true"></i></a>
                                      </li>
                                     
                                        <li>
                                          <a href="https://www.linkedin.com/company/adapdix/"><i class="fa fa-linkedin" aria-hidden="true"></i></a>
                                        </li>
										<li>
										  <a>
											<img src="<?php echo get_template_directory_uri(); ?>/img/medium.png" class="medium-icon">
										  </a>
                                        </li>
                                        
                                      
                                </ul>
                            </div> 
                            </div> 
                            </div>
                      </div>
                      </div>
                    </div>
		
	
</div>   

<script>
window.onscroll = function() {myFunction()};

var header = document.getElementById("stickyHeader");
var sticky = header.offsetTop;

function myFunction() {
if (window.pageYOffset > sticky) {
header.classList.add("sticky");
} else {
header.classList.remove("sticky");
}
}
</script>



<?php wp_footer(); ?>

<script>
$('.slider-for-sloution').slick({
  slidesToShow: 1,
  slidesToScroll: 1,
  fade: true,

  
  asNavFor: '.slider-nav-sloution'
});
$('.slider-nav-sloution').slick({
  slidesToShow: 5,
  slidesToScroll: 1,
  asNavFor: '.slider-for-sloution',
  arrows: true,
  centerMode: false,
  focusOnSelect: true,
  responsive: [
        {
            breakpoint: 980, // tablet breakpoint
            settings: {
                slidesToShow: 3,
                slidesToScroll: 1
            }
        },
        {
            breakpoint: 480, // mobile breakpoint
            settings: {
                slidesToShow: 1,
                slidesToScroll: 1
            }
        }
    ]
});
$(document).ready(function () {
	$( "input[type=text],input[type=email], textarea " ).focus(function() {
		$('.grecaptcha-badge').addClass('showgr');
	});
});

</script>
<!-- Start of HubSpot Embed Code -->
<script type="text/javascript" id="hs-script-loader" async defer src="//js.hs-scripts.com/7374328.js"></script>
<!-- End of HubSpot Embed Code -->
</body>
</html>