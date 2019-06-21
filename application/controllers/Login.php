<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Project    : FSDMS
 * Controller : Login
 * Author     : Vedavith Ravula ,at el.
 * Date       : 22-Nov-2018
 * Relese     : NONE
 * Production : Version 0.0.1 BETA
 */

/**
Login
===========
Type 		: Controller Class

	+function index()
	=================
	|->loading views
		|->loginheader
		|->login
		|->footer

		++loginheader ('views/headers/loginheader.php')
		==============================================
			|-> Email (email Field)
			|->	Password (Password Field)
			|-> Login Button (On click Leads to Validate())
			|-> Register Button (On click Redirects to Registration page)

		++login ('views/login/login.php')
		=============================================
			|-> Contains data related to site, Ad's, etc.

		++footer ('views/headers/footer.php')
		=============================================
		    |-> Contains Copyright Info with Zenopsys Logo

	+function validate()
	====================
	|-> Uses CI Form Validation Library To validate Required Fields
	|-> Loads Login Validate Model
	|-> function login_error() -> ('views/errors/userdefined/login_error.php')
		++function login_error()
		=============================================
			|-> Loads Error Page

	+function register()
	=====================
	+function user_register_validate()
	==================================
	+corporate_user_register_validate()
	==================================

	//ERROR HANDLING FUNCTIONS
	--------------------------
	+function login_error()
	=======================
	|-> Loads Error Page
*/


class Login extends CI_Controller
{

  public function index()
  {
      $this->load->view('headers/loginheader');
      $this->load->view('login/login');
      $this->load->view('headers/footer');
  }

  public function validate()
  {
 	//echo "Login Validations And Redirection to Home Page Go Here";

  	$this->form_validation->set_rules('email_id','Email ID', 'required');
  	$this->form_validation->set_rules('password','Password','required');

  	if ($this->form_validation->run())
  	{
  		$data = array(
  			"email_id" => $this->input->post("email_id"),
  			"password" => $this->input->post("password")
  		);
  		//print_r($data);
  		$this->load->model('validate_model');
  		$test = $this->validate_model->login_validate($data);
  		if($test)
  		{
        $var = $this->validate_model->get_id_individual_user($data['email_id']);
        if($var == 0)
        {
          $varco = $this->validate_model->get_id_corporate_user($data['email_id']);
          //
          if($varco == 0)
          {
            $varco_rep = $this->validate_model->get_id_corporate_representative($data['email_id']);
            if($varco_rep)
            {
                $this->session->set_userdata($varco_rep);
               redirect(base_url()."home/");
             }
            else
            {
              $this->load->view('headers/loginheader');
              $this->login_error("unf");
              $this->load->view('headers/footer');
            }
          }
          else
          {
            $this->session->set_userdata($varco);
               redirect(base_url()."home/");

           // $this->load->view('headers/loginheader');
           //  $this->login_error("unf");
           //  $this->load->view('headers/footer');
          }
        }
        else
        {
          $this->session->set_userdata($var);
           redirect(base_url()."home/");
        }

  		}
  		else
  		{
  			$this->load->view('headers/loginheader');
  			$this->login_error("unf");
  			$this->load->view('headers/footer');
  		}
  	}
  	else
  	{
  		$this->load->view('headers/loginheader');
  		$this->login_error();
  		$this->load->view('headers/footer');
  	}
  }

  public function register()
  {
  	$this->load->view('headers/loginheader');
  	$this->load->view('login/register');
  	$this->load->view('headers/footer');
  }

