<div class="card-header">
    <div class="card-title"><span class="icon p-r-10"><i class="fad fa-eye"></i></span> <?php _e("Preview")?></div>
</div>

<div class="card-body">
    <div class="alert alert-success p-20 d-flex justify-content-between mb-0">
        <div class="d-flex align-items-center"><?php _e( sprintf( __("You're scheduling %s posts to %s social accounts") , $post_success, count($accounts)) )?></div>
    </div>
</div>

<div class="d-flex justify-content-between m-l-34 m-r-34 pt-3 pb-2">
	<h3><i class="fad fa-exclamation-square text-danger me-1"></i> <?php _e("Post errors")?></h3>
	<div class="text-danger"><?php _e( sprintf( __("%s posts with errors") , $post_errors) )?></div>
</div>

<div class="card-body mh-800 overflow-auto pt-0">
    <?php if (!empty($bulks)): ?>
    	
    	<?php foreach ($bulks as $key => $value): ?>

    		<?php
    			$account = $value->account;
	    		$data = json_decode($value->data);
	    	?>
	    		
    		<div class="card border mb-3 <?php _e( $value->status == 4?"border-danger":"" )?>">
		        <div class="card-body d-flex p-15 justify-content-between">
		            
		            <div class="d-flex">
		                <div class="d-flex">
		                	<div class="d-flex align-items-center me-3">
		                		<a href="" title="<?php _ec( $value->result )?>" data-toggle="tooltip" data-placement="top">
		                			<i class="fad fa-radiation fa-spin fs-20 <?php _e( $value->status == 4?"text-danger":"text-success" )?>"></i>
		                		</a>
		                	</div>
		                	<?php if ($value->type == "media"){ ?>
		                		<img src="<?php _e( $data->medias[0] )?>" class="img-thumbnail me-3 mw-75 mh-75">
		                	<?php }else if($value->type == "link"){ ?>
		                		<a href="<?php _ec( $data->link )?>" class="bg-white me-3 miw-75 mih-75 border rounded d-flex align-items-center justify-content-center" target="_blank">
			                        <i class="fad fa-link fs-30 text-success"></i>
			                    </a>
		                	<?php }else{ ?>
		                		<div class="bg-white me-3 miw-75 mih-75 border rounded d-flex align-items-center justify-content-center">
			                        <i class="fad fa-align-center fs-30 text-success"></i>
			                    </div>
		                	<?php } ?>
		                    
		                    <div class="d-flex flex-column">

		                    	<?php if ($value->type == "media"){ ?>
			                		<div class="h-50 overflow-auto mb-2 text-gray-600 fs-13">
			                            <?php _ec( $data->caption )?>
			                        </div>
			                	<?php }else if($value->type == "link"){ ?>
			                		<div class="h-35 overflow-auto mb-2 text-gray-600 fs-13">
			                            <?php _ec( $data->caption )?>
			                        </div>
			                        <div class="text-gray-400 fs-13">
			                        	<i class="fad fa-link"></i> <a href="<?php _ec( $data->link )?>" class="text-gray-400 text-active-primary" target="_blank"><?php _ec( $data->link )?></a>
			                        </div>
			                	<?php }else{ ?>
			                		<div class="h-50 overflow-auto mb-2 text-gray-600 fs-13">
			                            <?php _ec( $data->caption )?>
			                        </div>
			                	<?php } ?>
		                        
		                        <div class="fs-12 text-gray-400"> 
		                            <i class="fad fa-calendar-alt"></i> <?php _e( datetime_show( $value->time_post ) )?>
		                        </div>
		                    </div>
		                </div>

		            </div>


		            <div class="d-flex">
			            <div class="d-flex align-items-center ms-3 me-3">
			                <a href="javascript:void(0);" class="text-danger" title="<?php _ec( ucfirst($account->social_network).": ".$account->name )?>" data-toggle="tooltip" data-placement="top">
			                    <img src="<?php _ec( get_file_url( $account->avatar ) )?>" class="rounded w-50 h-50 border p-3" >
			                </a>
			            </div>
		            </div>

		        </div>
		    </div>

    	<?php endforeach ?>

    <?php endif ?>

</div>

<div class="card-footer d-flex justify-content-end">
    <button class="btn btn-success"><?php _e("Save & Schedules")?></button>
</div>