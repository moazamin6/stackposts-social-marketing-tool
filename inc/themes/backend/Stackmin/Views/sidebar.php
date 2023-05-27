<div class="sidebar-wrapper">
    <div class="sidebar d-flex flex-column align-items-lg-center flex-row-auto h-100">
        <div class="sidebar-logo d-flex flex-column align-items-center flex-column-auto py-3">
            <a href="<?php _ec( base_url("dashboard") )?>">
                <img alt="Logo" src="<?php _ec( get_option("website_logo_color", base_url("assets/img/logo-color.svg")) )?>" class="logo-big h-39">
                <img alt="Logo" src="<?php _ec( get_option("website_logo_mark", base_url("assets/img/logo.svg")) )?>" class="logo-small h-39">

            </a>
        </div>

        <div class="sidebar-nav sidebar-nav-one d-flex flex-column flex-column-fluid w-100 pt-lg-0 hide-x-scroll">
            <ul class="nav flex-column">
                <?php 
                $request = \Config\Services::request();
                $top_sidebar = $request->top_sidebar; 
                ?>

                <?php foreach ($top_sidebar as $key => $menus): ?>

                    <?php foreach ($menus as $key => $row): ?>
                        
                        <?php if( ! isset( $row['sub_menu'] ) ){?>
                            <li class="nav-item mb-2">
                                <a href="<?php _e( base_url( $row['id'] ) )?>" class="nav-link d-flex p-t-12 p-b-12 <?php _e( uri('segment', 1) == $row['id']?'active text-primary bg-light':'hoverable' )?>" <?php _ec( ( get_option("sidebar_type", "sidebar-small") == "sidebar-close"  )?'title="'.$row['name'].'" data-toggle="tooltip" data-placement="right"':'' )?> >
                                    <i class="<?php _e( $row['icon'] )?> fs-20"  style="<?php _e( ( $row['color'] )?"color: ".$row['color']:"" )?>" ></i>
                                    <span class="text-gray-600 fw-5"><?php _e( $row['name'] )?></span>
                                </a>
                            </li>
                        <?php }else{?>

                            <?php 
                                $ids = [];
                                foreach ($row['sub_menu'] as $sub){
                                    $ids[] = get_data($sub, 'id');
                                }
                            ?>

                            <li class="nav-item mb-2 have-menus-sub">
                                <a href="javascript:void(0);" class="nav-link d-flex hoverable p-t-12 p-b-12 <?php _e( in_array( uri('segment', 1), $ids, true )?'active bg-light':'' )?>">
                                    <i class="<?php _e( $row['icon'] )?> fs-20"  style="<?php _e( ( $row['color'] )?"color: ".$row['color']:"" )?>" ></i>
                                    <span class="text-gray-600 fw-5"><?php _e( $row['name'] )?></span>
                                </a>

                                <div class="menu-sub menu-sub-accordion mt-3">
                                    <?php foreach ($row['sub_menu'] as $sub): ?>
                                    <div class="menu-item ">
                                        <a class="menu-link py-2 <?php _e( (uri('segment', 1) == get_data($sub, 'id'))?'text-primary':'text-gray-900 text-hover-primary' )?>" href="<?php _e( base_url( get_data($sub, 'id') ) )?>">
                                            <span class="menu-desc"><?php _e( get_data($sub, 'name') )?></span>
                                        </a>
                                    </div>
                                    <?php endforeach ?>
                                </div>
                            </li>
                        <?php }?>

                    <?php endforeach ?>
                    <li class="nav-item mb-2">
                        <div class="nav-line bg-light m-b-10 m-t-10"></div>
                    </li>
                <?php endforeach ?>
            </ul>

        </div>

        <div class="sidebar-footer d-flex flex-column-fluid mt-auto w-100 hide-x-scroll">
            <div class="nav flex-column overflow-hidden w-100">
            <?php 
                $bottom_sidebar = $request->bottom_sidebar; 
                ?>

                <?php foreach ($bottom_sidebar as $key => $menus): ?>

                    <?php foreach ($menus as $key => $row): ?>
                        
                        <?php if( ! isset( $row['sub_menu'] ) ){?>
                            <div class="nav-item mb-2">
                                <a href="<?php _e( base_url( $row['id'] ) )?>" class="nav-link d-flex p-t-12 p-b-12 <?php _e( uri('segment', 1) == $row['id']?'active text-primary bg-light':'hoverable' )?>" <?php _ec( ( get_option("sidebar_type", "sidebar-small") == "sidebar-close"  )?'title="'.$row['name'].'" data-toggle="tooltip" data-placement="right"':'' )?>>
                                    <i class="<?php _e( $row['icon'] )?> fs-20" style="<?php _e( ( $row['color'] )?"color: ".$row['color']:"" )?>"></i>
                                    <span class="text-gray-600 fw-5"><?php _e( $row['name'] )?></span>
                                </a>
                            </div>
                        <?php }else{?>

                            <?php 
                                $ids = [];
                                foreach ($row['sub_menu'] as $sub){
                                    $ids[] = get_data($sub, 'id');
                                }
                            ?>

                            <li class="nav-item mb-2 have-menus-sub">
                                <a href="javascript:void(0);" class="nav-link d-flex hoverable p-t-12 p-b-12 <?php _e( in_array( uri('segment', 1), $ids, true )?'active text-primary bg-light':'' )?>">
                                    <i class="<?php _e( $row['icon'] )?> fs-20"  style="<?php _e( ( $row['color'] )?"color: ".$row['color']:"" )?>" ></i>
                                    <span class="text-gray-600 fw-5"><?php _e( $row['name'] )?></span>
                                </a>

                                <div class="menu-sub menu-sub-accordion mt-3">
                                    <?php foreach ($row['sub_menu'] as $sub): ?>
                                    <div class="menu-item ">
                                        <a class="menu-link py-2 <?php _e( uri('segment', 1) == get_data($sub, 'id')?'text-primary':'text-hover-primary' )?>" href="<?php _e( base_url( get_data($sub, 'id') ) )?>">
                                            <span class="menu-desc"><?php _e( get_data($sub, 'name') )?></span>
                                        </a>
                                    </div>
                                    <?php endforeach ?>
                                </div>
                            </li>

                        <?php }?>

                    <?php endforeach ?>
                    <div class="menu-separator"></div>
                <?php endforeach ?>
            </div>
        </div>

        <!-- <a href="javascript:void(0);" class="sidebar-toggle">
            <div class="btn btn-sm btn-icon btn-white btn-active-primary position-absolute translate-middle start-100 end-0 bottom-0 shadow-sm d-none d-lg-flex">
                <i class="fad fa-chevron-right"></i>
            </div>
        </a> -->
    </div>
</div>
<!--end::Sidebar-->