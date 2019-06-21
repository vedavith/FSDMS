<style>
    .btn-file {
    position: relative;
    overflow: hidden;
}
.btn-file input[type=file] {
    position: absolute;
    top: 0;
    right: 0;
    min-width: 100%;
    min-height: 100%;
    font-size: 100px;
    text-align: right;
    filter: alpha(opacity=0);
    opacity: 0;
    outline: none;
    background: white;
    cursor: inherit;
    display: block;
}


</style>

<?php
if(!isset($store_data_id))
{
?>
<div class="col-sm-6 col-md-9">
    <div class="row">
        <div class="col-md-6" align="left">
            <p class="h3"> Create Store Mapping</p>
        </div>
        <div class="col-md-3" align="right">
            <a class="btn btn-sm btn-primary" href="<?php echo base_url()."superadmin/manage_store_mapping"; ?>"> Manage </a>
        </div>
        <div class="col-md-3" align="right">
            <a class="btn btn-sm btn-outline-danger" href="<?php echo base_url()."superadmin/home"; ?>"> Back</a>
        </div>
    </div>
    <br>

    <form method="post" action="<?php echo base_url()."superadmin/store_mapping_data" ?>" enctype="multipart/form-data" id="form1">
    <div class="row container">
  <div class="container" id="accordion1">
    <div class="card">
      <div class="card-header">
        <a class="card-link" data-toggle="collapse" href="#CategoryOne">
         Store Mapping
        </a>
      </div>
      <div id="CategoryOne" class="collapse show" data-parent="#accordion1">
        

           

            <div class="row">
                <div class="col-md-6">
                    <div class="card-body">
                    <select class="form-control" name="store" id="store_id">
                              <option value=" ">Select store name </option>
                              <?php
                              foreach($get_store->result() as $row1)
                              {
                                ?>
                                <option value="<?php echo $row1->id;?>"><?php echo $row1->store_name;?></option>
                                <?php
                                }
                               ?>

                     </select>
                     </div>
                 </div>
                 <div class="col-md-6">
                    <div class="card-body">
                    <select class="form-control" name="room" id="room_id">
                              <option value=" ">Select room name </option>
                              <?php
                              foreach($get_room->result() as $row1)
                              {
                                ?>
                                <option value="<?php echo $row1->id;?>"><?php echo $row1->room_name;?></option>
                                <?php
                                }
                               ?>
                               <option value="none">None</option>
                     </select>
                     </div>
                 </div>
             </div>
             <div class="row">
                <div class="col-md-6">
                    <div class="card-body">
                    <select class="form-control" name="grid" id="grid_id">
                              <option value=" ">Select grid name </option>
                              <?php
                              foreach($get_grid->result() as $row1)
                              {
                                ?>
                                <option value="<?php echo $row1->id;?>"><?php echo $row1->grid_name;?></option>
                                <?php
                                }
                               ?>
                               <option value="none">None</option>
                     </select>
                     </div>
                 </div>
                 <div class="col-md-6">
                    <div class="card-body">
                    <select class="form-control" name="bin" id="bin_id">
                              <option value=" ">Select bin name </option>
                              <?php
                              foreach($get_bin->result() as $row1)
                              {
                                ?>
                                <option value="<?php echo $row1->id;?>"><?php echo $row1->bin_name;?></option>
                                <?php
                                }
                               ?>
                               <option value="none">None</option>
                     </select>
                     </div>
                 </div>
                    
            </div>
            
           <div id="error">
       
            </div>
                <div class="card-body">
                <?php
                $count =0;
                if(!empty(form_error("store")))
                        {
                            $count = 1;
                    ?>
                    <div class="row alert alert-danger">
                                <strong>REQUIRED** : </strong> Store name is Required
                    </div>
                    <?php
                        }
                       if(!empty(form_error("room")))
                        {
                            $count = 1;
                    ?>
                    <div class="row alert alert-danger">
                                <strong>REQUIRED** : </strong>Room is Required
                    </div>
                        <?php
                            }
                       if(!empty(form_error("grid")))
                        {
                            $count = 1;
                    ?>
                    <div class="row alert alert-danger">
                                <strong>REQUIRED** : </strong> Grid is Required
                    </div>
                        <?php
                            }
                       if(!empty(form_error("bin")))
                        {
                            $count = 1;
                    ?>
                    <div class="row alert alert-danger">
                                <strong>REQUIRED** : </strong> Bin is Required
                    </div>
                        <?php
                            }
                    
                       
                            if ($count == 1)
                            {
                            ?>
                            <script>
                                $(document).ready(function(){
                                        $("#CategoryOne").addClass("show");
                                });
                            </script>
                        <?php
                        }
                        ?>
      </div>
        </div>
    </div>
    
    <div class="card">
      <div class="card-header">
        <a class="collapsed card-link" data-toggle="collapse" href="#CategoryThree">
         Submit
        </a>
      </div>
      <div id="CategoryThree" class="collapse" data-parent="#accordion1">
        <div class="row card-body">
            <div class="col-md-6 col-sm-3" align="right">
                 <input type="submit" name="insert" id="submit" value="Submit" class="btn btn-outline-success">
                <!--<button type="submit" class="btn btn-outline-success"> Submit </button>-->
            </div>
            <div class="col-md-6 col-sm-3" align="left">
                <button type="reset" class="btn btn-outline-danger"> Cancel </button>
            </div>
        </div>
      </div>
    </div>
   
  </div>
    </div>
</form>
</div>
</form>
<script>
    $(document).ready(function(){
        
        $('#bin_id').on('change',function(){
             var s_id = $('#store_id').val();
            
             var r_id = $('#room_id').val();
             var g_id = $('#grid_id').val();
             var b_id = $('#bin_id').val();
             $.ajax({
                type:'POST',
                url:'<?php echo base_url();?>superadmin/ajax_srgb_check',
                data:{'s_id': s_id,'r_id':r_id,'g_id':g_id,'b_id':b_id},
                success:function(resp){
                    data=resp;
                    
                  if(data >0)
                  {
                    $('#error').append("this is already exist").addClass("alert alert-danger");
                    
                  }
                  else{
                    return 0;
                  }

                }
            }); 
        });

    });
    </script>
<?php
}

