<br><br><br><br><br>
<script>
$(document).ready(function(){
    $('#res_id').on('change',function(){
        var r_id = $(this).val();
        if(r_id){
            $.ajax({
                type:'POST',
                url:'<?php echo base_url();?>home/fetch_dropdown',
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
$(document).ready(function(){
    $('#com_id').on('change',function(){
        var r_id = $(this).val();
        if(r_id){
            $.ajax({
                type:'POST',
                url:'<?php echo base_url();?>home/fetch_dropdown',
                data:'r_id='+r_id,
                success:function(html){
                    $('#brn_id').html(html);
                }
            }); 
        }else{
            $('#brn_id').html('<option value="">Select school first</option>');
        }
    });
  });
  </script>
 <?php
if(!isset($represent_data_id))
{
  
?>
<section>
    <div class = "container">
        <div class="row">
      <div class="col-md-6" align="left">
        <p class="h3"> Corporate Representative </p>
      </div>
      <div class="col-md-3" align="right">
        <a class="btn btn-sm btn-primary" href="<?php echo base_url()."home/manage_representative"; ?>"> Manage </a>
      </div>
      <div class="col-md-3" align="right">
        <a class="btn btn-sm btn-outline-danger" href="<?php echo base_url()."superadmin/home"; ?>"> Back</a>
      </div>
    </div>
    <br>
      <form method="post" action="<?php echo base_url()."home/representative_data" ?>">
        <div class="row">
          <div class="col-md-4">
           <select class="form-control" name="company_name" id="res_id">
                <option value="">select company name</option>
                <?php 
                foreach($company_data->result() as $row2)
                {
                  ?>

                  <option value="<?php echo $row2->id; ?>"> <?php echo $row2->company_name; ?> </option>
                  <?php
                }
                ?>
              
              </select>
        </div>
        <div class="col-md-4">
            <select class="form-control" id="br_id" name="branch_name">
               <option></option>
           </select>
        </div>
        <div class="col-md-4">
           <input type="text" class="form-control" name="rep_employee_id" placeholder="Employee ID">
        </div>
      </div>
      <br/>
     <div class="row">
        <div class="col-md-4">
           <select class="form-control" name="user_title">
              <option value="Mr" > Mr </option>
              <option value="Ms" > Ms </option>
              <option value="Dr" > Dr </option>
            </select>
        </div>
        <div class="col-md-4">
          <input type="text" name="rep_first_name" class="form-control" placeholder="First Name">
        </div>
        <div class="col-md-4">
           <input type="text" name="rep_middle_name" class="form-control" placeholder="Middle Name">
        </div>
    </div> <br/>
    <div class="row">
        <div class="col-md-4">
            <input type="text" name="rep_last_name" class="form-control" placeholder="Last Name">
        </div>
        <div class="col-md-4">
            <input type="text" class="form-control" name="rep_email_id" placeholder="Email">
        </div>
        <div class="col-md-4">
            <input type="text" class="form-control" name="rep_phone_number" placeholder="Phone Number">
        </div>
    </div> <br> 
    <div class="row">
        <div class="col-md-4">
           <input type="hidden" class="form-control" name="rep_user_password" id="corporate_user_password" placeholder="Password" value="<?php echo mt_rand(10000000,99999999)?>">
               
                <input type="text" class="form-control" name="rep_designation" placeholder="Designation"><br/>
                 <input type="text" class="form-control" name="rep_state" placeholder="State"> 
        </div>
        
         <div class="col-md-4">
            <input type="text" class="form-control" name="rep_city" placeholder="City"> <br/>
            <input type="text" class="form-control" name="rep_zipcode" placeholder="Zipcode"> 
        </div>
        <div class="col-md-4">
             <input type="text" class="form-control" name="rep_address1" placeholder="address1"><br/>
           <input type="text" class="form-control" name="rep_address2" placeholder="address2"><br/>
             <input type="text" class="form-control" name="rep_address3" placeholder="address3"><br/>
        </div>
    </div> <br> 
   <div class="container">
        
          <?php
                                  
                  $count =0;
                   if(!empty(form_error("company_name")))
                      {
                        $count = 1;
                    ?>
                    <div class="row alert alert-danger">
                          <strong>REQUIRED** : </strong> Company name is Required
                    </div>
                    <?php
                      }
                       if(!empty(form_error("branch_name")))
                      {
                        $count = 1;
                    ?>
                    <div class="row alert alert-danger">
                          <strong>REQUIRED** : </strong> Branch name is Required
                    </div>
                    <?php
                      }
                      if(!empty(form_error("rep_first_name")))
                      {
                        $count = 1;
                    ?>
                    <div class="row alert alert-danger">
                          <strong>REQUIRED** : </strong> First name is Required
                    </div>
                    <?php
                      }
                      if(!empty(form_error("rep_middle_name")))
                      {
                        $count = 1;
                    ?>
                      <div class="row alert alert-danger">
                          <strong>REQUIRED** : </strong> Middle name is Required
                    </div>
                      <?php
                        }
                        if(!empty(form_error("rep_last_name")))
                        {
                        $count = 1;
                      ?>
                      <div class="row alert alert-danger">
                          <strong>REQUIRED** : </strong> Last name is Required
                    </div>
                      <?php
                        }
                        if(!empty(form_error("rep_designation")))
                        {
                        $count = 1;
                      ?>
                      <div class="row alert alert-danger">
                          <strong>REQUIRED** : </strong> Designation is Required
                    </div>
                      <?php
                        }
                        if(!empty(form_error("rep_employee_id")))
                        {
                        $count = 1;
                      ?>
                      <div class="row alert alert-danger">
                          <strong>REQUIRED** : </strong> Employee id is Required
                    </div>
                      <?php
                        }
                        if(!empty(form_error("rep_email_id")))
                        {
                        $count = 1;
                      ?>
                      <div class="row alert alert-danger">
                          <strong>REQUIRED** : </strong> Email Id is Required
                    </div>
                      <?php
                        }
                         if(!empty(form_error("rep_phone_number")))
                        {
                        $count = 1;
                      ?>
                      <div class="row alert alert-danger">
                          <strong>REQUIRED** : </strong> phone number is Required
                    </div>
                      <?php
                        }
                         if(!empty(form_error("rep_address1")))
                      {
                        $count = 1;
                    ?>
                    <div class="row alert alert-danger">
                          <strong>REQUIRED** : </strong> Representative Address1 is Required
                    </div>
                    <?php
                      }
                      if(!empty(form_error("rep_address2")))
                      {
                        $count = 1;
                    ?>
                      <div class="row alert alert-danger">
                          <strong>REQUIRED** : </strong> Representative Address2  is Required
                    </div>

                      <?php
                    }
                    if(!empty(form_error("rep_address3")))
                      {
                        $count = 1;
                      ?>
                      <div class="row alert alert-danger">
                          <strong>REQUIRED** : </strong> Representative Address3 is Required
                    </div>
                    <?php
                  }
                  if(!empty(form_error("rep_city")))
                      {
                        $count = 1;
                      ?>
                      <div class="row alert alert-danger">
                          <strong>REQUIRED** : </strong> Representative city is Required
                    </div>
                    <?php
                  }
                    if(!empty(form_error("rep_state")))
                      {
                        $count = 1;
                    ?>
                    <div class="row alert alert-danger">
                          <strong>REQUIRED** : </strong> Representative State is Required
                    </div>
                    <?php
                  }

                  if(!empty(form_error("rep_zipcode")))
                      {
                        $count = 1;
                    ?>
                    <div class="row alert alert-danger">
                          <strong>REQUIRED** : </strong> Representative City is Required
                    </div>
                      <?php 
                    }
                    if ($count == 1)
                        {
                        ?>
                        <script>
                          $(document).ready(function(){
                              $("#CategoryTwo").addClass("show");
                          });
                        </script>
                        <?php
                        }
                      ?>
        </div>
    <div class="container">
      <?php
    if(isset($error))
    {
      if($error == "LOGIN")
      {
    ?>
    <br>
    <div class="container-fluid">
      <div class="alert alert-danger">
          <strong> ERROR(<?php echo $error; ?>) : </strong> Email Details Already Exists
      </div>
    </div>
    <?php
      }
    else if($error1 == "REP")
      {
    ?>
    <br>
    <div class="container-fluid">
      <div class="alert alert-danger">
          <strong> ERROR(<?php echo $error1; ?>) : </strong> Reprasentative Details Already Exists
      </div>
    </div>
    <?php
      }
    }
    ?>  
    </div>
    <div class="row card-body">
          <div class="col-md-6 col-sm-3" align="right">
             <input type="submit" name="insert" id="submit" value="Submit" class="btn btn-outline-success">
            <!--<button type="submit" class="btn btn-outline-success"> Submit </button>-->
          </div>
          <div class="col-md-6 col-sm-3" align="left">
            <button type="reset" class="btn btn-outline-danger"> Cancel </button>
          </div>
        </div><br/><br/>
    </form>  
<br>

</section>

<?php 
  
}
else
{
  if($represent_data_id->num_rows() > 0)
  {
    foreach ($represent_data_id->result() as $row)
    {
  ?>
  <section>
    <div class = "container">
        <div class="row">
      <div class="col-md-6" align="left">
        <p class="h3"> Corporate Representative </p>
      </div>
      <div class="col-md-3" align="right">
        <a class="btn btn-sm btn-primary" href="<?php echo base_url()."home/manage_representative"; ?>"> Manage </a>
      </div>
      <div class="col-md-3" align="right">
        <a class="btn btn-sm btn-outline-danger" href="<?php echo base_url()."superadmin/home"; ?>"> Back</a>
      </div>
    </div>
    <br>
      <form method="post" action="<?php echo base_url()."home/edit_representative_data" ?>">
        <div class="row">
          <div class="col-md-4">
          <select class="form-control" name="company_name" id="com_id" >
             <!--<option value=" ">Select company name </option>-->
              <option value="<?php echo $row->company_name;?>"><?php echo $row->company;?></option>
              <?php
              foreach($company_data->result() as $row1)
              {
                ?>
                <option value="<?php echo $row1->id;?>" <?php //if($row1->id == $row->company_name) echo "selected = 'selected'";?>><?php echo $row1->company_name;?></option>
                <?php
                }
               ?>
             
            </select>
        </div>
        <div class="col-md-4">
             <select class="form-control" name="branch_name" id="brn_id">
              <option value="<?php echo $row->branch_name?>"> <?php echo $row->branch; ?> </option>
            </select>
        </div>
        <div class="col-md-4">
           <input type="text" class="form-control" name="rep_employee_id" placeholder="Employee ID" value="<?php echo $row->rep_employee_id; ?>">
                <input type="hidden" name="rhidden_id" value="<?php echo $row->id ?>">
        </div>
      </div>
      <br/>
     <div class="row">
        <div class="col-md-4">
           <select class="form-control" name="user_title">
             <option value="Mr" <?php if($row->user_title =="Mr") echo "selected='selected'"; ?> > Mr </option>
              <option value="Ms" <?php if($row->user_title =="Ms") echo "selected='selected'"; ?> > Ms </option>
              <option value="Dr" <?php if($row->user_title =="Dr") echo "selected='selected'"; ?> > Dr </option>
            </select>
        </div>
        <div class="col-md-4">
       <input type="text" name="rep_first_name" class="form-control" placeholder="First Name" value="<?php echo $row->rep_first_name?>">
        </div>
        <div class="col-md-4">
           <input type="text" name="rep_middle_name" class="form-control" placeholder="Middle Name" value="<?php echo $row->rep_mid_name?>">
        </div>
    </div> <br/>
    <div class="row">
        <div class="col-md-4">
            <input type="text" name="rep_last_name" class="form-control" placeholder="Last Name" value="<?php echo $row->rep_last_name?>">
        </div>
        <div class="col-md-4">
             <input type="text" class="form-control" name="rep_email_id" placeholder="Email" value="<?php echo $row->rep_email_id?>">
        </div>
        <div class="col-md-4">
             <input type="text" class="form-control" name="rep_phone_number" placeholder="Phone Number" value="<?php echo $row->rep_phono_no?>">
        </div>
    </div> <br> 
    <div class="row">
        <div class="col-md-4">
          <input type="text" class="form-control" name="rep_designation" placeholder="Designation" value="<?php echo $row->rep_designation?>">
          <br/>
          <input type="text" class="form-control" name="rep_state" placeholder="State" value="<?php echo $row->rep_state;?>">
        </div>
        
         <div class="col-md-4">
            <input type="text" class="form-control" name="rep_city" placeholder="City" value="<?php echo $row->rep_city;?>"> <br/>
              <input type="text" class="form-control" name="rep_zipcode" placeholder="Zipcode" value="<?php echo $row->rep_zipcode?>"> 
        </div>
        <div class="col-md-4">
             <input type="text" class="form-control" name="rep_address1" placeholder="address1" value="<?php echo $row->rep_address1?>"><br/>
           <input type="text" class="form-control" name="rep_address2" placeholder="address2" value="<?php echo $row->rep_address2?>"><br/>
             <input type="text" class="form-control" name="rep_address3" placeholder="address3" value="<?php echo $row->rep_address3?>"><br/>
        </div>
    </div> <br> 
   <div class="container">
        
          <?php
                                  
                  $count =0;
                   if(!empty(form_error("company_name")))
                      {
                        $count = 1;
                    ?>
                    <div class="row alert alert-danger">
                          <strong>REQUIRED** : </strong> Company name is Required
                    </div>
                    <?php
                      }
                       if(!empty(form_error("branch_name")))
                      {
                        $count = 1;
                    ?>
                    <div class="row alert alert-danger">
                          <strong>REQUIRED** : </strong> Branch name is Required
                    </div>
                    <?php
                      }
                      if(!empty(form_error("rep_first_name")))
                      {
                        $count = 1;
                    ?>
                    <div class="row alert alert-danger">
                          <strong>REQUIRED** : </strong> First name is Required
                    </div>
                    <?php
                      }
                      if(!empty(form_error("rep_middle_name")))
                      {
                        $count = 1;
                    ?>
                      <div class="row alert alert-danger">
                          <strong>REQUIRED** : </strong> Middle name is Required
                    </div>
                      <?php
                        }
                        if(!empty(form_error("rep_last_name")))
                        {
                        $count = 1;
                      ?>
                      <div class="row alert alert-danger">
                          <strong>REQUIRED** : </strong> Last name is Required
                    </div>
                      <?php
                        }
                        if(!empty(form_error("rep_designation")))
                        {
                        $count = 1;
                      ?>
                      <div class="row alert alert-danger">
                          <strong>REQUIRED** : </strong> Designation is Required
                    </div>
                      <?php
                        }
                        if(!empty(form_error("rep_employee_id")))
                        {
                        $count = 1;
                      ?>
                      <div class="row alert alert-danger">
                          <strong>REQUIRED** : </strong> Employee id is Required
                    </div>
                      <?php
                        }
                        if(!empty(form_error("rep_email_id")))
                        {
                        $count = 1;
                      ?>
                      <div class="row alert alert-danger">
                          <strong>REQUIRED** : </strong> Email Id is Required
                    </div>
                      <?php
                        }
                         if(!empty(form_error("rep_phone_number")))
                        {
                        $count = 1;
                      ?>
                      <div class="row alert alert-danger">
                          <strong>REQUIRED** : </strong> phone number is Required
                    </div>
                      <?php
                        }
                         if(!empty(form_error("rep_address1")))
                      {
                        $count = 1;
                    ?>
                    <div class="row alert alert-danger">
                          <strong>REQUIRED** : </strong> Representative Address1 is Required
                    </div>
                    <?php
                      }
                      if(!empty(form_error("rep_address2")))
                      {
                        $count = 1;
                    ?>
                      <div class="row alert alert-danger">
                          <strong>REQUIRED** : </strong> Representative Address2  is Required
                    </div>

                      <?php
                    }
                    if(!empty(form_error("rep_address3")))
                      {
                        $count = 1;
                      ?>
                      <div class="row alert alert-danger">
                          <strong>REQUIRED** : </strong> Representative Address3 is Required
                    </div>
                    <?php
                  }
                  if(!empty(form_error("rep_city")))
                      {
                        $count = 1;
                      ?>
                      <div class="row alert alert-danger">
                          <strong>REQUIRED** : </strong> Representative city is Required
                    </div>
                    <?php
                  }
                    if(!empty(form_error("rep_state")))
                      {
                        $count = 1;
                    ?>
                    <div class="row alert alert-danger">
                          <strong>REQUIRED** : </strong> Representative State is Required
                    </div>
                    <?php
                  }

                  if(!empty(form_error("rep_zipcode")))
                      {
                        $count = 1;
                    ?>
                    <div class="row alert alert-danger">
                          <strong>REQUIRED** : </strong> Representative City is Required
                    </div>
                      <?php 
                    }
                    if ($count == 1)
                        {
                        ?>
                        <script>
                          $(document).ready(function(){
                              $("#CategoryTwo").addClass("show");
                          });
                        </script>
                        <?php
                        }
                      ?>
        </div>
    
   

     <div class="row card-body">
          <div class="col-md-6 col-sm-3" align="left">
             <input type="submit" name="update" id="submit" value="Update" class="btn btn-outline-success">
            <!--<button type="submit" class="btn btn-outline-success"> Submit </button>-->
          </div>
          
        </div><br/><br/>
    </form>  
<br>

</section>
<?php
}
}
}
?>