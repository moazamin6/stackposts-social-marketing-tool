<?php
namespace Core\Auth\Models;
use CodeIgniter\Model;

class AuthModel extends Model
{
	public function __construct(){
        $this->config = parse_config( include realpath( __DIR__."/../Config.php" ) );
    }

    public function block_settings($path = ""){
        return array(
            "position" => 9300,
            "menu" => view( 'Core\Auth\Views\settings\menu', [ 'config' => $this->config ] ),
            "content" => view( 'Core\Auth\Views\settings\content', [ 'config' => $this->config ] )
        );
    }
	
    public function login(){
    	$username = post("username");
    	$password = post("password");
    	$remember = post("remember");

		validate("null", __("Email is required"), $username);
		validate("null", __("Password is required"), $password);

		$user = db_get("id,status,ids", TB_USERS, "( email = '".$username."' OR username = '".$username."' ) AND password = '".password($password)."'");

		validate("empty", __("The account you entered does not match any account"), $user);

		$team = db_get("id,ids", TB_TEAM, "owner = '{$user->id}'");

		validate("empty", __("The is a problem on your account. Please try again later"), $team);

		
		if($user->status == 1){
			ms([
				"status"  => "error",
				"message" => __('Your account is not activated')
			]);
		}

		if($user->status == 0){
			ms([
				"status"  => "error",
				"message" => __('Your account is banned') 
			]);
		}

		$this->google_recaptcha();

		db_update(TB_USERS, ["last_login" => time()], ["id" => $user->id]);
		
		set_session(["uid" => $user->ids]);
		set_session(["team_id" => $team->ids]);
		if($remember){
			set_cookies([
				"uid" => encrypt_encode($user->ids),
				"team_id" => encrypt_encode($team->ids)
			], 2592000);
		}

		ms([
			"status" => "success",
			"message" => __('Success')
		]);
	}

	public function signup(){
		$fullname = post("fullname");
		$username = post("username");
		$email = post("email");
		$password = post("password");
		$confirm_password = post("confirm_password");
		$agree_terms = post("agree_terms");
		$timezone = post("timezone");

		validate("null", __("Fullname"), $fullname);
		validate("min_length", __("Fullname"), $fullname, 3);
		validate("null", __("Username"), $username);
		validate("min_length", __("Username"), $username, 6);
		validate("null", __("Email"), $email);
		validate("email", __("Email"), $email);
		validate("null", __("Password"), $password);
		validate("min_length", __("Password"), $password, 6);
		validate("min_length", __("Confirm password"), $confirm_password, 6);
		validate("null", __("Timezone"), $timezone);
		
		if( !$agree_terms ){
			ms([
				"status"  => "error",
				"message" => __('You need to agree to our terms and conditions.')
			]);
		}

		$check_username = db_get("id", TB_USERS, ["username" => $username]);
        validate("not_empty", __("The username already exists."), $check_username);

        $check_email = db_get("id", TB_USERS, ["email" => $email]);
        validate("not_empty", __("The email already exists."), $check_email);

        $language = db_get("*", TB_LANGUAGE_CATEGORY, ["is_default" => 1, "status" => 1]);
        $language_code = "en";
        if(!empty($language)){
        	$language_code = $language->code;
        }

        $plan = 0;
        $expiration_date = 0;
        $permissions = NULL;
        $plan_item = db_get("*", TB_PLANS, ["type" => 1, "status" => 1]);
        if(!empty($plan_item)){
        	$plan = $plan_item->id;
        	$permissions = $plan_item->permissions;
        	if($plan_item->trial_day != -1){
        		$expiration_date = time() + $plan_item->trial_day*86400;
        	}
        }

        $this->google_recaptcha();

        $ids = ids();
        $status = 2;
        $require_activation = get_option("activation_email_status", 0);
        if($require_activation == 1){
        	$status = 1;
        }

        $avatar = save_img( get_avatar($fullname), WRITEPATH.'avatar/' );

        $data = [
        	"ids" => $ids,
        	"is_admin" => 0,
        	"role" => 0,
        	"fullname" => $fullname,
        	"username" => $username,
        	"email" => $email,
        	"password" => password($password),
        	"plan" => $plan,
        	"expiration_date" => $expiration_date,
        	"timezone" => $timezone,
        	"recovery_key" => NULL,
        	"language" => $language_code,
        	"login_type" => "direct",
        	"avatar" => $avatar,
        	"last_login" => time(),
        	"status" => $status,
        	"changed" => time(),
        	"created" => time(),
        ];

        $user_id = db_insert(TB_USERS, $data);

        $save_team = [
			"ids" => ids(),
			"owner" => $user_id,
			"pid" => $plan,
			"permissions" => $permissions
		];

		db_insert(TB_TEAM, $save_team);

        if( $require_activation == 1 ){
        	$activation_link = base_url("activation/".$ids);
			system_email($user_id, "activation", [
	            "activation_link" => $activation_link
	        ]);

	        ms([
				"status" => "success",
				"message" => __('Thank you for your registration! Confirm your email address now to activate your account.')
			]);
		}else{
			if(get_option("welcome_email_status", 0)){
				system_email($user_id, "welcome");
			}

			ms([
				"status" => "success",
				"message" => __('Success')
			]);
		}
	}

