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

 <script>

    $(document).ready(function(){
    $('#p_id').on('change',function(){
        var r_id = $(this).val();
        if(r_id){
            $.ajax({
                type:'POST',
                url:'<?php echo base_url();?>superadmin/fetch_ajax_product',
                data:{sku:r_id},
                dataType:"json",
                
                success:function(recv){
                    //console.log(recv);
                     $.each(recv,function(key,value)
                     {
                       $('#pro_user').val(value.user_id);
                       $('#pro_user_table').val(value.user_table);
                       $('#pro_sku').val(value.product_sku);
                       $('#pro_order').val(value.order_id);
                       $('#pro_rowid').val(value.rowid);
                       $('#pro_unique_id').val(value.unique_order_id);
                       $('#pro_id').val(value.product_name);
                       $('#pro_quantity').val(value.quantity);
                       $('#pro_bundle').val(value.bundled_flag);
                    });
                 }
            }); 
        }

        else
        {
            $('#p_id').html('Select employee first');
        }
    });
});




   
    </script>
<?php
if(!isset($del_data))
{
?>
<div class="col-sm-6 col-md-9">
    <div class="row">
        <div class="col-md-6" align="left">
            <p class="h3"> Create Delivery kitchen </p>
        </div>`
        <div class="col-md-3" align="right">
            <a class="btn btn-sm btn-primary" href="<?php echo base_url()."superadmin/manage_delivery_kitchen"; ?>"> Manage </a>
        </div>
        <!--<div class="col-md-3" align="right">
            <a class="btn btn-sm btn-outline-danger" href="<?php // echo base_url()."superadmin/home"; ?>"> Back</a>
        </div>-->
    </div>
    <br>

    <form method="post" action="<?php echo base_url(); ?>superadmin/delivery_kitchen_data"  id="form1">
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
                    <label class="h6"> Delivery user Id </label>
                </div>
                    <div class="col-md-6">
                        <div class="card-body">
                            <select class="form-control" name="delivery_user" id="kit_id">
                                <option value=""> Select Kitchen </option>
                                <?php foreach($kitchen_data->result() as $row) 
                                {
                                ?>
                                <option value="<?php echo  $row->k_id;?>">
                                    <?php echo $row->k_id .'-'. $row->k_name;?>
                                </option>
                                <?php 
                                } 
                                ?>
                            </select>
                        </div>
                    </div>
                </div>
             
          
            
            <div class="row">
                <div class="card-body col-md-3" align="right">
                    <label class="h6"> Product SKU </label>
                </div>
                    <div class="col-md-6">
                        <div class="card-body">
                        <select class="form-control" name="product_sku[]" id="p_id">
                                <option value=""> Select Product </option>
                                <?php $z= 0; ?>
                                <?php foreach($product_data->result() as $row) 
                                {
                                ?>
                               <?php  $z++; ?>
                                <option value="<?php echo  $row->product_sku.'%'. $row->order_id;?>">
                                    <?php echo $row->product_sku.'_'. $row->order_id.'_'. $row->unique_order_id;?>
                                </option>
                                <?php 
                                } 
                                ?>
                            </select>
                            <input type="hidden" id="pro_id" name="product_name[]" value=""/>
                            <input type="hidden" id="pro_sku" name="prod_sku[]" value=""/>
                            <input type="hidden" id="pro_rowid" name="rowid[]" value=""/>
                            <input type="hidden" id="pro_quantity" name="quantity[]" value=""/>
                            <input type="hidden" id="pro_user" name="userid[]" value="">
                            <input type="hidden" id="pro_user_table" name="user_table[]" value="">
                            <input type="hidden" id="pro_order" name="order_id[]" value="">
                            <input type="hidden" id="pro_unique_id" name="unique_id[]" value="">
                            <input type="hidden" id="pro_bundle" name="bundle_flag[]" value="">
                            <input type="hidden" name="z" value="<?php echo $z ?>">
                        </div>

                    </div>
                    <!-- <div class="col-md-6">
                      
                            
                      
                    </div>-->

                <div class="col-md-3 card-body " align="left">
                     <input type="button" name="" style="" class="add_field_button2<? echo $z;?>" value="Add Product"/>
                </div>
                    
            </div>
             
<div class="input_fields_wrap2<?php echo $z; ?>">
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

<!-- Dont Remove this closed div tag -->
    <!-- Side row closed -->
    </div>
    <!-- sidebar container fluid closed -->
</div>

<script>
$(document).ready(function() {
var max_fields      = 5; //maximum input boxes allowed
var wrapper         = $(".input_fields_wrap2<?php echo $z ?>"); //Fields wrapper
var add_button      = $(".add_field_button2<?php echo $z ?>"); //Add button ID

var x = 1; //initlal text box count
$(add_button).click(function(e){ //on add input button click
e.preventDefault();
if(x < max_fields){ //max input box allowed
    x++; //text box increment
    $(wrapper).append('<div class="row"><div class="card-body col-md-3" align="right"></div><div class="col-md-6"><input type="hidden" name="count'+x+'" value="'+x+'" ><select class="form-control dropdown" name="product_sku[]" data-count="'+x+'" id="p_id'+x+'"><option value=" "> Select Kitchen </option><?php foreach($product_data->result() as $row) {?><option value="<?php echo  $row->product_sku.'%'. $row->order_id;?>"><?php echo $row->product_sku.'_'. $row->order_id.'_'. $row->unique_order_id;?></option><?php  } ?></select><input type="hidden" id="pro_id'+x+'" name="product_name[]" value=""/><input type="hidden" id="pro_sku'+x+'" name="prod_sku[]" value=""/><input type="hidden" id="pro_rowid'+x+'" name="rowid[]" value=""/><input type="hidden" id="pro_quantity'+x+'" name="quantity[]" value=""/><input type="hidden" id="pro_user'+x+'" name="userid[]" value=""><input type="hidden" id="pro_user_table'+x+'" name="user_table[]" value=""><input type="hidden" id="pro_order'+x+'" name="order_id[]" value=""><input type="hidden" id="pro_unique_id'+x+'" name="unique_id[]" value=""> <input type="hidden" id="pro_bundle'+x+'" name="bundle_flag[]" value=""><a href="#" class="remove_field1">REMOVE</a></div></div>'); 
}
});

$(wrapper).on("click",".remove_field1", function(e){ 


//user click on remove text
e.preventDefault(); $(this).parent('div').remove(); x--;
})
});
    $(document).on('change','.dropdown',function(e){
        var current_count = $(this).data('count');
        var previous_count = current_count -1;
        var get_select_id = '#p_id'+previous_count;


        var get_previous_value = $(get_select_id).val();
        console.log(get_previous_value)
        var r_id = $(this).val();
        console.log(r_id);


        var pro_user = '#pro_user'+current_count;
        var pro_sku = '#pro_sku'+current_count;
        var pro_order = '#pro_order'+current_count;
        var pro_rowid = '#pro_rowid'+current_count;
        var pro_id = '#pro_id'+current_count;
        var pro_quantity = '#pro_quantity'+current_count;
        var pro_user_table = '#pro_user_table'+current_count;
        var pro_unique_id = '#pro_unique_id'+current_count;
        var pro_bundle = '#pro_bundle'+current_count;

        if(r_id == get_previous_value)
        {
            alert("You Already Selected This Product.");
            $('#p_id'+current_count+' option:contains(" ")').prop('selected',true);
            $(pro_user).val("");
            $(pro_sku).val("");
            $(pro_order).val("");
            $(pro_rowid).val("");
            $(pro_id).val("");
            $(pro_quantity).val("");
            $(pro_user_table).val("");
            $(pro_unique_id).val("");
            $(pro_bundle).val("");
        }
        else
        {

            if(r_id)
            {
                $.ajax({
                    type:'POST',
                    url:'<?php echo base_url()."superadmin/fetch_ajax_product";?>',
                    data:{sku:r_id},
                    dataType : 'JSON',
                    success:function(recv){
                         console.log(recv);
                         $.each(recv,function(key,value)
                         {
                            
                            $(pro_user).val(value.user_id);
                            $(pro_sku).val(value.product_sku);
                            $(pro_order).val(value.order_id);
                            $(pro_rowid).val(value.rowid);
                            $(pro_id).val(value.product_name);
                            $(pro_quantity).val(value.quantity);
                            $(pro_user_table).val(value.user_table);
                            $(pro_unique_id).val(value.unique_order_id);
                            $(pro_bundle).val(value.bundled_flag);
                        }); 
                     }
                }); 
            }
            else
            {
                $('#p_id').html('Select employee first');
            }
        }
    });
</script>
<br><br><br><br><br>
