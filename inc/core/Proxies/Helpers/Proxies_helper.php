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