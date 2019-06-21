<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class KitchenTester extends CI_Controller 
{
    public function __construct()
    {
        parent::__construct();
       
        //UNIT TEST LIBRARY
        $this->load->library('unit_test');

        //LOADING VALIDATE MODEL
        $this->load->model('validate_model');
        $this->load->model('insert_model');
        $this->load->model('update_model');
        
    }

    public function testLogin()
    {
        $data = array(
            "email_id"=>"mounika.m@zenopsys.com",
            "password"=>"12345"
        );

       $test =  $this->validate_model->get_kitchen_user($data);
    //    print_r($test['count']);
       $expected_result = 'is_array';
       $test_name = "Login Validation";
       echo $this->unit->run($test,$expected_result,$test_name);
    }
    //28-12-18
    public function edit_user_dataTest()
    {
        $user_data = array(
			"kitchen_id" => "123",
            "first_name" => "mounika",
		    "last_name" => "marella",
		    "email_id" => "mounika.m@zenopsys.com",
            "user_name" => "mounika"
        //   "password" => $this->input->post("renew_pass")
        );
            $test = $this->update_model->update_kit_ser_profile($user_data['kitchen_id'],$user_data);
       $expected_result = 1;
       $test_name = "Login Validation";
       echo $this->unit->run($test,$expected_result,$test_name);
    }
    
}

/* End of file LoginTest.php */
