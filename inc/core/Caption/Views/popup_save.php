<div class="modal fade" id="saveCaptionModal" tabindex="-1" role="dialog">
  	<div class="modal-dialog modal-dialog-centered">
	    <div class="modal-content">
      		<div class="modal-header">
		        <h5 class="modal-title"><?php _ec("Save caption")?></h5>
		         <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
	      	</div>
	      	<div class="modal-body">
	        	<form class="actionForm" action="<?php _ec( get_module_url("save") ) ?>" data-call-success="Caption.closeSaveModal();" method="POST">
	        		<div class="mb-3">
	                    <input type="text" class="form-control form-control-solid" id="caption_title" name="caption_title" placeholder="<?php _e("Enter caption title")?>" value="">
	                </div>

	                <textarea name="caption_content" class="d-none"></textarea>

	                <div class="d-flex justify-content-end">
		        		<button type="submit" class="btn btn-primary"><?php _e("Save")?></button>
	                </div>
	        	</form>
	      	</div>
	    </div>
  	</div>
</div>