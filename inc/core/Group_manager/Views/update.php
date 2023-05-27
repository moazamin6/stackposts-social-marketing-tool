<div class="container my-5">
	<form class="actionForm" action="<?php _ec( get_module_url("save/".uri("segment", 4)) )?>" method="POST" data-redirect="<?php _ec( get_module_url() )?>">
		<div class="card m-b-25 mw-800 m-auto">
		    <div class="card-header">
		        <div class="card-title flex-column">
		            <h3 class="fw-bolder"><i class="fad fa-users"></i> <?php _e("Group manager")?></h3>
		        </div>
		    </div>
		    <div class="card-body">
		        <div class="mb-3">
		            <label for="name" class="form-label"><?php _e("Title")?></label>
		            <input type="text" class="form-control form-control-solid" id="name" name="name" value="<?php _ec( get_data($result, "name") )?>">
		        </div>
		        <div class="mb-3">

		        		<div class="d-flex mb-10 pt-4 pb-2">
		                    <div class="text-gray-800 fw-bold"><?php _e("Select accounts")?></div>
		                </div>

		                <div class="mb-3">
		                    <div class="d-flex align-items-center">
		                        <form class="w-100 position-relative ">
		                            <div class="input-group sp-input-group">
		                              <span class="input-group-text bg-light border-0 fs-20 bg-gray-100 text-gray-800" id="sub-menu-search"><i class="fad fa-search"></i></span>
		                              <input type="text" class="form-control form-control-solid ps-15 bg-light border-0 search-input" data-search="group-profiles" name="search" value="" placeholder="<?php _e("Search")?>" autocomplete="off">
		                            </div>
		                        </form>
		                    </div>
		                </div>

		                <div class="am-choice-body mh-400 overflow-auto">
							<div class="search-accounts">
								<?php if (!empty($accounts)): ?>
									
									<?php foreach ($accounts as $key => $value): ?>

										<?php 
											$account_selected = [];
											if(!empty($result)){
												$account_selected = json_decode($result->data);
											}
										?>

										<div class="group-profiles">
											<label class="am-choice-item d-flex flex-stack" for="am_<?php _ec($value->id)?>" data-account='<?php _ec( json_encode( $value ) )?>' >
												<div class="symbol symbol-35px px-3 py-2">
													<img src="<?php _ec( get_file_url($value->avatar) )?>" class="align-self-center" alt="">
												</div>
												<div class="d-flex align-items-center flex-row-fluid flex-wrap">
													<div class="flex-grow-1 me-2 text-over-all">
														<div class="text-gray-800 text-hover-primary fs-12 fw-bold text-over"><?php _e($value->name)?></div>
														<span class="text-muted fw-semibold d-block fs-10"><?php _e( ucfirst( $value->social_network . " " . __($value->category) ) )?></span>
													</div>
												</div>
												<div class="form-check me-2">
							                        <input class="form-check-input check-item" id="am_<?php _ec($value->id)?>" name="accounts[]" type="checkbox" value="<?php _e($value->pid)?>" <?php _ec( in_array($value->pid, $account_selected)?"checked":"" ) ?> >
							                        <label class="form-check-label"></label>
							                    </div>
											</label>
											<div class="separator separator-dashed mt-1"></div>
										</div>
									<?php endforeach ?>

								<?php else: ?>
									<div class="d-flex align-items-center align-self-center h-100 py-5">
								        <div class="w-100">
								            <div class="text-center px-4">
								                <img class="mh-190 mb-4" alt="" src="<?php _e( get_theme_url() ) ?>Assets/img/empty2.png">
								                <div>
									            	<a class="btn btn-primary btn-sm b-r-30" href="<?php _e( base_url("account_manager") )?>" >
						                            	<i class="fad fa-plus"></i> <?php _ec("Add account")?>
						                            </a>
									            </div>
								            </div>
								        </div>
								    </div>
								<?php endif ?>
							</div>
						</div>

	                </div>

		    </div>
		    <div class="card-footer d-flex justify-content-between">
		    	<a href="<?php _ec( get_module_url() )?>" class="btn btn-secondary"><?php _e("Back")?></a>
		    	<button type="submit" class="btn btn-primary"><?php _e("Save")?></button>
		    </div>
		</div>
	</form>
</div>