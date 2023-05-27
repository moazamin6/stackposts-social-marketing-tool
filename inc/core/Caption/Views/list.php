<div class="container d-sm-flex align-items-md-center pt-4 align-items-center justify-content-center">
    <div class="bd-search position-relative me-auto">
        <h2 class="mb-0 py-4"> <i class="<?php _ec( $config['menu']['icon'] )?> me-2" style="color: <?php _ec( $config['menu']['color'] )?>;"></i> <?php _e( $config['menu']['sub_menu']['name'] )?></h2>
    </div>
    <div class="">
        <div class="dropdown">
            <div class="input-group input-group-sm sp-input-group border b-r-4">
                <span class="input-group-text border-0 fs-20 bg-gray-100 text-gray-800" id="sub-menu-search"><i class="fad fa-search"></i></span>
                <input type="text" class="ajax-pages-search ajax-filter form-control form-control-solid ps-15 border-0" name="keyword" value="" placeholder="Search" autocomplete="off">
                <a href="<?php _ec( get_module_url("index/update") )?>" class="btn btn-light btn-active-light-primary" title="<?php _e("Add new")?>" data-toggle="tooltip" data-placement="top"><i class="fad fa-plus text-primary pe-0"></i></a>
            </div>
        </div>
    </div>
</div>
<div class="container mt-4">
    <div 
            class="ajax-pages" 
            data-url="<?php _ec( get_module_url("ajax_list") )?>" 
            data-response=".ajax-result" 
            data-per-page="<?php _ec( get_data($datatable, "per_page") )?>"
            data-current-page="<?php _ec( get_data($datatable, "current_page") )?>"
            data-total-items="<?php _ec( get_data($datatable, "total_items") )?>"
        >

        <div class="ajax-result row"></div>

        <?php if (get_data($datatable, "total_items") != 0): ?>
        <nav class="m-t-50 ajax-pagination m-auto text-center mb-4"> </nav>
        <?php endif ?>
    </div>
</div>

<script type="text/javascript">
    $(function(){
        Core.ajax_pages();
    });
</script>