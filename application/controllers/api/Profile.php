<?php
require APPPATH . 'libraries/REST_Controller.php';
header("Content-Type: application/json; charset=UTF-8");

class Profile extends REST_Controller
{
    // construct
    public function __construct()
    {
        parent::__construct();
        $this->load->model('profile_m');
    }

    // method index untuk menampilkan semua data mahasiswa dengan get
    function get_post()
    {
            $iduser = $this->input->post('iduser');
            $response = $this->profile_m->getUser($iduser);
            $this->response($response);
    }

    // method index untuk menampilkan semua data mahasiswa dengan get
    function index_post()
    {
            $iduser = $this->input->post('iduser');
            $nama = $this->input->post('nama');
            $email = $this->input->post('email');
            $phone = $this->input->post('phone');
            $password = md5($this->input->post('password'));
            $response = $this->profile_m->save($iduser,$nama,$email,$phone,$password);
            $this->response($response);
    }

}
