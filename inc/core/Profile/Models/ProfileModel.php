<?php
namespace Core\Profile\Models;
use CodeIgniter\Model;

class ProfileModel extends Model
{
    public function __construct(){
        $this->config = parse_config( include realpath( __DIR__."/../Config.php" ) );
    }

    public function block_topbar($path = ""){
        $settings = get_blocks("block_profile_settings", false, true);
        if($settings){
            foreach ($settings as $key => $value) {
                if(!is_array($value) || !isset($value["data"]) || !isset($value["data"]["content"])){
                    unset($settings[$key]);
                }
            }
        }

        return array(
            "position" => 10000,
            "topbar" => view( 'Core\Profile\Views\topbar', [ 'config' => $this->config, "settings" => $settings ] )
        );
    }

    public function invoices()
    {
    	$user_id = get_user("id");
        $db = \Config\Database::connect();
        $builder = $db->table(TB_PAYMENT_HISTORY." as a");
        $builder->join(TB_PLANS." as b", "a.plan = b.id", "LEFT");
        $builder->join(TB_USERS." as c", "a.uid = c.id", "LEFT");
        $builder->select('a.*,b.name as plan_name,c.username,c.fullname,c.email,c.avatar');
        $builder->where('a.uid', $user_id);
        $builder->orderBy('id', 'ASC');
        $query = $builder->get();
        $result = $query->getResult();
        $query->freeResult();
        
        return $result;
    }

    public function invoice($id)
    {
    	$user_id = get_user("id");
        $db = \Config\Database::connect();
        $builder = $db->table(TB_PAYMENT_HISTORY." as a");
        $builder->join(TB_PLANS." as b", "a.plan = b.id", "LEFT");
        $builder->join(TB_USERS." as c", "a.uid = c.id", "LEFT");
        $builder->select('a.*,b.name as plan_name,c.username,c.fullname,c.email,c.avatar,b.price_monthly,b.price_annually');
        $builder->where('a.uid', $user_id);
        $builder->where('a.id', $id);
        $builder->orderBy('id', 'ASC');
        $query = $builder->get();
        $result = $query->getRow();
        $query->freeResult();
        
        return $result;
    }
}
