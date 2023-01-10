<?php
require APPPATH . 'libraries/REST_Controller.php';
header("Content-Type: application/json; charset=UTF-8");

class Permohonan extends REST_Controller
{
    // construct
    public function __construct()
    {
        parent::__construct();
        $this->load->model('permohonan_m');
    }

    // method index untuk menampilkan semua data mahasiswa dengan get
    function list_post()
    {
            $iduser = $this->input->post('iduser');
            $response = $this->permohonan_m->getPermohonan($iduser);
            $this->response($response);
    }

    function pengajuan_post()
    {
            $iduser = $this->input->post('iduser');
            $id_pengajuan = $this->input->post('id_pengajuan');
            $response = $this->permohonan_m->getPermohonanbyId($iduser,$id_pengajuan);
            $this->response($response);
    }

    function aduan_post() {
        $iduser = $this->input->post('iduser');
        $response = $this->permohonan_m->getAduan($iduser);
        $this->response($response);
    }

    // method index untuk menampilkan semua data mahasiswa dengan get
    function index_post()
    {
            $iduser = $this->input->post('iduser');
            $nama_pemohon = $this->input->post('nama_pemohon');
            $alamat_pemohon = $this->input->post('alamat_pemohon');
            $nomor_pemohon = $this->input->post('nomor_pemohon');
            $email_pemohon = $this->input->post('email_pemohon');
            $informasi_pemohon = $this->input->post('informasi_pemohon');
            $alasan_pemohon = $this->input->post('alasan_pemohon');
            $nama_pengguna = $this->input->post('nama_pengguna');
            $alamat_pengguna = $this->input->post('alamat_pengguna');
            $nomor_pengguna = $this->input->post('nomor_pengguna');
            $email_pengguna = $this->input->post('email_pengguna');
            $tujuan_pengguna = $this->input->post('tujuan_pengguna');
            $response = $this->permohonan_m->save($iduser,$nama_pemohon,$alamat_pemohon,$nomor_pemohon,$email_pemohon,
            $informasi_pemohon,$alasan_pemohon,$nama_pengguna,$alamat_pengguna,$nomor_pengguna,$email_pengguna,$tujuan_pengguna);
            $this->response($response);
    }

}
