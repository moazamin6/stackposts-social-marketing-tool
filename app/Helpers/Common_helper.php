<?php
if( ! function_exists('_e') ){
    function _e($text = '', $strip_tags = true){
        if($strip_tags){
            $text = __($text);

            if(DEMO){
                if( filter_var($text, FILTER_VALIDATE_EMAIL) ){
                    echo hideEmailAddress($text);
                }else{
                    if($text != ""){
                        echo strip_tags($text);
                    }else{
                        echo $text;
                    }
                }
            }else{
                if($text != ""){
                    echo strip_tags($text);
                }else{
                    echo $text;
                }
            }
        }else{
            echo __($text);
        }
    }
}

if( ! function_exists('_ec') ){
    function _ec($text = '', $strip_tags = true){
        if(DEMO){
            if( filter_var($text, FILTER_VALIDATE_EMAIL) ){
                echo hideEmailAddress($text);
            }else{
                echo $text;
            }
        }else{
            echo $text;
        }
    }
}

function hideEmailAddress($email){
    if(filter_var($email, FILTER_VALIDATE_EMAIL))
    {
        list($first, $last) = explode('@', $email);
        $first = str_replace(substr($first, '3'), str_repeat('*', strlen($first)-3), $first);
        $last = explode('.', $last);
        $last_domain = str_replace(substr($last['0'], '1'), str_repeat('*', strlen($last['0'])-1), $last['0']);
        $hideEmailAddress = $first.'@'.$last_domain.'.'.$last['1'];
        return $hideEmailAddress;
    }
}

if ( ! function_exists('pr') ) {
    function pr($data, $type = 0) {
        print '<pre>';
        print_r($data);
        print '</pre>';
        if ($type != 0) {
            exit();
        }
    }
}

if( ! function_exists('ms') ){
    function ms($array){
        print_r(json_encode($array));
        exit(0);
    }
}

if (!function_exists('is_ajax')) {
    function is_ajax(){
        $request = \Config\Services::request();
        return $request->isAJAX();
    };
}

if (!function_exists('ids')) {
    function ids(){
        return uniqid();
    };
}

if (!function_exists('add_prefix_numer')) {
    function add_prefix_numer($num){
        return ((float) $num>0)?'+'.$num:$num;
    }
}

if (!function_exists('add_prefix_numer')) {
    function array_subtract(array $input) {
        $result = reset($input);
        foreach (array_slice($input, 1) as $value) {
            $result -= $value;
        }
        return $result;
    }
}

/*if (!function_exists('short_number')) {
    function short_number($number) {
        if ($number >= 1000000000) {
            return round($number/1000000000, 1).'B';
        } elseif ($number >= 1000000) {
            return round($number/1000000, 1).'M';
        } elseif ($number >= 1000) {
            return round($number/1000, 1).'K';
        } else {
            return $number;
        }
    }
}*/

if (!function_exists('custom_number_format')) {
    function custom_number_format($number, $decimal = '.')
    {
        $broken_number = explode($decimal, $number);
        if (isset($broken_number[1]))
            return number_format((float)$broken_number[0]) . $decimal . (float)$broken_number[1];
        else
            return number_format((float)$broken_number[0]);
    }
}

if (!function_exists('short_number')) {
    function short_number($n){
        if ($n < 1000000) {
            // Anything less than a million
            $n_format = number_format($n);
        } else if ($n < 1000000000) {
            // Anything less than a billion
            $n_format = number_format($n / 1000000, 3) . 'M';
        } else {
            // At least a billion
            $n_format = number_format($n / 1000000000, 3) . 'B';
        }

        return $n_format;
    }
}

function generate_numbers($start, $count, $digits) {
   $result = array();
   for ($n = $start; $n < $start + $count; $n++) {
 
      $result[] = str_pad($n, $digits, "0", STR_PAD_LEFT);
 
   }
   return $result;
}

if( !function_exists('slugify') ){
    function slugify($text)
    {
        $text = preg_replace('~[^\pL\d]+~u', '-', $text);
        $text = @iconv('utf-8', 'us-ascii//TRANSLIT', $text);
        $text = preg_replace('~[^-\w]+~', '', $text);
        $text = trim($text, '-');
        $text = preg_replace('~-+~', '-', $text);
        $text = strtolower($text);

        if (empty($text)) {
            return 'n-a';
        }

        return $text;
    }
}

if(!function_exists('isValidTelephoneNumber')){
    function isValidTelephoneNumber(string $telephone, int $minDigits = 9, int $maxDigits = 14): bool {
        if (preg_match('/^[+][0-9]/', $telephone)) { //is the first character + followed by a digit
            $count = 1;
            $telephone = str_replace(['+'], '', $telephone, $count); //remove +
        }
        
        //remove white space, dots, hyphens and brackets
        $telephone = str_replace([' ', '.', '-', '(', ')'], '', $telephone); 

        //are we left with digits only?
        return isDigits($telephone, $minDigits, $maxDigits); 
    }
}

if(!function_exists('isDigits')){
    function isDigits(string $s, int $minDigits = 9, int $maxDigits = 14): bool {
        return preg_match('/^[0-9]{'.$minDigits.','.$maxDigits.'}\z/', $s);
    }
}

if (!function_exists('utf8ize')) {
    function utf8ize($d) {
        if (is_array($d)) {
            foreach ($d as $k => $v) {
                $d[$k] = utf8ize($v);
            }
        } else if (is_string ($d)) {
            return utf8_encode($d);
        }
        return $d;
    }
}

if(!function_exists('add_script_to_header')){
    function add_script_to_header(){
        $items = get_blocks("add_script_to_header", false);
        if(!empty($items)){
            foreach ($items as $key => $value) {
                _ec( $value['data'] );
            }
        }
    }
}

if(!function_exists('add_script_to_footer')){
    function add_script_to_footer(){
        $items = get_blocks("add_script_to_footer", false);

        if(!empty($items)){
            foreach ($items as $key => $value) {
                _ec( $value['data'] );
            }
        }
    }
}

if (!function_exists('spintax')) {
    function spintax($str) {
        return preg_replace_callback("/{(.*?)}/", function ($match) {
            $words = explode("|", $match[1]);
            return $words[array_rand($words)];
        }, $str);
    }
}

if ( ! function_exists('get_link_info')){
    function get_link_info($url)
    {   

        $info = array(
            'title' => "",
            'description' => "",
            'image' => "",
            'host' => ""
        );

        $parse_url = @parse_url($url);
        if(isset($parse_url["host"])){
            $info['host'] = $parse_url["host"];
        }

        $youtube_reg = "/(youtube.com|youtu.be)\/(watch)?(\?v=)?(\S+)?/";
        if(preg_match($youtube_reg, $url, $match)){
            $result = get_curl("https://www.youtube.com/oembed?url=".$url."&format=json");
            $result = json_decode($result);
            if(!empty($result)){

                if(isset($result->title))
                    $info['title'] = $result->title;

                if(isset($result->thumbnail_url))
                    $info['image'] = $result->thumbnail_url;
            }
            
            return $info;
        }
        
        $result = get_curl($url);

        if($result != ""){
            $doc = new DOMDocument();
            @$doc->loadHTML(mb_convert_encoding($result, 'HTML-ENTITIES', 'UTF-8'));
            $title = $doc->getElementsByTagName('title');
            $metas = $doc->getElementsByTagName('meta');

            $info["title"] = isset($title->item(0)->nodeValue) ? $title->item(0)->nodeValue : "";

            for ($i = 0; $i < $metas->length; $i++){
                $meta = $metas->item($i);
                
                if($info['description'] == ""){
                    if(strtolower($meta->getAttribute('name')) == 'description'){
                        $info['description'] = $meta->getAttribute('content');
                    }
                }
                if($info['image'] == ""){
                    if($meta->getAttribute('property') == 'og:image'){
                        $info['image'] = $meta->getAttribute('content');
                    }
                }
            }

            if($info['description'] == ""){
                for ($i = 0; $i < $metas->length; $i++){
                    $meta = $metas->item($i);
                    if(strtolower($meta->getAttribute('property')) == 'og:description'){
                        $info['description'] = $meta->getAttribute('content');
                    }
                }
            }

            if($info['description'] == ""){
                for ($i = 0; $i < $metas->length; $i++){
                    $meta = $metas->item($i);
                    $body = $doc->getElementsByTagName('body');
                    $text = strip_tags($body->item(0)->nodeValue);
                    $dots = "";
                    if(strlen(utf8_decode($text))>250) $dots = "...";
                    $text = mb_substr(stripslashes($text),0,250, 'utf-8');
                    $info['description'] = $text.$dots;
                }
            }
        }


        return $info;
    }
}

