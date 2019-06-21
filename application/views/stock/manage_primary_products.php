<div class="col-sm-6 col-md-10">
  <div class="row">
    <div class="col-md-6" align="left">
      <p class="h3"> Manage Products</p>
    </div>
    <div class="col-md-6" align="right">
      <a class="btn btn-sm btn-outline-danger" href="<?php echo base_url()."superadmin/primary_stock_products"; ?>"> Back</a>
    </div>
  </div><br>

  <div class="container-fluid">
    <table id="table" class="table table-bordered">
      <thead>
        <th> S.No </th>
        <th> product Name </th>
        <th> Product SKU </th>
        <th> Primary Units </th>
        <th> Secondary Units </th>
        <th> Description</th>
        <th> Edit </th>
        <th> Delete </th>
      </thead>
      <tbody align="center">
        <?php
					if($select_primary_product->num_rows() > 0)
					{
						$i = 1;
						foreach ($select_primary_product->result() as $product)
						{

          ?>
          <tr>
            <td> <?php echo $i; ?> </td>
           <td> <?php echo $product->product_name; ?> </td>
            <td> <?php echo $product->product_sku; ?> </td>
            <td> <?php echo $product->primary_units; ?> </td>
            <td> <?php echo $product->secondary_units; ?> </td>
            <td> <?php echo $product->product_description; ?> </td>
          
            <td> <a class="btn btn-sm btn-primary" href="<?php echo base_url()."superadmin/update_primary_stock_products/".$product->id; ?>"> Edit </a> </td>
            <td><a href="#" class="btn btn-sm btn-danger delete_category" id="<?php echo $product->id; ?>"> Delete </a>
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
				window.location="<?php echo base_url();?>superadmin/delete_primary_stock_products/"+id;
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
