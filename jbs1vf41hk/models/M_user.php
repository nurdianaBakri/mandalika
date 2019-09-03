<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class M_user extends CI_Model {

    private $p_add = "add";
    private $p_remove = "hapus";
    private $p_update = "update";
 
    public function detail($where){ 
        $this->db->where($where);
        return  $this->db->get('user');
    }   
 
    public function getAll(){     
        //save to database  
        return $this->db->get('user');
    } 

    public function log_proses($id_user, $jenis_proses, $id_pic, $old_value, $new_value){
        $data_insert = array(
            'id_user' =>$id_user, 
            'aksi' =>$jenis_proses , 
            'id_pic' =>$id_pic , 
            'old_value' =>json_encode($old_value), 
            'new_value' =>json_encode($new_value), 
        ); 
        $insert_log = $this->db->insert("user_logs", $data_insert);
        return $insert_log; 
    } 
    
    public function update($data, $id_user, $id_pic)
    {  
        $update_log ="";  
        $this->db->where( array('id' => $id_user )); 
        $data_user_old = $this->db->get('user')->row();  
         
        $this->db->where(array('id' => $id_user )); 
        $update = $this->db->update('user',$data);
        if($update==true)
        {  
            $this->db->where( array('id' => $id_user )); 
            $get_new_value = $this->db->get('user',$data)->row();   
            $update_log = $this->log_proses($id_user, $this->p_update, $id_pic, $data_user_old, $get_new_value);
            return $update_log;
        }
        else{
            return false;
        } 
    }

    public function hapus($where, $id_pic){   
		//hapus file sop 
        $this->db->where($where);
        $data_user = $this->db->get('user')->row(); 
        
        //menghapus data sop di database 
        $this->db->where($where); 
        $this->db->delete('user'); 
        
        //memasukkan data ke tabel logs 
        return $this->log_proses($data_user->id, $this->p_remove, $id_pic, $data_user, '');
           
    } 

    public function generate_pass()
    { 
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ@#$%&*';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < 7; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        } 

        return $randomString;
    }

}