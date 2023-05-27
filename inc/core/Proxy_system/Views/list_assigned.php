<form class="" action="<?php _ec( get_module_url("delete") )?>">
<div class="container d-sm-flex align-items-md-center pt-4 align-items-center justify-content-center">
    <div class="bd-search position-relative me-auto">
        <h2 class="mb-0 py-4"> <i class="<?php _ec( $config['icon'] )?> me-2" style="color: <?php _ec( $config['color'] )?>;"></i> <?php _e("Assign proxy")?></h2>
    </div>
    <div class="">
        <div class="me-2">
            <div class="input-group input-group-sm sp-input-group border b-r-4">
                <span class="input-group-text border-0 fs-20 bg-gray-100 text-gray-800" id="sub-menu-search"><i class="fad fa-search"></i></span>
                <input type="text" class="ajax-pages-search ajax-filter form-control form-control-solid ps-15 border-0" name="keyword" value="" placeholder="<?php _e("Search")?>" autocomplete="off">
                <a href="<?php _ec( get_module_url("index/update") )?>" class="btn btn-light btn-active-light-primary m-r-1 border-end" title="<?php _e("Add new")?>" data-toggle="tooltip" data-placement="top"><i class="fad fa-plus text-primary pe-0"></i></a>
		        <div class="btn-group btn-group-sm" title="<?php _e("Assign proxy")?>" data-toggle="tooltip" data-placement="top">
				  	<button class="btn btn-light btn-active-light-success m-r-1 border-end dropdown-toggle dropdown-hide-arrow" type="button" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">
				    	<i class="fad fa-user-plus text-success pe-0"></i>
				  	</button>
				  	<ul class="dropdown-menu miw-500 p-20 dropdown-menu-end boder b-r-6">
				    	<li>
					    	<div class="me-2 w-100 mb-3">
			                	<select class="form-select boder border-dash select-sm w-100" data-control="select2" name="proxy">
			                		<option value=""><?php _e("Select proxy")?></option>
				                	<?php if (!empty($proxies)): ?>
				                		<?php foreach ($proxies as $key => $value): ?>
				                			<option value="<?php _ec($value->id)?>"><?php _ec( "[".list_countries($value->location)."] ".$value->proxy )?></option>
				                		<?php endforeach ?>
				                	<?php endif ?>
				                </select>
			                </div>
			                <a href="<?php _ec( get_module_url("do_assign") )?>" class="btn btn-light btn-active-light-success b-r-6 actionMultiItem w-100" data-redirect="<?php _ec( get_module_url("index/assign") )?>"><i class="fad fa-user"></i> <?php _e("Assign")?></a>
				    	</li>
				  	</ul>
				</div>
                <a href="<?php _e( get_module_url('remove_assign') )?>" class="btn btn-light btn-active-light-danger actionMultiItem m-r-1 border-end" title="<?php _e("Remove assign")?>" data-toggle="tooltip" data-placement="top" data-confirm="<?php _e('Are you sure to remove assign this accounts?')?>" data-redirect="<?php _ec( get_module_url("index/assign") )?>" ><i class="fad fa-user-times pe-0 text-danger pe-0"></i>
	            </a>
            	<a href="<?php _ec( get_module_url() )?>" class="btn btn-light btn-active-light-dark" title="<?php _e("Back")?>" data-toggle="tooltip" data-placement="top" ><i class="fad fa-chevron-left text-dark pe-0"></i></a>
            </div>
        </div>
    </div>
</div>
	
<div class="container my-3">
    <div class="card card-flush">
        <div class="card-body p-0">

            <?php if ( isset($datatable) ): ?>

                <div class="<?php _e( get_data($datatable, "responsive")? "table-responsive":"" )?>">

                    <?php if ( is_array( get_data($datatable, "columns") ) ): ?>

                        <table 
                            class="ajax-pages table table align-middle table-row-dashed fs-13 gy-5" 
                            data-url="<?php _ec( get_module_url("ajax_list_assigned") )?>" 
                            data-response=".ajax-result" 
                            data-per-page="<?php _ec( get_data($datatable, "per_page") )?>"
                            data-current-page="<?php _ec( get_data($datatable, "current_page") )?>"
                            data-total-items="<?php _ec( get_data($datatable, "total_items") )?>"
                        >
                            <thead>
                                <tr class="text-start text-muted fw-bolder text-uppercase gs-0">

                                    <?php foreach ( get_data($datatable, "columns") as $key => $value ): ?>

                                        <?php if ( $key == "id" ): ?>
                                        <th scope="col" class="w-20 border-bottom py-4 ps-4">
                                            <div class="form-check form-check-sm form-check-custom form-check-solid me-3">
                                                <input class="form-check-input checkbox-all" type="checkbox">
                                            </div>
                                        </th>
                                        <?php else: ?>
                                        <th scope="col" class="border-bottom fw-4 fs-12 text-nowrap pe-3 py-4  pe-3"><?php _e( $value )?></th>
                                        <?php endif ?>
                                    <?php endforeach ?>
                                </tr>
                            </thead>
                            <tbody class="ajax-result"></tbody>
                        </table>

                    <?php endif ?>

                </div>
                
            <?php endif ?>

            <?php if (get_data($datatable, "total_items") != 0): ?>
            <nav class="m-t-50 ajax-pagination m-auto text-center mb-4"> </nav>
            <?php endif ?>

        </div>
    </div>
</div>
</form>

<script type="text/javascript">
    $(function(){
        Core.ajax_pages();
    });
</script>