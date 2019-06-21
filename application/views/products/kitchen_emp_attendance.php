<div class="col-sm-6 col-md-9">
    
    <div class="row">
        <div class="col-md-6">
            <p class="h3" align="left"> View Employee Attendance </p>
        </div>
        <div class="col-md-6" align="right">
            <a class="btn btn-sm btn-outline-danger" href="<?php echo base_url()."superadmin/home"; ?>"> Back</a>
        </div>
    </div><br>

    <div class="row">
        <div class="card-body">
                <div class="container">
                    <div class="row">
                        <div class="col-md-2"></div>
                    <div class="col-md-4"> 
                        <select id="select_kitchen" class="form-control">
                            <option value = " "> Select kitchen name </option>
                       <?php
                       foreach ($kitchen_data->result() as $row) 
                       {
                       ?>
                            <option value="<?php echo $row->k_id; ?>"> <?php echo $row->k_name.'-'.$row->k_id; ?> </option>
                       <?php    
                       }
                       ?>
                        </select>
                        
                    </div>
                    <div class="col-md-4"> 
                    <input type="text"  class="form-control" id="select_date" onfocus="(this.type='date')" onblur="(this.type='text')"  placeholder="Select Date" value="">
                       
                        
                        
                    </div>
                    <!-- <div class="col-md-2" align="left">
                        <button class="btn btn-sm btn-info"> Submit </button>
                    </div> -->
                    </div>
        </div><br>
    <div class="container-fluid">
        <div class="table-responsive">
        <table id="table" class="table table-bordered">
            <thead>
                <tr align="center">
                    <th> S.No </th>
                    <th> Employee ID </th>
                    <th> Employee Name </th>
                    <th> Employee Role </th>
                    <th> Date </th>
                    <th> Attendance </th>
                </tr>
            </thead>        
        </table>
        <br>
        <br><br>
    </div>
    </div>  
</div>
<script>
$(document).ready(function() {
    $('#table').DataTable();
});
</script>
<script>
    $(document).ready(function(){
        $("#select_date").change(function(){
            
            var getKitchenId = $("#select_kitchen").val();
            var getDate = $('#select_date').val();

            if(getKitchenId == " ")
            {
                alert('Select Kitchen Id');
            }
            else
            {

                $.ajax({
                    url : '<?php echo base_url()."superadmin/ajaxCallKitchenAttendance"; ?>',
                    method : 'post',
                    data : {kitchen_id:getKitchenId,date:getDate},
                    dataType : 'JSON',
                    success : function(data){
                        if(data == 0)
                        {
                            $(".get_data").remove();
                            $(".dataTables_empty").show();
                        }
                        else
                        {   var count = 1;
                            var attendance_data = '';
                            
                            $.each(data,function(key,value){
                                console.log(value.attendance_flag);
                                var absent = '';
                                var present = '';
                                if(value.attendance_flag == 0)
                                {
                                    absent="checked='checked'";
                                    console.log('Abs '+absent);
                                }
                                else
                                {
                                    present = "checked='checked'";
                                    console.log('Pre '+present);
                                }
                                attendance_data += '<tr class="get_data">';
                                attendance_data += '<td>'+count+'</td>';
                                attendance_data += '<td>'+value.employee_id+'</td>';
                                attendance_data += '<td>'+value.employee_name+'</td>';
                                attendance_data += '<td>'+value.employee_role+'</td>';
                                attendance_data += '<td>'+value.set_date+'</td>';
                                attendance_data += '<td><label>Present&nbsp;<input type="radio" name="present'+count+'" class="abs_present" id="present" '+present+' data-id = "'+value.id+'" data-flag = "1"></label><label>Absent <input type="radio" name="present'+count+'" class="abs_present" id="absent" '+absent+' data-id = "'+value.id+'" data-flag = "0"></label></td>';
                                attendance_data += '</tr>';

                                console.log(attendance_data);
                                count++;
                            });
                            
                            $(".get_data").remove();
                            $(".dataTables_empty").hide();
                            $("#table").append(attendance_data);
                        }
                    }
                });
            }
        });
    });
</script>

<script>
$(document).on("change",".abs_present",function(e){

    var id = $(this).data('id');
    var get_flag = $(this).data('flag'); 
    alert(get_flag+' '+id);
    $.ajax({
        url : '<?php echo base_url()."superadmin/ajaxCallUpdateAttendance" ?>',
        method : 'post',
        data : {setId:id,setFlag:get_flag},
        success : function(data){
            if(data)
            {
                alert('Attendance Updated');

            }
        }
    });

});
</script>