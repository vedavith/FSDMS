<section>
<div class="row">
        <div class="col-md-6">
            <h3>Delivery Orders</h3>
        </div>
       <!--  <div class="col-md-6" align="right">
        <a class="btn btn-sm btn-outline-primary" href="<?php //echo base_url()."deliveryhub/delivery_employee" ?>"> Add Employee</a>
        </div> -->
    </div>
    <br>
    <div class="table-responsive">
<div class="row container">
       <div class="table-responsive">
        <table id="table" class="table table-responsive table-bordered">
            <thead>
                <tr align="center">
                    <th> S.No </th>
                   <th> Kitchen Name </th>

                    <th> Kitchen Address</th>
                    <th> OrderId </th>
                    <th> UserId </th>
                    <th> Main Address</th>
                    <th> Branch Address</th> 
                    <th> Executives</th>
                    <th>Delete</th>

                </tr>
            </thead>
            <tbody>
                <?php
                     if($delivery_user_employee->num_rows() > 0)
                    {
                         $i = 1;
                         foreach ($delivery_user_employee->result() as $del) 
                        {
                ?>
                <tr align="center">
                    <td> <?php echo $i; ?> </td>
                    <td> <?php echo $del->k_name;?></td>
                    <td> <?php echo $del->k_address1.','.$del->k_address2.','.$del->k_address3.','.$del->city.','.$del->state.','.$del->zipcode; ?> </td>
                    <td> <?php echo $del->order_id; ?> </td>
                    <td> <?php echo $del->user_id; ?> </td>
                    <td> <?php echo $del->main_address; ?></td>
                    <td> <?php echo $del->branch_address;?></td>
                    <td> <label>
                        <select  id="empId">
                            <?php foreach($del_exe->result() as $de){ ?>
                            <option value="<?php echo $de->id; ?>" ><?php echo $de->emp_name;?></option>
                            
                        <?php }
                        ?>
                    </select>
                        </label>
                        
                   </td>

                     <td> <a href="#" class="btn btn-sm btn-danger accept_order" data-sku="<?php echo $del->product_sku; ?>" data-pname="<?php echo $del->product_name; ?>" data-quant="<?php echo $del->quantity; ?>" data-rowid="<?php echo $del->row_id; ?>" data-userid = "<?php echo $del->user_id;?>" data-usertable = "<?php echo $del->user_table;?>" data-orderid = "<?php echo $del->order_id; ?>" data-unique = "<?php echo $del->unique_order_id; ?>" data-kit="<?php echo $del->kit_id; ?>" data-address="<?php echo $del->main_address;?>" data-braddr="<?php echo $del->branch_address; ?>" data-bundled_flag="<?php echo $del->bundled_flag; ?>" data-delid="<?php echo $del->del_id; ?>"> Assign </a> </td>


                   
                </tr>
                <?php
                        $i++;
                        }
                    }
                ?>
            </tbody>            
        </table>
    </div>
    <br><br><br><br>
    </div>   

</section>

<script>
$(document).ready(function() {
    $('#table').DataTable();
} );
</script>  

<script>
$(document).ready(function(){
    $('.accept_order').click(function(){
        var delId = $(this).data('delid');
        var kit = $(this).data('kit');
        var empId = $('#empId').val();
        var sku = $(this).data('sku');
        var pName = $(this).data('pname');
        var quant = $(this).data('quant');
        var rowId = $(this).data('rowid');
        var userId = $(this).data('userid');
        var usertable = $(this).data('usertable');
        var orderId = $(this).data('orderid');
        var uniqueId = $(this).data('unique');
        var mainAddr = $(this).data('address');
        var brAddr = $(this).data('braddr');
        var bundled = $(this).data('bundled_flag');
        //console.log(delId,kit,empId,sku,pName,quant,rowId,userId,usertable,orderId,uniqueId,mainAddr,brAddr);
        $.ajax({
            url : '<?php echo base_url()."deliveryhub/deliveryorder_ajax"; ?>',
            method : 'post',
            data : {delid:delId,kit:kit,emp_id:empId,sku:sku,product_name:pName,qunatity:quant,row_id:rowId,user_id:userId,usertable:usertable,order_id:orderId,unique_id:uniqueId,address:mainAddr,braddress:brAddr,bundled_flag:bundled},
            success : function(data){
                if(data)
                {
                    alert('Updated');
                    location.reload(true);
                }
            }
        });
    });
});
</script>


