<div class="container d-sm-flex align-items-md-center pt-4 align-items-center justify-content-center">
    <div class="bd-search position-relative me-auto">
        <h2 class="mb-0 py-4 text-gray-800"> <i class="<?php _ec( $config['icon'] )?> me-2" style="color: <?php _ec( $config['color'] )?>;"></i> <?php _e($config['name'])?></h2>
    </div>
    <div class="">
        <div class="dropdown me-2">
            <div class="input-group input-group-sm sp-input-group border b-r-4">
                <span class="input-group-text border-0 fs-20 bg-gray-100 text-gray-800" id="sub-menu-search"><i class="fad fa-search"></i></span>
                <input type="text" class="ajax-pages-search ajax-filter form-control form-control-solid ps-15 border-0" name="keyword" value="" placeholder="<?php _e("Search")?>" autocomplete="off">
                <a href="<?php _ec( get_module_url("index/update") )?>" class="btn btn-light btn-active-light-primary" title="<?php _e("Add new")?>" data-toggle="tooltip" data-placement="top"><i class="fad fa-plus text-primary pe-0"></i></a>
            </div>
        </div>
    </div>
</div>
<?php if (get_data($datatable, "total_items") != 0): ?>
<div class="container">
    <div 
            class="ajax-pages" 
            data-url="<?php _ec( get_module_url("ajax_list") )?>" 
            data-response=".ajax-result" 
            data-per-page="<?php _ec( get_data($datatable, "per_page") )?>"
            data-current-page="<?php _ec( get_data($datatable, "current_page") )?>"
            data-total-items="<?php _ec( get_data($datatable, "total_items") )?>"
        >

        <div class="ajax-result row mt-4"></div>

        <nav class="m-t-50 m-b-50 ajax-pagination m-auto text-center"></nav>
    </div>
</div>

<script type="text/javascript">
    $(function(){
        Core.ajax_pages();
    });
</script>
<?php else: ?>
<div class="container">
    <div class="d-flex align-items-center align-self-center h-100 mih-500">
        <div class="w-100">
            <div class="text-center px-4">
                <img class="mh-190 mb-4" alt="" src="<?php _e( get_theme_url() ) ?>Assets/img/empty2.png">
            </div>
        </div>
    </div>
</div>
<?php endif ?>
