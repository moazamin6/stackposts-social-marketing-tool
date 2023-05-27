<!DOCTYPE html>
<html lang="en" dir="<?php _ec( request_service("language")->dir )?>" data-theme="<?php _ec( get_option("theme_color", "light") )?>">
    <head><base href="">
        <meta charset="utf-8" />
        <title><?php _ec( $title )?></title>
        <meta name="description" content="<?php _e( get_option("website_description", "") )?>" />
        <meta name="keywords" content="<?php _e( get_option("website_description", "") )?>" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <link rel="shortcut icon" href="<?php _ec( get_option("website_favicon", base_url("assets/img/favicon.svg")) )?>" />
        <link href="<?php _ec( get_theme_url() ) ?>Assets/fonts/fontawesome/css/all.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php _ec( get_theme_url() ) ?>Assets/fonts/icomoon/icomoon.css" rel="stylesheet" type="text/css" />
        <link href="<?php _ec( get_theme_url() ) ?>Assets/fonts/flags/flag-icon.css" rel="stylesheet" type="text/css" />
        <link href="<?php _ec( get_theme_url() ) ?>Assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php _ec( get_theme_url() ) ?>Assets/plugins/pagination/pagination.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php _ec( get_theme_url() ) ?>Assets/plugins/izitoast/izitoast.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php _ec( get_theme_url() ) ?>Assets/plugins/webui-popover/webui-popover.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php _ec( get_theme_url() ) ?>Assets/plugins/jquery-ui/jquery-ui.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php _ec( get_theme_url() ) ?>Assets/plugins/datetimepicker/timepicker-addon.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php _ec( get_theme_url() ) ?>Assets/plugins/emojionearea/emojionearea.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php _ec( get_theme_url() ) ?>Assets/plugins/tagsinput/bootstrap-tagsinput.css" rel="stylesheet" type="text/css" />
        <link href="<?php _ec( get_theme_url() ) ?>Assets/plugins/owlcarousel/owl.carousel.css" rel="stylesheet" type="text/css" />
        <link href="<?php _ec( get_theme_url() ) ?>Assets/plugins/owlcarousel/owl.theme.default.css" rel="stylesheet" type="text/css" />
        <link href="<?php _ec( get_theme_url() ) ?>Assets/plugins/daterangepicker/daterangepicker.css" rel="stylesheet" type="text/css" />
        <link href="<?php _ec( get_theme_url() ) ?>Assets/plugins/fancybox/jquery.fancybox.min.css" rel="stylesheet" type="text/css"></link>
        <link href="<?php _ec( get_theme_url() ) ?>Assets/plugins/minicolors/jquery.minicolors.css" rel="stylesheet" type="text/css" />
        <link href="<?php _ec( get_theme_url() ) ?>Assets/plugins/select2/css/select2.css" rel="stylesheet" type="text/css" />
        <link href="<?php _ec( get_theme_url() ) ?>Assets/plugins/monthly/monthly.css" rel="stylesheet" type="text/css" />
        <link href="<?php _ec( get_theme_url() ) ?>Assets/css/animate.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php _ec( get_theme_url() ) ?>Assets/css/style.css" rel="stylesheet" type="text/css" />
        <script src="<?php _ec( get_theme_url() ) ?>Assets/plugins/jquery/jquery.min.js"></script>
        <?php _ec( load_files("css") );?>
        <?php _ec( add_script_to_header() )?>
    </head>
    <body class="<?php _ec( get_option("sidebar_type", "sidebar-small") )?> <?php _ec( get_option("theme_color", "light") )?>">
        <div class="loading">
            <div class="loading-icon">
                <span></span>
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>

        <?php _ec( $this->include('Backend\Stackmin\Views\header'), false )?>

        <div class="d-flex h-100">
            <?php _ec( $this->include('Backend\Stackmin\Views\sidebar'), false )?>
            <?php _ec( $this->renderSection('content'), false )?>
        </div>

        <div class="sidebar-popover"></div>
        
        <?php _ec( add_script_to_footer() )?>
        <script src="https://code.highcharts.com/highcharts.js"></script>
        <script src="https://code.highcharts.com/maps/modules/map.js"></script>
        <script src="https://code.highcharts.com/mapdata/custom/world.js"></script>
        <script src="<?php _ec( get_theme_url() ) ?>Assets/plugins/tinymce/tinymce.min.js"></script>
        <script src="<?php _ec( get_theme_url() ) ?>Assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="<?php _ec( get_theme_url() ) ?>Assets/plugins/nicescroll/nicescroll.min.js"></script>
        <script src="<?php _ec( get_theme_url() ) ?>Assets/plugins/izitoast/izitoast.min.js"></script>
        <script src="<?php _ec( get_theme_url() ) ?>Assets/plugins/pagination/pagination.min.js"></script>
        <script src="<?php _ec( get_theme_url() ) ?>Assets/plugins/webui-popover/webui-popover.js"></script>
        <script src="<?php _ec( get_theme_url() ) ?>Assets/plugins/jquery-ui/jquery-ui.min.js"></script>
        <script src="<?php _ec( get_theme_url() ) ?>Assets/plugins/datetimepicker/timepicker-addon.min.js"></script>
        <script src="<?php _ec( get_theme_url() ) ?>Assets/plugins/emojionearea/emojionearea.min.js"></script>
        <script src="<?php _ec( get_theme_url() ) ?>Assets/plugins/tagsinput/bootstrap-tagsinput.js"></script>
        <script src="<?php _ec( get_theme_url() ) ?>Assets/plugins/owlcarousel/owl.carousel.min.js"></script>
        <script src="<?php _ec( get_theme_url() ) ?>Assets/plugins/daterangepicker/moment.min.js"></script>
        <script src="<?php _ec( get_theme_url() ) ?>Assets/plugins/daterangepicker/daterangepicker.js"></script>
        <script src="<?php _ec( get_theme_url() ) ?>Assets/plugins/fancybox/jquery.fancybox.min.js"></script>
        <script src="<?php _ec( get_theme_url() ) ?>Assets/plugins/minicolors/jquery.minicolors.min.js"></script>
        <script src="<?php _ec( get_theme_url() ) ?>Assets/plugins/select2/js/select2.full.min.js"></script>
        <script src="<?php _ec( get_theme_url() ) ?>Assets/plugins/monthly/monthly.js"></script>
        <script src="<?php _ec( get_theme_url() ) ?>Assets/plugins/jquery-ace/ace/ace.js"></script>
        <script src="<?php _ec( get_theme_url() ) ?>Assets/plugins/jquery-ace/jquery-ace.min.js"></script>
        <script src="<?php _ec( get_theme_url() ) ?>Assets/plugins/jquery-ace/ace/mode-php.js"></script>
        <script src="<?php _ec( get_theme_url() ) ?>Assets/plugins/jquery-ace/ace/theme-monokai.js"></script>
        <script src="<?php _ec( get_theme_url() ) ?>Assets/js/layout.js"></script>
        <script src="<?php _ec( get_theme_url() ) ?>Assets/js/core.js"></script>
        <?php _ec( load_files("js") );?>

    </body>
</html>