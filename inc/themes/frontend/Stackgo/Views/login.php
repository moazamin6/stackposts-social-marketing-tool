<div class="row justify-content-center">
	<div class="col-xl-7 col-lg-10">
		<nav class="navbar navbar-static-top navbar-expand-lg header-sticky justify-content-between">
          	<a class="navbar-brand" href="<?php _ec( base_url() )?>"><img class="auth logo" src="<?php _ec( get_option("website_logo_color", base_url("assets/img/logo-color.svg")) )?>" alt="logo"></a>
        </nav>
		<div class="section-title m-0">
			<span class="sub-title"><?php _e("Welcome back")?></span>
			<h5 class="title"><?php _e("Sign in to your Account")?></h5>
		</div>
		<form class="actionForm" action="<?php _ec( base_url("auth/login") )?>" data-redirect="<?php _ec( base_url("dashboard") )?>" method="POST">
			<div class="form-group">
		  		<input type="text" class="form-control" id="username" name="username" placeholder="<?php _e("Enter username or email")?>">
		  		<span class="focus-border"></span>
			</div>
			<div class="form-group">
				<input type="password" class="form-control" id="password" name="password" placeholder="<?php _e("Password")?>">
				<span class="focus-border"></span>
			</div>
			<?php if(get_option('google_recaptcha_status', 0)){?>
			<div class="g-recaptcha  mb-3" data-sitekey="<?=get_option('google_recaptcha_site_key', '')?>"></div>
	    	<script src="https://www.google.com/recaptcha/api.js" async defer></script>
			<?php }?>
			<div class="show-message mb-2"></div>
			<div class="d-flex justify-content-between mb-0">
				<div class="d-flex form-group form-check">
					<input type="checkbox" class="form-check-input" id="remember" name="remember">
					<label class="form-check-label ps-1" for="remember"><?php _e("Remember Me")?></label>
				</div>
				<div>
					<a href="<?php _ec( base_url("forgot_password") )?>" class="mb-2"><?php _e("Forgot your password?")?></a>
				</div>
			</div>
			<button type="submit" class="btn btn-primary w-100 mb-3"><?php _e("Login")?></button>
			<?php if ( get_option("signup_status", 1) ): ?>
				<p class="mt-2 mb-0 text-end"><?php _e("Don't have an account?")?> <a href="<?php _ec( base_url("signup") )?>"> <?php _e("Sign Up")?></a></p>
			<?php endif ?>
			<?php if ( get_option('google_login_status', 0) || get_option('facebook_login_status', 0) || get_option('twitter_login_status', 0) ): ?>
			<hr>
			<p class="mt-2 mb-0"><?php _e("Or Log in with")?></p>
			<div class="mt-3">
				<?php if ( get_option('google_login_status', 0) ): ?>
				<a href="<?php _ec( base_url("login/google") )?>" class="btn btn-light bg-white mb-2 d-flex btn-social btn-google">
					<span class="icon"><img src="<?php _ec( get_frontend_url() )?>Assets/images/logo/g-logo.png" class="w-20"></span>
					<span class="flex-grow-1"><?php _e("Login with Google")?></span>
				</a>
				<?php endif ?>
				<?php if ( get_option('facebook_login_status', 0) ): ?>
				<a href="<?php _ec( base_url("login/facebook") )?>" class="btn btn-light bg-white mb-2 d-flex btn-social btn-facebook">
					<span class="icon"><i class="fab fa-facebook-square"></i></span>
					<span class="flex-grow-1"><?php _e("Login with Facebook")?></span>
				</a>
				<?php endif ?>
				<?php if ( get_option('twitter_login_status', 0) ): ?>
				<a href="<?php _ec( base_url("login/twitter") )?>" class="btn btn-light bg-white mb-2 d-flex btn-social btn-twitter">
					<span class="icon"><i class="fab fa-twitter"></i></span>
					<span class="flex-grow-1"><?php _e("Login with Twitter")?></span>
				</a>
				<?php endif ?>
			</div>
			<?php endif ?>
		</form>
	</div>
</div>