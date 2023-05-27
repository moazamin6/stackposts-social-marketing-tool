<div class="modal fade" id="OpenAIImageModal" tabindex="-1" role="dialog">
  	<div class="modal-dialog modal-dialog-centered">
	    <div class="modal-content">
        	<form class="actionForm OpenAIGenerate" action="<?php _ec( get_module_url("generate_image") ) ?>" method="POST" data-call-success="OpenAI.saveImage(result);">
	      		<div class="modal-header">
			        <h5 class="modal-title d-flex justify-content-center align-items-center"><i class="<?php _ec( $config['icon'] )?> me-2" style="color: <?php _ec( $config['color'] )?>;" style="color: <?php _ec( $config['color'] )?>"></i> <?php _ec("AI Generate Image")?></h5>
			         <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
		      	</div>
		      	<div class="modal-body shadow-none">
	        		<div class="mb-3">
            			<label class="form-label"><?php _e("Suggestion")?></label>
	                    <input type="text" class="form-control form-control-solid" id="suggestion" name="suggestion" value="">
	                </div>
	                <div class="mb-3">
            			<label class="form-label"><?php _e("Size")?></label>
	                    <select class="form-select" name="size">
	                    	<option value="256x256">256x256</option>
	                    	<option value="512x512">512x512</option>
	                    	<option value="1024x1024">1024x1024</option>
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