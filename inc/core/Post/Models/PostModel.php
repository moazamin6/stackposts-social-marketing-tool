<?php
namespace Core\Post\Models;
use CodeIgniter\Model;

class PostModel extends Model
{
    public function __construct(){
        $this->config = parse_config( include realpath( __DIR__."/../Config.php" ) );
    }

    public function block_permissions($path = ""){
    	$items = get_blocks("block_frame_posts", false);
        return [
        	"items" => $items,
        	"html" =>  view( 'Core\Post\Views\permissions', [ 'config' => $this->config, "items" => $items ] )
        ];
    }

    public function block_dashboard($path = ""){
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

        return [
        	"items" => $items,
        	"position" => 3000,
        	"html" =>  view( 'Core\Post\Views\report', [ 'config' => $this->config, "result" => $items ] )
        ];
    }

    public function validator($posts){
    	$models = $this->post_models("post_validator");
		$errors = [];
		$social_post = [];
		$have_errors = false;
		$can_post = false;
		$html_errors = "";
		$count_errors = 0;
		$social_can_posts = [];
		$configs = [];

		foreach ($posts as $key => $post)
		{
			if(isset( $models[ $post->social_network ] )){
				$model = $models[ $post->social_network ];
				$result = $model->post_validator($post);

				if(!empty($result)){
					$errors[ $post->social_network ] = $result;
					$social_post[] = ucfirst( $post->social_network ); 
				}else{
					$errors[ $post->social_network ] = [];
					$social_post[] = ucfirst( $post->social_network );
				}
			}else{
				$errors[ $post->social_network ] = [];
				$social_post[] = ucfirst( $post->social_network );
			}
		}

		if(!empty($errors)){
			foreach ($errors as $social => $sub_errors) {
				if(empty($sub_errors)){
					$can_post = true;
					$social_can_posts[] = $social;
				}else{
					$have_errors = true;

					foreach ($sub_errors as $key => $error) {
						$html_errors .= "<li>{$error}</li>";
					}
					$count_errors++;
				}
			}
		}

		$html_errors = "<p>".sprintf( __("%d profiles will be excluded from your publication in next step due to errors"),  $count_errors)." </p><ul>".$html_errors."</ul>";

		$message = "";
		$status = "";
		if(!$have_errors){
			$status = "success";
		}else{
			if($can_post){
				$status = "warning";
			}else{
				if( $count_errors == 1 ){
					$status = "error";
					$error = end( $errors );
					$error = is_array($error)?$error[0]:$error;
					$message = __($error);
				}else{
					$social_post = array_unique($social_post);
					$status = "error";
					$message = sprintf( __("Missing content on the following social networks: %s"),  implode(", ", $social_post) );
				}

			}
		}

		return array(
			"status"   => $status,
			"errors"   => $html_errors,
			"message"  => $message,
			"can_post" => json_encode($social_can_posts) 
		);
    }

