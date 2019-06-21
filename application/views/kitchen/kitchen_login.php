<br><br><br><br><br><br><br><br><br><br>
<section>
    <div class="container">
        <div class="row">
            <div class="col-md-3"></div>
            <div class="card bg-secondary text-white col-md-6">
                <div class="card-body">
                    <div class="card-title" align="center">
                        <p class="h3"> FSDMS Kitchen </p>
                    </div>
                    <form method="post" action="<?php echo base_url(); ?>kitchen/kitchen_login">
                        <input id="email" class="form-control" type="text" name="user_name" placeholder="User Name or Email ID"><br> 
                        <input id="admin_password" class="form-control" type="password" name="admin_password" placeholder="Password"><br>
                        <div class="card-footer" align="center">
                            <input class="btn btn-primary" type="submit" value="Login">
                        </div>                 
                    </form>
                </div>
            </div>
            <div class="col-md-3">
            	<?php
						if(!empty(form_error("user_name")))
						{
					?>
					<div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
  							<strong>REQUIRED** : </strong> User Name is Required 
					</div>
					<?php				
						}else{ echo "";}
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
					   if(isset($error_handler))
					   {
					  ?>
					  <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
  							<strong>ERROR[unf] : </strong> <?php echo $error_handler; ?>
					</div>
					  <?php     
					   }
					?>
            </div>
        </div> 
    </div>
</section><br>