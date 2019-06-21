<div class="col-sm-6 col-md-9">
        
  
    
    <div class="row">
    	<div class="col-md-6">
    		<p class="h3" align="left"> Create Notification </p>
    	</div>
    	<div class="col-md-6" align="right">
    		<a class="btn btn-sm btn-outline-danger" href="<?php echo base_url()."kitchen/kitchen_home"; ?>"> Back</a>
    	</div>
    </div><br>
    <div class="row">
    	<div class="card-body">
    		<form method="post" action="<?php echo base_url()?>kitchen/notify_kitchen_data"/>
    			<div class="container">
    				<div class="row">
    					<div class="col-md-2"></div>
    				<div class="col-md-6"> 
                       
    				    <!-- <input type="hidden" name="kitchen" class="form-control" placeholder = "Enter Kitchen Id" value=""><br/> -->
    					<input type="text" name="message" class="form-control" placeholder = "Enter Message" value=""><br/>
                       
    					
    				</div>
                </div><br/>
                <div class="row">
    				<div class="col-md-6" align="center">
                        <button class="btn btn-sm btn-info"> Submit </button>
                    </div>
    			</div>
                </div>
    				
    		</form>
    	</div><br>
    	<?php 
    		if(!empty(form_error("update_mealplan")))
    		{
    	?>
					<div class="alert alert-danger">
  							<strong>REQUIRED** : </strong> Meal Plan is Required 
					</div>
    	<?php		
    		}
    	?>
    </div><br>
  
<div class="row container">
        <div class="table-responsive">
        <table id="table" class="table table-bordered">
            <thead>
                <tr align="center">
                    <th> S.No </th>
                    <th> Message </th>
                    
                    <th> Delete </th>
                    
                </tr>
            </thead>
            <tbody>
                <?php
                   if($notify_data->num_rows() > 0)
                   {

                        $i = 1;
                        foreach ($notify_data->result() as $note) 
                        {
                ?>
                 <tr align="center">
                    <td> <?php echo $i; ?> </td>
                    <td> <?php echo $note->message; ?> </td>
                        
                   
                    <td> <a href="#" class="btn btn-sm btn-danger delete_category" id="<?php echo $note->id; ?>"> Delete </a> </td>
                </tr> 
                <?php
                        $i++;
                       }
                   }
                ?>
            </tbody>            
        </table>
        <br/>
        <br/>
        <br/>
    </div>
    </div> 

   
</div>

<!-- Dont Remove this closed div tag -->
    <!-- Side row closed -->
    </div>
    <!-- sidebar container fluid closed -->
</div>


<script>
$(document).ready(function() {
    $('#table').DataTable();
} );
</script>