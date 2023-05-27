<?php 
//Get Settings
if(!function_exists("_gm")){
    function _gm($key, $value = "", $account_id = 0){
        if($account_id != 0){
            $data = db_get("data", TB_ACCOUNTS, ["id" => $account_id])->data;
            try {
                $option = json_decode($data);
            } catch (\Exception $e) {
                $option = [];
            }

            if(is_array($option) || is_object($option)){
                $option = (array)$option;

                if( isset($option[$key]) ){
                    return $option[$key];
                }else{
                    $option[$key] = $value;
                    db_update(TB_ACCOUNTS, ["data" => json_encode($option)], [ "id" => $account_id ] );
                    return $value;
                }
            }else{ 
                $option = json_encode(array($key => $value));
                db_update(TB_ACCOUNTS, ["data" => $option ], [ "id" => $account_id ] );
                return $value;
            }
        }
    }
}

//Update Settings
if(!function_exists("_um")){
    function _um($key, $value, $account_id = 0){
        if($account_id != 0){
            $data = db_get("data", TB_ACCOUNTS, ["id" => $account_id])->data;
            $option = json_decode($data);
            if(is_array($option) || is_object($option)){
                $option = (array)$option;
                if( isset($option[$key]) ){
                    $option[$key] = $value;
                    db_update(TB_ACCOUNTS, [ "data" => json_encode($option) ], [ "id" => $account_id ] );
                    return true;
                }
            }
        }
        return false;
    }
}

if(!function_exists("permission_accounts")){
    function permission_accounts(&$accounts){
        if(!empty($accounts)){
            foreach ($accounts as $key => $value) {
                if( !permission($value->module) ){
                    unset( $accounts[$key] );
                    continue;
                }
            }
        }

        return $accounts;
    }
}

if(!function_exists("check_number_account")){
    function check_number_account($social_network, $category, $team_id = false, $return_message = true){
        if(!$team_id) $team_id = get_team("id");

        $number_accounts = (int)permission("number_accounts", $team_id);
        $plan_type = (int)permission("plan_type", $team_id);
        if($plan_type==1){
            $account_count = db_get("count(*) as count", TB_ACCOUNTS, ["social_network" => $social_network, "category" => $category, "team_id" => $team_id])->count;
        }else{
            $account_count = db_get("count(*) as count", TB_ACCOUNTS, ["team_id" => $team_id])->count;
        }

        if($number_accounts <= $account_count){
            if ($return_message) {
                ms([ "status" => "error", "message" => sprintf(__("You can only add up to %s profiles"), $number_accounts ) ]);
            }else{
                return false;
            }
        }

        if(!$return_message){
            return true;
        }
    }
}