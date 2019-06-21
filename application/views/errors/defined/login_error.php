<br><br><br><br>
<section>
	<div class="container">
		<?php 
			if(form_error("email_id"))
			{
		?>	
		<div class="alert alert-danger">
  			<strong>LOGIN ERROR : </strong> There is a problem while logging into this account. Please, Check your Email ID 
		</div>	
		<?php
			}
			if(form_error("password"))
			{
		?>	
		<div class="alert alert-danger">
			<strong>LOGIN ERROR : </strong> There is a problem while logging into this account. Please, Check your Password 
  		</div>
		<?php
			}
		?>
		<?php
			
			if(isset($error_handle))
			{	
				if($error_handle == "unf")
				{	
		?>
		<div class="alert alert-danger">
			<strong>LOGIN ERROR (<?php echo $error_handle; ?>): </strong> Please, Check  your Email and Password or Register.
  		</div>
  		<!-- <script type="text/javascript">
  			// setTimeout(myFunction, 3000);
	  		// 	function myFunction()
	  		// 	{
	  		// 		window.location.href='<?php //echo base_url()."login/";?>';
	  		// 	}
  		</script> -->
	  			
  		
		<?php		
				}
				if($error_handle == "uae")
				{
		?>
			<div class="alert alert-danger">
				<strong>LOGIN ERROR (<?php echo $error_handle; ?>): </strong> User Already Exists. Please,Login.
  			</div>
		<?php
				}
			}	 
		?>
	</div>
</section>