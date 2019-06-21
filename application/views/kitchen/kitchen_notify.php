<div class="col-sm-6 col-md-10">
  <div class="row">
    <div class="col-md-6" align="left">
      <p class="h3"> Receiving Notification</p>
    </div>
    <div class="col-md-6" align="right">
      <a class="btn btn-sm btn-outline-danger" href="<?php echo base_url()."kitchen/kitchen_home"; ?>"> Back</a>
    </div>
  </div><br>

  <div class="container-fluid">
    <table id="table" class="table table-bordered">
      <thead align="center">
        <th> S.No </th>
        <th> Message </th>
        <th> Delete</th>
      </thead>
      <tbody align="center">
        <?php
					if($note_data->num_rows() > 0)
					{
						$i = 1;
						foreach ($note_data->result() as $kitchen)
						{

          ?>
          <tr>
            <td> <?php echo $i; ?> </td>
           <td> <?php echo $kitchen->message; ?> </td>
           
           
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
				window.location="<?php echo base_url();?>kitchen/delete_notify/"+id;
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
