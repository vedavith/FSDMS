<div class="col-sm-6 col-md-9">
            <div class="row">
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
                                    <a href="#"> Dashboard </a>
                                    <ul>
                                      <li><a class="" href="<?php echo base_url()."deliveryhub/view_employee"; ?>"> Create Employee  </a></li>
                                      <li><a class="" href="<?php echo base_url()."deliveryhub/create_role"; ?>"> Create Role  </a></li>
                                     <!-- <li><a class="" href="<?php //echo base_url()."kitchen/kitchen_stock"; ?>"> Deduct Quantity  </a></li>
                                      <li><a class="" href="<?php //echo base_url()."kitchen/kitchen_dc"; ?>"> Delivery Challan  </a></li> -->

                                    </ul>
                                </li>
                               

                            </ul>
                        </div>
                    </div>
                    </div>
                        <!-- Quick Links Card  -->
                    </div>

                    <div class="col-sm-6 col-md-4">
                   <div class="card bg-info text-white">
                        <div class="card-body" align="center">
                           <i class="far fa-chart-bar"></i>&nbsp;&nbsp;<a href="<?php echo base_url()."deliveryhub/delivert_orders_count"; ?>" style="color:white !important;" data-toggle="tooltip1" title="It contains complete Orders with consolidated assigned data."> <strong> Total Orders List </strong> </a>
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
