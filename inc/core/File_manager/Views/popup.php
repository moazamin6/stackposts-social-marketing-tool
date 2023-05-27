<div class="modal fade file-manager file-manager-modal" data-select-multi="<?php echo $select?>" id="file-manager" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-fullscreen-lg-down modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="file-manager"><?php _e("File manager")?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="input-group mb-2 d-none">
                    <input type="text" class="form-control ajax-filter fs-12 fw-4 fm-input-folder" name="folder">
                    <input type="hidden" class="ajax-filter fm-input-filter" name="filter" value="<?php echo $type?>">
                </div>
            </div>
            <div class="modal-body shadow-none n-scroll overflow-hidden bg-light-dark fm-list row px-2 py-4 ajax-load-scroll m-l-0 m-r-0 align-content-start" data-url="<?php _e( get_module_url("load_files/widget") )?>" data-scroll="ajax-load-scroll" data-call-after="File_manager.lazy();">
                <div class="mw-400 container d-flex align-items-center justify-content-center text-center mih-500">
                    <div>
                        <div class="text-center px-4">
                            <img class="mh-190 mb-4" alt="" src="<?php _e( get_theme_url() ) ?>Assets/img/empty2.png">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer d-flex justify-content-between">
                <button type="button" class="btn btn-dark" data-bs-dismiss="modal"><?php _e("Close")?></button>
                <button type="button" class="btn btn-primary btnAddFiles" data-transfer="<?php echo $id?>" data-bs-dismiss="modal"><?php _e("Done")?></button>
            </div>
        </div>
    </div>
</div>