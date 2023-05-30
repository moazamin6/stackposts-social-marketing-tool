<?php
namespace Core\Facebook_post\Controllers;

class Facebook_post extends \CodeIgniter\Controller
{
    public function __construct(){
        $this->config = parse_config( include realpath( __DIR__."/../Config.php" ) );
    }
}