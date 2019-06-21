<div class="col-sm-6 col-md-9">
    
    <div class="row">
        <div class="col-md-6">
            <p class="h3" align="left"> Manage Receipt challans </p>
        </div>
        <div class="col-md-6" align="right">
            <a class="btn btn-sm btn-outline-danger" href="<?php echo base_url()."superadmin/primary_stock_inventory"; ?>"> Back</a>
        </div>
    </div><br>

    
               
    <div class=" row container-fluid">
        <div class="table-responsive">
        <table id="table" class="table table-responsive table-bordered">
            <thead>
                <tr align="center">
                    <th> S.No </th>
                    <th> Kitchen_Id </th>
                    <th> Executive ID</th>
                    <th> DC_NO </th>
                    <th> Delivery_user_id </th>
                    <th> Product_Name </th>
                    <th> Product_Sku </th>
                    <th> Order Id </th>
                    <!-- <th> Obtained Quantity </th> -->
                    <!-- <th> Print </th> -->
                </tr>
            </thead> 
            <tbody>
                 <?php
                     if($order_data->num_rows() > 0)
                    {
                         $i = 1;
                         foreach ($order_data->result() as $del) 
                        {
                        ?>
                <tr align="center">
                    <td><?php echo $i; ?></td>
                    <td><?php echo $del->kit_id; ?></td>
                    <td><?php echo $del->delivery_emp_id; ?></td>
                    <td><?php echo $del->dc_id; ?></td>
                    <td><?php echo $del->user_id; ?></td>
                    <td><?php echo $del->product_name; ?></td>
                    <td><?php echo $del->product_sku; ?></td>
                    <td><?php echo $del->order_id; ?></td>

                </tr>
                <?php
                         }
                      }
                 ?>
            </tbody>       
        </table>
   
</div>
<!-- <script>
$(document).ready(function(){
    $("#select_kitchen").change(function(){
        var kitGetter = $('#select_kitchen').val();
        $.ajax({
            url : '<?php //echo base_url()."superadmin/ajaxOrderedReciptDetails"; ?>',
            method : 'post',
            data : {kitchen_name:kitGetter},
            dataType : 'JSON',
            success:function(data){
                var productData = '';
                var count = 1;
                $.each(data,function(key,value){
                    productData += '<tr class="get_data">';
                    productData += '<td>'+count+'</td>';
                    productData += '<td>'+value.kitchen_id+'</td>';
                    productData += '<td>'+value.delivery_id +'</td>';
                    productData += '<td>'+value.dc_no +'</td>';
                    productData += '<td>'+value.product_sku+'</td>';
                    productData += '<td>'+value.product_name+'</td>';
                    productData += '<td>'+value.current_quantity+'</td>';
                    productData += '<td>'+value.obtained_quantity+'</td>';
                  // productData += '<td><button class="btn btn-sm btn-danger delete_product" data-productid="'+value.id+'" id= "'+value.id+'">Print </button></td>';                    
                    productData += '</tr>';
                    count++;
                });

                $(".get_data").remove();
                $(".dataTables_empty").hide();
                $("#table").append(productData);
            },
            error: function(xhr, statusText, errorThrown){
                    alert('Server Returned ERROR('+xhr.status+')'+errorThrown);
                     $(".get_data").remove();
                     $(".dataTables_empty").show();
                    }
        });
    });
});




</script> -->

<!-- Dont Remove this closed div tag -->
    <!-- Side row closed -->
    </div>
    <!-- sidebar container fluid closed -->
</div>

<script>
$(document).ready(function() {
    $('#table').DataTable();
});
</script>