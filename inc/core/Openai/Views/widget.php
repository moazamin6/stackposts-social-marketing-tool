<?php if ( get_option("openai_status", 0) && permission("openai_content") && permission("openai") ): ?>
<li>
	<a href="<?php _e( base_url("openai/popup/".$name) )?>" class="actionItem px-3 py-2 d-block btn btn-active-light text-gray-700" data-popup="OpenAIModal" title="<?php _e("OpenAI")?>" data-toggle="tooltip" data-placement="top"><i class="<?php _ec( $config['icon'] )?> pe-0"></i></a>
</li>
<?php endif ?>