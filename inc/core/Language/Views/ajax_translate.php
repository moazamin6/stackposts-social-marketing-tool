<?php if ( !empty($result) ): ?>
    
    <?php foreach ($result as $key => $value): ?>
        
        <tr class="item">
            <td class="border-bottom py-4 ps-4">
                <form class="actionForm" method="POST" action="<?php _ec( get_module_url("save_item") )?>" data-loading="0">
                    <input type="hidden" name="ids" value="<?php _ec( $value->ids )?>">
                    <textarea class="form-control form-control-solid auto-submit" name="text"><?php _ec( $value->text )?></textarea>
                </form>
            </td>
        </tr>

    <?php endforeach ?>

<?php else: ?>
    <?php if (post("current_page") == 1): ?>
    <tr>
        <td colspan="8" class="border-0">
            <div class="d-flex align-items-center align-self-center h-100 mih-500">
                <div class="w-100 text-center">
                    <div class="text-center px-4">
                        <img class="mh-190 mb-4" alt="" src="<?php _e( get_theme_url() ) ?>Assets/img/empty2.png">
                    </div>
                </div>
            </div>
        </td>
    </tr>
    <?php endif ?>
<?php endif ?>