  public function user_register_validate()
  {
  	$this->form_validation->set_rules('first_name', 'First Name', 'required');
  	$this->form_validation->set_rules('middle_name', 'Middle Name', 'required');
  	$this->form_validation->set_rules('last_name', 'Last Name', 'required');
  	$this->form_validation->set_rules('email_id', 'Email Id', 'required');
  	$this->form_validation->set_rules('user_password', 'Password', 'required');
  	$this->form_validation->set_rules('phone_number', 'Phone Number', 'required|max_length[10]');
  	$this->form_validation->set_rules('dob', 'Date Of Birth', 'required');
  	$this->form_validation->set_rules('blood_group', 'Blood Group', 'required');
  	$this->form_validation->set_rules('meal_type', 'Meal Type', 'required');
  	$this->form_validation->set_rules('address', 'Address', 'required');
  	$this->form_validation->set_rules('city', 'City', 'required');
  	$this->form_validation->set_rules('state', 'State', 'required');

  	if ($this->form_validation->run())
  	{
  		$data = array(
  			"user_title"=>$this->input->post("title"),
  			"first_name"=>$this->input->post("first_name"),
  			"middle_name"=>$this->input->post("middle_name"),
  			"last_name"=>$this->input->post("last_name"),
  			"email"=>$this->input->post("email_id"),
  			"phone_number"=>$this->input->post("phone_number"),
  			"dob"=>$this->input->post("dob"),
  			"blood_group"=>$this->input->post("blood_group"),
  			"meal_type"=>$this->input->post("meal_type"),
  			"address"=>$this->input->post("address"),
  			"city"=>$this->input->post("city"),
  			"state"=>$this->input->post("state")
  		);

  		$login_data = array(
  			"email_id"=>$data['email'],
  			"phone_number"=>$data['phone_number'],
  			"password"=>$this->input->post("user_password"),
  			"active"=>"0"
  		);

  		// echo $data['email'];
  		// echo $data['phone_number'];

  		$this->load->model('validate_model');
  		$get_count = $this->validate_model->validate_individual_registration($data['email'],$data['phone_number']);
      $get_login_count = $this->validate_model->check_duplicate_login($data['email']);
  		//echo $get_count;
  		if($get_count == 0 && $get_login_count == 0)
  		{
  			$this->load->model("insert_model");
  			$insert_indi_details_flag = $this->insert_model->insert_individual_details($data);
  			if($insert_indi_details_flag)
  			{
  				//$get_duplicate = $this->validate_model->check_duplicate_login($login_data['email_id']);

  				//if($get_duplicate == 0)
  				//{
	  				$insert_login_details = $this->insert_model->insert_login_details($login_data);
	  				if($insert_login_details)
	  				{

	  					$this->email->from('zenopsysevolve@gmail.com', 'FSDMS Appliacation');
	  					$this->email->to((string)$login_data['email_id']);
	  					$this->email->subject('Confirm Registration');
	  					$message = "<html>";
	  					$message .= "<body>";
	  					$message .= "<p> Please, click on the link to confirm the registration on FSDMS </p>";
	  					$message .= "<p><a href='".base_url()."login/confirmation/1/".base64_encode($login_data['email_id'])."'> Click to Confirm  </a></p>";
	  					$message .= "</body>";
	  					$message .= "</html>";
	  					$this->email->message($message);
	  					$this->email->send();

	  					echo $this->email->print_debugger();
						redirect(base_url()."login/confirmation/0");
	  				}
  				//}
  				/*else
  				{
  					$this->load->view('headers/loginheader');
  					$this->login_error("eae");
  					$this->load->view('headers/footer');
  				}	*/
  			}
  		}
  		else
  		{
  			$this->load->view('headers/loginheader');
  			$this->login_error("uae");
  			$this->load->view('headers/footer');
  		}
  	}
  	else
  	{
  		$this->register();
  	}

  }

