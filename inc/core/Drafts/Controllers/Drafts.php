<?php
namespace Core\Drafts\Controllers;

class Drafts extends \CodeIgniter\Controller
{
    public function __construct(){
        $this->config = parse_config( include realpath( __DIR__."/../Config.php" ) );
        $this->model = new \Core\Drafts\Models\DraftsModel();
    }
    
    public function index( $page = false ) {
        $total = $this->model->list("all", false);

        $datatable = [
            "total_items" => $total,
            "per_page" => 30,
            "current_page" => 1,

        ];

        $data_content = [
            'total' => $total,
            'datatable'  => $datatable,
            'config'  => $this->config,
        ];

        $data = [
            "title" => $this->config['name'],
            "desc" => $this->config['desc'],
            "content" => view('Core\Drafts\Views\list', $data_content)
        ];

        return view('Core\Drafts\Views\index', $data);
    }

    public function ajax_list(){
        $total_items = $this->model->list("all", false);
        $result = $this->model->list("all", true);
        $data = [
            "result" => $result,
            "config" => $this->config
        ];
        ms( [
            "total_items" => $total_items,
            "data" => view('Core\Drafts\Views\ajax_list', $data)
        ] );
    }

    public function delete( $type ="queue" ){
        $team_id = get_team("id");
        switch ($type) {
            case 'multi':
                
                $type = post("type");
                $social_network = post("social_network");

                switch ($type) {
                    case 'queue':
                        $status = 1;
                        break;

                    case 'published':
                        $status = 3;
                        break;

                    case 'unpublished':
                        $status = 4;
                        break;
                    
                    default:
                        ms([
                            "status" => "error",
                            "message" => __("Delete failed")
                        ]);
                        break;
                }

                $data = [ "team_id" => $team_id, "status" => $status ];
                if($social_network != "all"){
                    $data["social_network"] = $social_network;
                }
                db_delete( TB_POSTS, $data );

                ms([
                    "status" => "success",
                    "message" => __("Success")
                ]);
                break;
            
            default:
                $ids = post("id");
                db_delete( TB_POSTS,  [ "ids" => $ids, "team_id" => $team_id ]);
                ms([
                    "status" => "success",
                    "message" => __("Success")
                ]);
                break;
        }

    }
}