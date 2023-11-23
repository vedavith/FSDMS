<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	
	public function __construct()
	{
		parent::__construct();

		$this->load->model('insert_model');
	    $this->load->model('update_model');
	    $this->load->model('delete_model');
	    $this->load->model('select_model');
	    $this->load->model('validate_model');

      /**
       * SESSION DATA FOR SUPERADMIN HOME
       */

		$this->user_id = $this->session->userdata('id');
		$this->backend_table = $this->session->userdata('table');
		$this->user_type = $this->session->userdata('type');
		
	}
	

	public function index()
	{	
		if($this->session->has_userdata('id'))
		{
						
      $data['user_data'] = $this->select_model->select_user($this->backend_table,$this->user_id);
      //Checkout Counter
      $get_user_id = $this->user_id;
      $get_user_type = $this->user_type;
      $set_confirmation = 0;
      
      $get_checkout_counter = $this->select_model->get_product_list_on_user_id_count($get_user_id,$get_user_type,$set_confirmation);
      $this->session->set_userdata($get_checkout_counter);

      $get_cart_counter = $this->select_model->select_product_count_on_id($get_user_id);
      $this->session->set_userdata($get_cart_counter);

      $this->load->view('headers/userheader',$data);
      
    
			
			/**
			*	SHOW PRODUCTS IN HOME
			*/
			$data['product_list'] = $this->select_model->select_all_products();
			$this->load->view('home/home',$data);		
			$this->load->view('headers/footer');
		}
		else
		{
			$this->error_403();
		}
		
	}

