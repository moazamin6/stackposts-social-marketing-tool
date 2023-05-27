<section class="page-header bg-light">
    <div class="container">
            <div class="row justify-content-center text-center">
                <div class="col-lg-7">
                <img class="w-150 mb-5" src="<?php _ec( get_frontend_url() )?>Assets/images/plan-icon.png" alt="logo">
                <h1><?php _e("Choose your plan")?></h1>
                <p class="lead"><?php _e("We offer competitive rates and pricing plans to help you find one that fits the needs and budget of your business.")?></p>
            </div>

            <div class="form-check form-switch form-switch-pricing form-check-custom form-check-solid form-check-warning d-flex justify-content-center align-items-center">
                <label class="form-check-label text-gray-600 ps-0" for="plan_by">
                        <?php _ec("Monthly")?>
                </label>
                <input class="form-check-input plan_by" type="checkbox" id="plan_by" value="1">
                <label class="form-check-label text-gray-600" for="plan_by">
                        <?php _ec("Annually")?>
                </label>
            </div>
        </div>
    </div>
</section>

<div class="w-100 mt-n3">
    <svg xmlns="http://www.w3.org/2000/svg" width="1917" height="131.625" viewBox="0 0 1917 131.625">
        <defs></defs>
        <path class="fill-light" d="M0,0.089s1.965,0.9,5.762,2.582C62.48,27.8,528.022,142.15,962,130.943c463.03-11.957,829.35-70.02,955-130.854" transform="translate(0 -0.094)"></path>
    </svg>
</div>

