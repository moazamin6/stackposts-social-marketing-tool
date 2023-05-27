<div class="col-md-12 mb-5">
	<form class="actionForm" action="<?php _e( base_url("post/report/".uri("segment", 4)) )?>" method="POST" data-result="html" data-content="insights" date-redirect="false" data-loading="false">
	    <div class="card mb-4 bg-transparent shadow-none">
	        <div class="card-header px-0">
	            <div class="card-title fw-6 fs-22 text-gray-800">
	                <span class="me-2"><i class="<?php _ec( $config['icon'] )?> me-2" style="color: <?php _ec($config['color'])?>;"></i> <?php _e("Report posts")?></span>
	            </div>
	            <div class="card-toolbar">
	                <div class="me-3 py-2">
	                	<select name="social_network" data-control="select2" data-hide-search="true" class="form-select form-select-sm bg-body fw-bold border border-dashed miw-150 auto-submit">
		                    <option value="all" data-icon="fas fa-share-alt-square text-dark" selected><?php _e("All Report")?></option>
		                    <?php if (!empty( $result )): ?>
		                        <?php foreach ($result as $value): ?>
		                        	<?php if ( isset($value['parent']['id']) ): ?>
		                            <option value="<?php _e( $value['parent']['id'] )?>" data-icon="<?php _e( $value['icon'] )?>" data-icon-color="<?php _e( $value['color'] )?>"><?php _e( $value['name'] )?></option>
		                        	<?php endif ?>
		                        <?php endforeach ?>
		                    <?php endif ?>
		                </select>
	                </div>
	            	<div class="daterange dashed radius py-2"></div>
	            </div>
	        </div>
	    </div>
	</form>

	<div class="insights">
		<?php _ec( $this->include('Core\Post\Views\loading'), false);?>
	</div>
</div>
