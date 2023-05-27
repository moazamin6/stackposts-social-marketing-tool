<?php
get_option("base_url", base_url());
update_option("base_url", base_url());

if(get_session("uid")){
	date_default_timezone_set( get_user("timezone") );
}
$module_name = $request->uri->getSegment(1);
$module_paths = get_module_paths();
$settings_data = array();
$topbars = array();

if($module_name == "settings"){
	if(!empty($module_paths))
	{
		if( !empty($module_paths) ){
	        foreach ($module_paths as $key => $module_path) {
	            $model_paths = $module_path . "/Models/";
	            $model_files = glob( $model_paths . '*' );

	            if ( !empty( $model_files ) )
	            {
	                foreach ( $model_files as $model_file )
	                {
	                	$model_content = file_get_contents($model_file);
			        	if (preg_match("/block_settings/i", $model_content))
						{	
							include_once $model_file;
		                    
							$class = str_replace(COREPATH, "\\", $model_file);
							$class = str_replace(".php", "", $class);
							$class = str_replace("/", "\\", $class);
							$class = ucfirst($class);
							$data = new $class;

							$name = explode("\\", $class);
							$settings_data[ strtolower( $name[2] ) ] = $data->block_settings();
						}
	                }
	            }
	        }
	    }
	}



	if( !empty($settings_data)){
		uasort($settings_data, function($a, $b) {
	        return $a['position'] <=> $b['position'];
	    });

	    $settings_data = array_reverse($settings_data);
	    $request->setting_pages = $settings_data;
	}else{
		$request->setting_pages = false;
	}
}

if(!empty($module_paths))
{
	if( !empty($module_paths) ){
        foreach ($module_paths as $key => $module_path) {
            $model_paths = $module_path . "/Models/";
            $model_files = glob( $model_paths . '*' );

            if ( !empty( $model_files ) )
            {
                foreach ( $model_files as $model_file )
                {
                	$model_content = file_get_contents($model_file);
		        	if (preg_match("/block_topbar/i", $model_content))
					{	
						include_once $model_file;
		                
						$class = str_replace(COREPATH, "\\", $model_file);
						$class = str_replace(".php", "", $class);
						$class = str_replace("/", "\\", $class);
						$class = ucfirst($class);

						$data = new $class;

						$name = explode("\\", $class);
						$topbars[ strtolower( $name[2] ) ] = $data->block_topbar();
					}
                }
            }
        }
    }
}

if( !empty($topbars)){
	uasort($topbars, function($a, $b) {
        return $a['position'] <=> $b['position'];
    });

    $request->topbars = $topbars;
}else{
	$request->topbars = false;
}
