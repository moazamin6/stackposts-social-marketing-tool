<?php
namespace Core\Social_network_settings\Models;
use CodeIgniter\Model;

class Social_network_settingsModel extends Model
{
	public function __construct(){
        $this->config = parse_config( include realpath( __DIR__."/../Config.php" ) );
    }
    
    public function block_settings($path = ""){
        return array(
            "position" => 8000,
            "menu" => view( 'Core\Social_network_settings\Views\settings\menu', [ 'config' => $this->config ] ),
            "content" => view( 'Core\Social_network_settings\Views\settings\content', [ 'config' => $this->config ] )
        );
    }
}
