<?php
	global $Mo2fdbQueries;
	$user = wp_get_current_user();
	$is_NC = get_option( 'mo2f_is_NC' );
	$is_customer_registered = $Mo2fdbQueries->get_user_detail( 'user_registration_with_miniorange', $user->ID ) == 'SUCCESS' ? true : false;

if ($_GET['page'] == 'mo_2fa_upgrade') {
	?><br><br><?php
}
?>
	
	<div class="mo_wpns_upgrade_page_2fa_ns">
		<div style="float: left;">
		<?php
		if (!get_option('mo_wpns_2fa_with_network_security') && ($_GET['page'] == 'mo_2fa_upgrade')) {
			echo '<a class="mo_wpns_button mo_wpns_button1" href="'.$two_fa.'">Back</a>';
		 } 
		 ?>
		</div>
		<h1 class="mo_wpns_upgrade_page_2fa_ns_1"> 2 Factor Authentication</h1> <span></span>
	</div>
	<div class="mo_wpns_upgrade_title11">
		<div class="mo_wpns_upgrade_page_title_name">
			<h1 class="mo_wpns_upgrade_page_2fa_plan_name">Free</h1>	
			<hr class="mo_wpns_upgrade_page_hr">
		</div>
		<center>
				<h4>No. of User:- 3 <br>
					Basic security features<br>
					Five Authenticaton Methods<br>
					Login with Username + password + 2FA<br><br>
				</h4>
		</center>
		<div class="mo_wpns_upgrade_page_2fa_background"><br><br><br><br><br><br><br><br><br>
			<h1 style="text-align: center;color: white;">Current Plan</h1>
		</div>
		    <div>
		    	<a class="mo_wpns_upgrade_page_show_feature_arrow" id="mo2fa_show_free_features" onclick="mo2fa_show_detail_features()">
				<span class="mo_wpns_upgrade_page_arrow_size">⮟</span></a>  
				<a class="mo_wpns_upgrade_page_hide_feature_arrow" id="mo2fa_hide_free_features" onclick="mo2fa_hide_detail_features()">
				<span class="mo_wpns_upgrade_page_arrow_size">⮝</span></a>   
			</div>     
		
		
	</div>

	<div class="mo_wpns_upgrade_page_space_in_div"></div>

	<div class="mo_wpns_upgrade_title11"  >
		<div class="mo_wpns_upgrade_page_title_name">
			<h1 class="mo_wpns_upgrade_page_2fa_plan_name">Standard</h1>
			<hr class="mo_wpns_upgrade_page_hr">
		</div>
		<center>
		<h4> Multi-Site Support<br>
		     Backup Methods [ KBA ]<br>
			 Prevent Account Sharing<br>
		     Additional Authentication Methods<br> 
		     User role based redirection after Login<br>	
		</h4>
		</center>
		<div class="mo_wpns_upgrade_page_2fa_background">
			
			<center>
				<br>
			<h4 class="mo_wpns_upgrade_page_starting_price">Starting From</h4>
			<h1 class="mo_wpns_upgrade_pade_pricing">$5</h1>
			
				<?php echo mo2f_yearly_standard_pricing_plan(); ?>
				<?php echo mo2f_sms_cost1();?>
			</center>
			
		<br>
		<div style="text-align: center;">
		<?php if( $is_customer_registered) {
				?>
                <button class="mo_wpns_button mo_wpns_button1 mo_wpns_upgrade_page_button" onclick="mo2f_upgradeform1('wp_2fa_basic_plan')" >Upgrade</button>
        <?php }else{ 
        		?>
				<button class="mo_wpns_button mo_wpns_button1 mo_wpns_upgrade_page_button" id="std_upgrade_onprem" onclick="mo2f_registration_before_upgrade('wp_2fa_basic_plan')">Upgrade</button>
			<?php } ?>
                        <div id="mo_upgrade_plan_cloud" style="display: hidden;" disabled>
                        	<?php 
                        			if (get_option('mo_wpns_upgrade_onprem')) 
                        			{
                        				$user   = wp_get_current_user();
                        				if( $is_customer_registered)
                        				{
                        				?>
                        					<script type="text/javascript">
                        					var plantype		= "<?php echo get_option('mo_wpns_plantype');?>";
                        							var data =  {
														'action'				  : 'wpns_login_security',
														'wpns_loginsecurity_ajax' : 'wpns_upgrade_idp', 
														};
												jQuery.post(ajaxurl, data, function(response) {
													mo2f_upgradeform1(plantype);
												});
                        						</script>
                        				<?php
                        			}
                        				else
							    		display_customer_registration_forms( $user); 
                        			}
                        	?>
                        </div>
		
		</div>
		</div>
		<div>
			<a class="mo_wpns_upgrade_page_show_feature_arrow" id="mo2fa_show_standard_features" onclick="mo2fa_show_detail_features()"><span class="mo_wpns_upgrade_page_arrow_size">⮟</span></a>  
			<a class="mo_wpns_upgrade_page_hide_feature_arrow" id="mo2fa_hide_standard_features" onclick="mo2fa_hide_detail_features()"><span class="mo_wpns_upgrade_page_arrow_size">⮝</span></a> 
		
		</div>
	</div>
	<div class="mo_wpns_upgrade_page_space_in_div"></div>
	<div class="mo_wpns_upgrade_title11"  >
		<div class="mo_wpns_upgrade_page_title_name">
			<h1 class="mo_wpns_upgrade_page_2fa_plan_name">Premium</h1>
			<hr class="mo_wpns_upgrade_page_hr">	
		</div>
		<center>
			<h4>Multi-Site Support<br>
				Additional 2FA methods<br>
				Prevent Account Sharing<br>
				Force Two Factor for users<br>
				Enable 2FA for specific User Roles
				
			</h4>
		</center>
		<div class="mo_wpns_upgrade_page_2fa_background">
			<center><br>
				<h4 class="mo_wpns_upgrade_page_starting_price">Starting From</h4>
				<h1 class="mo_wpns_upgrade_pade_pricing">$30</h1>
				
					<?php echo mo2f_yearly_premium_pricing_plan(); ?>
					<?php echo mo2f_sms_cost1();?>
			</center>
			<br>
			<div style="text-align: center;">
			<?php if( $is_customer_registered) {
						?>
                        <button class="mo_wpns_button mo_wpns_button1 mo_wpns_upgrade_page_button"onclick="mo2f_upgradeform1('wp_2fa_premium_plan')" >Upgrade</button>
		                <?php 
		            }else{ ?>
						<button class="mo_wpns_button mo_wpns_button1 mo_wpns_upgrade_page_button"onclick="mo2f_registration_before_upgrade('wp_2fa_premium_plan')" >Upgrade</button>
		                <?php } ?>
		
		
		    </div> 
		    </div> 
		    <div>
		       <a class="mo_wpns_upgrade_page_show_feature_arrow" id="mo2fa_show_premium_features" onclick="mo2fa_show_detail_features()"><span class="mo_wpns_upgrade_page_arrow_size">⮟</span></a>  
		       <a class="mo_wpns_upgrade_page_hide_feature_arrow" id="mo2fa_hide_premium_features" onclick="mo2fa_hide_detail_features()"><span class="mo_wpns_upgrade_page_arrow_size">⮝</span></a>
		          
		</div>
	</div>
	<div class="mo_wpns_upgrade_page_space_in_div"></div>
	<div class="mo_wpns_upgrade_title11"  >

			<div class="mo_wpns_upgrade_page_title_name">
				<h1 class="mo_wpns_upgrade_page_2fa_plan_name">
				Enterprise</h1>
				<hr class="mo_wpns_upgrade_page_hr">
			</div>
			<center>
				<h4>
					Security Features<br>
					Multi-Site Support<br>
					Additional 2FA methods<br>
					Prevent Account Sharing<br>
					Login and File Protection, Strong Passwords<br>				
				</h4>
			</center>
			<div class="mo_wpns_upgrade_page_2fa_background">
			<center>
			<br>
			<h4 class="mo_wpns_upgrade_page_starting_price">Starting From</h4>
			<h1 class="mo_wpns_upgrade_pade_pricing">$59</h1>
				<?php echo mo2f_yearly_all_inclusive_pricing_plan(); ?>
				<?php echo mo2f_sms_cost1();?>
			</center>
			
			<br>
			<div style="text-align: center;">
	<?php	if( $is_customer_registered) {
						?>
                         <button class="mo_wpns_button mo_wpns_button1 mo_wpns_upgrade_page_button" onclick="mo2f_upgradeform1('wp_2fa_enterprise_plan')" >Upgrade</button>
		                <?php 
		            }else
		            { ?>
						<button class="mo_wpns_button mo_wpns_button1 mo_wpns_upgrade_page_button" onclick="mo2f_registration_before_upgrade('wp_2fa_enterprise_plan')" >Upgrade</button>
		                <?php } ?>
		    </div>
		    </div>
		    <div>
			<a class="mo_wpns_upgrade_page_show_feature_arrow" id="mo2fa_show_enterprise_features" onclick="mo2fa_show_detail_features()"><span class="mo_wpns_upgrade_page_arrow_size">⮟</span></a>  
			<a class="mo_wpns_upgrade_page_hide_feature_arrow" id="mo2fa_hide_enterprise_features" onclick="mo2fa_hide_detail_features()"><span class="mo_wpns_upgrade_page_arrow_size">⮝</span></a>
			
			</div>
	</div>
	<div class="mo_wpns_upgrade_page_space_in_div"></div>
	<div style="width: 96%; min-height: 60px;background-color: white;float: left;border-bottom: 2px solid #2ba29b; text-align: center;">
		<br>
		<a id= "mo2f_show_features" class="mo_wpns_upgrade_page_show_feature" onclick="mo2fa_show_detail_features()"><span style="font-size: 63%;"><u>Show more Features</u></span></a>
		<a id= "mo2f_hide_features" class="mo_wpns_upgrade_page_hide_feature" onclick="mo2fa_hide_detail_features()"><span style="font-size: 63%;"><u>Hide Features</u></span></a>
		<br>
	</div>
	<br><br>
			<form class="mo2f_display_none_forms" id="mo2fa_loginform"
                  action="<?php echo MO_HOST_NAME . '/moas/login'; ?>"
                  target="_blank" method="post">
                <input type="email" name="username" value="<?php echo get_option( 'mo2f_email' ); ?>"/>
                <input type="text" name="redirectUrl"
                       value="<?php echo MO_HOST_NAME . '/moas/initializepayment'; ?>"/>
                <input type="text" name="requestOrigin" id="requestOrigin"/>
            </form>

            <form class="mo2f_display_none_forms" id="mo2fa_register_to_upgrade_form"
                   method="post">
                <input type="hidden" name="requestOrigin" />
                <input type="hidden" name="mo2fa_register_to_upgrade_nonce"
                       value="<?php echo wp_create_nonce( 'miniorange-2-factor-user-reg-to-upgrade-nonce' ); ?>"/>
            </form>
	

	<div id="mo2f_features_id" style="display: none; float: left;width: 96.6%;">
		<?php 
		include $mo2f_dirName . 'views'.DIRECTORY_SEPARATOR.'upgrade_2fa.php';?>
	</div> 
	

