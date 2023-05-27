<?php
namespace Core\Profile\Controllers;
use Dompdf\Dompdf;

class Profile extends \CodeIgniter\Controller
{
    public function __construct(){
        $this->config = parse_config( include realpath( __DIR__."/../Config.php" ) );
        $this->model = new \Core\Profile\Models\ProfileModel();
    }
    
    public function index( $page = false ) {
        $team_id = get_team("id");
        $user_id = get_user("id");

        $languages = db_fetch("*", TB_LANGUAGE_CATEGORY, [ "status" => 1 ]);
        $user = db_get("*", TB_USERS, ["id" => $user_id]);
        $plan = db_get("*", TB_PLANS, ["id" => $user->plan]);
        $invoices = $this->model->invoices();
        $settings = get_blocks("block_profile_settings", false, true);

        if($settings){
            foreach ($settings as $key => $value) {
                if(!is_array($value) || !isset($value["data"]) || !isset($value["data"]["content"])){
                    unset($settings[$key]);
                }
            }
        }

        $data = [
            "title" => $this->config['name'],
            "desc" => $this->config['desc'],
            "content" => view('Core\Profile\Views\content', [ "languages" => $languages, "plan" => $plan, "invoices" => $invoices, "settings" => $settings ])
        ];

        return view('Core\Profile\Views\index', $data);
    }

    public function save_account(){
        $user_id = get_user("id");

        $fullname = post("fullname");
        $username = post("username");
        $email    = post("email");
        $language = post("language");
        $timezone = post("timezone");
        $avatar   = post("avatar");

        validate("null", __("Fullname"), $fullname);
        
        if (get_option("accept_change_username", 1)) {
            validate("null", __("Username"), $username);
            validate("min_length", __("Username"), $username, 6);
            $check_username = db_get("id", TB_USERS, ["username" => $username, "id != " => $user_id]);
            validate("not_empty", __("The username already exists."), $check_username);
        }

        if (get_option("accept_change_email", 1)) {
            validate("null", __("Email"), $email);
            validate("email", __("Email"), $email);
            validate("min_length", __("Email"), $email, 6);
            $check_email = db_get("id", TB_USERS, ["email" => $email, "id != " => $user_id]);
            validate("not_empty", __("The email already exists."), $check_email);
        }
        
        validate("null", __("Language"), $language);
        validate("null", __("Timezone"), $timezone);

        $data = [
            "avatar" => $avatar,
            "language" => $language,
            "timezone" => $timezone
        ];

        if (get_option("accept_change_username", 1)) {
            $data['username'] = $username;
        }

        if (get_option("accept_change_email", 1)) {
            $data['email'] = $email;
        }

        db_update(TB_USERS, $data, [ "id" => $user_id ]);

        ms([
            "status" => "success",
            "message" => __('Success')
        ]);
    }

    public function save_change_password(){
        $user_id = get_user("id");
        $have_old_password = get_user("password");

        $old_password = post("old_password");
        $new_password = post("new_password");
        $confirm_new_password = post("confirm_new_password");

        if($have_old_password != ""){
            validate("null", "Old password", $old_password);
        }
        validate("null", __("New password"), $new_password);
        validate("null", __("Confirm new password"), $confirm_new_password);
        validate("min_length", __("New password"), $new_password, 6);
        validate("min_length", __("Confirm new password"), $confirm_new_password, 6);
        validate("equal", __("New password cannot be the same as your old password"), $new_password, $old_password);

        if($have_old_password != ""){
            $check_old_password = db_get("id", TB_USERS, ["password" => password($old_password), "id" => $user_id]);
            validate("empty", __("Old password does not match"), $check_old_password);
        }

        validate("other", __("New password and confirm password does not match"), $new_password, $confirm_new_password);

        $data = [
            "password" => password($new_password)
        ];

        db_update(TB_USERS, $data, [ "id" => $user_id ]);

        ms([
            "status" => "success",
            "message" => __('Success')
        ]);
    }

    public function save_bill_info(){
        $user_id = get_user("id");

        $bill_owner = post("bill_owner");
        $bill_tax_number = post("bill_tax_number");
        $bill_address = post("bill_address");

        update_user_data("bill_owner", $bill_owner);
        update_user_data("bill_tax_number", $bill_tax_number);
        update_user_data("bill_address", $bill_address);

        ms([
            "status" => "success",
            "message" => __('Success')
        ]);
    }

    public function download_invoice($invoice_id = ""){
        $invoice = $this->model->invoice($invoice_id);
        if(!$invoice) redirect_to( base_url("profile") );

        $dompdf = new Dompdf();
        $data = [
            'logo'     => $this->imageToBase64( get_option("website_logo_color", base_url("assets/img/logo-color.svg")) ),
            'invoice'         => $invoice,
        ];
        $html = view('Core\Profile\Views\invoice', $data);
        $dompdf->loadHtml( $html );
        $dompdf->render();
        $dompdf->stream("invoice-".str_pad($invoice->id, 5, "0", STR_PAD_LEFT).".pdf", [ 'Attachment' => true ]);
    }

    private function imageToBase64($path) {
        $path = $path;
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $stream_opts = [
            "ssl" => [
                "verify_peer"=>false,
                "verify_peer_name"=>false,
            ]
        ]; 

        $data = @file_get_contents($path, false, stream_context_create($stream_opts));
            
        if($data){
            $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
            return $base64;
        }else{
            return false;
        }
    }
    
}