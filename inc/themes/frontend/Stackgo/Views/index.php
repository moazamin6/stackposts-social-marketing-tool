<!DOCTYPE html>
<html lang="en" dir="<?php _ec( request_service("language")->dir )?>">
<head>
    <meta charset="utf-8">
    <meta name="keywords" content="<?php _ec( get_option("website_keyword", "social network, marketing, brands, businesses, agencies, individuals") )?>" />
    <meta name="description" content="<?php _ec( get_option("website_description", "Let start to manage your social media so that you have more time for your business.") )?>" />
    <meta name="author" content="stackposts.com" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?php _ec( get_option("website_title", "#1 Social Media Management & Analysis Platform") )?></title>
    <link rel="shortcut icon" href="<?php _ec( get_option("website_favicon", base_url("assets/img/favicon.svg")) )?>" />
    <link rel="stylesheet" href="<?php _ec( get_frontend_url() )?>Assets/css/font-awesome/all.min.css" />
    <link rel="stylesheet" href="<?php _ec( get_frontend_url() )?>Assets/css/icomoon/icomoon.css" />
    <link rel="stylesheet" href="<?php _ec( get_frontend_url() )?>Assets/css/flaticon/flaticon.css" />
    <link rel="stylesheet" href="<?php _ec( get_frontend_url() )?>Assets/css/bootstrap/bootstrap.min.css" />
    <link rel="stylesheet" href="<?php _ec( get_frontend_url() )?>Assets/css/owl-carousel/owl.carousel.min.css" />
    <link rel="stylesheet" href="<?php _ec( get_frontend_url() )?>Assets/css/owl-carousel/owl.carousel.min.css" />
    <link rel="stylesheet" href="<?php _ec( get_frontend_url() )?>Assets/css/swiper/swiper.min.css" />
    <link rel="stylesheet" href="<?php _ec( get_frontend_url() )?>Assets/css/animate/animate.min.css"/>
    <link rel="stylesheet" href="<?php _ec( get_frontend_url() )?>Assets/css/style.css" />
    <script src="<?php _ec( get_frontend_url() )?>Assets/js/jquery-3.6.0.min.js"></script>
    <script type="text/javascript">
        var PATH  = '<?php _ec( base_url()."/" )?>';
        var csrf = "<?php _ec( csrf_hash() ) ?>";
    </script>
  </head>
