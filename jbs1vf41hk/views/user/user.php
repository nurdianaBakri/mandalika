    <!-- Full Width Column -->
    <div class="content-wrapper">
    <div class="container">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>
          Data User 
        </h1>
        <ol class="breadcrumb">
          <li><a href="<?php echo base_url()."User" ?>"><i class="fa fa-user"></i> User</a></li> 
        </ol>
      </section>

      <!-- Main content -->
      <section class="content"> 

      <?php if ($this->session->flashdata('pesan')!='')  {  ?>
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h4><i class="icon fa fa-check"></i> Alert!</h4>
            <?php echo $this->session->flashdata('pesan'); ?>
          </div>
      <?php  } ?>  

        <div class="box box-default">
          <div class="box-header with-border">
            <h3 class="box-title">Data User</h3>
            <div class="box-tools pull-right">  
                 <?php
                    $level = $this->session->userdata('level');
                    if(($level =="PIC") || ($level =="Admin")){
                        ?>
                            <button id="search-btn"  onclick="tambah_user()" class="btn btn-success"><i class="fa fa-plus-square"> User </i>
                            </button> 
                        <?php
                    }  ?>    
              </div> 
          </div>
          <div class="box-body">  
          </div>
          <!-- /.box-body -->
        </div>
        <!-- /.box -->
      </section>
      <!-- /.content -->
    </div>
    <!-- /.container --> 

  </div> 

  <div class="modal fade" id="myModal">
        <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"></h4>
            </div>
            <div class="modal-body">  


              <div class="hasil"></div>

                  <img src="<?php echo base_url()."assets/image/processing.gif" ?>" style="width:50px;height:50px;" class="processing"> 

              </div> 
            <div class="modal-footer">
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
            </div>
        </div>
        <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>   
  
  
  <script> 

    var id_pic = $('#id_pic').val();  

    $(document).ready(function(){
      $('#myModal').modal('hide');
      reload_user();
    }); 

    function show_modal(title){
        //rename title modal 
        $(".modal-title").text(title); 

        //showmodal 
        $('#myModal').modal({
            show: 'false',
            backdrop: 'static',
            keyboard: false
        }); 
    }    

    function hapus_user(id) {
      var nama = $('#'+id).val();  
        if (confirm("Apakah Anda yakin ingin menghapus "+nama+" ?")) {

            event.preventDefault();
            var url = "<?php echo base_url()."User/hapus/" ?>"+id+'/'+id_pic;
            
            // AJAX request
            $.ajax({
            url: url,
            type: 'post',
            data: '',
            contentType: false,
            processData: false,
            dataType: 'json',
            success: function(response){
                    console.log(response); 
                    reload_user(); 
                    $('.modal-body').html(response[0].pesan); 
                    show_modal("Hapus User"); 
                }
            }); 
        }
        return false;
    } 

    function tambah_user(id_divisi){
        var id_user = $("#id_user").val(); 
        var url = "<?php echo base_url()."User/register/" ?>"; 
        show_modal("Tambah User");
        $.post(url,
        { },
        function(data, status){ 
            $('.modal-body').html(data);
        });
    }  

    function send_email(id) {

      $('.processing').show();  
      $('.hasil').hide();  
      show_modal("Sending Email to User");   

      event.preventDefault();
      var url = "<?php echo base_url()."User/sendEmail/" ?>"+id;
      
      // AJAX request
      $.ajax({
      url: url,
      type: 'post',
      data: '',
      contentType: false,
      processData: false,
      dataType: 'html',
      success: function(response){ 
        console.log(response); 
          $('.processing').hide();  
          $('.hasil').html(response);  
        }
      }); 
  }   

  $(function () { 
    $('#example1').DataTable({
      'paging'      : true, 
      'searching'   : true,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false,
      'scrollX'     : true
    })
  })
</script>
   