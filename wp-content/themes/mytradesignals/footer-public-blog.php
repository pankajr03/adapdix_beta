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

<footer class="footer">
    <div class="copyright">
        <div class="container">
            <div class="row-fluid">
                <div class="span12 text-left cp-text">
                    Earn More Drive Less With MobbyD's Affiliate Based Recruiting System!
                    <a class="brand" href="<?php echo esc_url(home_url('/')); ?>"><img class="logo"
                                                                                       src="<?php echo get_template_directory_uri(); ?>/img/logo.png"/></a>
                </div>
            </div>
        </div>
    </div>
    <div>
        <p class="poweredby" style="text-align:center;margin-right:80px;font-size:15px;margin-bottom:15px;padding-top:15px;">
            Copyright (c) 2017 MobbyD LLC  | <a href="/terms.html" style="color:#525252" target="disclaimer_popup" onclick="window.open('','disclaimer_popup','height=600, width=700,scrollbars=yes')">Terms of Use &amp; Service</a>
        </p>
        
    </div>
    <div class="row">
        <div class="col-md-12 text-center" style="background-color:#fff;padding:45px;color: rgba(47, 47, 47, 0.54902);font-size: 16px;">
            <span>
                <b>MobbyD</b> - All Rights Reserved.
            </span>
        </div>
    </div>
</footer>

<!-- Le javascript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->

<!--<script src="assets/bootstrap/js/bootstrap-transition.js"></script>
<script src="assets/bootstrap/js/bootstrap-alert.js"></script>
<script src="assets/bootstrap/js/bootstrap-modal.js"></script>
<script src="assets/bootstrap/js/bootstrap-dropdown.js"></script>
<script src="assets/bootstrap/js/bootstrap-scrollspy.js"></script>
<script src="assets/bootstrap/js/bootstrap-tab.js"></script>
<script src="assets/bootstrap/js/bootstrap-tooltip.js"></script>
<script src="assets/bootstrap/js/bootstrap-popover.js"></script>
<script src="assets/bootstrap/js/bootstrap-button.js"></script>
<script src="assets/bootstrap/js/bootstrap-collapse.js"></script>
<script src="assets/bootstrap/js/bootstrap-carousel.js"></script>
<script src="assets/bootstrap/js/bootstrap-typeahead.js"></script>-->


<?php /*


  </div><!-- #main .wrapper -->
  <footer id="colophon" role="contentinfo">
  <div class="site-info">
  <?php do_action( 'twentytwelve_credits' ); ?>
  <a href="<?php echo esc_url( __( 'http://wordpress.org/', 'twentytwelve' ) ); ?>" title="<?php esc_attr_e( 'Semantic Personal Publishing Platform', 'twentytwelve' ); ?>"><?php printf( __( 'Proudly powered by %s', 'twentytwelve' ), 'WordPress' ); ?></a>
  </div><!-- .site-info -->
  </footer><!-- #colophon -->
  </div><!-- #page -->
 */
?>
<?php wp_footer(); ?>
</body>
</html>