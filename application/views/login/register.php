 <title>Register</title>
<br><br><br><br><br><br><br>
<section>
	<div class="container">
		<ul class="col-md-12 col-sm-12 nav nav-tabs" id="myTabs" role="tablist">
		    <li class="col-md-6 col-sm-6 nav-item">
		      <a class="indvidual nav-link" data-toggle="tab" href="#individual" style="text-align: center"><b> INDIVIDUAL USERS </b></a>
		    </li>
		    <li class="col-md-6 col-sm-6 nav-item">
		      <a class="corporate nav-link" data-toggle="tab" href="#corporate" style="text-align: center"> <b> CORPORATE USERS </b> </a>
		    </li>
		 </ul>
	</div>
 <!-- Tab panes -->
 	<div class="container">
		<div class="tab-content">
		    <div id="individual" class="tab-pane active"><br>
		    	<h3>INDIVIDUAL USER REGISTRATION</h3>
		    	<br>
		    	<form method="post" action="<?php echo base_url(); ?>login/user_register_validate">
				<div class="row">
					<div class="col-md-3">
						<select class="form-control" name="title">
							<option value="Mr" > Mr </option>
							<option value="Ms" > Ms </option>
							<option value="Dr" > Dr </option>
						</select>
					</div>
					<div class="col-md-3">
						<input type="text" name="first_name" class="form-control" placeholder="First Name">
					</div>
					<div class="col-md-3">
						<input type="text" name="middle_name" class="form-control" placeholder="Middle Name">
					</div>	
					<div class="col-md-3">
						<input type="text" name="last_name" class="form-control" placeholder="Last Name">
					</div>
				</div><br>
				<div class="row">
					<div class="col-md-3">
						<input type="text" class="form-control" name="email_id" placeholder="Email">
					</div>
					<div class="col-md-3">
						<input type="password" class="form-control" name="user_password" id="user_password" placeholder="Password">
					</div>
					<div class="col-md-3">
						<input type="password" class="form-control" name="confirm_user_passsword" id="user_confirm_password" placeholder="Confirm Password">
					</div>	
					<div class="col-md-3">
						<input type="text" class="form-control" name="phone_number" placeholder="Phone Number">
					</div>
				</div><br/>
				<div class="row">
					<div class="col-md-3">
						<input type="date" class="form-control" name="dob" placeholder="Date of Birth">
					</div>
					<div class="col-md-3">
						<input type="text" class="form-control" name="blood_group" placeholder="Blood Group">
					</div>
					<div class="col-md-3">
						<select class="form-control" name="meal_type">
							<option>Select Meal Type</option>
							<option value="Veg" > Veg</option>
							<option value="non_veg" > Non-Veg</option>
							<option value="jain_meal" > Jain Meal</option>
						</select>
					</div>
					<div class="col-md-3">
						<input type="text" class="form-control" name="address" placeholder="address">
					</div>
				</div></br>
				<div class="row">
					<div class="col-md-3">
						<input type="text" class="form-control" name="city" placeholder="City">
					</div>
					<div class="col-md-3">
						<input type="text" class="form-control" name="state" placeholder="State">
					</div>
					
				</div><br/>
				<script type="text/javascript">
				$('#user_password, #user_confirm_password').on('keyup', function () 
				{
  				 if ($('#user_password').val() == $('#user_confirm_password').val()) 
  				 {
   					$('#user_confirm_password').css('background', '#55d24980');
  				 } 
  				 else 
    				$('#user_confirm_password').css('background', '#ff8787a1');
				});
				</script>
