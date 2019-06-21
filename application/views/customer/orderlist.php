<br><br><br><br>
<section class="container">
    <div class="row">
        <div class = "table">
            <table class = "table table-bordered">
                <thead align="center">
                    <tr>
                        <th> S.No </th>
                        <th> Order ID </th>
                        <th> View Details </th>
                    </tr>    
                </thead>
                <tbody align="center">
                    <?php 
                        if($select_orderlist->num_rows() > 0)
                        {
                            $i = 1;
                            foreach($select_orderlist->result() as $rows)
                            {
                    ?>
                            <tr>
                                <td> <?php echo $i; ?> </td>
                                <td> <?php echo $rows->order_id; ?> </td>
                                <td> <a href = "#" class = "btn btn-sm btn-info clickable" data-toggle = "collapse" data-target="#accordian<?php echo $i  ?>" data-orderid = "<?php echo $rows->order_id; ?>" data-appender = "body<?php echo $i; ?>"> View More </a> </td>
                            </tr>
                                <tr>
                                    <td colspan="12" align="left">
                                        <div id="accordian<?php echo $i; ?>" class="collapse">
                                            <table class = "table">
                                                <thead align="center">
                                                    <tr>
                                                        <th> S.No </th>
                                                        <th> Unique Order ID </th>
                                                        <th> Product SKU </th>
                                                        <th> Product Price </th>
                                                        <th> Product Quantity </th>
                                                        <th> Optional SKU </th>
                                                        <th> Optional Product Name </th>
                                                        <th> Optional Product Quantity </th>
                                                        <th> From Date </th>
                                                        <th> To Date </th>
                                                    </tr>
                                                </thead>
                                                <tbody class = "body<?php echo $i; ?>">
                                                    
                                                </tbody>
                                            </table>
                                        </div>
                                    </td>
                                </tr>
                    <?php  
                            $i++;           
                            }
                        }
                    ?>
                </tbody>
            </table><br><br><br><br>
        </div><br><br><br><br>
    </div>
</section>

<script type="text/javascript">
$('.clickable').click(function(){
    var getOrderId = $(this).data('orderid');
    var appender = $(this).data('appender');
   // console.log(getOrderId);
    $.ajax({
        url : '<?php echo base_url()."home/ajaxGetOrders" ?>',
        method : 'post',
        data : {orderid:getOrderId},
        dataType : 'json',
        success : function(recv){
            table_appender = "";
            var i = 1;
            $.each(recv,function(key,value){
                table_appender += "<tr class='table_data' align='center'>";
                table_appender += "<td>"+i+"</td>";
                table_appender += "<td>"+value.unique_order_id+"</td>";
                table_appender += "<td>"+value.sku+"</td>";
                table_appender += "<td>"+value.price+"</td>";
                table_appender += "<td>"+value.quantity+"</td>";
                table_appender += "<td>"+value.optional_sku+"</td>";
                table_appender += "<td>"+value.optional_name+"</td>";
                table_appender += "<td>"+value.optional_quantity+"</td>";
                table_appender += "<td>"+value.from_date+"</td>";
                table_appender += "<td>"+value.to_date+"</td>";
                table_appender += "</tr>";
                i++;
            });

            $('.table_data').remove();
            $('.'+appender).append(table_appender);
        }
    });
});
</script>