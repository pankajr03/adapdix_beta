<?php
/**
 * Plugin Settings form template
 *
 * The get_option( 'olws_plugin_settings' ) will give you an array that contains
 * The plugins settings data saved in database 'wp_options' table.
 *
 * @package Orion Login with SMS
 */

?>
<div class="olws-settings-wrapper wrap">
	<!--Header-->
	<div class="jumbotron pt-1">
		<img class="heading-icon" src="<?php echo esc_url( OLWS_IMAGE_URI . '/login.svg' ); ?>" alt="<?php esc_html_e( 'Login Image', 'orion-login' ); ?>"/>
		<h4 class="mb-0 text-white lh-100"><?php esc_html_e( 'Orion Login With SMS', 'orion-login' ); ?></i></h4>
		<small><?php esc_html_e( 'by', 'orion-login' ); ?> Imran Sayed, Smit Patadiya</small>
	</div>

	<!--Plugin Description-->
	<div class="my-3 p-3 bg-white rounded box-shadow ">
		<h6 class="border-bottom border-gray pb-2 mb-0"><i class="fa fa-info-circle" aria-hidden="true"></i> <?php esc_html_e( 'Description', 'orion-login' ); ?></h6>
		<div class="media text-muted pt-3">
			<div class="d-sm-flex media-body olws-input-wrap pb-3 mb-0 small lh-125 border-bottom border-gray">
				<!--Common Instructions-->
				<div class="text-center w-100">
					<p class="h6"><?php esc_html_e( 'Let your user login on your website simply with their mobile number. No more password/email required.', 'orion-login' ); ?></p>
					<p class="h6"><?php esc_html_e( 'This plugin allows password less login by sending a verification code (sms/otp) to the user\'s mobile number.', 'orion-login' ); ?></p>
				</div>get the required Key from SMS
				<div class="text-center mt-0 mb-3 w-100">
					<img class="olws-page-banners" src="<?php echo esc_url( OLWS_IMAGE_URI . '/features.png' ); ?>" alt="Plugin Features" />
				</div>
				<div class="text-center mt-3 mb-3 w-100">
					<img class="olws-page-banners" src="<?php echo esc_url( OLWS_IMAGE_URI . '/supported-sms-gateways.png' ); ?>" alt="Supported SMS Gateways" />
				</div>
			</div>
		</div>
	</div>

	<!--SMS Gateway Links & Supported Plugins-->
	<div class="my-3 p-3 bg-white rounded box-shadow olws-instructions">
		<h6 class="border-bottom border-gray pb-2 mb-2"><i class="fa fa-info-circle" aria-hidden="true"></i> <?php esc_html_e( 'SMS Gateways & Supported Plugins', 'orion-login' ); ?></h6>
		<div class="row">
			<div class="col-12 col-md-6">
				<p class="mb-1"><?php esc_html_e( 'Get your API keys from below SMS Gateways.', 'orion-login' ); ?></p>
				<p class="section-title mb-1"><?php esc_html_e( 'SMS Gateways', 'orion-login' ); ?></p>
				<ol class="olws-list">
					<li>Twilio: <a target="_blank" href="<?php echo esc_url( 'https://www.youtube.com/watch?v=kepFz_P05rM' ); ?>"><i class="fas fa-link"></i> https://www.twilio.com</a></li>
					<li>Nexmo: <a target="_blank" href="<?php echo esc_url( 'https://www.youtube.com/watch?v=7pCO9TMOVUI' ); ?>"><i class="fas fa-link"></i> https://www.nexmo.com</a></li>
					<li>ClickSend: <a target="_blank" href="<?php echo esc_url( 'https://www.clicksend.com//' ); ?>"><i class="fas fa-link"></i> https://www.clicksend.com/</a></li>
					<li>MSG91: <a target="_blank" href="<?php echo esc_url( 'https://msg91.com//' ); ?>"><i class="fas fa-link"></i> https://msg91.com/</a></li>
					<li>Clickatell: <a target="_blank" href="<?php echo esc_url( 'https://www.youtube.com/watch?v=cu2HjXy3ap4' ); ?>"><i class="fas fa-link"></i> https://www.clickatell.com</a></li>
					<li>RingCaptcha: <a target="_blank" href="<?php echo esc_url( 'https://ringcaptcha.com//' ); ?>"><i class="fas fa-link"></i> https://ringcaptcha.com/</a></li>
				</ol>
			</div>
			<div class="col-12 col-md-6">
				<p class="mb-1"><?php esc_html_e( 'This plugin is Compatible all themes & login/registration plugins but we have successfully', 'orion-login' ); ?></p>
				<p class="section-title mb-1"><?php esc_html_e( 'Tested with below Plugins', 'orion-login' ); ?></p>
				<ol class="olws-list">
					<li><?php esc_html_e( 'WooCommerce', 'orion-login' ); ?></li>
					<li><?php esc_html_e( 'WPForms', 'orion-login' ); ?></li>
					<li><?php esc_html_e( 'Ninja Forms', 'orion-login' ); ?></li>
					<li><?php esc_html_e( 'Formidable Forms', 'orion-login' ); ?></li>
					<li><?php esc_html_e( 'Ultimate Member', 'orion-login' ); ?></li>
					<li><?php esc_html_e( 'User Registration - WPEverest', 'orion-login' ); ?></li>
					<li><?php esc_html_e( 'Profile Press', 'orion-login' ); ?></li>
					<li><?php esc_html_e( 'Registration Magic', 'orion-login' ); ?></li>
					<li><?php esc_html_e( 'Profile Builder', 'orion-login' ); ?></li>
					<li><?php esc_html_e( 'Pie Register', 'orion-login' ); ?></li>
					<li><?php esc_html_e( 'WP User Frontend', 'orion-login' ); ?></li>
				</ol>
			</div>
		</div>
		<div>
			<a href="<?php echo esc_url( 'https://www.messenger.com/t/OrionPlugins' );?>" target="_blank" class="btn btn-primary"><i class="fab fa-facebook-messenger"></i> <?php esc_html_e( 'Chat Support', 'orion_login' ); ?></a>
		</div>
	</div>

	<!--Form-->
	<form method="post" class="olws-settings-form" action="options.php">
		<?php
		settings_fields( 'olws-plugin-settings-group' );
		do_settings_sections( 'olws-plugin-settings-group' );

		?>
		<!--Heading-->
		<div class="d-sm-flex align-items-center p-0 my-3 text-white-50 bg-purple rounded box-shadow olws-section-title">
			<img class="heading-icon" src="<?php echo esc_url( OLWS_IMAGE_URI . '/api.svg' ); ?>" alt="API Configuration"/>
			<div class="lh-100 ihs-admin-head-cont">
				<h6 class="mb-0 text-white lh-100"><?php esc_html_e( 'SMS API Configuration', 'orion-login' ); ?></h6>
				<small><?php esc_html_e( 'API settings required in order to Send SMS or Verification Code', 'orion-login' ); ?></small>
			</div>
		</div>
		<div class="my-3 p-3 bg-white rounded box-shadow olws-api-config">
			<p class="border-bottom border-gray pb-2 mb-0"><?php esc_html_e( 'You can get the required Key from SMS Provider/SMS Gateway', 'orion-login' ); ?></p>
			<p class="border-bottom border-gray pb-2 mb-0"><a href="<?php echo esc_url( 'https://youtu.be/cu2HjXy3ap4' )?>"><?php esc_html_e( 'Plugin Tutorials Provider/SMS Gateway', 'orion-login' ); ?></a></p>
			<!--Api Type-->
			<!--Api Key-->
			<!--Api Secret-->
			<!--Api Username-->
			<!--Sender ID-->

			<?php

				$fields = array(
					array(
						'type'        => 'select',
						'name'        => 'api_type',
						'label'       => __( 'API Type', 'orion-login' ),
						'tooltip'     => __( 'Select API Type/SMS Gateway', 'orion-login' ),
						'placeholder' => '',
						'options'     => array(
							array(
								'label'          => 'Twilio',
								'value'          => 'twilio',
								'is_placeholder' => false,
							),
							array(
								'label'          => 'Nexmo',
								'value'          => 'nexmo',
								'is_placeholder' => false,
							),
							array(
								'label'          => 'ClickSend',
								'value'          => 'clicksend',
								'is_placeholder' => false,
							),
							array(
								'label'          => 'MSG91 - International',
								'value'          => 'msg91_International',
								'is_placeholder' => false,
							),
							array(
								'label'          => 'MSG91 - Standard',
								'value'          => 'msg91_Standard',
								'is_placeholder' => false,
							),
							array(
								'label'          => 'Clickatell',
								'value'          => 'clickatell',
								'is_placeholder' => false,
							),
							array(
								'label'          => 'Ring Captcha',
								'value'          => 'ringcaptcha',
								'is_placeholder' => false,
							),
						),
						'is_required' => true,
						'icon_class'  => 'fas fa-key',
						'icon_color'  => 'olws-bg-one',
					),
					array(
						'type'        => 'input',
						'name'        => 'api_key',
						'label'       => __( 'API KEY', 'orion-login' ),
						'tooltip'     => __( 'Get the API KEY from SMS Provider', 'orion-login' ),
						'placeholder' => __( 'Enter API Key', 'orion-login' ),
						'options'     => array(),
						'is_required' => true,
						'icon_class'  => 'fas fa-key',
						'icon_color'  => 'olws-bg-one',
					),
					array(
						'type'        => 'input',
						'name'        => 'api_secret',
						'label'       => __( 'API Secret', 'orion-login' ),
						'tooltip'     => __( 'Get the API Secret from SMS Provider. (Optional for some SMS Providers)', 'orion-login' ),
						'placeholder' => __( 'Enter API Secret', 'orion-login' ),
						'options'     => array(),
						'is_required' => false,
						'icon_class'  => 'fas fa-eye-slash',
						'icon_color'  => 'olws-bg-one',
					),
					array(
						'type'        => 'input',
						'name'        => 'api_username',
						'label'       => __( 'API Username/APP Key', 'orion-login' ),
						'tooltip'     => __( 'Get the API Username/APP Key from SMS Provider. (Optional for some SMS Providers)', 'orion-login' ),
						'placeholder' => __( 'Enter API Username/APP Key', 'orion-login' ),
						'options'     => array(),
						'is_required' => false,
						'icon_class'  => 'fas fa-key',
						'icon_color'  => 'olws-bg-one',
					),
					array(
						'type'        => 'input',
						'name'        => 'sender_id',
						'label'       => __( 'Sender ID', 'orion-login' ),
						'tooltip'     => __( 'Enter Sender ID if SMS provider supports it.', 'orion-login' ),
						'placeholder' => __( 'Enter Sender ID', 'orion-login' ),
						'options'     => array(),
						'is_required' => false,
						'icon_class'  => 'fa fa-id-badge',
						'icon_color'  => 'olws-bg-two',
					),
				);

				echo olws_populate_fields( $fields ); // phpcs:ignore WordPress.Security.EscapeOutput

				?>
		</div>

		<!--Heading-->
		<div class="d-sm-flex align-items-center p-0 my-3 text-white-50 bg-two rounded box-shadow olws-section-title">
			<img class="heading-icon" src="<?php echo esc_url( OLWS_IMAGE_URI . '/configuration.svg' ); ?>" alt="<?php esc_html_e( 'Configuration' ); ?>"/>
			<div class="lh-100 ihs-admin-head-cont">
				<h6 class="mb-0 text-white lh-100"><?php esc_html_e( 'Backend Data Configuration', 'orion-login' ); ?></h6>
			</div>
		</div>
		<div class="my-3 p-3 bg-white rounded box-shadow olws-api-config">

			<!--Phone Meta key-->
			<!--Saved With Country-->
			<?php

				$fields = array(
					array(
						'type'        => 'input',
						'name'        => 'phone_meta_key',
						'label'       => __( 'Phone Number Meta Key', 'orion-login' ),
						'tooltip'     => __( 'User meta key where user\'s phone number is stored.', 'orion-login' ),
						'placeholder' => __( 'Eg. billing_phone, phone_number', 'orion-login' ),
						'options'     => array(),
						'is_required' => true,
						'icon_class'  => 'fas fa-code',
						'icon_color'  => 'olws-bg-four',
					),
					array(
						'type'        => 'select',
						'name'        => 'saved_with_country_code',
						'label'       => __( 'Is saved with country code', 'orion-login' ),
						'tooltip'     => __( 'Is phone number is saved with country code in the database?', 'orion-login' ),
						'placeholder' => '',
						'options'     => array(
							array(
								'label'          => __( 'No', 'orion-login' ),
								'value'          => 'no',
								'is_placeholder' => false,
							),
							array(
								'label'          => __( 'Yes', 'orion-login' ),
								'value'          => 'yes',
								'is_placeholder' => false,
							),
							array(
								'label'          => __( 'Yes with + (plus) sign', 'orion-login' ),
								'value'          => 'with-plus-sign',
								'is_placeholder' => false,
							),
						),
						'is_required' => true,
						'icon_class'  => 'fa fa-globe',
						'icon_color'  => 'olws-bg-four',
					),
				);

				echo olws_populate_fields( $fields ); // phpcs:ignore WordPress.Security.EscapeOutput

				?>
		</div>
		<!--Heading-->
		<div class="d-sm-flex align-items-center p-0 my-3 text-white-50 bg-three rounded box-shadow olws-section-title">
			<img class="heading-icon" src="<?php echo esc_url( OLWS_IMAGE_URI . '/form.svg' ); ?>" alt="Heading Icon"/>
			<div class="lh-100 ihs-admin-head-cont">
				<h6 class="mb-0 text-white lh-100"><?php esc_html_e( 'Login Form Settings', 'orion-login' ); ?></h6>
			</div>
		</div>
		<div class="my-3 p-3 bg-white rounded box-shadow olws-api-config">

			<!--Country Code-->
			<!--Phone Number Length-->
			<!--Adaptive Style-->
			<!--Login With SMS Button Selector-->
			<!--Login Form Selector-->

			<?php

				$fields = array(
					array(
						'type'        => 'select',
						'name'        => 'country_code',
						'label'       => __( 'Country Code', 'orion-login' ),
						'tooltip'     => '',
						'placeholder' => '',
						'options'     => olws_get_country_code_options(),
						'is_required' => true,
						'icon_class'  => 'fa fa-globe',
						'icon_color'  => 'olws-bg-three',
					),
					array(
						'type'        => 'select',
						'name'        => 'mobile_length',
						'label'       => __( 'Phone number Length', 'orion-login' ),
						'tooltip'     => __( 'Phone Number length excluding country code.', 'orion-login' ),
						'placeholder' => '',
						'options'     => olws_get_phone_number_length_options(),
						'is_required' => true,
						'icon_class'  => 'fas fa-phone-square',
						'icon_color'  => 'olws-bg-three',
					),
					array(
						'type'        => 'select',
						'name'        => 'adaptive_style',
						'label'       => __( 'Apply Adaptive Style', 'orion-login' ),
						'tooltip'     => __( 'Dynamic styling for Buttons & Inputs based on your theme.', 'orion-login' ),
						'placeholder' => '',
						'options'     => array(
							array(
								'label'          => __( 'Yes', 'orion-login' ),
								'value'          => 1,
								'is_placeholder' => false,
							),
							array(
								'label'          => __( 'No', 'orion-login' ),
								'value'          => 0,
								'is_placeholder' => false,
							),
						),
						'is_required' => true,
						'icon_class'  => 'fas fa-magic',
						'icon_color'  => 'olws-bg-two',
					),
					array(
						'type'        => 'input',
						'name'        => 'login_btn_selector',
						'label'       => __( 'Login with SMS Button', 'orion-login' ),
						'tooltip'     => __( 'Button Selector of login forms\'s Login With SMS button.', 'orion-login' ),
						'placeholder' => __( 'Eg. button#my-login-with-sms', 'orion-login' ),
						'options'     => array(),
						'is_required' => true,
						'icon_class'  => 'fas fa-code',
						'icon_color'  => 'olws-bg-four',
					),
				);

				echo olws_populate_fields( $fields ); // phpcs:ignore WordPress.Security.EscapeOutput

				?>
				<div class="mt-1 mb-0 text-left">Or</div>
				<?php

				$fields = array(
					array(
						'type'        => 'input',
						'name'        => 'login_form_selector',
						'label'       => __( 'Login Form Selector', 'orion-login' ),
						'tooltip'     => __( 'This will create Login With SMS button in your form. Plugin will automatically create button', 'orion-login' ),
						'placeholder' => __( 'Eg. form#login-form', 'orion-login' ),
						'options'     => array(),
						'is_required' => false,
						'icon_class'  => 'fas fa-code',
						'icon_color'  => 'olws-bg-four',
					),
				);

				echo olws_populate_fields( $fields ); // phpcs:ignore WordPress.Security.EscapeOutput

				?>
		</div>

		<!--Submit Button-->
		<div class="olws-save-btn-container"><?php submit_button(); ?></div>

		<!--How to use plugin Heading-->
		<div class="d-sm-flex align-items-center p-0 my-3 text-white-50 bg-guide rounded box-shadow olws-section-title">
			<img class="heading-icon p-3" src="<?php echo esc_url( OLWS_IMAGE_URI . '/plugin-guide.svg' ); ?>" alt="API Configuration"/>
			<div class="lh-100 ihs-admin-head-cont">
				<h6 class="mb-0 text-white lh-100"><?php esc_html_e( 'How to use the Plugin?', 'orion-login' ); ?></h6>
				<small><?php esc_html_e( 'Watch below tutorials to have a better understanding.', 'orion-login' ); ?></small>
			</div>
		</div>
		<div class="d-block w-100">
			<div class="row">
				<div class="col-12 col-sm-6 col-md-4">
					<?php $title = esc_html__( '1. Plugin Setup', 'orion-login' ); ?>
					<?php $description = esc_html__( 'Orion Login with SMS Features, Setup guide and Clickatell API', 'orion-login' ); ?>
					<?php $video_link = 'https://www.youtube.com/embed/cu2HjXy3ap4'; ?>
					<?php echo olws_get_video_card( $title, $description, $video_link ); ?>
				</div>
				<div class="col-12 col-sm-6 col-md-4">
					<?php $title = esc_html__( '2. Nexmo API ', 'orion-login' ); ?>
					<?php $description = esc_html__( 'Orion Login with SMS | Nexmo API', 'orion-login' ); ?>
					<?php $video_link = 'https://www.youtube.com/embed/7pCO9TMOVUI'; ?>
					<?php echo olws_get_video_card( $title, $description, $video_link ); ?>
				</div>
				<div class="col-12 col-sm-6 col-md-4">
					<?php $title = esc_html__( '3. Twilio API', 'orion-login' ); ?>
					<?php $description = esc_html__( 'Orion Login with SMS | Twilio API', 'orion-login' ); ?>
					<?php $video_link = 'https://www.youtube.com/embed/kepFz_P05rM'; ?>
					<?php echo olws_get_video_card( $title, $description, $video_link ); ?>
				</div>
				<div class="col-12 col-sm-6 col-md-4">
					<?php $title = esc_html__( '4. Clicksend API', 'orion-login' ); ?>
					<?php $description = esc_html__( 'Orion Login with SMS | Clicksend API', 'orion-login' ); ?>
					<?php $video_link = 'https://www.youtube.com/embed/Gml5LR-437c'; ?>
					<?php echo olws_get_video_card( $title, $description, $video_link ); ?>
				</div>
				<div class="col-12 col-sm-6 col-md-4">
					<?php $title = esc_html__( '5. MSG91 API', 'orion-login' ); ?>
					<?php $description = esc_html__( 'Orion Login with SMS | MSG91 API', 'orion-login' ); ?>
					<?php $video_link = 'https://www.youtube.com/embed/e-moO1AYg8Q'; ?>
					<?php echo olws_get_video_card( $title, $description, $video_link ); ?>
				</div>
				<div class="col-12 col-sm-6 col-md-4">
					<?php $title = esc_html__( '6. RingCaptcha API', 'orion-login' ); ?>
					<?php $description = esc_html__( 'Orion Login with SMS | RingCaptcha API', 'orion-login' ); ?>
					<?php $video_link = 'https://www.youtube.com/embed/w9Rbu6rhIho'; ?>
					<?php echo olws_get_video_card( $title, $description, $video_link ); ?>
				</div>
			</div>
		</div>

	</form>
</div>