<br>
				<div class="row container">
					<button name="submit_individual" type="submit" class="btn btn-outline-danger" > Submit </button>
				</div>
				</form>	 
				<br>
				<div class="container">
					<?php
						if(!empty(form_error("first_name")))
						{
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
					?>
					<div class="alert alert-danger">
  							<strong>REQUIRED** : </strong> Email Id is Required 
					</div>
					<?php				
						}
					?>
					<?php
						if(!empty(form_error("user_password")))
						{
					?>
					<div class="alert alert-danger">
  							<strong>REQUIRED** : </strong> Password is Required 
					</div>
					<?php				
						}
					?>
					<?php
						if(!empty(form_error("phone_number")))
						{
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
					?>
					<div class="alert alert-danger">
  							<strong>REQUIRED** : </strong>State is Required 
					</div>
					<?php				
						}
					?>
				</div><br><br><br> 	  
			</div>

			<div id="corporate" class="tab-pane fade"><br>
		    	<h3>CORPORATE USERS REGISTRATION</h3>
		      	<form method="post" id="corporate_details" action="<?php echo base_url(); ?>login/corporate_admin_register_validate">
		      		<div class="container row">
		      			<p class="h4"> Company Details </p>
		      		</div>
		      		<div class="row">
		      			<div class="col-md-4">
		      				<input type="text" class="form-control" name="company_name" placeholder="Company Name">
		      			</div>
		      			<div class="col-md-4">
		      				<input type="text" class="form-control" name="company_telephone" placeholder=" Company Telephone">
		      			</div>
		      			<div class="col-md-4">
		      				<input type="text" class="form-control" name="company_gstn" placeholder="GSTN">
		      			</div>
		      		</div><br>
		      		<div class="row">	
		      			<div class="col-md-4">
		      				<input type="text" class="form-control" name="company_address" placeholder="Address">
		      			</div>
		      			<div class="col-md-4">
		      				<input type="text" class="form-control" name="company_city" placeholder="City">
		      			</div>
		      			<div class="col-md-4">
		      				<input type="text" class="form-control" name="company_state" placeholder="State">
		      			</div>
		      		</div><br>
		      		<div class="container row">
		      			<p class="h4"> Company Admin Details </p>
		      		</div>
		      		<div class="row">
		      			<div class="col-md-3">
		      				<select class="form-control" name="company_title">
		      					<option value="Mr"> Mr </option>
		      					<option value="Ms"> Ms </option>
		      					<option value="Mrs"> Mrs </option>
		      					<option value="Dr"> Dr </option>
		      				</select>
		      			</div>
		      			<div class="col-md-3">
		      				<input type="text" class="form-control" name="admin_first_name" placeholder="First Name">
		      			</div>
		      			<div class="col-md-3">
		      				<input type="text" class="form-control" name="admin_middle_name" placeholder="Middle Name">
		      			</div>
		      			<div class="col-md-3">
		      				<input type="text" class="form-control" name="admin_last_name" placeholder="Last Name">
		      			</div>
		      		</div><br>
		      		<div class="row">
		      			<div class="col-md-3">
		      				<input type="text" class="form-control" name="admin_designation" placeholder="Designation">
		      			</div>
		      			<div class="col-md-3">
		      				<input type="text" class="form-control" name="admin_employee_id" placeholder="Employee ID">
		      			</div>
		      			<div class="col-md-3">
		      				<input type="text" class="form-control" name="admin_email_id" placeholder="Company Email ID">
		      			</div>
		      			<div class="col-md-3">
		      				<input type="text" class="form-control" name="admin_phone_number" placeholder="Phone Number">
		      			</div>
		      		</div><br>
		      		<div class="row">
		      			<div class="col-md-3">
		      				<input type="password" class="form-control" name="corporate_admin_password" id="corporate_user_password" placeholder="Password">
		      			</div>
		      			<div class="col-md-3">
		      				<input type="password" class="form-control" name="corporate_admin_confirm_password" id="corporate_confirm_password" placeholder="Confirm Password">
		      			</div>
		      		</div><br>
		      		<script type="text/javascript">
		      		$('#corporate_user_password, #corporate_confirm_password').on('keyup', function () 
				{
  				 if ($('#corporate_user_password').val() == $('#corporate_confirm_password').val()) 
  				 {
   					$('#corporate_confirm_password').css('background', '#55d24980');
  				 } 
  				 else 
    				$('#corporate_confirm_password').css('background', '#ff8787a1');
				});
		      	</script>
		      		<button class="btn btn-outline-danger" name="submit_corporate" type="submit"> Submit </button>
		      	</form>
		      	<br>
				<div class="container">
					<?php
						if(!empty(form_error("company_name")))
						{
					?>
					<div class="alert alert-danger">
  							<strong>REQUIRED** : </strong> Company Name is Required 
					</div>
					<?php				
						}else{ echo "";}
					?>
					<?php
						if(!empty(form_error("company_telephone")))
						{
					?>
					<div class="alert alert-danger">
  							<strong>REQUIRED** : </strong> Company Telephone is Required 
					</div>
					<?php				
						}
					?>
					<?php
						if(!empty(form_error("company_gstn")))
						{
					?>
					<div class="alert alert-danger">
  							<strong>REQUIRED** : </strong> GSTN is Required 
					</div>
					<?php				
						}
					?>
					<?php
						if(!empty(form_error("company_address")))
						{
					?>
					<div class="alert alert-danger">
  							<strong>REQUIRED** : </strong> Company Address is Required 
					</div>
					<?php				
						}
					?>
					<?php
						if(!empty(form_error("company_state")))
						{
					?>
					<div class="alert alert-danger">
  							<strong>REQUIRED** : </strong> State is Required 
					</div>
					<?php				
						}
					?>
					<?php
						if(!empty(form_error("company_city")))
						{
					?>
					<div class="alert alert-danger">
  							<strong>REQUIRED** : </strong> City is Required 
					</div>
					<?php				
						}
					?>
					<?php
						if(!empty(form_error("company_title")))
						{
					?>
					<div class="alert alert-danger">
  							<strong>REQUIRED** : </strong> Title is Required 
					</div>
					<?php				
						}
					?>
					<?php
						if(!empty(form_error("admin_first_name")))
						{
					?>
					<div class="alert alert-danger">
  							<strong>REQUIRED** : </strong> First Name is Required 
					</div>
					<?php				
						}
					?>
					<?php
						if(!empty(form_error("admin_middle_name")))
						{
					?>
					<div class="alert alert-danger">
  							<strong>REQUIRED** : </strong> Middle Name is Required 
					</div>
					<?php				
						}
					?>
					<?php
						if(!empty(form_error("admin_last_name")))
						{
					?>
					<div class="alert alert-danger">
  							<strong>REQUIRED** : </strong>Last Name is Required 
					</div>
					<?php				
						}
					?>
					<?php
						if(!empty(form_error("radmin_designation")))
						{
					?>
					<div class="alert alert-danger">
  							<strong>REQUIRED** : </strong>Employee Designation is Required 
					</div>
					<?php				
						}
					?>
					<?php
						if(!empty(form_error("admin_employee_id")))
						{
					?>
					<div class="alert alert-danger">
  							<strong>REQUIRED** : </strong>Employee ID is Required 
					</div>
					<?php				
						}
					?>
					<?php
						if(!empty(form_error("admin_email_id")))
						{
					?>
					<div class="alert alert-danger">
  							<strong>REQUIRED** : </strong>Email ID is Required 
					</div>
					<?php				
						}
					?>
					<?php
						if(!empty(form_error("admin_phone_number")))
						{
					?>
					<div class="alert alert-danger">
  							<strong>REQUIRED** : </strong>Phone Number is Required 
					</div>
					<?php				
						}
					?>
					<?php
						if(!empty(form_error("corporate_admin_password")))
						{
					?>
					<div class="alert alert-danger">
  							<strong>REQUIRED** : </strong>Password is Required 
					</div>
					<?php				
						}
					?>
					<?php
						if(!empty(form_error("corporate_admin_confirm_password")))
						{
					?>
					<div class="alert alert-danger">
  							<strong>REQUIRED** : </strong>Confirm Password is Required 
					</div>
					<?php				
						}
					?>
				</div><br><br><br>
			</div>
		</div>
	</div>
