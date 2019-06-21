<section>
<div class="row">
        <div class="col-md-6">
            <h3>View Employee</h3>
        </div>
        <div class="col-md-6" align="right">
        <a class="btn btn-sm btn-outline-primary" href="<?php echo base_url()."deliveryhub/delivery_employee" ?>"> Add Employee</a>
        </div>
    </div>
    <br>
<div class="row container">
       
        <table id="table" class="table table-responsive table-bordered">
            <thead>
                <tr align="center">
                    <th> S.No </th>
                   <th> DeliveryHub Id </th>
                    <th> Employee Id</th>
                    <th> Employee Name </th>
                    <th> Employee Role </th>
                    <th> Email Id </th>
                    <!-- <th> Mobile No </th> -->
                    <th> Local Address </th>
                    <th>Edit</th>
                    <th>Delete</th>

                </tr>
            </thead>
            <tbody>
                <?php
                     if($delivery_user_employee->num_rows() > 0)
                    {
                         $i = 1;
                         foreach ($delivery_user_employee->result() as $del) 
                        {
                ?>
                <tr align="center">
                    <td> <?php echo $i; ?> </td>
                    <td> <?php echo $del->delhub_name;?></td>
                    <td> <?php echo $del->emp_id; ?> </td>

                    <td> <?php echo $del->emp_name; ?> </td>
                    
                    <td> <?php echo $del->role_name; ?> </td>
                    <td> <?php echo $del->email_id; ?> </td>
                    <td> <?php echo $del->l_address1.",".$del->l_address2.",".$del->l_address3.",<br>".$del->city.",".$del->state.",".$del->zipcode ; ?> </td>
                    <td> <a class="btn btn-sm btn-primary" href="<?php echo base_url()."deliveryhub/edit_employee/".$del->id; ?>"> Edit </a> </td>
                    <td> <a href="#" class="btn btn-sm btn-danger delete_employee" id="<?php echo $del->id; ?>"> Delete </a> </td>
                </tr>
                <?php
                        $i++;
                        }
                    }
                ?>
            </tbody>            
        </table>
    <br><br><br><br>
    </div>   

</section>

<script>
$(document).ready(function() {
    $('#table').DataTable();
} );
</script>  

<script type="text/javascript">
	$(document).ready(function(){
		$(".delete_employee").click(function(){
			var id = $(this).attr("id");
			if(confirm("Are you sure you want to delete this?"))
			{
				window.location="<?php echo base_url();?>deliveryhub/delete_employee/"+id;
			}
			else
			{
				return false;
			}
		});
	});
</script>