<?php ?>
	<div style="float: left;min-height: 40px;width: 96.2%;">
	</div>
	<div class="mo_wpns_upgrade_page_2fa_ns"><h1 class="mo_wpns_upgrade_page_2fa_ns_1"> Website Security Plans</h1></div>
	<div class="mo_wpns_upgrade_title11"  >
		<div class="mo_wpns_upgrade_page_title_name">
			<h1 style="margin-top: 0%;padding: 10% 0% 0% 0%; color: white;font-size: 250%;">
		WAF</h1><hr class="mo_wpns_upgrade_page_hr"></div>
		<div><center><b>
		<ul>
			<li>Realtime IP Blocking</li>
			<li>Live Traffic and Audit</li>
			<li>IP Blocking and Whitelisting</li>
			<li>OWASP TOP 10 Firewall Rules</li>
			<li>Standard Rate Limiting/ DOS Protection</li>
			<li><a onclick="wpns_pricing()">Know more</a></li>
		</ul>
		</b></center></div>
	<div class="mo_wpns_upgrade_page_ns_background">
			<br>
			<center>
			<h4 class="mo_wpns_upgrade_page_starting_price">Starting From</h4>
			<h1 class="mo_wpns_upgrade_pade_pricing">$50</h1>
			
				<?php echo mo2f_waf_yearly_standard_pricing(); ?>
				
			</center>
	
	<div style="text-align: center;">
	<?php	if( $is_customer_registered) {
						?>
                            <button
                                        class="mo_wpns_button mo_wpns_button1 mo_wpns_upgrade_page_button"
                                        onclick="mo2f_upgradeform1('wp_security_waf_plan')" >Upgrade</button>
		                <?php }else{ ?>
							<button
                                        class="mo_wpns_button mo_wpns_button1 mo_wpns_upgrade_page_button"
                                        onclick="mo2f_registration_before_upgrade('wp_security_waf_plan')" >Upgrade</button>
		                <?php } ?>
	</div></div>
	</div>
	<div class="mo_wpns_upgrade_page_space_in_div"></div>
	<div class="mo_wpns_upgrade_title11"  >
		<div class="mo_wpns_upgrade_page_title_name">
			<h1 style="margin-top: 0%;padding: 10% 0% 0% 0%; color: white;font-size: 250%;">
		Login and Spam</h1><hr class="mo_wpns_upgrade_page_hr"></div>
		<div><center><b>
		<ul>
			<li>Limit login Attempts</li>
			<li>CAPTCHA on login</li>
			<li>Blocking time period</li>
			<li>Enforce Strong Password</li>
			<li>SPAM Content and Comment Protection</li>
			<li><a onclick="wpns_pricing()">Know more</a></li>
		</ul>
		</b></center></div>
		<div class="mo_wpns_upgrade_page_ns_background">
			<br>
			<center>
			<h4 class="mo_wpns_upgrade_page_starting_price">Starting From</h4>
			<h1 class="mo_wpns_upgrade_pade_pricing">$15</h1>
			
				<?php echo mo2f_login_yearly_standard_pricing(); ?>
				
			</center>
			
		<div style="text-align: center;">
		<?php if( $is_customer_registered) {
						?>
                            <button class="mo_wpns_button mo_wpns_button1 mo_wpns_upgrade_page_button" 
                                        onclick="mo2f_upgradeform1('wp_security_login_and_spam_plan')" >Upgrade</button>
                        <?php }else{ ?>

                           <button class="mo_wpns_button mo_wpns_button1 mo_wpns_upgrade_page_button"
                                    onclick="mo2f_registration_before_upgrade('wp_security_login_and_spam_plan')" >Upgrade</button>
                        <?php } ?>
		</div>
		</div>
		
		
	</div>
	<div class="mo_wpns_upgrade_page_space_in_div"></div>
	<div class="mo_wpns_upgrade_title11"  >
		<div class="mo_wpns_upgrade_page_title_name">
			<h1 style="margin-top: 0%;padding: 10% 0% 0% 0%; color: white;font-size: 250%;">
		Malware Scanner</h1><hr class="mo_wpns_upgrade_page_hr"></div>
		<div><center><b>
		<ul>
			<li>Malware Detection</li>
			<li>Blacklisted Domains</li>
			<li>Action On Malicious Files</li>
			<li>Repository Version Comparison</li>
			<li>Detect any changes in the files</li>
			<li><a onclick="wpns_pricing()">Know more</a></li>
		</ul>
		</b></center></div>
			<div class="mo_wpns_upgrade_page_ns_background">
			<center>
			<br>
			<h4 class="mo_wpns_upgrade_page_starting_price">Starting From</h4>
			<h1 class="mo_wpns_upgrade_pade_pricing">$15</h1>
			
				<?php echo mo2f_scanner_yearly_standard_pricing(); ?>
				
			</center>
			<div style="text-align: center;">
			<?php if( $is_customer_registered) {
						?>
                            <button
                                        class="mo_wpns_button mo_wpns_button1 mo_wpns_upgrade_page_button"
                                        onclick="mo2f_upgradeform1('wp_security_malware_plan')" >Upgrade</button>
		                <?php }else{ ?>

                           <button
                                        class="mo_wpns_button mo_wpns_button1 mo_wpns_upgrade_page_button"
                                        onclick="mo2f_registration_before_upgrade('wp_security_malware_plan')" >Upgrade</button>
		                <?php } ?>
		</div>
	</div>
	</div>
	<div class="mo_wpns_upgrade_page_space_in_div"></div>
	<div class="mo_wpns_upgrade_title11"  >
		<div class="mo_wpns_upgrade_page_title_name">
			<h1 style="margin-top: 0%;padding: 10% 0% 0% 0%; color: white;font-size: 250%;">
		Encrypted Backup</h1><hr class="mo_wpns_upgrade_page_hr"></div>
		<div><center><b>
		<ul>
			<li>Schedule Backup</li>
			<li>Encrypted Backup</li>
			<li>Files/Database Backup</li>
			<li>Restore and Migration</li>
			<li>Password Protected Zip files</li>
			<li><a onclick="wpns_pricing()">Know more</a></li>
		</ul>
		</b></center></div>
	<div class="mo_wpns_upgrade_page_ns_background">

		<center>
			<br>
			<h4 class="mo_wpns_upgrade_page_starting_price">Starting From</h4>
			<h1 class="mo_wpns_upgrade_pade_pricing">$30</h1>
			
				<?php echo mo2f_backup_yearly_standard_pricing(); ?>
				
			</center>
			<div style="text-align: center;">
	<?php	if( $is_customer_registered) {
						?>
                            <button
                                        class="mo_wpns_button mo_wpns_button1 mo_wpns_upgrade_page_button"
                                        onclick="mo2f_upgradeform1('wp_security_backup_plan')" >Upgrade</button>
		                <?php }else{ ?>
							<button
                                        class="mo_wpns_button mo_wpns_button1 mo_wpns_upgrade_page_button"
                                        onclick="mo2f_registration_before_upgrade('wp_security_backup_plan')" >Upgrade</button>
		                <?php } ?>
		
	</div></div></div>
	
	<div style="float: left; background-color: white; min-height: 100px;width: 91.9%;margin-top: 4%;height: auto;padding: 2%; border: 2px solid #20b2aa;">
		<div>
                <h2>Steps to upgrade to the Premium Plan</h2>
                <ol class="mo2f_licensing_plans_ol">
                    <li><?php echo mo2f_lt( 'Click on \'Upgrade\' button of your preferred plan above.' ); ?></li>
                    <li><?php echo mo2f_lt( ' You will be redirected to the miniOrange Console. Enter your miniOrange username and password, after which you will be redirected to the payment page.' ); ?></li>

                    <li><?php echo mo2f_lt( 'Select the number of users you wish to upgrade for, and any add-ons if you wish to purchase, and make the payment.' ); ?></li>
                    <li><?php echo mo2f_lt( 'After making the payment, you can find the Standard/Premium plugin to download from the \'License\' tab in the left navigation bar of the miniOrange Console.' ); ?></li>
                    <li><?php echo mo2f_lt( 'Download the premium plugin from the miniOrange Console.' ); ?></li>
                    <li><?php echo mo2f_lt( 'In the Wordpress dashboard, uninstall the free plugin and install the premium plugin downloaded.' ); ?></li>
                    <li><?php echo mo2f_lt( 'Login to the premium plugin with the miniOrange account you used to make the payment, after this your users will be able to set up 2FA.' ); ?></li>
                </ol>
            </div>
            <div>
                <h2>Note</h2>
                <ul class="mo2f_licensing_plans_ol">
                    <li><?php echo mo2f_lt( 'There is no license key required to activate the Standard/Premium Plugins. You will have to just login with the miniOrange Account you used to make the purchase.' ); ?></li>
                </ul>
            </div>

            <br>
            <hr>
            <br>
            <div>
                <h2>Refund Policy</h2>
                <p class="mo2f_licensing_plans_ol"><?php echo mo2f_lt( 'At miniOrange, we want to ensure you are 100% happy with your purchase. If the premium plugin you purchased is not working as advertised and you\'ve attempted to resolve any issues with our support team, which couldn\'t get resolved then we will refund the whole amount within 10 days of the purchase.' ); ?>
                </p>
            </div>
            <br>
            <hr>
            <br>
            <div>
                <h2>Privacy Policy</h2>
                <p class="mo2f_licensing_plans_ol"><a
                            href="https://www.miniorange.com/2-factor-authentication-for-wordpress-gdpr">Click Here</a>
                    to read our Privacy Policy.
                </p>
            </div>
            <br>
            <hr>
            <br>
            <div>
                <h2>Contact Us</h2>
                <p class="mo2f_licensing_plans_ol"><?php echo mo2f_lt( 'If you have any doubts regarding the licensing plans, you can mail us at' ); ?>
                    <a href="mailto:info@xecurify.com"><i>info@xecurify.com</i></a> <?php echo mo2f_lt( 'or submit a query using the support form.' ); ?>
                </p>
            </div>
	</div>