    public function post( $posts, $social_can_post = false ){
    	$team_id = get_team("id");
    	$post_by = post("post_by");
    	$models = $this->post_models("post_handler");

    	$post_id = 0;
    	$count_error = 0;
		$count_success = 0;
		$count_schedule = 0; 
		$message = ""; 

		validate('empty', __('Accounts selected is inactive. Let re-login and try again'), $posts);

    	foreach ($posts as $key => $post)
		{
			$tmp_post = (array)$post;

			if( isset( $post->team_id ) )
			{
				$team_id = $post->team_id;
			}

			$social_network = $post->social_network;
			if( (is_array($social_can_post) && in_array($social_network, $social_can_post)) || !$social_can_post)
			{
				if( isset( $models[ $social_network ] ) )
				{
					$model = $models[ $social_network ];
					if(!post("ids") || post("draft"))
					{
						if( isset($post->id) && !post("draft") ){
							$post_id = $post->id;
						}

						$account = db_get("*", TB_ACCOUNTS, ["id" => $post->account_id ]);
						if(empty($account))
						{
							$count_error++;
							$message = __("This profile not exist");

							//Update
							if( post("ids") )
							{
								$post->status = 4;
								$post->result = json_encode([
									"message" => $message
								]);
								db_update(TB_POSTS, $result, [ "id" => $post_id ]);
							}
						}else{
							if($post_by == 1 || isset($post->id))
							{

								$post->account = $account;
								$response = $model->post_handler($post);

								if( $response['status'] == "success" )
								{
									$count_success++;
									$message = $response["message"];
									$post->status = 3;
									$post->result = json_encode([
										"id" => $response["id"],
										"url" => $response["url"],
										"message" => $response["message"]
									]);

									update_team_data($social_network."_post_success_count", get_team_data($social_network."_post_success_count", 0, $team_id) + 1, $team_id);
									update_team_data($social_network."_post_count", get_team_data($social_network."_post_count", 0, $team_id) + 1, $team_id);
									update_team_data($social_network."_post_". $response["type"] ."_count", get_team_data($social_network."_post_". $response["type"] ."_count", 0, $team_id) + 1, $team_id);
								}
								else
								{
									$count_error++;
									$message = $response["message"];

									$post->status = 4;
									$post->result = json_encode([
										"message" => $response["message"]
									]); 

									update_team_data($social_network."_post_error_count", get_team_data($social_network."_post_error_count", 0, $team_id) + 1, $team_id);
									update_team_data($social_network."_post_count", get_team_data($social_network."_post_count", 0, $team_id) + 1, $team_id);
								}

								//Repost
								if($tmp_post['repost_frequency'] != 0){
									$next_time = $tmp_post['repost_frequency']*86400;

									if(isset($tmp_post['account'])){
										unset( $tmp_post['account'] );
									}

									if(isset($tmp_post['id'])){
										unset( $tmp_post['id'] );
									}

									if($tmp_post['time_post'] < $tmp_post['repost_until']){
										//UPDATE POST
										$post->repost_frequency = 0;
										$post->repost_until = NULL;

										$tmp_post['ids'] = ids();
										$tmp_post['result'] = NULL;
										$tmp_post['changed'] = time();
										$tmp_post['created'] = time();
										$tmp_post['time_post'] += $next_time;
										if( $tmp_post['time_post'] <= time() ){
											$tmp_post['time_post'] = time() + $next_time;
										}

										db_insert( TB_POSTS, $tmp_post);
									}
								}

							}
							else
							{
								$count_schedule++;
							}

							if(isset($post->account)){
								unset( $post->account );
							}

							if( $post_id && !post("draft") )
							{
								db_update(TB_POSTS, $post, [ "ids" => $post->ids ]);
							}
							else
							{
								if(post("draft") && $post->status == 0){
									db_update(TB_POSTS, $post, [ "ids" => $post->ids ]);
								}else{
									$post->ids = ids();
									db_insert(TB_POSTS, $post);
								}
							}
						}
					}
					else
					{
						$item = db_get("*", TB_POSTS, ["ids" => $post->ids]);
						if(!empty($item))
						{
							if($post->status == 0){
								$post->ids = ids();
								db_insert(TB_POSTS, $post);
							}else{
								db_update(TB_POSTS, $post, [ "ids" => $post->ids ]);
							}
						}
						else
						{
							return [
								"status" => "error",
								"message" => __("Can't update this post")
							];
						}
					}
				}
				else
				{
					$count_error++;
					$message = __("Can't post to this social network");

					//Update
					if( $post_id )
					{
						$result['status'] = 4;
						$result['result'] = json_encode([
							"message" => $message
						]);
						db_update(TB_POSTS, $result, [ "id" => $post_id ]);
					}
				}
			}
		}

		if($post_by == 1 || isset($post->id))
		{
			if($count_error == 0)
			{
				return [
					"status"  => "success",
					"message" => sprintf(__("Content is being published on %d profiles"), $count_success)
				];
			}
			else
			{
				if($count_error == 1 && $count_success == 0)
				{
					return [
						"status"  => "error",
						"message" => $message
					];
				}
				else
				{
					return [
						"status"  => "error",
						"message" => sprintf(__("Content is being published on %d profiles and %d profiles unpublished"), $count_success, $count_error)
					];
				}
			}
		}
		else
		{
			return [
				"status"  => "success",
				"message" => __("Content successfully scheduled")
			];
		}
    }

    public function post_models($function = ""){
    	$models = [];
    	$module_paths = get_module_paths();

		if(!empty($module_paths))
	    {
	        if( !empty($module_paths) )
	        {
	        	foreach ($module_paths as $key => $module_path) {
	        		$model_paths = $module_path . "/Models/";
               		$model_files = glob( $model_paths . '*' );


               		if ( !empty( $model_files ) )
	                {
	                    foreach ( $model_files as $model_file )
	                    {
	                 		$model_content = file_get_contents($model_file);
	    		        	if (preg_match("/".$function."/i", $model_content))
	    					{
	    						try {
	    							$model = run_class($model_file);
	    							if( isset($model->config) && isset($model->config['id']) ){
	    								$models[$model->config['parent']['id']] = $model;
	    							}
								} catch (\Exception $e) {}
	    					}
	                    }
	                }
	        	}

	        }
		}

		return $models;
    }

