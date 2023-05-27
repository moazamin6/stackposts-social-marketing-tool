<?php
namespace Core\Faqs_manager\Controllers;

class Faqs_manager extends \CodeIgniter\Controller
{
    public function __construct(){
        $this->config = parse_config( include realpath( __DIR__."/../Config.php" ) );
        $this->class_name = get_class_name($this);
        $this->model = new \Core\Faqs_manager\Models\Faqs_managerModel();
    }
    
    public function index( $page = false ) {
        $data = [
            "title" => $this->config['name'],
            "desc" => $this->config['desc'],
        ];

        switch ( $page ) {
            case 'update':
                $item = false;
                $ids = uri('segment', 4);
                if( $ids ){
                    $item = db_get("*", TB_FAQS, [ "ids" => $ids ]);
                }

                $data['content'] = view('Core\Faqs_manager\Views\update', ["result" => $item]);
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

                $data['content'] = view('Core\Faqs_manager\Views\list', $data_content);
                break;
        }

        return view('Core\Faqs_manager\Views\index', $data);
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
            "data" => view('Core\Faqs_manager\Views\ajax_list', $data)
        ] );
    }

    public function save( $ids = "" ){
        $title = post("title");
        $content = post("content");
        $item = false;

        if ($ids != "") {
            $item = db_get("*", TB_FAQS, ["ids" => $ids]);
        }

        if (!$this->validate([
            'title' => 'required'
        ])) {
            ms([
                "status" => "error",
                "message" => __("Title is required")
            ]);
        }

        if (!$this->validate([
            'content' => 'required'
        ])) {
            ms([
                "status" => "error",
                "message" => __("Content is required")
            ]);
        }

        $data = [
            "title" => $title,
            "content" => $content,
            "status" => 1,
            "changed" => time(),
        ];

        if( empty($item) ){
            $data['ids'] = ids();
            $data['created'] = time();

            db_insert(TB_FAQS, $data);
        }else{
            db_update(TB_FAQS, $data, [ "id" => $item->id ]);
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
                db_delete(TB_FAQS, ['ids' => $id]);
            }
        }
        elseif( is_string($ids) )
        {
            db_delete(TB_FAQS, ['ids' => $ids]);
        }

        ms([
            "status" => "success",
            "message" => __('Success')
        ]);
    }
}