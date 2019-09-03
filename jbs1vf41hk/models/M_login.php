<?php

class M_login extends CI_Model
{	
  
	function cek_login($table,$where)
	{		
		return $this->db->get_where($table,$where);
	}

  public function redirectLogin($redirect_page)
  {
    // status user login = BENAR, pindah ke halaman absen
    if ($this->session->userdata('is_logedin') == TRUE)
    {
      if ($this->session->userdata('level')=="user")
      {
        //selamat datang  
        $nama_divisi = $this->session->userdata('nama_divisi');
        if ($nama_divisi="Moderator")
        {
          //selamat datang   
          redirect('Welcome');
        }
        else
        {
          redirect($redirect_page);
        }
      }
      else
      {
          redirect('Ad_user');
      }
    }
        // status login salah, tampilkan form login
    else
    {
        $this->load->view('login/login');
    }
  }

	public function cek_userIsLogedIn()
	{
    $this->secure_header();
		if($this->session->userdata('is_logedin')==TRUE)
    {
      return TRUE;
    }  
    else
    {
      return FALSE;
    }
  }	

  public function get_manutrue($kode)
  {
    $jawaban=false;
    $kode_menu_session = explode(",", $this->session->userdata('user_menu'));
    foreach ($kode_menu_session as $key) {
      if($key==$kode)
      {
        $jawaban=true;
      }
      else{
      }
    } 
    return $jawaban;
  }

  public function cekMenu002($kode_big_menu, $kode_menu, $kode_sub_menu)
  { 
    $kode_menu_session = explode(",", $this->session->userdata('user_menu'));
    $kode_menu_session2 = array();
    
    foreach ($kode_menu_session as $key) {
      $kode_menu_session2[]=$key;
    }  


    $balikan=  false;
    if($kode_sub_menu=="0")
    {
      if(in_array($kode_menu, $kode_menu_session2))
      {
        $balikan = true;  
        //cek kecocokan kode big menu,
        $kode_big_menu2 = $this->db->query("Select id_big_menu from menu where id_menu ='".$kode_menu."'")->row_array()['id_big_menu'];
        if($kode_big_menu2==$kode_big_menu)
        {
          $balikan = true;
        }
        else
        {
          $balikan = false; 
        } 
      }
      else
      { 
        $balikan =false;
      } 
    }
    else
    {
      //cek kecocokan sub menu
      if(in_array($kode_sub_menu, $kode_menu_session2))
      {
        $balikan = true;  

        ///tes kecocokan menu
        $kode_menu2 = $this->db->query("Select DISTINCT(id_menu) as kode_menu from sub_menu where id_sub_menu =".$kode_sub_menu)->row_array()['kode_menu'];
        if($kode_menu2==$kode_menu)
        {
          $balikan = true;
        }
        else
        {
          $balikan = false; 
        } 
      }
      else
      { 
        $balikan =false;
      } 
    }
   
    return $balikan;
}  
 

  public function cek_menuIsSet($actual_link)
  {
    $array2 = array();
    $status_code="gagal";
    $status_code2="";
    $array_link = $this->session->userdata('session_link'); 
    
    foreach($array_link as $link) 
    { 
      if($link!=NULL ||$link!="")
      { 
        $new_str = strstr($actual_link, 'NTB/');
        // Use this to get string after test3 
        $new_str = str_replace('NTB/', '', $new_str); 
        // $new_str value will be '/testupload/directory/'
      
        $status = strpos($new_str, $link);   
        if ($status !== FALSE)
        { 
          if($status_code!="berhasil"){
            $status_code2="berhasil";
            $status_code = $status_code2;
          }
        }
        else{ }  
      } 
    } 
    return $status_code;
  }
  
  public function secure_header()
  {
     // Prevent some security threats, per Kevin
		// Turn on IE8-IE9 XSS prevention tools
		$this->output->set_header('X-XSS-Protection: 1; mode=block');
		// Don't allow any pages to be framed - Defends against CSRF
		$this->output->set_header('X-Frame-Options: DENY');
		// prevent mime based attacks
    $this->output->set_header('X-Content-Type-Options: nosniff');
  }

  public function logout()
  {
    $data_session = array(
			'username'=> '',
			'nama' => '',
			'level' => '',
			'divisi' => '',
			'nama_divisi' =>'',
			'id_user' => '',
			'menu' => '',
			'user_menu' =>'',
			'is_logedin' => FALSE,
		);

		//add log logout  
		$data_savelog = array (
			'log_user'=>$this->session->userdata('id_user'),
			'log_tipe'=>11,
			'log_desc'=>"user has loged-out",
		);
		$this->M_log->save_login_log($data_savelog); 

		$this->session->sess_destroy();
		$this->session->unset_userdata($data_session);
  }

	public function cek_chield($jenis, $id_menu, $data_checking)
    {
      $data_output = array();
      if ($jenis=="menu")
      {
        $this->db->where('id_menu', $id_menu);
        $data_mm = $this->db->get("sub_menu")->result();
        foreach ($data_mm as $key)
        {
          foreach ($data_checking as $key2)
          {
            if ($key->id_sub_menu==$key2)
            {
              $data_output[] = $key2;
            }
          }
        }
      }
      else
      {
       echo "string";
      }

      return  sizeof($data_output);
    }
}