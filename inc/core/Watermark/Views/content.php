<div class="container watermark my-5">
    <div class="card m-b-25 m-auto">
            <div class="card-header">
                <div class="card-title flex-column">
                    <h3 class="fw-bolder"><i class="<?php _ec($config['menu']['icon']) ?>"></i> <?php _e($title)?></h3>
                </div>
            </div>
            <div class="card-body">

                <div class="watermark-content row">
                    <div class="watermark-option">
                        <div class="row">
                            <div class="col-md-5 col-sm-5 m-b-25">
                                <input type="text" name="ids" class="d-none watermark-ids" value="<?php _e($result->ids) ?>">
                                <div class="watermark-image">
                                    <img class="watermark-bg" src="<?php _e( get_module_path( __DIR__, "Assets/img/bg-watermark.jpg" ) )?>" >
                                    <?php if( $result->watermark_mask != ""){?>
                                        <img class="watermark-mask d-none" src="<?php _e( get_file_url($result->watermark_mask) )?>">
                                    <?php }else{?>
                                        <img class="watermark-mask d-none" src="<?php _e( get_module_path( __DIR__, "Assets/img/watermark.png" ) )?>">
                                    <?php }?>
                                </div>
                            </div>
                            <div class="col-md-7 col-sm-7 m-b-25">
                                <div class="form-group m-b-25">
                                    <span><?php _e("Position")?></span>
                                    <div class="watermark-positions">
                                        <div class="watermark-position-item pos-lt <?php _e( $result->watermark_position=="lt"?"active":"" )?>" data-direction="lt"></div>
                                        <div class="watermark-position-item pos-ct <?php _e( $result->watermark_position=="ct"?"active":"" )?>" data-direction="ct"></div>
                                        <div class="watermark-position-item pos-rt <?php _e( $result->watermark_position=="rt"?"active":"" )?>" data-direction="rt"></div>
                                        <div class="watermark-position-item pos-lc <?php _e( $result->watermark_position=="lc"?"active":"" )?>" data-direction="lc"></div>
                                        <div class="watermark-position-item pos-cc <?php _e( $result->watermark_position=="cc"?"active":"" )?>" data-direction="cc"></div>
                                        <div class="watermark-position-item pos-rc <?php _e( $result->watermark_position=="rc"?"active":"" )?>" data-direction="rc"></div>
                                        <div class="watermark-position-item pos-lb <?php _e( $result->watermark_position=="lb"?"active":"" )?>" data-direction="lb"></div>
                                        <div class="watermark-position-item pos-cb <?php _e( $result->watermark_position=="cb"?"active":"" )?>" data-direction="cb"></div>
                                        <div class="watermark-position-item pos-rb <?php _e( $result->watermark_position=="rb"?"active":"" )?>" data-direction="rb"></div>
                                        <input type="hidden" class="watermark-position form-control" name="position" value="<?php _e( $result->watermark_position)?>">
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="form-group m-b-25">
                                    <span><?php _e("Size")?></span>
                                    <input type="range" name="size" class="rangeslider d-none watermark-size" min="0" max="100" step="1" value="<?php _e($result->watermark_size) ?>" data-rangeslider data-orientation="vertical" >
                                </div>
                                <div class="form-group m-b-25">
                                    <span><?php _e("Transparent")?></span>
                                    <input type="range" name="opacity" class="rangeslider d-none watermark-transparent" min="0" max="100" step="1" value="<?php _e($result->watermark_opacity)?>" data-orientation="vertical" >
                                </div> 

                                <div class="d-flex justify-content-between">
                                    <div class="btn-group" role="group">
                                        <button type="button" class="btn btn-light-primary fileinput-button">
                                            <i class="fad fa-upload"></i> <?php _e('Upload')?>
                                            <input id="watermake-upload" type="file" name="files[]">
                                        </button>
                                        <a href="<?php _e( get_module_url("delete") )?>" data-confirm="Are you sure to delete this items?" data-id="<?php _e( $result->ids )?>" class="btn btn-light-danger actionItem" data-redirect=""><i class="fad fa-trash-alt"></i> <?php _e("Delete")?></a>
                                    </div>
                                    <button type="submit" class="btn btn-primary btnUploadWatermark"> <?php _e("Save")?></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>