<?php 
function mo2f_sms_cost1() {
	?>
    <p class="mo2f_pricing_text mo_wpns_upgrade_page_starting_price" id="mo2f_sms_cost1"
       title="<?php echo mo2f_lt( '(Only applicable if OTP over SMS is your preferred authentication method.)' ); ?>"><?php echo mo2f_lt( 'SMS + OTP Cost' ); ?>
        <b style="color: black;">[optional]</b><br/>
        <select id="mo2f_sms" class="form-control" style="border-radius:5px;width:200px;">
            <option><?php echo mo2f_lt( '$5 per 100 OTP + SMS delivery charges' ); ?></option>
            <option><?php echo mo2f_lt( '$15 per 500 OTP + SMS delivery charges' ); ?></option>
            <option><?php echo mo2f_lt( '$22 per 1k OTP + SMS delivery charges' ); ?></option>
            <option><?php echo mo2f_lt( '$30 per 5k OTP + SMS delivery charges' ); ?></option>
            <option><?php echo mo2f_lt( '$40 per 10k OTP + SMS delivery charges' ); ?></option>
            <option><?php echo mo2f_lt( '$90 per 50k OTP + SMS delivery charges' ); ?></option>
        </select>
    </p>
	<?php
}
function mo2f_yearly_standard_pricing_plan() {
	?>
    <p class="mo2f_pricing_text mo_wpns_upgrade_page_starting_price"
       id="mo2f_yearly_sub"><?php echo __( 'Yearly Subscription Fees', 'miniorange-2-factor-authentication' ); ?><br>

        <select id="mo2f_yearly" class="form-control" style="border-radius:5px;width:200px;">
            <option> <?php echo mo2f_lt( '1 - 2 users - $5 per year' ); ?> </option>
            <option> <?php echo mo2f_lt( '3 - 5 users - $20 per year' ); ?> </option>
            <option> <?php echo mo2f_lt( '6 - 50 users - $30 per year' ); ?> </option>
            <option> <?php echo mo2f_lt( '51 - 100 users - $49 per year' ); ?> </option>
            <option> <?php echo mo2f_lt( '101 - 500 users - $99 per year' ); ?> </option>
            <option> <?php echo mo2f_lt( '501 - 1000 users - $199 per year' ); ?> </option>
            <option> <?php echo mo2f_lt( '1001 - 5000 users - $299 per year' ); ?> </option>
            <option> <?php echo mo2f_lt( '5001 -  10000 users - $499 per year' ); ?></option>
            <option> <?php echo mo2f_lt( '10001 - 20000 users - $799 per year' ); ?> </option>
            
        </select>
    </p>
	<?php
}
function mo2f_yearly_premium_pricing_plan() {
	?>
    <p class="mo2f_pricing_text mo_wpns_upgrade_page_starting_price"
       id="mo2f_yearly_sub"><?php echo __( 'Yearly Subscription Fees', 'miniorange-2-factor-authentication' ); ?><br>

        <select id="mo2f_yearly" class="form-control" style="border-radius:5px;width:200px;">
           <option> <?php echo mo2f_lt( '1 - 5 users - $30 per year' ); ?> </option>
            <option> <?php echo mo2f_lt( '6 - 50 users - $99 per year' ); ?> </option>
            <option> <?php echo mo2f_lt( '51 - 100 users - $199 per year' ); ?> </option>
            <option> <?php echo mo2f_lt( '101 - 500 users - $349 per year' ); ?> </option>
            <option> <?php echo mo2f_lt( '501 - 1000 users - $499 per year' ); ?> </option>
            <option> <?php echo mo2f_lt( '1001 - 5000 users - $799 per year' ); ?> </option>
            <option> <?php echo mo2f_lt( '5001 -  10000 users - $999 per year ' ); ?></option>
            <option> <?php echo mo2f_lt( '10001 - 20000 users - $1449 per year' ); ?> </option>
            
        </select>
    </p>
	<?php
}
function mo2f_yearly_all_inclusive_pricing_plan() {
	?>
    <p class="mo2f_pricing_text mo_wpns_upgrade_page_starting_price"
       id="mo2f_yearly_sub"><?php echo __( 'Yearly Subscription Fees', 'miniorange-2-factor-authentication' ); ?><br>

        <select id="mo2f_yearly" class="form-control" style="border-radius:5px;width:200px;">
           <option> <?php echo mo2f_lt( '1 - 5 users - $59 per year' ); ?> </option>
            <option> <?php echo mo2f_lt( '6 - 50 users - $128 per year' ); ?> </option>
            <option> <?php echo mo2f_lt( '51 - 100 users - $228 per year' ); ?> </option>
            <option> <?php echo mo2f_lt( '101 - 500 users - $378 per year' ); ?> </option>
            <option> <?php echo mo2f_lt( '501 - 1000 users - $528 per year' ); ?> </option>
            <option> <?php echo mo2f_lt( '1001 - 5000 users - $828 per year' ); ?> </option>
            <option> <?php echo mo2f_lt( '5001 -  10000 users - $1028 per year ' ); ?></option>
            <option> <?php echo mo2f_lt( '10001 - 20000 users - $1478 per year' ); ?> </option>
            
        </select>
    </p>
	<?php
}
function mo2f_yearly_standard_pricing1() {
	?>
    <p class="mo2f_pricing_text mo_wpns_upgrade_page_starting_price"
       id="mo2f_yearly_sub"><?php echo __( 'Yearly Subscription Fees', 'miniorange-2-factor-authentication' ); ?><br>

        <select id="mo2f_yearly" class="form-control" style="border-radius:5px;width:200px;">
            <option> <?php echo mo2f_lt( '1 site - $15 per year' ); ?> </option>
            <option> <?php echo mo2f_lt( '5 sites - $35 per year' ); ?> </option>
            <option> <?php echo mo2f_lt( '10 sites - $60 per year' ); ?> </option>
            
        </select>
    </p>
	<?php
}
function mo2f_waf_yearly_standard_pricing() {
	?>
    <p class="mo2f_pricing_text mo_wpns_upgrade_page_starting_price"
       id="mo2f_yearly_sub"><?php echo __( 'Yearly Subscription Fees', 'miniorange-2-factor-authentication' ); ?><br>

        <select id="mo2f_yearly" class="form-control" style="border-radius:5px;width:200px;">
            <option> <?php echo mo2f_lt( '1 site - $50 per year' ); ?> </option>
            <option> <?php echo mo2f_lt( '5 sites - $100 per year' ); ?> </option>
            <option> <?php echo mo2f_lt( '10 sites - $150 per year' ); ?> </option>
            
        </select>
    </p>
	<?php
}
function mo2f_login_yearly_standard_pricing() {
	?>
    <p class="mo2f_pricing_text mo_wpns_upgrade_page_starting_price"
       id="mo2f_yearly_sub"><?php echo __( 'Yearly Subscription Fees', 'miniorange-2-factor-authentication' ); ?><br>

        <select id="mo2f_yearly" class="form-control" style="border-radius:5px;width:200px;">
            <option> <?php echo mo2f_lt( '1 site - $15 per year' ); ?> </option>
            <option> <?php echo mo2f_lt( '5 sites - $35 per year' ); ?> </option>
            <option> <?php echo mo2f_lt( '10 sites - $60 per year' ); ?> </option>
            
        </select>
    </p>
	<?php
}
function mo2f_backup_yearly_standard_pricing() {
	?>
    <p class="mo2f_pricing_text mo_wpns_upgrade_page_starting_price"
       id="mo2f_yearly_sub"><?php echo __( 'Yearly Subscription Fees', 'miniorange-2-factor-authentication' ); ?><br>

        <select id="mo2f_yearly" class="form-control" style="border-radius:5px;width:200px;">
            <option> <?php echo mo2f_lt( '1 site - $30 per year' ); ?> </option>
            <option> <?php echo mo2f_lt( '5 sites - $50 per year' ); ?> </option>
            <option> <?php echo mo2f_lt( '10 sites - $70 per year' ); ?> </option>
            
        </select>
    </p>
	<?php
}
function mo2f_scanner_yearly_standard_pricing() {
	?>
    <p class="mo2f_pricing_text mo_wpns_upgrade_page_starting_price" 
       id="mo2f_yearly_sub"><?php echo __( 'Yearly Subscription Fees', 'miniorange-2-factor-authentication' ); ?><br>

        <select id="mo2f_yearly" class="form-control" style="border-radius:5px;width:200px;">
            <option> <?php echo mo2f_lt( '1 site - $15 per year' ); ?> </option>
            <option> <?php echo mo2f_lt( '5 sites - $35 per year' ); ?> </option>
            <option> <?php echo mo2f_lt( '10 sites - $60 per year' ); ?> </option>
            
        </select>
    </p>
	<?php
}
?>

