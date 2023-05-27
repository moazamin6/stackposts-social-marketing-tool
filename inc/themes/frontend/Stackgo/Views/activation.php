<div class="row justify-content-center">
	<div class="col-xl-10 col-lg-10">
        <form class="actionForm" action="<?php _ec( base_url("auth/signup") )?>" data-redirect="<?php _ec( base_url("login") )?>" method="POST">
			<?php if ($status): ?>
				<div class="row">
					<h1 class="text-success"><i class="far fa-check-circle"></i></h1>
					<h5><?php _e("Activation successful")?></h5>
					<p><?php _e("Thank you for choosing us. Sign in and get started.")?></p>
					<a href="<?php _ec( base_url("login") )?>" class="btn btn-primary w-auto"><?php _e("Login")?></a>
				</div>
			<?php else: ?>
				<div class="row">
					<h1 class="text-danger"><i class="far fa-frown"></i></h1>
					<h5><?php _e("Activation unsuccessful")?></h5>
					<p><?php _e("Incorrect or invalid activation code")?></p>
					<a href="<?php _ec( base_url("resend_activation") )?>" class="btn btn-primary w-auto"><?php _e("Resend activation email")?></a>
				</div>
			<?php endif ?>
		</form>
	</div>
</div>