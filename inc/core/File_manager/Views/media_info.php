<?php
$detect = detect_file_type( $result->extension );
$file_url = get_file_url( $result->file );
$detect_icon = detect_file_icon($detect);
    $text = $detect_icon['text'];
    $icon = $detect_icon['icon'];
?>

<div class="offcanvas offcanvas-end p-20" tabindex="-1" id="offcanvasMediaInfo">
    <div class="offcanvas-header">
        <h4 id="offcanvasRightLabel" class="text-primary"><?php _e("Media info")?></h4>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body n-scroll">
        <div class="row mb-3">
            <div class="col">
                <?php if($result->is_image){?>
                    <img class="w-100 border b-r-6" src="<?php _e( get_file_url($result->file) )?>">
                <?php }else{?>
                    <div class="card">
                        <div class="card-body">
                            <p class="card-text text-center text-<?php _e( $text )?> fs-90">
                                <i class="<?php _e( $icon )?>"></i>
                            </p>
                        </div>
                    </div>
                <?php }?>
            </div>
        </div>

        <table class="table m-b-0">
            <tbody>
                <tr>
                    <th class="fw-6">File name</th>
                    <td><?php _e( $result->name )?></td>
                </tr>
                <tr>
                    <th class="fw-6">Upload date</th>
                    <td><?php _e( datetime_show($result->created) )?></td>
                </tr>
                <?php if($result->is_image){?>
                <tr>
                    <th class="fw-6">Dimensions</th>
                    <td><?php _e( $result->width . "x" . $result->height )?></td>
                </tr>
                <?php }?>
                <tr>
                    <th class="fw-6">File size</th>
                    <td><?php _e( format_bytes($result->size) )?></td>
                </tr>
                <tr>
                    <th class="fw-6">File type</th>
                    <td><?php _e( $result->extension )?></td>
                </tr>
                <tr class="border-none">
                    <th class="fw-6">Caption</th>
                    <td>
                        <form class="actionForm" action="<?php _e( get_module_url("save_caption/".$result->ids) )?>" data-loading="false" method="POST">
                            <div class="mb-3">
                                <textarea class="form-control form-control-solid" name="caption"><?php _e( $result->note )?></textarea>
                            </div>
                            <div class="text-end">
                                <button class="btn btn-primary btn-sm"><?php _e("Save")?></button>
                            </div>
                        </form>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>