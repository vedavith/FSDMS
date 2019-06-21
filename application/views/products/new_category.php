<div class="col-sm-6 col-md-9">
        <?php
    	if((isset($update)) && ($update == 1))
    	{
    ?>
    <div class="row">
    	<div class="col-md-6">
    		<p class="h3" align="left"> Update Category </p>
    	</div>
    	<div class="col-md-6" align="right">
    		<a class="btn btn-sm btn-outline-danger" href="<?php echo base_url()."superadmin/create_category"; ?>"> Back</a>
    	</div>
    </div><br>
    <div class="row">
    	<div class="card-body">
    		<form method="post" action="<?php echo base_url()."superadmin/update_category/".$this->uri->segment(3);?>">
    			<div class="container">
    				<div class="row">
    					<div class="col-md-2"></div>
    				<div class="col-md-6
    				"> 
    				<input type="hidden" name="update_id" class="form-control" value="<?php echo $id; ?>">
    					<input type="text" name="update_category" class="form-control" placeholder = "Enter Category" value="<?php echo $category_name; ?>">
    					
    				</div>
    				<div class="col-md-2" align="left">
    					<button type="submit" class="btn btn-sm btn-warning" name="cat_update" value="cat_update"> Update </button>
    				</div>
    				</div>
    		</form>
    	</div><br>
    	<?php 
    		if(!empty(form_error("update_category")))
    		{
    	?>
					<div class="alert alert-danger">
  							<strong>REQUIRED** : </strong> Category is Required 
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
    		<p class="h3" align="left"> Create Category </p>
    	</div>
    	<div class="col-md-6" align="right">
    		<a class="btn btn-sm btn-outline-danger" href="<?php echo base_url()."superadmin/home"; ?>"> Back</a>
    	</div>
    </div><br>

    <div class="row">
    	<div class="card-body">
    		<form method="post" action="<?php echo base_url()."superadmin/insert_category" ?>">
    			<div class="container">
    				<div class="row">
    					<div class="col-md-2"></div>
    				<div class="col-md-6
    				"> 
    					<input type="text" name="category" class="form-control" placeholder = "Enter Category">
    					
    				</div>
    				<div class="col-md-2" align="left">
    					<button class="btn btn-sm btn-info"> Submit </button>
    				</div>
    				</div>
    		</form>
    	</div><br>
    	<?php 
    		if(!empty(form_error("category")))
    		{
    	?>
					<div class="alert alert-danger">
  							<strong>REQUIRED** : </strong> Category is Required 
					</div>
    	<?php		
    		}
    	?>
    </div><br>
	<?php		
    	}
    ?>
    <div class="row container">
    	<table class="table table-bordered">
			<thead>
				<tr align="center">
					<th> S.No </th>
					<th> Category </th>
					<th> Edit </th>
					<th> Delete </th>
				</tr>
			</thead>
			<tbody>
				<?php
					if($category_master->num_rows() > 0)
					{

						$i = 1;
						foreach ($category_master->result() as $category) 
						{
				?>
				<tr align="center">
					<td> <?php echo $i; ?> </td>
					<td> <?php echo $category->category; ?> </td>
					<td> <a class="btn btn-sm btn-primary" href="<?php echo base_url()."superadmin/update_category/".$category->id; ?>"> Edit </a> </td>
					<td> <a href="#" class="btn btn-sm btn-danger delete_category" id="<?php echo $category->id; ?>"> Delete </a> </td>
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
		$(".delete_category").click(function(){
			var id = $(this).attr("id");
			if(confirm("Are you sure you want to delete this?"))
			{
				window.location="<?php echo base_url();?>superadmin/delete_category/"+id;
			}
			else
			{
				return false;
			}
		});
	});
</script>