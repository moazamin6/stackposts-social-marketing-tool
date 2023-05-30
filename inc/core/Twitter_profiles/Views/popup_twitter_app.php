<div class="modal fade" id="TwitterAPPModal" tabindex="-1" role="dialog">
  	<div class="modal-dialog modal-dialog-centered">
	    <div class="modal-content">
	    	<form class="actionForm" action="<?php _ec( get_module_url("save_twitter_api") ) ?>" method="POST">
	      		<div class="modal-header">
			        <h5 class="modal-title"><i class="<?php _ec( $config['icon'] )?>" style="color: <?php _ec( $config['color'] )?>;"></i> <?php _ec("Use your Twitter app")?></h5>
			         <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
		      	</div>
		      	<div class="modal-body p-25 shadow-none">
			        <div class="mb-4">
			            <div class="alert alert-dismissible bg-light-primary border border-primary border-dashed d-flex flex-column flex-sm-row w-100 p-25 mb-10">
			                <span class="fs-30 me-4 mb-5 mb-sm-0 text-primary">
			                    <i class="fad fa-link"></i>
			                </span>
			                <div class="d-flex flex-column pe-0 pe-sm-10">
			                    <h5 class="mb-1"><?php _e("Callback URL:")?></h5>
			                    <span class="m-b-0"><?php _ec( base_url($config['id']) )?></span>
			                </div>
			            </div>
			        </div>

			        <div class="mb-4">
	                    <label class="form-label"><?php _e("Status")?></label>
	                    <div>
	                        <div class="form-check form-check-inline">
	                            <input class="form-check-input" type="radio" name="twitter_status" <?php _ec( (get_team_data("twitter_status", 0) == 1 || get_team_data("twitter_status", 0) == "")?"checked='true'":"" ) ?> id="status_enable" value="1">
	                            <label class="form-check-label" for="status_enable"><?php _e('Enable')?></label>
	                        </div>
	                        <div class="form-check form-check-inline">
	                            <input class="form-check-input" type="radio" name="twitter_status" <?php _ec( (get_team_data("twitter_status", 0) == 0 )?"checked='true'":"" ) ?> id="status_disable" value="0">
	                            <label class="form-check-label" for="status_disable"><?php _e('Disable')?></label>
	                        </div>
	                    </div>
	                </div>

			        <div class="mb-3">
			            <label for="twitter_consumer_key" class="form-label"><?php _e('Twitter consumer id')?></label>
			            <input type="text" class="form-control form-control-solid" id="twitter_consumer_key" name="twitter_consumer_key" value="<?php _e( get_team_data("twitter_consumer_key", "") )?>">
			        </div>
			        <div class="mb-3">
			            <label for="twitter_consumer_secret" class="form-label"><?php _e('Twitter consumer secret')?></label>
			            <input type="text" class="form-control form-control-solid" id="twitter_consumer_secret" name="twitter_consumer_secret" value="<?php _e( get_team_data("twitter_consumer_secret", "") )?>">
			        </div>
		      	</div>
		      	<div class="modal-footer d-flex justify-content-end">
		      		<button class="btn btn-primary" data-bs-dismiss="modal"><?php _e("Submit")?></button>
		      	</div>
        	</form>
	    </div>
  	</div>
</div>