<?php
namespace Core\Post\Controllers;

class Post extends \CodeIgniter\Controller
{
    public function __construct(){
        $this->config = parse_config( include realpath( __DIR__."/../Config.php" ) );
        $this->model = new \Core\Post\Models\PostModel();
        $this->account_manager_model = new \Core\Account_manager\Models\Account_managerModel();
    }
    
    public function index( $page = false ) {
        $post_id = get("post_id");
        $team_id = get_team("id");

        $post = db_get( "*", TB_POSTS, [ "ids" => $post_id, "team_id" => $team_id ] );

        $request = \Config\Services::request();
        $data = [
            "title" => $this->config['name'],
            "desc" => $this->config['desc'],
            "config" => $this->config,
            "post" => json_encode($post),
            "content" => view('Core\Post\Views\composer', ['frame_posts' => $request->block_frame_posts, "post" => $post ])
        ];

        return view('Core\Post\Views\index', $data);
    }

    public function url_info(){
        $url = post("url");
        validate("link", "", $url);
        $info = get_link_info($url);
        return ms([
            "status" => "success",
            "data" => $info
        ]);
    }

    public function save($skip_validate = false){
        $list_data = [];
        $team_id = get_team("id");
        $accounts = post("accounts");
        $type = post("type");
        $medias = post("medias");
        $advance_options = post("advance_options");
        $post_by = post("post_by");
        $time_now = time();
        $time_post = (int)timestamp_sql( post("time_post") );
        $interval_per_post = (int)post("interval_per_post");
        $repost_frequency = (int)post("repost_frequency");
        $repost_until = (int)timestamp_sql( post("repost_until") );
        $time_posts = post("time_posts");
        $caption = post("caption");
        $link = post("link");

        validate('empty', __('Please select at least a profile'), $accounts);

        switch ($type) {
            case "media":
                validate('empty', __('Please select at least one media'), $medias);
                break;

            case "link":
                validate('null', __('Link'), $link);
                validate('link', '', $link);
                break;
            
            default:
                $type = "text";
                validate('null', __('Caption'), $caption);
                break;
        }

        $postData = [
            "caption" => $caption,
            "link" => $link,
            "medias" => $medias,
            "advance_options" => $advance_options,
        ];

        $data = [
            "team_id" => $team_id,
            "function" => "post",
            "type" => $type,
            "data" => json_encode($postData),
            "time_post" => 0,
            "delay" => $interval_per_post,
            "repost_frequency" => $repost_frequency,
            "repost_until" => $repost_frequency == 0?NULL:$repost_until,
            "result" => "",
            "status" => 1,
            "changed" => time(),
            "created" => time(),
        ];

        switch ($post_by) {
            case 2:
                validate('null', __('Time post'), $time_post);
                validate('repost_frequency', __('Repost frequency'), $repost_frequency, 0);
                validate('min_number', __('Interval per post'), $interval_per_post, 1);

                 if($time_post <= $time_now){
                    ms([
                        "status" => "error",
                        "message" => __("Time post must be greater than current time")
                    ]);
                }

                if($repost_frequency > 0 && $time_post > $repost_until){
                    ms([
                        "status" => "error",
                        "message" => __("Time post must be smaller than repost until")
                    ]);
                }

                if($repost_frequency > 0)
                {
                    validate('null', __('Repost until'), $repost_until);
                }

                $data['time_post'] = $time_post;
                break;

            case 3:
                validate('empty', __('Please select at least a time post'), $time_posts);
                $time_posts = array_unique($time_posts);
                $data['repost_frequency'] = 0;
                $data['repost_until'] = NULL;
                $data['delay'] = 0;
                break;

            case 4:
                $data['status'] = 0;
                $data['delay'] = 5;
                $data['time_post'] = NULL;
                $data['repost_until'] = NULL;
                break;
            
            default:
                $data['time_post'] = $time_now;
                break;
        }

        $list_accounts = $this->account_manager_model->get_accounts_by( $accounts );

        if(empty($list_accounts)){
            validate('empty', __('Accounts selected is inactive. Let re-login and try again'), $list_accounts);
        }

        foreach ($list_accounts as $key => $value) {
            $ids = post("ids")?post("ids"):ids();
            $data['ids'] = $ids;
            $data['account_id'] = $value->id;
            $data['social_network'] = $value->social_network;
            $data['category'] = $value->category;
            $data['api_type'] = $value->login_type;
            
            if($post_by == 3){
                foreach ($time_posts as $time) {
                    $data['time_post'] = (int)timestamp_sql( $time );
                    $list_data[] = (object)$data;
                }

            }else{
                $list_data[] = (object)$data;
            }
        }

        $validator = $this->model->validator($list_data);

        $social_can_post = json_decode($validator["can_post"]);
        if( ($skip_validate && !empty($social_can_post)) || $validator["status"] == "success" ){
            $result = $this->model->post($list_data, $social_can_post);
            ms($result);
        }

        ms($validator);
    }

