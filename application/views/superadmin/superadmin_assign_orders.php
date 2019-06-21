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
    		<p class="h3"> Assign Orders </p>
    	</div>
    	<div class="col-md-3" align="right">
    		<a class="btn btn-sm btn-primary" href="<?php echo base_url()."superadmin/manage_assign_orders"; ?>"> Manage </a>
    	</div>
    	<div class="col-md-3" align="right">
    		<a class="btn btn-sm btn-outline-danger" href="<?php echo base_url()."superadmin/home"; ?>"> Back</a>
    	</div>
    </div>
    <br>

    <form method="post" action="<?php echo base_url()."superadmin/insert_assigned_products" ?>" enctype="multipart/form-data" id="form1">
    <div class="row container">
  <div class="container" id="accordion1">
    <div class="card">
      <div class="card-header">
        <a class="card-link" data-toggle="collapse" href="#CategoryOne">
         Order Details
        </a>
      </div>
      <div id="CategoryOne" class="collapse show" data-parent="#accordion1">
      	<div class="row">
      		<div class="card-body col-md-3" align="right">
      			<label class="h6"> Kitchen ID </label>
      		</div>
      			<div class="col-md-6">
        			<div class="card-body">
        				<select name="kitchen_id" id="kit_id" class="form-control">
						<option value=""> Select Kitchen Id </option>
			          	<?php 
			          	foreach($kitchen_ids->result() as $row)
			          	{
			          	?>
			          	<option value="<?php echo $row->k_id; ?>"><?php echo $row->k_id; ?></option>
			          	<?php
			          	} 
			          	?>
			          </select>
        				
        			</div>
        		</div>
        	</div>

        	
        	<div class="row">
	      		<div class="card-body col-md-3" align="right">
	      			<label class="h6"> product sku </label>
	      		</div>
      				<div class="col-md-6">
        				<div class="card-body">
				        
				         <select name="produt_sku" id="pro_sku" class="form-control product_sku">
				         	<option value="">Select Kitchen ID First</option>
				         </select>
        				</div>
        			</div>
        	</div>
        	<div class="row">
	      		<div class="card-body col-md-3" align="right">
	      			<label class="h6"> Kitchen Capacity </label>
	      		</div>
      				<div class="col-md-6">
        				<div class="card-body">
				         <input type="text" name="quantity" id="quantity" class="form-control" placeholder="Kitchen Capacity" readonly>
        				</div>
        			</div>
        	</div>
        	<div class="row">
	      		<div class="card-body col-md-3" align="right">
	      			<label class="h6"> Date </label>
	      		</div>
      				<div class="col-md-6">
        				<div class="card-body">
				         <!-- <input type="date" name="date" id="date" class="form-control" placeholder="date"> -->
				        	<!-- <input id="date" name="date" onchange="checkDate()" required class="datepicker-input form-control " type="date" data-date-format="yyyy-mm-dd" > -->
								 <input type="text" name="daterange[]" id="date" class="form-control date_ranger"  value="" placeholder="Select Dates"/>
								</div>
        			</div>
        	</div>
        	

				<div class="card-body container row" align="center">
					<div class="col-md-4">
								<span class="h4"> Required Quantity </span>
						</div>
						<div class="col-md-4">
								<span class="h4"> Dates </span>
						</div>
						<div class="col-md-4">
								<span class="h4"> Assigned Quantity </span>
						</div>
				</div>

        	<div class="row appender container">
	      		<!-- APPENDER GOES HERE -->
        	</div>
					
        	<div class="container row" id="error">
				<div class="card-body alert alert-warning alert-dismissible">
					<button type="button" class="close" data-dismiss="alert">&times</button>
					<span><strong>Warning: </strong>Assigned Quantity Exceeding Estimated Quantity </span>
				</div>
			</div>
			<div class="container row" id="error1">
				<div class="card-body alert alert-warning alert-dismissible">
					<button type="button" class="close" data-dismiss="alert">&times</button>
					<span><strong>Warning: </strong>Assigned Quantity Exceeding Received Quantity </span>
				</div>
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


<!-- Dont Remove this closed div tag -->
    <!-- Side row closed -->
    </div>
    <!-- sidebar container fluid closed -->
</div>


<br><br><br><br><br>

<script type="text/javascript">
$(document).ready(function(){
	
    $('#kit_id').on('change',function(){
        var k_id = $(this).val();
        alert(k_id);
        if(k_id){
            $.ajax({
                type:'POST',
                url:'<?php echo base_url();?>superadmin/fetch_product_sku',
                data:{k_id:k_id},
                dataType:"json",
                success:function(recv){
                	json_data = recv;
                	$('#pro_sku').append('<option value="0" data-quant="none">Select SKU</option>');
                	$.each(recv,function(key,value){
                    	  $('#pro_sku').append('<option value="' +value.product_sku+ '" data-quant="'+value.estimated_units+'">' +value.product_sku+ '</option>');
                    });
				}

            }); 
            $('#pro_sku').children("option").remove();
        }
    });
   }); 

	$(document).ready(function(){
		$('.product_sku').on('change',function(e){
    		$('.product_sku :selected').each(function(){
				var est_quant = $(this).data('quant');
				$("#quantity").val(est_quant);
				});
			});
		});	


		$(document).ready(function() {

				$('input[name="daterange[]"]').daterangepicker({
						autoUpdateInput: false,
						minDate:moment().add(1,'day'),
						maxDate:moment().add(6,'day'),
						locale: {
								cancelLabel: 'Clear'
						}
				});

				$('input[name="daterange[]"]').on('apply.daterangepicker', function(ev, picker) {
					$(this).val(picker.startDate.format('YYYY-MM-DD') + ' - ' + picker.endDate.format('YYYY-MM-DD'));
						var d_val = $(this).val();
						var date_splitter = d_val.split(" - ");
						var kit_id = $('#kit_id').val();
						var sku = $('.product_sku').val();
						if((sku == "" && kit_id == "") ||(sku == '0')) 
						{
							alert("Please Select kitchen Id and Product SKU");
						}
						else
						{
							$.ajax({
								url : '<?php echo base_url(); ?>superadmin/fetch_required_qnt',
								method : 'post',
								data : {from_date:date_splitter[0],to_date:date_splitter[1],sku_val:sku},
								dataType : 'json',
								success : function(recv){
										$.each(recv, function(key,value){
											$('.appender').append('<div class="card-body row data"><div class="col-md-4"><input type="text" name="received_quant[]" class="form-control" value="'+value.quantity+'" readonly/></div><div class="col-md-4"><input type="date" name="date[]" class="form-control" value="'+value.dates+'" readonly/></div><div class="col-md-4"><input type="text" id="assign_orders" name="assign_orders[]" class="form-control" placeholder="Assign Quantity"/></div></div><br>')
										});
								}
							});
							$('.data').remove();
						}
				});

				$('input[name="daterange[]"]').on('cancel.daterangepicker', function(ev, picker) {
						$(this).val('');
				});

	});

	$(document).ready(function(){
		$('#error').hide();
		$('#error1').hide();
		$('#assign_orders').on('change',function(){
			var assign_orders = $(this).val();
			var estimated_order = $('#quantity').val();
			var received_order = $('#received_order').val();
			if(parseInt(assign_orders)>parseInt(estimated_order))
			{
				$('#error').show();
			}
			if(parseInt(received_order) < parseInt(assign_orders))
			{
				$('#error1').show();
			}
		})

	});
</script>


<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />


