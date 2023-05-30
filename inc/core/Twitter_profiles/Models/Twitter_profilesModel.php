<?php
namespace Core\Twitter_profiles\Models;
use CodeIgniter\Model;

class Twitter_profilesModel extends Model
{
	public function __construct(){
        $this->config = include realpath( __DIR__."/../Config.php" );
    }
    
	public function block_accounts($path = ""){
        $team_id = get_team("id");
        $accounts = db_fetch("*", TB_ACCOUNTS, "social_network = 'twitter' AND category = 'profile' AND team_id = '{$team_id}'");
        return [
        	"button" => view( 'Core\Twitter_profiles\Views\button', [ 'config' => $this->config ] ),
        	"content" => view( 'Core\Twitter_profiles\Views\content', [ 'config' => $this->config, 'accounts' => $accounts ] )
        ];
    }

    public function block_social_settings($path = ""){
        return [
            "menu" => view( 'Core\Twitter_profiles\Views\settings\menu', [ 'config' => $this->config ] ),
            "content" => view( 'Core\Twitter_profiles\Views\settings\content', [ 'config' => $this->config ] )
        ];
    }

    public function block_profile_settings(){
        if (permission("twitter_post")) {
            return array(
                "position" => 1000,
                "content" => view( 'Core\Twitter_profiles\Views\settings', [ 'config' => $this->config ] )
            );
        }
    }
}
