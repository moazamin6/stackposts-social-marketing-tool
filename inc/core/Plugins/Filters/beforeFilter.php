<?php
if( get_session("uid") && get_session("team_id") ){
	$page = uri("segment", 1);
	$router = service('router'); 
	$controller  = $router->controllerName();  
	$controller  = explode("\\", $controller);  
	$controller = $controller[2];
	if( $controller != "Home" && $controller != get_option("frontend_template", "Stackgo") && $page != "plugins"){
		$license_file = WRITEPATH."license.key";
		if(file_exists($license_file)){
			$license_content = file_get_contents($license_file);
			$license_data = do_decrypt($license_content, get_key(), true);
			$license_data = json_decode($license_data, true);
			$domain = get_domain( base_url() );

			if( 
				!is_array($license_data) || 
				!isset($license_data['domain']) || 
				$license_data['domain'] != $domain 
			){
				redirect_to( base_url("plugins?error=true") );
			}
		}else{
			redirect_to( base_url("plugins?error=".__("The license is invalid. Kindly contact us for further assistance")) );
		}
	}
}