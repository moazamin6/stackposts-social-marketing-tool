<div class="container my-5">

    <div class="card">
        <div class="card-header">
            <div class="card-title">
               <i class="fad fa-envelope-open-text fs-18 text-primary me-2"></i> <?php _e("Mail template")?>
            </div>
        </div>
        <div class="card-body">
            <?php if (!empty($templates)): ?>
            <div class="row">
                <?php foreach ($templates as $key => $value): ?>
                    
                    <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
                        <div class="card b-r-6 border ">
                            <div class="card-body p-0 overflow-hidden b-r-6 rounded-bottom-0">
                                <img src="<?php _e($value['thumbnail'])?>" class="w-100 p-0">
                                
                            </div>
                            <div class="card-footer d-flex justify-content-between align-items-center px-3 py-3">
                                <div class="text-gray-800"><?php _ec(str_replace("_", " ", $value['name']))?></div>
                                <?php if (get_option("mail_template", "Dora") == $value['name']): ?>
                                    <button class="btn btn-primary disabled btn-sm"><?php _e("Activated")?></button>
                                <?php else: ?>
                                    <a class="btn btn-dark btn-sm actionItem" href="<?php _ec( get_module_url("active_template/".$value['name']) )?>" data-redirect="<?php _ec( get_module_url() )?>"><?php _e("Active")?></a>
                                <?php endif ?>
                            </div>
                        </div>
                    </div>

                <?php endforeach ?>
            </div>
            <?php endif ?>
        </div>
    </div>
</div>
