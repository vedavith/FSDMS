<?php 
if($super_user_data->num_rows() > 0)
{
    // echo json_encode($super_user_data->result());
	foreach($super_user_data->result() as $super_admin)
	{
?>            
<section>
<div class="col-md-2">
</div>
    <div class = "col-md-9 container">
        <div class="card bg-light text-dark">
            <div class="card-body">
   
            <p class = "h3">Change Profile</p>
                <br>
        <form method="post" action="<?php echo base_url()."superadmin/edit_profile_data" ?>">
        <div class="row">    
            <div class="col-md-8">
				<input type="hidden" name="superadmin_id" class="form-control" placeholder="Superadmin ID" value="<?php echo  $super_admin->id;?>" readonly>
                <label>Username</label>
				<input type="text" name="superadmin_name" class="form-control" placeholder="Username" value="<?php echo  $super_admin->user_name;?>" >
                <label>Email Id</label>
				<input type="text" name="superadmin_email" class="form-control" placeholder="Email ID" value="<?php echo  $super_admin->email;?>" readonly>

            	<label> Current Password</label>
				<input type="hidden" class="form-control" name="curr_pass" id="password" placeholder="Current Password" value="<?php echo  $super_admin->password;?>">

				<input type="password" class="form-control" name="old_password" id="confirm_password" placeholder="Current Password" value="">
                <span id='message'></span>
			</div>
            <br>
            <div class="col-md-8">
            	<label> Enter New Password</label>
				<input type="password" class="form-control" name="new_password" placeholder="Enter New Password" value="" id="new_pass">
			</div>
            <br>
            <div class="col-md-8">
            	<label> Re-Enter New Password</label>
				<input type="password" class="form-control" name="renew_pass" placeholder="Re-enter New Password" value=""  id="renew_pass">
			</div>

                <script>
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
                </script>
    </div>

    <br><br>
        <div class="row container">
        <div class="col-md-3"></div>
			<input name="edit_profile_data" type="submit" class="btn btn-outline-success"  value="Submit" />&nbsp;&nbsp;
			<a href="<?php echo base_url()."superadmin/home"; ?>" class="btn btn-outline-danger" >Cancel</a>

        </div>
        
    </div>
    
    </div>
    
    </form>
    </div>
    <div class="card-body">
    <?php

                if(!empty(form_error("superadmin_name")))
                {
                $count = 1;
                ?>
                <div class="row alert alert-danger">
                    <strong>REQUIRED** : </strong> Username is Required
                </div>
                <?php
                }
                ?>
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
            ?>
        </div>
        <br><br><br>
</section>

<?php	
 	} 
 }
?>