	public function resend_activation(){
		$email = post("email");

		validate("null", __("Email"), $email);
		validate("email", __("Email"), $email);

		$user = db_get("*", TB_USERS, ["email" => $email]);

		if(empty($user)){
			ms([
				"status" => "error",
				"message" => __("User does not exist.")
			]);
		}

		if($user->status == 2){
			ms([
				"status" => "error",
				"message" => __("Your account is activated. Back to the login page to login and start using.")
			]);
		}

		if($user->status == 0){
			ms([
				"status" => "error",
				"message" => __("Your account is banned.")
			]);
		}

		$this->google_recaptcha();

		if($user->status == 1){
			$activation_link = base_url("activation/".$user->ids);
			system_email($user->id, "activation", [
	            "activation_link" => $activation_link
	        ]);

			ms([
				"status" => "success",
				"message" => __("The activation email has been resent. Please check your email inbox. If you don't see it, please try searching for it in your spam folder.")
			]);
		}

		ms([
			"status" => "error",
			"message" => __("Unknown error.")
		]);
	}

	public function forgot_password(){
		$email = post("email");
		validate("null", __("Email"), $email);
		validate("email", __(""), $email);
		$user = db_get("id,status,ids", TB_USERS, ["email" => $email]);

		if(empty($user)){
			ms([
				"status"  => "error",
				"message" => __('Account does not exist.')
			]);
		}

		$this->google_recaptcha();

		$recovery_key = uniqid();
		db_update(TB_USERS, [ "recovery_key" => $recovery_key ], ["id" => $user->id]);
		$recovery_password_link = base_url("recovery_password/".$recovery_key);

		system_email($user->id, "forgot_password", [
            "recovery_password_link" => $recovery_password_link
        ]);

		ms([
			"status" => "success",
			"message" => __('Recovery email sent!')
		]);
	}

	public function recovery_password(){
		$recovery_key = uri("segment", 3);
		$new_password = post("new_password");
		$confirm_new_password = post("confirm_new_password");

		validate("null", __("New password"), $new_password);
		validate("null", __("Confirm new password"), $confirm_new_password);
		validate("min_length", __("New password"), $new_password, 6);
		validate("min_length", __("Confirm new password"), $confirm_new_password, 6);
		validate("other", __("New password and confirm password does not match."), $new_password, $confirm_new_password);
		validate("null", __("Recovery key"), $recovery_key);

		$user = db_get("id,status,ids", TB_USERS, ["recovery_key" => $recovery_key]);

		if(empty($user)){
			ms([
				"status"  => "error",
				"message" => __('Account does not exist.')
			]);
		}

		$this->google_recaptcha();

		db_update(TB_USERS, [ "password" => password($new_password), "recovery_key" => NULL ], ["id" => $user->id]);

		ms([
			"status" => "success",
			"message" => __('Success')
		]);
	}

