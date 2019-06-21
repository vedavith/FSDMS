<div class="col-sm-6 col-md-10">
  <div class="row">
    <div class="col-md-6" align="left">
      <p class="h3"> Manage Kitchen </p>
    </div>
    <div class="col-md-6" align="right">
      <a class="btn btn-sm btn-outline-danger" href="<?php echo base_url()."superadmin/create_kitchen"; ?>"> Back</a>
    </div>
  </div><br>

  <div class="container-fluid">
    <table id="table" class="table table-bordered">
      <thead>
        <th> S.No </th>
        <th> Kitchen Id </th>
        <th> Kitchen Name </th>
        <th> Kitchen Type</th>
        <th> Kitchen Address </th>
        <th> State </th>
        <th> City </th>
        <th> Zipcode </th>
        <th> Edit </th>
        <th> Delete </th>
      </thead>
      <tbody align="center">
        <?php
					if($kitchen_data->num_rows() > 0)
					{
						$i = 1;
						foreach ($kitchen_data->result() as $kitchen)
						{

          ?>
          <tr>
            <td> <?php echo $i; ?> </td>
           <td> <?php echo $kitchen->k_id; ?> </td>
          
            <td> <?php echo $kitchen->k_name; ?> </td>
             <td> <?php if($kitchen->kitchen_type=="company") { echo "Company Owned";} if($kitchen->kitchen_type=="other") { echo "Third party";}?></td>
            <td> <?php echo $kitchen->k_address1 ." , ". $kitchen->k_address2 ." , ". $kitchen->k_address3; ?> </td>
            <td> <?php echo $kitchen->state; ?> </td>
            <td> <?php echo $kitchen->city; ?> </td>
            <td> <?php echo $kitchen->zipcode; ?> </td>
            <td> <a class="btn btn-sm btn-primary" href="<?php echo base_url()."superadmin/edit_kitchen_register/".$kitchen->id; ?>"> Edit </a> </td>
            <td><a href="#" class="btn btn-sm btn-danger delete_category" id="<?php echo $kitchen->id; ?>"> Delete </a>
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
				window.location="<?php echo base_url();?>superadmin/delete_kitchen_reg/"+id;
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