</section>

<script type="text/javascript">
	$(document).ready(function() {
    $('.nav-tabs a').click(function(){
        $(this).tab('show');
    });

 // The on tab shown event
    $('.nav-tabs a').on('shown.bs.tab', function (e) {
        var current_tab = e.target;
        var previous_tab = e.relatedTarget;
        
        var get_href = String(current_tab).split('#');
        var Test = document.cookie = "get_href="+get_href[1];
    });
 });  

    $(document).ready(function() {
    	function readCookie(name) 
    	{
    		var nameEQ = name + "=";
    		var ca = document.cookie.split(';');
    		for(var i=0;i < ca.length;i++) 
    		{
        		var c = ca[i];
        		while (c.charAt(0)==' ') 
        		{	
        			c = c.substring(1,c.length);
        		}

        		if (c.indexOf(nameEQ) == 0)
        		{ 
        			return c.substring(nameEQ.length,c.length);
        		}
    		}
    		return null;
		}

        var value = readCookie('get_href');
        if(value == "individual")
    	{
    		//alert('inside individual');
    		$('.individual').addClass('active');
    		$('#individual').addClass('active show');
    		$('.corporate').removeClass('active');
    		$('#corporate').removeClass('active show');
    	}
   		if(value == "corporate")
    	{
    		//alert('inside corporate');
    		$('.individual').removeClass('active');
    		$('#individual').removeClass('active show');
    		$('.corporate').addClass('active');
    		$('#corporate').addClass('active show');
    	}
    });
    	

 
</script>