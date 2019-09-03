<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Judul_SOP extends CI_Controller {
	private $id_sesion;
	public function __Construct()
    { 
		parent ::__construct();    
		$cek  = $this->M_login->cek_userIsLogedIn();
		if($cek==false){
			redirect('Welcome');
		} 
    }

    public function index()
    { 
    	$data['title']="Home";  
		$this->load->view('header', $data);
		$this->load->view('judul_sop/index', $data);
		$this->load->view('footer'); 
    }

    public function reload()
    {
    	$data['sop'] = $this->M_judulSOP->getAll()->result();
		$this->load->view('judul_sop/data', $data); 
    }

	public function form_judul_sop($id=null)
	{   
		$data = array();
		$id_user = $this->session->userdata('id');
        $data['data']['id_user'] = $id_user;

        if ($id=="0")
        {
        	$data['data']['id'] = null;
        	$data['data']['judul_sop'] = null;
        }
        else
        {
        	$where = array(
        		'id' => $id, 
        	);
        	$data['data'] = $this->M_judulSOP->detail($where)->row_array(); 
        	$data['data']['id_user']=  $id_user; 
        }
		$this->load->view('judul_sop/form', $data); 
	}

	public function detail($id)
	{   
		$data = array();
		$id_user = $this->session->userdata('id');  
    	$where = array(
    		'id' => $id, 
    	);
    	$data['data'] = $this->M_judulSOP->detail($where)->row_array(); 
    	$data['data']['id_user']=  $id_user;  

		$this->load->view('judul_sop/form_edit', $data); 
	}

	public function save()
	{
		$status=false;
		$pesan=""; 
		$input=false; 

		// proses add
		 $data = array(  
			'judul_sop' => $this->input->post('judul_sop'), 
		);
		$input=$this->M_judulSOP->add($data);

		if ($input==true){
			$pesan = "proses tambah judul SOP berhasil";
			$status =true;
		}
		else{
			$pesan = "proses tambah judul SOP gagal";
			$status=false;
		}  

		$return = array(
			array(
				'pesan' => $pesan,
				'status' => $status,
			)
		);
		echo json_encode ( $return);   
	}

	public function update()
	{ 
		$where = array('id' => $this->input->post('id')); 
		// proses add
		 $data = array(  
			'judul_sop' => $this->input->post('judul_sop'), 
		);
		$input=$this->M_judulSOP->update($where, $data);
		redirect('Judul_SOP'); 
	}

	public function hapus($id){
		$pesan="";
		$status ="";
		$where = array('id' => $id );
		$hapus=$this->M_judulSOP->hapus($where);
		if ($hapus==true){
			$pesan = "proses hapus judul SOP berhasil";
			$status =true;
		}
		else if($hapus=false){
			$pesan = "proses hapus judul SOP gagal";
			$status=false;
		}
		else{
			$pesan = $hapus;
			$status=false;
		} 

		$return = array(
			array(
				'pesan' => $pesan,
				'status' => $hapus,
			)
		);
 
		echo json_encode ($return);  
	} 


	public function cari()
	{
		$data = array();
		$keyword = $this->input->post('keyword'); 
		$data['sop'] = $this->M_judulSOP->cari($keyword)->resul_array();  
		$this->load->view('judul_sop/data', $data); 
	}
  
}
