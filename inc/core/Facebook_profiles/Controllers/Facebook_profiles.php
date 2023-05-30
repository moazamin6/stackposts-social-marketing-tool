<?php
namespace Core\Facebook_profiles\Controllers;
class Facebook_profiles extends \CodeIgniter\Controller
{
    public function __construct(){
        $reflect = new \ReflectionClass(get_called_class());
        $this->module = strtolower( $reflect->getShortName() );
        $this->config = include realpath( __DIR__."/../Config.php" );
        $app_id = get_option('facebook_client_id', '');
        $app_secret = get_option('facebook_client_secret', '');
        $app_version = get_option('facebook_app_version', 'v16.0');

        if($app_id == "" || $app_secret == "" || $app_version == ""){
            redirect_to( base_url("social_network_settings/index/".$this->config['parent']['id']) ); 
        }

        $fb = new \JanuSoftware\Facebook\Facebook([
            'app_id' => $app_id,
            'app_secret' => $app_secret,
            'default_graph_version' => $app_version,
        ]);

        $this->fb = $fb;
    }
    
    public function index() {

        try {
            if( !get_session("FB_AccessToken") ){

                if(!get('code')){
                    redirect_to( get_module_url("oauth") );
                }

                $callback_url = get_module_url();
                $helper = $this->fb->getRedirectLoginHelper();
                if ( get("state") ) {
                    $helper->getPersistentDataHandler()->set('state', get("state"));
                }
                $accessToken = $helper->getAccessToken($callback_url);
                $accessToken = $accessToken->getValue();
                set_session( ['FB_AccessToken' => $accessToken] );
                redirect_to( $callback_url );
            }else{
                $accessToken = get_session("FB_AccessToken"); 
            }

            $response = $this->fb->get('/me?fields=id,name,picture', $accessToken)->getDecodedBody();

            if(!is_string($response)){
                $result = [];
                $result[] = (object)[
                    'id' => $response['id'],
                    'name' => $response['name'],
                    'avatar' => $response['picture']['data']['url'],
                    'desc' => $response['name']
                ];

                $profiles = [
                    "status" => "success",
                    "config" => $this->config,
                    "result" => $result
                ];
            }else{
                $profiles = [
                    "status" => "error",
                    "config" => $this->config,
                    "message" => $response
                ];
            }
        } catch (\Exception $e) {
            $profiles = [
                "status" => "error",
                "config" => $this->config,
                "message" => $e->getMessage()
            ];
        }

        $data = [
            "title" => $this->config['name'],
            "desc" => $this->config['desc'],
            "content" => view('Core\Facebook_profiles\Views\add', $profiles)
        ];

        return view('Core\Facebook_profiles\Views\index', $data);
    }

    public function oauth(){
        remove_session(['FB_AccessToken']);
        $helper = $this->fb->getRedirectLoginHelper();
        $permissions = [ get_option('facebook_profile_permissions', '') ];
        $login_url = $helper->getLoginUrl( get_module_url() , $permissions);
        redirect_to( $login_url );
    }

    public function save()
    {
        try {
            $ids = post('id');
            $team_id = get_team("id");
            $accessToken = get_session('FB_AccessToken');

            validate('empty', __('Please select a profile to add'), $ids);

            $response = $this->fb->get('/me?fields=id,name,picture', $accessToken)->getDecodedBody();

            if(!is_string($response)){

                if(in_array($response['id'], $ids, true)){

                    $avatar = save_img( $response['picture']['data']['url'], WRITEPATH.'avatar/' );

                    $item = db_get('*', TB_ACCOUNTS, "social_network = 'facebook' AND team_id = '{$team_id}' AND pid = '".$response['id']."'");
                    if(!$item){
                        //Check limit number 
                        check_number_account("facebook", "profile");
                        $avatar = save_img( $response['picture']['data']['url'], WRITEPATH.'avatar/' );
                        $data = [
                            'ids' => ids(),
                            'module' => $this->module,
                            'social_network' => 'facebook',
                            'category' => 'profile',
                            'login_type' => 1,
                            'can_post' => 0,
                            'team_id' => $team_id,
                            'pid' => $response['id'],
                            'name' => $response['name'],
                            'username' => $response['name'],
                            'token' => $accessToken,
                            'avatar' => $avatar,
                            'url' => 'https://fb.com/'.$response['id'],
                            'data' => NULL,
                            'status' => 1,
                            'changed' => time(),
                            'created' => time()
                        ];

                        db_insert(TB_ACCOUNTS, $data);
                    }else{
                        unlink( get_file_path($item->avatar) );
                        $avatar = save_img( $response['picture']['data']['url'], WRITEPATH.'avatar/' );
                        $data = [
                            'can_post' => 0,
                            'pid' => $response['id'],
                            'name' => $response['name'],
                            'username' => $response['name'],
                            'token' => $accessToken,
                            'avatar' => $avatar,
                            'url' => 'https://fb.com/'.$response['id'],
                            'status' => 1,
                            'changed' => time(),
                        ];

                        db_update(TB_ACCOUNTS, $data, ['id' => $item->id]);
                    }
                }

                ms([
                    "status" => "success",
                    "message" => __("Success")
                ]);
       
            }else{
                ms([
                    "status" => "error",
                    "message" => $response
                ]);
            }
        } catch (\Exception $e) {
            ms([
                "status" => "error",
                "message" => $e->getMessage()
            ]);
        }
    }
}