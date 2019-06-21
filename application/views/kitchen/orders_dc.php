<style>
	.btn-file {
    position: relative;
    overflow: hidden;
}
.btn-file input[type=file] {
    position: absolute;
    top: 0;
    right: 0;
    min-width: 100%;
    min-height: 100%;
    font-size: 100px;
    text-align: right;
    filter: alpha(opacity=0);
    opacity: 0;
    outline: none;
    background: white;
    cursor: inherit;
    display: block;
}


</style>
<?php 
if(!isset($del_order_val))
{
if(isset($del_order))
{
?>



<div class="col-sm-6 col-md-9">
    <div class="row">
        <div class="col-md-6" align="left">
            <p class="h3"> Manage Delivery Challan</p>
        </div>
        <div class="col-md-3" align="right">
            <a class="btn btn-sm btn-outline-primary" href="<?php echo base_url()."kitchen/delivery_challan_order"; ?>"> Add DC ORDER </a>
        </div>
        <div class="col-md-3" align="right">
            <a class="btn btn-sm btn-outline-danger" href="<?php echo base_url()."kitchen/kitchen_home"; ?>"> Back</a>
        </div>
    </div>
    <br>

    <form method="post" action="<?php echo base_url()."kitchen/dc_order_data" ?>"  id="form1">
    <div class="row container">
            <div class="table-responsive">
        <table id="table" class="table table-responsive table-bordered">
            <thead>
                <tr align="center">
                    <th> S.No </th>
                    <th> DC NO</th>
                    <th> Delivery Executive Id</th>
                    <th> User Id</th>
                    <th> Product Name </th>
                    <th> Product Sku</th>
                    <th> Order Id</th>
                    <!-- <th>Edit</th> -->
                    <th>Delete</th>

                </tr>
            </thead>
            <tbody>
                <?php
                     if($del_order->num_rows() > 0)
                    {
                         $i = 1;
                         foreach ($del_order->result() as $del) 
                        {
                ?>
                <tr align="center">
                    <td> <?php echo $i; ?> </td>
                    <td> <?php echo $del->dc_id?></td>
                    <td> <?php echo $del->delivery_emp_id; ?> </td>
                    <td> <?php echo $del->user_id;?></td>
                    <td> <?php echo $del->product_name; ?> </td>
                    <td> <?php echo $del->product_sku; ?></td>
                    <td> <?php echo $del->order_id;?></td>
                    <!-- <td> 
                        <a class="btn btn-sm btn-primary" href="<?php //echo base_url()."kitchen/edit_dc_order/".$del->dc_id; ?>"> Edit </a>
                     </td> -->
                    <td> <a href="#" class="btn btn-sm btn-danger delete_order" id="<?php echo $del->dc_id; ?>"> Delete </a> </td>
                </tr>
                <?php
                        $i++;
                        }
                    }
                ?>
            </tbody>            
        </table>
        <script type="text/javascript">
            $(document).ready(function(){
                $(".delete_order").click(function(){
                    var id = $(this).attr("id");
                    if(confirm("Are you sure you want to delete this?"))
                    {
                        window.location="<?php echo base_url();?>kitchen/delete_dc_order/"+id;
                    }
                    else
                    {
                        return false;
                    }
                });
            });
        </script>


    </div>
    </div>
     
</form>

</div>
</form>
<?php
}
}
?>
<?php 
if(!isset($del_order) && !isset($del_order_val))
{
?>

<script>
$(document).ready(function(){
    $('#or_id').on('change',function(){
        var or_id = $(this).val();
        if(or_id){
            $.ajax({
                type:'POST',
                url:'<?php echo base_url();?>kitchen/fetch_product',
                data:'or_id='+or_id,
                dataType:"json",
                success:function(html){
                    var i=1;
                    $('.jdata').remove();
                   $.each(html,function(key,value)
                     {
                        //console.log(value.quanity);
                        //$('#product_name_id').val(value.product_name);
                        var split_quantity =value.quanity.split('<br>');

                        $('.append_data').append('<div class="jdata"><div class="row"><div class="col-md-4"><div class="card-body"><label class="h6"> Product Name </label><input id = "product_name_id'+i+'"  name = "product_name[]" class = "form-control" value="'+value.product_name+'" readonly/></div></div><div class="col-md-4"><div class="card-body"><label class="h6">Product sku </label><input id = "product_sku'+i+'"  name = "product_sku[]" class = "form-control" value="'+value.product_sku+'" readonly/></div></div><div class="col-md-4"><div class="card-body"><label class="h6">Customer Id</label><input id = "user_id'+i+'"  name = "user_id[]" class = "form-control" value="'+value.user_id+'" readonly/></div></div><div class="col-md-4"><div class="card-body"><label class="h6">quantity Id</label><input id = "product_qnt'+i+'"  name = "product_quantity[]" class = "form-control" value="'+split_quantity[0]+'" readonly/></div></div><div class="col-md-4"><div class="card-body"><label class="h6">Main Address</label><input id = "product_addr'+i+'"  name = "product_addr[]" class = "form-control" value="'+value.main_address+'" readonly/></div></div><div class="col-md-4"><div class="card-body"><label class="h6">Branch Address</label><input id = "product_braddr'+i+'"  name = "product_braddr[]" class = "form-control" value="'+value.branch_address+'" readonly/></div></div><div class="col-md-4"><div class="card-body"><label class="h6">Bundled Product</label><input type="text" id = "product_bundled'+i+'"  name = "product_bundled[]" class = "form-control" value="'+value.bundled_flag+'" readonly/></div></div></div></div>')
                    //alert(recv.length);
                    });
                }
                 
                 
            }); 
        }
    });
  });
  </script>
<div class="col-sm-6 col-md-9">
    <div class="row">
    	<div class="col-md-6" align="left">
    		<p class="h3"> Create Delivery Challan</p>
    	</div>
    	<div class="col-md-3" align="right">
    		<a class="btn btn-sm btn-primary" href="<?php echo base_url()."kitchen/manage_dc_order"; ?>"> Manage </a>
    	</div>
    	<div class="col-md-3" align="right">
    		<a class="btn btn-sm btn-outline-danger" href="<?php echo base_url()."kitchen/kitchen_home"; ?>"> Back</a>
    	</div>
    </div>
    <br>

    <form method="post" action="<?php echo base_url()."kitchen/dc_order_data" ?>"  id="form1">
    <div class="row container">
  <div class="container" id="accordion1">
    <div class="card">
      <div class="card-header">
        <a class="card-link" data-toggle="collapse" href="#CategoryOne">
         Create Delivery Challan
        </a>
      </div>
      <div id="CategoryOne" class="collapse show" data-parent="#accordion1">
           
            <div class="row">
                <div class="card-body col-md-3" align="right">
                    <label class="h6"> Delivery Executive Name </label>
                </div>
                    <div class="col-md-6">
                        <div class="card-body">
                            <select class="form-control" name="del_executive" id="del_executive">
                               <?php foreach($del_exe->result() as $row)
                               {
                                 echo "<option value='$row->id'> $row->emp_name </option>";
                               } 
                               ?>

                         </select>
                        </div>
                    </div>
            </div>
            <div class="row">
                <div class="card-body col-md-3" align="right">
                    <label class="h6"> Select Order Id </label>
                </div>
                    <div class="col-md-6">
                        <div class="card-body">
                            <select class="form-control" name="del_order_id" id="or_id">
                                <option value="0">select Order ID</option>
                               <?php foreach($order_id->result() as $row)
                               {
                                 echo "<option value='$row->order_id'> $row->order_id </option>";
                               } 
                               ?>

                         </select>
                        </div>
                    </div>
                    
            </div>
             <div class="row">
                <div class="card-body col-md-3" align="right">
                    <label class="h6"> Delivery challan Id </label>
                </div>
                    <div class="col-md-6">
                        <div class="card-body">
                            <input type="text" name="dc_no" id="dc_id" class = "form-control" placeholder="Insert Delivery challan num" value="<?php echo "DC".date("dmYhis");?>" readonly/>
                        </div>
                    </div>
            </div>
             
        	<!-- <div class="row">
	      		<div class="card-body col-md-3" align="right">
	      			<label class="h6"> Product Name </label>
	      		</div>
      				<div class="col-md-6">
        				<div class="card-body">
                       
                        <input id = "product_name_id"  name = "product_name" class = "form-control" placeholder="Enter Product"/>
        				
                       
                        </div>
        			</div>
        	</div> -->
        	<div class="append_data">

            </div>

			

						

		</div>
    </div>

    <div class="card">
      <div class="card-header">
        <a class="collapsed card-link" data-toggle="collapse" href="#CategoryThree">
         Submit
        </a>
      </div>
      <div id="CategoryThree" class="collapse" data-parent="#accordion1">
        <div class="row card-body">
        	<div class="col-md-6 col-sm-3" align="right">
        		 <input type="submit" name="insert" id="submit" value="Submit" class="btn btn-outline-success">
        		<!--<button type="submit" class="btn btn-outline-success"> Submit </button>-->
        	</div>
        	<div class="col-md-6 col-sm-3" align="left">
        		<button type="reset" class="btn btn-outline-danger"> Cancel </button>
        	</div>
        </div>
      </div>
    </div>
	
  </div>
    </div>
     
</form>

</div>
</form>


<?php
}
?>

