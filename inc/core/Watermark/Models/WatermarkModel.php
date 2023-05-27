<?php
namespace Core\Watermark\Models;
use CodeIgniter\Model;

class WatermarkModel extends Model
{
	public function __construct(){
        $this->config = parse_config( include realpath( __DIR__."/../Config.php" ) );
    }

    public function block_profile_settings(){
        if (permission("watermark")) {
            return array(
                "position" => 1000,
                "content" => view( 'Core\Watermark\Views\settings', [ 'config' => $this->config ] )
            );
        }
    }

    public function block_plans(){
        return [
            "tab" => 30,
            "position" => 400,
            "label" => __("Advanced features"),
            "items" => [
                [
                    "id" => $this->config['menu']['sub_menu']['id'],
                    "name" => $this->config['menu']['sub_menu']['name'],
                ]
            ]
        ];
    }
}
