
            <?php  $id_pic = $this->session->userdata('id_user');  ?>
            <input name="id_pic" value="<?php echo $id_pic ?>" id="id_pic" type="hidden" >
          <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Nama</th>
                  <th>Divisi</th>
                  <th>Level</th>
                  <th>Username</th>
                  <th>Status Aktif</th>
                  <th></th>
                  <th></th>
                  <th></th>
                </tr>
                </thead>
                <tbody>  

                <?PHP

                foreach ($user as $key ) {
                   ?>
                       <tr>
                            <td><?php echo $key->nama ?></td>
                            <td><?php echo $this->M_divisi->detail( array('id_divisi' => $key->divisi ))->row()->nama_divisi;?> </td>
                            <td><?php echo $key->level ?></td>
                            <td><?php echo $key->username ?></td>
                            <td><?php
                            if($key->aktif==1)
                            {
                                echo "Aktif"; 
                            }
                            else
                            {
                                echo "Tidak Aktif";  
                            }  
                            ?></td>  
                            <td>
                                <button type="button" class="btn btn-danger btn-sm" onclick="hapus_user(<?php echo $key->id ?>)">
                                    <i class="fa fa-trash"> Hapus</i>
                                </button> 
                            </td>
                            <td> 
                                <button type="button" class="btn btn-success btn-sm" onclick="edit_user(<?php echo $key->id ?>)">
                                    <i class="glyphicon glyphicon-pencil"> Update</i>
                                </button> 
                            </td> 

                            <td> 
                              <button type="button" class="btn btn-success btn-sm" onclick="send_email(<?php echo $key->id ?>)">
                                  <i class="glyphicon glyphicon-envelope"> Email</i>
                              </button> 
                          </td>   
                        </tr>  
                   <?php
                } 
                ?>
                
                </tbody>
                <tfoot>
                <tr>
                    <th>Nama</th>
                    <th>Divisi</th>
                    <th>Level</th>
                    <th>Username</th>
                    <th>Status Aktif</th>
                    <th>Aksi</th> 
                </tr>
                </tfoot>
              </table>  

                <script>  
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
   