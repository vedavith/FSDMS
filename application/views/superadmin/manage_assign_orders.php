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
                   <!--  <div class="col-md-4"> 
                    <input type="text"  class="form-control" id="select_date" onfocus="(this.type='date')" onblur="(this.type='text')"  placeholder="Select Date" value="">
                       
                        
                        
                    </div> -->
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
                    <th> Kitchen ID </th>
                    <th> Product SKU </th>
                    <th> Assigned Orders </th>
                    <th> Date </th>
                    <th> Assigned Time</th>
                    <th> Undo</th>
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
        $("#select_kitchen").change(function(){
            
            var getKitchenId = $("#select_kitchen").val();
            var today = new Date();
            var dd = String(today.getDate()).padStart(2, '0');
            var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
            var yyyy = today.getFullYear();

            today = yyyy + '-' + mm + '-' + dd;
           

            if(getKitchenId)
            {
                $.ajax({
                    type:'POST',
                    url:'<?php echo base_url();?>superadmin/fetch_assign_orders',
                    data:{kit_id:getKitchenId},
                     dataType : 'JSON',
                    success:function(data){
                        if(data == 0)
                        {
                             $(".get_data").remove();
                            $(".dataTables_empty").show();
                        }
                         else
                        {   var count = 1;
                            var assign_data = '';
                            
                            $.each(data,function(key,value){
                                var disable = "";
                                assign_data += '<tr class="get_data">';
                                assign_data += '<td>'+count+'</td>';
                                assign_data += '<td>'+value.kitchen_id+'</td>';
                                assign_data += '<td>'+value.product_sku+'</td>';
                                assign_data += '<td>'+value.assigned_orders+'</td>';
                                assign_data += '<td>'+value.date+'</td>';
                                assign_data += '<td>'+value.time_stamp+'</td>';
                                if(value.date < today)
                                {
                                    disable = "disabled";
                                }
                                
                                assign_data += '<td><input type="button" class="btn btn-sm btn-danger undo" name="undo" id="undo_transaction" value="Undo" data-id="'+value.id+'" data-sku="'+value.product_sku+'" data-order="'+value.assigned_orders+'" data-date="'+value.date+'" '+disable+'></td>';

                                assign_data += '</tr>';

                                console.log(assign_data);
                                count++;
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
$(document).on('click','.undo',function(e){
    if(confirm("Do you Want to Undo this Assignment ?"))
    {
        var id = $(this).data('id')
        var sku = $(this).data('sku')
        var orders = $(this).data('order')
        var date = $(this).data('date')
        $.ajax({
            url : '<?php echo base_url();?>superadmin/undo_assign',
            type : 'POST',
            data : { id : id,sku_id : sku,orders_val : orders,date_val:date},
            success:function (data) {
               if(data > 0)
               {
                alert("Previous assignment successfully undone ");
                window.location.href='<?php echo base_url()."superadmin/orders_list"?>';
               }
            } 

        });
    }
   

});
</script>


