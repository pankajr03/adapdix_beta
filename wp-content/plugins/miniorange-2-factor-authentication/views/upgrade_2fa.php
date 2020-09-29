<?php
	global $Mo2fdbQueries;
	$user = wp_get_current_user();
	$is_NC = get_option( 'mo2f_is_NC' );

	$is_customer_registered = $Mo2fdbQueries->get_user_detail( 'user_registration_with_miniorange', $user->ID ) == 'SUCCESS' ? true : false;

	$mo2f_feature_set = array(
		"Authentication Methods",
		"Language Translation Support",
		"Login with Username + password + 2FA",
		"Login with Username + 2FA (skip password)",
		"Backup Methods",
		"Multi-Site Support",
		"User role based redirection after Login",
		"Add custom Security Questions (KBA)",
		"Customize account name in Google Authenticator app",
		"Brute Force Protection",
		"Blocking IP",
		"Monitoring",
		"Strong Password",
		"File Protection",
		"Enable 2FA for specific User Roles",
		"Enable 2FA for specific Users",
		"Choose specific authentication methods for Users",
		"Force Two Factor for users",
		"One Time Email Verification for Users during 2FA Registration",
		"Enable Security Questions as backup for Users during 2FA registration",
		"App Specific Password to login from mobile Apps",
		"Support"
	);


	$two_factor_methods = array(
		"miniOrange QR Code Authentication",
		"miniOrange Soft Token",
		"miniOrange Push Notification",
		"Google Authenticator",
		"Security Questions",
		"Authy Authenticator",
		"Email Verification",
		"OTP Over SMS",
		"OTP Over Email",
		"OTP Over SMS and Email",
		"Hardware Token"
	);

	$two_factor_methods_EC          = array_slice( $two_factor_methods, 0, 7 );

	$mo2f_feature_set_with_plans_NC = array(
		"Authentication Methods"                                                => array(
			array_slice( $two_factor_methods, 0, 5 ),
			array_slice( $two_factor_methods, 0, 10 ),
			array_slice( $two_factor_methods, 0, 11 ),
			array_slice( $two_factor_methods, 0, 11 )
		),
		

		"Language Translation Support"                                          => array( true, true, true, true ),
		"Login with Username + password + 2FA"                                  => array( true, true, true, true ),
		"Login with Username + 2FA (skip password)"                             => array( false, true, true, true ),
		"Backup Methods"                                                        => array(
			false,
			"KBA",
			array( "KBA", "OTP Over Email", "Backup Codes" ),
			array( "KBA", "OTP Over Email", "Backup Codes" )
		),
		"Multi-Site Support"                                                    => array( false, true, true, true ),
		"User role based redirection after Login"                               => array( false, true, true, true ),
		"Add custom Security Questions (KBA)"                                   => array( false, true, true, true ),
		"Add custom Security Questions (KBA)"                                   => array( false, true, true, true ),
		"Customize account name in Google Authenticator app"                    => array( false, true, true, true ),
		"Brute Force Protection"												=> array( true, false, false, true ),
		"Blocking IP"															=> array( true, false, false, true ),
		"Monitoring"															=> array( true, false, false, true ),
		"Strong Password"														=> array( true, false, false, true ),
		"File Protection"														=> array( true, false, false, true ),
		"Enable 2FA for specific User Roles"                                    => array( false, false, true, true ),
		"Enable 2FA for specific Users"                                         => array( false, false, true, true ),
		"Choose specific authentication methods for Users"                      => array( false, false, true, true ),
		"Force Two Factor for users"                        						=> array( false, false, true, true ),
		"One Time Email Verification for Users during 2FA Registration"         => array( false, false, true, true ),
		"Enable Security Questions as backup for Users during 2FA registration" => array( false, false, true, true ),
		"App Specific Password to login from mobile Apps"                       => array( false, false, true, true ),
		"Support"                                                               => array(
			"Basic Support by Email",
			"Priority Support by Email",
			array( "Priority Support by Email", "Priority Support with GoTo meetings" ),
			array( "Priority Support by Email", "Priority Support with GoTo meetings" )
		),

	);

	$mo2f_feature_set_with_plans_EC = array(
		"Authentication Methods"                                                => array(
			array_slice( $two_factor_methods, 0, 8 ),
			array_slice( $two_factor_methods, 0, 10 ),
			array_slice( $two_factor_methods, 0, 11 ),
			array_slice( $two_factor_methods, 0, 11 )
		),
		
		"Language Translation Support"                                          => array( true, true, true, true ),
		"Login with Username + password + 2FA"                                  => array( true, true, true, true ),
		"Login with Username + 2FA (skip password)"                             => array( true, true, true, true ),
		"Backup Methods"                                                        => array(
			"KBA",
			"KBA",
			array( "KBA", "OTP Over Email", "Backup Codes" ),
			array( "KBA", "OTP Over Email", "Backup Codes" )
		),
		"Multi-Site Support"                                                    => array( false, true, true, true ),
		"Brute Force Protection"												=> array( true, false, false, true ),
		"Blocking IP"															=> array( true, false, false, true ),
		"Monitoring"															=> array( true, false, false, true ),
		"Strong Password"														=> array( true, false, false, true ),
		"File Protection"														=> array( true, false, false, true ),
		"User role based redirection after Login"                               => array( false, true, true, true ),
		"Add custom Security Questions (KBA)"                                   => array( false, true, true, true ),
		"Customize account name in Google Authenticator app"                    => array( false, true, true, true ),
		"Enable 2FA for specific User Roles"                                    => array( false, false, true, true ),
		"Enable 2FA for specific Users"                                         => array( false, false, true, true ),
		"Choose specific authentication methods for Users"                      => array( false, false, true, true ),
		"Force Two Factor for users"                        					=> array( false, false, true, true ),
		"One Time Email Verification for Users during 2FA Registration"         => array( false, false, true, true ),
		"Enable Security Questions as backup for Users during 2FA registration" => array( false, false, true, true ),
		"App Specific Password to login from mobile Apps"                       => array( false, false, true, true ),
		"Support"                                                               => array(
			"Basic Support by Email",
			"Priority Support by Email",
			array( "Priority Support by Email", "Priority Support with GoTo meetings" ),
			array( "Priority Support by Email", "Priority Support with GoTo meetings" )
		),

	);

	$mo2f_addons           = array(
		"RBA & Trusted Devices Management Add-on",
		"Personalization Add-on",
		"Short Codes Add-on"
	);
	$mo2f_addons_plan_name = array(
		"RBA & Trusted Devices Management Add-on" => "wp_2fa_addon_rba",
		"Personalization Add-on"                  => "wp_2fa_addon_personalization",
		"Short Codes Add-on"                      => "wp_2fa_addon_shortcode"
	);


	$mo2f_addons_with_features = array(
		"Personalization Add-on"                  => array(
			"Custom UI of 2FA popups",
			"Custom Email and SMS Templates",
			"Customize 'powered by' Logo",
			"Customize Plugin Icon",
			"Customize Plugin Name",
			
		),
		"RBA & Trusted Devices Management Add-on" => array(
			"Remember Device",
			"Set Device Limit for the users to login",
		 "IP Restriction: Limit users to login from specific IPs"
		),
		"Short Codes Add-on"                      => array(
			"Option to turn on/off 2-factor by user",
			"Option to configure the Google Authenticator and Security Questions by user",
			"Option to 'Enable Remember Device' from a custom login form",
			"On-Demand ShortCodes for specific fuctionalities ( like for enabling 2FA for specific pages)"
		)
	);
	?>
    <div class="mo2f_licensing_plans" style="border:0px;">
	
        <table class="table mo_table-bordered mo_table-striped">
            <thead>
            <tr>
            	<th style="background-color: #20b2aa;border: 2px solid #20b2aa;width: 21%;"><h1 style="color: white;">Features</h1></th>
            	<th style="background-color: #20b2aa;border: 2px solid #20b2aa;"><h1 style="color: white;">Free</h1></th>
            	<th style="background-color: #20b2aa;border: 2px solid #20b2aa;"><h1 style="color: white;">Standard</h1></th>
            	<th style="background-color: #20b2aa;border: 2px solid #20b2aa;"><h1 style="color: white;">Premium</h1></th>
            	<th style="background-color: #20b2aa;border: 2px solid #20b2aa;"><h1 style="color: white;">Enterprise</h1></th>
            </tr>
            
            
            </thead>
            <tbody class="mo_align-center mo-fa-icon">
			<?php for ( $i = 0; $i < count( $mo2f_feature_set ); $i ++ ) { ?>
                <tr>
                    <td><?php
						$feature_set = $mo2f_feature_set[ $i ];

						echo $feature_set;
						?>
					</td>
					<?php if ( $is_NC ) {
						$f_feature_set_with_plan = $mo2f_feature_set_with_plans_NC[ $feature_set ];
					} else {
						$f_feature_set_with_plan = $mo2f_feature_set_with_plans_EC[ $feature_set ];
					}
					?>
                    <td><?php
						if ( is_array( $f_feature_set_with_plan[0] ) ) {
							echo mo2f_create_li( $f_feature_set_with_plan[0] );
						} else {
							if ( gettype( $f_feature_set_with_plan[0] ) == "boolean" ) {
								echo mo2f_get_binary_equivalent( $f_feature_set_with_plan[0] );
							} else {
								echo $f_feature_set_with_plan[0];
							}
						} ?>
                    </td>
                    <td><?php
						if ( is_array( $f_feature_set_with_plan[1] ) ) {
							echo mo2f_create_li( $f_feature_set_with_plan[1] );
						} else {
							if ( gettype( $f_feature_set_with_plan[1] ) == "boolean" ) {
								echo mo2f_get_binary_equivalent( $f_feature_set_with_plan[1] );
							} else {
								echo $f_feature_set_with_plan[1];
							}
						} ?>
                    </td>
                    <td><?php
						if ( is_array( $f_feature_set_with_plan[2] ) ) {
							echo mo2f_create_li( $f_feature_set_with_plan[2] );
						} else {
							if ( gettype( $f_feature_set_with_plan[2] ) == "boolean" ) {
								echo mo2f_get_binary_equivalent( $f_feature_set_with_plan[2] );
							} else {
								echo $f_feature_set_with_plan[2];
							}
						} ?>
                    </td>
					<td><?php
						if ( is_array( $f_feature_set_with_plan[3] ) ) {
							echo mo2f_create_li( $f_feature_set_with_plan[3] );
						} else {
							if ( gettype( $f_feature_set_with_plan[3] ) == "boolean" ) {
								echo mo2f_get_binary_equivalent( $f_feature_set_with_plan[3] );
							} else {
								echo $f_feature_set_with_plan[3];
							}
						} ?>
                    </td>
                </tr>
			<?php } ?>

            <tr>
                <td><b>Add-Ons</b></td>
				<?php if ( $is_NC ) { ?>
                    <td><b>Purchase Separately</b></td>
				<?php } else { ?>
                    <td><b>NA</b></td>
				<?php } ?>
                <td><b>Purchase Separately</b></td>
                <td><b>Included</b></td>
                <td><b>Included</b></td>
            </tr>
			<?php for ( $i = 0; $i < count( $mo2f_addons ); $i ++ ) { ?>
                <tr>
                    <td><?php echo $mo2f_addons[ $i ]; ?> <?php for ( $j = 0; $j < $i + 1; $j ++ ) { ?>*<?php } ?>
                    </td>
					<?php if ( $is_NC ) { ?>
                        <td>
                            <button class="mo_wpns_button mo_wpns_button1" style="cursor:pointer"
                                    onclick="mo2f_upgradeform('<?php echo $mo2f_addons_plan_name[ $mo2f_addons[ $i ] ]; ?>')" <?php echo $is_customer_registered ? "" : " disabled " ?> >
                                Purchase
                            </button>
                            
                        </td>
					<?php } else { ?>
                        <td><b>NA</b></td>
					<?php } ?>
                    <td>
                        <button class="mo_wpns_button mo_wpns_button1" style="cursor:pointer"
                                onclick="mo2f_upgradeform('<?php echo $mo2f_addons_plan_name[ $mo2f_addons[ $i ] ]; ?>')" <?php echo $is_customer_registered ? "" : " disabled " ?> >
                            Purchase
                        </button>
                    </td>
                    <td><div style="color:#20b2aa;font-size: large;">✔</div></td>
                    <td><div style="color:#20b2aa;font-size: large;">✔</div></td>
                </tr>
			<?php } ?>

            </tbody>
        </table>
        <br>
        <div style="padding:10px;">
			<?php for ( $i = 0; $i < count( $mo2f_addons ); $i ++ ) {
				$f_feature_set_of_addons = $mo2f_addons_with_features[ $mo2f_addons[ $i ] ];
				for ( $j = 0; $j < $i + 1; $j ++ ) { ?>*<?php } ?>
                <b><?php echo $mo2f_addons[ $i ]; ?> Features</b>
                <br>
                <ol>
					<?php for ( $k = 0; $k < count( $f_feature_set_of_addons ); $k ++ ) { ?>
                        <li><?php echo $f_feature_set_of_addons[ $k ]; ?></li>
					<?php } ?>
                </ol>

                <hr><br>
			<?php } ?>
            <b>**** SMS Charges</b>
            <p><?php echo mo2f_lt( 'If you wish to choose OTP Over SMS / OTP Over SMS and Email as your authentication method,
                    SMS transaction prices & SMS delivery charges apply and they depend on country. SMS validity is for lifetime.' ); ?></p>
            <hr>
            <br>
            <div>
                <h2>Note</h2>
                <ol class="mo2f_licensing_plans_ol">
                    <li><?php echo mo2f_lt( 'The plugin works with many of the default custom login forms (like Woocommerce / Theme My Login), however if you face any issues with your custom login form, contact us and we will help you with it.' ); ?></li>
                </ol>
            </div>

            <br>
            <hr>
            
           

            <style>#mo2f_support_table {
                    display: none;
                }

            </style>
        </div>
    </div>

<?php 
function mo2f_create_li( $mo2f_array ) {
	$html_ol = '<ul>';
	foreach ( $mo2f_array as $element ) {
		$html_ol .= "<li>" . $element . "</li>";
	}
	$html_ol .= '</ul>';

	return $html_ol;
}


function mo2f_get_binary_equivalent( $mo2f_var ) {

	switch ( $mo2f_var ) {
		case 1:
			return "<div style='color:#20b2aa;font-size: large;'>✔</div>";
		case 0:
			return "<div style='color:red;font-size: large;'>×</div>";
		default:
			return $mo2f_var;
	}
	}
