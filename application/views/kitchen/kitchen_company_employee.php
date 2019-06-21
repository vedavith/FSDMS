<?php 
if(!isset($kitchen_emp_data))
{



	
?>
<!-- <div class="row">

<div class="col-md-6" align="left">   
<a class="btn btn-sm btn-outline-danger" href="<?php //echo base_url()."kitchen/view_employee" ?>"> Back</a>
</div>    
</div>
 -->
 <script>
 //copy address
function FillBilling(f)
{
  if(f.billingtoo.checked == true)
  {
    f.p_addr1.value = f.l_addr1.value;
    f.p_addr2.value = f.l_addr2.value;
    f.p_addr3.value = f.l_addr3.value;
    f.p_state.value = f.l_state.value;
    
    f.p_city.value = f.l_city.value;
    f.p_zipcode.value = f.l_zipcode.value;
  }
  if(f.billingtoo.checked != true)
  {
   
   f.p_addr1.value = "";
    f.p_addr2.value = "";
    f.p_addr3.value = "";
    f.p_state.value = "";
  
    f.p_city.value = "";
    f.p_zipcode.value = "";
  }
  
}
 </script>
 <section>
<div class="row">
        <div class="col-md-6">
            
        </div>
        <div class="col-md-6" align="right">
        <a class="btn btn-sm btn-outline-danger" href="<?php echo base_url()."superadmin/view_employee" ?>"> Back</a>
        </div>
    </div>

<div class="col-md-2">
</div>
    <div class = "col-md-11 container">
        <div class="card bg-light text-dark">
            <div class="card-body">
   
            <p class = "h3">Kitchen Employee</p>
                <br>
        <form method="post" action="<?php echo base_url()."superadmin/employee" ?>">
        <div class="row"> 
         
            <div class="col-md-3">
                <label>Kitchen Id</label>
				<!--<input type="text" name="txtkitchen_id" class="form-control" placeholder="" value="<?php //echo  $kitchen->k_id;?>" readonly>-->
           
            <select name="txtkitchen_id" class="form-control">
                    <option value="">Select Kitchen</option>
                    <?php

                    if($kitchen_data->num_rows() > 0)
                    {
                        foreach($kitchen_data->result() as $kitchen)
                        {
                            ?>
                        <option value="<?php echo $kitchen->k_id ?>"><?php echo $kitchen->k_name ?></option>
                            <?php
                        }
                    }
                    ?>
                </select>
                 </div>
            <div class="col-md-3">
                <label>Employee Id</label>
				<input type="text" name="txtemp_id" class="form-control" placeholder="" value="<?php //echo  $kitchen->k_id;?>">
            </div>
            <div class="col-md-3">
            	<label> First Name</label>
				<input type="text" class="form-control" name="txtemp_name" id="password" placeholder="" value="<?php //echo  $kitchen_admin->password;?>">
			</div>
          
            <div class="col-md-3 col-sm-10">
                <label class="control-label">Last Name</label>
                <input class="form-control" type="text" name="txtLname" value=""/>
            </div> 
            </div>
            <br>
            <div class="row">
            <div class="col-md-3">
                <label class="control-label">Middle Name</label>
                <input class="form-control" type="text" name="txtMname" value=""/>
            </div> 
            <div class="col-md-3">
                <label class="control-label">Gender</label>
                <select class="form-control" name="txtGender" required>
                    <option> Select Gender </option>
                    <option value="M" > Male </option>
                    <option value="F" > Female </option>
                    <option value="O" > Others </option>

                </select>
            </div> 
            <div class="col-md-3">
            	<label> Employee Role</label>
				<!-- <input type="text" class="form-control" name="emp_role" placeholder="" value="" > -->
                <select name="txtemp_role" class="form-control">
                    <option value="">Select Role</option>
                    <?php
                    if($get_role->num_rows() > 0)
                    {
                        foreach($get_role->result() as $emp_role)
                        {
                            ?>
                        <option value="<?php echo $emp_role->id ?>"><?php echo $emp_role->emp_role ?></option>
                            <?php
                        }
                    }
                    ?>
                </select>
			</div>
            <div class="col-md-3">
            	<label> Email Id</label>
				<input type="text" class="form-control" name="txtemail_id" placeholder="" value=""  >
			</div>
        </div>
        
        <br>
        <div class="row">
                    <div class="col-md-3">
                        <label>Blood Group</label>
                        <select class="form-control" name="txtBlood" required>
                            <option> Select Blood Group </option>
                            <option value="A+" >A+</option>
                            <option value="A-" >A-</option>
                            <option value="B+" >B+</option>
                            <option value="B-" >B-</option>
                            <option value="O+" >O+</option>
                            <option value="O-" >O-</option>
                            <option value="AB+">AB+</option>
                            <option value="AB-">AB-</option>
                        </select>
                    </div>
                    
                    <div class="col-md-3 col-sm-12">
                        <label class="control-label">Date Of Birth</label>
                        <input class="form-control" type="date" name="txtBirthdate" value="">
                    </div>
                    <div class="col-md-3">
                        <label class="control-label">Date Of Joining</label>
                        <input class="form-control" type="date" name="txtJoindate" value="">
                    </div>
                    <div class="col-md-3">
                            <label>Mobile</label>
                            <input type="text" class="form-control" name="txtmobile" value=""/>
                    </div>
                </div><br>
                <div class="row">
                        <div class="col-md-3">
                            <label>Emergency Contact </label>
                            <input type="text" class="form-control" name="txtemgcnt" value=""/>
                        </div>
                        <div class="col-md-3">
                            <label>Aadhar </label>
                            <input type="text" class="form-control" name="txtaadhar" value=""/>
                        </div>
                        <div class="col-md-3">
                            <label>PAN</label>
                            <input type="text" class="form-control" name="txtpan" value=""/>
                        </div>
                        <div class="col-md-3">
                            <label>Passport No.</label>
                            <input type="text" class="form-control" name="txtpass" value=""/>
                        </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-3">
                                <label class="control-label">Local Address</label>
                                <input type="text" CLASS="form-control" name="l_addr1"   style="margin-bottom:5px;" value="">
                                <input type="text" CLASS="form-control" name="l_addr2"   style="margin-bottom:5px;"value="">
                                <input type="text" CLASS="form-control" name="l_addr3"  style="margin-bottom:5px;" value="">
                            </div>
                            
                            <div class="col-md-3">
                               
                            <label class="control-label">State</label>
                                <input type="text" class = "form-control" autocomplete="off" name="l_state" id="state" value="" >        
                            </div>
                            <div class="col-md-3">
                            <label class="control-label">City</label>
                                <input type="text" class = "form-control" autocomplete="off" name="l_city" id="city" value="" >
                                <label class="control-label">Zipcode</label>
                                <input type="text" class = "form-control" autocomplete="off" name="l_zipcode" id="zipcode" value="" >
                            </div>
                            </div>
                            
                            <div class="row">
                            <div class="col-md-6" style="margin-top:15px;margin-bottom:5px;">
                                                        <input type="checkbox" name="billingtoo" onclick="FillBilling(this.form)">
                                                            <em>COPY SAME ADDRESS TO PERMANENT ADDRESS</em>
                                                    </div>
                            </div>
                            <div class="row">
                            <div class="col-md-3">
                                <label class="control-label">Permanent Address</label>
                                <input type="text" CLASS="form-control" name="p_addr1"  style="margin-bottom:5px;" value="">
                                <input type="text" CLASS="form-control" name="p_addr2"  style="margin-bottom:5px;" value="">
                                <input type="text" CLASS="form-control" name="p_addr3"  style="margin-bottom:5px;" value="">
                                </div>
                                
                                <div class="col-md-3">
                                    
                                <label class="control-label">State</label>
                                    <input type="text" class = "form-control" autocomplete="off" name="p_state" id="state" value="">
                                </div>
                                <div class="col-md-3">
                                <label class="control-label">City</label>
                                    <input type="text" class = "form-control" autocomplete="off" name="p_city" id="city" value="">
                                    <label class="control-label">Zipcode</label>
                                    <input type="text" class = "form-control" autocomplete="off" name="p_zipcode" id="zipcode"  value="">
                                </div>
                            </div>
                            <br>
                            <div class="row">
                            <div class="col-md-9">
                                    <h5>Dependent Details</h5>
                                </div>
                            </div>
                            <hr class="hr-primary" style="border-top: 1px solid #94a3bf !important; " />
                            <div class="row">
                            <div class="col-md-3">
                                <label>Father's Name</label>
                                <input type="text" class="form-control" name="txtfather" value=""/>
                            </div>
                            <div class="col-md-3">
                                <label>Father's Email</label>
                                <input type="text" class="form-control" name="txtfathmail" value=""/>
                            </div>
                            <div class="col-md-3">
                                <label>Father's Mobile</label>
                                <input type="text" class="form-control" name="txtfathmob" value=""/>
                            </div>
                            <div class="col-md-3">
                                <label>Father's Aadhar</label>
                                <input type="text" class="form-control" name="txtfathaadhar" value=""/>
                            </div>
                            </div>
                            <br>
                            <div class="row">
                            <div class="col-md-3">
                                <label>Mother's Name</label>
                                <input type="text" class="form-control" name="txtmother"  value=""/>
                            </div>
                            <div class="col-md-3">
                                <label>Mother's Email</label>
                                <input type="text" class="form-control" name="txtmothmail" value=""/>
                            </div>
                            <div class="col-md-3">
                                <label>Mother's Mobile</label>
                                <input type="text" class="form-control" name="txtmothmob" value=""/>
                            </div>
                            <div class="col-md-3">
                                <label>Mother's Aadhar</label>
                                <input type="text" class="form-control" name="txtmothaadhar" value=""/>
                            </div>
                            </div>
                            <br>
                            <!-- <div class="row">
                            <div class="col-md-3">
                                <label>Spouse Name</label>
                                <input type="text" class="form-control" name="txtspouse"  value=""/>
                            </div>
                            <div class="col-md-3">
                                <label>Spouse Email</label>
                                <input type="text" class="form-control" name="txtspomail" value=""/>
                            </div>
                            <div class="col-md-3">
                                <label>Spouse Mobile</label>
                                <input type="text" class="form-control" name="txtspomob" value=""/>
                            </div>
                            <div class="col-md-3">
                                <label>Spouse Aadhar</label>
                                <input type="text" class="form-control" name="txtspoaadhar" value=""/>
                            </div>
                            </div>
                            <br> -->
                            <div class="row">
                                <div class="col-md-9">
                                    <h5>Bank Details</h5>
                                </div>
                            </div>
                            <hr class="hr-primary" style="border-top: 1px solid #94a3bf !important; " />
                            <div class="row">
                                <div class="col-md-3">
                                    <label>Bank Name</label>
                                    <input type="text" class="form-control" name="txtbank" value="">
                                </div>
                                <div class="col-md-3">
                                    <label>Account Number</label>
                                    <input type="text" class="form-control" name="txtacct" value="">
                                </div>
                                <div class="col-md-3">
                                    <label> Branch</label>
                                    <input type="text" class="form-control" name="txtbranch" value="">
                                </div>
                                <div class="col-md-3">
                                    <label>IFSC</label>
                                    <input type="text" class="form-control" name="txtifsc" value="">
                                </div>
                            </div>

                
    </div>

    <br><br>
        <div class="row container">
        <div class="col-md-5"></div>
			<input name="edit_profile_data" type="submit" class="btn btn-outline-success"  value="Submit" />&nbsp;&nbsp;
			<button type="reset" class="btn btn-outline-danger"> Cancel </button>
 
        </div>
       
        </div>
    
    
    <div class="card-body">
    <?php
    $count=0;
    
                if(!empty(form_error("txtemp_name")))
				{
				$count = 1;
			?>
				<div class="row alert alert-danger">
				    <strong>REQUIRED** : </strong> Employee Name is Required
				</div>
			<?php
                }
            ?>
            <?php
                if(!empty(form_error("txtLname")))
				{
				$count = 1;
			?>
				<div class="row alert alert-danger">
				    <strong>REQUIRED** : </strong> Last name is Required
				</div>
			<?php
                }
            ?>
            <?php
                if(!empty(form_error("txtMname")))
				{
				$count = 1;
			?>
				<div class="row alert alert-danger">
				    <strong>REQUIRED** : </strong> Middle name is Required
				</div>
			<?php
                }
            ?>
            <?php
                if(!empty(form_error("txtGender")))
				{
				$count = 1;
			?>
				<div class="row alert alert-danger">
				    <strong>REQUIRED** : </strong> Gender is Required
				</div>
			<?php
                }
            ?>
            <?php
                if(!empty(form_error("txtemp_id")))
				{
				$count = 1;
			?>
				<div class="row alert alert-danger">
				    <strong>REQUIRED** : </strong> Employee Id is Required
				</div>
			<?php
                }
            ?>
            <?php
                if(!empty(form_error("emp_role")))
				{
				$count = 1;
			?>
				<div class="row alert alert-danger">
				    <strong>REQUIRED** : </strong> Employee Role is Required
				</div>
			<?php
                }
            ?>
            <?php
                if(!empty(form_error("txtemail_id")))
				{
				$count = 1;
			?>
				<div class="row alert alert-danger">
				    <strong>REQUIRED** : </strong> Email Id is Required
				</div>
                <?php
                }
            ?>
            <?php
                if(!empty(form_error("txtBlood")))
				{
				$count = 1;
			?>
				<div class="row alert alert-danger">
				    <strong>REQUIRED** : </strong> Blood Group is Required
				</div>
			<?php
                }
            ?>
            <?php
                if(!empty(form_error("txtBirthdate")))
				{
				$count = 1;
			?>
				<div class="row alert alert-danger">
				    <strong>REQUIRED** : </strong> Birth date is Required
				</div>
			<?php
                }
            ?>
            <?php
                if(!empty(form_error("txtJoindate")))
				{
				$count = 1;
			?>
				<div class="row alert alert-danger">
				    <strong>REQUIRED** : </strong> Join date is Required
				</div>
			<?php
                }
            ?>
            <?php
                if(!empty(form_error("txtmobile")))
				{
				$count = 1;
			?>
				<div class="row alert alert-danger">
				    <strong>REQUIRED** : </strong> Mobile No is Required
				</div>
                <?php
                }
            ?>
            <?php
                if(!empty(form_error("txtemgcnt")))
				{
				$count = 1;
			?>
				<div class="row alert alert-danger">
				    <strong>REQUIRED** : </strong> Emergency Contact is Required
				</div>
			<?php
                }
            ?>
            <?php
                if(!empty(form_error("txtaadhar")))
				{
				$count = 1;
			?>
				<div class="row alert alert-danger">
				    <strong>REQUIRED** : </strong> Aadhar No. is Required
				</div>
			<?php
                }
            ?>
            <?php
                if(!empty(form_error("txtpan")))
				{
				$count = 1;
			?>
				<div class="row alert alert-danger">
				    <strong>REQUIRED** : </strong> Pan No. is Required
				</div>
			<?php
                }
            ?>
            <?php
                if(!empty(form_error("txtpass")))
				{
				$count = 1;
			?>
				<div class="row alert alert-danger">
				    <strong>REQUIRED** : </strong> Passport No. is Required
				</div>
			<?php
                }
            ?>
            <?php
                if(!empty(form_error("l_addr1")))
				{
				$count = 1;
			?>
				<div class="row alert alert-danger">
				    <strong>REQUIRED** : </strong> Address1 is Required
				</div>
                <?php
                }
            ?>
            <?php
                if(!empty(form_error("l_addr2")))
				{
				$count = 1;
			?>
				<div class="row alert alert-danger">
				    <strong>REQUIRED** : </strong> Address2 is Required
				</div>
                <?php
                }
            ?>
            <?php
                if(!empty(form_error("l_addr3")))
				{
				$count = 1;
			?>
				<div class="row alert alert-danger">
				    <strong>REQUIRED** : </strong> Address3 is Required
				</div>
                <?php
                }
            ?>
            
            <?php
                if(!empty(form_error("l_state")))
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
                if(!empty(form_error("l_city")))
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
                if(!empty(form_error("l_zipcode")))
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
                if(!empty(form_error("p_addr1")))
				{
				$count = 1;
			?>
				<div class="row alert alert-danger">
				    <strong>REQUIRED** : </strong> Address1 is Required
				</div>
                <?php
                }
            ?>
            <?php
                if(!empty(form_error("p_addr2")))
				{
				$count = 1;
			?>
				<div class="row alert alert-danger">
				    <strong>REQUIRED** : </strong> Address2 is Required
				</div>
                <?php
                }
            ?>
            <?php
                if(!empty(form_error("p_addr3")))
				{
				$count = 1;
			?>
				<div class="row alert alert-danger">
				    <strong>REQUIRED** : </strong> Address3 is Required
				</div>
                <?php
                }
            ?>
            
            <?php
                if(!empty(form_error("p_state")))
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
                if(!empty(form_error("p_city")))
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
                if(!empty(form_error("p_zipcode")))
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
                if(!empty(form_error("txtfather")))
				{
				$count = 1;
			?>
				<div class="row alert alert-danger">
				    <strong>REQUIRED** : </strong> father Name is Required
				</div>
                <?php
                }
            ?>
            <?php
                if(!empty(form_error("txtfathmob")))
				{
				$count = 1;
			?>
				<div class="row alert alert-danger">
				    <strong>REQUIRED** : </strong> father Mobile is Required
				</div>
                <?php
                }
            ?>
            <?php
                if(!empty(form_error("txtfathaadhar")))
				{
				$count = 1;
			?>
				<div class="row alert alert-danger">
				    <strong>REQUIRED** : </strong> father Aadhar is Required
				</div>
                <?php
                }
            ?>
            <?php
                if(!empty(form_error("txtmother")))
				{
				$count = 1;
			?>
				<div class="row alert alert-danger">
				    <strong>REQUIRED** : </strong> Mother Name is Required
				</div>
                <?php
                }
            ?>
            <?php
                if(!empty(form_error("txtmothmail")))
				{
				$count = 1;
			?>
				<div class="row alert alert-danger">
				    <strong>REQUIRED** : </strong> Mother Mail is Required
				</div>
                <?php
                }
            ?>
            <?php
                if(!empty(form_error("txtmothmob")))
				{
				$count = 1;
			?>
				<div class="row alert alert-danger">
				    <strong>REQUIRED** : </strong> Mother Mobile is Required
				</div>
                <?php
                }
            ?>
            <?php
                if(!empty(form_error("txtmothaadhar")))
				{
				$count = 1;
			?>
				<div class="row alert alert-danger">
				    <strong>REQUIRED** : </strong> Mother Aadhar is Required
				</div>
                <?php
                }
            ?>
            <?php
                if(!empty(form_error("txtbank")))
				{
				$count = 1;
			?>
				<div class="row alert alert-danger">
				    <strong>REQUIRED** : </strong> Bank Name is Required
				</div>
                <?php
                }
            ?>
            <?php
                if(!empty(form_error("txtacct")))
				{
				$count = 1;
			?>
				<div class="row alert alert-danger">
				    <strong>REQUIRED** : </strong> Account is Required
				</div>
                <?php
                }
            ?>
            <?php
                if(!empty(form_error("txtbranch")))
				{
				$count = 1;
			?>
				<div class="row alert alert-danger">
				    <strong>REQUIRED** : </strong> Branch is Required
				</div>
                <?php
                }
            ?>
            <?php
                if(!empty(form_error("txtifsc")))
				{
				$count = 1;
			?>
				<div class="row alert alert-danger">
				    <strong>REQUIRED** : </strong> IFSC is Required
				</div>
                <?php
                }
            ?>
            <br>
        </div>
        </div>
    
    </div>
    
    </form>
    </div>
        <br><br><br>
</section>

<?php	
 
}
else
{
    if(isset($kitchen_emp_data))
    {
       
        $session_emp_id = array("emp_id" => $this->uri->segment(3));
        $this->session->set_userdata($session_emp_id);

        foreach($kitchen_emp_data->result() as $kitchen)
	{
        ?>
        <section>
<div class="row">
        <div class="col-md-6">
            
        </div>
        <div class="col-md-6" align="right">
        <a class="btn btn-sm btn-outline-danger" href="<?php echo base_url()."kitchen/view_employee" ?>"> Back</a>
        </div>
    </div>

<div class="col-md-2">
</div>
    <div class = "col-md-11 container">
        <div class="card bg-light text-dark">
            <div class="card-body">
   
            <p class = "h3">Edit Kitchen Employee</p>
                <br>
        <form method="post" action="<?php echo base_url()."superadmin/update_employee" ?>">
        <div class="row"> 
         
            <div class="col-md-3">
                <label>Kitchen Id</label>
				<input type="hidden" name="id" class="form-control" placeholder="" value="<?php echo  $kitchen->id;?>">

				<!--<input type="text" name="txtkitchen_id" class="form-control" placeholder="" value="<?php //echo  $kitchen->kitchen_id;?>" readonly>-->
                <select name="txtkitchen_id" class="form-control">
                    <option value="">Select Kitchen</option>
                    <?php

                    if($kitchen_data->num_rows() > 0)
                    {
                        foreach($kitchen_data->result() as $k)
                        {
                            ?>
                        <option value="<?php echo $k->k_id; ?>"<?php if($k->k_id == $kitchen->kitchen_id) echo "selected ='selected'"; ?>><?php echo $k->k_name ?></option>
                            <?php
                        }
                    }
                    ?>
                </select>
            </div>
            <div class="col-md-3">
                <label>Employee Id</label>
				<input type="text" name="txtemp_id" class="form-control" placeholder="" value="<?php echo  $kitchen->emp_id;?>">
            </div>
            <div class="col-md-3">
            	<label> First Name</label>
				<input type="text" class="form-control" name="txtemp_name" id="password" placeholder="" value="<?php echo  $kitchen->emp_name;?>">
			</div>
          
            <div class="col-md-3 col-sm-10">
                <label class="control-label">Last Name</label>
                <input class="form-control" type="text" name="txtLname" value="<?php echo  $kitchen->Lname;?>"/>
            </div> 
            </div>
            <br>
            <div class="row">
            <div class="col-md-3">
                <label class="control-label">Middle Name</label>
                <input class="form-control" type="text" name="txtMname" value="<?php echo  $kitchen->Mname;?>"/>
            </div> 
            <div class="col-md-3">
                <label class="control-label">Gender</label>
                <select class="form-control" name="txtGender" required>
                    <option> Select Gender </option>
                    <option value="M"<?php if($kitchen->Gender == "M"){echo "selected='selected'";}?> > Male </option>
                    <option value="F" <?php if($kitchen->Gender == "F"){echo "selected='selected'";}?>> Female </option>
                    <option value="O" <?php if($kitchen->Gender == "O"){echo "selected='selected'";}?> > Others </option>

                </select>
            </div> 
            <div class="col-md-3">
            	<label> Employee Role</label>
				<!-- <input type="text" class="form-control" name="emp_role" placeholder="" value="" > -->
                <select name="txtemp_role" class="form-control">
                    <option value="">Select Role</option>
                    <?php
                    if($get_role->num_rows() > 0)
                    {
                        foreach($get_role->result() as $emp_role)
                        {
                            ?>
                        <option value="<?php echo $emp_role->id; ?>"<?php if($emp_role->id == $kitchen->emp_role)  echo "selected='selected'";  ?>><?php echo $emp_role->emp_role; ?></option>
                            <?php
                        }
                    }
                    ?>
                </select>
			</div>
            <div class="col-md-3">
            	<label> Email Id</label>
				<input type="text" class="form-control" name="txtemail_id" placeholder="" value="<?php echo  $kitchen->email_id;?>"  >
			</div>
        </div>
        
        <br>
        <div class="row">
                    <div class="col-md-3">
                        <label>Blood Group</label>
                        <select class="form-control" name="txtBlood" required>
                            <option> Select Blood Group </option>
                            <option value="A+" <?php if($kitchen->Blood == "A+"){ echo "selected='selected'";}?> >A+</option>
                            <option value="A-" <?php if($kitchen->Blood == "A-"){echo "selected='selected'";}?>>A-</option>
                            <option value="B+" <?php if($kitchen->Blood == "B+"){echo "selected='selected'";}?>>B+</option>
                            <option value="B-" <?php if($kitchen->Blood == "B-"){echo "selected='selected'";}?>>B-</option>
                            <option value="O+" <?php if($kitchen->Blood == "O-"){echo "selected='selected'";}?>>O+</option>
                            <option value="O-" <?php if($kitchen->Blood == "O-"){echo "selected='selected'";}?>>O-</option>
                            <option value="AB+" <?php if($kitchen->Blood == "AB-"){echo "selected='selected'";}?>>AB+</option>
                            <option value="AB-" <?php if($kitchen->Blood == "AB-"){echo "selected='selected'";}?>>AB-</option>
                        </select>
                    </div>
                    
                    <div class="col-md-3 col-sm-12">
                        <label class="control-label">Date Of Birth</label>
                        <input class="form-control" type="date" name="txtBirthdate" value="<?php echo  $kitchen->Birthdate;?>">
                    </div>
                    <div class="col-md-3">
                        <label class="control-label">Date Of Joining</label>
                        <input class="form-control" type="date" name="txtJoindate" value="<?php echo  $kitchen->Joindate;?>">
                    </div>
                    <div class="col-md-3">
                            <label>Mobile</label>
                            <input type="text" class="form-control" name="txtmobile" value="<?php echo  $kitchen->mobile;?>"/>
                    </div>
                </div><br>
                <div class="row">
                        <div class="col-md-3">
                            <label>Emergency Contact </label>
                            <input type="text" class="form-control" name="txtemgcnt" value="<?php echo  $kitchen->emgcnt;?>"/>
                        </div>
                        <div class="col-md-3">
                            <label>Aadhar </label>
                            <input type="text" class="form-control" name="txtaadhar" value="<?php echo  $kitchen->aadhar;?>"/>
                        </div>
                        <div class="col-md-3">
                            <label>PAN</label>
                            <input type="text" class="form-control" name="txtpan" value="<?php echo  $kitchen->pan;?>"/>
                        </div>
                        <div class="col-md-3">
                            <label>Passport No.</label>
                            <input type="text" class="form-control" name="txtpass" value="<?php echo  $kitchen->pass;?>"/>
                        </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-3">
                                <label class="control-label">Local Address</label>
                                <input type="text" CLASS="form-control" name="l_addr1"   style="margin-bottom:5px;" value="<?php echo  $kitchen->l_address1;?>">
                                <input type="text" CLASS="form-control" name="l_addr2"   style="margin-bottom:5px;"value="<?php echo  $kitchen->l_address2;?>">
                                <input type="text" CLASS="form-control" name="l_addr3"  style="margin-bottom:5px;" value="<?php echo  $kitchen->l_address3;?>">
                            </div>
                            
                            <div class="col-md-3">
                               
                            <label class="control-label">State</label>
                                <input type="text" class = "form-control" autocomplete="off" name="l_state" id="state" value="<?php echo  $kitchen->state;?>" >        
                            </div>
                            <div class="col-md-3">
                            <label class="control-label">City</label>
                                <input type="text" class = "form-control" autocomplete="off" name="l_city" id="city" value="<?php echo  $kitchen->city;?>" >
                                <label class="control-label">Zipcode</label>
                                <input type="text" class = "form-control" autocomplete="off" name="l_zipcode" id="zipcode" value="<?php echo  $kitchen->zipcode;?>" >
                            </div>
                            </div>
                            
                            <div class="row">
                            <div class="col-md-6" style="margin-top:15px;margin-bottom:5px;">
                                                        <input type="checkbox" name="billingtoo" onclick="FillBilling(this.form)">
                                                            <em>COPY SAME ADDRESS TO PERMANENT ADDRESS</em>
                                                    </div>
                            </div>
                            <div class="row">
                            <div class="col-md-3">
                                <label class="control-label">Permanent Address</label>
                                <input type="text" CLASS="form-control" name="p_addr1"  style="margin-bottom:5px;" value="<?php echo  $kitchen->p_address1;?>">
                                <input type="text" CLASS="form-control" name="p_addr2"  style="margin-bottom:5px;" value="<?php echo  $kitchen->p_address2;?>">
                                <input type="text" CLASS="form-control" name="p_addr3"  style="margin-bottom:5px;" value="<?php echo  $kitchen->p_address3;?>">
                                </div>
                                
                                <div class="col-md-3">
                                    
                                <label class="control-label">State</label>
                                    <input type="text" class = "form-control" autocomplete="off" name="p_state" id="state" value="<?php echo  $kitchen->p_state;?>">
                                </div>
                                <div class="col-md-3">
                                <label class="control-label">City</label>
                                    <input type="text" class = "form-control" autocomplete="off" name="p_city" id="city" value="<?php echo  $kitchen->p_city;?>">
                                    <label class="control-label">Zipcode</label>
                                    <input type="text" class = "form-control" autocomplete="off" name="p_zipcode" id="zipcode"  value="<?php echo  $kitchen->p_zipcode;?>">
                                </div>
                            </div>
                            <br>
                            <div class="row">
                            <div class="col-md-9">
                                    <h5>Dependent Details</h5>
                                </div>
                            </div>
                            <hr class="hr-primary" style="border-top: 1px solid #94a3bf !important; " />
                            <div class="row">
                            <div class="col-md-3">
                                <label>Father's Name</label>
                                <input type="text" class="form-control" name="txtfather" value="<?php echo  $kitchen->father_name;?>"/>
                            </div>
                            <div class="col-md-3">
                                <label>Father's Email</label>
                                <input type="text" class="form-control" name="txtfathmail" value="<?php echo  $kitchen->father_email;?>"/>
                            </div>
                            <div class="col-md-3">
                                <label>Father's Mobile</label>
                                <input type="text" class="form-control" name="txtfathmob" value="<?php echo  $kitchen->father_mobile;?>"/>
                            </div>
                            <div class="col-md-3">
                                <label>Father's Aadhar</label>
                                <input type="text" class="form-control" name="txtfathaadhar" value="<?php echo  $kitchen->father_aadhar;?>"/>
                            </div>
                            </div>
                            <br>
                            <div class="row">
                            <div class="col-md-3">
                                <label>Mother's Name</label>
                                <input type="text" class="form-control" name="txtmother"  value="<?php echo  $kitchen->mother_name;?>"/>
                            </div>
                            <div class="col-md-3">
                                <label>Mother's Email</label>
                                <input type="text" class="form-control" name="txtmothmail" value="<?php echo  $kitchen->mother_email;?>"/>
                            </div>
                            <div class="col-md-3">
                                <label>Mother's Mobile</label>
                                <input type="text" class="form-control" name="txtmothmob" value="<?php echo  $kitchen->mother_mobile;?>"/>
                            </div>
                            <div class="col-md-3">
                                <label>Mother's Aadhar</label>
                                <input type="text" class="form-control" name="txtmothaadhar" value="<?php echo  $kitchen->mother_aadhar;?>"/>
                            </div>
                            </div>
                            <br>
                            <!-- <div class="row">
                            <div class="col-md-3">
                                <label>Spouse Name</label>
                                <input type="text" class="form-control" name="txtspouse"  value=""/>
                            </div>
                            <div class="col-md-3">
                                <label>Spouse Email</label>
                                <input type="text" class="form-control" name="txtspomail" value=""/>
                            </div>
                            <div class="col-md-3">
                                <label>Spouse Mobile</label>
                                <input type="text" class="form-control" name="txtspomob" value=""/>
                            </div>
                            <div class="col-md-3">
                                <label>Spouse Aadhar</label>
                                <input type="text" class="form-control" name="txtspoaadhar" value=""/>
                            </div>
                            </div>
                            <br> -->
                            <div class="row">
                                <div class="col-md-9">
                                    <h5>Bank Details</h5>
                                </div>
                            </div>
                            <hr class="hr-primary" style="border-top: 1px solid #94a3bf !important; " />
                            <div class="row">
                                <div class="col-md-3">
                                    <label>Bank Name</label>
                                    <input type="text" class="form-control" name="txtbank" value="<?php echo  $kitchen->bank_name;?>">
                                </div>
                                <div class="col-md-3">
                                    <label>Account Number</label>
                                    <input type="text" class="form-control" name="txtacct" value="<?php echo  $kitchen->bank_acct;?>">
                                </div>
                                <div class="col-md-3">
                                    <label> Branch</label>
                                    <input type="text" class="form-control" name="txtbranch" value="<?php echo  $kitchen->bank_branch;?>">
                                </div>
                                <div class="col-md-3">
                                    <label>IFSC</label>
                                    <input type="text" class="form-control" name="txtifsc" value="<?php echo  $kitchen->bank_ifsc;?>">
                                </div>
                            </div>

                
    </div>

    <br><br>
        <div class="row container">
        <div class="col-md-5"></div>
			<input name="update_profile_data" type="submit" class="btn btn-outline-success"  value="Update" />&nbsp;&nbsp;
			<a href="<?php echo base_url()."kitchen/view_employee" ?>" class="btn btn-outline-danger"> Cancel </a>

        </div>
        <br>
        </div>
    
    
    <div class="card-body">
    <?php
    $count=0;
    
                if(!empty(form_error("emp_name")))
				{
				$count = 1;
			?>
				<div class="row alert alert-danger">
				    <strong>REQUIRED** : </strong> Employee Name is Required
				</div>
			<?php
                }
            ?>
            <?php
                if(!empty(form_error("emp_id")))
				{
				$count = 1;
			?>
				<div class="row alert alert-danger">
				    <strong>REQUIRED** : </strong> Employee Id is Required
				</div>
			<?php
                }
            ?>
            <?php
                if(!empty(form_error("emp_role")))
				{
				$count = 1;
			?>
				<div class="row alert alert-danger">
				    <strong>REQUIRED** : </strong> Employee Role is Required
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
				    <strong>REQUIRED** : </strong> Email Id is Required
				</div>
                <?php
                }
            ?>
            <?php
                if(!empty(form_error("mobile_no")))
				{
				$count = 1;
			?>
				<div class="row alert alert-danger">
				    <strong>REQUIRED** : </strong> Mobile No is Required
				</div>
                <?php
                }
            ?>
            <?php
                if(!empty(form_error("l_addr1")))
				{
				$count = 1;
			?>
				<div class="row alert alert-danger">
				    <strong>REQUIRED** : </strong> Address1 is Required
				</div>
                <?php
                }
            ?>
            <?php
                if(!empty(form_error("l_addr2")))
				{
				$count = 1;
			?>
				<div class="row alert alert-danger">
				    <strong>REQUIRED** : </strong> Address2 is Required
				</div>
                <?php
                }
            ?>
            <?php
                if(!empty(form_error("l_addr3")))
				{
				$count = 1;
			?>
				<div class="row alert alert-danger">
				    <strong>REQUIRED** : </strong> Address2 is Required
				</div>
                <?php
                }
            ?>
            
            <?php
                if(!empty(form_error("l_state")))
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
                if(!empty(form_error("l_city")))
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
                if(!empty(form_error("l_zipcode")))
				{
				$count = 1;
			?>
				<div class="row alert alert-danger">
				    <strong>REQUIRED** : </strong> Zipcode is Required
				</div>
                <?php
                }
            ?>
            <br>
        </div>
        </div>
    
    </div>
    
    </form>
    </div>
        <br><br><br>
</section>
<?php
    }
}
}
?>