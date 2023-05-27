<?php
namespace Core\Social_pages\Models;
use CodeIgniter\Model;

class Social_pagesModel extends Model
{
	public function __construct(){
        $this->config = parse_config( include realpath( __DIR__."/../Config.php" ) );
    }

    public function block_settings($path = ""){
        return array(
            "position" => 9000,
            "menu" => view( 'Core\Social_pages\Views\settings\menu', [ 'config' => $this->config ] ),
            "content" => view( 'Core\Social_pages\Views\settings\content', [ 'config' => $this->config ] )
        );
    }
}
