<div class="btn btn-outline btn-outline-dashed me-2 mb-2 text-start list-btn-add-account d-flex justify-content-between align-items-center py-2">
    <a href="<?php _e( base_url( $config['id']."/oauth" ) )?>" class="text-gray-800">
        <div>
            <i class="<?php _e( $config['icon'] )?>" style="color: <?php _e( $config['color'] )?>;" ></i> 
            <?php _ec("Add Twitter profile")?>
        </div>
        
    </a>
    <a href="<?php _ec( base_url("twitter_profiles/popup_twitter_app") )?>" data-popup="TwitterAPPModal" class="actionItem" title="<?php _e("Use your Twitter app")?>" data-toggle="tooltip" data-placement="top"><i class="fad fa-cog"></i></a>
</div>