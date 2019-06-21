 <div class="col-sm-6 col-md-9">
            <div class="row">
                <div class="col-sm-6 col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-md-4">
                            <a class="" href="<?php echo base_url()."superadmin/home"; ?>"> < Back</a>
                        </div>
                        <div class="col-md-4">
                            <p class="h5" align="center">
                                One Month Product Orders
                            </p>
                        </div>
                        <!-- <div class="col-md-4 " align="right">
                            <a class="btn btn-sm btn-primary" href="<?php //echo base_url()."superadmin/assign_orders_kitchen"; ?>">
                                Assign Orders</a>
                            
                        </div> -->
                        </div>
                        </div>
                        <div class="card-body">
                          
                             <div class="container-fluid">
                               <div class="table-responsive">
                                <table id="table" class="table table-bordered">
                                  <thead align="center">
                                  



                                   <?php
                                   
                                   array_push($get_array,"date");

                                   $get_array_copy = $get_array;

                                   foreach($get_array as $key=>$value)
                                   {
                                    ?>
                                    <th> 
                                     <?php
                                         
                                      echo $value; 
                                   

                                      ?>
                                      
                                      </th>
                                      <?php
                                   }
                                    ?>
                               
                                  </thead>

                                <tbody align="center">
                                  <?php
                                  $count = 0;
                                 $set_array = array();
                                   foreach($data_array as $key =>$value)
                                   {
                                     $set_array[$count] = $value;
                                     $set_array[$count]['date'] = $key;
                                     $count++;
                                   }
                                   for($x = 0; $x < count($set_array); $x++)
                                   {
                                    echo "<tr>";

                                      foreach($set_array[$x] as $row=>$val)
                                      { 
                                          if(preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/",$val))
                                          {
                                            
                                            echo "<td>";
                                             echo "<a href='#' data-toggle='collapse' data-target='#accordion".$x."' class='clickable' data-date='".$val."' data-appender='body".$x."'>".date('d  F  Y',strtotime($val))."</a>";
                                             echo "</td>";
                                          }
                                          else
                                          {
                                             echo "<td>".$val."</td>";
                                          }
                                         
                                         
                                      }
                                     echo '<tr>';
                                            echo '<td colspan="12" align="left">';
                                            echo '<div id="accordion'.$x.'" class="collapse">';
                                            echo "<table class='table table-hover'>";
                                            echo "<thead align='center'>";
                                            echo "<tr>"; 
                                        // array_pop($get_array_copy);
                                            $headers_array = array("S.No","Kitchen ID","Assigned Orders","Date");
                                            foreach($headers_array as $key=>$value)
                                            {
                                                echo "<th>".$value."</th>";
                                            }
                                            echo "</tr>"; 
                                            echo "</thead>";
                                            echo "<tbody class='body".$x."'>";
                                            echo "</tbody>";
                                            echo "</table>";
                                            echo '</div>';
                                            echo '</td>';
                                            echo '</tr>';
                                            echo '</tr>';
                                           // $x++;
                                      
                                   }  
                                   ?>
                                      
                                  </tbody> 
                                </table>
                              </div>
                                <br><br><br>
                              </div>
                        </div>
                    </div><br/><br/><br/><br/>
                        <!-- Quick Links Card  -->
                    </div>
                </div>
            </div>
        </div>
    <!-- Side row closed -->
    </div>
    <!-- sidebar container fluid closed -->
</div>
<script>

$(document).ready(function(){
    $('.clickable').click(function(e){
        //alert('test');
        var products_json = <?php echo json_encode($get_array_copy); ?>;
        var get_date =  $(this).data('date');
        var appender = $(this).data('appender');
       $.ajax({
           url : '<?php echo base_url();?>/superadmin/ajaxCallGetassigned',
           method : 'post',
           data : {date:get_date,products:products_json},
           dataType : 'json',
           success : function(data){
            var get_data = data;
            var append_rows = "";

            $.each(data,function (key,value) {
                append_rows += "<tr class='table_data' colspan='12'><td colspan='12'><strong> SKU : "+key+"</strong></td></tr>";
                var counter = 1;
               $.each(value,function(key1,value1){
                   append_rows += "<tr class='table_data table-info' align='center'>";
                   append_rows += "<td>"+counter+"</td>";
                //    append_rows += "<td>"+key+"</td>";
                   append_rows += "<td>"+value1.kitchen_id+"</td>";
                   append_rows += "<td>"+value1.assigned_orders+"</td>";
                   append_rows += "<td>"+value1.date+"</td>";
                   append_rows += "</tr>";
                   counter++;
               });
            });
            
            $('.table_data').remove();
            $('.'+appender).append(append_rows);

           }
       });
    });
});
</script>