if(!function_exists("get_curl")){
    function get_curl($url){
        $user_agent='Mozilla/5.0 (iPhone; U; CPU like Mac OS X; en) AppleWebKit/420.1 (KHTML, like Gecko) Version/3.0 Mobile/3B48b Safari/419.3';

        $headers = array
        (
            'Accept:text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8',
            'Accept-Language: en-US,fr;q=0.8;q=0.6,en;q=0.4,ar;q=0.2',
            'Accept-Encoding: gzip,deflate',
            'Accept-Charset: utf-8;q=0.7,*;q=0.7',
            'cookie:datr=; locale=en_US; sb=; pl=n; lu=gA; c_user=; xs=; act=; presence='
        ); 

        $ch = curl_init( $url );

        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST , "GET");
        curl_setopt($ch, CURLOPT_POST, false);     
        curl_setopt($ch, CURLOPT_USERAGENT, $user_agent);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_ENCODING, "");
        curl_setopt($ch, CURLOPT_AUTOREFERER, true);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 60);
        curl_setopt($ch, CURLOPT_TIMEOUT, 60);
        curl_setopt($ch, CURLOPT_MAXREDIRS, 10);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_REFERER, base_url());

        $result = curl_exec( $ch );
       
        curl_close( $ch );

        return $result;
    }
}

if(!function_exists('now')){
    function now(){
        return date("Y-m-d H:i:s");
    }
}

if(!function_exists("get_avatar")){
    function get_avatar($text, $color = "009ef7"){

        if($color == "random" || $color == "rand"){
            $colors = [
                "E74645",
                "FB7756",
                "FACD60",
                "12492F",
                "F7A400",
                "58B368"
            ];

            $rand_key = array_rand($colors, 1);
            $color = $colors[$rand_key];
        }

        $text = str_replace("&", "", $text);
        $text = str_replace("&amp;", "", $text);
        $text = str_replace("=", "", $text);
        $text = str_replace("&quot", "", $text);
        $text = str_replace("\"", "", $text);
        $text = str_replace("'", "", $text);
        $text = str_replace("~", "", $text);
        $text = str_replace(" ", "", $text);
        return "https://ui-avatars.com/api/?name=".urldecode($text)."&background=".$color."&color=fff&font-size=0.5&rounded=false&format=png";
    }
}

if( ! function_exists("redirect_to") ){
    function redirect_to( $path = "", $back = false ){

        if($back){
            $path = $path."?redirect=".current_url();
        }

        header("Location: ".$path );
        die();
    }
}

if( ! function_exists("redirect_to_404") ){
    function redirect_to_404( $path = "" ){
        header("Location: ".base_url("page_not_found") );
        die();
    }
}

if( ! function_exists("get_theme_url") ){
    function get_theme_url( $path = "" ){
        return base_url("inc/themes/backend/Stackmin/" . $path). "/";
    }
}

if( ! function_exists("get_theme_path") ){
    function get_theme_path( $path = "" ){
        return FCPATH."inc/themes/backend/Stackmin/" . $path;
    }
}

if( ! function_exists("get_frontend_url") ){
    function get_frontend_url( $path = "" ){
        $frontend_template = get_option("frontend_template", "Stackgo");
        return base_url("inc/themes/frontend/".$frontend_template."/" . $path). "/";
    }
}

if( ! function_exists("get_frontend_dir") ){
    function get_frontend_dir( $path = "" ){
        return base_url("inc/themes/frontend/" . $path). "/";
    }
}

if( ! function_exists("get_module_url") ){
    function get_module_url( $path = "" ){
        return base_url( uri('segment', 1) . "/" . $path );
    }
}

if( ! function_exists("get_module_path") ){
    function get_module_path( $dir, $path = "", $back = "/../" ){
        $dir = realpath( $dir . $back );
        $dir = str_replace(FCPATH, "", $dir);
        $dir = str_replace("\\", "/", $dir);
        return base_url( $dir . "/" . $path );
    }
}

if( ! function_exists("get_module_dir") ){
    function get_module_dir( $dir, $path = "", $back = "/../" ){
        $dir = realpath( $dir . $back );
        $dir = str_replace(FCPATH, "", $dir);
        $dir = str_replace("\\", "/", $dir);
        return $dir."/".$path;
    }
}

if( ! function_exists("TMPPATH") ){
    function TMPPATH( $path = ""){
        create_folder(WRITEPATH."tmp/");
        return str_replace("//", "/", WRITEPATH."tmp/".$path);
    }
}

if( !function_exists('get_tmp_url') ){
    function get_tmp_url( $file ){
        $file = str_replace(TMPPATH(), "", $file);
        return base_url( "writable/tmp/".$file );
    }
}

if( ! function_exists("uri") ){
    function uri( $type , $value = "" ){
        $uri = service('uri');

        $data = false;
        
        switch ($type) {
            case 'segment':
                try {
                    $data = $uri->getSegment($value);
                } catch (Exception $e) {}
                break;
        }
        return $data;
    }
}

if( ! function_exists('get_module_paths') ){
    function get_module_paths(){
        $configs = array();
        $folders = array(
            ROOTPATH . 'inc/plugins/',
            ROOTPATH . 'inc/core/',
            ROOTPATH . 'inc/themes/backend/',
            ROOTPATH . 'inc/themes/frontend/',
        );

        $module_paths = array();

        foreach ( $folders as $folder )
        {
            $directories = glob( $folder . '*' );

            if ( !empty( $directories ) )
            {
                foreach ( $directories as $directory )
                {
                    if( file_exists( $directory . "/Config.php" ) ){
                        $module_paths[] = $directory;
                    }
                }
            }
        }

        return $module_paths;
    }
}

if( ! function_exists('get_class_name') ){
    function get_class_name($class){
        $class = get_class( $class );
        $class = explode("\\", $class );
        return end( $class );
    }
}

if(!function_exists('find_modules')){
    function find_modules($module_name){

        $module_paths = get_module_paths();
        if(!empty($module_paths))
        {
            foreach ($module_paths as $module_path) 
            {

                $config = $module_path.'/Config.php';
                if( !file_exists($config) ){
                    return false;
                }
                $config = include $config;

                if(isset($config['menu']) && isset($config['menu']["sub_menu"]) && isset($config['menu']["sub_menu"]["id"]) ){
                    if($config['menu']["sub_menu"]["id"] == $module_name)
                    {
                        return $config;
                    }
                }else{
                    if( !isset($config["id"]) ){
                        return false;
                    }

                    if($config["id"] == $module_name)
                    {
                        return $config;
                    }
                }

            }
        }

        return false;
    }
}


if(!function_exists('get_blocks')){
    function get_blocks( $block_name, $get_all = true, $check_permissions = false ){
        $module_paths = get_module_paths();
        $list_items = [];
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
                            $model_content = get_all_functions($model_file);
                            if ( in_array($block_name, $model_content) )
                            {   
                                include_once $model_file;
                                
                                $class = str_replace(COREPATH, "\\", $model_file);
                                $class = str_replace(".php", "", $class);
                                $class = str_replace("/", "\\", $class);
                                $class = ucfirst($class);
                                $data = new $class;

                                $name = explode("\\", $class);
                                $config_item["data"] = $data->$block_name();
                                
                                if(!$get_all){
                                    if(!$check_permissions || ( $check_permissions && permission($config_item['id']) ) )
                                        $list_items[] = $config_item;
                                }
                            }
                        }
                    }

                    if($get_all){
                        if(!$check_permissions || ( $check_permissions && permission($config_item['id']) ) )
                            $list_items[] = $config_item;
                    }
                }
            }
        }

        return $list_items;
    }
}

function get_all_functions($file) {
    $data = file_get_contents($file);   
    $data = preg_replace("/<script[^>]*>[\s\S]*?<\/script>/", "", $data);
    preg_match_all("/function[\s\n]+(\S+)[\s\n]*\(/", $data, $outputData);

    return $outputData[1];
}

if (!function_exists('run_class')) {
    function run_class($file){
        $classes = get_declared_classes();
        $get_class = str_replace(ROOTPATH."inc/","",$file);
        $get_class = str_replace(".php","",$get_class);
        $get_class = str_replace("/","\\",$get_class);
        $get_class = ucfirst($get_class);

        if( in_array($get_class, $classes) ){
            $class = $get_class;
        }else{
            include $file;
            $class = end($classes);
        }

        return new $class;
    };
}

if (!function_exists('password')) {
    function password($text){
        return md5( $text );
    };
}

if (!function_exists('encrypt_encode')) {
    function encrypt_encode($plainText){
        $encrypter = \Config\Services::encrypter();
        return base64_encode($encrypter->encrypt($plainText));
    };
}

if (!function_exists('encrypt_decode')) {
    function encrypt_decode($ciphertext){
        $ciphertext = base64_decode($ciphertext);
        $encrypter = \Config\Services::encrypter();
        return $encrypter->decrypt($ciphertext);
    };
}

if (!function_exists('getDirContents')) {
    function getDirContents($dir, &$results = array()) {
        $files = scandir($dir);

        foreach ($files as $key => $value) {
            $path = realpath($dir . DIRECTORY_SEPARATOR . $value);
            if (!is_dir($path)) {
                $results[] = $path;
            } else if ($value != "." && $value != "..") {
                if ( stripos($path, "\Controllers") || stripos($path, "\Views") || stripos($path, "\Models") || stripos($path, "\Helpers") ) {
                    getDirContents($path, $results);
                }
                $results[] = $path;
            }
        }

        return $results;
    }
}

