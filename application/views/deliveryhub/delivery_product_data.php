<div class="col-sm-6 col-md-9">
    
    <div class="row">
        <div class="col-md-6">
            <p class="h3" align="left"> View Assign Orders </p>
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
<!--                         <input type="date" class="form-control" id="date" value=""/> -->
                       <input id="date" name="date"  class="datepicker-input form-control " type="date" data-date-format="yyyy-mm-dd" >  
                    </div>
                    </div>
        </div><br>
    <div class="container-fluid">
        <div class="table-responsive">
        <table id="table" class="table table-bordered">
            <thead>
                <tr align="center">
                    <th> S.No </th>
                    <th> KitchenId</th>
                    <th> Product SKU </th>
                    <th> Assigned Orders </th>
                    <th> Date </th>
                    <th> Assigned Time</th>
                    
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
        $("#select_kitchen,#date").change(function(){
            var selectedText = document.getElementById('date').value;
           var selectedDate = new Date(selectedText);
           var now = new Date();
           if (selectedDate < now.setDate(now.getDate()-1)) {
            alert("Date must be in the future");
             
             $(".get_data").remove();
             $(".dataTables_empty").show();
            document.getElementById('date').value = NaN;
           }
            //alert("hi");
            var getKitchenId = $("#select_kitchen").val();
            var getdate = $("#date").val();

            if(getKitchenId && getdate)
            {
                $.ajax({
                    type:'POST',
                    url:'<?php echo base_url();?>deliveryhub/fetch_kitchen_product',
                    data:{kit_id:getKitchenId,date_val:getdate},
                    dataType : 'JSON',
                    success:function(data){
                        console.log(data);
                        if(data == 0)
                        {
                            $(".get_data").remove();
                            $(".dataTables_empty").show();
                        }

                         else
                        {   var sno = 1;
                            var assign_data = '';
                            
                            $.each(data,function(key,value){
                                assign_data += '<tr class="get_data">';
                                assign_data += '<td>'+sno+'</td>';
                                assign_data += '<td>'+value.kitchen_id+'</td>';
                                assign_data += '<td>'+value.product_sku+'</td>';
                                assign_data += '<td>'+value.count+'</td>';
                                assign_data += '<td>'+value.date+'</td>';
                                assign_data += '<td>'+value.time_stamp+'</td>';
                                assign_data += '</tr>';

                                console.log(assign_data);
                                sno++;
                            });
                            
                            $(".get_data").remove();
                            $(".dataTables_empty").hide();
                            $("#table").append(assign_data);
                        }
                    }
                });
            }
            
        });
    });
// $(document).on('click','.undo',function(e){
//     if(confirm("Do you Want to Undo this Assignment ?"))
//     {
//         var id = $(this).data('id')
//         var sku = $(this).data('sku')
//         var orders = $(this).data('order')
//         var date = $(this).data('date')
//         $.ajax({
//             url : '<?php //echo base_url();?>superadmin/undo_assign',
//             type : 'POST',
//             data : { id : id,sku_id : sku,orders_val : orders,date_val:date},
//             success:function (data) {
//                if(data > 0)
//                {
//                 alert("Previous assignment successfully undone ");
//                 window.location.href='<?php //echo base_url()."superadmin/orders_list"?>';
//                }
//             } 

//         });
//     }
   

// });
</script>


