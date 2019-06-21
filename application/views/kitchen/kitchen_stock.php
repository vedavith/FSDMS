<section>

<div class="row">
        <div class="col-md-6">
            <h3>View Stock</h3>
        </div>
        <div class="col-md-6" align="right">
        <!-- <a class="btn btn-sm btn-outline-primary" href="<?php //echo base_url()."kitchen/kitchen_employee" ?>"> Add Employee</a> -->
        </div>
    </div>
    <br>
<div class="row container">
        
        <table id="table" class="table table-responsive table-bordered">
            <thead>
                <tr align="center">
                    <th> S.No </th>
                    <th> Product SKU</th>
                    <th> Product Name </th>
                    <th> Product Units </th>
                    <th> Current Quantity </th>
                    <th> Updated Quantity</th>
                    <!-- <th> Add</th> -->
                    <th> Deduct</th>
                </tr>
            </thead>
            <tbody>
                <?php
                     if($kitchen_stock_data->num_rows() > 0)
                    {
                         $i = 1;
                         foreach ($kitchen_stock_data->result() as $meal) 
                        {
                ?>
                <tr align="center">
                    <td> <?php echo $i; ?> </td>
                    <td> <?php echo $meal->product_sku; ?> </td>
                    <td> <?php echo $meal->product_name; ?> </td>
                    <td> <?php echo $meal->product_units; ?> </td> 
                    <td> <?php echo $meal->product_quantity; ?> </td>
                   <td>  <input type = "number" class="form-control" id="<?php echo $meal->product_sku; ?>" name="txtupdate_quan" min=0  max="<?php echo $meal->product_quantity; ?>"/></td>
                    <!-- <td> <button class="btn btn-sm btn-success add_stock" data-productname="<?php echo  $meal->product_name; ?>" data-productsku="<?php echo $meal->product_sku; ?>" data-productunit="<?php echo $meal->product_units; ?>"> Add </button> </td> -->
                    <td> <button class="btn btn-sm btn-danger deduct_stock" data-prodname="<?php echo  $meal->product_name; ?>" data-prodsku="<?php echo $meal->product_sku; ?>" data-produnit="<?php echo $meal->product_units; ?>" data-currentquant="<?php echo $meal->product_quantity; ?>"> Deduct </button> </td>
                </tr>
                <?php
                        $i++;
                        }
                    }
                ?>
            </tbody>            
        </table>
    <br><br><br><br>
    </div>   

</section>
 

<!-- <script type="text/javascript">
	$(document).ready(function(){
		$(".delete_employee").click(function(){
			var id = $(this).attr("id");
			if(confirm("Are you sure you want to delete this?"))
			{
				window.location="<?php //echo base_url();?>kitchen/delete_employee/"+id;
			}
			else
			{
				return false;
			}
		});
	});
</script> -->


<script>
$(document).ready(function() {
    $('#table').DataTable();
} );
</script> 

<script>
    	// $(".add_stock").click(function(){
		// 		var product_sku = $(this).data("productsku");
		// 		//console.log(product_sku);
        //         var product_name = $(this).data("productname");
		// 		// console.log(product_name);
        //         var product_units = $(this).data("productunit");
		// 		// console.log(product_units);
		// 		var quantity = $("#"+product_sku).val();
		// 		// console.log(quantity);
        //         var  pro_addordel = "a";
        //         if((quantity == '' || quantity == '0' ))
        //         {
        //                 alert('update quantity required');
        //         }
        //         else
        //         {
        //             $.ajax({
        //             url: '<?php echo base_url()."kitchen/add_stock"; ?>',
        //             method: 'post',
        //             data: {sku:product_sku,name:product_name,quant:quantity,addordel:pro_addordel,units:product_units},
        //             success: function(data){
        //                 alert('added quantity');
        //                 location.reload(true);
        //             }

        //             });
                
        //         }
        //     });

                $(".deduct_stock").click(function(){
				var product_sku = $(this).data("prodsku");
				//console.log(product_sku);
                var product_name = $(this).data("prodname");
				// console.log(product_name);
                var product_units = $(this).data("produnit");
				// console.log(product_units);
				var quantity = $("#"+product_sku).val();
				console.log(quantity);
                var current_quant = $(this).data("currentquant");
                console.log(current_quant);
                var  pro_addordel = "d";
                if(quantity == '' || quantity == '0' || (quantity > current_quant))
                {
                    if((quantity == '' || quantity == '0' ))
                    {
                        alert('update quantity required');
                    }
                    if(quantity > current_quant)
                    {
                        alert('Update Quantity Cannot be greater than Current Quantity');
                    }                    
                }
                else
                {
                $.ajax({
                    url: '<?php echo base_url()."kitchen/deduct_stock"; ?>',
                    method: 'post',
                    data: {sku:product_sku,name:product_name,quant:quantity,addordel:pro_addordel,units:product_units},
                    success: function(data){
                        alert('quantity deducted');
                        location.reload(true);
                    }

                    });
                }
            });


</script>