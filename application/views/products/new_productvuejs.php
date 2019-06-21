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

#img-upload{
    width: 100%;
    height:100%;
}
img{
  max-width:180px;
}
</style>
ABCD
<script>
	<?php

	$sql="select * from product_master where is_customizable='custom_no'";
      $query=$this->db->query($sql);
      
      //var_dump(json_encode($query->result()));



      //die();

	?>

	var producttable=JSON.parse('<?php echo json_encode($query->result()); ?>');
	console.log(producttable);

</script>


<?php
if(!isset($get_product_by_id))
{
?>
<div class="col-sm-6 col-md-9">
    <div class="row">
    	<div class="col-md-6" align="left">
    		<p class="h3"> Create Product </p>
    	</div>
    	<div class="col-md-3" align="right">
    		<a class="btn btn-sm btn-primary" href="<?php echo base_url()."superadmin/manage_product"; ?>"> Manage </a>
    	</div>
    	<div class="col-md-3" align="right">
    		<a class="btn btn-sm btn-outline-danger" href="<?php echo base_url()."superadmin/home"; ?>"> Back</a>
    	</div>
    </div>
    <br>

    <form method="post" action="<?php echo base_url()."superadmin/insert_product" ?>" enctype="multipart/form-data" id="form1">
    <div class="row container">
  <div class="container" id="accordion1">
    <div class="card">
      <div class="card-header">
        <a class="card-link" data-toggle="collapse" href="#CategoryOne">
         Product Category/Image
        </a>
      </div>
      <div id="CategoryOne" class="collapse show" data-parent="#accordion1">
      	<div class="row">
      		<div class="card-body col-md-3" align="right">
      			<label class="h6"> Meal Type </label>
      		</div>
  			<div class="col-md-6">
    			<div class="card-body">
    				<?php
    					// @todo  Create a master for meal type
     				?>
		          <select name="meal_type" class="form-control">
					<option value=""> Select Option </option>
		          	<option value="veg"> Vegetarian Meal</option>
		          	<option value="non-veg"> Non-Vegetarian Meal</option>
		          	<option value="jain"> Jain Meal</option>
		          </select>
    			</div>
    		</div>
        </div>

        	<div class="row">
	      		<div class="card-body col-md-3" align="right">
	      			<label class="h6"> Product Category </label>
	      		</div>
      				<div class="col-md-6">
        				<div class="card-body">
				          <select name="category" class="form-control">
							<option value=""> Select Category </option>
				          	<?php
				          	if($category_master->num_rows() > 0)
              				{
                				foreach($category_master->result() as $row)
                				{
    						?>
    						<option value="<?php echo $row->id; ?>"> <?php echo $row->category ?> </option>
    						<?php
 	               				}
              				}
				          	?>
				          </select>
        				</div>
        			</div>
        	</div>

        	<div class="row">
	      		<div class="card-body col-md-3" align="right">
	      			<label class="h6">Product Image </label>
	      		</div>
      			<div class="card-body col-md-6">
        			<div class="form-group">
					    <div class="input-group">
					        <span class="input-group-btn">
					            <span class="btn btn-default">
					              <input type="file" name="userfile[]" id="imgInp1" onchange="inImg1(this);">
									<img id="blah1" src="#" alt="" />
								</span>
								 
								<span class="btn btn-default">
					              <input type="file" name="userfile[]" id="imgInp2" onchange="inImg2(this);">
					              <img id="blah2" src="#" alt="" />
									</span>
									<span class="btn btn-default">
					              <input type="file" name="userfile[]" id="imgInp3" onchange="inImg3(this);">
					              <img id="blah3" src="#" alt="" />
									</span>
									 <span class="btn btn-default">
					              <input type="file" name="userfile[]" id="imgInp4" onchange="inImg4(this);">
					              <img id="blah4" src="#" alt="" />
									</span>
								<span class="btn btn-default">
									 <input type="file" name="userfile[]" id="imgInp5" onchange="inImg5(this);">
					              <img id="blah5" src="#" alt="" />
					             <!--<button class="add_field_button">+</button>-->
					            </span>
					        </span>
					        <!--<div class="input_fields_wrap"></div>-->
					    </div>
    				</div>
        		</div>
        	</div>
        	
        		
        		
        	

      <div class="card-body">
      	<?php
				$count =0;
      		if(!empty(form_error("meal_type")))
					{
						$count = 1;
				?>
				<div class="row alert alert-danger">
							<strong>REQUIRED** : </strong> Meal Type is Required
				</div>
				<?php
					}
				?>
					<?php
						if(!empty(form_error("category")))
						{
							$count = 1;
					?>
					<div class="row alert alert-danger">
								<strong>REQUIRED** : </strong> Category is Required
					</div>
					<?php
						}
					?>
					<?php
						 if(!empty(form_error("userfile[]")))
						{
							$count = 1;
					?>
					<div class="row alert alert-danger">
								<strong>REQUIRED** : </strong> Product Image is Required
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
        <a class="collapsed card-link" data-toggle="collapse" href="#CategoryTwo">
        Product Attributes
      </a>
      </div>
      <div id="CategoryTwo" class="collapse" data-parent="#accordion1">
        <div class="row">
        	<div class="card-body col-md-3" align="right"> <label class="h6"> Product Name </label> </div>
        	<div class="card-body col-md-6" align="left">
        		<input type="text" name="product_name" class="form-control" placeholder="Product Name">
        	</div>
    	</div>
    	<div class="row">
        	<div class="card-body col-md-3" align="right"> <label class="h6"> Product SKU </label> </div>
        	<div class="card-body col-md-6" align="left">
        		<input type="text" name="product_sku" class="form-control" placeholder="Product SKU">
        	</div>
    	</div>
    	<div class="row">
        	<div class="card-body col-md-3" align="right"> <label class="h6"> Product Quantity </label> </div>
        	<div class="card-body col-md-6" align="left">
        		<input type="number" name="product_quantity" class="form-control" placeholder="Product Quantity" min="0">
        	</div>
    	</div>
			<div class="row">
        	<div class="card-body col-md-3" align="right"> <label class="h6"> Product Price </label> </div>
        	<div class="card-body col-md-6" align="left">
        		<input type="number" name="product_price" class="form-control" placeholder="Product Price" min="0">
        	</div>
    	</div>
    	<div class="row">
        	<div class="card-body col-md-3" align="right"> <label class="h6"> Is Customizable </label> </div>
        	<div class="card-body col-md-6" align="left">
        		<label class="radio-inline">
      				<input type="radio" class="custom_no custom_opt" id="customno" value="custom_no" name="custom_options" checked>No
    			</label> &nbsp;
    			<label class="radio-inline">
      				<input type="radio" class="custom_yes custom_opt" id="customyes" value="custom_yes" name="custom_options">Yes
    			</label>
        	</div>
       
        	<br/>
        </div>
        
       	
        	<div class="show_customoptionsyes">
        		<div id="customopt">
        			
        			<div class="card-body">
                       	<div class="col-md-3">
                         <button type="button" @click="addRow" class="btn btn-sm btn-outline-danger">Add row</button>
                        </div>                         
                    </div>

                    <div v-for="(product,index) in productArray">

		        	<div class="card-body row hide">
		        		
		        		<div class="col-md-3">
		        			<div class="card-body">
			        			<!--<input type="text" id="product_name" name="customizable_options[]" class="form-control" placeholder="Product Name"> -->
			        			<select name="prddata[]" class="form-control" id="prddata" v-model="product.prddata" @change='getPrice(index)'>
									<option value=""> Select Product </option>
						          	<?php

						          	if($prd_data->num_rows() > 0)
		              				{
		                				foreach($prd_data->result() as $row)
		                				{
		                					$id=$row->id;
		                					$sku=$row->product_sku;
		                					$prdname=$row->product_name;
		                					$prskuid= $id."_".$sku."_".$prdname;

		    						?>
		    						<option value="<?php echo $prskuid; ?>" data-price="<?php echo $row->product_price; ?>"> <?php echo $row->product_name ?> </option>
		    						<?php
		 	               				}
		              				}
						          	?>
					          	</select>

					          	<!--  <select class='form-control' v-model='state' @change='getPrice()'>
						          <option value='0' >Select Product</option>
						          <option v-for='data in products' :value='data.id'>{{ data.name }}</option>
						        </select> -->
		        			</div>
		        		</div>

		        		<div class="col-md-3">
		        			<div class="card-body">
		        			<!--<input type="text" id="product_name" name="customizable_options[]" class="form-control" placeholder="Product Name"> -->
		        			<select name="prdpricedata[]" class="form-control" id="prdpricedata" v-model="product.prdpricedata">
								<option> </option>
				          	</select>

					          	<!-- <select class='form-control' v-model='prdprice' name="prdpricedata" id="prdpricedata">
						          <option value='0' >Select Price</option>
						          <option v-for='data in prices' :value='data.id'>{{ data.name }}</option>
						        </select> -->
				          	</div>
		        			
		        		</div>
		        		<!--<div class="col-md-3">
		        			<input type="text" id="product_price" name="customizable_price[]" class="form-control" placeholder="Product Price">
		        		</div>
		        		<div class="col-md-3" align="left">
		        			<button type="button" class="btn btn-sm btn-primary add"> <b> Add </b> </button>
		        		</div> -->

		        		<div class="col-md-3">
		        			<div class="card-body">	
	        	  				<button type="button" @click="deleteRow(index)" class="btn btn-sm btn-outline-danger">Delete row</button> 
	        	  			</div>
	        	  		</div>

		        	</div>
		        	    

		           </div>
		           
		        </div>
        	</div> 

<!--         	<script src="<?php //echo base_url()."application/views/assets/vue.js"; ?>"></script>
 -->
         	<!-- <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script> -->

         	<script src="https://cdn.jsdelivr.net/npm/vue"></script>


        	<br>


        	<script>



        	function prdDetail(){
			this.prddata="";
			this.prdpricedata="";
			 
			} 
        	var initPrdList= [];


        	console.log(initPrdList);

        	const app = new Vue({
 
			 el: '#customopt',
			 
			 data: {
			   productArray: initPrdList
			 },
			 
			 methods: {
			   addRow() {
			    alert("hi");
			     this.productArray.push( new prdDetail());
			   },
			   deleteRow(index) {
			    alert("hello");
			     this.productArray.splice(index,1)
			   },


			    getPrice(index){
			    	alert("getprice");

			    	var dateStr=this.productArray[index].prdData;
   					alert(dateStr);
			    }
			   // getPrice: function(){
			   // 	alert("getprice");

			   // 	xios.get('<?php //echo base_url();?>Superadmin/fetch_dropdown_prdid', { 
			   //      params: {
			   //        request: 'prdid',
			   //        product_id: this.product
			   //      }
			   //    }) 
			   //    .then(function (response) {
			   //      app.prices = response.data;
			   //      app.price = 0;
			   //    }); 
			   // }

			 
			 }
			 
			})

        	</script>
        

        	<div class="card-body row append_custom"></div>

    	

						      <div class="card-body">
						      	<?php
										$count = 0;
										$customize = 0;

						      		if(!empty(form_error("product_name")))
											{
												$count = 1;
										?>
										<div class="row alert alert-danger">
													<strong>REQUIRED** : </strong> Product Name is Required
										</div>
										<?php
											}
										?>
											<?php
												if(!empty(form_error("product_sku")))
												{
													$count = 1;
											?>
											<div class="row alert alert-danger">
														<strong>REQUIRED** : </strong> Product SKU is Required
											</div>
											<?php
												}
											?>
											<?php
												if(!empty(form_error("product_quantity")))
												{
													$count = 1;
											?>
											<div class="row alert alert-danger">
														<strong>REQUIRED** : </strong> Product Quantity is Required
											</div>
											<?php
												}
												if(!empty(form_error("product_price")))
												{
													$count = 1;
											?>
											<div class="row alert alert-danger">
														<strong>REQUIRED** : </strong> Product Price is Required
											</div>
											<?php
													}
													if(!empty(form_error("customizable_options[]")))
													{
														$count = 1;
														$customize = 1;
												?>
												<div class="row alert alert-danger">
															<strong>REQUIRED** : </strong> Product is Required
												</div>
												<?php
											}
														if(!empty(form_error("customizable_price[]")))
														{
															$count = 1;
															$customize = 1;
													?>

													<div class="row alert alert-danger">
																<strong>REQUIRED** : </strong> Product Price is Required
													</div>
													<?php
														}

												if($customize == 1)
												{
												?>
												<script>
													// var set_checked_flag = 0;
												$(document).ready(function(){
													$(".custom_opt").attr("checked",true);
													if ($(".custom_opt").is( ":checked" ))
													{
														set_checked_flag = 1;
													}
												});
												</script>
												<?php
												}
												if ($count == 1)
												{
												?>
												<script>
													$(document).ready(function(){
															$("#CategoryTwo").addClass("show");
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
        		<button type="submit" class="btn btn-outline-success"> Submit </button>
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
			if($error == "PAE")
			{
		?>
		<br>
		<div class="container-fluid">
			<div class="alert alert-danger">
					<strong> ERROR(<?php echo $error; ?>) : </strong> Product Already Exists
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
	if($get_product_by_id->num_rows() > 0)
	{
		foreach ($get_product_by_id->result() as $row)
		{
			$a = 0;
?>

<div class="col-sm-6 col-md-9">
    <div class="row">
    	<div class="col-md-6" align="left">
    		<p class="h3"> Update Product </p>
    		<?php 
    		$id = $this->uri->segment(3); 
    		$this->session->set_userdata("product_id",$id);
    		//print_r($_SESSION);
    		?>
    	</div>
    	<div class="col-md-3"></div>
    	<div class="col-md-3" align="right">
    		<a class="btn btn-sm btn-outline-danger" href="<?php echo base_url()."superadmin/manage_product"; ?>"> Back</a>
    	</div>
    </div>
    <br>

    <form method="post" action="<?php echo base_url()."superadmin/update_product" ?>" enctype="multipart/form-data">
    <div class="row container">
  <div class="container" id="accordion1">
  <input type="hidden" name="product_id" value="<?php echo $row->id; ?>">
    <div class="card">
      <div class="card-header">
        <a class="card-link" data-toggle="collapse" href="#CategoryOne">
         Product Category/Image
        </a>
      </div>
      <div id="CategoryOne" class="collapse show" data-parent="#accordion1">
      	<div class="row">
      		<div class="card-body col-md-3" align="right">
      			<label class="h6"> Meal Type </label>
      		</div>
      			<div class="col-md-6">
        			<div class="card-body">
        				<?php
        					// @todo  Create a master for meal type
         				?>
			          <select name="meal_type" class="form-control">
									<option value=""> Select Option </option>
			          	<option value="veg" <?php if($row->meal == "veg"){echo "selected='selected'";} ?> > Vegetarian Meal</option>
			          	<option value="non-veg" <?php if($row->meal == "non-veg"){echo "selected='selected'";} ?> > Non-Vegetarian Meal</option>
			          	<option value="jain" <?php if($row->meal == "jain"){echo "selected='selected'";} ?> > Jain Meal</option>
			          </select>
        			</div>
        		</div>
        	</div>

        	<div class="row">
	      		<div class="card-body col-md-3" align="right">
	      			<label class="h6"> Product Category </label>
	      		</div>
      				<div class="col-md-6">
        				<div class="card-body">
				          <select name="category" class="form-control">
										<option value=""> Select Category </option>
				          	<?php
				          	if($category_master->num_rows() > 0)
              				{
                				foreach($category_master->result() as $rows)
                				{
    						?>
    						<option value="<?php echo $rows->id; ?>" <?php if($rows->id == $row->category){echo "selected='selected'";} ?>> <?php echo $rows->category ?> </option>
    						<?php
 	               				}
              				}
				          	?>
				          </select>
        				</div>
        			</div>
        	</div>

        	<div class="row">
	      		<div class="card-body col-md-3" align="right">
	      			<label class="h6">Product Image </label>
	      		</div>
      			<div class="card-body col-md-6">
        			<div class="form-group">
					    <div class="input-group">
							 <span class="input-group-btn">
					        	<input type="hidden" name="pic1" id="show_path" value="<?php echo $row->image1; ?>"/>	
					        	<input type="file" name="userfile" class="form-control img_upload" id="upload_image1" accept=".png,.jpg,.jpeg,.gif" src="<?php echo base_url(); ?><?php echo $row->image1; ?>" onchange="upImg1(this);">
					            <span class="btn btn-default btn-file">

					              <?php 
					              
					              if(!empty($row->image1)){?>
					               <img src="<?php echo base_url(); ?><?php echo $row->image1; ?>" style="vertical-align:middle;" width="80" height="80" id="upimg1">
					           <?php
					            $a++;
					            } ?>
					            </span>
					        </span>
					            <span class="input-group-btn">
					            	<input type="hidden" name="pic2" id="show_patha" value="<?php echo $row->image2; ?>"/>
					        	<input type="file" name="userafile" class="form-control img_upload" id="upload_image2" accept=".png,.jpg,.jpeg,.gif"  src="<?php echo base_url(); ?><?php echo $row->image2; ?>" onchange="upImg2(this);"  >
					             <span class="btn btn-default btn-file">
					             	<?php if(!empty($row->image2)){?>
					             <img src="<?php echo base_url(); ?><?php echo $row->image2; ?>" style="vertical-align:middle;" width="80" height="80" id="upimg2">
					         <?php 
					         $a++;
					     } ?>
					         </span>
					     </span>
					     <span class="input-group-btn">
					     	<input type="hidden" name="pic3" id="show_pathb" value="<?php echo $row->image3; ?>"/>
					        	<input type="file" name="userbfile" class="form-control img_upload" id="upload_image3" accept=".png,.jpg,.jpeg,.gif" src="<?php echo base_url(); ?><?php echo $row->image3; ?>" onchange="upImg3(this);" >
					          <span class="btn btn-default btn-file">
					             	<?php if(!empty($row->image3)){?>
					             <img src="<?php echo base_url(); ?><?php echo $row->image3; ?>" style="vertical-align:middle;" width="80" height="80" id="upimg3">
					         <?php 
					         $a++;
					     } ?>
					         </span>
					     </span>
					     <span class="input-group-btn">
					     	<input type="hidden" name="pic4" id="show_pathc" value="<?php echo $row->image4; ?>"/>
					        	<input type="file" name="usercfile" class="form-control img_upload" id="upload_image4" accept=".png,.jpg,.jpeg,.gif" src="<?php echo base_url(); ?><?php echo $row->image4; ?>" onchange="upImg4(this);" >
					          <span class="btn btn-default btn-file">
					             	<?php if(!empty($row->image4)){?>
					             <img src="<?php echo base_url(); ?><?php echo $row->image4; ?>" style="vertical-align:middle;" width="80" height="80" id="upimg4">
					         <?php 
					         $a++; } ?>
					         </span>
					        </span>	
					       <span class="input-group-btn">
					       	<input type="hidden" name="pic5" id="show_pathd" value="<?php echo $row->image5; ?>"/>
					        	<input type="file" id="upload_image5" name="userdfile" class="form-control img_upload" accept=".png,.jpg,.jpeg,.gif" src="<?php echo base_url(); ?><?php echo $row->image5; ?>" onchange="upImg5(this);"  >
					          <span class="btn btn-default btn-file">
					             	<?php if(!empty($row->image5)){?>
					             <img src="<?php echo base_url(); ?><?php echo $row->image5; ?>" style="vertical-align:middle;" width="80" height="80" id="upimg5">
					         <?php 
					         $a++; } ?>
					         </span>
					        </span>
 							
					        <!--<input type="text" class="form-control">-->
					    </div>
    				</div>
        		</div>
        		<!--<div class="card-body col-md-3">
        			<img class="form-control img_upload" id='img-upload'/>
        		</div>-->
        	</div> 

      <div class="card-body">
      	<?php
				$count =0;
      		if(!empty(form_error("meal_type")))
					{
						$count = 1;
				?>
				<div class="row alert alert-danger">
							<strong>REQUIRED** : </strong> Meal Type is Required
				</div>
				<?php
					}
				?>
					<?php
						if(!empty(form_error("category")))
						{
							$count = 1;
					?>
					<div class="row alert alert-danger">
								<strong>REQUIRED** : </strong> Category is Required
					</div>
					<?php
						}
					?>
					<?php
						 if(!empty(form_error("pic1")))
						 {
							$count = 1;
					?>
					 <div class="row alert alert-danger">
								<strong>REQUIRED** : </strong> Product Image1 is Required
					</div> 
					<?php
						 }
						  if(!empty(form_error("pic2")))
						 {
							$count = 1;
					?>
					 <div class="row alert alert-danger">
								<strong>REQUIRED** : </strong> Product Image2 is Required
					</div> 
					<?php
						 }
						  if(!empty(form_error("pic3")))
						 {
							$count = 1;
					?>
					 <div class="row alert alert-danger">
								<strong>REQUIRED** : </strong> Product Image3 is Required
					</div> 
					<?php
						 }
						  if(!empty(form_error("pic4")))
						 {
							$count = 1;
					?>
					 <div class="row alert alert-danger">
								<strong>REQUIRED** : </strong> Product Image4 is Required
					</div> 
					<?php
						 }
						  if(!empty(form_error("pic5")))
						 {
							$count = 1;
					?>
					 <div class="row alert alert-danger">
								<strong>REQUIRED** : </strong> Product Image5 is Required
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
        <a class="collapsed card-link" data-toggle="collapse" href="#CategoryTwo">
        Product Attributes
      </a>
      </div>
      <div id="CategoryTwo" class="collapse" data-parent="#accordion1">
        <div class="row">
        	<div class="card-body col-md-3" align="right"> <label class="h6"> Product Name </label> </div>
        	<div class="card-body col-md-6" align="left">
        		<input type="text" name="product_name" class="form-control" placeholder="Product Name" value="<?php echo $row->name; ?>">
        	</div>
    	</div>
    	<div class="row">
        	<div class="card-body col-md-3" align="right"> <label class="h6"> Product SKU </label> </div>
        	<div class="card-body col-md-6" align="left">
        		<input type="text" name="product_sku" class="form-control" placeholder="Product SKU" value="<?php echo $row->sku; ?>" readonly>
        	</div>
    	</div>
    	<div class="row">
        	<div class="card-body col-md-3" align="right"> <label class="h6"> Current Quantity </label> </div>
        	<div class="card-body col-md-6" align="left">
        		<input type="number" name="product_quantity" class="form-control" placeholder="Product Quantity" min="0" value="<?php echo $row->quantity; ?>" readonly>
        	</div>
    	</div>
    	
    	<div class="row">
        	<div class="card-body col-md-3" align="right"> <label class="h6">Update Quantity </label> </div>
        	<div class="card-body col-md-6" align="left">
        		<input type="number" name="product_update_quantity" class="form-control" placeholder="Update Quantity" min="0" value="0" required>
        	</div>
    	</div>
			<div class="row">
        	<div class="card-body col-md-3" align="right"> <label class="h6"> Product Price </label> </div>
        	<div class="card-body col-md-6" align="left">
        		<input type="number" name="product_price" class="form-control" placeholder="Product Price" min="0" value="<?php echo $row->price; ?>">
        	</div>
    	</div>
    	<div class="row">
        	<div class="card-body col-md-3" align="right"> <label class="h6"> Is Customizable </label> </div>
        	<div class="card-body col-md-6" align="left">
        		<label class="radio-inline">
      				<input type="radio" class="custom_no custom_opt" value="custom_no" name="custom_options" <?php if($row->custom == "custom_no"){echo "checked";} ?>>No
    			</label> &nbsp;
    			<label class="radio-inline">
      				<input type="radio" class="custom_yes custom_opt" value="custom_yes" name="custom_options" <?php if($row->custom == "custom_yes"){echo "checked";} ?>>Yes
    			</label>
        	</div>

					<div class="card-body row">
						<?php
						if(isset($get_product_by_id))
						{
							if(($row->custom_product != NULL)&&($row->custom_product_price != NULL))
							{
								$custom_product_array = explode(",",$row->custom_product);
								$custom_price_array = explode(",",$row->custom_product_price);
								
								$get_custom_product = array();
								$get_custom_price = array();
								$merge_product_price = array();

								for($x=0,$y=0; $x < count($custom_product_array); $x++,$y++)
								{
									$merge_product_price[$custom_product_array[$x]] = 'custom_product';
									$merge_product_price[$custom_price_array[$y]] = 'custom_price';
								}
								 //echo json_encode($merge_product_price);
							}
						}
						?>
					</div>
				 <div  id="custom" class="hide">
					<div class="card-body row container">
						<div class="col-md-2"></div>
						<button type="button" v-on:click="addRow" class="btn btn-sm btn-success">Add row</button>	
					</div>
					<div class="card-body row container" v-for="(product,index) in productsArray">
						<div class="card-body col-md-3"></div>
						<div class="card-body col-md-3">
							<input type="text" id="product_name" v-model="product.custom_product_name" name="customizable_options[]" class="form-control" placeholder="Product Name">
						</div>
						<div class="card-body col-md-3">
							<input type="text" id="product_price" v-model="product.custom_product_price" name="customizable_price[]" class="form-control" placeholder="Product Price">
						</div>
						<div class="card-body col-md-3" align="left">
							<button type="button" class="btn btn-sm btn-danger" v-on:click="deleteRow(index)"> <b> Remove </b> </button>
						</div>
					</div>
				    </div>
    	</div>
<script>
     if($('#show_path').val() == "")
	{
 		$('#upload_image1').on('change',function(){
 		$('#show_path').val($('#upload_image1').val().replace(/.*(\/|\\)/, ''));
 		});
	}
	 if($('#show_patha').val() == "")
	{
 		$('#upload_image2').on('change',function(){
 		$('#show_patha').val($('#upload_image2').val().replace(/.*(\/|\\)/, ''));
 		});
	}
	 if($('#show_pathb').val() == "")
	{
 		$('#upload_image3').on('change',function(){
 		$('#show_pathb').val($('#upload_image3').val().replace(/.*(\/|\\)/, ''));
 		});
	}
	 if($('#show_pathc').val() == "")
	{
 		$('#upload_image4').on('change',function(){
 		$('#show_pathc').val($('#upload_image4').val().replace(/.*(\/|\\)/, ''));
 		});
	}
	 if($('#show_pathd').val() == "")
	{
 		$('#upload_image5').on('change',function(){
 		$('#show_pathd').val($('#upload_image5').val().replace(/.*(\/|\\)/, ''));
 		});
	}
</script>


						      <div class="card-body">
						      	<?php
										$count = 0;
										$customize = 0;

						      		if(!empty(form_error("product_name")))
											{
												$count = 1;
										?>
										<div class="row alert alert-danger">
													<strong>REQUIRED** : </strong> Product Name is Required
										</div>
										<?php
											}
										?>
											<?php
												if(!empty(form_error("product_sku")))
												{
													$count = 1;
											?>
											<div class="row alert alert-danger">
														<strong>REQUIRED** : </strong> Product SKU is Required
											</div>
											<?php
												}
											?>
											<?php
												if(!empty(form_error("product_quantity")))
												{
													$count = 1;
											?>
											<div class="row alert alert-danger">
														<strong>REQUIRED** : </strong> Product Quantity is Required
											</div>
											<?php
												}
												if(!empty(form_error("product_price")))
												{
													$count = 1;
											?>
											<div class="row alert alert-danger">
														<strong>REQUIRED** : </strong> Product Price is Required
											</div>
											<?php
													}
													if(!empty(form_error("customizable_options[]")))
													{
														$count = 1;
														$customize = 1;
												?>
												<div class="row alert alert-danger">
															<strong>REQUIRED** : </strong> Product is Required
												</div>
												<?php
											}
														if(!empty(form_error("customizable_price[]")))
														{
															$count = 1;
															$customize = 1;
													?>

													<div class="row alert alert-danger">
																<strong>REQUIRED** : </strong> Product Price is Required
													</div>
													<?php
														}

												if($customize == 1)
												{
												?>
												<script>
													// var set_checked_flag = 0;
												$(document).ready(function(){
													$(".custom_opt").attr("checked",true);
													if ($(".custom_opt").is( ":checked" ))
													{
														set_checked_flag = 1;
													}
												});
												</script>
												<?php
												}
												if ($count == 1)
												{
												?>
												<script>
													$(document).ready(function(){
															$("#CategoryTwo").addClass("show");
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
        		<button type="submit" class="btn btn-outline-info" name="product_update" value="product_update"> Update </button>
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


<!-- Dont Remove this closed div tag -->
    <!-- Side row closed -->
    </div>
    <!-- sidebar container fluid closed -->
</div>


<br><br><br><br><br>


<script type="text/javascript">
<?php
if(isset($get_product_by_id))
{
	if($row->custom == "custom_yes")
	{
?>
		$(document).ready(function(){
			
			$(".hide").show();
		});
<?php
	}
	else
	{
?>
	$(document).ready(function(){
		$(".hide").hide();
	});
<?php
	}
}
?>



 $(document).ready(function(){

	 $(".show_customoptionsyes").hide();
	 var radioValue = $("#customno:checked"). val();
	 //alert(radioValue);

	var custno= $("#customno").val();
	//alert(custno);
	if($("#customno").is(":checked")){
        $(".show_customoptions").hide();
  	}
    $("#customyes").click(function(){
        $(".show_customoptionsyes").show();
    });
     $("#customno").click(function(){
        $(".show_customoptions").hide();
    });



 	$("input:radio[name='custom_options']").click(function(){
	var custopt=($(this).val());
	//alert(custopt);

	if(custopt=="custom_no")
		{
			 $(".show_customoptionsyes").hide();
		}

	if(custopt=="custom_yes")
		{
			 $(".show_customoptionsyes").show();
		}
	});

	$("#prddata").on("change", function(){
		var prdid=$("#prddata").val();
		alert(prdid);
		if(prdid)
		{
			$.ajax({
				type:'POST',
				url:'<?php echo base_url();?>Superadmin/fetch_dropdown_prdid',
				data:'prdid='+prdid,
				success:function(html){
					 $('#prdpricedata').html(html);
				}
			});
		}
		else
		{
			$('#prdpricedata').html('<option value="">Select Product First</option>');
		}

	  // This code will fire every time the user selects something
	})

    });

// 	Append Using Add Button
	$(document).ready(function(e){
		var count = 0;
		$(".add").click(function(){
			count++;
			$(".append_custom").append("<div class='card-body row hide'><div class='col-md-3'></div><div class='col-md-3'><input type='text' id='product_name_'"+count+" name='customizable_options[]' class='form-control' placeholder='Product Name'></div><div class='col-md-3'><input type='text' id='product_price_'"+count+" name='customizable_price[]' class='form-control' placeholder='Product Price'></div><div class='col-md-3' align='left'><button type='button' class='btn btn-sm btn-danger remove'> <b> Remove </b> </button></div></div>");
		});
	});

//	Remove Button

	$(".append_custom").on('click','.remove',function(){
 //alert("remove");
        $(this).parent().parent().remove();
   });
</script>

<script type="text/javascript">
 		 function inImg1(input)
 		  {
            if (input.files && input.files[0])
             {
                var reader = new FileReader();
				reader.onload = function (e)
				 {
                    $('#blah1')
                    .attr('src', e.target.result);
                };
					reader.readAsDataURL(input.files[0]);
            }
          }
  		function inImg2(input) 
  		{
            if (input.files && input.files[0])
             {
                var reader = new FileReader();
				reader.onload = function (e) 
				{
                    $('#blah2')
                    .attr('src', e.target.result);
                };
				reader.readAsDataURL(input.files[0]);
            }
        }
		function inImg3(input) {
            if (input.files && input.files[0])
             {
                var reader = new FileReader();
				reader.onload = function (e)
				 {
                    $('#blah3')
                    .attr('src', e.target.result);
                };
				reader.readAsDataURL(input.files[0]);
            }
        }
        function inImg4(input)
         {
            if (input.files && input.files[0]) 
            {
                var reader = new FileReader();
				reader.onload = function (e)
				 {
                    $('#blah4')
                    .attr('src', e.target.result);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }
        function inImg5(input) 
        {
            if (input.files && input.files[0]) 
            {
                var reader = new FileReader();
				reader.onload = function (e)
				 {
                    $('#blah5')
                    .attr('src', e.target.result);
                };
				reader.readAsDataURL(input.files[0]);
            }
        }

         function upImg1(input)
          {
            if (input.files && input.files[0])
             {
                var reader = new FileReader();
				reader.onload = function (e)
				 {
                    $('#upimg1')
                     .attr('src', e.target.result);
                 };
				reader.readAsDataURL(input.files[0]);
            }
        }
         function upImg2(input) 
         {
            if (input.files && input.files[0])
             {
                var reader = new FileReader();
				reader.onload = function (e)
				 {
                    $('#upimg2')
                    .attr('src', e.target.result);
                };
			   reader.readAsDataURL(input.files[0]);
            }
        }
        function upImg3(input)
         {
            if (input.files && input.files[0])
             {
                var reader = new FileReader();
				reader.onload = function (e)
				 {
                    $('#upimg3')
                    .attr('src', e.target.result);
                };
			reader.readAsDataURL(input.files[0]);
            }
        }
	  function upImg4(input)
	   {
	        if (input.files && input.files[0]) 
	        {
	            var reader = new FileReader();
				reader.onload = function (e)
				 {
	                 $('#upimg4')
	                 .attr('src', e.target.result);
	              };
				reader.readAsDataURL(input.files[0]);
	         }
	    }
	   function upImg5(input)
	    {
            if (input.files && input.files[0])
             {
                var reader = new FileReader();
				reader.onload = function (e)
				 {
                    $('#upimg5')
                    .attr('src', e.target.result);
                };
				reader.readAsDataURL(input.files[0]);
            }
        }

	 
</script>