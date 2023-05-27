<form class="actionForm" action="<?php _e( get_module_url("save/".get_data($result, "ids")) )?>" data-call-success="Core.click('users-list');" method="POST">
	<div class="container my-5">
	    <div class="mw-750">
	        <div class="card card-flush">
	            <div class="card-header mt-6">
	                <div class="card-title w-100 m-r-0">
	                	<div class="d-flex">
	                    	<h3 class="fw-bolder"><i class="fad fa-edit text-primary"></i> <?php _e('Update')?></h3>
	                	</div>
	                	<div class="d-flex ms-auto">
	                		<a href="<?php _e( get_module_url('index/list') )?>" class="btn btn-light-primary actionItem" data-remove-other-active="true" data-active="bg-light-primary" data-result="html" data-content="main-wrapper" data-history="<?php _e( get_module_url('index/list') )?>">
		                    	<i class="fad fa-chevron-left"></i> <?php _e('Back')?>
		                    </a>
	                	</div>
	                </div>
	            </div>
	            <div class="card-body">
	                <div class="mb-4">
	                    <label for="website_description" class="form-label"><?php _e('Role')?></label>
	                    <div>
	                        <div class="form-check form-check-inline">
	                            <input class="form-check-input" type="radio" name="is_admin" <?php _e( get_data($result, "is_admin", "radio", 0) )?> id="is_user" value="0">
	                            <label class="form-check-label" for="is_user"><?php _e('User')?></label>
	                        </div>
	                        <div class="form-check form-check-inline">
	                            <input class="form-check-input" type="radio" name="is_admin" <?php _e( get_data($result, "is_admin", "radio", 1) )?> id="is_admin" value="1">
	                            <label class="form-check-label" for="is_admin"><?php _e('Admin')?></label>
	                        </div>
	                    </div>
	                </div>
	                <div class="mb-4">
	                    <label for="website_description" class="form-label"><?php _e('Status')?></label>
	                    <div>
	                        <div class="form-check form-check-inline">
	                            <input class="form-check-input" type="radio" name="status" <?php _e( get_data($result, "status", "radio", 2) )?> id="status-active" value="2">
	                            <label class="form-check-label" for="status-active"><?php _e('Active')?></label>
	                        </div>
	                        <div class="form-check form-check-inline">
	                            <input class="form-check-input" type="radio" name="status"  <?php _e( get_data($result, "status", "radio", 1) )?> id="status-inactive" value="1">
	                            <label class="form-check-label" for="status-inactive"><?php _e('Inactive')?></label>
	                        </div>
	                        <div class="form-check form-check-inline">
	                            <input class="form-check-input" type="radio" name="status"  <?php _e( get_data($result, "status", "radio", 0) )?> id="status-banned" value="0">
	                            <label class="form-check-label" for="status-banned"><?php _e('Banned')?></label>
	                        </div>
	                    </div>
	                </div>
	                <div class="mb-3">
	                    <label for="package" class="form-label"><?php _e("Group role")?></label>
	                    <select id="package" name="role" class="form-control form-select form-control-solid">
                    		<option value="0"><?php _e("None")?></option>
	                    	<?php if (!empty($group_roles)): ?>
	                    		<?php foreach ($group_roles as $key => $value): ?>
	                    			 <option value="<?php _ec( $value->id )?>" <?php _ec( get_data($result, "role", "select", $value->id) )?>><?php _ec( $value->name )?></option>
	                    		<?php endforeach ?>
	                    	<?php endif ?>
	                    </select>
	                </div>
	                <div class="mb-3">
	                    <label for="username" class="form-label"><?php _e('Username')?></label>
	                    <input type="text" class="form-control form-control-solid" id="username" name="username" value="<?php _e( get_data($result, "username") )?>">
	                </div>
	                <div class="mb-3">
	                    <label for="fullname" class="form-label"><?php _e('Fullname')?></label>
	                    <input type="text" class="form-control form-control-solid" id="fullname" name="fullname" value="<?php _e( get_data($result, "fullname") )?>">
	                </div>
	                <div class="mb-3">
	                    <label for="email" class="form-label"><?php _e('Email')?></label>
	                    <input type="text" class="form-control form-control-solid" id="email" name="email" value="<?php _e( get_data($result, "email") )?>">
	                </div>
	                <div class="mb-3">
	                    <label for="password" class="form-label"><?php _e('Password')?></label>
	                    <input type="password" class="form-control form-control-solid" id="password" name="password" value="">
	                </div>
	                <div class="mb-3">
	                    <label for="confirm-password" class="form-label"><?php _e('Confirm password')?></label>
	                    <input type="password" class="form-control form-control-solid" id="confirm-password" name="confirm_password" value="">
	                </div>
	                <div class="mb-3">
	                    <label for="package" class="form-label"><?php _e('Plan')?></label>
	                    <select id="package" name="plan" class="form-control form-select form-control-solid">
                    		<option value="0"><?php _e("Select plan")?></option>
	                    	<?php if (!empty($plans)): ?>
	                    		<?php foreach ($plans as $key => $value): ?>
	                    			 <option value="<?php _ec( $value->id )?>" <?php _ec( get_data($result, "plan", "select", $value->id) )?> ><?php _ec( $value->name )?></option>
	                    		<?php endforeach ?>
	                    	<?php endif ?>
	                    </select>
	                </div>
	                <div class="mb-3">
	                    <label for="expiration-date" class="form-label"><?php _e('Expiration date')?></label>
	                    <input type="text" class="form-control form-control-solid" id="expiration-date" name="expiration_date" value="<?php _e( get_data($result, "expiration_date")?date("d/m/Y", get_data($result, "expiration_date")):0 )?>" placeholder="<?php _e("dd/mm/yyyy")?>">
	                    <span class="fs-12 text-primary"><?php _e("Set 0 is unlimited")?></span>
	                </div>
	                <div class="mb-3">
	                    <label for="timezone" class="form-label"><?php _e('Timezone')?></label>
	                    <select name="timezone" class="form-control form-select form-control-solid">
	                    	<?php foreach ( tz_list() as $key => $value): ?>
	                    		<option value="<?php _e( $key ) ?>" <?php _e( get_data($result, "timezone", "select", $key) )?> ><?php _e( $value )?></option>
	                    	<?php endforeach ?>
	                    </select>
	                </div>
	            </div>

	            <div class="card-footer">
	                <button type="submit" class="btn btn-primary"><?php _e('Save')?></button>
	            </div>
	        </div>
	    </div>

	</div>
</form>