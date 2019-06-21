<br><br><br><br>
<section>
    <div class="container">
        <div class="row">
            <div class="col-md-3"></div>
            <div class="card bg-secondary text-white col-md-6">
                <div class="card-body">
                 <?php  if(isset($kitchen))  {
                  ?>
                    <div class="card-title" align="center">
                        <p class="h3"> FSDMS Kitchen Form </p>
                    </div>
                    <form method="post" action="<?php echo base_url(); ?>superadmin/create_password">
                        
                        <input id="email" class="form-control" type="text" name="email" placeholder="Email ID" value="<?php echo $email_address; ?>" readonly><br> 
                        


                         <input id="conpwd" class="form-control" type="hidden" name="con_password" placeholder="Password" value="<?php echo $pwd;?>" required>
                    
                        <input id="password" class="form-control" type="password" name="password" placeholder="Password" value="" required>
                        <br>

                         <input id="new_password" class="form-control" type="password" name="new_pwd" placeholder="New Password" required>
                         <br>
                          <input id="retype_password" class="form-control" type="password" name="re_pwd" placeholder="Retype Password" required>
                          <br>
                        <div class="card-footer" align="center">
                            <input class="btn btn-primary" type="submit" value="Submit" id="submit_id">
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

                       <!--<div id="message" class="card-title" align="center">
                        </div>-->

                    </form>
                    <?php 
                  }
                  ?>
                   <?php  if(isset($individual_user)) {
                  ?>
                    <div class="card-title" align="center">
                        <p class="h3"> FSDMS Individual Customer Form </p>
                    </div>
                    <form method="post" action="<?php echo base_url(); ?>superadmin/individual_password">
                        
                        <input id="email" class="form-control" type="text" name="email" placeholder="Email ID" value="<?php echo $email_address; ?>" readonly><br> 
                        


                         <input id="conpwd" class="form-control" type="hidden" name="con_password" placeholder="Password" value="<?php echo $pwd;?>" required>
                    
                        <input id="password" class="form-control" type="password" name="password" placeholder="Password" value="" required>
                        <br>

                         <input id="new_password" class="form-control" type="password" name="new_pwd" placeholder="New Password" required>
                         <br>
                          <input id="retype_password" class="form-control" type="password" name="re_pwd" placeholder="Retype Password" required>
                          <br>
                        <div class="card-footer" align="center">
                            <input class="btn btn-primary" type="submit" value="Submit" id="submit_id">
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

                       <!--<div id="message" class="card-title" align="center">
                        </div>-->

                    </form>
                    <?php 
                  }
                  ?>
                   <?php  if(isset($corporate_company)) 
                   {
                  ?>
                    <div class="card-title" align="center">
                        <p class="h3"> FSDMS Corporate Company Form </p>
                    </div>
                    <form method="post" action="<?php echo base_url(); ?>superadmin/individual_password">
                        
                        <input id="email" class="form-control" type="text" name="email" placeholder="Email ID" value="<?php echo $email_address; ?>" readonly><br> 
                        


                         <input id="conpwd" class="form-control" type="hidden" name="con_password" placeholder="Password" value="<?php echo $pwd;?>" required>
                    
                        <input id="password" class="form-control" type="password" name="password" placeholder="Password" value="" required>
                        <br>

                         <input id="new_password" class="form-control" type="password" name="new_pwd" placeholder="New Password" required>
                         <br>
                          <input id="retype_password" class="form-control" type="password" name="re_pwd" placeholder="Retype Password" required>
                          <br>
                        <div class="card-footer" align="center">
                            <input class="btn btn-primary" type="submit" value="Submit" id="submit_id">
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

                       <!--<div id="message" class="card-title" align="center">
                        </div>-->

                    </form>
                    <?php 
                  }
                  ?>
                    <?php  if(isset($representative)) 
                   {
                  ?>
                    <div class="card-title" align="center">
                        <p class="h3"> FSDMS Corporate Representative Form </p>
                    </div>
                    <form method="post" action="<?php echo base_url(); ?>superadmin/individual_password">
                        
                        <input id="email" class="form-control" type="text" name="email" placeholder="Email ID" value="<?php echo $email_address; ?>" readonly><br> 
                        


                         <input id="conpwd" class="form-control" type="hidden" name="con_password" placeholder="Password" value="<?php echo $pwd;?>" required>
                    
                        <input id="password" class="form-control" type="password" name="password" placeholder="Password" value="" required>
                        <br>

                         <input id="new_password" class="form-control" type="password" name="new_pwd" placeholder="New Password" required>
                         <br>
                          <input id="retype_password" class="form-control" type="password" name="re_pwd" placeholder="Retype Password" required>
                          <br>
                        <div class="card-footer" align="center">
                            <input class="btn btn-primary" type="submit" value="Submit" id="submit_id">
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

                       <!--<div id="message" class="card-title" align="center">
                        </div>-->

                    </form>
                    <?php 
                  }
                  ?>
                   <?php  if(isset($deliveryhub)) 
                   {
                  ?>
                    <div class="card-title" align="center">
                        <p class="h3"> FSDMS Deliveryhub Form </p>
                    </div>
                    <form method="post" action="<?php echo base_url(); ?>superadmin/delivery_password">
                        
                        <input id="email" class="form-control" type="text" name="email" placeholder="Email ID" value="<?php echo $email_address; ?>" readonly><br> 
                        


                         <input id="conpwd" class="form-control" type="hidden" name="con_password" placeholder="Password" value="<?php echo $pwd;?>" required>
                    
                        <input id="password" class="form-control" type="password" name="password" placeholder="Password" value="" required>
                        <br>

                         <input id="new_password" class="form-control" type="password" name="new_pwd" placeholder="New Password" required>
                         <br>
                          <input id="retype_password" class="form-control" type="password" name="re_pwd" placeholder="Retype Password" required>
                          <br>
                        <div class="card-footer" align="center">
                            <input class="btn btn-primary" type="submit" value="Submit" id="submit_id">
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

                       <!--<div id="message" class="card-title" align="center">
                        </div>-->

                    </form>
                    <?php 
                  }
                  ?>
                </div>
            </div>
            <div class="col-md-3">
                
                    
                   
                    
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