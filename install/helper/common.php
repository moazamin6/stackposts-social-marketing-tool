<?php
function get_openssl_version_number($patch_as_number=false,$openssl_version_number=null) {
    if (is_null($openssl_version_number)) $openssl_version_number = OPENSSL_VERSION_NUMBER;
    $openssl_numeric_identifier = str_pad((string)dechex($openssl_version_number),8,'0',STR_PAD_LEFT);          

    $openssl_version_parsed = array();
    $preg = '/(?<major>[[:xdigit:]])(?<minor>[[:xdigit:]][[:xdigit:]])(?<fix>[[:xdigit:]][[:xdigit:]])';
    $preg.= '(?<patch>[[:xdigit:]][[:xdigit:]])(?<type>[[:xdigit:]])/';
    preg_match_all($preg, $openssl_numeric_identifier, $openssl_version_parsed);

    $openssl_version = false;
    if (!empty($openssl_version_parsed)) {
        $alphabet = array(1=>'a',2=>'b',3=>'c',4=>'d',5=>'e',6=>'f',7=>'g',8=>'h',9=>'i',10=>'j',11=>'k',12=>'l',13=>'m',
                                      14=>'n',15=>'o',16=>'p',17=>'q',18=>'r',19=>'s',20=>'t',21=>'u',22=>'v',23=>'w',24=>'x',25=>'y',26=>'z');
        $openssl_version = intval($openssl_version_parsed['major'][0]).'.';
        $openssl_version.= intval($openssl_version_parsed['minor'][0]).'.';
        $openssl_version.= intval($openssl_version_parsed['fix'][0]);
        if (!$patch_as_number && array_key_exists(intval($openssl_version_parsed['patch'][0]), $alphabet)) {
            $openssl_version.= $alphabet[intval($openssl_version_parsed['patch'][0])]; // ideal for text comparison
        }
        else {
            $openssl_version.= '.'.intval($openssl_version_parsed['patch'][0]); // ideal for version_compare
        }
    }
    
    return $openssl_version;
}

function ms($array){ 
    print_r(json_encode($array)); exit(0); 
} 

if (!function_exists('post')) {
    function post($name) {
        if( isset( $_POST[$name] ) ){
            return $_POST[$name];
        }

        if( isset( $_GET[$name] ) ){
            return $_GET[$name];
        }
        return false;
    }
}

if (!function_exists('pr')) {
    function pr($data, $type = 0) {
        print '<pre>';
        print_r($data);
        print '</pre>';
        if ($type != 0) {
            exit();
        }
    }
}

if (!function_exists('tz_list')){ 
    function tz_list() { 
        $zones_array = array();
        $timestamp = time(); 
        foreach(timezone_identifiers_list() as $key => $zone) { 
            date_default_timezone_set($zone); 
            $zones_array[$key]['zone'] = $zone; 
            $zones_array[$key]['time'] = '(UTC ' . date('P', $timestamp).") ".$zone; 
            $zones_array[$key]['sort'] = date('P', $timestamp);
        } 

        usort($zones_array, function($a, $b) { 
            return $a['sort'] <=> $b['sort']; 
        }); 
        return $zones_array; 
    } 
}

if(!function_exists("do_decrypt")){
    function do_decrypt($message, $key, $encoded = false)
    {
        if ($encoded) {
            $message = base64_decode($message, true);
            if ($message === false) {
                throw new Exception('Encryption failure');
            }
        }

        $nonceSize = openssl_cipher_iv_length("aes-256-ctr");
        $nonce = mb_substr($message, 0, $nonceSize, '8bit');
        $ciphertext = mb_substr($message, $nonceSize, null, '8bit');

        $plaintext = openssl_decrypt(
            $ciphertext,
            "aes-256-ctr",
            $key,
            OPENSSL_RAW_DATA,
            $nonce
        );

        return $plaintext;
    }
}

if( !function_exists('get_key') ){
    function get_key() {
        return "5d3cd64d5d2f07292d75676b93921497";
    }
}