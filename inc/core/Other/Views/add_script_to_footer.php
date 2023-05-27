<?php if ( get_option("embed_code_status", 1) ): ?>
    <?php _ec( htmlspecialchars_decode( get_option("embed_code", ""), ENT_QUOTES) )?>
<?php endif ?>