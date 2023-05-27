<div class="container py-5">
	
	<form class="actionForm" action="<?php _ec( get_module_url("save_sender") )?>" method="POST">
		<div class="card mb-4">
			<div class="card-header">
				<div class="card-title">
					<?php _e("Sender information")?>
				</div>
			</div>
			<div class="card-body">
				<div class="row">
					<div class="col-12">
						<div class="mb-4">
		                    <label for="website_description" class="form-label"><?php _e('Mail Protocol')?></label>
		                    <div>
		                        <div class="form-check form-check-inline">
		                            <input class="form-check-input" type="radio" name="sender_protocol" <?php _e( get_option("sender_protocol", 1)==1?"checked":"" )?> id="role-user" value="1">
		                            <label class="form-check-label" for="role-user"><?php _e('Mail')?></label>
		                        </div>
		                        <div class="form-check form-check-inline">
		                            <input class="form-check-input" type="radio" name="sender_protocol" <?php _e( get_option("sender_protocol", 1)==2?"checked":"" )?> id="role-admin" value="2">
		                            <label class="form-check-label" for="role-admin"><?php _e('SMTP')?></label>
		                        </div>
		                    </div>
		                </div>
					</div>
					<div class="col-6">
						<div class="mb-3">
							<label class="form-label" for="sender_email"><?php _e("Sender email")?></label>
							<input type="email" id="sender_email" name="sender_email" class="form-control form-control-solid" value="<?php _e( get_option("sender_email", "example@gmail.com") )?>">
						</div>
					</div>
					<div class="col-6">
						<div class="mb-3">
							<label class="form-label" for="sender_name"><?php _e("Sender name")?></label>
							<input type="text" id="sender_name" name="sender_name" class="form-control form-control-solid" value="<?php _e( get_option("sender_name", "Stackposts") )?>">
						</div>
					</div>
				</div>
			</div>
			<div class="card-footer d-flex justify-content-end py-3">
				<button type="submit" class="btn btn-dark btn-sm"><?php _e("Save")?></button>
			</div>
		</div>
	</form>
	<form class="actionForm" action="<?php _ec( get_module_url("save_sender") )?>">
		<div class="card">
			<div class="card-header">
				<div class="card-title">
					<?php _e("SMTP Server")?>
				</div>
				<div class="card-toolbar">
					<a href="<?php _ec( get_module_url("poupup_add_smtp") )?>" class="btn btn-primary btn-sm actionItem" data-popup="addSMTPModal"><i class="fad fa-plus"></i> <?php _e("Add new")?></a>
				</div>
			</div>
			<div class="card-body">
				<div class="table-responsive">
					<table class="table align-middle">
					  	<thead class="border-bottom">
						    <tr class="border-bottom">
						      <th class="border-bottom text-over" scope="col"><?php _e("Server")?></th>
						      <th class="border-bottom text-over" scope="col"><?php _e("Username")?></th>
						      <th class="border-bottom text-over" scope="col"><?php _e("Password")?></th>
						      <th class="border-bottom text-over" scope="col"><?php _e("Port")?></th>
						      <th class="border-bottom text-over" scope="col"><?php _e("Encryption")?></th>
						      <th class="border-bottom text-over" scope="col"><?php _e("Status")?></th>
						      <th class="border-bottom text-over w-80" scope="col"></th>
						    </tr>
					  	</thead>
			  			<tbody>
						    
					    	<?php if (!empty($result)): ?>
					    	
					    		<?php foreach ($result as $key => $value): ?>
					    		<tr class="item border-bottom">
									<td ><?php _ec( $value->server )?></td>
									<td ><?php _ec( $value->username )?></td>
									<td ><?php _ec( $value->password )?></td>
									<td ><?php _ec( $value->port )?></td>
									<td ><?php _ec( $value->encryption )?></td>
									<td class="border-bottom py-4">
								    	<?php
								    		switch ($value->status) {
								    			case 1:
								    				$status = '<span class="badge badge-light-success fw-4 fs-12 p-6">'.__("Enable").'</span>';
								    				break;

								    			default:
								    				$status = '<span class="badge badge-light-dark fw-4 fs-12 p-6">'.__("Disable").'</span>';
								    				break;
								    		}

								    	?>

								    	<?php _ec( $status )?>
								    </td>
									<td>
										<div class="dropdown dropdown-fixed">
										  	<button class="btn btn-light btn-active-light-primary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
										    	<?php _e("Actions")?>
										  	</button>
										  	<ul class="dropdown-menu dropdown-menu-end">
										    	<li>
										    		<a href="<?php _ec( get_module_url("poupup_add_smtp/".$value->ids) )?>" class="actionItem dropdown-item" data-popup="addSMTPModal"><?php _e("Edit")?></a>
										    	</li>
										    	<li>
										    		<a href="<?php _e( get_module_url('delete_smtp/'.$value->ids) )?>" data-confirm="<?php _e("Are you sure to delete this items?")?>" class="actionItem dropdown-item" data-remove="item" data-active="bg-light-primary">
										    		<?php _e("Delete")?></a>
										    	</li>
										  	</ul>
										</div>
									</td>
								</tr>
					    		<?php endforeach ?>

					    	<?php else: ?>
					    		<tr>
							    	<td colspan="6" class="py-5">
							    		<div class="mw-400 container d-flex align-items-center align-self-center h-100">
										    <div>
										        <div class="text-center px-4">
										            <img class="mw-100 mh-300px" alt="" src="<?php _e( get_theme_url() ) ?>Assets/img/empty.png">
										        </div>
										    </div>
										</div>
							    	</td>
						    	</tr>
					    	<?php endif ?>
					    
					  	</tbody>
					</table>
				</div>
			</div>
		</div>
	</form>
</div>