<div class="menu-item">
    <a class="menu-link sp-menu-item actionItem <?php _e( uri('segment', 3) == $config['id']?"active":"" )?>" href="<?php _e( base_url("settings/index/" . $config['id']) )?>" data-remove-other-active="true" data-active="active" data-result="html" data-content="main-wrapper" data-history="<?php _e( base_url("settings/index/" . $config['id']) )?>">
        <span class="menu-icon">
            <i class="<?php _ec( $config['icon'] )?> fs-20" style="color: <?php _ec( $config['color'] )?>;"></i>
        </span>
        <span class="menu-title"><?php _e( $config['name'] )?></span>
    </a>
</div>