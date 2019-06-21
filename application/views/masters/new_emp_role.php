<div class="col-sm-6 col-md-9">
        <?php
    	if((isset($update)) && ($update == 1))
    	{
    ?>
     <div class="row">
    	<div class="col-md-6">
    		<p class="h3" align="left"> Update Role </p>
    	</div>
    	<div class="col-md-6" align="right">
    		<a class="btn btn-sm btn-outline-danger" href="<?php echo base_url()."kitchen/create_emp_role"; ?>"> Back</a>
    	</div>
    </div><br>
    <div class="row">
    	<div class="card-body">
    		<form method="post" action="<?php echo base_url()."kitchen/update_emp_role/";?>">
    			<div class="container">
    				<div class="row">
    					<div class="col-md-2"></div>
    				<div class="col-md-6
    				">
    				<input type="hidden" name="update_id" class="form-control" value="<?php echo $id; ?>">
    					<input type="text" name="update_role" class="form-control" placeholder = "Enter Role" value="<?php echo $role_name; ?>">

    				</div>
    				<div class="col-md-2" align="left">
    					<button type="submit" class="btn btn-sm btn-warning" name="cat_update" value="cat_update"> Update </button>
    				</div>
    				</div>
    		</form>
    	</div><br>
    	<?php
    		if(!empty(form_error("update_role")))
    		{
    	?>
					 <div class="alert alert-danger">
  							<strong>REQUIRED** : </strong> Role is Required
					</div>
    	<?php
    		}
    	?>
     </div><br>
    <?php
    	}
    	else
    	{
	?>
	<div class="row">
    	<div class="col-md-6">
    		<p class="h3" align="left"> Create Role </p>
    	</div>
    	<div class="col-md-6" align="right">
    		<a class="btn btn-sm btn-outline-danger" href="<?php echo base_url()."kitchen/kitchen_home"; ?>"> Back</a>
    	</div>
    </div><br>

    <div class="row">
    	<div class="card-body">
    		<form method="post" action="<?php echo base_url()."kitchen/insert_emp_role" ?>">
    			<div class="container">
    				<div class="row">
    					<div class="col-md-2"></div>
    				<div class="col-md-6
    				">
    					<input type="text" name="emp_role" class="form-control" placeholder = "Enter Role">

    				</div>
    				<div class="col-md-2" align="left">
    					<button class="btn btn-sm btn-info"> Submit </button>
    				</div>
    				</div>
    		</form>
    	</div><br>
    	<?php
    		if(!empty(form_error("emp_role")))
    		{
    	?>
					<div class="alert alert-danger">
  							<strong>REQUIRED** : </strong> Role is Required
					</div>
    	<?php
    		}
    	?>
    </div><br>
	<?php
    	}
    ?>
    <div class="container">
    	<table id="table" class="table table-bordered">
			<thead>
				<tr align="center">
					<th> S.No </th>
					<th> Role </th>
					<th> Edit </th>
					<th> Delete </th>
				</tr>
			</thead>
			<tbody>
				<?php
					if($emp_role_master->num_rows() > 0)
					 {
					 	$i = 1;
					 	foreach ($emp_role_master->result() as $role)
					 	{
				?>
				<tr align="center">
				    <td> <?php echo $i; ?> </td>
					<td> <?php echo $role->emp_role; ?> </td>
					<td> <a class="btn btn-sm btn-primary" href="<?php echo base_url()."kitchen/update_emp_role/".$role->id; ?>"> Edit </a> </td>
					<td> <a href="#" class="btn btn-sm btn-danger delete_role" id="<?php echo $role->id; ?>"> Delete </a> </td>
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
<!-- Dont Remove this closed div tag -->
    <!-- Side row closed -->
    </div>
    <!-- sidebar container fluid closed -->
</div>

<script type="text/javascript">
	$(document).ready(function(){
		$(".delete_role").click(function(){
			var id = $(this).attr("id");
			if(confirm("Are you sure you want to delete this?"))
			{
				window.location="<?php echo base_url();?>kitchen/delete_role/"+id;
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