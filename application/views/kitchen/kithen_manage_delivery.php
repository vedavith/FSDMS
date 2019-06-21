<section>
<div class="row">
        <div class="col-md-6">
            <h3>View Delivery Manage Kitchen</h3>
        </div>
        
    </div>
    <br>
<div class="row container">
       
        <table id="table" class="table table-responsive table-bordered">
            <thead>
                <tr align="center">
                    <th> S.No </th>
                   
                    <th> Kitchen Id</th>
                    <th> Product Name </th>
                    <th> Product Sku</th>
                    <th> Order Id</th>
                    <th> Quantity</th>
                    <th> Status</th>
                   
                    

                </tr>
            </thead>
            <tbody>
                <?php
                     if($del_data->num_rows() > 0)
                    {
                         $i = 1;
                         foreach ($del_data->result() as $del) 
                        {
                ?>
                <tr align="center">
                    <td> <?php echo $i; ?> </td>
                  
                    <td> <?php echo $del->kit_id; ?> </td>

                    <td> <?php echo $del->product_name; ?> </td>
                    <td> <?php echo $del->product_sku; ?></td>
                    <td> <?php echo $del->order_id;?></td>
                    <td> <?php echo $del->quantity; ?> </td>
                   
                    
                    <!--<td> <a class="btn btn-sm btn-primary" href="<?php //echo base_url()."superadmin/edit_delivery_kitchen/".$del->id; ?>"> Edit </a> </td>-->
                    <td style="width: 15rem;"><label>Completed  <input type="radio" class="completed" data-empid = '<?php echo $del->kit_id; ?>' data-date = '<?php echo $del->order_id; ?>' data-sku = '<?php echo $del->product_sku; ?>' name="kitc_status<?php echo $i; ?>" /></label> &nbsp;&nbsp;  <label>Pending <input type="radio" class="pending" name="kitc_status<?php echo $i; ?>" checked/></label>  </td>

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
     

</section>
<script>
$(document).ready(function() {
    $('#table').DataTable();
} );
</script> 


<script>
$(document).ready(function(){
    $('.completed').change(function(){
        var emp_id = $(this).data('empid'); 
        var date = $(this).data('date');
        var sku = $(this).data('sku');
        $.ajax({
            url : '<?php echo base_url()."kitchen/ajaxCalldelstatus"; ?>',
            method : 'post',
            data : {kit:emp_id, order:date, skuid:sku},
           
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