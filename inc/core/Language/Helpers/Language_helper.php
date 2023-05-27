<?php
if(!function_exists('create_language_file')){
    function create_language_file($code){
        $language_category = db_get("*", TB_LANGUAGE_CATEGORY, ["code" => $code]);
        $language_items = db_fetch("slug, text", TB_LANGUAGE, ["code" => $code]);
        if(!empty($language_category)){
            $language = array();
            if(!empty($language_items)){
                foreach ($language_items as $key => $value) {
                    $slug = str_replace("", "", $value->slug);
                    $language[$slug] =str_replace("\\", "", $value->text);
                }
            }

            $category = [
                "name" => $language_category->name,
                "icon" => $language_category->icon,
                "code" => $language_category->code,
                "dir" => $language_category->dir,
            ];

            $language_pack = [
                "info" => $category,
                "data" => $language
            ];

            $language_pack = json_encode($language_pack);

            create_folder(WRITEPATH."lang");
            $handle = fopen(WRITEPATH."lang/".$code.".json", "w");
            fwrite($handle, $language_pack);
            fclose($handle);
        }
    }
}

if(!function_exists('__')){
    function __($key = ''){
        if(get_session('language')){
            $language = get_session('language');
        }else{
            if(!get_user("language")){
                $code = get_user("language");
                $language = db_get("*", TB_LANGUAGE_CATEGORY, ["code" => $code]);
                if(empty($language)){
                    $language = db_get("*", TB_LANGUAGE_CATEGORY, ["is_default" => 1]);
                }
            }else{
                $language = db_get("*", TB_LANGUAGE_CATEGORY, ["is_default" => 1]);
            }
            
            $language = json_encode($language);
            if(!empty($language)){
                set_session(["language" => $language]);
            }
        }

        if($language){
            $language = is_string($language)?json_decode( $language ):$language;

            if(isset($language->code)){
                $lang_file = WRITEPATH."lang/".$language->code.".json";
                if(file_exists($lang_file)){
                    $data = file_get_contents(WRITEPATH."lang/".$language->code.".json");
                    $data = json_decode($data, 1);
                    if(isset($data['data'])){
                        $data = $data['data'];
                        if($key != "" && isset($data[ md5($key) ])){
                            return $data[ md5($key) ];
                        }
                    }
                }
            }
        }

        return $key;
    }
}

if( ! function_exists("create_default_language") ){
    function create_default_language()
    {
    	$data = [];
        //Create Default Language
        $language_en = db_get("*", TB_LANGUAGE_CATEGORY, "code = 'en'");
        if( empty( $language_en ) ){
        	$language_default = db_get("id", TB_LANGUAGE_CATEGORY, "status = 1");
        	$status = 1;
        	if( !empty( $language_default ) ){
        		$status = 0;
        	}

            $data = [
                "ids" => ids(),
                "name" => "English",
                "code" => "en",
                "icon" => "flag-icon flag-icon-us",
                "is_default" => 1,
                "status" => $status,
            ];
        }

        //$id = db_insert(TB_LANGUAGE_CATEGORY, $data);

        $module_paths = get_module_paths();
        $language_data = array();
        if(!empty($module_paths))
        {
            if( !empty($module_paths) ){
                foreach ($module_paths as $key => $module_path) {
                    $lang_paths = $module_path . "/Language/";
                    $lang_files = glob( $lang_paths . '*' );

                    if ( !empty( $lang_files ) )
                    {
                        foreach ( $lang_files as $lang_file )
                        {
                            $lang_content = include_once $lang_file;
                            $language_data[] = $lang_content;

                        }
                    }
                }
            }
        }

        $language_data = array_flatten($language_data);

        $language_items = [];
        foreach ($language_data as $key => $text) {
            $check_exist = db_get("*", TB_LANGUAGE, "code = 'en' AND slug = '".md5($key)."'");
            if(empty( $check_exist )){
                $language_items[] = [
                    "ids" => ids(),
                    "code" => "en",
                    "slug" => md5($key),
                    "text" => $text,
                    "custom" => 0
                ];
            }
        }

        db_insert( TB_LANGUAGE, $language_items );
    }
}


function array_flatten($array) { 
  if (!is_array($array)) { 
    return FALSE; 
  } 
  $result = array(); 
  foreach ($array as $key => $value) { 
    if (is_array($value)) { 
      $result = array_merge($result, array_flatten($value)); 
    } 
    else { 
      $result[$key] = $value; 
    } 
  } 
  return $result; 
} 