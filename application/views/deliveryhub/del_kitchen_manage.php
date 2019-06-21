<section>
<div class="row">
        <div class="col-md-6">
            <h3>View Delivery Manage Kitchen</h3>
        </div>
        <div class="col-md-6" align="right">
        <a class="btn btn-sm btn-outline-primary" href="<?php echo base_url()."superadmin/delivery_manage" ?>"> Add Delivery</a>
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
                    <!--<th>Edit</th>-->
                    <th>Delete</th>

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
                    <td> <?php  
                            if($del->status == 0)
                             { 
                                echo "<b style='color:red';>PENDING </b>";
                             }
                             else 
                             {
                                 echo "<b style='color:green';>COMPLETED </b>";
                             }

                                 ?> </td>
                    
                    <!--<td> <a class="btn btn-sm btn-primary" href="<?php //echo base_url()."superadmin/edit_delivery_kitchen/".$del->id; ?>"> Edit </a> </td>-->
                    <td> <a href="#" class="btn btn-sm btn-danger delete_employee" id="<?php echo $del->order_id; ?>"> Delete </a> </td>
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

<script type="text/javascript">
	$(document).ready(function(){
		$(".delete_employee").click(function(){
			var id = $(this).attr("id");
			if(confirm("Are you sure you want to delete this?"))
			{
				window.location="<?php echo base_url();?>superadmin/delete_del_kitchen/"+id;
			}
			else
			{
				return false;
			}
		});
	});
</script>