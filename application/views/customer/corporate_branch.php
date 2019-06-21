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
if(!isset($branch_data_id))
{
?>
<div class="col-sm-6 col-md-9">
    <div class="row">
    	<div class="col-md-6" align="left">
    		<p class="h3"> Branch Company </p>
    	</div>
    	<div class="col-md-3" align="right">
    		<a class="btn btn-sm btn-primary" href="<?php echo base_url()."superadmin/manage_corporate_branch"; ?>"> Manage </a>
    	</div>
    	<div class="col-md-3" align="right">
    		<a class="btn btn-sm btn-outline-danger" href="<?php echo base_url()."superadmin/home"; ?>"> Back</a>
    	</div>
    </div>
    <br>

    <form method="post" action="<?php echo base_url()."superadmin/corporate_branch_data" ?>" enctype="multipart/form-data" id="form1">
    <div class="row container">
  <div class="container" id="accordion1">
    <div class="card">
      <div class="card-header">
        <a class="collapsed card-link" data-toggle="collapse" href="#CategoryTwo">
        Branch Details
      </a>
      </div>
      <div id="CategoryTwo" class="collapse show" data-parent="#accordion1">
        <div class="row">
            <div class="col-md-4 card-body">
                
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
            <div class="col-md-4 card-body">
                
            <input type="text" class="form-control" name="branch_name" placeholder="Branch Name">
           
            </div>
            <div class="col-md-4 card-body">
                
            <input type="text" class="form-control" name="branch_telephone" placeholder=" Branch Telephone"> 
                
            </div>
             
              
          </div>
       <div class="row">
          
            <div class="col-md-4 card-body">
                
             <input type="text" class="form-control" name="branch_address1" placeholder="address1"><br/>
           <input type="text" class="form-control" name="branch_address2" placeholder="address2"><br/>
             <input type="text" class="form-control" name="branch_address3" placeholder="address3"><br/>
                
              </div>
              <div class="col-md-4 card-body">
                
             <input type="text" class="form-control" name="branch_city" placeholder="City">  <br/>
             
                
              <input type="text" class="form-control" name="branch_zipcode" placeholder="zipcode">
                 
              
              </div>
              <div class="col-md-4 card-body">
                
              <input type="text" class="form-control" name="branch_state" placeholder="State"><br/>
              <input type="text" class="form-control" name="branch_gstn" placeholder="GSTN">
                
              </div>
              
              
          </div>

     
      
      
                  <div class="card-body">
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
    </div>
</form>
</div>

<?php
}
else{
  if($branch_data_id->num_rows() > 0)
  {
    foreach ($branch_data_id->result() as $row)
    {
?>
<div class="col-sm-6 col-md-9">
    <div class="row">
      <div class="col-md-6" align="left">
        <p class="h3"> Corporate Branch </p>
      </div>
      <div class="col-md-3" align="right">
        <a class="btn btn-sm btn-primary" href="<?php echo base_url()."superadmin/manage_branch"; ?>"> Manage </a>
      </div>
      <div class="col-md-3" align="right">
        <a class="btn btn-sm btn-outline-danger" href="<?php echo base_url()."superadmin/home"; ?>"> Back</a>
      </div>
    </div>
    <br>

    <form method="post" action="<?php echo base_url()."superadmin/edit_branch_data" ?>" enctype="multipart/form-data" id="form1">
    <div class="row container">
  <div class="container" id="accordion1">

       <div class="card">
      <div class="card-header">
        <a class="collapsed card-link" data-toggle="collapse" href="#CategoryTwo">
        Branch Details
      </a>
      </div>
      <div id="CategoryTwo" class="collapse show" data-parent="#accordion1">
        <div class="row">
            <div class="col-md-4 card-body">
                
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
            <div class="col-md-4 card-body">
            <input type="hidden" class="form-control" name="bhidden_id" value="<?php echo $row->id; ?>">    
            <input type="text" class="form-control" name="branch_name" placeholder="Branch Name" value="<?php echo $row->branch_name; ?>">
           
            </div>
            <div class="col-md-4 card-body">
                
            <input type="text" class="form-control" name="branch_telephone" placeholder=" Branch Telephone" value="<?php echo $row->branch_telephone; ?>"> 
                
            </div>
             
              
          </div>
       <div class="row">
          
            <div class="col-md-4 card-body">
                
             <input type="text" class="form-control" name="branch_address1" placeholder="address1" value="<?php echo $row->branch_address1; ?>"><br/>
           <input type="text" class="form-control" name="branch_address2" placeholder="address2" value="<?php echo $row->branch_address2; ?>"><br/>
             <input type="text" class="form-control" name="branch_address3" placeholder="address3" value="<?php echo $row->branch_address3; ?>"><br/>
                
              </div>
              <div class="col-md-4 card-body">
                
             <input type="text" class="form-control" name="branch_city" placeholder="City" value="<?php echo $row->branch_city; ?>">  <br/>
             
                
              <input type="text" class="form-control" name="branch_zipcode" placeholder="zipcode" value="<?php echo $row->branch_zipcode; ?>">
                 
              
              </div>
              <div class="col-md-4 card-body">
                
              <input type="text" class="form-control" name="branch_state" placeholder="State" value="<?php echo $row->branch_state; ?>"><br/>
              <input type="text" class="form-control" name="branch_gstn" placeholder="GSTN" value="<?php echo $row->branch_gstn; ?>">
                
              </div>
              
              
          </div>

     
      
      
                  <div class="card-body">
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
             <input type="submit" name="update" id="submit" value="Update" class="btn btn-outline-success">
            <!--<button type="submit" class="btn btn-outline-success"> Submit </button>-->
          </div>
          <div class="col-md-6 col-sm-3" align="left">
           <a href="<?php echo base_url()."superadmin/manage_corporate" ?>" class="btn btn-outline-danger"> back </a>
          </div>
        </div>
      </div>
    </div>
  
  </div>
    </div>
</form>
</div>



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


