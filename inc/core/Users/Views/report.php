<?php 
$stats_by_status = $result->stats_by_status;
$stats_by_date = $result->stats_by_date;
$stats_by_login_type = $result->stats_by_login_type;
$recently_registered_users = $result->recently_registered_users;
$chart = $result->chart;
?>
<div class="container py-5">
	<div class="row widget-main">
	    <div class="col-md-4 mb-4">
  			<div class="bg-white p-20">
  				<div class="d-flex justify-content-between mb-2">
  					<div>
  						<div class="fs-16 fw-6 text-success"><?php _e("Active user")?></div>
  						<div class="fs-12 text-gray-600"><?php _e("Number of active users")?></div>
  					</div>
					<div class="fs-25 fw-6 text-success"><?php _e( $stats_by_status->active )?></div>
  				</div>
  				<div class="progress mb-2">
			  		<div class="progress-bar bg-success" role="progressbar" style="width: <?php _e( $stats_by_status->percent_active )?>%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
				</div>
				<div class="d-flex justify-content-between text-gray-600 fs-12">
					<div><?php _e("Percent")?></div>
					<div class="text-gray-600 fw-6"><?php _e( round( $stats_by_status->percent_active ) )?><?php _e("%")?></div>
				</div>
  			</div>
	    </div>
	    <div class="col-md-4 mb-4">
  			<div class="bg-white p-20">
  				<div class="d-flex justify-content-between mb-2">
  					<div>
  						<div class="fs-16 fw-6 text-warning"><?php _e("Inactive user")?></div>
  						<div class="fs-12 text-gray-600"><?php _e("Number of inactive users")?></div>
  					</div>
					<div class="fs-25 fw-6 text-warning"><?php _e( $stats_by_status->inactive )?></div>
  				</div>
  				<div class="progress mb-2">
			  		<div class="progress-bar bg-warning" role="progressbar" style="width: <?php _e( $stats_by_status->percent_inactive )?>%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
				</div>
				<div class="d-flex justify-content-between text-gray-600 fs-12">
					<div><?php _e("Percent")?></div>
					<div class="text-gray-600 fw-6"><?php _e( round( $stats_by_status->percent_inactive ) )?><?php _e("%")?></div>
				</div>
  			</div>
	    </div>

	    <div class="col-md-4 mb-4">
  			<div class="bg-white p-20">
  				<div class="d-flex justify-content-between mb-2">
  					<div>
  						<div class="fs-16 fw-6 text-danger"><?php _e("Banned user")?></div>
  						<div class="fs-12 text-gray-600"><?php _e("Number of banned users")?></div>
  					</div>
					<div class="fs-25 fw-6 text-danger"><?php _e( $stats_by_status->banned )?></div>
  				</div>
  				<div class="progress mb-2">
			  		<div class="progress-bar bg-danger" role="progressbar" style="width: <?php _e( $stats_by_status->percent_banned )?>%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
				</div>
				<div class="d-flex justify-content-between text-gray-600 fs-12">
					<div><?php _e("Percent")?></div>
					<div class="text-gray-600 fw-6"><?php _e( round( $stats_by_status->percent_banned ) )?><?php _e("%")?></div>
				</div>
  			</div>
	    </div>
	</div>

	<div class="row">
		<div class="col-md-12 mb-4">
			<div class="card h-100">
				<div class="card-header">
					<div class="card-title"><?php _e("Register history")?></div>
				</div>
				<div class="card-body overflow-auto pb-1">
					<div class="row">
						<div class="col-ld-6 col-md-3 col-xs-3">
							<div class="card border b-r-10 mb-4">
								<div class="card-body">
									<div class="fw-9 fs-40 text-primary position-absolute t-10 r-10 opacity-20"><i class="fad fa-user-plus"></i></div>
									<div class="fs-14 text-gray-600"><?php _e("Today")?></div>
									<div class="fw-9 fs-30 text-primary d-flex"><span class="me-1"><?php _ec( short_number( $stats_by_date->today ) )?></span> <span class="fs-14 fw-4 d-flex align-items-center mt-2"><?php _e("Users")?></span></div>
								</div>
							</div>
						</div>
						<div class="col-ld-6 col-md-3 col-xs-3">
							<div class="card border b-r-10 mb-4">
								<div class="card-body">
									<div class="fw-9 fs-40 text-success position-absolute t-10 r-10 opacity-20"><i class="fad fa-user-plus"></i></div>
									<div class="fs-14 text-gray-600"><?php _e("This week")?></div>
									<div class="fw-9 fs-30 text-success d-flex"><span class="me-1"><?php _ec( short_number( $stats_by_date->week ) )?></span> <span class="fs-14 fw-4 d-flex align-items-center mt-2"><?php _e("Users")?></span></div>
								</div>
							</div>
						</div>
						<div class="col-ld-6 col-md-3 col-xs-3">
							<div class="card border b-r-10 mb-4">
								<div class="card-body">
									<div class="fw-9 fs-40 text-warning position-absolute t-10 r-10 opacity-20"><i class="fad fa-user-plus"></i></div>
									<div class="fs-14 text-gray-600"><?php _e("This month")?></div>
									<div class="fw-9 fs-30 text-warning d-flex"><span class="me-1"><?php _ec( short_number( $stats_by_date->month ) )?></span> <span class="fs-14 fw-4 d-flex align-items-center mt-2"><?php _e("Users")?></span></div>
								</div>
							</div>
						</div>
						<div class="col-ld-6 col-md-3 col-xs-3">
							<div class="card border b-r-10 mb-4">
								<div class="card-body">
									<div class="fw-9 fs-40 text-danger position-absolute t-10 r-10 opacity-20"><i class="fad fa-user-plus"></i></div>
									<div class="fs-14 text-gray-600"><?php _e("This year")?></div>
									<div class="fw-9 fs-30 text-danger d-flex"><span class="me-1"><?php _ec( short_number( $stats_by_date->year ) )?></span> <span class="fs-14 fw-4 d-flex align-items-center mt-2"><?php _e("Users")?></span></div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="col-md-6 mb-4">
			<div class="card h-100">
				<div class="card-header">
					<div class="card-title"><?php _e("Recently registered")?></div>
				</div>
				<div class="card-body overflow-auto h-400">
					<?php
						if($recently_registered_users){
					 	foreach ($recently_registered_users as $row) {?>
						<div class="d-flex justify-content-between">
							<div href="#" class="d-flex align-items-center">
				                <img src="<?php _e( get_file_url($row->avatar) )?>" class="w-45 h-45 rounded border me-2 p-3 b-r-10">
				                <div>
				                    <div class="fw-6 text-gray-700"><?php _e( $row->fullname )?></div>
				                    <div class="fs-10 text-gray-400"><?php _e( $row->email )?></div>
				                </div>
				            </div>
							<div class="d-flex align-items-center">
								<?php if($row->status == 1){?>
									<span class="fw-4 badge badge-light-warning"><?php _e("Inactive")?></span>
								<?php }else if($row->status == 0){?>
									<span class="fw-4 badge badge-light-danger"><?php _e("Banned")?></span>
								<?php }else{?>
									<span class="fw-4 badge badge-light-success"><?php _e("Active")?></span>
								<?php }?>
							</div>
						</div>

						<div class="separator separator-dashed my-4"></div>
					<?php }}?>
				</div>
			</div>
		</div>

		<div class="col-md-6 mb-4">
			<div class="card">
				<div class="card-header">
					<div class="card-title"><?php _e("Login type")?></div>
				</div>
				<div class="card-body">
					<div id="login_type_chart"></div>			
				</div>
			</div>
		</div>

	</div>

	<div class="card">
		<div class="card-header">
			<div class="card-title"><?php _e("Last 30 days")?></div>
		</div>
		<div class="card-body">
			<div id="user_register_chart"></div>
		</div>
	</div>
