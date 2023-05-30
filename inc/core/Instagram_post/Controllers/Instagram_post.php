<?php
namespace Core\Instagram_post\Controllers;

class Instagram_post extends \CodeIgniter\Controller
{
    public function __construct(){
        $this->config = parse_config( include realpath( __DIR__."/../Config.php" ) );
    }
}