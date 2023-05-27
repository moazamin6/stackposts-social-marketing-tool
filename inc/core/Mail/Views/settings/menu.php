<?php if (role($config['id'])): ?>
<div class="menu-item">
    <a class="menu-link sp-menu-item <?php _e( uri('segment', 3) == $config['id']?"active":"" )?>" href="<?php _e( base_url("mail") )?>">
        <span class="menu-icon">
            <i class="<?php _ec( $config['icon'] )?> fs-20" style="color: <?php _ec( $config['color'] )?>;"></i>
        </span>
        <span class="menu-title"><?php _e( "Email Configuration" )?></span>
    </a>
</div>
<?php endif ?>