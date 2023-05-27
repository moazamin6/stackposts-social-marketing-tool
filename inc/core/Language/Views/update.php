<div class="container my-4">
    <form class="actionForm" action="<?php _ec( get_module_url( "save/" . gd($item, "ids") ) )?>" method="POST" data-redirect="<?php _ec( get_module_url() )?>">
    <div class="card mb-5 mb-lg-10">
        <div class="card-header">
            <div class="card-title">
                <h2 class="fw-bolder"><i class="fad fa-pen-square text-primary"></i> <?php _e("Update")?></h2>
            </div>
        </div>
        <div class="card-body pt-0">
            
            <div class="row">
                <div class="col-md-12">
                    <div class="fv-row mb-3">
                        <label class="fw-bold form-label mt-3">
                            <span><?php _e("Status")?></span>
                        </label>
                        <div class="mb-10 d-flex">
                            <div class="me-4">
                                <input class="form-check-input me-1" name="status" id="status_on" type="radio" value="1" <?php _ec( gd($item, "status") == 1 || gd($item, "status") == ""?"checked":"" )?>>
                                <label for="status_on"><?php _e("Enable")?></label>
                            </div>
                            <div>
                                <input class="form-check-input me-1" name="status" id="status_off" type="radio" value="0" <?php _ec( gd($item, "status", "radio", 0) )?>>
                                <label for="status_off"><?php _e("Disable")?></label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="fv-row mb-3">
                        <label class="fw-bold form-label mt-3">
                            <span><?php _e("Default")?></span>
                        </label>
                        <div class="mb-10 d-flex">
                            <div class="me-4">
                                <input class="form-check-input me-1" name="is_default" id="is_default_on" type="radio" value="1" <?php _ec( gd($item, "is_default", "radio", 1) )?>>
                                <label for="is_default_on"><?php _e("Yes")?></label>
                            </div>
                            <div>
                                <input class="form-check-input me-1" name="is_default" id="is_default_off" type="radio" value="0" <?php _ec( gd($item, "is_default") == 0 || gd($item, "is_default") == ""?"checked":"" )?>>
                                <label for="is_default_off"><?php _e("No")?></label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="fv-row mb-3">
                        <label class="fw-bold form-label mt-3">
                            <span><?php _e("Text direction")?></span>
                        </label>
                        <div class="mb-10 d-flex">
                            <div class="me-4">
                                <input class="form-check-input me-1" name="dir" id="dir_ltr" type="radio" value="ltr" <?php _ec( gd($item, "status") == "ltr" || gd($item, "status") == ""?"checked":"" )?>>
                                <label for="dir_ltr"><?php _e("LTR")?></label>
                            </div>
                            <div>
                                <input class="form-check-input me-1" name="dir" id="dir_ltr" type="radio" value="rtl" <?php _ec( gd($item, "dir", "radio", "rtl") )?>>
                                <label for="dir_ltr"><?php _e("RTL")?></label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="fv-row mb-3">
                <label class="fw-bold form-label">
                    <span><?php _e("Name")?></span>
                </label>
                <input type="text" class="form-control form-control-solid" name="name" value="<?php _ec( gd($item, "name") )?>">
            </div>
            <div class="fv-row mb-3">
                <label class="fw-bold form-label">
                    <span><?php _e("Language")?></span>
                </label>
                <select class="form-control form-control-solid" name="code">
                    <option value=""><?php _e("Select language code")?></option>
                    <?php foreach ($language_codes as $key => $value): ?>
                        <option value="<?php _ec($key)?>" <?php _ec( gd($item, "code", "select", $key) )?> ><?php _ec($value)?></option>
                    <?php endforeach ?>
                </select>
            </div>
            <div class="fv-row mb-3">
                <label class="fw-bold form-label">
                    <span><?php _e("Flag")?></span>
                </label>
                <ul class="list-group n-scroll overflow-hidden" style="height: 300px;">
                    <?php $fileList = glob( get_theme_path('Assets/fonts/flags/flags/*') );
                    foreach($fileList as $filename){
                        $directory_list = explode("/", $filename);
                        $filename = end($directory_list);
                        $ext = explode(".", $filename);
                        if(count($ext) == 2 && $ext[1] == "svg"){
                            $icon = "flag-icon flag-icon-".$ext[0];
                    ?>
                        <li class="list-group-item px-4 py-3">
                            <input class="form-check-input me-1" type="radio" name="icon" value="<?php _e($icon)?>" <?php _ec($icon)?> <?php _ec( gd($item, "icon", "radio", $icon) )?>>
                            <span class="me-2 ms-2"><i class="<?php _e($icon)?>"></i> </span>
                            <?php _e( strtoupper($ext[0]) )?>
                        </li>
                    <?php
                        }
                    }?>
                </ul>
            </div>

            <div class="fv-row mb-3">
                <?php if(empty($item)){?>
                <div class="alert alert-primary" role="alert">
                    <div class="form-group">
                        <label for="code"><?php _e('Translate to')?></label>
                        <select name="translate" class="form-control">
                            <option><?php _e("Select language you want translate")?></option>
                            <?php 
                                $translate_code_list = translate_code_list();
                                foreach ($translate_code_list as $key => $value) {
                            ?>
                            <option value="<?php _e( $key )?>"><?php _e( $value )?></option>
                            <?php }?>
                        </select>
                        <span class="small"><?php _e("Automatically translate languages using Google Translate. Do not select if you do want to translate manually")?></span>
                    </div>
                </div>
                <?php }?>
            </div>

        </div>
        <div class="card-footer d-flex justify-content-between">
            <a href="<?php _ec( get_module_url() )?>" class="btn btn-secondary"><?php _e("Back")?></a>
            <button type="submit" class="btn btn-primary"><?php _e("Save")?></button>
        </div>
    </div>
    </form>
</div>