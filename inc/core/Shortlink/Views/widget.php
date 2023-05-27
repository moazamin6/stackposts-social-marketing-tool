<?php if (permission("shortlink")): ?>
	<?php if ( !get_team_data("shortlink_status", 0) ): ?>
	<div class="dropdown dropdown-hide-arrow" data-dropdown-spacing="36">
	    <a href="javascript:void(0);" class="dropdown-toggle px-3 py-2 d-block btn btn-active-light fs-12 h-35 d-flex align-items-center" data-toggle="dropdown" aria-expanded="true">
	        <i class="fal fa-link"></i> <span><?php _e("URL Shortener")?></span>
	    </a>
	    <div class="dropdown-menu t-auto position-fixed" >
			<a class="dropdown-item d-flex align-items-center " href="<?php _ec( base_url("shortlink/bitly") )?>">
				<img src="<?php _ec( get_module_path( __DIR__, "Assets/img/bitly.png") )?>" class="w-17 h-17 me-2"> <span><?php _e("Bitly")?></span>
			</a>
	    </div>
	</div>
	<?php else: ?>
		<select name="advance_options[shortlink]" data-control="select2" data-hide-search="true" class="form-select form-select-sm bg-body fw-bold border-0 miw-130">
		    <option value="" data-icon="fal fa-link text-dark" data-icon-color="" selected><span><?php _e("URL Shortener")?></span></option>
			<?php if (get_team_data("bitly_access_token", "") != ""): ?>
		    <option value="bitly" data-img="<?php _ec( get_module_path( __DIR__, "Assets/img/bitly.png") )?>" ><?php _e("Bitly")?></option>
			<?php endif ?>
		</select>
	<?php endif ?>
<?php endif ?>