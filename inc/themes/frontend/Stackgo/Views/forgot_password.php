<div class="row justify-content-center">
    <div class="col-xl-7 col-lg-10">
        <nav class="navbar navbar-static-top navbar-expand-lg header-sticky justify-content-between">
            <a class="navbar-brand" href="<?php _ec( base_url() )?>"><img class="auth logo" src="<?php _ec( get_option("website_logo_color", base_url("assets/img/logo-color.svg")) )?>" alt="logo"></a>
        </nav>
        <form class="actionForm" action="<?php _ec( base_url("auth/forgot_password") )?>" method="POST">
            <div class="row">
                <div class="section-title m-0">
                    <h2 class="title"><?php _e("Forgot Password")?></h2>
                    <p class=""><?php _e("To continue first verify it's you")?></p>
                </div>
                <div class="form-group col-md-12">
                    <input type="text" class="form-control" name="email" placeholder="<?php _e("Enter email")?>">
                </div>
                <?php if(get_option('google_recaptcha_status', 0)){?>
                <div class="g-recaptcha  mb-3" data-sitekey="<?=get_option('google_recaptcha_site_key', '')?>"></div>
                <script src="https://www.google.com/recaptcha/api.js" async defer></script>
                <?php }?>
                <div class="show-message mb-2"></div>
                <div class="col-md-12">
                    <button type="submit" class="btn btn-primary w-100 mb-3"><?php _e("Submit")?></button>
                </div>
            </div>
        </form>
    </div>
</div>