<div class="col-sm-6 col-md-10">
  <div class="row">
    <div class="col-md-6" align="left">
      <p class="h3"> Manage Product </p>
    </div>
    <div class="col-md-6" align="right">
      <a class="btn btn-sm btn-outline-danger" href="<?php echo base_url()."superadmin/create_products"; ?>"> Back</a>
    </div>
  </div><br>

  <div class="container-fluid">
    <table id="table" class="table table-bordered">
      <thead>
        <th> S.No </th>
        <th> Image </th>
        <th> Product Category </th>
        <th> Product Name </th>
        <th> Product SKU </th>
        <th> Product Price </th>
        <th> Product Quantity </th>
        <th> Customizable </th>
        <th> Edit </th>
        <th> Delete </th>
      </thead>
      <tbody align="center">
        <?php
					if($product_data->num_rows() > 0)
					{
						$i = 1;
						foreach ($product_data->result() as $product)
						{

          ?>
          <tr>
            <td> <?php echo $i; ?> </td>
            <!--change images view in 1-2-19-->
            <td>  <img src="<?php echo base_url(); ?><?php echo $product->image; ?>" class="img-thumbnail"></td>
            <td> <?php echo $product->category; ?> </td>
            <td> <?php echo $product->name; ?> </td>
            <td> <?php echo $product->sku; ?> </td>
            <td> <?php echo $product->price; ?> </td>
            <td> <?php echo $product->quantity; ?> </td>
            <td> <?php if($product->custom == "custom_yes"){echo "Yes";}else{echo "No";} ?> </td>
            <td> <a class="btn btn-sm btn-primary" href="<?php echo base_url()."superadmin/create_products/".$product->id; ?>"> Edit </a> </td>
            <td><a href="#" class="btn btn-sm btn-danger delete_category" id="<?php echo $product->id; ?>"> Delete </a></td>
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
				window.location="<?php echo base_url();?>superadmin/delete_product/"+id;
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
