<div class="container my-5">
    <div class="card mb-4">
        <div class="card-header mt-6">
            <div class="card-title flex-column">
                <h3 class="fw-bolder"><i class="<?php _ec( $config['icon'] )?>" style="color: <?php _ec( $config['color'] )?>;"></i> <?php _e( "Bitly" )?></h3>
            </div>
        </div>
        <div class="card-body">
            <div class="alert alert-dismissible bg-light-primary border border-primary border-dashed d-flex flex-column flex-sm-row w-100 p-25 mb-10">
                <span class="fs-30 me-4 mb-5 mb-sm-0 text-primary">
                    <i class="fad fa-link"></i>
                </span>
                <div class="d-flex flex-column pe-0 pe-sm-10">
                    <h5 class="mb-1"><?php _e("Callback URL:")?></h5>
                    <span class="m-b-0"><a href="<?php _ec( base_url("shortlink/bitly") )?>" target="_blank"><?php _ec( base_url("shortlink/bitly") )?></a></span>

                    <h5 class="mb-1 mt-3"><?php _e("Click this link to create Bitly app:")?></h5>
                    <span class="m-b-0"><a href="https://app.bitly.com/settings/api/oauth/" target="_blank">https://app.bitly.com/settings/api/oauth/</a></span>
                </div>
            </div>
            <div class="mb-4">
                <label class="form-label"><?php _e("Status")?></label>
                <div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="shortlink_bitly_status" <?php _e( get_option("shortlink_bitly_status", 0)==1?"checked='true'":"" )?> id="shortlink_bitly_status_enable" value="1">
                        <label class="form-check-label" for="shortlink_bitly_status_enable"><?php _e('Enable')?></label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="shortlink_bitly_status" <?php _e( get_option("shortlink_bitly_status", 0)==0?"checked='true'":"" )?> id="shortlink_bitly_status_disable" value="0">
                        <label class="form-check-label" for="shortlink_bitly_status_disable"><?php _e('Disable')?></label>
                    </div>
                </div>
            </div>
            <div class="mb-4">
                <label for="shortlink_bitly_client_id" class="form-label"><?php _e('Client id')?></label>
                <input type="text" class="form-control form-control-solid" id="shortlink_bitly_client_id" name="shortlink_bitly_client_id" value="<?php _ec( get_option("shortlink_bitly_client_id", "") )?>">
            </div>
            <div class="mb-4">
                <label for="shortlink_bitly_client_secret" class="form-label"><?php _e('Client secret')?></label>
                <input type="text" class="form-control form-control-solid" id="shortlink_bitly_client_secret" name="shortlink_bitly_client_secret" value="<?php _ec( get_option("shortlink_bitly_client_secret", "") )?>">
            </div>
        </div>
    </div>

    <div class="m-t-25">
        <button type="submit" class="btn btn-primary"><?php _e('Save')?></button>
    </div>
</div>