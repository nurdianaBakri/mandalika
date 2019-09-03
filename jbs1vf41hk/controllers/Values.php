<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Values extends CI_Controller {

	public function __Construct()
    { 
		parent ::__construct();      
    }
 
	public function index()
	{
		$data['title']="WELCOME!";
		$this->load->view('user-include/header2', $data);
		$this->load->view('portfolio', $data);
		$this->load->view('user-include/footer');
	} 
}
