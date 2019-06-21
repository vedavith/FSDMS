<div class="col-sm-6 col-md-9">
<div class="row">
        <div class="col-md-6">

            <h3><?php echo date("d-m-Y"); ?> Attendance</h3>
        </div>
        <div class="col-md-6" align="right">
        <!-- <a class="btn btn-sm btn-outline-primary" href="<?php //echo base_url()."kitchen/kitchen_employee" ?>"> Add Employee</a> -->
        </div>
    </div>
    <br>
<div class="row">
       <div class="card-body">
        <div class="container-fluid">
        <div class="table-responsive"> 
         <table id="table" class="table table-bordered">
            <thead>
                <tr align="center">
                    <th> S.No </th>
                    <th> Employee Id</th>
                    <th> Employee Name </th>
                    <th> Employee Role </th>
                    <th> Attendance</th>
                    <!-- <th>Edit</th>
                    <th>Delete</th> -->

                </tr>
            </thead>
            <tbody>
                <?php
                     if($select_current_attendance->num_rows() > 0)
                    {
                         $i = 1;
                         foreach ($select_current_attendance->result() as $meal) 
                        {
                ?>
                <tr align="center">
                    <td> <?php echo $i; ?> </td>
                   
                    <td> <?php echo $meal->employee_id; ?> </td>

                    <td> <?php echo $meal->employee_name; ?> </td>
                    
                    <td> <?php echo $meal->employee_role; ?> </td>

                    <td style="width: 15rem;"><label>Present  <input type="radio" class="present" data-empid = '<?php echo $meal->employee_id; ?>' data-date = '<?php echo $meal->set_date; ?>' name="kitc_status<?php echo $i; ?>" /></label> &nbsp;&nbsp;  <label>Absent <input type="radio" class="pending" name="kitc_status<?php echo $i; ?>" checked/></label>  </td>
                   
                    
                    <!-- <td> <a class="btn btn-sm btn-primary" href="<?php //echo base_url()."kitchen/edit_employee/".$meal->id; ?>"> Edit </a> </td> -->
                    <!-- <td> <a href="#" class="btn btn-sm btn-danger delete_employee" id="<?php //echo $meal->id; ?>"> Delete </a> </td> -->
                </tr>
                <?php
                        $i++;
                        }
                    }
                ?>
            </tbody>            
        </table>
    </div>
</div>
</div>
    <br><br><br><br>
    </div>   

</div>

<script>
$(document).ready(function() {
    $('#table').DataTable();
} );
</script>  
<script>
$(document).ready(function(){
    $('.present').change(function(){
        var emp_id = $(this).data('empid');
        var date = $(this).data('date');
        $.ajax({
            url : '<?php echo base_url()."kitchen/ajaxCallAttendance"; ?>',
            method : 'post',
            data : {employee_id:emp_id, date:date},
            success : function(data){
                if(data)
                {
                    alert('Updated');
                    location.reload(true);
                }
            }
        });
    });
});
</script>