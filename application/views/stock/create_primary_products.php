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
if(!isset($get_primary_products))
{
?>
<div class="col-sm-6 col-md-9">
    <div class="row">
    	<div class="col-md-6" align="left">
    		<p class="h3"> Create Store Products </p>
    	</div>
    	<div class="col-md-3" align="right">
    		<a class="btn btn-sm btn-primary" href="<?php echo base_url()."superadmin/manage_primary_stock_products"; ?>"> Manage </a>
    	</div>
    	<div class="col-md-3" align="right">
    		<a class="btn btn-sm btn-outline-danger" href="<?php echo base_url()."superadmin/home"; ?>"> Back</a>
    	</div>
    </div>
    <br>

    <form method="post" action="<?php echo base_url()."superadmin/insert_primary_stock_products" ?>"  id="form1">
    <div class="row container">
  <div class="container" id="accordion1">
    <div class="card">
      <div class="card-header">
        <a class="card-link" data-toggle="collapse" href="#CategoryOne">
         Primary Stock Details
        </a>
      </div>
      <div id="CategoryOne" class="collapse show" data-parent="#accordion1">

        	<div class="row">
	      		<div class="card-body col-md-3" align="right">
	      			<label class="h6"> Product Name </label>
	      		</div>
      				<div class="col-md-6">
        				<div class="card-body">
				         <input type="text" name="product_name" class="form-control" placeholder="Product Name">
        				</div>
        			</div>
        	</div>
        	<div class="row">
	      		<div class="card-body col-md-3" align="right">
	      			<label class="h6"> Product SKU </label>
	      		</div>
      				<div class="col-md-6">
        				<div class="card-body">
				         <input type="text" name="product_sku" class="form-control" placeholder="Product SKU">
        				</div>
        			</div>
        	</div>

					<div class="row">
	      		<div class="card-body col-md-3" align="right">
	      			<label class="h6"> Primary Units </label>
	      		</div>
	      			<div class="col-md-6">
	        			<div class="card-body">
	        				<select name="primary_units" class="form-control">
							<option value=" "> Select Primary Units </option>
				          	<?php
				          	foreach($units_data->result() as $row)
				          	{
				          	?>
				          	<option value="<?php echo $row->units; ?>"><?php echo $row->units; ?></option>
				          	<?php
				          	}
				          	?>
				          </select>

	        			</div>
	        		</div>
	        	</div>

						<div class="row">
							<div class="card-body col-md-3" align="right">
								<label class="h6"> Secondary Units </label>
							</div>
								<div class="col-md-6">
									<div class="card-body">
										<select name="secondary_units" class="form-control">
								<option value=" "> Select Secondary Units </option>
											<?php
											foreach($units_data->result() as $row)
											{
											?>
											<option value="<?php echo $row->units; ?>"><?php echo $row->units; ?></option>
											<?php
											}
											?>
										</select>
									</div>
								</div>
							</div>

							<div class="row">
			      		<div class="card-body col-md-3" align="right">
			      			<label class="h6"> Product Description </label>
			      		</div>
		      				<div class="col-md-6">
		        				<div class="card-body">
						         <textarea name="product_description" class="form-control" placeholder="Product SKU"></textarea>
		        				</div>
		        			</div>
		        	</div>


				<div class="card-body">
	      		<?php
				$count =0;
	      		if(!empty(form_error("product_name")))
						{
							$count = 1;
					?>
					<div class="row alert alert-danger">
								<strong>REQUIRED** : </strong> Product Name is Required
					</div>
					<?php
						}
						if(!empty(form_error("product_sku")))
						{
							$count = 1;
					?>
						<div class="row alert alert-danger">
								<strong>REQUIRED** : </strong>Product SKU is Required
					</div>
						<?php
							}
							if(!empty(form_error("primary_units")))
						{
							$count = 1;
					?>
					<div class="row alert alert-danger">
								<strong>REQUIRED** : </strong> Primary Unit is Required
					</div>
						<?php
							}
					if(!empty(form_error("secondary_units")))
						{
							$count = 1;
					?>
					<div class="row alert alert-danger">
								<strong>REQUIRED** <label name="secondary_units"></label>: </strong> Secondary Unit is Required
					</div>
						<?php
							}
								if(!empty(form_error("product_description")))
						{
							$count = 1;
					?>
					<div class="row alert alert-danger">
								<strong>REQUIRED** : </strong> Description is Required
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
	if($get_primary_products->num_rows() > 0)
	{
		foreach ($get_primary_products->result() as $row1)
		{

	?>
	<div class="col-sm-6 col-md-9">
    <div class="row">
    	<div class="col-md-6" align="left">
    		<p class="h3"> Edit Primary Stock </p>
    	</div>
    	<div class="col-md-3" align="right">
    		<a class="btn btn-sm btn-primary" href="<?php echo base_url()."superadmin/manage_primary_stock_products"; ?>"> Manage </a>
    	</div>
    	<div class="col-md-3" align="right">
    		<a class="btn btn-sm btn-outline-danger" href="<?php echo base_url()."superadmin/home"; ?>"> Back</a>
    	</div>
    </div>
    <br>

    <form method="post" action="<?php echo base_url()."superadmin/update_primary_stock_products_data" ?>"  id="form1">
    <div class="row container">
  <div class="container" id="accordion1">
    <div class="card">
      <div class="card-header">
        <a class="card-link" data-toggle="collapse" href="#CategoryOne">
         Primary Stock Details
        </a>
      </div>
      <div id="CategoryOne" class="collapse show" data-parent="#accordion1">
      	
      		        	<input type="hidden" name="get_product_id" value="<?php echo $row1->id; ?>">

        	<div class="row">
	      		<div class="card-body col-md-3" align="right">
	      			<label class="h6"> Product Name </label>
	      		</div>
      				<div class="col-md-6">
        				<div class="card-body">
				         <input type="text" name="product_name" class="form-control" placeholder="Product Name" value="<?php echo $row1->product_name; ?>">
        				</div>
        			</div>
        	</div>
        	<div class="row">
	      		<div class="card-body col-md-3" align="right">
	      			<label class="h6"> Product SKU </label>
	      		</div>
      				<div class="col-md-6">
        				<div class="card-body">
				         <input type="text" name="product_sku" class="form-control" placeholder="Last Name" value="<?php echo $row1->product_sku; ?>" readonly >
        				</div>
        			</div>
        	</div>

<div class="row">
	      		<div class="card-body col-md-3" align="right">
	      			<label class="h6"> Primary Units </label>
	      		</div>
	      			<div class="col-md-6">
	        			<div class="card-body">
	        				<select name="primary_units" class="form-control">
							<option value=" "> Select Primary Units </option>
				          	<?php
				          	foreach($units_data->result() as $row)
				          	{
				          	?>
				          	<option value="<?php echo $row->units; ?>" <?php if($row->units == $row1->primary_units){echo "selected='selected'";} ?>><?php echo $row->units; ?></option>
				          	<?php
				          	}
				          	?>
				          </select>

	        			</div>
	        		</div>
	        	</div>

						<div class="row">
							<div class="card-body col-md-3" align="right">
								<label class="h6"> Secondary Units </label>
							</div>
								<div class="col-md-6">
									<div class="card-body">
										<select name="secondary_units" class="form-control">
								<option value=" "> Select Secondary Units </option>
											<?php
											foreach($units_data->result() as $row)
											{
											?>
											<option value="<?php echo $row->units; ?>" <?php if($row->units == $row1->secondary_units){echo "selected='selected'";} ?>><?php echo $row->units; ?></option>
											<?php
											}
											?>
										</select>
									</div>
								</div>
							</div>

        	<div class="row">
	      		<div class="card-body col-md-3" align="right">
	      			<label class="h6"> Product Description </label>
	      		</div>
      				<div class="col-md-6">
        				<div class="card-body">
				         <textarea name="product_description" class="form-control" placeholder="Product Description"> <?php if($row1->product_description){echo $row1->product_description;}else{echo "";} ?> </textarea>
        				</div>
        			</div>
        	</div>
        	
				<div class="card-body">
	      		<?php
				$count =0;
	      		if(!empty(form_error("product_name")))
						{
							$count = 1;
					?>
					<div class="row alert alert-danger">
								<strong>REQUIRED** : </strong> Product Name is Required
					</div>
					<?php
						}
						if(!empty(form_error("product_sku")))
						{
							$count = 1;
					?>
						<div class="row alert alert-danger">
								<strong>REQUIRED** : </strong> Product SKU is Required
					</div>
						<?php
							}
							if(!empty(form_error("primary_units")))
						{
							$count = 1;
					?>
					<div class="row alert alert-danger">
								<strong>REQUIRED** : </strong> Primary Unit is Required
					</div>
						<?php
							}
					if(!empty(form_error("secondary_units")))
						{
							$count = 1;
					?>
					<div class="row alert alert-danger">
								<strong>REQUIRED** : </strong> Secondary Unit is Required
					</div>
						<?php
							}
								if(!empty(form_error("product_description")))
						{
							$count = 1;
					?>
					<div class="row alert alert-danger">
								<strong>REQUIRED** : </strong> Description is Required
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
        		 <input type="submit" name="update" id="update" value="Update" class="btn btn-outline-success">
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
