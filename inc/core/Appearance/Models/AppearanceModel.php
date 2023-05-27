<?php
namespace Core\Appearance\Models;
use CodeIgniter\Model;

class AppearanceModel extends Model
{
    public function __construct(){
        $this->config = parse_config( include realpath( __DIR__."/../Config.php" ) );
    }

    public function block_settings($path = ""){

        $frontend_theme_paths = FCPATH."inc/themes/frontend";
        $frontend_theme_folders = glob( $frontend_theme_paths . '/*' );
        $fontend_templates = [];

        if( !empty($frontend_theme_folders) ){
            foreach ($frontend_theme_folders as $key => $theme_folder) {
                $config_file = $theme_folder. "/" . "Config.php";
                if ( file_exists($config_file) ) {
                    $fontend_templates[] = include $config_file;
                }
            }
        }

        return array(
            "position" => 9500,
            "menu" => view( 'Core\Appearance\Views\settings\menu', [ 'config' => $this->config ] ),
            "content" => view( 'Core\Appearance\Views\settings\content', [ 'config' => $this->config, "frontend_tempaltes" => $fontend_templates ] )
        );
    }
}