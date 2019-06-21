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
    		<p class="h3"> Create Store Products </p>
    	</div>
    	<div class="col-md-3" align="right">
    		<a class="btn btn-sm btn-primary" href="<?php echo base_url()."superadmin/manage_primary_stock_inventory"; ?>"> Manage </a>
    	</div>
    	<div class="col-md-3" align="right">
    		<a class="btn btn-sm btn-outline-danger" href="<?php echo base_url()."superadmin/home"; ?>"> Back</a>
    	</div>
    </div>
    <br>

    <form method="post" action="<?php echo base_url()."superadmin/insert_primary_stock_inventory" ?>"  id="form1">
    <div class="row container">
  <div class="container" id="accordion1">
    <div class="card">
      <div class="card-header">
        <a class="card-link" data-toggle="collapse" href="#CategoryOne">
         Create Primary Stock
        </a>
      </div>
      <div id="CategoryOne" class="collapse show" data-parent="#accordion1">

        	<div class="row">
	      		<div class="card-body col-md-3" align="right">
	      			<label class="h6"> Product Name </label>
	      		</div>
      				<div class="col-md-6">
        				<div class="card-body">
                        <input id = "select_uid" list = "uid" name = "product_name" class = "form-control" placeholder="Select Product"/>
        				<datalist id = "uid">
                        <?php
							foreach($get_products->result() as $row)
							{
						?>
            <option data-value="<?php echo $row->product_sku."%".$row->primary_units."%".$row->secondary_units;?>" value="<?php echo $row->product_name; ?>"> </option>
						<?php
						}
						?>
                        </datalist>
                        <script>
      							$(document).ready(function() {
      									$('#select_uid').change(function()
      									{
                            var value = $('#select_uid').val();
                            product_combo = $('#uid [value="' + value + '"]').data('value');
                            var result = product_combo.split("%");
                            $('#product_sku').val(result[0]);
                            $('#primary_units').val(result[1]);
                            $('#secondary_units').val(result[2]);
      									});
      								});
      </script>
                        </div>
        			</div>
        	</div>
        	<div class="row">
	      		<div class="card-body col-md-3" align="right">
	      			<label class="h6"> Product SKU </label>
	      		</div>
      				<div class="col-md-6">
        				<div class="card-body">
				         <input type="text" id="product_sku" name="product_sku" class="form-control" placeholder="Product SKU" readonly>
        				</div>
        			</div>
        	</div>

					<div class="row">
	      		<div class="card-body col-md-3" align="right">
	      			<label class="h6"> Primary Units </label>
	      		</div>
	      			<div class="col-md-6">
	        			<div class="card-body">
                        <input type="text" id="primary_units" name="primary_units" class="form-control" placeholder="Primary Units" readonly>
	        			</div>
	        		</div>
	        	</div>

						<div class="row">
							<div class="card-body col-md-3" align="right">
								<label class="h6"> Secondary Units </label>
							</div>
								<div class="col-md-6">
									<div class="card-body">
                                    <input type="text" id="secondary_units" name="secondary_units" class="form-control" placeholder="Primary Units" readonly>										
									</div>
								</div>
							</div>

							<div class="row">
			      		<div class="card-body col-md-3" align="right">
			      			<label class="h6"> Select Store </label>
			      		</div>
		      				<div class="col-md-6">
		        				<div class="card-body">
                                <select class="form-control" name="store_name" id="store_name">
                                      <option value=" "> Select Store </option>
                                <?php
                                    foreach($store_data->result() as $row)
                                    {
                                ?>
                                    <option value="<?php echo $row->store_name; ?>"> <?php echo $row->store_name; ?> </option>
                                <?php        
                                    }
                                ?>      
                                </select>
		        				</div>
		        			</div>
		        	</div>

                    <div class="row">
			      		<div class="card-body col-md-3" align="right">
			      			<label class="h6"> Select Room - Grid - Bin </label>
			      		</div>
		      				<div class="col-md-6">
		        				<div class="card-body">
                                <select class="form-control" name="grid_combo" id="grid_combo">
                                      <option value=" "> Select Store First </option>
                                </select>
		        				</div>
		        			</div>
		        	</div>
                    <div id="show_error"></div>
                    <div class="row hide">
			      		<div class="card-body col-md-3" align="right">
			      			<label class="h6"> Quantity </label>
			      		</div>
		      				<div class="col-md-6">
		        				<div class="card-body">
                                    <input type="number" class="form-control" id="stock_qunatity" name="stock_qunatity" min="1"/>
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
<script>
    $(document).ready(function(){
        $("#store_name").change(function(){
            var get_val = $("#store_name").val();
            $.ajax({
                url : '<?php echo base_url()."superadmin/ajaxGetGridBinCombo"; ?>',
                method : 'post',
                data : {valSetter:get_val},
                success:function(recv){
                    $('#grid_combo').children('option').remove();
                    $('#grid_combo').append('<option value=" "> Select Room - Grid - Bin </option>');
                    $.each(JSON.parse(recv), function (index, value) {
                        $('#grid_combo').append('<option value="' + value.id + '">' +value.room_name+'-'+value.grid_name+'-'+value.bin_name+'</option>');
                    });
                }
            });
        });
    });

    $(document).ready(function(){
        $('#grid_combo').change(function(){
            var get_val = $("#store_name").val();
            console.log(get_val);
            var get_combo_id = $('#grid_combo').val();
            console.log(get_combo_id);
            $.ajax({
                url : '<?php echo base_url()."superadmin/ajaxCheckgridAvailability" ?>',
                method : 'post',
                data : {comboIdSetter:get_combo_id,valSetter:get_val},
                success:function(recv){
                    data = recv;
                    if(data > 0)
                    {
                       $("#show_error").append('<div class="card-body error"><div class="row alert alert-danger"> Selected Room-Grid-Bin is Full </div></div>');
                       $(".hide").hide();
                       $('#submit').prop('disabled', true);

                    }
                    else
                    {
                        $(".error").hide();
                        $(".hide").show();
                        $('#submit').prop('disabled', false);
                    }
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
