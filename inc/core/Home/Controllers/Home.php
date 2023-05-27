<?php
namespace Core\Home\Controllers;

class Home extends \CodeIgniter\Controller
{
    public function __construct(){
        $this->config = parse_config( include realpath( __DIR__."/../Config.php" ) );
        $this->template = get_option("frontend_template", "Stackgo");
    }
    
    public function index() {
        if(uri("segment", 1) == "Home") redirect_to(  base_url() );

        if ( !get_option("landing_page_status", 1) ) {
            redirect_to( base_url("login") );
        }
        
        if (find_modules("blog_manager")) {
            $blogs = db_fetch("*", TB_BLOGS, ["status" => 1], "id", "DESC", 0, 3);
        }else{
            $blogs = false;
        }
        $faqs = db_fetch("*", TB_FAQS, ["status" => 1], "id", "ASC", 0, 3);
        $data = [
            "title" => $this->config['name'],
            "desc" => $this->config['desc'],
            "content" => view("Frontend\\".$this->template."\Views\\home", ['faqs' => $faqs, 'blogs' => $blogs])
        ];

        return view("Frontend\\".$this->template."\Views\\index", $data);
    }

    public function pricing() {
        if(uri("segment", 1) == "Home" || !find_modules("payment")) redirect_to(  base_url() );

        $block_frame_posts = get_blocks("block_frame_posts", false, false);
        $total_social = count($block_frame_posts);

        $plans = db_fetch("*", TB_PLANS, ["status" => 1, "type" => 2], "position", "ASC");

        $data = [
            "title" => $this->config['name'],
            "desc" => $this->config['desc'],
            "content" => view("Frontend\\".$this->template."\Views\\pricing", ["plans" => $plans, "total_social" => $total_social])
        ];

        return view("Frontend\\".$this->template."\Views\\index", $data);
    }

    public function features() {
        if(uri("segment", 1) == "Home") redirect_to(  base_url() );
        $data = [
            "title" => $this->config['name'],
            "desc" => $this->config['desc'],
            "content" => view("Frontend\\".$this->template."\Views\\features")
        ];

        return view("Frontend\\".$this->template."\Views\\index", $data);
    }

    public function faqs() {
        if(uri("segment", 1) == "Home") redirect_to(  base_url() );
        $faqs = db_fetch("*", TB_FAQS, ["status" => 1], "id", "ASC");
        $data = [
            "title" => $this->config['name'],
            "desc" => $this->config['desc'],
            "content" => view("Frontend\\".$this->template."\Views\\faqs", ['faqs' => $faqs])
        ];

        return view("Frontend\\".$this->template."\Views\\index", $data);
    }

    public function blogs($slug = false, $id = false) {
        if(uri("segment", 1) == "Home" || !find_modules("blog_manager")) redirect_to(  base_url() );


        if(!$slug){
            $blogs = db_fetch("*", TB_BLOGS, ["status" => 1], "id", "DESC");
            $data = [
                "title" => $this->config['name'],
                "desc" => $this->config['desc'],
                "content" => view("Frontend\\".$this->template."\Views\\blogs", ["blogs" => $blogs])
            ];
        }else{
            $blog = db_get("*", TB_BLOGS, ["id" => $id, "status" => 1]);
            if(!$blog){ redirect_to( base_url("blog") ); }
            $recent_posts = db_fetch("*", TB_BLOGS, ["id !=" => $blog->id, "status" => 1], "id", "DESC", 0, 5);
            $data = [
                "title" => $this->config['name'],
                "desc" => $this->config['desc'],
                "content" => view("Frontend\\".$this->template."\Views\\blog_details", ["result" => $blog, "recent_posts" => $recent_posts])
            ];
        }

        return view("Frontend\\".$this->template."\Views\\index", $data);
    }

    public function privacy_policy() {
        if(uri("segment", 1) == "Home") redirect_to(  base_url("privacy_policy") );
        $data = [
            "title" => $this->config['name'],
            "desc" => $this->config['desc'],
            "content" => view("Frontend\\".$this->template."\Views\\privacy_policy")
        ];

        return view("Frontend\\".$this->template."\Views\\index", $data);
    }

