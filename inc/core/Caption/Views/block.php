<div class="mb-3 wrap-input-emoji">
	<textarea class="form-control input-emoji fw-4" name="<?php _e($name)?>" placeholder="<?php _e($placeholder)?>"><?php _ec($value)?></textarea>
	<ul class="caption-option d-flex overflow-x-auto">
		<li class="count-word px-3 py-2 d-block d-flex align-items-center justify-content-center text-gray-700"><i class="fad fa-text-width"></i><span class="p-l-5"></span></li>
		<li class="get-caption">
			<a href="javascript:void(0);" class="btnGetCaption px-3 py-2 d-block btn btn-active-light text-gray-700" title="<?php _e("Get Caption")?>" data-toggle="tooltip" data-placement="top"><i class="fal fa-comment-alt-lines p-0"></i></a>
		</li>
		<li class="save-caption">
			<a href="javascript:void(0);" class="btnSaveCaption px-3 py-2 d-block btn btn-active-light text-gray-700" title="<?php _e("Save caption")?>" data-toggle="tooltip" data-placement="top"><i class="fal fa-save p-0"></i></a>
		</li>
		<?php echo view_cell('\Core\Openai\Controllers\Openai::widget', [ "name" => $name ]) ?>
		<li>
			<?php echo view_cell('\Core\Shortlink\Controllers\Shortlink::widget') ?>
		</li>
	</ul>
</div>
<script type="text/javascript">
	$(function(){
		Core.select2();
	});
</script>