if(!function_exists('post')){
    function post($name, $filters = null, $flags = null){
        $request = \Config\Services::request();
        return $request->getPostGet($name, $filters, $flags);
    }
}

if(!function_exists('get')){
    function get($name, $filters = null, $flags = null){
        $request = \Config\Services::request();
        return $request->getPostGet($name, $filters, $flags);
    }
}

if(!function_exists('request_service')){
    function request_service($name){
        $request = \Config\Services::request();
        return $request->$name;
    }
}

if(!function_exists('date_short')){
    function date_short($data){
        if($data != ""){
            if(!is_numeric($data)){
                $data = strtotime($data);
            }
            return date("M j", $data);
        }else{
            return false;
        }
    }
}


if(!function_exists('date_sql')){
    function date_sql($data){
        if($data != ""){
            $format = get_option('format_date', 'd/m/Y');
            switch ($format) {
                case 'd/m/Y':
                    $data = str_replace("/", "-", $data);
                    break;
            }
            return date("Y-m-d", strtotime($data));
        }else{
            return false;
        }
    }
}

if(!function_exists('datetime_sql')){
    function datetime_sql($data){
        if($data != ""){
            $format = get_option('format_datetime', 'd/m/Y g:i A');
            switch ($format) {
                case 'd/m/Y H:i':
                    $data = str_replace("/", "-", $data);
                    break;

                case 'd/m/Y g:i A':
                    $data = str_replace("/", "-", $data);
                    break;
            }
            return date("Y-m-d H:i:s", strtotime($data));
        }else{
            return false;
        }
    }
}

if(!function_exists('timestamp_sql')){
    function timestamp_sql($data){
        if($data != ""){
            $format = get_option('format_datetime', 'd/m/Y g:i A');
            switch ($format) {
                case 'd/m/Y H:i':
                    $data = str_replace("/", "-", $data);
                    break;

                case 'd/m/Y g:i A':
                    $data = str_replace("/", "-", $data);
                    break;
            }
            return strtotime($data);
        }else{
            return false;
        }
    }
}

if(!function_exists('date_show')){
    function date_show($data){
        if($data != ""){
            if(!is_numeric($data)){
                $data = strtotime($data);
            }

            if( get_option('format_date', 'd/m/Y') == 'd/m/Y' ){
                return date( "d-m-Y" , $data);
            }else{
                return date( get_option('format_date', 'd/m/Y') , $data);
            }
        }else{
            return false;
        }
    }
}

if(!function_exists('datetime_show')){
    function datetime_show($data){
        if($data != ""){
            if(!is_numeric($data)){
                $data = strtotime($data);
            }

            return date( get_option('format_datetime', 'd/m/Y g:i A') , $data);
        }else{
            return false;
        }
    }
}

if(!function_exists('date_show_js')){
    function date_show_js(){
        $format = get_option('format_date', 'd/m/Y');

        switch ($format) {
            case 'd/m/Y':
                return "dd/mm/yy";
                break;

            case 'd M, Y':
                return "d M, yy";
                break;

            case 'm/d/Y':
                return "mm/dd/yy";
                break;

            case 'Y-m-d':
                return "yy-mm-dd";
                break;
            
            default:
                return "dd/mm/yy";
                break;
        }
    }
}

if(!function_exists('datetime_show_js')){
    function datetime_show_js(){
        $format = get_option('format_datetime', 'd/m/Y g:i A');

        switch ($format) {
            case "d/m/Y g:i A":
                return '["dd/mm/yy", "hh:mm TT"]';
                break;

            case "m/d/Y g:i A":
                return '["mm/dd/yy", "hh:mm TT"]';
                break;

            case "d/m/Y H:i":
                return '["dd/mm/yy", "HH:mm"]';
                break;

            case "m/d/Y H:i":
                return '["mm/dd/yy", "HH:mm"]';
                break;

            case "Y-m-d g:i A":
                return '["yy-mm-dd", "hh:mm TT"]';
                break;

            case "Y-m-d H:i":
                return '["yy-mm-dd", "HH:mm"]';
                break;
            
            default:
                return '["dd/mm/yy", "hh:mm TT"]';
                break;
        }
    }
}

if (!function_exists('time_elapsed_string')) {
    function time_elapsed_string($datetime, $full = false) {
        if(!is_numeric($datetime)){
            $datetime = strtotime($datetime);
        }
        
        $datetime =  date( 'Y-m-d g:i A' , $datetime);

        $now = new DateTime;
        $ago = new DateTime($datetime);
        $diff = $now->diff($ago);

        $diff->w = floor($diff->d / 7);
        $diff->d -= $diff->w * 7;

        $string = array(
            'y' => __('%s year%s ago'),
            'm' => __('%s month%s  ago'),
            'w' => __('%s week%s  ago'),
            'd' => __('%s day%s  ago'),
            'h' => __('%s hour%s  ago'),
            'i' => __('%s minute%s  ago'),
            's' => __('%s second%s  ago'),
        );
        foreach ($string as $k => &$v) {
            if ($diff->$k) {
                $v = sprintf( $v , $diff->$k, ($diff->$k > 1 ? 's' : '') );
            } else {
                unset($string[$k]);
            }
        }

        if (!$full) $string = array_slice($string, 0, 1);
        return $string ? implode(', ', $string) : __('Just now');
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
            return strcmp($a["sort"], $b["sort"]);
        });
        
        $timezones = array();
        foreach ($zones_array as $value) {
            $timezones[$value['zone']] = $value['time'];
        }

        return $timezones;
    }
}

if (!function_exists('tz_list_number')){
    function tz_list_number($timezone) {
        $zones_array = array();
        $timestamp = time();
        foreach(timezone_identifiers_list() as $key => $zone) {
            date_default_timezone_set($zone);
            $zones_array[$key]['zone'] = $zone;
            $zones_array[$key]['time'] = '(UTC ' . date('P', $timestamp).") ".$zone;
            $zones_array[$key]['sort'] = date('P', $timestamp);
        }

        usort($zones_array, function($a, $b) {
            return strcmp($a["sort"], $b["sort"]);
        });
        
        $timezones = array();
        foreach ($zones_array as $value) {
            $timezones[$value['zone']] = $value['sort'];
        }

        return $timezones[$timezone];
    }
}

if(!function_exists("translate_code_list")){
    function translate_code_list(){
        $list = [
            "af" => "Afrikaans",
            "sq" => "Albanian",
            "ar" => "Arabic",
            "hy" => "Armenian",
            "az" => "Azerbaijani",
            "eu" => "Basque",
            "be" => "Belarusian",
            "bg" => "Bulgarian",
            "ca" => "Catalan",
            "zh-CN" => "Chinese (Simplified)",
            "zh-TW" => "Chinese (Traditional)",
            "hr" => "Croatian",
            "cs" => "Czech",
            "da" => "Danish",
            "nl" => "Dutch",
            "en" => "English",
            "et" => "Estonian",
            "tl" => "Filipino",
            "fi" => "Finnish",
            "fr" => "French",
            "gl" => "Galician",
            "ka" => "Georgian",
            "de" => "German",
            "el" => "Greek",
            "ht" => "Haitian Creole",
            "iw" => "Hebrew",
            "hi" => "Hindi",
            "hu" => "Hungarian",
            "is" => "Icelandic",
            "id" => "Indonesian",
            "ga" => "Irish",
            "it" => "Italian",
            "ja" => "Japanese",
            "ko" => "Korean",
            "lv" => "Latvian",
            "lt" => "Lithuanian",
            "mk" => "Macedonian",
            "ms" => "Malay",
            "mt" => "Maltese",
            "no" => "Norwegian",
            "fa" => "Persian",
            "pl" => "Polish",
            "pt" => "Portuguese",
            "ro" => "Romanian",
            "ru" => "Russian",
            "sr" => "Serbian",
            "sk" => "Slovak",
            "sl" => "Slovenian",
            "es" => "Spanish",
            "sw" => "Swahili",
            "sv" => "Swedish",
            "th" => "Thai",
            "tr" => "Turkish",
            "uk" => "Ukrainian",
            "ur" => "Urdu",
            "vi" => "Vietnamese",
            "cy" => "Welsh",
            "yi" => "Yiddish",
        ];

        return $list;
    }
}

if (!function_exists('gd')) {
    function gd($data, $field, $type = '', $value = '', $class = 'active'){
        if( is_array($data) ){
            if(!empty($data) && isset($data[$field]) ){
                switch ($type) {
                    case 'checkbox':
                        if($data[$field] == $value){
                            return 'checked';
                        }
                        break;

                    case 'radio':
                        if($data[$field] == $value){
                            return 'checked';
                        }
                        break;

                    case 'select':
                        if($data[$field] == $value){
                            return 'selected';
                        }
                        break;

                    case 'class':
                        if($data[$field] == $value){
                            return $class;
                        }
                        break;

                    default:
                        return $data[$field];
                        break;
                }
            }
        }else{
            if(!empty($data) && isset($data->$field) ){
                switch ($type) {
                    case 'checkbox':
                        if($data->$field == $value){
                            return 'checked';
                        }
                        break;

                    case 'radio':
                        if($data->$field == $value){
                            return 'checked';
                        }
                        break;

                    case 'select':
                        if($data->$field == $value){
                            return 'selected';
                        }
                        break;

                    case 'class':
                        if($data->$field == $value){
                            return $class;
                        }
                        break;

                    default:
                        return $data->$field;
                        break;
                }
            }
        }

        return false;
    };
}

