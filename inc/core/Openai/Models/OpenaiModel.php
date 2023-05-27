<?php
namespace Core\Openai\Models;
use CodeIgniter\Model;

class OpenaiModel extends Model
{
	public function __construct(){
        $this->config = parse_config( include realpath( __DIR__."/../Config.php" ) );
    }

    public function block_plans(){
        return [
            "tab" => 30,
            "position" => 900,
            "label" => __("Advanced features"),
            "items" => [
                [
                    "id" => "openai_content",
                    "name" => __("OpenAI Generate Content"),
                ],
                [
                    "id" => "openai_image",
                    "name" => __("OpenAI Generate Image"),
                ]
            ]
        ];
    }

    public function block_permissions($path = ""){
        return view( 'Core\Openai\Views\permissions', [ 'config' => $this->config ] );
    }

    public function block_settings($path = ""){
        return array(
            "position" => 9300,
            "menu" => view( 'Core\Openai\Views\settings\menu', [ 'config' => $this->config ] ),
            "content" => view( 'Core\Openai\Views\settings\content', [ 'config' => $this->config ] )
        );
    }
}
