<?php 
//Get Settings
if(!function_exists("get_user_data")){
    function get_user_data($key, $value = "", $uid = 0){
        if( get_session("uid")){
            $uid = get_user("id");
        }

        if($uid != 0){
            $data = db_get("data", TB_USERS, "id = '".$uid."' ")->data;
            if($data != ""){
                try {
                    $option = json_decode($data);
                } catch (\Exception $e) {
                    $option = [];
                }
            }else{
                $option = [];
            }
            
            if(is_array($option) || is_object($option)){
                $option = (array)$option;

                if( isset($option[$key]) ){
                    return $option[$key];
                }else{
                    $option[$key] = $value;
                    db_update(TB_USERS, ["data" => json_encode($option)], [ "id" => $uid ] );
                    return $value;
                }
            }else{ 
                $option = json_encode(array($key => $value));
                db_update(TB_USERS, ["data" => $option ], [ "id" => $uid ] );
                return $value;
            }
        }
    }
}

//Update Settingz
if(!function_exists("update_user_data")){
    function update_user_data($key, $value, $uid = 0){
        if( get_session("uid")){
            $uid = get_user("id");
        }

        if($uid != 0){
            $data = db_get("data", TB_USERS, "id = '".$uid."' ")->data;
            $option = json_decode($data);
            if(is_array($option) || is_object($option)){
                $option = (array)$option;
                if( isset($option[$key]) ){
                    $option[$key] = $value;
                    db_update(TB_USERS, [ "data" => json_encode($option) ], [ "id" => $uid ] );
                    return true;
                }
            }
        }
        return false;
    }
}

//Get Team Settings
if(!function_exists("get_team_data")){
    function get_team_data($key, $value = "", $team_id = 0){
        if( get_session("team_id")){
            $team_id = get_team("id");
        }

        if($team_id != 0){
            $data = db_get("data", "sp_team", "id = '".$team_id."' ")->data;
            if(!empty($data)){
                $option = json_decode($data);
            }else{
                $option = false;
            }

            if(is_array($option) || is_object($option)){
                $option = (array)$option;

                if( isset($option[$key]) ){
                    return $option[$key];
                }else{
                    $option[$key] = $value;
                    db_update("sp_team", ["data" => json_encode($option)], [ "id" => $team_id ] );
                    return $value;
                }
            }else{ 
                $option = json_encode(array($key => $value));
                db_update("sp_team", ["data" => $option ], [ "id" => $team_id ] );
                return $value;
            }
        }
    }
}

//Update Team Setting
if(!function_exists("update_team_data")){
    function update_team_data($key, $value, $team_id = 0){
        if( get_session("team_id") && $team_id == 0){
            $team_id = get_team("id");
        }

        if($team_id != 0){
            $data = db_get("data", "sp_team", "id = '".$team_id."' ")->data;
            if($data != ""){
                try {
                    $option = json_decode($data);
                } catch (\Exception $e) {
                    $option = [];
                }
            }else{
                $option = [];
            }
            if(is_array($option) || is_object($option)){
                $option = (array)$option;
                if( isset($option[$key]) ){
                    $option[$key] = $value;
                    db_update("sp_team", [ "data" => json_encode($option) ], [ "id" => $team_id ] );
                    return true;
                }
            }
        }
        return false;
    }
}

if(!function_exists("get_user")){
    function get_user( $field = "ids", $uid = 0){
        if($uid == 0){
            $uid =  get_session('uid');
        }else{
            $uid = db_get("ids", TB_USERS, "id = '{$uid}'")->ids;
        }

        $user = db_get("*", TB_USERS, "ids = '".$uid."'");

        if($user && isset($user->$field)){
            return $user->$field;
        }

        return false;
    }
}

if(!function_exists("get_team")){
    function get_team( $field = "ids", $tid = 0){
        if($tid == 0){
            $tid =  get_session('team_id');
        }else{
            $tid = db_get("ids", TB_TEAM, ['id' => $tid])->ids;
        }
        
        $team = db_get("*", TB_TEAM, ['ids' => $tid]);

        if($team && isset($team->$field)){
            return $team->$field;
        }

        return false;
    }
}

/*Permissions*/
if(!function_exists('user_roles')){
    function user_roles($type, $field){
        $request = \Config\Services::request();
        $permissions =  $request->user_roles;

        if( !$permissions ) return false;

        switch ($type) {
            case 'checkbox':
                
                if( isset($permissions->$field) ) return $permissions->$field;

                break;

            case 'radio':
                
                if( isset($permissions->$field) ) return $permissions->$field;

                break;

            case 'selected':
                
                if( isset($permissions->$field) ) return $permissions->$field;

                break;
            
            default:
                
                if( isset($permissions->$field) ) return $permissions->$field;

                break;
        }

        return false;
    }
}

if(!function_exists('role')){
    function role($name, $uid=""){
        if($uid==""){
            $uid = get_user('id');
            $role = get_user("role");
            $is_admin = get_user("is_admin");
            if(!get_session("team_id") || !get_session("uid")){
                return false;
            }
        }else{
            $role = 0;
            $is_admin = 0;
        }

        $roles = db_get("*", TB_ROLES, ["id" => $role]);
        $user = db_get("expiration_date", TB_USERS, ["id" => $uid]);
        $expiration_date = $user->expiration_date;

        if( $user->expiration_date < time() && !$is_admin ){
            return false;
        }

        $permissions = false;
        if($roles){
            $permissions = json_decode($roles->permissions, true);
        }


        if($permissions){
            if( isset( $permissions[$name] ) ){
                return $permissions[$name];
            }
        }

        if($is_admin){
            return true;
        }

        return false;
    }
}
