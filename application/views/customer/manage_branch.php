<div class="col-sm-6  col-md-12">
  <div class="row">
    <div class="col-md-6" align="left">
      <p class="h3"> Manage Company Branch</p>
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
        <th> Company Name </th>
        <th> Branch Name </th>
        <th> Phone No</th>
        <th> Address </th>
        <th> Edit </th>
        <th> Delete </th>
      </thead>
      <tbody align="center">
        <?php
					if($branch_data->num_rows() > 0)
					{
						$i = 1;
						foreach ($branch_data->result() as $branch)
            {
          ?>
          <tr>
            <td> <?php echo $i; ?> </td>
            <td> <?php echo $branch->company; ?> </td>
            <td> <?php echo $branch->branch_name; ?> </td>
            <td> <?php echo $branch->branch_telephone; ?> </td>
          
            <td> <?php echo $branch->branch_address1.",".$branch->branch_address2.",".$branch->branch_address3; ?> </td>
            

           
            <td> <a class="btn btn-sm btn-primary" href="<?php echo base_url()."home/edit_branch/".$branch->id; ?>"> Edit </a> </td>
            <td><a href="#" class="btn btn-sm btn-danger delete_category" id="<?php echo $branch->id; ?>"> Delete </a>
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
				window.location="<?php echo base_url();?>home/delete_branch/"+id;
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
