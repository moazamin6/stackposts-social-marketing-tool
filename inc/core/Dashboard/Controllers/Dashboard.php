<?php
namespace Core\Dashboard\Controllers;

class Dashboard extends \CodeIgniter\Controller
{
    public function __construct(){
        $this->config = parse_config( include realpath( __DIR__."/../Config.php" ) );
    }
    
    public function index( $page = false ) {
        $configs = get_blocks("block_dashboard", false, true);
        $items = [];

        if( ! empty($configs) ){
            $items = $configs;
            if( count($items) >= 2 ){
                usort($items, function($a, $b) {
                    if( isset($a['data']['position']) &&  isset($b['data']['position']) )
                        return $a['data']['position'] <=> $b['data']['position'];
                });
            }
        }

        $data = [
            "title" => $this->config['name'],
            "desc" => $this->config['desc'],
            "content" => view('Core\Dashboard\Views\content', ['result' => $items])
        ];

        return view('Core\Dashboard\Views\index', $data);
    }
}