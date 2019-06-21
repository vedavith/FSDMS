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
if(!isset($get_delivery_data))
{
?>
<div class="col-sm-6 col-md-9">
    <div class="row">
    	<div class="col-md-6" align="left">
    		<p class="h3"> Create Delivery Challan</p>
    	</div>
    	<div class="col-md-3" align="right">
    		<a class="btn btn-sm btn-primary" href="<?php echo base_url()."superadmin/manage_delivery_challan"; ?>"> Manage </a>
    	</div>
    	<div class="col-md-3" align="right">
    		<a class="btn btn-sm btn-outline-danger" href="<?php echo base_url()."superadmin/home"; ?>"> Back</a>
    	</div>
    </div>
    <br>

    <form method="post" action="<?php echo base_url()."superadmin/dc_data" ?>"  id="form1">
    <div class="row container">
  <div class="container" id="accordion1">
    <div class="card">
      <div class="card-header">
        <a class="card-link" data-toggle="collapse" href="#CategoryOne">
         Create Delivery Challan
        </a>
      </div>
      <div id="CategoryOne" class="collapse show" data-parent="#accordion1">
            <div class="row">
                <div class="card-body col-md-3" align="right">
                    <label class="h6"> Kitchen Id </label>
                </div>
                    <div class="col-md-6">
                        <div class="card-body">
                            <select class="form-control" name="kitchen_name" id="kit_id">
                                      <option value=" "> Select Kitchen </option>
                                <?php
                                    foreach($kitchen_id->result() as $row)
                                    {
                                ?>
                                    <option value="<?php echo $row->k_id; ?>"> <?php echo $row->k_id.'-'. $row->k_name; ?> </option>
                                <?php        
                                    }
                                ?>      
                         </select>
                        </div>
                    </div>
                </div>
            <div class="row">
                <div class="card-body col-md-3" align="right">
                    <label class="h6"> Delivery user Id </label>
                </div>
                    <div class="col-md-6">
                        <div class="card-body">
                            <select class="form-control" name="delivery_user" id="kit_id">
                                <option value=""> Select delivery user </option>
                                <option value="1">one</option>
                                <option value="2">two</option>
                                <option value="3">three</option>
                                <option value="4">four</option>

                         </select>
                        </div>
                    </div>
            </div>
             <div class="row">
                <div class="card-body col-md-3" align="right">
                    <label class="h6"> Delivery challan Id </label>
                </div>
                    <div class="col-md-6">
                        <div class="card-body">
                            <input type="text" name="dc_no" id="dc_id" class = "form-control" placeholder="Insert Delivery challan num" value="<?php echo "DC".date("dmYhis");?>" readonly/>
                        </div>
                    </div>
            </div>
          
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
            <option data-value="<?php echo $row->product_sku."%".$row->primary_units."%".$row->store_name."%".$row->room_name.'-'.$row->grid_name.'-'.$row->bin_name."%".$row->quantity."%".$row->grid_add;?>" value="<?php echo $row->product_name; ?>"> </option>
						<?php
                    
						}
						?>
                        </datalist>
                        <script>
      							$(document).ready(function() {
      									$('#select_uid').change(function()
      									{
                            var value = $('#select_uid').val();
                             var product_combo = $('#uid [value="' + value + '"]').data('value');
                            var result = product_combo.split("%");
                            $('#product_sku').val(result[0]);
                            $('#primary_units').val(result[1]);
                            $('#store_name').val(result[2]);
                            $('#grid_combo').val(result[3]);
                            $('#stock_quantity').val(result[4]);
                            $('#grid_id').val(result[5]);
                            
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

						<!--<div class="row">
							<div class="card-body col-md-3" align="right">
								<label class="h6"> Secondary Units </label>
							</div>
								<div class="col-md-6">
									<div class="card-body">
                                    <input type="text" id="secondary_units" name="secondary_units" class="form-control" placeholder="Primary Units" readonly>										
									</div>
								</div>
							</div>-->

							<div class="row">
			      		<div class="card-body col-md-3" align="right">
			      			<label class="h6"> Select Store </label>
			      		</div>
		      				<div class="col-md-6">
		        				<div class="card-body">
                                     <input type="text" name="store_name" class="form-control" id="store_name" value=""/>
                               <!--  <select class="form-control" name="store_name" id="store_name">
                                      <option value=" "> Select Store </option>
                                <?php
                                   // foreach($store_data->result() as $row)
                                   // {
                                ?>
                                    <option value="<?php //echo $row->store_name; ?>"> <?php //echo $row->store_name; ?> </option>
                                <?php        
                                   // }
                                ?>      
                                </select> -->
		        				</div>
		        			</div>
		        	</div>

                    <div class="row">
			      		<div class="card-body col-md-3" align="right">
			      			<label class="h6"> Select Room - Grid - Bin </label>
			      		</div>
		      				<div class="col-md-6">
		        				<div class="card-body">
                                    <input type="hidden" name="grid_id" id="grid_id" value=""/>
                                    <input type="text" name="grid_combo" class="form-control" id="grid_combo" value=""/>
                                <!-- <select class="form-control" name="grid_combo" id="grid_combo">
                                      <option value=" "> Select Store First </option>
                                </select> -->
		        				</div>
		        			</div>
		        	</div>
                    <div id="show_error"></div>
                    <div class="row">
			      		<div class="card-body col-md-3" align="right">
			      			<label class="h6"> Available Quantity </label>
			      		</div>
		      				<div class="col-md-6">
		        				<div class="card-body">

                                    <input type="text" class="form-control" id="stock_quantity" name="stock_quantity" readonly/>
		        				</div>
		        			</div>
		        	</div>
                    <div class="row">
                        <div class="card-body col-md-3" align="right">
                            <label class="h6"> Delivery Quantity </label>
                        </div>
                            <div class="col-md-6">
                                <div class="card-body">
                                    <input type="number" class="form-control" id="dc_quantity" name="dc_quantity" />
                                </div>
                            </div>
                    </div>
                  <script type="text/javascript">
    
    $(document).ready(function(){
        $("#dc_quantity").change(function(){
            var get_quantity = parseInt($("#stock_quantity").val());
            var set_quantity = parseInt($("#dc_quantity").val());
            console.log(set_quantity);
            if(set_quantity > get_quantity)
            {
                alert("value must be less then stock quantity");
            }
        });
    });
        
    </script>


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
    if($get_delivery_data->num_rows() > 0)
    {
        foreach ($get_delivery_data->result() as $row5)
        {

    ?>
    <div class="col-sm-6 col-md-9">
    <div class="row">
        <div class="col-md-6" align="left">
            <p class="h3"> Edit Delivery Challan </p>
        </div>
        <div class="col-md-3" align="right">
            <a class="btn btn-sm btn-primary" href="<?php echo base_url()."superadmin/manage_delivery_challan"; ?>"> Manage </a>
        </div>
        <div class="col-md-3" align="right">
            <a class="btn btn-sm btn-outline-danger" href="<?php echo base_url()."superadmin/delivery_challan"; ?>"> Back</a>
        </div>
    </div>
    <br>

    <form method="post" action="<?php echo base_url()."superadmin/edit_delivery_challan_data" ?>"  id="form1">
    <div class="row container">
  <div class="container" id="accordion1">
    <div class="card">
      <div class="card-header">
        <a class="card-link" data-toggle="collapse" href="#CategoryOne">
         Edit Delivery Challan
        </a>
      </div>
      <div id="CategoryOne" class="collapse show" data-parent="#accordion1">
            <div class="row">
                <div class="card-body col-md-3" align="right">
                    <label class="h6"> Kitchen Id </label>
                </div>
                    <div class="col-md-6">
                        <div class="card-body">
                            <select class="form-control" name="kitchen_name" id="kit_id">
                                      <option value=" "> Select Kitchen </option>
                                <?php
                                    foreach($kitchen_id->result() as $row)
                                    {
                                ?>
                                    <option value="<?php echo $row->k_id; ?>" <?php if($row->k_id == $row5->kitchen_id) echo "selected ='selected'"; ?>> <?php echo $row->k_id.'-'. $row->k_name; ?> </option>
                                <?php        
                                    }
                                ?>      
                         </select>
                        </div>
                    </div>
                </div>
            <div class="row">
                <div class="card-body col-md-3" align="right">
                    <label class="h6"> Delivery user Id </label>
                </div>
                    <div class="col-md-6">
                        <div class="card-body">
                            <select class="form-control" name="delivery_user" id="kit_id">
                                <option value=""> Select delivery user </option>
                                <option value="1" <?php if($row5->delivery_id == "1")echo "selected ='selected'";?>> one</option>
                                <option value="2" <?php if($row5->delivery_id == "2")echo "selected ='selected'";?>>two</option>
                                <option value="3" <?php if($row5->delivery_id == "3")echo "selected ='selected'";?>>three</option>
                                <option value="4" <?php if($row5->delivery_id == "4")echo "selected ='selected'";?>>four</option>

                         </select>
                        </div>
                    </div>
            </div>
             <div class="row">
                <div class="card-body col-md-3" align="right">
                    <label class="h6"> Delivery challan Id </label>
                </div>
                    <div class="col-md-6">
                        <div class="card-body">
                            <input type="text" name="dc_no" id="dc_id" class = "form-control" placeholder="Insert Delivery challan num" value="<?php echo $row5->dc_no; ?>" readonly/>
                        </div>
                    </div>
            </div>
          
            <div class="row">
                <div class="card-body col-md-3" align="right">
                    <label class="h6"> Product Name </label>
                </div>
                    <div class="col-md-6">
                        <div class="card-body">
                        <input id = "select_uid" list = "uid" name = "product_name" class = "form-control" placeholder="Select Product" value="<?php echo $row5->product_name; ?>"/>
                        <datalist id = "uid">
                        <?php
                            foreach($get_products->result() as $row)
                            {
                               
                                
                        ?>
            <option data-value="<?php echo $row->product_sku."%".$row->primary_units."%".$row->store_name."%".$row->room_name.'-'.$row->grid_name.'-'.$row->bin_name."%".$row->quantity."%".$row->grid_add;?>" value="<?php echo $row->product_name; ?>"> </option>
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
                            $('#store_name').val(result[2]);
                            $('#grid_combo').val(result[3]);
                            $('#stock_quantity').val(result[4]);
                            $('#grid_id').val(result[5]);
                            
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
                         <input type="text" id="product_sku" name="product_sku" class="form-control" placeholder="Product SKU" readonly value="<?php echo $row5->product_sku; ?>">
                        </div>
                    </div>
            </div>

                    <div class="row">
                <div class="card-body col-md-3" align="right">
                    <label class="h6"> Primary Units </label>
                </div>
                    <div class="col-md-6">
                        <div class="card-body">
                        <input type="text" id="primary_units" name="primary_units" class="form-control" placeholder="Primary Units" readonly value="<?php echo $row5->product_units; ?>">
                        </div>
                    </div>
                </div>

                        <!--<div class="row">
                            <div class="card-body col-md-3" align="right">
                                <label class="h6"> Secondary Units </label>
                            </div>
                                <div class="col-md-6">
                                    <div class="card-body">
                                    <input type="text" id="secondary_units" name="secondary_units" class="form-control" placeholder="Primary Units" readonly>                                       
                                    </div>
                                </div>
                            </div>-->

                            <div class="row">
                        <div class="card-body col-md-3" align="right">
                            <label class="h6"> Select Store </label>
                        </div>
                            <div class="col-md-6">
                                <div class="card-body">
                                     <input type="text" name="store_name" class="form-control" id="store_name" value="<?php echo $row5->store_name; ?>"/>
                               <!--  <select class="form-control" name="store_name" id="store_name">
                                      <option value=" "> Select Store </option>
                                <?php
                                   // foreach($store_data->result() as $row)
                                   // {
                                ?>
                                    <option value="<?php //echo $row->store_name; ?>"> <?php //echo $row->store_name; ?> </option>
                                <?php        
                                   // }
                                ?>      
                                </select> -->
                                </div>
                            </div>
                    </div>

                    <div class="row">
                        <div class="card-body col-md-3" align="right">
                            <label class="h6"> Select Room - Grid - Bin </label>
                        </div>
                            <div class="col-md-6">
                                <div class="card-body">
                                    <input type="hiiden" name="grid_id" id="grid_id" value="<?php echo $row5->prod_ploc; ?>"/>
                                    <input type="text" name="grid_combo" class="form-control" id="grid_combo" value="<?php echo $row5->room_name.'-'. $row5->grid_name.'-'.$row5->bin_name; ?>"/>
                                <!-- <select class="form-control" name="grid_combo" id="grid_combo">
                                      <option value=" "> Select Store First </option>
                                </select> -->
                                </div>
                            </div>
                    </div>
                    <div id="show_error"></div>
                    <div class="row">
                        <div class="card-body col-md-3" align="right">
                            <label class="h6"> Available Quantity </label>
                        </div>
                            <div class="col-md-6">
                                <div class="card-body">
                                    <input type="text" class="form-control" id="stock_quantity" name="stock_quantity" readonly value="<?php echo $row5->available_quantity; ?>"/>
                                </div>
                            </div>
                    </div>
                    <div class="row">
                        <div class="card-body col-md-3" align="right">
                            <label class="h6"> Delivery Quantity </label>
                        </div>
                            <div class="col-md-6">
                                <div class="card-body">
                                    <input type="text" name="dc_hid" value="<?php echo $row5->dc_id; ?>"/>
                                    <input type="text" class="form-control" id="dc_quantity" name="dc_quantity" value="<?php echo $row5->product_quantity; ?>"/>
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
                 <input type="submit" name="update" id="update" value="Update" class="btn btn-outline-success">
                <!--<button type="submit" class="btn btn-outline-success"> Submit </button>-->
            </div>
            <div class="col-md-6 col-sm-3" align="left">
                <button type="reset" class="btn btn-outline-danger"> Cancel </button>
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

<script>
    /*$(document).ready(function(){
        $("#store_name").change(function(){
            var get_val = $("#store_name").val();
            $.ajax({
                url : '<?php //echo base_url()."superadmin/ajaxGetGridBinCombo"; ?>',
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
*/
   // $(document).ready(function(){
   //      $('#grid_combo').change(function(){
   //          var get_val = $("#store_name").val();
   //          console.log(get_val);
   //          var get_combo_id = $('#grid_combo').val();
   //          console.log(get_combo_id);
   //          $.ajax({
   //              url : '<?php //echo base_url()."superadmin/ajaxCheckgridAvailability" ?>',
   //              method : 'post',
   //              data : {comboIdSetter:get_combo_id,valSetter:get_val},
   //              success:function(recv){
   //                  data = recv;
   //                  if(data > 0)
   //                  {
   //                     $("#show_error").append('<div class="card-body error"><div class="row alert alert-danger"> Selected Room-Grid-Bin is Full </div></div>');
   //                     $(".hide").hide();
   //                     $('#submit').prop('disabled', true);

   //                  }
   //                  else
   //                  {
   //                      $(".error").hide();
   //                      $(".hide").show();
   //                      $('#submit').prop('disabled', false);
   //                  }
   //              }
   //          });
   //      });
   //  });
</script>


<!-- Dont Remove this closed div tag -->
    <!-- Side row closed -->
    </div>
    <!-- sidebar container fluid closed -->
</div>


<br><br><br><br><br>
