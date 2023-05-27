<?php
namespace Core\Users\Controllers;

class Users extends \CodeIgniter\Controller
{
    public function __construct(){
        $this->config = parse_config( include realpath( __DIR__."/../Config.php" ) );
        $this->model = new \Core\Users\Models\UsersModel();
    }
    
    public function index( $page = false ) {
        $data = [
            "title" => $this->config['name'],
            "desc" => $this->config['desc'],
            'config' => $this->config
        ];

        switch ( $page ) {
            case 'update':
                $item = false;
                $ids = uri('segment', 4);
                if( $ids ){
                    $item = db_get("*", TB_USERS, [ "ids" => $ids ]);
                }

                $plans = db_fetch("*", TB_PLANS, "", "id", "ASC");
                $group_roles = db_fetch("*", TB_ROLES, "", "id", "ASC");

                $data['content'] = view('Core\Users\Views\update', ["result" => $item, 'plans' => $plans, "group_roles" => $group_roles, 'config' => $this->config]);
                break;

            case 'role':
                if (!find_modules("payment")) {
                    redirect_to( get_module_url() );
                }

                $ids = uri('segment', 4);
                $request = \Config\Services::request();
                $result = db_fetch("*", TB_ROLES, [], "id", "ASC");
                $item = db_get("*", TB_ROLES, "ids = '{$ids}'");
                if(!is_ajax() || uri("segment", 4) == ""){
                    $data['content'] = view('Core\Users\Views\role', [
                        "roles" => $request->roles,
                        "result" => $result,
                        "item" => $item
                    ]);
                }else{
                   $data['content'] = view('Core\Users\Views\update_role', [
                        "roles" => $request->roles,
                        "result" => $result,
                        "item" => $item,
                        'config' => $this->config
                    ]); 
                }
                break;

            case 'report':
                if (!find_modules("payment")) {
                    redirect_to( get_module_url() );
                }
                $data['content'] = view('Core\Users\Views\report', [
                    "result" => $this->model->get_report(),
                    'config' => $this->config
                ]);
                break;
            
            default:
                $start = 0;
                $limit = 1;

                $pager = \Config\Services::pager();
                $total = $this->model->get_list(false);

                $datatable = [
                    "responsive" => true,
                    "columns" => [
                        "id" => __("ID"),
                        "user" => __("User"),
                        "admin" => __("Admin"),
                        "role" => __("Role"),
                        "plan" => __("Plan"),
                        "expiration_date" => __("Expiration date"),
                        "login_type" => __("Login type"),
                        "status" => __("Status"),
                        "created" => __("Created"),
                    ],
                    "total_items" => $total,
                    "per_page" => 50,
                    "current_page" => 1,

                ];

                $data_content = [
                    'start' => $start,
                    'limit' => $limit,
                    'total' => $total,
                    'pager' => $pager,
                    'datatable'  => $datatable,
                    'config' => $this->config
                ];

                $data['content'] = view('Core\Users\Views\list', $data_content);
                break;
        }

        return view('Core\Users\Views\index', $data);
    }

    public function ajax_list(){
        $total_items = $this->model->get_list(false);
        $result = $this->model->get_list(true);
        $actions = get_blocks("block_action_user", false);
        $data = [
            "result" => $result,
            "actions" => $actions
        ];
        ms( [
            "total_items" => $total_items,
            "data" => view('Core\Users\Views\ajax_list', $data)
        ] );
    }

    public function export(){
        export_csv(TB_USERS, "users");
    }

    public function view($ids = ""){

        $user = db_get("*", TB_USERS, ["ids" => $ids]);
        if(empty($user)){
            ms([
                "status" => "error",
                "message" => __("This account does not exist")
            ]);
        }

        $team = db_get("*", TB_TEAM, ["owner" => $user->id]);
        if(empty($user)){
            ms([
                "status" => "error",
                "message" => __("This account does not belong to any team")
            ]);
        }

        set_session([
            "tmp_uid" => get_session("uid"),
            "tmp_team_id" => get_session("team_id"),
            "uid" => $user->ids,
            "team_id" => $team->ids,
        ]);

        ms([
            "status" => "success",
            "message" => __("Success")
        ]);
    }
    