<section class="clearfix space-pb mb-5 mt-n6 mt-lg-n8">
    <div class="container">
        <div class="row align-items-center pb-4 d-flex justify-content-center">
            <?php if (!empty($plans)): ?>
                
                <?php foreach ($plans as $plan): ?>

                    <?php
                        $permissions = json_decode($plan->permissions, 1);
                    ?>

                    <div class="col-md-4 pb-4 pb-md-0">
                        <div class="pricing pricing-01 shadow-sm rounded <?php _ec($plan->featured?"active":"")?>">
                            <div class="pricing-plan">
                                <?php if ($plan->featured): ?>
                                <div class="text-white"><?php _e("Most popular")?> <span class="text-warning ms-1"><i class="fas fa-star"></i></span></div>
                                <?php endif ?>
                                <h3 class="pricing-title class">
                                    <?php _e($plan->name)?>        
                                </h3>
                                <div class="pricing-description">
                                    <p class="mb-0"><?php _e($plan->description)?></p>
                                </div>
                                <div class="price-table mb-2">
                                    <span class="pricing-price">
                                        <sup><?php _e( get_option("payment_symbol", "$") )?></sup>
                                        <strong class="by_monthly"><?php _e($plan->price_monthly)?></strong>
                                        <strong class="by_annually d-none"><?php _e($plan->price_annually)?></strong>
                                        <?php _e("/ month")?>
                                    </span>
                                </div>

                                <div class="pricing-type">
                                    <?php if ($plan->plan_type == 1): ?>
                                        <div class="title"><?php _e( sprintf(__("Add up to %d social accounts"), $plan->number_accounts*$total_social) )?></div>
                                        <div class="desc"><?php _e( sprintf(__("%d accounts on each platform"), $plan->number_accounts) )?></div>                                  
                                    <?php else: ?>
                                        <div class="title"><?php _e( sprintf(__("%d Social Accounts"), $plan->number_accounts) )?></div>
                                    <?php endif ?>
                                    
                                </div>
                            </div>
                            <ul class="list-unstyled pricing-list text-left m-0">
                                <?php
                                    $plan_items = request_service("plans");
                                ?>

                                <?php if ( !empty($plan_items) ): ?>
                                    
                                    <?php foreach ($plan_items as $plan_item): ?>
                                        <li class="ml-lg-5 text-uppercase mt-3 pricing-list-head"><?php _e( $plan_item["label"] )?></li>

                                        <?php if (!empty($plan_item['items'])): ?>

                                            <?php if ( $plan_item['permission'] ): ?>
                                                <li class="ml-lg-5 d-block">
                                                    <?php foreach ($plan_item['items'] as $key => $value): ?>
                                                        <?php if ( isset( $permissions[ $value['id'] ] ) ): ?>
                                                        <span class="list-icon">
                                                            <div class="d-flex justify-content-center align-items-center">
                                                                <i class="<?php _ec( $value['icon'] )?>" style="color: <?php _ec( $value['color'] )?>;"></i>
                                                            </div>
                                                        </span>
                                                        <?php endif ?>
                                                    <?php endforeach ?>
                                                </li>
                                            <?php else: ?>
                                                <?php foreach ($plan_item['items'] as $key => $value): ?>
                                                    <li class="ml-lg-5"><i class="me-2 <?php _ec( isset( $permissions[ $value['id'] ] )?"fa fa-check bg-primary text-white":"fa fa-check" )?>"></i><?php _e($value["name"])?></li>
                                                <?php endforeach ?>
                                            <?php endif ?>
                                            
                                        <?php endif ?>
                                    <?php endforeach ?>

                                <?php endif ?>
                                <?php 
                                $check_cloud_import = true;
                                if ( !isset($permissions["file_manager_dropbox"]) && !isset($permissions["file_manager_google_drive"]) && !isset($permissions["file_manager_onedrive"]) ){
                                    $check_cloud_import = false;
                                }
                                ?>

                                <li class="ml-lg-5"><i class="me-2 <?php _ec( $check_cloud_import?"fa fa-check bg-primary text-white":"fa fa-check" )?>"></i><span class="me-2"><?php _e( "Cloud import: " )?> </span>

                                    <?php if ( isset($permissions["file_manager_dropbox"]) || isset($permissions["file_manager_google_drive"]) || isset($permissions["file_manager_onedrive"]) ): ?>
                                        <?php if (isset($permissions["file_manager_dropbox"])): ?>
                                        <span class="fab fa-dropbox me-2"></span>
                                        <?php endif ?>
                                        <?php if (isset($permissions["file_manager_google_drive"])): ?>
                                        <span class="fab fa-google-drive me-2"></span>
                                        <?php endif ?>
                                        <?php if (isset($permissions["file_manager_onedrive"])): ?>
                                        <span class="icon icon-onedrive"></span>
                                        <?php endif ?>
                                    <?php else: ?>
                                        <span class="small"><?php _e("No support")?></span>
                                    <?php endif ?>
                                </li>
                                <li class="ml-lg-5"><i class="me-2 fa fa-check bg-primary text-white"></i><?php _e( sprintf( __("Max. storage size: %sMB"), $permissions["max_storage_size"])  )?></li>
                                <li class="ml-lg-5"><i class="me-2 fa fa-check bg-primary text-white"></i><?php _e( sprintf( __("Max. file size: %sMB"), $permissions["max_file_size"])  )?></li>
                            </ul>
                            <a href="<?php _e( base_url("payment/index/{$plan->ids}/1" ) )?>" class="btn btn-primary btn-square mt-4 by_monthly"><?php _e("Buy Now")?></a>
                            <a href="<?php _e( base_url("payment/index/{$plan->ids}/2" ) )?>" class="btn btn-primary btn-square mt-4 by_annually d-none"><?php _e("Buy Now")?></a>
                        </div>
                    </div>
                <?php endforeach ?>
            <?php endif ?>
        </div>
    </div>
</section>

