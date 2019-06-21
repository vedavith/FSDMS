<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->

   <!--  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script> -->
<script src="https://code.jquery.com/jquery-3.2.1.js" integrity="sha256-DZAnKJ/6XZ9si04Hgrsxu/8s717jcIzLy3oi35EouyE="crossorigin="anonymous"></script>

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">

  <style>
	.badge2
	{
		position:relative;
	}

	.badge2[data-badge]:after
	{
		content:attr(data-badge);
		position:absolute;
		top:-10px;
		right:-10px;
		font-size:0.8rem;
		background:#ff5f46;
		color:white;
		width:20px;
		height:20px;
		text-align:center;
		line-height:20px;
		border-radius:50%;
		box-shadow:0 0 1px #333;
	}

	.notifications
	{
		max-height: 300px;
		min-width: 400px;
		overflow-y: auto
	}
  </style>

</head>
  <body>
    <header>
      <!-- Fixed navbar -->
      <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
        <a class="navbar-brand" href="<?php echo base_url()."home"?>">FSDMS</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <?php
              $title = "";
              $first_name = "";
              $last_name = "";

              if($user_data->num_rows() > 0)
              {

                foreach($user_data->result() as $row)
                {
                  $title = $row->user_title;
                  $first_name = $row->first_name;
                 
                  if($this->session->userdata('type')=="individual")
                  {
                      $email = $row->email;
                  }
                  else
                  {
                     $email = $row->rep_email_id;
                  }
                }
              }
        ?>
        <div class="collapse navbar-collapse" id="navbarCollapse">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item">
              <a class="nav-link" href="#"> Hello, <?php echo  $first_name;  ?></a>
            </li>
            <!-- <li class="nav-item">
              <a class="nav-link disabled" href="#">Disabled</a>
            </li> -->
          </ul>
          <form method="post" class="form-inline mt-2 mt-md-0" action="#">
            <div class="input-group">
              <input type="text" class="form-control" placeholder="Search">
              <div class="input-group-append">
                <button class="btn btn-info" type="submit"><li class="fa fa-search"></li></button>
              </div>
            </div> &nbsp;&nbsp;&nbsp;<br><br>

            <div class="dropdown">
              <button class="btn btn-info dropdown-toggle " type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><li class="fa  far fa-bell"></li>&nbsp; Notifications &nbsp;<span class="badge badge-dark">05</span> </button>
                <div class="dropdown-menu notifications" aria-labelledby="dropdownMenuButton">
			  		<div class="container">
						<div class="alert alert-success">
							<strong>Success!</strong> Indicates a successful or positive action.
						</div>
						<div class="alert alert-success">
							<strong>Success!</strong> Indicates a successful or positive action.
						</div>
						<div class="alert alert-success">
							<strong>Success!</strong> Indicates a successful or positive action.
						</div>
						<div class="alert alert-success">
							<strong>Success!</strong> Indicates a successful or positive action.
						</div>
						<div class="alert alert-success">
							<strong>Success!</strong> Indicates a successful or positive action.
						</div>
					</div>
				</div>
            </div>&nbsp;&nbsp;&nbsp;<br>
			
            <div class="dropdown">
              <button class="btn btn-info dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><li class="fa fa-user"></li> User Account</button>

                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                  <a class="dropdown-item" href="<?php echo base_url()."home/profile/".base64_encode($this->session->userdata('type'))."/".base64_encode($this->session->userdata('id')); ?>"> <li class="fa fa-address-card"></li> User Profile</a>

				  <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="<?php echo base_url()."home/change_password/".base64_encode($email)."/".base64_encode($this->session->userdata('id')); ?>"> <li class="fa fa-key"></li> Change Password</a>
          <div class="dropdown-divider"></div>

                  <?php 
                      if(($this->session->has_userdata('admin')) && $this->session->userdata('admin') == 1)
                      {
                  ?>
                   
                  <a class="dropdown-item" href="<?php echo base_url()."home/branch"; ?>"> <li class="fa fa-university"></li> Create Branch </a>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item" href="<?php echo base_url()."home/representative"; ?>"> <li class="fa fa-user-plus"></li> Create Representative </a>
                  <div class="dropdown-divider"></div>
                  <?php
                      }
                  ?>
                  <a class="dropdown-item" href="<?php echo base_url()."home/orderlist" ?>"> <li class="fa fa-history"></li> Order History </a>
				          <div class="dropdown-divider"></div>
                  <a class="dropdown-item" href="#"> <li class="fa fa-clipboard-list"></li>  Preferences </a>
                </div>
            </div>&nbsp;&nbsp;&nbsp;<br>
            
            <a class="btn btn-info badge2"  data-badge="<?php echo$this->session->userdata('cart_count'); ?>" href = "<?php echo base_url()."cart"; ?>" title="Cart"> <li class="fa fa-shopping-cart"></li> </a>&nbsp;&nbsp;&nbsp;<br>
            <a class="btn btn-danger" href = "<?php echo base_url()."login/logout" ?>" title="Logout"><li class="fa fa-sign-out-alt"></li> </a>
          </form>
        </div>
      </nav>
    </header>
