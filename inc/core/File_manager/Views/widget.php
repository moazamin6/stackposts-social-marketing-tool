<div class="card border file-manager" data-select-multi="1">
	<div class="card-header p-r-20 p-l-20">
		<h3 class="card-title"><?php _e("Media")?></h3>
        <div class="card-toolbar">
        	<button type="button" class="btn btn-color-gray-500 btn-active-color-primary p-0 fileinput-button">
                <i class="far fa-desktop"></i>
                <input id="fileupload" type="file" name="files[]" multiple="">
            </button>
            <?php if ( get_option("fm_google_dropbox_status", 0) && permission("file_manager_dropbox") ): ?>
	            <a href="javascript:void(0);" class="btn btn-link btn-color-gray-500 btn-active-color-primary ms-2 text-muted dropbox-choose">
	                <i class="fab fa-dropbox p-r-0"></i>
	            </a>
	            <script type="text/javascript" src="https://www.dropbox.com/static/api/2/dropins.js" id="dropboxjs" data-app-key="<?php _ec( get_option("fm_dropbox_api_key", "") )?>"></script>
            <?php endif ?>
            <?php if ( get_option("fm_google_drive_status", 0) && permission("file_manager_google_drive") ): ?>
	            <a href="javascript:void(0)" class="btn btn-link btn-color-gray-500 btn-active-color-primary ms-2 text-muted" onclick="handleAuthClick()">
	                <i class="fab fa-google-drive p-r-0"></i>
	            </a>
	            <?php echo view_cell('\Core\File_manager\Controllers\File_manager::google_drive') ?>
	        <?php endif ?>
	        <?php if ( get_option("fm_google_onedrive_status", 0) && permission("file_manager_onedrive") ): ?>
            <a href="javascript:void(0)" class="btn btn-link btn-color-gray-500 btn-active-color-primary ms-2 text-muted onedrive-choose" data-client-id="<?php _ec( get_option("fm_onedrive_api_key", "") )?>">
                <i class="icon icon-onedrive fs-23 p-r-0"></i>
            </a>
            <script type="text/javascript" src="https://js.live.net/v7.2/OneDrive.js"></script>
            <?php endif ?>

            <?php if ( get_option("fm_adobe_status", 0) || ( get_option("openai_status", 0) && permission("openai_image") && permission("openai") ) ): ?>
            <div class="dropdown dropdown-hide-arrow ms-2" data-dropdown-spacing="25">
	            <a href="javascript:void(0);" class="dropdown-toggle d-block position-relative" data-toggle="dropdown" aria-expanded="true">
	                <i class="fad fa-th-large p-r-0 text-gray-500 text-active-color-primary fs-18"  data-toggle="tooltip" data-placement="top" data-bs-original-title="<?php _e("Advanced options")?>" ></i>
	            </a>
	            <div class="dropdown-menu dropdown-menu-right" >
            		<?php echo view_cell('\Core\Openai\Controllers\Openai::image_widget') ?>
                	<?php echo view_cell('\Core\File_manager\Controllers\File_manager::adobe', ["button" => true]) ?>
	            </div>
	        </div>
	        <?php endif ?>

	        <div class="ps-3 d-lg-none d-md-none d-sm-block d-xs-block d-block">
        		<button type="button" class="btn btn-sm btn-light-danger btn-close-filemanager w-35 h-35 b-r-40 d-flex justify-content-center align-items-center"><i class="fad fa-times pe-0"></i></button>
			</div>
        </div>
	</div>
	<div class="card-body p-0 fm-widget bg-light" data-loading="false" data-result="html" data-result="fm-selected-media .items" data-select-multi="1">
		<div class="fm-content flex-grow-1">
			<div class="fm-progress-bar bg-primary"></div>
			<div class="input-group mb-2 d-none">
                <input type="text" class="form-control ajax-filter fs-12 fw-4 fm-input-folder" name="folder">
                <input type="hidden" class="ajax-filter fm-input-filter" name="filter" value="image,video">
            </div>
			<div class="fm-list row px-2 py-4 ajax-load-scroll m-l-0 m-r-0 align-content-start" style="height: 669px;" data-url="<?php _e( base_url("file_manager/load_files/widget") )?>" data-scroll="ajax-load-scroll" data-call-after="File_manager.lazy(); File_manager.checkSelected();">
				<div class="fm-empty text-center fs-90 text-muted h-100 d-flex flex-column align-items-center justify-content-center">
					<img class="mh-190 mb-4" alt="" src="<?php _e( get_theme_url() ) ?>Assets/img/empty2.png">
				</div>
			</div>
			<div class="ajax-loading text-center bg-primary"></div>
		</div>
	</div>
</div>