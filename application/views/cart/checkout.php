<br><br><br><br><br>
<section class="container-fluid">
<form method="post" action="<?= base_url() ?>paypal/create_payment_with_paypal">
	<div class="container-fluid">
<?php 

$option_price = 0;
$option_product_append = "";
$sub_product_array = array();
if($show_optional_product->num_rows() != 0)
{	$x = 0;
	foreach($show_optional_product->result() as $options)
	{
		if($options->optional_name == "" && $options->optional_price == "" && $options->optional_quantity="")
		{
			$option_product_append = "No options";
		}
		else
		{
			$option_product_append = "product:".$options->optional_name."&nbsp;&nbsp;";
			$option_product_append .= "sku:".$options->optional_sku."&nbsp;&nbsp;";
			$option_product_append .= "GST(%):".$options->optional_gst."&nbsp;&nbsp;";
			$option_product_append .= "Price:".$options->optional_subtotal."&nbsp;&nbsp;";
			$option_product_append .= "Price(GST):".$options->optional_price."&nbsp;&nbsp;";
			$option_product_append .= "quantity:".$options->optional_quantity."<br>";

			$sub_product_array[$option_product_append] =  $options->optional_rowid;
			$quant_rtrim = "";
		
			if($options->optional_quantity != "")
			{
				$quant_rtrim = $options->optional_quantity;
			}
			else
			{
				$quant_rtrim = 0;
			}
			
			$option_price = $option_price + ($quant_rtrim * $options->optional_price); 
			$x++;
		}	
	}
}

// echo "<pre>";
// echo"<code> Sub product";
// print_r($sub_product_array); 
// echo "</code>";
// echo "</pre>";

$Final_array = array();               
foreach($sub_product_array as $key => $value)
{
	if(array_key_exists($value, $Final_array))
	{
  		$Final_array[$value] = $Final_array[$value]. ",".$key;
	}
	else
	{
  		$Final_array[$value] = $key;
 	}
}
// echo "<pre>";
// echo "<code>";
// print_r($Final_array);
// echo "</code>";
// echo "</pre>";

$product_price = 0;
$total = 0;

