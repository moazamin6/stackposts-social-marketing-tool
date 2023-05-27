<div class="row">
	<div class="col mb-4">
        <div class="border border-light rounded p-20 b-r-8 text-center bg-white">
            <div class="bg-light-success w-52 h-52 text-success m-auto d-flex align-items-center justify-content-center fs-30 rounded-circle">
                <i class="fad fa-check-double"></i>
            </div>
            <div class="fs-38 fw-9 text-gray-700"><?php _ec( short_number($total_succeed) )?></div>
            <div class="fs-18 fw-5 text-gray-500"><?php _e("Succeed")?></div>
        </div>
    </div>
    <div class="col mb-4">
        <div class="border border-light rounded p-20 b-r-8 text-center bg-white">
            <div class="bg-light-danger w-52 h-52 text-danger m-auto d-flex align-items-center justify-content-center fs-30 rounded-circle">
                <i class="fad fa-engine-warning"></i>
            </div>
            <div class="fs-38 fw-9 text-gray-700"><?php _ec( short_number($total_failed) )?></div>
            <div class="fs-18 fw-5 text-gray-500"><?php _e("Failed")?></div>
        </div>
    </div>
    <div class="col mb-4">
        <div class="border border-light rounded p-20 b-r-8 text-center bg-white">
            <div class="bg-light-primary w-52 h-52 text-primary m-auto d-flex align-items-center justify-content-center fs-30 rounded-circle">
                <i class="fad fa-calendar-check"></i>
            </div>
            <div class="fs-38 fw-9 text-gray-700"><?php _ec( short_number($total_post) )?></div>
            <div class="fs-18 fw-5 text-gray-500"><?php _e("Total")?></div>
        </div>
    </div>
</div>

<div class="card b-r-6 mb-4">
	<div class="card-header">
		<div class="card-title">
			<?php _e("Report post by status")?>
		</div>
	</div>
	<div class="card-body">
		<div id="post_by_status_chart"></div>
		<h3 class="text-center"></h3>
	</div>
</div>

