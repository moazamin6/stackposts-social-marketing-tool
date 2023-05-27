<?php if ( !empty($result) ){ ?>
	
	<?php foreach ($result as $key => $value): ?>
		
		<div class="col-md-4 col-sm-4 mb-4 caption-item">
		    <div class="card d-flex flex-column flex-row-auto h-250">
		        <div class="card-header border-0 pt-4 px-4">
		            <h3 class="card-title mb-3 text-over">
		                <span class="card-label fw-bold fs-16 text-over text-gray-800">
		                	<?php _e($value->title)?>
		            	</span>
		            </h3>
		        </div>
		        <div class="card-body pt-0 check-wrap-all overflow-auto h-70 mb-4 px-4 text-gray-600 hidden-x-scroll">
		            <?php _e($value->content)?>
		        </div>
		        <div class="card-footer px-4 p-t-10 p-b-10 d-flex justify-content-between">
		        	<a href="<?php _ec( get_module_url("delete") )?>" class="btn btn-sm btn-light-danger btnDeleteCaption actionItem" data-confirm="<?php _e("Are you sure to delete this items?")?>" data-remove="caption-item" data-id="<?php _ec( $value->ids )?>"><i class="fad fa-trash-alt"></i> <?php _e("Delete")?></a>

		        	<a href="<?php _ec( get_module_url("index/update/".$value->ids) )?>" class="btn btn-sm btn-light-primary"><i class="fad fa-edit"></i> <?php _e("Edit")?></a>
		        </div>
		    </div>            
		</div>

	<?php endforeach ?>

<?php }else{ ?>
	<div class="mw-400 container d-flex align-items-center align-self-center h-100 py-5">
	    <div>
	        <div class="text-center px-4">
	            <img class="mw-100 mh-300px" alt="" src="<?php _e( get_theme_url() ) ?>Assets/img/empty.png">
	        </div>
	    </div>
	</div> 
<?php }?>
