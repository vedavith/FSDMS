<div class="col-sm-6 col-md-10">
  <div class="row">
    <div class="col-md-6" align="left">
      <p class="h3"> Manage Kitchen Admin</p>
    </div>
    <div class="col-md-6" align="right">
      <a class="btn btn-sm btn-outline-danger" href="<?php echo base_url()."superadmin/create_kitchen_admin"; ?>"> Back</a>
    </div>
  </div><br>

  <div class="container-fluid">
    <table id="table" class="table table-bordered">
      <thead>
        <th> S.No </th>
        <th> Kitchen Id </th>
        <th> First Name </th>
        <th> Last Name </th>
        <th> Email Id </th>
        <th> User Name</th>
       
        <th> Edit </th>
        <th> Delete </th>
      </thead>
      <tbody align="center">
        <?php
					if($kitchen_admin_data->num_rows() > 0)
					{
						$i = 1;
						foreach ($kitchen_admin_data->result() as $kitchen)
						{

          ?>
          <tr>
            <td> <?php echo $i; ?> </td>
           <td> <?php echo $kitchen->kitchen_id; ?> </td>
            <td> <?php echo $kitchen->first_name; ?> </td>
            <td> <?php echo $kitchen->last_name ; ?> </td>
            <td> <?php echo $kitchen->email_id; ?> </td>
            <td> <?php echo $kitchen->user_name; ?> </td>
          
            <td> <a class="btn btn-sm btn-primary" href="<?php echo base_url()."superadmin/edit_kitchen_admin/".$kitchen->id; ?>"> Edit </a> </td>
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
				window.location="<?php echo base_url();?>superadmin/delete_kitchen_admin/"+id;
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
