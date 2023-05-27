<?php
namespace Core\Users\Models;
use CodeIgniter\Model;

class UsersModel extends Model
{
    protected $table = TB_USERS;
    protected $primaryKey = 'id';
    protected $allowedFields = ['fullname', 'email'];

    public function __construct(){
        $this->config = parse_config( include realpath( __DIR__."/../Config.php" ) );
    }
    
    public function get_list( $return_data = true )
    {
        $current_page = (int)(post("current_page") - 1);
        $per_page = post("per_page");
        $total_items = post("total_items");
        $keyword = post("keyword");

        $db = \Config\Database::connect();
        $builder = $db->table(TB_USERS." as a");
        $builder->join(TB_PLANS." as b", "a.plan = b.id", "LEFT");
        $builder->join(TB_ROLES." as c", "a.role = c.id", "LEFT");
        $builder->select('a.*,b.name as plan_name,c.name as role_name');
        if( $keyword ){
            $array = [
                'a.username' => $keyword, 
                'a.fullname' => $keyword, 
                'a.email' => $keyword,
                'b.name' => $keyword,
                'c.name' => $keyword
            ];
            $builder->orLike($array);
        }
        
        if( !$return_data )
        {
            $result =  $builder->countAllResults();
        }
        else
        {
            $builder->limit($per_page, $per_page*$current_page);
            $query = $builder->get();
            $result = $query->getResult();
            $query->freeResult();
        }
        
        return $result;
    }

    public function get_report(){

        //Group by status
        $stats_by_status = [
            "active" => 0,
            "inactive" => 0,
            "banned" => 0,
        ];

        $db = \Config\Database::connect();
        $builder = $db->table(TB_USERS);
        $builder->select("status, count(status) as total");
        $builder->groupBy("status");
        $query = $builder->get();
        $result = $query->getResult();
        $query->freeResult();

        if( !empty($result) ){
            foreach ($result as $row) {
                switch ($row->status) {
                    case 1:
                        $stats_by_status['inactive'] = $row->total;
                        break;

                    case 0:
                        $stats_by_status['banned'] = $row->total;
                        break;
                    
                    default:
                        $stats_by_status['active'] = $row->total;
                        break;
                }
            }

        }

        $total_user = array_sum($stats_by_status);

        $stats_by_status['total_user'] = $total_user;
        $stats_by_status['percent_active'] = $stats_by_status['active']/$total_user*100;
        $stats_by_status['percent_inactive'] = $stats_by_status['inactive']/$total_user*100;
        $stats_by_status['percent_banned'] = $stats_by_status['banned']/$total_user*100;

        //Group by login type
        $stats_by_login_type = [
            "direct" => 0,
            "facebook" => 0,
            "google" => 0,
            "twitter" => 0
        ];

        $builder = $db->table(TB_USERS);
        $builder->select("login_type, count(login_type) as total");
        $builder->groupBy("login_type");
        $query = $builder->get();
        $result = $query->getResult();
        $query->freeResult();

        if(!empty($result)){
            foreach ($result as $row) {
                switch ($row->login_type) {
                    case 'facebook':
                        $stats_by_login_type['facebook'] = $row->total;
                        break;

                    case 'google':
                        $stats_by_login_type['google'] = $row->total;
                        break;

                    case 'twitter':
                        $stats_by_login_type['twitter'] = $row->total;
                        break;
                    
                    default:
                        $stats_by_login_type['direct'] = $row->total;
                        break;
                }
            }
        }

    
        //Recrent registers
        $recently_registered_users = db_fetch("*", TB_USERS, [], "id", "desc", 0, 10);

        //Stats by date
        $today = db_get("count(*) as count", TB_USERS, " created > NOW() - INTERVAL 1 DAY ")->count;
        $week = db_get("count(*) as count", TB_USERS, " created > NOW() - INTERVAL 7 DAY ")->count;
        $month = db_get("count(*) as count", TB_USERS, " created > NOW() - INTERVAL 30 DAY ")->count;
        $year = db_get("count(*) as count", TB_USERS, " created > NOW() - INTERVAL 365 DAY ")->count;

        $stats_by_date = [
            "today" => $today,
            "week" => $week,
            "month" => $month,
            "year" => $year
        ];

        //Chart
        $value_string = "";
        $date_string = "";

        $date_list = array();
        $date = strtotime(date('Y-m-d', strtotime( now() )));
        for ($i=29; $i >= 0; $i--) { 
            $left_date = $date - 86400 * $i;
            $date_list[date('M j, Y', $left_date)] = 0;
        }

        $query = $db->query("SELECT COUNT(status) as count, DATE(created) as created FROM ".TB_USERS." WHERE created > NOW() - INTERVAL 30 DAY GROUP BY DATE(created);");
        if($query->getResult()){
            foreach ($query->getResult() as $key => $value) {
                if(isset($date_list[$value->created])){
                    $date_list[$value->created] = $value->count;
                }
            }
        }

        foreach ($date_list as $date => $value) {
            $value_string .= "{$value},";
            $date_string .= "'{$date}',";
        }

        $value_string = "[".substr($value_string, 0, -1)."]";
        $date_string  = "[".substr($date_string, 0, -1)."]";

        $chart = [
            "value" => $value_string,
            "date" => $date_string
        ];

        return (object)[
            "stats_by_status" => (object)$stats_by_status,
            "stats_by_date" => (object)$stats_by_date,
            "stats_by_login_type" => (object)$stats_by_login_type,
            "recently_registered_users" => $recently_registered_users,
            "chart" => (object)$chart,
        ];
    }
}
