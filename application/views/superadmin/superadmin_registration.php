<br><br><br>
<section>
    <div class="container">
        <div class="row">
            <div class="col-md-3"></div>
            <div class="card bg-secondary text-white col-md-6">
                <div class="card-body">
                    <div class="card-title" align="center">
                        <p class="h3"> FSDMS Superadmin </p>
                    </div>
                    <form method="post" action="<?php echo base_url(); ?>superadmin/superadmin_registration">
                        <input id="first_name" class="form-control" type="text" name="first_name" placeholder="First Name"><br>
                        <input id="last_name" class="form-control" type="text" name="last_name" placeholder="Last Name"> <br>
                        <input id="user_name" class="form-control" type="text" name="user_name" placeholder="User Name"><br>
                        <input id="email" class="form-control" type="email" name="email_id" placeholder="Email ID"><br> 
                        <input id="phone_number" class="form-control" type="text" name="phone_number" placeholder="Phone Number"><br> 
                        <input id="admin_password" class="form-control" type="password" name="admin_password" placeholder="Password"><br>
                        <input id="confirm_admin_password" class="form-control" type="password" name="confirm_admin_password" placeholder="Confirm Password"> <br>
                        <div class="card-footer" align="center">
                            <input class="btn btn-primary" type="submit" value="Submit">
                        </div>                 
                    </form>
                </div>
            </div>
            <div class="col">
            <?php
						if(!empty(form_error("first_name")))
						{
					?>
					<div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
  							<strong>REQUIRED** : </strong> First Name is Required 
					</div>
					<?php				
						}else{ echo "";}
					?>
					<?php
						if(!empty(form_error("last_name")))
						{
					?>
					<div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
  							<strong>REQUIRED** : </strong> Last Name is Required 
					</div>
					<?php				
						}
					?>
					<?php
						if(!empty(form_error("user_name")))
						{
					?>
					<div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
  							<strong>REQUIRED** : </strong> User Name is Required 
					</div>
					<?php				
						}
					?>
					<?php
						if(!empty(form_error("email_id")))
						{
					?>
					<div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
  							<strong>REQUIRED** : </strong> Email Id is Required 
					</div>
					<?php				
						}
					?>
					<?php
						if(!empty(form_error("phone_number")))
						{
					?>
					<div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
  							<strong>REQUIRED** : </strong> Phone Number is Required 
					</div>
					<?php				
						}
					?>
					<?php
						if(!empty(form_error("admin_password")))
						{
					?>
					<div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
  							<strong>REQUIRED** : </strong> Password is Required 
					</div>
					<?php				
						}
					?>
					<?php
						if(!empty(form_error("confirm_password")))
						{
					?>
					<div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
  							<strong>REQUIRED** : </strong> Confirm Password is Required 
					</div>
					<?php				
						}
					?>
            </div>
        </div> 
    </div>
</section><br>