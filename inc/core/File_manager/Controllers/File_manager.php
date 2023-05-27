<?php
namespace Core\File_manager\Controllers;

class File_manager extends \CodeIgniter\Controller
{
    public function __construct(){
        $this->config = parse_config( include realpath( __DIR__."/../Config.php" ) );
        $this->model = new \Core\File_manager\Models\File_managerModel();
        $this->extensions = get_option("fm_allow_extensions", "jpeg,gif,png,jpg,mp4,csv,pdf,mp3");
        $this->max_size = (int)permission("max_file_size")*1024;
        $this->max_storage = (int)permission("max_storage_size");

        if( !permission("file_manager_photo") || !permission("file_manager_video") || !permission("file_manager_other_type")  ){
            $accept_extensions = [];

            if( permission("file_manager_photo")){
                $accept_extensions = array_merge($accept_extensions, explode(",", "jpeg,gif,png,jpg"));
            }

            if( permission("file_manager_video")){
                $accept_extensions = array_merge($accept_extensions, explode(",", "mp4"));
            }

            if( permission("file_manager_other_type")){
                if ($this->extensions != "") {
                    $remove_extensions = ['jpeg','gif','png','jpg','mp4'];
                    $extensions = explode(",", $this->extensions);
                    for ($i=0; $i <= count($extensions); $i++) { 
                        if( in_array($extensions[$i], $remove_extensions) ){
                            unset($extensions[$i]);
                        }
                    }

                    $accept_extensions = array_merge($accept_extensions, $extensions);
                }
            }

            $this->extensions = implode(",", $accept_extensions);
        }
    }
    
    public function index( $page = false ) {
        $media_info = $this->model->media_info();
        $data = [
            "id" => $this->config['id'],
            "title" => $this->config['name'],
            "desc" => $this->config['desc'],
            "total_size" => $media_info->total_size,
            "total_file" => $media_info->total_file,
            "media_info" => $media_info->info,
            "max_storage" => $this->max_storage,
            "content" => view('Core\File_manager\Views\content')
        ];

        return view('Core\File_manager\Views\index', $data);
    }

    public function editor($ids = ""){
        $team_id = get_team("id");
        $media = db_get("*", TB_FILES, ["ids" => $ids, "team_id" => $team_id, "is_image" => 1]);
        
        if(!$media) exit;

        $data = array(
            "image" => get_file_url($media->file)
        );

        return view('Core\File_manager\Views\editor', $data);
    }

    public function widget( $params = [] ){
        return view('Core\File_manager\Views\widget', []);
    }

    public function selected( $params = [] ){
        return view('Core\File_manager\Views\selected', []);
    }

    public function mini( $params = [] ){
        $type = "all";
        $select_multi = 1;

        if(isset($params['type'])){
            $type = $params['type'];
        }

        if(isset($params['select_multi'])){
            $select_multi = $params['select_multi'];
        }

        return view('Core\File_manager\Views\mini', ["type" => $type, "select_multi" => $select_multi]);
    }

    public function popup($type = "", $select = 0, $id = "") {
        $data = [
            "type" => $type,
            "select" => $select,
            "id" => $id,
        ];
        return view('Core\File_manager\Views\popup', $data);
    }

    public function media_info() {
        $team_id = get_team("id");
        $ids = uri('segment', 3);

        $media_item = db_get("*", TB_FILES, "ids = '{$ids}' AND team_id = {$team_id}");

        $data = [
            "result" => $media_item
        ];
        return view('Core\File_manager\Views\media_info', $data);
    }

    public function onedrive() {}

