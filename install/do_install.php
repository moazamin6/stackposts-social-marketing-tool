<?php
include "helper/common.php";
$db_host = post("db_host"); 
$db_name = post("db_name"); 
$db_user = post("db_user"); 
$db_pass = post("db_pass"); 
$admin_fullname = post("admin_fullname"); 
$admin_username = post("admin_username"); 
$admin_email = post("admin_email"); 
$admin_pass = post("admin_pass"); 
$admin_timezone = post("admin_timezone"); 
$purchase_code = post("purchase_code"); 
$tmp_path = "../writable/tmp/";

$config_file_path = "../.env"; 
$encryption_key = md5(rand()); 
$config_file = file_get_contents($config_file_path);
$is_installed = strpos($config_file, "sp_config_base_url"); 

$isSecure = false;
if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') {
    $isSecure = true;
}
elseif (!empty($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https' || !empty($_SERVER['HTTP_X_FORWARDED_SSL']) && $_SERVER['HTTP_X_FORWARDED_SSL'] == 'on') {
    $isSecure = true;
}
$REQUEST_PROTOCOL = $isSecure ? 'https' : 'http';

$website = $REQUEST_PROTOCOL . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$website = str_replace("install/do_install.php", "", $website);

$endpoint = "https://stackposts.com/api/install";
$stream_opts = [
    "ssl" => [
        "verify_peer"=>false,
        "verify_peer_name"=>false,
    ]
];

if (!($db_host && $db_name && $db_user && $admin_fullname && $admin_username && $admin_email && $admin_pass && $admin_timezone && $purchase_code)) { 
    ms(array(
        "status" => "error", 
        "message" => "Please input all fields."
    )); 
} 

$params = [
    "purchase_code" => urlencode($purchase_code), 
    "website" => urlencode($website), 
    "is_main" => 1
];

if (filter_var($admin_email, FILTER_VALIDATE_EMAIL) === false) { 
    ms(array(
        "status" => "error", 
        "message" => "Please input a valid email."
    )); 
} 

try {
    $mysqli = @new mysqli($db_host, $db_user, $db_pass, $db_name); 
    if (mysqli_connect_errno()) { 
        ms(array(
            "status" => "error", 
            "message" => "Database error: ".$mysqli->connect_error
        ));
    }   
} catch (Exception $e) {
    ms(array(
        "status" => "error", 
        "message" => "Database error: ".$e->getMessage()
    ));
}

if (!$is_installed) { 
    ms(array(
        "status" => "error", 
        "message" => "Seems this app is already installed! You can't reinstall it again. Make sure you not edit file .env"
    )); 
} 

$result = file_get_contents( $endpoint."?".http_build_query( $params ), false, stream_context_create($stream_opts) );
if(!$result){
    ms([
        "status" => "error",
        "message" => __("There seems to be a problem with your request. Please ensure that your server has enabled sufficient permissions to allow for the installation")
    ]);
}

$result_array = json_decode( $result , 1 );
if( is_array( $result_array ) && isset( $result_array['status'] ) && $result_array['status'] == "error"){
    ms($result);
}

try {
    $result = do_decrypt( $result, get_key(), true );
} catch (\Exception $e) {
    ms([
        "status" => "error",
        "message" => "There was an error during the installation process. Please contact us for prompt assistance"
    ]);
}

$result = json_decode($result);
if( count( (array)$result ) != 7 ){
    ms([
        "status" => "error",
        "message" => "There was an error during the installation process. Please contact us for prompt assistance"
    ]);
}

if (!extension_loaded('zip')) {
    ms([
        "status" => "error",
        "message" => __("Please enable PHP ZIP Extension on your server to can install")
    ]);
}

$status         = $result->status;
$item_id        = $result->item_id;
$license        = $result->license;
$install_path   = "../".$result->path;
$version        = $result->version;
$is_main        = $result->is_main;
$data           = $result->file;
$file           = $tmp_path.uniqid().".temp";
$license_path   = "../writable/license.key";

$fp = @fopen($file, 'w');
@fwrite( $fp, base64_decode( $data ) );
@fclose($fp);

if(!is_file($file) || !is_readable($tmp_path)){
    ms([
        "status" => "error",
        "message" => "Can't read input"
    ]);
}

if(!is_dir($tmp_path) || !is_writable($tmp_path)){
    ms([
        "status" => "error",
        "message" => "Unable to write to the target folder. Please update the folder permission to 775: ".$tmp_path
    ]);
}

//Extract file
$zip = new \ZipArchive;
$response = @$zip->open($file);
$file_count = @$zip->numFiles;
if ($response === FALSE) {
    ms([
        "status" => "error",
        "message" => "There was an error during the installation process. Please contact us for prompt assistance"
    ]);
}

if(!$file_count){
    ms([
        "status" => "error",
        "message" => "There was an error during the installation process. Please contact us for prompt assistance"
    ]);
}
@$zip->extractTo($install_path);
@$zip->close();

if( file_exists( $install_path."database.sql" ) ){
    try {
        $mysqli = @new mysqli($db_host, $db_user, $db_pass, $db_name); 
        $sql = @file_get_contents($install_path."database.sql"); 
        $sql = str_replace('ADMIN_FULLNAME', $admin_fullname, $sql); 
        $sql = str_replace('ADMIN_USERNAME', $admin_username, $sql); 
        $sql = str_replace('ADMIN_EMAIL', $admin_email, $sql); 
        $sql = str_replace('ADMIN_PASSWORD', md5($admin_pass), $sql); 
        $sql = str_replace('ADMIN_TIMEZONE', $admin_timezone, $sql); 
        $sql = str_replace('ADMIN_IDS', uniqid(), $sql); 
        $sql = str_replace('TEAM_IDS', uniqid(), $sql); 
        $mysqli->multi_query($sql); 

        do {} while (mysqli_more_results($mysqli) && mysqli_next_result($mysqli)); $mysqli->close(); 

        $mysqli = @new mysqli($db_host, $db_user, $db_pass, $db_name); 
        $sql = "INSERT INTO sp_purchases (ids, item_id, is_main, purchase_code, version) VALUES ('".uniqid()."', '".$item_id."', '".$is_main."', '".$purchase_code."', '".$version."')"; 
        if ($mysqli->query($sql) !== TRUE) {
            ms(array( 
                "status" => "error", 
                "message" => "Error: " . $sql
            )); 
        } 
        $mysqli->close(); 
    } catch (Exception $e) {
        @unlink($file);
        @unlink($install_path."database.sql");

        ms([
            "status" => "error",
            "message" => "There was an error during the installation process. Please contact us for prompt assistance"
        ]);
    }

    $config_file = str_replace('sp_config_base_url', $website, $config_file); 
    $config_file = str_replace('sp_config_host', $db_host, $config_file); 
    $config_file = str_replace('sp_config_username', $db_user, $config_file); 
    $config_file = str_replace('sp_config_password', $db_pass, $config_file); 
    $config_file = str_replace('sp_config_database', $db_name, $config_file); 
    $config_file = str_replace('sp_config_encryption_key', uniqid(), $config_file); 
    file_put_contents($config_file_path, $config_file);

    $index_file_path = realpath(".././index.php"); 
    $index_file = file_get_contents($index_file_path); 
    $index_file = str_replace('$installation = true;', '$installation = false;', $index_file); 
    file_put_contents($index_file_path, $index_file); 
    file_put_contents($license_path, $license); 
}

//Remove Install
@unlink($file);
@unlink($install_path."database.sql");

ms(array( 
    "status" => "success" 
)); 