/**
 * PRODUCT VIEW
 */

 public function product()
 {
   if($this->session->has_userdata('id'))
   {
     $data['user_data'] = $this->select_model->select_user($this->backend_table,$this->user_id);
     $this->load->view('headers/userheader',$data);
     $data['get_product_details'] = $this->select_model->select_product_on_sku(base64_decode($this->uri->segment(3)));
     $this->load->view('home/product_profile',$data);
     $this->load->view('headers/footer');
   }
   else
   {
     $this->error_403();
   }
 }


	public function profile()
	{
		if($this->session->has_userdata('id'))
		{

			$data['user_data'] = $this->select_model->select_user($this->backend_table,$this->user_id);

			$this->load->view('headers/userheader',$data);
			$get_user_type = base64_decode( $this->uri->segment(3));
			if($get_user_type == "individual")
			{
				$this->load->view('home/profile/individual_profile',$data);
				
			}
			else
			{
				$data['user_data']=$this->select_model->select_corporate_user($this->user_id);
				$this->load->view('home/profile/corporate_profile',$data);
				//echo "Corporate details";
			}
			$this->load->view('headers/footer');
		}
		else
		{
			$this->error_403();
		}
	}

	public function update_individual_user()
	{
		$this->form_validation->set_rules('first_name', 'First Name', 'required');
  		$this->form_validation->set_rules('middle_name', 'Middle Name', 'required');
  		$this->form_validation->set_rules('last_name', 'Last Name', 'required');
  		$this->form_validation->set_rules('email_id', 'Email Id', 'required');
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
			 
			$get_rows_affected = $this->update_model->update_individual_user_data($this->user_id,$data);
			if($get_rows_affected)
			{
				echo "<script> alert('Details Updated'); </script>";
				redirect(base_url()."/home/profile/".base64_encode($this->user_type)."/".base64_encode($this->user_id),'refresh');
			}
		} 
		else 
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

			
			$data['user_data'] = $this->select_model->select_user($this->backend_table,$this->user_id);

			$this->load->view('headers/userheader',$data);
			$this->load->view('home/profile/individual_profile',$data);	
			$this->load->view('headers/footer');
		}
		
	}
	//28-12-18
	public function update_corporate()
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
	  	
	  	if ($this->form_validation->run()) 
	  	{
	  		$this->load->model('validate_model');

	  			
	  			$get_rows_affected = $this->update_model->update_corporate_user_data($this->user_id,$representative_data);
	  			$get_company_rows_affected = $this->update_model->update_company_data($this->input->post("comp_id"),$company_data);
				if($get_rows_affected)
				{
					echo "<script> alert('Details Updated'); </script>";
					redirect(base_url()."/home/profile/".base64_encode($this->user_type)."/".base64_encode($this->user_id),'refresh');
				}
				if($get_company_rows_affected)
				{
					echo "<script> alert('Details Updated'); </script>";
					redirect(base_url()."/home/profile/".base64_encode($this->user_type)."/".base64_encode($this->user_id),'refresh');
				}
	  	}
	  	else
	  	{
	  			$data['user_data']=$this->select_model->select_corporate_user($this->user_id);
				$this->load->view('headers/userheader',$data);
				$this->load->view('home/profile/corporate_profile',$data);
				$this->load->view('headers/footer');
		}

	}

	//26-2-19
	public function branch($error = NULL)
	{

		if($this->session->has_userdata('id'))
		{

			$data['user_data'] = $this->select_model->select_user($this->backend_table,$this->user_id);
			$data['company_data'] = $this->select_model->get_corporate_company();
			 if($error != NULL)
             {
               $data['error'] = "BRN";
            }
			$this->load->view('headers/userheader',$data);
			$get_user_type = base64_decode( $this->uri->segment(3));
			$this->load->view('customer/corpor_branch',$data);
			$this->load->view('headers/footer');
		}
		else
		{
			$this->error_403();
		}
	  	
	}

	 //corporate branch data 
    function corpor_branch_data()
    {
       $this->form_validation->set_rules('company_name','company_name','required');
       $this->form_validation->set_rules('branch_name','branch_name','required');
       $this->form_validation->set_rules('branch_telephone','branch_telephone','required');
       $this->form_validation->set_rules('branch_gstn','branch_gstn','required');
       $this->form_validation->set_rules('branch_address1','branch_address1','required');
       $this->form_validation->set_rules('branch_address2','branch_address2','required');
       $this->form_validation->set_rules('branch_address3','branch_address3','required');
        $this->form_validation->set_rules('branch_city','branch_city','required');
       $this->form_validation->set_rules('branch_state','branch_state','required');
       $this->form_validation->set_rules('branch_zipcode','branch_zipcode','required');
            
        if($this->form_validation->run())
       {
        $branch_data = array(
          "company_name" => $this->input->post("company_name"),
          "branch_name" => $this->input->post("branch_name"),
          "branch_telephone" => $this->input->post("branch_telephone"),
          "branch_gstn" => $this->input->post("branch_gstn"),
          "branch_address1" => $this->input->post("branch_address1"),
          "branch_address2" => $this->input->post("branch_address2"),
          "branch_address3" => $this->input->post("branch_address3"),
          "branch_city" => $this->input->post("branch_city"),
          "branch_state" => $this->input->post("branch_state"),
          "branch_zipcode" => $this->input->post("branch_zipcode")
          );

           $insert_mealplan = array(
                "meal_plan"=>$this->input->post("meal_plan")
          );
           $get_count = $this->validate_model->get_branch($branch_data['branch_name']);


           if(!($get_count))
          {
            $get_affected_rows = $this->insert_model->insert_corporate_branch($branch_data);
            if($get_affected_rows)
            {
                echo "<script> alert('Created Branch'); </script>";
                $this->branch();
            }
          }
          else
          {
            //$this->create_category("vae");
            echo "<script> alert('Error(BRN): Value Already Exists.'); </script>";
            $this->branch("BRN");
          }
        }
        else
        {
          $this->branch();
        }

    }
    //26-2-19
    public function manage_branch()
    {
     if($this->session->has_userdata('id'))
		{
		$data['user_data'] = $this->select_model->select_user($this->backend_table,$this->user_id);
		$company_name = $this->session->userdata('company');
        $data['branch_data'] = $this->select_model->get_cor_branch($company_name);

          $this->load->view('headers/userheader',$data);
          $this->load->view('customer/manage_branch',$data);
          $this->load->view('headers/footer');
        }
      else
      {
          $this->error_403();
      }

    }	
    //26-02-19 edit branch
    function edit_branch()
    {
      if($this->session->has_userdata('id'))
        {
            $data['user_data'] = $this->select_model->select_user($this->backend_table,$this->user_id);
            $id = $this->uri->segment(3);
            $data['branch_data_id'] = $this->select_model->select_user("branch_data","$id");
               $data['company_data'] = $this->select_model->get_corporate_company();
            $this->load->view('headers/userheader',$data);
            $this->load->view('customer/corpor_branch',$data);
            $this->load->view('headers/footer');
      }
      else
      {
            $this->error_403();
      }
    }
     //27-2-19 edit branch data
    function edit_branch_data()
    {
       $this->form_validation->set_rules('company_name','company_name','required');
       $this->form_validation->set_rules('branch_name','branch_name','required');
       $this->form_validation->set_rules('branch_telephone','branch_telephone','required');
       $this->form_validation->set_rules('branch_gstn','branch_gstn','required');
       $this->form_validation->set_rules('branch_address1','branch_address1','required');
       $this->form_validation->set_rules('branch_address2','branch_address2','required');
       $this->form_validation->set_rules('branch_address3','branch_address3','required');
        $this->form_validation->set_rules('branch_city','branch_city','required');
       $this->form_validation->set_rules('branch_state','branch_state','required');
       $this->form_validation->set_rules('branch_zipcode','branch_zipcode','required');
            
        if($this->form_validation->run())
       {
      $id = $this->input->post("bhidden_id");
     
     
     $branch_data = array(
          "company_name" => $this->input->post("company_name"),
          "branch_name" => $this->input->post("branch_name"),
          "branch_telephone" => $this->input->post("branch_telephone"),
          "branch_gstn" => $this->input->post("branch_gstn"),
          "branch_address1" => $this->input->post("branch_address1"),
          "branch_address2" => $this->input->post("branch_address2"),
          "branch_address3" => $this->input->post("branch_address3"),
          "branch_city" => $this->input->post("branch_city"),
          "branch_state" => $this->input->post("branch_state"),
          "branch_zipcode" => $this->input->post("branch_zipcode")
          );

       

      if($this->input->post("update"))
        {
           
            $update_corp_branch = $this->update_model->update_corp_branch($id,$branch_data);
            if($update_corp_branch >= 0)
            {
                echo "<script> alert('Updated successfully'); </script>";
                 echo "<script>window.location.href='".base_url()."home/manage_branch/';</script>";
            } 

        }
        

        }
        else
        {
          if($this->session->has_userdata('admin_id'))
            {
                $data['user_data'] = $this->select_model->select_user($this->backend_table,$this->admin_id);
                $id = $this->input->post("bhidden_id");
                $data['branch_data_id'] = $this->select_model->select_user("branch_data","$id");
               $data['company_data'] = $this->select_model->get_corporate_company();
                
                $this->load->view('headers/userheader',$data);
                $this->load->view('products/corporate_branch',$data);
                $this->load->view('headers/footer');
          }
          else
          {
                $this->error_403();
          }
        }

       
    }
	

	public function delete_branch()
	{
		$get_affected_rows = $this->delete_model->delete_branch($this->uri->segment(3));
            
            if($get_affected_rows)
            {
               redirect(base_url()."home/branch",'refresh');
            }
	}

	//fetching dropdown
  function fetch_dropdown()
  { 
    if($this->select_model->fetch_dropdown($this->input->post('r_id')))
    {
      echo $this->select_model->fetch_dropdown($this->input->post('r_id'));
    }
    else
    {
      echo "Failed";
    }
  }
	//27-02-19
	public function representative($error = NULL)
	{
		if($this->session->has_userdata('id'))
		{

			$data['user_data'] = $this->select_model->select_user($this->backend_table,$this->user_id);
			$data['company_data'] = $this->select_model->get_corporate_company();
			  if($error != NULL)
                 {
                   $data['error'] = "LOGIN";
                   $data['error1'] = "REP";
                }
			$this->load->view('headers/userheader',$data);
			$get_user_type = base64_decode( $this->uri->segment(3));
			$this->load->view('customer/cor_representative',$data);
			$this->load->view('headers/footer');
		}
		else
		{
			$this->error_403();
		}	
	}

	//27-02-19 representative data
    public function representative_data()
    {
       $this->form_validation->set_rules('company_name','company_name','required');
       $this->form_validation->set_rules('branch_name','branch_name','required');
       $this->form_validation->set_rules('user_title','user_title','required');
       $this->form_validation->set_rules('rep_first_name','rep_first_name','required');
       $this->form_validation->set_rules('rep_middle_name','rep_middle_name','required');
      $this->form_validation->set_rules('rep_last_name','rep_last_name','required');
      $this->form_validation->set_rules('rep_email_id','rep_email_id','required');
      $this->form_validation->set_rules('rep_phone_number','rep_phone_number','required');
      $this->form_validation->set_rules('rep_designation','rep_designation','required');
      $this->form_validation->set_rules('rep_employee_id','rep_employee_id','required');
       $this->form_validation->set_rules('rep_address1','branch_address1','required');
       $this->form_validation->set_rules('rep_address2','rep_address2','required');
       $this->form_validation->set_rules('rep_address3','rep_address3','required');
        $this->form_validation->set_rules('rep_city','rep_city','required');
       $this->form_validation->set_rules('rep_state','rep_state','required');
       $this->form_validation->set_rules('rep_zipcode','rep_zipcode','required');
            
        if($this->form_validation->run())
       {
        $representative_data = array(
            "company_name"=>$this->input->post("company_name"),
            "branch_name"=>$this->input->post("branch_name"),
            "user_title"=>$this->input->post("user_title"),
            "rep_first_name"=>$this->input->post("rep_first_name"),
            "rep_mid_name"=>$this->input->post("rep_middle_name"),
            "rep_last_name"=>$this->input->post("rep_last_name"),
            "rep_email_id"=>$this->input->post("rep_email_id"),
            "rep_phono_no"=>$this->input->post("rep_phone_number"),
            "rep_designation"=>$this->input->post("rep_designation"),
            "rep_employee_id"=>$this->input->post("rep_employee_id"),
            "rep_address1"=>$this->input->post("rep_address1"),
            "rep_address2"=>$this->input->post("rep_address2"),
            "rep_address3"=>$this->input->post("rep_address3"),
            "rep_city"=>$this->input->post("rep_city"),
            "rep_state"=>$this->input->post("rep_state"),
            "rep_zipcode"=>$this->input->post("rep_zipcode")
        );
      $login_data = array(
        "email_id"=>$this->input->post("rep_email_id"),
        "phone_number"=>$this->input->post("rep_phone_number"),
        "password"=>$this->input->post("rep_user_password"),
        "active"=>"0",
        "admin"=>"0"
      );

       $get_representative_count = $this->validate_model->get_representative($representative_data['rep_email_id']);
        $get_login_count = $this->validate_model->check_duplicate_login($login_data['email_id']);


        if($get_representative_count == 0 && $get_login_count == 0)
        {
          

          $get_affected = $this->insert_model->insert_corp_representative($representative_data);
         
          if($get_affected == 1)
          {
            
             $get_affected_rows2 = $this->insert_model->insert_login_details($login_data);

                 echo "<script>window.location.href='".base_url()."home/manage_representative/';</script>";

               if($get_affected_rows2)
              {

              $this->email->from('zenopsysevolve@gmail.com', 'FSDMS Appliacation');
              $this->email->to((string)$login_data['email_id']);
              $this->email->subject('Confirm Registration');
              $message = "<html>";
              $message .= "<body>";
              $message .= "<p> Please, click on the link to confirm the registration on FSDMS </p>";

              $message .= "<p> <b>Email Id : ".$login_data['email_id']."</b></p>";
              $message .= "<p> <b> Password : ".$login_data['password']."</b></p>";
              $message .= "<p><a href='".base_url()."home/confirmation/1/".base64_encode($login_data['email_id'])."'> Click to Confirm  </a></p>";

              $message .= "</body>";
              $message .= "</html>";
              $this->email->message($message);
              $this->email->send();

              echo $this->email->print_debugger();
              echo "<script>window.location.href='".base_url()."home/manage_representative/';</script>";
             }
          }
          else
          {
            echo "<script> alert('Error(LOGIN): Email Already Exists.'); </script>";
            $this->representative("LOGIN");
          }
        }
        else
        {
            echo "<script> alert('Error(REP): Email Already Exists.'); </script>";
            $this->representative("REP");
        }
      }
      else
      {
        $this->representative();
      }

  } 

	 //27-02-19 manage representative details
    public function manage_representative()
    {
      if($this->session->has_userdata('id'))
		{

			$data['user_data'] = $this->select_model->select_user($this->backend_table,$this->user_id);
			
			$company_name = $this->session->userdata('company');
			echo $company_name;
			
        $data['representative_data'] = $this->select_model->get_cor_repres($company_name);

         	$this->load->view('headers/userheader',$data);
			$this->load->view('customer/manage_repres',$data);
			$this->load->view('headers/footer');
        }
      else
      {
          $this->error_403();
      }
    }
	public function delete_representative()
	{
		return 0;
	}
	//27-02-19
    //delete representative
     public function delete_repres()
      {
            $get_affected_rows = $this->delete_model->delete_repres($this->uri->segment(3));

            
            if($get_affected_rows)
            {
               redirect(base_url()."home/manage_representative",'refresh');
            }
        }


     //21-02-19 edit representative
    function edit_representative()
    {
     if($this->session->has_userdata('id'))
		{
			$data['user_data'] = $this->select_model->select_user($this->backend_table,$this->user_id);
            $id = $this->uri->segment(3);

            $data['represent_data_id'] = $this->select_model->get_representative_id("$id");
            $data['company_data'] = $this->select_model->get_corporate_company();
            $this->load->view('headers/userheader',$data);
            $this->load->view('customer/cor_representative',$data);
            $this->load->view('headers/footer');
      }
      else
      {
            $this->error_403();
      }
    }
	
    //21-2-19 edit representative data
    function edit_representative_data()
    {
      
       $this->form_validation->set_rules('company_name','company_name','required');
       $this->form_validation->set_rules('branch_name','branch_name','required');
       $this->form_validation->set_rules('user_title','user_title','required');
       $this->form_validation->set_rules('rep_first_name','rep_first_name','required');
       $this->form_validation->set_rules('rep_middle_name','rep_middle_name','required');
      $this->form_validation->set_rules('rep_last_name','rep_last_name','required');
      $this->form_validation->set_rules('rep_email_id','rep_email_id','required');
      $this->form_validation->set_rules('rep_phone_number','rep_phone_number','required');
      $this->form_validation->set_rules('rep_designation','rep_designation','required');
      $this->form_validation->set_rules('rep_employee_id','rep_employee_id','required');
       $this->form_validation->set_rules('rep_address1','branch_address1','required');
       $this->form_validation->set_rules('rep_address2','rep_address2','required');
       $this->form_validation->set_rules('rep_address3','rep_address3','required');
        $this->form_validation->set_rules('rep_city','rep_city','required');
       $this->form_validation->set_rules('rep_state','rep_state','required');
       $this->form_validation->set_rules('rep_zipcode','rep_zipcode','required');
            
        if($this->form_validation->run())
       {
      $id = $this->input->post("rhidden_id");
      $represent_data = array(
           "company_name"=>$this->input->post("company_name"),
            "branch_name"=>$this->input->post("branch_name"),
            "user_title"=>$this->input->post("user_title"),
            "rep_first_name"=>$this->input->post("rep_first_name"),
            "rep_mid_name"=>$this->input->post("rep_middle_name"),
            "rep_last_name"=>$this->input->post("rep_last_name"),
            "rep_email_id"=>$this->input->post("rep_email_id"),
            "rep_phono_no"=>$this->input->post("rep_phone_number"),
            "rep_designation"=>$this->input->post("rep_designation"),
            "rep_employee_id"=>$this->input->post("rep_employee_id"),
            "rep_address1"=>$this->input->post("rep_address1"),
            "rep_address2"=>$this->input->post("rep_address2"),
            "rep_address3"=>$this->input->post("rep_address3"),
            "rep_city"=>$this->input->post("rep_city"),
            "rep_state"=>$this->input->post("rep_state"),
            "rep_zipcode"=>$this->input->post("rep_zipcode")
          );

       

      if($this->input->post("update"))
        {
           
            $update_corp_repres = $this->update_model->update_corp_repres($id,$represent_data);
            if($update_corp_repres >=0)
            {
                echo "<script> alert('Updated successfully'); </script>";
                 echo "<script>window.location.href='".base_url()."home/manage_representative/';</script>";
            } 

        }
       }
      else
        {
           if($this->session->has_userdata('id'))
	           {

        			$data['user_data'] = $this->select_model->select_user($this->backend_table,$this->user_id);
                        $id = $this->input->post("rhidden_id");
                         $data['represent_data_id'] = $this->select_model->get_representative_id("$id");
                    $data['company_data'] = $this->select_model->get_corporate_company();
                        
                        $this->load->view('headers/userheader',$data);
                        $this->load->view('customer/cor_representative',$data);
                        $this->load->view('headers/footer');
                  }
                  else
                  {
                        $this->error_403();
                  }
        }
       
    }

