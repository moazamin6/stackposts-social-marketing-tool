<?php
namespace Core\Social_pages\Controllers;

class Social_pages extends \CodeIgniter\Controller
{
    public function __construct(){
        $this->config = parse_config( include realpath( __DIR__."/../Config.php" ) );
    }
}