<section>
<div class="row">
        <div class="col-md-6">
            <h3>View Employee</h3>
        </div>
        <div class="col-md-6" align="right">
        <a class="btn btn-sm btn-outline-primary" href="<?php echo base_url()."kitchen/kitchen_employee" ?>"> Add Employee</a>
        </div>
    </div>
    <br>
<div class="row container">
       
        <table id="table" class="table table-responsive table-bordered">
            <thead>
                <tr align="center">
                    <th> S.No </th>
                    <th> Kitchen Id </th>
                    <th> Employee Id</th>
                    <th> Employee Name </th>
                    <th> Employee Role </th>
                    <th> Email Id </th>
                    <!-- <th> Mobile No </th> -->
                    <th> Local Address </th>
                    <?php
                    if($this->session->userdata('kitchen_type') == "other")
                    {
                    ?>
                    <th>Edit</th>
                    <th>Delete</th>
                    <?php
                    }
                    ?>
                </tr>
            </thead>
            <tbody>
                <?php
                     if($kitchen_user_employee->num_rows() > 0)
                    {
                         $i = 1;
                         foreach ($kitchen_user_employee->result() as $meal) 
                        {
                ?>
                <tr align="center">
                    <td> <?php echo $i; ?> </td>
                    <td> <?php echo $meal->kitchen_id; ?> </td>
                    <td> <?php echo $meal->emp_id; ?> </td>

                    <td> <?php echo $meal->emp_name; ?> </td>
                    
                    <td> <?php echo $meal->role; ?> </td>
                    <td> <?php echo $meal->email_id; ?> </td>
                    <td> <?php echo $meal->l_address1.",".$meal->l_address2.",".$meal->l_address3.",<br>".$meal->city.",".$meal->state.",".$meal->zipcode ; ?> </td>
                    <?php
                    if($this->session->userdata('kitchen_type') == "other")
                    {
                    ?>
                    <td> <a class="btn btn-sm btn-primary" href="<?php echo base_url()."kitchen/edit_employee/".$meal->id; ?>"> Edit </a> </td>
                    <td> <a href="#" class="btn btn-sm btn-danger delete_employee" id="<?php echo $meal->id; ?>"> Delete </a> </td>
                    <?php
                    }
                    ?>
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
				window.location="<?php echo base_url();?>kitchen/delete_employee/"+id;
			}
			else
			{
				return false;
			}
		});
	});
</script>