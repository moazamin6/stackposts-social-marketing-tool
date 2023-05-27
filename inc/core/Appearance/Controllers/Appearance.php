<?php
namespace Core\Appearance\Controllers;

class Appearance extends \CodeIgniter\Controller
{
    public function __construct(){
        $this->config = parse_config( include realpath( __DIR__."/../Config.php" ) );
    }
    
    public function index( $page = false ) {
        $data = [
            "title" => $this->config['name'],
            "desc" => $this->config['desc'],
            "content" => view('Core\Appearance\Views\empty')
        ];

        return view('Core\Appearance\Views\index', $data);
    }
}