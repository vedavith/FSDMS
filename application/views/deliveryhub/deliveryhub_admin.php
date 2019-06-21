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
if(!isset($delhub_admin_id))
{
	if(isset($dlhub_data))
	{
?>
<section>
<div class="row">
        <div class="col-md-6">
            <h3>View DeliveryHub</h3>
        </div>
        <div class="col-md-6" align="right">
        <a class="btn btn-sm btn-outline-primary" href="<?php echo base_url()."superadmin/create_deliveryhub_admin" ?>"> Add DeliveryHub Admin</a>
        </div>
    </div>
    <br>
<div class="row container">
       <div class="table-responsive">
        <table id="table" class="table table-responsive table-bordered">
            <thead>
                <tr align="center">
                    <th> S.No </th>
                   
                    <th> DeliveryHub Name</th>
                    <th> Name </th>
                    <th> Email ID</th>
                    <th> User Name</th>
                   	<th>Edit</th>
                    <th>Delete</th>

                </tr>
            </thead>
            <tbody>
                <?php
                     if($dlhub_data->num_rows() > 0)
                    {
                         $i = 1;
                         foreach ($dlhub_data->result() as $del) 
                        {
                ?>
                <tr align="center">
                    <td> <?php echo $i; ?> </td>
                  
                    <td> <?php echo $del->delhub_name; ?> </td>

                    <td> <?php echo $del->first_name.' '. $del->last_name; ?> </td>
                    <td> <?php echo $del->email_id; ?></td>
                    <td> <?php echo $del->user_name; ?></td>
                    	
                    </td>
                  
                  
                    <td> <a class="btn btn-sm btn-primary" href="<?php echo base_url()."superadmin/edit_deliveryhub_admin/".$del->id; ?>"> Edit </a> </td>
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
				window.location="<?php echo base_url();?>superadmin/delete_dlhub_admin/"+id;
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
if(!isset($delhub_admin_id) && !isset($dlhub_data))
{
?>
<div class="col-sm-6 col-md-9">
    <div class="row">
    	<div class="col-md-6" align="left">
    		<p class="h3"> Create DeliveryHub Admin </p>
    	</div>
    	<div class="col-md-3" align="right">
    		<a class="btn btn-sm btn-primary" href="<?php echo base_url()."superadmin/manage_deliveryhub_admin"; ?>"> Manage </a>
    	</div>
    	<div class="col-md-3" align="right">
    		<a class="btn btn-sm btn-outline-danger" href="<?php echo base_url()."superadmin/home"; ?>"> Back</a>
    	</div>
    </div>
    <br>

    <form method="post" action="<?php echo base_url()."superadmin/insert_dlhub_admin_data" ?>" enctype="multipart/form-data" id="form1">
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
                        <select name="delhub_id" class="form-control">
                            <option value="">Select deliveryhub id</option>
                            <?php 
                            foreach($get_delhub->result() as $dl)
                            {
                            ?>
                            <option value="<?php echo $dl->delhub_id; ?>"><?php echo $dl->delhub_id;  ?></option>
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
                    <div class="col-md-6">
                        
                         <input type="hidden" name="password" class="form-control" placeholder="Password" value="<?php echo rand(10000000,99999999)?>">
                        
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
					if(!empty(form_error("first_name")))
					{
						$count = 1;
				?>
					<div class="row alert alert-danger">
							<strong>REQUIRED** : </strong> First name is Required
				</div>
					<?php
						}
                        if(!empty(form_error("last_name")))
                    {
                        $count = 1;
                ?>
                    <div class="row alert alert-danger">
                            <strong>REQUIRED** : </strong> Last name is Required
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
                            <strong>REQUIRED** : </strong> Username is Required
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
			if($error == "DHADMIN")
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
if(!isset($dlhub_data))
{
if(isset($delhub_admin_id))
{
	foreach ($delhub_admin_id->result() as $row)
	{
?>
	<div class="col-sm-6 col-md-9">
    <div class="row">
    	<div class="col-md-6" align="left">
    		<p class="h3"> Edit DeliveryHub Admin </p>
    	</div>
    	<div class="col-md-3" align="right">
    		<a class="btn btn-sm btn-primary" href="<?php echo base_url()."superadmin/manage_deliveryhub_admin"; ?>"> Manage </a>
    	</div>
    	<div class="col-md-3" align="right">
    		<a class="btn btn-sm btn-outline-danger" href="<?php echo base_url()."superadmin/home"; ?>"> Back</a>
    	</div>
    </div>
    <br>

    <form method="post" action="<?php echo base_url()."superadmin/edit_delhub_admin_data" ?>" enctype="multipart/form-data" id="form1">
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
        				<select name="delhub_id" class="form-control">
                            <option value="">Select deliveryhub id</option>
                            <?php 
                           foreach($get_delhub->result() as $dl)
                           {
                            ?>
                            <option value="<?php echo $dl->delhub_id;?>" <?php if($dl->delhub_id == $row->delhub_id) echo "selected ='selected'"?>><?php echo $dl->delhub_id;  ?></option>
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
				         <input type="text" name="first_name" class="form-control" placeholder="First Name" value="<?php echo $row->first_name; ?>">
        				</div>
        			</div>
        	</div>
            <div class="row">
                <div class="card-body col-md-3" align="right">
                    <label class="h6"> Last Name </label>
                </div>
                    <div class="col-md-6">
                        <div class="card-body">
                         <input type="text" name="last_name" class="form-control" placeholder="Last Name" value="<?php echo $row->last_name; ?>">
                        </div>
                    </div>
            </div>
            <div class="row">
                <div class="card-body col-md-3" align="right">
                    <label class="h6"> Email Id </label>
                </div>
                    <div class="col-md-6">
                        <div class="card-body">
                         <input type="text" name="email" class="form-control" placeholder="Email Id" value="<?php echo $row->email_id; ?>">
                        </div>
                    </div>
            </div>
            <div class="row">
                <div class="card-body col-md-3" align="right">
                    <label class="h6"> User Name </label>
                </div>
                    <div class="col-md-6">
                        <div class="card-body">
                         <input type="text" name="user_name" class="form-control" placeholder="User Name" value="<?php echo $row->user_name; ?>">
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
                    if(!empty(form_error("first_name")))
                    {
                        $count = 1;
                ?>
                    <div class="row alert alert-danger">
                            <strong>REQUIRED** : </strong> First name is Required
                </div>
                    <?php
                        }
                        if(!empty(form_error("last_name")))
                    {
                        $count = 1;
                ?>
                    <div class="row alert alert-danger">
                            <strong>REQUIRED** : </strong> Last name is Required
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
                            <strong>REQUIRED** : </strong> Username is Required
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
        		<a href="<?php echo base_url()."superadmin/manage_deliveryhub_admin"; ?>" class="btn btn-outline-danger"> Cancel </a>
        		
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


