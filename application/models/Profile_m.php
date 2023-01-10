<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Profile_m extends CI_Model {

    public function empty_response(){
        $response['status']=502;
        $response['error']=true;
        $response['message']='Field tidak boleh kosong';
        return $response;
      }
    
 function getUser($iduser) 
 {
        $this->db->where('user_id',$iduser);
        $query = $this->db->get('tbl_user')->row();
        if($query) {
                $response['status']=200;
                $response['error']=false;
                $response['profile']=[
                    'user_id' => $query->user_id,
                    'user_name' => $query->user_name,
                    'user_email' => $query->user_email,
                    'no_hp' =>$query->no_hp,
                ];
                return $response;
            }else{
                $response['status']=502;
                $response['error']=true;
                $response['message']='Data Tidak Ditemukan';
                return $response;
            
    }
}

    function save($iduser,$nama,$email,$no_hp,$password){
        if(empty($nama) || empty($email) || empty($no_hp) ||empty($password))
        {
            return $this->empty_response();
        } else {
            $this->db->set('user_name', $nama);
            $this->db->set('user_email', $email);
            $this->db->set('no_hp', $no_hp);
            $this->db->set('user_password', $password);
            $this->db->where('user_id', $iduser);
            $query = $this->db->update('tbl_user');
            if($query)
            {
                    $response['status']=200;
                    $response['error']=false;
                    $response['message']="Data Berhasil Di Update";
                    return $response;
                }else{
                    $response['status']=502;
                    $response['error']=true;
                    $response['message']="Data Gagal Di Update";
                    return $response;
                }
            
            }
    }
}