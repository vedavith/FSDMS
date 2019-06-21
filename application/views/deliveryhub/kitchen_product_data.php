<section>
<div class="row">
        <div class="col-md-6">
            <h3>Kitchen Orders </h3>
        </div>
        <!--<div class="col-md-6" align="right">
        <a class="btn btn-sm btn-outline-primary" href="<?php //echo base_url()."superadmin/kitchen_employee" ?>"> Add Employee</a>
        </div>-->
    </div>
    <br>
<div class="row">
    <div class="col-md-12">
       <div class="table-responsive">
        <table id="table" class="table table-responsive table-bordered">
            <thead align="center">
                <tr >
                    <th> S.No </th>
                   <th> Kitchen Id </th>
                    
                    <th> Product SKU </th>
                    <th> Quanity</th>
                    
                   
                    <th> Date </th>
                    
                   
                    

                </tr>
            </thead>
            <tbody align="center">
                <?php
                     if($kitchen_data->num_rows() > 0)
                    {
                         $i = 1;
                         foreach ($kitchen_data->result() as $del) 
                        {
                ?>
                <tr >
                    <td> <?php echo $i; ?> </td>
                    <td> <?php echo $del->kitchen_id ;?></td>
                    <td> <?php echo $del->product_sku ; ?> </td>

                    <td> <?php echo $del->assigned_orders; ?> </td>
                    
                    <td> <?php echo $del->date; ?> </td>
                   
                    
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
    <br><br><br><br>
    </div>   

</section>

<script>
$(document).ready(function() {
    $('#table').DataTable();
} );
</script>  

