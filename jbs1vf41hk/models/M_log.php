<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class M_log extends CI_Model {

    public function libraries_log($tipe, $old_value, $new_value, $str = ""){
        // $CI =& get_instance();
    
        $param['log_user'] = $this->session->userdata('id_user');
        $param['log_tipe'] = $tipe;
        $param['log_desc'] = $str;
        $param['old_value'] = $old_value;
        $param['new_value'] = $new_value;
      
        //save to database
        $this->save_log($param);
    }
    
    public function save_login_log($data){     
        //save to database
        return  $this->db->insert('tabel_log',$data);
    }
 
    public function save_log($data)
    {
        $sql = $this->db->insert('tabel_log',$data);
        return $sql;
    }

    public function save_login_log2($data){
       return  $this->db->insert('tabel_log',$data);

    }
}