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
            <p class="h3"> Create Store </p>
        </div>
        <div class="col-md-3" align="right">
            <a class="btn btn-sm btn-primary" href="<?php echo base_url()."superadmin/manage_store"; ?>"> Manage </a>
        </div>
        <div class="col-md-3" align="right">
            <a class="btn btn-sm btn-outline-danger" href="<?php echo base_url()."superadmin/home"; ?>"> Back</a>
        </div>
    </div>
    <br>

    <form method="post" action="<?php echo base_url()."superadmin/insert_store_data" ?>" enctype="multipart/form-data" id="form1">
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
                         <input type="text" name="store_name" class="form-control" placeholder="Store Name">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card-body">
                         <input type="text" name="email" class="form-control" placeholder="Email Id">
                        </div>
                    </div>
                    
            </div>
            

            <div class="row">
                
                    
                    <div class="col-md-6">
                        <div class="card-body">
                         <input type="text" name="phono_num" class="form-control" placeholder="Mobile number">
                        </div>
                    </div>
                    
            </div>
            
            <div class="row">
                    <div class="col-md-6">
                        <div class="card-body">
                         <input type="text" name="address1" class="form-control" placeholder="Address1"><br/>
                         <input type="text" name="address2" class="form-control" placeholder="Address2"><br/>
                         <input type="text" name="address3" class="form-control" placeholder="Address3">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card-body">
                         <input type="text" name="state" class="form-control" placeholder="state"><br/>
                         <input type="text" name="city" class="form-control" placeholder="city"><br/>
                         <input type="text" name="zipcode" class="form-control" placeholder="Zipcode">
                        </div>
                    </div>
            </div>
                <div class="card-body">
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
                        if(!empty(form_error("email")))
                        {
                            $count = 1;
                    ?>
                        <div class="row alert alert-danger">
                                <strong>REQUIRED** : </strong> Email is Required
                    </div>
                        <?php
                            }
                            if(!empty(form_error("phono_num")))
                        {
                            $count = 1;
                    ?>
                    <div class="row alert alert-danger">
                                <strong>REQUIRED** : </strong> Mobile is Required
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
    if($store_data_id->num_rows() > 0)
    {
        foreach ($store_data_id->result() as $row1)
        {

?>
<div class="col-sm-6 col-md-9">
    <div class="row">
        <div class="col-md-6" align="left">
            <p class="h3"> Edit Store </p>
        </div>
        <div class="col-md-3" align="right">
            <a class="btn btn-sm btn-primary" href="<?php echo base_url()."superadmin/manage_store"; ?>"> Manage </a>
        </div>
        <div class="col-md-3" align="right">
            <a class="btn btn-sm btn-outline-danger" href="<?php echo base_url()."superadmin/home"; ?>"> Back</a>
        </div>
    </div>
    <br>

    <form method="post" action="<?php echo base_url()."superadmin/edit_store_data" ?>" enctype="multipart/form-data" id="form1">
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
                    <input type="hidden" name="hidden_store"  value="<?php echo $row1->id;?>">
                         <input type="text" name="store_name" class="form-control" placeholder="Store Name" value="<?php echo $row1->store_name;?>">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card-body">
                         <input type="text" name="email" class="form-control" placeholder="Email Id" value="<?php echo $row1->email;?>">
                        </div>
                    </div>
                    
            </div>
            

            <div class="row">
                
                    
                    <div class="col-md-6">
                        <div class="card-body">
                <input type="text" name="phono_num" class="form-control" placeholder="Mobile number" value="<?php echo $row1->phone_num;?>">
                        </div>
                    </div>
                    
            </div>
            
            <div class="row">
                    <div class="col-md-6">
                        <div class="card-body">
                         <input type="text" name="address1" class="form-control" placeholder="Address1" value="<?php echo $row1->address1;?>"><br/>
                         <input type="text" name="address2" class="form-control" placeholder="Address2" value="<?php echo $row1->address2;?>"><br/>
                         <input type="text" name="address3" class="form-control" placeholder="Address3" value="<?php echo $row1->address3;?>">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card-body">
                         <input type="text" name="state" class="form-control" placeholder="state" value="<?php echo $row1->state;?>"><br/>
                         <input type="text" name="city" class="form-control" placeholder="city" value="<?php echo $row1->city;?>"><br/>
                         <input type="text" name="zipcode" class="form-control" placeholder="Zipcode" value="<?php echo $row1->zipcode;?>">
                        </div>
                    </div>
            </div>
                <div class="card-body">
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
                        if(!empty(form_error("email")))
                        {
                            $count = 1;
                    ?>
                        <div class="row alert alert-danger">
                                <strong>REQUIRED** : </strong> Email is Required
                    </div>
                        <?php
                            }
                            if(!empty(form_error("phono_num")))
                        {
                            $count = 1;
                    ?>
                    <div class="row alert alert-danger">
                                <strong>REQUIRED** : </strong> MObile is Required
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


