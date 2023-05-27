<form class="actionForm" action="<?php _e( get_module_url("save/".get_data($result, "ids")) )?>" data-redirect="<?php _ec( get_module_url() )?>" method="POST">
	<div class="container my-5">
	    <div class="mw-750">
	        <div class="card card-flush">
	            <div class="card-header mt-6">
	                <div class="card-title w-100 m-r-0">
	                	<div class="d-flex">
	                    	<h3 class="fw-bolder"><i class="fad fa-file-import text-primary"></i> <?php _e('Import proxies')?></h3>
	                	</div>
	                	<div class="d-flex ms-auto">

	                		<a href="<?php _e( get_module_url('index/list') )?>" class="btn btn-light-primary actionItem" data-remove-other-active="true" data-active="bg-light-primary" data-result="html" data-content="main-wrapper" data-history="<?php _e( get_module_url('index/list') )?>">
		                    	<i class="fad fa-chevron-left"></i> <?php _e('Back')?>
		                    </a>
	                	</div>
	                </div>
	            </div>
	            <div class="card-body">
	                <label class="form-label"><?php _e("Select plans")?></label>
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
	            	<button type="button" class="btn btn-success btn-block fileinput-button w-100">
                        <i class="fad fa-upload"></i> <?php _e("Upload CSV")?>
                        <input id="import_proxy" type="file" name="files[]" multiple="" data-action="<?php _ec( get_module_url("do_import_proxy") )?>" data-redirect="<?php _ec( get_module_url() )?>">
                    </button>

	            	<a href="<?php _ec( get_module_url("download_example_upload_csv") )?>" class="btn btn-secondary w-100 mt-3">
	            		<i class="fad fa-window-alt"></i> <?php _e("Example template")?>
	            	</a>

	            </div>

	        </div>
	    </div>

	</div>
</form>

<script type="text/javascript">
	$(function(){
		Core.do_upload("import_proxy");
	});
</script>