<?php
namespace Core\Other\Models;
use CodeIgniter\Model;

class OtherModel extends Model
{
	public function __construct(){
        $this->config = parse_config( include realpath( __DIR__."/../Config.php" ) );
    }

    public function block_settings($path = ""){
        return array(
            "position" => 1000,
            "menu" => view( 'Core\Other\Views\settings\menu', [ 'config' => $this->config ] ),
            "content" => view( 'Core\Other\Views\settings\content', [ 'config' => $this->config ] )
        );
    }

    public function add_script_to_footer(){
        return view( 'Core\Other\Views\add_script_to_footer', [ 'config' => $this->config ] );
    }
}
