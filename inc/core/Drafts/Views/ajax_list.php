<?php foreach ($result as $key => $value): ?>

    <?php
    $data = json_decode($value->data);
    ?>
    <div class="card item mb-4 b-r-10">

        <?php if ($value->status == 1){ ?>
            <div class="ribbon ribbon-triangle ribbon-top-start border-primary rounded">
                <div class="ribbon-icon mn-t-22 mn-l-22">
                    <i class="fs-20 fas fa-circle-notch fa-spin fs-2 text-white"></i>
                </div>
            </div>

            <div class="border-primary border-top-dashed border-1"></div>
        <?php }else if($value->status == 3){ ?>
            <div class="ribbon ribbon-triangle ribbon-top-start border-success rounded">
                <div class="ribbon-icon mn-t-22 mn-l-22">
                    <i class="fs-20 fad fa-check-double fs-2 text-white"></i>
                </div>
            </div>

            <div class="border-success border-top-dashed border-1"></div>
        <?php }else if($value->status == 4){ ?>
            <div class="ribbon ribbon-triangle ribbon-top-start border-danger rounded">
                <div class="ribbon-icon mn-t-22 mn-l-22">
                    <i class="fs-20 fad fa-exclamation-circle fs-2 text-white"></i>
                </div>
            </div>

            <div class="border-danger border-top-dashed border-1"></div>
        <?php } ?>
        
        <div class="card-header px-4 border-0">
            
            <div class="card-title fw-normal fs-12">
                
                <div class="d-flex flex-stack">
                    <div class="symbol symbol-45px me-3">
                        <img src="<?php _ec( get_file_url($value->avatar) )?>" class="align-self-center rounded-circle border" alt="">
                    </div>
                    <div class="d-flex align-items-center flex-row-fluid flex-wrap">
                        <div class="flex-grow-1 me-2 text-over-all">
                            <a href="https://fb.com/771770400635067" class="text-gray-800 text-hover-primary fs-14 fw-bold"><i class="<?php _ec( $value->icon )?>" style="color: <?php _ec( $value->color )?>;"></i> <?php _ec( $value->name )?></a>
                            <span class="text-muted fw-semibold d-block fs-12"><i class="fal fa-calendar-alt"></i> <?php _ec( $value->username )?></span>
                        </div>
                    </div>
                </div>

            </div>

            <div class="card-toolbar">
                <a href="<?php _ec( base_url("post?post_id=".$value->ids) )?>" class="btn btn-sm px-3 btn-light-primary me-2">
                    <i class="fal fa-edit fs-14 pe-0"></i>
                </a>
                <a href="<?php _ec( get_module_url("delete") )?>" class="btn btn-sm px-3 btn-light-danger actionItem" data-remove="item" data-id="<?php _ec($value->ids)?>" data-confirm="<?php _e("Are you sure to delete this items?")?>">
                    <i class="fal fa-trash-alt fs-14 pe-0"></i>
                </a>
            </div>

        </div>

        <div class="card-body p-20">
            
            <div class="d-flex">
                <div class="symbol symbol-100px me-3 overflow-hidden w-99 border rounded">

                    <?php if($value->type == "media"){?>
                        <?php if (!empty($data->medias)): ?>
                        <div class="owl-carousel owl-theme">
                            <?php foreach ($data->medias as $index => $media): ?>
                                
                                <?php if ( is_image($media) ): ?>
                                    <div class="item w-100 h-99" style="background-image: url('<?php _ec( get_file_url($media) )?>');"></div>
                                <?php else: ?>
                                    <div class="item w-100 h-99">
                                        <video  autoplay muted>
                                            <source src="<?php _ec( get_file_url($media) )?>" type="video/mp4">
                                        </video>
                                    </div>
                                <?php endif ?>

                            <?php endforeach ?>
                        </div>
                        <?php endif ?>

                    <?php }elseif($value->type == "link"){?>
                        <a href="<?php _ec( $data->link )?>" target="_blank" class="d-flex align-items-center justify-content-center w-99 h-99 fs-30 bg-light-primary"><i class="fal fa-link"></i></a>
                    <?php }else{?>
                        <div class="d-flex align-items-center justify-content-center w-99 h-99 fs-30 text-primary bg-light-primary"><i class="fal fa-align-center"></i></div>
                    <?php }?>

                </div>
                <div class="d-flex flex-row-fluid flex-wrap">
                    <div class="flex-grow-1 me-2">
                        <span class="text-gray-600 d-block h-99 overflow-auto">
                            <?php _ec( nl2br($data->caption) )?>
                        </span>
                    </div>
                </div>
            </div>

        </div>

        <?php if ( $value->status == 3 ): ?>

            <?php  $data = json_decode($value->result); ?>

            <div class="card-footer bg-light-success text-success py-3 px-4 d-flex justify-content-between">
                <span class="me-2"><?php _e("Post successed")?></span> <a href="<?php _e( $data->url )?>" class="text-dark text-hover-primary" target="_blank"><i class="fad fa-eye"></i> <?php _e("View post")?></a>
            </div>
        <?php endif ?>

        <?php if ( $value->status == 4 ): ?>

            <?php  $error = json_decode($value->result); ?>

            <div class="card-footer bg-light-danger text-danger py-3 px-4">
                <?php _e($error->message)?>
            </div>
        <?php endif ?>

        
    </div>

<?php endforeach ?>

<script type="text/javascript">
    $(function(){
        Layout.carousel();
    });
</script>