    public function upload_files(){
        $team_id = get_team("id");
        $folder = (int)post("folder");
        $imagefile = $this->request->getFiles();

        if(empty($imagefile)){
            return false;
        }

        $check_mime = $this->validate([
            'files' => [
                'uploaded[files]',
                'ext_in[files,'.$this->extensions.']'
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
                'max_size[files,'.$this->max_size.']'
            ],
        ]);

        if(!$check_size){
            ms([
                "status" => "error",
                "message" => __( sprintf("Unable to upload a file larger than %sMB", $this->max_size/1024) )
            ]);
        }

        if ($imagefile = $this->request->getFiles()) {
            if( isset( $imagefile['files'] ) ){
                foreach($imagefile['files'] as $img) {

                    $db = \Config\Database::connect();
                    $storage = (float)$db->table(TB_FILES)->selectSum("size")->where("team_id", $team_id)->get()->getRow()->size;
                    if( $this->max_storage*1024 < $storage/1024 + $img->getSize()/1024 ){
                        ms([
                            'status' => 'error',
                            'message' => sprintf( __( 'You have exceeded the storage quota allowed is %sMB' ), $this->max_storage )
                        ]);
                    }

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
                        
                        db_insert(TB_FILES , [
                            "ids" => ids(),
                            "team_id" => $team_id,
                            "is_folder" => 0,
                            "pid" => $folder,
                            "name" => $img->getClientName(),
                            "file" => str_replace( WRITEPATH, "", $file_path),
                            "type" => $img->getClientMimeType(),
                            "extension" => $file_type,
                            "detect" => $detect,
                            "size" => $img->getSize(),
                            "is_image" => $is_image,
                            "width" => (int)$img_width,
                            "height" => (int)$img_height,
                            "created" => time()
                        ]);
                    }
                }
            }
        }

