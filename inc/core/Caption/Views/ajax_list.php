<?php if ( !empty($result) ){ ?>
	
	<?php foreach ($result as $key => $value): ?>
		
		<div class="col-md-4 col-sm-4 mb-4 caption-item">
		    <div class="card card-flush d-flex flex-column flex-row-auto h-250 b-r-10 card-shadow position-relative">
		    	<div class="text-success fs-40 position-absolute opacity-25 l-20">
	        		<i class="fad fa-quote-left"></i>
	        	</div>
		        <div class="card-header">
		        	
		        	<div class="d-flex justify-content-between w-100">
		            	<h4 class="card-title fs-16 text-gray-800"><?php _e($value->title)?></h4>
			            <div class="card-toolbar">
			            	<div class="dropdown dropdown-hide-arrow" data-dropdown-spacing="40">
		                        <a href="javascript:void(0);" class="dropdown-toggle d-block position-relative text-gray-500 p-0" data-toggle="dropdown" aria-expanded="true">
		                            <i class="fad fa-th-large pe-0 fs-20"></i>
		                        </a>
		                        <div class="dropdown-menu dropdown-menu-right p-20">
		                            <a class="dropdown-item" href="<?php _ec( get_module_url("index/update/".$value->ids) )?>"><i class="fad fa-edit text-primary"></i> <?php _e("Edit")?></a>
		                        	<a href="<?php _ec( get_module_url("delete") )?>" class="dropdown-item actionItem" data-confirm="<?php _e("Are you sure to delete this items?")?>" data-remove="caption-item" data-id="<?php _ec( $value->ids )?>"><i class="fad fa-trash-alt text-danger"></i> <?php _e("Delete")?></a>
		                        </div>
		                    </div>
			            </div>
		        	</div>
		        </div>
		        <div class="card-body">
		        	<div class="overflow-auto hide-x-scroll h-125 text-gray-600">
		            	<?php _e($value->content)?>
		        	</div>
		        </div>
		    </div>            
		</div>

	<?php endforeach ?>

<?php }else{ ?>
	<div class="mw-400 container d-flex align-items-center align-self-center h-100 py-5">
	    <div>
	        <div class="text-center px-4">
	            <img class="mw-100 mh-300px" alt="" src="<?php _e( get_theme_url() ) ?>Assets/img/empty.png">
	            <a href="<?php _ec( get_module_url("index/update") )?>" class="btn btn-primary btn-sm mt-4 b-r-30"><i class="fad fa-plus"></i> <?php _e("Add new")?></a>
	        </div>
	    </div>
	</div> 
<?php }?>
