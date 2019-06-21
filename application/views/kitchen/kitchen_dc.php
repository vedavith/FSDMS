<section>
<div class="row">
        <div class="col-md-6">
            <h3>View DC</h3>
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
                    <th> Kitchen Id </th>
                    <th> Delivery Id</th>
                    <th> DC NO. </th>
                    <th> Product Name </th>
                   <th> current quantity</th>
                    <th> Quantity </th>

                    <th>Accept</th>

                </tr>
            </thead>
            <tbody>
                <?php
                     if($kitchen_dc_data->num_rows() > 0)
                    {
                         $i = 1;
                         foreach ($kitchen_dc_data->result() as $meal) 
                        {
                ?>
                <tr align="center">
                    <td> <?php echo $i; ?> </td>
                    <td> <?php echo $meal->kitchen_id; ?> </td>
                    <td> <?php echo $meal->delivery_id; ?> </td>

                    <td> <?php echo $meal->dc_no; ?> </td>
                    
                    <td> <?php echo $meal->product_name; ?> </td>
                    <td> <?php echo $meal->product_name; ?> </td>
                   <td> <?php echo $meal->product_quantity; ?></td>
                    <td> <input type="number" class="form-control" id ="<?php echo $meal->product_sku; ?>" name="quant" min=0  max="<?php echo $meal->product_quantity; ?>" value="<?php echo $meal->product_quantity; ?>"/> </td>
                   
                    <td> <button class="btn btn-sm btn-success add_stock" data-productname="<?php echo  $meal->product_name; ?>" data-productsku="<?php echo $meal->product_sku; ?>" data-productunit="<?php echo $meal->product_units; ?>" data-getid="<?php echo $meal->id; ?>" data-getkitchenid="<?php echo $meal->kitchen_id; ?>" data-getdeliveryid="<?php echo $meal->delivery_id; ?>" data-getdcno="<?php echo $meal->dc_no; ?>" data-getcurrentquant="<?php echo $meal->product_quantity; ?>" > Accept </button> </td>
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

<script>
$(document).ready(function() {
    $('#table').DataTable();
} );
</script>  
<script>
             $(".add_stock").click(function(){
				var product_sku = $(this).data("productsku");
				console.log(product_sku);
                var product_name = $(this).data("productname");
				console.log(product_name);
                var product_units = $(this).data("productunit");
				 console.log(product_units);
				var quantity = $("#"+product_sku).val();
				 console.log(quantity);
                var  pro_addordel = "a";
                var idsetter = $(this).data("getid");
                var kitchenid = $(this).data("getkitchenid");
                var deliveryid = $(this).data("getdeliveryid");
                var dcno = $(this).data("getdcno");
                var currquant = $(this).data("getcurrentquant");

                if((quantity == '' || quantity == '0' ))
                {
                        alert('update quantity required');
                }
                else
                {
                    $.ajax({
                    url: '<?php echo base_url()."kitchen/add_stock"; ?>',
                    method: 'post',
                    data: {sku:product_sku,name:product_name,quant:quantity,addordel:pro_addordel,units:product_units,idsetter:idsetter,kitchenid:kitchenid,deliveryid:deliveryid,dcno:dcno,currquant:currquant},
                    success: function(data){
                        alert('added quantity');
                        location.reload(true);
                    }

                    });
                
                }
            });

        </script>