  public function corporate_user_register_validate()
  {
  	$this->form_validation->set_rules('company_name','Company Name','required');
  	$this->form_validation->set_rules('company_telephone','Telephone','required');
  	$this->form_validation->set_rules('company_gstn','GSTN','required');
  	$this->form_validation->set_rules('company_address','Address','required');
  	$this->form_validation->set_rules('company_city','City','required');
  	$this->form_validation->set_rules('company_state','State','required');
  	$this->form_validation->set_rules('company_title','Title','required');
  	$this->form_validation->set_rules('rep_first_name','First Name','required');
  	$this->form_validation->set_rules('rep_middle_name','Middle Name','required');
  	$this->form_validation->set_rules('rep_last_name','Last Name','required');
  	$this->form_validation->set_rules('rep_designation','Designation','required');
  	$this->form_validation->set_rules('rep_employee_id','Employee ID','required');
  	$this->form_validation->set_rules('rep_email_id','Email ID','required');
  	$this->form_validation->set_rules('rep_phone_number','Phone Number','required');
  	$this->form_validation->set_rules('corporate_user_password','User Password','required');
  	$this->form_validation->set_rules('corporate_confirm_password','Confirm Password','required');

  	if ($this->form_validation->run())
  	{

  		$this->load->model('validate_model');

  			$company_data = array(
  				"company_name"=>$this->input->post("company_name"),
  				"company_telephone"=>$this->input->post("company_telephone"),
  				"company_gstn"=>$this->input->post("company_gstn"),
  				"company_address"=>$this->input->post("company_address"),
  				"company_city"=>$this->input->post("company_city"),
  				"company_state"=>$this->input->post("company_state")
  			);

  			$representative_data = array(
  				"company_name"=>$company_data['company_name'],
  				"user_title"=>$this->input->post("company_title"),
  				"first_name"=>$this->input->post("rep_first_name"),
  				"middle_name"=>$this->input->post("rep_middle_name"),
  				"last_name"=>$this->input->post("rep_last_name"),
  				"rep_designation"=>$this->input->post("rep_designation"),
  				"rep_employee_id"=>$this->input->post("rep_employee_id"),
  				"rep_email_id"=>$this->input->post("rep_email_id"),
  				"rep_phone_number"=>$this->input->post("rep_phone_number")
  			);



  			$login_data = array(
  				"email_id"=>$representative_data['rep_email_id'],
  				"phone_number"=>$representative_data['rep_phone_number'],
  				"password"=>$this->input->post("corporate_user_password"),
  				"active"=>"0"
  			);


  			$get_company_count = $this->validate_model->validate_company_data($company_data['company_name'],$company_data['company_gstn']);



  			if($get_company_count == 0)
  			{
  				$this->load->model('insert_model');
  				//echo "<script> alert('Inside Count'); </script>";

  				$get_affected = $this->insert_model->insert_company_data($company_data);
  				echo $get_affected;
  				if($get_affected == 1)
  				{

  					echo "<script> alert(inside to validate user) </script>";
  					$get_rep_count = $this->validate_model->validate_corporate_user($representative_data['company_name'],$representative_data['rep_employee_id'],$representative_data['rep_email_id']);
            $get_login_count = $this->validate_model->check_duplicate_login($login_data['email_id']);
  					//echo $get_rep_count;
  					if($get_rep_count == 0 && $get_login_count == 0)
  					{
  						$get_affected_rows1 = $this->insert_model->insert_corporate_user($representative_data);
  						if($get_affected_rows1)
  						{
							  $get_affected_rows2 = $this->insert_model->insert_login_details($login_data);
							  if($get_affected_rows2)
							  {

								$this->email->from('zenopsysevolve@gmail.com', 'FSDMS Appliacation');
								$this->email->to((string)$login_data['email_id']);
								$this->email->subject('Confirm Registration');
								$message = "<html>";
								$message .= "<body>";
								$message .= "<p> Please, click on the link to confirm the registration on FSDMS </p>";
								$message .= "<p><a href='".base_url()."login/confirmation/1/".base64_encode($login_data['email_id'])."'> Click to Confirm  </a></p>";
								$message .= "</body>";
								$message .= "</html>";
								$this->email->message($message);
								$this->email->send();

								echo $this->email->print_debugger();
							  	redirect(base_url()."login/confirmation/0");

							  }
  						}
  					}
  					else
  					{
  						$this->load->view('headers/loginheader');
  						$this->login_error("uae");
  						$this->load->view('headers/footer');
  					}
  				}
  			}
  			else
  			{

  				$this->load->model('insert_model');

  				$get_rep_count = $this->validate_model->validate_corporate_user($representative_data['company_name'],$representative_data['rep_employee_id'],$representative_data['rep_email_id']);
  				if($get_rep_count == 0)
  				{
  					$get_affected_rows1 = $this->insert_model->insert_corporate_user($representative_data);
  					if($get_affected_rows1)
  					{
  						$get_affected_rows2 = $this->insert_model->insert_login_details($login_data);
  					}
  				}
  				else
  				{
  						$this->load->view('headers/loginheader');
  						$this->login_error("uae");
  						$this->load->view('headers/footer');
  				}
  			}

  	}
  	else
  	{
  		$this->register();
  	}

  }
 /**
   *  Author : Divya A, Vedavith Ravula, et.al
   * Re-factor : 1
   * Changes : Functionality change - Instead of creating Representative. We are 
   *                    creating a Admin for Corporate user.
   * Date : 19022019
   */
  
