<?php
global $affwp_register_redirect;

affiliate_wp()->register->print_errors();

$errors = affiliate_wp()->register->get_errors();

if ( ! is_user_logged_in() && ! empty( $errors ) ) {

	if ( ! array_key_exists( 'empty_name', $errors ) ) {
		$user_name = sanitize_text_field( $_POST['affwp_user_name'] );
	}

	if ( ! array_key_exists( 'empty_username', $errors ) && ! array_key_exists( 'username_unavailable', $errors ) && ! array_key_exists( 'username_invalid', $errors ) ) {
		$user_login = sanitize_text_field( $_POST['affwp_user_login'] );
	}

	if ( ! array_key_exists( 'email_unavailable', $errors ) && ! array_key_exists( 'email_invalid', $errors ) ) {
		$user_email = sanitize_text_field( $_POST['affwp_user_email'] );
	}

	if ( ! array_key_exists( 'payment_email_invalid', $errors ) ) {
		$payment_email = sanitize_text_field( $_POST['affwp_payment_email'] );
	}

	$url    = esc_url( $_POST['affwp_user_url'] );
	$method = sanitize_text_field( $_POST['affwp_promotion_method'] );

}

if ( is_user_logged_in() ) {
	$current_user = wp_get_current_user();
	$user_name    = $current_user->user_firstname . ' ' . $current_user->user_lastname;
	$user_login   = $current_user->user_login;
	$user_email   = $current_user->user_email;
	$url          = $current_user->user_url;

	$disabled = ' disabled="disabled"';
} else {
	$disabled = '';
}

?>

<form id="affwp-register-form" class="affwp-form" action="" method="post" novalidate="novalidate">
	<?php do_action( 'affwp_affiliate_register_form_top' ); ?>

	<fieldset>
		<legend><?php _e( 'Register a New Affiliate Account', 'affiliate-wp' ); ?></legend>

		<?php do_action( 'affwp_register_fields_before' ); ?>

		<p>
			<label for="affwp-user-name"><?php _e( 'Your Name', 'affiliate-wp' ); ?></label>
			<input id="affwp-user-name" class="required" type="text" name="affwp_user_name" value="<?php if( ! empty( $user_name ) ) { echo $user_name; } ?>" title="<?php esc_attr_e( 'Your Name', 'affiliate-wp' ); ?>" />
		</p>

		<p>
			<label for="affwp-user-login"><?php _e( 'Username', 'affiliate-wp' ); ?></label>
			<input id="affwp-user-login" class="required" type="text" name="affwp_user_login" maxlength="60" value="<?php if( ! empty( $user_login ) ) { echo $user_login; } ?>" title="<?php esc_attr_e( 'Username', 'affiliate-wp' ); ?>"<?php echo $disabled; ?> />
		</p>

		<p>
			<label for="affwp-user-email"><?php _e( 'Account Email', 'affiliate-wp' ); ?></label>
			<input id="affwp-user-email" class="required" type="email" name="affwp_user_email" value="<?php if( ! empty( $user_email ) ) { echo $user_email; } ?>" title="<?php esc_attr_e( 'Email Address', 'affiliate-wp' ); ?>"<?php echo $disabled; ?> />
		</p>
		
		<?php if ( ! is_user_logged_in() ) : ?>

			<p>
				<label for="affwp-user-pass"><?php _e( 'Password', 'affiliate-wp' ); ?></label>
				<input id="affwp-user-pass" class="password required" type="password" name="affwp_user_pass" />
			</p>

			<p>
				<label for="affwp-user-pass2"><?php _e( 'Confirm Password', 'affiliate-wp' ); ?></label>
				<input id="affwp-user-pass2" class="password required" type="password" name="affwp_user_pass2" />
			</p>

		<?php endif; ?>

		<?php do_action( 'affwp_register_fields_before_tos' ); ?>

		<?php $terms_of_use = affiliate_wp()->settings->get( 'terms_of_use' ); ?>
		<?php if ( ! empty( $terms_of_use ) ) : ?>
			<p>
				<label class="affwp-tos" for="affwp-tos">
					<input id="affwp-tos" class="required" type="checkbox" name="affwp_tos" />
					<?php printf( __( 'Agree to our <a href="%s" target="_blank">Terms of Use</a>', 'affiliate-wp' ), esc_url( get_permalink( affiliate_wp()->settings->get( 'terms_of_use' ) ) ) ); ?>
				</label>
			</p>
		<?php endif; ?>

		<?php if ( affwp_is_recaptcha_enabled() ) : ?>
			<div class="g-recaptcha" data-sitekey="<?php echo esc_attr( affiliate_wp()->settings->get( 'recaptcha_site_key' ) ); ?>"></div>

			<p>
				<input type="hidden" name="g-recaptcha-remoteip" value=<?php echo esc_attr( affiliate_wp()->tracking->get_ip() ); ?> />
			</p>
		<?php endif; ?>

		<?php do_action( 'affwp_register_fields_before_submit' ); ?>

		<p>
			<input type="hidden" name="affwp_honeypot" value="" />
			<input type="hidden" name="affwp_redirect" value="<?php echo esc_url( $affwp_register_redirect ); ?>"/>
			<input type="hidden" name="affwp_register_nonce" value="<?php echo wp_create_nonce( 'affwp-register-nonce' ); ?>" />
			<input type="hidden" name="affwp_action" value="affiliate_register" />
			<input class="button" type="submit" value="<?php esc_attr_e( 'Register', 'affiliate-wp' ); ?>" />
		</p>

		<?php do_action( 'affwp_register_fields_after' ); ?>
	</fieldset>

	<?php do_action( 'affwp_affiliate_register_form_bottom' ); ?>
</form>