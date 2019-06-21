<div class="col-sm-6 col-md-9">
            <div class="row">
                <div class="col-sm-6 col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <p class="h5" align="center">
                                Quick Links
                            </p>
                        </div>
                        <div class="card-body">
                            <ul class="ul">
                               
                                <li class="li">
                                    <a href="#"> Dashboard </a>
                                    <ul>
                                      <li><a class="" href="<?php echo base_url()."kitchen/view_employee"; ?>"> Create Employee  </a></li>
                                      <li><a class="" href="<?php echo base_url()."kitchen/create_emp_role"; ?>"> Create Role  </a></li>
                                      <li><a class="" href="<?php echo base_url()."kitchen/kitchen_stock"; ?>"> Deduct Quantity  </a></li>
                                      <li><a class="" href="<?php echo base_url()."kitchen/kitchen_dc"; ?>"> Delivery Challan  </a></li>
                                       <li><a class="" href="<?php echo base_url()."kitchen/assigned_orders"; ?>"> Assigned Orders  </a></li>

                                    </ul>
                                </li>
                               

                            </ul>
                        </div>

                    </div>
                        <!-- Quick Links Card  -->

                    </div>
                     <div class="card-body">
                       
  
 
                         <?php 
                          if($note_data->num_rows() > 0)
                          {
                          foreach($note_data->result() as $row)
                          {
                            
                            echo " <div class='alert alert-info  alert-dismissible'>";
                            // echo "<button type='button' class='close delete_category' data-dismiss='alert' id='".$row->id."'>&times;</button>";
                            echo "<a href='#' class='close delete_category' id='".$row->id."'> &times; </a>";

                           echo "<strong>Info! </strong>".$row->message;
                           echo " </div>";
                          }
                        }
                          ?>
                     
                        </div>
                </div>
                <br/>
                
                <div class="row">
                   <div class="col-sm-12 col-md-12">
                    <div class="card">
                        <div class="card-header">
                          <center>One week Orders list</center>
                        </div>
                          <div class="card-body">
                          <table id="table" class="table table-bordered">
                                <thead align="center">
                                  <th> S.No </th>
                                
                                  <th> Product SKU</th>
                                  <th> Quantity </th>
                                  <th> Delivery ON </th>
                                 
                                </thead>
                                <tbody align="center">
                                  <?php
                                if($total_order->num_rows() > 0)
                                  {
                                    $i = 1;
                                    foreach ($total_order->result() as $kitchen)
                                    {

                                  ?>
                                  <tr>
                                    <td> <?php echo $i; ?> </td>
                                   <td> <?php echo $kitchen->sku; ?> </td>
                                  
                                    <td> <?php echo $kitchen->sum; ?> </td>
                                    
                                    <td> <?php echo $kitchen->assigned_date; ?> </td>
                                    
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
                <br/><br><br/>
            </div>
        </div>
    <!-- Side row closed -->
    </div>
    <!-- sidebar container fluid closed -->
</div>
<script type="text/javascript">
    $(document).ready(function(){
        $(".delete_category").click(function(){
            var id = $(this).attr("id");
            if(confirm("Are you sure you want to delete this?"))
            {
                window.location="<?php echo base_url();?>kitchen/delete_notify/"+id;
            }
            else
            {
                return false;
            }
        });
    });
</script>