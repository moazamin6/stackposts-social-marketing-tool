<?php
namespace Core\Mail\Controllers;

class Mail extends \CodeIgniter\Controller
{
    public function __construct(){
        $this->config = parse_config( include realpath( __DIR__."/../Config.php" ) );
        $this->model = new \Core\Mail\Models\MailModel();
    }

    public function index( $page = false ) {
        $data = [
            "title" => $this->config['name'],
            "desc" => $this->config['desc']
        ];

        switch ( $page ) {
            case 'config_mail_server':
                $result = db_fetch("*", TB_SMTP, [], "id", "ASC");
                $data['content'] = view('Core\Mail\Views\config_mail_server', [
                    "result" => $result
                ]);
                break;

            case 'mail_contents':
                $data['content'] = view('Core\Mail\Views\mail_contents', []);
                break;
            
            default:
                $data['content'] = view('Core\Mail\Views\template', [
                    "templates" => $this->request->block_mail_templates
                ]);
                break;
        }

        return view('Core\Mail\Views\index', $data);
    }

    public function save_sender(){
        $data = $this->request->getPost();

        if(is_array($data)){
            foreach ($data as $key => $value) {
                if($key != 'csrf'){
                    update_option( $key, trim( htmlspecialchars( $value ) ) );
                }
            }
        }

        ms([
            "status"  => "success",
            "message" => __('Success'),
        ]);
    }

    public function poupup_add_smtp($ids = "") {
        $result = db_get("*", TB_SMTP, ["ids" => $ids]);

        $data = [
            'config'  => $this->config,
            'result' => $result
        ];
        return view('Core\Mail\Views\poupup_add_smtp', $data);
    }

    public function save_smtp( $ids = false ) {
        $smtp_server = post("smtp_server");
        $smtp_username = post("smtp_username");
        $smtp_password = post("smtp_password");
        $smtp_port = post("smtp_port");
        $smtp_encryption = post("smtp_encryption");
        $status = (int)post("status");

        validate("null", __("SMTP Server"), $smtp_server);
        validate("null", __("SMTP Username"), $smtp_username);
        validate("null", __("SMTP Password"), $smtp_password);
        validate("null", __("SMTP Port"), $smtp_port);
        validate("null", __("SMTP Encryption"), $smtp_encryption);

        $data = [
            "server" => $smtp_server,
            "username" => $smtp_username,
            "password" => $smtp_password,
            "port" => $smtp_port,
            "encryption" => $smtp_encryption,
            "status" => $status,
        ];

        $result = db_get("*", TB_SMTP, ["ids" => $ids]);

        if(empty($result)){
            $data["ids"] = ids();
            db_insert(TB_SMTP, $data);
        }else{
            db_update(TB_SMTP, $data, ["ids" => $result->ids]);
        }

        ms([
            "status" => "success",
            "message" => __('Success')
        ]);
    }

    public function delete_smtp( $ids = '' ){
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
                db_delete(TB_SMTP, ['ids' => $id]);
            }
        }
        elseif( is_string($ids) )
        {
            db_delete(TB_SMTP, ['ids' => $ids]);
        }

        ms([
            "status" => "success",
            "message" => __('Success')
        ]);
    }

    public function active_template($name = ""){
        $templates = $this->request->block_mail_templates;

        validate("null", __("Template"), $name);

        $check = false;
        foreach ($templates as $key => $value) {
            if($name == $value['name']){
                $check = true;
            }
        }

        if(!$check){
            ms([
                "status" => "error",
                "message" => __('Cannot found email template')
            ]);  
        }

        get_option("mail_template", "Dora");
        update_option("mail_template", $name);

        ms([
            "status" => "success",
            "message" => __('Success')
        ]);   
    }

    public function save_mail_contents(){
        $data = $this->request->getPost();

        if(is_array($data)){
            foreach ($data as $key => $value) {
                if($key != 'csrf'){
                    update_option( $key, trim( htmlspecialchars( $value ) ) );
                }
            }
        }

        ms([
            "status"  => "success",
            "message" => __('Success'),
        ]);
    }

    //Page Page
    public function demo($type="activation"){
        $subject = get_option('activation_email_subject', 'Hello {fullname}! Activation your account');
        $content = get_option('activation_email_content', "Welcome to {website_name}! <br/><br/>Hello {fullname},  <br/><br/>Thank you for joining! We're glad to have you as community member, and we're stocked for you to start exploring our service. <br/>All you need to do is activate your account: <br/><a href='{activation_link}' target='_blank'>{activation_link}</a> <br/><br/>Thanks and Best Regards!");

        return view('Core\Mail\Views\Template\Dora\index', [ "subject" => $subject, "content" => $content ]);
    }
}