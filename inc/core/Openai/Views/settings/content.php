<div class="container my-5">
    <div class="card card-flush mb-4">
        <div class="card-header mt-6">
            <div class="card-title flex-column">
                <h3 class="fw-bolder d-flex justify-content-center align-items-center"><i class="<?php _ec( $config['icon'] )?> me-2" style="color: <?php _ec( $config['color'] )?>;"></i>  <?php _e( $config['name'] )?></h3>
            </div>
        </div>
        <div class="card-body">
            <div class="alert alert-primary">
                <span class="fw-6"><?php _e("Get OpenAI access token at here:")?></span> 
                <a href="https://platform.openai.com/account/api-keys" target="_blank">https://platform.openai.com/account/api-keys</a> 
                <br/>
            </div>
            <div class="mb-4">
                <label for="openai_status" class="form-label"><?php _e('Status')?></label>
                <div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="openai_status" <?php _e( get_option("openai_status", 0)==1?"checked='true'":"" )?> id="openai_status_enable" value="1">
                        <label class="form-check-label" for="openai_status_enable"><?php _e('Enable')?></label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="openai_status" <?php _e( get_option("openai_status", 0)==0?"checked='true'":"" )?> id="openai_status_disable" value="0">
                        <label class="form-check-label" for="openai_status_disable"><?php _e('Disable')?></label>
                    </div>
                </div>
            </div>
            <div class="mb-4">
                <label for="openai_api_key" class="form-label"><?php _e('Open AI API keys')?></label>
                <input type="text" class="form-control form-control-solid" id="openai_api_key" name="openai_api_key" value="<?php _ec( get_option("openai_api_key", "") )?>">
            </div>
        </div>
    </div>

    <div class="m-t-25">
        <button type="submit" class="btn btn-primary"><?php _e('Save')?></button>
    </div>
</div>