    public function report(){
        $team_id = get_team("id");
        $social_network = post("social_network");
        $configs = get_blocks("block_frame_posts", false, true);
        $items = [];
        if( ! empty($configs) ){
            $items = $configs;
            if( count($items) >= 2 ){
                usort($items, function($a, $b) {
                    if( isset($a['data']['position']) &&  isset($b['data']['position']) )
                        return $a['data']['position'] <=> $b['data']['position'];
                });
            }
        }

        $total_succeed = 0;
        $total_failed = 0;
        $total_media_succeed = 0;
        $total_link_succeed = 0;
        $total_text_succeed = 0;
        if(!empty($items)){
            foreach ($items as $key => $value) {

                if($social_network != "all"){
                    if($value["parent"]["id"] == $social_network){
                        $total_succeed += get_team_data($value["id"]."_success_count", 0, $team_id);
                        $total_failed += get_team_data($value["id"]."_error_count", 0, $team_id);
                        $total_media_succeed += get_team_data($value["id"]."_media_count", 0, $team_id);
                        $total_link_succeed += get_team_data($value["id"]."_link_count", 0, $team_id);
                        $total_text_succeed += get_team_data($value["id"]."_text_count", 0, $team_id);
                    }
                }else{
                    $total_succeed += get_team_data($value["id"]."_success_count", 0, $team_id);
                    $total_failed += get_team_data($value["id"]."_error_count", 0, $team_id);
                    $total_media_succeed += get_team_data($value["id"]."_media_count", 0, $team_id);
                    $total_link_succeed += get_team_data($value["id"]."_link_count", 0, $team_id);
                    $total_text_succeed += get_team_data($value["id"]."_text_count", 0, $team_id);
                }
            }
        }

        $total_post_type = $total_media_succeed + $total_link_succeed + $total_text_succeed;

        if($total_post_type > 0){
            $percent_media_succeed = round($total_media_succeed/$total_post_type*100);
            $percent_link_succeed = round($total_link_succeed/$total_post_type*100);
            $percent_text_succeed = round($total_text_succeed/$total_post_type*100);
        }else{
            $percent_media_succeed = 0;
            $percent_link_succeed = 0;
            $percent_text_succeed = 0;
        }

        $total_post = $total_succeed + $total_failed;
        $post_succeed = $this->model->get_report_by_status(3);
        $post_failed = $this->model->get_report_by_status(4);

        //
        $recent_posts = $this->model->get_recent_posts();

        $data = [
            "total_media_succeed" => $total_media_succeed,
            "total_link_succeed" => $total_link_succeed,
            "total_text_succeed" => $total_text_succeed,
            "percent_media_succeed" => $percent_media_succeed,
            "percent_link_succeed" => $percent_link_succeed,
            "percent_text_succeed" => $percent_text_succeed,
            "total_succeed" => $total_succeed,
            "total_failed" => $total_failed,
            "total_post" => $total_post,
            "recent_posts" => $recent_posts,
            "date" => $post_succeed["date"],
            "post_succeed" => $post_succeed["value"],
            "post_failed" => $post_failed["value"],
        ];
        return view( 'Core\Post\Views\insights', $data );
    }

    public function cron()
    {
        $posts = $this->model->get_posts();

        if(!$posts){ 
            _ec("Empty schedule");
            exit(0);
        }

        foreach ($posts as $post) {

            db_update( TB_POSTS, [
                "status" => 4,
                "result" => json_encode([ "message" => __("Unknow error") ])
            ], ["id" => $post->id]);

            $list_data = [$post];
            $validator = $this->model->validator($list_data);
            $social_can_post = json_decode($validator["can_post"]);
            if( !empty($social_can_post) || $validator["status"] == "success" ){
                $result = $this->model->post($list_data, $social_can_post);
                _ec( strtoupper( __( ucfirst($result['status']) ) ).": ".__( $result['message']) . "<br/>" , false);
            }
        }

    }
}