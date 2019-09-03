<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
	private $id_sesion;
	public function __Construct()
    { 
		parent ::__construct();     
    }

	public function index()
	{
		// status user login = BENAR, pindah ke halaman absen
        if ($this->session->userdata('is_logedin') == FALSE)
        {

        	$data['title']="Login";
        	$this->load->view('admin-include/header',$data);
            $this->load->view('login/login'); 
        }
            // status login salah, tampilkan form login
        else
        { 
			$this->load->view('login/login', $data);
        }
	}

	public function cek_session()
	{ 
		if($this->session->userdata('id_user')==NULL){
			echo "tidak_login";
		}
		else{
			echo "login";
		}
	}

	public function get_login()
	{
		$username = $this->input->post('username');
		$password = $this->input->post('password');

		$where = array(
			'username' => $username,
			'password' => md5($password)
		);
		$cek = $this->M_login->cek_login("user",$where);

		if($cek->num_rows() > 0)
		{ 
			$data = $cek->row();  
			//cek apakah user akktif
			if ($data->aktif==0 || $data->aktif=="0" || $data->aktif==false) {
				$this->setUserLoginSession(FALSE); 
				$this->session->set_flashdata('pesan','Akun Anda belum di approve oleh admin, silahkan hubungi admin');
				redirect('Login');
			}
			else{  
				//get detail 

				$data_session = array(
					'username' => $data->username,
					'nama' => $data->nama,
					'level' => $data->level, 
					'id_user' => $data->id, 
					'is_logedin' => FALSE,
				);
				$this->session->set_userdata($data_session); 
				
				$data_savelog = array (
					'log_user'=>$data->id,
					'new_value' => json_encode($data_session),
					'log_tipe'=>0,
					'log_desc'=>"user has logined",
				);
				$this->M_log->save_login_log($data_savelog);    
				
				$this->setUserLoginSession(TRUE); 
				redirect('Values'); 
			}
		}
		else
		{
			$this->setUserLoginSession(FALSE); 
			$this->session->set_flashdata('pesan','Username dan password salah, silahkan coba lagi');
			redirect('Login');
		} 
	}
 
	public function logout()
	{ 
		$this->M_login->logout();
		redirect(base_url('Login'));
	}

	public function reset_pass()
	{
		$data['title']="Reset Password";		
		$this->load->view('reset_pass',$data); 
	}

	public function changepassword()
	{
		$this->load->view('login/form_changepassword');
	}

	public function do_reset_pass()
	{  
		$email = $this->input->post('username');
		$where = array('username' => $email );
    	$data_user = $this->M_user->detail($where);

    	if ($data_user->num_rows()>0)
    	{
    		$data_user = $data_user->row();
    		//generate pass baru buat user 
	    	$randomString = $this->M_user->generate_pass(); 

	    	$data = array('password' => md5($randomString) ); 

	    	//update password user
	    	$update = $this->M_user->update($data, $data_user->id, '');
	  
	    	// kirim email  
	    	$kirim_email = $this->M_email->send_emailMaster($data_user->username, $randomString);
	        if ($kirim_email==true || $kirim_email=="true" || $kirim_email==1 || $kirim_email==TRUE)
	        {
	        	$this->session->set_flashdata('pesan',"password baru berhasil di kirim ke email, silahkan cek email Anda");
	        }
	        else
	        {
	        	$this->session->set_flashdata('pesan',"Proses kirim email ke user gagal, silahkan cek email anda ");
	        }  
    	}
    	else{
    		$this->session->set_flashdata('pesan',"email ".$email." tidak terdaftar di portal, silahkan masukkan email yang terdaftar");
    	} 
        redirect('Login');
	}

	 
	public function change_password()
	{
		$id_user = $this->input->post('id_user'); 
		$password1 = $this->input->post('password1');
		$password2 = $this->input->post('password2');

		//CEK apakah password = password 2
		//update password if true 
		if($password1==$password2)
		{
			//get data password sebelumnnya  
			$old_value = $this->M_user->getHalfDataUser($id_user);
  
			// update data ke database 
			$data = array(
				'password' => md5($password2),
				'password_changed' =>1,
			); 
			
			$where = array(
				'id' => $id_user,
			);
			$cek = $this->M_user->do_update($where, $data);
			if ($cek==true)
			{
				//insert old value dan new value ke table log
				$this->M_log->libraries_log(12, $old_value, json_encode($data), "User berhasil merubah password"); 
				
				$this->setUserLoginSession(TRUE); 

				//selamat datang   
				redirect('Login');
			}
			else
			{
				//proses ganti password gagal, redirect ke halaman ubah password
				//keluarkan error
				redirect('Login/changepassword');
			} 
		} 
		//redirect ke halaman ganti password lagi
		else
		{
			redirect('Login/changepassword');
		}
	}

	public function setUserLoginSession($status)
	{
		$data_session = array( 
			'is_logedin' => $status,
		);
		$this->session->set_userdata($data_session);
	}
}
