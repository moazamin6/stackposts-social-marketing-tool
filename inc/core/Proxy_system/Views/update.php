<form class="actionForm" action="<?php _e( get_module_url("save/".get_data($result, "ids")) )?>" data-redirect="<?php _ec( get_module_url() )?>" method="POST">
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
	                    <label class="form-label"><?php _e('Status')?></label>
	                    <div>
	                        <div class="form-check form-check-inline">
	                            <input class="form-check-input" type="radio" name="status" <?php _e( get_data($result, "status", "radio", 1) )?> id="status_enable" value="1">
	                            <label class="form-check-label" for="status_enable"><?php _e('Enable')?></label>
	                        </div>
	                        <div class="form-check form-check-inline">
	                            <input class="form-check-input" type="radio" name="status" <?php _e( get_data($result, "status", "radio", 0) )?> id="status_disable" value="0">
	                            <label class="form-check-label" for="status_disable"><?php _e('Disable')?></label>
	                        </div>
	                    </div>
	                </div>
	                <label class="form-label"><?php _e("Plans")?></label>
					<div class="mb-3">
						<?php
						$allow_plans = json_decode( get_data($result, 'plans') );
						?>
						<?php if ($plans): ?>
							
							<?php foreach ($plans as $key => $value): ?>
							<label for="plan_<?php _ec( $value->id )?>" class="form-label"> 
						        <div class="form-check form-check-inline">
						            <input class="form-check-input" type="checkbox" name="plans[]" id="plan_<?php _ec( $value->id )?>" value="<?php _e( $value->id )?>" <?php _e( (!empty( $allow_plans ) && in_array($value->id, $allow_plans ))?"checked":"" )?>>
						            <label class="form-check-label" for="plan_<?php _ec( $value->id )?>"><?php _ec( $value->name )?></label>
						        </div>
						    </label>
							<?php endforeach ?>

						<?php endif ?>
					</div>
	                <div class="mb-3">
	                    <label for="proxy" class="form-label"><?php _e('Proxy')?></label>
	                    <input type="text" class="form-control form-control-solid" id="proxy" name="proxy" value="<?php _e( get_data($result, "proxy") )?>">
	                    <span class="fs-12 text-gray-600"><?php _e("Proxy format username:password@ip:port OR ip:port")?></span>
	                </div>
	                <div class="mb-3">
	                    <label for="limit" class="form-label"><?php _e('Limit')?></label>
	                    <input type="text" class="form-control form-control-solid" id="limit" name="limit" value="<?php _e( get_data($result, "limit") )?>">
	                </div>
	            </div>

	            <div class="card-footer">
	                <button type="submit" class="btn btn-primary"><?php _e('Save')?></button>
	            </div>
	        </div>
	    </div>

	</div>
</form>