<br><br><br><br><br><br>

<style>
.veg-square {    
	height: 30px;
    width: 30px;
    display: -webkit-inline-box;
    border-color: green;
    border-style:solid;
}
.veg-circle
{
	height : 20%;
	background: green;
  	border-radius: 100%;
    width:40%;
    height:40%;
    margin : 30%
}

.nonveg-square {    
	height: 30px;
    width: 30px;
    display: -webkit-inline-box;
	border-color: #520000fa;
	border-style:solid;
}
.nonveg-circle
{
	height : 20%;
	background: #520000fa;
  	border-radius: 100%;
    width:45%;
    height:45%;
    margin : 30%
}

.chkbox
{
	zoom: 150% !important;
}


/*
 *  Include CSS is empty. Keep it that way
 */
.card-img-top 
{
	height: 155px;
}
 .include
 {

 }

</style>
<section>

		<?php
			if($product_list->num_rows() > 0)
			{
			?>
			<!-- <div class="row"> -->
			<?php
			$accordian_count = 1;
			$row_count = 1;
			//$x = null;
				foreach ($product_list->result() as $products) 
				{
				    if($products->custom != "custom_no")
					{
    					if($row_count == 1)
    					{
    						echo "<div class='container'>"; echo "<div class='row'>";echo "<div class='col-md-3'>";
    					}
    					else
    					{
    						echo "<div class='container col-md-3'>";
    					}
		?>
		
			<!-- <div class="col-md-3"> -->
				<div class="card">
    				<img class="card-img-top" src="<?php if(!empty($products->image)){echo base_url().$products->image;}else{echo "https://foodtango.com/img/ui/noimage.png";} ?>" alt="Card image" style="width:100%">
    				<div class="card-body">
      				<h4 class="card-title" align="center"><a href="<?php echo base_url()."home/product/".base64_encode($products->sku); ?>"> <span> <?php echo $products->name; ?> </span> </a> </h4>
      				<input type="hidden" name="product_name" value="<?php echo $products->name; ?>">
      				<input type="hidden" name="product_sku" value="<?php echo $products->sku; ?>">
      				<table>
      					<tbody>
      						<tr> 
      							<td>
      								<label> Category </label>
      							</td> 
      							<td>
      								<label>&nbsp; <?php echo $products->category_name; ?> &nbsp;</label>
      								<input type="hidden" name="product_category_id" value="<?php echo $products->category_id; ?>">
      							</td> 
      						</tr>
      						<tr> 
      							<td>
      								<label> Price </label>
      							</td> 
      							<td>
      								<label> &nbsp; <?php echo $products->price; ?> &nbsp;</label>
      								<input type="hidden" name="product_price" value="<?php echo $products->price; ?>">
      							</td> 
      						</tr>
      						<tr> 
      							<td>
      								<label> Quantity </label>
      							</td>  
      							<td>
      								<input type="number" class="form-control" name="product_qunat" placeholder="Quantity" id="<?php echo $products->sku; ?>" value="1" min="1">
      							</td> 
      						</tr>
      					</tbody>
      				</table><br>
      				<?php 
      						if(($products->custom_product != "") && ($products->custom_product_price != ""))
      						{
								$get_products = explode(",",$products->custom_product);
								$get_gst = explode(",",$products->custom_gst);
								$get_sub_total = explode(",",$products->custom_sub_price);
								$get_prices = explode(",",$products->custom_product_price);
								$get_sku = explode(",",$products->custom_sku);

      				?>
      				<div id="accordion<?php echo $accordian_count; ?>">
								    <div class="card">
								      <div class="card-header">
								        <a class="card-link" data-toggle="collapse" href="#collapseOne<?php echo $accordian_count; ?>">
								          Customize Product
								        </a>
								      </div>
								      <div id="collapseOne<?php echo $accordian_count; ?>" class="collapse" data-parent="#accordion<?php echo $accordian_count; ?>">
								        <div class="card-body">

							<?php
									

									for($x=0;$x < count($get_products);$x++ )
									{

							?>
												<br>
												<div class="row">
												  	<div class="col-md-6">
    														<input type="checkbox" class="form-control checked" id="options<?php echo $x; ?>" name="options<?php echo $x; ?>" value="<?php echo $get_products[$x]."/".$get_prices[$x]."/".$get_sku[$x]."/".$get_gst[$x]."/".$get_sub_total[$x]; ?>" rel="quantity_<?php echo $products->sku.$x; ?>">												  		
												  	</div>
												  	<div class="col-md-6">
    														<?php echo $get_products[$x]."-".$get_prices[$x]; ?>
												  	</div>
												 </div> <br>	
												<div class="row">
												  	<div class="col">
			<input type="number" class="<?php echo "form-control quantity_".$products->sku.$x; ?>" placeholder="Quantity" name="custom_quantity[]" id="quantity_<?php echo $products->sku.$x; ?>">
												  	</div><br>
												</div>
 							<?php
 									}
 							?>
								        		
								        	</div>
								        </div>
								      </div>
								    </div><br>
								    <?php
								  		}
								  		else
								  		{
								  			echo "<br><br><br>";
								  		}
								  	?>
								    <div class="row">
								    	<div class="col-md-6" align="left">
      										<button class="btn btn-primary add-cart" data-productname="<?php echo $products->name; ?>"  data-gst="<?php echo $products->product_gst; ?>" data-subtotal="<?php echo $products->product_subtotal; ?>" data-price="<?php echo $products->price; ?>" data-productid="<?php echo $products->sku; ?>" data-customflag = "<?php if(($products->custom_product != "") && ($products->custom_product_price != "")){echo "1";}else{echo "0";} ?>"> Add To Cart</button>							    		
								    	</div>
								    	<div class="col-md-6" align="right">
												  <span class="<?php if($products->meal == "non-veg"){echo "nonveg-square";}else{echo "veg-square";} ?>"><p class="<?php if($products->meal == "non-veg"){echo "nonveg-circle";}else{echo "veg-circle";} ?>"></p></span>
								    	</div>
								    </div>
    			</div>
  				</div>
			</div>
			<div class="col-md-1"></div>
			
			<?php
			if($row_count == 3)
			{
				// echo "<div class='col-md-1'></div>";
				echo "</div></div>";
				echo "<br>";
				$row_count = 0;
			}			
			$row_count++;
				$accordian_count++;
				}
			}
		}
	?>
		</div><br>
		</div>
		<br>
	</div>
