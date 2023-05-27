<div class="card">
	<div class="card-header">
		<div class="card-title">
			<span class="me-2"><i class="<?php _e( $config['icon'] )?> me-2" style="color: <?php _e( $config['color'] )?>"></i> <?php _e( $config['name'] )?></span>
		</div>
	</div>
	<div class="card-body">
		
		<div class="border b-r-10 p-25 d-inline-block">
			<img src="https://www.pngkey.com/png/full/624-6241157_bitly-logo-png-bit-ly-logo-png.png" class="h-40 mb-2">
			<?php if ( !get_team_data("shortlink_status", 0) ): ?>
				<div class="mb-4"><?php _e("Connect your social media with your Bit.ly account")?></div>
				<div>
					<a href="<?php _ec( base_url("shortlink/bitly") )?>" class="btn btn-dark"><?php _e("Connect")?></a>
				</div>
			<?php else: ?>
				<div class="mb-4"><?php _e("Disconnect your Bit.ly account")?></div>
				<div>
					<a href="<?php _ec( base_url("shortlink/disconnect_bitly") )?>" class="btn btn-danger actionItem" data-redirect=""><?php _e("Disconnect")?></a>
				</div>
			<?php endif ?>
		</div>

	</div>
</div>