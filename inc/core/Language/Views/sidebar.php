<div class="sub-sidebar bg-white d-flex flex-column flex-row-auto">
    <div class="d-flex mb-10 p-20">
        <div class="d-flex align-items-center w-lg-400px">
            <form class="w-100 position-relative ">
                <div class="input-group sp-input-group">
                  <span class="input-group-text bg-light border-0 fs-20 bg-gray-100 text-gray-800" id="sub-menu-search"><i class="fad fa-search"></i></span>
                  <input type="text" class="form-control form-control-solid ps-15 bg-light border-0 search-input" data-search="search" name="search" value="" placeholder="<?php _e("Search")?>" autocomplete="off">
                </div>
            </form>
        </div>
    </div>

    <div class="d-flex mb-10 p-l-20 p-r-20 m-b-12">
        <h2 class="text-gray-800 fw-bold"><?php _e( $title )?></h2>
    </div>

    <div class="sp-menu n-scroll sp-menu-two menu menu-column menu-state-bg menu-rounded menu-title-gray-600 menu-icon-gray-400 menu-state-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-500 p-l-20 p-r-20 m-b-12 fw-5 h-100">
        
        <?php if(!empty($result) ){?>

        <?php foreach ($result as $key => $value): ?>
            <div class="sp-menu-item search">
                <div class="menu-item m-b-2 d-flex justify-content-between align-items-center">
                    <a class="menu-link sp-menu-item actionItem bg-hover-light-primary <?php _e( uri('segment', 4) == $value->ids?"bg-light-primary":"" )?>" data-active="bg-light-primary" data-remove-other-active="true" data-active="active" href="<?php _e( get_module_url("index/update/".$value->ids) ) ?>" data-result="html" data-content="main-wrapper" data-history="<?php _e( get_module_url("index/update/".$value->ids) ) ?>">
                        <span class="menu-icon">
                            <i class="text-primary fs-20 <?php _ec( $value->icon )?>"></i>
                        </span>
                        <span class="menu-title text-gray-800"><?php _e( $value->name )?></span>
                    </a>
                </div>
                <div class="sp-menu-dropdown dropdown dropdown-hide-arrow" data-dropdown-spacing="0">
                    <a class="dropdown-toggle text-gray-800" href="javascript:void(0);" data-bs-toggle="dropdown">
                        <i class="fal fa-ellipsis-v"></i>
                    </a>

                    <ul class="dropdown-menu" data-dropdown-spacing="0">
                        <li>
                            <a class="dropdown-item actionItem" href="<?php _ec( get_module_url("index/translate/".$value->code) )?>" data-result="html" data-content="main-wrapper" data-history="<?php _e( get_module_url("index/translate/".$value->code) ) ?>"><i class="fad fa-sync-alt text-success"></i> <?php _e("Translate")?></a>
                        </li>
                        <li>
                            <a class="dropdown-item actionItem" href="<?php _ec( get_module_url("delete") )?>" data-id="<?php _ec( $value->ids )?>" data-confirm="<?php _e("Are you sure to delete this items?")?>" data-remove="sp-menu-item"><i class="fad fa-trash text-danger"></i> <?php _e("Delete")?></a>
                        </li>
                    </ul>
                </div>
            </div>
        <?php endforeach ?>

        <?php }?>

    </div>
</div>