    public function get_recent_posts(){
    	$team_id = get_team("id");
    	$social_network = addslashes(post("social_network"));
		$db = \Config\Database::connect();
        $builder = $db->table(TB_POSTS." as a");
        $builder->select("
        	from_unixtime(a.time_post,'%Y-%m-%d %H:%i:%s') as time_posts, 
			from_unixtime(a.repost_until,'%Y-%m-%d %H:%i:%s') as repost_untils, 
			a.time_post, 
			a.repost_frequency, 
			a.repost_until, 
			a.team_id, 
			a.social_network, 
			a.category,
			a.type,
			a.id,
			a.ids,
			a.data,
			a.status,
			a.result,
			b.name,
			b.username,
			b.avatar,
			b.url"
		);
        $builder->join(TB_ACCOUNTS." as b", "a.account_id = b.id");
        $builder->where('( a.status = 3 )');
        $builder->where("a.type != 'live'");
        $builder->where("a.team_id", $team_id);
        if($social_network != "all"){
        	$builder->where("a.social_network", $social_network);
        }
        $builder->orderBy("time_post", "DESC");
        $builder->limit(15, 0);
        $query = $builder->get();
        $result = $query->getResult();
        $query->freeResult();

        if( $result ){
			foreach ($result as $key => $value) {
				$config = find_modules( $value->social_network );

				if($config)
				{
					$result[$key]->module_name = $config['name'];
					$result[$key]->icon = $config['icon'];
					$result[$key]->color = $config['color'];

				}else{

					$result[$key]->module_name = "";
					$result[$key]->icon = "";
					$result[$key]->color = "";
				}
			}
		}

        return $result;
	}

    public function get_posts(){
		$db = \Config\Database::connect();
        $builder = $db->table(TB_POSTS);
        $builder->select('id,ids,team_id,function,type,data,time_post,delay,repost_frequency,repost_until,result,status,changed,created,account_id,social_network,api_type,category');
        $builder->where('status = 1');
        $builder->where("time_post <= '".time()."'");
        $builder->where("type != 'live'");
        $builder->orderBy("time_post", "ASC");
        $builder->limit(5, 0);
        $query = $builder->get();
        $result = $query->getResult();
        $query->freeResult();
        return $result;
	}

	public function get_report_by_status( $status ){
		$db = \Config\Database::connect();
		$social_network = addslashes(post("social_network"));
		$daterange = addslashes(post("daterange"));
        if( $daterange != "" ){
            $daterange = explode(",", $daterange);
        }else{
            $daterange = [];
        }

        if(count($daterange) == 2){
        	$date_list = array();
            $date_since = $daterange[0]." 00:00:00";
            $date_until = $daterange[1]." 23:59:59";
			
	        $team_id = get_team("id");
	        $value_string = "";
	        $date_string = "";

	        $period = new \DatePeriod(
			     new \DateTime($date_since),
			     new \DateInterval('P1D'),
			     new \DateTime($date_until)
			);

			foreach ($period as $key => $value) {
			    $date_list[date_short($value->format('Y-m-d'))] = 0;
			}

	        if($social_network != "all"){
	            $query = $db->query("SELECT COUNT(status) as count, DATE(FROM_UNIXTIME(time_post)) as time_post FROM ".TB_POSTS." WHERE social_network = '".$social_network."' AND status = '{$status}' AND team_id = '".$team_id."' AND FROM_UNIXTIME(time_post) > '".$date_since."' AND FROM_UNIXTIME(time_post) < '".$date_until."' GROUP BY DATE(FROM_UNIXTIME(time_post));");
	        }else{
	            $query = $db->query("SELECT COUNT(status) as count, DATE(FROM_UNIXTIME(time_post)) as time_post FROM ".TB_POSTS." WHERE status = '{$status}' AND team_id = '".$team_id."' AND FROM_UNIXTIME(time_post) > '".$date_since."' AND FROM_UNIXTIME(time_post) < '".$date_until."' GROUP BY DATE(FROM_UNIXTIME(time_post)); ");
	        }

	        if($query->getResult()){
	            
	            foreach ($query->getResult() as $key => $value) {
	                if(isset($date_list[date_short($value->time_post)])){
	                    $date_list[date_short($value->time_post)] = $value->count;
	                }
	            }
	        }

	        foreach ($date_list as $date => $value) {
	            $value_string .= "{$value},";
	            $date_string .= "'{$date}',";
	        }

	        $value_string = "[".substr($value_string, 0, -1)."]";
	        $date_string  = "[".substr($date_string, 0, -1)."]";

	        return [
	            "date" => $date_string,
	            "value" => $value_string,
	        ];
	    }
	}
}
