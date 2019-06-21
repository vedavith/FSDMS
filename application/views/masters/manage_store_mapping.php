<div class="col-sm-6 col-md-10">
  <div class="row">
    <div class="col-md-6" align="left">
      <p class="h3"> Manage Store Mapping</p>
    </div>
    <div class="col-md-6" align="right">
      <a class="btn btn-sm btn-outline-danger" href="<?php echo base_url()."superadmin/store_mapping"; ?>"> Back</a>
    </div>
  </div><br>

  <div class="container-fluid">
    <div class="table-responsive">
    <table id="table" class="table table-bordered">
      <thead>
        <th> S.No </th>
        <th> Store </th>
        <th> Room </th>
        <th> Grid</th>
        <th> Bin</th>
        
        <th> Edit </th>
        <th> Delete </th>
      </thead>
      <tbody align="center">
        <?php
					if($mapping_data->num_rows() > 0)
					{
						$i = 1;
						foreach ($mapping_data->result() as $store)
            {
          ?>
          <tr>
            <td> <?php echo $i; ?> </td>
            <td> <?php echo $store->store_name; ?> </td>
            <td> <?php if($store->room_name ==''){ echo "None";} else { echo $store->room_name; } ?> </td>
            <td> <?php if($store->grid_name ==''){ echo "None";} else {echo $store->grid_name; } ?></td>
            <td> <?php if($store->bin_name ==''){ echo "None";} else { echo $store->bin_name;} ?></td>
            <td> <a class="btn btn-sm btn-primary" href="<?php echo base_url()."superadmin/edit_store_mapping/".$store->id; ?>"> Edit </a> </td>
            <td><a href="#" class="btn btn-sm btn-danger delete_category" id="<?php echo $store->id; ?>"> Delete </a>
            </td>
          </tr>
          <?php
              $i++;
            }
          }
				?>
      </tbody>
    </table>
  </div>
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
				window.location="<?php echo base_url();?>superadmin/delete_store_map/"+id;
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
