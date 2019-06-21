<section>
<div class="row">
        <div class="col-md-6">
            <h3>Delivery Orders</h3>
        </div>
       <!--  <div class="col-md-6" align="right">
        <a class="btn btn-sm btn-outline-primary" href="<?php //echo base_url()."deliveryhub/delivery_employee" ?>"> Add Employee</a>
        </div> -->
    </div>
    <br>
    <div class="table-responsive">
<div class="row container">
       <div class="table-responsive">
        <table id="table" class="table table-responsive table-bordered">
            <thead>
                <tr align="center">
                    <th> S.No </th>
                   <th> Kitchen Name </th>

                    <th> Kitchen Address</th>
                    <th> OrderId </th>
                    <th> UserId </th>
                    <th> Main Address</th>
                    <th> Branch Address</th>
                    <th> Executives Name</th>
                    <th> Receive</th>

                </tr>
            </thead>
            <tbody>
                <?php
                     if($del_data->num_rows() > 0)
                    {
                         $i = 1;
                         foreach ($del_data->result() as $del) 
                        {
                ?>
                <tr align="center">
                    <td> <?php echo $i; ?> </td>
                    <td> <?php echo $del->k_name;?></td>
                    <td> <?php echo $del->k_address1.','.$del->k_address2.','.$del->k_address3.','.$del->city.','.$del->state.','.$del->zipcode; ?> </td>
                    <td> <?php echo $del->order_id; ?> </td>
                    <td> <?php echo $del->user_id; ?> </td>
                    <td> <?php echo $del->main_address; ?></td>
                    <td> <?php echo $del->branch_address;?></td>
                    <td> <?php echo $del->emp_name;?></td>
                   

                     <td><a href="#" class="btn btn-sm btn-danger delete_category" id="<?php echo $del->del_id; ?>"> Receive </a>


                   
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
        $(".delete_category").click(function(){
            var id = $(this).attr("id");
            if(confirm("Are you sure you want to delete this?"))
            {
                window.location="<?php echo base_url();?>kitchen/receive_del_executive/"+id;
            }
            else
            {
                return false;
            }
        });
    });
</script>


