<?php if( !empty($result) ){?>
<div class="d-flex align-items-stretch ms-3">
    <div class="d-flex align-items-center">
        <div class="dropdown dropdown-hide-arrow" data-dropdown-spacing="40">
            <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                <div class="text-gray-800 d-flex align-items-center fs-18"><i class="<?php _ec( $default->icon )?>"></i></div>
            </a>
            <div class="dropdown-menu dropdown-menu-right" >
            	<?php foreach ($result as $key => $value): ?>
                	<a class="dropdown-item py-2 actionItem" href="<?php _ec( base_url("auth/language/".$value->ids) )?>" data-redirect=""><i class="<?php _ec($value->icon)?>"></i> <?php _ec($value->name)?></a>
	  			<?php endforeach ?>
            </div>
        </div>
    </div>
</div>
<?php }?> 