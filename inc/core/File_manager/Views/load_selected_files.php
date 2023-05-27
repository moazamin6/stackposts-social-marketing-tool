<?php if( !empty( $result ) ){?>


	<?php foreach ($result as $key => $value): ?>

	<?php
	$detect = detect_file_type( $value->extension );
	$file_url = get_file_url( $value->file );
	$detect_icon = detect_file_icon($detect);
	$text = $detect_icon['text'];
	$icon = $detect_icon['icon'];
	?>

			
	<a class="fm-list-item rounded border bg-white" href="javascript:void(0);" data-is-image="<?php _ec( $value->is_image )?>" data-id="<?php _e( $value->ids )?>" data-file="<?php _e( $file_url )?>" data-id="<?php _e( $value->ids )?>">
		<img class="fm-list-overplay" src="<?php _e( get_module_path( __DIR__, "Assets/img/overplay.png" ) )?>">
		<div class="fm-list-box">
			<div class="fm-chechbox form-check form-check-inline d-none">
                <input class="form-check-input d-none" type="checkbox" name="medias[]" value="<?php _e( $value->file )?>" checked="true">
                <label class="form-check-label" for="<?php _e( $value->ids )?>"></label>
            </div>
			<?php if( $detect == "image" ){?>
			<div class="fm-list-hover">
				<div class="fm-list-media rounded d-flex flex-column align-items-center justify-content-center fs-40 text-primary">
					<img class="lazy" src="<?php _e( get_module_path( __DIR__, "Assets/img/loading.gif") )?>" data-src="<?php _e( img($file_url) )?>">
				</div>
			</div>
			<?php } else {?>
			<div class="fm-list-hover">
				<div class="fm-list-media rounded d-flex flex-column align-items-center justify-content-center fs-40 text-<?php _e( $text )?>">
					<i class="<?php _e( $icon )?>"></i>
				</div>
			</div>
			<?php }?>
			<div class="fm-list-info border-top">
				<div class="text-truncate fw-5 text-dark" title="<?php _e( $value->name )?>"><?php _e( $value->name )?></div>
				<div class="text-muted fs-8"><?php _e( format_bytes( $value->size ) )?></div>
			</div>
		</div>
		<button type="button" href="javascript:void(0)" class="remove text-danger"><i class="fal fa-times"></i></button>
	</a>			

	<?php endforeach ?>
<?php }?>
