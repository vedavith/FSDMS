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
<div class="col-sm-6 col-md-9">
    <div class="row">
    	<div class="col-md-6" align="left">
    		<p class="h3"> Create Kitchen Inventory </p>
    	</div>
    	<div class="col-md-3" align="right">
    		<a class="btn btn-sm btn-primary" href="<?php echo base_url()."superadmin/manage_kitchen_inventory"; ?>"> Manage </a>
    	</div>
    	<div class="col-md-3" align="right">
    		<a class="btn btn-sm btn-outline-danger" href="<?php echo base_url()."superadmin/kitchen_inventory"; ?>"> Back</a>
    	</div>
    </div>
    <br>

    <form method="post" action="<?php echo base_url()."superadmin/create_kitchen_inventory" ?>" enctype="multipart/form-data" id="form1">
    	<div class="row container">
		<div class="container" id="accordion1">
		    <div class="card">
		      <div class="card-header">
		        <a class="card-link" data-toggle="collapse" href="#kitchenOne">
		        	Kitchen Inventory
		        </a>
		      </div>
		      <div id="kitchenOne" class="collapse show" data-parent="#accordion1">
		        <div class="card-body">
		          <div class="row">
		          	<div class="col-md-3"></div>
		          	<div class="col-md-3">
		          		<label> Kitchen ID </label>
		          	</div>
		          	<div class="col-md-3" align="left">
		          		<select class="form-control" id="kitchen_id" name = "kitchen_id">
		          			<option value = " "> Select Kitchen ID </option>
		          	<?php
		          		if($get_kitchen_id->num_rows() > 0)
		          		{
		          			foreach($get_kitchen_id->result() as $kitchen_details)
		          			{
		          	?>
		          			<option value="<?php echo $kitchen_details->k_id; ?>"><?php echo $kitchen_details->k_id; ?></option>
		          	<?php
		          			}
		          		}
		          	?>		
		          		</select>
		          	</div>
		          	<div class="col-md-3"></div>
		          </div><br>
				  <div id = "product_combo">
		          <div class="row">
		          	<div class="col-md-3">
		          		<select id="product_name" class="form-control" name="product_name[]">
		          			<option value=" "> Select Product </option>
		          	<?php 
		          		if($get_kitchen_products->num_rows() > 0)
		          		{
		          			foreach($get_kitchen_products->result() as $kitchen_data)
		          			{
		          	?>
		          			<option value="<?php echo $kitchen_data->product_name; ?>"><?php echo $kitchen_data->product_name; ?></option>
		          	<?php			
		          			}
		          		}
		          	?>		
		          		</select>
		          	</div>
		          	<div class="col-md-3">
		          		<select id="units_name" class="form-control" name="units_name[]">
		          			<option value=" "> Select Units </option>
		          	<?php 
		          		if($get_units_master->num_rows() > 0)
		          		{
		          			foreach($get_units_master->result() as $units)
		          			{
		          	?>
		          			<option value = "<?php echo $units->units; ?>"> <?php echo $units->units; ?> </option>
		          	<?php
		          			}
		          		}
		          	?>
		          		</select>
		          	</div>
		          	<div class="col-md-2">
		          		<input type="text" id="product_sku" class="form-control" name="product_sku[]" placeholder="Product SKU">
		          	</div>
		          	<div class="col-md-2">
		          		<input type="text" id="quantity" class="form-control" name="quantity[]" placeholder="Quantity">
		          	</div>
		          	<div class="col-md-1">
		          		<input type="button" class="btn btn-sm btn-success" id="add_product" value="Add Row">
		          	</div>
		          </div><br>
		      	  </div>
		      	  <div class="ajax_error"></div>
		      	  <?php

		      	  		$count = 0;
						if(!empty(form_error("kitchen_id")))
						{
							$count++;
					?>
					<div class="alert alert-danger">
  							<strong>REQUIRED** : </strong> Kitchen ID Required 
					</div>
					<?php				
						}
					?>
					 <?php
		      	  		
						if(!empty(form_error("product_name[]")))
						{
							$count++;
					?>
					<div class="alert alert-danger">
  							<strong>REQUIRED** : </strong> Product Name Required 
					</div>
					<?php				
						}
					?>
					 <?php
		      	  		
						if(!empty(form_error("units_name[]")))
						{
							$count++
					?>
					<div class="alert alert-danger">
  							<strong>REQUIRED** : </strong> Units Required 
					</div>
					<?php				
						}
					?>
					 <?php
		      	  		
						if(!empty(form_error("product_sku[]")))
						{
							$count++
					?>
					<div class="alert alert-danger">
  							<strong>REQUIRED** : </strong> Product SKU Required 
					</div>
					<?php				
						}
					?>
					 <?php
		      	  		
						if(!empty(form_error("quantity[]")))
						{
							$count++;
					?>
					<div class="alert alert-danger">
  							<strong>REQUIRED** : </strong> Quantity Required 
					</div>
					<?php				
						}
						?>
					<?php
		      	  		
						if(isset($error))
						{
							$count++;
					?>
					<div class="alert alert-danger">
  							<strong>ERROR(Invalid Inventory Operation) : </strong><?php echo $error; ?>
  						</div>
					<?php				
						}
						if($count)
						{
					?>
						<script>
								$(document).ready(function(){
									$("#kitchenOne").addClass("show");
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
		        <a class="collapsed card-link" data-toggle="collapse" href="#kitchenTwo">
		       Submit
		      </a>
		      </div>
		      <div id="kitchenTwo" class="collapse" data-parent="#accordion1">
		        <div class="card-body">
		         <div class="row">
		         	<div class="col-md-6" align ="right">
		         		<button type="submit" class="btn btn-outline-success" name="submit_kitchen_inventory"> Submit </button>  
		         	</div>
		         	<div class="col-md-6" align ="left">
		         		<a class="btn btn-outline-danger" href="#"> Cancel </a>
		         	</div>
		         </div>
		        </div>
		      </div>
		    </div>
		  </div>
    	</div>
    </form>
    <?php 

    	$set_json_kitchen_products = null;
    	$set_json_units = null;

    	if($get_kitchen_products->num_rows() > 0)
    	{
    		
    		$set_json_kitchen_products = json_encode($get_kitchen_products->result());
    		
    	}

    	if($get_units_master->num_rows() > 0)
    	{

    		$set_json_units = json_encode($get_units_master->result());

    	}
    ?>
    <script type="text/javascript">
    	var count = 0;
    	$(document).ready(function(){
    		
    		$('#add_product').click(function() {
				count++;

$('#product_combo').append('<div class="row"><div class="col-md-3"><select id="product_name'+count+'" class="form-control" name="product_name[]"><option value=" "> Select Product </option></select></div><div class="col-md-3"><select id="units_name'+count+'" class="form-control" name="units_name[]"><option value=" "> Select Units </option></select></div><div class="col-md-2"><input type="text" id="product_sku'+count+'" class="form-control" name="product_sku[]" placeholder="Product SKU"></div><div class="col-md-2"><input id="quantity'+count+'" type="text" class="form-control" name="quantity[]" placeholder="Quantity"></div><div class="col-md-1"><input type="button" class="btn btn-sm btn-danger" id="remove_product" value="Remove"></div></div><br>');

		var url1 = <?php echo $set_json_kitchen_products; ?>;
		 // console.log(url1);
		var url2 = <?php echo $set_json_units; ?>;
		// console.log(url2);

        var str = "#product_name"+count;
                $.each(url1, function (index, value) {
                        $(str).append('<option value="' + value.product_name + '">' + value.product_name + '</option>');
                    });

        var str = "#units_name"+count;
                $.each(url2, function (index, value) {
                        $(str).append('<option value="' + value.units + '">' + value.units + '</option>');
                    });
				var storeCount = count;
   			var prevSkuId = "#product_sku"+(storeCount-1);
				var get_sku_id ="#product_sku"+count;
				var get_product_name = "#product_name"+count;

   			$(get_sku_id).on('change',function(){

					 if(($(get_sku_id).val() == $(prevSkuId).val()) || ($(get_sku_id).val() == $('#product_sku').val()))
						{
						alert('Same SKU Cannot Be Entered');
						$(get_sku_id).val("");
						}
					var get_kitchen_id = $('#kitchen_id').val();
					var get_product_value = $(get_product_name).val();
					var get_sku_value = $(get_sku_id).val();

					// console.log(get_sku_value);
					$.ajax({
						url: '<?php echo base_url()."superadmin/ajaxCallCheckSku"; ?>',
						method:"POST",
						data:{ajax_kitchen_id:get_kitchen_id,ajax_product_name:get_product_value,ajax_sku:get_sku_value},
						success: function(resp){
							 data = resp;
							 // console.log(data);
							 if(data != 0)
							 {
							 	//console.log(data);
							 	$(get_sku_id).val("");
							 	$(get_product_name).prop("selectedIndex", 0);

							 	alert("ERROR(SAE) : SKU Already Exists");							 	
							 }
							 else
							 {
							 	$(".ajax_error").html();
							 }
						},
  						error: (error) => {
                     	console.log(JSON.stringify(error));
   							}		
					});

	    		});

    		});

    	});

   
    	$("#product_combo").on('click','#remove_product',function(){
			$(this).parent().parent().remove();
		});

		$(document).ready(function(){
			$("#product_sku").on('change',function(){
				var get_kitchen_id = $('#kitchen_id').val();
				var get_product_value = $('#product_name').val();
				var get_sku_value = $('#product_sku').val(); 

				$.ajax({
						url: '<?php echo base_url()."superadmin/ajaxCallCheckSku"; ?>',
						method:"POST",
						data:{ajax_kitchen_id:get_kitchen_id,ajax_product_name:get_product_value,ajax_sku:get_sku_value},
						success: function(resp){
							 data = resp;
							 // console.log(data);
							 if(data != 0)
							 {
							 	//console.log(data);
							 	$('#product_sku').val("");
							 	$('#product_name').prop("selectedIndex", 0);

							 	alert("ERROR(SAE) : SKU Already Exists");							 	
							 }
							 else
							 {
							 	$(".ajax_error").html();
							 }
						},
  						error: (error) => {
                     	console.log(JSON.stringify(error));
   							}		
					});

			});
		});

    </script>

<!-- Dont Remove this closed div tag -->
    <!-- Side row closed -->
    </div>
    <!-- sidebar container fluid closed -->
</div>


<br><br><br><br><br>


