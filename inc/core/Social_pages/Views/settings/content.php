<div class="container my-5">
    <div class="card card-flush">
        <div class="card-header mt-6">
            <div class="card-title flex-column">
                <h3 class="fw-bolder"><i class="<?php _ec( $config['icon'] )?>" style="color: <?php _ec( $config['color'] )?>;"></i> <?php _e( $config['name'] )?></h3>
            </div>
        </div>
        <div class="card-body">
            <div class="mb-4">
                <label for="social_page_facebook" class="form-label"><?php _e('Facebook')?></label>
                <input type="text" class="form-control form-control-solid" id="social_page_facebook" name="social_page_facebook" value="<?php _ec( get_option("social_page_facebook", "") )?>">
            </div>
            <div class="mb-4">
                <label for="social_page_instagram" class="form-label"><?php _e('Instagram')?></label>
                <input type="text" class="form-control form-control-solid" id="social_page_instagram" name="social_page_instagram" value="<?php _ec( get_option("social_page_instagram", "") )?>">
            </div>
            <div class="mb-4">
                <label for="social_page_youtube" class="form-label"><?php _e('Youtube')?></label>
                <input type="text" class="form-control form-control-solid" id="social_page_youtube" name="social_page_youtube" value="<?php _ec( get_option("social_page_youtube", "") )?>">
            </div>
            <div class="mb-4">
                <label for="social_page_tiktok" class="form-label"><?php _e('Tiktok')?></label>
                <input type="text" class="form-control form-control-solid" id="social_page_tiktok" name="social_page_tiktok" value="<?php _ec( get_option("social_page_tiktok", "") )?>">
            </div>
            <div class="mb-4">
                <label for="social_page_twitter" class="form-label"><?php _e('Twitter')?></label>
                <input type="text" class="form-control form-control-solid" id="social_page_twitter" name="social_page_twitter" value="<?php _ec( get_option("social_page_twitter", "") )?>">
            </div>
            <div class="mb-4">
                <label for="social_page_pinterest" class="form-label"><?php _e('Pinterest')?></label>
                <input type="text" class="form-control form-control-solid" id="social_page_pinterest" name="social_page_pinterest" value="<?php _ec( get_option("social_page_pinterest", "") )?>">
            </div>
        </div>
    </div>
        
    <div class="m-t-25">
        <button type="submit" class="btn btn-primary"><?php _e('Save')?></button>
    </div>
</div>