<?php
namespace Core\Instagram_profiles\Controllers;

class Instagram_profiles extends \CodeIgniter\Controller
{
    public $ig;
    public $username;
    public $password;
    public $proxy;
    public $security_code;
    public $verification_code;
    public $choice;

    public function __construct(){
        $reflect = new \ReflectionClass(get_called_class());
        $this->module = strtolower( $reflect->getShortName() );
        $this->config = include realpath( __DIR__."/../Config.php" );
        $this->app_id = get_option('instagram_client_id', '');
        $this->app_secret = get_option('instagram_client_secret', '');
        $this->app_version = get_option('instagram_app_version', 'v16.0');

        if($this->app_id == "" || $this->app_secret == ""){
            redirect_to( base_url("social_network_settings/index/".$this->config['parent']['id']) ); 
        }

        if( get_option('instagram_official_status', 0) && $this->app_id && $this->app_secret && $this->app_version){
            $fb = new \JanuSoftware\Facebook\Facebook([
                'app_id' => $this->app_id,
                'app_secret' => $this->app_secret,
                'default_graph_version' => $this->app_version,
            ]);

            $this->fb = $fb;
        }
    }
    
    public function index() {

        try {
            if(!get_session("IG_AccessToken")){
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
                set_session( ['IG_AccessToken' => $accessToken] );
                redirect_to( $callback_url );
            }else{
                $accessToken = get_session("IG_AccessToken"); 
            }

            $response = $this->fb->get('/me/accounts?fields=instagram_business_account,id,name,username,fan_count,link,is_verified,picture,access_token,category&limit=10000', $accessToken)->getDecodedBody();
            if(is_string($response)){
                $response = $this->fb->get('/me/accounts?fields=instagram_business_account,id,name,username,fan_count,link,is_verified,picture,access_token,category&limit=3', $accessToken)->getDecodedBody();
            }

            $page_ids = [];
            if(isset($response['data']) && !empty($response['data'])){
                foreach ($response['data'] as $value) {
                    if(isset($value['instagram_business_account'])){
                        $page_ids[] = $value['instagram_business_account']['id'];
                    }
                }
            }

            if(empty($page_ids)){
                $profiles = [
                    "status" => "error",
                    "config" => $this->config,
                    "message" => __('No profile to add')
                ];
            }

            $result = [];
            if(!empty($page_ids)){
                foreach ($page_ids as $key => $page_id) {
                    $profile = $this->fb->get('/'.$page_id.'?fields=id,name,username,profile_picture_url,ig_id', $accessToken)->getDecodedBody();
                    $result[] = (object)[
                        'id' => $profile['id'],
                        'name' => $profile['username'],
                        'avatar' => $profile['profile_picture_url'],
                        'desc' => $profile['name']
                    ];
                }
            }

            $profiles = [
                "status" => "success",
                "config" => $this->config,
                "result" => $result
            ];
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
            "content" => view('Core\Instagram_profiles\Views\add', $profiles)
        ];

        return view('Core\Instagram_profiles\Views\index', $data);
    }

    public function oauth(){
        remove_session(['IG_AccessToken']);
        if( !get_option('instagram_official_status', 0) ){
            redirect_to( base_url() );
        }

        if($this->app_id == "" || $this->app_secret == "" || $this->app_version == ""){
            redirect_to( base_url("social_network_settings/index/".$this->config['parent']['id']) ); 
        }

        $helper = $this->fb->getRedirectLoginHelper();
        $permissions = [ get_option('instagram_permissions', 'instagram_basic,instagram_content_publish,pages_read_engagement') ];
        $login_url = $helper->getLoginUrl( get_module_url() , $permissions);
        redirect_to($login_url);
    }

    public function save()
    {
        try {
            $ids = post('id');
            $team_id = get_team("id");
            $accessToken = get_session('IG_AccessToken');

            validate('empty', __('Please select a profile to add'), $ids);

            $response = $this->fb->get('/me/accounts?fields=instagram_business_account,id,name,username,fan_count,link,is_verified,picture,access_token,category&limit=10000', $accessToken)->getDecodedBody();
            if(is_string($response)){
                $response = $this->fb->get('/me/accounts?fields=instagram_business_account,id,name,username,fan_count,link,is_verified,picture,access_token,category&limit=3', $accessToken)->getDecodedBody();
            }

            $page_ids = [];
            if(isset($response['data']) && !empty($response['data'])){
                foreach ($response['data'] as $value) {
                    if(isset($value['instagram_business_account'])){
                        $page_ids[] = $value['instagram_business_account']['id'];
                    }
                }
            }

            if(empty($page_ids)){
                ms([
                    "status" => "error",
                    "message" => __('No profile to add')
                ]);
            }

            if(!is_string($page_ids)){

                foreach ($page_ids as $page_id) {

                    $profile = $this->fb->get('/'.$page_id.'?fields=id,name,username,profile_picture_url,ig_id', $accessToken)->getDecodedBody();

                    if(in_array($profile['id'], $ids, true)){

                        $avatar = save_img( $profile['profile_picture_url'], WRITEPATH.'avatar/' ); 

                        $item = db_get('*', TB_ACCOUNTS, "social_network = 'instagram' AND login_type = '1' AND team_id = '{$team_id}' AND pid = '".$profile['id']."'");
                        if(!$item){
                            //Check limit number 
                            check_number_account("instagram", "profile");
                            $avatar = save_img( $profile['profile_picture_url'], WRITEPATH.'avatar/', WRITEPATH.'avatar/' );
                            $data = [
                                'ids' => ids(),
                                'module' => $this->module,
                                'social_network' => 'instagram',
                                'category' => 'profile',
                                'login_type' => 1,
                                'can_post' => 1,
                                'team_id' => $team_id,
                                'pid' => $profile['id'],
                                'name' => $profile['name'],
                                'username' => $profile['username'],
                                'token' => $accessToken,
                                'avatar' => $avatar,
                                'url' => "https://www.instagram.com/".$profile['username'],
                                'data' => NULL,
                                'status' => 1,
                                'changed' => time(),
                                'created' => time()
                            ];

                            db_insert(TB_ACCOUNTS, $data);
                        }else{
                            @unlink( get_file_path($item->avatar) );
                            $avatar = save_img( $profile['profile_picture_url'], WRITEPATH.'avatar/', WRITEPATH.'avatar/' );
                            $data = [
                                'can_post' => 1,
                                'pid' => $profile['id'],
                                'name' => $profile['name'],
                                'username' => $profile['username'],
                                'token' => $accessToken,
                                'avatar' => $avatar,
                                'url' => "https://www.instagram.com/".$profile['username'],
                                'status' => 1,
                                'changed' => time(),
                            ];

                            db_update(TB_ACCOUNTS, $data, ['id' => $item->id]);
                        }
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