<br><br><br><br><br>
<?php 
if(!isset($branch_data_id))
{
  
?>
<section>
    <div class = "container">
        <div class="row">
      <div class="col-md-6" align="left">
        <p class="h3"> Change Password </p>
      </div>
     
      <div class="col-md-3" align="right">
        <a class="btn btn-sm btn-outline-danger" href="<?php echo base_url()."home"; ?>"> Back</a>
      </div>
    </div>
    <br>
    
      <form method="post" action="<?php echo base_url()."home/change_password_data" ?>">
        <div class="row">
          <div class="col-md-6">
            <?php echo $id = $this->session->userdata("email_id"); ?>
           
          <input type="text" class="form-control" name="cur_pwd" placeholder="Current Password" id="password"/>
          <?php foreach($pass_data->result() as $row){

         ?>
          <input type="hidden" class="form-control" name="old_pwd" value="<?php echo $row->password;?>" id="conpwd"/>
          <input type="hidden" name="email_hid" value="<?php echo $row->email_id; ?>"/>
          <?php 
        }
          ?>

        </div>
      </div></br>
        <div class="row">
        <div class="col-md-6">
          <input type="text" class="form-control" name="new_pwd" placeholder="New Password" id="new_password">
        </div>

      </div><br/>
      <div class="row">
        <div class="col-md-6">
           <input type="text" class="form-control" name="re_pwd" placeholder="Retype Password" id="retype_password"> 
        </div>
      </div>
      <br/>
    
    <div class="row container">
      <div  class="col-md-3" align="right">
      <button  name="update" type="submit" class="btn btn-outline-danger" > Submit </button>
       </div> 
     <div class="col-md-3" align="left">
      <button name="reset" type="reset" class="btn btn-outline-danger" > Cancel </button>
    </div>
    
    </div>
  <script>
                        $('#conpwd, #password').on('keyup', function ()
                         {
                            if ($('#conpwd').val() == $('#password').val())
                             {
                                 $('#message').html('Matching').css('color', 'green');
                                 $('#password').css('background', '#55d24980');
                                 $("#submit_id").prop("disabled", false);
                             }
                              else
                              {
                                 $('#message').html('Not Matching').css('color', 'red');
                             
                                $('#password').css('background', '#ff8787a1');
                                $("#submit_id").prop("disabled", true);
                            }
                        });
                        

                        $('#new_password, #retype_password').on('keyup', function () 
                        {
                            if ($('#new_password').val() == $('#retype_password').val())
                            {
                            // console.log("matching");
                            //$('#message1').html('Matching').css('color', 'green');
                            $('#retype_password').css('background', '#55d24980');
                            $("#submit_id").prop("disabled", false);
                            }
                            else
                            {
                            // console.log(" not matching");
                            //$('#message1').html('Not Matching').css('color', 'red');
                            $('#retype_password').css('background', '#ff8787a1');
                            $("#submit_id").prop("disabled", true);
                            }
                        });
                        </script>

    </form> 
   
<br>
<div class="container">
        
          <?php
                    $count = 0;
                   

                      if(!empty(form_error("company_name")))
                      {
                        $count = 1;
                    ?>
                    <div class="row alert alert-danger">
                          <strong>REQUIRED** : </strong> Company name is Required
                    </div>
                    <?php
                      }
                      if(!empty(form_error("branch_name")))
                     
                   
                    if ($count == 1)
                        {
                        ?>
                        <script>
                          $(document).ready(function(){
                              $("#CategoryTwo").addClass("show");
                          });
                        </script>
                        <?php
                        }
                      ?>
        </div><br><br><br>
    </div>
    
</section>

<?php 
  
}

?>