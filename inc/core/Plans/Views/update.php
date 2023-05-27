<form class="actionForm" action="<?php _ec( get_module_url("save/0/".get_data($item, "ids")) )?>" method="POST" data-redirect="<?php _ec( get_module_url() )?>">
    <div class="container my-5">
        <div class="d-flex w-100 m-r-0 align-items-center">
            <div class="d-flex">
                <h3 class="fw-bolder m-b-0 text-gray-800"><i class="fad fa-edit text-primary"></i> <?php _e('Update')?></h3>
            </div>
            <div class="d-flex ms-auto">
                <a href="<?php _e( get_module_url('index/list') )?>" class="btn btn-light-primary actionItem" data-remove-other-active="true" data-active="bg-light-primary" data-result="html" data-content="main-wrapper" data-history="<?php _e( get_module_url('index/list') )?>">
                    <i class="fad fa-chevron-left"></i> <?php _e('Back')?>
                </a>
            </div>
        </div>

        <ul class="nav nav-pills mb-4 m-t-40 bg-light-dark rounded" id="pills-tab">
            <li class="nav-item me-0">
                <button class="nav-link bg-active-light-primary text-gray-700 px-4 py-3 active" data-bs-toggle="pill" data-bs-target="#plan_info" type="button" role="tab"><i class="fad fa-box-open me-2  text-primary"></i> <?php _e("Plan info")?></button>
            </li>
            <li class="nav-item me-0">
                <button class="nav-link bg-active-light-primary text-gray-700 px-4 py-3" data-bs-toggle="pill" data-bs-target="#plan_permissions" type="button" role="tab"><i class="fad fa-key me-2 text-danger"></i> <?php _e("Permissions")?></button>
            </li>
        </ul>

        <div class="rounded border b-r-10 p-20 card m-t-30">
         
            <div class="tab-content" id="tab_plans">
                <div class="tab-pane fade active show" id="plan_info" role="tabpanel">
                    
                    <div class="row">
                        <div class="col">
                            <div class="mb-4">
                                <label class="form-label"><?php _e('Status')?></label>
                                <div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="status" <?php _e( get_data($item, "status", "radio", 1) )?> id="status_enable" value="1">
                                        <label class="form-check-label" for="status_enable"><?php _e('Enable')?></label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="status" <?php _e( get_data($item, "status", "radio", 0) )?> id="status_disable" value="0">
                                        <label class="form-check-label" for="status_disable"><?php _e('Disable')?></label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-4">
                                <label class="form-label"><?php _e('Featured')?></label>
                                <div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="featured" <?php _e( get_data($item, "featured", "radio", 1) )?> id="featured_enable" value="1">
                                        <label class="form-check-label" for="featured_enable"><?php _e('Enable')?></label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="featured" <?php _e( get_data($item, "featured", "radio", 0) )?> id="featured_disable" value="0">
                                        <label class="form-check-label" for="featured_disable"><?php _e('Disable')?></label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="name" class="form-label"><?php _e('Plan name')?></label>
                        <input type="text" class="form-control form-control-solid" id="name" name="name" value="<?php _e( get_data($item, "name") )?>">
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label"><?php _e('Plan description')?></label>
                        <input type="text" class="form-control form-control-solid" id="description" name="description" value="<?php _e( get_data($item, "description") )?>">
                    </div>
                    <?php if (get_data($item, "type") != 1 || !get_data($item, "type")): ?>
                    <div class="row">
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="price_monthly" class="form-label"><?php _e('Price monthly')?></label>
                                <input type="number" class="form-control form-control-solid" id="price_monthly" name="price_monthly" value="<?php _e( get_data($item, "price_monthly") )?>">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="price_annually" class="form-label"><?php _e('Price annually')?></label>
                                <input type="number" class="form-control form-control-solid" id="price_annually" name="price_annually" value="<?php _e( get_data($item, "price_annually") )?>">
                            </div>
                        </div>
                    </div>
                    <?php else: ?>
                    <div class="mb-3">
                        <label for="trial_day" class="form-label"><?php _e('Trial day')?></label>
                        <input type="number" class="form-control form-control-solid" id="trial_day" name="trial_day" value="<?php _e( get_data($item, "trial_day") )?>">
                        <span class="fs-10 text-primary"><?php _e("Set -1 is unlimited")?></span>
                    </div>
                    <?php endif ?>

                    <div class="mb-3">
                        <label for="position" class="form-label"><?php _e('Position')?></label>
                        <input type="number" class="form-control form-control-solid" id="position" name="position" value="<?php _e( get_data($item, "position") )?>">
                    </div>

                    <div class="card border">
                        <div class="card-body">
                            <div class="mb-4">
                                <label class="form-label"><?php _e('The number of accounts is calculated by')?></label>
                                <div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="plan_type" <?php _ec( (get_data($item, "plan_type") == 1 || get_data($item, "plan_type") == "")?"checked='true'":"" ) ?> id="plan_type_1" value="1">
                                        <label class="form-check-label" for="plan_type_1"><?php _e('Each social network')?></label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="plan_type" <?php _e( get_data($item, "plan_type", "radio", 2) )?> id="plan_type_2" value="2">
                                        <label class="form-check-label" for="plan_type_2"><?php _e('Entire social network')?></label>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="number_accounts" class="form-label"><?php _e('Number accounts')?></label>
                                <input type="number" class="form-control form-control-solid" id="number_accounts" name="number_accounts" value="<?php _e( get_data($item, "number_accounts") )?>">
                            </div>
                        </div>
                    </div>

                </div>
                <div class="tab-pane fade" id="plan_permissions" role="tabpanel">
                    <ul class="nav nav-tabs mb-4 border-0" role="tablist">

                        <?php
                            $count = 0;
                        ?>

                        <?php if (!empty($permissions)): ?>
                            
                            <?php foreach ($permissions as $rows): ?>
                                
                                <?php if (!empty($rows)): ?>
                                    
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link mb-2 me-2 text-active-white bg-active-primary text-gray-700 border b-r-4 text-center <?php _ec( ($count == 0)?"active":"" ) ?>" data-bs-toggle="tab" href="#plan_<?php _ec($rows[0]['id'])?>" aria-selected="false" role="tab" tabindex="-1"> <i class="<?php _ec($rows[0]['icon'])?>"></i> <?php _e($rows[0]['name'])?></a>
                                    </li>

                                <?php endif ?>

                                <?php $count ++; ?>

                            <?php endforeach ?>

                        <?php endif ?>
                    </ul>

                    <div class="tab-content" id="tab_permissions">
                        <?php
                            $count = 0;
                        ?>

                        <?php if (!empty($permissions)): ?>
                            
                            <?php foreach ($permissions as $type => $rows): ?>
                                
                                <?php if (!empty($rows)): ?>

                                    <?php 
                                    $main_status = $type;
                                    ?>

                                    <div class="tab-pane fade <?php _ec( ($count == 0)?"active show":"" ) ?>" id="plan_<?php _ec($rows[0]['id'])?>" role="tabpanel">
                                        <?php if( count($rows) > 1 ){?>
                                        <div class="border border-dashed border-gray-300 rounded p-20 mb-4">
                                            <h5 class="fw-bold m-b-30"><i class="<?php _ec( $rows[0]['icon'] )?>" style="color: <?php _ec( $rows[0]['color'] )?>;"></i> <?php _ec( $rows[0]['name'] )?></h5>
                                            <div class="mb-3">
                                                <label for="website_description" class="form-label"> 
                                                    <div class="form-check form-check-inline">
                                                        <input 
                                                            class="form-check-input" 
                                                            type="checkbox" 
                                                            name="permissions[<?php _ec($type)?>]" 
                                                            id="<?php _ec($type)?>" 
                                                            value="1" 
                                                            <?php _e( plan_permission('checkbox', $main_status)  == 1?"checked":"" )?>
                                                        >
                                                        <label class="form-check-label" for="<?php _ec($type)?>"><?php _e('Enable/Disable')?></label>
                                                    </div>
                                                </label>
                                            </div>
                                        </div>
                                        <?php }?>

                                        <?php 
                                            foreach ($rows as $key => $value): 
                                            $count++;

                                            $id = $value["id"];
                                            $name = $value["name"];
                                            $icon = $value["icon"];
                                            $color = $value["color"];
                                            $module_status = $value["id"];

                                            if(isset($value["sub_menu"]) && isset($value["sub_menu"]["id"])){
                                                $id = $value["sub_menu"]["id"];
                                                $module_status = $value["sub_menu"]["id"];
                                            }

                                            if(isset($value["sub_menu"]) && isset($value["sub_menu"]["name"])){
                                                $name = $value["sub_menu"]["name"];
                                            }

                                            if(isset($value["sub_menu"]) && isset($value["sub_menu"]["icon"])){
                                                $icon = $value["sub_menu"]["icon"];
                                            }

                                            if(isset($value["sub_menu"]) && isset($value["sub_menu"]["color"])){
                                                $color = $value["sub_menu"]["color"];
                                            }

                                        ?>

                                        <div class="border border-dashed border-gray-300 rounded p-20 mb-4">
                                            <h5 class="fw-bold m-b-30"><i class="<?php _ec( $icon )?>" style="color: <?php _ec( $color )?>;"></i> <?php _ec( $name )?></h5>
                                            <div class="mb-3">
                                                <label for="website_description" class="form-label"> 
                                                    <div class="form-check form-check-inline">
                                                        <input 
                                                            class="form-check-input" 
                                                            type="checkbox" 
                                                            name="permissions[<?php _ec($id)?>]" 
                                                            id="<?php _ec($id)?>" 
                                                            value="1" 
                                                            <?php _e( plan_permission('checkbox', $module_status)  == 1?"checked":"" )?>
                                                        >
                                                        <label class="form-check-label" for="<?php _ec($id)?>"><?php _e('Enable/Disable')?></label>
                                                    </div>
                                                </label>
                                            </div>
                                            <?php if ( isset( $value["data"] ) ): ?>
                                                
                                                <?php if ( is_array($value["data"]) ): ?>
                                                    <?php if ( isset($value["data"]["html"]) ): ?>
                                                        <?php _ec( $value["data"]["html"] )?>
                                                    <?php endif ?>
                                                <?php else: ?>
                                                    <?php _ec( $value["data"] )?>
                                                <?php endif ?>

                                            <?php endif ?>
                                        </div>

                                        <?php endforeach ?>

                                    </div>


                                <?php endif ?>

                                <?php $count ++; ?>

                            <?php endforeach ?>

                        <?php endif ?>
                    </div>

                </div>

            </div>

            <div class="mt-5 mb-2">
                <button type="submit" class="btn btn-primary me-2"><?php _e('Save')?></button>
                <a href="<?php _ec( get_module_url("save/1/".get_data($item, "ids")) )?>" class="btn btn-dark actionMultiItem" data-redirect="<?php _ec( get_module_url() )?>"><?php _e('Save and update subscribers')?></a>
            </div>

        </div>
        
    </div>
</form>

