<label class="form-label"><?php _e("File picker")?></label>
<div class="mb-3">
    <label for="file_manager_google_drive" class="form-label"> 
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="checkbox" name="permissions[file_manager_google_drive]" id="file_manager_google_drive" value="1" <?php _e( plan_permission('checkbox', "file_manager_google_drive") == 1?"checked":"" )?>>
            <label class="form-check-label" for="file_manager_google_drive"><?php _e("Google Drive")?></label>
        </div>
    </label>

    <label for="file_manager_dropbox" class="form-label"> 
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="checkbox" name="permissions[file_manager_dropbox]" id="file_manager_dropbox" value="1" <?php _e( plan_permission('checkbox', "file_manager_dropbox") == 1?"checked":"" )?>>
            <label class="form-check-label" for="file_manager_dropbox"><?php _e("Dropbox")?></label>
        </div>
    </label>

    <label for="file_manager_onedrive" class="form-label"> 
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="checkbox" name="permissions[file_manager_onedrive]" id="file_manager_onedrive" value="1" <?php _e( plan_permission('checkbox', "file_manager_onedrive") == 1?"checked":"" )?>>
            <label class="form-check-label" for="file_manager_onedrive"><?php _e("OneDrive")?></label>
        </div>
    </label>
</div>

<label class="form-label"><?php _e("File type")?></label>
<div class="mb-3">
    <label for="file_manager_photo" class="form-label"> 
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="checkbox" name="permissions[file_manager_photo]" id="file_manager_photo" value="1" <?php _e( plan_permission('checkbox', "file_manager_photo") == 1?"checked":"" )?>>
            <label class="form-check-label" for="file_manager_photo"><?php _e("Photo")?></label>
        </div>
    </label>

    <label for="file_manager_video" class="form-label"> 
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="checkbox" name="permissions[file_manager_video]" id="file_manager_video" value="1" <?php _e( plan_permission('checkbox', "file_manager_video") == 1?"checked":"" )?>>
            <label class="form-check-label" for="file_manager_video"><?php _e("Video")?></label>
        </div>
    </label>

    <label for="file_manager_other_type" class="form-label"> 
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="checkbox" name="permissions[file_manager_other_type]" id="file_manager_other_type" value="1" <?php _e( plan_permission('checkbox', "file_manager_other_type") == 1?"checked":"" )?>>
            <label class="form-check-label" for="file_manager_other_type"><?php _e("Other")?></label>
        </div>
    </label>
</div>

<label class="form-label"><?php _e("Image Editor")?></label>
<div class="mb-3">
    <label for="file_manager_image_editor" class="form-label"> 
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="checkbox" name="permissions[file_manager_image_editor]" id="file_manager_image_editor" value="1" <?php _e( plan_permission('checkbox', "file_manager_image_editor") == 1?"checked":"" )?>>
            <label class="form-check-label" for="file_manager_pimage_editor"><?php _e("Enable/Disable")?></label>
        </div>
    </label>
</div>

<div class="row">
	<div class="col-md-6">
		<div class="mb-3">
		    <label class="form-label" for="max_storage_size"><?php _e("Max. storage size (MB)")?></label>
		    <input type="number" class="form-control" id="max_storage_size" name="permissions[max_storage_size]" value="<?php _ec( (int)plan_permission('text', "max_storage_size") )?>">
		</div>
	</div>
	<div class="col-md-6">
		<div class="mb-3">
		    <label class="form-label" for="max_file_size"><?php _e("Max. file size (MB)")?></label>
		    <input type="number" class="form-control" id="max_file_size" name="permissions[max_file_size]" value="<?php _ec( (int)plan_permission('text', "max_file_size") )?>">
		</div>
	</div>
</div>