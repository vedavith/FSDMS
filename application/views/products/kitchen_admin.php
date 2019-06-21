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
if(!isset($kicthen_admin_id))
{
?>
<div class="col-sm-6 col-md-9">
    <div class="row">
    	<div class="col-md-6" align="left">
    		<p class="h3"> Create Kitchen Admin </p>
    	</div>
    	<div class="col-md-3" align="right">
    		<a class="btn btn-sm btn-primary" href="<?php echo base_url()."superadmin/manage_kitchen_admin"; ?>"> Manage </a>
    	</div>
    	<div class="col-md-3" align="right">
    		<a class="btn btn-sm btn-outline-danger" href="<?php echo base_url()."superadmin/home"; ?>"> Back</a>
    	</div>
    </div>
    <br>

    <form method="post" action="<?php echo base_url()."superadmin/insert_kitchen_admin" ?>" enctype="multipart/form-data" id="form1">
    <div class="row container">
  <div class="container" id="accordion1">
    <div class="card">
      <div class="card-header">
        <a class="card-link" data-toggle="collapse" href="#CategoryOne">
         Kitchen Admin details
        </a>
      </div>
      <div id="CategoryOne" class="collapse show" data-parent="#accordion1">
      	<div class="row">
      		<div class="card-body col-md-3" align="right">
      			<label class="h6"> Kitchen ID </label>
      		</div>
      			<div class="col-md-6">
        			<div class="card-body">
        				<select name="kitchen_id" class="form-control">
						<option value=""> Select Option </option>
			          	<?php 
			          	foreach($kitchen_ids->result() as $row)
			          	{
			          	?>
			          	<option value="<?php echo $row->k_id; ?>"><?php echo $row->k_id; ?></option>
			          	<?php
			          	} 
			          	?>
			          </select>
        				
        			</div>
        		</div>
        	</div>

        	<div class="row">
	      		<div class="card-body col-md-3" align="right">
	      			<label class="h6"> First Name </label>
	      		</div>
      				<div class="col-md-6">
        				<div class="card-body">
				         <input type="text" name="first_name" class="form-control" placeholder="First Name">
        				</div>
        			</div>
        	</div>
        	<div class="row">
	      		<div class="card-body col-md-3" align="right">
	      			<label class="h6"> Last Name </label>
	      		</div>
      				<div class="col-md-6">
        				<div class="card-body">
				         <input type="text" name="last_name" class="form-control" placeholder="Last Name">
        				</div>
        			</div>
        	</div>

        	<div class="row">
	      		<div class="card-body col-md-3" align="right">
	      			<label class="h6"> Email Id </label>
	      		</div>
      				<div class="col-md-6">
        				<div class="card-body">
				         <input type="text" name="email" class="form-control" placeholder="Email Id">
        				</div>
        			</div>
        	</div>
        	<div class="row">
	      		<div class="card-body col-md-3" align="right">
	      			<label class="h6"> User Name </label>
	      		</div>
      				<div class="col-md-6">
        				<div class="card-body">
				         <input type="text" name="user_name" class="form-control" placeholder="User Name">
        				</div>
        			</div>
        	</div>
        	<div class="row">
	      		<!--<div class="card-body col-md-3" align="right">
	      			<label class="h6"> Password </label>
	      		</div>-->
      				<div class="col-md-6">
        				
				         <input type="hidden" name="password" class="form-control" placeholder="Password" value="admin@123">
        				
        			</div>
        	</div>
				<div class="card-body">
	      		<?php
				$count =0;
	      		if(!empty(form_error("kitchen_id")))
						{
							$count = 1;
					?>
					<div class="row alert alert-danger">
								<strong>REQUIRED** : </strong> Kitchen Id is Required
					</div>
					<?php
						}
						if(!empty(form_error("first_name")))
						{
							$count = 1;
					?>
						<div class="row alert alert-danger">
								<strong>REQUIRED** : </strong> First Name is Required
					</div>
						<?php
							}
							if(!empty(form_error("last_name")))
						{
							$count = 1;
					?>
					<div class="row alert alert-danger">
								<strong>REQUIRED** : </strong> Last Name is Required
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
								if(!empty(form_error("user_name")))
						{
							$count = 1;
					?>
					<div class="row alert alert-danger">
								<strong>REQUIRED** : </strong> User Name is Required
					</div>
						<?php
							}
								if(!empty(form_error("password")))
						{
							$count = 1;
					?>
					<div class="row alert alert-danger">
								<strong>REQUIRED** : </strong> Password is Required
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
			if($error == "KAD")
			{
		?>
		<br>
		<div class="container-fluid">
			<div class="alert alert-danger">
					<strong> ERROR(<?php echo $error; ?>) : </strong> Kitchen ADMIN Details Already Exists
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
	if($kicthen_admin_id->num_rows() > 0)
	{
		foreach ($kicthen_admin_id->result() as $row1)
		{
			
	?>
	<div class="col-sm-6 col-md-9">
    <div class="row">
    	<div class="col-md-6" align="left">
    		<p class="h3"> Edit Kitchen Admin </p>
    	</div>
    	<div class="col-md-3" align="right">
    		<a class="btn btn-sm btn-primary" href="<?php echo base_url()."superadmin/manage_kitchen_admin"; ?>"> Manage </a>
    	</div>
    	<div class="col-md-3" align="right">
    		<a class="btn btn-sm btn-outline-danger" href="<?php echo base_url()."superadmin/home"; ?>"> Back</a>
    	</div>
    </div>
    <br>

    <form method="post" action="<?php echo base_url()."superadmin/edit_kitchen_admin_data" ?>" enctype="multipart/form-data" id="form1">
    <div class="row container">
  <div class="container" id="accordion1">
    <div class="card">
      <div class="card-header">
        <a class="card-link" data-toggle="collapse" href="#CategoryOne">
         Kitchen Admin details
        </a>
      </div>
      <div id="CategoryOne" class="collapse show" data-parent="#accordion1">
      	<div class="row">
      		<div class="card-body col-md-3" align="right">
      			<label class="h6"> Kitchen ID </label>
      		</div>
      			<div class="col-md-6">
        			<div class="card-body">
        				<input type="hidden" name="khidden_id" class="form-control"  value="<?php echo $row1->id; ?>">
        				<select name="kitchen_id" class="form-control">
						<option value=""> Select Option </option>
			          	<?php 
			          	foreach($kitchen_ids->result() as $row)
			          	{
			          	?>
			          	<option value="<?php echo $row->k_id;?>" <?php if($row->k_id == $row1->kitchen_id) echo 'selected="selected"' ?>"><?php echo $row->k_id; ?></option>
			          	<?php
			          	} 
			          	?>
			          </select>
        				
        			</div>
        		</div>
        	</div>

        	<div class="row">
	      		<div class="card-body col-md-3" align="right">
	      			<label class="h6"> First Name </label>
	      		</div>
      				<div class="col-md-6">
        				<div class="card-body">
				         <input type="text" name="first_name" class="form-control" placeholder="First Name" value="<?php echo $row1->first_name; ?>">
        				</div>
        			</div>
        	</div>
        	<div class="row">
	      		<div class="card-body col-md-3" align="right">
	      			<label class="h6"> Last Name </label>
	      		</div>
      				<div class="col-md-6">
        				<div class="card-body">
				         <input type="text" name="last_name" class="form-control" placeholder="Last Name" value="<?php echo $row1->last_name; ?>" >
        				</div>
        			</div>
        	</div>

        	<div class="row">
	      		<div class="card-body col-md-3" align="right">
	      			<label class="h6"> Email Id </label>
	      		</div>
      				<div class="col-md-6">
        				<div class="card-body">
				         <input type="text" name="email" class="form-control" placeholder="Email Id" value="<?php echo $row1->email_id; ?>" >
        				</div>
        			</div>
        	</div>
        	<div class="row">
	      		<div class="card-body col-md-3" align="right">
	      			<label class="h6"> User Name </label>
	      		</div>
      				<div class="col-md-6">
        				<div class="card-body">
				         <input type="text" name="user_name" class="form-control" placeholder="User Name" value="<?php echo $row1->user_name; ?>" >
        				</div>
        			</div>
        	</div>
        	<div class="row">
	      		<!--<div class="card-body col-md-3" align="right">
	      			<label class="h6"> Password </label>
	      		</div>-->
      				<!--<div class="col-md-6">
        				
				         <input type="hidden" name="password" class="form-control" placeholder="Password" value="<?php //echo $row1->password; ?>" >
        				
        			</div>-->
        	</div>
				<div class="card-body">
	      		<?php
				$count =0;
	      		if(!empty(form_error("kitchen_id")))
						{
							$count = 1;
					?>
					<div class="row alert alert-danger">
								<strong>REQUIRED** : </strong> Kitchen Id is Required
					</div>
					<?php
						}
						if(!empty(form_error("first_name")))
						{
							$count = 1;
					?>
						<div class="row alert alert-danger">
								<strong>REQUIRED** : </strong> First Name is Required
					</div>
						<?php
							}
							if(!empty(form_error("last_name")))
						{
							$count = 1;
					?>
					<div class="row alert alert-danger">
								<strong>REQUIRED** : </strong> Last Name is Required
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
								if(!empty(form_error("user_name")))
						{
							$count = 1;
					?>
					<div class="row alert alert-danger">
								<strong>REQUIRED** : </strong> User Name is Required
					</div>
						<?php
							}
								if(!empty(form_error("password")))
						{
							$count = 1;
					?>
					<div class="row alert alert-danger">
								<strong>REQUIRED** : </strong> Password is Required
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
        		 <input type="submit" name="update" id="update" value="UPDATE" class="btn btn-outline-success">
        		<!--<button type="submit" class="btn btn-outline-success"> Submit </button>-->
        	</div>
        	<div class="col-md-6 col-sm-3" align="left">
        		<a href="<?php echo base_url()."superadmin/create_kitchen_admin" ?>" class="btn btn-outline-danger"> Back </a>
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


