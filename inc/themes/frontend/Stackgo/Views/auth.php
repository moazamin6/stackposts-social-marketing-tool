<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="description" content="<?php _e( get_option("website_description", "Let start to manage your social media so that you have more time for your business.") )?>" />
    <meta name="keywords" content="<?php _e( get_option("website_keyword", "social network, marketing, brands, businesses, agencies, individuals") )?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?php _e( get_option("website_title", "All-you-need social media toolkit for your businesses") )?></title>
    <link rel="shortcut icon" href="<?php _e( get_option("website_favicon", base_url("assets/img/favicon.svg")) )?>" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500&amp;family=Roboto:wght@300;400;500;700;900&amp;display=swap">
    <link rel="stylesheet" href="<?php _ec( get_frontend_url() )?>Assets/css/font-awesome/all.min.css" />
    <link rel="stylesheet" href="<?php _ec( get_frontend_url() )?>Assets/css/flaticon/flaticon.css" />
    <link rel="stylesheet" href="<?php _ec( get_frontend_url() )?>Assets/css/bootstrap/bootstrap.min.css" />
    <link rel="stylesheet" href="<?php _ec( get_frontend_url() )?>Assets/css/select2/select2.css" />
    <link rel="stylesheet" href="<?php _ec( get_frontend_url() )?>Assets/css/owl-carousel/owl.carousel.min.css" />
    <link rel="stylesheet" href="<?php _ec( get_frontend_url() )?>Assets/css/swiper/swiper.min.css" />
    <link rel="stylesheet" href="<?php _ec( get_frontend_url() )?>Assets/css/animate/animate.min.css"/>
    <link rel="stylesheet" href="<?php _ec( get_frontend_url() )?>Assets/css/style.css" />
    <script type="text/javascript">
        var PATH  = '<?php _ec( base_url()."/" )?>';
        var csrf = "<?php _ec( csrf_hash() ) ?>";
    </script>
</head>
<body>
    <section class="vh-100 sign-in">
        <div class="container-fluid h-100 p-0">
            <div class="row g-0 h-100">
                <div class="col-lg-6 align-self-center p-sm-5 p-4">
                    <?php _ec( $content, false )?>
                </div>
                <div class="col-lg-6 col-xl-6 overflow-hidden position-relative d-lg-block d-none" style="background-image: url(<?php _ec( get_frontend_url() )?>Assets/images/svg/signup.svg); background-size: cover;">
                    <div class="d-flex flex-column flex-center py-7 py-lg-15 px-5 px-md-15 h-100 align-items-center justify-content-center">
                        <h1 class="d-none d-lg-block text-white fs-2qx fw-bolder text-center mb-7"> 
                            <?php _e("Fast, Efficient and Productive")?>
                        </h1>
                        <div class="d-none d-lg-block text-white fs-base text-center">
                            <?php _e('There is a solution that supports you make the most out of <br> your social media marketing campaigns and manage them with finesse.<br>Our platform can help simplify your work as well as improve your efficiency', false)?>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </section>

    <div id="back-to-top" class="back-to-top">
        <a href="#"> <i class="fas fa-angle-up"></i></a>
    </div>

    <script src="<?php _ec( get_frontend_url() )?>Assets/js/jquery-3.6.0.min.js"></script>
    <script src="<?php _ec( get_frontend_url() )?>Assets/js/popper/popper.min.js"></script>
    <script src="<?php _ec( get_frontend_url() )?>Assets/js/bootstrap/bootstrap.min.js"></script>
    <script src="<?php _ec( get_frontend_url() )?>Assets/js/jquery.appear.js"></script>
    <script src="<?php _ec( get_frontend_url() )?>Assets/js/owl-carousel/owl.carousel.min.js"></script>
    <script src="<?php _ec( get_frontend_url() )?>Assets/js/swiper/swiper.min.js"></script>
    <script src="<?php _ec( get_frontend_url() )?>Assets/js/swiperanimation/SwiperAnimation.min.js"></script>
    <script src="<?php _ec( get_frontend_url() )?>Assets/js/custom.js"></script>
    <script src="<?php _ec( get_frontend_url() )?>Assets/js/core.js"></script>
</body>
</html>
