<div class="container">
    <div class="row justify-content-center mt-5">
        <div class="col-md-7">
            <div class="card mb-4 mb-xl-10">
                <div class="card-header cursor-pointer">
                    <div class="card-title m-0">
                        <h3 class="fw-bold m-0"><i class="<?php _e( $config['icon'] )?>" style="color: <?php _e($config['color'])?>"></i> <?php _e("Add Twitter profiles")?></h3>
                    </div>
                </div>
                <div class="card-body p-25">
                    <div class="py-2 check-wrap-all">
                        <div class="m-b-25">
                            <div class="input-group input-group-solid mb-5">
                                <input type="text" class="form-control search-input" data-search="list-profiles" placeholder="<?php _e("Search")?>">
                                <span class="input-group-text"><i class="fad fa-search"></i></span>
                                <div class="input-group-append m-l-1">
                                    <a class="btn border-start rounded-0">
                                        <div class="form-check p-l-0">
                                            <input class="form-check-input check-box-all" type="checkbox" id="checkAll">
                                            <label class="form-check-label" for="checkAll"></label> 
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <?php if( $status == "error" && isset($message) ){?>
                        <div class="alert alert-danger d-flex rounded border-danger border border-dashed mb-9 p-15">
                            <span class="d-flex flex-stack fs-30 me-3">
                                <i class="fad fa-exclamation-circle"></i>
                            </span>
                            <div class="d-flex flex-stack flex-grow-1">
                                <div class="fw-semibold">
                                    <div class="fs-14">
                                        <?php _e( $message )?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php }?>

                        <?php if(!empty($result)){?>

                            <?php foreach ($result as $key => $value): ?>
                            <div class="list-profiles">
                                <div class="d-flex flex-stack">
                                    <div class="d-flex">
                                        <div class="w-50 m-r-10">
                                            <img src="<?php _e( $value->avatar )?>" class="w-100 rounded" alt="">
                                        </div>
                                        <div class="d-flex flex-column justify-content-center">
                                            <a href="#" class="text-dark text-hover-primary fw-bold"><?php _e( $value->name )?></a>
                                            <div class="fw-semibold text-gray-400"><?php _e( $value->id )?></div>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-end">
                                        <div class="form-check">
                                            <input class="form-check-input check-item" name="id[]" type="checkbox" value="<?php _e( $value->id )?>">
                                            <label class="form-check-label"></label>
                                        </div>
                                    </div>
                                </div>
                                <?php if($key + 1 != count($result)){?>
                                <div class="separator separator-dashed my-4"></div>
                                <?php }?>
                            </div>
                            <?php endforeach ?>
                        <?php } ?>
                        
                    </div>
                </div>
                <div class="card-footer d-flex justify-content-end py-6 px-9">
                    <a class="btn btn-light btn-active-light-primary me-2" href="<?php _ec( base_url("account_manager") )?>"><?php _e("Discard")?></a>
                    <button class="btn btn-primary"><?php _e("Add profile")?></button>
                </div>
            </div>

            <div class="card">
                
                <div class="card-body">
                    <div class="note">
                        <div class="desc m-b-15"><?php _e("If you don't see your profiles above, you might try to reconnec, re-accept all permissions, and ensure that you're logged in to the correct profile.")?></div>
                        <a href="<?php _ec( get_module_url("oauth") )?>" class="btn btn-outline btn-outline-dashed bg-white"><i class="<?php _ec( $config['icon'] )?>" style="color: <?php _ec( $config['color'] )?>"></i> <?php _e("Re-connect with Twitter")?></a>
                    </div>
                </div>

            </div>
        </div>
    </div>

</div>