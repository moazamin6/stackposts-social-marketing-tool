<div class="fm-selected-media fm-selected-mini" data-loading="false" data-result="html" data-select-multi="<?php _ec($select_multi)?>">
	<div class="fm-progress-bar bg-primary"></div>
	<div class="items clearfix"></div>
	<div class="drophere">
		<span class="d-flex align-items-center justify-content-center"><?php _e("Select media")?></span>
	</div>
	<ul class="fm-mini-option d-flex align-items-center">
		<li class="text-nowrap">
			<a href="javascript:void(0);" class="px-3 py-2 d-block btn text-gray-700 btn-active-light btnOpenFileManager" data-select-multi="<?php _ec($select_multi)?>" data-type="<?php _ec($type)?>" data-id=""><i class="fad fa-folder-open"></i> <span class="fs-12"><?php _e("File manager")?></span></a>
		</li>
		<li class="text-nowrap">
			<button type="button" class="px-3 py-2 d-block btn btn-active-light fileinput-button">
                <i class="fad fa-upload me-0 pe-0 text-gray-600 fs-14"></i>
                <input id="fileupload" type="file" name="files[]" multiple="">
            </button>
		</li>
		<?php if ( get_option("fm_google_dropbox_status", 0) && permission("file_manager_dropbox") ): ?>
		<li class="text-nowrap">
            <a href="javascript:void(0);" class="px-3 py-2 d-block btn btn-active-light dropbox-choose" title="<?php _e("Dropbox")?>" data-toggle="tooltip" data-placement="top">
                <i class="fab fa-dropbox p-r-0 text-gray-600 fs-14"></i>
            </a>
            <script type="text/javascript" src="https://www.dropbox.com/static/api/2/dropins.js" id="dropboxjs" data-app-key="<?php _ec( get_option("fm_dropbox_api_key", "") )?>"></script>
        </li>
        <?php endif ?>

        <?php if ( get_option("fm_google_drive_status", 0) && permission("file_manager_google_drive") ): ?>
    	<li class="text-nowrap">
            <a href="javascript:void(0)" class="px-3 py-2 d-block btn btn-active-light" onclick="handleAuthClick()" title="<?php _e("Google Drive")?>" data-toggle="tooltip" data-placement="top">
                <i class="fab fa-google-drive p-r-0 text-gray-600 fs-14"></i>
            </a>
            <?php echo view_cell('\Core\File_manager\Controllers\File_manager::google_drive') ?>
        </li>
        <?php endif ?>

        <?php if ( get_option("fm_google_onedrive_status", 0) && permission("file_manager_onedrive") ): ?>
        <li class="text-nowrap">
	        <a href="javascript:void(0)" class="px-3 py-2 d-block btn btn-active-light onedrive-choose" data-client-id="<?php _ec( get_option("fm_onedrive_api_key", "") )?>" title="<?php _e("OneDrive")?>" data-toggle="tooltip" data-placement="top">
	            <i class="icon icon-onedrive fs-18 p-r-0 text-gray-600 fs-14"></i>
	        </a>
	        <script type="text/javascript" src="https://js.live.net/v7.2/OneDrive.js"></script>
        </li>
        <?php endif ?>

        <?php if ( get_option("fm_adobe_status", 0) || ( get_option("openai_status", 0) && permission("openai_image") && permission("openai") ) ): ?>
    	<li class="text-nowrap">
	        <div class="dropdown dropdown-hide-arrow" data-dropdown-spacing="37">
	            <a href="javascript:void(0);" class="dropdown-toggle d-block position-relative" data-toggle="dropdown" aria-expanded="true">
	                <i class="px-3 py-2 d-block btn btn-active-light fad fa-th-large text-gray-600"  data-toggle="tooltip" data-placement="top" data-bs-original-title="<?php _e("Advanced options")?>" ></i>
	            </a>
	            <div class="dropdown-menu dropdown-menu-right" >
	        		<?php echo view_cell('\Core\Openai\Controllers\Openai::image_widget') ?>
                	<?php echo view_cell('\Core\File_manager\Controllers\File_manager::adobe') ?>
	            </div>
	        </div>
    	</li>
        <?php endif ?>
	</ul>
</div>