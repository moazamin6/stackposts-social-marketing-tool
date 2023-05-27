<?php if ( !empty($result) ): ?>
	
	<?php foreach ($result as $key => $value): ?>
		
		<tr class="item">
		    <td class="border-bottom py-4 ps-4">
		        <div class="form-check form-check-sm form-check-custom form-check-solid me-3">
		            <input class="form-check-input checkbox-item" type="checkbox" name="ids[]" value="<?php _e( $value->ids )?>">
		        </div>
		    </td>
		    <td class="border-bottom py-4"><?php _ec( $value->proxy )?></td>
		    <td class="border-bottom py-4"><?php _ec( list_countries($value->location) )?></td>
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
		    <td class="border-bottom py-4"><?php _e( datetime_show( $value->created ) )?></td>
		    <td class="text-end border-bottom text-nowrap pe-4">
		    	<div class="dropdown dropdown-fixed dropdown-hide-arrow">
				  	<button class="btn btn-light btn-active-light-primary btn-sm dropdown-toggle px-3" type="button" data-bs-toggle="dropdown" aria-expanded="false">
				    	<i class="fad fa-th-list pe-0"></i>
				  	</button>
				  	<ul class="dropdown-menu dropdown-menu-end">
				    	<li>
				    		<a href="<?php _e( get_module_url('index/update/'.$value->ids) )?>" class="actionItem dropdown-item" data-remove-other-active="true" data-active="bg-light-primary" data-result="html" data-content="main-wrapper" data-history="<?php _e( get_module_url('index/update/'.$value->ids) )?>" data-call-after="Core.calendar();">
			                	<i class="fad fa-pen-square pe-2"></i> <?php _e('Edit')?>
			                </a>
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
<?php else: ?>
	<?php if (post("current_page") == 1): ?>
	<tr>
        <td colspan="6" class="border-0">
            <div class="d-flex align-items-center align-self-center h-100 mih-500">
                <div class="w-100 text-center">
                    <div class="text-center px-4">
                        <img class="mh-190 mb-4" alt="" src="<?php _e( get_theme_url() ) ?>Assets/img/empty2.png">
                    </div>
                    <a href="<?php _ec( get_module_url("index/update") )?>" class="btn btn-primary btn-sm b-r-30"><i class="fad fa-plus"></i> <?php _e("Add new")?></a>
                </div>
            </div>
        </td>
    </tr>
	<?php endif ?>
<?php endif ?>
