<?php if ( !empty($result) ): ?>
	
	<?php foreach ($result as $key => $value): ?>
		
		<tr class="item">
		    <th scope="row" class="py-3 ps-4 border-bottom">
		        <div class="form-check form-check-sm form-check-custom form-check-solid me-3">
		            <input class="form-check-input checkbox-item" type="checkbox" name="ids[]" value="<?php _e( $value->ids )?>">
		        </div>
		    </th>
		    <td class="border-bottom">
		    	<div class="d-flex align-items-center">
		    		<div class="symbol symbol-50px overflow-hidden me-3">
						<a href="<?php _e( get_module_url('index/update/'.$value->ids) )?>" class="actionItem" data-remove-other-active="true" data-active="bg-light-primary" data-result="html" data-content="main-wrapper" data-history="<?php _e( get_module_url('index/update/'.$value->ids) )?>" data-call-after="Core.calendar();">
							<div class="symbol-label b-r-10">
								<img src="<?php _ec( get_file_url($value->avatar) )?>" class="w-100 border b-r-10">
							</div>
						</a>
					</div>
					<div class="d-flex flex-column">
						<a href="<?php _e( get_module_url('index/update/'.$value->ids) )?>" class="text-gray-800 text-hover-primary fw-6 actionItem" data-remove-other-active="true" data-active="bg-light-primary" data-result="html" data-content="main-wrapper" data-history="<?php _e( get_module_url('index/update/'.$value->ids) )?>" data-call-after="Core.calendar();"><?php _ec( $value->fullname )?></a>
			        	<span class="text-gray-400"><?php _ec( $value->email )?></span>
					</div>
		    	</div>
		    </td>
		    <td class="border-bottom py-3 text-center"><i class="fs-18 <?php _ec( $value->is_admin?"fad fa-check-circle text-primary":"fad fa-times-circle text-dark" )?>"></i></td>
		    <td class="border-bottom"><?php _ec( ($value->role_name != "")?$value->role_name:_ec("None") )?></td>
		    <td class="border-bottom"><?php _ec( $value->plan_name )?></td>
		    <td class="border-bottom"><?php _ec( $value->expiration_date?date_show( $value->expiration_date ):__("Unlimited") )?></td>
		    <td class="border-bottom text-center">
		    	<?php
		    		switch ($value->login_type) {
		    			case 'google':
		    				$login_type = '<i class="fs-18 fab fa-google" style="color: #ea4335" title="Google"></i>';
		    				break;

		    			case 'facebook':
		    				$login_type = '<i class="fs-18 fab fa-facebook-square" style="color: #4267b3" title="Facebook"></i>';
		    				break;

		    			case 'twitter':
		    				$login_type = '<i class="fs-18 fab fa-twitter" style="color: #08a0e9" title="Twitter"></i>';
		    				break;
		    			
		    			default:
		    				$login_type = '<i class="fs-18 fas fa-location-circle text-dark" title="Direct"></i>';
		    				break;
		    		}

		    	?>

		    	<?php _ec( $login_type )?>
		    </td>
		    <td class="border-bottom">
		    	<?php
		    		switch ($value->status) {
		    			case 1:
		    				$status = '<span class="badge badge-light-warning fw-4 fs-12 p-6">'.__("Inactive").'</span>';
		    				break;

		    			case 2:
		    				$status = '<span class="badge badge-light-success fw-4 fs-12 p-6">'.__("Active").'</span>';
		    				break;

		    			default:
		    				$status = '<span class="badge badge-light-danger fw-4 fs-12 p-6">'.__("Banned").'</span>';
		    				break;
		    		}

		    	?>

		    	<?php _ec( $status )?>
		    </td>
		    <td class="border-bottom"><?php _e( datetime_show( $value->created ) )?></td>
		    <td class="text-end border-bottom text-nowrap py-4 pe-4">
		    	<div class="dropdown dropdown-fixed dropdown-hide-arrow">
				  	<button class="btn btn-light btn-active-light-primary btn-sm dropdown-toggle px-3" type="button" data-bs-toggle="dropdown" aria-expanded="false">
				    	<i class="fad fa-th-list pe-0"></i>
				  	</button>
				  	<ul class="dropdown-menu dropdown-menu-end">
				  		<?php 
				  		if(!empty($actions)){
		                    foreach ($actions as $action) {
		                    	$data = $action['data'];
		                    	$data = str_replace("__user_id__", $value->id, $data);
		                    	$data = str_replace("__expiration_date__", $value->expiration_date, $data);
		                    	$data = str_replace("__user_ids__", $value->ids, $data);

		                        _ec( $data );
		                    }
		                }
			  		 	?>
				    	<li>
				    		<a href="<?php _e( get_module_url('index/update/'.$value->ids) )?>" class="actionItem dropdown-item" data-remove-other-active="true" data-active="bg-light-primary" data-result="html" data-content="main-wrapper" data-history="<?php _e( get_module_url('index/update/'.$value->ids) )?>" data-call-after="Core.calendar();">
			                	<i class="fad fa-pen-square pe-2"></i> <?php _e('Edit')?>
			                </a>
				    	</li>
				    	<li>
				    		<a class="dropdown-item actionItem" href="<?php _e( get_module_url('view/'.$value->ids) )?>" data-redirect="<?php _ec( base_url("dashboard") )?>"><i class="fad fa-eye pe-2"></i> <?php _e("Preview as user")?></a>
				    	</li>
				    	<li>
				    		<a href="<?php _e( get_module_url('delete/'.$value->ids) )?>" class="actionItem dropdown-item" data-confirm="<?php _e('Are you sure to delete this items?')?>" data-remove="item" data-active="bg-light-primary">
				    			<i class="fad fa-trash-alt pe-2"></i> <?php _e("Delete")?>
				    		</a>
				    	</li>
				  	</ul>
				</div>
			</td>
		</tr>

	<?php endforeach ?>

<?php endif ?>
