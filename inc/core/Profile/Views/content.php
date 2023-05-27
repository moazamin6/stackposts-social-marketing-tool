<div class="container my-5">
	<?php if (get_user("timezone") == "" || get_user("email") == "" || get_user("username") == ""): ?>
		<div class="alert alert-warning">
			<?php if (get_user("timezone") == "" ): ?>
				<?php _e("<b>Required:</b> Please select your timezone to begin using.", false)?><br/>
			<?php endif ?>
			<?php if (get_user("email") == "" ): ?>
				<?php _e("<b>Required:</b> Email is required.", false)?><br/>
			<?php endif ?>
			<?php if (get_user("username") == "" ): ?>
				<?php _e("<b>Required:</b> Username is required.", false)?>
			<?php endif ?>
		</div>
	<?php endif ?>

	<div class="d-flex mb-5 align-items-center">
		<img src="<?php _ec( get_file_url( get_user("avatar") ) )?>" class="img-thumbnail me-3 border rounded b-r-20 w-90 h-90">
		<div>
			<h2 class="text-primary"><?php _ec( get_user("fullname") )?></h2>
			<?php if (get_user("username") != "" ): ?>
			<div class="text-gray-700"><i class="fad fa-user"></i> <?php _ec( get_user("username") )?></div>
			<?php endif ?>
			<?php if (get_user("email") != "" ): ?>
			<div class="text-gray-700"><i class="fad fa-envelope"></i> <?php _ec( get_user("email") )?></div>
			<?php endif ?>
		</div>
	</div>

	<ul class="nav nav-pills mb-4 m-t-40 bg-light-dark rounded" id="pills-tab">
	  	<li class="nav-item">
	    	<button class="nav-link bg-active-white text-gray-700 px-4 py-3 <?php _e( ( uri("segment", 3) == "account" || uri("segment", 3) == "" )?"active":"" )?>" id="pills-account-tab" data-bs-toggle="pill" data-bs-target="#profile_account" type="button" role="tab"><i class="fad fa-user me-2 text-primary"></i> <?php _e("Account")?></button>
	  	</li>
	  	<li class="nav-item">
	    	<button class="nav-link bg-active-white text-gray-700 px-4 py-3 <?php _e( uri("segment", 3) == "change_password"?"active":"" )?>" id="pills-change-password-tab" data-bs-toggle="pill" data-bs-target="#profile_change_password" type="button" role="tab"><i class="fad fa-key me-2 text-success"></i> <?php _e("Change password")?></button>
	  	</li>
	  	<li class="nav-item">
	    	<button class="nav-link bg-active-white text-gray-700 px-4 py-3 <?php _e( uri("segment", 3) == "plan"?"active":"" )?>" id="pills-plan-tab" data-bs-toggle="pill" data-bs-target="#profile_plan" type="button" role="tab"><i class="fad fa-box-open me-2 text-danger"></i> <?php _e("Plan")?></button>
	  	</li>
	  	<?php if (find_modules("payment")): ?>
	  	<li class="nav-item">
	    	<button class="nav-link bg-active-white text-gray-700 px-4 py-3 <?php _e( uri("segment", 3) == "billing"?"active":"" )?>" id="pills-billing-tab" data-bs-toggle="pill" data-bs-target="#profile_billing" type="button" role="tab"><i class="fad fa-credit-card me-2 text-warning"></i> <?php _e("Billing")?></button>
	  	</li>
	  	<?php endif ?>
	  	<?php if (!empty($settings)): ?>
	  	<li class="nav-item">
	    	<button class="nav-link bg-active-white text-gray-700 px-4 py-3 <?php _e( uri("segment", 3) == "settings"?"active":"" )?>" id="pills-settings-tab" data-bs-toggle="pill" data-bs-target="#profile_settings" type="button" role="tab"><i class="fad fa-cog me-2 text-info"></i> <?php _e("Settings")?></button>
	  	</li>
	  	<?php endif ?>
	</ul>
	 
	<div class="tab-content" id="pills-tabContent">
	  	<div class="tab-pane fade  <?php _e( (uri("segment", 3) == "account" || uri("segment", 3) == "")?"show active":"" )?>" id="profile_account">
	  		<form class="actionForm" action="<?php _ec( base_url("profile/save_account") )?>" <?php _ec( post("require")=="timezone"?'data-redirect="'.base_url("dashboard").'"':'' )?> >		
  				<div class="card">
		  			<div class="card-header">
		  				<div class="card-title">
		  					<span class="me-2"><i class="fad fa-user me-2 text-primary"></i> <?php _e("Account")?></span>
		  				</div>
		  			</div>
		  			<div class="card-body">

		        		<div class="mb-0">
				        	<label for="desc" class="form-label"><?php _e("Avatar")?></label>
				        </div>
				        <div class="mb-3 border p-20 d-inline-block rounded">
				        	<?php if ( get_user("avatar") == "" ): ?>
				        		<img src="<?php _ec( get_module_path( __DIR__, "Assets/img/default.png" ) )?>" class="img-thumbnail avatar mw-100 mb-3 w-150 h-150">
				        		<input type="text" name="avatar" id="avatar" class="form-control form-control-solid d-none" placeholder="<?php _e("Select file")?>">
				        	<?php else: ?>
				        		<img src="<?php _ec( get_file_url(get_user("avatar")) )?>" class="img-thumbnail avatar mw-100 mb-3  w-150 h-150">
				        		<input type="text" name="avatar" id="avatar" class="form-control form-control-solid d-none" placeholder="<?php _e("Select file")?>" value="<?php _ec( get_user("avatar") )?>">
				        	<?php endif ?>
			                <div class="input-group w-100 ">
			                    <button type="button" class="btn btn-light-primary btn-sm btnOpenFileManager w-100" data-select-multi="0" data-type="image" data-id="avatar">
			                        <i class="fad fa-folder-open p-r-0"></i> <?php _e( "Select" )?>
			                    </button>
			                </div>
			            </div>

		  				<div class="mb-3">
			                <label for="fullname" class="form-label"><?php _e('Fullname')?></label>
			                <input type="text" class="form-control form-control-solid" id="fullname" name="fullname" value="<?php _e( get_user("fullname") )?>">
			            </div>

			            <div class="mb-3">
			                <label for="username" class="form-label"><?php _e('Username')?></label>
			                <input type="text" class="form-control form-control-solid" id="username" name="username" <?php _ec( !get_option("accept_change_username", 1)?"readonly":"" )?> value="<?php _e( get_user("username") )?>">
			            </div>
	  					
		  				<div class="mb-3">
			                <label for="email" class="form-label"><?php _e('Email')?></label>
			                <input type="text" class="form-control form-control-solid" id="email" name="email" <?php _ec( !get_option("accept_change_email", 1)?"readonly":"" )?> value="<?php _e( get_user("email") )?>">
			            </div>

			            <div class="mb-3">
			                <label for="language" class="form-label"><?php _e('Language')?></label>
			                <select name="language" class="form-control form-select form-control-solid">
		                    	<?php foreach ( $languages as $key => $value): ?>
		                    		<option value="<?php _e( $value->code ) ?>" <?php _e( get_user("language")==$value->code?"selected":"" )?> ><?php _e( $value->name )?></option>
		                    	<?php endforeach ?>
		                    </select>
			            </div>

			            <div class="mb-3">
		                    <label for="timezone" class="form-label"><?php _e('Timezone')?></label>
		                    <select name="timezone" class="form-control form-select form-control-solid">
		                    	<?php foreach ( tz_list() as $key => $value): ?>
		                    		<option value="<?php _e( $key ) ?>" <?php _e( get_user("timezone")==$key?"selected":"" )?> ><?php _e( $value )?></option>
		                    	<?php endforeach ?>
		                    </select>
		                </div>
	  				</div>
	  				<div class="card-footer d-flex justify-content-end px-3 py-30">
	  					<button class="btn btn-primary"><?php _e("Submit")?></button>
	  				</div>
		  		</div>
		  	</form>
	  	</div>
	  	<div class="tab-pane fade <?php _e( uri("segment", 3) == "change_password"?"show active":"" )?>" id="profile_change_password">
	  		<form class="actionForm" action="<?php _ec( base_url("profile/save_change_password") )?>">		
  				<div class="card">
		  			<div class="card-header">
		  				<div class="card-title">
		  					<span class="me-2"><i class="fad fa-key me-2 text-success"></i> <?php _e("Change password")?></span>
		  				</div>
		  			</div>
		  			<div class="card-body">
		  				<?php if ( get_user("password") != "" ): ?>
		  				<div class="mb-3">
			                <label for="old_password" class="form-label"><?php _e('Current password')?></label>
			                <input type="password" class="form-control form-control-solid" id="old_password" name="old_password" value="">
			            </div>
		  				<?php endif ?>

		  				<div class="mb-3">
			                <label for="password" class="form-label"><?php _e('New password')?></label>
			                <input type="password" class="form-control form-control-solid" id="password" name="new_password" value="">
			            </div>

			            <div class="mb-3">
			                <label for="confirm_password" class="form-label"><?php _e('Confirm new password')?></label>
			                <input type="password" class="form-control form-control-solid" id="confirm_password" name="confirm_new_password" value="">
			            </div>
	  				</div>
	  				<div class="card-footer d-flex justify-content-end px-3 py-30">
	  					<button type="submit" class="btn btn-primary"><?php _e("Submit")?></button>
	  				</div>
		  		</div>
		  	</form>
	  	</div>
	  	<div class="tab-pane fade <?php _e( uri("segment", 3) == "plan"?"show active":"" )?>" id="profile_plan">
	  		<div class="row">
	  			<div class="col-6">
	  				<div class="card mb-4">
			  			<div class="card-header">
			  				<div class="card-title">
			  					<span class="me-2"><i class="fad fa-box-open me-2 text-danger"></i> <?php _e("Plan Details")?></span>
			  				</div>
			  			</div>
			  			<div class="card-body text-center py-5">
		  					<div class="mb-5">
			  					<?php if ( !empty($plan) ): ?>
			  						<?php $expiration_date = get_user("expiration_date"); ?>

			  						<div class="fs-100 text-center">
				  						<i class="fad fa-starfighter text-warning"></i>
				  					</div>
			  						<div class="fs-25 fw-9"><?php _ec( $plan->name )?></div>
			  						<div class="mb-2"><?php _ec( $plan->description )?></div>
			  						<div class="text-center text-gray-500 fs-14">
			  							<?php if ( $expiration_date > time() ): ?>
			  								<?php _e( sprintf( __("Expire date: %s"), date_show( get_user("expiration_date") ) ) )?>
		  								<?php else: ?>

		  									<?php if ($expiration_date == 0): ?>
		  										<?php _e( sprintf( __("Expire date: %s"), __("Unlimited") ) )?>
		  									<?php else: ?>
		  										<span class="text-danger"><?php _e("Your account may have expired, but our service is still here for you.")?></span>
		  									<?php endif ?>

		  									
		  								<?php endif ?>
			  							
			  						</div>
			  					<?php else: ?>
			  						<div class="d-flex flex-column justify-content-center align-items-center text-gray-500 h-100 mih-300">
									    <i class="fad fa-puzzle-piece fs-70"></i>
									    <div class="text-gray-500 fs-20 mt-3"><?php _e("No plan found")?></div>
									</div>
			  					<?php endif ?>
		  					</div>

		  					<?php if(find_modules("payment")){ ?>
					            <?php if( get_user_data("is_subscription", 0) ){?>
					                <a href="<?php _e( base_url("payment/cancel_subscription") )?>" class="btn btn-danger b-r-30 actionItem" data-confirm="<?php _e("Are you sure want cancel your subscription?")?>" data-redirect=""><?php _e("Cancel automatic payments")?></a>
					            <?php }else{?>
					                <a href="<?php _e( base_url("pricing") )?>" class="btn btn-primary b-r-30"><?php _e("Upgrade your plan")?></a>
					            <?php }?>
					        <?php }?>   
		  				</div>
			  		</div>
	  			</div>
	  			<div class="col-6">
	  				<div class="card mb-4">
			  			<div class="card-header">
			  				<div class="card-title">
			  					<span class="me-2"><i class="fad fa-th-list me-2 text-info"></i> <?php _e("Permissions")?></span>
			  				</div>
			  			</div>
			  			<div class="card-body p-0 overflow-auto h-400">
		  					<ul class="list-group">
		  						<?php
		  							$permissions = json_decode( get_team("permissions") , 1);
                                    $plan_items = request_service("plans");
                                ?>

                                <?php if ( !empty($plan_items) ): ?>
                                    
                                    <?php foreach ($plan_items as $plan_item): ?>
                                        <li class="list-group-item px-4 py-3 border-top-0 border-start-0 border-end-0 d-flex align-items-center text-gray-700 fw-6"><?php _e( $plan_item["label"] )?></li>

                                        <?php if (!empty($plan_item['items'])): ?>

                                            <?php foreach ($plan_item['items'] as $key => $value): ?>
                                            	<?php if ( isset( $permissions[ $value['id'] ] ) ): ?>
                                                <li class="list-group-item px-4 py-3 border-top-0 border-start-0 border-end-0 d-flex align-items-center text-gray-600"><i class="me-2 fa fa-check text-success"></i><?php _e($value["name"])?></li>
                                            	<?php endif ?>
                                            <?php endforeach ?>
                                            
                                        <?php endif ?>
                                    <?php endforeach ?>

                                <?php endif ?>
							</ul>
		  				</div>
			  		</div>
	  			</div>
	  		</div>
	  	</div>
	  	<?php if (find_modules("payment")): ?>
	  	<div class="tab-pane fade <?php _e( uri("segment", 3) == "billing"?"show active":"" )?>" id="profile_billing">
	  		<form class="actionForm" action="<?php _ec( base_url("profile/save_bill_info") )?>">	
  				<div class="card mb-4">
		  			<div class="card-header">
		  				<div class="card-title">
		  					<span class="me-2"><i class="fad fa-info-circle text-warning me-2"></i> <?php _e("Billing info")?></span>
		  				</div>
		  			</div>
		  			<div class="card-body">
	  					<div class="row">
	  						<div class="col-6">
		  						<div class="mb-3">
					                <label for="bill_owner" class="form-label"><?php _e('Owner')?></label>
					                <input type="text" class="form-control form-control-solid" id="bill_owner" name="bill_owner" value="<?php _ec( get_user_data("bill_owner", "") )?>">
					            </div>
					        </div>
					        <div class="col-6">
				  				<div class="mb-3">
					                <label for="bill_tax_number" class="form-label"><?php _e('Tax number/ID')?></label>
					                <input type="text" class="form-control form-control-solid" id="bill_tax_number" name="bill_tax_number" value="<?php _ec( get_user_data("bill_tax_number", "") )?>">
					            </div>
		  					</div>
		  					<div class="col-12">
					            <div class="mb-3">
					                <label for="bill_address" class="form-label"><?php _e('Address')?></label>
					                <input type="text" class="form-control form-control-solid" id="bill_address" name="bill_address" value="<?php _ec( get_user_data("bill_address", "") )?>">
					            </div>
					        </div>
	  					</div>
	  				</div>
	  				<div class="card-footer d-flex justify-content-end px-3 py-30">
	  					<button type="submit" class="btn btn-primary"><?php _e("Submit")?></button>
	  				</div>
		  		</div>
		  	</form>

	  		<div class="card">
	  			<div class="card-header">
	  				<div class="card-title">
	  					<span class="me-2"><i class="fad fa-file-invoice-dollar me-2 text-danger"></i> <?php _e("Invoices")?></span>
	  				</div>
	  			</div>
	  			<div class="card-body p-0">
  					<div class="table-responsive">
  						<table class="table align-middle mb-0">
							<thead class="border-bottom text-uppercase">
						    	<tr>
									<th scope="col" class="text-gray-700 p-10">#</th>
									<th scope="col" class="text-gray-700 p-10"><?php _e("Date")?></th>
									<th scope="col" class="text-gray-700 p-10"><?php _e("Plan")?></th>
									<th scope="col" class="text-gray-700 p-10 text-center"><?php _e("Amount")?> (<span class="text-success"><?php _ec( get_option("payment_currency", "USD") )?></span>)</th>
									<th scope="col" class="text-gray-700 p-10"></th>
						    	</tr>
						  	</thead>
						  	<?php if ($invoices): ?>
						  	<tbody>
						  		<?php foreach ($invoices as $key => $value): ?>
							    <tr class="text-gray-600">
							      	<th scope="row" class="p-10">#<?php _e( str_pad($value->id, 5, "0", STR_PAD_LEFT) )?></th>
							      	<td class="aj p-10"><?php _e( datetime_show($value->created) )?></td>
						     	 	<td class="aj p-10"><?php _e( $value->plan_name )?></td>
						     	 	<td class="aj p-10 text-center"><?php _ec( get_option("payment_symbol", "$") )?><?php _e( number_format($value->amount, 2) )?></td>
							      	<td class="aj p-10 text-right d-flex justify-content-end px-3 py-30">
							      		<a href="<?php _ec( get_module_url("download_invoice/".$value->id) )?>" class="btn btn-outline btn-active-dark"><?php _e("Download")?></a>
							      	</td>
							    </tr>
						  		<?php endforeach ?>
						  	</tbody>
						  	<?php else: ?>
						  	<tbody>
						  		<tr>
						  			<td colspan="5">
								  		<div class="mw-400 container d-flex align-items-center align-self-center h-100 py-5">
										    <div>
										        <div class="text-center px-4">
										            <img class="mw-100 mh-300px" alt="" src="<?php _ec( get_theme_url() ) ?>Assets/img/empty.png">
										        </div>
										    </div>
										</div>
						  			</td>
								</tr>
							</tbody>
						  	<?php endif ?>
						</table>
  					</div>
  				</div>
	  		</div>

	  	</div>
	  	<?php endif ?>

  		<?php if (!empty($settings)): ?>
	  	<div class="tab-pane fade <?php _e( uri("segment", 3) == "settings"?"show active":"" )?>" id="profile_settings">	

  			<?php foreach ($settings as $key => $value): ?>
  				<?php if (is_array($value) && isset($value["data"]) && isset($value["data"]["content"])): ?>
  					<div class="mb-4">
  						<?php  _ec( $value["data"]["content"] ) ?>
  					</div>
  				<?php endif ?>
  			<?php endforeach ?>

	  	</div>
  		<?php endif ?>
	</div>
</div>