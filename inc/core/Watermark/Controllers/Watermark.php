<?php
namespace Core\Watermark\Controllers;

class Watermark extends \CodeIgniter\Controller
{
    public function __construct(){
        $this->config = parse_config( include realpath( __DIR__."/../Config.php" ) );
    }
    
    public function index( $ids = '' ) {
        $team_id = get_team("id");
        $accounts = db_fetch("*", TB_ACCOUNTS, [ 'team_id' => $team_id ], "social_network, category", "ASC");
        permission_accounts($accounts);

        $result = [
            "ids" => "",
            "watermark_size" => get_team_data("watermark_size", 30),
            "watermark_opacity" => get_team_data("watermark_opacity", 70),
            "watermark_position" => get_team_data("watermark_position", "lb"),
            "watermark_mask" => get_team_data("watermark_mask", "")
        ];

        if($ids != ""){

            $account = db_get("*", TB_ACCOUNTS, [ "team_id" => $team_id, "ids" => $ids ]);

            if(empty($account)) redirect_to( get_module_url() );

            $watermark_size = _gm("watermark_size", "", $account->id)?_gm("watermark_size", "", $account->id):get_team_data("watermark_size", 30);
            $watermark_opacity = _gm("watermark_opacity", "", $account->id)?_gm("watermark_opacity", "", $account->id):get_team_data("watermark_opacity", 70);
            $watermark_position = _gm("watermark_position", "", $account->id)?_gm("watermark_position", "", $account->id):get_team_data("watermark_position", "lb");
            $watermark_mask = _gm("watermark_mask", "", $account->id)?_gm("watermark_mask", "", $account->id):get_team_data("watermark_mask", "");

            $result = [
                "ids" => $account->ids,
                "watermark_size" => $watermark_size,
                "watermark_opacity" => $watermark_opacity,
                "watermark_position" => $watermark_position,
                "watermark_mask" => $watermark_mask
            ];
    
        }

        $data = [
            "accounts" => $accounts,
            "title" => $this->config['menu']['sub_menu']['name'],
            "desc" => $this->config['desc'],
            "config" => $this->config,
            "content" => view('Core\Watermark\Views\content',[
                "title" => $this->config['menu']['sub_menu']['name'], 
                "result" => (object)$result,
                "config" => $this->config
            ])
        ];

        return view('Core\Watermark\Views\index', $data);
    }

    public function save_status(){

        $watermark_status = (int)post("watermark_status");
        update_team_data("watermark_status", $watermark_status);

        ms([
            "status" => "success",
            "message" => __("Success")
        ]);
    }

    public function upload_files($id = ""){
        $team_id = get_team("id");
        $folder = (int)post("folder");
        $imagefile = $this->request->getFiles();

        $ids = post("ids");
        $size = post("size");
        $opacity = post("opacity");
        $position = post("position");
        $max_size = 5*1024;
        $mask = "";

        if(!empty($_FILES) && is_array($_FILES['files']['name'])){
            if(empty($imagefile)){
                return false;
            }

            $check_mime = $this->validate([
                'files' => [
                    'uploaded[files]',
                    'ext_in[files,jpeg,gif,png,jpg]'
                ],
            ]);

            if(!$check_mime){
                ms([
                    "status" => "error",
                    "message" => "The filetype you are attempting to upload is not allowed"
                ]);
            }

            $check_size = $this->validate([
                'files' => [
                    'uploaded[files]',
                    'max_size[files,'.$max_size.']'
                ],
            ]);

            if(!$check_size){
                ms([
                    "status" => "error",
                    "message" => __( sprintf("Unable to upload a file larger than %sMB", $maxsize) )
                ]);
            }

            if ($imagefile = $this->request->getFiles()) {
                if( isset( $imagefile['files'] ) ){
                    foreach($imagefile['files'] as $img) {
                        if ($img->isValid() && ! $img->hasMoved()) {
                            $newName = $img->getRandomName();
                            $img->move(WRITEPATH.'uploads', $newName);
                            $file_path = WRITEPATH.'uploads/'.$newName;
                            $file_type = mime2ext( $img->getClientMimeType() );
                            $detect = detect_file_type( $file_type );
                                
                            //IMAGE INFO
                            $img_info = getimagesize(WRITEPATH.'uploads/'.$img->getName());
                            $is_image = (int)is_image( $file_path );
                            $img_width = 0;
                            $img_height = 0;
                            if(!empty($img_info)){
                                $img_width = $img_info[0];
                                $img_height = $img_info[1];
                            }
                        }

                        $mask = str_replace( WRITEPATH, "", $file_path);
                    }
                }
            }
        }

        if(!$ids || $ids == ""){
            update_team_data("watermark_size", $size);
            update_team_data("watermark_opacity", $opacity);
            update_team_data("watermark_position", $position);
            if($mask != ""){
                @unlink( get_team_data("watermark_mask", "") );
                update_team_data("watermark_mask", $mask);
            }
        }else{
            $account = db_get("*", TB_ACCOUNTS, [ "ids" => $ids ]);

            if(!$account){
                ms([
                    "status"  => "error",
                    "message" => __("Cannot find the profile")
                ]);
            }

            _um("watermark_size", $size, $account->id);
            _um("watermark_opacity", $opacity, $account->id);
            _um("watermark_position", $position, $account->id);
            
            if($mask != ""){
                if( _gm("watermark_mask", "", $account->id) ){
                    @unlink( _gm("watermark_mask", "", $account->id) );
                }

                _um("watermark_mask", $mask, $account->id);
            }

        }

        ms([
            "status" => "success",
            "message" => __("Success"),
            "mask" => get_file_url($mask)
        ]);
    }

    public function delete(){
        $ids = post("id");
        if(!$ids || $ids == ""){
            update_team_data("watermark_size", 30);
            update_team_data("watermark_opacity", 70);
            update_team_data("watermark_position", "lb");
            @unlink( get_team_data("watermark_mask", "") );
            update_team_data("watermark_mask", "");
        }else{
            $account = db_get("*", TB_ACCOUNTS, ['ids' => $ids]);

            if(!$account){
                ms([
                    "status"  => "error",
                    "message" => __("Cannot find the profile")
                ]);
            }

            _um("watermark_size", "", $account->id);
            _um("watermark_opacity", "", $account->id);
            _um("watermark_position", "", $account->id);

            if( _gm("watermark_mask", "", $account->id) ){
                @unlink( _gm("watermark_mask", "", $account->id) );
            }

            _um("watermark_mask", "", $account->id);
        }

        ms([
            "status" => "success",
            "message" => __("Success")
        ]);
    }
}