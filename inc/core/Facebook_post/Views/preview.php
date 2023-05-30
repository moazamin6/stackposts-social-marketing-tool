<div class="pv-header mb-3 d-flex align-items-center"><i class="<?php _ec($config['icon'])?> pe-2 fs-20" style="color: <?php _ec($config['color'])?>;"></i> <?php _ec($config['name'])?></div>
<div class="pv-body border rounded">
	<div class="preview-item preview-facebook">
		
		<div class="pvi-header d-flex p-13">
			
			<div class="d-flex flex-stack">
				<div class="symbol symbol-45px me-3">
					<img src="<?php _ec( get_theme_url()."Assets/img/avatar.jpg" )?>" class="align-self-center rounded-circle" alt="">
				</div>
				<div class="d-flex align-items-center flex-row-fluid flex-wrap">
					<div class="flex-grow-1 me-2 text-over-all">
						<a href="javascript:void(0);" class="text-gray-800 text-hover-primary fs-14 fw-bold"><?php _e("Your name")?></a>
						<span class="text-muted fw-semibold d-block fs-12"><?php _ec( date("M j") )?></span>
					</div>
				</div>
			</div>

		</div>

		<div class="pvi-body">
			
			<div class="piv-text px-3 p-b-13"></div>

			<div class="piv-img w-100">
				<img src="<?php _ec( get_theme_url()."Assets/img/default.jpg" )?>" class="w-100">
			</div>

			<div class="piv-link w-100 d-none">
				<div class="piv-link-img w-100">
					<img src="<?php _ec( get_theme_url()."Assets/img/default.jpg" )?>" class="w-100">
				</div>
				<div class="bg-gray-300 p-10 fs-12">
					<div class="piv-web text-uppercase fw-3">
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

		<div class="pvi-footer border-top px-3 py-2">
			<div class="d-flex justify-content-between">
				<div class="d-flex flex-stack">
					<div class="symbol symbol-45px me-2">
						<i class="fal fa-thumbs-up"></i>
					</div>
					<div class="d-flex align-items-center flex-row-fluid flex-wrap">
						<div class="flex-grow-1 me-2 text-over-all">
							<span class="text-gray-800 fs-12 fw-bold"><?php _e("Like")?></span>
						</div>
					</div>
				</div>
				<div class="d-flex flex-stack">
					<div class="symbol symbol-45px me-2">
						<i class="fal fa-comment-alt"></i>
					</div>
					<div class="d-flex align-items-center flex-row-fluid flex-wrap">
						<div class="flex-grow-1 me-2 text-over-all">
							<span class="text-gray-800 fs-12 fw-bold"><?php _e("Comment")?></span>
						</div>
					</div>
				</div>
				<div class="d-flex flex-stack">
					<div class="symbol symbol-45px me-2">
						<i class="fal fa-share"></i>
					</div>
					<div class="d-flex align-items-center flex-row-fluid flex-wrap">
						<div class="flex-grow-1 me-2 text-over-all">
							<span class="text-gray-800 fs-12 fw-bold"><?php _e("Share")?></span>
						</div>
					</div>
				</div>
			</div>
		</div>

	</div>
</div>