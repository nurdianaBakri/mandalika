<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class M_register extends CI_Model {
 
    public function registering($data){     
        //save to database
        return $this->db->insert('user', $data);
    } 

}