<body>

    <header class="header default header-transparent <?php _ec( uri("segment", 1) == ""?"header-transparent-light":"" )?>">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <nav class="navbar navbar-static-top navbar-expand-lg header-sticky justify-content-between">
              <?php if (uri("segment", 1) == ""): ?>
              <a class="navbar-brand" href="<?php _ec( base_url() )?>"><img class="img-fluid logo" src="<?php _ec( get_option("website_logo_light", base_url("assets/img/logo-light.svg")) )?>" alt="logo"></a>
              <?php else: ?>
              <a class="navbar-brand" href="<?php _ec( base_url() )?>"><img class="img-fluid logo" src="<?php _ec( get_option("website_logo_color", base_url("assets/img/logo-color.svg")) )?>" alt="logo"></a>
              <?php endif ?>
              <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarmenu" aria-controls="navbarmenu" aria-expanded="false" aria-label="Toggle navigation">
              <i class="fas fa-align-left"></i>
              </button>
              <div class="navbar-collapse collapse" id="navbarmenu">
                <ul class="nav navbar-nav">
                  <li class="nav-item">
                    <a class="nav-link" href="<?php _ec( base_url() )?>" aria-haspopup="true" aria-expanded="false"><?php _e("Home")?></a>
                  </li>
                  <li class="nav-item mega-menu">
                    <a href="<?php _ec( base_url("features") )?>" class="nav-link" ><?php _e("Features")?></a>
                  </li>
                  <?php if (find_modules("payment")): ?>
                  <li class="nav-item mega-menu">
                    <a href="<?php _ec( base_url("pricing") )?>" class="nav-link" ><?php _e("Pricing")?></a>
                  </li>   
                  <?php endif ?>             
                  <li class="nav-item">
                    <a class="nav-link" href="<?php _ec( base_url("faqs") )?>" aria-haspopup="true" aria-expanded="false"><?php _e("FAQs")?></a> 
                  </li>
                  <?php if (find_modules("blog_manager")): ?>
                  <li class="nav-item">
                    <a class="nav-link" href="<?php _ec( base_url("blogs") )?>" aria-haspopup="true" aria-expanded="false"><?php _e("Blogs")?></a> 
                  </li>
                  <?php endif ?>
                </ul>       
              </div>
              <?php if ( get_session("uid") ): ?>
                <div class="align-items-center" ml-5 mt-5 mt-lg-0>
                  <a href="<?php _ec( base_url("dashboard") )?>" class="btn btn-primary" data-swiper-animation="fadeInUp" data-duration="1s" data-delay="1.5s"><?php _e("Dashboard")?><span></span></a>
                </div>   
              <?php else: ?>

                <?php if ( get_option("signup_status", 1) ): ?>
                <ul class="nav navbar-nav">   
                  <li class="nav-item">
                    <a class="nav-link" href="<?php _ec( base_url("login") )?>" aria-haspopup="true" aria-expanded="false"> <?php _e("Login")?></a> 
                  </li>                                                            
                </ul>  
                <?php else: ?>
                  <div class="align-items-center" ml-5 mt-5 mt-lg-0>
                    <a href="<?php _ec( base_url("login") )?>" class="btn btn-primary" data-swiper-animation="fadeInUp" data-duration="1s" data-delay="1.5s"><?php _e("Login")?><span></span></a>
                  </div>  
                <?php endif ?>
                <?php if ( get_option("signup_status", 1) ): ?>
                <div class="align-items-center" ml-5 mt-5 mt-lg-0>
                  <a href="<?php _ec( base_url("signup") )?>" class="btn btn-primary" data-swiper-animation="fadeInUp" data-duration="1s" data-delay="1.5s"><?php _e("Sign up")?><span></span></a>
                </div>            
                  <?php endif ?>            
              <?php endif ?>
            </nav>
          </div>
        </div>
      </div>
    </header>

    <?php _ec( $content )?>

    <svg  class="blog-shape" xmlns="http://www.w3.org/2000/svg" width="100%" height="200" viewBox="0 0 1920 100">
      <path class="" fill="#f5f9ff" d="M0,80S480,0,960,0s960,80,960,80v20H0V80Z"/></svg>
    <footer class="footer bg-light pt-5">
      <div class="container pb-5">
        <div class="row">
          <div class="col-md-12 col-lg-4 pe-lg-5 ">
            <a class="footer-logo py-0" href="<?php _ec( base_url() )?>"><img class="img-fluid" src="<?php _ec( get_option("website_logo_color", base_url("assets/img/logo-color.svg")) )?>" alt="logo"></a>
            <div class="footer-contact-info mt-4">
              <p><?php _e("Helping you execute a comprehensive marketing plan, manage your brands by scheduling your posts to optimize performance on many social media platforms")?></p>
            </div>
          </div>
          <div class="col-lg-5 col-md-8">
            <div class="row">
              <div class="col-sm-6 col-lg-6 mb-4 mb-sm-0">
                <h5 class="text-primary mb-2 mb-sm-4"><?php _e("Quick links")?></h5>
                <div class="footer-link">
                  <ul class="list-unstyled mb-0">
                    <li><a href="<?php _ec( base_url("faqs") )?>"><?php _e("FAQs")?></a></li>
                    <?php if (find_modules("blog_manager")): ?>
                    <li><a href="<?php _ec( base_url("blogs") )?>"><?php _e("Blog")?></a></li>
                    <?php endif ?>
                    <li><a href="<?php _ec( base_url("login") )?>"><?php _e("Login")?></a></li>
                    <li><a href="<?php _ec( base_url("signup") )?>"><?php _e("Signup")?></a></li>
                  </ul>
                </div>
              </div>
              <div class="col-sm-6 col-lg-6 mb-4 mb-lg-0">
                <h5 class="text-primary mb-2 mb-sm-4"><?php _e("Useful Links")?></h5>
                <div class="footer-link">
                  <ul class="list-unstyled mb-0">
                    <li><a href="<?php _e( base_url("terms_of_service") )?>"><?php _e("Terms of Use")?></a></li>
                    <li><a href="<?php _e( base_url("privacy_policy") )?>"><?php _e("Privacy Policy")?></a></li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
          <?php if ( 
            get_option("social_page_facebook", "") != "" ||
            get_option("social_page_twitter", "") != "" ||
            get_option("social_page_pinterest", "") != "" ||
            get_option("social_page_youtube", "") != "" ||
            get_option("social_page_instagram", "") != ""
          ): ?>
          <div class="col-sm-6 col-md-4 col-lg-3 mb-4 mb-lg-0">
            <h5 class="text-primary mb-2 mb-sm-4"><?php _e("Socials")?></h5>
            <div class="footer-link">
              <ul class="list-unstyled mb-0">
                <div class="social">
                  <ul class="list-unstyled">
                    <?php if (get_option("social_page_facebook", "") != ""): ?>
                      <li><a href="<?php _ec( get_option("social_page_facebook", "") )?>"> <i class="fab fa-facebook-f"></i> </a></li>
                    <?php endif ?>
                    <?php if (get_option("social_page_twitter", "") != ""): ?>
                    <li><a href="<?php _ec( get_option("social_page_twitter", "") )?>"> <i class="fab fa-twitter"></i> </a></li>
                    <?php endif ?>
                    <?php if (get_option("social_page_pinterest", "") != ""): ?>
                    <li><a href="<?php _ec( get_option("social_page_pinterest", "") )?>"> <i class="fab fa-pinterest-p"></i> </a></li>
                    <?php endif ?>
                    <?php if (get_option("social_page_youtube", "") != ""): ?>
                    <li><a href="<?php _ec( get_option("social_page_youtube", "") )?>"> <i class="fab fa-youtube"></i> </a></li>
                    <?php endif ?>
                    <?php if (get_option("social_page_instagram", "") != ""): ?>
                    <li><a href="<?php _ec( get_option("social_page_instagram", "") )?>"> <i class="fab fa-instagram"></i> </a></li>
                    <?php endif ?>
                  </ul>
                </div>                
              </ul>
            </div>
          </div>
          <?php endif ?>
        </div>
      </div>
      <div class="footer-bottom py-4 border-top">
        <div class="container">
          <div class="row align-items-center">
            <div class="col-lg-6 text-md-start text-center mt-0">
              <p class="mb-0"><?php _e("© Copyright 2023. All Rights Reserved")?></p>
            </div>
          </div>
        </div>
      </div>
    </footer>

    <div id="back-to-top" class="back-to-top">
      <a href="#"><i class="fas fa-angle-up"></i></a>
    </div>

    <?php if (get_option("gdpr_status", 1)): ?>
    <script type="text/javascript">
        $(function(){
            $('body').ihavecookies({
                title:"<?php _e("Cookies & Privacy")?>",
                message:"<?php _e("We use cookies to ensure that we give you the best experience on our website. By clicking Accept or continuing to use our site, you consent to our use of cookies and our privacy policy. For more information, please read our privacy policy.")?>",
                acceptBtnLabel:"<?php _e("Accept cookies")?>",
                advancedBtnLabel:"<?php _e("Customize cookies")?>",
                moreInfoLabel: "<?php _e("More information")?>",
                link: '<?php _ec( base_url("privacy_policy") )?>',
                expires: 30,
            });
        });
    </script>
    <?php endif ?>

    
    <script src="<?php _ec( get_frontend_url() )?>Assets/js/popper/popper.min.js"></script>
    <script src="<?php _ec( get_frontend_url() )?>Assets/js/bootstrap/bootstrap.min.js"></script>
    <script src="<?php _ec( get_frontend_url() )?>Assets/js/owl-carousel/owl.carousel.min.js"></script>
    <script src="<?php _ec( get_frontend_url() )?>Assets/js/ihavecookies/jquery.ihavecookies.js"></script>
    <script src="<?php _ec( get_frontend_url() )?>Assets/js/swiper/swiper.min.js"></script>
    <script src="<?php _ec( get_frontend_url() )?>Assets/js/swiperanimation/SwiperAnimation.min.js"></script>
    <script src="<?php _ec( get_frontend_url() )?>Assets/js/jquery.appear.js"></script>
    <script src="<?php _ec( get_frontend_url() )?>Assets/js/shuffle/shuffle.min.js"></script>
    <script src="<?php _ec( get_frontend_url() )?>Assets/js/custom.js"></script>
    <script src="<?php _ec( get_frontend_url() )?>Assets/js/core.js"></script>
    
</body>
</html>