else
{
    if($store_data_id->num_rows() > 0)
    {
        foreach ($store_data_id->result() as $row)
        {

?>
<div class="col-sm-6 col-md-9">
    <div class="row">
        <div class="col-md-6" align="left">
            <p class="h3"> Edit Store </p>
        </div>
        <div class="col-md-3" align="right">
            <a class="btn btn-sm btn-primary" href="<?php echo base_url()."superadmin/manage_store_mapping"; ?>"> Manage </a>
        </div>
        <div class="col-md-3" align="right">
            <a class="btn btn-sm btn-outline-danger" href="<?php echo base_url()."superadmin/home"; ?>"> Back</a>
        </div>
    </div>
    <br>

    <form method="post" action="<?php echo base_url()."superadmin/edit_store_mapping_data" ?>" enctype="multipart/form-data" id="form1">
    <div class="row container">
  <div class="container" id="accordion1">
    <div class="card">
      <div class="card-header">
        <a class="card-link" data-toggle="collapse" href="#CategoryOne">
         Store details
        </a>
      </div>
      <div id="CategoryOne" class="collapse show" data-parent="#accordion1">
        
             <div class="row">
                <div class="col-md-6">
                    <div class="card-body">
                        <input type="hidden" name="map_id" value="<?php echo $row->id;?>">
                    <select class="form-control" name="store" id="store_id">
                              <option value=" ">Select store name </option>
                              <?php
                              foreach($get_store->result() as $row1)
                              {
                                ?>
                                <option value="<?php echo $row1->id;?>" <?php if($row1->id == $row->store) echo "selected ='selected'" ?>><?php echo $row1->store_name;?></option>
                                <?php
                                }
                               ?>
                     </select>
                     </div>
                 </div>
                 <div class="col-md-6">
                    <div class="card-body">
                    <select class="form-control" name="room" id="room_id">
                              <option value=" ">Select room name </option>
                              <?php
                              foreach($get_room->result() as $row1)
                              {
                                ?>
                                <option value="<?php echo $row1->id;?>" <?php if($row1->id == $row->room) echo "selected ='selected'" ?>><?php echo $row1->room_name;?></option>
                                <?php
                                }
                               ?>
                               <option value="none" <?php if($row->room=="none")echo "selected =='selected'"; ?>>None</option>
                     </select>
                     </div>
                 </div>
             </div>
             <div class="row">
                <div class="col-md-6">
                    <div class="card-body">
                    <select class="form-control" name="grid" id="grid_id">
                              <option value=" ">Select grid name </option>
                              <?php
                              foreach($get_grid->result() as $row1)
                              {
                                ?>
                                <option value="<?php echo $row1->id;?>" <?php if($row1->id == $row->grid) echo "selected ='selected'" ?>><?php echo $row1->grid_name;?></option>
                                <?php
                                }
                               ?>
                               <option value="none" <?php if($row->grid=="none")echo "selected =='selected'"; ?>>None</option>
                     </select>
                     </div>
                 </div>
                 <div class="col-md-6">
                    <div class="card-body">
                    <select class="form-control" name="bin" id="bin_id">
                              <option value=" ">Select bin name </option>
                              <?php
                              foreach($get_bin->result() as $row1)
                              {
                                ?>
                                <option value="<?php echo $row1->id;?>" <?php if($row1->id == $row->bin) echo "selected ='selected'" ?>><?php echo $row1->bin_name;?></option>
                                <?php
                                }
                               ?>
                               <option value="none" <?php if($row->bin=="none")echo "selected =='selected'"; ?>>None</option>
                     </select>
                     </div>
                 </div>
                    
            </div>
            
           

        
            
          
                <div class="card-body" id="error1">
                <?php
                $count =0;
                if(!empty(form_error("store_name")))
                        {
                            $count = 1;
                    ?>
                    <div class="row alert alert-danger">
                                <strong>REQUIRED** : </strong> Store_name is Required
                    </div>
                    <?php
                        }
                       
                     if ($count == 1)
                            {
                            ?>
                            <script>
                                $(document).ready(function(){
                                        $("#CategoryOne").addClass("show");
                                });
                            </script>
                        <?php
                        }
                        ?>
                     </div>
        </div>
    </div>
    
    <div class="card">
      <div class="card-header">
        <a class="collapsed card-link" data-toggle="collapse" href="#CategoryThree">
         Submit
        </a>
      </div>
      <div id="CategoryThree" class="collapse" data-parent="#accordion1">
        <div class="row card-body">
            <div class="col-md-6 col-sm-3" align="right">
                 <input type="submit" name="update" id="update" value="Update" class="btn btn-outline-success">
                <!--<button type="submit" class="btn btn-outline-success"> Submit </button>-->
            </div>
            <div class="col-md-6 col-sm-3" align="left">
                <a href="<?php echo base_url()."superadmin/create_store" ?>" class="btn btn-outline-danger"> Back </a>
            </div>
        </div>
      </div>
    </div>
    
  </div>
    </div>
</form>
</div>
</form>
<script>
    $(document).ready(function(){
        
        $('#bin_id').on('change',function(){
             var s_id = $('#store_id').val();
            
             var r_id = $('#room_id').val();
             var g_id = $('#grid_id').val();
             var b_id = $('#bin_id').val();
             $.ajax({
                type:'POST',
                url:'<?php echo base_url();?>superadmin/ajax_srgb_check',
                data:{'s_id': s_id,'r_id':r_id,'g_id':g_id,'b_id':b_id},
                success:function(resp){
                    data=resp;
                    
                  if(data >0)
                  {
                    alert("this is already exist");
                     $('#update').prop('disabled', true);
                  }
                  else{
                    //return 0;
                    $('#update').prop('disabled', false);
                  }

                }
            }); 
        });

    });
    </script>
<?php
}
}
}
?>


<!-- Dont Remove this closed div tag -->
    <!-- Side row closed -->
    </div>
    <!-- sidebar container fluid closed -->
</div>


<br><br><br><br><br>


