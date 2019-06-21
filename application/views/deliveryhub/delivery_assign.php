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
    
       var jsonData = <?php echo json_encode($current_order_list);?>; 


       // console.log( JSON.stringify(jsonData));
       // console.log(jsonData["23w23"]);
    

</script>

<div class="col-sm-6 col-md-9">
    <div class="row">
    	<div class="col-md-6" align="left">
    		<p class="h3"> Assign orders </p>
    	</div>
    	<div class="col-md-3" align="right">
    		<a class="btn btn-sm btn-primary" href="<?php echo base_url()."superadmin/manage_kitchen_admin"; ?>"> Manage </a>
    	</div>
    	<div class="col-md-3" align="right">
    		<a class="btn btn-sm btn-outline-danger" href="<?php echo base_url()."superadmin/home"; ?>"> Back</a>
    	</div>
    </div>
    <br>

    <form method="post" action="<?php echo base_url()."superadmin/insert_kitchen_admin" ?>" enctype="multipart/form-data" id="form1">
    <div class="row container">
  <div class="container" id="accordion1">
    <div class="card">
      <div class="card-header">
        <a class="card-link" data-toggle="collapse" href="#CategoryOne">
         Delivery Orders
        </a>
      </div>
      <div id="CategoryOne" class="collapse show" data-parent="#accordion1">
      	<div class="row">
      		<div class="card-body col-md-3" align="right">
      			<label class="h6"> Product Sku </label>
      		</div>
      			<div class="col-md-6">
        			<div class="card-body">
        				 <select class="form-control" name="product" id="sku_id">
                               <option value=""> Select product sku </option>
                                <?php foreach($prod_sku as $key=>$value) 
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

        	
            <div class="row card-body">
                <div class="col-md-12">
                <table class="table table_order">
                    <thead align="center">
                    <th> Unique OrderId</th>
                    <th> Required Quantity</th>
                </thead>
                  
                    

                </table>
                 </div>  
            </div>
        	<!-- <div class="row">
	      		<div class="card-body col-md-3" align="right">
	      			<label class="h6"> Required Quantity </label>
	      		</div>
      				<div class="col-md-6">
        				<div class="card-body">
				         <input type="text" name="required quantity" class="form-control" placeholder="Required Quantity">
        				</div>
        			</div>
        	</div>

        	<div class="row">
	      		<div class="card-body col-md-3" align="right">
	      			<label class="h6"> Assign Quantity </label>
	      		</div>
      				<div class="col-md-6">
        				<div class="card-body">
				         <input type="number" name="assign_qnt" class="form-control" placeholder="Assign Quantity">
        				</div>
        			</div>
        	</div>
        	<div class="row">
	      		<div class="card-body col-md-3" align="right">
	      			<label class="h6"> User Name </label>
	      		</div>
      				<div class="col-md-6">
        				<div class="card-body">
				        <select  id="empId" class="form-control">
                            <?php //foreach($del_exe->result() as $de){ ?>
                            <option value="<?php //echo $de->id; ?>" ><?php //echo $de->emp_name;?></option>
                            
                        <?php //}
                        ?>
                    </select>
        				</div>
        			</div>
        	</div>
        	 -->
				
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


<br><br><br><br><br>
<script type="text/javascript">
    $(document).ready(function()
    {
        $("#sku_id").change(function(){
             $(".get_data").remove();
            var skuId = $("#sku_id").val();
            var jsonOrderdata = jsonData[skuId].trimRight();
            var orderId = jsonOrderdata.split(' ');
            console.log(orderId);
            var assign_data = '';
            assign_data += '<tbody align="center">';
            $.each(orderId,function(key,value){
                var qnt = value.split('-');

               assign_data += '<tr class="get_data">';
               assign_data += '<td>'+qnt[0]+'</td>';
               assign_data += '<td>'+qnt[1]+'</td>';
               assign_data += '</tr>';

                            });
            assign_data += '</tbody>';
          
            $(".table_order").append(assign_data);
        });
    });
</script>

