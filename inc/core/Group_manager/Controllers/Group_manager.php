<?php
namespace Core\Group_manager\Controllers;

class Group_manager extends \CodeIgniter\Controller
{
    public function __construct(){
        $this->config = parse_config( include realpath( __DIR__."/../Config.php" ) );
    }
    
    public function index( $page = false ) {
        $team_id = get_team("id");
        $result = db_fetch("*", TB_GROUPS, [ "team_id" => $team_id ], "created", "ASC");

        $data = [
            "result" => $result,
            "title" => $this->config['menu']['sub_menu']['name'],
            "desc" => $this->config['desc'],
        ];

        switch ( $page ) {
            case 'update':
                $item = false;
                $ids = uri('segment', 4);
                if( $ids ){
                    $item = db_get("*", TB_GROUPS, [ "ids" => $ids ]);
                }

                $accounts = db_fetch("*", TB_ACCOUNTS, ["team_id" => $team_id]);
                permission_accounts($accounts);
                $data['content'] = view('Core\Group_manager\Views\update', ["result" => $item, "accounts" => $accounts]);
                break;

            default:
                $data['content'] = view('Core\Group_manager\Views\empty');
                break;
        }

        return view('Core\Group_manager\Views\index', $data);
    }

    public function widget(){
        $team_id = get_team("id");
        $groups = db_fetch("*", TB_GROUPS, ["team_id" => $team_id], "created", "ASC");

        $data = [
            "groups" => $groups
        ];

        return view('Core\Group_manager\Views\widget', $data);
    }

    public function save( $ids = "" ){
        $team_id = get_team("id");
        $name = post("name");
        $accounts = post("accounts");
        $item = false;

        if ($ids != "") {
            $item = db_get("*", TB_GROUPS, ["ids" => $ids]);
        }

        if (!$this->validate([
            'name' => 'required'
        ])) {
            ms([
                "status" => "error",
                "message" => __("Title is required")
            ]);
        }

        if (!$this->validate([
            'accounts' => 'required'
        ])) {
            ms([
                "status" => "error",
                "message" => __("Please select an account")
            ]);
        }

        $data = [
            "team_id" => $team_id,
            "name" => $name,
            "data" => json_encode($accounts),
            "changed" => time(),
        ];

        if( empty($item) ){
            $data['ids'] = ids();
            $data['created'] = time();

            db_insert(TB_GROUPS, $data);
        }else{
            db_update(TB_GROUPS, $data, [ "id" => $item->id ]);
        }

        ms([
            "status" => "success",
            "message" => __('Success')
        ]);
    }

    public function delete( $ids = '' ){
        if($ids == ''){
            $ids = post('id');
        }

        if( empty($ids) ){
            ms([
                "status" => "error",
                "message" => __('Please select an item to delete')
            ]);
        }

        if( is_array($ids) )
        {
            foreach ($ids as $id) 
            {
                db_delete(TB_GROUPS, ['ids' => $id]);
            }
        }
        elseif( is_string($ids) )
        {
            db_delete(TB_GROUPS, ['ids' => $ids]);
        }

        ms([
            "status" => "success",
            "message" => __('Success')
        ]);
    }
}