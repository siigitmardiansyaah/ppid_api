<?php
require APPPATH . 'libraries/REST_Controller.php';
header("Content-Type: application/json; charset=UTF-8");

class Register extends REST_Controller
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
            $nama = $this->input->post('nama');
            $no_hp = $this->input->post('no_hp');
            $email = $this->input->post('email');
            $password = md5($this->input->post('password'));
            $response = $this->auth_m->register($nama,$email,$password,$no_hp);
            $this->response($response);
    }

}
