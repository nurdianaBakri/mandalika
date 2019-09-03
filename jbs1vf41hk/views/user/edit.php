<form role="form" id="my-form">

    <input type="hidden" name="id_user" id="id_user" value="<?php echo $data->id ?>">
    <input type="hidden" name="id_pic" id="id_pic" value="<?php echo $id_pic ?>"> 
     
    <div class="form-group has-feedback">
        <label for="exampleInputEmail1">Nama</label> 
        <input type="text" name="nama" id="nama" class="form-control" placeholder="nama" required value="<?php echo $data->nama ?>"> 
    </div>

    <div class="form-group has-feedback">
        <label for="exampleInputEmail1">Username</label>  
        <input type="email" name="username" id="username" class="form-control" placeholder="username" required value="<?php echo $data->username ?>">
        
    </div> 

    <div class="form-group has-feedback">
        <label for="exampleInputEmail1">Divisi</label>   
        <select name="divisi" class="form-control" required  id="divisi">
        <?php
            foreach ($divisi as $key) {
                ?>
                 <option value='<?php echo $key->id_divisi; ?>' <?php if ($key->id_divisi == $data->divisi) echo ' selected'; ?>> <?php echo $key->nama_divisi ?></option>
                <?php 
            }
        ?> 
        </select>
        
    </div> 

    <div class="form-group has-feedback">
        <label for="exampleInputEmail1">Level</label>  
        <select name="level" class="form-control" id="level" required> 
            <option value='Admin' <?php if ($data->level == 'Admin') echo ' selected'; ?>>Admin</option> 
            <!-- <option value='PIC' <?php if ($data->level == 'PIC') echo ' selected'; ?>>PIC</option>  -->
            <option value='User' <?php if ($data->level == 'User') echo ' selected'; ?>>User</option> 
        </select>
        
    </div>  

    <div class="form-group has-feedback">
        <label for="exampleInputEmail1">Status Aktif</label>  
        <select name="aktif" class="form-control" id="aktif" required> 
            <option value='0' <?php if ($data->aktif == 0) echo ' selected'; ?>>Tidak Aktif</option>  
            <option value='1' <?php if ($data->aktif == 1) echo ' selected'; ?>>Aktif</option>  
        </select>
        
    </div>  

    <div class="form-group has-feedback">
        <label for="exampleInputEmail1">Password (Isi jika ingin merubah password)</label>   
        <input type="password" name="password" class="form-control" placeholder="Password" id="password" required>
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
    </div>

    <div class="row">  
        <div class="col-xs-12">
            <button type="submit" id="submit" class="btn btn-success btn-block btn-flat" id="edit_user" disabled>Update</button>
        </div> 
    </div>
</form> 

<div id="preview"><div> 
<img src="<?php echo base_url()."assets/image/processing.gif" ?>" style="width:50px;height:50px;" class="processing"> 
    
    <script> 

        $(document).ready(function() {  

            cek_validasi(); 

            //set button menjadi dissable 
            $("#submit").attr('disabled', 'disabled');

            //cek form ketika user memasukkan data ke dalamnya 
            $("input").keyup(function() {     
                // To Disable Submit Button
                $("#submit").attr('disabled', 'disabled');
                cek_validasi(); 
            }); 

            $("select").change(function() {   
                // To Disable Submit Button
                $("#submit").attr('disabled', 'disabled');
                cek_validasi(); 
            }); 

        }); 

        function cek_validasi() {
             // Validating Fields 
            var nama=$("#nama").val();
            var username=$("#username").val();
            var divisi=$("#divisi").val();
            var level=$("#level").val();
            var aktif=$("#aktif").val();

            console.log(nama);
            console.log(username);
            console.log(divisi);
            console.log(level);
            console.log(aktif); 

            if ( !(nama=="" || username=="" || divisi=="" || level=="" || aktif==""  )) { 
                // To Enable Submit Button
                $("#submit").removeAttr('disabled'); 
            }
        }  

    
    $(document).ready(function(){  
        var id_user = $('#id_user').val();  
        var id_pic = $('#id_pic').val();  

        $('.processing').hide(); 
        $('#edit_user').click(function(){ 
            event.preventDefault();
            var form = $("#my-form")[0];
            var data = new FormData(form);
            var url = '<?php echo base_url().'User/do_update/' ?>'+id_user+'/'+id_pic;

            console.log(url);
            // AJAX request
            $.ajax({
            url: url,
            type: 'post',
            data: data,
            contentType: false,
            processData: false,
            dataType: 'json',
            success: function(response){ 
                console.log(response);
                $('.processing').show();    
                if(response.status != 0){ 
                    $('.processing').hide();  
                    $('#my-form').hide(); 
                    reload_user(); 
                    $('#preview').html(response[0].pesan);
                }else{
                    $('#preview').html(response[0].pesan);
                }
            }
            });
        });
    });
</script>