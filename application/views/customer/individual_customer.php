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

function isNumber(evt) {
evt = (evt) ? evt : window.event;
var charCode = (evt.which) ? evt.which : evt.keyCode;
if (charCode > 31 && (charCode < 48 || charCode > 57)) {
return false;
}
return true;
}


  </script>
<?php
if(!isset($indiv_data_id))
{
?>
<div class="col-sm-6 col-md-9">
    <div class="row">
    	<div class="col-md-6" align="left">
    		<p class="h3"> Individual Customer </p>
    	</div>
    	<div class="col-md-3" align="right">
    		<a class="btn btn-sm btn-primary" href="<?php echo base_url()."superadmin/manage_individual"; ?>"> Manage </a>
    	</div>
    	<div class="col-md-3" align="right">
    		<a class="btn btn-sm btn-outline-danger" href="<?php echo base_url()."superadmin/home"; ?>"> Back</a>
    	</div>
    </div>
    <br>

    <form method="post" action="<?php echo base_url()."superadmin/individual_customer_data" ?>" enctype="multipart/form-data" id="form1">
    <div class="row container">
  <div class="container" id="accordion1">
    <div class="card">
      <div class="card-header">
        <a class="card-link" data-toggle="collapse" href="#CategoryOne">
         Customer Name
        </a>
      </div>
      <div id="CategoryOne" class="collapse show" data-parent="#accordion1">
      	<div class="row">
      				
      			<div class="col-md-4 card-body">
      				
						<select class="form-control" name="title">
							<option value="Mr" > Mr </option>
							<option value="Ms" > Ms </option>
							<option value="Dr" > Dr </option>
						</select>
					
				</div>
				
      				<div class="col-md-4 card-body">
        				
				        <input type="text" name="first_name" class="form-control" placeholder="First Name">
        				
        			</div>
        			<div class="col-md-4 card-body">
      				
						<input type="text" name="middle_name" class="form-control" placeholder="Middle Name">
					
				</div>
        	</div>
        	<div class="row">
      		
      			<div class="col-md-4 card-body">
        				
				        <input type="text" name="last_name" class="form-control" placeholder="Last Name">
        				
        			</div>
        			<div class="col-md-4 card-body">
        				
				       <input type="text" class="form-control" name="email_id" placeholder="Email">
        				
        			</div>
        			<div class="col-md-4 card-body">
        				
				       <input type="text" class="form-control" name="phone_number" placeholder="Phone Number" onkeypress="return isNumber(event)">
        				
        			</div>
        	</div>
        	<div class="row">
      		     <input type="hidden" class="form-control" name="user_password" id="user_password" placeholder="Password"  value="<?php echo mt_rand(00000000,99999999)?>">
      			 
        			<!--<div class="col-md-4 card-body">
        				
				       	<input type="password" class="form-control" name="confirm_user_passsword" id="user_confirm_password" placeholder="Confirm Password">
        				<div id="message"></div>
        			</div>-->
        			<div class="col-md-4 card-body">
        				
				      <input type="date" class="form-control" name="dob" placeholder="Date of Birth">
        				
        			</div>
                <div class="col-md-4 card-body">
                
               <input type="text" class="form-control" name="blood_group" placeholder="Blood Group">
                
              </div>
              <div class="col-md-4 card-body">
                
               <select class="form-control" name="meal_type">
              <option>Select Meal Type</option>
              <option value="Veg" > Veg</option>
              <option value="non_veg" > Non-Veg</option>
              <option value="jain_meal" > Jain Meal</option>
            </select>
                
              </div>
        	</div>
			<div class="row">
      		
      		
        			
        	</div>
        	
        	<div class="row">
      		
      			<div class="col-md-4 card-body">
        				
				     <input type="text" class="form-control" name="address[]" placeholder="address1"><br/>
				     <input type="text" class="form-control" name="address[]" placeholder="address2"><br/>
				     <input type="text" class="form-control" name="address[]" placeholder="address3"><br/>
        				
        			</div>
        			<div class="col-md-4 card-body">
        				
				     <input type="text" class="form-control" name="city" placeholder="City">  
        				
        			</div>
        			<div class="col-md-4 card-body">
        				
				      <input type="text" class="form-control" name="state" placeholder="State">
        				
        			</div>
        			
        	</div>
            
        	
		<div class="card-body">
      	<?php
			     $count =0;
            if(!empty(form_error("first_name")))
            {
              $count =1;
          ?>
          <div class="alert alert-danger">
                <strong>REQUIRED** : </strong> First Name is Required 
          </div>
          <?php       
            }else{ echo "";}
          ?>
          <?php
            if(!empty(form_error("middle_name")))
            {
              $count =1;
          ?>
          <div class="alert alert-danger">
                <strong>REQUIRED** : </strong> Middle Name is Required 
          </div>
          <?php       
            }
          ?>
          <?php
            if(!empty(form_error("last_name")))
            {
              $count =1;
          ?>
          <div class="alert alert-danger">
                <strong>REQUIRED** : </strong> Last Name is Required 
          </div>
          <?php       
            }
          ?>
          <?php
            if(!empty(form_error("email_id")))
            {
              $count =1;
          ?>
          <div class="alert alert-danger">
                <strong>REQUIRED** : </strong> Email Id is Required 
          </div>
          <?php       
            }
          ?>
          <?php
          //  if(!empty(form_error("user_password")))
           // {
           //   $count =1;
          ?>
         <!-- <div class="alert alert-danger">
                <strong>REQUIRED** : </strong> Password is Required 
          </div>-->
          <?php       
           // }
          ?>
          <?php
            if(!empty(form_error("phone_number")))
            {
              $count =1;
          ?>
          <div class="alert alert-danger">
                <strong>REQUIRED** : </strong> Phone Number is Required 
          </div>
          <?php       
            }
          ?>
          <?php
            if(!empty(form_error("dob")))
            {
              $count =1;
          ?>
          <div class="alert alert-danger">
                <strong>REQUIRED** : </strong> Date Of Birth is Required 
          </div>
          <?php       
            }
          ?>
          <?php
            if(!empty(form_error("blood_group")))
            {
              $count =1;
          ?>
          <div class="alert alert-danger">
                <strong>REQUIRED** : </strong> Blood Group is Required 
          </div>
          <?php       
            }
          ?>
          <?php
            if(!empty(form_error("meal_type")))
            {
              $count =1;
          ?>
          <div class="alert alert-danger">
                <strong>REQUIRED** : </strong> Meal Type is Required 
          </div>
          <?php       
            }
          ?>
          <?php
            if(!empty(form_error("address[]")))
            {
              $count =1;
          ?>
          <div class="alert alert-danger">
                <strong>REQUIRED** : </strong>Address is Required 
          </div>
          <?php       
            }
          ?>
          
          
          <?php
            if(!empty(form_error("city")))
            {
              $count =1;
          ?>
          <div class="alert alert-danger">
                <strong>REQUIRED** : </strong>City is Required 
          </div>
          <?php       
            }
          ?>
            <?php
            if(!empty(form_error("state")))
            {
              $count =1;
          ?>
          <div class="alert alert-danger">
                <strong>REQUIRED** : </strong>State is Required 
          </div>
          <?php       
            }
          ?>
          <?php
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
			if($error == "ICD")
			{
		?>
		<br>
		<div class="container-fluid">
			<div class="alert alert-danger">
					<strong> ERROR(<?php echo $error; ?>) : </strong> Individual Customer Details Already Exists
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

else{
  if($indiv_data_id->num_rows() > 0)
  {
    foreach ($indiv_data_id->result() as $row)
    {
      
?>
<div class="col-sm-6 col-md-9">
    <div class="row">
      <div class="col-md-6" align="left">
        <p class="h3"> Individual Customer </p>
      </div>
      <div class="col-md-3" align="right">
        <a class="btn btn-sm btn-primary" href="<?php echo base_url()."superadmin/manage_individual"; ?>"> Manage </a>
      </div>
      <div class="col-md-3" align="right">
        <a class="btn btn-sm btn-outline-danger" href="<?php echo base_url()."superadmin/individual_customer"; ?>"> Back</a>
      </div>
    </div>
    <br>

    <form method="post" action="<?php echo base_url()."superadmin/edit_individual_data" ?>" enctype="multipart/form-data" id="form1">
    <div class="row container">
  <div class="container" id="accordion1">
    <div class="card">
      <div class="card-header">
        <a class="card-link" data-toggle="collapse" href="#CategoryOne">
         Customer Name
        </a>
      </div>
      <div id="CategoryOne" class="collapse show" data-parent="#accordion1">
        <div class="row">
              
            <div class="col-md-4 card-body">
              <input type="hidden" name="hidden_id" value="<?php echo $row->id;?>">
            <select class="form-control" name="title">
              <option value="Mr" <?php if($row->user_title == "Mr") echo 'selected ="selected"' ?> > Mr </option>
              <option value="Ms" <?php if($row->user_title == "Ms") echo 'selected ="selected"' ?> > Ms </option>
              <option value="Dr" <?php if($row->user_title == "Dr") echo 'selected ="selected"' ?>> Dr </option>
            </select>
          
        </div>
        
              <div class="col-md-4 card-body">
                
                <input type="text" name="first_name" class="form-control" placeholder="First Name" value="<?php echo $row->first_name;?>">
                
              </div>
              <div class="col-md-4 card-body">
              
            <input type="text" name="middle_name" class="form-control" placeholder="Middle Name" value="<?php echo $row->middle_name;?>" >
          
        </div>
          </div>
          <div class="row">
          
            <div class="col-md-4 card-body">
                
                <input type="text" name="last_name" class="form-control" placeholder="Last Name" value="<?php echo $row->last_name;?>" >
                
              </div>
              <div class="col-md-4 card-body">
                
               <input type="text" class="form-control" name="email_id" placeholder="Email" value="<?php echo $row->email;?>" Readonly >
                
              </div>
              <div class="col-md-4 card-body">
                
               <input type="text" class="form-control" name="phone_number" placeholder="Phone Number" value="<?php echo $row->phone_number;?>" >
                
              </div>
          </div>
          <div class="row">
             <input type="hidden" class="form-control" name="user_password" id="user_password" placeholder="Password" value="" >
                
             
              
              <div class="col-md-4 card-body">
                
               <input type="date" class="form-control" name="dob" placeholder="Date of Birth" value="<?php echo $row->dob;?>" >
                
              </div>
              <div class="col-md-4 card-body">
                
               <input type="text" class="form-control" name="blood_group" placeholder="Blood Group"  value="<?php echo $row->blood_group;?>">
                
              </div>
              <div class="col-md-4 card-body">
                
               <select class="form-control" name="meal_type">
              <option>Select Meal Type</option>
              <option value="Veg" <?php if($row->meal_type == "Veg") echo 'selected ="selected"' ?>> Veg</option>
              <option value="non_veg"  <?php if($row->meal_type == "non_veg") echo 'selected ="selected"' ?> > Non-Veg</option>
              <option value="jain_meal" <?php if($row->meal_type == "jain_meal") echo 'selected ="selected"' ?> > Jain Meal</option>
            </select>
                
              </div>
          </div>
     
          
          <div class="row">
          
            <div class="col-md-4 card-body">
               <?php
               $addr =explode(",",$row->address);
               $count =count($addr);
               for($i=0;$i<=$count; $i++)
               {
                $addr1=$addr[0];
                $addr2=$addr[1];
                $addr3=$addr[2];
                }
               //echo $addr1;
              
                ?> 
             <input type="text" class="form-control" name="address[]" placeholder="address1" value="<?php echo $addr1;?>"><br/>
             <input type="text" class="form-control" name="address[]" placeholder="address2" value="<?php  if(!empty($addr2)) { echo $addr2;}?>"><br/>
             <input type="text" class="form-control" name="address[]" placeholder="address3" value="<?php if(!empty($addr3)) { echo $addr3;}?>" ><br/>

              </div>
              <div class="col-md-4 card-body">
                
             <input type="text" class="form-control" name="city" placeholder="City" value="<?php echo $row->city;?>">  
                
              </div>
              <div class="col-md-4 card-body">
                
              <input type="text" class="form-control" name="state" placeholder="State" value="<?php echo $row->state;?>">
                
              </div>
              
          </div>

          
    <div class="card-body">
        <?php
           $count =0;
            if(!empty(form_error("first_name")))
            {
              $count =1;
          ?>
          <div class="alert alert-danger">
                <strong>REQUIRED** : </strong> First Name is Required 
          </div>
          <?php       
            }else{ echo "";}
          ?>
          <?php
            if(!empty(form_error("middle_name")))
            {
              $count =1;
          ?>
          <div class="alert alert-danger">
                <strong>REQUIRED** : </strong> Middle Name is Required 
          </div>
          <?php       
            }
          ?>
          <?php
            if(!empty(form_error("last_name")))
            {
              $count =1;
          ?>
          <div class="alert alert-danger">
                <strong>REQUIRED** : </strong> Last Name is Required 
          </div>
          <?php       
            }
          ?>
          <?php
            if(!empty(form_error("email_id")))
            {
              $count =1;
          ?>
          <div class="alert alert-danger">
                <strong>REQUIRED** : </strong> Email Id is Required 
          </div>
          <?php       
            }
          ?>
         
          <?php
            if(!empty(form_error("phone_number")))
            {
              $count =1;
          ?>
          <div class="alert alert-danger">
                <strong>REQUIRED** : </strong> Phone Number is Required 
          </div>
          <?php       
            }
          ?>
          <?php
            if(!empty(form_error("dob")))
            {
              $count =1;
          ?>
          <div class="alert alert-danger">
                <strong>REQUIRED** : </strong> Date Of Birth is Required 
          </div>
          <?php       
            }
          ?>
          <?php
            if(!empty(form_error("blood_group")))
            {
              $count =1;
          ?>
          <div class="alert alert-danger">
                <strong>REQUIRED** : </strong> Blood Group is Required 
          </div>
          <?php       
            }
          ?>
          <?php
            if(!empty(form_error("meal_type")))
            {
              $count =1;
          ?>
          <div class="alert alert-danger">
                <strong>REQUIRED** : </strong> Meal Type is Required 
          </div>
          <?php       
            }
          ?>
          <?php
            if(!empty(form_error("address")))
            {
              $count =1;
          ?>
          <div class="alert alert-danger">
                <strong>REQUIRED** : </strong>Address is Required 
          </div>
          <?php       
            }
          ?>
           
           
          <?php
            if(!empty(form_error("city")))
            {
              $count =1;
          ?>
          <div class="alert alert-danger">
                <strong>REQUIRED** : </strong>City is Required 
          </div>
          <?php       
            }
          ?>
            <?php
            if(!empty(form_error("state")))
            {
              $count =1;
          ?>
          <div class="alert alert-danger">
                <strong>REQUIRED** : </strong>State is Required 
          </div>
          <?php       
            }
          ?>
          <?php
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
             <a href="<?php echo base_url()."superadmin/manage_individual" ?>" class="btn btn-outline-danger"> Back </a>
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

<script>
    $('#user_password, #user_confirm_password').on('keyup', function ()
     {
         if ($('#user_password').val() == $('#user_confirm_password').val())
          {
             $('#message').html('Matching').css('color', 'green');
              $('#user_confirm_password').css('background', '#55d24980');
              $("#submit_id").prop("disabled", false);
          }
          else
          {
             $('#message').html('Not Matching').css('color', 'red');
           $('#user_confirm_password').css('background', '#ff8787a1');
             $("#submit_id").prop("disabled", true);
           }
     });
</script>

<!-- Dont Remove this closed div tag -->
    <!-- Side row closed -->
    </div>
    <!-- sidebar container fluid closed -->
</div>


<br><br><br><br><br>


