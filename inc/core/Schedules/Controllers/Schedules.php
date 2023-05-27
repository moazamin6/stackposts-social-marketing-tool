<?php
namespace Core\Schedules\Controllers;

class Schedules extends \CodeIgniter\Controller
{
    public function __construct(){
        $this->model = new \Core\Schedules\Models\SchedulesModel();
        $this->config = parse_config( include realpath( __DIR__."/../Config.php" ) );
    }
    
    public function index( $type = "", $social_network = "", $time = "" ) {
        if(!in_array($type, ["queue", "published", "unpublished"]) || $social_network == "") redirect_to( get_module_url("index/queue/all/") );

        $categories = $this->model->categories();
        $result = $this->model->list($type, $social_network, $time);

        $list_schedules = view('Core\Schedules\Views\list', ['result' => $result]);

        if(!is_ajax()){
            $data = [
                "title" => $this->config['name'],
                "desc" => $this->config['desc'],
                "config" => $this->config,
                "categories" => $categories,
                "content" => view('Core\Schedules\Views\calendar', ['result' => $result, 'list_schedules' => $list_schedules])
            ];

            return view('Core\Schedules\Views\index', $data);
        }else{
            return $list_schedules;
        }
    }

    public function get($type = "", $social_network = ""){

        $posts = $this->model->calendar($type, $social_network);

        if($posts)
        {
            $data = [];
            foreach ($posts as $key => $post)
            {
                $config = find_modules( $post->social_network."_post" );

                if($config)
                {
                    $module_name = $config['name'];
                    $module_icon = $config['icon'];
                    $module_color = $config['color'];

                    $data[] = [
                        "id" => 1,
                        "name" => "<i class='{$module_icon}'></i> {$module_name} ({$post->total})",
                        "startdate" => $post->time_posts,
                        "enddate" => $post->repost_untils,
                        "color" => "{$module_color}",
                    ];

                }

            }

            $data = [
                "monthly" => $data
            ];

            echo json_encode($data);

        }
        else
        {
            echo json_encode([ 'monthly' => [] ]);
        }

    }

    public function delete( $type ="single" ){
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