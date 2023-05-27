<?php
namespace Core\Schedules\Models;
use CodeIgniter\Model;

class SchedulesModel extends Model
{
    public function __construct(){
        $this->config = parse_config( include realpath( __DIR__."/../Config.php" ) );
    }

    public function categories(){
    	$team_id = get_team("id");
    	$db = \Config\Database::connect();
        $builder = $db->table(TB_POSTS);
        $builder->select("social_network,function");
        $builder->where("team_id", $team_id);
        $builder->orderBy("social_network", "ASC");
        $builder->groupBy("social_network,function");
        $query = $builder->get();
        $result = $query->getResult();
        if(!empty($result)){
        	foreach ($result as $key => $row)
        	{

				$config = find_modules( $row->social_network."_post" );

				/*if( !permission($row->social_network."_status") ){
					unset( $result[$key] );
					continue;
				}*/

				if($config)
				{
					$result[$key]->name = $config['name'];
					$result[$key]->icon = $config['icon'];
					$result[$key]->color = $config['color'];
				}
				else
				{
					$result[$key]->name = "";
					$result[$key]->icon = "";
					$result[$key]->color = "";
				}

			}
        }
        $query->freeResult();

        return $result;
    }

    public function calendar($type, $social_network)
	{
		$db = \Config\Database::connect();

		switch ($type) {
			case 'published':
				$status = 3;
				break;

			case 'unpublished':
				$status = 4;
				break;
			
			default:
				$status = 1;
				break;
		}

		$team_id = get_team("id");

		$builder = $db->table(TB_POSTS);
        $builder->select("from_unixtime(time_post,'%Y-%m-%d') as time_posts, from_unixtime(repost_until,'%Y-%m-%d') as repost_untils, social_network, COUNT(time_post) as total, category, function");
        $builder->where("status = '{$status}' AND team_id = '{$team_id}'");

        if(strip_tags($social_network) != "all"){
			$builder->where("social_network = '".$social_network."'");
		}

		$builder->groupBy("time_posts,repost_untils,social_network,category,function");
		$builder->orderBy("repost_untils", "DESC");
		$query = $builder->get();
		$result = $query->getResult();
		$query->freeResult();

		if($result)
		{	
			foreach ($result as $key => $value) {
				if( !permission($value->social_network."_post") ){
					unset( $result[$key] );
					continue;
				}
			}
		}

		return $result;
	}

	public function list($type, $category, $time)
	{	
		$db = \Config\Database::connect();

		$time_check = explode("-", $time);
		
		if( count($time_check) != 3 || !checkdate( (int)$time_check[1], (int)$time_check[2], (int)$time_check[0]) ) return false;

		switch ($type) {
			case 'published':
				$status = 3;
				break;

			case 'unpublished':
				$status = 4;
				break;
			
			default:
				$status = 1;
				break;
		}

		$team_id = get_team("id");
		$date_start = $time . " 00:00:00";
		$date_end = $time . " 23:59:59";

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
			b.url
		");
		
		$builder->join(TB_ACCOUNTS." as b", "a.account_id = b.id");

		$cate = "";
		if(strip_tags($category) != "all"){
			$cate = " a.social_network = '{$category}' AND ";
		}

		$builder->having(" ( {$cate} a.status = '{$status}' AND from_unixtime(a.time_post,'%Y-%m-%d %H:%i:%s') >= '{$date_start}' AND from_unixtime(a.time_post,'%Y-%m-%d %H:%i:%s') <= '{$date_end}' AND a.repost_until IS NULL AND a.team_id = '{$team_id}' ) ");
		$builder->orHaving(" ( {$cate} a.status = '{$status}' AND from_unixtime(a.time_post,'%Y-%m-%d 00:00:00') <= '{$date_end}' AND from_unixtime(a.repost_until,'%Y-%m-%d 23:59:59') >= '{$date_start}' AND a.team_id = '{$team_id}' ) ");
		
		$builder->orderBy("a.time_post ASC");
		$query = $builder->get();
		$result = $query->getResult();
		$query->freeResult();

		if( $result ){
			foreach ($result as $key => $value) {
				$config = find_modules( $value->social_network. "_post" );

				if( !permission( $value->social_network. "_post" ) ){
					unset( $result[$key] );
					continue;
				}

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
}
