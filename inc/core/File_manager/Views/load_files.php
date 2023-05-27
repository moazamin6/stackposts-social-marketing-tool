<?php if ($page == 0 && $folder != 0): ?>
<div class="col-2">
	<a href="javascript:void(0);" class="fm-list-item fm-folder-item rounded mb-4 bg-white" data-folder-id="">
		<img class="fm-list-overplay" src="<?php _e( get_module_path( __DIR__, "Assets/img/overplay.png" ) )?>">
		<div class="fm-list-box">
			<div class="fm-list-hover h-100">
				<div class="fm-list-media rounded-top d-flex flex-column align-items-center justify-content-center fs-100 text-primary">
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
			<div class="position-relative">
				<div href="javascript:void(0);" class="fm-list-item fm-folder-item rounded mb-4 bg-white overflow-hidden" data-folder-id="<?php _e( $value->id )?>">
					<img class="fm-list-overplay" src="<?php _e( get_module_path( __DIR__, "Assets/img/overplay.png" ) )?>">
					<div class="fm-list-box">
						<div class="fm-list-hover">
							<div class="fm-list-media rounded-top fm-bg-folder d-flex flex-column align-items-center justify-content-center fs-100 text-primary"></div>
						</div>
						<div class="fm-list-info border-top d-flex justify-content-between align-items-center">
							<div class="text-truncate me-5">
								<div class="text-truncate fw-5 text-dark"><?php _e( $value->name )?></div>
								<div class="text-muted fs-11"><?php _e("Folder")?></div>
							</div>
							<div> </div>
						</div>
					</div>
				</div>			
				<a href="<?php _ec( get_module_url("delete/{$value->ids}") )?>" class="actionItem text-danger position-absolute b-18 r-18" data-confirm="<?php _e("Are you sure to delete this items?")?>" data-remove="fm-list-item" data-call-success="Core.ajax_load_scroll(true);"><i class="fad fa-trash-alt me-0 pe-0"></i></a>
			</div>
		<?php }else{?>
			<div class="fm-list-item rounded mb-4 bg-white" href="javascript:void(0);" data-id="<?php _e( $value->ids )?>" data-file="<?php _e( $file_url )?>">
				<img class="fm-list-overplay" src="<?php _e( get_module_path( __DIR__, "Assets/img/overplay.png" ) )?>">
				<div class="fm-list-box">
					<div class="fm-chechbox form-check form-check-inline">
                        <input class="form-check-input fm-check-item" type="checkbox" name="ids[]" id="<?php _e( $value->ids )?>" value="<?php _e( $value->ids )?>">
                        <label class="form-check-label" for="<?php _e( $value->ids )?>"></label>
                    </div>
					<?php if( $detect == "image" ){?>
					<div class="fm-list-hover">
						<div class="fm-list-media rounded-top d-flex flex-column align-items-center justify-content-center fs-90 text-primary">
							<img class="lazy" src="<?php _e( get_module_path( __DIR__, "Assets/img/loading.gif") )?>" data-src="<?php _e( img($file_url) )?>">
						</div>

						<div class="fm-list-action text-end fs-16">
							<a href="javascript:void(0);" class="fm-edit p-l-5" data-fancybox data-src="<?php _e( get_module_url("editor/".$value->ids) )?>" data-options='{"type" : "iframe", "iframe" : {"preload" : false, "css" : {"height" : "100%"}}}'>
								<i class="fad fa-pencil-alt"></i>
							</a>
							<a href="javascript:void(0);" class="p-l-5 btnOpenMediaInfo" data-id="<?php _e( $value->ids )?>"><i class="fad fa-info-circle"></i></a>
						</div>
					</div>
					<?php } else {?>

						<?php if (is_video($file_url)): ?>
							<div class="fm-list-hover overflow-hidden position-relative">
								<video class="fm-video miw-100">
								  	<source src="<?php _ec( $file_url )?>" type="video/mp4">
									<?php _e('Your browser does not support the video tag.')?>
								</video>
								<div class="fm-list-media rounded-top d-flex flex-column align-items-center justify-content-center fs-90 text-<?php _e( $text )?>">
									<i class="<?php _e( $icon )?>"></i>
								</div>
							</div>
						<?php else: ?>
							<div class="fm-list-hover">
								<div class="fm-list-media rounded-top d-flex flex-column align-items-center justify-content-center fs-90 text-<?php _e( $text )?>">
									<i class="<?php _e( $icon )?>"></i>
								</div>
							</div>
						<?php endif ?>
					
					<?php }?>
					<div class="fm-list-info border-top">
						<div class="text-truncate fw-5 text-dark" title="<?php _e( $value->name )?>"><?php _e( $value->name )?></div>
						<div class="text-muted fs-11"><?php _e( format_bytes( $value->size ) )?></div>
					</div>
					
				</div>
			</div>			
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