<div class="row">
	<div class="col-md-6 mb-4">
	    <div class="card h-100 mb-4">
	        <div class="card-header">
	            <div class="card-title">
	                <span class="me-2"><?php _e("Report post by type")?></span>
	            </div>
	        </div>
	        <div class="card-body">
	            <div id="post_by_type_chart"></div>
	            <div class="card border b-r-10">
	            	<div class="card-body">
	            		<div class="table-responsive">
	                        <table class="table align-middle">
	                            <thead class="border-bottom">
	                                <tr>
	                                    <th scope="col" class="text-center text-gray-500 fw-6"></th>
	                                    <th scope="col" class="text-center text-gray-500 fw-4 fs-12"><?php _e("Media")?></th>
	                                    <th scope="col" class="text-center text-gray-500 fw-4 fs-12"><?php _e("Link")?></th>
	                                    <th scope="col" class="text-center text-gray-500 fw-4 fs-12"><?php _e("Text")?></th>
	                                </tr>
	                            </thead>
	                            <tbody class="text-gray-700">
	                                <tr>
	                                	<td class="text-dark p-10 text-gray-500 fw-4 fs-12"><?php _e("Total post")?></td>
	                                	<td class="text-dark p-10 text-center fw-6"><?php _ec($total_media_succeed)?></td>
	                                	<td class="text-dark p-10 text-center fw-6"><?php _ec($total_link_succeed)?></td>
	                                	<td class="text-dark p-10 text-center fw-6"><?php _ec($total_text_succeed)?></td>
	                                </tr>
	                            </tbody>
	                        </table>
	                    </div>
	            	</div>
	            </div>
	        </div>
	    </div>
	</div>

	<div class="col-md-6 mb-4">
	    <div class="card h-100 mb-4">
	        <div class="card-header">
	            <div class="card-title">
	                <span class="me-2"><?php _e("Recent publications")?></span>
	            </div>
	        </div>
	        <div class="card-body py-0 px-4">
	        	<div class="schedules-main overflow-auto row mt-4 mh-600 h-100">
				    <div class="schedule-list h-100">
				    	<?php if (!empty($recent_posts)): ?>
					    	<?php foreach ($recent_posts as $key => $value): ?>

							    <?php
							    $data = json_decode($value->data);
							    ?>
							    <div class="card border px-0 item mb-4">

							        <?php if ($value->status == 1){ ?>
							            <div class="ribbon ribbon-triangle ribbon-top-start border-primary rounded">
							                <div class="ribbon-icon mn-t-22 mn-l-22">
							                    <i class="fs-20 fas fa-circle-notch fa-spin fs-2 text-white"></i>
							                </div>
							            </div>

							            <div class="border-primary border-top-dashed border-1"></div>
							        <?php }else if($value->status == 3){ ?>
							            <div class="ribbon ribbon-triangle ribbon-top-start border-success rounded">
							                <div class="ribbon-icon mn-t-22 mn-l-22">
							                    <i class="fs-20 fad fa-check-double fs-2 text-white"></i>
							                </div>
							            </div>

							            <div class="border-success border-top-dashed border-1"></div>
							        <?php }else if($value->status == 4){ ?>
							            <div class="ribbon ribbon-triangle ribbon-top-start border-danger rounded">
							                <div class="ribbon-icon mn-t-22 mn-l-22">
							                    <i class="fs-20 fad fa-exclamation-circle fs-2 text-white"></i>
							                </div>
							            </div>

							            <div class="border-danger border-top-dashed border-1"></div>
							        <?php } ?>
							        
							        <div class="card-header px-4 border-0">
							            
							            <div class="card-title fw-normal fs-12">
							                
							                <div class="d-flex flex-stack">
							                    <div class="symbol symbol-45px me-3">
							                        <img src="<?php _ec( get_file_url($value->avatar) )?>" class="align-self-center rounded-circle border" alt="">
							                    </div>
							                    <div class="d-flex align-items-center flex-row-fluid flex-wrap">
							                        <div class="flex-grow-1 me-2 text-over-all">
							                            <a href="<?php _ec( $value->url )?>" target="_blank" class="text-gray-800 text-hover-primary fs-14 fw-bold"><i class="<?php _ec( $value->icon )?>" style="color: <?php _ec( $value->color )?>;"></i> <?php _ec( $value->name )?></a>
							                            <span class="text-muted fw-semibold d-block fs-12"><i class="fal fa-calendar-alt"></i> <?php _ec( datetime_show($value->time_post) )?></span>
							                        </div>
							                    </div>
							                </div>

							            </div>

							        </div>

							        <div class="card-body p-20">
							            
							            <div class="d-flex">
							                <div class="symbol symbol-100px me-3 overflow-hidden w-99 border rounded">

							                    <?php if($value->type == "media"){?>
							                        <?php if (!empty($data->medias)): ?>
							                        <div class="owl-carousel owl-theme">
							                            <?php foreach ($data->medias as $index => $media): ?>
							                                
							                                <?php if ( is_image($media) ): ?>
							                                    <div class="item w-100 h-99" style="background-image: url('<?php _ec( get_file_url($media) )?>');"></div>
							                                <?php else: ?>
							                                    <div class="item w-100 h-99">
							                                        <video  autoplay muted>
							                                            <source src="<?php _ec( get_file_url($media) )?>" type="video/mp4">
							                                        </video>
							                                    </div>
							                                <?php endif ?>

							                            <?php endforeach ?>
							                        </div>
							                        <?php endif ?>

							                    <?php }elseif($value->type == "link"){?>
							                        <a href="<?php _ec( $data->link )?>" target="_blank" class="d-flex align-items-center justify-content-center w-99 h-99 fs-30 bg-light-primary"><i class="fal fa-link"></i></a>
							                    <?php }else{?>
							                        <div class="d-flex align-items-center justify-content-center w-99 h-99 fs-30 text-primary bg-light-primary"><i class="fal fa-align-center"></i></div>
							                    <?php }?>

							                </div>
							                <div class="d-flex flex-row-fluid flex-wrap">
							                    <div class="flex-grow-1 me-2">
							                        <span class="text-gray-600 d-block h-99 overflow-auto">
							                            <?php _ec( nl2br($data->caption) )?>
							                        </span>
							                    </div>
							                </div>
							            </div>

							        </div>

							        <?php if ( $value->status == 3 ): ?>

							            <?php  $data = json_decode($value->result); ?>

							            <div class="card-footer bg-light-success text-success py-3 px-4 d-flex justify-content-between">
							                <span class="me-2"><?php _e("Post successed")?></span> <a href="<?php _e( $data->url )?>" class="text-dark text-hover-primary" target="_blank"><i class="fad fa-eye"></i> <?php _e("View post")?></a>
							            </div>
							        <?php endif ?>

							        <?php if ( $value->status == 4 ): ?>

							            <?php  $error = json_decode($value->result); ?>

							            <div class="card-footer bg-light-danger text-danger py-3 px-4">
							                <?php _e($error->message)?>
							            </div>
							        <?php endif ?>

							        
							    </div>

							<?php endforeach ?>
							<script type="text/javascript">
							    $(function(){
							        Layout.carousel();
							    });
							</script>
						<?php else: ?>
							<div class="w-100 h-100 d-flex justify-content-center align-items-center">
								<div class="text-center px-4">
						            <img class="mh-190 mb-4" alt="" src="<?php _e( get_theme_url() ) ?>Assets/img/empty2.png">
						            <div>
						            	<a class="btn btn-primary btn-sm b-r-30" href="<?php _e( base_url('post') )?>" >
			                            	<i class="fad fa-plus"></i> <?php _ec("Create post")?>
			                            </a>
						            </div>
						        </div>
							</div>							
						<?php endif ?>

				    </div>
	        	</div>
	        </div>
	    </div>
	</div>
