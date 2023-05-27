<div class="sp-menu-dropdown dropdown dropdown-hide-arrow dropdown-hide border-start" data-dropdown-spacing="0">
    <a class="dropdown-toggle text-gray-800 btn" href="javascript:void(0);" data-bs-toggle="dropdown" >
        <i class="fad fa-users text-primary" ></i>
    </a>

    <ul class="dropdown-menu dropdown-menu-end"  data-dropdown-spacing="0">
        <?php if (!empty($groups)): ?>
            
            <?php foreach ($groups as $key => $value): ?>

                <li>
                    <a class="dropdown-item btnSelectedGroup" href="javascript:void(0);" data-accounts='<?php _ec( $value->data )?>' ><i class="fad fa-users"></i> <?php _ec( $value->name )?></a>
                </li>

            <?php endforeach ?>

        <?php else: ?>
            <div class="text-gray-500 text-center"><?php _e("Empty")?></div>          
        <?php endif ?>
    </ul>
</div>