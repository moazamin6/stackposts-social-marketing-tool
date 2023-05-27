<div class="account_manager w-100">

	<div class="am-choice-box">
		
		<div class="am-selected-box rounded border p-10 d-flex align-items-center justify-content-between">
			
			<div class="am-selected-list flex-stack overflow-y-auto mh-90 me-3">
				<button type="button" class="am-open-list-account"></button>
				<div class="am-selected-empty">
					<i class="fad fa-address-card"></i> <?php _e("Please select a profile")?>
				</div>
			</div>

			<div class="am-selected-arrow">
				<i class="fal fa-chevron-up"></i>
			</div>

		</div>

		<div class="am-list-account border rounded bg-white check-wrap-all">
			<div class="input-group input-group-solid rounded-0">
                <input type="text" class="form-control search-input" data-search="search-accounts" placeholder="Search">
                <span class="input-group-text m-r-1 border border-start border-top border-bottom border-gray-300"><i class="fad fa-search fs-18"></i></span>
                <div class="input-group-append m-r-1 border border-start border-top border-bottom border-gray-300">
                    <a class="btn border-start rounded-0">
                        <div class="form-check p-l-0">
                            <input class="form-check-input check-box-all" type="checkbox" id="checkAll">
                            <label class="form-check-label" for="checkAll"></label> 
                        </div>
                    </a>
                </div>
            	<?php echo view_cell('\Core\Group_manager\Controllers\Group_manager::widget') ?>
            </div>
			<div class="am-choice-body mh-400 overflow-auto">
				<?php if (!empty($accounts)): ?>
					
					<?php foreach ($accounts as $key => $value): ?>
						
						<div class="search-accounts">
							<label class="am-choice-item d-flex flex-stack" for="am_<?php _ec($value->id)?>" data-pid="<?php _ec($value->pid)?>" data-account='<?php _ec( json_encode( $value ) )?>' >
								<div class="symbol symbol-35px px-3 py-2">
									<img src="<?php _ec( get_file_url($value->avatar) )?>" class="align-self-center" alt="">
								</div>
								<div class="d-flex align-items-center flex-row-fluid flex-wrap">
									<div class="flex-grow-1 me-2 text-over-all">
										<div class="text-gray-800 text-hover-primary fs-12 fw-bold text-over"><?php _e($value->name)?></div>
										<span class="text-muted fw-semibold d-block fs-10"><?php _e( ucfirst( str_replace("_", " ", $value->social_network) . " " . __($value->category) ) )?> <span class="badge badge-light-danger"><?php _e( $value->login_type == 2?"Unofficial":"" )?></span></span>
									</div>
								</div>
								<div class="form-check me-2">
			                        <input class="form-check-input check-item" id="am_<?php _ec($value->id)?>" name="accounts[]" type="checkbox" value="<?php _e($value->ids)?>">
			                        <label class="form-check-label"></label>
			                    </div>

			                    <div class="am-choice-item-selected d-none">
			                    	<div class="am-selected-item border mb-1 mt-1 rounded float-start px-2 me-2 miw-100 mw-150" data-id="<?php _e($value->ids)?>" data-network="<?php _ec($value->social_network)?>">
										<div class="d-flex flex-stack ">
											<div class="symbol symbol-20px pe-2 py-2">
												<img src="<?php _ec( get_file_url($value->avatar) )?>" class="align-self-center" alt="">
											</div>
											<div class="d-flex align-items-center flex-row-fluid flex-wrap">
												<div class="text-gray-800 text-hover-primary fs-12 fw-bold text-over"><?php _e($value->name)?></div>
											</div>
											<a href="javascript:void(0);" class="d-flex align-items-center flex-row-fluid flex-wrap m-r-10 remove">
												<div class="text-gray-800 text-hover-danger fs-12 fw-bold ps-2"><i class="fal fa-times"></i></div>
											</a>
										</div>
									</div>
			                    </div>
							</label>
							<div class="separator separator-dashed mt-1"></div>
						</div>
					<?php endforeach ?>

				<?php endif ?>
			</div>
			<div class="am-choice-footer border-top p-15">
				<a href="<?php _ec( base_url("account_manager") )?>" class="btn btn-outline btn-outline-dashed btn-outline-primary btn-active-light-primary w-100">
					<i class="fal fa-plus"></i> <?php _e("Connect a Profile")?>
				</a>
			</div>

		</div>

	</div>

</div>