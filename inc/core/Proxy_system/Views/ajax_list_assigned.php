<?php if ( !empty($result) ): ?>
	
	<?php foreach ($result as $key => $value): ?>
		
		<tr class="item">
		    <td class="border-bottom ps-4">
		        <div class="form-check form-check-sm form-check-custom form-check-solid me-3">
		            <input class="form-check-input checkbox-item" type="checkbox" name="ids[]" value="<?php _e( $value->ids )?>">
		        </div>
		    </td>
		    <td class="d-flex align-items-center border-bottom py-3">
		    	<div class="symbol symbol-50px overflow-hidden me-3">
					<div class="symbol-label b-r-10">
						<img src="<?php _ec( get_file_url($value->avatar) )?>" class="w-100 border b-r-10">
					</div>
				</div>
				<div class="d-flex flex-column">
					<?php _ec( $value->account_name )?>
		        	<span class="text-gray-400"><?php _ec( ucfirst( str_replace("_", " ", $value->social_network) ) )?></span>
				</div>
		    </td>
		    <td class="border-bottom py-3">
				<div class="d-flex flex-column">
					<?php _ec( $value->fullname )?>
		        	<span class="text-gray-400"><?php _ec( $value->email )?></span>
				</div>
		    </td>
		    <td class="border-bottom py-3"><i class="fs-18 <?php _ec( $value->is_system?"fad fa-circle text-success":"fad fa-circle text-gray-300" )?>"></i></td>
		    <td class="border-bottom py-3"><?php _ec( $value->proxy )?></td>
		    <td class="border-bottom py-3 pe-4">
		    	<?php if ($value->location != ""): ?>
		    		<?php _ec( list_countries($value->location) )?>
		    	<?php endif ?>
			</td>
		</tr>

	<?php endforeach ?>

<?php else: ?>
	<?php if (post("current_page") == 1): ?>
	<tr>
        <td colspan="8" class="border-0">
            <div class="d-flex align-items-center align-self-center h-100 mih-500">
                <div class="w-100 text-center">
                    <div class="text-center px-4">
                        <img class="mh-190 mb-4" alt="" src="<?php _e( get_theme_url() ) ?>Assets/img/empty2.png">
                    </div>
                </div>
            </div>
        </td>
    </tr>
	<?php endif ?>
<?php endif ?>
