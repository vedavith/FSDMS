<div class="col-sm-6 col-md-10">
  <div class="row">
    <div class="col-md-6" align="left">
      <p class="h3"> Manage Corporate Company </p>
    </div>
    <div class="col-md-6" align="right">
      <a class="btn btn-sm btn-outline-danger" href="<?php echo base_url()."superadmin/corporate_customer"; ?>"> Back</a>
    </div>
  </div><br>

  <div class="container-fluid">
    <div class="table-responsive">
    <table id="table" class="table table-bordered">
      <thead>
        <th> S.No </th>
        <th> User name </th>
        <th> Email </th>
        <th> Phone No</th>
        
        <th> Address </th>
        
        <th> Edit </th>
        <th> Delete </th>
      </thead>
      <tbody align="center">
        <?php
					if($corporate_data->num_rows() > 0)
					{
						$i = 1;
						foreach ($corporate_data->result() as $corporate)
            {
          ?>
          <tr>
            <td> <?php echo $i; ?> </td>
            <td> <?php echo $corporate->first_name." ".$corporate->first_name; ?> </td>
            <td> <?php echo $corporate->rep_email_id; ?> </td>
            <td> <?php echo $corporate->rep_phone_number; ?> </td>
          
            <td> <?php echo $corporate->company_address.",".$corporate->company_city.",".$corporate->company_state ?> </td>
            

           
            <td> <a class="btn btn-sm btn-primary" href="<?php echo base_url()."superadmin/edit_corporate/".base64_encode($corporate->rep_email_id); ?>"> Edit </a> </td>
            <td><a href="#" class="btn btn-sm btn-danger delete_category" id="<?php echo $corporate->rep_email_id; ?>"> Delete </a>
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
				window.location="<?php echo base_url();?>superadmin/delete_corporate_customer/"+id;
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
