<div class="p-25 container">
	<div class="row">

		<div class="col-md-12 mb-4">
			
			<div class="row post-type">
				<label class="col-4 bg-primary text-light-primary" for="type_media">
					<div class="d-block d-md-flex d-sm-flex text-center align-items-center flex-row-fluid flex-wrap">
						<span class="icon p-r-10"><i class="fad fa-images"></i></span>
						<span class="text"><?php _e("Media")?></span>
						<input id="type_media" type="radio" class="d-none" name="type" value="media" checked>
					</div>
				</label>
				<label class="col-4" for="type_link">
					<div class="d-block d-md-flex d-sm-flex text-center align-items-center flex-row-fluid flex-wrap">
						<span class="icon p-r-10"><i class="fad fa-link"></i></span>
						<span class="text"><?php _e("Link")?></span>
						<input id="type_link" type="radio" class="d-none" name="type" value="link">
					</div>
				</label>
				<label class="col-4" for="type_text">
					<div class="d-block d-md-flex d-sm-flex text-center align-items-center flex-row-fluid flex-wrap">
						<span class="icon p-r-10"><i class="fad fa-align-center"></i></span>
						<span class="text"><?php _e("Text")?></span>
						<input id="type_text" type="radio" class="d-none" name="type" value="text">
					</div>
				</label>
			</div>
		</div>
		
		<div class="post-tab filemanager-tab col-lg-4 col-md-6 col-sm-12 d-lg-block d-md-block d-sm-none d-xs-none d-none">
			<?php echo view_cell('\Core\File_manager\Controllers\File_manager::widget') ?>
		</div>
		<div class="post-tab post-content-tab col-lg-4 col-md-6 col-sm-12">
			<div class="card border h-100 post-schedule wrap-caption">
				<div class="card-header p-r-20 p-l-20">
					<h3 class="card-title"><?php _e("New post")?></h3>
			        <div class="card-toolbar">
			        	<button type="button" class="btn btn-sm btn-light btn-preview d-lg-none d-md-none d-sm-block"><?php _e("Preview")?></button>
			        </div>
				</div>
				<div class="card-body p-20 position-relative">
					<div class="mb-3">
						<?php echo view_cell('\Core\Account_manager\Controllers\Account_manager::widget', ["account_id" => get_data($post, 'account_id')]) ?>
					</div>
					
					<div class="post-type-box d-none" data-type="link">
						<div class="input-group input-group-solid bg-white border mb-3">
			                <input type="text" class="form-control" name="link" placeholder="Enter link">
			                <span class="input-group-text"><i class="fal fa-link fs-18"></i></span>
			            </div>
			            <label class="fs-14 text-uppercase text-gray-500"><?php _e("Thumbnail")?></label>
					</div>
					<div class="post-type-box mb-3" data-type="media">
						<?php echo view_cell('\Core\File_manager\Controllers\File_manager::selected') ?>
					</div>

					<?php echo view_cell('\Core\Caption\Controllers\Caption::block', ['name' => 'caption']) ?>

					<?php if(!empty($frame_posts)){?>

					<?php 
					$advance_options = false;
					foreach ($frame_posts as $key => $value){
						if ( isset( $value['data']['advance_options'] ) ){
							$advance_options = true;
						}
					}
					$advance_option_menu = 0;
					$advance_option_tab = 0;
					?>

					<?php if ($advance_options): ?>
					<div class="mt-3 advance-options d-none">
						<!-- <label class="mb-3 fw-6 text-gray-500"><?php _e("Advance options")?></label> -->

						<div class="nx-scroll no-update overflow-hidden">
					        <ul class="nav nav-tabs flex-nowrap text-nowrap">
					        	<?php foreach ($frame_posts as $key => $value): ?>
					        		<?php if ( isset( $value['data']['advance_options'] ) ): ?>
						            <li class="nav-item" data-network="<?php _ec( $value['parent']['id'] )?>">
						                <a class="nav-link btn btn-active-light btn-color-gray-600 btn-active-color-primary rounded-bottom-0 px-3 py-2 text-center <?php _ec( $advance_option_menu==0?"active":"" )?>" data-bs-toggle="tab" href="#advance_option_<?php _ec( $value['parent']['id'] )?>">
						                	<i class="<?php _ec( $value['icon'] )?> p-r-0" style="color: <?php _ec( $value['color'] )?>;"></i>
						                </a>
						            </li>
						        	<?php 
						        	$advance_option_menu++; 
						        	endif 
						        	?>
					        	<?php endforeach ?>
					        </ul>
						</div>

						<div class="tab-content border rounded rounded-top-0 border-top-0 p-15">
							<?php foreach ($frame_posts as $key => $value): ?>
								<?php if ( isset( $value['data']['advance_options'] ) ): ?>
					            <div class="tab-pane fade show <?php _ec( $advance_option_tab==0?"active":"" )?>" id="advance_option_<?php _ec( $value['parent']['id'] )?>"  data-network="<?php _ec( $value['parent']['id'] )?>" role="tabpanel">
							        <?php _ec( $value['data']['advance_options'] )?>
							    </div>
							    <?php 
							    $advance_option_tab++;
							    endif 
							    ?>
				        	<?php endforeach ?>
						</div>

					</div>
					<?php endif ?>
					<?php }?>

					<div class="mt-3">
						<div class="card border">
							<?php if( empty($post) ){?>
							<div class="card-header p-r-20 p-l-20 py-2 border-bottom-0">
								<h3 class="card-title fs-14"><?php _e("When to post")?></h3>
						        <div class="card-toolbar">
						            <select class="form-select mw-150 fs-12" name="post_by">
						            	<option value="1"><?php _e("Immediately")?></option>
						            	<option value="2"><?php _e("Schedule & Repost")?></option>
						            	<option value="3"><?php _e("Specific Days & Times")?></option>
						            	<?php if (permission("drafts")): ?>
						            	<option value="4"><?php _e("Draft")?></option>
						            	<?php endif ?>
						            </select>
						        </div>
							</div>
							<?php }else{?>

								<?php if ($post->status==0): ?>
									<div class="card-header p-r-20 p-l-20 py-2">
										<h3 class="card-title fs-14"><?php _e("When to post")?></h3>
								        <div class="card-toolbar">
								            <select class="form-select mw-150 fs-12" name="post_by">
								            	<option value="1"><?php _e("Immediately")?></option>
								            	<option value="2"><?php _e("Schedule & Repost")?></option>
								            	<option value="3"><?php _e("Specific Days & Times")?></option>
								            	<?php if (permission("drafts")): ?>
								            	<option value="4" <?php _e($post->status==0)?"selected":""?> ><?php _e("Draft")?></option>
								            	<?php endif ?>
								            </select>
								        </div>
									</div>
									<div class="d-none">
										<input type="text" name="ids" value="<?php _ec( $post->ids )?>">
										<input type="text" name="draft" value="1">
									</div>
								<?php else: ?>
									<div class="d-none">
										<input type="text" name="post_by" value="2">
										<input type="text" name="ids" value="<?php _ec( $post->ids )?>">
									</div>
								<?php endif ?>
								
							<?php }?>
							<div class="post-by d-none" data-by="2">
								<div class="card-body <?php _ec( empty($post)?"border-top":"" )?> p-20">
									<div class="row mb-3">
										<div class="col-6">
											<label class="fs-10"><?php _e("Time post")?></label>
											<input type="text" class="form-control form-control-sm datetime datetime fs-12" autocomplete="off" name="time_post" value="<?php _e( datetime_show( get_data($post, 'time_post') ) )?>">
										</div>
										<div class="col-6">
											<label class="fs-10"><?php _e("Interval per post (minute)")?></label>
											<input type="number" class="form-control form-control-sm fs-12" autocomplete="off" name="interval_per_post" value="<?php _e( (empty($post) || get_data($post, 'delay') == "")?5:get_data($post, 'delay') )?>">
										</div>
									</div>
									<div class="row post-repost">
										<div class="col-6">
											<label class="fs-10"><?php _e('Repost frequency (day)')?></label>
											<select class="form-control form-control-sm fs-12" name="repost_frequency">
												<?php for ($i=0; $i <= 60; $i++){?>
													<option value="<?php _e($i)?>" <?php _e( get_data($post, 'repost_frequency', 'select', $i) )?> ><?php _e($i==0?"Disable":$i)?></option>
												<?php }?>
											</select>
										</div>
										<div class="col-6">
											<label class="fs-10"><?php _e('Repost until')?></label>
											<input type="text" class="form-control form-control-sm datetime fs-12" autocomplete="off" name="repost_until" value="<?php _e( datetime_show( get_data($post, 'repost_until') ) )?>">
										</div>
									</div>
								</div>
							</div>
							<div class="post-by d-none" data-by="3">
								<div class="card-body border-top p-20 listPostByDays">
									<div class="item my-1">
										<div class="input-group input-group-sm input-group-solid bg-white border">
							                <input type="text" class="form-control form-control-sm datetime fs-12" autocomplete="off" name="time_posts[]" value="">
							                <span class="input-group-text"><i class="fal fa-calendar-alt"></i></span>
							                <button type="button" class="btn btn-sm btn-color-gray-500 btn-active-color-danger border-start remove disabled">
							                	<i class="fad fa-trash"></i>
							                </button>
							            </div>
									</div>
								</div>
								<div class="card-footer py-1 p-r-20 p-l-20">
									<a href="javascript:void(0);" class="btn btn-link btn-active-color-primary me-5 mb-0 py-2 fs-12 addSpecificDays">
										<i class="fal fa-plus"></i> <?php _e("Add more scheduled times")?>
									</a>

									<div class="tempPostByDays d-none">
										<div class="item my-1">
											<div class="input-group input-group-sm input-group-solid bg-white border">
								                <input type="text" class="form-control form-control-sm fs-12" autocomplete="off" value="">
								                <span class="input-group-text"><i class="fal fa-calendar-alt"></i></span>
								                <button type="button" class="btn btn-sm btn-color-gray-500 btn-active-color-danger border-start remove">
								                	<i class="fad fa-trash"></i>
								                </button>
								            </div>
										</div>
									</div>
								</div>
							</div>
							
						</div>

					</div>

				</div>
				<div class="card-footer p-15">
					<div class="d-flex justify-content-end">
						<?php 
						if( empty($post) ){
							$button = 1;
						}else{

							if ($post->status==0){
								$button = 3;
							}else{
								$button = 2;
							}
						}
						?>
						<button type="submit" href="#" class="btn btn-primary btn-hover-scale btnPostNow <?php _ec( $button == 1?"":"d-none" )?>">
							<i class="fal fa-paper-plane"></i> <?php _e("Send now")?>
						</button>
						<button type="submit" href="#" class="btn btn-primary btn-hover-scale btnSchedulePost  <?php _ec( $button == 2?"":"d-none" )?>">
							<i class="fal fa-paper-plane"></i> <?php _e("Schedule")?>
						</button>
						<button type="submit" href="#" class="btn btn-primary btn-hover-scale btnSaveDraft  <?php _ec( $button == 3?"":"d-none" )?>">
							<i class="fad fa-save"></i> <?php _e("Save as Draft")?>
						</button>
					</div>
				</div>

				<div id="post-modal" class="modal fade post-modal">
					<div class="modal-dialog modal-dialog-centered modal-md">
						<div class="modal-content">
						  	<div class="modal-header bg-solid-warning">
						    	<h5 class="modal-title"><i class="fad fa-engine-warning text-danger"></i> <?php _e("Confirm")?></h5>
						  	</div>
						  	<div class="modal-body data-post-confirm shadow-none">
						  	</div>
						  	<div class="modal-footer">
						    	<button type="button" data-bs-dismiss="modal" class="btn btn-secondary"><?php _e('No, Cancel')?></button>
								<a href="<?php _e( get_module_url("save/true") )?>" class="btn btn-primary actionMultiItem" data-call-after="Post.closeConfirmPostModal();" ><?php _e("Yes, I'm sure")?></a>
						  	</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="post-tab preview-tab col-md-4 d-lg-block d-md-none d-sm-none d-xs-none d-none">
			<?php if(!empty($frame_posts)){?>

			<?php 
			$preview = false;
			$preview_count = 0;
			foreach ($frame_posts as $key => $value){
				if ( isset( $value['data']['preview'] ) ){
					$preview = true;
				}
			}
			?>

			<?php if ($preview): ?>
			<div class="card border">
				<div class="card-header p-r-20 p-l-20 m-auto w-100">
					<h3 class="card-title text-center"><?php _e("Network Preview")?></h3>
					<div class="card-toolbar">
						<div class="d-lg-none d-md-none d-sm-block d-xs-block d-block">
			        		<button type="button" class="btn btn-sm btn-light-danger btn-close-preview w-35 h-35 b-r-40 d-flex justify-content-center align-items-center"><i class="fad fa-times pe-0"></i></button>
						</div>
			        </div>
				</div>
				<div class="card-header px-0 w-100">
					<div class="nx-scroll no-update w-100">
					    <ul class="preview-menu d-flex mb-0 <?php _ec( count($frame_posts) < 4?"justify-content-center":"" )?>">
				        	<?php foreach ($frame_posts as $key => $value): ?>
				        		<?php if ( isset( $value['data']['preview'] ) ): ?>
					            <li class="item mb-0">
					                <a class="btn btn-active-light btn-color-gray-600 btn-active-color-primary rounded-0 p-l-30 p-r-30 p-t-24 p-b-24 text-center <?php _ec( $preview_count==0?"active":"" )?>" href="#preview-<?php _ec($value['id'])?>">
					                	<i class="<?php _ec( $value['icon'] )?> p-r-0 fs-20" style="color: <?php _ec( $value['color'] )?>;"></i>
					                </a>
					            </li>
					            <?php 
							    $preview_count++;
							    endif 
							    ?>
				        	<?php endforeach ?>
				        </ul>
					</div>
				</div>
				<div class="card-body post-preview-wrap px-4 pb-4 pt-0 h-600 overflow-auto">
					<?php foreach ($frame_posts as $key => $value): ?>
						<?php if ( isset( $value['data']['preview'] ) ): ?>
							<div class="post-preview pt-3" id="preview-<?php _ec($value['id'])?>">
								<?php _ec( $value['data']['preview'] )?>
							</div>

							<?php if(count($frame_posts) != $key + 1):?>
							<div class="separator separator-dashed mt-5 mb-3"></div>
							<?php endif ?>

						<?php endif ?>
					<?php endforeach ?>

				</div>
			</div>
			<?php endif ?>

			<?php }?>
		</div>

	</div>

</div>

<?php if(!empty($post)){?>
<script type="text/javascript">
	$(function(){
		Post.edit(<?php _ec(json_encode($post))?>);
	});
</script>
<?php }?>