    public function save( $ids = '' ){

        $fullname = post('fullname');
        $username = post('username');
        $email = post('email');
        $password = post('password');
        $confirm_password = post('confirm_password');
        $plan_id = (int)post('plan');
        $expiration_date = post('expiration_date');
        $timezone = post('timezone');
        $is_admin = (int)post('is_admin');
        $role = (int)post('role');
        $status = (int)post('status');
        $item = db_get( "*", TB_USERS, ['ids' => $ids] );
        $plan = db_get("*", TB_PLANS, ['id' => $plan_id]);

        if(!$item)
        {
            $email_check = db_get( "*", TB_USERS, ['email' => $email] );
            $username_check = db_get( "*", TB_USERS, ['username' => $username] );
            validate('null', __('Fullname'), $fullname);
            validate('null', __('Email'), $email);
            validate('username', __('Username'), $username);
            validate('min_length', __('Username'), $username, 6);
            validate('not_empty', __('This email already exists'), $email_check);
            validate('not_empty', __('This username already exists'), $username_check);
            validate('null', __('Password'), $password);
            validate('min_length', __('Password'), $password, 6);
            validate('null', __('Confirm password'), $confirm_password);
            validate('other', __('Your password and confirmation password do not match'), $password, $confirm_password);
            validate('empty', __('Please select a plan'), $plan);
            validate('null', __('Expiration date'), $expiration_date);
            validate('null', __('Timezone'), $timezone);

            $avatar = save_img( get_avatar($fullname), WRITEPATH.'avatar/' );

            $id = db_insert(TB_USERS , [
                "ids" => ids(),
                "is_admin" => $is_admin,
                "role" => $role,
                "fullname" => $fullname,
                "username" => $username,
                "email" => $email,
                "password" => md5($password),
                "plan" => $plan_id,
                "expiration_date" => $expiration_date?strtotime(date_sql($expiration_date)):0,
                "timezone" => $timezone,
                "login_type" => 'direct',
                "avatar" => $avatar,
                "status" => $status,
                "changed" => time(),
                "created" => time()
            ]);

            db_insert( TB_TEAM, [
                "ids" => ids(),
                "owner" => $id,
                "pid" => $plan_id,
                "permissions" => $plan->permissions
            ]);
        }
        else
        {
            $email_check = db_get( "*", TB_USERS, ['email' => $email, 'id != ' => $item->id] );
            $username_check = db_get( "*", TB_USERS, ['username' => $username, 'id != ' => $item->id] );
            validate('null', __('Fullname'), $fullname);
            validate('username', __('Username'), $username);
            validate('min_length', __('Username'), $username, 6);
            validate('null', __('Email'), $email);
            validate('email', __('Email'), $email);
            validate('not_empty', __('This email already exists'), $email_check);
            validate('not_empty', __('This username already exists'), $username_check);
            
            if($password != "")
            {
                validate('min_length', __('Password'), $password, 6);
                validate('null', __('Confirm password'), $confirm_password);
                validate('other', __('Your password and confirmation password do not match'), $password, $confirm_password);
            }

            validate('empty', __('Please select a plan'), $plan);
            validate('null', __('Expiration date'), $expiration_date);
            validate('null', __('Timezone'), $timezone);

            $data = [
                "is_admin" => $is_admin,
                "role" => $role,
                "fullname" => $fullname,
                "username" => $username,
                "email" => $email,
                "plan" => $plan_id,
                "expiration_date" => $expiration_date?strtotime(date_sql($expiration_date)):0,
                "timezone" => $timezone,
                "status" => $status,
                "changed" => time()
            ];

            if($password != "")
            {
                $data['password'] = md5($password);
            }

            db_update(TB_USERS , $data, ["ids" => $ids]);

            if( $plan )
            {
                $team = db_get("*", TB_TEAM, ["owner" => $item->id]);
                update_team_data("number_accounts", $plan->number_accounts, $team->id);

                db_update( TB_TEAM, [
                    "permissions" => $plan->permissions,
                    "pid" => $plan->id
                ],
                [
                    "owner" => $item->id
                ]);
            }
        }

        ms([
            "status" => "success",
            "message" => __('Success')
        ]);
    }

    public function delete( $ids = '' ){

        if($ids == ''){
            $ids = post('ids');
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
                db_delete(TB_USERS, ['ids' => $id]);
            }
        }
        elseif( is_string($ids) )
        {
            db_delete(TB_USERS, ['ids' => $ids]);
        }

        ms([
            "status" => "success",
            "message" => __('Success')
        ]);

    }

    /*
    * ROLES
    */

    public function role_save($ids = "")
    {
        if (!find_modules("payment")) {
            redirect_to( get_module_url() );
        }

        $name = post('name');
        $permissions = post('permissions');
        $permissions['profile_status'] = 1;

        validate('null', __('Name'), $name);

        $item = db_get("*", TB_ROLES, "ids = '{$ids}'");
        if(!$item){

            db_insert(TB_ROLES, [
                "ids" => ids(),
                "name" => $name,
                "permissions" => json_encode( $permissions )
            ]);

        }else{

            db_update(
                TB_ROLES, 
                [
                    "name" => $name,
                    "permissions" => json_encode( $permissions ),
                ], 
                [ "ids" => $ids ]
            );
            
        }

        ms([
            "status" => "success",
            "message" => __('Success')
        ]);

    }

}