  public function corporate_admin_register_validate()
  {
      $this->form_validation->set_rules('company_name','Company Name','required');
    $this->form_validation->set_rules('company_telephone','Telephone','required');
    $this->form_validation->set_rules('company_gstn','GSTN','required');
    $this->form_validation->set_rules('company_address','Address','required');
    $this->form_validation->set_rules('company_city','City','required');
    $this->form_validation->set_rules('company_state','State','required');
    $this->form_validation->set_rules('company_title','Title','required');
    $this->form_validation->set_rules('admin_first_name','First Name','required');
    $this->form_validation->set_rules('admin_middle_name','Middle Name','required');
    $this->form_validation->set_rules('admin_last_name','Last Name','required');
    $this->form_validation->set_rules('admin_designation','Designation','required');
    $this->form_validation->set_rules('admin_employee_id','Employee ID','required');
    $this->form_validation->set_rules('admin_email_id','Email ID','required');
    $this->form_validation->set_rules('admin_phone_number','Phone Number','required');
    $this->form_validation->set_rules('corporate_admin_password','User Password','required');
    $this->form_validation->set_rules('corporate_admin_confirm_password','Confirm Password','required');
                
                    if($this->form_validation->run())
                    {
                        $company_data = array(
          "company_name"=>$this->input->post("company_name"),
          "company_telephone"=>$this->input->post("company_telephone"),
          "company_gstn"=>$this->input->post("company_gstn"),
          "company_address"=>$this->input->post("company_address"),
          "company_city"=>$this->input->post("company_city"),
          "company_state"=>$this->input->post("company_state")
        );
                        
                            $company_admin_data = array(
          "company_name"=>$company_data['company_name'],
          "user_title"=>$this->input->post("company_title"),
          "first_name"=>$this->input->post("admin_first_name"),
          "middle_name"=>$this->input->post("admin_middle_name"),
          "last_name"=>$this->input->post("admin_last_name"),
          "rep_designation"=>$this->input->post("admin_designation"),
          "rep_employee_id"=>$this->input->post("admin_employee_id"),
          "rep_email_id"=>$this->input->post("admin_email_id"),
          "rep_phone_number"=>$this->input->post("admin_phone_number"),
            "admin" => "1"
        );
                            
                            $login_data = array(
          "email_id"=>$company_admin_data['rep_email_id'],
          "phone_number"=>$company_admin_data['rep_phone_number'],
          "password"=>$this->input->post("corporate_admin_password"),
          "active"=>"0",
           "admin"=>"1"
        );
                            
                            $this->load->model("validate_model");
                            
                           $get_company_count = $this->validate_model->validate_company_data($company_data['company_name'],$company_data['company_gstn']);
                           if($get_company_count == 0)
                           {
                                  $this->load->model('insert_model');
                                        
                                    $get_affected = $this->insert_model->insert_company_data($company_data);
                                    if($get_affected)
                                    {
                                             echo "<script> alert(inside to validate user) </script>";
                                             $get_rep_count = $this->validate_model->validate_corporate_user($company_admin_data['company_name'],$company_admin_data['rep_employee_id'],$company_admin_data['rep_email_id']);
                                             $get_login_count = $this->validate_model->check_duplicate_login($login_data['email_id']);
                                             
                                              if($get_rep_count == 0 && $get_login_count == 0)
                                            {
              $get_affected_rows1 = $this->insert_model->insert_corporate_user($company_admin_data);
        if($get_affected_rows1)
        {
               $get_affected_rows2 = $this->insert_model->insert_login_details($login_data);
                                                                if($get_affected_rows2)
                                                                {
                                                                        $this->email->from('zenopsysevolve@gmail.com', 'FSDMS Appliacation');
        $this->email->to((string)$login_data['email_id']);
        $this->email->subject('Confirm Registration');
        $message = "<html>";
        $message .= "<body>";
        $message .= "<p> Please, click on the link to confirm the registration on FSDMS </p>";
        $message .= "<p><a href='".base_url()."login/confirmation/1/".base64_encode($login_data['email_id'])."'> Click to Confirm  </a></p>";
        $message .= "</body>";
        $message .= "</html>";
        $this->email->message($message);
        $this->email->send();
        echo $this->email->print_debugger();
                                
        redirect(base_url()."login/confirmation/0");

                                                                }
        }
                                            }
                                            else
                                            {
        $this->load->view('headers/loginheader');
        $this->login_error("uae");
        $this->load->view('headers/footer');
                                            }
                                             
                                    }
                           }
                           else
                           {
                               $this->load->model('insert_model');
                               
                            $get_rep_count = $this->validate_model->validate_corporate_user($company_admin_data['company_name'],$company_admin_data['rep_employee_id'],$company_admin_data['rep_email_id']);
                                    if($get_rep_count == 0)
                                    {
                                            $get_affected_rows1 = $this->insert_model->insert_corporate_user($company_admin_data);
                                            if($get_affected_rows1)
                                            {
                                                    $get_affected_rows2 = $this->insert_model->insert_login_details($login_data);
                                            }
                                    }
                                    else
                                    {
                                                        $this->load->view('headers/loginheader');
                                                        $this->login_error("uae");
                                                        $this->load->view('headers/footer');
                                    }
                            }
                  }
                    else
                    {
                        $this->register();
                    }
  }

