<div class="col-sm-6 col-md-9">
        <?php
    	if(isset($get_value))
    	{
    ?>
    <div class="row">
    	<div class="col-md-6">
    		<p class="h3" align="left"> Update Grid </p>
    	</div>
    	<div class="col-md-6" align="right">
    		<a class="btn btn-sm btn-outline-danger" href="<?php echo base_url()."deliveryhub/create_role"; ?>"> Back</a>
    	</div>
    </div><br>
    <div class="row">
    	<div class="card-body">
    		<form method="post" action="<?php echo base_url()."deliveryhub/update_role/".$this->uri->segment(3);?>">
    			<div class="container">
    				<div class="row">
    					<div class="col-md-2"></div>
    				<div class="col-md-6"> 
                        <?php
                        if($get_value->num_rows() > 0)
                       foreach($get_value->result() as $role)
                         {
                        ?>
    				<input type="hidden" name="update_id" class="form-control" value="<?php echo $role->id; ?>">
    					<input type="text" name="update_role" class="form-control" placeholder = "Enter room" value="<?php echo $role->role_name; ?>">
    					<?php } ?>
    				</div>
    				<div class="col-md-2" align="left">
    					<button type="submit" class="btn btn-sm btn-warning" name="role_update" value="role_update"> Update </button>
    				</div>
    				</div>
    		</form>
    	</div><br>
    	<?php 
    		if(!empty(form_error("update_role")))
    		{
    	?>
					<div class="alert alert-danger">
  							<strong>REQUIRED** : </strong> Role Name is Required 
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
    		<a class="btn btn-sm btn-outline-danger" href="<?php echo base_url()."deliveryhub/deliveryhub_home"; ?>"> Back</a>
    	</div>
    </div><br>

    <div class="row">
    	<div class="card-body">
    		<form method="post" action="<?php echo base_url()."deliveryhub/insert_role_data" ?>">
    			<div class="container">
    				<div class="row">
    					<div class="col-md-2"></div>
    				<div class="col-md-6
    				"> 
    					<input type="text" name="role_name" class="form-control" placeholder = "Enter Role Name">
    					
    				</div>
    				<div class="col-md-2" align="left">
    					<button class="btn btn-sm btn-info"> Submit </button>
    				</div>
    				</div>
    		</form>
    	</div><br>
    	<?php 
    		if(!empty(form_error("role_name")))
    		{
    	?>
					<div class="alert alert-danger">
  							<strong>REQUIRED** : </strong> Role name is Required 
					</div>
    	<?php		
    		}
    	?>
        <?php
        if(isset($error))
        {
            if($error == "DROLE")
            {
        ?>
        <br>
        <div class="container-fluid">
            <div class="alert alert-danger">
                    <strong> ERROR(<?php echo $error; ?>) : </strong> Role Already Exists
            </div>
        </div>
        <?php
            }
        }
        ?>
    </div><br>
	<?php		
    	}
    ?>
    <div class="row container">
        <div class="table-responsive">
    	<table id="table" class="table table-bordered">
			<thead>
				<tr align="center">
					<th> S.No </th>
					<th> Role Name </th>
					<th> Edit </th>
					<th> Delete </th>
				</tr>
			</thead>
			<tbody>
				<?php
					if($get_role->num_rows() > 0)
					{

						$i = 1;
						foreach ($get_role->result() as $role) 
						{
				?>
				<tr align="center">
					<td> <?php echo $i; ?> </td>
					<td> <?php echo $role->role_name; ?> </td>
					<td> <a class="btn btn-sm btn-primary" href="<?php echo base_url()."deliveryhub/update_role/".$role->id; ?>"> Edit </a> </td>
					<td> <a href="#" class="btn btn-sm btn-danger delete_category" id="<?php echo $role->id; ?>"> Delete </a> </td>
				</tr>
				<?php
					 	$i++;
					 	}
					 }
				?>
			</tbody>    		
    	</table>
        <br/>
        <br/>
        <br/>
    </div>
    </div>	
</div>

<!-- Dont Remove this closed div tag -->
    <!-- Side row closed -->
    </div>
    <!-- sidebar container fluid closed -->
</div>

<script type="text/javascript">
	$(document).ready(function(){
		$(".delete_category").click(function(){
			var id = $(this).attr("id");
			if(confirm("Are you sure you want to delete this?"))
			{
				window.location="<?php echo base_url();?>deliveryhub/delete_role/"+id;
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