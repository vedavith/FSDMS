<div class="col-sm-6 col-md-9">
    
	<div class="row">
    	<div class="col-md-6">
    		<p class="h3" align="left"> Manage Assigned Products </p>
    	</div>
    	<div class="col-md-6" align="right">
    		<a class="btn btn-sm btn-outline-danger" href="<?php echo base_url()."superadmin/assign_kitchen_products"; ?>"> Back</a>
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
                            <option value="<?php echo $kitchen_details->k_id; ?>"><?php echo $kitchen_details->k_name; ?></option>
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
                    <th> Bundled Flag</th>
                    <th> Kitchen Limit </th>
					<!-- <th> Add Quantity</th> -->
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

<script>
$(document).ready(function(){
    $(document).on('change','#select_kitchen',function(e){
        var kitchen_id =  $(this).val();
       console.log(kitchen_id);
       $.ajax({
           url : '<?php echo base_url()."superadmin/ajax_call_get_kitchen_assigned_products" ?>',
           method : 'post',
           dataType : 'JSON',
           data : {kitchen_id:kitchen_id},
           success : function(data){
            if(data.length > 0)
            {
                var productData = '';
                var count = 1;
                $.each(data,function(key,value){
                    productData += '<tr class="get_data" align="center">';
                    productData += '<td>'+count+'</td>';
                    productData += '<td>'+value.product_name+'</td>';
                   
                    productData += '<td>'+value.product_sku+'</td>';
                    productData += '<td>'+value.bundled_flag+'</td>';
                    productData += '<td>'+value.estimated_units+'</td>';
                    productData += '<td><input type="button" class="btn btn-sm btn-danger delete_assigned_product" data-id="'+value.product_sku+'" value="Delete"/></td>';
                    productData += '</tr>';
                    count++;
                });
                        $(".get_data").remove();
                        $(".dataTables_empty").hide();
                        $("#table").append(productData);
            }
            else
            {
                        $(".get_data").remove();
                        $(".dataTables_empty").show();
            }  
           },
           error : function(xhr, statusText, errorThrown){
                    alert('Server Returned ERROR('+xhr.status+')'+errorThrown+' : '+getTableName);
                     $(".get_data").remove();
                     $(".dataTables_empty").show();
           }
       });
    });

    $(document).on('click','.delete_assigned_product',function(e){
        var kitchen_id =  $('#select_kitchen').val();
        var productSku = $(this).data('id');
        $.ajax({
            url : '<?php echo base_url()."superadmin/ajax_call_delete_assigned_product"; ?>',
            method : 'post',
            data : {kitchen_id:kitchen_id,product_sku:productSku},
            success : function(data){
                if(data)
                {
                    alert('Product Deleted');
                    location.reload(true);
                }
            }
        });

    });

});
</script>



<script>
$(document).ready(function() {
    $('#table').DataTable();
});
</script>