if($show_product_cart->num_rows() > 0)
{
	$x = 1;
?>
<div  id="mydiv">
	<table class="table table-bordered">
		<thead>
			<td> S.NO </td>
			<td> PRODUCT SUMMARY </td>
			<td> PRICE </td>
			<td> SUB TOTAL  </td>
		<?php 
			if($this->session->userdata('type') == 'individual')
			{
		?>
			<td> ADDRESS </td>
			
		<?php		
			}
			else
			{
		?>
			<td> Corporate Address </td>
			<td> Branch Address </td>
		<?php		
			}
		?>	
			
			<td> SUBSCRIPTION DATES </td>
			<td> Remove </td>
		</thead>
		<tbody id="reloader">

<?php
	foreach ($show_product_cart->result() as $product)
	{
?>
		<tr>
			<td> <?php echo $x; ?> </td>
			<td> 
				<?php 
				 $product_price =  $product->subtotal + ((int)$product->subtotal * (int)$product->gst/100);
					echo "Name : ".$product->name." SKU : ".$product->sku." Product GST : ".$product->gst." Product Price : ".$product->subtotal." price (Incl GST) :". $product_price."<br><br>";
					
						if(array_key_exists($product->rowid,$Final_array))
						{

							echo $Final_array[$product->rowid];	
						}
						else
						{
							echo "No options";
						}
				?>
                  <a href='#' data-toggle='collapse' data-target='#accordion<?php echo $x; ?>' class='main_summary_click clickable'> Product Summary </a> 
				<input type="hidden" class="form-control" value="<?php echo "Name : ".$product->name ?>" name="product_array[]" readonly/> 
				<input type="hidden" class="form-control" value="<?php echo $product->sku ?>" name="product_sku_array[]" readonly/> 
						
			</td>
			<td> 
				<input type="text" class="form-control" id ="rate<?php echo $x; ?>" name="price_array[]" value="<?php echo ($product->main_product_price * $product->quantity) + $product->optional_product_price; ?>" readonly> <br>
				<input type="hidden" class="form-control" name = "order_id[]" value="<?php echo $product->order_id; ?>" readonly><br>
				<input type="hidden" class="form-control" name="unique_order_id[]" value="<?php echo $product->unique_order_id; ?>"readonly> <br>
			    <input type="hidden" class = "form-control" name="row_id_array[]" value="<?php echo $product->rowid; ?>" readonly/>
			</td>
			<td> <input type="text" class="form-control sum rate<?php echo $x;?>" value="0" readonly/> </td>			
			<td>
					<select class="form-control" name ="address_array[]"> 
				<?php
					foreach($get_address->result() as $address)
					{
				?>
						<option value="<?php echo $address->address."%".$address->state."%".$address->city;?>"> <?php echo $address->address." ".$address->state." ".$address->city;?> </option>
				<?php		
					}
				?>		
					</select>
			</td>
			<?php 
				if($this->session->userdata('type') != 'individual')
				{
			?>
			<td>
					<select class="form-control" name="branch_address_array[]">
						<option value="no_branch"> No Branch </option>
			<?php
				if($get_branch_data->num_rows() > 0)
				{
					foreach($get_branch_data->result() as $branch_address)
					{
			?>
						<option value="<?php echo $branch_address->branch_address1.",".$branch_address->branch_address2.",".$branch_address->branch_address3."%".$branch_address->branch_city."%".$branch_address->branch_state; ?>"> <?php echo $branch_address->branch_address1.",".$branch_address->branch_address2.",".$branch_address->branch_address3." ".$branch_address->branch_city." ".$branch_address->branch_state; ?> </option>
			<?php			
					}
				}
				else
				{
			?>
						<option value="no_branch"> No Branch </option>
			<?php		
				}	
			?>
					<select>
			</td>		
			<?php		
				}
			?>
			<td> <input type="text" name="daterange[]" class="form-control date_ranger" data-rate = "rate<?php echo $x; ?>" value="" /></td>
			<td> <input type="button" class="btn btn-sm btn-danger delete_confirm_cart" data-prodid='<?php echo $product->unique_order_id; ?>' value="Remove"> </td>
		</tr>
		<tr class="main_summary">
             <td colspan="12">
				<div class = "container">
					<div id="accordion<?php echo $x; ?>" class="optional collapse">
					<p class="h5"> Product Summary </p>
						<table class="table table-bordered">
							<thead>
								<tr align="center">
									<th> S.No </th>
									<th> Name </th>
									<th> SKU </th>
									<th> GST(%) </th>
									<th> Price </th>
									<th> Price(Incl GST) </th>
									<th> Quantity </th>
									<th> Sub Total </th>
								</tr>
							</thead>
							<tbody>
								<tr align="center">
									<td> 1 </td>
									<td> <?php echo $product->name; ?> </td>
									<td> <?php echo $product->sku; ?> </td>
									<td> <?php echo $product->gst; ?> </td>
									<td> <?php echo $product->subtotal; ?> </td>
									<td> <?php echo $subtotal = $product->subtotal + ((int)$product->subtotal * (int)$product->gst/100); ?> </td>
									<td> <?php echo $quant = $product->quantity; ?> </td>
									<td> <?php echo $main_total =  $subtotal * $quant;?> </td>
								</tr>
								<tr>
                              		<td colspan="7" align="right"><b> Main Product Total :  </b></td>
                              		<td align="center"> <?php echo $main_total; ?> </td>
                          		</tr>
					<?php
							if(array_key_exists($product->rowid,$Final_array))
							{
								$explode_data = explode(",",$Final_array[$product->rowid]);
								$optional_sum = 0;
								for($z = 0,$counter = 1; $z < count($explode_data); $z++,$counter++)
								{
									$level_one_explode_data = explode("&nbsp;&nbsp;",$explode_data[$z]);
									$product_name = preg_split('/:/',$level_one_explode_data[0],-1);
									$product_sku = preg_split('/:/',$level_one_explode_data[1],-1);
									$product_gst = preg_split('/:/',$level_one_explode_data[2],-1);
									$product_subtotal = preg_split('/:/',$level_one_explode_data[3],-1);
									$product_price = preg_split('/:/',$level_one_explode_data[4],-1);
									
									$product_quantity = preg_split('/:/',$level_one_explode_data[5],-1);
									$qunat = explode("<br>",$product_quantity[1]);
					?>
								<tr align="center">
									<td> <?php echo $counter;  ?></td>
									<td> <?php echo $product_name[1]; ?> </td>
									<td> <?php echo $product_sku[1]; ?> </td>
									<td> <?php echo $product_gst[1]; ?> </td>
									<td> <?php echo $product_subtotal[1]; ?> </td>
									<td> <?php echo $subtotal =$product_price[1]; ?> </td>
									<td> <?php echo $quant = $qunat[0]; ?> </td>
									<td> <?php echo $optional_total = $subtotal * $quant; $optional_sum += $optional_total ?> </td>
								</tr>
					<?php				
								}
					?>
								<tr>
                              		<td colspan="7" align="right"><b> Optional Product Total :  </b></td>
                              		<td align="center"> <?php echo $optional_sum; ?> </td>
                          		</tr>
								<tr>
                              		<td colspan="7" align="right"><b> Total :  </b></td>
                              		<td align="center"> <?php echo $optional_sum + $main_total; ?> </td>
                          		</tr>
					<?php			
							}	
							else
							{
					?>
								
								<tr>
                              		<td colspan="8" align="center"><b>No Optional Products  </b></td>
                          		</tr>
					<?php
							}
					?>			
							</tbody>
						</table>
					</div>
				</div>
			</td>
		</tr>	   
<?php		
	$total+=$product->price;
	$x++;
	}
}
//echo $Final_array['4705c36f1d1651a1e4ad04d462ab9051'];        

	if($show_product_cart->num_rows() > 0)
	{

?>
		<tr>
			<td colspan="3" align="right"> Total </td>
			<!-- <td> <input type="text" class="form-control" name="details_subtotal1" value = "<?php //echo $total; ?>"  readonly> </td> -->
			<td> <input type="text" class="form-control total" name="details_subtotal" value="0"  readonly> </td>
			<td colspan="2" align="right">Pay To Checkout </td>
			<td>  
				<!-- <input type="submit" class="btn btn-sm btn-primary" name="submit_cart" value="Pay">  -->
				<button  type="submit"  class="btn btn-sm btn-success">Pay Now</button></td>
			</td>
		</tr>
		
	</tbody>
	</table>
	<?php 
	}
	else
	{
?>
	<div class="container">
		<p class="h3">
			<strong> Your Checkout Is Empty!! </strong>
		</p>	
	</div>		
<?php
	}