/*Validate*/
if(!function_exists("validate")){
    function validate($type, $message, $data, $value = "", $status = "error"){
        $error = false;

        switch ($type) {
            case 'empty':
                if( empty( $data ) ){
                    ms([
                        "status" => $status,
                        "message" => $message
                    ]);
                }
                break;

            case 'not_empty':
                if( ! empty( $data ) ){
                    ms([
                        "status" => $status,
                        "message" => $message
                    ]);
                }
                break;

            case 'equal':
                if( $data == $value){
                    ms([
                        "status" => $status,
                        "message" => $message
                    ]);
                }
                break;

            case 'other':
                if( $data != $value){
                    ms([
                        "status" => $status,
                        "message" => $message
                    ]);
                }
                break;

            case 'min_number':
                if(  $data < $value ){
                    ms([
                        "status" => $status,
                        "message" => sprintf(__('%s must be greater than or equal to %d'), $message, $value)
                    ]);
                }
                break;

            case 'max_number':
                if( $data > $value ){
                    ms([
                        "status" => $status,
                        "message" => sprintf(__('%s must be less than or equal to %d'), $message, $value)
                    ]);
                }
                break;

            case 'min_length':
                if( strlen($data) < $value ){
                    ms([
                        "status" => $status,
                        "message" => sprintf(__('%s must be greater than or equal to %d characters'), $message, $value)
                    ]);
                }
                break;

            case 'max_length':
                if( strlen($data) > $value ){
                    ms([
                        "status" => $status,
                        "message" => sprintf(__('%s must be less than or equal to %d characters'), $message, $value)
                    ]);
                }
                break;

            case 'compare':
                if( $data != $value ){
                    ms([
                        "status" => $status,
                        "message" => $message
                    ]);
                }
                break;

            case 'email':
                if( !filter_var($data, FILTER_VALIDATE_EMAIL) ){
                    ms([
                        "status" => $status,
                        "message" => __('Email address is not valid')
                    ]);
                }
                break;

            case 'link':
                if( !filter_var($data, FILTER_VALIDATE_URL) ){
                    ms([
                        "status" => $status,
                        "message" => __('The url is not valid')
                    ]);
                }
                break;

            case 'not_is_string':
                if( !is_string( $data ) ){
                    ms([
                        "status" => $status,
                        "message" => sprintf(__('%s must be an string'), $message)
                    ]);
                }
                break;

            case 'not_is_array':
                if( !is_array( $data ) ){
                    ms([
                        "status" => $status,
                        "message" => sprintf(__('%s must be an array'), $message)
                    ]);
                }
                break;

            case 'not_is_object':
                if( !is_object( $data ) ){
                    ms([
                        "status" => $status,
                        "message" => sprintf(__('%s must be an object'), $message)
                    ]);
                }
                break;

            case 'is_string':
                if( is_string( $data ) ){
                    ms([
                        "status" => $status,
                        "message" => sprintf(__('%s must not be an string'), $message)
                    ]);
                }
                break;

            case 'is_array':
                if( is_array( $data ) ){
                    ms([
                        "status" => $status,
                        "message" => sprintf(__('%s must not be an array'), $message)
                    ]);
                }
                break;

            case 'is_object':
                if( is_object( $data ) ){
                    ms([
                        "status" => $status,
                        "message" => sprintf(__('%s must not be an object'), $message)
                    ]);
                }
                break;
            
            default:
                if($data != NULL || is_numeric($data)){
                }else{
                    ms([
                        "status" => $status,
                        "message" => sprintf(__('%s is required'), $message)
                    ]);
                }
                break;
        }
    }
}

if( ! function_exists("get_option") ){
    function get_option($key, $value = ""){
        $option = db_get("value", "sp_options", "name = '".$key."'");
        if(empty($option)){
            db_insert("sp_options", [ "name" => $key, "value" => $value ] );
            return $value;
        }else{
            return $option->value;
        }
    }
}

if( ! function_exists("update_option") ){
    function update_option($key, $value){
        $option = db_get("value", "sp_options", "name = '".$key."'");
        if(empty($option)){
            db_insert( "sp_options", [ "name" => $key, "value" => $value ] );
        }else{
            db_update( "sp_options", [ "value" => $value ], [ "name" => $key ] );
        }
    }
}

if( ! function_exists("db_fetch") ){
    function db_fetch($select = "*", $table = "", $wheres = false, $order = "", $by = "DESC", $start = -1, $limit = 0, $return_array = false)
    {

        $db = \Config\Database::connect();
        $builder = $db->table($table);

        $builder->select($select);
        if( $wheres &&  is_string($wheres) ){
            $builder->where($wheres);
        }

        if( $wheres && is_array($wheres) && ! empty($wheres) ){
            foreach ($wheres as $key => $value) {
                $builder->where($key, $value);
            }
        }
        if($order != "" && (strtolower($by) == "desc" || strtolower($by) == "asc"))
        {
            if($order == 'rand'){
                $builder->orderBy('rand()');
            }else{
                $builder->orderBy($order, $by);
            }
        }
        
        if((int)$start >= 0 && (int)$limit > 0)
        {
            $builder->limit($limit, $start);
        }
        #Query
        $query = $builder->get();
        if($return_array){
            $result = $query->getResultArray();
        } else {
            $result = $query->getResult();
        }
        $query->freeResult();
        return $result;
    }   
}

if( ! function_exists("db_get") ){
    function db_get($select = "*", $table = "", $wheres = false, $order = "", $by = "DESC", $return_array = false)
    {
        $db = \Config\Database::connect();
        $builder = $db->table($table);
        $builder->select($select);
        if( $wheres &&  is_string($wheres) ){
            $builder->where($wheres);
        }
        if( $wheres && is_array($wheres) && ! empty($wheres) ){
            foreach ($wheres as $key => $value) {
                $builder->where($key, $value);
            }
        }
        if($order != "" && (strtolower($by) == "desc" || strtolower($by) == "asc"))
        {
            if($order == 'rand'){
                $builder->orderBy('rand()');
            }else{
                $builder->orderBy($order, $by);
            }
        }
        #Query
        $query = $builder->get();
        if($return_array){
            $result = $query->getRowArray();
        } else {
            $result = $query->getRow();
        }
        $query->freeResult();

        return $result;
    }
}

if( ! function_exists("db_insert") ){
    function db_insert($table = "", $data = [])
    {
        $data = (array)$data;
        if( !empty($data) ){
            $db = \Config\Database::connect();
            $builder = $db->table($table);

            if( isset($data[0]) && is_array($data[0]) ){
                $data = $data;
            }else{
                $data = [$data];
            }

            $builder->insertBatch($data);
            return $db->insertID();
        }else{
            return false;
        }
    }
}

if( ! function_exists("db_update") ){
    function db_update($table = "", $data = [], $wheres = [])
    {
        $data = (array)$data;
        $db = \Config\Database::connect();
        $builder = $db->table($table);

        if( ! empty($wheres) ){
            foreach ($wheres as $key => $value) {
                $builder->where($key, $value);
            }
        }
        
        $builder->update($data);
        return true;
    }
}

if( ! function_exists("db_delete") ){
    function db_delete($table = "", $wheres = [])
    {
        $db = \Config\Database::connect();
        $builder = $db->table($table);

        if( ! empty($wheres) ){
            foreach ($wheres as $key => $value) {
                $builder->where($key, $value);
            }
        }
        $builder->delete();
        return true;
    }
}
 
if(!function_exists('load_files')){
    function load_files($type){
        $configs = array();

        foreach(glob(FCPATH.'inc/*') as $folders) {
            foreach(glob($folders."/*") as $directory) {
                $config_file = $directory.'/Config.php';
                if ( file_exists( $config_file ) )
                {
                    $config = include $config_file;
                    $config['path'] = $directory."/";
                    $config['url'] = base_url( str_replace(FCPATH, "", $directory) )."/";
                    $configs[] = $config;
                }
            }
        }

        if( !empty($configs) ){
            foreach ( $configs as $key => $config ) {
                if ( isset( $config[$type] ) && !empty( $config[$type] ) )
                {   
                    foreach ( $config[$type] as $file ) 
                    {
                        
                        if (stripos($file, "https://") === false && stripos($file, "http://") === false) {
                            $url = $config["url"].$file;
                        }else{
                            $url = $file;
                        }

                        if($type == "css"){
                            echo "<link rel='stylesheet' type='text/css' href='".$url."'>\n";
                        }else if($type == "js"){
                            echo '<script src="'.$url.'"></script>';
                        }
                    }
                }
            }
        }

    }
}