<script type="text/javascript">

function wpns_pricing()
{
	window.open("https://security.miniorange.com/pricing/");
}
</script>

	<script type="text/javascript">
		var $='jQuery';		
			    	
			    	function mo2fa_show_detail_features()
			    	{
			    		// jQuery("#mo2f_features_id").slideToggle();
			    		jQuery("#mo2f_features_id").show(1500);

			    		document.getElementById('mo2fa_show_enterprise_features').scrollIntoView();

			    		document.getElementById("mo2f_show_features").style.display = "none";
			    		document.getElementById("mo2f_hide_features").style.display = "block";

			    		document.getElementById("mo2fa_show_free_features").style.display = "none";
			    		document.getElementById("mo2fa_hide_free_features").style.display = "block";			    		
			    		document.getElementById("mo2fa_show_enterprise_features").style.display = "none";
			    		document.getElementById("mo2fa_hide_enterprise_features").style.display = "block";

			    		document.getElementById("mo2fa_show_standard_features").style.display = "none";
			    		document.getElementById("mo2fa_hide_standard_features").style.display = "block";

			    		document.getElementById("mo2fa_show_premium_features").style.display = "none";
			    		document.getElementById("mo2fa_hide_premium_features").style.display = "block";
			    	}

			    	function mo2fa_hide_detail_features()
			    	{
			    		// jQuery("#mo2f_features_id").slideToggle();
			    		jQuery("#mo2f_features_id").hide(1500);

			    		document.getElementById("mo2f_show_features").style.display = "block";
			    		document.getElementById("mo2f_hide_features").style.display = "none";

						document.getElementById("mo2fa_show_free_features").style.display = "block";
			    		document.getElementById("mo2fa_hide_free_features").style.display = "none";

			    		document.getElementById("mo2fa_show_enterprise_features").style.display = "block";
			    		document.getElementById("mo2fa_hide_enterprise_features").style.display = "none";

			    		document.getElementById("mo2fa_show_standard_features").style.display = "block";
			    		document.getElementById("mo2fa_hide_standard_features").style.display = "none";

			    		document.getElementById("mo2fa_show_premium_features").style.display = "block";
			    		document.getElementById("mo2fa_hide_premium_features").style.display = "none";
			    	}

		function mo2f_features()
		{
			document.getElementById("mo2f_visible").style.display = "block";
		}
		function mo2f_features_disable()
		{
			document.getElementById("mo2f_visible").style.display = "none";
			document.getElementById("mo2f_features_id").style.display = "none";
		}
		function mo2f_upgradeform1(planType) {
                    jQuery('#requestOrigin').val(planType);
                    jQuery('#mo2fa_loginform').submit();
                }

                function mo2f_register_and_upgradeform1(planType) {
                    jQuery('#requestOrigin').val(planType);
                    jQuery('input[name="requestOrigin"]').val(planType);
                    jQuery('#mo2fa_register_to_upgrade_form').submit();
                }
			function mo2f_registration_before_upgrade(plantype)
			{
				var plantype = plantype;
				var data =  {
						'action'				  : 'wpns_login_security',
						'wpns_loginsecurity_ajax' : 'wpns_upgrade', 
						'plantype'				  : plantype,
						};
				jQuery.post(ajaxurl, data, function(response) {
				location.reload(true);
				});
			}
	</script>