<label class="form-label"><?php _e("Features")?></label>
<div class="mb-3">
    <label for="openai_content" class="form-label"> 
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="checkbox" name="permissions[openai_content]" id="openai_content" value="1" <?php _e( plan_permission('checkbox', "openai_content") == 1?"checked":"" )?>>
            <label class="form-check-label" for="openai_content"><?php _e("Generate Content")?></label>
        </div>
    </label>

    <label for="openai_image" class="form-label"> 
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="checkbox" name="permissions[openai_image]" id="openai_image" value="1" <?php _e( plan_permission('checkbox', "openai_image") == 1?"checked":"" )?>>
            <label class="form-check-label" for="openai_image"><?php _e("Generate Image")?></label>
        </div>
    </label>
</div>

<div class="row">
	<div class="col-md-6">
		<div class="mb-3">
		    <label class="form-label" for="openai_limit_tokens"><?php _e("Limit tokens")?></label>
		    <input type="number" class="form-control" id="openai_limit_tokens" name="permissions[openai_limit_tokens]" value="<?php _ec( (int)plan_permission('text', "openai_limit_tokens") )?>">
		</div>
	</div>
</div>