if( !function_exists('format_bytes') ){
    function format_bytes($bytes) { 
        if ($bytes >= 1073741824)
        {
            $bytes = number_format($bytes / 1073741824, 2) . 'GB';
        }
        elseif ($bytes >= 1048576)
        {
            $bytes = number_format($bytes / 1048576, 2) . 'MB';
        }
        elseif ($bytes >= 1024)
        {
            $bytes = number_format($bytes / 1024, 2) . 'KB';
        }
        elseif ($bytes > 1)
        {
            $bytes = $bytes . 'bytes';
        }
        elseif ($bytes == 1)
        {
            $bytes = $bytes . 'byte';
        }
        else
        {
            $bytes = '0 bytes';
        }

        return $bytes;
    } 
}

if (!function_exists('get_data')) {
    function get_data($data, $field, $type = '', $value = '', $class = 'active'){
        if( is_array($data) ){
            if(!empty($data) && isset($data[$field]) ){
                switch ($type) {
                    case 'checkbox':
                        if($data[$field] == $value){
                            return 'checked';
                        }
                        break;

                    case 'radio':
                        if($data[$field] == $value){
                            return 'checked';
                        }
                        break;

                    case 'select':
                        if($data[$field] == $value){
                            return 'selected';
                        }
                        break;

                    case 'class':
                        if($data[$field] == $value){
                            return $class;
                        }
                        break;

                    default:
                        return $data[$field];
                        break;
                }
            }
        }else{
            if(!empty($data) && isset($data->$field) ){
                switch ($type) {
                    case 'checkbox':
                        if($data->$field == $value){
                            return 'checked';
                        }
                        break;

                    case 'radio':
                        if($data->$field == $value){
                            return 'checked';
                        }
                        break;

                    case 'select':
                        if($data->$field == $value){
                            return 'selected';
                        }
                        break;

                    case 'class':
                        if($data->$field == $value){
                            return $class;
                        }
                        break;

                    default:
                        return $data->$field;
                        break;
                }
            }
        }

        return false;
    };
}

if( !function_exists('is_image') ){
    function is_image($path)
    {   
        if (stripos($path, FCPATH) === false && stripos($path, "http://") === false && stripos($path, "https://") === false) { 
            $path = get_file_path($path);
        }
        
        if(!file_exists($path)){
            return true;
        }

        $a = getimagesize($path);
        $image_type = "";
        if(!empty($a)){
            $image_type = $a[2];
        }

        if(in_array($image_type , array(1 , 2 , 3 , 6)))
        {
            return true;
        }
        return false;
    }
}

if( !function_exists('get_header') ){
    function get_header($path)
    {   
        $stream_opts = [
            "ssl" => [
                "verify_peer"=>false,
                "verify_peer_name"=>false,
            ]
        ]; 

        $headers = get_headers( $path , 1, stream_context_create($stream_opts));
        if(!$headers){
            return false;
        }

        return $headers;
    }
}

if( !function_exists('is_video') ){
    function is_video($path)
    {   
        try {
            if (stripos($path, FCPATH) === false && stripos($path, "http://") === false && stripos($path, "https://") === false) { 
                $path = get_file_url($path);
            }

            $stream_opts = [
                "ssl" => [
                    "verify_peer"=>false,
                    "verify_peer_name"=>false,
                ]
            ]; 

            $headers = get_headers( $path , 1, stream_context_create($stream_opts));
            if(!$headers){
                return false;
            }

            $video_types = [
                "video/mp4",
                'video/quicktime' => 'mov'
            ];

            $file_type = "";

            if( isset( $headers['Content-Type'] ) ){
                $file_type = $headers['Content-Type'];
            }

            if( isset( $headers['content-type'] ) ){
                $file_type = $headers['content-type'];
            }

            if( in_array( $file_type, $video_types ) ){
                return true;
            } 
        } catch (\Exception $e) { pr($e,1); }

        return false;
    }
}


if( !function_exists('parse_config') ){
    function parse_config( $config ){

        if(isset( $config['icon'] )){
           
        } 

        if( get_option("sidebar_icon_color", 0) && get_option("site_icon_color", "#006dff") != "" ){
             $config['color'] = get_option("site_icon_color", "#006dff");
        }

        return $config;
    }
}

if( !function_exists('remove_file_path') ){
    function remove_file_path( $file ){
        if( $file != "" && stripos( strtolower($file) , "https://") !== false ||  stripos( strtolower($file) , "http://") !== false ){
            $file = str_replace( base_url()."/writable/", "", $file);
        }

        return $file;
    }
}

if( !function_exists('get_file_path') ){
    function get_file_path( $file ){
        if( $file != "" && stripos( strtolower($file) , "https://") !== false ||  stripos( strtolower($file) , "http://") !== false ){
            $file = str_replace( base_url( "writable/"), "", $file);
        }

        $file = str_replace( WRITEPATH, "", $file);

        return WRITEPATH.$file;
    }
}

if( !function_exists('get_file_url') ){
    function get_file_url( $file ){
        if ($file !== null) {
            if( $file != "" && stripos( strtolower($file) , "https://") !== false ||  stripos( strtolower($file) , "http://") !== false ){
                return $file;
            }else{
                return base_url( "writable/".$file );
            }
        }else{
            return $file;
        }
    }
}

if( !function_exists('get_upload_path') ){
    function get_upload_path($url = "", $slash = true){
        return WRITEPATH.'uploads'. ($slash?("/".$url):"");
    }
}

if( !function_exists('save_file') ){
    function save_file($url){
        $headers = get_header( $url );

        if(!$headers){
            return false;
        }

        $headers = array_change_key_case($headers, CASE_LOWER);

        if( !isset( $headers['content-type'] ) ){
            return false;
        }

        $mime = $headers['content-type'];
        $ext = mime2ext( $mime );
        $file_path = get_upload_path( uniqid().".".$ext );
        $stream_opts = [
            "ssl" => [
                "verify_peer"=>false,
                "verify_peer_name"=>false,
            ]
        ]; 

        $data = file_get_contents($url, false, stream_context_create($stream_opts));
        file_put_contents( $file_path , $data);

        return str_replace( WRITEPATH, "", $file_path);
    }
}

if( !function_exists('save_img') ){
    function save_img($img, $path){
        create_folder($path);

        $stream_opts = [
            "ssl" => [
                "verify_peer"=>false,
                "verify_peer_name"=>false,
            ]
        ]; 


        $headers = @get_headers($img, 1, stream_context_create($stream_opts));
        $img_types = ['image/jpeg', 'image/png', 'image/gif'];
        $headers = array_change_key_case($headers, CASE_LOWER);
        if(!empty($headers) && isset( $headers['content-type'] )){
            
            if( is_array($headers['content-type']) ){
                $file_type = "png";
                $path = $path.ids().".".$file_type;
                $data = file_get_contents($img, false, stream_context_create($stream_opts));
                file_put_contents($path, $data);
                return str_replace( WRITEPATH, "", $path);
            }else{
                $file_type = mime2ext( $headers['content-type'] );
                $path = $path.ids().".".$file_type;
                if(in_array( $headers['content-type'] , $img_types, true)){
                    $data = file_get_contents($img, false, stream_context_create($stream_opts));
                    file_put_contents($path, $data);
                    return str_replace( WRITEPATH, "", $path);
                }
            }
        }

        return "";
    }
}

if(!function_exists("get_domain")){
    function get_domain($url){
        if(filter_var($url, FILTER_VALIDATE_URL)){
            $parse_domain = parse_url($url);
            $real_domain = str_replace("www.", "", $parse_domain['host']);
            return $real_domain;
        }else{
            return false;
        }
    }
}

if (!function_exists('export_csv')) {
    function export_csv($table_name, $filename = "export"){
        // file name 
        $filename = $filename.'_'.date('Ymd').'.csv'; 
        header("Content-Description: File Transfer"); 
        header("Content-Disposition: attachment; filename=$filename"); 
        header("Content-Type: application/csv; ");

        // get data 
        $usersData = db_fetch("*", $table_name, false, "", "DESC", -1, 0, true);

        // file creation 
        $file = fopen('php://output', 'w');

        #$header = array("ID","Name","Email","City"); 
        #fputcsv($file, $header);
        foreach ($usersData as $key=>$line){ 
            fputcsv($file, $line); 
        }
        fclose($file); 
        exit;
    }
}

if( !function_exists('detect_file_type') ){
    function detect_file_type( $ext ){
        if( 
            $ext  == "jpg" || 
            $ext == "jpeg" || 
            $ext == "png" || 
            $ext == "gif" 
        ){
            return "image";
        }else if( 
            $ext == "mp4" || 
            $ext == "mov" 
        ){
            return "video";
        }else if( 
            $ext == "csv"
        ){
            return "csv";
        }else if( 
            $ext == "pdf"
        ){
            return "pdf";
        }else if( 
            $ext == "xlsx" || 
            $ext == "xls" || 
            $ext == "docx" || 
            $ext == "doc" || 
            $ext == "txt" 
        ){
            return "doc";
        }else if( 
            $ext == "mp3" 
        ){
            return "audio";
        }else{
            return "other";
        }
    }
}

