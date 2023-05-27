<form class="actionForm" action="<?php _ec( base_url("watermark/save_status") ) ?>" method="POST">
	<div class="card">
		<div class="card-header">
			<div class="card-title">
				<span class="me-2"><i class="<?php _e( $config['menu']['icon'] )?> me-2" style="color: <?php _e( $config['color'] )?>"></i> <?php _e( $config['menu']['sub_menu']['name'] )?></span>
			</div>
		</div>
		<div class="card-body">
	        <div class="mb-4">
                <label class="form-label"><?php _e("Status")?></label>
                <div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="watermark_status" <?php _ec( (get_team_data("watermark_status", 1) == 1 || get_team_data("watermark_status", 1) == "")?"checked='true'":"" ) ?> id="watermark_status_enable" value="1">
                        <label class="form-check-label" for="watermark_status_enable"><?php _e('Enable')?></label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="watermark_status" <?php _ec( (get_team_data("watermark_status", 1) == 0 )?"checked='true'":"" ) ?> id="watermark_status_disable" value="0">
                        <label class="form-check-label" for="watermark_status_disable"><?php _e('Disable')?></label>
                    </div>
                </div>
            </div>
		</div>
      	<div class="card-footer d-flex justify-content-end">
      		<button class="btn btn-primary" data-bs-dismiss="modal"><?php _e("Submit")?></button>
      	</div>
	</div>
</form>