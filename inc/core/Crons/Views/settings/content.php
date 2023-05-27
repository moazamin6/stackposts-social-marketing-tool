<div class="container d-sm-flex align-items-md-center pt-4 align-items-center justify-content-center">
    <div class="bd-search position-relative me-auto">
        <h2 class="mb-0 py-4 text-gray-800"> <i class="<?php _ec( $config['icon'] )?> me-2" style="color: <?php _ec( $config['color'] )?>;"></i> <?php _e($config['name'])?></h2>
    </div>
    <div class="">
        <div class="dropdown me-2">
            <div class="input-group input-group-sm sp-input-group border b-r-4">
                <span class="input-group-text border-0 fs-20 bg-gray-100 text-gray-800" id="sub-menu-search"><i class="fad fa-search"></i></span>
                <input type="text" class="form-control form-control-solid ps-15 border-0 search-input" data-search="cron-item" name="keyword" value="" placeholder="<?php _e("Search")?>" autocomplete="off">
            </div>
        </div>
    </div>
</div>

<div class="container my-4">
    <?php if (!empty( $crons )): ?>
        
        <?php foreach ($crons as $key => $cron): ?>
            
            <div class="card shadow-sm mb-4 cron-item">
                <div class="card-header">
                    <h3 class="card-title"><?php _e( $cron['name'] )?></h3>
                </div>
                <div class="card-body bg-gray-200 text-gray-800">
                    <pre class="m-b-0"><?php _ec( $cron['style'] )?> <?php _ec( base_url( $cron['uri']) )?></pre>
                </div>
            </div>

        <?php endforeach ?>

    <?php endif ?>
</div>