<?php 
if(!isset($del_order))
{
    if(isset($del_order_val))
    {
        foreach($del_order_val->result() as $row)
        {
?>

<div class="col-sm-6 col-md-9">
    <div class="row">
        <div class="col-md-6" align="left">
            <p class="h3"> Edit Delivery Challan</p>
        </div>
        <div class="col-md-3" align="right">
            <a class="btn btn-sm btn-primary" href="<?php echo base_url()."kitchen/manage_dc_order"; ?>"> Manage </a>
        </div>
        <div class="col-md-3" align="right">
            <a class="btn btn-sm btn-outline-danger" href="<?php echo base_url()."kitchen/kitchen_home"; ?>"> Back</a>
        </div>
    </div>
    <br>

    <form method="post" action="<?php echo base_url()."kitchen/edit_dc_data" ?>"  id="form1">
    <div class="row container">
  <div class="container" id="accordion1">
    <div class="card">
      <div class="card-header">
        <a class="card-link" data-toggle="collapse" href="#CategoryOne">
         Edit Delivery Challan
        </a>
      </div>
      <div id="CategoryOne" class="collapse show" data-parent="#accordion1">

            <div class="row">
                <div class="card-body col-md-3" align="right">
                    <label class="h6"> Delivery user Id </label>
                </div>
                    <div class="col-md-6">
                        <div class="card-body">
                            <select class="form-control" name="del_executive" id="del_executive">
                               <?php foreach($del_exe->result() as $row1)
                               {
                                ?>
                                 <option value='<?php echo $row1->id;?>' <?php if($row1->id == $row->delivery_emp_id) echo "selected == 'selected'"?>> <?php echo $row1->emp_name; ?> </option>";
                                 <?php
                               } 
                               ?>

                         </select>
                        </div>
                    </div>
            </div>
             <div class="row">
                <div class="card-body col-md-3" align="right">
                    <label class="h6"> Delivery challan Id </label>
                </div>
                    <div class="col-md-6">
                        <div class="card-body">
                            <input type="text" name="dc_no" id="dc_id" class = "form-control" placeholder="Insert Delivery challan num" value="<?php echo $row->dc_id;?>" readonly/>
                        </div>
                    </div>
            </div>
           <div class="row">
                <div class="card-body col-md-3" align="right">
                    <label class="h6">User Id</label>
                </div>
                    <div class="col-md-6">
                        <div class="card-body">
                       
                        <input id = "user_id"  name = "user_id" class = "form-control" placeholder="User Id" value="<?php echo $row->user_id; ?>"/>
                        
                       
                        </div>
                    </div>
            </div>
            <div class="row">
                <div class="card-body col-md-3" align="right">
                    <label class="h6"> Product Name </label>
                </div>
                    <div class="col-md-6">
                        <div class="card-body">
                       
                        <input id = "product_name" list = "product_name" name = "product_name" class = "form-control" placeholder="Enter Product" value="<?php echo $row->product_name; ?>"/>
                        
                       
                        </div>
                    </div>
            </div>
            <div class="row">
                <div class="card-body col-md-3" align="right">
                    <label class="h6"> Product SKU </label>
                </div>
                    <div class="col-md-6">
                        <div class="card-body">
                         <input type="text" id="product_sku" name="product_sku" class="form-control" placeholder="Product SKU" value="<?php echo $row->product_sku; ?>">
                        </div>
                    </div>
            </div>

            <div class="row">
                <div class="card-body col-md-3" align="right">
                    <label class="h6"> OrderId </label>
                </div>
                    <div class="col-md-6">
                        <div class="card-body">
                        <input type="text" id="OrderId" name="order_id" class="form-control" placeholder="Order Id" value="<?php echo $row->order_id; ?>" >
                        </div>
                    </div>
            </div>
        <?php
    }
    ?>
                        

        </div>
    </div>

    <div class="card">
      <div class="card-header">
        <a class="collapsed card-link" data-toggle="collapse" href="#CategoryThree">
         Submit
        </a>
      </div>
      <div id="CategoryThree" class="collapse" data-parent="#accordion1">
        <div class="row card-body">
            <div class="col-md-6 col-sm-3" align="right">
                 <input type="submit" name="insert" id="submit" value="Submit" class="btn btn-outline-success">
                <!--<button type="submit" class="btn btn-outline-success"> Submit </button>-->
            </div>
            <div class="col-md-6 col-sm-3" align="left">
                <button type="reset" class="btn btn-outline-danger"> Cancel </button>
            </div>
        </div>
      </div>
    </div>
    
  </div>
    </div>
     
</form>

</div>
</form>
<?php
}
}
?>

<!-- Dont Remove this closed div tag -->
    <!-- Side row closed -->
    </div>
    <!-- sidebar container fluid closed -->
</div>


<br><br><br><br><br>
