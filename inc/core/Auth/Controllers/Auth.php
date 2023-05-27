<?php
namespace Core\Auth\Controllers;

class Auth extends \CodeIgniter\Controller
{
    public function __construct(){
        $this->config = parse_config( include realpath( __DIR__."/../Config.php" ) );
        $this->model = new \Core\Auth\Models\AuthModel();
    }
    
    public function login() {
        $this->model->login();
    }

    public function social_login($social_network = "") {
        $this->model->social_login($social_network);
    }

    public function resend_activation() {
        $this->model->resend_activation();
    }

    public function signup() {
        $this->model->signup();
    }

    public function forgot_password() {
        $this->model->forgot_password();
    }

    public function recovery_password() {
        $this->model->recovery_password();
    }

    public function logout() {
        $this->model->logout();
    }

    public function team($ids = ""){
        $this->model->team($ids);
    }

    public function language($ids = ""){
        $this->model->language($ids);
    }

    public function timezone(){
        $this->model->timezone();
    }

    public function back_to_admin(){
        $this->model->back_to_admin();
    }
}