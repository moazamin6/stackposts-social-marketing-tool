<?php if ( get_option("openai_status", 0) && permission("openai_image") && permission("openai") ): ?>
<a class="dropdown-item d-flex align-items-center actionItem" href="<?php _e( base_url("openai/image_popup") )?>" data-popup="OpenAIImageModal" ><i class="<?php _ec( $config['icon'] )?> pe-0 me-1"></i> <?php _e("OpenAI")?></a>
<?php endif ?>