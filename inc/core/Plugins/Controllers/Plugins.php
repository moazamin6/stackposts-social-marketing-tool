<?php
namespace Core\Plugins\Controllers;

class Plugins extends \CodeIgniter\Controller
{
    public function __construct(){
        $this->config = parse_config( include realpath( __DIR__."/../Config.php" ) );
        $this->endpoint = "https://stackposts.com/api/";
        $this->stream_opts = [
            "ssl" => [
                "verify_peer"=>false,
                "verify_peer_name"=>false,
            ]
        ]; 
    }
    
    public function index( $page = false ) {
        if( post("error") ){
            $purchase_item = db_get("*", TB_PURCHASES, ["is_main" => 1]);
            if(!empty($purchase_item)){
                $website = base_url();
                $params = [
                    "website" => urlencode( $website ),
                    "purchase_code" => $purchase_item->purchase_code
                ];

                $result = @file_get_contents( $this->endpoint."change?".http_build_query( $params ), false, stream_context_create($this->stream_opts) );
                if($result){
                    $result_array = json_decode( $result , 1 );
                    if( !is_array( $result_array ) ){
                        $license_path = WRITEPATH."license.key";
                        @file_put_contents($license_path, $result); 
                        redirect_to( base_url("dashboard") );
                    }else{
                        if(!post("status")){
                            redirect_to( base_url("plugins?status=error&error=".$result_array['message']) );
                        }
                    }
                }
            }
        }

        $purchases = db_fetch("*", TB_PURCHASES);
        $purchases_arr = [];
        if( !empty( $purchases ) ){
            foreach ($purchases as  $row) {
                $purchases_arr[$row->item_id] = $row->version;
            }
        }

        $params = [
            "purchases" => serialize($purchases_arr),
            "website" => urlencode( base_url() )
        ];

        $products = @file_get_contents($this->endpoint."products?".http_build_query($params), false, stream_context_create($this->stream_opts));

        $data = [
            "title" => $this->config['name'],
            "desc" => $this->config['desc'],
            "content" => view('Core\Plugins\Views\content', ["config" => $this->config, "products" => $products])
        ];

        return view('Core\Plugins\Views\index', $data);
    }

    public function popup_install(){
        $data = [
            'config'  => $this->config
        ];
        return view('Core\Plugins\Views\popup_install', $data);
    }

