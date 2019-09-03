
<?php 
  $this->load->view('header'); 
?>  

  <!-- Full Width Column -->
  <div class="content-wrapper">
    <div class="container">  

      <!-- Main content -->
      <section class="content">  
        
        <div class="login-box">
        
        <!-- /.login-logo -->
        <div class="login-box">
          <div class="login-logo">
            <a href="<?php echo base_url() ?>"><b>BANK </b>NTB Syariah</a>
          </div>
          <!-- /.login-logo -->
          <div class="login-box-body">
            <p class="login-box-msg">Masukkan email untuk mereset password</p>

            <?php if ($this->session->flashdata('pesan')!='')  {  ?>
              <div class="alert alert-success alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                  <h4><i class="icon fa fa-check"></i> Alert!</h4>
                  <?php echo $this->session->flashdata('pesan'); ?>
                </div>
            <?php  } ?>  

            <form name="fomr_login" action="<?php echo base_url()."index.php/Login/do_reset_pass" ?>" onsubmit="return validateForm()" method="post">
               
              <div class="form-group has-feedback">
                <input type="email" name="username" class="form-control" placeholder="username/email" required>
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
              </div> 
              <div class="row">
              
                <div class="col-xs-12">
                  <button type="submit" class="btn btn-success btn-block btn-flat">Reset Password</button>
                </div>
                <!-- /.col -->
              </div>
            </form> 
            <br>  
            
          </div>
          <!-- /.login-box-body -->
        </div>
        <!-- /.login-box-body -->
      </div>

      </section>
      <!-- /.content -->
    </div>
    <!-- /.container -->
  </div>

  <script> 
    function validateForm() {
      var username = document.forms["fomr_login"]["usrname"].value;
      var password = document.forms["fomr_login"]["password"].value;  
      if (username == "") {
        alert("Silahkan masukkan username");
        return false;
      }
      if (password == "") {
        alert("Silahkan masukkan password");
        return false;
      }
    } 
  
  </script>

  
<?php 
  $this->load->view('footer'); 
?>

