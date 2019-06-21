<div class="col-sm-6 col-md-10">
  <div class="row">
    <div class="col-md-6" align="left">
      <p class="h3"> Manage Delivery Challan</p>
    </div>
    <div class="col-md-6" align="right">
      <a class="btn btn-sm btn-outline-danger" href="<?php echo base_url()."superadmin/delivery_challan"; ?>"> Back</a>
    </div>
  </div><br>

  <div class="container-fluid">
    <table id="table" class="table table-bordered">
      <thead>
        <th> S.No </th>
        <th> Kitchen_Name </th>
        <th> DC_no</th>
        <th> Product_Name</th>
        <th> Product Quantity </th>
       
        <th> Edit </th>
        <th> Delete </th>
      </thead>
      <tbody align="center">
        <?php
					if($dc_challan_data->num_rows() > 0)
					{
						$i = 1;
						foreach ($dc_challan_data->result() as $product)
						{
              $id= $product->dc_id;
          ?>
          <tr>
            <td> <?php echo $i; ?> </td>
           <td> <?php echo $product->kitchen_id; ?> </td>
            <td> <?php echo $product->dc_no; ?> </td>
            <td> <?php echo $product->product_name; ?> </td>
            <td> <?php echo $product->product_quantity; ?> </td>
          
          
            <td> <a class="btn btn-sm btn-primary" href="<?php echo base_url()."superadmin/edit_delivery_challan/".$product->dc_id; ?>"> Edit </a> </td>
            <td> <form action="<?php echo base_url();?>superadmin/delete_dc" onsubmit="return confirm('Do you want to delete this?');" method="POST">
              <input type="hidden" name="id" value="<?php echo $id;?>" ><input type="submit" value="DELETE" class="btn btn-sm btn-danger">
            </form>
          </td>
            
            <!--<td><a href="#" class="btn btn-sm btn-danger delete_category" id="<?php //echo $product->dc_id; ?>"> Delete </a>-->
            </td>
          </tr>
          <?php
              $i++;
            }
          }
				?>
      </tbody>
    </table>
    <br><br><br>
  </div>
</div>


<!-- Removal of these tags disturbs page alignment -->
       </div>
   <!-- Side row closed -->
   </div>
   <!-- sidebar container fluid closed -->
</div>

<script type="text/javascript">
	$(document).ready(function(){
		$(".delete_category").click(function(){
			var id = $(this).attr("id");
			if(confirm("Are you sure you want to delete this?"))
			{
				window.location="<?php echo base_url();?>superadmin/delete_dc/"+id;
			}
			else
			{
				return false;
			}
		});
	});
</script>

<script>
$(document).ready(function() {
    $('#table').DataTable();
} );
</script>