?>
	</div>
</div>
</form>
<br><br><br><br>
</section>

<script>
	$(function() {

$('input[name="daterange[]"]').daterangepicker({
	autoUpdateInput: false,
	 minDate:moment().add(1,"day"),
	locale: {
		cancelLabel: 'Clear'
	}
});

$('input[name="daterange[]"]').on('apply.daterangepicker', function(ev, picker) {
	$(this).val(picker.startDate.format('YYYY/MM/DD') + ' - ' + picker.endDate.format('YYYY/MM/DD'));

	var from_date = new Date(picker.startDate.format('YYYY/MM/DD'));
	var to_date = new Date(picker.endDate.format('YYYY/MM/DD'));
	var timeDiff = Math.abs(to_date.getTime() - from_date.getTime());
	
	// days difference
	var diffDays = Math.ceil(timeDiff / (1000 * 3600 * 24));
	
	var diffDaysValue = 0;
	if( diffDays == 0)
	{
		diffDaysValue = 1;
	}
	else
	{
		diffDaysValue = diffDays + 1;
	}
	
	var id_value = $(this).data('rate');

	var id_setter = '#'+id_value;
	var class_setter = '.'+id_value;
	var get_value = $(id_setter).val();
	var sub_total = get_value * diffDaysValue;
	$(class_setter).val(sub_total);

	var sum = 0;

	$('.sum').each(function(i, obj) {
    var obj_store = obj;
    sum  = sum + parseInt($(obj_store).val());
	});

	$('.total').val(sum);

});

$('input[name="daterange[]"]').on('cancel.daterangepicker', function(ev, picker) {
	$(this).val('');
});

});
</script>
<!-- calender -->
<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />




<script>
	$(document).ready(function(){
		$('.delete_confirm_cart').click(function(){
			var rowid = $(this).data('prodid');
			$.ajax({
				url : '<?php echo base_url()."cart/ajaxCallDeleteProduct"; ?>',
				method : 'post',
				data : {id_setter:rowid},
				success : function(recv){
					if(data=recv)
					{
						alert('Product Removed');
						location.reload(true);
					}
				}
			});
		});
	});


</script>