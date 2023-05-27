<?php
namespace Core\Faqs_manager\Models;
use CodeIgniter\Model;

class Faqs_managerModel extends Model
{
    public function get_list( $return_data = true )
    {
        $current_page = (int)(post("current_page") - 1);
        $per_page = post("per_page");
        $total_items = post("total_items");
        $keyword = post("keyword");

        $db = \Config\Database::connect();
        $builder = $db->table(TB_FAQS);
        $builder->select('*');

        if( $keyword ){
            $array = [
                'title' => $keyword, 
                'content' => $keyword
            ];
            $builder->orLike($array);
        }
        
        if( !$return_data )
        {
            $result =  $builder->countAllResults();
        }
        else
        {
            $builder->limit($per_page, $per_page*$current_page);
            $builder->orderBy("created", "DESC");
            $query = $builder->get();
            $result = $query->getResult();
            $query->freeResult();
        }
        
        return $result;
    }
}
