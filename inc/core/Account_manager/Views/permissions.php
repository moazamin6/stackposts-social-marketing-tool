<div class="mb-3 mt-4">
    <div class="fs-14 fw-bold m-b-20"><?php _e('Allow add profiles for')?></div>
    <div>
    <?php
    if(!empty($items)){
        foreach ($items as $key => $value) {
    ?>

    <div class="form-check form-check-inline mb-4">
        <input 
            class="form-check-input" 
            type="checkbox" 
            name="permissions[<?php _e($value['id'])?>]" <?php _ec( plan_permission('checkbox', $value['id']) == 1?"checked":"" )?> 
            id="<?php _e($value['id'])?>" value="1"
        >
        <label class="form-check-label" for="<?php _ec($value['id'])?>"><?php _e( $value['name'] )?></label>
    </div>

    <?php }}?>
    </div>
</div>