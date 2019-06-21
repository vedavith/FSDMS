<br><br><br><br><br>
<section>
<div class="container-fluid">  
    <div class="row">
      <div class="col-md-6" align="left">
        <p class="h3"> Cart </p>
      </div>
      <div class="col-md-6" align="right">
        <a class="btn btn-sm btn-outline-danger" href="<?php echo base_url()."home"; ?>"> Back</a>
      </div>
    </div><br>

    <div class="container-fluid">
      <table id="table" class="table table-bordered cart_details">
        <thead>
          <th> S.No </th>
          <th> Product SKU </th>
          <th> Product Name </th>
          <th> Price </th>
          <th> Product GST(%) </th>
          <th> Price (Incl GST) </th>
          <th> Optional Product </th>
          <th></th>
          <th> Product Quantity </th>
          <th></th>          
          <th> Product Price </th>
          <!-- <th> Sub Total </th> -->
          <th> Remove</th>
        </thead>
        <tbody align="center">
            <?php
            if($cart_products_on_id->result())
            {
              $count = 1;
              $sum = 0;
              foreach($cart_products_on_id->result() as $items)
              {
            ?>
            <tr>
              <td> <?php echo $count; ?> </td>
              <td> <?php echo $items->sku; ?> </td>
              <td> <?php echo $items->product_name; ?> </td>
              <td> <?php echo $items->subtotal; ?> </td>
              <td> <?php echo $items->gst; ?> </td>
              <td> 
                <?php 
                  $gst = $items->gst;
                  $price = $items->subtotal;
                  $incl_gst = $price + (($price * $gst) / 100);
                  echo $incl_gst;
                ?> 
              </td>
               <td> 
                <?php 
                  if($items->optional_sku == "")
                  {
                    echo "No Options";
                  }
                  else
                  {
                ?>
                  <a href='#' data-toggle='collapse' data-target='#accordion<?php echo $count; ?>' class='optional_summary_click clickable'> Optional Product </a>
                <?php    
                  }
                ?>
              </td>
              <td>  
                <button type="button" class="btn btn-sm btn-success add_product" data-incrementer = "<?php echo $items->unique_order_id; ?>"> <b> + </b> </button> 
              </td> 
              <td> 
                <input type="number" class="form-control quantity" id="<?php echo $items->unique_order_id; ?>" value="<?php echo $items->quantity; ?>" min="1" readonly/>
              </td>
              <td>  
                <button type="button" class="btn btn-sm btn-success deduct_product" data-decrementer = "<?php echo $items->unique_order_id; ?>"> <b> - </b> </button>
              </td>
              <td> 
                    <a href='#' data-toggle='collapse' data-target='#accordion1<?php echo $count; ?>' class='main_summary_click clickable'> 
                      <?php 
                          echo "Main :". $product_subtotal = ($items->subtotal + ($items->subtotal * $items->gst/100)) * $items->quantity;
                          echo "<br>";
                          $sum_optional = 0;

                          if(!empty($items->optional_subtotal))
                          {

                            $optional_subtotal_array = explode(",",$items->optional_subtotal);
                            $optional_gst_array = explode(",",$items->optional_gst);
                            $optional_quantity_array = explode(",",$items->optional_quantity);
                            
                              for($h = 0; $h < count($optional_subtotal_array); $h++)
                              {
                                $sum_optional = $sum_optional + ($optional_subtotal_array[$h] + ($optional_subtotal_array[$h] * $optional_gst_array[$h]/100)) * $optional_quantity_array[$h];
                              }
                          }
                          //echo @$optional_subtotal = ($items->optional_subtotal + ($items->optional_subtotal * $items->optional_gst/100)) * $items->optional_quantity;
                          echo "Optional : ". $sum_optional;
                          echo "<br>";
                          echo "Total : ".$total =  $product_subtotal + $sum_optional;  
                          //echo $items->price + ($items->optional_subtotal + ($items->optional_subtotal * $items->optional_gst/100)); 
                      ?> 
                    </a>
              </td>
              <!-- <td> <?php echo  $sum += $total; ?> </td> -->
              <td> <button type="button" class="btn btn-sm btn-danger remove_product" id="<?php echo $items->unique_order_id; ?>"> <b>Remove </b> </button> </td>
            </tr>    
            <?php 
               if($items->optional_sku != "")
               {
           ?>
           <tr class="optional_summary">
             <td colspan="12">
               <div id="accordion<?php echo $count; ?>" class="optional collapse">
               <?php 
                    $optional_sku = explode(",",$items->optional_sku);
                    $optional_product_name = explode(",",$items->optional_name);
                    $optional_product_gst = explode(",",$items->optional_gst);
                    $optional_product_subtotal = explode(",",$items->optional_subtotal);
                    $optional_quantity = explode(",",$items->optional_quantity);
                ?>
                      <div class="container">
                      <br>
                      <p class="h5"> Optional Products Summary</p>
                      <table class = "table table-bordered">
                          <thead>
                              <tr align="center">
                                  <th> S.No </th>
                                  <th> SKU </th>
                                  <th> Product Name </th>
                                  <th> Product GST(in %) </th>
                                  <th> Price </th>
                                  <th> Price (Incl GST)</th>
                                  <th> Quantity </th>
                                  <th> Sub Total </th>
                              </tr>
                          </thead>
                          <tbody>
                <?php
                    $sum_optional = 0;
                    for($i = 0,$counter = 1; $i < count($optional_sku); $i++,$counter++)
                    {
              ?>
                   
                          
                              <tr align="center">
                                <td> <?php echo $counter; ?> </td>
                                <td> <?php echo $optional_sku[$i]; ?> </td>
                                <td> <?php echo $optional_product_name[$i]; ?> </td>
                                <td> <?php echo $optional_product_gst[$i]; ?> </td>
                                <td> <?php echo $optional_product_subtotal[$i]; ?> </td>
                                <td> <?php echo $sub_total = $optional_product_subtotal[$i] + (($optional_product_subtotal[$i] * $optional_product_gst[$i])/100); ?> </td>
                                <td> <?php echo $optional_quantity[$i]; ?> </td>
                                <td> <?php echo $quantify = $sub_total *  $optional_quantity[$i]; $sum_optional += $quantify;?> </td>
                              </tr>
                              
              <?php        
                    }
                ?>
                              <tr>
                                <td colspan="7" align="right"><b> Sub Total :  </b></td>
                                <td> <?php echo $sum_optional; ?> </td>
                              </tr>
                      </tbody>
                    </table></div>
               </div>
              </td>
           </tr>
   
           <?php      
               } 
               $sum_main = 0;
            ?>
            <tr class="main_summary">
              <td colspan="12">
                  <div id="accordion1<?php echo $count; ?>" class="main collapse">
                    <div class="container">
                    <br>
                      <p class = "h5"> Product Summary  </p>
                      <table class = "table table-bordered">
                      <thead>
                              <tr align="center">
                                  <th> S.No </th>
                                  <th> SKU </th>
                                  <th> Product Name </th>
                                  <th> Product GST(in %) </th>
                                  <th> Price </th>
                                  <th> Price (Incl GST)</th>
                                  <th> Quantity </th>
                                  <th> Sub Total </th>
                              </tr>
                        </thead>
                        <tbody>
                           <tr align="center">
                                <td> <?php echo $count; ?> </td>
                                <td> <?php echo $items->sku; ?> </td>
                                <td> <?php echo $items->product_name; ?> </td>
                                <td> <?php echo $items->gst; ?> </td>
                                <td> <?php echo $items->subtotal; ?> </td>
                                <td> <?php echo $incl_gst ?> </td>
                                <td> <?php echo $items->quantity; ?> </td>
                                <td> <?php echo $quantify = $incl_gst * $items->quantity; $sum_main += $quantify;?> </td>
                          </tr>
                          <tr>
                              <td colspan="7" align="right"><b> Sub Total :  </b></td>
                              <td align="center"> <?php echo $sum_main; ?> </td>
                          </tr>
                          
                      

                <?php
               $sum_optional = 0;
               if($items->optional_sku != "")
               {
                    for($i = 0,$counter = 1; $i < count($optional_sku); $i++,$counter++)
                    {
              ?>
                   
                          
                              <tr align="center">
                                <td> <?php echo $counter; ?> </td>
                                <td> <?php echo $optional_sku[$i]; ?> </td>
                                <td> <?php echo $optional_product_name[$i]; ?> </td>
                                <td> <?php echo $optional_product_gst[$i]; ?> </td>
                                <td> <?php echo $optional_product_subtotal[$i]; ?> </td>
                                <td> <?php echo $sub_total = $optional_product_subtotal[$i] + (($optional_product_subtotal[$i] * $optional_product_gst[$i])/100); ?> </td>
                                <td> <?php echo $optional_quantity[$i]; ?> </td>
                                <td> <?php echo $quantify = $sub_total *  $optional_quantity[$i]; $sum_optional += $quantify;?> </td>
                              </tr>
                              
              <?php        
                    }
                ?>
                              <tr>
                                <td colspan="7" align="right"><b> Sub Total :  </b></td>
                                <td align="center"> <?php echo $sum_optional; ?> </td>
                              </tr>
                              <tr>
              <?php 
                }
              ?>                
                                  <td colspan="7" align="right"><b> Total :  </b></td>
                                  <td align="center"> <?php echo $sum_optional + $sum_main; ?> </td>
                            </tr>
                      </table>
                    </div>
                  </div>
                </td>
            </tr>    
            <?php   
              $count++; 
              }
            ?>
            <tr>
              <td colspan="10" align="right"> <b> Total Billable </b>  </td>
              <td><?php echo $sum; ?></td> 
              <td colspan="2"> <a href="<?php echo base_url()."cart/checkout";?>" class="btn btn-sm btn-info" > <b>Checkout </b> </a> </td>
            </tr>
            <?php 
              }
              else
              {
                echo "<tr> <td colspan='12'> <b> Your Cart Is Empty </b> </td> </tr>";
              }
            ?>
        </tbody>
      </table>
      <br><br><br>
    </div>
 </div> 
