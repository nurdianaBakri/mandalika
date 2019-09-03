<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo $title ?> Portal Bank NTB Syariah </title>

  <link rel="shortcut icon" type="image/png" href="https://www.bankntbsyariah.co.id/assets/Portals/1/favicon.ico?ver=2017-02-03-134614-000"/>
	<link rel="shortcut icon" type="image/png" href="https://www.bankntbsyariah.co.id/assets/Portals/1/favicon.ico?ver=2017-02-03-134614-000"/>
  
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?php echo base_url()."assets/" ?>bower_components/bootstrap/dist/css/bootstrap.min.css">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url()."assets/" ?>bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?php echo base_url()."assets/" ?>bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url()."assets/" ?>dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?php echo base_url()."assets/" ?>dist/css/skins/_all-skins.min.css">
  
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
 
  <!-- jQuery 3 -->
  <script src="<?php echo base_url()."assets/" ?>bower_components/jquery/dist/jquery.min.js"></script>

  <!-- Bootstrap 3.3.7 -->
  <script src="<?php echo base_url()."assets/" ?>bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

  <!-- SlimScroll -->
  <script src="<?php echo base_url()."assets/" ?>bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
  <!-- FastClick -->
  <script src="<?php echo base_url()."assets/" ?>bower_components/fastclick/lib/fastclick.js"></script>
  <!-- AdminLTE App -->
  <script src="<?php echo base_url()."assets/" ?>dist/js/adminlte.min.js"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="<?php echo base_url()."assets/" ?>dist/js/demo.js"></script>  

    <!-- DataTables -->
  <link rel="stylesheet" href="<?php echo base_url()."assets/" ?>bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
  <script src="<?php echo base_url()."assets/" ?>bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
  <script src="<?php echo base_url()."assets/" ?>bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script> 

  <script>
    function reload_sop(id_divisi){
          var id_user = $("#id_user").val(); 
          var url = "<?php echo base_url()."Sop/reload_sop/" ?>"+id_divisi;
          console.log(url); 

          $.post(url,
          { },
          function(data, status){
              $('.box-body').html(data);
          });
      }    
        
    function edit_sop(id_sop) {  
      var id_user = $("#id_user").val(); 
      var url = "<?php echo base_url()."Sop/edit_sop/" ?>"+id_sop+"/"+id_user;
      show_modal("Update SOP");
      $.post(url,
      { },
      function(data, status){ 
          $('.modal-body').html(data);
      });
    }

    function reload_user(){
        var id_user = $("#id_user").val(); 
        var url = "<?php echo base_url()."User/reload_user" ?>"; 
        $.post(url,
        { },
        function(data, status){
            $('.box-body').html(data);
        });
    }    

    function edit_user(id) {  
      var id_pic = $("#id_pic").val(); 
      var url = "<?php echo base_url()."User/edit/" ?>"+id+"/"+id_pic;
      console.log(url);
      show_modal("Update User");
      $.post(url,
      { },
      function(data, status){ 
          $('.modal-body').html(data);
      });
    }     
  </script>

</head>
<!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->

<!-- oncontextmenu="return false;" -->
<body class="hold-transition skin-green layout-top-nav" onload="get_login()" >
<div class="wrapper">

  <header class="main-header">
    <nav class="navbar navbar-static-top">
      <div class="container">
        <div class="navbar-header">
          <a href="<?php echo base_url()."Judul_SOP" ?>" class="navbar-brand"><b>BANK NTB</b>SYARIAH</a>
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
            <i class="fa fa-bars"></i>
          </button>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
          <ul class="nav navbar-nav">
            <?php 
            if($this->session->userdata('level')=='Admin'){ ?>
              <li class=""><a href="<?php echo base_url()."User" ?>">User <span class="sr-only">(current)</span></a></li>
           <?php } ?> 
          
          </ul> 
        </div>
        <!-- /.navbar-collapse -->
        <!-- Navbar Right Menu -->
        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">
            
            <!-- User Account Menu -->
            <li class="dropdown user user-menu">
              <!-- Menu Toggle Button -->
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <!-- The user image in the navbar-->
                <img src="<?php echo base_url()."assets/" ?>dist/img/user2-160x160.jpg" class="user-image" alt="User Image">
                <!-- hidden-xs hides the username on small devices so only the image appears. -->
                <span class="hidden-xs"><?php echo $this->session->userdata('nama'); ?></span>
              </a>
              <ul class="dropdown-menu">
                <!-- The user image in the menu -->
                <li class="user-header">
                  <img src="<?php echo base_url()."assets/" ?>dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">

                  <p>
                    <?php echo $this->session->userdata('nama'); ?>
                    <small>Level : <?php echo $this->session->userdata('level'); ?></small>
                  </p>
                </li>
                <!-- Menu Body -->
               
                <!-- Menu Footer-->
                <li class="user-footer"> 
                  <div class="pull-right">
                    <a href="<?php echo base_url()."Login/logout" ?>" class="btn btn-default btn-flat">Sign out</a>
                  </div>
                </li>
              </ul>
            </li>
          </ul>
        </div>
        <!-- /.navbar-custom-menu -->
      </div>
      <!-- /.container-fluid -->
    </nav>
  </header>