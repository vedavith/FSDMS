<div class="col-sm-6 col-md-9">
        <?php
    	if(isset($get_value))
    	{
    ?>
    <div class="row">
    	<div class="col-md-6">
    		<p class="h3" align="left"> Update Meal Plan </p>
    	</div>
    	<div class="col-md-6" align="right">
    		<a class="btn btn-sm btn-outline-danger" href="<?php echo base_url()."superadmin/create_mealplan"; ?>"> Back</a>
    	</div>
    </div><br>
    <div class="row">
    	<div class="card-body">
    		<form method="post" action="<?php echo base_url()."superadmin/update_mealplan/".$this->uri->segment(3);?>">
    			<div class="container">
    				<div class="row">
    					<div class="col-md-2"></div>
    				<div class="col-md-6"> 
                        <?php
                        if($get_value->num_rows() > 0)
                       foreach($get_value->result() as $mealplan)
                         {
                        ?>
    				<input type="hidden" name="update_id" class="form-control" value="<?php echo $mealplan->id; ?>">
    					<input type="text" name="update_mealplan" class="form-control" placeholder = "Enter MealPlan" value="<?php echo $mealplan->meal_plan; ?>">
    					<?php } ?>
    				</div>
    				<div class="col-md-2" align="left">
    					<button type="submit" class="btn btn-sm btn-warning" name="meal_update" value="meal_update"> Update </button>
    				</div>
    				</div>
    		</form>
    	</div><br>
    	<?php 
    		if(!empty(form_error("update_mealplan")))
    		{
    	?>
					<div class="alert alert-danger">
  							<strong>REQUIRED** : </strong> Meal Plan is Required 
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
    		<p class="h3" align="left"> Create Meal Plan </p>
    	</div>
    	<div class="col-md-6" align="right">
    		<a class="btn btn-sm btn-outline-danger" href="<?php echo base_url()."superadmin/home"; ?>"> Back</a>
    	</div>
    </div><br>

    <div class="row">
    	<div class="card-body">
    		<form method="post" action="<?php echo base_url()."superadmin/insert_mealplan_data" ?>">
    			<div class="container">
    				<div class="row">
    					<div class="col-md-2"></div>
    				<div class="col-md-6
    				"> 
    					<input type="text" name="meal_plan" class="form-control" placeholder = "Enter meal_plan">
    					
    				</div>
    				<div class="col-md-2" align="left">
    					<button class="btn btn-sm btn-info"> Submit </button>
    				</div>
    				</div>
    		</form>
    	</div><br>
    	<?php 
    		if(!empty(form_error("meal_plan")))
    		{
    	?>
					<div class="alert alert-danger">
  							<strong>REQUIRED** : </strong> Meal Plan is Required 
					</div>
    	<?php		
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
					<th> Meal Plan </th>
					<th> Edit </th>
					<th> Delete </th>
				</tr>
			</thead>
			<tbody>
				<?php
					if($mealplan_master->num_rows() > 0)
					{

						$i = 1;
						foreach ($mealplan_master->result() as $meal) 
						{
				?>
				<tr align="center">
					<td> <?php echo $i; ?> </td>
					<td> <?php echo $meal->meal_plan; ?> </td>
					<td> <a class="btn btn-sm btn-primary" href="<?php echo base_url()."superadmin/update_mealplan/".$meal->id; ?>"> Edit </a> </td>
					<td> <a href="#" class="btn btn-sm btn-danger delete_category" id="<?php echo $meal->id; ?>"> Delete </a> </td>
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
				window.location="<?php echo base_url();?>superadmin/delete_mealplan/"+id;
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