  public function confirmation()
  {
  	echo $get_url_value = $this->uri->segment(3);

  	if($get_url_value == 0)
  	{
  		$this->load->view('headers/loginheader');
  		$this->load->view('confirmation/confirmation');
  		$this->load->view('headers/footer');
  	}

  	if($get_url_value == 1)
  	{
  		$get_encoded_email = $this->uri->segment(4);
  		$email_address = base64_decode($get_encoded_email);
  		$this->load->model('update_model');
  		$is_updated = $this->update_model->update_user_login($email_address);
  		if($is_updated)
  		{
  			redirect(base_url()."login");
  		}
  	}
  }

  /*
   *  ERROR HANDLINING FUNCTIONS
   * ============================
   *	1. Login Error
   */

  	 public function login_error($error_handler = NULL)
  	 {
  	 	if($error_handler == "unf")
  	 	{
  	 		$data['error_handle'] = $error_handler;
  	 		//print_r($data);
  	 		$this->load->view('errors/defined/login_error',$data);
  	 	}
  	 	elseif($error_handler == "uae")
  	 	{
  	 		$data['error_handle'] = $error_handler;
  	 		$this->load->view('errors/defined/login_error',$data);
  	 	}
  	 	elseif($error_handler == "eae")
  	 	{
  	 		$data['error_handle'] = $error_handler;
  	 		$this->load->view('errors/defined/login_error',$data);
  	 	}
  	 	else
  	 	{
  	 		$this->load->view('errors/defined/login_error');
  	 	}
	   }

	   /**
		* KIll SESSIONS
		* ===============
		*/

		public function logout()
		{
			$this->session->sess_destroy();
			redirect(base_url()."login");
		}
}