	public function social_login($social_network){
	 	try {
	 		switch ($social_network) {
	            case 'google':
	                if( !get_option('google_login_status', 0) ){
	                    redirect_to( base_url("login") );
	                }
	                
	                $client_id = get_option('google_login_client_id', '');
	                $client_secret = get_option('google_login_client_secret', '');
	                $callback_url = base_url("login/google");

	                if($client_id == "" || $client_secret == ""){
	                    redirect_to( base_url("login") );
	                }

	                $this->client = new \Google_Client();
	                $this->client->setAccessType("offline");
	                $this->client->setApprovalPrompt("force");
	                $this->client->setApplicationName("Login with Google");
	                $this->client->setClientId( $client_id );
	                $this->client->setClientSecret( $client_secret );
	                $this->client->setRedirectUri( $callback_url );
	                $this->client->setScopes([ 'https://www.googleapis.com/auth/userinfo.email', 'https://www.googleapis.com/auth/userinfo.profile' ] );

	                if(!post("code")){
	                    $url = $this->client->createAuthUrl();
	                    redirect_to($url);
	                }else{
	                    $this->client->authenticate( post("code") );
	                    $oauth2 = new \Google_Service_Oauth2($this->client);
	                    $access_token = $this->client->getAccessToken();
	                    $this->client->setAccessToken($access_token);
	                    $oauth2 = new \Google_Service_Oauth2($this->client);
	                    $response = $oauth2->userinfo->get();

	                    $id = (isset($response->id) && $response->id != "")?$response->id : NULL;
	                    $fullname = (isset($response->name) && $response->name != "")? $response->name : NULL;
	                    $email = (isset($response->email) && $response->email != "")? $response->email : NULL;
	                    $username = NULL;
	                    $avatar = isset($response->picture)?save_img( $response->picture, WRITEPATH.'avatar/' ):NULL;

	                    if(!$email){
	                        throw new Exception( __("To be able to log in, you must give permission for the app to access your email.") );
	                    }

	                    $this->add_social_account("google", $id, $fullname, $email, $username, $avatar);
	                }
	                break;

	            case 'facebook':
	                if( !get_option('facebook_login_status', 0) ){
						redirect_to( base_url("login") );
					}

					$app_id = get_option('facebook_login_app_id', '');
			        $app_secret = get_option('facebook_login_app_secret', '');
			        $app_version = get_option('facebook_login_app_version', 'v16.0');
			        $callback_url = base_url("login/facebook");

			        if($app_id == "" || $app_secret == "" || $app_version == ""){
			            redirect_to( base_url("login") );
			        }

			        $fb = new \JanuSoftware\Facebook\Facebook([
			            'app_id' => $app_id,
			            'app_secret' => $app_secret,
			            'default_graph_version' => $app_version,
			        ]);

					if(!post("code")){
						$helper = $fb->getRedirectLoginHelper();
				        $permissions = ['email'];
				        $login_url = $helper->getLoginUrl( $callback_url , $permissions);
				        redirect_to($login_url);
					}else{
			            $helper = $fb->getRedirectLoginHelper();
			            $accessToken = $helper->getAccessToken($callback_url);
		            	$response = $fb->get("/me?fields=id,name,email,picture.width(100).height(100)", $accessToken);
		            	$response = json_decode($response->getBody());

		            	$id = isset( $response->id )? $response->id : NULL;
		            	$fullname = isset( $response->name )? $response->name : NULL;
		            	$email = isset( $response->email )? $response->email : NULL;
		            	$username = NULL;
		            	$avatar = save_img( $response->picture->data->url, WRITEPATH.'avatar/' );

		            	if(!$email){
		            		throw new Exception( __("To be able to log in, you must give permission for the app to access your email.") );
		            	}

		            	$this->add_social_account("facebook", $id, $fullname, $email, $username, $avatar);
					}
	                break;

	            case 'twitter':
	                if( !get_option('twitter_login_status', 0) ){
						redirect_to( base_url("login") );
					}

					$client_id = get_option('twitter_login_client_id', '') ;
			        $client_secret = get_option('twitter_login_client_secret', '');
			        $callback_url = base_url("login/twitter");

			        if($client_id == "" || $client_secret == ""){
		           		redirect_to( base_url("login") );
			        }

			        $provider = new \Smolblog\OAuth2\Client\Provider\Twitter([
						'clientId'     => $client_id,
						'clientSecret' => $client_secret,
						'redirectUri'  => $callback_url,
					]);

					if (!post("code")) {
						remove_session(['oauth2state', 'oauth2verifier']);

					    $options = [
					        'scope' => [
					            'tweet.read',
					            'tweet.write',
					            'tweet.moderate.write',
					            'users.read',
					            'follows.read',
					            'follows.write',
					            'offline.access',
					            'space.read',
					            'mute.read',
					            'mute.write',
					            'like.read',
					            'like.write',
					            'list.read',
					            'list.write',
					            'block.read',
					            'block.write',
					            'bookmark.read',
					            'bookmark.write'
					        ],
						]; 

						$authUrl = $provider->getAuthorizationUrl($options);
						set_session(['oauth2state' => $provider->getState()]);
						set_session(['oauth2verifier' => $provider->getPkceVerifier()]);
						redirect_to($authUrl);
					} elseif (empty(post("state")) || (post("state") !== get_session("oauth2state"))) {
						remove_session(['oauth2state']);
						throw new \Exception( _e("Invalid state") );
					} else {
						$token = $provider->getAccessToken('authorization_code', [
							'code' => post('code'),
							'code_verifier' => get_session("oauth2verifier"),
						]);
						$response = $provider->getResourceOwner($token);
						$id = $response->getId();
		            	$fullname = $response->getName();
		            	$username = $response->getUsername();
		            	$avatar = save_img( $response->getProfileImageUrl(), WRITEPATH.'avatar/' );
		            	$email = NULL;

		            	$this->add_social_account("twitter", $id, $fullname, $email, $username, $avatar);
			        }
	                break;
	            
	            default:
	                redirect_to( base_url("login") );
	                break;
	        }
	 	} catch (\Exception $e) {
	 		pr($e,1);
	 		echo $e->getMessage()."<br/>";
			echo _e("Redirecting...");
			echo '<script type="text/javascript">setTimeout( function(){ window.location.assign("'.base_url("login").'") }, 5000)</script>';
			exit(0);
	 	}
	}

