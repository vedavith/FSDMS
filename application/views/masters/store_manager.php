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
<script>
$(document).ready(function(){
    $('#res_id').on('change',function(){
        var r_id = $(this).val();
        if(r_id){
            $.ajax({
                type:'POST',
                url:'<?php echo base_url();?>superadmin/fetch_dropdown',
                data:'r_id='+r_id,
                success:function(html){
                    $('#br_id').html(html);
                }
            }); 
        }else{
            $('#br_id').html('<option value="">Select school first</option>');
        }
    });
  });
  </script>
<?php
if(!isset($store_manager_id))
{
?>
<div class="col-sm-6 col-md-9">
    <div class="row">
        <div class="col-md-6" align="left">
            <p class="h3"> Create Store Manager </p>
        </div>
        <div class="col-md-3" align="right">
            <a class="btn btn-sm btn-primary" href="<?php echo base_url()."superadmin/manage_store_manager"; ?>"> Manage </a>
        </div>
        <div class="col-md-3" align="right">
            <a class="btn btn-sm btn-outline-danger" href="<?php echo base_url()."superadmin/home"; ?>"> Back</a>
        </div>
    </div>
    <br>

    <form method="post" action="<?php echo base_url()."superadmin/insert_store_manager_data" ?>" enctype="multipart/form-data" id="form1">
    <div class="row container">
  <div class="container" id="accordion1">
    <div class="card">
      <div class="card-header">
        <a class="card-link" data-toggle="collapse" href="#CategoryOne">
         Store Manager details
        </a>
      </div>
      <div id="CategoryOne" class="collapse show" data-parent="#accordion1">
        

            <div class="row">
                
                    <div class="col-md-4">
                        <div class="card-body">
                         <input type="text" name="first_name" class="form-control" placeholder="First Name">
                        </div>
                    </div>
                     <div class="col-md-4">
                        <div class="card-body">
                         <input type="text" name="mid_name" class="form-control" placeholder="Middle Name">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card-body">
                         <input type="text" name="last_name" class="form-control" placeholder="Last Name">
                        </div>
                    </div>
                   
                    
            </div>
              <div class="row">
                 <div class="col-md-4">
                        <div class="card-body">
                         <input type="text" name="email" class="form-control" placeholder="Email Id">
                        </div>
                    </div>
                     <div class="col-md-4">
                        <div class="card-body">
                         <input type="text" name="phono_num" class="form-control" placeholder="Mobile number">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card-body">
                         <input type="text" name="employee_id" class="form-control" placeholder="Employee Id">
                         
                        </div>

                    </div>
                 </div>

            <div class="row">
                 <div class="col-md-4">
                        <div class="card-body">
                         <select class="form-control" name="company" id="res_id">
                              <option value=" ">Select company name </option>
                              <?php
                              foreach($company_data->result() as $row1)
                              {
                                ?>
                                <option value="<?php echo $row1->id;?>"><?php echo $row1->company_name;?></option>
                                <?php
                                }
                               ?>
                         </select>
                        </div>
                    </div> 
                    <div class="col-md-4">
                        <div class="card-body">
                         <select class="form-control" id="br_id" name="branch">
                                 <option></option>
                             </select>
                        </div> 
                    </div>   
                    <div class="col-md-4">
                        <div class="card-body">
                         <select class="form-control" name="store" id="str_id">
                              <option value=" ">Select Store name </option>
                              <?php
                              foreach($store_data->result() as $row3)
                              {
                                ?>
                                <option value="<?php echo $row3->id;?>"><?php echo $row3->store_name;?></option>
                                <?php
                                }
                               ?>
                         </select>
                        </div>
                    </div>
             </div>
            <div class="row">
                <div class="col-md-4">
                        <div class="card-body">
                         <input type="text" name="address1" class="form-control" placeholder="Address1"><br/>
                         <input type="text" name="address2" class="form-control" placeholder="Address2"><br/>
                         <input type="text" name="address3" class="form-control" placeholder="Address3">
                        </div>
                    </div>
                     <div class="col-md-4">
                        <div class="card-body">
                          <input type="text" name="city" class="form-control" placeholder="city"><br/>
                         
                           <input type="text" name="state" class="form-control" placeholder="state"><br/>
                        <input type="text" name="zipcode" class="form-control" placeholder="Zipcode">
                        </div>
                    </div>
            </div>
            
           
                <div class="card-body">
                <?php
                $count =0;
                if(!empty(form_error("first_name")))
                        {
                            $count = 1;
                    ?>
                    <div class="row alert alert-danger">
                                <strong>REQUIRED** : </strong> First name is Required
                    </div>
                    <?php
                        }
                         if(!empty(form_error("last_name")))
                        {
                            $count = 1;
                    ?>
                    <div class="row alert alert-danger">
                                <strong>REQUIRED** : </strong> Last name is Required
                    </div>
                    <?php
                        }
                         if(!empty(form_error("mid_name")))
                        {
                            $count = 1;
                    ?>
                    <div class="row alert alert-danger">
                                <strong>REQUIRED** : </strong> Middle name is Required
                    </div>
                    <?php
                        }
                         if(!empty(form_error("email")))
                        {
                            $count = 1;
                    ?>
                    <div class="row alert alert-danger">
                                <strong>REQUIRED** : </strong> Email Id is Required
                    </div>
                    <?php
                        }
                        if(!empty(form_error("phono_num")))
                        {
                            $count = 1;
                    ?>
                        <div class="row alert alert-danger">
                                <strong>REQUIRED** : </strong> Phone Number is Required
                    </div>
                        <?php
                            }
                         if(!empty(form_error("employee_id")))
                        {
                            $count = 1;
                    ?>
                    <div class="row alert alert-danger">
                                <strong>REQUIRED** : </strong> Employee Id is Required
                    </div>
                        <?php
                            }
                        if(!empty(form_error("company")))
                        {
                            $count = 1;
                    ?>
                    <div class="row alert alert-danger">
                                <strong>REQUIRED** : </strong> Company Name is Required
                    </div>
                        <?php
                            }
                             if(!empty(form_error("branch")))
                        {
                            $count = 1;
                    ?>
                    <div class="row alert alert-danger">
                                <strong>REQUIRED** : </strong> Branch Name is Required
                    </div>
                        <?php
                            }
                             if(!empty(form_error("store")))
                        {
                            $count = 1;
                    ?>
                    <div class="row alert alert-danger">
                                <strong>REQUIRED** : </strong> Store Id is Required
                    </div>
                        <?php
                            }
                    if(!empty(form_error("address1")))
                        {
                            $count = 1;
                    ?>
                    <div class="row alert alert-danger">
                                <strong>REQUIRED** : </strong> Address1 is Required
                    </div>
                        <?php
                            }
                         if(!empty(form_error("address2")))
                        {
                            $count = 1;
                    ?>
                    <div class="row alert alert-danger">
                                <strong>REQUIRED** : </strong>Address2 is Required
                    </div>
                        <?php
                            }
                       if(!empty(form_error("address3")))
                        {
                            $count = 1;
                    ?>
                    <div class="row alert alert-danger">
                                <strong>REQUIRED** : </strong> Address3 is Required
                    </div>
                        <?php
                            }
                             if(!empty(form_error("state")))
                        {
                            $count = 1;
                    ?>
                    <div class="row alert alert-danger">
                                <strong>REQUIRED** : </strong> State is Required
                    </div>
                        <?php
                            }
                    if(!empty(form_error("city")))
                        {
                            $count = 1;
                    ?>
                    <div class="row alert alert-danger">
                                <strong>REQUIRED** : </strong> City is Required
                    </div>
                        <?php
                            }
                        if(!empty(form_error("zipcode")))
                        {
                            $count = 1;
                    ?>
                    <div class="row alert alert-danger">
                                <strong>REQUIRED** : </strong> Zipcode is Required
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
    <?php
        if(isset($error))
        {
            if($error == "STR")
            {
        ?>
        <br>
        <div class="container-fluid">
            <div class="alert alert-danger">
                    <strong> ERROR(<?php echo $error; ?>) : </strong>STORE Details Already Exists
            </div>
        </div>
        <?php
            }
        }
        ?>
  </div>
    </div>
</form>
</div>
</form>
<?php
}

else
{
    if($store_manager_id->num_rows() > 0)
    {
        foreach ($store_manager_id->result() as $row)
        {

?>
<div class="col-sm-6 col-md-9">
    <div class="row">
        <div class="col-md-6" align="left">
            <p class="h3"> Edit Store Manager</p>
        </div>
        <div class="col-md-3" align="right">
            <a class="btn btn-sm btn-primary" href="<?php echo base_url()."superadmin/manage_store"; ?>"> Manage </a>
        </div>
        <div class="col-md-3" align="right">
            <a class="btn btn-sm btn-outline-danger" href="<?php echo base_url()."superadmin/home"; ?>"> Back</a>
        </div>
    </div>
    <br>

    <form method="post" action="<?php echo base_url()."superadmin/edit_store_manager_data" ?>" enctype="multipart/form-data" id="form1">
    <div class="row container">
  <div class="container" id="accordion1">
    <div class="card">
      <div class="card-header">
        <a class="card-link" data-toggle="collapse" href="#CategoryOne">
         Store Manager details
        </a>
      </div>
      <div id="CategoryOne" class="collapse show" data-parent="#accordion1">
        

             <div class="row">
                
                    <div class="col-md-4">
                        <div class="card-body">
                        <input type="hidden" name="hidden_id" value="<?php echo $row->id; ?>">
                         <input type="text" name="first_name" class="form-control" placeholder="First Name" value="<?php echo $row->first_name;?>">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card-body">
                         <input type="text" name="mid_name" class="form-control" placeholder="Middle Name" value="<?php echo $row->mid_name;?>">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card-body">
                         <input type="text" name="last_name" class="form-control" placeholder="Last Name" value="<?php echo $row->last_name;?>">
                        </div>
                    </div>
                    
                    
            </div>
              <div class="row">
                 <div class="col-md-4">
                        <div class="card-body">
                         <input type="text" name="email" class="form-control" placeholder="Email Id" value="<?php echo $row->email;?>" >
                        </div>
                    </div>
                     <div class="col-md-4">
                        <div class="card-body">
                         <input type="text" name="phono_num" class="form-control" placeholder="Mobile number" value="<?php echo $row->phone_num;?>">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card-body">
                         <input type="text" name="employee_id" class="form-control" placeholder="Employee Id" value="<?php echo $row->emp_id;?>">
                         
                        </div>

                    </div>
                 </div>

            <div class="row">
                 <div class="col-md-4">
                        <div class="card-body">
                         <select class="form-control" name="company" id="res_id">
                               <option value="<?php echo $row->company;?>"><?php echo $row->company_name;?></option>
                              <?php
                              foreach($company_data->result() as $row1)
                              {
                                ?>
                                <option value="<?php echo $row1->id;?>"><?php echo $row1->company_name;?></option>
                                <?php
                                }
                               ?>
                         </select>
                        </div>
                    </div> 
                    <div class="col-md-4">
                        <div class="card-body">
                         <select class="form-control" id="br_id" name="branch">
                                 <option value="<?php echo $row->branch; ?>"><?php echo $row->branch_name; ?></option>
                             </select>
                        </div> 
                    </div>   
                    <div class="col-md-4">
                        <div class="card-body">
                         <select class="form-control" name="store" id="str_id">
                              <option value=" ">Select Store name </option>
                              <?php
                              foreach($store_data->result() as $row3)
                              {
                                ?>
                                <option value="<?php echo $row3->id;?>" <?php if($row3->id == $row->store) echo "selected = 'selected'" ?>><?php echo $row3->store_name;?></option>
                                <?php
                                }
                               ?>
                         </select>
                        </div>
                    </div>
             </div>
            <div class="row">
                <div class="col-md-4">
                        <div class="card-body">
                         <input type="text" name="address1" class="form-control" placeholder="Address1" value="<?php echo $row->address1;?>"><br/>
                         <input type="text" name="address2" class="form-control" placeholder="Address2" value="<?php echo $row->address2;?>"><br/>
                         <input type="text" name="address3" class="form-control" placeholder="Address3" value="<?php echo $row->address3;?>">
                        </div>
                    </div>
                     <div class="col-md-4">
                        <div class="card-body">
                          <input type="text" name="city" class="form-control" placeholder="city" value="<?php echo $row->city;?>"><br/>
                         
                           <input type="text" name="state" class="form-control" placeholder="state" value="<?php echo $row->state;?>"><br/>
                        <input type="text" name="zipcode" class="form-control" placeholder="Zipcode" value="<?php echo $row->zipcode;?>">
                        </div>
                    </div>
            </div>
            
                <div class="card-body">
                <?php
                $count =0;
                if(!empty(form_error("first_name")))
                        {
                            $count = 1;
                    ?>
                    <div class="row alert alert-danger">
                                <strong>REQUIRED** : </strong> First name is Required
                    </div>
                    <?php
                        }
                         if(!empty(form_error("last_name")))
                        {
                            $count = 1;
                    ?>
                    <div class="row alert alert-danger">
                                <strong>REQUIRED** : </strong> Last name is Required
                    </div>
                    <?php
                        }
                         if(!empty(form_error("mid_name")))
                        {
                            $count = 1;
                    ?>
                    <div class="row alert alert-danger">
                                <strong>REQUIRED** : </strong> Middle name is Required
                    </div>
                    <?php
                        }
                         if(!empty(form_error("email")))
                        {
                            $count = 1;
                    ?>
                    <div class="row alert alert-danger">
                                <strong>REQUIRED** : </strong> Email Id is Required
                    </div>
                    <?php
                        }
                        if(!empty(form_error("phono_num")))
                        {
                            $count = 1;
                    ?>
                        <div class="row alert alert-danger">
                                <strong>REQUIRED** : </strong> Phone Number is Required
                    </div>
                        <?php
                            }
                         if(!empty(form_error("employee_id")))
                        {
                            $count = 1;
                    ?>
                    <div class="row alert alert-danger">
                                <strong>REQUIRED** : </strong> Employee Id is Required
                    </div>
                        <?php
                            }
                        if(!empty(form_error("company")))
                        {
                            $count = 1;
                    ?>
                    <div class="row alert alert-danger">
                                <strong>REQUIRED** : </strong> Company Name is Required
                    </div>
                        <?php
                            }
                             if(!empty(form_error("branch")))
                        {
                            $count = 1;
                    ?>
                    <div class="row alert alert-danger">
                                <strong>REQUIRED** : </strong> Branch Name is Required
                    </div>
                        <?php
                            }
                             if(!empty(form_error("store")))
                        {
                            $count = 1;
                    ?>
                    <div class="row alert alert-danger">
                                <strong>REQUIRED** : </strong> Store Id is Required
                    </div>
                        <?php
                            }
                    if(!empty(form_error("address1")))
                        {
                            $count = 1;
                    ?>
                    <div class="row alert alert-danger">
                                <strong>REQUIRED** : </strong> Address1 is Required
                    </div>
                        <?php
                            }
                         if(!empty(form_error("address2")))
                        {
                            $count = 1;
                    ?>
                    <div class="row alert alert-danger">
                                <strong>REQUIRED** : </strong>Address2 is Required
                    </div>
                        <?php
                            }
                       if(!empty(form_error("address3")))
                        {
                            $count = 1;
                    ?>
                    <div class="row alert alert-danger">
                                <strong>REQUIRED** : </strong> Address3 is Required
                    </div>
                        <?php
                            }
                             if(!empty(form_error("state")))
                        {
                            $count = 1;
                    ?>
                    <div class="row alert alert-danger">
                                <strong>REQUIRED** : </strong> State is Required
                    </div>
                        <?php
                            }
                    if(!empty(form_error("city")))
                        {
                            $count = 1;
                    ?>
                    <div class="row alert alert-danger">
                                <strong>REQUIRED** : </strong> City is Required
                    </div>
                        <?php
                            }
                        if(!empty(form_error("zipcode")))
                        {
                            $count = 1;
                    ?>
                    <div class="row alert alert-danger">
                                <strong>REQUIRED** : </strong> Zipcode is Required
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


