<?php 
/*Permissions*/
if(!function_exists('plan_permission')){
    function plan_permission($type, $field){
        $request = \Config\Services::request();
        $permissions =  $request->plan_permissions;

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

if(!function_exists('permission')){
    function permission($name, $tid="", $check_expiration_date = false){
        if($tid==""){
            $uid = get_user('id');
            $team_id = get_team('id');
            $is_admin = get_user("is_admin");
            if(!get_session("team_id") || !get_session("uid")){
                return false;
            }
        }else{
            $team_id=$tid;
            $team = db_get("*", TB_TEAM, "id = '".$team_id."'");
            $uid = $team->owner;
            $is_admin = 0;
        }


        $team = db_get("*", TB_TEAM, "id = '".$team_id."'");
        $user = db_get("is_admin,expiration_date", TB_USERS, " id = '{$team->owner}' ");

        if(empty($user) || empty($team)){
            return false;
        }

        $is_admin = $user->is_admin;

        if($check_expiration_date){
            $expiration_date = $user->expiration_date;

            if($team->owner == $uid){
                if( $expiration_date != 0 && $expiration_date < time() && !$is_admin ){
                    return false;
                }
            }else{
                if( $expiration_date != 0 && $user->expiration_date < time() && !$is_admin ){
                    return false;
                }
            }
        }

        $permissions = false;
        if(!empty($team)){
            if($team->owner == $uid){
                if($team->permissions != ""){
                    $permissions = json_decode($team->permissions, true);
                }
            }else{
                $team_member = db_get("*", TB_TEAM_MEMBER, "team_id = '".$team->id."' AND uid = '".$uid."'");
                if(empty($team_member)){
                    if( get_session("owner_team_id") ){
                        set_session( [ "team_id" => _s("owner_team_id") ] );
                        remove_session( ["owner_team_id"] );
                        redirect_to( get_url("dashboard") );
                    }
                }

                if($team_member->permissions != ""){
                    $permissions = json_decode($team_member->permissions, true);
                }
            }
        }

        if($permissions){
            if( isset( $permissions[$name] ) ){
                return $permissions[$name];
            }
        }

        if($is_admin && $team->owner == $uid){
            return true;
        }

        return false;
    }
}

if(!function_exists('check_expiration_date')){
    function check_expiration_date($tid=""){
        if($tid==""){
            $uid = get_user('id');
            $team_id = get_team('id');
            $is_admin = get_user("is_admin");
            if(!get_session("team_id") || !get_session("uid")){
                return false;
            }
        }else{
            $team_id=$tid;
            $team = db_get("*", TB_TEAM, "id = '".$team_id."'");
            $uid = $team->owner;
            $is_admin = 0;
        }


        $team = db_get("*", TB_TEAM, "id = '".$team_id."'");
        $user = db_get("is_admin,expiration_date", TB_USERS, " id = '{$team->owner}' ");

        if(empty($user) || empty($team)){
            return false;
        }

        $is_admin = $user->is_admin;

        $expiration_date = $user->expiration_date;

        if($team->owner == $uid){
            if( $expiration_date != 0 && $expiration_date < time() && !$is_admin ){
                return false;
            }
        }else{
            if( $expiration_date != 0 && $user->expiration_date < time() && !$is_admin ){
                return false;
            }
        }

        return true;
    }
}
