<div class="submenu-right fm-submenu d-flex flex-column flex-row-auto p-20 bg-white n-scroll">
    <div class="fm-options">
        <div class="mb-4">
            <div class="btn-group btn-group-sm w-100" role="group" aria-label="Basic example">
                <button type="button" class="btn btn-light fm-select-all">
                    <span class="fm-btn-select-all"><i class="fad fa-check-double"></i> <?php _e("Select all")?></span>
                    <span class="fm-btn-deselect-all"><i class="fad fa-times"></i> <?php _e("Deselect All ")?></span>
                </button>
                <button type="button" class="btn btn-danger w-30 fm-delete-all"><i class="fad fa-trash-alt me-0 pe-0"></i></button>
            </div>
        </div>
        <div class="mb-4">
            <button class="btn btn-light-primary btn-sm w-100 fm-open-new-folder mb-2">
                <i class="fad fa-plus"></i> <?php _e("New folder")?>
            </button>
            <div class="fm-box-new-folder">
                <div class="input-group mb-3">
                    <input type="text" class="form-control fs-12 fm-input-new-folder" name="create_new_folder" placeholder="Enter folder name" >
                    <button type="button" class="btn btn-primary fs-12 p-r-10 p-l-12 fm-btn-new-folder">
                        <i class="fad fa-arrow-right"></i>
                    </button>
                </div>
            </div>
        </div>
        <div class="mb-4">
            <h3 class="mb-3 text-gray-800 fs-16"><i class="fad fa-upload text-primary"></i> <?php _e("Upload")?></h3>     
            
            <div class="fm-box-upload mb-2 rounded p-5 text-center bg-light-dark">
                
                <div class="fm-upload-dd p-10 rounded">
                    
                    <div class="fm-upload-area">
                        
                        <div class="icon fs-40 text-primary">
                            <i class="fad fa-cloud-upload"></i>
                        </div>
                        <div class="text-gray-500">
                            <?php _e("Drag & Drop files here")?>
                        </div>

                        <div class="py-2 text-gray-500">
                            <?php _e("Or")?>
                        </div>

                        <div class="text">
                            <button type="button" class="btn btn-primary btn-sm fileinput-button">
                                <?php _e("Browser Files")?>
                                <input id="fileupload" type="file" name="files[]" multiple="">
                            </button>
                        </div>

                        <div class="fm-upload-area-overplay">
                            <div class="d-flex align-items-center justify-content-center text-white fw-6 fs-40 h-100">
                                <?php _e("Drop files to upload")?>
                            </div>
                        </div>

                    </div>

                </div>

            </div>

            <div class="row px-2">
                <?php if ( get_option("fm_google_dropbox_status", 0) && permission("file_manager_dropbox") ): ?>
                    <div class="col px-1 mb-2">
                        <button class="btn btn-light btn-sm w-100 dropbox-choose"><i class="fab fa-dropbox p-r-0"></i></button>
                    </div>
                    <script type="text/javascript" src="https://www.dropbox.com/static/api/2/dropins.js" id="dropboxjs" data-app-key="<?php _ec( get_option("fm_dropbox_api_key", "") )?>"></script>
                <?php endif ?>
                
                <?php if ( get_option("fm_google_drive_status", 0) && permission("file_manager_google_drive") ): ?>
                <div class="col px-1 mb-2">
                    <button class="btn btn-light btn-sm w-100 google-drive-choose" onclick="handleAuthClick()"><i class="fab fa-google-drive p-r-0"></i></button>
                    <?php echo view_cell('\Core\File_manager\Controllers\File_manager::google_drive') ?>
                </div>
                <?php endif ?>
                <?php if ( get_option("fm_google_onedrive_status", 0) && permission("file_manager_onedrive") ): ?>
                <div class="col px-1 mb-2">
                    <button class="btn btn-light btn-sm w-100 onedrive-choose" data-client-id="<?php _ec( get_option("fm_onedrive_api_key", "") )?>"><i class="icon icon-onedrive fs-20 p-r-0"></i></button>
                    <script type="text/javascript" src="https://js.live.net/v7.2/OneDrive.js"></script>
                </div>
                <?php endif ?>
                <?php if ( get_option("fm_allow_upload_via_url", 0) ): ?>
                <div class="col-md-12 px-1 mb-2">
                    <button class="btn btn-light btn-sm w-100 fm-open-upload-by-url"><i class="fad fa-link"></i> <?php _e("Upload by url")?></button>
                </div>
                <?php endif ?>
            </div>

            <div class="fm-box-upload-by-url">
                <div class="input-group mb-3">
                    <input type="text" class="form-control fs-12 fm-input-upload-by-url" name="upload_by_url" placeholder="Enter file url" >
                    <button type="button" class="btn btn-primary fs-12 p-r-10 p-l-12 fm-btn-upload-by-url">
                        <i class="fad fa-download"></i>
                    </button>
                </div>
            </div>
        </div>

        <?php if ( get_option("fm_adobe_status", 0) ): ?>
        <div class="mb-4">
            <h3 class="mb-3 text-gray-800 fs-16"><i class="fad fa-palette p-r-0 text-success"></i> <?php _e("Image editor")?></h3>

            <a class="btn btn-light w-100 btn-sm ccEverywhere" href="javascript:void(0)"><img src="<?php _ec( get_module_path( __DIR__, "Assets/img/adobe.png") )?>" class="w-17 h-17"> <?php _e("Adobe Express")?></a>
            <?php echo view_cell('\Core\File_manager\Controllers\File_manager::adobe') ?>
        </div>
        <?php endif?>

        <div class="mb-4">
            <h3 class="mb-3 text-gray-800 fs-16"><i class="fad fa-filter"></i> <?php _e("Filter")?></h3>     
            
            <div class="input-group mb-2">
                <span class="input-group-text bg-white px-3">
                    <i class="fad fa-search"></i>
                </span>
                <input type="text" class="form-control ajax-filter fm-input-search fs-12 fw-4" name="keyword" placeholder="<?php _e("Enter keyword")?>">
            </div>

            <div class="input-group mb-2 d-none">
                <input type="text" class="form-control ajax-filter fs-12 fw-4 fm-input-folder" name="folder">
            </div>

            <div class="form-group">
                <label class="fs-12"><?php _e("Media Type")?></label>

                <div class="input-group">
                    <span class="input-group-text bg-white px-3">
                        <i class="fad fa-filter"></i>
                    </span>
                    <select class="form-control fs-12 fw-4 ajax-filter fm-input-filter" name="filter">
                        <option value=""><?php _e("All Media")?></option>
                        <option value="image"><?php _e("Image")?></option>
                        <option value="video"><?php _e("Video")?></option>
                        <option value="pdf"><?php _e("Pdf")?></option>
                        <option value="doc"><?php _e("Document")?></option>
                        <option value="mp3"><?php _e("Audio")?></option>
                        <option value="zip"><?php _e("Zip")?></option>
                        <option value="other"><?php _e("Other")?></option>
                    </select>
                </div>
            </div>
        </div>
    </div>

    <div class="fm-storage mb-3">
        <h3 class="mb-3 text-gray-800 fs-16"><i class="fad fa-info-circle text-warning"></i> <?php _e("Media info")?></h3>     
        <div class="d-flex justify-content-between mb-2">
            <div>
                <div class="fw-6 fs-18 text-primary"><?php _e( format_bytes( $total_size ) )?></div>
                <div class="fs-12 text-gray-800"><?php _e("Used")?></div>
            </div>
            <div class="text-end text-gray-800">
                <div class="fw-6 fs-18 total"><?php _e( sprintf("%dMB", $max_storage) )?></div>
                <div class="fs-12"><?php _e("Total")?></div>
            </div>
        </div>
        <div class="progress h-5">
            <div class="progress-bar bg-primary" style="width:<?php _e( $media_info['image']['percent'] )?>%"></div>
            <div class="progress-bar bg-success" style="width:<?php _e( $media_info['video']['percent'] )?>%"></div>
            <div class="progress-bar bg-warning" style="width:<?php _e( $media_info['doc']['percent'] )?>%"></div>
            <div class="progress-bar bg-danger" style="width:<?php _e( $media_info['audio']['percent'] )?>%"></div>
            <div class="progress-bar bg-dark" style="width:<?php _e( $media_info['other']['percent'] )?>%"></div>
        </div>
    </div>
    <div class="fm-stats">
        <div class="d-flex align-items-center mb-3">
            <div>
                <div class="symbol symbol-45px me-2">
                    <span class="symbol-label bg-light-primary fs-20 text-primary">
                        <i class="fad fa-image-polaroid"></i>
                    </span>
                </div>
            </div>
            <div class="flex-fill text-gray-700">
                <div class="fw-6 fs-12"><?php _e("Images")?></div>
                <div class="fs-10 text-muted"><?php _e( sprintf("%d files", $media_info['image']['count'])  )?> </div>
            </div>
            <div class="flex-fill text-end fw-6 text-primary fs-12 text-gray-700"><?php _e( format_bytes( $media_info['image']['size'] ) )?></div>
        </div>

        <div class="d-flex align-items-center mb-3">
            <div>
                <div class="symbol symbol-45px me-2">
                    <span class="symbol-label bg-light-success fs-20 text-success">
                        <i class="fad fa-video"></i>
                    </span>
                </div>
            </div>
            <div class="flex-fill text-gray-700">
                <div class="fw-6 fs-12"><?php _e("Videos")?></div>
                <div class="fs-10 text-muted"><?php _e( sprintf("%d files", $media_info['video']['count'])  )?></div>
            </div>
            <div class="flex-fill text-end fw-6 text-primary fs-12 text-gray-700"><?php _e( format_bytes( $media_info['video']['size'] ) )?></div>
        </div>

        <div class="d-flex align-items-center mb-3">
            <div>
                <div class="symbol symbol-45px me-2">
                    <span class="symbol-label bg-light-primary fs-20 text-primary">
                        <i class="fad fa-file-music"></i>
                    </span>
                </div>
            </div>
            <div class="flex-fill text-gray-700">
                <div class="fw-6 fs-12"><?php _e("Audios")?></div>
                <div class="fs-10 text-muted"><?php _e( sprintf("%d files", $media_info['audio']['count'])  )?></div>
            </div>
            <div class="flex-fill text-end fw-6 text-primary fs-12 text-gray-700"><?php _e( format_bytes( $media_info['audio']['size'] ) )?></div>
        </div>

        <div class="d-flex align-items-center mb-3">
            <div>
                <div class="symbol symbol-45px me-2">
                    <span class="symbol-label bg-light-info fs-20 text-info">
                        <i class="fad fa-file-csv"></i>
                    </span>
                </div>
            </div>
            <div class="flex-fill text-gray-700">
                <div class="fw-6 fs-12"><?php _e("CSV")?></div>
                <div class="fs-10 text-muted"><?php _e( sprintf("%d files", $media_info['csv']['count'])  )?></div>
            </div>
            <div class="flex-fill text-end fw-6 text-info fs-12 text-gray-700"><?php _e( format_bytes( $media_info['csv']['size'] ) )?></div>
        </div>

        <div class="d-flex align-items-center mb-3">
            <div>
                <div class="symbol symbol-45px me-2">
                    <span class="symbol-label bg-light-danger fs-20 text-danger">
                        <i class="fad fa-file-pdf"></i>
                    </span>
                </div>
            </div>
            <div class="flex-fill text-gray-700">
                <div class="fw-6 fs-12"><?php _e("PDF")?></div>
                <div class="fs-10 text-muted"><?php _e( sprintf("%d files", $media_info['pdf']['count'])  )?></div>
            </div>
            <div class="flex-fill text-end fw-6 text-danger fs-12 text-gray-700"><?php _e( format_bytes( $media_info['pdf']['size'] ) )?></div>
        </div>

        <div class="d-flex align-items-center mb-3">
            <div>
                <div class="symbol symbol-45px me-2">
                    <span class="symbol-label bg-light-warning fs-20 text-warning">
                        <i class="fad fa-file-alt"></i>
                    </span>
                </div>
            </div>
            <div class="flex-fill text-gray-700">
                <div class="fw-6 fs-12"><?php _e("Documents")?></div>
                <div class="fs-10 text-muted"><?php _e( sprintf("%d files", $media_info['doc']['count'])  )?></div>
            </div>
            <div class="flex-fill text-end fw-6 text-warning fs-12 text-gray-700"><?php _e( format_bytes( $media_info['doc']['size'] ) )?></div>
        </div>

        <div class="d-flex align-items-center mb-3">
            <div>
                <div class="symbol symbol-45px me-2">
                    <span class="symbol-label fs-20">
                        <i class="fad fa-image-polaroid"></i>
                    </span>
                </div>
            </div>
            <div class="flex-fill text-gray-700">
                <div class="fw-6 fs-12"><?php _e("Others")?></div>
                <div class="fs-10 text-muted"><?php _e( sprintf("%d files", $media_info['other']['count'])  )?></div>
            </div>
            <div class="flex-fill text-end fw-6 text-dark fs-12 text-gray-700"><?php _e( format_bytes( $media_info['other']['size'] ) )?></div>
        </div>
    </div>
</div>