<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class M_divisi extends CI_Model {
 
    public function getAll(){     
        //save to database
        return  $this->db->get('divisi');
    }

    public function detail($where){     
        //save to database
        $this->db->where($where);
        return  $this->db->get('divisi');
    }
   
}