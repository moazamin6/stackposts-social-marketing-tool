<section class="page-header">
  <div class="container">
      <div class="row justify-content-center text-center">
          <div class="col-lg-7">
              <h1><?php _ec($result->title)?></h1>
          </div>
      </div>
  </div>
</section>

<section class="blog-space-pb mb-5">
  <div class="container">
    <div class="row">
      <div class="col-md-8 col-lg-7">
        <div class="card border-0">
            <img src="<?php _ec( get_file_url($result->img) )?>" class="img-fluid card-img-top" alt="<?php _ec($result->title)?>">
            <div class="card-body">
              <?php _ec($result->content)?>
            </div>
            <hr>
            <!-- row start -->
            <div class="row px-4">
              <div class="col-sm-6">
                <?php if ($result->tags != ""): ?>
                  <?php
                  $tags = explode(",", $result->tags);
                  ?>
                  <div class="tags d-flex align-items-center mt-1">
                    <h6 class="font-weight-medium mb-0 me-3"><?php _e("Tags")?></h6>
                    <?php foreach ($tags as $key => $value): ?>
                      <?php if ($key != 0): ?>
                        <span class="me-2">, </span>
                      <?php endif ?> 
                      <a class="text-muted me-1" href="#"><?php _e($value)?></a>
                    <?php endforeach ?>
                  </div>
                <?php endif ?>
              </div>
              <div class="col-sm-6">

                <!-- share start -->
                <div class="d-flex align-items-center justify-content-sm-end">
                  <h6 class="font-weight-medium mb-0 me-3"><?php _e("Share:")?></h6>
                  <a href="#" class="text-dark ms-2">
                    <i class="fab fa-facebook-f"></i>
                  </a>
                  <a href="#" class="text-dark ms-2">
                    <i class="fab fa-twitter"></i>
                  </a>
                  <a href="#" class="text-dark ms-2">
                    <i class="fab fa-instagram"></i>
                  </a>
                  <a href="#" class="text-dark ms-2">
                    <i class="fab fa-linkedin"></i>
                  </a>
                </div>
                <!-- share end -->

              </div>
            </div>
            <!-- row end -->
            <hr>
          </div>
          <!-- blog end -->

          </div>
          <div class="col-md-4 col-lg-4 mt-md-0 mt-5 offset-lg-1">
            <!-- blog-sidebar -->
            <div class="sidebar">
              <!-- search -->
              <!-- <div class="widget">
                <div class="search">
                  <i class="fas fa-search"></i>
                  <input type="text" class="form-control" placeholder="Search">
                </div>
              </div> -->
              <!-- search -->
              <!-- Recent Post -->
              <div class="widget">
                <div class="widget-title">
                  <h5><?php _e("Recent Post")?></h5>
                </div>
                <?php if ($recent_posts): ?>
                  <?php foreach ($recent_posts as $key => $value): ?>
                    <div class="d-flex mb-4 align-items-center">
                      <div class="avatar avatar-lg">
                        <img class="img-fluid rounded" src="<?php _ec( get_file_url($value->img) )?>" alt="<?php _e($value->title)?>">
                      </div>
                      <div class="ms-3 recent-posts">
                        <a class="mb-2 d-block" href="<?php _ec( base_url("blogs/".slugify($value->title)."/".$value->id) )?>"><b><?php _e($value->title)?></b></a>
                        <a class="d-block date" href="<?php _ec( base_url("blogs/".slugify($value->title)."/".$value->id) )?>"><i class="far fa-clock text-primary pe-2"></i><?php _ec( date_show($value->created) )?></a>
                      </div>
                    </div>
                  <?php endforeach ?>
                <?php endif ?>
              </div>
              <!-- Recent Post -->
              <!-- Contact Info -->
              <div class="widget">
                <div class="widget-title">
                  <h5>Contact Info</h5>
                </div>
                <div class="widget-contact-info">
                  <ul class="list-unstyled list-style mb-0">
                    <li><i class="fas fa-map-marker-alt text-primary"></i><span><?php _e("Fairground St. North Bergen, NJ")?></span></li>
                    <li><i class="fas fa-phone-alt text-primary"></i><span><?php _e("+91 123 456 7890")?></span></li>
                    <li><i class="fas fa-envelope-open-text text-primary"></i><span><?php _e("letstalk@example.com")?></span></li>
                  </ul>
                </div>
              </div>
              <!-- Contact Info -->
          </div>
          <!-- blog-sidebar -->
        </div>
      </div>
    </div>
  </section>
