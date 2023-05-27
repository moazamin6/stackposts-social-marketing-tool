<section class="page-header bg-light position-relative pb-5">
  <div class="container">
    <div class="row justify-content-center text-center">
      <div class="col-lg-8">
        <h1 class="mb-4"><?php _e("Frequently Asked Questions")?></h1>
        <p class="lead"><?php _e("Getting more information about our platform that will help you get all benefits from us. These all questions are asked for the first time")?></p>
      </div>
    </div>
  </div>
</section>
<div class="w-100 mt-n1">
  <svg xmlns="http://www.w3.org/2000/svg" width="1917" height="131.625" viewBox="0 0 1917 131.625">
    <defs>
    </defs>
    <path class="fill-light" d="M0,0.089s1.965,0.9,5.762,2.582C62.48,27.8,528.022,142.15,962,130.943c463.03-11.957,829.35-70.02,955-130.854" transform="translate(0 -0.094)"/>
  </svg>
</div>

<section class="space-pb mt-lg-n5">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-8">
        <div class="accordion accordion-big" id="faqsContent">
        <?php if (!empty($faqs)): ?>
          
          <?php foreach ($faqs as $key => $value): ?>
          <div class="accordion-item mb-4">
            <h2 class="accordion-header" id="heading<?php _ec($key)?>">
            <button class="accordion-button border <?php _ec( $key == 0?"show":"collapsed shadow" )?>" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?php _ec($key)?>" aria-expanded="true" aria-controls="collapse<?php _ec($key)?>">
            <?php _ec($value->title)?>
            </button>
            </h2>
            <div id="collapse<?php _ec($key)?>" class="accordion-collapse collapse <?php _ec( $key == 0?"show":"" )?>" aria-labelledby="heading<?php _ec($key)?>" data-bs-parent="#faqsContent">
              <div class="accordion-body">
                <?php _ec($value->content)?>
              </div>
            </div>
          </div>
          <?php endforeach ?>

        <?php endif ?>
        </div>
      </div>
    </div>
  </div>
</section>