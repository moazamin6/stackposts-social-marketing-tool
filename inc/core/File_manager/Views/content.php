<form class="fm-content fm-form flex-grow-1">
	<div class="fm-progress-bar bg-primary"></div>
	<div class="fm-list row px-2 py-4 ajax-load-scroll m-l-0 m-r-0 n-scroll align-content-start" data-url="<?php _e( get_module_url("load_files") )?>" data-scroll="ajax-load-scroll" data-call-after="File_manager.lazy();">
		<div class="fm-empty text-center fs-90 text-muted h-100 d-flex flex-column align-items-center justify-content-center">
			<img class="mh-190 mb-4" alt="" src="<?php _e( get_theme_url() ) ?>Assets/img/empty2.png">
		</div>
	</div>
	<div class="ajax-loading text-center bg-primary"></div>
</form>