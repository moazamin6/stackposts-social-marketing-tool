<form class="actionForm" action="<?php _ec( get_module_url("role_save/".get_data($item, "ids")) )?>" method="POST" data-call-success="Core.click('group-role');" >
	<div class="card">
		<div class="card-header">
			<div class="card-title"><i class="fad fa-pen-square fs-18 text-danger me-2"></i> <?php _e( (!empty($item)?"Update":"Add new") )?></div>
		</div>
		<div class="card-body">

			<div class="mb-4">
                <label for="name" class="form-label"><?php _e('Role name')?></label>
                <input type="text" class="form-control form-control-solid" id="name" name="name" value="<?php _ec( get_data($item, "name") )?>">
            </div>

            <div class="mb-1">
                <label for="name" class="form-label"><?php _e('Permissions')?></label>
            </div>
			
			<ul class="nav nav-tabs mb-4 border-0" role="tablist">
                <?php
                    $count = 0;
                ?>

                <?php if (!empty($roles)): ?>
                    
                    <?php foreach ($roles as $rows): ?>
                        
                        <?php if (!empty($rows)): ?>
                            
                            <li class="nav-item" role="presentation">
                                <a class="nav-link mb-2 me-2 text-active-white bg-active-primary text-gray-700 border b-r-4 text-center <?php _ec( ($count == 0)?"active":"" ) ?>" data-bs-toggle="tab" href="#role_<?php _ec($rows[0]['id'])?>" aria-selected="false" role="tab" tabindex="-1"> <i class="<?php _ec($rows[0]['icon'])?>"></i> <?php _ec($rows[0]['name'])?></a>
                            </li>

                        <?php endif ?>

                        <?php $count ++; ?>

                    <?php endforeach ?>

                <?php endif ?>
            </ul>

            <div class="tab-content" id="tab_roles">
                <?php
                    $count = 0;
                ?>

                <?php if (!empty($roles)): ?>
                    
                    <?php foreach ($roles as $type => $rows): ?>
                        
                        <?php if (!empty($rows)): ?>

                            <?php 
                            $main_status = $type;
                            ?>

                            <div class="tab-pane fade <?php _ec( ($count == 0)?"active show":"" ) ?>" id="role_<?php _ec($rows[0]['id'])?>" role="tabpanel">
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
                                                    <?php _e( user_roles('checkbox', $main_status)  == 1?"checked":"" )?>
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
                                                    <?php _e( user_roles('checkbox', $module_status)  == 1?"checked":"" )?>
                                                >
                                                <label class="form-check-label" for="<?php _ec($id)?>"><?php _e('Enable/Disable')?></label>
                                            </div>
                                        </label>
                                    </div>
                                    <?php if ( isset( $value["data"] ) ): ?>
                                        
                                        <?php if ( is_array($value["data"]) ): ?>
                                            <?php _ec( $value["data"]["html"] )?>
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
		<div class="card-footer d-flex justify-content-end">
            <button type="submit" class="btn btn-primary"><?php _e('Save')?></button>
		</div>
	</div>
</form>