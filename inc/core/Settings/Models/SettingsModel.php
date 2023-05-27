<?php
namespace Core\Settings\Models;
use CodeIgniter\Model;

class SettingsModel extends Model
{
    public function __construct(){
        $this->config = parse_config( include realpath( __DIR__."/../Config.php" ) );
    }
    
    public function block_settings($path = ""){
        return array(
            "position" => 10000,
            "menu" => view( 'Core\Settings\Views\settings\menu', [ 'config' => $this->config ] ),
            "content" => view( 'Core\Settings\Views\settings\content', [ 'config' => $this->config ] )
        );
    }

    public function add_script_to_header(){
        return view( 'Core\Settings\Views\add_script_to_header', [ 'config' => $this->config ] );
    }
}
