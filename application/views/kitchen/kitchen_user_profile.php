<?php 
if($kitchen_user_data->num_rows() > 0)
{
	foreach($kitchen_user_data->result() as $kitchen_admin)
	{
?>

<section>
    <div class = "container">
    
                    <p class = "h3">User Profile</p>
                <br>
        <form method="post" action="<?php echo base_url()."kitchen/edit_user_data" ?>">
        <div class="row">
            <div class="col-md-3">
            <label>Kitchen ID</label>
				<input type="hidden" name="id" class="form-control" placeholder="Kitchen ID" value="<?php echo  $kitchen_admin->id;?>" readonly>

				<input type="text" name="kitchen_id" class="form-control" placeholder="Kitchen ID" value="<?php echo  $kitchen_admin->kitchen_id;?>" readonly>
			</div>
			<div class="col-md-3">
            <label>First Name</label>
				<input type="text" name="first_name" class="form-control" placeholder="First Name" value="<?php echo  $kitchen_admin->first_name;?>">
			</div>
			
			<div class="col-md-3">
            <label>Last Name</label>
				<input type="text" name="last_name" class="form-control" placeholder="Last Name" value="<?php echo  $kitchen_admin->last_name;?>">
			</div>
            <div class="col-md-3">
            <label>Email ID</label>
				<input type="text" class="form-control" name="email_id" placeholder="Email" value="<?php echo  $kitchen_admin->email_id;?>">
			</div>
	    </div><br>
		<div class="row">
			
            <div class="col-md-3">
            	<label>Username</label>
				<input type="text" class="form-control" name="user_name" placeholder="Username" value="<?php echo  $kitchen_admin->user_name;?>">
			</div>
           
			<!-- <script>
                                         $('#password, #confirm_password').on('keyup', function () {
                                            if ($('#password').val() == $('#confirm_password').val()) {
                                                $('#message').html('Matching').css('color', 'green');
                                            } else 
                                                $('#message').html('Not Matching').css('color', 'red');
                                                                            });

                                         $('#new_pass, #renew_pass').on('keyup', function () {
                                            if ($('#new_pass').val() == $('#renew_pass').val()) 
                                            {
                                                // console.log("matching");
                                                $('#message1').html('Matching').css('color', 'green');
                                                $('#renew_pass').css('background', '#55d24980');
                                            } 
                                            else
                                            { 
                                                // console.log(" not matching");
                                                $('#message1').html('Not Matching').css('color', 'red');
                                                $('#renew_pass').css('background', '#ff8787a1');
                                            }
                                                });
                                </script> -->
		</div><br>
        <div class="card-body">
            <?php
                if(!empty(form_error("user_name")))
				{
				$count = 1;
			?>
				<div class="row alert alert-danger">
				    <strong>REQUIRED** : </strong> User Name is Required
				</div>
			<?php
                }
            ?>
            <?php
                if(!empty(form_error("first_name")))
				{
				$count = 1;
			?>
				<div class="row alert alert-danger">
				    <strong>REQUIRED** : </strong> First Name is Required
				</div>
			<?php
                }
            ?>
            <?php
                if(!empty(form_error("last_name")))
				{
				$count = 1;
			?>
				<div class="row alert alert-danger">
				    <strong>REQUIRED** : </strong> Last Name is Required
				</div>
			<?php
                }
            ?>
            <?php
                if(!empty(form_error("email_id")))
				{
				$count = 1;
			?>
				<div class="row alert alert-danger">
				    <strong>REQUIRED** : </strong> Email ID is Required
				</div>
			<?php
                }
            ?>
<!--             
            <?php
                if(!empty(form_error("old_password")))
				{
				$count = 1;
			?>
				<div class="row alert alert-danger">
				    <strong>REQUIRED** : </strong> Current Password is Required
				</div>
			<?php
                }
            ?>
            <?php
                if(!empty(form_error("new_password")))
				{
				$count = 1;
			?>
				<div class="row alert alert-danger">
				    <strong>REQUIRED** : </strong> New Password is Required
				</div>
			<?php
                }
            ?>
            <?php
                if(!empty(form_error("renew_pass")))
				{
				$count = 1;
			?>
				<div class="row alert alert-danger">
				    <strong>REQUIRED** : </strong> Re Enter Password is Required
				</div>
			<?php
                }
            ?> -->
            </div>
		<div class="row container">
			<input name="edit_user_data" type="submit" class="btn btn-outline-success"  value="Update" />
        </div>
    </form>	 
<br>
<div class="container">
																																																																	</div><br><br><br>
    </div>
</section>

<?php	
	} 
}
?>