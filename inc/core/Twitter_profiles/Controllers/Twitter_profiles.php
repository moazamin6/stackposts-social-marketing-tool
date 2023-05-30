<?php
namespace Core\Twitter_profiles\Controllers;
use Abraham\TwitterOAuth\TwitterOAuth;

class Twitter_profiles extends \CodeIgniter\Controller
{
    public function __construct(){
        $reflect = new \ReflectionClass(get_called_class());
        $this->module = strtolower( $reflect->getShortName() );
        $this->config = include realpath( __DIR__."/../Config.php" );

        $this->consumer_key = get_team_data("twitter_consumer_key", "");
        $this->consumer_secret = get_team_data("twitter_consumer_secret", "");

        if(!get_team_data("twitter_status", 0) || $this->consumer_key == "" || $this->consumer_secret == ""){
            $this->consumer_key = get_option('twitter_consumer_key', '');
            $this->consumer_secret = get_option('twitter_consumer_secret', '');
        }

        $this->callback_url = get_module_url();
        if($this->consumer_key == "" || $this->consumer_secret == ""){
            redirect_to( base_url("social_network_settings/index/".$this->config['parent']['id']) ); 
        }
    }
    
    public function index() {

        try {
            if(!get_session("TW_AccessToken")){
                $oauth_token = get_session("twitter_oauth_token");
                $oauth_token_secret = get_session("twitter_oauth_token_secret");
                $oauth_verifier = get("oauth_verifier");
                remove_session( ["twitter_oauth_token"] );
                remove_session( ["twitter_oauth_token_secret"] );

                $connection = new TwitterOAuth($this->consumer_key, $this->consumer_secret, $oauth_token, $oauth_token_secret);
                $accessToken = $connection->oauth("oauth/access_token", ["oauth_verifier" => $oauth_verifier]);
                set_session(["TW_AccessToken" => $accessToken]);
            }else{
                $connection = new TwitterOAuth($this->consumer_key, $this->consumer_secret);
                $accessToken = get_session("TW_AccessToken");
            }

            $accessToken = (object)$accessToken;
            $connection->setOauthToken($accessToken->oauth_token, $accessToken->oauth_token_secret);
            $profile = $connection->get("account/verify_credentials", ['include_entities' => 'false', 'skip_status' => 'true']);

            $result = [];
            $result[] = (object)[
                'id' => $profile->id,
                'name' => $profile->name,
                'avatar' => $profile->profile_image_url_https,
                'desc' => $profile->screen_name
            ];

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
            "content" => view('Core\Twitter_profiles\Views\add', $profiles)
        ];

        return view('Core\Twitter_profiles\Views\index', $data);
    }

    public function popup_twitter_app(){
        $data = [
            'config'  => $this->config
        ];
        return view('Core\Twitter_profiles\Views\popup_twitter_app', $data);
    }

    public function save_twitter_api(){

        $twitter_status = (int)post("twitter_status");
        $twitter_consumer_key = post("twitter_consumer_key");
        $twitter_consumer_secret = post("twitter_consumer_secret");

        update_team_data("twitter_status", $twitter_status);
        update_team_data("twitter_consumer_key", $twitter_consumer_key);
        update_team_data("twitter_consumer_secret", $twitter_consumer_secret);

        ms([
            "status" => "success",
            "message" => __("Success")
        ]);
    }

    public function oauth(){
        remove_session(['TW_AccessToken']);
        try {
            $connection = new TwitterOAuth($this->consumer_key, $this->consumer_secret);
            $connection->setApiVersion('2');
            $request_token = $connection->oauth('oauth/request_token', array('oauth_callback' => $this->callback_url));

            set_session( ["twitter_oauth_token" => $request_token['oauth_token'] ] );
            set_session( ["twitter_oauth_token_secret" => $request_token['oauth_token_secret'] ] );

            $oauth_link = $connection->url('oauth/authorize', array('oauth_token' => $request_token['oauth_token']));
            redirect_to($oauth_link);
        } catch (\Exception $e) {
            $message = json_decode( $e->getMessage() , TRUE);
            $message = $message['errors'][0]['message'];
            redirect_to( get_module_url("?error=".$message) );
        }
    }

    public function save()
    {
        $ids = post('id');
        $team_id = get_team("id");
        $accessToken = get_session("TW_AccessToken");
        $accessToken = (object)$accessToken;

        validate('empty', __('Please select a profile to add'), $ids);

        $connection = new TwitterOAuth($this->consumer_key, $this->consumer_secret);
        $connection->setOauthToken($accessToken->oauth_token, $accessToken->oauth_token_secret);
        $response = $connection->get("account/verify_credentials");

        if(!is_string($response)){

            if(in_array($response->id, $ids)){
                $item = db_get('*', TB_ACCOUNTS, "social_network = 'twitter' AND team_id = '{$team_id}' AND pid = '".$response->id."'");
                if(!$item){
                    //Check limit number 
                    check_number_account("twitter", "profile");
                    $avatar = save_img( $response->profile_image_url_https, WRITEPATH.'avatar/' );
                    $data = [
                        'ids' => ids(),
                        'module' => $this->module,
                        'social_network' => 'twitter',
                        'category' => 'profile',
                        'login_type' => 1,
                        'can_post' => 1,
                        'team_id' => $team_id,
                        'pid' => $response->id,
                        'name' => $response->name,
                        'username' => $response->screen_name,
                        'token' => json_encode($accessToken),
                        'avatar' => $avatar,
                        'url' => 'https://twitter.com/'.$response->screen_name,
                        'data' => NULL,
                        'status' => 1,
                        'changed' => time(),
                        'created' => time()
                    ];

                    db_insert(TB_ACCOUNTS, $data);
                }else{
                    unlink( get_file_path($item->avatar) );
                    $avatar = save_img( $response->profile_image_url_https, WRITEPATH.'avatar/' );
                    $data = [
                        'can_post' => 1,
                        'pid' => $response->id,
                        'name' => $response->name,
                        'username' => $response->screen_name,
                        'token' => json_encode($accessToken),
                        'avatar' => $avatar,
                        'url' => 'https://twitter.com/'.$response->screen_name,
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
    }
}