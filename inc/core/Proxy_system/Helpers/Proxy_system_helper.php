<?php 
if( ! function_exists('validate_proxy') ){
    function validate_proxy($proxy = ""){
        $ip = "";
        $proxy_parse = explode("@", $proxy);

        if(count($proxy_parse) > 1){
            $ipport = explode(":", $proxy_parse[1]);
            if(count($ipport) == 2){
                $ip = $ipport[0];
            }
        }else{
            $ipport = explode(":", $proxy_parse[0]);
            if(count($ipport) == 2){
                $ip = $ipport[0];
            }
        }

        if($ip == ""){
        	return false;
        }

        return $ip;
    }
}

if( ! function_exists('proxy_location') ){
    function proxy_location($proxy = ""){
    	$ip = validate_proxy($proxy);
        if(!$ip){
        	return false;
        }

        $result = get_curl("http://ip-api.com/json/".$ip);
        $result = json_decode($result);

        if($result->status == 'success'){
            return $result->countryCode;
        }

        return false;
    }
}

if( !function_exists('asign_proxy') ){
    function asign_proxy( $social_network, $category, $login_type = 2){
        $team_id = get_team("id");

        if( permission("proxies") ){
            $result = db_fetch("*", TB_PROXIES, ["status" => 1, "team_id" => $team_id, "is_system" => 0]);
            if ($result) {
                foreach ($result as $key => $value) {
                    $count = db_get("count(*) as count", TB_ACCOUNTS, ["social_network" => $social_network, "category" => $category, "login_type" => $login_type, "status" => 1, "proxy" => $value->id])->count;
                    $result[$key]->count = $count;             
                }

                usort( $result , function($a, $b) {
                    return $a->count <=> $b->count;
                });

                return $result[0];
            }

            $result = db_fetch("*", TB_PROXIES, ["status" => 1, "is_system" => 1]);
            if($result){
                foreach ($result as $key => $value) {
                    $plans = [];
                    if($value->plans){
                        $plans = json_decode($value->plans);
                    }

                    if(empty($plans)){
                        unset($result[$key]);
                    }else{
                        $user_plan = get_user("plan");
                        if( !in_array($user_plan, $plans) ){
                            unset($result[$key]);
                        }else{
                            $count = db_get("count(*) as count", TB_ACCOUNTS, ["social_network" => $social_network, "category" => $category, "login_type" => $login_type, "status" => 1, "proxy" => $value->id])->count;
                            $result[$key]->count = $count;   
                        }
                    }
                }
               
                if(!empty($result)){
                    usort( $result , function($a, $b) {
                        return $a->count <=> $b->count;
                    });

                    return $result[0];
                }        
            }
        }

        return false;

    }
}

if( !function_exists('get_proxy') ){
    function get_proxy( $proxy_id){
        if(is_numeric($proxy_id)){
            $proxy_item = db_get("*", TB_PROXIES, ["id" => $proxy_id, "status" => 1]);
            if($proxy_item){
                return $proxy_item->proxy;
            }else{
                return false;
            }
        }

        if($proxy_id == "") return false;

        return $proxy_id;
    }
}