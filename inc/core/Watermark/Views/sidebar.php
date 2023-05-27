<div class="sub-sidebar bg-white d-flex flex-column flex-row-auto">
    <div class="d-flex mb-10 p-20">
        <div class="d-flex align-items-center w-lg-400px">
            <form class="w-100 position-relative ">
                <div class="input-group sp-input-group">
                  <span class="input-group-text bg-light border-0 fs-20 bg-gray-100 text-gray-800" id="sub-menu-search"><i class="fad fa-search"></i></span>
                  <input type="text" class="form-control form-control-solid ps-15 bg-light border-0" name="search" value="" placeholder="<?php _e("Search")?>" autocomplete="off">
                </div>
            </form>
        </div>
    </div>

    <div class="d-flex mb-10 p-l-20 p-r-20 m-b-12">
        <h2 class="text-gray-800 fw-bold"><?php _e( $title )?></h2>
    </div>

    <div class="sp-menu n-scroll sp-menu-two menu menu-column menu-fit menu-rounded menu-title-gray-600 menu-icon-gray-400 menu-state-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-500 p-l-20 p-r-20 fw-5">

        <div class="sp-menu-item plan-item mb-2 group-item" data-active="bg-light-primary" >
            <a 
                class="sp-menu-item d-flex align-items-center px-2 py-2 rounded bg-hover-light-primary actionItem <?php _e( uri('segment', 3 )==""?'bg-light-primary':'' )?>" 
                data-active="bg-light-primary" 
                href="<?php _e( get_module_url() )?>" 
                data-remove-other-active="true" 
                data-result="html" 
                data-content="main-wrapper" 
                data-remove-other-active="true" data-active="bg-light-primary"
                data-history="<?php _e( get_module_url() )?>" 
                data-call-after="Watermark.range();"
            >
                <div class="d-flex mb-10 me-auto w-drop">
                    <div class="d-flex align-items-center mb-10 ">
                        <div class="w-40 h-40 m-r-10">
                            <div class="symbol symbol-40px p-r-10">
                                <span class="symbol-label border bg-white">
                                    <i class="fad fa-medal fs-18 text-primary"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex flex-column flex-grow-1 text-over justify-content-center">
                        <h5 class="custom-list-title fw-bold text-gray-800 mb-0 fs-14 text-over"><?php _ec("Default watermark")?></h5>
                        <span class="text-gray-700 fs-10 text-over"><?php _e("Set default watermark for all profiles")?></span>
                    </div>
                </div>

            </a>

            <div class="sp-menu-dropdown dropdown dropdown-hide-arrow" data-dropdown-spacing="0">
                <a class="dropdown-toggle text-gray-800" href="javascript:void(0);" data-bs-toggle="dropdown">
                    <i class="fal fa-ellipsis-v"></i>
                </a>

                <ul class="dropdown-menu"  data-dropdown-spacing="0">
                    <li>
                        <a class="dropdown-item actionItem" href="<?php _e( get_module_url('delete') )?>" data-id="" data-confirm="<?php _e('Are you sure to delete this items?')?>" data-remove="sp-menu-item"><i class="fad fa-trash text-danger"></i> <?php _e('Delete')?></a>
                    </li>
                </ul>
            </div>
        </div>

        <?php if ( !empty( $accounts ) ): ?>
            
            <?php foreach ($accounts as $key => $value): ?>
                
                <div class="sp-menu-item plan-item mb-2 group-item" data-active="bg-light-primary" >
                    <a 
                        class="sp-menu-item d-flex align-items-center px-2 py-2 rounded bg-hover-light-primary actionItem <?php _e( uri('segment', 3 )==$value->ids?'bg-light-primary':'' )?>" 
                        data-active="bg-light-primary" 
                        href="<?php _e( get_module_url("index/" . $value->ids) )?>" 
                        data-remove-other-active="true" 
                        data-result="html" 
                        data-content="main-wrapper" 
                        data-remove-other-active="true" data-active="bg-light-primary"
                        data-history="<?php _e( get_module_url("index/" . $value->ids) )?>" 
                        data-call-after="Watermark.range();"
                    >
                        <div class="d-flex mb-10 me-auto w-drop">
                            <div class="d-flex align-items-center mb-10 ">
                                <div class="w-40 h-40 m-r-10">
                                    <img src="<?php _ec( get_file_url($value->avatar) )?>" class="h-40 align-self-center rounded">
                                </div>
                            </div>
                            <div class="d-flex flex-column flex-grow-1 text-over">
                                <h5 class="custom-list-title fw-bold text-gray-800 mb-1 fs-14 text-over"><?php _ec( get_data($value, "name") )?></h5>
                                <span class="text-gray-400 fs-12 text-over"><?php _ec( ucfirst( get_data($value, "category") ) )?></span>
                            </div>
                        </div>

                    </a>

                    <div class="sp-menu-dropdown dropdown dropdown-hide-arrow" data-dropdown-spacing="0">
                        <a class="dropdown-toggle text-gray-800" href="javascript:void(0);" data-bs-toggle="dropdown">
                            <i class="fal fa-ellipsis-v"></i>
                        </a>

                        <ul class="dropdown-menu"  data-dropdown-spacing="0">
                            <li>
                                <a class="dropdown-item actionItem" href="<?php _e( get_module_url('delete') )?>" data-id="<?php _e( $value->ids )?>" data-confirm="<?php _e('Are you sure to delete this items?')?>" data-remove="sp-menu-item"><i class="fad fa-trash text-danger"></i> <?php _e('Delete')?></a>
                            </li>
                        </ul>
                    </div>
                </div>

            <?php endforeach ?>

        <?php endif ?>
        
    </div>
</div>