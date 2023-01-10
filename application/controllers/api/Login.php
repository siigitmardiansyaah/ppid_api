<?php
require APPPATH . 'libraries/REST_Controller.php';
header("Content-Type: application/json; charset=UTF-8");

class Login extends REST_Controller
{
    // construct
    public function __construct()
    {
        parent::__construct();
        $this->load->model('auth_m');
    }

    // method index untuk menampilkan semua data mahasiswa dengan get
    function index_post()
    {
            $email = $this->input->post('email');
            $password = md5($this->input->post('password'));
            $response = $this->auth_m->login($email,$password);
            $this->response($response);
    }

}
