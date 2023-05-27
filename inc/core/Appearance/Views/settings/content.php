<?php
$sidebar_type = get_option("sidebar_type", "sidebar-small");
$theme_color = get_option("theme_color", "light");
$sidebar_icon_color = get_option("sidebar_icon_color", 0);
?>

<div class="container my-5">
    <div class="card">
        <div class="card-header mt-6">
            <div class="card-title flex-column">
                <h3 class="fw-bolder"><i class="text-success <?php _e( $config['icon'] )?>"></i> <?php _e( "Backend configure" )?></h3>
            </div>
        </div>
        <div class="card-body">
            <div class="mb-4">
                <label for="sidebar_type" class="form-label"><?php _e('Sidebar type')?></label>
                <div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="sidebar_type" <?php _e( $sidebar_type=='sidebar-close'?"checked='true'":"" )?> id="sidebar_type_close" value="sidebar-close">
                        <label class="form-check-label" for="sidebar_type_close"><?php _e('Close')?></label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="sidebar_type" <?php _e( $sidebar_type=='sidebar-open'?"checked='true'":"" )?> id="sidebar_type_open" value="sidebar-open">
                        <label class="form-check-label" for="sidebar_type_open"><?php _e('Open')?></label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="sidebar_type" <?php _e( $sidebar_type=='sidebar-small'?"checked='true'":"" )?> id="sidebar_type_hover" value="sidebar-small">
                        <label class="form-check-label" for="sidebar_type_hover"><?php _e('Hover')?></label>
                    </div>
                </div>
            </div>
            <div class="mb-4">
                <label for="theme_color" class="form-label"><?php _e('Theme color')?></label>
                <div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="theme_color" <?php _e( $theme_color=='light'?"checked='true'":"" )?> id="theme_color_light" value="light">
                        <label class="form-check-label" for="theme_color_light"><?php _e('Full light')?></label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="theme_color" <?php _e( $theme_color=='sidebar-dark'?"checked='true'":"" )?> id="theme_color_sidebar_dark" value="sidebar-dark">
                        <label class="form-check-label" for="theme_color_sidebar_dark"><?php _e('Sidebar dark')?></label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="theme_color" <?php _e( $theme_color=='sidebar-light'?"checked='true'":"" )?> id="theme_color_sidebar_light" value="sidebar-light">
                        <label class="form-check-label" for="theme_color_sidebar_light"><?php _e('Sidebar & header light')?></label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="theme_color" <?php _e( $theme_color=='dark'?"checked='true'":"" )?> id="theme_color_dark" value="dark">
                        <label class="form-check-label" for="theme_color_dark"><?php _e('Full dark')?></label>
                    </div>
                </div>
            </div>

            <div class="mb-4">
                <label for="sidebar_icon_color" class="form-label"><?php _e('Sidebar icon color')?></label>
                <div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="sidebar_icon_color" <?php _e( $sidebar_icon_color==0?"checked='true'":"" )?> id="sidebar_icon_color_default" value="0">
                        <label class="form-check-label" for="sidebar_icon_color_default"><?php _e('Default')?></label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="sidebar_icon_color" <?php _e( $sidebar_icon_color==1?"checked='true'":"" )?> id="sidebar_icon_color_custom" value="1">
                        <label class="form-check-label" for="sidebar_icon_color_custom"><?php _e('Custom color')?></label>
                    </div>
                </div>
            </div>

            <div class="mb-4">
                <label for="site_icon_color" class="form-label"><?php _e('Custom color')?></label>
                <input type="text" class="form-control form-control-solid input-color" id="site_icon_color" name="site_icon_color" value="<?php _ec( get_option("site_icon_color", "#006dff") )?>">
            </div>
        </div>
    </div>
        
    <div class="m-t-25">
        <div class="card">
            <div class="card-header mt-6">
                <div class="card-title flex-column">
                    <h3 class="fw-bolder"><i class="text-success <?php _e( $config['icon'] )?>"></i> <?php _e('Frontend themes')?></h3>
                </div>
            </div>
            <div class="card-body">
                
                <div class="row">
                    
                    <?php foreach ($frontend_tempaltes as $key => $value): ?>
                    <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
                        <div class="card b-r-6 border ">
                    
                            <div class="card-body p-0 overflow-hidden b-r-6 rounded-bottom-0">
                                <img src="<?php _ec( get_frontend_dir().$value['id']."/".$value['thumbnail'] )?>" class="w-100 p-0">
                            </div>

                            <div class="card-footer d-flex justify-content-between align-items-center px-3 py-3">
                                <div class="text-gray-800"><?php _e( $value['name'] )?></div>
                                <?php if ( get_option("frontend_template", "Stackgo") == $value['id'] ): ?>
                                    <button type="button" class="btn btn-primary btn-sm btn-success btn-disable"><?php _e("Activated")?></button>  
                                <?php else: ?>
                                    <a href="<?php _ec( get_module_url("set_frontend/".$value['id']) )?>" data-id="<?php _ec($value['id'])?>" class="btn btn-primary btn-sm actionItem"><?php _e("Activate")?></a>
                                <?php endif ?>
                            </div>
                        </div>
                    </div>
                    <?php endforeach ?>

                </div>

            </div>
        </div>
    </div>

    <div class="m-t-25">
        <button type="submit" class="btn btn-primary"><?php _e('Save')?></button>
    </div>
</div>

<script type="text/javascript">
    $(function(){
        Core.input_color();
    });
</script>