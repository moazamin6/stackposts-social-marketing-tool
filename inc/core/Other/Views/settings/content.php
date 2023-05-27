<div class="container my-5">
    <div class="card mb-4 d-none">
        <div class="card-header mt-6">
            <div class="card-title flex-column">
                <h3 class="fw-bolder"><?php _e( $config['name'] )?></h3>
            </div>
        </div>
        <div class="card-body">
            
            <div class="mb-4">
                <label for="website_keyword" class="form-label"><?php _e('Redirect HTTP to HTTPS automatically')?></label>
                <div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="http_to_https_status" <?php _ec( get_option("http_to_https_status", 0)==1?"checked='true'":"" )?> id="http_to_https_status_enable" value="1">
                        <label class="form-check-label" for="http_to_https_status_enable"><?php _e('Enable')?></label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="http_to_https_status" <?php _ec( get_option("http_to_https_status", 0)==0?"checked='true'":"" )?> id="http_to_https_status_disable" value="0">
                        <label class="form-check-label" for="http_to_https_status_disable"><?php _e('Disable')?></label>
                    </div>
                </div>
            </div>
            <div class="alert alert-danger">
                <span class="fw-6"><?php _e("Important:")?></span>
                <span><?php _e('This feature may cause the website to stop functioning. Therefore, make sure that SSL has been installed on this domain.')?></span>
            </div>
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-header mt-6">
            <div class="card-title flex-column">
                <h3 class="fw-bolder"><?php _e("GDPR Cookie Consent")?></h3>
            </div>
        </div>
        <div class="card-body">
            <div class="mb-4">
                <label for="website_keyword" class="form-label"><?php _e('Status')?></label>
                <div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="gdpr_status" <?php _ec( get_option("gdpr_status", 1)==1?"checked='true'":"" )?> id="gdpr_status_enable" value="1">
                        <label class="form-check-label" for="gdpr_status_enable"><?php _e('Enable')?></label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="gdpr_status" <?php _ec( get_option("gdpr_status", 1)==0?"checked='true'":"" )?> id="gdpr_status_disable" value="0">
                        <label class="form-check-label" for="gdpr_status_disable"><?php _e('Disable')?></label>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-header mt-6">
            <div class="card-title flex-column">
                <h3 class="fw-bolder"><?php _e("Embed code")?></h3>
            </div>
        </div>
        <div class="card-body">
            <div class="mb-4">
                <label for="website_keyword" class="form-label"><?php _e('Status')?></label>
                <div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="embed_code_status" <?php _ec( get_option("embed_code_status", 0)==1?"checked='true'":"" )?> id="embed_code_status_enable" value="1">
                        <label class="form-check-label" for="embed_code_status_enable"><?php _e('Enable')?></label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="embed_code_status" <?php _ec( get_option("embed_code_status", 0)==0?"checked='true'":"" )?> id="gdpr_status_disable" value="0">
                        <label class="form-check-label" for="gdpr_status_disable"><?php _e('Disable')?></label>
                    </div>
                </div>
            </div>

            <div class="mb-4">
                <textarea class="code-editor h-400 w-100" name="embed_code" rows="4"><?php _ec( get_option("embed_code", "") )?></textarea>
            </div>
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-header mt-6">
            <div class="card-title flex-column">
                <h3 class="fw-bolder"><?php _e("Terms of Use")?></h3>
            </div>
        </div>
        <div class="card-body">
            <div class="mb-4">
                <textarea class="mh-600 w-100 terms_of_use" name="terms_of_use" rows="4"><?php _ec( get_option("terms_of_use", "") )?></textarea>
            </div>
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-header mt-6">
            <div class="card-title flex-column">
                <h3 class="fw-bolder"><?php _e("Privacy Policy")?></h3>
            </div>
        </div>
        <div class="card-body">
            <div class="mb-4">
                <textarea class="mh-600 w-100 privacy_policy" name="privacy_policy" rows="4"><?php _ec( get_option("privacy_policy", "") )?></textarea>
            </div>
        </div>
    </div>
        
    <div class="m-t-25">
        <button type="submit" class="btn btn-primary"><?php _e('Save')?></button>
    </div>
</div>

<script type="text/javascript">
$(function(){
    Core.ckeditor("terms_of_use");
    Core.ckeditor("privacy_policy");
});
</script>