<br/><br/><br/>
  <div class="row">
    <div class="col-md-6" align="center">
      <p class="h3"> Manage Company Representatives</p>
    </div>
    <div class="col-md-4" align="right">
      <a class="btn btn-sm btn-outline-danger" href="<?php echo base_url()."home/representative"; ?>"> Back</a>
    </div>
  </div><br>

  <div class="container-fluid">
    <div class="table-responsive">
    <table id="table" class="table table-bordered">
      <thead>
        <th> S.No </th>
        <th> Company Name </th>
        <th> Branch Name </th>
        <th> Name</th>
        <th> Email </th>
        <th> Phone</th>
        <th> Designation</th>
        <th> Address</th>
        <th> Edit </th>
        <th> Delete </th>
      </thead>
      <tbody align="center">
        <?php
					if($representative_data->num_rows() > 0)
					{
						$i = 1;
						foreach ($representative_data->result() as $represent)
            {
          ?>
          <tr>
            <td> <?php echo $i; ?> </td>
            <td> <?php echo $represent->company; ?> </td>
            <td> <?php echo $represent->branch; ?> </td>
            <td> <?php echo $represent->rep_first_name .' '.$represent->rep_last_name ; ?> </td>
            <td> <?php echo $represent->rep_email_id; ?> </td>
            <td> <?php echo $represent->rep_phono_no; ?> </td>
            <td> <?php echo $represent->rep_designation; ?> </td>
            <td> <?php echo $represent->rep_address1 .",".$represent->rep_address2.",".$represent->rep_address3; ?> </td>
            <td> <a class="btn btn-sm btn-primary" href="<?php echo base_url()."home/edit_representative/".$represent->id; ?>"> Edit </a> </td>
            <td><a href="#" class="btn btn-sm btn-danger delete_category" id="<?php echo $represent->id; ?>"> Delete </a>
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
				window.location="<?php echo base_url();?>home/delete_repres/"+id;
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