if( !function_exists('detect_file_icon') ){
    function detect_file_icon($detect){
        switch ( $detect ) {
            case 'image':
                $text = "primary";
                $icon = "fad fa-image-polaroid";
                $icon = "fad fa-image-polaroid";
                break;

            case 'video':
                $text = "success";
                $icon = "fad fa-video";
                break;

            case 'audio':
                $text = "primary";
                $icon = "fad fa-file-music";
                break;

            case 'csv':
                $text = "info";
                $icon = "fad fa-file-csv";
                break;

            case 'pdf':
                $text = "danger";
                $icon = "fad fa-file-pdf";
                break;

            case 'doc':
                $text = "warning";
                $icon = "fad fa-file-alt";
                break;

            case 'zip':
                $text = "warning";
                $icon = "fad fa-file-archive";
                break;

            case 'folder':
                $text = "warning";
                $icon = "fad fa-file-archive";
                break;
            
            default:
                $text = "success";
                $icon = "fad fa-file-alt";
                break;
        }

        return [
            "text" => $text,
            "icon" => $icon
        ];
    }
}

if( !function_exists('mime2ext') ){
    function mime2ext($mime) {
        if(is_array($mime)){
            $mime = end($mime);
        }

        $mime_map = [
            'video/3gpp2' => '3g2',
            'video/3gp' => '3gp',
            'video/3gpp' => '3gp',
            'application/x-compressed' => '7zip',
            'audio/x-acc' => 'aac',
            'audio/ac3' => 'ac3',
            'application/postscript' => 'ai',
            'audio/x-aiff' => 'aif',
            'audio/aiff' => 'aif',
            'audio/x-au' => 'au',
            'video/x-msvideo' => 'avi',
            'video/msvideo' => 'avi',
            'video/avi' => 'avi',
            'application/x-troff-msvideo' => 'avi',
            'application/macbinary' => 'bin',
            'application/mac-binary' => 'bin',
            'application/x-binary' => 'bin',
            'application/x-macbinary' => 'bin',
            'image/bmp' => 'bmp',
            'image/x-bmp' => 'bmp',
            'image/x-bitmap' => 'bmp',
            'image/x-xbitmap' => 'bmp',
            'image/x-win-bitmap' => 'bmp',
            'image/x-windows-bmp' => 'bmp',
            'image/ms-bmp' => 'bmp',
            'image/x-ms-bmp' => 'bmp',
            'application/bmp' => 'bmp',
            'application/x-bmp' => 'bmp',
            'application/x-win-bitmap' => 'bmp',
            'application/cdr' => 'cdr',
            'application/coreldraw' => 'cdr',
            'application/x-cdr' => 'cdr',
            'application/x-coreldraw' => 'cdr',
            'image/cdr' => 'cdr',
            'image/x-cdr' => 'cdr',
            'zz-application/zz-winassoc-cdr' => 'cdr',
            'application/mac-compactpro' => 'cpt',
            'application/pkix-crl' => 'crl',
            'application/pkcs-crl' => 'crl',
            'application/x-x509-ca-cert' => 'crt',
            'application/pkix-cert' => 'crt',
            'text/css' => 'css',
            'text/x-comma-separated-values' => 'csv',
            'text/comma-separated-values' => 'csv',
            'application/vnd.msexcel' => 'csv',
            'text/csv' => 'csv',
            'application/x-director' => 'dcr',
            'application/vnd.openxmlformats-officedocument.wordprocessingml.document' => 'docx',
            'application/x-dvi' => 'dvi',
            'message/rfc822' => 'eml',
            'application/x-msdownload' => 'exe',
            'video/x-f4v' => 'f4v',
            'audio/x-flac' => 'flac',
            'video/x-flv' => 'flv',
            'image/gif' => 'gif',
            'application/gpg-keys' => 'gpg',
            'application/x-gtar' => 'gtar',
            'application/x-gzip' => 'gzip',
            'application/mac-binhex40' => 'hqx',
            'application/mac-binhex' => 'hqx',
            'application/x-binhex40' => 'hqx',
            'application/x-mac-binhex40' => 'hqx',
            'text/html' => 'html',
            'image/x-icon' => 'ico',
            'image/x-ico' => 'ico',
            'image/vnd.microsoft.icon' => 'ico',
            'text/calendar' => 'ics',
            'application/java-archive' => 'jar',
            'application/x-java-application' => 'jar',
            'application/x-jar' => 'jar',
            'image/jp2' => 'jp2',
            'video/mj2' => 'jp2',
            'image/jpx' => 'jp2',
            'image/jpm' => 'jp2',
            'image/jpeg' => 'jpg',
            'image/pjpeg' => 'jpeg',
            'application/x-javascript' => 'js',
            'application/json' => 'json',
            'text/json' => 'json',
            'application/vnd.google-earth.kml+xml' => 'kml',
            'application/vnd.google-earth.kmz' => 'kmz',
            'text/x-log' => 'log',
            'audio/x-m4a' => 'm4a',
            'application/vnd.mpegurl' => 'm4u',
            'audio/midi' => 'mid',
            'application/vnd.mif' => 'mif',
            'video/quicktime' => 'mov',
            'video/x-sgi-movie' => 'movie',
            'audio/mpeg' => 'mp3',
            'audio/mpg' => 'mp3',
            'audio/mpeg3' => 'mp3',
            'audio/mp3' => 'mp3',
            'video/mp4' => 'mp4',
            'video/mpeg' => 'mpeg',
            'application/oda' => 'oda',
            'audio/ogg' => 'ogg',
            'video/ogg' => 'ogg',
            'application/ogg' => 'ogg',
            'application/x-pkcs10' => 'p10',
            'application/pkcs10' => 'p10',
            'application/x-pkcs12' => 'p12',
            'application/x-pkcs7-signature' => 'p7a',
            'application/pkcs7-mime' => 'p7c',
            'application/x-pkcs7-mime' => 'p7c',
            'application/x-pkcs7-certreqresp' => 'p7r',
            'application/pkcs7-signature' => 'p7s',
            'application/pdf' => 'pdf',
            'application/octet-stream' => 'pdf',
            'application/x-x509-user-cert' => 'pem',
            'application/x-pem-file' => 'pem',
            'application/pgp' => 'pgp',
            'application/x-httpd-php' => 'php',
            'application/php' => 'php',
            'application/x-php' => 'php',
            'text/php' => 'php',
            'text/x-php' => 'php',
            'application/x-httpd-php-source' => 'php',
            'image/png' => 'png',
            'image/x-png' => 'png',
            'application/powerpoint' => 'ppt',
            'application/vnd.ms-powerpoint' => 'ppt',
            'application/vnd.ms-office' => 'ppt',
            'application/msword' => 'doc',
            'application/vnd.openxmlformats-officedocument.presentationml.presentation' => 'pptx',
            'application/x-photoshop' => 'psd',
            'image/vnd.adobe.photoshop' => 'psd',
            'audio/x-realaudio' => 'ra',
            'audio/x-pn-realaudio' => 'ram',
            'application/x-rar' => 'rar',
            'application/rar' => 'rar',
            'application/x-rar-compressed' => 'rar',
            'audio/x-pn-realaudio-plugin' => 'rpm',
            'application/x-pkcs7' => 'rsa',
            'text/rtf' => 'rtf',
            'text/richtext' => 'rtx',
            'video/vnd.rn-realvideo' => 'rv',
            'application/x-stuffit' => 'sit',
            'application/smil' => 'smil',
            'text/srt' => 'srt',
            'image/svg+xml' => 'svg',
            'application/x-shockwave-flash' => 'swf',
            'application/x-tar' => 'tar',
            'application/x-gzip-compressed' => 'tgz',
            'image/tiff' => 'tiff',
            'text/plain' => 'txt',
            'text/x-vcard' => 'vcf',
            'application/videolan' => 'vlc',
            'text/vtt' => 'vtt',
            'audio/x-wav' => 'wav',
            'audio/wave' => 'wav',
            'audio/wav' => 'wav',
            'application/wbxml' => 'wbxml',
            'video/webm' => 'webm',
            'audio/x-ms-wma' => 'wma',
            'application/wmlc' => 'wmlc',
            'video/x-ms-wmv' => 'wmv',
            'video/x-ms-asf' => 'wmv',
            'application/xhtml+xml' => 'xhtml',
            'application/excel' => 'xl',
            'application/msexcel' => 'xls',
            'application/x-msexcel' => 'xls',
            'application/x-ms-excel' => 'xls',
            'application/x-excel' => 'xls',
            'application/x-dos_ms_excel' => 'xls',
            'application/xls' => 'xls',
            'application/x-xls' => 'xls',
            'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet' => 'xlsx',
            'application/vnd.ms-excel' => 'xlsx',
            'application/xml' => 'xml',
            'text/xml' => 'xml',
            'text/xsl' => 'xsl',
            'application/xspf+xml' => 'xspf',
            'application/x-compress' => 'z',
            'application/x-zip' => 'zip',
            'application/zip' => 'zip',
            'application/x-zip-compressed' => 'zip',
            'application/s-compressed' => 'zip',
            'multipart/x-zip' => 'zip',
            'text/x-scriptzsh' => 'zsh'
        ];

        return isset($mime_map[$mime]) === true ? $mime_map[$mime] : false;
    }
}

