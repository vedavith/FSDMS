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
if(!isset($delhub_reg_id))
{
	if(isset($del_data))
	{
?>
<section>
<div class="row">
        <div class="col-md-6">
            <h3>View DeliveryHub</h3>
        </div>
        <div class="col-md-6" align="right">
        <a class="btn btn-sm btn-outline-primary" href="<?php echo base_url()."superadmin/create_deliveryhub" ?>"> Add DeliveryHub</a>
        </div>
    </div>
    <br>
<div class="row container">
       <div class="table-responsive">
        <table id="table" class="table table-responsive table-bordered">
            <thead>
                <tr align="center">
                    <th> S.No </th>
                   
                    <th> DeliveryHub Id</th>
                    <th> DeliveryHub Name </th>
                    <th> DeliveryHub Address</th>
                   	<th>Edit</th>
                    <th>Delete</th>

                </tr>
            </thead>
            <tbody>
                <?php
                     if($del_data->num_rows() > 0)
                    {
                         $i = 1;
                         foreach ($del_data->result() as $del) 
                        {
                ?>
                <tr align="center">
                    <td> <?php echo $i; ?> </td>
                  
                    <td> <?php echo $del->delhub_id; ?> </td>

                    <td> <?php echo $del->delhub_name; ?> </td>
                    <td> <?php echo $del->dh_address1.','.$del->dh_address2.','.$del->dh_address3.','.$del->city.','.$del->state.','.$del->zipcode; ?>
                    	
                    </td>
                  
                  
                    <td> <a class="btn btn-sm btn-primary" href="<?php echo base_url()."superadmin/edit_deliveryhub/".$del->id; ?>"> Edit </a> </td>
                    <td> <a href="#" class="btn btn-sm btn-danger delete_category" id="<?php echo $del->id; ?>"> Delete </a> </td>
                </tr>
                <?php
                        $i++;
                        }
                    }
                ?>
            </tbody>            
        </table>
    </div>
    </div>
    <br><br><br><br>

    <script type="text/javascript">
	$(document).ready(function(){
		$(".delete_category").click(function(){
			var id = $(this).attr("id");
			if(confirm("Are you sure you want to delete this?"))
			{
				window.location="<?php echo base_url();?>superadmin/delete_deliveryhub/"+id;
			}
			else
			{
				return false;
			}
		});
	});
</script>

<script>
$(document).ready(function() {
    $('#table').DataTable();
} );
</script>

    </section>
<?php
}
}
?>
<?php
if(!isset($delhub_reg_id) && !isset($del_data))
{
?>
<div class="col-sm-6 col-md-9">
    <div class="row">
    	<div class="col-md-6" align="left">
    		<p class="h3"> Create DeliveryHub </p>
    	</div>
    	<div class="col-md-3" align="right">
    		<a class="btn btn-sm btn-primary" href="<?php echo base_url()."superadmin/manage_deliveryhub"; ?>"> Manage </a>
    	</div>
    	<div class="col-md-3" align="right">
    		<a class="btn btn-sm btn-outline-danger" href="<?php echo base_url()."superadmin/home"; ?>"> Back</a>
    	</div>
    </div>
    <br>

    <form method="post" action="<?php echo base_url()."superadmin/insert_deliveryhub_data" ?>" enctype="multipart/form-data" id="form1">
    <div class="row container">
  <div class="container" id="accordion1">
    <div class="card">
      <div class="card-header">
        <a class="card-link" data-toggle="collapse" href="#CategoryOne">
         Deliveryhub ID/Name
        </a>
      </div>
      <div id="CategoryOne" class="collapse show" data-parent="#accordion1">
      	<div class="row">
      		<div class="card-body col-md-3" align="right">
      			<label class="h6"> Delivery ID </label>
      		</div>
      			<div class="col-md-6">
        			<div class="card-body">
        				<input type="text" name="delhub_id" class="form-control" placeholder="Deliveryhub ID">
        			</div>
        		</div>
        	</div>

        	<div class="row">
	      		<div class="card-body col-md-3" align="right">
	      			<label class="h6"> Deliveryhub Name </label>
	      		</div>
      				<div class="col-md-6">
        				<div class="card-body">
				         <input type="text" name="delhub_name" class="form-control" placeholder="Deliveryhub Name">
        				</div>
        			</div>
        	</div>
        	
		<div class="card-body">
      	<?php
			$count =0;
      		if(!empty(form_error("delhub_id")))
					{
						$count = 1;
				?>
				<div class="row alert alert-danger">
							<strong>REQUIRED** : </strong> Delivery Id is Required
				</div>
				<?php
					}
					if(!empty(form_error("delhub_name")))
					{
						$count = 1;
				?>
					<div class="row alert alert-danger">
							<strong>REQUIRED** : </strong> Delivery name is Required
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
        DeliveryHub Address
      </a>
      </div>
      <div id="CategoryTwo" class="collapse" data-parent="#accordion1">
        <div class="row">
        	<div class="card-body col-md-3" align="right"> <label class="h6"> DeliveryHub Address </label> </div>
        	<div class="card-body col-md-6" align="left">
        		<input type="text" name="delhub_address1" class="form-control" placeholder="Deliveryhub Address1"> </br>
				<input type="text" name="delhub_address2" class="form-control" placeholder="Deliveryhub Address2"></br>
        		<input type="text" name="delhub_address3" class="form-control" placeholder="Deliveryhub Address3">
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

						      		if(!empty(form_error("delhub_address1")))
											{
												$count = 1;
										?>
										<div class="row alert alert-danger">
													<strong>REQUIRED** : </strong> Deliveryhub address1 is Required
										</div>
										<?php
											}
											if(!empty(form_error("delhub_address2")))
											{
												$count = 1;
										?>
											<div class="row alert alert-danger">
													<strong>REQUIRED** : </strong> Deliveryhub address2 is Required
										</div>

											<?php
										}
										if(!empty(form_error("delhub_address3")))
											{
												$count = 1;
											?>
											<div class="row alert alert-danger">
													<strong>REQUIRED** : </strong> Deliveryhub address3 is Required
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
			if($error == "DELHUB")
			{
		?>
		<br>
		<div class="container-fluid">
			<div class="alert alert-danger">
					<strong> ERROR(<?php echo $error; ?>) : </strong> Delivery Hub Details Already Exists
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
if(!isset($del_data))
{
if(isset($delhub_reg_id))
{
	foreach ($delhub_reg_id->result() as $row)
	{
?>
	<div class="col-sm-6 col-md-9">
    <div class="row">
    	<div class="col-md-6" align="left">
    		<p class="h3"> Edit DeliveryHub </p>
    	</div>
    	<div class="col-md-3" align="right">
    		<a class="btn btn-sm btn-primary" href="<?php echo base_url()."superadmin/manage_deliveryhub"; ?>"> Manage </a>
    	</div>
    	<div class="col-md-3" align="right">
    		<a class="btn btn-sm btn-outline-danger" href="<?php echo base_url()."superadmin/home"; ?>"> Back</a>
    	</div>
    </div>
    <br>

    <form method="post" action="<?php echo base_url()."superadmin/edit_deliveryhub_data" ?>" enctype="multipart/form-data" id="form1">
    <div class="row container">
  <div class="container" id="accordion1">
    <div class="card">
      <div class="card-header">
        <a class="card-link" data-toggle="collapse" href="#CategoryOne">
         Deliveryhub ID/Name
        </a>
      </div>
      <div id="CategoryOne" class="collapse show" data-parent="#accordion1">
      	<div class="row">
      		<div class="card-body col-md-3" align="right">
      			<label class="h6"> Delivery ID </label>
      		</div>
      			<div class="col-md-6">
        			<div class="card-body">
        				<input type="hidden" name="hid_id" value="<?php echo $row->id; ?>">
        				<input type="text" name="delhub_id" class="form-control"placeholder="Deliveryhub ID" value="<?php echo $row->delhub_id; ?>">
        			</div>
        		</div>
        	</div>

        	<div class="row">
	      		<div class="card-body col-md-3" align="right">
	      			<label class="h6"> Deliveryhub Name </label>
	      		</div>
      				<div class="col-md-6">
        				<div class="card-body">
				         <input type="text" name="delhub_name" class="form-control" placeholder="Deliveryhub Name" value="<?php echo $row->delhub_name; ?>">
        				</div>
        			</div>
        	</div>
        	
		<div class="card-body">
      	<?php
			$count =0;
      		if(!empty(form_error("delhub_id")))
					{
						$count = 1;
				?>
				<div class="row alert alert-danger">
							<strong>REQUIRED** : </strong> Delivery Id is Required
				</div>
				<?php
					}
					if(!empty(form_error("delhub_name")))
					{
						$count = 1;
				?>
					<div class="row alert alert-danger">
							<strong>REQUIRED** : </strong> Delivery name is Required
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
        DeliveryHub Address
      </a>
      </div>
      <div id="CategoryTwo" class="collapse" data-parent="#accordion1">
        <div class="row">
        	<div class="card-body col-md-3" align="right"> <label class="h6"> DeliveryHub Address </label> </div>
        	<div class="card-body col-md-6" align="left">
        		<input type="text" name="delhub_address1" class="form-control" placeholder="Deliveryhub Address1" value="<?php echo $row->dh_address1; ?>"> </br>
				<input type="text" name="delhub_address2" class="form-control" placeholder="Deliveryhub Address2" value="<?php echo $row->dh_address2; ?>"></br>
        		<input type="text" name="delhub_address3" class="form-control" placeholder="Deliveryhub Address3" value="<?php echo $row->dh_address3; ?>">
        	</div>
    	</div>
    	<div class="row">
        	<div class="card-body col-md-3" align="right"> <label class="h6"> State </label> </div>
        	<div class="card-body col-md-6" align="left">
        		<input type="text" name="state" class="form-control" placeholder="State" value="<?php echo $row->state; ?>">
        	</div>
    	</div>
    	<div class="row">
        	<div class="card-body col-md-3" align="right"> <label class="h6"> City </label> </div>
        	<div class="card-body col-md-6" align="left">
        		<input type="text" name="city" class="form-control" placeholder="City" value="<?php echo $row->city; ?>">
        	</div>
    	</div>
    	<div class="row">
        	<div class="card-body col-md-3" align="right"> <label class="h6"> Zipcode </label> </div>
        	<div class="card-body col-md-6" align="left">
        		<input type="text" name="zipcode" class="form-control" placeholder="Zip code" value="<?php echo $row->zipcode; ?>">
        	</div>
    	</div>
			
    	
						      <div class="card-body">
						      	<?php
										$count = 0;
										$customize = 0;

						      		if(!empty(form_error("delhub_address1")))
											{
												$count = 1;
										?>
										<div class="row alert alert-danger">
													<strong>REQUIRED** : </strong> Deliveryhub address1 is Required
										</div>
										<?php
											}
											if(!empty(form_error("delhub_address2")))
											{
												$count = 1;
										?>
											<div class="row alert alert-danger">
													<strong>REQUIRED** : </strong> Deliveryhub address2 is Required
										</div>

											<?php
										}
										if(!empty(form_error("delhub_address3")))
											{
												$count = 1;
											?>
											<div class="row alert alert-danger">
													<strong>REQUIRED** : </strong> Deliveryhub address3 is Required
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
        		 <input type="submit" name="update" id="update" value="Update" class="btn btn-outline-success">
        		<!--<button type="submit" class="btn btn-outline-success"> Submit </button>-->
        	</div>
        	<div class="col-md-6 col-sm-3" align="left">
        		<a href="<?php echo base_url()."superadmin/manage_deliveryhub"; ?>" class="btn btn-outline-danger"> Cancel </a>
        		
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


