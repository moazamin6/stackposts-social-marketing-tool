<?php
namespace Core\Mail\Models;
use CodeIgniter\Model;

class MailModel extends Model
{
	public function __construct(){
        $this->config = parse_config( include realpath( __DIR__."/../Config.php" ) );
    }
    
    public function block_settings($path = ""){
        return array(
            "position" => 9300,
            "menu" => view( 'Core\Mail\Views\settings\menu', [ 'config' => $this->config ] ),
            "content" => view( 'Core\Mail\Views\settings\content', [ 'config' => $this->config ] )
        );
    }
}
