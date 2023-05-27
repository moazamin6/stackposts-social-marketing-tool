<?php
namespace Core\Caption\Controllers;

class Caption extends \CodeIgniter\Controller
{
    public function __construct(){
        $this->config = parse_config( include realpath( __DIR__."/../Config.php" ) );
        $this->class_name = get_class_name($this);
        $this->model = new \Core\Caption\Models\CaptionModel();
    }
    
    public function index( $page = false ) {
        $team_id = get_team("id");
        $data = [
            "title" => $this->config['menu']['sub_menu']['name'],
            "desc" => $this->config['desc'],
        ];

        switch ( $page ) {
            case 'update':
                $item = false;
                $ids = uri('segment', 4);
                if( $ids ){
                    $item = db_get("*", TB_CAPTIONS, [ "ids" => $ids, "team_id" => $team_id ]);
                }

                $data['content'] = view('Core\Caption\Views\update', ["result" => $item]);
                break;

            default:
                $total = $this->model->get_list(false);

                $datatable = [
                    "total_items" => $total,
                    "per_page" => 30,
                    "current_page" => 1,

                ];

                $data_content = [
                    'total' => $total,
                    'datatable'  => $datatable,
                    'config'  => $this->config,
                ];

                $data['content'] = view('Core\Caption\Views\list', $data_content);
                break;
        }

        return view('Core\Caption\Views\index', $data);
    }

    public function block( $params = [] ){
        $data = [
            'name' => isset($params['name'])?$params['name']:"caption",
            'value' => isset($params['value'])?$params['value']:"",
            'placeholder' => isset($params['placeholder'])?$params['placeholder']:__("Write a caption"),
        ];
        return view('Core\Caption\Views\block', $data);
    }

    public function ajax_list(){
        $total_items = $this->model->get_list(false);
        $result = $this->model->get_list(true);
        $data = [
            "result" => $result,
            "config" => $this->config
        ];
        ms( [
            "total_items" => $total_items,
            "data" => view('Core\Caption\Views\ajax_list', $data)
        ] );
    }

    public function get(){
        $name = post("name");
        $data = [ 'name' => $name ];
        return view('Core\Caption\Views\popup_caption', $data);
    }

    public function load_captions(){
        $result = $this->model->get_captions();
        if(post('page') != 0 && empty($result)) return false;
        $data = [
            'result' => $result,
            'page' => (int)post('page'),
            'config'  => $this->config
        ];
        
        return view('Core\Caption\Views\load_captions', $data);
    }

    public function popup_save(){
        $data = [];
        return view('Core\Caption\Views\popup_save', $data);
    }

    public function save( $ids = '' ){
        $team_id = get_team("id");
        $title = post("caption_title");
        $content = post("caption_content");
        $item = false;

        if ($ids != "") {
            $item = db_get("*", TB_CAPTIONS, ["ids" => $ids]);
        }

        if (!$this->validate([
            'caption_title' => 'required'
        ])) {
            ms([
                "status" => "error",
                "message" => __("Title is required")
            ]);
        }

        if (!$this->validate([
            'caption_content' => 'required'
        ])) {
            ms([
                "status" => "error",
                "message" => __("Caption is required")
            ]);
        }

        $data = [
            "team_id" => $team_id,
            "title" => $title,
            "content" => $content,
            "changed" => time(),
        ];

        if( empty($item) ){
            $data['ids'] = ids();
            $data['created'] = time();

            db_insert(TB_CAPTIONS, $data);
        }else{
            db_update(TB_CAPTIONS, $data, [ "id" => $item->id ]);
        }

        ms([
            "status" => "success",
            "message" => __('Success')
        ]);
    }

    public function delete( $ids = '' ){
        if($ids == ''){
            $ids = post('id');
        }

        if( empty($ids) ){
            ms([
                "status" => "error",
                "message" => __('Please select an item to delete')
            ]);
        }

        if( is_array($ids) )
        {
            foreach ($ids as $id) 
            {
                db_delete(TB_CAPTIONS, ['ids' => $id]);
            }
        }
        elseif( is_string($ids) )
        {
            db_delete(TB_CAPTIONS, ['ids' => $ids]);
        }

        ms([
            "status" => "success",
            "message" => __('Success')
        ]);
    }
}