<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {
	private $id_sesion;
	public function __Construct()
    { 
		parent ::__construct();    
		$this->id_sesion = $this->session->userdata('id_session');
        $cek  = $this->M_login->cek_userIsLogedIn();
		if($cek==false){
			redirect('Welcome');
		}  
		else
		{
			$level = $this->session->userdata('level');
			if($level!='Admin'){
				$this->session->set_flashdata('pesan','Anda tidak dapat mengakses halaman User, karena halaman ini hanya dapat di akses oleh Admin');
				redirect('Home'); 
			}
		} 
    }

	public function index()
	{ 
		$data['user']=$this->M_user->getAll()->result();
		$data['title']="Manajemen User";
        $this->load->view('header', $data);
		$this->load->view('user/user',$data);
        $this->load->view('footer'); 
	}  

	public function reload_user()
	{ 
		$data['user']=$this->M_user->getAll()->result();
		$this->load->view('user/reload_user',$data);
	}

	public function edit($id_user,$id_pic){

		$data = array(
			'id_pic'=>$id_pic, 
			'divisi'=>$this->M_divisi->getAll()->result(), 
		); 

		$where = array('id' =>$id_user );
		$data['data'] = $this->M_user->detail($where)->row();
		$this->load->view('user/edit',$data);
	} 

	public function do_update($id_user, $id_pic)
	{
		$status=false;
		$pesan=""; 
		$nama = $this->input->post('nama');
		$username = $this->input->post('username');
		$aktif = $this->input->post('aktif');
		$divisi = $this->input->post('divisi');
		$level = $this->input->post('level');

		$data = array(
			'username' => $username, 
			// 'id_user' => $id_user, 
			// 'id_pic' => $id_pic, 
			'nama' => $nama, 
			'aktif' => $aktif, 
			'level' => $level, 
			'divisi' => $divisi,  
		);
 
		if($this->input->post('password')!=null || $this->input->post('password')!=""){
			$password= $this->input->post('password');
			$data['password']=md5($password);
		}

		$update =$this->M_user->update($data, $id_user, $id_pic); 
		if ($update==true || $update==TRUE || $update==1){
			$pesan = "proses update user berhasil";
			$status=true;
		}
		else
		{
			$pesan = "proses update user gagal, silahkan coba kembali"; 
			$status=false;
		}  

		$return = array(
			array(
				'pesan' => $pesan,
				'status' => $status,
			)
		);
		echo json_encode ($return);  
	}
	
	public function hapus($id, $id_pic){
		$pesan="";
		$status ="";
		$where = array('id' => $id );
		$hapus=$this->M_user->hapus($where, $id_pic);
		if ($hapus==true){
			$pesan = "proses hapus user berhasil";
			$status =true;
		}
		else if($hapus=false){
			$pesan = "proses hapus user gagal";
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

	public function registering()
	{
		$pesan="";
		$status=0;
		$nama = $this->input->post('nama');
		$username = $this->input->post('username');
		$aktif = $this->input->post('aktif');
		$divisi = $this->input->post('divisi');
		$level = $this->input->post('level');
		$password = $this->input->post('password');

		$data = array(
			'username' => $username, 
			'nama' => $nama, 
			'aktif' => $aktif, 
			'level' => $level, 
			'divisi' => $divisi, 
			'password' => md5($password), 
		);

		$insert =$this->M_register->registering($data); 
		if ($insert==true || $insert==TRUE || $insert==1){

			$kirim = $this->kirimEmail($username, $password); 
			if ($kirim==true)
			{ 
				$pesan ='proses Penambahan user berhasil'; 
			}
			else
			{
				$pesan ='proses Penambahan user berhasil, namun proses pengirimain email gagal';  
			}
			$status =1; 
		}
		else
		{
			$pesan ='proses Penambahan user gagal, silahkan coba lagi';
			$status =0;
		} 
		$return = array(
			array(
				'pesan' => $pesan, 
			)
		);

		// redirect('User');
		// echo json_encode ($return); 
	} 

	public function register()
	{
		$data['divisi']=$this->M_divisi->getAll()->result();
		$this->load->view('register/register',$data);
	}  

	public function kirimEmail($email, $password)
    {    
    	$kirim_email = $this->M_email->send_emailMaster($email, $password);
        if ($kirim_email==true || $kirim_email=="true" || $kirim_email==1 || $kirim_email==TRUE)
        {
        	echo "Proses tambah user berhasil";
        }
        else
        {
        	echo "Proses tambah user berhasil, namun proses kirim email ke user gagal";
        }  
    } 

    public function sendEmail($id)
    { 
    	$where = array('id' => $id );
    	$data_user = $this->M_user->detail($where)->row();

    	//generate pass baru buat user 
    	$randomString = $this->M_user->generate_pass(); 

    	$data = array('password' => md5($randomString) );

    	//PIC== ADMIN 
    	$id_pic = $this->session->userdata('id_user');

    	//update password user
    	$update = $this->M_user->update($data, $id, $id_pic);

    	// var_dump($update); 

    	// kirim email  
    	$kirim_email = $this->M_email->send_emailMaster($data_user->username, $randomString);
        if ($kirim_email==true || $kirim_email=="true" || $kirim_email==1 || $kirim_email==TRUE)
        {
        	echo "Proses kirim email ke user berhasil";
        }
        else
        {
        	echo "Proses kirim email ke user berhasil, namun proses kirim email ke user gagal";
        }  
    }  
 
 
	 
}
