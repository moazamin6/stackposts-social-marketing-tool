<div class="container py-5">
	<div class="card mb-4">
		<div class="card-header">
			<div class="card-title"><?php _e("Auth")?></div>
		</div>
		<div class="card-body">
            <div class="mb-4">
                <label class="form-label"><?php _e("Landing page")?></label>
                <div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="landing_page_status" <?php _e( get_option("landing_page_status", 1)==1?"checked='true'":"" )?> id="landing_page_status_enable" value="1">
                        <label class="form-check-label" for="landing_page_status_enable"><?php _e('Enable')?></label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="landing_page_status" <?php _e( get_option("landing_page_status", 1)==0?"checked='true'":"" )?> id="landing_page_status_disable" value="0">
                        <label class="form-check-label" for="landing_page_status_disable"><?php _e('Disable')?></label>
                    </div>
                </div>
            </div>
			<div class="mb-4">
				<label class="form-label"><?php _e("Signup page")?></label>
				<div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="signup_status" <?php _e( get_option("signup_status", 1)==1?"checked='true'":"" )?> id="signup_status_enable" value="1">
                        <label class="form-check-label" for="signup_status_enable"><?php _e('Enable')?></label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="signup_status" <?php _e( get_option("signup_status", 1)==0?"checked='true'":"" )?> id="signup_status_disable" value="0">
                        <label class="form-check-label" for="signup_status_disable"><?php _e('Disable')?></label>
                    </div>
                </div>
			</div>
			<div class="mb-4">
				<label class="form-label"><?php _e("Activation email for new user")?></label>
				<div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="activation_email_status" <?php _e( get_option("activation_email_status", 0)==1?"checked='true'":"" )?> id="activation_email_status_enable" value="1">
                        <label class="form-check-label" for="activation_email_status_enable"><?php _e('Enable')?></label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="activation_email_status" <?php _e( get_option("activation_email_status", 0)==0?"checked='true'":"" )?> id="activation_email_status_disable" value="0">
                        <label class="form-check-label" for="activation_email_status_disable"><?php _e('Disable')?></label>
                    </div>
                </div>
			</div>
            <div class="mb-4">
                <label class="form-label"><?php _e("Welcome email for new user")?></label>
                <div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="welcome_email_status" <?php _e( get_option("welcome_email_status", 0)==1?"checked='true'":"" )?> id="welcome_email_status_enable" value="1">
                        <label class="form-check-label" for="welcome_email_status_enable"><?php _e('Enable')?></label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="welcome_email_status" <?php _e( get_option("welcome_email_status", 0)==0?"checked='true'":"" )?> id="welcome_email_status_disable" value="0">
                        <label class="form-check-label" for="welcome_email_status_disable"><?php _e('Disable')?></label>
                    </div>
                </div>
            </div>
			<div class="mb-4">
				<label class="form-label"><?php _e("User can change email")?></label>
				<div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="accept_change_email" <?php _e( get_option("accept_change_email", 1)==1?"checked='true'":"" )?> id="accept_change_email_enable" value="1">
                        <label class="form-check-label" for="accept_change_email_enable"><?php _e('Enable')?></label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="accept_change_email" <?php _e( get_option("accept_change_email", 1)==0?"checked='true'":"" )?> id="accept_change_email_disable" value="0">
                        <label class="form-check-label" for="accept_change_email_disable"><?php _e('Disable')?></label>
                    </div>
                </div>
			</div>
            <div class="mb-4">
                <label class="form-label"><?php _e("User can change username")?></label>
                <div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="accept_change_username" <?php _e( get_option("accept_change_username", 1)==1?"checked='true'":"" )?> id="accept_change_username_enable" value="1">
                        <label class="form-check-label" for="accept_change_username_enable"><?php _e('Enable')?></label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="accept_change_username" <?php _e( get_option("accept_change_username", 1)==0?"checked='true'":"" )?> id="accept_change_username_disable" value="0">
                        <label class="form-check-label" for="accept_change_username_disable"><?php _e('Disable')?></label>
                    </div>
                </div>
            </div>
			<!-- <div class="mb-4">
				<label class="form-label"><?php _e("Phone number field  for signup page")?></label>
				<div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="signup_phone_number" <?php _e( get_option("signup_phone_number", 0)==1?"checked='true'":"" )?> id="signup_phone_number_enable" value="1">
                        <label class="form-check-label" for="signup_phone_number_enable"><?php _e('Enable')?></label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="signup_phone_number" <?php _e( get_option("signup_phone_number", 0)==0?"checked='true'":"" )?> id="signup_phone_number_disable" value="0">
                        <label class="form-check-label" for="activation_email_status_disable"><?php _e('Disable')?></label>
                    </div>
                </div>
			</div> -->
		</div>
	</div>

	<div class="card mb-4">
		<div class="card-header">
			<div class="card-title"><?php _e("Google reCaptcha V2")?></div>
		</div>
		<div class="card-body">
			<div class="mb-4">
				<label class="form-label"><?php _e("Status")?></label>
				<div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="google_recaptcha_status" <?php _e( get_option("google_recaptcha_status", 0)==1?"checked='true'":"" )?> id="google_recaptcha_status_enable" value="1">
                        <label class="form-check-label" for="google_recaptcha_status_enable"><?php _e('Enable')?></label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="google_recaptcha_status" <?php _e( get_option("google_recaptcha_status", 0)==0?"checked='true'":"" )?> id="google_recaptcha_status_disable" value="0">
                        <label class="form-check-label" for="google_recaptcha_status_disable"><?php _e('Disable')?></label>
                    </div>
                </div>
			</div>
			<div class="mb-4">
                <label for="google_recaptcha_site_key" class="form-label"><?php _e('Google site key')?></label>
                <input type="text" class="form-control form-control-solid" id="google_recaptcha_site_key" name="google_recaptcha_site_key" value="<?php _ec( get_option("google_recaptcha_site_key", "") )?>">
            </div>
            <div class="mb-4">
                <label for="google_recaptcha_secret_key" class="form-label"><?php _e('Google secret key')?></label>
                <input type="text" class="form-control form-control-solid" id="google_recaptcha_secret_key" name="google_recaptcha_secret_key" value="<?php _ec( get_option("google_recaptcha_secret_key", "") )?>">
            </div>
		</div>
	</div>

	<div class="card mb-4">
		<div class="card-header">
			<div class="card-title"><?php _e("Facebook login")?></div>
		</div>
		<div class="card-body">
			<div class="alert alert-dismissible bg-light-primary border border-primary border-dashed d-flex flex-column flex-sm-row w-100 p-25 mb-10">
                <span class="fs-30 me-4 mb-5 mb-sm-0 text-primary">
                    <i class="fad fa-link"></i>
                </span>
                <div class="d-flex flex-column pe-0 pe-sm-10">
                    <h5 class="mb-1"><?php _e("Callback URL:")?></h5>
                    <span class="m-b-0"><a href="<?php _ec( base_url("login/facebook") )?>" target="_blank"><?php _ec( base_url("login/facebook") )?></a></span>

                    <h5 class="mb-1 mt-3"><?php _e("Click this link to create Facebook app:")?></h5>
                    <span class="m-b-0"><a href="https://developers.facebook.com/apps/create/" target="_blank">https://developers.facebook.com/apps/create/</a></span>
                </div>
            </div>
			<div class="mb-4">
				<label class="form-label"><?php _e("Status")?></label>
				<div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="facebook_login_status" <?php _e( get_option("facebook_login_status", 0)==1?"checked='true'":"" )?> id="facebook_login_status_enable" value="1">
                        <label class="form-check-label" for="facebook_login_status_enable"><?php _e('Enable')?></label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="facebook_login_status" <?php _e( get_option("facebook_login_status", 0)==0?"checked='true'":"" )?> id="facebook_login_status_disable" value="0">
                        <label class="form-check-label" for="facebook_login_status_disable"><?php _e('Disable')?></label>
                    </div>
                </div>
			</div>
			<div class="mb-4">
                <label for="facebook_login_app_id" class="form-label"><?php _e('Facebook app id')?></label>
                <input type="text" class="form-control form-control-solid" id="facebook_login_app_id" name="facebook_login_app_id" value="<?php _ec( get_option("facebook_login_app_id", "") )?>">
            </div>
            <div class="mb-4">
                <label for="facebook_login_app_secret" class="form-label"><?php _e('Facebook app secret')?></label>
                <input type="text" class="form-control form-control-solid" id="facebook_login_app_secret" name="facebook_login_app_secret" value="<?php _ec( get_option("facebook_login_app_secret", "") )?>">
            </div>
            <div class="mb-4">
                <label for="facebook_login_app_version" class="form-label"><?php _e('Facebook app version')?></label>
                <input type="text" class="form-control form-control-solid" id="facebook_login_app_version" name="facebook_login_app_version" value="<?php _ec( get_option("facebook_login_app_version", "v16.0") )?>">
            </div>
		</div>
	</div>

	<div class="card mb-4">
		<div class="card-header">
			<div class="card-title"><?php _e("Google login")?></div>
		</div>
		<div class="card-body">
			<div class="alert alert-dismissible bg-light-primary border border-primary border-dashed d-flex flex-column flex-sm-row w-100 p-25 mb-10">
                <span class="fs-30 me-4 mb-5 mb-sm-0 text-primary">
                    <i class="fad fa-link"></i>
                </span>
                <div class="d-flex flex-column pe-0 pe-sm-10">
                    <h5 class="mb-1"><?php _e("Callback URL:")?></h5>
                    <span class="m-b-0"><a href="<?php _ec( base_url("login/google") )?>" target="_blank"><?php _ec( base_url("login/google") )?></a></span>

                    <h5 class="mb-1 mt-3"><?php _e("Click this link to create Google app:")?></h5>
                    <span class="m-b-0"><a href="https://console.cloud.google.com/projectcreate" target="_blank">https://console.cloud.google.com/projectcreate</a></span>
                </div>
            </div>
			<div class="mb-4">
				<label class="form-label"><?php _e("Status")?></label>
				<div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="google_login_status" <?php _e( get_option("google_login_status", 0)==1?"checked='true'":"" )?> id="google_login_status_enable" value="1">
                        <label class="form-check-label" for="google_login_status_enable"><?php _e('Enable')?></label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="google_login_status" <?php _e( get_option("google_login_status", 0)==0?"checked='true'":"" )?> id="google_login_status_disable" value="0">
                        <label class="form-check-label" for="google_login_status_disable"><?php _e('Disable')?></label>
                    </div>
                </div>
			</div>
			<div class="mb-4">
                <label for="google_login_client_id" class="form-label"><?php _e('Google client id')?></label>
                <input type="text" class="form-control form-control-solid" id="google_login_client_id" name="google_login_client_id" value="<?php _ec( get_option("google_login_client_id", "") )?>">
            </div>
            <div class="mb-4">
                <label for="google_login_client_secret" class="form-label"><?php _e('Google client secret')?></label>
                <input type="text" class="form-control form-control-solid" id="google_login_client_secret" name="google_login_client_secret" value="<?php _ec( get_option("google_login_client_secret", "") )?>">
            </div>
		</div>
	</div>

	<div class="card mb-4">
		<div class="card-header">
			<div class="card-title"><?php _e("Twitter login")?></div>
		</div>
		<div class="card-body">
			<div class="alert alert-dismissible bg-light-primary border border-primary border-dashed d-flex flex-column flex-sm-row w-100 p-25 mb-10">
                <span class="fs-30 me-4 mb-5 mb-sm-0 text-primary">
                    <i class="fad fa-link"></i>
                </span>
                <div class="d-flex flex-column pe-0 pe-sm-10">
                    <h5 class="mb-1"><?php _e("Callback URL:")?></h5>
                    <span class="m-b-0"><a href="<?php _ec( base_url("login/twitter") )?>" target="_blank"><?php _ec( base_url("login/twitter") )?></a></span>

                    <h5 class="mb-1 mt-3"><?php _e("Click this link to create Twitter app:")?></h5>
                    <span class="m-b-0"><a href="https://developer.twitter.com/en/portal/dashboard" target="_blank">https://developer.twitter.com/en/portal/dashboard</a></span>
                </div>
            </div>
			<div class="mb-4">
				<label class="form-label"><?php _e("Status")?></label>
				<div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="twitter_login_status" <?php _e( get_option("twitter_login_status", 0)==1?"checked='true'":"" )?> id="twitter_login_status_enable" value="1">
                        <label class="form-check-label" for="twitter_login_status_enable"><?php _e('Enable')?></label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="twitter_login_status" <?php _e( get_option("twitter_login_status", 0)==0?"checked='true'":"" )?> id="twitter_login_status_disable" value="0">
                        <label class="form-check-label" for="twitter_login_status_disable"><?php _e('Disable')?></label>
                    </div>
                </div>
			</div>
			<div class="mb-4">
                <label for="twitter_login_client_id" class="form-label"><?php _e('Twitter client id')?></label>
                <input type="text" class="form-control form-control-solid" id="twitter_login_client_id" name="twitter_login_client_id" value="<?php _ec( get_option("twitter_login_client_id", "") )?>">
            </div>
            <div class="mb-4">
                <label for="twitter_login_client_secret" class="form-label"><?php _e('Twitter client secret')?></label>
                <input type="text" class="form-control form-control-solid" id="twitter_login_client_secret" name="twitter_login_client_secret" value="<?php _ec( get_option("twitter_login_client_secret", "") )?>">
            </div>
		</div>
	</div>


	<div class="m-t-25">
        <button type="submit" class="btn btn-primary"><?php _e('Save')?></button>
    </div>
</div>