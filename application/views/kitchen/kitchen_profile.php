
<?php 
if($kitchen_reg_data->num_rows() > 0)
{
	foreach($kitchen_reg_data->result() as $kitchen)
	{
?>
<section>
    <div class = "container">
    
                    <p class = "h3"> Kitchen Profile</p>
                <br>
        <form method="post" action="<?php echo base_url()."kitchen/edit_kitchen_data" ?>">
        <div class="row">
            <div class="col-md-3">
            <label>Kitchen ID</label>
				<input type="text" name="kitchen_id" class="form-control" placeholder="Kitchen ID" value="<?php echo  $kitchen->k_id;?>" readonly>
			</div>
			<div class="col-md-3">
            <label>Kitchen Name</label>
				<input type="text" name="kitchen_name" class="form-control" placeholder="Kitchen Name" value="<?php echo  $kitchen->k_name;?>">
			</div>
                  
             <div class="col-md-4">
            <label> Kitchen Type </label>
            <br>
                <input type="radio" name="kitchen_type" value="company" <?php echo ($kitchen->kitchen_type =='company')? 'CHECKED' : '' ; ?>>Company Owned &nbsp;&nbsp;&nbsp;
                <input type="radio" name="kitchen_type" value="other" <?php echo ($kitchen->kitchen_type =='other')? 'CHECKED' : '' ; ?>>Third party
            </div>
           
        </div>
           <br>
        
            <div class="row">
            <div class="col-md-3">
            <label>State</label>
				<input type="text" name="state" class="form-control" placeholder="State" value="<?php echo  $kitchen->state;?>">
			</div>
            <div class="col-md-3">
            <label>City</label>
				<input type="text" name="city" class="form-control" placeholder="City" value="<?php echo  $kitchen->city;?>">
			</div>
            <div class="col-md-3">
            <label>Zipcode</label>
				<input type="text" name="zipcode" class="form-control" placeholder="Zipcode" value="<?php echo  $kitchen->zipcode;?>">
			</div>
			<div class="col-md-3">
            <label>Kitchen Address</label>
        		<input type="text" name="kitchen_address1" class="form-control" placeholder="Kichen Address1" value="<?php echo  $kitchen->k_address1;?>"> <br>
				<input type="text" name="kitchen_address2" class="form-control" placeholder="Kichen Address2" value="<?php echo  $kitchen->k_address2;?>"><br>
        		<input type="text" name="kitchen_address3" class="form-control" placeholder="Kichen Address3" value="<?php echo  $kitchen->k_address3;?>">	
			</div>
            
            
		</div>
        <div class="card-body">
            <?php
                if(!empty(form_error("kitchen_name")))
				{
				$count = 1;
			?>
				<div class="row alert alert-danger">
				    <strong>REQUIRED** : </strong> Kitchen Name is Required
				</div>
			<?php
                }
            ?>
             <?php
                if(!empty(form_error("kitchen_type")))
				{
				$count = 1;
			?>
				<div class="row alert alert-danger">
				    <strong>REQUIRED** : </strong> Kitchen Type is Required
				</div>
			<?php
                }
            ?>
             <?php
                if(!empty(form_error("state")))
				{
				$count = 1;
			?>
				<div class="row alert alert-danger">
				    <strong>REQUIRED** : </strong> State is Required
				</div>
			<?php
                }
            ?>
             <?php
                if(!empty(form_error("city")))
				{
				$count = 1;
			?>
				<div class="row alert alert-danger">
				    <strong>REQUIRED** : </strong> City is Required
				</div>
			<?php
                }
            ?>
             <?php
                if(!empty(form_error("zipcode")))
				{
				$count = 1;
			?>
				<div class="row alert alert-danger">
				    <strong>REQUIRED** : </strong> Zipcode is Required
				</div>
			<?php
                }
            ?>
			<?php
                if(!empty(form_error("kitchen_address1")))
				{
				$count = 1;
			?>
				<div class="row alert alert-danger">
				    <strong>REQUIRED** : </strong> Kitchen address1 is Required
				</div>
			<?php
                }
            ?>
            <?php
                if(!empty(form_error("kitchen_address2")))
				{
				$count = 1;
			?>
				<div class="row alert alert-danger">
				    <strong>REQUIRED** : </strong> Kitchen address2 is Required
				</div>
			<?php
                }
            ?>
            <?php
                if(!empty(form_error("kitchen_address3")))
				{
				$count = 1;
			?>
				<div class="row alert alert-danger">
				    <strong>REQUIRED** : </strong> Kitchen address3 is Required
				</div>
			<?php
                }
            ?>
            </div>
		<div class="row container">
			<input  name="edit_kitchen_data" type="submit" class="btn btn-outline-success"  value="Update" >
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