 <div class="col-sm-6 col-md-9">
            <div class="row" >
                <div class="col-sm-6 col-md-4" id="accordion">
                    <div class="card">
                        <div class="card-header bg-info text-white" align="center" style="padding: 1.25rem;" >
                           <!--  <p class="h5" align="center" > -->
                              <i class="far fa-chart-bar"></i>&nbsp;&nbsp;<a class="card-link" data-toggle="collapse" href="#collapseEn" style="color:white !important;">
                                <strong>Quick Links</strong>
                              </a>
                            <!-- </p> -->
                        </div>

                         <div id="collapseEn" class="collapse" data-parent="#accordion">
                        <div class="card-body">
                            <ul class="ul">
                                <li class="li">
                                    <a class="" href="<?php echo base_url()."superadmin/create_mealplan"; ?>">Create Meal Plan</a>
                                </li>
                                <li class="li">
                                    <a class="" href="<?php echo base_url()."superadmin/create_mealpreference"; ?>">Create Meal Preference</a>
                                </li>
                                <li class="li">
                                    <a class="" href="<?php echo base_url()."superadmin/create_category"; ?>">Create Category</a>
                                </li>
                                <li class="li">
                                    <a class="" href="<?php echo base_url()."superadmin/create_products"; ?>"> Create Product </a>
                                    <ul>
                                      <li><a class="" href="<?php echo base_url()."superadmin/manage_product"; ?>"> Manage Product </a></li>
                                    </ul>
                                </li>
                                 <li class="li">
                                    <a class="" href="<?php echo base_url()."superadmin/create_kitchen"; ?>">Create Kitchen</a>
                                    <ul>
                                      <li><a class="" href="<?php echo base_url()."superadmin/manage_kitchen"; ?>"> Manage kitchen </a></li>
                                    </ul>
                                </li>
                                <li class="li">
                                    <a class="" href="<?php echo base_url()."superadmin/create_kitchen_admin"; ?>">Create Kitchen admin</a>
                                    <ul>
                                      <li><a class="" href="<?php echo base_url()."superadmin/manage_kitchen_admin"; ?>"> Manage kitchen admin</a></li>
                                    </ul>
                                </li>
                                <li class="li">
                                    <a class="" href="<?php echo base_url()."superadmin/individual_customer"; ?>">Create Individual Customer</a>
                                    <ul>
                                      <li><a class="" href="<?php echo base_url()."superadmin/manage_individual"; ?>"> Manage Individual Customer</a></li>
                                    </ul>
                                </li>
                                <li class="li">
                                    <a class="" href="<?php echo base_url()."superadmin/corporate_customer"; ?>">Create Corporate Company</a>
                                    <ul>
                                      <li><a class="" href="<?php echo base_url()."superadmin/manage_corporate"; ?>"> Manage Corporate Company</a></li>
                                    </ul>
                                </li>
                                <li class="li">
                                    <a class="" href="<?php echo base_url()."superadmin/corporate_branch"; ?>">Create Corporate Branch</a>
                                    <ul>
                                      <li><a class="" href="<?php echo base_url()."superadmin/manage_corporate_branch"; ?>"> Manage Corporate Branch</a></li>
                                    </ul>
                                </li>
                                <li class="li">
                                    <a class="" href="<?php echo base_url()."superadmin/corporate_representative"; ?>">Create Corporate Representative</a>
                                    <ul>
                                      <li><a class="" href="<?php echo base_url()."superadmin/manage_representative"; ?>"> Manage Corporate Representative</a></li>
                                    </ul>
                                </li>
                                 <li class="li">
                                    <a class="" href="<?php echo base_url()."superadmin/create_notification"; ?>">Create Notification</a>
                                </li>
                            </ul>
                        </div>
                      </div>
                    </div><br/><br/><br/><br/>
                        <!-- Quick Links Card  -->
                    </div>
                    <div class="col-sm-6 col-md-4">
                   <div class="card bg-info text-white">
                        <div class="card-body" align="center">
                           <i class="far fa-chart-bar"></i>&nbsp;&nbsp;<a href="<?php echo base_url()."superadmin/orders_list"; ?>" style="color:white !important;" data-toggle="tooltip" title="It contains assigned Orders with consolidate order data" > <strong>  Assigned Orders List </strong> </a>
                        </div>
                   </div>
               </div>
              <div class="col-sm-6 col-md-4">
                   <div class="card bg-info text-white">
                        <div class="card-body" align="center">
                           <i class="far fa-chart-bar"></i>&nbsp;&nbsp;<a href="<?php echo base_url()."superadmin/orders_count"; ?>" style="color:white !important;" data-toggle="tooltip1" title="It contains complete Orders with consolidated assigned data."> <strong> Total Orders List </strong> </a>
                        </div>
                   </div>
               </div>
                </div>
            </div>
        </div>
    <!-- Side row closed -->
    </div>
    <!-- sidebar container fluid closed -->
</div>
<script>
$(document).ready(function(){
  $('[data-toggle="tooltip"],[data-toggle="tooltip1"]').tooltip();   
});
</script>