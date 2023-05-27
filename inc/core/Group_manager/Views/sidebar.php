<div class="sub-sidebar bg-white d-flex flex-column flex-row-auto">
    <div class="d-flex mb-10 p-20">
        <div class="d-flex align-items-center w-lg-400px">
            <form class="w-100 position-relative ">
                <div class="input-group sp-input-group">
                  <span class="input-group-text bg-light border-0 fs-20 bg-gray-100 text-gray-800" id="sub-menu-search"><i class="fad fa-search"></i></span>
                  <input type="text" class="form-control form-control-solid ps-15 bg-light border-0 search-input" data-search="group-item" name="search" value="" placeholder="<?php _e("Search")?>" autocomplete="off">
                </div>
            </form>
        </div>
    </div>

    <div class="d-flex mb-10 p-l-20 p-r-20 m-b-12">
        <h2 class="text-gray-800 fw-bold text-over"><?php _e( $title )?></h2>
    </div>

    <div class="sp-menu n-scroll sp-menu-two menu menu-column menu-fit menu-rounded menu-title-gray-600 menu-icon-gray-400 menu-state-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-500 p-l-20 p-r-20 m-b-12 fw-5 h-100">
        <?php if ( !empty($result) ): ?>

            <?php foreach ($result as $key => $value): ?>
                
                <?php 
                $data = json_decode($value->data);
                ?>

                <div class="sp-menu-item plan-item mb-1 group-item">
                    <a 
                        class="sp-menu-item d-flex align-items-center px-2 py-2 rounded bg-hover-light-primary actionItem <?php _ec( uri('segment', 4 )==$value->ids?'active bg-light-primary':'' )?>" 
                        data-active="bg-light-primary" 
                        href="<?php _ec( get_module_url("index/update/" . $value->ids) )?>" 
                        data-remove-other-active="true" 
                        data-result="html" 
                        data-content="main-wrapper" 
                        data-history="<?php _ec( get_module_url("index/update/" . $value->ids) )?>" 
                    >
                        <div class="d-flex mb-10 me-auto w-drop align-items-center">
                            <div class="d-flex align-items-center mb-10 ">
                                <div class="w-40 h-40 m-r-10">
                                    <div class="border rounded h-40 bg-white fs-18 d-flex align-items-center justify-content-center text-primary b-r-10"><i class="fad fa-users"></i></div>
                                </div>
                            </div>
                            <div class="d-flex flex-column flex-grow-1 text-over">
                                <h5 class="custom-list-title fw-bold text-gray-800 mb-1 fs-14 text-over"><?php _ec( get_data($value, "name") )?></h5>
                                <span class="text-gray-400 fs-12 text-over"><?php _ec( sprintf("%s accounts", count($data)) )?></span>
                            </div>
                        </div>

                    </a>

                    <div class="sp-menu-dropdown dropdown dropdown-hide-arrow" data-dropdown-spacing="0">
                        <a class="dropdown-toggle text-gray-800" href="javascript:void(0);" data-bs-toggle="dropdown">
                            <i class="fal fa-ellipsis-v"></i>
                        </a>

                        <ul class="dropdown-menu"  data-dropdown-spacing="0">
                            <li>
                                <a class="dropdown-item actionItem" href="<?php _ec( get_module_url('delete') )?>" data-id="<?php _ec( $value->ids )?>" data-confirm="<?php _e('Are you sure to delete this items?')?>" data-remove="sp-menu-item"><i class="fad fa-trash text-danger"></i> <?php _e('Delete')?></a>
                            </li>
                        </ul>
                    </div>
                </div>

            <?php endforeach ?>

        <?php else: ?>
            <div class="d-flex flex-column justify-content-center align-items-center text-gray-500 h-100 mih-300">
                <img class="mh-190 mb-4" alt="" src="<?php _e( get_theme_url() ) ?>Assets/img/empty2.png">
               <div>
                    <a class="btn btn-primary btn-sm b-r-30" href="<?php _e( get_module_url("index/update") )?>" >
                        <i class="fad fa-plus"></i> <?php _ec("Add new")?>
                    </a>
                </div>
            </div>
        <?php endif ?>
        
    </div>
</div>