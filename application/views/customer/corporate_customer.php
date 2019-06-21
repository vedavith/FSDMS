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
if(!isset($corporate_data_id))
{
?>
<div class="col-sm-6 col-md-9">
    <div class="row">
    	<div class="col-md-6" align="left">
    		<p class="h3"> Corporate Company </p>
    	</div>
    	<div class="col-md-3" align="right">
    		<a class="btn btn-sm btn-primary" href="<?php echo base_url()."superadmin/manage_corporate"; ?>"> Manage </a>
    	</div>
    	<div class="col-md-3" align="right">
    		<a class="btn btn-sm btn-outline-danger" href="<?php echo base_url()."superadmin/home"; ?>"> Back</a>
    	</div>
    </div>
    <br>

    <form method="post" action="<?php echo base_url()."superadmin/corporate_customer_data" ?>" enctype="multipart/form-data" id="form1">
    <div class="row container">
  <div class="container" id="accordion1">
    <div class="card">
      <div class="card-header">
        <a class="collapsed card-link" data-toggle="collapse" href="#CategoryTwo">
        Company Details
      </a>
      </div>
      <div id="CategoryTwo" class="collapse" data-parent="#accordion1">
        <div class="row">
          
            <div class="col-md-4 card-body">
                
            <input type="text" class="form-control" name="company_name" placeholder="Company Name">
           
              </div>
              <div class="col-md-4 card-body">
                
            <input type="text" class="form-control" name="company_telephone" placeholder=" Company Telephone"> 
                
              </div>
              <div class="col-md-4 card-body">
                
             <input type="text" class="form-control" name="company_gstn" placeholder="GSTN">
                
              </div>
              
          </div>
       <div class="row">
          
            <div class="col-md-4 card-body">
                
             <input type="text" class="form-control" name="company_address[]" placeholder="address1"><br/>
           <input type="text" class="form-control" name="company_address[]" placeholder="address2"><br/>
             <input type="text" class="form-control" name="company_address[]" placeholder="address3"><br/>
                
              </div>
              <div class="col-md-4 card-body">
                
             <input type="text" class="form-control" name="company_city" placeholder="City">  
                
              </div>
              <div class="col-md-4 card-body">
                
              <input type="text" class="form-control" name="company_state" placeholder="State">
                
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
                      if(!empty(form_error("company_telephone")))
                      {
                        $count = 1;
                    ?>
                      <div class="row alert alert-danger">
                          <strong>REQUIRED** : </strong> Company telephone is Required
                    </div>

                      <?php
                    }
                    if(!empty(form_error("company_gstn")))
                      {
                        $count = 1;
                      ?>
                      <div class="row alert alert-danger">
                          <strong>REQUIRED** : </strong> Company GSTN is Required
                    </div>
                    <?php
                  }
                  if(!empty(form_error("company_address[]")))
                      {
                        $count = 1;
                      ?>
                      <div class="row alert alert-danger">
                          <strong>REQUIRED** : </strong> Company Address is Required
                    </div>
                    <?php
                  }
                    if(!empty(form_error("company_state")))
                      {
                        $count = 1;
                    ?>
                    <div class="row alert alert-danger">
                          <strong>REQUIRED** : </strong> Company State is Required
                    </div>
                    <?php
                  }

                  if(!empty(form_error("company_city")))
                      {
                        $count = 1;
                    ?>
                    <div class="row alert alert-danger">
                          <strong>REQUIRED** : </strong> Company City is Required
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
        <a class="card-link" data-toggle="collapse" href="#CategoryOne">
         Admin Details
        </a>
      </div>
      <div id="CategoryOne" class="collapse show" data-parent="#accordion1">
      	<div class="row">
      				
      			<div class="col-md-4 card-body">
      				
						<select class="form-control" name="company_title">
							<option value="Mr" > Mr </option>
							<option value="Ms" > Ms </option>
							<option value="Dr" > Dr </option>
						</select>
					
				</div>
				
      				<div class="col-md-4 card-body">
        				
				        <input type="text" name="rep_first_name" class="form-control" placeholder="First Name">
        				
        			</div>
        			<div class="col-md-4 card-body">
      				
						<input type="text" name="rep_middle_name" class="form-control" placeholder="Middle Name">
					
				</div>
        	</div>
        	<div class="row">
      		
      			<div class="col-md-4 card-body">
        				
				        <input type="text" name="rep_last_name" class="form-control" placeholder="Last Name">
        				
        			</div>
        			<div class="col-md-4 card-body">
        				
				       <input type="text" class="form-control" name="rep_email_id" placeholder="Email">
        				
        			</div>
        			<div class="col-md-4 card-body">
        				
				       <input type="text" class="form-control" name="rep_phone_number" placeholder="Phone Number">
        				
        			</div>
        	</div>
        	<div class="row">
      		
      			<div class="col-md-4 card-body">
        				 <input type="hidden" class="form-control" name="corporate_user_password" id="corporate_user_password" placeholder="Password" value="<?php echo mt_rand(10000000,99999999)?>">
				       
        				<input type="text" class="form-control" name="rep_designation" placeholder="Designation">
        			</div>
        			<div class="col-md-4 card-body">
        				
				       	<input type="text" class="form-control" name="rep_employee_id" placeholder="Employee ID">
        				
        			</div>
        		
        	</div>
		
        	
        

        	
		<div class="card-body">
      	<?php
			$count =0;
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
			if($error == "COM")
			{
		?>
		<br>
		<div class="container-fluid">
			<div class="alert alert-danger">
					<strong> ERROR(<?php echo $error; ?>) : </strong> Company Admin Details Already Exists
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
  if($corporate_data_id->num_rows() > 0)
  {
    foreach ($corporate_data_id->result() as $row)
    {
?>
<div class="col-sm-6 col-md-9">
    <div class="row">
      <div class="col-md-6" align="left">
        <p class="h3"> Corporate Company </p>
      </div>
      <div class="col-md-3" align="right">
        <a class="btn btn-sm btn-primary" href="<?php echo base_url()."superadmin/manage_corporate"; ?>"> Manage </a>
      </div>
      <div class="col-md-3" align="right">
        <a class="btn btn-sm btn-outline-danger" href="<?php echo base_url()."superadmin/home"; ?>"> Back</a>
      </div>
    </div>
    <br>

    <form method="post" action="<?php echo base_url()."superadmin/edit_corporate_data" ?>" enctype="multipart/form-data" id="form1">
    <div class="row container">
  <div class="container" id="accordion1">

        <div class="card">
      <div class="card-header">
        <a class="collapsed card-link" data-toggle="collapse" href="#CategoryTwo">
        Company Details
      </a>
      </div>
      <div id="CategoryTwo" class="collapse" data-parent="#accordion1">
        <div class="row">
          
            <div class="col-md-4 card-body">
          
            <input type="text" class="form-control" name="company_name" placeholder="Company Name" value="<?php echo $row->company_name;?>" readonly>
           
              </div>
              <div class="col-md-4 card-body">
                
            <input type="text" class="form-control" name="company_telephone" placeholder=" Company Telephone" value="<?php echo $row->company_telephone;?>"> 
                
              </div>
              <div class="col-md-4 card-body">
                
             <input type="text" class="form-control" name="company_gstn" placeholder="GSTN" value="<?php echo $row->company_gstn;?>" readonly>
                
              </div>
              
          </div>
       <div class="row">
          
            <div class="col-md-4 card-body">
                <?php
               $addr =explode(",",$row->company_address);
               $count =count($addr);
               for($i=0;$i<=$count; $i++)
               {
                $addr1=$addr[0];
                $addr2=$addr[1];
                $addr3=$addr[2];
                }
               //echo $addr1;
              
                ?>  
             <input type="text" class="form-control" name="company_address[]" placeholder="address1" value="<?php echo $addr1;?>"><br/>
            <input type="text" class="form-control" name="company_address[]" placeholder="address2" value="<?php echo $addr2;?>"><br/>
             <input type="text" class="form-control" name="company_address[]" placeholder="address3" value="<?php echo $addr3;?>"><br/>
                
              </div>
              <div class="col-md-4 card-body">
                
             <input type="text" class="form-control" name="company_city" placeholder="City" value="<?php echo $row->company_city;?>">  
                
              </div>
              <div class="col-md-4 card-body">
                
              <input type="text" class="form-control" name="company_state" placeholder="State" value="<?php echo $row->company_state;?>">
                
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
                      if(!empty(form_error("company_telephone")))
                      {
                        $count = 1;
                    ?>
                      <div class="row alert alert-danger">
                          <strong>REQUIRED** : </strong> Company telephone is Required
                    </div>

                      <?php
                    }
                    if(!empty(form_error("company_gstn")))
                      {
                        $count = 1;
                      ?>
                      <div class="row alert alert-danger">
                          <strong>REQUIRED** : </strong> Company GSTN is Required
                    </div>
                    <?php
                  }
                  if(!empty(form_error("company_address[]")))
                      {
                        $count = 1;
                      ?>
                      <div class="row alert alert-danger">
                          <strong>REQUIRED** : </strong> Company Address is Required
                    </div>
                    <?php
                  }
                    if(!empty(form_error("company_state")))
                      {
                        $count = 1;
                    ?>
                    <div class="row alert alert-danger">
                          <strong>REQUIRED** : </strong> Company State is Required
                    </div>
                    <?php
                  }

                  if(!empty(form_error("company_city")))
                      {
                        $count = 1;
                    ?>
                    <div class="row alert alert-danger">
                          <strong>REQUIRED** : </strong> Company City is Required
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
        <a class="card-link" data-toggle="collapse" href="#CategoryOne">
         Admin Details
        </a>
      </div>
      <div id="CategoryOne" class="collapse show" data-parent="#accordion1">
        <div class="row">
              
            <div class="col-md-4 card-body">
          <input type="hidden" name="hidden_id"  value="<?php echo $row->id;?>">
          <input type="hidden" name="uhidden_id" value="<?php echo $row->user_id;?> " >
          <input type="hidden" class="form-control" name="chidden_id"  value="<?php echo $row->com_id;?>">
          <input type="hidden" name="en_email" value="<?php echo $row->rep_email_id ?>">
            <select class="form-control" name="company_title">
              <option value="Mr"<?php if($row->user_title == "Mr") echo 'selected ="selected"' ?> > Mr </option>
              <option value="Ms" <?php if($row->user_title == "Ms") echo 'selected ="selected"' ?> > Ms </option>
              <option value="Dr"  <?php if($row->user_title == "Dr") echo 'selected ="selected"' ?>> Dr </option>
            </select>
          
        </div>
        
              <div class="col-md-4 card-body">
                
                <input type="text" name="rep_first_name" class="form-control" placeholder="First Name" value="<?php echo $row->first_name;?>">
                
              </div>
              <div class="col-md-4 card-body">
              
            <input type="text" name="rep_middle_name" class="form-control" placeholder="Middle Name" value="<?php echo $row->middle_name;?>">
          
        </div>
          </div>
          <div class="row">
          
            <div class="col-md-4 card-body">
                
                <input type="text" name="rep_last_name" class="form-control" placeholder="Last Name" value="<?php echo $row->last_name;?>" >
                
              </div>
              <div class="col-md-4 card-body">
                
               <input type="text" class="form-control" name="rep_email_id" placeholder="Email" value="<?php echo $row->rep_email_id;?>" readonly
               >
                
              </div>
              <div class="col-md-4 card-body">
                
               <input type="text" class="form-control" name="rep_phone_number" placeholder="Phone Number" value="<?php echo $row->rep_phone_number;?>">
                
              </div>
          </div>
          <div class="row">
          
            <div class="col-md-4 card-body">
                
               
                <input type="text" class="form-control" name="rep_designation" placeholder="Designation" value="<?php echo $row->rep_designation;?>">
              </div>
              <div class="col-md-4 card-body">
                
                <input type="text" class="form-control" name="rep_employee_id" placeholder="Employee ID" value="<?php echo $row->rep_employee_id;?>" readonly>
                
              </div>
            
          </div>
    
          
        

          
          
    <div class="card-body">
        <?php
      $count =0;
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