    public function terms_of_service() {
        if(uri("segment", 1) == "Home") redirect_to(  base_url("terms_of_service") );
        $data = [
            "title" => $this->config['name'],
            "desc" => $this->config['desc'],
            "content" => view("Frontend\\".$this->template."\Views\\terms_of_service")
        ];

        return view("Frontend\\".$this->template."\Views\\index", $data);
    }

    public function login() {
        if(uri("segment", 1) == "Home") redirect_to(  base_url("login") );

        $redirect = post("redirect");

        if($redirect != ""){
            $redirect = urldecode( $redirect );
        }elsE{
            $redirect = base_url("login");
        }

        $data = [
            "title" => $this->config['name'],
            "desc" => $this->config['desc'],
            "content" => view("Frontend\\".$this->template."\Views\\login", ["redirect" => $redirect,])
        ];

        return view("Frontend\\".$this->template."\Views\\auth", $data);
    }

    public function signup() {
        if(uri("segment", 1) == "Home") redirect_to(  base_url("signup") );
        if ( !get_option("signup_status", 1) ) {
            redirect_to( base_url("login") );
        }

        $data = [
            "title" => $this->config['name'],
            "desc" => $this->config['desc'],
            "content" => view("Frontend\\".$this->template."\Views\\signup")
        ];

        return view("Frontend\\".$this->template."\Views\\auth", $data);
    }

    public function forgot_password() {

        if(uri("segment", 1) == "Home") redirect_to(  base_url("forgot_password") );

        $data = [
            "title" => $this->config['name'],
            "desc" => $this->config['desc'],
            "content" => view("Frontend\\".$this->template."\Views\\forgot_password")
        ];

        return view("Frontend\\".$this->template."\Views\\auth", $data);
    }

    public function recovery_password() {
        if(uri("segment", 1) == "Home") redirect_to(  base_url("recovery_password") );

        $recovery_key = uri("segment", 2);
        if(!$recovery_key){
            redirect_to(base_url("login"));
        }

        $user = db_get("id,status,ids", TB_USERS, ["recovery_key" => $recovery_key]);
        if(empty($user)){
            redirect_to(base_url("login"));
        }
        
        $data = [
            "title" => $this->config['name'],
            "desc" => $this->config['desc'],
            "content" => view("Frontend\\".$this->template."\Views\\recovery_password")
        ];

        return view("Frontend\\".$this->template."\Views\\auth", $data);
    }

    public function activation($ids = "") {
        if(uri("segment", 1) == "Home") redirect_to(  base_url("activation") );

        $user = db_get("*", TB_USERS, ["ids" => $ids]);
        $check_active = 0;
        if(!empty($user)){
            if($user->status == 1){
                $check_active = 1;

                if(get_option("welcome_email_status", 0)){
                    system_email($user->id, "welcome");
                }

                db_update(TB_USERS, ["status" => 2], ["id" => $user->id]);
            }
        }

        $data = [
            "title" => $this->config['name'],
            "desc" => $this->config['desc'],
            "content" => view("Frontend\\".$this->template."\Views\\activation", ['status' => $check_active])
        ];

        return view("Frontend\\".$this->template."\Views\\auth", $data);
    }

    public function resend_activation() {
        if(uri("segment", 1) == "Home") redirect_to(  base_url("resend_activation") );

        $data = [
            "title" => $this->config['name'],
            "desc" => $this->config['desc'],
            "content" => view("Frontend\\".$this->template."\Views\\resend_activation")
        ];

        return view("Frontend\\".$this->template."\Views\\auth", $data);
    }

    public function show404() {
        if(uri("segment", 1) == "Home") redirect_to(  base_url() );

        $data = [
            "title" => $this->config['name'],
            "desc" => $this->config['desc'],
            "content" => view("Frontend\\".$this->template."\Views\\show404")
        ];


        echo view("Frontend\\".$this->template."\Views\\index", $data);
    }
}