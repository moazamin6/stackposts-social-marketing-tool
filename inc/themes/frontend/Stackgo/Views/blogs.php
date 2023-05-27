<section class="page-header">
  <div class="container">
      <div class="row justify-content-center text-center">
          <div class="col-lg-7">
              <h1><?php _e("Blog")?></h1>
              <p class="lead"><?php _e("The latest articles from our content team will help you update news and reports instantly.")?></p>
          </div>
      </div>
  </div>
</section>

<section class="space-pb">
  <div class="container">
    <div class="row">
      <div class="col-12">
        <div class="my-shuffle-container columns-3">
          <?php foreach ($blogs as $key => $value): ?>
          <div class="grid-item">
            <div class="blog bg-white shadow-sm border-0">
              <img class="img-fluid w-100" src="<?php _ec( get_file_url( $value->img ) )?>" alt="">
              <svg  class="blog-shape" xmlns="http://www.w3.org/2000/svg" width="100%" height="200" viewBox="0 0 1920 100">
              <path class="" fill="#ffffff" d="M0,80S480,0,960,0s960,80,960,80v20H0V80Z"/></svg>
                <!-- Card body start -->
              <div class="card-body p-4 pt-0">
                <h4 class="font-weight-normal mt-2"><a class="text-dark" href="<?php _ec( base_url("blogs/".slugify($value->title)."/".$value->id) )?>"><?php _e($value->title)?></a></h4>
                <hr>
                <?php if ($value->tags != ""): ?>
                  <?php
                  $tags = explode(",", $value->tags);
                  ?>
                  <div class="d-flex">
                    <?php foreach ($tags as $key => $value): ?>
                      <a class="text-dark me-3 small" href="#"><?php _e($value)?></a>
                    <?php endforeach ?>
                  </div>
                <?php endif ?>
              </div>
            </div>
          </div>
          <?php endforeach ?>
       </div>
    </div>
  </section>