if (!function_exists('img')) {
    function img($image_path, $width = 200, $height = 200, $quality = 80) {
        try {
            create_folder(WRITEPATH."tmp/thumb/");
            $file_path = FCPATH.str_replace( base_url() , "", $image_path);

            if(file_exists($file_path)){
                $file_name = explode("writable/uploads/", $file_path);
                if(count($file_name) > 1){
                    $file_name = $file_name[1];
                }else{
                    $file_name = md5( $file_path ).'.jpg';
                }

                $image = 0;
                $thumb_path = 'tmp/thumb/'.$file_name;
                $thumb_full_path = WRITEPATH.$thumb_path;
                if ( !file_exists($thumb_full_path) ) {
                    $image = \Config\Services::image()
                    ->withFile( $file_path )
                    ->fit($width, $height, 'center')
                    ->save($thumb_full_path);
                }
                
                if($image){
                    return base_url( 'writable/'.$thumb_path );
                }else{
                    return $image_path;
                }
            }else{
                return get_theme_url()."Assets/img/file-not-found.jpg";
            }
        } catch (Exception $e) {
            pr($e,1);
            return get_theme_url()."Assets/img/file-not-found.jpg";
        }
    }
}

if(!function_exists("create_folder")){
    function create_folder($path){
        if (!file_exists($path)) {
            $uold     = umask(0);
            mkdir($path, 0777);
            umask($uold);

            file_put_contents($path."index.html", "<h1>404 Not Found</h1>");
        }
    }
}

if( !function_exists('set_cookies') ){
    function set_cookies($cookie_data, $expire = 0) {
        helper('cookie');
        if(is_array($cookie_data)){
            foreach ($cookie_data as $key => $value) {
                helper('cookie');
                set_cookie($key, $value, $expire);
            }
        }
    }
}

if( !function_exists('cookie') ){
    function cookie($cookie_name) {
        helper('cookie');
        return get_cookie($cookie_name);
    }
}

if( !function_exists('delete_cookies') ){
    function delete_cookies($cookie_name) {
        helper('cookie');
        return delete_cookie($cookie_name);
    }
}


if( !function_exists('set_session') ){
    function set_session($array) {
        $session = \Config\Services::session();
        $session->set($array);
    }
}

if( !function_exists('get_session') ){
    function get_session($value) {
        $session = \Config\Services::session();
        return $session->get($value);
    }
}

if( !function_exists('remove_session') ){
    function remove_session($array) {
        $session = \Config\Services::session();
        $session->remove($array);
    }
}

if( !function_exists('check_session') ){
    function check_session($value) {
        $session = \Config\Services::session();
        return $session->has($value);
    }
}

if( !function_exists('destroy_session') ){
    function destroy_session() {
        $session = \Config\Services::session();
        $session->destroy();
    }
}

if( !function_exists('stop_session') ){
    function stop_session() {
        $session = \Config\Services::session();
        $session->stop();
    }
}

if( !function_exists('get_key') ){
    function get_key() {
        return "5d3cd64d5d2f07292d75676b93921497";
    }
}

if( !function_exists('get_language_code') ){
    function get_language_codes(){
        $codes = [
            "af" => "Afrikaans",
            "ak" => "Akan",
            "sq" => "Albanian",
            "am" => "Amharic",
            "ar" => "Arabic",
            "hy" => "Armenian",
            "rup" => "Aromanian",
            "as" => "Assamese",
            "az" => "Azerbaijani",
            "az-tr" => "Azerbaijani (Turkey)",
            "ba" => "Bashkir",
            "eu" => "Basque",
            "bel" => "Belarusian",
            "bn" => "Bengali",
            "bs" => "Bosnian",
            "bg" => "Bulgarian",
            "mya" => "Burmese",
            "ca" => "Catalan",
            "bal" => "Catalan (Balear)",
            "zh-cn" => "Chinese (China)",
            "zh-hk" => "Chinese (Hong Kong)",
            "zh-tw" => "Chinese (Taiwan)",
            "co" => "Corsican",
            "hr" => "Croatian",
            "cs" => "Czech",
            "da" => "Danish",
            "dv" => "Dhivehi",
            "nl" => "Dutch",
            "nl-be" => "Dutch (Belgium)",
            "en" => "English",
            "en-au" => "English (Australia)",
            "en-ca" => "English (Canada)",
            "en-gb" => "English (UK)",
            "eo" => "Esperanto",
            "et" => "Estonian",
            "fo" => "Faroese",
            "fi" => "Finnish",
            "fr-be" => "French (Belgium)",
            "fr" => "French (France)",
            "fy" => "Frisian",
            "fuc" => "Fulah",
            "gl" => "Galician",
            "ka" => "Georgian",
            "de" => "German",
            "de-ch" => "German (Switzerland)",
            "el" => "Greek",
            "gn" => "Guaraní",
            "gu" => "Gujarati",
            "haw" => "Hawaiian",
            "haz" => "Hazaragi",
            "he" => "Hebrew",
            "hi" => "Hindi",
            "hu" => "Hungarian",
            "is" => "Icelandic",
            "ido" => "Ido",
            "id" => "Indonesian",
            "ga" => "Irish",
            "it" => "Italian",
            "ja" => "Japanese",
            "jv" => "Javanese",
            "kn" => "Kannada",
            "kk" => "Kazakh",
            "km" => "Khmer",
            "kin" => "Kinyarwanda",
            "ky" => "Kirghiz",
            "ko" => "Korean",
            "ckb" => "Kurdish (Sorani)",
            "lo" => "Lao",
            "lv" => "Latvian",
            "li" => "Limburgish",
            "lin" => "Lingala",
            "lt" => "Lithuanian",
            "lb" => "Luxembourgish",
            "mk" => "Macedonian",
            "mg" => "Malagasy",
            "ms" => "Malay",
            "ml" => "Malayalam",
            "mr" => "Marathi",
            "xmf" => "Mingrelian",
            "mn" => "Mongolian",
            "me" => "Montenegrin",
            "ne" => "Nepali",
            "nb" => "Norwegian (Bokmål)",
            "nn" => "Norwegian (Nynorsk)",
            "ory" => "Oriya",
            "os" => "Ossetic",
            "ps" => "Pashto",
            "fa" => "Persian",
            "fa-af" => "Persian (Afghanistan)",
            "pl" => "Polish",
            "pt-br" => "Portuguese (Brazil)",
            "pt" => "Portuguese (Portugal)",
            "pa" => "Punjabi",
            "rhg" => "Rohingya",
            "ro" => "Romanian",
            "ru" => "Russian",
            "ru-ua" => "Russian (Ukraine)",
            "rue" => "Rusyn",
            "sah" => "Sakha",
            "sa-in" => "Sanskrit",
            "srd" => "Sardinian",
            "gd" => "Scottish Gaelic",
            "sr" => "Serbian",
            "sd" => "Sindhi",
            "si" => "Sinhala",
            "sk" => "Slovak",
            "sl" => "Slovenian",
            "so" => "Somali",
            "azb" => "South Azerbaijani",
            "es-ar" => "Spanish (Argentina)",
            "es-cl" => "Spanish (Chile)",
            "es-co" => "Spanish (Colombia)",
            "es-mx" => "Spanish (Mexico)",
            "es-pe" => "Spanish (Peru)",
            "es-pr" => "Spanish (Puerto Rico)",
            "es" => "Spanish (Spain)",
            "es-ve" => "Spanish (Venezuela)",
            "su" => "Sundanese",
            "sw" => "Swahili",
            "sv" => "Swedish",
            "gsw" => "Swiss German",
            "tl" => "Tagalog",
            "tg" => "Tajik",
            "tzm" => "Tamazight (Central Atlas)",
            "ta" => "Tamil",
            "ta-lk" => "Tamil (Sri Lanka)",
            "tt" => "Tatar",
            "te" => "Telugu",
            "th" => "Thai",
            "bo" => "Tibetan",
            "tir" => "Tigrinya",
            "tr" => "Turkish",
            "tuk" => "Turkmen",
            "ug" => "Uighur",
            "uk" => "Ukrainian",
            "ur" => "Urdu",
            "uz" => "Uzbek",
            "vi" => "Vietnamese",
            "wa" => "Walloon",
            "cy" => "Welsh",
            "yor" => "Yoruba"
        ];

        return $codes;
    }
}

