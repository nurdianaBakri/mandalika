<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sop extends CI_Controller {

	public function __Construct()
    { 
		parent ::__construct();
		$cek  = $this->M_login->cek_userIsLogedIn();
		if($cek==false){
			redirect('Welcome');
		}    
    }

	public function index($id_judul_sop)
	{
		$data['title']="SOP";  

		$level = $this->session->userdata('level'); 
		if($level=="Admin"){
			$data['button_tambah'] = true;
		}
		else{
			$data['button_tambah'] = false; 
		}

		$data['id_judul_sop'] = $id_judul_sop; 

		$data['data_sop'] = $this->M_sop->detail(array('id_judul_sop' => $id_judul_sop ))->result();  
		$data['data_judul'] = $this->M_judulSOP->detail(array('id' => $id_judul_sop ))->row(); 

		$data['title']="SOP";  
		$this->load->view('header', $data);
		$this->load->view('sop/index', $data); 
		$this->load->view('footer');   
	}

	public function reload_sop($id_judul_sop)
	{ 
		$id_divisilogin = $this->session->userdata('divisi');
		$data['id_judul_sop'] = $id_divisilogin; 
		$level = $this->session->userdata('level'); 
		if($level=="Admin"){
			$data['button_tambah'] = true;
		}
		else{
			$data['button_tambah'] = false; 
		}

		$data['data_sop'] = $this->M_sop->detail( array('id_judul_sop' => $id_judul_sop ))->result();   
		$this->load->view('sop/reload_sop', $data); 
	}

	public function searching()
	{
		$id_judul_sop = $this->input->post('id_judul_sop');
		$keyword = $this->input->post('keyword');
		$level = $this->session->userdata('level'); 
		if($level=="Admin"){
			$data['button_tambah'] = true;
		}
		else{
			$data['button_tambah'] = false; 
		} 

		$data['data_sop'] = $this->M_sop->searching($id_judul_sop, $keyword)->result();   
		$this->load->view('sop/reload_sop', $data);  
	}

	public function open_sop($id_sop){
		$where = array('id_sop' => $id_sop );
		$data['data_sop'] = $this->M_sop->get_file($where)->row();
		$this->load->view('sop/view_pdf', $data);
	}  
	
	public function tambah_sop($id_judul_sop,$id_user){
		$data = array(
			'id_user'=>$id_user,
			'id_judul_sop'=>$id_judul_sop, 
		); 
		$this->load->view('sop/add_sop',$data);
	} 

	public function edit_sop($id_sop,$id_user){
		$data = array(
			'id_user'=>$id_user,
			'id_sop'=>$id_sop, 
		); 

		$where = array('id_sop' =>$id_sop );
		$data['data'] = $this->M_sop->detail($where)->row();
		$this->load->view('sop/edit_sop',$data);
	} 

	public function hapus_sop($id_sop){
		$pesan="";
		$status ="";
		$where = array('id_sop' => $id_sop );
		$hapus=$this->M_sop->hapus($where);
		if ($hapus==true){
			$pesan = "proses hapus SOP berhasil";
			$status =true;
		}
		else if($hapus=false){
			$pesan = "proses hapus SOP gagal";
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
	 
	public function do_add_sop()
	{ 
		$pesan="";
		$status="";
		$nama_sop = $this->input->post('nama_sop');
		$id_user = $this->input->post('id_user'); 

		$new_name = time(); 
		$config['upload_path']          = './assets/sop/';
		$config['allowed_types']        = 'pdf|swf';
		// $config['encrypt_name'] 		= TRUE;
		$config['file_name']			= $new_name.".pdf";

		$this->upload->initialize($config);
		if ( ! $this->upload->do_upload('file_sop'))
		{
			$pesan = $this->upload->display_errors();
			$status = false;
		}
		else
		{  
			$data = array('upload_data' => $this->upload->data()); 

			// $get_image = $this->input->post(file_get_contents($data['upload_data']['file_name']));  //imgProfile is the name of the image tag  

			//masukkan data ke tabel sop
			$data_input = array(
				'id_judul_sop' => $this->input->post('id_judul_sop'), 
				'nama_sop' => $nama_sop, 
				// 'file_sop' => $config['file_name'], 
				'file_sop' => $data['upload_data']['file_name'], 
				// 'sop_blob' => $get_image, 
			);
 
			$input=$this->M_sop->add($data_input, $id_user);
			if ($input==true){
				$pesan = "proses upload SOP berhasil";
				$status =true;
			}
			else{
				$pesan = "proses upload SOP gagal";
				$status=false;
			}  
		}
		
		$return = array(
			array(
				'pesan' => $pesan,
				'status' => $status,
			)
		);
		echo json_encode ( $return);  
	}

	function convert(){
		$this->load->view('sop/convert22');
	} 

	public function do_upload_library()
	{

		$status="";
		$file_null=false;
		$pesan="";
		$data = array();

		$new_name = time(); 
		$config['upload_path']          = './assets/sop/';
		$config['allowed_types']        = 'pdf'; 
		$config['file_name']			= null; 

		if(isset($_FILES['file_sop']) && $_FILES['file_sop']['size'] > 0){
			$status=true;
			$file_null = false;
		} 
		else{
			$file_null=false;
			$config['file_name']		=$new_name.".pdf";

			$this->upload->initialize($config);
			if ( ! $this->upload->do_upload('file_sop'))
			{
				$pesan = $this->upload->display_errors();
				$status = false;
			} 
		}  

		$data = $this->upload->data(); 
		$pesan = "berhasil";
		$status = true;

		return array(
			'pesan' => $pesan,
			'data_upload' => $data,
			'status' => $status,
			'file_null' => $file_null,
		); 
	} 

	public function do_update_sop2($id_sop)
    {
		$nama_sop = $this->input->post('nama_sop');
		$id_user = $this->input->post('id_user'); 
		$file_sop = "";
		$pesan = "";
		$file_uploaded = "false";
		$data_input = array();

		if(isset($_FILES['file_sop']) && $_FILES['file_sop']['size'] > 0)
		{
			$new_name = time(); 
			$config['upload_path']          = './assets/sop/';
			$config['allowed_types']        = 'pdf'; 
			$config['file_name']			= $new_name.".pdf"; 
 
			$this->upload->initialize($config);
			if ( ! $this->upload->do_upload('file_sop'))
			{
				$pesan =  $this->upload->display_errors();
			}
			else
			{
				$upload_data=$this->upload->data();
				$file_sop=$upload_data['file_name']; 
				$file_kosong="true";
			}
		}
		else{
			$file_sop=$this->input->post('file_sop_old');
			$file_kosong="false"; 
		}

		$data_input = array(
			'nama_sop' => $nama_sop, 
			'file_sop' => $file_sop, 
		);

		$update=$this->M_sop->update_sop($data_input, $id_user, $id_sop, $file_kosong);
 
		if ($update==true){
			$pesan = "proses update SOP berhasil";
			$status =true;
		}
		else{
			$pesan = $pesan;
			$status=false;
		}    


		//memasukkan log 
		$return = array(
			array(
				'pesan' => $pesan,
				// 'id_divisi' => $id_divisi,
				'status' => $status,
				'update' => $update,
			)
		);
		echo json_encode ($return); 
	}
 

}
