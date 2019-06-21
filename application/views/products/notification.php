<div class="col-sm-6 col-md-9">
        <?php
        
        if(isset($get_value))
        {
    ?>
    <div class="row">
        <div class="col-md-6">
            <p class="h3" align="left"> Update Notification </p>
        </div>
        <div class="col-md-6" align="right">
            <a class="btn btn-sm btn-outline-danger" href="<?php echo base_url()."superadmin/create_mealplan"; ?>"> Back</a>
        </div>
    </div><br>
    <div class="row">
        <div class="card-body">
            <form method="post" action="<?php echo base_url()."superadmin/update_notification/".$this->uri->segment(3);?>">
                <div class="container">
                    <div class="row">
                        <div class="col-md-2"></div>
                    <div class="col-md-6"> 
                        <?php
                        if($get_value->num_rows() > 0)
                       foreach($get_value->result() as $not)
                         {
                        ?>
                    <input type="hidden" name="update_id" class="form-control" value="<?php echo $not->id; ?>">
                        <input type="text" name="update_message" class="form-control" placeholder = "Enter MealPlan" value="<?php echo $not->message; ?>"><br/>
                        <input type="date" name="update_date" class="form-control" placeholder = "Enter time" value="<?php echo $not->time_stamp; ?>">  
                        <?php } ?>
                    </div>
                </div><br/>
                     <div class="row">
                        <div class="col-md-6" align="center">
                            <button type="submit" class="btn btn-sm btn-warning" name="note_update" value="note_update"> Update </button>
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
    <?php       
        }
      else{  
    	
    ?>
    <div class="row">
    	<div class="col-md-6">
    		<p class="h3" align="left"> Create Notification </p>
    	</div>
    	<div class="col-md-6" align="right">
    		<a class="btn btn-sm btn-outline-danger" href="<?php echo base_url()."superadmin/create_mealplan"; ?>"> Back</a>
    	</div>
    </div><br>
    <div class="row">
    	<div class="card-body">
    		<form method="post" action="<?php echo base_url()."superadmin/notification_data/".$this->uri->segment(3);?>">
    			<div class="container">
    				<div class="row">
    					<div class="col-md-2"></div>
    				<div class="col-md-6"> 
                       
    				
    					<input type="text" name="message" class="form-control" placeholder = "Enter Message" value=""><br/>
                        <input type="date" name="date_insert" class="form-control" placeholder = "Enter Date" value="">
    					
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
  <?php
}
?>
         <div class="row container">
        <div class="table-responsive">
        <table id="table" class="table table-bordered">
            <thead>
                <tr align="center">
                    <th> S.No </th>
                    <th> Message </th>
                    <th> Date </th>
                    <th> Edit </th>
                    <th> Delete</th>
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
                    <td> <?php echo $note->time_stamp;?></td>
                    <td> <a class="btn btn-sm btn-primary" href="<?php echo base_url()."superadmin/update_notification/".$note->id; ?>"> Edit </a> </td>
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

<script type="text/javascript">
	$(document).ready(function(){
		$(".delete_category").click(function(){
			var id = $(this).attr("id");
			if(confirm("Are you sure you want to delete this?"))
			{
				window.location="<?php echo base_url();?>superadmin/delete_notify/"+id;
			}
			else
			{
				return false;
			}
		});
	});
</script>
<script>
$(document).ready(function() {
    $('#table').DataTable();
} );
</script>