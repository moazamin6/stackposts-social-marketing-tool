<form class="actionForm" action="<?php _ec( get_module_url("save") )?>" method="POST">
    <div class="container d-flex align-items-md-center justify-content-between pt-5  mw-800">
        <div class="bd-search position-relative me-auto">
            <h1><i class="<?php _ec( $config['icon'] )?>" style="color: <?php _ec( $config['color'] )?>;" ></i> <?php _e( $config['name'] )?></h1>
            <span><?php _e( $config['desc'] )?></span>
        </div>
    </div>

    <div class="py-5 container mw-800">

        <div class="card b-r-10">
            <div class="card-body">
                <div class="mb-3">
                    <label class="form-label"><?php _e("Select accounts")?></label>
                    <?php echo view_cell('\Core\Account_manager\Controllers\Account_manager::widget', []) ?>
                </div>

                <div class="mb-0">
                    <label class="form-label"><?php _e("Media CSV file")?></label>
                    <?php echo view_cell('\Core\File_manager\Controllers\File_manager::mini', ["type" => "csv", "select_multi" => 0]) ?>
                </div>

                <label class="form-label"><?php _e("Advance options")?></label>
                <div class="card border b-r-6">
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label fs-12"><?php _e("URL Shortener")?></label>
                            <div class="border b-r-6">
                                <?php echo view_cell('\Core\Shortlink\Controllers\Shortlink::widget') ?>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fs-12"><?php _e("Interval per post (minute)")?></label>
                            <input type="number" class="form-control form-control-sm" autocomplete="off" name="delay" value="<?php _e( get_team_data("bulk_delay", 60) )?>">
                        </div>
                        <div class="alert alert-warning fs-12"><?php _e("If your posts are scheduled for an incorrect time or empty, the system will automatically set the first post with the current time and the next posts follow an interval delay per post")?></div>
                    </div>
                </div>
                
            </div>
            <div class="card-footer">
                <div class="d-flex justify-content-between">
                    <a href="<?php _ec( get_module_url("download_bulk_template_csv") )?>" class="btn btn-light btn-hover-scale"><i class="fad fa-window"></i> <?php _e("Bulk Template")?></a>
                    <button type="submit" class="btn btn-primary btn-hover-scale"><i class="fad fa-mail-bulk"></i> <?php _e("Submit")?></button>
                </div>
            </div>
        </div>

        <div class="card mb-5 tab-bulk tab-bulk-preview " data-active="1">

        </div>

    </div>
</form>