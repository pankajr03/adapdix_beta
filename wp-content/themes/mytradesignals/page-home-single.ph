<?php
/**
 * Template Name: Home - without video bar
 */

get_header('home-new'); ?>
    <div class="container">
        <?php the_post(); ?>
        <div class="row-fluid">
            <?php get_template_part('content', 'page'); ?>
        </div>

    </div>
    <br/><br/><br/>
    <div class="row-fluid home-opt-in-form">
        <div class="container">
            <?php //dynamic_sidebar('sidebar-6') ?>
            <div class="containerInner1">
                <div class="row" style="margin-bottom: 0px; outline: none;" data-delay="500" data-animate="fade"
                     data-trigger="none" data-title="3 column row">
                    <script type="text/javascript"
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
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row-fluid" style="  background-color: rgb(227, 244, 248);border-bottom:2px solid rgb(186, 237, 248);">
        <div style="width:1170px; margin:0 auto;" class="low-3-ban">
            <div class="span4">
                <h1>Technical Analysis</h1>
                <span>A big part of trading and or investing is understanding how to read charts.  There are a lot of charting applications out there but how do you make heads or tails. Well that's what we are here for.</span>
            </div>
            <div class="span4">
                <h1>Trading Methodolgies</h1>
                <span>Again there are a lot of different strategies and methodologies out there so what do you do.  We have assembled some of the best educators in the business to guide you through this tangled web.</span>
            </div>
            <div class="span4">
                <h1>Live Classes</h1>
                <span>Having some issues understanding what you are learning, no problem just attend our live classroom environment, watch out instructors trade live and ask any question you like.  We are here for you!</span>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
<?php get_footer('home-new'); ?>