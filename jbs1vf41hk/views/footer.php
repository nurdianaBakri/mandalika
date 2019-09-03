
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="container">
      <div class="pull-right hidden-xs">
        <b>Version</b> 2.4.0
      </div>
      <strong>Copyright &copy; <?php echo date('Y'); ?> <a href="http://www.bankntbsyariah.co.id" target="_blank">Bank NTB Syariah</a>.</strong> All rights
      reserved.
    </div>
    <!-- /.container -->
  </footer>
</div>
<!-- ./wrapper --> 

<script>

  $('#myModal').modal({
      backdrop: 'static',
      keyboard: false
  })


  function get_login(){
    $.post("<?php echo base_url()."index.php/Login/cek_session" ?>",
    { },
    function(data, status){  
      if(data=="tidak_login"){
        $(".navbar-nav").hide();
      } 
    });
  } 

</script>
</body>
</html>
