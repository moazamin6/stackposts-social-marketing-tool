<?php
namespace Core\Twitter_post\Controllers;

class Twitter_post extends \CodeIgniter\Controller
{
    public function __construct(){
        $this->config = parse_config( include realpath( __DIR__."/../Config.php" ) );
    }
}