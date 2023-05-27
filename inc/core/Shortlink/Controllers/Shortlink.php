<?php
namespace Core\Shortlink\Controllers;

class Shortlink extends \CodeIgniter\Controller
{
    public function __construct(){
        $reflect = new \ReflectionClass(get_called_class());
        $this->module = strtolower( $reflect->getShortName() );
        $this->config = parse_config( include realpath( __DIR__."/../Config.php" ) );
    }

    public function widget( $params = [] ){
        return view('Core\Shortlink\Views\widget', []);
    }

    public function bitly(){
        $bitly_api_url = "https://api-ssl.bitly.com/oauth/access_token";
        $client_id = get_option("shortlink_bitly_client_id", "");
        $client_secret = get_option("shortlink_bitly_client_secret", "");
        $redirect_url = base_url($this->module."/bitly");

        if($client_id == "" || $client_secret == ""){
            redirect_to( base_url("settings/index/shortlink") ); 
        }

        if(post("code"))
        {
            // Params for request
            $params = array(
                'client_id' => $client_id,
                'client_secret' => $client_secret,
                'code' => post("code"),
                'redirect_uri' => $redirect_url,
                'state' => post("state"),
                'grant_type' => 'authorization_code'
            );

            $curl = curl_init();
            curl_setopt($curl, CURLOPT_URL, $bitly_api_url);
            curl_setopt($curl, CURLOPT_POST, 1);
            curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($params));
            curl_setopt(
                $curl,
                CURLOPT_HTTPHEADER,
                array(
                    'Content-Type: application/x-www-form-urlencoded',
                    'Accept: application/json'
                )
            );

            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            $access_token = json_decode( curl_exec($curl) );

            if (curl_errno($curl)) {
                $error_msg = curl_error($curl);
                redirect_to( base_url("post?error_msg=".$access_token) );
            }
            curl_close ($curl);

            if(!$access_token || !isset($access_token->access_token)){
                redirect_to( base_url("post?error_msg=".urlencode( __("Unknown error") )) );
            }

            get_team_data("shortlink_status", 0);
            get_team_data("bitly_access_token", "");
            get_team_data("bitly_user_id", "");
            
            update_team_data("shortlink_status", 1);
            update_team_data("bitly_access_token", $access_token->access_token);
            update_team_data("bitly_user_id", $access_token->login);

            redirect_to( base_url("post") );
        }
        else
        {
            redirect_to("https://bitly.com/oauth/authorize?client_id={$client_id}&state=".ids()."&redirect_uri=".$redirect_url);
        }
    }

    public function disconnect_bitly(){
        update_team_data("shortlink_status", 0);
        update_team_data("bitly_access_token", "");
        update_team_data("bitly_user_id", "");

        ms([
            "status" => "success",
            "message" => __("Success")
        ]);
    }
}