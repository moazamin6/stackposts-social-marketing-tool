<?php
namespace Core\Language\Models;
use CodeIgniter\Model;

class LanguageModel extends Model
{
    public function __construct(){
        $this->config = parse_config( include realpath( __DIR__."/../Config.php" ) );
    }
    
    public function block_settings($path = ""){
        return array(
            "position" => 8500,
            "menu" => view( 'Core\Language\Views\settings\menu', [ 'config' => $this->config ] ),
            "content" => view( 'Core\Language\Views\settings\content', [ 'config' => $this->config ] )
        );
    }

    public function block_topbar($path = ""){
        $result = db_fetch("*", TB_LANGUAGE_CATEGORY, ["status" => 1]);

        $default = [];
        $session = get_session('language');
        if(!empty($result)){
            foreach ($result as $row) {
                if($row->is_default == 1){
                    $default = [
                        'name' => $row->name,
                        'icon' => $row->icon,
                        'code' => $row->code,
                        'dir'  => $row->dir,
                    ];
                }
            }

            if(!$session){
                if(!empty($default)){
                    set_session(['language' => json_encode($default)]);
                }
            }else{
                $default = json_decode($session);
            }
        }else{
            remove_session(["language"]);
        }

        return array(
            "position" => 7000,
            "topbar" => view( 'Core\Language\Views\topbar', [ 'config' => $this->config, "result" => $result, "default" => $default ] )
        );
    }

    public function get_list( $code, $return_data = true )
    {
        $current_page = (int)(post("current_page") - 1);
        $per_page = post("per_page");
        $total_items = post("total_items");
        $keyword = post("keyword");

        $db = \Config\Database::connect();
        $builder = $db->table(TB_LANGUAGE);
        $builder->select('*');

        $builder->where("( code = '{$code}' )");

        if( $keyword ){
            $builder->where("( text LIKE '%{$keyword}%' )") ;
        }

        if( !$return_data )
        {
            $result =  $builder->countAllResults();
        }
        else
        {
            $builder->limit($per_page, $per_page*$current_page);
            $query = $builder->get();
            $result = $query->getResult();
            $query->freeResult();
        }
        
        return $result;
    }
}