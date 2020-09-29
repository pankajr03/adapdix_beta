<?php
/**
 * Template Name: Home - without video bar
 */
get_header('home-new');
?>
<div class="container homenotlogin">
    <?php the_post(); ?>
    <div class="row-fluid">
        <?php get_template_part('content', 'page'); ?>
    </div>
</div>

<div class="row-fluid home-opt-in-form">
    <div class="container">
        <?php //dynamic_sidebar('sidebar-6')  ?>
        <div class="containerInner1">
            <div class="row" style="margin-bottom: 0px; outline: none;" data-delay="500" data-animate="fade"
                 data-trigger="none" data-title="3 column row">
                <!--script type="text/javascript"
                        src="//www1.moon-ray.com/v2.4/include/formEditor/genjs-v2.php?html=false&uid=p2c6041f50"></script>
                <div class="moonray-form-p2c6041f50">
                    <form class="moonray-form-clearfix" action="https://forms.moon-ray.com/v2.4/form_processor.php?"
                          method="post" accept-charset="ISO-8859-1">
                        <div class="col-md-4 innerContent col_left" id="col-left-512" data-delay="500"
                             data-animate="fade" data-trigger="none" data-title="Left column" data-col="left"
                             style="outline: none;">
                            <div
                                class="moonray-form-element-wrapper moonray-form-element-wrapper-alignment-left moonray-form-input-type-text">
                                <input name="firstname" type="text" class="moonray-form-input form-first"
                                       id="mr-field-element-619757134467" required value=""
                                       placeholder="Enter Your First Name"/></div>
                        </div>
                        <div class="col-md-4 innerContent col_right ui-resizable" id="col-center-302"
                             data-delay="500"
                             data-animate="fade" data-trigger="none" data-title="Center column" data-col="center"
                             style="outline: none;">
                            <div
                                class="moonray-form-element-wrapper moonray-form-element-wrapper-alignment-left moonray-form-input-type-email">
                                <input name="email" type="email"
                                       class="moonray-form-input form-second"
                                       id="mr-field-element-182821498252"
                                       required value=""
                                       placeholder="Enter Your Best Email Address"/></div>
                        </div>
                        <div class="col-md-4 innerContent col_right ui-resizable" id="col-right-500"
                             data-delay="500"
                             data-animate="fade" data-trigger="none" data-title="Right column" data-col="right"
                             style="outline: none;">
                            <div
                                class="moonray-form-element-wrapper moonray-form-element-wrapper-alignment-left moonray-form-input-type-submit">
                                <input type="submit" name="submit-button" value="Sign Up For Free Course!"
                                       class="moonray-form-input elButtonMain"
                                       id="mr-field-element-859993786783"/>
                            </div>
                            <div class="moonray-form-element-wrapper moonray-form-input-type-hidden"><input
                                    name="afft_" type="hidden" value=""/></div>
                            <div class="moonray-form-element-wrapper moonray-form-input-type-hidden"><input
                                    name="aff_" type="hidden" value=""/></div>
                            <div class="moonray-form-element-wrapper moonray-form-input-type-hidden"><input
                                    name="sess_" type="hidden" value=""/></div>
                            <div class="moonray-form-element-wrapper moonray-form-input-type-hidden"><input
                                    name="ref_" type="hidden" value=""/></div>
                            <div class="moonray-form-element-wrapper moonray-form-input-type-hidden"><input
                                    name="own_" type="hidden" value=""/></div>
                            <div class="moonray-form-element-wrapper moonray-form-input-type-hidden"><input
                                    name="oprid" type="hidden" value=""/></div>
                            <div class="moonray-form-element-wrapper moonray-form-input-type-hidden"><input
                                    name="contact_id" type="hidden" value=""/></div>
                            <div class="moonray-form-element-wrapper moonray-form-input-type-hidden"><input
                                    name="uid" type="hidden" value="p2c6041f50"/></div>
                        </div>
                    </form>
                </div-->
              <?php
                if (is_active_sidebar('public-frontpage-optin-form')){
                        dynamic_sidebar('public-frontpage-optin-form');
                        }
                ?>
        </div>
    </div>
</div>

<div class="container">
        <div class="hero-unit">
            <div class="row-fluid">
                <div class="col-md-4">
                    <div id="secondary" class="widget-area" role="complementary">
                            <?php get_template_part('multi', 'menu'); ?>
                        
                    </div>
                </div>
                <div class="col-md-8">
                    <?php while (have_posts()) : the_post(); ?>
                        <?php get_template_part('content', 'page'); ?>
                    <?php endwhile; // end of the loop.   ?>
                </div>

            </div>
        </div>
    </div>

<div class="row-fluid" style="  background-color: rgb(227, 244, 248);border-bottom:2px solid rgb(186, 237, 248);">
    <div style="color: inherit;margin:0 auto;" class="low-3-ban container">
        <div class="span4">
            <h1>Earn More Drive Less</h1>
            <span>This idea came about because as a driver there was no way to scale your earnings beyond your own personal efforts. Currently 75% of all revenues generated by the ride share industry go to the drivers individually and now MobbyD makes it possible for drivers to earn beyond their personal efforts. </span>
        </div>
        <div class="span4">
            <h1>The Real Way To Earn</h1>
            <span>With MobbyD you are going to learn the most effective way to take advantage of the ride share industry. Remember the ride share industry generates Billions of dollars every single month through the efforts of it's drivers!</span>
        </div>
        <div class="span4">
            <h1>Live Webinars</h1>
            <span>If you have any questions as you progress through our members area, you can attend our live webinars and ask our trainers any questions you have.</span>
        </div>
        <div class="clearfix"></div>
    </div>
</div>


<?php get_footer('home-new'); ?>