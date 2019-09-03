  <form role="form" method="post" enctype="multipart/form-data" action="#" id="my-form">
        <input type="hidden" name="id_divisi" value="<?php echo $id_divisi ?>" id="id_divisi"> 
        <input type="hidden" name="id_user" value="<?php echo $id_user ?>">   
    
        <div class="form-group">
            <label for="exampleInputPassword1">Judul SOP</label>
            <textarea class="form-control" name="nama_sop"  placeholder="masukkan judul SOP" required></textarea>
        </div>
        <div class="form-group">
            <label for="exampleInputFile">File SOP</label>
            <input type="file" name="file_sop" id="exampleInputFile" require accept="application/pdf" />
        </div>   
        <button type="submit" class="btn btn-success btn-block"  id="upload">Tambah</button>  
    </form> 
    <div id="preview"><div> 
    <img src="<?php echo base_url()."assets/image/processing.gif" ?>" style="width:50px;height:50px;" class="processing"> 
    
    <script>
    $(document).ready(function(){  
        var id_divisi = $('#id_divisi').val(); 

        $('.processing').hide();

        $('#upload').click(function(){ 
            event.preventDefault();
            var form = $("#my-form")[0];
            var data = new FormData(form);
            // AJAX request
            $.ajax({
            url: '<?php echo base_url().'Sop/do_add_sop/' ?>',
            type: 'post',
            data: data,
            contentType: false,
            processData: false,
            dataType: 'json',
            success: function(response){
                $('.processing').show();    
                if(response.status != 0){ 
                    $('.processing').hide();  
                    $('#my-form').hide();
                    //reload data sop 
                    reload_sop(id_divisi);
                    $('#preview').html(response[0].pesan);
                }else{
                    $('#preview').html(response[0].pesan);
                }
            }
            });
        });
    });
</script>