<div class="container my-5">
	<form class="actionForm" action="<?php _ec( get_module_url("save/".uri("segment", 4)) )?>" method="POST" data-redirect="<?php _ec( get_module_url() )?>">
		<div class="card m-b-25 mw-800 m-auto">
		    <div class="card-header">
		        <div class="card-title flex-column">
		            <h3 class="fw-bolder"><i class="fad fa-edit"></i> <?php _e("Update")?></h3>
		        </div>
		    </div>
		    <div class="card-body">
        		<div class="mb-3">
		            <label for="title" class="form-label"><?php _e("Question")?></label>
		            <input type="text" class="form-control form-control-solid" id="title" name="title" value="<?php _ec( get_data($result, "title") )?>">
		        </div>
		        <div class="mb-3">
		            <label for="content" class="form-label"><?php _e("Answers")?></label>
		            <textarea class="form-control form-control-solid input-emoji" id="content" name="content"><?php _ec( get_data($result, "content") )?></textarea>
		        </div>
		    </div>
		    <div class="card-footer d-flex justify-content-between">
		    	<a href="<?php _ec( get_module_url() )?>" class="btn btn-secondary"><?php _e("Back")?></a>
		    	<button type="submit" class="btn btn-primary"><?php _e("Save")?></button>
		    </div>
		</div>
	</form>
</div>