	public function add_social_account($login_type, $pid, $fullname, $email, $username = "", $avatar = ""){
		$user = db_get("*", TB_USERS, ["pid" => $pid]);
		if(empty($user)){
			$user = db_get("*", TB_USERS, ["email" => $email]);
		}

		if( $avatar == "" ){
			$avatar = save_img( get_avatar($fullname), WRITEPATH.'avatar/' );
		}

		if($username == ""){
			$username = explode("@", $email);
			$username = $username[0];
		}

		if($user){
			$team = db_get("*", TB_TEAM, ["owner" => $user->id]);
			if(!empty($team)){
				$user_id = $user->id;
				$user_ids = $user->ids;
				$team_ids = $team->ids;

				if(file_exists( get_file_path($user->avatar) )){
					unlink( get_file_path($user->avatar) ); 
				}

				$data = [
					"fullname" => $fullname,
	        		"username" => $username,
	        		"email" => $email,
	        		"avatar" => $avatar,
					"last_login" => time()
				];

				if($user->status == 1){
					$data["status"] = 2;
				}

				db_update(TB_USERS, $data, ["id" => $user->id]);
			}else{
				redirect_to( base_url("login") );
			}
		}else{
			$plan = 0;
	        $expiration_date = 0;
	        $permissions = NULL;
	        $plan_item = db_get("*", TB_PLANS, ["type" => 1, "status" => 1]);
	        if(!empty($plan_item)){
	        	$plan = $plan_item->id;
	        	$permissions = $plan_item->permissions;
	        	if($plan_item->trial_day != 0){
	        		$expiration_date = time() + $plan_item->trial_day*86400;
	        	}
	        }

	        $language = db_get("*", TB_LANGUAGE_CATEGORY, ["is_default" => 1, "status" => 1]);
	        $language_code = "en";
	        if(!empty($language)){
	        	$language_code = $language->code;
	        }

			$user_ids = ids();
			$team_ids = ids();
			
			$timezone = NULL;
			if( get_session("timezone") ){
				$timezone = get_session("timezone");
			}

			$save_user = [
				"ids" => $user_ids,
				"pid" => $pid,
	        	"is_admin" => 0,
	        	"role" => 0,
	        	"fullname" => $fullname,
	        	"username" => $username,
	        	"email" => $email,
	        	"password" => NULL,
	        	"plan" => $plan,
	        	"expiration_date" => $expiration_date,
	        	"timezone" => $timezone,
	        	"recovery_key" => NULL,
	        	"language" => $language_code,
	        	"login_type" => $login_type,
	        	"last_login" => time(),
	        	"avatar" => $avatar,
	        	"status" => 2,
	        	"changed" => time(),
	        	"created" => time(),
			];

			$user_id = db_insert(TB_USERS, $save_user);

			$save_team = [
				"ids" => $team_ids,
				"owner" => $user_id,
				"pid" => $plan,
				"permissions" => $permissions
			];

			db_insert(TB_TEAM, $save_team);

			if($email != "" && get_option("welcome_email_status", 0)){
				system_email($user_id, "welcome");
			}
		}

		set_session(["uid" => $user_ids, "team_id" => $team_ids]);
		set_cookies(["uid" => encrypt_encode($user_ids), "team_id", encrypt_encode($team_ids) ], 2419200);
		
		redirect_to( base_url("dashboard") );
	}

