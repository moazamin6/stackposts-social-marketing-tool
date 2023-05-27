<div class="container py-5">
	<div class="row">
		
		<div class="col-md-3 mb-4">
			<form class="actionForm" action="<?php _ec( get_module_url("role_save") )?>" method="POST" data-redirect="<?php _ec( get_module_url("index/role") )?>">
				<div class="card">
					<div class="card-header">
						<div class="card-title"><i class="fad fa-align-center fs-18 text-success me-2"></i>  <?php _e("Email contents");?></div>
					</div>
					<div class="card-body nav nav-tabs" role="tablist">
						<a href="#activation_email" class="sp-menu-item d-flex align-items-center px-2 py-2 rounded bg-hover-light-primary bg-active-light-primary w-100 active" data-bs-toggle="tab" data-bs-target="#activation_email" type="button" role="tab" aria-controls="activation_email" aria-selected="true" data-remove-other-active="true" data-active="bg-light-primary">
				            <div class="d-flex mb-10 me-auto w-100 align-items-center">
				                <div class="d-flex align-items-center mb-10 ">
				                    <div class="symbol symbol-40px p-r-10">
				                        <span class="symbol-label border bg-white">
				                            <i class="fad fa-envelope-open-text fs-18 text-primary"></i>
				                        </span>
				                    </div>
				                </div>
				                <div class="d-flex flex-column flex-grow-1 text-over">
				                    <h5 class="custom-list-title fw-5 text-gray-800 mb-0 fs-14 text-over"><?php _e("Activation email")?></h5>
				                </div>
				            </div>
				        </a>

				        <a href="#welcome-email-tab" class="sp-menu-item d-flex align-items-center px-2 py-2 rounded bg-hover-light-primary bg-active-light-primary w-100" data-bs-toggle="tab" data-bs-target="#welcome_email" type="button" role="tab" aria-controls="welcome_email" aria-selected="true" data-remove-other-active="true" data-active="bg-light-primary">
				            <div class="d-flex mb-10 me-auto w-100 align-items-center">
				                <div class="d-flex align-items-center mb-10 ">
				                    <div class="symbol symbol-40px p-r-10">
				                        <span class="symbol-label border bg-white">
				                            <i class="fad fa-envelope-open-text fs-18 text-primary"></i>
				                        </span>
				                    </div>
				                </div>
				                <div class="d-flex flex-column flex-grow-1 text-over">
				                    <h5 class="custom-list-title fw-5 text-gray-800 mb-0 fs-14 text-over"><?php _e("Welcome email")?></h5>
				                </div>
				            </div>
				        </a>

				        <a href="#forgot-password-email-tab" class="sp-menu-item d-flex align-items-center px-2 py-2 rounded bg-hover-light-primary bg-active-light-primary w-100" data-bs-toggle="tab" data-bs-target="#forgot_password_email" type="button" role="tab" aria-controls="forgot_password_email" aria-selected="true" data-remove-other-active="true" data-active="bg-light-primary">
				            <div class="d-flex mb-10 me-auto w-100 align-items-center">
				                <div class="d-flex align-items-center mb-10 ">
				                    <div class="symbol symbol-40px p-r-10">
				                        <span class="symbol-label border bg-white">
				                            <i class="fad fa-envelope-open-text fs-18 text-primary"></i>
				                        </span>
				                    </div>
				                </div>
				                <div class="d-flex flex-column flex-grow-1 text-over">
				                    <h5 class="custom-list-title fw-5 text-gray-800 mb-0 fs-14 text-over"><?php _e("Forgot password email")?></h5>
				                </div>
				            </div>
				        </a>

				        <a href="#renewal-reminders-tab" class="sp-menu-item d-flex align-items-center px-2 py-2 rounded bg-hover-light-primary bg-active-light-primary w-100" data-bs-toggle="tab" data-bs-target="#renewal_reminders_email" type="button" role="tab" aria-controls="renewal_reminders_email" aria-selected="true" data-remove-other-active="true" data-active="bg-light-primary">
				            <div class="d-flex mb-10 me-auto w-100 align-items-center">
				                <div class="d-flex align-items-center mb-10 ">
				                    <div class="symbol symbol-40px p-r-10">
				                        <span class="symbol-label border bg-white">
				                            <i class="fad fa-envelope-open-text fs-18 text-primary"></i>
				                        </span>
				                    </div>
				                </div>
				                <div class="d-flex flex-column flex-grow-1 text-over">
				                    <h5 class="custom-list-title fw-5 text-gray-800 mb-0 fs-14 text-over"><?php _e("Renewal reminders email")?></h5>
				                </div>
				            </div>
				        </a>

				        <a href="#paypent-success-tab" class="sp-menu-item d-flex align-items-center px-2 py-2 rounded bg-hover-light-primary bg-active-light-primary w-100" data-bs-toggle="tab" data-bs-target="#paypent_success_email" type="button" role="tab" aria-controls="paypent_success_email" aria-selected="true" data-remove-other-active="true" data-active="bg-light-primary">
				            <div class="d-flex mb-10 me-auto w-100 align-items-center">
				                <div class="d-flex align-items-center mb-10 ">
				                    <div class="symbol symbol-40px p-r-10">
				                        <span class="symbol-label border bg-white">
				                            <i class="fad fa-envelope-open-text fs-18 text-primary"></i>
				                        </span>
				                    </div>
				                </div>
				                <div class="d-flex flex-column flex-grow-1 text-over">
				                    <h5 class="custom-list-title fw-5 text-gray-800 mb-0 fs-14 text-over"><?php _e("Paypent success email")?></h5>
				                </div>
				            </div>
				        </a>
						
					</div>
				</div>
			</form>
		</div>
		<div class="col-md-9 mb-4 update-roles">
			<div class="tab-content" id="myTabContent">
			  	<div class="tab-pane fade show active" id="activation_email" role="tabpanel" aria-labelledby="activation-email-tab">
	                <form class="actionForm" action="<?php _ec( get_module_url("save_mail_contents") )?>">
						<div class="card">
							<div class="card-header">
								<div class="card-title"><?php _e("Activation Email")?></div>
							</div>
							<div class="card-body">
								<div class="mb-3">
									<label class="form-label" for="activation_email_subject"><?php _e("Subject")?></label>
									<input type="text" class="form-control" id="activation_email_subject" name="activation_email_subject" value="<?php _ec( get_option('activation_email_subject', 'Hello {fullname}! Activation your account') )?>">
								</div>

								<div class="mb-3">
						            <label for="activation_email_content" class="form-label"><?php _e("Content")?></label>
						            <textarea class="form-control activation_email_content" id="activation_email_content" name="activation_email_content"><?php _ec( get_option('activation_email_content', "Welcome to {website_name}! <br/><br/>Hello {fullname},  <br/><br/>Thank you for joining! We're glad to have you as community member, and we're stocked for you to start exploring our service. <br/>All you need to do is activate your account: <br/><a href='{activation_link}' target='_blank'>{activation_link}</a> <br/><br/>Thanks and Best Regards!"), false)?></textarea>
						        </div>
							</div>
							<div class="card-footer d-flex justify-content-end">
								<button type="submit"0 class="btn btn-primary"><?php _e("Save")?></button>
							</div>
						</div>
					</form>
			  	</div>
			  	<div class="tab-pane fade" id="welcome_email" role="tabpanel" aria-labelledby="welcome-email-tab">
	                <form class="actionForm" action="<?php _ec( get_module_url("save_mail_contents") )?>">
						<div class="card">
							<div class="card-header">
								<div class="card-title"><?php _e("Welcome email")?></div>
							</div>
							<div class="card-body">
								<div class="mb-3">
									<label class="form-label" for="welcome_email_subject"><?php _e("Subject")?></label>
									<input type="text" class="form-control" id="welcome_email_subject" name="welcome_email_subject" value="<?php _ec( get_option('welcome_email_subject', 'Hi {fullname}! Getting Started with Our Service') )?>">
								</div>

								<div class="mb-3">
						            <label for="welcome_email_content" class="form-label"><?php _e("Content")?></label>
						            <textarea class="form-control welcome_email_content" id="welcome_email_content" name="welcome_email_content"><?php _ec( get_option('welcome_email_content', "Hello {fullname}! <br/><br/>Congratulations! <br/><br/>You have successfully signed up for our service. <br/>You have got a trial package, starting today. <br/>We hope you enjoy this package! We love to hear from you, <br/><br/>Thanks and Best Regards!"), false)?></textarea>
						        </div>
							</div>
							<div class="card-footer d-flex justify-content-end">
								<button type="submit"0 class="btn btn-primary"><?php _e("Save")?></button>
							</div>
						</div>
					</form>
			  	</div>
			  	<div class="tab-pane fade" id="forgot_password_email" role="tabpanel" aria-labelledby="forgot-password-email-tab">
	                <form class="actionForm" action="<?php _ec( get_module_url("save_mail_contents") )?>">
						<div class="card">
							<div class="card-header">
								<div class="card-title"><?php _e("Forgot password email")?></div>
							</div>
							<div class="card-body">
								<div class="mb-3">
									<label class="form-label" for="forgot_password_email_subject"><?php _e("Subject")?></label>
									<input type="text" class="form-control" id="forgot_password_email_subject" name="forgot_password_email_subject" value="<?php _ec( get_option('forgot_password_email_subject', 'Hi {fullname}! Password Reset') )?>">
								</div>

								<div class="mb-3">
						            <label for="forgot_password_email_content" class="form-label"><?php _e("Content")?></label>
						            <textarea class="form-control forgot_password_email_content" id="forgot_password_email_content" name="forgot_password_email_content"><?php _ec( get_option('email_forgot_password_content', "Hi {fullname}! <br/><br/>Somebody (hopefully you) requested a new password for your account. <br/>No changes have been made to your account yet. <br/><br/>You can reset your password by click this link: <br/><a href='{recovery_password_link}' target='_blank'>{recovery_password_link}</a>. <br/><br/>If you did not request a password reset, no further action is required. <br/><br/>Thanks and Best Regards!"), false)?></textarea>
						        </div>
							</div>
							<div class="card-footer d-flex justify-content-end">
								<button type="submit"0 class="btn btn-primary"><?php _e("Save")?></button>
							</div>
						</div>
					</form>
			  	</div>
			  	<div class="tab-pane fade" id="renewal_reminders_email" role="tabpanel" aria-labelledby="renewal-reminders-tab">
	                <form class="actionForm" action="<?php _ec( get_module_url("save_mail_contents") )?>">
						<div class="card">
							<div class="card-header">
								<div class="card-title"><?php _e("Renewal reminders email")?></div>
							</div>
							<div class="card-body">
								<div class="mb-3">
									<label class="form-label" for="renewal_reminders_email_subject"><?php _e("Subject")?></label>
									<input type="text" class="form-control" id="renewal_reminders_email_subject" name="renewal_reminders_email_subject" value="<?php _ec( get_option('renewal_reminders_email_subject', "Hi {fullname}, Here's a little Reminder your Membership is expiring soon...") )?>">
								</div>

								<div class="mb-3">
						            <label for="renewal_reminders_email_content" class="form-label"><?php _e("Content")?></label>
						            <textarea class="form-control renewal_reminders_email_content" id="renewal_reminders_email_content" name="renewal_reminders_email_content"><?php _ec( get_option('renewal_reminders_email_content', "Dear {fullname}, <br/><br/>Your membership with your current package will expire in {days_left} days. <br/><br/>We hope that you will take the time to renew your membership and remain part of our community. It couldn't be easier - just click here to renew: {pricing_page} <br/><br/>Thanks and Best Regards!"), false)?></textarea>
						        </div>
							</div>
							<div class="card-footer d-flex justify-content-end">
								<button type="submit"0 class="btn btn-primary"><?php _e("Save")?></button>
							</div>
						</div>
					</form>
			  	</div>
			  	<div class="tab-pane fade" id="paypent_success_email" role="tabpanel" aria-labelledby="paypent-success-tab">
	                <form class="actionForm" action="<?php _ec( get_module_url("save_mail_contents") )?>">
						<div class="card">
							<div class="card-header">
								<div class="card-title"><?php _e("Paypent success email")?></div>
							</div>
							<div class="card-body">
								<div class="mb-3">
									<label class="form-label" for="payment_success_email_subject"><?php _e("Subject")?></label>
									<input type="text" class="form-control" id="payment_success_email_subject" name="payment_success_email_subject" value="<?php _ec( get_option('payment_success_email_subject', "Hi {fullname}, Thank you for your payment") )?>">
								</div>

								<div class="mb-3">
						            <label for="payment_success_email_content" class="form-label"><?php _e("Content")?></label>
						            <textarea class="form-control payment_success_email_content" id="payment_success_email_content" name="payment_success_email_content"><?php _ec( get_option('payment_success_email_content', "Hi {fullname}, <br/><br/>You just completed the payment successfully on our service. <br/>Thank you for being awesome, we hope you enjoy your package. <br/><br/>Thanks and Best Regards!"), false)?></textarea>
						        </div>
							</div>
							<div class="card-footer d-flex justify-content-end">
								<button type="submit"0 class="btn btn-primary"><?php _e("Save")?></button>
							</div>
						</div>
					</form>
			  	</div>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	$(function(){
		Core.ckeditor("activation_email_content");
		Core.ckeditor("welcome_email_content");
		Core.ckeditor("forgot_password_email_content");
		Core.ckeditor("renewal_reminders_email_content");
		Core.ckeditor("payment_success_email_content");
	});
</script>