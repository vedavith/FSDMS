<section>
<div class="row">
        <div class="col-md-6">
            <h3> Employees Approval</h3>
        </div>
        <div class="col-md-6" align="right">
        <a class="btn btn-sm btn-outline-primary" href="<?php echo base_url()."superadmin/kitchen_employee" ?>"> Add Employee</a>
        </div>
    </div>
    <br>
<div class="row container">
       <div class="table-responsive">
        <table id="table" class="table table-responsive table-bordered">
            <thead>
                <tr align="center">
                    <th> S.No </th>
                    <th> Kitchen Name </th>
                    <th> Employee Id</th>
                    <th> Employee Name </th>
                    <th> Employee Role </th>
                    <th> Email Id </th>
                    <th> Local Address </th>
                    <th>Approve</th>
                    

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
                    <td> <?php echo $meal->k_name; ?> </td>
                    <td> <?php echo $meal->emp_id; ?> </td>

                    <td> <?php echo $meal->emp_name; ?> </td>
                    
                    <td> <?php echo $meal->role; ?> </td>
                    <td> <?php echo $meal->email_id; ?> </td>
                    <td> <?php echo $meal->l_address1.",".$meal->l_address2.",".$meal->l_address3.",<br>".$meal->city.",".$meal->state.",".$meal->zipcode ; ?> </td>
                   <!-- <td> <?php //echo $meal->approve; ?></td>-->
                    <!--<td> <a class="btn btn-sm btn-primary" href="<?php //echo base_url()."superadmin/edit_employee/".$meal->id; ?>"> Edit </a> </td>-->
                    <td> <a href="#" class="btn btn-sm btn-danger delete_employee" id="<?php echo $meal->id; ?>"> Active </a> </td>
                </tr>
                <?php
                        $i++;
                        }
                    }
                ?>
            </tbody>            
        </table>
    </div>
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
				window.location="<?php echo base_url();?>superadmin/approved_employee/"+id;
			}
			else
			{
				return false;
			}
		});
	});
</script>