<?php
namespace Core\Settings\Controllers;

class Settings extends \CodeIgniter\Controller
{
    public function __construct(){
        $this->config = parse_config( include realpath( __DIR__."/../Config.php" ) );
    }

    public function index( $page = false ) {

        $setting_data = $this->request->setting_pages;

        $data = [
            "title" => $this->config['name'],
            "desc" => $this->config['desc'],
            "settings" => $setting_data,
            "content" => view('Core\Settings\Views\empty')
        ];

        if( isset($setting_data[$page]) && isset($setting_data[$page]['content']) ){
            $data['content'] = $setting_data[$page]['content'];
        }

        return view('Core\Settings\Views\index', $data);
    }

    public function save(){
        $data = $this->request->getPost();

        if(is_array($data)){
            foreach ($data as $key => $value) {
                if($key != 'csrf'){
                    update_option( $key, trim( htmlspecialchars( $value ) ) );
                }
            }
        }

        ms([
            "status"  => "success",
            "message" => __('Success'),
        ]);
    }

    public function set_frontend( $id = false ) {
        $frontend_theme_paths = FCPATH."inc/themes/frontend";
        $frontend_theme_folders = glob( $frontend_theme_paths . '/*' );
        if( !empty($frontend_theme_folders) ){
            foreach ($frontend_theme_folders as $key => $theme_folder) {
                $config_file = $theme_folder. "/" . "Config.php";
                if ( file_exists($config_file) ) {
                    $config_item = include $config_file;
                    if($config_item['id'] == $id){
                        $check = true;
                        get_option("frontend_template", "Stackgo");
                        update_option("frontend_template", $id);

                        ms([
                            "status" => "success",
                            "message" => __("Success")
                        ]);
                    }
                }
            }
        }

        ms([
            "status" => "error",
            "message" => __("Frontend template you selected is not exist")
        ]);
    }
}