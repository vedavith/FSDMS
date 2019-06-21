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
        <form method="post" action="<?php echo base_url()."home/update_individual_user" ?>">
        <div class="row">
			<div class="col-md-3">
				<select class="form-control" name="title"> <?php echo $row->user_title; ?>
					<option value=""> Select Option </option>
					<option value="Mr" <?php if($row->user_title == "Mr"){echo "selected='selected'";} ?> > Mr </option>
					<option value="Ms" <?php if($row->user_title == "Ms"){echo "selected='selected'";} ?>> Ms </option>					
					<option value="Mrs"<?php if($row->user_title == "Mrs"){echo "selected='selected'";} ?>> Mrs </option>
					<option value="Dr" <?php if($row->user_title == "Dr"){echo "selected='selected'";} ?>> Dr </option>
				</select>
			</div>
			<div class="col-md-3">
				<input type="text" name="first_name" class="form-control" placeholder="First Name" value="<?php if(isset($row->first_name)){ echo $row->first_name; } ?>">
			</div>
			<div class="col-md-3">
				<input type="text" name="middle_name" class="form-control" placeholder="Middle Name" value="<?php if(isset($row->middle_name)){echo $row->middle_name;} ?>">
			</div>	
			<div class="col-md-3">
				<input type="text" name="last_name" class="form-control" placeholder="Last Name" value="<?php if(isset($row->last_name)){ echo $row->last_name; } ?>">
			</div>
	    </div><br>
		<div class="row">
			<div class="col-md-3">
				<input type="text" class="form-control" name="email_id" placeholder="Email" value="<?php if(isset($row->email)){ echo $row->email; } ?>" readonly>
			</div>
			<div class="col-md-3">
				<input type="text" class="form-control" name="phone_number" placeholder="Phone Number" value = "<?php if(isset($row->phone_number)){ echo $row->phone_number; } ?>">
			</div>
			<div class="col-md-3">
				<input type="date" class="form-control" name="dob" placeholder="Date of Birth" value="<?php if(isset($row->dob)){ echo "$row->dob"; } ?>">
			</div>
			<div class="col-md-3">
				<input type="text" class="form-control" name="blood_group" placeholder="Blood Group" value="<?php if(isset($row->blood_group)){ echo $row->blood_group; } ?>"> 
			</div>
		</div><br/>
		<div class="row">
			<div class="col-md-3">
				<select class="form-control" name="meal_type">
					<option>Select Meal Type</option>
					<option value="Veg" <?php if(isset($row->meal_type)){if($row->meal_type == "Veg"){echo "selected='selected'";}} ?>> Veg</option>
					<option value="non_veg"  <?php if(isset($row->meal_type)){if($row->meal_type == "non_veg"){echo "selected='selected'";}} ?>> Non-Veg</option>
					<option value="jain_meal"  <?php if(isset($row->meal_type)){if($row->meal_type == "jain_meal"){echo "selected='selected'";}} ?>> Jain Meal</option>
				</select>
			</div>
			<div class="col-md-3">
				<input type="text" class="form-control" name="address" placeholder="address" value="<?php if(isset($row->address)){ echo $row->address; } ?>">
			</div>
			<div class="col-md-3">
				<input type="text" class="form-control" name="city" placeholder="City" value="<?php if(isset($row->city)){ echo $row->city; } ?>">
			</div>
			<div class="col-md-3">
				<input type="text" class="form-control" name="state" placeholder="State" value="<?php if(isset($row->state)){ echo $row->state; } ?>">
			</div>
		</div><br>
		<div class="row container">
			<button name="update_individual" type="submit" class="btn btn-outline-danger" > Submit </button>
        </div>
    </form>	 
<br>
<div class="container">
					<?php
						if(!empty(form_error("first_name")))
						{
					?>
					<div class="alert alert-danger">
  							<strong>REQUIRED** : </strong> First Name should not be empty
					</div>
					<?php				
						}else{ echo "";}
					?>
					<?php
						if(!empty(form_error("middle_name")))
						{
					?>
					<div class="alert alert-danger">
  							<strong>REQUIRED** : </strong> Middle Name should not be empty 
					</div>
					<?php				
						}
					?>
					<?php
						if(!empty(form_error("last_name")))
						{
					?>
					<div class="alert alert-danger">
  							<strong>REQUIRED** : </strong> Last Name should not be empty 
					</div>
					<?php				
						}
					?>
					<?php
						if(!empty(form_error("email_id")))
						{
					?>
					<div class="alert alert-danger">
  							<strong>REQUIRED** : </strong> Email Id should not be empty 
					</div>
					<?php				
						}
					?>
					<?php
						if(!empty(form_error("user_password")))
						{
					?>
					<div class="alert alert-danger">
  							<strong>REQUIRED** : </strong> Password should not be empty 
					</div>
					<?php				
						}
					?>
					<?php
						if(!empty(form_error("phone_number")))
						{
					?>
					<div class="alert alert-danger">
  							<strong>REQUIRED** : </strong> Phone Number should not be empty 
					</div>
					<?php				
						}
					?>
					<?php
						if(!empty(form_error("dob")))
						{
					?>
					<div class="alert alert-danger">
  							<strong>REQUIRED** : </strong> Date Of Birth should not be empty 
					</div>
					<?php				
						}
					?>
					<?php
						if(!empty(form_error("blood_group")))
						{
					?>
					<div class="alert alert-danger">
  							<strong>REQUIRED** : </strong> Blood Group should not be empty 
					</div>
					<?php				
						}
					?>
					<?php
						if(!empty(form_error("meal_type")))
						{
					?>
					<div class="alert alert-danger">
  							<strong>REQUIRED** : </strong> Meal Type should not be empty 
					</div>
					<?php				
						}
					?>
					<?php
						if(!empty(form_error("address")))
						{
					?>
					<div class="alert alert-danger">
  							<strong>REQUIRED** : </strong>Address should not be empty 
					</div>
					<?php				
						}
					?>
					<?php
						if(!empty(form_error("city")))
						{
					?>
					<div class="alert alert-danger">
  							<strong>REQUIRED** : </strong>City should not be empty 
					</div>
					<?php				
						}
					?>
						<?php
						if(!empty(form_error("state")))
						{
					?>
					<div class="alert alert-danger">
  							<strong>REQUIRED** : </strong>State should not be empty 
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