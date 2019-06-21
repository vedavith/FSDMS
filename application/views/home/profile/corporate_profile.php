<br><br><br><br><br>
<?php 
if($user_data->num_rows() > 0)
{
	foreach($user_data->result() as $row)
	{
?>
<section>
    <div class = "container">
        <p class = "h3"> Profile </p>
        <form method="post" action="<?php echo base_url()."home/update_corporate" ?>">
        <div class="row">
        	<div class="col-md-3">
        		<input type="hidden" name="comp_id" value="<?php echo  $row->id;?>"/>
				<input type="text" name="company_name" class="form-control" placeholder="Company Name" value="<?php if(isset($row->company_name)){ echo $row->company_name; } ?>">
			</div>
			<div class="col-md-3">
				<input type="text" name="company_telephone" class="form-control" placeholder="Company Telephone" value="<?php if(isset($row->company_telephone)){ echo $row->company_telephone; } ?>">
			</div>
			<div class="col-md-3">
				<input type="text" name="company_gstn" class="form-control" placeholder="Company GST" value="<?php if(isset($row->company_gstn)){ echo $row->company_gstn; } ?>">
			</div>
			<div class="col-md-3">
				<input type="text" name="company_address" class="form-control" placeholder="Company Address" value="<?php if(isset($row->company_address)){ echo $row->company_address; } ?>">
			</div>

        </div>	<br>
        <div class="row">
        	<div class="col-md-3">
				<input type="text" name="company_city" class="form-control" placeholder="Company City" value="<?php if(isset($row->company_city)){ echo $row->company_city; } ?>">
			</div>
			<div class="col-md-3">
				<input type="text" name="company_state" class="form-control" placeholder="Company State" value="<?php if(isset($row->company_state)){ echo $row->company_state; } ?>">
			</div>
        </div><br>
        <div class="row">
        	
		
			<div class="col-md-3">
				<select class="form-control" name="company_title"> <?php echo $row->user_title; ?>
					<option value=""> Select Option </option>
					<option value="Mr" <?php if($row->user_title == "Mr"){echo "selected='selected'";} ?> > Mr </option>
					<option value="Ms" <?php if($row->user_title == "Ms"){echo "selected='selected'";} ?>> Ms </option>					
					<option value="Mrs"<?php if($row->user_title == "Mrs"){echo "selected='selected'";} ?>> Mrs </option>
					<option value="Dr" <?php if($row->user_title == "Dr"){echo "selected='selected'";} ?>> Dr </option>
				</select>
			</div>
			<div class="col-md-3">
				<input type="text" name="rep_first_name" class="form-control" placeholder="First Name" value="<?php if(isset($row->first_name)){ echo $row->first_name; } ?>">
			</div>
			<div class="col-md-3">
				<input type="text" name="rep_middle_name" class="form-control" placeholder="Middle Name" value="<?php if(isset($row->middle_name)){echo $row->middle_name;} ?>">
			</div>
			<div class="col-md-3">
				<input type="text" name="rep_last_name" class="form-control" placeholder="Last Name" value="<?php if(isset($row->last_name)){ echo $row->last_name; } ?>">
			</div>
			
	    </div><br>
		<div class="row">
				
			
			<div class="col-md-3">
				<input type="text" class="form-control" name="rep_designation" placeholder="Designation" value="<?php if(isset($row->rep_designation)){ echo $row->rep_designation; } ?>"> 
			</div>
			<div class="col-md-3">
				<input type="text" class="form-control" name="rep_employee_id" placeholder="Employee Id" value="<?php if(isset($row->rep_employee_id)){ echo "$row->rep_employee_id"; } ?>">
			</div>
			
			<div class="col-md-3">
				<input type="text" class="form-control" name="rep_email_id" placeholder="Email" value="<?php if(isset($row->rep_email_id)){ echo $row->rep_email_id; } ?>" readonly>
			</div>
			<div class="col-md-3">
				<input type="text" class="form-control" name="rep_phone_number" placeholder="Phone Number" value = "<?php if(isset($row->rep_phone_number)){ echo $row->rep_phone_number; } ?>">
			</div>
			
			
		</div><br/>
		<div class="row">
			
			
		</div><br>
		<div class="row container">
			<button name="update_corporate" type="submit" class="btn btn-outline-danger" > Update </button>
        </div>
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
						if(!empty(form_error("rep_first_name")))
						{
					?>
					<div class="alert alert-danger">
  							<strong>REQUIRED** : </strong> First Name is Required 
					</div>
					<?php				
						}
					?>
					<?php
						if(!empty(form_error("rep_middle_name")))
						{
					?>
					<div class="alert alert-danger">
  							<strong>REQUIRED** : </strong> Middle Name is Required 
					</div>
					<?php				
						}
					?>
					<?php
						if(!empty(form_error("rep_last_name")))
						{
					?>
					<div class="alert alert-danger">
  							<strong>REQUIRED** : </strong>Last Name is Required 
					</div>
					<?php				
						}
					?>
					<?php
						if(!empty(form_error("rep_designation")))
						{
					?>
					<div class="alert alert-danger">
  							<strong>REQUIRED** : </strong>Employee Designation is Required 
					</div>
					<?php				
						}
					?>
					<?php
						if(!empty(form_error("rep_employee_id")))
						{
					?>
					<div class="alert alert-danger">
  							<strong>REQUIRED** : </strong>Employee ID is Required 
					</div>
					<?php				
						}
					?>
					<?php
						if(!empty(form_error("rep_email_id")))
						{
					?>
					<div class="alert alert-danger">
  							<strong>REQUIRED** : </strong>Email ID is Required 
					</div>
					<?php				
						}
					?>
					<?php
						if(!empty(form_error("rep_phone_number")))
						{
					?>
					<div class="alert alert-danger">
  							<strong>REQUIRED** : </strong>Phone Number is Required 
					</div>
					<?php				
						}
					?>
					
					<?php
						if(!empty(form_error("rep_phone_number")))
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
</section>

<?php	
	} 
}
?>