<div class="mb-3">
    <div class="d-flex align-items-center">
        <div class="w-100 position-relative">
            <div class="input-group sp-input-group">
              <span class="input-group-text bg-light border-0 fs-20 bg-gray-100 text-gray-800" id="sub-menu-search"><i class="fad fa-search"></i></span>
              <input type="text" class="form-control form-control-solid ps-15 bg-light border-0 search-input" data-search="group-profiles" name="search" value="" placeholder="<?php _e("Search")?>" autocomplete="off">
            </div>
        </div>
    </div>
</div>

<div class="am-choice-body mh-400 overflow-auto">
	<div class="search-accounts">
		<?php if (!empty($accounts)): ?>
			
			<?php foreach ($accounts as $key => $value): ?>
				<div class="group-profiles">
					<label class="am-choice-item d-flex flex-stack" for="am_<?php _ec($value->id)?>" data-account='<?php _ec( json_encode( $value ) )?>' >
						<div class="symbol symbol-35px px-3 py-2">
							<img src="<?php _ec( get_file_url($value->avatar) )?>" class="align-self-center" alt="">
						</div>
						<div class="d-flex align-items-center flex-row-fluid flex-wrap">
							<div class="flex-grow-1 me-2 text-over-all">
								<div class="text-gray-800 text-hover-primary fs-12 fw-bold text-over"><?php _e($value->name)?></div>
								<span class="text-muted fw-semibold d-block fs-10"><?php _e( ucfirst( str_replace("_", " ", $value->social_network) . " " . __($value->category) ) )?></span>
							</div>
						</div>
						<div class="form-check me-2">
	                        <input class="form-check-input check-item" id="am_<?php _ec($value->id)?>" name="accounts[]" type="checkbox" value="<?php _e($value->pid)?>" <?php _ec( in_array($value->pid, $selected_accounts) || in_array($value->id, $selected_accounts)?"checked":"" ) ?> >
	                        <label class="form-check-label"></label>
	                    </div>
					</label>
					<div class="separator separator-dashed mt-1"></div>
				</div>
			<?php endforeach ?>

		<?php else: ?>
			<div class="d-flex flex-column justify-content-center align-items-center text-gray-500 h-100 mih-300">
                <img class="mh-190 mb-4" alt="" src="<?php _e( get_theme_url() ) ?>Assets/img/empty2.png">
               <div>
                    <a class="btn btn-primary btn-sm b-r-30" href="<?php _e( base_url("account_manager") )?>" >
                        <i class="fad fa-plus"></i> <?php _ec("Add account")?>
                    </a>
                </div>
            </div>
		<?php endif ?>
	</div>
</div>