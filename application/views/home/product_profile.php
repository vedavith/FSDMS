<br><br><br><br><br><br>
<style>

.veg-square 
{    
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
   <div class = "container">
 		<div class = "row">
		<?php 
			foreach($get_product_details->result() as $product)
			{
				// echo "<pre>";
				// print_r($product);
				// echo "</pre>";

				$image_array = array();
				$image_array[0] = $product->image1;
				$image_array[1] = $product->image2;
				$image_array[2] = $product->image3;
				$image_array[3] = $product->image4;
				$image_array[4] = $product->image5;
		?>	 
			<div class="col-md-6">
				<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
					<ol class="carousel-indicators">
				<?php 
					for($i = 0; $i < count($image_array); $i++)
					{
				?>		
						<li data-target="#carouselExampleIndicators" data-slide-to="<?php echo $i ?>" <?php if($i == 0){echo "class = 'active'";} ?>>
						<img class="d-block w-100" src="<?php echo base_url().$image_array[$i]; ?>" alt="<?php echo $i; ?>" style="width:100% !important; height: 40px;">
						</li>
				<?php 
					}
				?>		
					</ol>
					<div class="carousel-inner">
				<?php
					for($i = 0; $i < count($image_array); $i++)
					{
				?>
						<div class="carousel-item <?php if($i == 0){echo 'active';} ?>">
							<img class="d-block w-100" src="<?php echo base_url().$image_array[$i]; ?>" alt="<?php echo $i; ?>" style="width:100%; height: 400px;">
						</div>
				<?php 
					}
				?>		
					</div>
					<a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
						<span class="carousel-control-prev-icon" aria-hidden="true"></span>
						<span class="sr-only">Previous</span>
					</a>
					<a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
						<span class="carousel-control-next-icon" aria-hidden="true"></span>
						<span class="sr-only">Next</span>
					</a>
				</div>
			</div>
			 <div class="col-md-6" >
				 <div class = "row">
					<div class="col-md-6 col-sm-6" align="right"> <h5> Product Name :  </h5> </div>
					<div class="col-md-6 col-sm-6" align="left"> <h5> <?php echo $product->name; ?> </h5> </div>
				 </div>
				 <div class = "row">
					<div class="col-md-6 col-sm-6" align="right"> <h5> Category : </h5> </div>
					<div class="col-md-6 col-sm-6" align="left"> <h5> <?php echo $product->category_name; ?> </h5> </div>
				 </div>
				 <div class = "row">
					<div class="col-md-6 col-sm-6" align="right"> <h5> Price : </h5> </div>
					<div class="col-md-6 col-sm-6" align="left"> <h5> <?php echo $product->price; ?> </h5> </div>
				 </div>
				 <div class = "row">
					<div class="col-md-6 col-sm-6" align="right"> <h5> Quantity : </h5> </div>
					<div class="col-md-6 col-sm-6" align="left"> <input type="number" class="form-control" id="<?php echo $product->sku; ?>"/> </div>
				 </div><br><br>
				 <!-- Write Accordian Here -->
				 <?php
					if($product->custom == "custom_yes")
					{
						if(($product->custom_product != "") && ($product->custom_product_price != ""))
      					{
							$get_products = explode(",",$product->custom_product);
							$get_prices = explode(",",$product->custom_product_price);
							$get_sku = explode(",",$product->custom_sku);
				?>
				 <!-- <div class = "row container"> -->
					<!-- <div id="accordion"> -->
						<div class="card" id = "accordian">
							<div class="card-header" id="headingOne">
								<h5 class="mb-0">
									<button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
									Customize product
									</button>
								</h5>
							</div>

							<div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
								<div class="card-body">
								<?php
									

									for($x=0;$x < count($get_products);$x++ )
									{

							?>
									<br>
									<div class="row">
										<div class="col-md-4">
    										<input type="checkbox" class="form-control checked" id="options<?php echo $x; ?>" name="options<?php echo $x; ?>" value="<?php echo $get_products[$x]."/".$get_prices[$x]."/".$get_sku[$x]; ?>" rel="quantity_<?php echo $product->sku.$x; ?>">												  		
										</div>
										<div class="col-md-4">
    										<?php echo $get_products[$x]."-".$get_prices[$x]; ?>
										</div>
										<div class="col-md-4">
											<input type="number" class="<?php echo "form-control quantity_".$product->sku.$x; ?>" placeholder="Quantity" name="custom_quantity[]" id="quantity_<?php echo $product->sku.$x; ?>">
										</div>
									</div> <br>	
 							<?php
 									}
 							?>
								</div>
							</div>
						</div>
					<!-- </div>	 -->
				 <!-- </div> -->
				<?php
						}
					}
				 ?>
				 <br>
				 <div class="row">
					<div class="col-md-6" align="right">
      					<button class="btn btn-primary add-cart" data-productname="<?php echo $product->name; ?>" data-price="<?php echo $product->price; ?>" data-productid="<?php echo $product->sku; ?>" data-customflag = "<?php if(($product->custom_product != "") && ($product->custom_product_price != "")){echo "1";}else{echo "0";} ?>"> Add To Cart</button>							    		
					</div>
					<div class="col-md-6" align="right">
						<span class="<?php if($product->meal == "non-veg"){echo "nonveg-square";}else{echo "veg-square";} ?>"><p class="<?php if($product->meal == "non-veg"){echo "nonveg-circle";}else{echo "veg-circle";} ?>"></p></span>
					</div>
				</div>
			 </div>
		<?php 
			}
		?>	 
 		</div>
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
				var product_price = $(this).data("price");
				var quantity = $("#"+product_id).val();
				var custom_flag = $(this).data("customflag");

				// console.log(product_id+" "+product_name+" "+product_price+" "+quantity+" "+custom_flag);
				
				var checkBoxArray = undefined;
				var custom_amount = 0;

				if(custom_flag)
				{
				   var checkBoxArray = [];

				   	var i = 0
					$('input.include').each(function(){
						console.log(this.value);
        				checkBoxArray.push($('.checked:checked')[i].value+'/'+$('.'+$('.checked:checked').attr('rel')).val());
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
							// console.log(split_array[2]);

    					custom_amount = Number(custom_amount) + Number(split_array[1]*split_array[3]);
    					// console.log(custom_amount);
    				}

    				product_price = product_price + custom_amount;
				}
				else
				{
					product_price = product_price + custom_amount
					checkBoxArray = undefined;
				}
				
				 //console.log(checkBoxArray);

				if(quantity != '' && quantity > 0)
				{
					$.ajax({
						url: '<?php echo base_url()."cart/add"; ?>',
						method:"POST",
						data:{product_id:product_id,product_name:product_name,product_price:product_price,quantity:quantity,options:checkBoxArray},
						success: function(data){
							if(data != 'empty_error')
							{
								alert("Product Added To Cart");
								location.reload(true);
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
