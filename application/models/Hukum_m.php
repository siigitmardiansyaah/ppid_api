<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
date_default_timezone_set("Asia/Jakarta");

class Hukum_m extends CI_Model {

    public function empty_response(){
        $response['status']=502;
        $response['error']=true;
        $response['message']='Field tidak boleh kosong';
        return $response;
      } 

      function getHukum() {
        $this->db->order_by('id_hukum_cat','DESC');
        $query = $this->db->get('tbl_hukum_cat')->result();
        $response['status']=200;
        $response['error']=false;
        $response['hukum']=$query;
        return $response;
      }

      function getList($id_hukum) {
        $this->db->join('tbl_hukum_cat','tbl_hukum.hukum_cat_id = tbl_hukum_cat.id_hukum_cat');
        $this->db->where('tbl_hukum.hukum_cat_id',$id_hukum);
        $query = $this->db->get('tbl_hukum')->result();
            $response['status']=200;
            $response['error']=false;
            $response['listhukum']=$query;
            return $response;
      }

      
}