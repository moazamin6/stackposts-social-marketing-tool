<?php if ( !empty($result) ){ ?>
	
	<?php foreach ($result as $key => $value): ?>
		
		    <div class="card border mb-4 caption-item" data-id="<?php _ec($value->ids)?>">
		    	<textarea class="d-none"><?php _ec($value->content)?></textarea>
		        <div class="card-header border-0 pt-3">
		            <h3 class="card-title">
		                <span class="card-label fw-bold text-dark"><i class="fal fa-quote-left" style="color: <?php _ec( $config['color'] )?>;"></i> 
		                	<?php _ec($value->title)?>
		            	</span>
		            </h3>
		        </div>
		        <div class="card-body pt-3 check-wrap-all overflow-scroll mh-125 mb-2">
		            <?php _ec($value->content)?>
		        </div>
		        <div class="card-footer p-l-25 p-r-25 p-t-10 p-b-10 d-flex justify-content-between">
		        	<a href="<?php _ec( get_module_url("delete") )?>" class="btn btn-sm btn-light-danger btnDeleteCaption actionItem" data-confirm="<?php _e("Are you sure to delete this items?")?>" data-remove="caption-item" data-id="<?php _ec( $value->ids )?>"><i class="fad fa-trash-alt"></i> <?php _e("Delete")?></a>
		        	<button type="button" class="btn btn-sm btn-light-primary btnSelectCaption"><?php _e("Select")?> <i class="fad fa-chevron-right"></i></button>
		        </div>
		    </div>   

	<?php endforeach ?>

<?php }else{ ?>

	<?php if ($page == 0): ?>
	<div class="mw-400 container d-flex align-items-center align-self-center h-100">
	    <div>
	        <div class="text-center px-4">
	            <img class="mw-100 mh-300px" alt="" src="<?php _e( get_theme_url() ) ?>Assets/img/empty.png">
	        </div>
	    </div>
	</div>
	<?php endif ?>

<?php } ?>

