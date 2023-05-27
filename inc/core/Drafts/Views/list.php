<div class="container my-5">
    <div class="d-flex flex-column flex-row-auto h-100">
        <div class="bd-search position-relative me-auto">
            <h1><i class="<?php _e( $config['icon'] )?>" style="color: <?php _e( $config['color'] )?>;" ></i> <?php _e( $config['name'] )?></h1>
        </div>
    </div>
</div>

<?php if ( get_data($datatable, "total_items") != 0 ): ?>
    

<div class="container schedules-main">
    <div 
            class="ajax-pages" 
            data-url="<?php _ec( get_module_url("ajax_list") )?>" 
            data-response=".ajax-result" 
            data-per-page="<?php _ec( get_data($datatable, "per_page") )?>"
            data-current-page="<?php _ec( get_data($datatable, "current_page") )?>"
            data-total-items="<?php _ec( get_data($datatable, "total_items") )?>"
        >

        <div class="schedule-list h-100 overflow-auto ajax-result row mt-4"></div>

        <nav class="m-t-50 m-b-50 ajax-pagination m-auto text-center"></nav>
    </div>
</div>

<script type="text/javascript">
    $(function(){
        Core.ajax_pages();
    });
</script>
<?php else: ?>

<div class="mw-400 container d-flex align-items-center align-self-center h-400 py-5">
    <div class="text-center">
        <div class="text-center px-4 mb-4">
            <img class="mw-100 mh-300px" alt="" src="<?php _e( get_theme_url() ) ?>Assets/img/empty.png">
        </div>
        <h3 class="mb-4"><?php _e("There are no drafts")?></h3>
        <div><a href="<?php _ec( base_url("post") )?>" class="btn btn-primary btn-sm"><?php _e("Compose a Post")?></a></div>
    </div>
</div> 
    
<?php endif ?>