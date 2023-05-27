<?php
namespace Core\Plans\Controllers;

class Plans extends \CodeIgniter\Controller
{
    public function __construct(){
        $this->config = parse_config( include realpath( __DIR__."/../Config.php" ) );
    }
    
    public function index( $page = false, $ids = "") {
        $page_type = is_ajax()?false:true;

        //
        $item = [];
        $data = [];
        switch ($page) {
            case 'update':
                $request = \Config\Services::request();
                $item = db_get("*", TB_PLANS, "ids = '{$ids}'");
                $content = view('Core\Plans\Views\update', [
                    "permissions" => $request->permissions,
                    "item" => $item
                ]);
                break;

            default:
                $content = view('Core\Plans\Views\empty');
        }

        $data = [
            "title" => $this->config['menu']['sub_menu']['name'],
            "desc" => $this->config['desc'],
            "content" => $content,
            "result" => db_fetch("*", TB_PLANS, "", "id", "DESC"),
            "item" => $item,
        ];

        return view('Core\Plans\Views\index', $data);
    }

    public function save($update = 0, $ids = "")
    {
        $name = post('name');
        $description = post('description');
        $trial_day = (float)post('trial_day');
        $plan_type = (int)post('plan_type');
        $number_accounts = post('number_accounts');
        $price_monthly = (float)post('price_monthly');
        $price_annually = (float)post('price_annually');
        $featured = (int)post('featured');
        $position = (int)post('position');
        $status = (int)post('status');
        $permissions = post('permissions');
        $permissions['plan_type'] = $plan_type;
        $permissions['number_accounts'] = $number_accounts;

        validate('null', __('Name'), $name);
        validate('null', __('Description'), $description);
        validate('null', __('Trial day'), $trial_day);
        validate('null', __('Number accounts'), $number_accounts);
        validate('null', __('Price monthly'), $price_monthly);
        validate('null', __('Price annually'), $price_annually);

        $item = db_get("*", TB_PLANS, "ids = '{$ids}'");
        if(!$item){

            db_insert(TB_PLANS, [
                "ids" => ids(),
                "type" => 2,
                "name" => $name,
                "description" => $description,
                "trial_day" =>  $trial_day,
                "price_monthly" => $price_monthly,
                "price_annually" => $price_annually,
                "plan_type" =>  $plan_type,
                "number_accounts" =>  $number_accounts,
                "featured" => $featured,
                "position" => $position,
                "permissions" => json_encode( $permissions ),
                "status" => $status
            ]);

        }else{

            db_update(
                TB_PLANS, 
                [
                    "name" => $name,
                    "description" => $description,
                    "trial_day" =>  $trial_day,
                    "price_monthly" => $price_monthly,
                    "price_annually" => $price_annually,
                    "plan_type" =>  $plan_type,
                    "number_accounts" =>  $number_accounts,
                    "featured" => $featured,
                    "position" => $position,
                    "permissions" => json_encode( $permissions ),
                    "status" => $status
                ], 
                [ "ids" => $ids ]
            );

            if((int)$update == 1){
                db_update(TB_TEAM, ['permissions' => json_encode($permissions)], [ "pid" => $item->id ]);
            }
        }

        ms([
            "status" => "success",
            "message" => __('Success')
        ]);

    }

    public function delete(){
        $ids = post('id');

        if( empty($ids) ){
            ms([
                "status" => "error",
                "message" => __('Please select an item to delete')
            ]);
        }

        if( is_array($ids) ){
            foreach ($ids as $id) {
                db_delete(TB_PLANS, ['ids' => $id, "type != " => 1]);
            }
        }
        elseif( is_string($ids) )
        {
            db_delete(TB_PLANS, ['ids' => $ids, "type != " => 1]);
        }

        ms([
            "status" => "success",
            "message" => __('Success')
        ]);
    }
}