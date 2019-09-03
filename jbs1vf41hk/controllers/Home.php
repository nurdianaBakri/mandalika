<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __Construct()
    { 
		parent ::__construct();      
    }
 
	public function index()
	{
		$data['title']="WELCOME!";
		$this->load->view('user-include/header', $data);
		$this->load->view('home', $data);
		$this->load->view('user-include/footer'); 
	}

	public function index2()
	{
		$data['title']="WELCOME!";
		$this->load->view('home2', $data);
	}
 
}
