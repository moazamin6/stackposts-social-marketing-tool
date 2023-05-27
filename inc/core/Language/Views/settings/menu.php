<?php if (role($config['id'])): ?>
<div class="menu-item">
    <a class="menu-link sp-menu-item <?php _ec( uri('segment', 3) == $config['id']?"active":"" )?>" href="<?php _ec( base_url( $config['id'] ) )?>" data-remove-other-active="true" data-active="active" data-result="html" data-content="main-wrapper">
        <span class="menu-icon">
            <i class=""></i>
            <i class="fs-20 <?php _ec( $config['icon'] )?>" style="color: <?php _ec( $config['color'] )?>;" ></i>
        </span>
        <span class="menu-title"><?php _e( $config['name'] )?></span>
    </a>
</div>
<?php endif ?>