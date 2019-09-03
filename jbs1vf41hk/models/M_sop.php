<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class M_sop extends CI_Model {

    private $p_add = "add";
    private $p_remove = "hapus";
    private $p_update = "update";
 
    public function detail($where){ 
        $this->db->where($where);
        return  $this->db->get('sop');
    }  

    public function get_file($where){ 
        $this->db->where($where);
        return  $this->db->get('sop');
    } 

    public function hapus($where){   
		//hapus file sop 
        $this->db->where($where);
        $data_sop = $this->db->get('sop')->row();

        $url_file ="./assets/sop/".$data_sop->file_sop;
        if (!unlink($url_file))
        {
            return "proses hapus file gagal";
        }
        else
        {
            //menghapus data sop di database 
            $this->db->where($where); 
            $this->db->delete('sop'); 
            
            //memasukkan data ke tabel logs 
            return $this->log_proses('0', $this->p_remove, $data_sop->id_sop, $data_sop, NULL);
        }     
    } 

    public function log_proses($id_user, $jenis_proses, $id_sop, $old_value, $new_value){
        $data_insert = array(
            'id_user' =>$id_user, 
            'aksi' =>$jenis_proses , 
            'id_sop' =>$id_sop , 
            'old_value' =>json_encode($old_value), 
            'new_value' =>json_encode($new_value), 
        ); 
        $insert_log = $this->db->insert("sop_logs", $data_insert);
        return $insert_log; 
    }

    public function add($data, $id_user)
    { 
        $insert_log =""; 
        $insert = $this->db->insert('sop',$data);
        if($insert==true){

            $insert_id = $this->db->insert_id();
            // masukkan data ke tabel log
            $data_insert = array(
                'id_user' =>$id_user, 
                'aksi' =>$this->p_add , 
                'id_sop' =>$insert_id , 
                'new_value' =>json_encode($data), 
            );
            $insert_log = $this->db->insert("sop_logs", $data_insert);
            return $insert_log;
        }
        else{
            return false;
        }
    }

    public function update_sop($data, $id_user,  $id_sop, $file_kosong)
    { 
        $hapus_file =""; 
        $update_log =""; 
        $dataTmp = array();
        $this->db->where( array('id_sop' => $id_sop )); 
        $data_sop_old = $this->db->get('sop')->row(); 

        //hapus file SOP yang kemarin 
        //jika file -- null 
        if($file_kosong!="false"){ 
            $url_file ="./assets/sop/".$data_sop_old->file_sop;
            if (!unlink($url_file))
            {
                $hapus_file = false;
            }
            else
            {
                $hapus_file = true;
            }     
        } 
        
        $this->db->where( array('id_sop' => $id_sop )); 
        $update = $this->db->update('sop',$data);
        if($update==true)
        {  
            $this->db->where( array('id_sop' => $id_sop )); 
            $get_new_value = $this->db->get('sop',$data)->row();  

            $update_log = $this->log_proses($id_user, $this->p_update, $id_sop, $data_sop_old, $get_new_value);
            return $update_log;
        }
        else{
            return false;
        } 
    }

    public function searching($id_judul_sop, $keyword)
    {  
        $this->db->where('id_judul_sop', $id_judul_sop); 
        $this->db->like('nama_sop', $keyword); 
        return $this->db->get('sop');    
    }

     
}