<?php
$config = include realpath( __DIR__."/../Config.php" );
if (!defined('MODULE_CONFIG')){
    define("MODULE_CONFIG", $config);
}

$routes->set404Override('\Core\Home\Controllers\Home::show404');
$routes->get('login/', 'Home::login');
$routes->get('login/(:any)', '\Core\Auth\Controllers\Auth::social_login/$1');
$routes->get('signup/', 'Home::signup');
$routes->get('logout/', 'Home::logout');
$routes->get('blog/', 'Home::blog');
$routes->get('social_login/', 'Home::social_login');
$routes->get('forgot_password/', 'Home::forgot_password');
$routes->get('pricing/', 'Home::pricing');
$routes->get('recovery_password/(:any)', 'Home::recovery_password');
$routes->get('privacy_policy/', 'Home::privacy_policy');
$routes->get('terms_of_service/', 'Home::terms_of_service');
$routes->get('resend_activation', 'Home::resend_activation');
$routes->get('activation/(:any)', 'Home::activation/$1');
$routes->get('faqs/', 'Home::faqs');
$routes->get('features/', 'Home::features');
$routes->get('pricing/', 'Home::pricing');
$routes->get('blogs/', 'Home::blogs');
$routes->get('blogs/(:any)', 'Home::blogs/$1');

$routes->group('', ['namespace' => 'Core\Auth\Controllers'], static function ($routes) {
    $routes->get('login/(:any)', 'Auth::social_login/$1');
    $routes->post('timezone', 'Auth::timezone');
});

if ( file_exists( realpath(  __DIR__."/../Helpers" ) ) ) {
    $helperPath = realpath(  __DIR__."/../Helpers/" )."/";
    $helpers = scandir($helperPath);
    foreach ($helpers as $helper) {
        if ($helper === '.' || $helper === '..' || stripos( $helper , "_helper.php") === false) continue;
        if (  file_exists( $helperPath.$helper ) ) {
            require_once( $helperPath.$helper );
        }
    }
}