//===============================================================================
 //11-2-19 email sending 
    public function confirmation()
    {
      
      $get_url_value = $this->uri->segment(3);
      
     
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
    //Change Password
    public function change_password()
    {
          if($this->session->has_userdata('id'))
             {

              $data['user_data'] = $this->select_model->select_user($this->backend_table,$this->user_id);

              $get_encoded_email = $this->uri->segment(3);
              $email_address = base64_decode($get_encoded_email);
           
                  $data['pass_data'] = $this->select_model->get_password_data($email_address);  
                        
                    $data['email_data'] = $this->select_model->select_user($this->backend_table,$this->user_id);
                        
                        $this->load->view('headers/userheader',$data);
                        $this->load->view('customer/change_pwd',$data);
                        $this->load->view('headers/footer');
              }
             else
              {
                  $this->error_403();
              }
    }
    public function change_password_data()
    {
      $email = $this->input->post("email_hid");
      $oldpwd = $this->input->post("cur_pwd");
      $olduser = $this->input->post("old_pwd");
      $newpwd = $this->input->post("new_pwd");
      $repwd = $this->input->post("re_pwd");
      $data = array(
          "password" =>$this->input->post("new_pwd")
        );
       if($oldpwd == $olduser)
         {

          if($newpwd == $repwd)
          {
            $update_pwd = $this->update_model->update_pwd_user($email,$data);
            if($update_pwd)
            {
               redirect(base_url()."home/",'refresh');
            }
         }
         
        }
    }


    /**
     * AUTHOR : VEDAVITH RAVULA
     * DATE : 04062019
     * ------------------------
     */

     public function orderlist()
     {
    
      $data['user_data'] = $this->select_model->select_user($this->backend_table,$this->user_id);
      $data['email_data'] = $this->select_model->select_user($this->backend_table,$this->user_id);

      $data['select_orderlist'] = $this->select_model->select_order_id($this->user_id);

                
      $this->load->view('headers/userheader',$data);
      $this->load->view('customer/orderlist',$data);
      $this->load->view('headers/footer');
     
    }
     //========================//

     /**
      * !AJAX CALL ON ORDER ID
      *--------------------------
      * AUTHOR : VEDAVITH RAVULA
      * DATE : 04062019
      *-------------------------
      */

    public function ajaxGetOrders()
    {
        $getData = $this->select_model->get_orders_order_id($this->user_id,$this->input->post('orderid'));
        echo $getData;
    }

      //=================================//
  
    public function error_403()
	  {
		  $this->load->view('404');
		  $this->load->view('headers/footer');
	  }

}

/* End of file Home.php */
/* Location: ./application/controllers/Home.php */
