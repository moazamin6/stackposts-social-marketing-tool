<?php
namespace Core\File_manager\Models;
use CodeIgniter\Model;

class File_managerModel extends Model
{
    public function __construct(){
        $this->config = parse_config( include realpath( __DIR__."/../Config.php" ) );
    }

    public function block_plans(){
        return [
            "tab" => 30,
            "position" => 1000,
            "label" => __("Advanced features"),
            "items" => [
                [
                    "id" => "file_manager_image_editor",
                    "name" => "Image editor",
                ],
            ]
        ];
    }

    public function block_permissions($path = ""){
        return view( 'Core\File_manager\Views\permissions', [ 'config' => $this->config ] );
    }

    public function block_settings($path = ""){
        return array(
            "position" => 9400,
            "menu" => view( 'Core\File_manager\Views\settings\menu', [ 'config' => $this->config ] ),
            "content" => view( 'Core\File_manager\Views\settings\content', [ 'config' => $this->config ] )
        );
    }

    public function get_files(){
        $filter = post("filter");
        $keyword = post("keyword");
        $folder = (int)post("folder");
        $page = (int)post("page");
        $team_id = (int)get_team("id");

        $db = \Config\Database::connect();
        $builder = $db->table(TB_FILES);

        $builder->select("*");
        $builder->where('team_id', $team_id);

        if( $folder && $folder != '' ){
            $builder->where('pid', $folder);
        }else{
            $builder->where('pid', 0);
        }

        if( $filter && $filter != '' ){
            $filter = explode(",", $filter);
            $filter[] = "folder";
            $builder->whereIn('detect', $filter);
        }

        if( $keyword && $keyword != '' ){
            $builder->like('name', $keyword);
        }

        $builder->orderBy("is_folder DESC, id DESC");
        $builder->limit(50, $page * 50);

        $query = $builder->get();
        $result = $query->getResult();
        $query->freeResult();
        return $result;
    }

    public function media_info(){

        $team_id = (int)get_team("id");

        $db = \Config\Database::connect();

        $total_file = 0;
        $builder = $db->table(TB_FILES);
        $builder->select("SUM(size) as size");
        $builder->where('team_id', $team_id);
        $query = $builder->get();
        $total_size = $query->getRow()->size;
        $query->freeResult();

        $builder = $db->table(TB_FILES);
        $builder->select(" SUM(size) as size, COUNT(id) as count, detect");
        $builder->where('team_id', $team_id);
        $builder->where('is_folder', 0);
        $builder->groupBy('detect');
        $query = $builder->get();
        $result = $query->getResult();
        $query->freeResult();

        if( !empty($result) ){
            foreach ($result as $key => $row) {
                $size = (int)$row->size;
                $total_file += $row->count;
                $result[$key]->size = $size;
                if( $total_size == 0 ){
                    $result[$key]->total_size = 0;
                    $result[$key]->percent = 0;
                }else{
                    $result[$key]->total_size = $total_size;
                    $result[$key]->percent = round(($size/$total_size)*100, 4);
                }
            }
        }

        $data = [
            "image" => [
                "size" => 0, 
                "count" => 0, 
                "percent" => 0
            ],
            "video" => [
                "size" => 0, 
                "count" => 0, 
                "percent" => 0
            ],
            "csv" => [
                "size" => 0, 
                "count" => 0, 
                "percent" => 0
            ],
            "pdf" => [
                "size" => 0, 
                "count" => 0, 
                "percent" => 0
            ],
            "doc" => [
                "size" => 0, 
                "count" => 0, 
                "percent" => 0
            ],
            "audio" => [
                "size" => 0, 
                "count" => 0, 
                "percent" => 0
            ],
            "other" => [
                "size" => 0, 
                "count" => 0, 
                "percent" => 0
            ]
        ];

        if( !empty($result) ){
            foreach ($result as $key => $row) {
                if( isset($data[$row->detect]) ){
                    $data[$row->detect]['size'] = $row->size;
                    $data[$row->detect]['count'] = $row->count;
                    $data[$row->detect]['percent'] = $row->percent;
                }
            }
        }

        return (object)[
            "total_size" => $total_size,
            "total_file" => $total_file,
            "info" => $data
        ];
    }

    public function get_list_files($files = [], $field = "file"){
        if(empty($files)){
            return false;
        }
        $team_id = (int)get_team("id");
        $db = \Config\Database::connect();

        $builder = $db->table(TB_FILES);
        $builder->select("*");
        $builder->where('team_id', $team_id);
        $builder->whereIn($field, $files);
        $query = $builder->get();
        $result = $query->getResult();
        $query->freeResult();

        return $result;
    }
}
