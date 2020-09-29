<?php


global $post;
if (post_password_required($post)) {
    ?>
    <p>THIS POST IS PASSWORD PROTECTED. PLEASE ENTER THE PASSWORD TO VIEW THIS POST.</p>

    <?php echo get_the_password_form(); ?>

<?php
} else {

    get_header('products'); ?>
    <div class="container signal-optin">
        <div class="hero-unit opt-in-form">
            <div class="row-fluid ">
                <div class="logo-row">
                    <a href=""><img src="<?php echo get_template_directory_uri(); ?>/img/products-list-logo.png"
                                    alt="logo"></a>
                </div>
                <?php
                the_post();
                echo get_field('wpcf-signal-header', false, false);
                ?>
            </div>
            <div class="row-fluid">
                <div class="span6">
                    <?php
                    echo get_field('wpcf-code', false, false);
                    ?>
                </div>
                <div class="span6 description">
                    <?php echo get_field('wpcf-code-description', false, false); ?>
                </div>
            </div>
        </div>
    </div>


<?php
}
get_footer('products'); ?>