</div>

<script type="text/javascript">
    $(function(){
        Core.chart({
	        id: 'post_by_status_chart',
	        categories: <?php _ec( $date )?>,
	        legend: true,
	        data: [{
	        	type: 'spline',
	            name: '<?php _e("Post succeed")?>',
	            lineColor: 'rgba(80, 205, 127, 1)',
                color: 'rgba(80, 205, 127, 1)',
	            marker: {
	                enabled: false
	            },
	            data: <?php _ec( $post_succeed )?>,
	        },
	        {
	        	type: 'spline',
	            name: '<?php _e("Post failed")?>',
	            lineColor: 'rgba(241, 65, 108, 1)',
                color: 'rgba(241, 65, 108, 1)',
	            marker: {
	                enabled: false
	            },
	            data: <?php _ec( $post_failed )?>,
	        }]
	    });

	    Core.chart({
            id: 'post_by_type_chart',
            categories: '',
            legend: true,
            data: [{
                type: 'pie',
                name: '<?php _e("Percent")?>',
                data: [{
                    name: '<?php _e("Media")?>',
                    y: <?php _ec( $percent_media_succeed )?>,
                    color: 'rgba(60, 88, 208, 1)',
                }, 
                {
                    name: '<?php _e("Link")?>',
                    y: <?php _ec( $percent_link_succeed )?>,
                    color: 'rgba(255, 199, 0, 1)',
                },
                {
                    name: '<?php _e("Text")?>',
                    y: <?php _ec( $percent_text_succeed )?>,
                    color: 'rgba(80, 205, 103, 1)',
                }],
                size: 250,
                innerSize: '60%',
                showInLegend: true,
                dataLabels: {
                    enabled: false
                }
            }]
        });
    });
</script>