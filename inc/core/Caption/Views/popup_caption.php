<div class="popup-caption bg-white d-flex flex-column flex-row-auto h-100" data-id="<?php _ec($name)?>">
	<div class="card-header p-r-20 p-l-20">
		<h3 class="card-title"><?php _e("Caption")?></h3>
        <div class="card-toolbar">
            <button type="button" class="btn btn-sm btn-light btnCloseCaption">
                <?php _e("Close")?>
            </button>
        </div>
	</div>

	<div class="card-body p-20 position-relative ajax-load-scroll-1 overflow-auto" data-url="<?php _e( get_module_url("load_captions") )?>" data-scroll="ajax-load-scroll-1">
		
	</div>

	<script type="text/javascript">
		$(function(){
			Core.call_load_scroll(1);
			Core.ajax_load_scroll(false, 1)
		});
	</script>
</div>
