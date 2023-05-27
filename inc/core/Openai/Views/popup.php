<div class="modal fade" id="OpenAIModal" tabindex="-1" role="dialog">
  	<div class="modal-dialog modal-dialog-centered">
	    <div class="modal-content">
        	<form class="actionForm OpenAIGenerate" data-name="<?php _ec($name)?>" action="<?php _ec( get_module_url("generate") ) ?>" method="POST" data-call-success="OpenAI.saveContent(result);">
	      		<div class="modal-header">
			        <h5 class="modal-title d-flex justify-content-center align-items-center"><i class="<?php _ec( $config['icon'] )?> me-2" style="color: <?php _ec( $config['color'] )?>;"></i> <?php _ec("AI Generate Content")?></h5>
			         <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
		      	</div>
		      	<div class="modal-body shadow-none">
	        		<div class="mb-3">
            			<label class="form-label"><?php _e("Suggestion")?></label>
	                    <input type="text" class="form-control form-control-solid" id="suggestion" name="suggestion" value="">
	                </div>
            		<div class="mb-3">
            			<label class="form-label"><?php _e("Max Result Length")?></label>
	                    <input type="number" class="form-control form-control-solid" id="max_lenght" name="max_lenght" value="200">
	                </div>
	                <div class="mb-3">
                        <label class="form-label"><?php _e("Add hashtags")?></label>
	                    <select class="form-select" name="hashtags">
	                    	<option value="<?php _ec(0)?>"><?php _ec(0)?></option>
            				<?php for ($i=1; $i <= 50; $i++) { ?>
            					<option value="<?php _ec($i)?>"><?php _ec($i)?></option>
            				<?php }?>
            			</select>
                    </div>
		      	</div>
		      	<div class="modal-footer d-flex justify-content-end">
		      		<button type="submit" class="btn btn-primary"><?php _e("Generate")?></button>
		      	</div>
        	</form>
	    </div>
  	</div>
</div>