<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class M_judulSOP extends CI_Model {

      private $p_add = "add";
    private $p_remove = "hapus";
    private $p_update = "update";
 
    public function getAll(){     
        //save to database
        return  $this->db->get('judul_sop');
    }

    public function detail($where){     
        //save to database
        $this->db->where($where);
        return  $this->db->get('judul_sop');
    } 

    public function cari($keword)
    {  
        return  $this->db->query('SELECT *  FROM judul_sop where judul_sop like "%$keword%"');
    }

    public function add($data)
    {
        $sql = $this->db->insert('judul_sop',$data);
        return $sql;
    }

    public function hapus($where){   

        $this->db->where($where);
        $data = $this->db->get('judul_sop')->row();

        //menghapus data sop di database 
        $this->db->where($where);  
        $this->db->delete('judul_sop'); 
        
        //memasukkan data ke tabel logs 
        return $this->log_proses('0', $this->p_remove, $data->id, $data, NULL); 
    } 

    public function log_proses($id_user, $jenis_proses, $id, $old_value, $new_value){
        $data_insert = array(
            'id_user' =>$id_user, 
            'aksi' =>$jenis_proses , 
            'id' =>$id , 
            'old_value' =>json_encode($old_value), 
            'new_value' =>json_encode($new_value), 
        ); 
        $insert_log = $this->db->insert("judul_sop_log", $data_insert);
        return $insert_log; 
    }

    public function update($where, $data){ 
        $this->db->where($where);
        return  $this->db->update('judul_sop',$data);
    } 

}