</div>

<script type="text/javascript">
	$(function(){
		Core.chart({
            id: 'user_register_chart',
            categories: <?php _ec( $chart->date )?>,
            data: [{
                name: '<?php _e("New register")?>',
                lineColor: 'rgba(60, 88, 208, 1)',
                fillColor: {
                    linearGradient: {x1: 0, y1: 0, x2: 0, y2: 1},
                    stops: [
                        [0, 'rgba(60, 88, 208, 1)'],
                        [1, 'rgba(255,255,255,.5)']
                    ]
                },
                color: 'rgba(60, 88, 208, 1)',
                data: <?php _ec( $chart->value )?>,
            }]
        });

		Core.chart({
            id: 'login_type_chart',
            categories: '',
            legend: true,
            data: [{
                type: 'pie',
                name: '<?php _e("Total")?>',
                data: [{
                    name: '<?php _e("Direct")?>',
                    y: <?php _ec( $stats_by_login_type->direct )?>,
                    color: 'rgba(60, 88, 208, 1)',
                }, {
                    name: '<?php _e("Facebook")?>',
                    y: <?php _ec( $stats_by_login_type->facebook )?>,
                    color: 'rgba(80, 205, 103, 1)',
                },{
                    name: '<?php _e("Google")?>',
                    y: <?php _ec( $stats_by_login_type->google )?>,
                    color: 'rgba(255, 199, 0, 1)',
                },{
                    name: '<?php _e("Twitter")?>',
                    y: <?php _ec( $stats_by_login_type->twitter )?>,
                    color: 'rgba(241, 65, 108, 1)',
                }],
                showInLegend: true,
                dataLabels: {
                    enabled: false
                }
            }]
        });
	});
</script>