    public function do_install(){
        $purchase_code = trim( post("purchase_code") );
        $website = base_url();
        $purchase_item = db_get("*", TB_PURCHASES, "purchase_code = '{$purchase_code}'");

        if(!empty($purchase_item)){
            ms([
                "status" => "error",
                "message" => __("This modules or themes is already installed")
            ]);
        }

        $params = [
            "website" => urlencode( $website ),
            "purchase_code" => $purchase_code,
            "is_main" => 0
        ];

        $result = @file_get_contents( $this->endpoint."install?".http_build_query( $params ), false, stream_context_create($this->stream_opts) );
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
                "message" => "There was a problem during installation"
            ]);
        }

        $result = json_decode($result);
        if( count( (array)$result ) != 7 ){
            ms([
                "status" => "error",
                "message" => "There was a problem during installation"
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
        $install_path   = $result->path;
        $version        = $result->version;
        $is_main        = $result->is_main;
        $data           = $result->file;
        $file           = TMPPATH().uniqid().".temp";

        $fp = @fopen($file, 'w');
        @fwrite( $fp, base64_decode( $data ) );
        @fclose($fp);

        if(!is_file($file) || !is_readable(TMPPATH())){
            ms([
                "status" => "error",
                "message" => "Can't read input"
            ]);
        }

        if(!is_dir(TMPPATH()) || !is_writable(TMPPATH())){
            ms([
                "status" => "error",
                "message" => "Unable to write to the target folder. Please update the folder permission to 775: ".TMPPATH()
            ]);
        }

        //Extract file
        $zip = new \ZipArchive;
        $response = @$zip->open($file);
        $file_count = @$zip->numFiles;
        if ($response === FALSE) {
            ms([
                "status" => "error",
                "message" => __("There was a problem during installation")
            ]);
        }

        if(!$file_count){
            ms([
                "status" => "error",
                "message" => __("There was a problem during installation")
            ]);
        }

        @$zip->extractTo($install_path);
        @$zip->close();

        $data = array(
            "ids" => ids(),
            "item_id" => $item_id,
            "purchase_code" => $purchase_code,
            "is_main" => $is_main,
            "version" => $version
        );

        db_insert(TB_PURCHASES , $data);

        get_option("license_".$item_id, $license);
        if( file_exists( $install_path."database.sql" ) ){
            $sql = @file_get_contents($install_path."database.sql", false, stream_context_create($this->stream_opts));
            $sql_querys = explode(';', $sql);
            array_pop($sql_querys);

            foreach($sql_querys as $sql_query){
                $sql_query = $sql_query . ";";
                $db = db_connect();
                $db->query($sql_query);
            }
        }

        //Remove Install
        @unlink($file);
        @unlink($install_path."database.sql");

        ms([
            "status" => "success",
            "message" => __("Success")
        ]);
    }

    public function do_update($item_id = ""){
        $purchase_item = db_get("*", TB_PURCHASES, ["item_id" => $item_id]);
        if( !$purchase_item ){
            ms([
                "status" => "error",
                "message" => __("This product does not exist. Kindly contact us for further assistance")
            ]);
        }

        $params = [
            "website" => urlencode( base_url() ),
            "purchase_code" => $purchase_item->purchase_code
        ];

        $result = @file_get_contents( $this->endpoint."update?".http_build_query( $params ), false, stream_context_create($this->stream_opts) );

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
                "message" => __("There was a problem during installation")
            ]);
        }


        $result = json_decode($result);
        if( count( (array)$result ) != 7 ){
            ms([
                "status" => "error",
                "message" => __("There was a problem during installation")
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
        $install_path   = $result->path;
        $version        = $result->version;
        $is_main        = $result->is_main;
        $data           = $result->file;
        $file           = TMPPATH().uniqid().".temp";
        $license_path   = WRITEPATH."license.key";

        $fp = @fopen($file, 'w');
        @fwrite( $fp, base64_decode( $data ) );
        @fclose($fp);

        if(!is_file($file) || !is_readable(TMPPATH())){
            ms([
                "status" => "error",
                "message" => "Can't read input"
            ]);
        }

        if(!is_dir(TMPPATH()) || !is_writable(TMPPATH())){
            ms([
                "status" => "error",
                "message" => "Unable to write to the target folder. Please update the folder permission to 775: ".TMPPATH()
            ]);
        }

        //Extract file
        $zip = new \ZipArchive;
        $response = @$zip->open($file);
        $file_count = @$zip->numFiles;
        if ($response === FALSE) {
            ms([
                "status" => "error",
                "message" => __("There was a problem during installation")
            ]);
        }

        if(!$file_count){
            ms([
                "status" => "error",
                "message" => __("There was a problem during installation")
            ]);
        }

        @$zip->extractTo($install_path);
        @$zip->close();

        if( $is_main == 1 ){
            @file_put_contents($license_path, $license);
            update_option( "license", get_option("license", $license) );
        }else{
            update_option( "license_".$item_id, get_option("license_".$item_id, $license) );
        }

       if( file_exists( $install_path."database.sql" ) ){
            $sql = @file_get_contents($install_path."database.sql", false, stream_context_create($this->stream_opts));
            $sql_querys = explode(';', $sql);
            array_pop($sql_querys);

            foreach($sql_querys as $sql_query){
                $sql_query = $sql_query . ";";
                $db = db_connect();
                $db->query($sql_query);
            }
        }

        //Remove Install
        @unlink($file);
        @unlink($install_path."database.sql");

        db_update(TB_PURCHASES , ["version" => $version], [ "id" => $purchase_item->id ]);

        ms(array(
            "status" => "success",
            "message" => __("Success")
        ));
    }
}