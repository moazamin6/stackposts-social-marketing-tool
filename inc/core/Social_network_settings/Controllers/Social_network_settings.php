<?php
namespace Core\Social_network_settings\Controllers;

class Social_network_settings extends \CodeIgniter\Controller
{
    public function __construct(){
        $this->config = parse_config( include realpath( __DIR__."/../Config.php" ) );
    }
    
    public function index( $page = false ) {
        $block_social_settings = $this->request->block_social_settings;

        $data = [
            "title" => $this->config['name'],
            "desc" => $this->config['desc'],
            "blocks" => $block_social_settings
        ];

        if( isset($block_social_settings[$page]) && isset($block_social_settings[$page]) ){
            $data['content'] = view('Core\Social_network_settings\Views\content', [ 'block_tab' => $block_social_settings[$page] ]);
        }else{
            $data['content'] = view('Core\Social_network_settings\Views\empty');
        }

        return view('Core\Social_network_settings\Views\index', $data);
    }

    public function save(){
        $data = $this->request->getPost();

        if(is_array($data)){
            foreach ($data as $key => $value) {
                if($key != 'csrf'){
                    update_option( $key, trim( htmlspecialchars( $value ) ) );
                }
            }
        }

        ms([
            "status"  => "success",
            "message" => __('Success'),
        ]);
    }
}