<?php
require APPPATH . 'libraries/REST_Controller.php';
header("Content-Type: application/json; charset=UTF-8");

class Hukum extends REST_Controller
{
    // construct
    public function __construct()
    {
        parent::__construct();
        $this->load->model('hukum_m');
    }

    // method index untuk menampilkan semua data mahasiswa dengan get
    function index_get()
    {
            $response = $this->hukum_m->getHukum();
            $this->response($response);
    }

    function list_post()
    {
            $id_hukum = $this->input->post('id_hukum');
            $response = $this->hukum_m->getList($id_hukum);
            $this->response($response);
    }

}
