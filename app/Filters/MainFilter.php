<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class MainFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {   
        if(DEMO){
            $url = current_url();
            if(is_ajax()){
                if(
                    strpos($url, "/remove_assign") ||
                    strpos($url, "/do_assign") ||
                    strpos($url, "/do_import") ||
                    strpos($url, "/do_") ||
                    strpos($url, "/upload") ||
                    strpos($url, "/delete") ||
                    strpos($url, "/status/") ||
                    strpos($url, "/save")

                ){
                    ms([
                        "status" => "error",
                        "message" => __("This feature disabled in demo version")
                    ]);
                }
            }else{
                if(
                    (strpos($url, "/export"))
                ){
                    redirect_to( base_url("dashboard") );
                }
            }
        }


        $module_paths = get_module_paths();

        if( !empty($module_paths) ){
            foreach ($module_paths as $key => $module_path) {
                $filter_file = $module_path . "/Filters/beforeFilter.php";
                if( file_exists( $filter_file ) ){
                    include_once $filter_file;
                }
            }
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        $module_paths = get_module_paths();

        if( !empty($module_paths) ){
            foreach ($module_paths as $key => $module_path) {
                $filter_file = $module_path . "/Filters/afterFilter.php";
                if( file_exists( $filter_file ) ){
                    include_once $filter_file;
                }
            }
        }
    }
}