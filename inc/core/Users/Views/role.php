<div class="container py-5">
	<div class="row">
		
		<div class="col-md-3 mb-4">
			<form class="actionForm" action="<?php _ec( get_module_url("role_save") )?>" method="POST" data-redirect="<?php _ec( get_module_url("index/role") )?>">
				<div class="card">
					<div class="card-header">
						<div class="card-title"><i class="fad fa-key fs-18 text-danger me-2"></i>  <?php _e("Roles");?></div>
					</div>
					<div class="card-body">
						<a href="<?php _e( get_module_url("index/role/new") )?>" class="btn btn-outline btn-outline-dashed btn-outline-primary btn-active-light-primary w-100 mb-4 actionItem" data-result="html" data-content="update-roles" data-history="<?php _e( get_module_url("index/role") )?>">
							<i class="fal fa-plus"></i> <?php _e("Add new")?>
						</a>
						<?php if (!empty($result)): ?>

							<?php foreach ($result as $key => $value): ?>

							<?php 
							$permissions = json_decode( $value->permissions, 2);
							?>
							<a href="<?php _e( get_module_url('index/role/'.$value->ids) )?>" class="sp-menu-item d-flex align-items-center px-2 py-2 mb-1 rounded bg-hover-light-primary actionItem users-list <?php _e( uri('segment', 4)==$value->ids?'bg-light-primary':'' )?>" data-remove-other-active="true" data-active="bg-light-primary" data-result="html" data-content="update-roles" data-history="<?php _e( get_module_url('index/role/'.$value->ids) )?>">
					            <div class="d-flex mb-10 me-auto w-100 align-items-center">
					                <div class="d-flex align-items-center mb-10 ">
					                    <div class="symbol symbol-40px p-r-10">
					                        <span class="symbol-label border bg-white">
					                            <i class="fad fa-users fs-18 text-primary"></i>
					                        </span>
					                    </div>
					                </div>
					                <div class="d-flex flex-column flex-grow-1">
					                    <h5 class="custom-list-title fw-bold text-gray-800 mb-0 fs-14"><?php _ec( $value->name )?></h5>
					                    <span class="text-gray-700 fs-10"><?php _ec( sprintf(__("%s permissions"), count( $permissions ) ) )?></span>
					                </div>
					            </div>
					        </a>
					        <?php endforeach ?>
						<?php else: ?>
							<div class="mw-400 container d-flex align-items-center align-self-center h-100">
							    <div class="text-center">
							        <div class="text-center px-4">
							            <img class="mw-100 mh-300px" alt="" src="<?php _e( get_theme_url() ) ?>Assets/img/empty.png">
							        </div>
							    </div>
							</div>
						<?php endif ?>
					</div>
				</div>
			</form>
		</div>
		<div class="col-md-9 mb-4 update-roles">
			<?php _ec( $this->include('Core\Users\Views\update_role'), false);?>
		</div>
	</div>
</div>