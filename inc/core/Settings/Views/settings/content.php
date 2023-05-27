<div class="container my-5">
    <div class="card card-flush">
        <div class="card-header mt-6">
            <div class="card-title flex-column">
                <h3 class="fw-bolder"><i class="text-success fad fa-browser"></i> <?php _e('Website info')?></h3>
            </div>
        </div>
        <div class="card-body">
            <div class="mb-4">
                <label for="website_title" class="form-label"><?php _e('Website title')?></label>
                <input type="text" class="form-control form-control-solid" id="website_title" name="website_title" value="<?php _ec( get_option("website_title", "#1 Social Media Management & Analysis Platform") )?>">
            </div>
            <div class="mb-4">
                <label for="website_description" class="form-label"><?php _e('Website description')?></label>
                <input type="text" class="form-control form-control-solid" id="website_description" name="website_description" value="<?php _ec( get_option("website_description", "Let start to manage your social media so that you have more time for your business.") )?>">
            </div>
            <div class="mb-4">
                <label for="website_keyword" class="form-label"><?php _e('Website keyword')?></label>
                <input type="text" class="form-control form-control-solid" id="website_keyword" name="website_keyword" value="<?php _ec( get_option("website_keyword", "social network, marketing, brands, businesses, agencies, individuals") )?>">
            </div>
            <div class="mb-4">
                <label for="website_favicon" class="form-label"><?php _e('Website favicon')?></label>
                <div class="input-group">
                    <input type="text" name="website_favicon" id="website_favicon" class="form-control form-control-solid" placeholder="<?php _e("Select file")?>" value="<?php _ec( get_option("website_favicon", base_url("assets/img/favicon.svg")) )?>">
                    <button type="button" class="btn btn-light-primary btnOpenFileManager" data-select-multi="0" data-type="image" data-id="website_favicon">
                        <i class="fad fa-folder-open p-r-0"></i>
                    </button>
                </div>
            </div>
            <div class="mb-4">
                <label for="website_mark" class="form-label"><?php _e('Website logo mark')?></label>
                <div class="input-group">
                    <input type="text" name="website_logo_mark" id="website_logo_mark" class="form-control form-control-solid" placeholder="<?php _e("Select file")?>" value="<?php _ec( get_option("website_logo_mark", base_url("assets/img/logo.svg")) )?>">
                    <button type="button" class="btn btn-light-primary btnOpenFileManager" data-select-multi="0" data-type="image" data-id="website_logo_mark">
                        <i class="fad fa-folder-open p-r-0"></i>
                    </button>
                </div>
            </div>
            <div class="mb-4">
                <label for="website_logo_color" class="form-label"><?php _e('Website logo color')?></label>
                <div class="input-group">
                    <input type="text" name="website_logo_color" id="website_logo_color" class="form-control form-control-solid" placeholder="<?php _e("Select file")?>" value="<?php _ec( get_option("website_logo_color", base_url("assets/img/logo-color.svg")) )?>">
                    <button type="button" class="btn btn-light-primary btnOpenFileManager" data-select-multi="0" data-type="image" data-id="website_logo_color">
                        <i class="fad fa-folder-open p-r-0"></i>
                    </button>
                </div>
            </div>
            <div class="mb-4">
                <label for="website_logo_light" class="form-label"><?php _e('Website logo light')?></label>
                <div class="input-group">
                    <input type="text" name="website_logo_light" id="website_logo_light" class="form-control form-control-solid" placeholder="<?php _e("Select file")?>" value="<?php _ec( get_option("website_logo_light", base_url("assets/img/logo-light.svg")) )?>">
                    <button type="button" class="btn btn-light-primary btnOpenFileManager" data-select-multi="0" data-type="image" data-id="website_logo_light">
                        <i class="fad fa-folder-open p-r-0"></i>
                    </button>
                </div>
            </div>
            <div class="mb-4">
                <label for="website_logo_black" class="form-label"><?php _e('Website logo black')?></label>
                <div class="input-group">
                    <input type="text" name="website_logo_black" id="website_logo_black" class="form-control form-control-solid" placeholder="<?php _e("Select file")?>" value="<?php _ec( get_option("website_logo_black", base_url("assets/img/logo-black.svg")) )?>">
                    <button type="button" class="btn btn-light-primary btnOpenFileManager" data-select-multi="0" data-type="image" data-id="website_logo_black">
                        <i class="fad fa-folder-open p-r-0"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
        
    <div class="m-t-25">
        <div class="card card-flush">
            <div class="card-header mt-6">
                <div class="card-title flex-column">
                    <h3 class="fw-bolder"><i class="text-success fad fa-calendar-alt"></i> <?php _e('Date and Time Formats')?></h3>
                </div>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <label for="date_format" class="form-label"><?php _e('Date')?></label>
                    <?php $format_date = get_option('format_date', 'd/m/Y'); ?>
                    <select class="form-control form-control-solid form-select" name="format_date">
                        <option class="d/m/Y" <?php _e( $format_date == 'd/m/Y'?'selected':'' )?> >d/m/Y</option>
                        <option class="d M, Y" <?php _e( $format_date == 'd M, Y'?'selected':'' )?> >d M, Y</option>
                        <option class="m/d/Y" <?php _e( $format_date == 'm/d/Y'?'selected':'' )?>>m/d/Y</option>
                        <option class="Y-m-d" <?php _e( $format_date == 'Y-m-d'?'selected':'' )?>>Y-m-d</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="datetime_format" class="form-label"><?php _e('Datetime')?></label>
                    <?php $format_datetime = get_option('format_datetime', 'd/m/Y g:i A'); ?>
                    <select class="form-control form-control-solid form-select" name="format_datetime">
                        <option class="d/m/Y g:i A" <?php _e( $format_datetime == 'd/m/Y g:i A'?'selected':'' )?>>d/m/Y g:i A</option>
                        <option class="m/d/Y g:i A" <?php _e( $format_datetime == 'm/d/Y g:i A'?'selected':'' )?>>m/d/Y g:i A</option>
                        <option class="d/m/Y H:i" <?php _e( $format_datetime == 'd/m/Y H:i'?'selected':'' )?>>d/m/Y H:i</option>
                        <option class="m/d/Y H:i" <?php _e( $format_datetime == 'm/d/Y H:i'?'selected':'' )?>>m/d/Y H:i</option>
                        <option class="Y-m-d g:i A" <?php _e( $format_datetime == 'Y-m-d g:i A'?'selected':'' )?>>Y-m-d g:i A</option>
                        <option class="Y-m-d H:i" <?php _e( $format_datetime == 'Y-m-d H:i'?'selected':'' )?>>Y-m-d H:i</option>
                    </select>
                </div>
            </div>
        </div>
    </div>

    <div class="m-t-25">
        <button type="submit" class="btn btn-primary"><?php _e('Save')?></button>
    </div>
</div>