	public function logout(){
		remove_session(["uid"]);
	    remove_session(["team_id"]);
	    delete_cookies("uid");
	    delete_cookies("team_id");

	    redirect_to( base_url("login") );
	}

	public function team( $ids = "" ){
		$uid = get_user("id");
        $team_id = get_team("ids");
        $team = db_get("*", TB_TEAM, ["ids" => $ids]);

        if( !empty($team) && $team_id == $team->ids ){
            ms([
                "status" => "success",
                "message" => __("Success")
            ]);
        }

        if($ids == ""){
            if( get_session("owner_team_id") ){
                set_session( [ "team_id" => get_session("owner_team_id") ] );
            }

            ms([
                "status" => "success",
                "message" => __("Success")
            ]);
        }

        if(empty($team)){
            ms([
                "status" => "error",
                "message" => __("Cannot found this team")
            ]);
        }

        $team_member = db_get("*", TB_TEAM_MEMBER, ["team_id" => $team->id, "uid" => $uid]);
        if(empty($team_member)){
            ms([
                "status" => "error",
                "message" => __("Cannot access this team")
            ]);
        }

        set_session(["owner_team_id" => $team_id]);
        set_session(["team_id" => $team->ids]);

        ms([
            "status" => "success",
            "message" => __("Success")
        ]);
	}

	public function language( $ids = "" ){
		$language = db_get("*", TB_LANGUAGE_CATEGORY, ["ids" => $ids]);
		if(!empty($language)){
			set_session(["language" => json_encode($language)]);
		}
		ms([
            "status" => "success",
            "message" => ""
        ]);
	}

	public function timezone(){
		if(post("timezone")){
            set_session(['timezone' => post("timezone")]);
            ms(['status' => 'success']);
        }
        ms(['status' => 'error']);
	}

	public function back_to_admin(){
		if( !get_session("tmp_uid") || !get_session("tmp_team_id") ){
            ms([
                "status" => "error",
                "message" => __("Unscuccessfull")
            ]);
        }

        set_session([
            "uid" => get_session("tmp_uid"), 
            "team_id" => get_session("tmp_team_id"
        ) ]);

        remove_session(["tmp_uid", "tmp_team_id"]);

        ms([
            "status" => "success",
            "message" => __("Success")
        ]);
	}

	public function google_recaptcha(){
		if(get_option('google_recaptcha_status', 0)){
			$captcha = post('g-recaptcha-response');

			validate("null", __("Captcha"), $captcha);

			$ip = $_SERVER['REMOTE_ADDR'];
			$secretkey = get_option('google_recaptcha_secret_key', '');					
			$response=file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=".$secretkey."&response=".$captcha."&remoteip=".$ip);
			$responseKeys = json_decode($response,true);	     
			if(intval($responseKeys["success"]) !== 1) {
			    ms([
					"status"  => "error",
					"message" => __("Wrong captcha try again please")
				]);
			}
		}
	}
}
