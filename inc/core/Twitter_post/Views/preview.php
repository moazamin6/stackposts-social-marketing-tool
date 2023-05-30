<div class="pv-header mb-3 d-flex align-items-center"><i class="<?php _ec($config['icon'])?> pe-2 fs-20" style="color: <?php _ec($config['color'])?>;"></i> <?php _ec($config['name'])?></div>
<div class="pv-body border rounded">
	
	<div class="preview-facebook">
		
		<div class="pvi-header d-flex p-13">
			
			<div class="d-flex w-100">
				<div class="symbol symbol-45px me-3">
					<img src="<?php _ec( get_theme_url()."Assets/img/avatar.jpg" )?>" class="align-self-center rounded-circle" alt="">
				</div>
				<div class="d-flex align-items-center flex-row-fluid flex-wrap">
					<div class="flex-grow-1 me-2 mb-2 text-over-all">
						<a href="javascript:void(0);" class="text-gray-800 text-hover-primary fs-12">
							<span class="fw-bold"><?php _e("Your name")?></span>
							<span class="fw-3 text-gray-500"><?php _e("@username")?></span>
							<span class="fw-3 text-gray-500 position-relative b-4">.</span>
							<span class="fw-3 text-gray-500"><?php _ec( date("M j") )?></span>
						</a>
						<div class="pvi-body mt-3">
							<div class="piv-text p-b-13 fs-12"></div>
							<div class="piv-img w-100">
								<img src="<?php _ec( get_theme_url()."Assets/img/default.jpg" )?>" class="w-100">
							</div>
							<div class="piv-link w-100 d-none d-flex text-over b-r-10">
								<div class="piv-link-img miw-80 h-80 mw-80">
									<img src="<?php _ec( get_theme_url()."Assets/img/default.jpg" )?>">
								</div>
								<div class="bg-gray-300 p-10 w-100 fs-12 text-over">
									<div class="piv-web fw-3">
										<div class="line-no-text w50"></div>
									</div>
									<div class="piv-title text-over fw-6">
										<div class="line-no-text"></div>
									</div>
									<div class="piv-desc text-over text-gray-700">
										<div class="line-no-text"></div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

		</div>

		<div class="pvi-footer m-l-70 pe-3 pb-3">
			<div class="d-flex fs-16 text-gray-500">
				<div class="d-flex flex-stack me-5">
					<div class="symbol symbol-45px me-2">
						<i class="fal fa-comment"></i>
					</div>
				</div>
				<div class="d-flex flex-stack me-5">
					<div class="symbol symbol-45px me-2">
						<i class="fal fa-retweet"></i>
					</div>
				</div>
				<div class="d-flex flex-stack">
					<div class="symbol symbol-45px me-2">
						<i class="fal fa-heart"></i>
					</div>
				</div>
			</div>
		</div>

	</div>

</div>