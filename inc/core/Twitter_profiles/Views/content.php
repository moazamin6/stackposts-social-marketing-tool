<div class="col-custom">
	<form>
	<div class="card mb-4">
		<div class="card-header border-0 pt-3">
			<h3 class="card-title align-items-start flex-column">
				<span class="card-label fw-bold text-dark"><i class="<?php _ec( $config['icon'] )?>" style="color: <?php _ec( $config['color'] )?>;"></i> <?php _e( $config['name'] )?></span>
			</h3>
		</div>
		<div class="card-body pt-3 check-wrap-all">
			<div class="m-b-25">
                <div class="input-group input-group-solid">
                    <input type="text" class="form-control search-input" data-search="search-<?php _ec( $config['id'] )?>" placeholder="<?php _e("Search")?>">
                    <span class="input-group-text"><i class="fad fa-search fs-18"></i></span>
                    <div class="input-group-append m-l-1">
                        <a class="btn border-start rounded-0">
                            <div class="form-check p-l-0">
                                <input class="form-check-input check-box-all" type="checkbox" id="checkAll">
                                <label class="form-check-label" for="checkAll"></label> 
                            </div>
                        </a>

                    </div>
                    <a 
                    	class="btn btn-bg-light btn-color-danger border-start actionMultiItem" 
                    	href="<?php _e( get_module_url('delete') )?>" 
                    	data-confirm="<?php _e('Are you sure to delete this items?')?>" 
                    	data-redirect="<?php _e( get_module_url() )?>"
                    >
                    	<i class="fad fa-trash"></i>
                    </a>
                </div>
            </div>
			
			<div class="h-300 n-scroll overflow-hidden no-update">
				<?php if(!empty($accounts)){ ?>

					<?php foreach ($accounts as $key => $value): ?>
						<div class="search-<?php _ec( $config['id'] )?>">
							<div class="d-flex flex-stack">
								<div class="symbol symbol-45px me-3">
									<img src="<?php _ec( get_file_url($value->avatar) )?>" class="align-self-center" alt="">
								</div>
								<div class="d-flex align-items-center flex-row-fluid flex-wrap">
									<div class="flex-grow-1 me-2 text-over-all">
										<a href="<?php _ec( $value->url)?>" class="text-gray-800 text-hover-primary fs-14 fw-bold"><?php _e( $value->name )?></a>
										<span class="text-muted fw-semibold d-block fs-12"><?php _e( $value->pid )?></span>
									</div>
								</div>
								<div class="form-check me-2">
	                                <input class="form-check-input check-item" name="id[]" type="checkbox" value="<?php _ec( $value->ids )?>">
	                                <label class="form-check-label"></label>
	                            </div>
							</div>
							<?php if($key + 1 != count($accounts)){?>
                            <div class="separator separator-dashed my-4"></div>
                            <?php }?>
						</div>
					<?php endforeach ?>
				<?php }else{?>
					<div class="d-flex align-items-center align-self-center h-100">
						<div class="w-100">
							<div class="text-center px-4">
					            <img class="mh-190 mb-4" alt="" src="<?php _e( get_theme_url() ) ?>Assets/img/empty2.png">
					            <div>
					            	<a class="btn btn-primary btn-sm b-r-30" href="<?php _e( base_url($config['id'].'/oauth') )?>" >
		                            	<i class="fad fa-plus"></i> <?php _ec("Add account")?>
		                            </a>
					            </div>
					        </div>
						</div>
					</div>
				<?php }?>
			</div>
			
		</div>
	</div>
	</form>
</div>