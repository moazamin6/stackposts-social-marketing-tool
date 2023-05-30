<div class="pv-header mb-3 d-flex align-items-center"><i class="<?php _ec($config['icon'])?> pe-2 fs-20" style="color: <?php _ec($config['color'])?>;"></i> <?php _ec($config['name'])?></div>
<div class="pv-body border rounded" data-support-type="media,link">
	<div class="preview-item  preview-instagram">
		<div class="pvi-header d-flex p-13">
			<div class="d-flex flex-stack">
				<div class="symbol symbol-45px me-3">
					<img src="<?php _ec( get_theme_url()."Assets/img/avatar.jpg" )?>" class="align-self-center rounded-circle" alt="">
				</div>
				<div class="d-flex align-items-center flex-row-fluid flex-wrap">
					<div class="flex-grow-1 me-2 text-over-all">
						<a href="javascript:void(0);" class="text-gray-800 text-hover-primary fs-14 fw-bold"><?php _e("Username")?></a>
					</div>
				</div>
			</div>

		</div>

		<div class="pvi-body">
			<div class="piv-img w-100">
				<img src="<?php _ec( get_theme_url()."Assets/img/default.jpg" )?>" class="w-100">
			</div>
			<div class="piv-link w-100 d-none">
				<div class="piv-link-img w-100">
					<img src="<?php _ec( get_theme_url()."Assets/img/default.jpg" )?>" class="w-100">
				</div>
			</div>
		</div>

		<div class="pvi-footer border-top px-3 py-2">
			<div class="d-flex mb-2">
				<div class="d-flex flex-stack">
					<div class="symbol symbol-45px me-4">
						<i class="far fa-heart fs-20"></i>
					</div>
				</div>
				<div class="d-flex flex-stack">
					<div class="symbol symbol-45px me-2">
						<i class="far fa-comment fs-20"></i>
					</div>
				</div>
			</div>

			<div class="d-flex align-items-center flex-row-fluid flex-wrap">
				<div class="flex-grow-1 me-2 text-over-all">
					<div class="fs-12">
						<a href="javascript:void(0);" class="text-gray-800 text-hover-primary fw-bold me-2"><?php _e("Your name")?></a>
						<span class="piv-text"></span>
					</div>
					<span class="text-muted fw-semibold d-block fs-10 text-uppercase mt-2"><?php _ec( date("M j") )?></span>
				</div>
			</div>
		</div>

	</div>

	<div class="piv-not-support d-none">
		<div class="p-20 text-danger opacity-75 fs-12 text-center"><?php _e("Instagram doesn't allow posts with text type")?></div>
	</div>
</div>