if(!function_exists('list_countries')){
    function list_countries($key = ""){
        $countries = array(
              "AF" => "Afghanistan",
              "AX" => "Åland Islands",
              "AL" => "Albania",
              "DZ" => "Algeria",
              "AS" => "American Samoa",
              "AD" => "Andorra",
              "AO" => "Angola",
              "AI" => "Anguilla",
              "AQ" => "Antarctica",
              "AG" => "Antigua and Barbuda",
              "AR" => "Argentina",
              "AM" => "Armenia",
              "AW" => "Aruba",
              "AU" => "Australia",
              "AT" => "Austria",
              "AZ" => "Azerbaijan",
              "BS" => "Bahamas",
              "BH" => "Bahrain",
              "BD" => "Bangladesh",
              "BB" => "Barbados",
              "BY" => "Belarus",
              "BE" => "Belgium",
              "BZ" => "Belize",
              "BJ" => "Benin",
              "BM" => "Bermuda",
              "BT" => "Bhutan",
              "BO" => "Bolivia, Plurinational State of",
              "BQ" => "Bonaire, Sint Eustatius and Saba",
              "BA" => "Bosnia and Herzegovina",
              "BW" => "Botswana",
              "BV" => "Bouvet Island",
              "BR" => "Brazil",
              "IO" => "British Indian Ocean Territory",
              "BN" => "Brunei Darussalam",
              "BG" => "Bulgaria",
              "BF" => "Burkina Faso",
              "BI" => "Burundi",
              "KH" => "Cambodia",
              "CM" => "Cameroon",
              "CA" => "Canada",
              "CV" => "Cape Verde",
              "KY" => "Cayman Islands",
              "CF" => "Central African Republic",
              "TD" => "Chad",
              "CL" => "Chile",
              "CN" => "China",
              "CX" => "Christmas Island",
              "CC" => "Cocos (Keeling) Islands",
              "CO" => "Colombia",
              "KM" => "Comoros",
              "CG" => "Congo",
              "CD" => "Congo, the Democratic Republic of the",
              "CK" => "Cook Islands",
              "CR" => "Costa Rica",
              "CI" => "Côte d'Ivoire",
              "HR" => "Croatia",
              "CU" => "Cuba",
              "CW" => "Curaçao",
              "CY" => "Cyprus",
              "CZ" => "Czech Republic",
              "DK" => "Denmark",
              "DJ" => "Djibouti",
              "DM" => "Dominica",
              "DO" => "Dominican Republic",
              "EC" => "Ecuador",
              "EG" => "Egypt",
              "SV" => "El Salvador",
              "GQ" => "Equatorial Guinea",
              "ER" => "Eritrea",
              "EE" => "Estonia",
              "ET" => "Ethiopia",
              "FK" => "Falkland Islands (Malvinas)",
              "FO" => "Faroe Islands",
              "FJ" => "Fiji",
              "FI" => "Finland",
              "FR" => "France",
              "GF" => "French Guiana",
              "PF" => "French Polynesia",
              "TF" => "French Southern Territories",
              "GA" => "Gabon",
              "GM" => "Gambia",
              "GE" => "Georgia",
              "DE" => "Germany",
              "GH" => "Ghana",
              "GI" => "Gibraltar",
              "GR" => "Greece",
              "GL" => "Greenland",
              "GD" => "Grenada",
              "GP" => "Guadeloupe",
              "GU" => "Guam",
              "GT" => "Guatemala",
              "GG" => "Guernsey",
              "GN" => "Guinea",
              "GW" => "Guinea-Bissau",
              "GY" => "Guyana",
              "HT" => "Haiti",
              "HM" => "Heard Island and McDonald Islands",
              "VA" => "Holy See (Vatican City State)",
              "HN" => "Honduras",
              "HK" => "Hong Kong",
              "HU" => "Hungary",
              "IS" => "Iceland",
              "IN" => "India",
              "ID" => "Indonesia",
              "IR" => "Iran, Islamic Republic of",
              "IQ" => "Iraq",
              "IE" => "Ireland",
              "IM" => "Isle of Man",
              "IL" => "Israel",
              "IT" => "Italy",
              "JM" => "Jamaica",
              "JP" => "Japan",
              "JE" => "Jersey",
              "JO" => "Jordan",
              "KZ" => "Kazakhstan",
              "KE" => "Kenya",
              "KI" => "Kiribati",
              "KP" => "Korea, Democratic People's Republic of",
              "KR" => "Korea, Republic of",
              "KW" => "Kuwait",
              "KG" => "Kyrgyzstan",
              "LA" => "Lao People's Democratic Republic",
              "LV" => "Latvia",
              "LB" => "Lebanon",
              "LS" => "Lesotho",
              "LR" => "Liberia",
              "LY" => "Libya",
              "LI" => "Liechtenstein",
              "LT" => "Lithuania",
              "LU" => "Luxembourg",
              "MO" => "Macao",
              "MK" => "Macedonia, the former Yugoslav Republic of",
              "MG" => "Madagascar",
              "MW" => "Malawi",
              "MY" => "Malaysia",
              "MV" => "Maldives",
              "ML" => "Mali",
              "MT" => "Malta",
              "MH" => "Marshall Islands",
              "MQ" => "Martinique",
              "MR" => "Mauritania",
              "MU" => "Mauritius",
              "YT" => "Mayotte",
              "MX" => "Mexico",
              "FM" => "Micronesia, Federated States of",
              "MD" => "Moldova, Republic of",
              "MC" => "Monaco",
              "MN" => "Mongolia",
              "ME" => "Montenegro",
              "MS" => "Montserrat",
              "MA" => "Morocco",
              "MZ" => "Mozambique",
              "MM" => "Myanmar",
              "NA" => "Namibia",
              "NR" => "Nauru",
              "NP" => "Nepal",
              "NL" => "Netherlands",
              "NC" => "New Caledonia",
              "NZ" => "New Zealand",
              "NI" => "Nicaragua",
              "NE" => "Niger",
              "NG" => "Nigeria",
              "NU" => "Niue",
              "NF" => "Norfolk Island",
              "MP" => "Northern Mariana Islands",
              "NO" => "Norway",
              "OM" => "Oman",
              "PK" => "Pakistan",
              "PW" => "Palau",
              "PS" => "Palestinian Territory, Occupied",
              "PA" => "Panama",
              "PG" => "Papua New Guinea",
              "PY" => "Paraguay",
              "PE" => "Peru",
              "PH" => "Philippines",
              "PN" => "Pitcairn",
              "PL" => "Poland",
              "PT" => "Portugal",
              "PR" => "Puerto Rico",
              "QA" => "Qatar",
              "RE" => "Réunion",
              "RO" => "Romania",
              "RU" => "Russian Federation",
              "RW" => "Rwanda",
              "BL" => "Saint Barthélemy",
              "SH" => "Saint Helena, Ascension and Tristan da Cunha",
              "KN" => "Saint Kitts and Nevis",
              "LC" => "Saint Lucia",
              "MF" => "Saint Martin (French part)",
              "PM" => "Saint Pierre and Miquelon",
              "VC" => "Saint Vincent and the Grenadines",
              "WS" => "Samoa",
              "SM" => "San Marino",
              "ST" => "Sao Tome and Principe",
              "SA" => "Saudi Arabia",
              "SN" => "Senegal",
              "RS" => "Serbia",
              "SC" => "Seychelles",
              "SL" => "Sierra Leone",
              "SG" => "Singapore",
              "SX" => "Sint Maarten (Dutch part)",
              "SK" => "Slovakia",
              "SI" => "Slovenia",
              "SB" => "Solomon Islands",
              "SO" => "Somalia",
              "ZA" => "South Africa",
              "GS" => "South Georgia and the South Sandwich Islands",
              "SS" => "South Sudan",
              "ES" => "Spain",
              "LK" => "Sri Lanka",
              "SD" => "Sudan",
              "SR" => "Suriname",
              "SJ" => "Svalbard and Jan Mayen",
              "SZ" => "Swaziland",
              "SE" => "Sweden",
              "CH" => "Switzerland",
              "SY" => "Syrian Arab Republic",
              "TW" => "Taiwan, Province of China",
              "TJ" => "Tajikistan",
              "TZ" => "Tanzania, United Republic of",
              "TH" => "Thailand",
              "TL" => "Timor-Leste",
              "TG" => "Togo",
              "TK" => "Tokelau",
              "TO" => "Tonga",
              "TT" => "Trinidad and Tobago",
              "TN" => "Tunisia",
              "TR" => "Turkey",
              "TM" => "Turkmenistan",
              "TC" => "Turks and Caicos Islands",
              "TV" => "Tuvalu",
              "UG" => "Uganda",
              "UA" => "Ukraine",
              "AE" => "United Arab Emirates",
              "GB" => "United Kingdom",
              "US" => "United States",
              "UM" => "United States Minor Outlying Islands",
              "UY" => "Uruguay",
              "UZ" => "Uzbekistan",
              "VU" => "Vanuatu",
              "VE" => "Venezuela, Bolivarian Republic of",
              "VN" => "Viet Nam",
              "VG" => "Virgin Islands, British",
              "VI" => "Virgin Islands, U.S.",
              "WF" => "Wallis and Futuna",
              "EH" => "Western Sahara",
              "YE" => "Yemen",
              "ZM" => "Zambia",
              "ZW" => "Zimbabwe"
        );

        if($key != ""){
              if(isset($countries[$key])){
                  return $countries[$key];
              }else{
                  return __("Unknown");
              }
        }

        return $countries;
    }
}