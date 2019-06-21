<div class="col-sm-6 col-md-9">
    
	<div class="row">
    	<div class="col-md-6">
    		<p class="h3" align="left"> Update Kitchen Inventory </p>
    	</div>
    	<div class="col-md-6" align="right">
    		<a class="btn btn-sm btn-outline-danger" href="<?php echo base_url()."superadmin/create_kitchen_inventory"; ?>"> Back</a>
    	</div>
    </div><br>

    <div class="row">
    	<div class="card-body">
    			<div class="container">
    				<div class="row">
    					<div class="col-md-2"></div>
    				<div class="col-md-6"> 
    					<select id="select_kitchen" class="form-control">
                            <option value = " "> Select Kitchen </option>
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
    				<!-- <div class="col-md-2" align="left">
    					<button class="btn btn-sm btn-info"> Submit </button>
    				</div> -->
    				</div>
    	</div><br>
    <div class="container-fluid">
    	<table id="table" class="table table-bordered">
			<thead>
				<tr align="center">
					<th> S.No </th>
					<th> Product Name </th>
                    <th> Product SKU </th>
                    <th> Units </th>
                    <th> Current Quantity </th>
                    <th> Update Quantity </th>
					<th> Add Quantity</th>
                    <th> Deduct Qunatity </th>
                    <!-- <th> Update Product</th> -->
					<th> Delete Product</th>
				</tr>
			</thead> 		
    	</table>
    </div>	
</div>

<!-- Dont Remove this closed div tag -->
    <!-- Side row closed -->
    </div>
    <!-- sidebar container fluid closed -->
</div>
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
    $(document).ready(function(){
        $("#select_kitchen").on('change',function(){

            var getTableName = $("#select_kitchen").val();
            // console.log(getTableName);
            var url1 = <?php echo $set_json_kitchen_products; ?>;
            // console.log(url1);
            var url2 = <?php echo $set_json_units; ?>;
            // console.log(url2);
            var set_total_count = 0;
            var productArray = new Array();
            var unitArray = new Array();

            $.ajax({
                url:'<?php echo base_url()."superadmin/ajaxCallGetInventory"; ?>',
                method:'post',
                data:{table_name:getTableName},
                dataType:"JSON",
                success:function(data){
                    var productData = '';
                    var count = 1;
                    $.each(data,function(key,value){
                       
                       productArray[set_total_count] = value.product_name;
                       unitArray[set_total_count] = value.product_units;

                        productData += '<tr class="get_data" align="center">';
                        productData += '<td>'+count+'</td>';
                        productData += '<td>'+value.product_name+'</td>';
                        productData += '<td>'+value.product_sku+'</td>';
                        productData += '<td>'+value.product_units+'</td>';
                        productData += '<td>'+value.product_quantity+'</td>';
                        productData += '<td><input type="number" class="form-control" id="'+value.product_sku+'" min=0 max="'+value.product_quantity+'"></td>';
                        productData += '<td><button class="btn btn-sm btn-success add_stock" data-productname="'+value.product_name+'" data-productsku="'+value.product_sku+'"data-productunits="'+value.product_units+'">Add </button></td>';
                        productData += '<td><button class="btn btn-sm btn-warning remove_stock" data-productname="'+value.product_name+'" data-productsku="'+value.product_sku+'"data-productunits="'+value.product_units+'">Deduct </button></td>';
                        productData += '<td><button class="btn btn-sm btn-danger delete_product" data-tablename="'+getTableName+'" data-productid="'+value.id+'">Delete </button></td>';
                        productData += '</tr>';
                        count++;
                        set_total_count++;
                    });

                    $(".get_data").remove();
                    $(".dataTables_empty").hide();
                    $("#table").append(productData);
                },
                error: function(xhr, statusText, errorThrown){
                    alert('Server Returned ERROR('+xhr.status+')'+errorThrown+' : '+getTableName);
                     $(".get_data").remove();
                     $(".dataTables_empty").show();
                    }
            });
        });
    });

</script>

<script type="text/javascript">
  $(document).on('click','.add_stock',function(e){
            var getTableName = $("#select_kitchen").val();
            var product_name = $(this).data('productname');
            var product_sku = $(this).data('productsku');
            var product_units = $(this).data('productunits');
            var updated_qunatity = $("#"+product_sku).val();
            var addflag = "a";

            $.ajax({
                url:'<?php echo base_url()."superadmin/ajaxCallAddQuant"; ?>',
                method:'post',
                data:{ajaxProductName:product_name,ajaxProductSku:product_sku,ajaxProductUnits:product_units,ajaxUpdatedQuant:updated_qunatity,ajaxAddFlag:addflag,ajaxTableName:getTableName},
                success:function(data){
                    alert('Updated Quantity');
                }
            });

  });  

  $(document).on('click','.remove_stock',function(e){
            var getTableName = $("#select_kitchen").val();
            var product_name = $(this).data('productname');
            var product_sku = $(this).data('productsku');
            var product_units = $(this).data('productunits');
            var updated_qunatity = $("#"+product_sku).val();
            var addflag = "d";

            $.ajax({
                url:'<?php echo base_url()."superadmin/ajaxCallDeductQuant"; ?>',
                method:'post',
                data:{ajaxProductName:product_name,ajaxProductSku:product_sku,ajaxProductUnits:product_units,ajaxUpdatedQuant:updated_qunatity,ajaxAddFlag:addflag,ajaxTableName:getTableName},
                success:function(data){

                    alert('Deducted Quantity');
                    $('#product_units option[value="'+getTableName+'"]').attr('selected', 'selected');
                }
            });

  });  

  $(document).on('click','.delete_product',function(e){
    if(confirm('Are You Sure You Want To Delete?'))
    {
        var getTableName = $(this).data('tablename');
        console.log(getId);
        var getId = $(this).data('productid');
        console.log(getId);
        
        $.ajax({
            url:'<?php echo base_url()."superadmin/ajaxCallDeleteProduct"; ?>',
            method:'post',
            data:{ajaxTableName:getTableName,ajaxProductId:getId},
            success:function(data){
                alert('Product Deleted');
            }
        });
    }

  });
</script>



<script>
$(document).ready(function() {
    $('#table').DataTable();
});
</script>