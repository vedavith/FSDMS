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

<div class="col-sm-6 col-md-9">
    <div class="row">
        <div class="col-md-6" align="left">
            <p class="h3"> Assign Product To kitchen </p>
        </div>`
        <div class="col-md-3" align="right">
            <a class="btn btn-sm btn-primary" href="<?php echo base_url()."superadmin/manage_assign_kitchen_product"; ?>"> Manage </a>
        </div>
        <!--<div class="col-md-3" align="right">
            <a class="btn btn-sm btn-outline-danger" href="<?php // echo base_url()."superadmin/home"; ?>"> Back</a>
        </div>-->
    </div>
    <br>

    <form method="post" action="<?php echo base_url(); ?>superadmin/insert_assign_kitchen_products">
    <div class="row container">
  <div class="container" id="accordion1">
    <div class="card">
      <div class="card-header">
        <a class="card-link" data-toggle="collapse" href="#CategoryOne">
        Assign Products
        </a>
      </div>
      <div id="CategoryOne" class="collapse show" data-parent="#accordion1">
            
            <div class="row">
                <div class="card-body col-md-3" align="right">
                    <label class="h6"> Kitchen ID </label>
                </div>
                    <div class="col-md-6">
                        <div class="card-body">
                            <select class="form-control" name="product" id="kit_id">
                               <option value=""> Select Kitchen </option>
                                <?php foreach($get_array as $key=>$value) 
                                {
                                ?>
                                <option value="<?php echo  $value;?>">
                                    <?php echo $value;?>
                                </option>
                                <?php 
                                } 
                                ?> 
                            </select>
                        </div>
                    </div>
                </div>
             
          
            
            <div class="row">
                <!-- <div class="card-body col-md-3" align="right">
                    <label class="h6"> Product Name </label>
                </div> -->
                    <div class="col-md-12">
                        <div class="row">
                        <div class="col-md-3 card-body">
                            <label class="h6"> Product Sku </label>
                        <select class="form-control prod_select" name="product_sku[]" data-val="p_id0" data-cval="p_cid0" data-csku="p_csid0" id="p_id">
                                <option value=""> Select Product SKU</option>
                               <!--  <?php //$z= 0; ?>
                                <?php //foreach($get_all_products->result() as $row) 
                                //{
                                ?>
                               <?php // $z++; ?>
                                <option value="<?php //echo  $row->product_sku;?>"> <?php //echo $row->product_sku; ?> </option>
                                <?php 
                                //} 
                                ?> -->
                            </select>
                        </div>
                        <div class="col-md-3 card-body">
                            <label class="h6"> Product Name </label>
                            <input type="text" class="form-control" id="p_id0" name="product_name[]" value="" readonly/>                      
                        </div>
                        <div class="col-md-3 card-body">
                            <label class="h6"> Custom Product Name </label>
                            <input type="text" class="form-control" id="p_cid0" name="sub_product_name[]" value="" readonly/>
                            <input type="text" class="form-control" id="p_csid0" name="sub_product_sku[]" value="" readonly/>                      
                        </div>
                        <div class="col-md-3 card-body " >
                            <br/>
                            <input type="button" name="" style="" class="btn btn-sm btn-success add_button" value="Add Product"/>
                        </div>
                    </div>
                    </div>       
            </div>
             
            <div class="input_fields_wrap"></div>
             
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


<!-- Dont Remove this closed div tag -->
    <!-- Side row closed -->
    </div>
    <!-- sidebar container fluid closed -->
</div>

<!-- <script>
$(document).ready(function(){
    var append_count = 1;

    $('.add_button').click(function(){
        $('.input_fields_wrap').append('<div class="container col-md-12"><div class="row"><div class="col-md-3 card-body"><select class="form-control prod_select" name="product_sku[]" data-val="p_id'+append_count+'" data-cval="p_cid'+append_count+'" data-csku="p_csid'+append_count+'" ><option value=""> Select Product </option><?php //foreach($get_all_products->result() as $row){?><option value="<?php //echo  $row->product_sku;?>"> <?php //echo $row->product_sku ?> </option><?php //}?></select></div><div class="col-md-3 card-body"><input type="text" class="form-control" id="p_id'+append_count+'"  name="product_name[]" value="" readonly/></div> <div class="col-md-3 card-body"><input type="text" class="form-control" id="p_cid'+append_count+'" name="sub_product_name[]" value="" readonly/> <input type="text" class="form-control" id="p_csid'+append_count+'" name="sub_product_sku[]" value="" readonly/></div><div class="col-md-3 card-body " ><input type="button" name="" style="" class="btn btn-sm btn-danger remove_product" value="Remove"/></div></div>');
        append_count++;
    });

    $(document).on('click','.remove_product',function(e){
        e.preventDefault(); $(this).parent().parent('div').remove();
    });

    $(document).on('change','.prod_select',function(){
        var value = $(this).val();

        var dataValue = $(this).data('val');
        var dataCvalue = $(this).data('cval');
        var dataCsku = $(this).data('csku');
        
        var id_setter = '#'+dataValue;
        var cid_setter = '#'+dataCvalue;
        var csku_setter = '#'+dataCsku;
        console.log(id_setter);
        console.log(cid_setter);
        console.log(csku_setter);
         

        $.ajax({
            url : '<?php //echo base_url()."superadmin/ajax_call_product_on_sku" ?>',
            method : 'post',
            data : {product_sku:value},
            dataType:'json',
            success : function(recv){
                //var data = recv;
               //$(id_setter).val(data.trim());
               console.log(recv.length);
                $.each(recv,function(key,value){
                        value.product_name;
                        $(id_setter).val(value.product_name);
                       var custom_product = null;
                        var custom_sku = null;
                       if(value.custom_product != null)
                       {
                        custom_product = value.custom_product;
                        custom_sku = value.customize_sku;
                       }
                       else
                       {
                        custom_product = "None";
                       }
                        $(cid_setter).val(custom_product);
                        $(csku_setter).val(custom_sku);

                    });
                
            }
        });
       
    });
});

</script>
<br><br><br><br><br>
 -->