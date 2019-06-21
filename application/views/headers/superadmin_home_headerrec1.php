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

     .sticky-offset 
     {
          top: 56px;
     }

  </style>
  
</head>
  <body  style="padding-top: 5rem;">
   <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
        <a class="navbar-brand" href="<?php echo base_url()."superadmin/home"?>">FSDMS</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <?php
              $first_name = "";


              if($user_data->num_rows() > 0)
              {
                foreach($user_data->result() as $row)
                {
                  $first_name = $row->first_name;
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
              <button class="btn btn-info dropdown-toggle " type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><li class="fa  far fa-bell"></li> Notifications  <span class="badge badge-dark">05</span> </button>
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
                  <a class="dropdown-item" href="#"> <li class="fa fa-address-card"></li> User Profile</a>
                      <div class="dropdown-divider"></div>
                  <a class="dropdown-item" href="#"> <li class="fa fa-history"></li> Order History </a>
                      <div class="dropdown-divider"></div>
                  <a class="dropdown-item" href="#"> <li class="fa fa-clipboard-list"></li>  Preferences </a>
                </div>
            </div>&nbsp;&nbsp;&nbsp;<br>
            <a class="btn btn-danger" href = "<?php echo base_url()."superadmin/logout" ?>" title="Logout"><li class="fa fa-sign-out-alt"></li> </a>
          </form>
        </div>
      </nav>
      <!-- END OF NAV -->
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-6 col-md-2">
            <div class="sticky-top sticky-offset">

<div id="accordion">
         <div class="card bg-secondary">
      <div class="card-header">
        <a class="collapsed card-link text-white" data-toggle="collapse" href="#collapseFour">
               <small>MAIN MENU</small>     
        </a>
      </div>
      <div id="collapseFour" class="collapse show" data-parent="#accordion">
       
                                <ul class="list-group">
                    
               <a href="<?php echo base_url(); ?>superadmin/home" class="bg-dark list-group-item list-group-item-action flex-column align-items-start">
                    <div class="d-flex w-100 justify-content-start align-items-center">
                         <li class="fas fa-fw mr-3 fa-tachometer-alt text-light"></li> 
                         <span class="menu-collapsed text-light">Dashboard</span>

                         <span class="submenu-icon ml-auto"></span>
                    </div>
               </a>

               <a href="#submenu2" data-toggle="collapse" aria-expanded="false" class="bg-dark list-group-item list-group-item-action flex-column align-items-start">
                    <div class="d-flex w-100 justify-content-start align-items-center">
                         <span class="fa fa-user-friends fa-fw mr-3 text-light"></span>
                         <span class="menu-collapsed text-light">Customers</span>
                         <span class="fa fa-caret-down ml-auto text-light"></span>
                    </div>
               </a>
            <!-- Submenu content -->
            <div id='submenu2' class="collapse sidebar-submenu">
                <a href="<?php echo base_url()."superadmin/individual_customer" ?>" class="list-group-item list-group-item-action bg-dark text-white">
                    <span class="menu-collapsed">Individual Customer</span>
                </a>
                <a href="<?php echo base_url()."superadmin/corporate_customer" ?>" class="list-group-item list-group-item-action bg-dark text-white">
                    <span class="menu-collapsed">Corporate Customer</span>
                </a>
            </div> 

            <a href="#submenu3" data-toggle="collapse" aria-expanded="false" class="bg-dark list-group-item list-group-item-action flex-column align-items-start">
                    <div class="d-flex w-100 justify-content-start align-items-center">
                         <span class="fa fa-user-lock fa-fw mr-3 text-light"></span>
                         <span class="menu-collapsed text-light">Admin</span>
                         <span class="fa fa-caret-down ml-auto text-light"></span>
                    </div>
               </a>
            <!-- Submenu content -->
            <div id='submenu3' class="collapse sidebar-submenu">
                <a href="<?php echo base_url()."superadmin/create_kitchen_admin" ?>" class="list-group-item list-group-item-action bg-dark text-white">
                    <span class="menu-collapsed">Kitchen Admin</span>
                </a>
                <a href="#" class="list-group-item list-group-item-action bg-dark text-white">
                    <span class="menu-collapsed">Delivery Hub Admin</span>
                </a>
            </div>

            <a href="#submenu4" data-toggle="collapse" aria-expanded="false" class="bg-dark list-group-item list-group-item-action flex-column align-items-start">
                    <div class="d-flex w-100 justify-content-start align-items-center">
                         <span class="fa fa-utensils fa-fw mr-3 text-light"></span>
                         <span class="menu-collapsed text-light">Kitchen</span>
                         <span class="fa fa-caret-down ml-auto text-light"></span>
                    </div>
            </a>
            <!-- Submenu content -->
            <div id='submenu4' class="collapse sidebar-submenu">
                <a href="<?php echo base_url()."superadmin/create_kitchen" ?>" class="list-group-item list-group-item-action bg-dark text-white">
                    <span class="menu-collapsed">Create Kitchens</span>
                </a>
                <!--<a href="#" class="list-group-item list-group-item-action bg-dark text-white">
                    <span class="menu-collapsed"> Other Kitchens </span>
                </a>-->
            </div>    

            <a href="#" class="bg-dark list-group-item list-group-item-action flex-column align-items-start">
                    <div class="d-flex w-100 justify-content-start align-items-center">
                         <li class="fas fa-fw mr-3 fa-truck text-light"></li> 
                         <span class="menu-collapsed text-light">Delivery Hub</span>

                         <span class="submenu-icon ml-auto"></span>
                    </div>
               </a>
                </ul>
      </div>
    </div>
    <div class="card bg-secondary">
      <div class="card-header">
        <a class="card-link text-white" data-toggle="collapse" href="#collapseOne">
          
                          <small> REPORTS </small>
        </a>
      </div>
      <div id="collapseOne" class="collapse" data-parent="#accordion">
           
                    <a href="#submenu5" data-toggle="collapse" aria-expanded="false" class="bg-dark list-group-item list-group-item-action flex-column align-items-start">
                    <div class="d-flex w-100 justify-content-start align-items-center">
                         <span class="fa fa-file-contract fa-fw mr-3 text-light"></span>
                         <span class="menu-collapsed text-light"> Reports</span>
                         <span class="fa fa-caret-down ml-auto text-light"></span>
                    </div>
               </a>
            <!-- Submenu content -->
            <div id='submenu5' class="collapse sidebar-submenu">
                <a href="#" class="list-group-item list-group-item-action bg-dark text-white">
                    <span class="menu-collapsed"> Sales </span>
                </a>
                <a href="#" class="list-group-item list-group-item-action bg-dark text-white">
                    <span class="menu-collapsed"> Stock </span>
                </a>
            </div>
      </div>
    </div>
    <div class="card bg-secondary">
      <div class="card-header">
        <a class="collapsed card-link text-white" data-toggle="collapse" href="#collapseTwo"> 
                          <small> PRODUCTS </small>         
      </a>
      </div>
      <div id="collapseTwo" class="collapse" data-parent="#accordion">
       
                     <a href="#submenu6" data-toggle="collapse" aria-expanded="false" class="bg-dark list-group-item list-group-item-action flex-column align-items-start">
                    <div class="d-flex w-100 justify-content-start align-items-center">
                         <span class="fa fa-tasks fa-fw mr-3 text-light"></span>
                         <span class="menu-collapsed text-light">Create Product</span>
                         <span class="fa fa-caret-down ml-auto text-light"></span>
                    </div>
                    </a>
            <!-- Submenu content -->
            <div id='submenu6' class="collapse sidebar-submenu">
                <a href="<?php echo base_url()."superadmin/create_category" ?>" class="list-group-item list-group-item-action bg-dark text-white">
                    <span class="menu-collapsed">Create Category</span>
                </a>
                <a href="<?php echo base_url()."superadmin/create_products" ?>" class="list-group-item list-group-item-action bg-dark text-white">
                    <span class="menu-collapsed"> Create Product </span>
                </a>
            </div>
      </div>
    </div>
    <div class="card bg-secondary">
      <div class="card-header">
        <a class="collapsed card-link text-white" data-toggle="collapse" href="#collapseThree">
                          <small> NOTIFICATION CENTER </small>
        </a>
      </div>
      <div id="collapseThree" class="collapse" data-parent="#accordion">
       
                    
                    
                     <a href="<?php echo base_url(); ?>superadmin/home" class="bg-dark list-group-item list-group-item-action flex-column align-items-start">
                    <div class="d-flex w-100 justify-content-start align-items-center">
                         <li class="fas fa-fw mr-3 fa-envelope text-light"></li> 
                         <span class="menu-collapsed text-light"> Messages <span class="badge badge-pill badge-primary ml-2">5</span></span>
                    </div>
               </a>
      </div>
    </div>
  </div>
            </div>
        </div>


