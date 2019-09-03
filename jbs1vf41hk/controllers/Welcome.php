<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function __Construct()
    { 
		parent ::__construct();    
		$this->id_sesion = $this->session->userdata('id_session');
        $cek  = $this->M_login->cek_userIsLogedIn();
		if($cek==true){
			redirect('Judul_SOP');
		}   
    }
 
	public function index()
	{
		$data['title']="Login";
		$this->load->view('welcome', $data);
	}

	public function index2()
	{
		$this->load->view('welcome_message');
	}
}
