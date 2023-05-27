<?php
namespace Core\Crons\Models;
use CodeIgniter\Model;

class CronsModel extends Model
{
	public function __construct(){
        $this->config = parse_config( include realpath( __DIR__."/../Config.php" ) );
    }

    public function block_settings($path = ""){
        $module_paths = get_module_paths();
        $settings_data = array();
        $configs = [];
        if(!empty($module_paths))
        {
            if( !empty($module_paths) ){
                foreach ($module_paths as $key => $module_path) {
                    $config_path = $module_path . "/Config.php";
                    $config_item = include $config_path;

                    $model_paths = $module_path . "/Models/";
                    $model_files = glob( $model_paths . '*' );

                    $configs[] = $config_item;
                }
            }
        }

        $crons = [];

        if( ! empty($configs) ){ 
            foreach ($configs as $key => $config) {
                if ( isset($config['cron']) && isset($config['cron']['uri']) && isset($config['cron']['style']) && isset($config['cron']['name']) ) {
                    $crons[] = $config['cron'];
                }
            }
        }

        return array(
            "position" => 8900,
            "menu" => view( 'Core\Crons\Views\settings\menu', [ 'config' => $this->config ] ),
            "content" => view( 'Core\Crons\Views\settings\content', [ 'config' => $this->config, "crons" => $crons ] )
        );
    }
}