<!--=================================
Testimonials -->
<section class="banner-04 align-items-center d-flex space-ptb bg-holder bg-overlay-black-50" style="background-image: url(<?php _ec( get_frontend_url() )?>Assets/images/bg/02.png);">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="section-title text-center">
                    <span class="sub-title text-white"><?php _e("Our Happy Clients")?></span>
                    <h2 class="title text-white"><?php _e("Our customers love us!")?></h2>
                    <p class="text-white"><?php _e("Our clients praise us for our great results, personable service and expert knowledge. </br>Here are what just a few of them had to say.", true)?></p>
                </div>
            </div>
        </div>
        <div class="row position-relative z-index-9">
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="testimonial-item shadow m-0 rounded bg-white p-4">
                    <div class="testimonial-content">
                        <div class="rating mb-3">
                            <ul class="list-unstyled">
                                <li><i class="fas fa-star text-warning"></i></li>
                                <li><i class="fas fa-star text-warning"></i></li>
                                <li><i class="fas fa-star text-warning"></i></li>
                                <li><i class="fas fa-star text-warning"></i></li>
                                <li><i class="fas fa-star text-warning"></i></li>
                            </ul>
                        </div>
                        <p class="mb-4"><?php _e("Easy scheduling, simple time saving and lots of features rich")?></p>
                    </div>
                    <div class="testimonial-info">
                        <div class="testimonial-avatar-img">
                            <img class="img-fluid avatar w-auto rounded-circle" src="<?php _ec( get_frontend_url() )?>Assets/images/avatar/01.jpg" alt="">
                        </div>
                        <div class="testimonial-author">
                            <h6 class="author-name"><?php _e("- Ara A.")?></h6>
                            <span class="author-designation"><?php _e("CEO & Founder, General Motors")?></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="testimonial-item shadow m-0 rounded bg-white p-4 mt-4 mt-md-0">
                    <div class="testimonial-content">
                        <div class="rating mb-3">
                            <ul class="list-unstyled">
                                <li><i class="fas fa-star text-warning"></i></li>
                                <li><i class="fas fa-star text-warning"></i></li>
                                <li><i class="fas fa-star text-warning"></i></li>
                                <li><i class="fas fa-star text-warning"></i></li>
                                <li><i class="fas fa-star text-warning"></i></li>
                            </ul>
                        </div>
                        <p class="mb-4"><?php _e("Very well organized tool with stunning high quality design. Thank you so much!")?></p>
                    </div>
                    <div class="testimonial-info">
                        <div class="testimonial-avatar-img">
                            <img class="img-fluid avatar w-auto rounded-circle" src="<?php _ec( get_frontend_url() )?>Assets/images/avatar/02.jpg" alt="">
                        </div>
                        <div class="testimonial-author">
                            <h6 class="author-name"><?php _e("- Nev W.D95.")?></h6>
                            <span class="author-designation"><?php _e("Product Designer")?></span>
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="testimonial-item shadow m-0 rounded bg-white p-4 mt-4 mt-lg-0">
                    <div class="testimonial-content">
                        <div class="rating mb-3">
                            <ul class="list-unstyled">
                                <li><i class="fas fa-star text-warning"></i></li>
                                <li><i class="fas fa-star text-warning"></i></li>
                                <li><i class="fas fa-star text-warning"></i></li>
                                <li><i class="fas fa-star text-warning"></i></li>
                                <li><i class="fas fa-star text-warning"></i></li>
                            </ul>
                        </div>
                        <p class="mb-4"><?php _e("This tool has made sharing our story and building our brand on social media so much easier.")?></p>
                    </div>
                    <div class="testimonial-info">
                        <div class="testimonial-avatar-img">
                            <img class="img-fluid avatar w-auto rounded-circle" src="<?php _ec( get_frontend_url() )?>Assets/images/avatar/03.jpg" alt="">
                        </div>
                        <div class="testimonial-author">
                            <h6 class="author-name"><?php _e("- Scarlett D.")?></h6>
                            <span class="author-designation"><?php _e("SEO leader")?></span>
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="testimonial-item shadow m-0 rounded bg-white p-4">
                    <div class="testimonial-content">
                        <div class="rating mb-3">
                            <ul class="list-unstyled">
                                <li><i class="fas fa-star text-warning"></i></li>
                                <li><i class="fas fa-star text-warning"></i></li>
                                <li><i class="fas fa-star text-warning"></i></li>
                                <li><i class="fas fa-star text-warning"></i></li>
                                <li><i class="fas fa-star text-warning"></i></li>
                            </ul>
                        </div>
                        <p class="mb-4"><?php _e("This platform is a wonderful tool. The service team is serious, professional and quickly.")?></p>
                    </div>
                    <div class="testimonial-info">
                        <div class="testimonial-avatar-img">
                            <img class="img-fluid avatar w-auto rounded-circle" src="<?php _ec( get_frontend_url() )?>Assets/images/avatar/04.jpg" alt="">
                        </div>
                        <div class="testimonial-author">
                            <h6 class="author-name"><?php _e("- Emily M.")?></h6>
                            <span class="author-designation"><?php _e("Marketing Manager")?></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="position-absolute bottom-0 end-0 w-100">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
            <path fill="#fff" fill-opacity="1" d="M0,288L1440,64L1440,320L0,320Z"></path>
        </svg>
    </div>
</section>
<!--=================================
Testimonials -->
