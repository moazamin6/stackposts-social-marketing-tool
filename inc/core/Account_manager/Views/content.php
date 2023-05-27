<div class="container">
    
    <div class="row no-gutters px-2 py-5 m-auto">
        <div class="sub-header">
            <?php if( isset($config) ){?>
                <h1 class="d-flex fw-bold my-0 fs-20 mb-5"><i class="<?php _ec( $config['icon'] )?> pe-3" style="color: <?php _ec( $config['color'] )?>;"></i> <?php _e( $config['name'] )?></h1>
            <?php }?>
        </div>

        <?php if( !empty($block_accounts) ){?>

            <?php foreach ($block_accounts as $key => $value): ?>
                
                <?php _ec( $value['data']['content'] )?>

            <?php endforeach ?>

        <?php }?>
    </div>

</div>    