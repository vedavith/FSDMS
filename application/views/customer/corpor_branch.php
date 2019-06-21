<br><br><br><br><br>
<?php 
if(!isset($branch_data_id))
{
  
?>
<section>
    <div class = "container">
        <div class="row">
      <div class="col-md-6" align="left">
        <p class="h3"> Branch Company </p>
      </div>
      <div class="col-md-3" align="right">
        <a class="btn btn-sm btn-primary" href="<?php echo base_url()."home/manage_branch"; ?>"> Manage </a>
      </div>
      <div class="col-md-3" align="right">
        <a class="btn btn-sm btn-outline-danger" href="<?php echo base_url()."superadmin/home"; ?>"> Back</a>
      </div>
    </div>
    <br>
      <form method="post" action="<?php echo base_url()."home/corpor_branch_data" ?>">
        <div class="row">
          <div class="col-md-4">
           <select class="form-control" name="company_name">
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
          <input type="text" class="form-control" name="branch_name" placeholder="Branch Name">
        </div>
        <div class="col-md-4">
           <input type="text" class="form-control" name="branch_telephone" placeholder=" Branch Telephone"> 
        </div>
      </div>
      <br/>
     <div class="row">
        <div class="col-md-4">
           <input type="text" class="form-control" name="branch_address1" placeholder="address1"><br/>
             <input type="text" class="form-control" name="branch_address2" placeholder="address2"><br/>
               <input type="text" class="form-control" name="branch_address3" placeholder="address3"><br/>
        </div>
        <div class="col-md-4">
            <input type="text" class="form-control" name="branch_city" placeholder="City">  <br/>
            <input type="text" class="form-control" name="branch_zipcode" placeholder="zipcode">
        </div>
        <div class="col-md-4">
          <input type="text" class="form-control" name="branch_state" placeholder="State"><br/>
          <input type="text" class="form-control" name="branch_gstn" placeholder="GSTN">
        </div>
    </div>  
    <div class="row container">
      <button name="update_corporate" type="submit" class="btn btn-outline-danger" > Update </button>
    </div>
    </form>  
<br>
<div class="container">
        
          <?php
                    $count = 0;
                   

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
                      if(!empty(form_error("branch_telephone")))
                      {
                        $count = 1;
                    ?>
                      <div class="row alert alert-danger">
                          <strong>REQUIRED** : </strong> Branch telephone is Required
                    </div>

                      <?php
                    }
                    if(!empty(form_error("branch_gstn")))
                      {
                        $count = 1;
                      ?>
                      <div class="row alert alert-danger">
                          <strong>REQUIRED** : </strong> Branch GSTN is Required
                    </div>
                    <?php
                  }
                  if(!empty(form_error("branch_address1")))
                      {
                        $count = 1;
                      ?>
                      <div class="row alert alert-danger">
                          <strong>REQUIRED** : </strong> Branch Address1 is Required
                    </div>
                    <?php
                  }
                   if(!empty(form_error("branch_address2")))
                      {
                        $count = 1;
                      ?>
                      <div class="row alert alert-danger">
                          <strong>REQUIRED** : </strong> Branch Address2 is Required
                    </div>
                    <?php
                  }
                   if(!empty(form_error("branch_address3")))
                      {
                        $count = 1;
                      ?>
                      <div class="row alert alert-danger">
                          <strong>REQUIRED** : </strong> Branch Address3 is Required
                    </div>
                    <?php
                  }
                    if(!empty(form_error("branch_state")))
                      {
                        $count = 1;
                    ?>
                    <div class="row alert alert-danger">
                          <strong>REQUIRED** : </strong> Branch State is Required
                    </div>
                    <?php
                  }

                  if(!empty(form_error("branch_city")))
                      {
                        $count = 1;
                    ?>
                    <div class="row alert alert-danger">
                          <strong>REQUIRED** : </strong> Branch City is Required
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
        </div><br><br><br>
    </div>
    <div class="container">
      <?php
    if(isset($error))
    {
      if($error == "BRN")
      {
    ?>
    <br>
    <div class="container-fluid">
      <div class="alert alert-danger">
          <strong> ERROR(<?php echo $error; ?>) : </strong> Branch Details Already Exists
      </div>
    </div>
    <?php
      }
    }
    ?>
    </div>
</section>

<?php 
  
}
else
{
  if($branch_data_id->num_rows() > 0)
  {
    foreach ($branch_data_id->result() as $row)
    {
  ?>
  <section>
    <div class = "container">
        <div class="row">
      <div class="col-md-6" align="left">
        <p class="h3"> Branch Company </p>
      </div>
      <div class="col-md-3" align="right">
        <a class="btn btn-sm btn-primary" href="<?php echo base_url()."home/manage_branch"; ?>"> Manage </a>
      </div>
      <div class="col-md-3" align="right">
        <a class="btn btn-sm btn-outline-danger" href="<?php echo base_url()."superadmin/home"; ?>"> Back</a>
      </div>
    </div>
    <br>
      <form method="post" action="<?php echo base_url().'home/edit_branch_data' ?>">
        <div class="row">
          <div class="col-md-4">
            <select class="form-control" name="company_name">
                <option value="">select company name</option>
                <?php 
                foreach($company_data->result() as $row2)
                {
                  ?>

                  <option value="<?php echo $row2->id; ?>" <?php if($row2->id == $row->company_name) echo 'selected="selected"';?>> <?php echo $row2->company_name; ?> </option>
                  <?php
                }
                ?>
              
              </select>
        </div>
        <div class="col-md-4">
          <input type="hidden" class="form-control" name="bhidden_id" value="<?php echo $row->id; ?>">    
            <input type="text" class="form-control" name="branch_name" placeholder="Branch Name" value="<?php echo $row->branch_name; ?>">
        </div>
        <div class="col-md-4">
          <input type="text" class="form-control" name="branch_telephone" placeholder=" Branch Telephone" value="<?php echo $row->branch_telephone; ?>"> 
        </div>
      </div>
      <br/>
     <div class="row">
        <div class="col-md-4">
           <input type="text" class="form-control" name="branch_address1" placeholder="address1" value="<?php echo $row->branch_address1; ?>"><br/>
           <input type="text" class="form-control" name="branch_address2" placeholder="address2" value="<?php echo $row->branch_address2; ?>"><br/>
             <input type="text" class="form-control" name="branch_address3" placeholder="address3" value="<?php echo $row->branch_address3; ?>"><br/>
        </div>
        <div class="col-md-4">
             <input type="text" class="form-control" name="branch_city" placeholder="City" value="<?php echo $row->branch_city; ?>">  <br/>
             <input type="text" class="form-control" name="branch_zipcode" placeholder="zipcode" value="<?php echo $row->branch_zipcode; ?>">
        </div>
        <div class="col-md-4">
          <input type="text" class="form-control" name="branch_state" placeholder="State" value="<?php echo $row->branch_state; ?>"><br/>
          <input type="text" class="form-control" name="branch_gstn" placeholder="GSTN" value="<?php echo $row->branch_gstn; ?>">
        </div>
    </div>  
    <div class="row container">
      <!--<button name="update_corporate" type="submit" class="btn btn-outline-danger" > Update </button>-->
       <input type="submit" name="update" id="submit" value="Update" class="btn btn-outline-success">
    </div>
    </form>  
<br>
<div class="container">
        
          <?php
                    $count = 0;
                   

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
                      if(!empty(form_error("branch_telephone")))
                      {
                        $count = 1;
                    ?>
                      <div class="row alert alert-danger">
                          <strong>REQUIRED** : </strong> Branch telephone is Required
                    </div>

                      <?php
                    }
                    if(!empty(form_error("branch_gstn")))
                      {
                        $count = 1;
                      ?>
                      <div class="row alert alert-danger">
                          <strong>REQUIRED** : </strong> Branch GSTN is Required
                    </div>
                    <?php
                  }
                  if(!empty(form_error("branch_address1")))
                      {
                        $count = 1;
                      ?>
                      <div class="row alert alert-danger">
                          <strong>REQUIRED** : </strong> Branch Address1 is Required
                    </div>
                    <?php
                  }
                   if(!empty(form_error("branch_address2")))
                      {
                        $count = 1;
                      ?>
                      <div class="row alert alert-danger">
                          <strong>REQUIRED** : </strong> Branch Address2 is Required
                    </div>
                    <?php
                  }
                   if(!empty(form_error("branch_address3")))
                      {
                        $count = 1;
                      ?>
                      <div class="row alert alert-danger">
                          <strong>REQUIRED** : </strong> Branch Address3 is Required
                    </div>
                    <?php
                  }
                    if(!empty(form_error("branch_state")))
                      {
                        $count = 1;
                    ?>
                    <div class="row alert alert-danger">
                          <strong>REQUIRED** : </strong> Branch State is Required
                    </div>
                    <?php
                  }

                  if(!empty(form_error("branch_city")))
                      {
                        $count = 1;
                    ?>
                    <div class="row alert alert-danger">
                          <strong>REQUIRED** : </strong> Branch City is Required
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
        </div><br><br><br>
    </div>
   
</section>
<?php
}
}
}
?>