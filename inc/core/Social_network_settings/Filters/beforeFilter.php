<?php
if(uri('segment',1) == "social_network_settings"){
    $menu_top = [];
    $top_menu_groups = [];
    $bottom_menu_groups = [];

    $module_paths = get_module_paths();
    $settings_data = array();
    $configs = [];
    if(!empty($module_paths))
    {
        if( !empty($module_paths) ){
            foreach ($module_paths as $key => $module_path) {
                $config_path = $module_path . "/Config.php";
                $config_item = include $config_path;

                $model_paths = $module_path . "/Models/";
                $model_files = glob( $model_paths . '*' );

                if ( !empty( $model_files ) )
                {
                    foreach ( $model_files as $model_file )
                    {
                    	$model_content = file_get_contents($model_file);
    		        	if (preg_match("/block_social_settings/i", $model_content))
    					{	
    						include_once $model_file;
    	                    
                            $class = str_replace(COREPATH, "\\", $model_file);
                            $class = str_replace(".php", "", $class);
                            $class = str_replace("/", "\\", $class);
                            $class = ucfirst($class);
                            $data = new $class;
                            
    						$name = explode("\\", $class);
    						$config_item["html"] = $data->block_social_settings();
                            $configs[] = $config_item;
    					}
                    }
                }
            }
        }
    }

    $menus = [];
    $top_tabs = [];

    if( ! empty($configs) ){

        $menus = $configs;

        if( count($menus) >= 2 ){
            usort($menus, function($a, $b) {
                if( isset($a['position']) &&  isset($b['position']) )
                    return $a['position'] <=> $b['position'];
            });
        }

        //TOP TAB
        foreach ($menus as $row) {
            if(isset($row['parent'])){
                $tab = $row['parent']['id'];
                $top_tabs[$tab][] = $row;
            }else{
                $tab = $row['id'];
                $top_tabs[$tab][] = $row;
            }
        }
    }

    $request->block_social_settings = $top_tabs;
}