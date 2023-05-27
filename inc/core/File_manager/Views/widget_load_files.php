<?php if ($page == 0 && $folder != 0): ?>
<div class="col-2">
	<a href="javascript:void(0);" class="fm-list-item fm-folder-item rounded mb-4 bg-white" data-folder-id="">
		<img class="fm-list-overplay" src="<?php _ec( get_module_path( __DIR__, "Assets/img/overplay.png" ) )?>">
		<div class="fm-list-box">
			<div class="fm-list-hover h-100">
				<div class="fm-list-media rounded-top d-flex flex-column align-items-center justify-content-center fs-50 text-primary">
					<i class="fad fa-chevron-left"></i>
				</div>
			</div>
		</div>
	</a>	
</div>		
<?php endif ?>

<?php if( !empty( $result ) ){?>


	<?php foreach ($result as $key => $value): ?>

	<?php
	$detect = detect_file_type( $value->extension );
	$file_url = get_file_url( $value->file );
	$detect_icon = detect_file_icon($detect);
	$text = $detect_icon['text'];
	$icon = $detect_icon['icon'];
	?>

	<div class="col-2">
		<?php if($value->is_folder){?>
			<a href="javascript:void(0);" class="fm-list-item fm-folder-item rounded mb-4 bg-white overflow-hidden" data-folder-id="<?php _ec( $value->id )?>">
				<img class="fm-list-overplay" src="<?php _ec( get_module_path( __DIR__, "Assets/img/overplay.png" ) )?>">
				<div class="fm-list-box">
					<div class="fm-list-hover">
						<div class="fm-list-media rounded-top fm-bg-folder d-flex flex-column align-items-center justify-content-center fs-50 text-primary"></div>
					</div>
					<div class="fm-list-info border-top">
						<div class="text-truncate fw-5 text-dark"><?php _e( $value->name )?></div>
						<div class="text-muted fs-8"><?php _e("Folder")?></div>
					</div>
				</div>
			</a>			
		<?php }else{?>
			<a class="fm-list-item rounded mb-4 bg-white" href="javascript:void(0);" data-id="<?php _ec( $value->ids )?>" data-is-image="<?php _ec( $value->is_image )?>" data-file="<?php _ec( $file_url )?>" >
				<img class="fm-list-overplay" src="<?php _ec( get_module_path( __DIR__, "Assets/img/overplay.png" ) )?>">
				<div class="fm-list-box">
					<div class="fm-chechbox form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="file_ids[]" value="<?php _ec( $value->file )?>">
                        <label class="form-check-label" for="<?php _ec( $value->ids )?>"></label>
                    </div>
					<?php if( $detect == "image" ){?>
					<div class="fm-list-hover">
						<div class="fm-list-media rounded-top d-flex flex-column align-items-center justify-content-center fs-40 text-primary">
							<img class="lazy" src="<?php _ec( get_module_path( __DIR__, "Assets/img/loading.gif") )?>" data-src="<?php _ec( img($file_url) )?>">
						</div>
					</div>
					<?php } else {?>
					
						<?php if (is_video($file_url)): ?>
							<div class="fm-list-hover overflow-hidden position-relative">
								<video class="fm-video miw-100">
								  	<source src="<?php _ec( $file_url )?>" type="video/mp4">
									<?php _e('Your browser does not support the video tag.')?>
								</video>
								<div class="fm-list-media rounded-top d-flex flex-column align-items-center justify-content-center fs-40 text-<?php _ec( $text )?>">
									<i class="<?php _e( $icon )?>"></i>
								</div>
							</div>
						<?php else: ?>
							<div class="fm-list-hover">
								<div class="fm-list-media rounded-top d-flex flex-column align-items-center justify-content-center fs-40 text-<?php _ec( $text )?>">
									<i class="<?php _e( $icon )?>"></i>
								</div>
							</div>
						<?php endif ?>
					
					<?php }?>
					<div class="fm-list-info border-top">
						<div class="text-truncate fw-5 text-dark" title="<?php _ec( $value->name )?>"><?php _ec( $value->name )?></div>
						<div class="text-muted fs-8"><?php _ec( format_bytes( $value->size ) )?></div>
					</div>
					
				</div>
			</a>			
		<?php }?>
	</div>

	<?php endforeach ?>
<?php }else{?>
	<?php if ($page == 0 && $folder == 0): ?>
	<div class="fm-empty text-center fs-90 text-muted h-100 d-flex flex-column align-items-center justify-content-center">
		<img class="mh-190 mb-4" alt="" src="<?php _e( get_theme_url() ) ?>Assets/img/empty2.png">
	</div>
	<?php endif ?>
<?php }?>