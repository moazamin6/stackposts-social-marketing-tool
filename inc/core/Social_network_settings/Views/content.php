<div class="container my-5">
    <?php if( !empty($block_tab) ){?>

        <?php foreach ($block_tab as $key => $value):?>
            
            <?php 
                if( isset($value['html']) && isset($value['html']['content']) ){
                    _ec( $value['html']['content'] );
                }
            ?>            

        <?php endforeach ?>

        <div class="m-t-25">
            <button type="submit" class="btn btn-primary"><?php _e("Save")?></button>
        </div>

    <?php }?>
</div>