        ms([
            "status" => "success",
            "file" => str_replace( WRITEPATH, "", $file_path),
            "message" => ""
        ]);
    }

    public function save_files(){
        $url = post("url");
        $tmp_file = "";

        if( stripos($url, "data:image") !== FALSE ){
            list($dataType, $imageData) = explode(';', $url);

            $imageExtension = explode('/', $dataType)[1];
            $tmp_file = TMPPATH( uniqid().".".$imageExtension );
            list(, $encodedImageData) = explode(',', $imageData);
            $decodedImageData = base64_decode($encodedImageData);
            file_put_contents($tmp_file, $decodedImageData);
            $url = get_tmp_url($tmp_file);
        }

        $folder = (int)post("folder");
        $team_id = get_team("id");
       
        if (!$this->validate([
            'url' => 'required'
        ])) {
            ms([
                "status" => "error",
                "message" => __("Url is required")
            ]);
        }

        $headers = get_header($url);
        if(!$headers){
            ms([
                "status" => "error",
                "message" => __("Couldn't find the media")
            ]);
        }

        $headers = array_change_key_case($headers, CASE_LOWER);

        if( !isset( $headers['content-type'] ) ){
            ms([
                "status" => "error",
                "message" => __("Couldn't get file type")
            ]);
        }

        $mime = !is_array($headers['content-type'])?$headers['content-type']:end($headers['content-type']);
        $size = !is_array($headers['content-length'])?$headers['content-length']:end($headers['content-length']);
        $ext = mime2ext( $mime );
        $allow_extensions = explode(",", $this->extensions);
        $detect = detect_file_type( $ext );

        if( !in_array( $ext, $allow_extensions) ){
            ms([
                "status" => "error",
                "message" => __("The filetype you are attempting to upload is not allowed")
            ]);
        }

        if( $size/1024 > $this->max_size ){
            ms([
                "status" => "error",
                "message" => __( sprintf("Unable to upload a file larger than %sMB", $this->max_size) )
            ]);

        }

        $db = \Config\Database::connect();
        $storage = (float)$db->table(TB_FILES)->selectSum("size")->where("team_id", $team_id)->get()->getRow()->size;

        if( $this->max_storage*1024 < $storage/1024 + $size/1024 ){
            ms([
                'status' => 'error',
                'message' => sprintf( __( 'You have exceeded the storage quota allowed is %sMB' ), $this->max_storage )
            ]);
        }

        $file_path = save_file($url);
        $img_info = getimagesize(WRITEPATH."/".$file_path);
        $is_image = (int)is_image( WRITEPATH."/".$file_path );
        $img_width = 0;
        $img_height = 0;
        if(!empty($img_info)){
            $img_width = $img_info[0];
            $img_height = $img_info[1];
        }

        db_insert(TB_FILES , [
            "ids" => ids(),
            "team_id" => $team_id,
            "is_folder" => 0,
            "pid" => $folder,
            "name" => str_replace( "uploads/", "", $file_path),
            "file" => $file_path,
            "type" => $mime,
            "extension" => $ext,
            "detect" => $detect,
            "size" => $size,
            "is_image" => $is_image,
            "width" => (int)$img_width,
            "height" => (int)$img_height,
            "created" => time()
        ]);

        if($tmp_file != "" && file_exists($tmp_file)){
            unlink($tmp_file);
        }

        ms([
            "status" => "success",
            "file" => $file_path,
            "message" => ""
        ]);
    }

    public function new_folder(){
        $name = post("name");
        $team_id = get_team("id");
        $validation =  \Config\Services::validation();

        if (!$this->validate([
            'name' => 'required'
        ])) {
            ms([
                "status" => "error",
                "message" => __("Folder name is required")
            ]);
        }

        db_insert(TB_FILES , [
            "ids" => ids(),
            "team_id" => $team_id,
            "is_folder" => 1,
            "name" => $name,
            "file" => NULL,
            "type" => NULL,
            "extension" => NULL,
            "detect" => "folder",
            "size" => NULL,
            "is_image" => NULL,
            "width" => NULL,
            "height" => NULL,
            "created" => time()
        ]);

        ms([
            "status" => "success",
            "message" => __("Create new folder successfull")
        ]);
    }

    public function load_files($widget = false){
        $result = $this->model->get_files();
        if(post('page') != 0 && empty($result)) return false;
        $data = [
            'result' => $result,
            'page' => (int)post('page'),
            'folder' => (int)post('folder'),
            'widget' => $widget,
        ];
        
        switch ($widget) {
            case 'widget':
                return view('Core\File_manager\Views\widget_load_files', $data);
                break;
            
            default:
                return view('Core\File_manager\Views\load_files', $data);
        }
    }

    public function load_selected_files($files = []){
        $medias = post("medias");
        $result = $this->model->get_list_files($medias);
        $data = [
            "result" => $result
        ];
        return view('Core\File_manager\Views\load_selected_files', $data);
    }

    public function save_caption(){
        $team_id = get_team("id");
        $ids = uri('segment', 3);
        $note = post('caption');

        db_update(TB_FILES, ["note" => $note], ["team_id" => $team_id, "ids" => $ids]);

        ms([
            "status" => "success",
            "message" => __("Updated caption")
        ]);
    }

    public function google_drive(){
        return view('Core\File_manager\Views\google_drive');
    }

    public function adobe($params = []){
        if(isset( $params['button'] ) && $params['button']){
            $button = true;
        }else{
            $button = false;
        }

        return view('Core\File_manager\Views\adobe', ["button" => $button]);
    }

    public function delete($ids = ""){
        if($ids == ""){
            $ids = post('ids');
        }

        if( empty($ids) ){
            ms([
                "status" => "error",
                "message" => __('Please select an item to delete')
            ]);
        }

        if( is_array($ids) ){
            foreach ($ids as $id) {
                $item = db_get("id,ids,is_folder,file", TB_FILES, ['ids' => $id]);

                if(!empty($item)){
                    if($item->is_folder == 0){
                        $this->delete_file($item->file);
                    }else{
                        $files = db_fetch("id,ids,is_folder,file", TB_FILES, ['pid' => $item->id]);
                        if(!empty($files)){
                            foreach ($files as $key => $value) {
                                $this->delete_file($value->file);
                            }
                        }
                        db_delete(TB_FILES, ['pid' => $item->id]);
                    }
                }

                db_delete(TB_FILES, ['ids' => $id]);
            }
        }
        elseif( is_string($ids) )
        {
            $item = db_get("id,ids,is_folder", TB_FILES, ['ids' => $ids]);
            if(!empty($item)){
                if($item->is_folder == 0){
                    $this->delete_file($item->file);
                }else{
                    $files = db_fetch("id,ids,is_folder,file", TB_FILES, ['pid' => $item->id]);
                    if(!empty($files)){
                        foreach ($files as $key => $value) {
                            $this->delete_file($value->file);
                        }
                    }
                    db_delete(TB_FILES, ['pid' => $item->id]);
                }
            }

            db_delete(TB_FILES, ['ids' => $ids]);
        }

        ms([
            "status" => "success",
            "message" => __('Success')
        ]);
    }

    public function delete_file($file_path){
        $file = get_file_path($file_path);

        $file_name = explode("uploads/", $file);
        if( count($file_name) > 1 ){
            $file_name = end( $file_name );
        }else{
            $file_name = md5( $file_path );
        }

        $file_tmp = TMPPATH("thumb/".$file_name);

        if( file_exists($file) ) unlink($file);
        if( file_exists($file_tmp) ) unlink($file_tmp);
    }
}