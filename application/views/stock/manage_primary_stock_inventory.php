<div class="col-sm-6 col-md-9">
    
	<div class="row">
    	<div class="col-md-6">
    		<p class="h3" align="left"> Manage Primary Stock Inventory </p>
    	</div>
    	<div class="col-md-6" align="right">
    		<a class="btn btn-sm btn-outline-danger" href="<?php echo base_url()."superadmin/primary_stock_inventory"; ?>"> Back</a>
    	</div>
    </div><br>

    <div class="row">
    	<div class="card-body">
    			<div class="container">
    				<div class="row">
    					<div class="col-md-2"></div>
    				<div class="col-md-6"> 
    					<select id="select_store" class="form-control">
                            <option value = " "> Select Store </option>
                       <?php
                       foreach ($store_data->result() as $row) 
                       {
                       ?>
                            <option value="<?php echo $row->store_name; ?>"> <?php echo $row->store_name; ?> </option>
                       <?php    
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
                    <th> Store Name </th>
                    <th> Grid Combo </th>
                    <th> Current Quantity </th>
                    <!-- <th> Update Quantity </th>
					<th> Add Quantity</th>
                    <th> Deduct Qunatity </th> -->
					<th> Delete Product</th>
				</tr>
			</thead> 		
    	</table>
        <br/><br/><br/>
    </div>	
</div>
<script>
$(document).ready(function() {
    $('#table').DataTable();
});
</script>
<script>
$(document).ready(function(){
    $("#select_store").change(function(){
        var storeGetter = $('#select_store').val();
        $.ajax({
            url : '<?php echo base_url()."superadmin/ajaxGetProductDetails"; ?>',
            method : 'post',
            data : {store_name:storeGetter},
            dataType : 'JSON',
            success:function(data){
                if(data == 0)
                {
                    $(".get_data").remove();
                    $(".dataTables_empty").show();
                }
                else
                {
                var productData = '';
                var count = 1;
                $.each(data,function(key,value){
                    productData += '<tr class="get_data">';
                    productData += '<td>'+count+'</td>';
                    productData += '<td>'+value.product_name+'</td>';
                    productData += '<td>'+value.product_sku+'</td>';
                    productData += '<td>'+value.primary_units+'/'+value.secondary_units+'</td>';
                    productData += '<td>'+value.store_name+'</td>';
                    productData += '<td>'+value.room_name+'-'+value.grid_name+'-'+value.bin_name+'</td>';
                    productData += '<td>'+value.quantity+'</td>';
                    // productData += '<td><input type="number" class="form-control" id="'+value.rgb_combo+'" name="update_quantity" min="1" max="'+value.quantity+'"/></td>';
                    // productData += '<td><button class="btn btn-sm btn-success add_stock" data-productname="'+value.product_name+'" data-productsku="'+value.product_sku+'"data-primaryunits="'+value.primary_units+'" data-secondaryunits="'+value.secondary_units+'" data-storename="'+value.store_name+'" data-rgbcombo="'+value.rgb_combo+'" data-addordel="a">Add </button></td>';
                    // productData += '<td><button class="btn btn-sm btn-warning remove_stock" data-productname="'+value.product_name+'" data-productsku="'+value.product_sku+'"data-primaryunits="'+value.primary_units+'" data-secondaryunits="'+value.secondary_units+'" data-storename="'+value.store_name+'" data-rgbcombo="'+value.rgb_combo+'" data-addordel="d"> Deduct </button></td>';                    
                    productData += '<td><button class="btn btn-sm btn-danger delete_product" data-productid="'+value.prod_id+'">Delete </button></td>';                    
                    productData += '</tr>';
                    count++;
                });
                $(".get_data").remove();
                $(".dataTables_empty").hide();
                $("#table").append(productData);
            }
                
            },
            error: function(xhr, statusText, errorThrown){
                    alert('Server Returned ERROR('+xhr.status+')'+errorThrown);
                     $(".get_data").remove();
                     $(".dataTables_empty").show();
                    }
        });
    });
});

$(document).on('click','.add_stock',function(e){
    var productName = $(this).data('productname');
    console.log(productName);
    var productSku = $(this).data('productsku');
    console.log(productSku);
    var primaryUnits = $(this).data('primaryunits');
    console.log(primaryUnits);
    var secondaryUnits = $(this).data('secondaryunits')
    console.log(secondaryUnits);
    var storeName = $(this).data('storename');
    console.log(storeName);
    var rgbCombo = $(this).data('rgbcombo');
    console.log(rgbCombo);
    var updatedQunatity = $("#"+rgbCombo).val();
    console.log(updatedQunatity);
    var addDel = $(this).data('addordel');
    console.log(addDel);

    $.ajax({
        url : '<?php echo base_url()."superadmin/ajaxAddPrimaryStock"; ?>',
        method : 'post',
        data : {product_name:productName,product_sku:productSku,primary_units:primaryUnits,secondary_units:secondaryUnits,store_name:storeName,rgb_combo:rgbCombo,quantity:updatedQunatity,addordel:addDel},
        success:function(data){
            alert('Updated Quantity');
        }
    });
});

$(document).on('click','.remove_stock',function(e){
    var productName = $(this).data('productname');
    console.log(productName);
    var productSku = $(this).data('productsku');
    console.log(productSku);
    var primaryUnits = $(this).data('primaryunits');
    console.log(primaryUnits);
    var secondaryUnits = $(this).data('secondaryunits')
    console.log(secondaryUnits);
    var storeName = $(this).data('storename');
    console.log(storeName);
    var rgbCombo = $(this).data('rgbcombo');
    console.log(rgbCombo);
    var updatedQunatity = $("#"+rgbCombo).val();
    console.log(updatedQunatity);
    var addDel = $(this).data('addordel');
    console.log(addDel);

    $.ajax({
        url : '<?php echo base_url()."superadmin/ajaxremovePrimaryStock"; ?>',
        method : 'post',
        data : {product_name:productName,product_sku:productSku,primary_units:primaryUnits,secondary_units:secondaryUnits,store_name:storeName,rgb_combo:rgbCombo,quantity:updatedQunatity,addordel:addDel},
        success:function(data){
            alert('Deducted Quantity');
        }
    });
});
</script>

<!-- Dont Remove this closed div tag -->
    <!-- Side row closed -->
    </div>
    <!-- sidebar container fluid closed -->
</div>
<script>
	$(document).on('click','.delete_product',function(e){
       
        var get_id = $(this).data('productid');
        console.log(get_id);
        if(confirm("Are you sure you want to delete this?"))
	    {	
            $.ajax({
                url : '<?php echo base_url()."superadmin/delete_primary_stock_inventory"; ?>',
                method : 'post',
                data : {product_id:get_id},
                success: function(data){
                alert('Product Deleted');
                }
            });
        }	
	});
</script>
