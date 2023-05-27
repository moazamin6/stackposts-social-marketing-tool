<?php
namespace Core\Shortlink\Models;
use CodeIgniter\Model;

class ShortlinkModel extends Model
{
	public function __construct(){
        $this->config = parse_config( include realpath( __DIR__."/../Config.php" ) );
    }

    public function block_plans(){
        return [
            "tab" => 30,
            "position" => 500,
            "label" => __("Advanced features"),
            "items" => [
                [
                    "id" => $this->config['id'],
                    "name" => __("URL Shortener"),
                ]
            ]
        ];
    }

    public function block_settings($path = ""){
        return array(
            "position" => 9200,
            "menu" => view( 'Core\Shortlink\Views\settings\menu', [ 'config' => $this->config ] ),
            "content" => view( 'Core\Shortlink\Views\settings\content', [ 'config' => $this->config ] )
        );
    }

    public function block_profile_settings(){
        if (permission("shortlink") && get_option("shortlink_bitly_status")) {
            return array(
                "position" => 1000,
                "content" => view( 'Core\Shortlink\Views\settings', [ 'config' => $this->config ] )
            );
        }
    }

    public function add_script_to_footer(){
        return view( 'Core\Shortlink\Views\add_script_to_footer', [ 'config' => $this->config ] );
    }
}
