<div class="col-sm-6 col-md-9">
    
	<div class="row">
    	<div class="col-md-6">
    		<p class="h3" align="left"> Assigned Products </p>
    	</div>
    	<div class="col-md-6" align="right">
    		<a class="btn btn-sm btn-outline-danger" href="<?php echo base_url()."kitchen/kitchen_home"; ?>"> Back</a>
    	</div>
    </div><br>

    <div class="row">
    	<div class="card-body">
            <div class="container-fluid">
                <table id="table" class="table table-bordered">
                    <thead>
                        <tr align="center">
                            <th> S.No </th>
                            <th> Product Name </th>
                            <th> Product SKU </th>
                            <th> Kitchen Limit </th>
                            <th> Add Quantity</th>
                        </tr>
                    </thead> 
                    <tbody>
                        <?php 
                            $i = 1;
                            foreach($assigned_products->result() as $row)
                            {
                        ?>
                        <tr>
                            <td> <?php echo $i; ?> </td>
                            <td> <?php echo $row->product_name; ?> </td>
                            <td> <?php echo $row->product_sku; ?> </td>
                            <td> <input type="number" class="form-control" id="<?php echo $row->product_sku; ?>" name="estimated_quant" value="<?php echo $row->estimated_units; ?>" min="0"></td>
                            <td><input type="button" class="btn btn-sm btn-success add_quants" data-sku="<?php echo $row->product_sku; ?>" value="Add Quantity"></td>       
                        </tr>
                        <?php 
                            $i++;       
                            }
                        ?>
                    </tbody>		
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
        $('.add_quants').on('click',function(e){
            var prod_sku = $(this).data('sku');
            var quant_id = '#'+prod_sku;
            var getQuant = $(quant_id).val();
            var sessionKitchenId = '<?php echo $this->session->userdata('kitchen_id'); ?>';
            $.ajax({
                url : '<?php echo base_url()."kitchen/ajax_call_update_asssigned_quantity"; ?>',
                method : 'post',
                data : {kitchen_id:sessionKitchenId,product_sku:prod_sku,quantity:getQuant},
                success : function(data){
                    if(data)
                    {
                        alert('Quantity Updated');
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