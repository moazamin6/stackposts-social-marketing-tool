<?php
namespace Core\Caption\Models;
use CodeIgniter\Model;

class CaptionModel extends Model
{
    public function get_list( $return_data = true )
    {
        $team_id = get_team("id");
        $current_page = (int)(post("current_page") - 1);
        $per_page = post("per_page");
        $total_items = post("total_items");
        $keyword = post("keyword");

        $db = \Config\Database::connect();
        $builder = $db->table(TB_CAPTIONS);
        $builder->select('*');

        if( $keyword ){
            $array = [
                'title' => $keyword, 
                'content' => $keyword
            ];
            $builder->orLike($array);
        }

        $builder->where('team_id', $team_id);
        
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

    public function get_captions(){
        $keyword = post("keyword");
        $page = (int)post("page");
        $team_id = (int)get_team("id");

        $db = \Config\Database::connect();
        $builder = $db->table(TB_CAPTIONS);

        $builder->select("*");
        $builder->where('team_id', $team_id);

        if( $keyword && $keyword != '' ){
            $builder->like('name', $keyword);
        }

        $builder->orderBy("created", "DESC");
        $builder->limit(50, $page * 50);

        $query = $builder->get();
        $result = $query->getResult();
        $query->freeResult();
        return $result;
    }
}
