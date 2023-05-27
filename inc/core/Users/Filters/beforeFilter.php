<?php
if(uri('segment',1) == "users"){
	$role = db_get('*', TB_ROLES, "ids = '".uri('segment',4)."'");

    $request->user_roles = false;
    if( $role ){
        if( $role->permissions != "" ){
            $request->user_roles = json_decode( $role->permissions );
        }
    }

    $configs = get_blocks("block_roles");

    if( ! empty($configs) ){

        $menus = [];
        foreach ($configs as $config) {
            if( isset( $config['menu'] ) && (isset( $config['role'] ) && $config['role'] == 1 ) ){
                $config['menu']['id'] =  isset($config['id'])?$config['id']:false;
                $config['menu']['icon'] = isset($config['icon'])?$config['icon']:false;
                $config['menu']['color'] = isset($config['color'])?$config['color']:false;
                $config['menu']['data'] = isset($config['data'])?$config['data']:false;

                $menus[] = $config['menu'];
            }else{
                if( isset( $config['role'] ) && $config['role'] == 1 ){
                    $config['menu']['tab'] =  5;
                    $config['menu']['position'] = 20000;
                    $config['menu']['name'] =  isset($config['name'])?$config['name']:false;
                    $config['menu']['id'] =  isset($config['id'])?$config['id']:false;
                    $config['menu']['icon'] = isset($config['icon'])?$config['icon']:false;
                    $config['menu']['color'] = isset($config['color'])?$config['color']:false;
                    $config['menu']['data'] = isset($config['data'])?$config['data']:false;

                    $menus[] = $config['menu'];
                }
            }
        }

        if( count($menus) > 2 ){
            usort($menus, function($a, $b) {
                return $a['position'] <=> $b['position'];
            });
            $menus = array_reverse($menus);
        }

        if( count($menus) > 2 ){
            usort($menus, function($a, $b) {
                return $a['tab'] <=> $b['tab'];
            });
            $menus = array_reverse($menus);
        }

        //TOP TAB
        $top_tabs = [];
        foreach ($menus as $row) {
            $tab = $row['id'];
            $top_tabs[$tab][] = $row;
        }

    }

    $request->roles = $top_tabs;
}