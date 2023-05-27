<?php
namespace Core\Account_manager\Models;
use CodeIgniter\Model;

class Account_managerModel extends Model
{
	public function __construct(){
        $this->config = parse_config( include realpath( __DIR__."/../Config.php" ) );
    }
    
    public function block_permissions($path = ""){
        if( uri('segment',1) == "account_manager" ){
           $configs = get_blocks("block_accounts", false, true);
        }else{
            $configs = get_blocks("block_accounts", false, false);
        }

        $items = [];

        if( ! empty($configs) ){
            $items = $configs;
            if( count($items) >= 2 ){
                usort($items, function($a, $b) {
                    if( isset($a['position']) &&  isset($b['position']) )
                        return $a['position'] <=> $b['position'];
                });
            }
        }

        return [
            "items" => $items,
            "html" =>  view( 'Core\Account_manager\Views\permissions', [ 'config' => $this->config, "items" => $items ] )
        ];
    }

    public function get_account_by($field, $value , $status = 1, $team_id = 0){

        if($team_id == 0){
            $team_id = (int)get_team("id");
        }

        $db = \Config\Database::connect();

        $builder = $db->table(TB_ACCOUNTS);
        $builder->select("*");
        $builder->where('team_id', $team_id);
        $builder->where($field, $value);
        $builder->where('status', $status);
        $query = $builder->get();
        $result = $query->getResult();
        $query->freeResult();

        return $result;
    }

    public function get_accounts_by($list = [], $field = "ids", $status = 1, $team_id = 0){

        if($team_id == 0){
            $team_id = (int)get_team("id");
        }

        $db = \Config\Database::connect();

        $builder = $db->table(TB_ACCOUNTS);
        $builder->select("*");
        $builder->where('team_id', $team_id);
        $builder->whereIn($field, $list);
        $builder->where('status', $status);
        $query = $builder->get();
        $result = $query->getResult();
        $query->freeResult();
        return $result;
    }
}
