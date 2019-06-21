<div class="col-sm-6 col-md-9">
<div class="row">
        <div class="col-md-6">
            <h3>Prepare Orders</h3>
        </div>
       <!--  <div class="col-md-6" align="right">
        <a class="btn btn-sm btn-outline-primary" href="<?php //echo base_url()."deliveryhub/delivery_employee" ?>"> Add Employee</a>
        </div> -->
    </div>
    <br>
  <div class="row">
        <div class="card-body">
            <div class="container-fluid"> 
<!-- <div class="row container">-->
       <div class="table-responsive">
        <table id="table" class="table table-bordered">
            <thead>
                <tr align="center">
                    <th> S.No </th>
                    <th> Product_sku </th>
                    <th> Quantity </th>
                    <th> Delivery On </th>
                    <th> Order Status </th>
                </tr>
            </thead>
            <tbody>
                <?php
                     if($assigned_data->num_rows() > 0)
                    {
                         $i = 1;
                         foreach ($assigned_data->result() as $ad) 
                        {
                ?>
                <tr align="center">
                    <td> <?php echo $i; ?> </td>
                    <td> <?php echo $ad->sku;?></td>
                    <td> <?php echo $ad->sum; ?> </td>
                    <td> <?php echo $ad->assigned_date; ?> </td>
                    <td><label> Pending <input type="radio" class="form-control" name="status_selector" checked> </label> &nbsp;&nbsp; <label>  Finished <input type="radio" class="form-control yes" name="status_selector" data-kitchen="<?php echo $this->session->userdata('kitchen_id') ?>" data-sku = '<?php echo $ad->sku; ?>' data-dates='<?php echo $ad->assigned_date; ?>'> </label> </td>                   
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
    </div>  
    <br><br><br><br> 
</div>

<script>
$(document).ready(function() {
    $('#table').DataTable();
} );
</script>  

<script type="text/javascript">
    $(document).ready(function(){
        $('.yes').on('click',function(e){
            var kitchen_id = $(this).data('kitchen');
            var product_sku = $(this).data('sku');
            var dates = $(this).data('dates');
            // console.log(kitchen_id);
            // console.log(product_sku);
            // console.log(dates);
            if(confirm('Is order cooked and ready ?'))
            {
                $.ajax({
                    url : '<?php echo base_url()."kitchen/update_assigned_product_status" ?>',
                    method : 'post',
                    data : {kitchen_id:kitchen_id,sku:product_sku,date:dates},
                    success : function(data){
                        alert('Marked as cooked and ready');
                    }
                });
            }
        });
    });
</script>


