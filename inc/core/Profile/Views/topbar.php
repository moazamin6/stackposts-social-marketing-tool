<div class="d-flex align-items-stretch ms-2 ms-lg-2">
    <div class="d-flex align-items-center">
        <div class="dropdown dropdown-hide-arrow" data-dropdown-spacing="52.5">
            <a href="javascript:void(0);" class="dropdown-toggle d-block position-relative" data-toggle="dropdown" aria-expanded="true">
                <img src="<?php _ec( get_file_url( get_user("avatar") ) )?>" class="h-40 w-40 rounded-circle border">
            </a>
            <div class="dropdown-menu dropdown-menu-right" >
                <a class="dropdown-item py-2" href="<?php _ec( base_url("profile/index/account") )?>"><i class="fad fa-user me-2"></i> <?php _e("Account")?></a>
                <a class="dropdown-item py-2" href="<?php _ec( base_url("profile/index/change_password") )?>"><i class="fad fa-key me-2"></i> <?php _e("Change password")?></a>
                <a class="dropdown-item py-2" href="<?php _ec( base_url("profile/index/plan") )?>"><i class="fad fa-box-open me-2"></i> <?php _e("Plan")?></a>
                <?php if (find_modules("payment")): ?>
                <a class="dropdown-item py-2" href="<?php _ec( base_url("profile/index/billing") )?>"><i class="fad fa-credit-card me-2"></i> <?php _e("Billing")?></a>
                <?php endif ?>
                <?php if (!empty($settings)): ?>
                <a class="dropdown-item py-2" href="<?php _ec( base_url("profile/index/settings") )?>"><i class="fad fa-cog me-2"></i> <?php _e("Settings")?></a>
                <?php endif ?>
                <li><hr class="border-bottom"></li>
                <a class="dropdown-item py-2" href="<?php _ec( base_url("auth/logout") )?>"><i class="fad fa-sign-out text-danger me-2"></i> <?php _e("Logout")?></a>
            </div>
        </div>
    </div>
</div>
<?php if ( get_session("tmp_uid") && get_session("tmp_team_id") ): ?>
<div class="d-flex align-items-stretch ms-2">
    <div class="d-flex align-items-center">
        <a href="<?php _e( base_url("auth/back_to_admin") )?>" data-redirect="<?php _e( base_url("users") )?>" class="actionItem btn btn-light-dark btn-sm border b-r-30 h-40 w-40 d-flex align-items-center justify-content-center" data-toggle="tooltip" data-placement="bottom" title="<?php _e("Back to admin")?>">
            <i class="fad fa-chevron-left"></i>
        </a>
    </div>
</div>
<?php endif ?>