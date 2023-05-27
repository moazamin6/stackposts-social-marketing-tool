<?php
if(uri('segment',1) == "mail"){
    $templates = [];
    $view_paths = FCPATH."inc/core/Mail/Views/Template/";
    $view_files = glob( $view_paths . '*' );

    if ( !empty( $view_files ) )
    {
        foreach ( $view_files as $view_file )
        {
            $view_file_arr = explode("/", $view_file);
            $name = end($view_file_arr);

            $thumbnail = $module_path."Assets/img/thumbnail.jpg";
            if( file_exists($view_file."/thumbnail.jpg") ){
                $thumbnail = $view_file."/thumbnail.jpg";
                $thumbnail = str_replace(FCPATH, "", $thumbnail);
                $thumbnail = base_url($thumbnail);
            }

            $templates[] = [
                "name" => $name,
                "thumbnail" => $thumbnail
            ];
        }
    }

    $request->block_mail_templates = $templates;
}