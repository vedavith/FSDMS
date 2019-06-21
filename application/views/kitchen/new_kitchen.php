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
if(!isset($kicthen_reg_id))
{
?>
<div class="col-sm-6 col-md-9">
    <div class="row">
    	<div class="col-md-6" align="left">
    		<p class="h3"> Create Kitchen </p>
    	</div>
    	<div class="col-md-3" align="right">
    		<a class="btn btn-sm btn-primary" href="<?php echo base_url()."superadmin/manage_kitchen"; ?>"> Manage </a>
    	</div>
    	<div class="col-md-3" align="right">
    		<a class="btn btn-sm btn-outline-danger" href="<?php echo base_url()."superadmin/home"; ?>"> Back</a>
    	</div>
    </div>
    <br>

    <form method="post" action="<?php echo base_url()."superadmin/insert_kitchen_data" ?>" enctype="multipart/form-data" id="form1">
    <div class="row container">
  <div class="container" id="accordion1">
    <div class="card">
      <div class="card-header">
        <a class="card-link" data-toggle="collapse" href="#CategoryOne">
         Kitchen ID/Name
        </a>
      </div>
      <div id="CategoryOne" class="collapse show" data-parent="#accordion1">
      	<div class="row">
      		<div class="card-body col-md-3" align="right">
      			<label class="h6"> Kitchen ID </label>
      		</div>
      			<div class="col-md-6">
        			<div class="card-body">
        				<input type="text" name="kitchen_id" class="form-control" placeholder="Kitchen ID">
        			</div>
        		</div>
        	</div>

        	<div class="row">
	      		<div class="card-body col-md-3" align="right">
	      			<label class="h6"> Kitchen Name </label>
	      		</div>
      				<div class="col-md-6">
        				<div class="card-body">
				         <input type="text" name="kitchen_name" class="form-control" placeholder="Kitchen Name">
        				</div>
        			</div>
        	</div>
        	<div class="row">
	      		<div class="card-body col-md-3" align="right">
	      			<label class="h6"> Kitchen Type </label>
	      		</div>
      				<div class="col-md-6">
        				<div class="card-body">
				         <input type="radio" name="kitchen_type" value="company"> Company Owned
				         <input type="radio" name="kitchen_type" value="other"> Third party
        				</div>
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
					if(!empty(form_error("kitchen_name")))
					{
						$count = 1;
				?>
					<div class="row alert alert-danger">
							<strong>REQUIRED** : </strong> Kitchen name is Required
				</div>
					<?php
						}
						if(!empty(form_error("kitchen_type")))
						{
						$count = 1;
					?>
					<div class="row alert alert-danger">
							<strong>REQUIRED** : </strong> Kitchen type is Required
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
        <a class="collapsed card-link" data-toggle="collapse" href="#CategoryTwo">
        Kitchen Address
      </a>
      </div>
      <div id="CategoryTwo" class="collapse" data-parent="#accordion1">
        <div class="row">
        	<div class="card-body col-md-3" align="right"> <label class="h6"> Kitchen Address </label> </div>
        	<div class="card-body col-md-6" align="left">
        		<input type="text" name="kitchen_address1" class="form-control" placeholder="Kichen Address1"> </br>
				<input type="text" name="kitchen_address2" class="form-control" placeholder="Kichen Address2"></br>
        		<input type="text" name="kitchen_address3" class="form-control" placeholder="Kichen Address3">
        	</div>
    	</div>
    	<div class="row">
        	<div class="card-body col-md-3" align="right"> <label class="h6"> State </label> </div>
        	<div class="card-body col-md-6" align="left">
        		<input type="text" name="state" class="form-control" placeholder="State">
        	</div>
    	</div>
    	<div class="row">
        	<div class="card-body col-md-3" align="right"> <label class="h6"> City </label> </div>
        	<div class="card-body col-md-6" align="left">
        		<input type="text" name="city" class="form-control" placeholder="City">
        	</div>
    	</div>
    	<div class="row">
        	<div class="card-body col-md-3" align="right"> <label class="h6"> Zipcode </label> </div>
        	<div class="card-body col-md-6" align="left">
        		<input type="text" name="zipcode" class="form-control" placeholder="Zip code">
        	</div>
    	</div>
			
    	
						      <div class="card-body">
						      	<?php
										$count = 0;
										$customize = 0;

						      		if(!empty(form_error("kitchen_address1")))
											{
												$count = 1;
										?>
										<div class="row alert alert-danger">
													<strong>REQUIRED** : </strong> Kitchen address1 is Required
										</div>
										<?php
											}
											if(!empty(form_error("kitchen_address2")))
											{
												$count = 1;
										?>
											<div class="row alert alert-danger">
													<strong>REQUIRED** : </strong> Kitchen address2 is Required
										</div>

											<?php
										}
										if(!empty(form_error("kitchen_address3")))
											{
												$count = 1;
											?>
											<div class="row alert alert-danger">
													<strong>REQUIRED** : </strong> Kitchen address3 is Required
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
													<strong>REQUIRED** : </strong> city is Required
										</div>
											<?php 
										}
										if(!empty(form_error("zipcode")))
											{
												$count = 1;
											?>
									<div class="row alert alert-danger">
													<strong>REQUIRED** : </strong> zipcode is Required
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
			if($error == "KTE")
			{
		?>
		<br>
		<div class="container-fluid">
			<div class="alert alert-danger">
					<strong> ERROR(<?php echo $error; ?>) : </strong> Kitchen Details Already Exists
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
	if($kicthen_reg_id->num_rows() > 0)
	{
		foreach ($kicthen_reg_id->result() as $row)
		{
			

		?>


<div class="col-sm-6 col-md-9">
    <div class="row">
    	<div class="col-md-6" align="left">
    		<p class="h3"> Edit Kitchen </p>
    	</div>
    	<div class="col-md-3" align="right">
    		<a class="btn btn-sm btn-primary" href="<?php echo base_url()."superadmin/manage_kitchen"; ?>"> Manage </a>
    	</div>
    	<div class="col-md-3" align="right">
    		<a class="btn btn-sm btn-outline-danger" href="<?php echo base_url()."superadmin/create_kitchen"; ?>"> Back</a>
    	</div>
    </div>
    <br>

    <form method="post" action="<?php echo base_url()."superadmin/edit_kitchen_data" ?>" enctype="multipart/form-data" id="form1">
    <div class="row container">
  <div class="container" id="accordion1">
    <div class="card">
      <div class="card-header">
        <a class="card-link" data-toggle="collapse" href="#CategoryOne">
         Kitchen ID/Name
        </a>
      </div>
      <div id="CategoryOne" class="collapse show" data-parent="#accordion1">
      	<div class="row">
      		<div class="card-body col-md-3" align="right">
      			<label class="h6"> Kitchen ID </label>
      		</div>
      			<div class="col-md-6">
        			<div class="card-body">
        				<input type="hidden" name="khidden_id" class="form-control" value="<?php echo $row->id;?>" >
        				<input type="text" name="kitchen_id" class="form-control" placeholder="Kitchen ID" readonly value="<?php echo $row->k_id;?>" >
        			</div>
        		</div>
        	</div>

        	<div class="row">
	      		<div class="card-body col-md-3" align="right">
	      			<label class="h6"> Kitchen Name </label>
	      		</div>
      				<div class="col-md-6">
        				<div class="card-body">
				         <input type="text" name="kitchen_name" class="form-control" placeholder="Kitchen Name" value="<?php echo $row->k_name;?>">
        				</div>
        			</div>
        	</div>
        	<div class="row">
	      		<div class="card-body col-md-3" align="right">
	      			<label class="h6"> Kitchen Type </label>
	      		</div>
      				<div class="col-md-6">
        				<div class="card-body">
        					
				         <input type="radio" name="kitchen_type" value="company" <?php echo ($row->kitchen_type =='company')? 'CHECKED' : '' ; ?>>Company Owned
				         <input type="radio" name="kitchen_type" value="other" <?php echo ($row->kitchen_type =='other')? 'CHECKED' : '' ; ?>>Third party
        				</div>
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
					if(!empty(form_error("kitchen_name")))
					{
						$count = 1;
				?>
					<div class="row alert alert-danger">
							<strong>REQUIRED** : </strong> Kitchen name is Required
				</div>
					<?php
						}
						if(!empty(form_error("kitchen_type")))
					{
						$count = 1;
				?>
					<div class="row alert alert-danger">
							<strong>REQUIRED** : </strong> Kitchen type is Required
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
        <a class="collapsed card-link" data-toggle="collapse" href="#CategoryTwo">
        Kitchen Address
      </a>
      </div>
      <div id="CategoryTwo" class="collapse" data-parent="#accordion1">
        <div class="row">
        	<div class="card-body col-md-3" align="right"> <label class="h6"> Kitchen Address </label> </div>
        	<div class="card-body col-md-6" align="left">
        		<input type="text" name="kitchen_address1" class="form-control" placeholder="Kichen Address1" value="<?php echo $row->k_address1;?>"> </br>
				<input type="text" name="kitchen_address2" class="form-control" placeholder="Kichen Address2" value="<?php echo $row->k_address2;?>" ></br>
        		<input type="text" name="kitchen_address3" class="form-control" placeholder="Kichen Address3" value="<?php echo $row->k_address3;?>" >
        	</div>
    	</div>
    	<div class="row">
        	<div class="card-body col-md-3" align="right"> <label class="h6"> State </label> </div>
        	<div class="card-body col-md-6" align="left">
        		<input type="text" name="state" class="form-control" placeholder="State" value="<?php echo $row->state;?>">
        	</div>
    	</div>
    	<div class="row">
        	<div class="card-body col-md-3" align="right"> <label class="h6"> City </label> </div>
        	<div class="card-body col-md-6" align="left">
        		<input type="text" name="city" class="form-control" placeholder="City" value="<?php echo $row->city;?>">
        	</div>
    	</div>
    	<div class="row">
        	<div class="card-body col-md-3" align="right"> <label class="h6"> Zipcode </label> </div>
        	<div class="card-body col-md-6" align="left">
        		<input type="text" name="zipcode" class="form-control" placeholder="Zip code" value="<?php echo $row->zipcode;?>">
        	</div>
    	</div>
			
    	
						      <div class="card-body">
						      	<?php
										$count = 0;
										$customize = 0;

						      		if(!empty(form_error("kitchen_address1")))
											{
												$count = 1;
										?>
										<div class="row alert alert-danger">
													<strong>REQUIRED** : </strong> Kitchen address1 is Required
										</div>
										<?php
											}
											if(!empty(form_error("kitchen_address2")))
											{
												$count = 1;
										?>
											<div class="row alert alert-danger">
													<strong>REQUIRED** : </strong> Kitchen address2 is Required
										</div>

											<?php
										}
										if(!empty(form_error("kitchen_address3")))
											{
												$count = 1;
											?>
											<div class="row alert alert-danger">
													<strong>REQUIRED** : </strong> Kitchen address3 is Required
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
													<strong>REQUIRED** : </strong> city is Required
										</div>
											<?php 
										}
										if(!empty(form_error("zipcode")))
											{
												$count = 1;
											?>
									<div class="row alert alert-danger">
													<strong>REQUIRED** : </strong> zipcode is Required
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
        		 <input type="submit" name="update" id="update" value="UPDATE" class="btn btn-outline-success">
        		<!--<button type="submit" class="btn btn-outline-success"> Update </button>-->
        	</div>
        	<div class="col-md-6 col-sm-3" align="left">
        		<a href="<?php echo base_url()."superadmin/create_kitchen" ?>" class="btn btn-outline-danger"> Back </a>
        	</div>
        </div>
      </div>
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