</section>
<br><br><br>
<script>
	$(document).ready(function(){
		$('.checked').click(function(){
			var getRel = $(this).attr('rel');
			console.log(getRel);
    		var getVal = $('.'+$(this).attr('rel')).toggleClass('include');
    		 console.log(getVal);
		});		

		$(".add-cart").click(function(){
				var product_id = $(this).data("productid");
				var product_name = $(this).data("productname");
				var product_gst = $(this).data("gst");
				var product_subtotal = $(this).data("subtotal");
				var quantity = $("#"+product_id).val();
				var actual_price = $(this).data("price");
				var product_price = $(this).data("price") * quantity;
				var product_total_price = 0;
				var main_price = 0;
				var optional_price = 0;
				var custom_flag = $(this).data("customflag");

				var bundle_flag = undefined;


				// console.log(product_id+" "+product_name+" "+product_price+" "+quantity+" "+custom_flag);
				
				var checkBoxArray = undefined;
				var custom_amount = 0;

				if(custom_flag)
				{
				   var checkBoxArray = [];

				   	var i = 0
					$('input.include').each(function(){
						//console.log(this.value);
        				checkBoxArray.push($('.checked:checked')[i].value+'/'+this.value);
        				i++;
    				}); 
    				
						console.log(checkBoxArray);
    				var split_array = undefined;

    				for(var x = 0; x < checkBoxArray.length; x++)
    				{
    					split_array = checkBoxArray[x].split('/');
						// console.log("split_array");
    					// console.log(split_array);

						// console.log(split_array[1]);
						// console.log(split_array[5]);

    					custom_amount = Number(custom_amount) + Number(split_array[1]*split_array[5]);

					}
					

					main_price = actual_price;
					optional_price = custom_amount;
					product_total_price = product_price + custom_amount;
					bundle_flag = 'bundle';
				}
				else
				{
					main_price = actual_price;
					optional_price = custom_amount;

					product_total_price = product_price + custom_amount;
					checkBoxArray = undefined;
					bundle_flag = 'single';
				}
				
				 console.log(checkBoxArray);

				if(quantity != '' && quantity > 0)
				{
					$.ajax({
						url: '<?php echo base_url()."cart/add"; ?>',
						method:"POST",
						data:{product_id:product_id,product_name:product_name,product_gst:product_gst,product_subtotal:product_subtotal,main_product_price:main_price,optional_product_price:optional_price,product_price:product_total_price,quantity:quantity,bundle_flag:bundle_flag,options:checkBoxArray},
						success: function(data){
							if(data != 'empty_error')
							{
								alert("Product Added To Cart");
								// location.reload(true);
							}
						},
  						error: (error) => {
                     	console.log(JSON.stringify(error));
   							}		
					});
				}
				else
				{
					alert('Quantity Cannot Be Empty or Zero');
				}

		});
	});

</script>
