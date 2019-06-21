<?php
interface Idelivery 
{
    public function deliveryhub_login();
    public function delivery_employee();
    public function delivery_emploee_data();
    public function view_employee();
    public function edit_employee();
    public function update_employee();
    public function delete_employee();
    public function deliveryhub_home();
    //Creation of deleivery_hub_admin
    //@Todo - implemented on Deliveryhub class(controller)
    //@Todo - same functionality should be there in superadmin class(controller)
    //@Todo - superadmin should accept the request from delivery hub on creating delivery hub admin
    
    // public function create_delivery_hub_admin();
    // public function insert_delivery_hub_admin();
    // public function update_delivery_hub_admin();
    // public function delete_delivery_hub_admin();

    // //Creation of deleivery_executive
    // //@Todo - implemented on Deliveryhub class(controller)
    // //@Todo - same functionality should be there in superadmin class(controller)
    // //@Todo - superadmin should accept the request from delivery hub on creating delivery executive

    // public function create_delivery_executive();
    // public function insert_delivery_executive();
    // public function update_delivery_executive();
    // public function delete_delivery_executive();

    // //@Todo - Get finished orders from kitchens.
    // public function get_order_schedule();

    // //@Todo - Assign finished orders from kitchens to delivery execuitive.
    // //@Todo - check bundled order is finished or not and assign bundled order to delivery executive
    // public function set_order_del_executive();

    // //@Todo - Get addresses of assigned orders.
    // //@Todo - LOCUS-API.
    // public function get_routes();
    // public function set_routes();


    
}

?>