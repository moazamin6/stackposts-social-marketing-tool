<?php
namespace Core\Instagram_profiles\Models;
use CodeIgniter\Model;

class Instagram_profilesModel extends Model
{
	public function __construct(){
        $this->config = include realpath( __DIR__."/../Config.php" );
    }
    
	public function block_accounts($path = ""){
        $team_id = get_team("id");
        $accounts = db_fetch("*", TB_ACCOUNTS, "social_network = 'instagram' AND category = 'profile' AND team_id = '{$team_id}'");
        $user_proxy = db_fetch("id", TB_ACCOUNTS, "social_network = 'instagram' AND category = 'profile' AND team_id = '{$team_id}' AND login_type = 2");

        return [
            "can_use_proxy" => $user_proxy,
        	"button" => view( 'Core\Instagram_profiles\Views\button', [ 'config' => $this->config ] ),
        	"content" => view( 'Core\Instagram_profiles\Views\content', [ 'config' => $this->config, 'accounts' => $accounts ] )
        ];
    }

    public function block_social_settings($path = ""){
        return [
            "menu" => view( 'Core\Instagram_profiles\Views\settings\menu', [ 'config' => $this->config ] ),
            "content" => view( 'Core\Instagram_profiles\Views\settings\content', [ 'config' => $this->config ] )
        ];
    }
}