</section>
<script>
$(document).ready(function(){
  
  $('.main_summary').hide();
  $('.optional_summary').hide();  
  $('.main').collapse('hide');
  $('.optional').collapse('hide');
  
  $('.optional_summary_click').click(function(){
    $('.main_summary').hide();
    $('.main').collapse('hide');
    $('.optional_summary').show();
  });
  $('.main_summary_click').click(function(){
    $('.optional_summary').hide();
    $('.optional').collapse('hide');
    $('.main_summary').show();
  });
});
</script>

<script>
$(document).ready(function() {
    $('#table').DataTable();
} );
</script>
<script type="text/javascript">
  $(document).ready(function(){
  
    $(".remove_product").click(function(){
        var uid = $(this).attr("id");

        if(confirm('Are You Sure, You want to delete this Item?'))
        {
          $.ajax({
            url : '<?php echo base_url()."cart/remove"; ?>',
            method : 'POST',
            data : {uid:uid},
            success : function(data){
              alert('Removed Item From Cart');
              location.reload(true);
            },
            error : function (data) {
              alert('Unexpected Error : Cannot Remove Item From Cart');
            }
          });
        }
    });
  // });

  $(".add_product").click(function(){
      var uid = $(this).data("incrementer");
      // console.log(uid);
      var qty = $("#"+uid).val();
      // console.log(parseInt(qty)+1);
      var increment_value = $("#"+uid).val(parseInt(qty)+1);
      
      $.ajax({
          url : '<?php echo base_url()."cart/update"; ?>',
          method : 'POST',
          data : {uid:uid,quantity:parseInt(qty)+1,flag:"incr"},
          success : function(data){
            alert('Cart Updated');
            location.reload(true);
          }
          // error : function(data){
          //   alert('Unexpected Error : Cannot Update Cart.');
          // }
      
        });
    });

    $(".deduct_product").click(function(){
          var uid = $(this).data("decrementer");
          var qty = $("#"+uid).val();
          if(parseInt(qty) == 1)
          {
            alert('cannot Decrement Further.');
          }
          else
          {
            var increment_value = $("#"+uid).val(parseInt(qty)-1);
            $.ajax({
                url : '<?php echo base_url()."cart/update"; ?>',
                method : 'POST',
                data : {uid:uid,quantity:parseInt(qty)-1,flag:"decr"},
                success : function(data){
                  alert('Cart Updated');
                  location.reload(true);
                }
                // error : function(data){
                //   alert('Unexpected Error : Cannot Update Cart.');
                // }
            
              });
          }
         
        });     
        
  });
</script>
