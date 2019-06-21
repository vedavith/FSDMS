<div class="col-sm-6 col-md-9">
        <?php
    	if((isset($update)) && ($update == 1))
    	{
    ?>
    <div class="row">
    	<div class="col-md-6">
    		<p class="h3" align="left"> Update Units </p>
    	</div>
    	<div class="col-md-6" align="right">
    		<a class="btn btn-sm btn-outline-danger" href="<?php echo base_url()."superadmin/units_master"; ?>"> Back</a>
    	</div>
    </div><br>
    <div class="row">
    	<div class="card-body">
    		<form method="post" action="<?php echo base_url()."superadmin/update_units/".$this->uri->segment(3);?>">
    			<div class="container">
    				<div class="row">
    					<div class="col-md-2"></div>
    				<div class="col-md-6
    				"> 
    				<input type="hidden" name="update_id" class="form-control" value="<?php echo $id; ?>">
    					<input type="text" name="update_units" class="form-control" placeholder = "Enter Units" value="<?php echo $units; ?>">
    					
    				</div>
    				<div class="col-md-2" align="left">
    					<button type="submit" class="btn btn-sm btn-warning" name="cat_update" value="cat_update"> Update </button>
    				</div>
    				</div>
    		</form>
    	</div><br>
    	<?php 
    		if(!empty(form_error("update_units")))
    		{
    	?>
					<div class="alert alert-danger">
  							<strong>REQUIRED** : </strong> Units Can Not be Empty 
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
    		<p class="h3" align="left"> Create Units </p>
    	</div>
    	<div class="col-md-6" align="right">
    		<a class="btn btn-sm btn-outline-danger" href="<?php echo base_url()."superadmin/home"; ?>"> Back</a>
    	</div>
    </div><br>

    <div class="row">
    	<div class="card-body">
    		<form method="post" action="<?php echo base_url()."superadmin/create_units" ?>">
    			<div class="container">
    				<div class="row">
    					<div class="col-md-2"></div>
    				<div class="col-md-6
    				"> 
    					<input type="text" name="units" class="form-control" placeholder = "Enter Units">
    					
    				</div>
    				<div class="col-md-2" align="left">
    					<button class="btn btn-sm btn-info"> Submit </button>
    				</div>
    				</div>
    		</form>
    	</div><br>
    	<?php 
    		if(!empty(form_error("units")))
    		{
    	?>
					<div class="alert alert-danger">
  							<strong>REQUIRED** : </strong> Units Can Not be Empty  
					</div>
    	<?php		
    		}
    	?>
    </div><br>
	<?php		
    	}
    ?>
    <div class="container">
    	<table id = "table" class="table table-bordered">
			<thead>
				<tr align="center">
					<th> S.No </th>
					<th> Units </th>
					<th> Edit </th>
					<th> Delete </th>
				</tr>
			</thead>
			<tbody>
				<?php
					if($units_data->num_rows() > 0)
					{

						$i = 1;
						foreach ($units_data->result() as $units) 
						{
				?>
				<tr align="center">
					<td> <?php echo $i; ?> </td>
					<td> <?php echo $units->units; ?> </td>
					<td> <a class="btn btn-sm btn-primary" href="<?php echo base_url()."superadmin/update_units/".$units->id; ?>"> Edit </a> </td>
					<td> <a href="#" class="btn btn-sm btn-danger delete_units" id="<?php echo $units->id; ?>"> Delete </a> </td>
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

<!-- Dont Remove this closed div tag -->
    <!-- Side row closed -->
    </div>
    <!-- sidebar container fluid closed -->
</div>

<script type="text/javascript">
	$(document).ready(function(){
		$(".delete_units").click(function(){
			var id = $(this).attr("id");
			if(confirm("Are you sure you want to delete this?"))
			{
				window.location="<?php echo base_url();?>superadmin/delete_units/"+id;
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