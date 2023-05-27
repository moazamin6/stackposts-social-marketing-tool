<div class="modal fade" id="addSMTPModal" tabindex="-1" role="dialog">
  	<div class="modal-dialog modal-dialog-centered">
	    <div class="modal-content">
	    	<form class="actionForm" action="<?php _ec( get_module_url("save_smtp/".get_data($result, "ids")) ) ?>" method="POST" data-redirect="<?php _ec( get_module_url("index/config_mail_server") ) ?>">
	      		<div class="modal-header">
			        <h5 class="modal-title"><i class="<?php _ec( $config['icon'] )?>" style="color: <?php _ec( $config['color'] )?>;"></i> <?php _ec("Add new SMTP server")?></h5>
			         <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
		      	</div>
		      	<div class="modal-body shadow-none">
		      		<?php if (!empty($result)): ?>
		      			<input type="hidden" name="ids" value="<?php _ec( get_data($result, "ids") )?>">
		      		<?php endif ?> 

		      		<div class="mb-4">
	                    <label class="form-label"><?php _e("Status")?></label>
	                    <div>
	                        <div class="form-check form-check-inline">
	                            <input class="form-check-input" type="radio" name="status" <?php _ec( (get_data($result, "status") == 1 || get_data($result, "status") == "")?"checked='true'":"" ) ?> id="status_enable" value="1">
	                            <label class="form-check-label" for="status_enable"><?php _e('Enable')?></label>
	                        </div>
	                        <div class="form-check form-check-inline">
	                            <input class="form-check-input" type="radio" name="status" <?php _ec( get_data($result, "status", "radio", 0) ) ?> id="status_disable" value="0">
	                            <label class="form-check-label" for="status_disable"><?php _e('Disable')?></label>
	                        </div>
	                    </div>
	                </div>

	        		<div class="mb-3">
	        			<label class="form-label" for="smtp_server"><?php _e("SMTP Server")?></label>
	                    <input type="text" class="form-control form-control-solid" id="smtp_server" name="smtp_server" value="<?php _ec( get_data($result, "server") )?>">
	                </div>
	                <div class="mb-3">
	        			<label class="form-label" for="smtp_username"><?php _e("SMTP Username")?></label>
	                    <input type="text" class="form-control form-control-solid" id="smtp_username" name="smtp_username" value="<?php _ec( get_data($result, "username") )?>">
	                </div>

	                <div class="mb-3">
	        			<label class="form-label" for="smtp_password"><?php _e("SMTP Password")?></label>
	                    <input type="text" class="form-control form-control-solid" id="smtp_password" name="smtp_password" value="<?php _ec( get_data($result, "password") )?>">
	                </div>

	                <div class="mb-3">
	        			<label class="form-label" for="smtp_port"><?php _e("SMTP Port")?></label>
	                    <input type="number" class="form-control form-control-solid" id="smtp_port" name="smtp_port" value="<?php _ec( get_data($result, "port") )?>">
	                </div>

	                <div class="mb-3">
	        			<label class="form-label" for="smtp_encryption"><?php _e("SMTP Encryption")?></label>
	        			<select class="form-select form-select-solid" id="smtp_encryption" name="smtp_encryption">
	        				<option value="NONE" <?php _ec( get_data($result, "encryption")=="NONE"?"selected":"" )?>><?php _e("NONE")?></option>
	        				<option value="SSL" <?php _ec( get_data($result, "encryption")=="SSL"?"selected":"" )?>><?php _e("SSL")?></option>
	        				<option value="TSL" <?php _ec( get_data($result, "encryption")=="TSL"?"selected":"" )?>><?php _e("TSL")?></option>
	        			</select>
	                </div>
		      	</div>
		      	<div class="modal-footer d-flex justify-content-end py-3">
		      		<button type="submit" class="btn btn-dark btn-sm"><?php _e("Add")?></button>
		      	</div>
	      	</form>
	    </div>
  	</div>
</div>