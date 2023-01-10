<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Auth_m extends CI_Model {

    public function empty_response(){
        $response['status']=502;
        $response['error']=true;
        $response['message']='Field tidak boleh kosong';
        return $response;
      }
    
 function login($email,$password) 
 {
    if(empty($email) || empty($password))
    {
        return $this->empty_response();
    }else{
        $this->db->where('user_email',$email);
        $query = $this->db->get('tbl_user')->row();
        if($query) {
            if($query->user_password == $password) {
                $response['status']=200;
                $response['error']=false;
                $response['login']=[
                    'user_id' => $query->user_id,
                    'user_name' => $query->user_name,
                    'user_email' => $query->user_email,
                    'no_hp' =>$query->no_hp,
                ];
                return $response;
            }else{
                $response['status']=502;
                $response['error']=true;
                $response['message']='Password Tidak Sesuai';
                return $response;
            }
        } else {
            $response['status']=502;
            $response['error']=true;
            $response['message']='Email Tidak Ditemukan';
            return $response;
        }
        
    }
}

    function register($nama,$email,$password, $no_hp){
        if(empty($nama) || empty($email) || empty($no_hp) ||empty($password))
        {
            return $this->empty_response();
        } else {
            $this->db->where('user_email',$email);
            $query = $this->db->get('tbl_user')->row();
            if(empty($query))
            {
                $data = array(
                    'user_name' => $nama,
                    'user_email'  => $email,
                    'user_password' => $password,
                    'no_hp' => $no_hp,
                    'user_level' => 2,
                    'user_status' => 1
                );
                $query1 = $this->db->insert('tbl_user', $data);
                if($query1)
                {
                    $response['status']=200;
                    $response['error']=false;
                    $response['message']="Anda Berhasil Register";
                    return $response;
                }else{
                    $response['status']=502;
                    $response['error']=true;
                    $response['message']="Anda Gagal Register";
                    return $response;
                }
            }else{
                $response['status']=502;
                $response['error']=true;
                $response['message']="Anda Telah Register Sebelumnya";
                return $response;
            }
        }
    }
}