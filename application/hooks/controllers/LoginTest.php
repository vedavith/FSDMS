<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LoginTest extends CI_Controller 
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
            "email_id"=>"vedavith.r@zenopsys.com",
            "password"=>"1234"
        );

       $test =  $this->validate_model->login_validate($data);
       $expected_result = 1;
       $test_name = "Login Validation";
       echo $this->unit->run($test,$expected_result,$test_name);
    }
    //28-12-18
    public function corporLogin()
    {
        $data = array(
            "email_id"=>"reply2developer@gmail.com",
            "password"=>"123"
        );

       $test =  $this->validate_model->login_validate($data);
       $expected_result = 1;
       $test_name = "Login Validation";
       echo $this->unit->run($test,$expected_result,$test_name);
    }
    public function corporateinsert()
    {
        $company_data = array(
                "company_name"=>"MansoroftLappy",
                "company_telephone"=>"91607006666",
                "company_gstn"=>"GSTN123",
                "company_address"=>"hyderabad",
                "company_city"=>"hyderabad",
                "company_state"=>"hyderabad"
            );

        $representative_data = array(
            "company_name"=>"MansoroftLappy",
            "user_title"=>"Mr",
            "first_name"=>"text",
            "middle_name"=>"text",
            "last_name"=>"text",
            "rep_designation"=>"text",
            "rep_employee_id"=>"1111",
            "rep_email_id"=>"reply2developer@gmail.com",
            "rep_phone_number"=>"91607006666"
          );
        $login_data = array(
                "email_id"=>"reply2developer@gmail.com",
                "phone_number"=>"91607006666",
                "password"=>"123",
                "active"=>"0"
            );

            $get_affected = $this->insert_model->insert_company_data($company_data);
               
                if($get_affected == 1)
                {
                    $get_affected_rows1 = $this->insert_model->insert_corporate_user($representative_data);
                        if($get_affected_rows1)
                        {
                              $test = $this->insert_model->insert_login_details($login_data);
                        }
                }

        
       $expected_result = 1;
       $test_name = "Insert Corporate Data";
       echo $this->unit->run($test,$expected_result,$test_name);

    }
    public function update_corp_data()
    {

        $company_data = array(
                "company_name"=>"MansoroftLappy",
                "company_telephone"=>"test",
                "company_gstn"=>"GSTN123",
                "company_address"=>"test",
                "company_city"=>"test",
                "company_state"=>"test"
            );

        $representative_data = array(
            "company_name"=>"MansoroftLappy",
            "user_title"=>"Mr",
            "first_name"=>"test",
            "middle_name"=>"test",
            "last_name"=>"test",
            "rep_designation"=>"test",
            "rep_employee_id"=>"test",
            "rep_email_id"=>"reply2developer@gmail.com",
            "rep_phone_number"=>"test"
          );
         $get_rows_affected = $this->update_model->update_corporate_user_data('6',$representative_data);
        $test = $this->update_model->update_company_data('14',$company_data);


         $expected_result = 1;
       $test_name = "Insert Corporate Data";
       echo $this->unit->run($test,$expected_result,$test_name);
    }

    // public function Testregister()
    // {
    //     echo "Registration Tests go here";
    // }
}

/* End of file LoginTest.php */
