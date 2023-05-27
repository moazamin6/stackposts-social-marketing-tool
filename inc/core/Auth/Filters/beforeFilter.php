<?php
$page = uri("segment", 1);

$router = service('router'); 
$controller  = $router->controllerName();  
$controller  = explode("\\", $controller);  
$controller = $controller[2];

$router = service('router');
$method = $router->methodName();

if(!get_user("id") || !get_team("id")){
    remove_session(["uid"]);
    remove_session(["team_id"]);
    delete_cookies("uid");
    delete_cookies("team_id");

    $module = find_modules( strtolower( $controller ) );

    if ( !isset($module['login_required']) || (isset($module['login_required']) && $module['login_required']) ) {
        if( $controller != "Home" && $controller != get_option("frontend_template", "Stackgo") && $controller != "Auth" && $method != "cron"){
            redirect_to( base_url("login") );
        }
    }

}else{
    if( 
        $page == "login" ||
        $page == "signup" ||
        $page == "activation" ||
        $page == "forgot_password" ||
        $page == "recovery_password"
    ){
        redirect_to( base_url("dashboard") );
    }

    if($page != "profile" && $page != "auth" && $method != "logout" && $page != "dashboard"){
        $module = find_modules($page);

        if ( !isset($module['login_required']) || (isset($module['login_required']) && $module['login_required']) ) {
            if(!empty($module)){
                if( isset($module['role']) && $module['role'] ){
                    if(!role($page)){
                        redirect_to( base_url("dashboard") );
                    }
                }else{
                    if(!permission($page, "", true) && !is_ajax()){
                        redirect_to( base_url("dashboard") );
                    }
                }

                if(get_user("timezone") == ""){
                    redirect_to( base_url("profile/index/account") );
                }
            }
        }
    }

}

