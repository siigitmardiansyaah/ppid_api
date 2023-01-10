<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
date_default_timezone_set("Asia/Jakarta");

class Permohonan_m extends CI_Model {

    public function empty_response(){
        $response['status']=502;
        $response['error']=true;
        $response['message']='Field tidak boleh kosong';
        return $response;
      } 

      function getPermohonan($iduser) {
        $this->db->select('pengajuan_id, DATE_FORMAT(waktu, "%d-%m-%Y %H:%i") as waktu, DATE_FORMAT(STR_TO_DATE(send_bidang, "%d-%m-%Y %H:%i"),"%d-%m-%Y %H:%i") as send_bidang, DATE_FORMAT(STR_TO_DATE(diterima, "%d-%m-%Y %H:%i"),"%d-%m-%Y %H:%i") as diterima, DATE_FORMAT(STR_TO_DATE(send_pemohon, "%d-%m-%Y %H:%i"),"%d-%m-%Y %H:%i") as send_pemohon,status_pengajuan');
        $this->db->where('id_user',$iduser);
        $this->db->order_by('waktu','DESC');
        $query = $this->db->get('tbl_pengajuan')->result();
        $response['status']=200;
        $response['error']=false;
        $response['pengajuan']=$query;
        return $response;
      }

      function getAduan($iduser) {
        $this->db->where('id_user',$iduser);
        $query = $this->db->get('tbl_pengajuan')->num_rows();
        if($query) { 
            $response['status']=200;
            $response['error']=false;
            $response['aduan']=$query;
            return $response;
        }else{
            $response['status']=500;
            $response['error']=true;
            $response['message']= "Gagal Menarik Total Aduan";
            return $response;
        }
      }

      function getPermohonanbyId($iduser,$id_pengajuan) {
        $this->db->select('pengajuan_id as id_pengajuan,nama_pemohon,alamat_pemohon,
        no_pemohon,email_pemohon,info_butuh,info_alasan,nama_info,alamat_info,no_info,email_info,
        DATE_FORMAT(waktu, "%d-%m-%Y %H:%i") as waktu_buat,jawab_pemohon,
        DATE_FORMAT(STR_TO_DATE(send_pemohon, "%d-%m-%Y %H:%i"),"%d-%m-%Y %H:%i") as tanggal_jawab,data_file,info_tujuan');
        $this->db->where('pengajuan_id',$id_pengajuan);
        $this->db->where('id_user',$iduser);
        $query = $this->db->get('tbl_pengajuan')->row();
        if($query) {
                $response['status']=200;
                $response['error']=false;
                $response['data_pemohon']=[
                    'id_pengajuan' => $query->id_pengajuan,
                    'nama_pemohon' => $query->nama_pemohon,
                    'alamat_pemohon' => $query->alamat_pemohon,
                    'no_pemohon' =>$query->no_pemohon,
                    'email_pemohon' =>$query->email_pemohon,
                    'info_butuh' =>$query->info_butuh,
                    'info_alasan' =>$query->info_alasan,
                    'nama_info' =>$query->nama_info,
                    'alamat_info' =>$query->alamat_info,
                    'no_info' =>$query->no_info,
                    'email_info' =>$query->email_info,
                    'waktu_buat' =>$query->waktu_buat,
                    'info_tujuan' => $query->info_tujuan,
                    'jawab_pemohon' =>$query->jawab_pemohon,
                    'data_file' =>$query->data_file,
                ];
                return $response;
        }else{
            $response['status']=500;
            $response['error']=true;
            $response['message']= "Data Tidak Ditemukan";
            return $response;
        }
    }


    function save($iduser,$nama_pemohon,$alamat_pemohon,$nomor_pemohon,$email_pemohon,
    $informasi_pemohon,$alasan_pemohon,$nama_pengguna,$alamat_pengguna,$nomor_pengguna,$email_pengguna,$tujuan_pengguna){
        if(empty($nama_pemohon) || empty($alamat_pemohon) || empty($nomor_pemohon) ||empty($email_pemohon)||
        empty($informasi_pemohon) || empty($alasan_pemohon) || empty($nama_pengguna) ||empty($alamat_pengguna)||
        empty($nomor_pengguna) || empty($email_pengguna) || empty($tujuan_pengguna))
        {
            return $this->empty_response();
        } else {
                $data = array(
                    'id_user' => $iduser,
                    'tujuan_id'=> 0,
                    'nama_pemohon' => $nama_pemohon,
                    'alamat_pemohon'  => $alamat_pemohon,
                    'no_pemohon' => $nomor_pemohon,
                    'email_pemohon' => $email_pemohon,
                    'info_butuh' => $informasi_pemohon,
                    'info_alasan' => $alasan_pemohon,
                    'nama_info' => $nama_pengguna,
                    'alamat_info' => $alamat_pengguna,
                    'no_info' => $nomor_pengguna,
                    'email_info' => $email_pengguna,
                    'waktu' => date('Y-m-d H:i:s'),
                    'info_tujuan' => $tujuan_pengguna,
                    'send_bidang' => '',
                    'jawaban' => '',
                    'diterima' => '',
                    'jawab_pemohon' => '',
                    'send_pemohon' => '',
                    'status_pengajuan' => 1,
                    'data_file' => '',
                    'status_file' => '',
                );
                $query1 = $this->db->insert('tbl_pengajuan', $data);
                if($query1)
                {
                    $response['status']=200;
                    $response['error']=false;
                    $response['message']="Berhasil Mengajukan Permohonan";
                    return $response;
                }else{
                    $response['status']=502;
                    $response['error']=true;
                    $response['message']="Gagal Mengajukan Permohonan";
                    return $response;
                }
        }
    }
}