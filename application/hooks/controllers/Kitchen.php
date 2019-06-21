<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kitchen extends CI_Controller 
{


	public function __construct()
	{
		parent::__construct();

		$this->load->model('insert_model');
	    $this->load->model('update_model');
	    $this->load->model('delete_model');
	    $this->load->model('select_model');
	    $this->load->model('validate_model');	
	}
	

	public function index($data = null)
	{
		$this->load->view('headers/kitchenheader');
		$this->load->view('kitchen/kitchen_login',$data);
		$this->load->view('headers/footer');
	}

	public function kitchen_login()
	{
		$this->form_validation->set_rules('user_name','user_name','required');
		$this->form_validation->set_rules('admin_password','password','required');

		if ($this->form_validation->run())
		{
			$data = array(
				'email_id' => $this->input->post('user_name'),
				'password' => $this->input->post('admin_password')
			);

			$data =  $this->validate_model->get_kitchen_user($data);
			$this->session->set_userdata($data);

			if($data['count'])
			{
				if($this->session->has_userdata('user_id'))
				{
					$this->load->view('headers/kitchen_home_header',$data);
					$this->load->view('kitchen/kitchen_home');
					$this->load->view('headers/footer');
				}
				else
				{
					$this->error_403();
				}	
			}
			else
			{
				$data['error_handler'] = "User Not Found";
				$this->index($data);
			}
		} 
		else 
		{
			$this->index();
		}
	}
 	//12-2-19(Mounika)
	public function kitchen_order_schedule()
    {
        $this->load->view('headers/kitchen_home_header');
        // $this->load->view('superadmin/superadmin_registration');
        $this->load->view('headers/footer');
	}
	 //12-2-19(Mounika)
	public function profile()
	{
		if($this->session->userdata('admin_id'))
		{
            //echo $this->session->userdata('admin_id');
			$data['kitchen_user_data'] = $this->select_model->kicthen_admin_id($this->session->userdata('admin_id'));

			$this->load->view('headers/kitchen_home_header',$data);
			//$get_user_type = base64_decode( $this->uri->segment(3));
			
				$this->load->view('kitchen/kitchen_user_profile');
			
				//echo "kitchen admin details";
			
			$this->load->view('headers/footer');
		}
		else
		{
			$this->error_403();
		}
	}

	function edit_user_data()
    {
      
	   $this->form_validation->set_rules('first_name','first_name','required');
	   $this->form_validation->set_rules('last_name','last_name','required');
       $this->form_validation->set_rules('email_id','email_id','required');
       $this->form_validation->set_rules('user_name','user_name','required');
    //    $this->form_validation->set_rules('old_password','old_password','required');
    //    $this->form_validation->set_rules('new_password','new_password','required');
    //    $this->form_validation->set_rules('renew_pass','renew_pass','required');
       

      if($this->form_validation->run())
       {
      
        $user_data = array(
			"kitchen_id" => $this->input->post("kitchen_id"),
            "first_name" => $this->input->post("first_name"),
		    "last_name" => $this->input->post("last_name"),
		    "email_id" =>$this->input->post("email_id"),
            "user_name" => $this->input->post("user_name")
        //   "password" => $this->input->post("renew_pass")
        );
            $get_update = $this->update_model->update_kit_ser_profile($this->input->post("kitchen_id"),$user_data);
			 if($get_update)
			 {
              echo "<script> alert('user data updated'); </script>";
              echo "<script>window.location.href='".base_url()."kitchen/profile/';</script>";
            }
        }
      else
      {
        if($this->session->has_userdata('kitchen_id'))
            {
			   $kitchen_id = $this->session->userdata("kitchen_id");
               $user_id = $this->session->userdata("user_id");
			   
                // $data['user_data'] = $this->select_model->select_user($this->backend_table,$this->admin_id);
           
                $data['kitchen_user_data'] = $this->select_model->get_kitchen_admin_details($kitchen_id,$user_id);
                $this->load->view('headers/kitchen_home_header');
                $this->load->view('kitchen/kitchen_user_profile',$data);
                $this->load->view('headers/footer');
            }
            else
            {
                $this->error_403();
            }
      }
    }
	 //13-2-19(Mounika)
	public function kitchen_profile()
    {
		if($this->session->userdata('kitchen_id'))
		{
			$data['kitchen_reg_data'] = $this->select_model->kicthen_reg_kitchid($this->session->userdata('kitchen_id'));

        $this->load->view('headers/kitchen_home_header');
        $this->load->view('kitchen/kitchen_profile',$data);
		$this->load->view('headers/footer');
		}
		else
		{
			$this->error_403();
		}
	}
	
	// public function kitchen_update_profile()
    // {
	// 	$affected_rows = $this->update_model->update_kitchen_regprofile();
	// 	if($affected_rows)
    //                {
    //                 redirect(base_url()."kitchen");
    //                }

	// }


	function edit_kitchen_data()
    {
      
	   $this->form_validation->set_rules('kitchen_name','kitchen_name','required');
	   $this->form_validation->set_rules('kitchen_type','kitchen_type','required');
       $this->form_validation->set_rules('kitchen_address1','kitchen_address1','required');
       $this->form_validation->set_rules('kitchen_address2','kitchen_address2','required');
       $this->form_validation->set_rules('kitchen_address3','kitchen_address3','required');
       $this->form_validation->set_rules('state','state','required');
       $this->form_validation->set_rules('city','city','required');
       $this->form_validation->set_rules('zipcode','zipcode','required');

      if($this->form_validation->run())
       {
      
        $kitchen_data = array(
          "k_id" => $this->input->post("kitchen_id"),
		  "k_name" => $this->input->post("kitchen_name"),
		  "kitchen_type" =>$this->input->post("kitchen_type"),
          "k_address1" => $this->input->post("kitchen_address1"),
          "k_address2" => $this->input->post("kitchen_address2"),
          "k_address3" => $this->input->post("kitchen_address3"),
          "state" => $this->input->post("state"),
          "city" => $this->input->post("city"),
          "zipcode" => $this->input->post("zipcode")
        );
         
            
          
            $get_update = $this->update_model->update_kitchen_regprofile($this->input->post("kitchen_id"),$kitchen_data);
             if($get_update >= 0)
             {
              
              echo "<script> alert('kitchen data updated'); </script>";
              echo "<script>window.location.href='".base_url()."kitchen/kitchen_profile/';</script>";
              }
             
        }
      else
      {
        if($this->session->has_userdata('kitchen_id'))
            {
                $id = $this->input->post("kitchen_id");
                // $data['user_data'] = $this->select_model->select_user($this->backend_table,$this->admin_id);
           
                $data['kitchen_reg_data'] = $this->select_model->kicthen_reg_kitchid($id);
                $this->load->view('headers/kitchen_home_header');
                $this->load->view('kitchen/kitchen_profile',$data);
                $this->load->view('headers/footer');
            }
            else
            {
                $this->error_403();
            }
      }
	}

	//18-2-19(Mounika)
	
	public function change_profile()
    {
		if($this->session->userdata('kitchen_id'))
		{
		$data['kitchen_user_data'] = $this->select_model->kicthen_admin_id($this->session->userdata('admin_id'));
        $this->load->view('headers/kitchen_home_header');
        $this->load->view('kitchen/kitchen_change_pswd',$data);
		$this->load->view('headers/footer');
		}
		else
		{
			$this->error_403();
		}
	}

	function edit_profile_data()
    {
       $this->form_validation->set_rules('old_password','old_password','required');
       $this->form_validation->set_rules('new_password','new_password','required');
	   $this->form_validation->set_rules('renew_pass','renew_pass','required');
	   
      if($this->form_validation->run())
       {
      
        $user_data = array(
			"kitchen_id" => $this->input->post("kitchen_id"),
			"password" => $this->input->post("renew_pass")
		);
		
		// echo json_encode($user_data);

            $get_update = $this->update_model->update_kit_ser_profile($this->input->post("kitchen_id"),$user_data);
			if($get_update >= 0)
			{
              echo "<script> alert('user profile updated'); </script>";
              echo "<script>window.location.href='".base_url()."kitchen/change_profile/';</script>";
            }
        }
      else
      {
        if($this->session->has_userdata('kitchen_id'))
            {
			   $kitchen_id = $this->session->userdata("kitchen_id");
               $admin_id = $this->session->userdata("admin_id");
			   
                // $data['user_data'] = $this->select_model->select_user($this->backend_table,$this->admin_id);
           
                $data['kitchen_user_data'] = $this->select_model->get_kitchen_admin_details($kitchen_id,$admin_id);
                $this->load->view('headers/kitchen_home_header');
                $this->load->view('kitchen/kitchen_change_pswd',$data);
                $this->load->view('headers/footer');
            }
            else
            {
                $this->error_403();
            }
      }
    }

	/**
	*	PAGE FORBIDDEN
	*/

    public function error_403()
    {
        $this->load->view('404');
        $this->load->view('headers/footer');
	}
	
	public function logout()
    {
            $this->session->sess_destroy();
            redirect(base_url()."kitchen");
	}
	//19-2-2019(Mounika)
	public function kitchen_home()
    {
        $this->load->view('headers/kitchen_home_header');
        $this->load->view('kitchen/kitchen_home');
        $this->load->view('headers/footer');
    }
    //19-2-2019(Mounika)
	public function kitchen_employee()
    {
		
        $data['kitchen_reg_data'] = $this->select_model->kicthen_reg_kitchid($this->session->userdata('kitchen_id'));
        $data['get_role'] = $this->select_model->get_role_master();
        
		// $data['kitchen_user_data'] = $this->select_model->kicthen_admin_id($this->session->userdata('user_id'));
			$this->load->view('headers/kitchen_home_header');
			$this->load->view('kitchen/kitchen_employee',$data);
			$this->load->view('headers/footer');
		
	}

    //20-2-2019(Mounika)
	public function employee()
    {
       $this->form_validation->set_rules('txtemp_name', 'txtemp_name', 'required');
       $this->form_validation->set_rules('txtLname', 'txtLname', 'required');
       $this->form_validation->set_rules('txtMname', 'txtMname', 'required');
       $this->form_validation->set_rules('txtemp_id', 'txtemp_id', 'required');
       $this->form_validation->set_rules('txtGender', 'txtGender', 'required');
       $this->form_validation->set_rules('txtemp_role', 'txtemp_role', 'required');
       $this->form_validation->set_rules('txtemail_id', 'txtemail_id', 'required');
       $this->form_validation->set_rules('txtBlood', 'txtBlood', 'required');
       $this->form_validation->set_rules('txtBirthdate', 'txBirthdate', 'required');
       $this->form_validation->set_rules('txtJoindate', 'txtJoindate', 'required');
       $this->form_validation->set_rules('txtmobile', 'txtmobile', 'required');
       $this->form_validation->set_rules('txtemgcnt', 'txtemgcnt', 'required');
       $this->form_validation->set_rules('txtaadhar', 'txtaadhar', 'required');
       $this->form_validation->set_rules('txtpan', 'txtpan', 'required');
       $this->form_validation->set_rules('txtpass', 'txtpass', 'required');
       $this->form_validation->set_rules('l_addr1', 'l_addr1', 'required');
       $this->form_validation->set_rules('l_addr2', 'l_addr2', 'required');
       $this->form_validation->set_rules('l_addr3', 'l_addr3', 'required');
       $this->form_validation->set_rules('l_state', 'l_state', 'required');
       $this->form_validation->set_rules('l_city', 'l_city', 'required');
       $this->form_validation->set_rules('l_zipcode', 'l_zipcode', 'required');
       $this->form_validation->set_rules('p_addr1', 'p_addr1', 'required');
       $this->form_validation->set_rules('p_addr2', 'p_addr2', 'required');
       $this->form_validation->set_rules('p_addr3', 'p_addr3', 'required');
       $this->form_validation->set_rules('p_state', 'p_state', 'required');
       $this->form_validation->set_rules('p_city', 'p_city', 'required');
       $this->form_validation->set_rules('p_zipcode', 'p_zipcode', 'required');
       $this->form_validation->set_rules('txtfather', 'txtfather', 'required');
       $this->form_validation->set_rules('txtfathmail', 'txtfathmail', 'required');
       $this->form_validation->set_rules('txtfathmob', 'txtfathmob', 'required');
       $this->form_validation->set_rules('txtfathaadhar', 'txtfathaadhar', 'required');
       $this->form_validation->set_rules('txtmother', 'txtmother', 'required');
       $this->form_validation->set_rules('txtmothmail', 'txtmothmail', 'required');
       $this->form_validation->set_rules('txtmothmob', 'txtmothmob', 'required');
       $this->form_validation->set_rules('txtmothaadhar', 'txtmothaadhar', 'required');
       $this->form_validation->set_rules('txtbank', 'txtbank', 'required');
       $this->form_validation->set_rules('txtacct', 'txtacct', 'required');
       $this->form_validation->set_rules('txtbranch', 'txtbranch', 'required');
       $this->form_validation->set_rules('txtifsc', 'txtifsc', 'required');

       if ($this->form_validation->run())
       {
           $isCompany = NULL;
           if($this->session->userdata('kitchen_type') == 'company')
           {
            $isCompany = 0;
           }
           else
           {
            $isCompany = 1;
           }
          $insert_employee = array(
                "kitchen_id"=>$this->input->post("txtkitchen_id"),
                "emp_id"=>$this->input->post("txtemp_id"),
                "emp_name"=>$this->input->post("txtemp_name"),
                "Lname"=>$this->input->post("txtLname"),
                "Mname"=>$this->input->post("txtMname"),
                "Gender"=>$this->input->post("txtGender"),
                "emp_role"=>$this->input->post("txtemp_role"),
                "email_id"=>$this->input->post("txtemail_id"),
                "Blood"=>$this->input->post("txtBlood"),
                "Birthdate"=>$this->input->post("txtBirthdate"),
                "Joindate"=>$this->input->post("txtJoindate"),
                "mobile"=>$this->input->post("txtmobile"),
                "emgcnt"=>$this->input->post("txtemgcnt"),
                "aadhar"=>$this->input->post("txtaadhar"),
                "pan"=>$this->input->post("txtpan"),
                "pass"=>$this->input->post("txtpass"),
                "l_address1"=>$this->input->post("l_addr1"),
                "l_address2"=>$this->input->post("l_addr2"),
                "l_address3"=>$this->input->post("l_addr3"),
                "state"=>$this->input->post("l_state"),
                "city"=>$this->input->post("l_city"),
                "zipcode"=>$this->input->post("l_zipcode"),
                "p_address1"=>$this->input->post("p_addr1"),
                "p_address2"=>$this->input->post("p_addr2"),
                "p_address3"=>$this->input->post("p_addr3"),
                "p_state"=>$this->input->post("p_state"),
                "p_city"=>$this->input->post("p_city"),
                "p_zipcode"=>$this->input->post("p_zipcode"),
                "father_name"=>$this->input->post("txtfather"),
                "father_email"=>$this->input->post("txtfathmail"),
                "father_mobile"=>$this->input->post("txtfathmob"),
                "father_aadhar"=>$this->input->post("txtfathaadhar"),
                "mother_name"=>$this->input->post("txtmother"),
                "mother_email"=>$this->input->post("txtmothmail"),
                "mother_mobile"=>$this->input->post("txtmothmob"),
                "mother_aadhar"=>$this->input->post("txtmothaadhar"),
                "bank_name"=>$this->input->post("txtbank"),
                "bank_acct"=>$this->input->post("txtacct"),
                "bank_branch"=>$this->input->post("txtbranch"),
                "bank_ifsc"=>$this->input->post("txtifsc"),
                "approve"=> $isCompany,
                "status"=> 0

          );

           // print_r($insert_employee);
         echo $get_count = $this->validate_model->get_employee($insert_employee['emp_id']);

          if(!($get_count))
          {
            $get_affected_rows = $this->insert_model->insert_kitchen_employee($insert_employee);
            if($get_affected_rows)
            {
                echo "<script> alert('Created Employee'); </script>";
				$this->kitchen_employee();
            }
          }
          else
          {
            //$this->create_category("vae");
            echo "<script> alert('Error(VAE): Value Already Exists.'); </script>";
				$this->kitchen_employee();
                // $this->create_category();
          }
       }
       else
       {
        $this->kitchen_employee();
       }
       
    }
    //20-2-2019(Mounika)
    public function view_employee()
    {
		
        //$data['kitchen_user_employee'] = $this->select_model->get_employee();
        $data['get_role'] = $this->select_model->get_role_master();
       $data['kitchen_user_employee'] = $this->select_model->get_kitchen_data($this->session->userdata('kitchen_id'));      
        $this->load->view('headers/kitchen_home_header');
        $this->load->view('kitchen/kitchen_view_employee',$data);
		$this->load->view('headers/footer');
		
    }
    //20-2-2019(Mounika)
    public function edit_employee()
    {
		if($this->session->userdata('kitchen_id'))
		{
        $data['kitchen_emp_data'] = $this->select_model->kitchen_empid($this->uri->segment(3));
        $data['get_role'] = $this->select_model->get_role_master();
        
        $this->load->view('headers/kitchen_home_header');
        $this->load->view('kitchen/kitchen_employee',$data);
		$this->load->view('headers/footer');
		}
		else
		{
			$this->error_403();
		}
    }
    //20-2-2019(Mounika)
    public function update_employee()
    {
        $this->form_validation->set_rules('txtemp_name', 'txtemp_name', 'required');
        $this->form_validation->set_rules('txtLname', 'txtLname', 'required');
        $this->form_validation->set_rules('txtMname', 'txtMname', 'required');
        $this->form_validation->set_rules('txtemp_id', 'txtemp_id', 'required');
        $this->form_validation->set_rules('txtGender', 'txtGender', 'required');
        $this->form_validation->set_rules('txtemp_role', 'txtemp_role', 'required');
        $this->form_validation->set_rules('txtemail_id', 'txtemail_id', 'required');
        $this->form_validation->set_rules('txtBlood', 'txtBlood', 'required');
        $this->form_validation->set_rules('txtBirthdate', 'txBirthdate', 'required');
        $this->form_validation->set_rules('txtJoindate', 'txtJoindate', 'required');
        $this->form_validation->set_rules('txtmobile', 'txtmobile', 'required');
        $this->form_validation->set_rules('txtemgcnt', 'txtemgcnt', 'required');
        $this->form_validation->set_rules('txtaadhar', 'txtaadhar', 'required');
        $this->form_validation->set_rules('txtpan', 'txtpan', 'required');
        $this->form_validation->set_rules('txtpass', 'txtpass', 'required');
        $this->form_validation->set_rules('l_addr1', 'l_addr1', 'required');
        $this->form_validation->set_rules('l_addr2', 'l_addr2', 'required');
        $this->form_validation->set_rules('l_addr3', 'l_addr3', 'required');
        $this->form_validation->set_rules('l_state', 'l_state', 'required');
        $this->form_validation->set_rules('l_city', 'l_city', 'required');
        $this->form_validation->set_rules('l_zipcode', 'l_zipcode', 'required');
        $this->form_validation->set_rules('p_addr1', 'p_addr1', 'required');
        $this->form_validation->set_rules('p_addr2', 'p_addr2', 'required');
        $this->form_validation->set_rules('p_addr3', 'p_addr3', 'required');
        $this->form_validation->set_rules('p_state', 'p_state', 'required');
        $this->form_validation->set_rules('p_city', 'p_city', 'required');
        $this->form_validation->set_rules('p_zipcode', 'p_zipcode', 'required');
        $this->form_validation->set_rules('txtfather', 'txtfather', 'required');
        $this->form_validation->set_rules('txtfathmail', 'txtfathmail', 'required');
        $this->form_validation->set_rules('txtfathmob', 'txtfathmob', 'required');
        $this->form_validation->set_rules('txtfathaadhar', 'txtfathaadhar', 'required');
        $this->form_validation->set_rules('txtmother', 'txtmother', 'required');
        $this->form_validation->set_rules('txtmothmail', 'txtmothmail', 'required');
        $this->form_validation->set_rules('txtmothmob', 'txtmothmob', 'required');
        $this->form_validation->set_rules('txtmothaadhar', 'txtmothaadhar', 'required');
        $this->form_validation->set_rules('txtbank', 'txtbank', 'required');
        $this->form_validation->set_rules('txtacct', 'txtacct', 'required');
        $this->form_validation->set_rules('txtbranch', 'txtbranch', 'required');
        $this->form_validation->set_rules('txtifsc', 'txtifsc', 'required');


	   
       if ($this->form_validation->run())
       {
          $update_employee = array(
                "kitchen_id"=>$this->input->post("txtkitchen_id"),
                "emp_id"=>$this->input->post("txtemp_id"),
                "emp_name"=>$this->input->post("txtemp_name"),
                "Lname"=>$this->input->post("txtLname"),
                "Mname"=>$this->input->post("txtMname"),
                "Gender"=>$this->input->post("txtGender"),
                "emp_role"=>$this->input->post("txtemp_role"),
                "email_id"=>$this->input->post("txtemail_id"),
                "Blood"=>$this->input->post("txtBlood"),
                "Birthdate"=>$this->input->post("txtBirthdate"),
                "Joindate"=>$this->input->post("txtJoindate"),
                "mobile"=>$this->input->post("txtmobile"),
                "emgcnt"=>$this->input->post("txtemgcnt"),
                "aadhar"=>$this->input->post("txtaadhar"),
                "pan"=>$this->input->post("txtpan"),
                "pass"=>$this->input->post("txtpass"),
                "l_address1"=>$this->input->post("l_addr1"),
                "l_address2"=>$this->input->post("l_addr2"),
                "l_address3"=>$this->input->post("l_addr3"),
                "state"=>$this->input->post("l_state"),
                "city"=>$this->input->post("l_city"),
                "zipcode"=>$this->input->post("l_zipcode"),
                "p_address1"=>$this->input->post("p_addr1"),
                "p_address2"=>$this->input->post("p_addr2"),
                "p_address3"=>$this->input->post("p_addr3"),
                "p_state"=>$this->input->post("p_state"),
                "p_city"=>$this->input->post("p_city"),
                "p_zipcode"=>$this->input->post("p_zipcode"),
                "father_name"=>$this->input->post("txtfather"),
                "father_email"=>$this->input->post("txtfathmail"),
                "father_mobile"=>$this->input->post("txtfathmob"),
                "father_aadhar"=>$this->input->post("txtfathaadhar"),
                "mother_name"=>$this->input->post("txtmother"),
                "mother_email"=>$this->input->post("txtmothmail"),
                "mother_mobile"=>$this->input->post("txtmothmob"),
                "mother_aadhar"=>$this->input->post("txtmothaadhar"),
                "bank_name"=>$this->input->post("txtbank"),
                "bank_acct"=>$this->input->post("txtacct"),
                "bank_branch"=>$this->input->post("txtbranch"),
                "bank_ifsc"=>$this->input->post("txtifsc")
          );

         // print_r($update_employee);

          $get_update = $this->update_model->update_emp_profile($this->input->post("id"),$update_employee);
          if($get_update >= 0)
          {
            echo "<script> alert('Employee profile updated'); </script>";
            echo "<script>window.location.href='".base_url()."kitchen/view_employee/';</script>";
          }
          else
          {
            //$this->create_category("vae");
            //echo "<script> alert('Error(VAE): Value Already Exists.'); </script>";
				$this->edit_employee();
                // $this->create_category();
          }
       }
       else
       {
        $data['kitchen_emp_data'] = $this->select_model->kitchen_empid($this->session->userdata('emp_id'));
        $data['get_role'] = $this->select_model->get_role_master();

        $this->load->view('headers/kitchen_home_header');
        $this->load->view('kitchen/kitchen_employee',$data);
		$this->load->view('headers/footer');
       }
       
    }
    //20-2-2019(Mounika)
    public function delete_employee()
    {
      $data = array(
          "status" => '1'
      );
        $get_affected_rows = $this->update_model->update_emp_status($this->uri->segment(3),$data);

        if($get_affected_rows)
        {
          $this->view_employee();
        }
    }
    //21-2-2019(Mounika)
    public function create_emp_role($error=NULL,$data_array=NULL)
    {
        if($this->session->has_userdata('kitchen_id'))
        {
            // $data['user_data'] = $this->select_model->select_user($this->backend_table,$this->kitchen_id);
            $this->load->view('headers/kitchen_home_header');

            // $data['error_handler'] = $error;
             $data['emp_role_master'] = $this->select_model->get_role_master();

            if(isset($data_array))
            {
                $data['update'] = 1;
                $data['id'] = $data_array['id'];
                $data['role_name'] = $data_array['role_name'];
            }

            $this->load->view('masters/new_emp_role',$data);
            $this->load->view('headers/footer');
        }
        else
        {
            $this->error_403();
        }
    }

    public function insert_emp_role()
    {
       $this->form_validation->set_rules('emp_role', 'emp_role', 'required');
       if ($this->form_validation->run())
       {
          $insert_role = array(
                "emp_role"=>$this->input->post("emp_role")
          );

          $get_count = $this->validate_model->get_role($insert_role['emp_role']);

          if(!($get_count))
          {
            $get_affected_rows = $this->insert_model->insert_emp_role($insert_role);
            if($get_affected_rows)
            {
                echo "<script> alert('Created Role'); </script>";
                $this->create_emp_role();
            }
          }
          else
          {
            //$this->create_category("vae");
            echo "<script> alert('Error(VAE): Value Already Exists.'); </script>";
            $this->create_emp_role();
          }
       }
       else
       {
           $this->create_emp_role("Required");
       }
    }

    public function update_emp_role()
    {
        $data['id']=$this->uri->segment(3);
        $get_value = $this->select_model->get_role($this->uri->segment(3));
        // print_r($get_value);
        if($get_value->num_rows() > 0)
        {
            $data_array = array();
            // print_r($get_value->result());
            foreach($get_value->result() as $role)
            {
                $data_array['update'] = 1;
                $data_array['id'] = $role->id;
                $data_array['role_name'] = $role->emp_role;
            }
            $this->create_emp_role(NULL,$data_array);
        }        

        /*
         *  Update button
         */

        if($this->input->post('cat_update') == "cat_update")
        {

            $this->form_validation->set_rules('update_role','update_role','required');
            
            if($this->form_validation->run())
            {
                 $get_update = array(
                    "id" => $this->input->post('update_id'),
                    "emp_role" => (string)$this->input->post('update_role')
                );

                $get_update_count = $this->update_model->update_role_master($get_update);
                if($get_update_count >= 0)
                {
                    echo "<script> alert('Updated'); </script>";
                    redirect(base_url()."kitchen/create_emp_role/".$this->uri->segment(3),'refresh');
                }

            }
            else
            {
                echo "<script> alert('ERROR(UVE) : Update Value Should Not Be Empty'); </script>";
                redirect(base_url()."kitchen/create_emp_role/".$this->uri->segment(3),'refresh');
            }
         
        }
    }

    public function delete_role()
    {
        $get_affected_rows = $this->delete_model->delete_emp_role($this->uri->segment(3));

        if($get_affected_rows)
        {
           redirect(base_url()."kitchen/create_emp_role",'refresh');
        }
    }
    
    public function select_role()
    {
        $get_role = $this->select_model->get_role_master();
        $this->load->view('kitchen/kitchen_employee',$get_role);    
    }
    //25-2-19(Mounika)
	public function kitchen_stock()
    {
		if($this->session->userdata('kitchen_id'))
		{
			$data['kitchen_stock_data'] = $this->select_model->get_kicthen_stock($this->session->userdata('kitchen_id'));

        $this->load->view('headers/kitchen_home_header');
        $this->load->view('kitchen/kitchen_stock',$data);
        //print_r($data['kitchen_stock_data']);
		$this->load->view('headers/footer');
		}
		else
		{
			$this->error_403();
		}
    }
     //25-2-19(Mounika)
    public function add_stock()
    {
        $add_stock_insert = array(
            "product_name" =>$this->input->post('name'),
            "product_sku" =>$this->input->post('sku'),
            "product_units" =>$this->input->post('units'),
            "product_quantity" =>$this->input->post('quant')
        );
        $add_stock = array(
            "product_name"=>$this->input->post('name'),
            "product_sku"=>$this->input->post('sku'),
            "product_units"=>$this->input->post('units'),
            "product_quantity"=>$this->input->post('quant'),
            "addordel"=>$this->input->post('addordel')
        );

        /**
         * 1. Product Count on SKU
         * 2. IF COUNT = 1
         *      DO  : Update
         *    ELSE
         *      DO  : Insert
         */
         $count_setter = 0;
         $get_count = $this->validate_model->get_kitchen_product_count($this->session->userdata('kitchen_id'),$add_stock_insert['product_sku']);

        if($get_count > 0)
        {
            //Do Update
            $stock = $this->insert_model->kitchen_inventory_update($this->session->userdata('kitchen_id'),$add_stock);
            if($stock)
            {
                $get_stock = array(
                    "sku" => $add_stock['product_sku'],
                    "quantity" => $add_stock['product_quantity']
                );
                $get_affected = $this->update_model->update_stock_add($this->session->userdata('kitchen_id'),$get_stock);
                if($get_affected)
                {
                    $count_setter++;
                }
            }
        }
        else
        {
            //Do Insert
            $insert_kitchen_inventory = $this->insert_model->kitchen_inventory_insert($this->session->userdata('kitchen_id'),$add_stock_insert);
            if($insert_kitchen_inventory)
            {
                $stock = $this->insert_model->kitchen_inventory_update($this->session->userdata('kitchen_id'),$add_stock);
                if($stock)
                {
                    $count_setter++;
                }
            }
        }    

        if($count_setter)
        {   
            
        $add_rc = array(
            "kitchen_id" =>$this->input->post('kitchenid'),
            "delivery_id" =>$this->input->post('deliveryid'),
            "DC_no" => $this->input->post('dcno'),
            "product_sku"=>$this->input->post('sku'),
            "product_name"=>$this->input->post('name'),
            "current_quantity" =>$this->input->post('currquant'),
            "obtained_quantity"=>$this->input->post('quant')
            
        );

        $insert_RC   = $this->insert_model->insert_RC($add_rc); 
            if($insert_RC)
            {
                //do update stuff
                $update_flag = $this->update_model->update_acceptflag($this->input->post('idsetter'));
                
            }
        }
    }
     //26-2-19(Mounika)
     public function deduct_stock()
    {
        $deduct_stock = array(
            "product_name"=>$this->input->post('name'),
            "product_sku"=>$this->input->post('sku'),
            "product_units"=>$this->input->post('units'),
            "product_quantity"=>$this->input->post('quant'),
            "addordel"=>$this->input->post('addordel')
        );
        $stock = $this->insert_model->kitchen_inventory_update_deduct($this->session->userdata('kitchen_id'),$deduct_stock);
        if($stock)
        {
            $get_stock = array(
                "sku" => $deduct_stock['product_sku'],
                "quantity" => $deduct_stock['product_quantity']
            );
        echo $get_affected = $this->update_model->update_stock_deduct($this->session->userdata('kitchen_id'),$get_stock);
        }
    }

    public function kitchen_dc()
    {
		if($this->session->userdata('kitchen_id'))
		{
		$data['kitchen_dc_data'] = $this->select_model->kitchen_dc($this->session->userdata('kitchen_id'));
        $this->load->view('headers/kitchen_home_header');
        $this->load->view('kitchen/kitchen_dc',$data);
		$this->load->view('headers/footer');
		}
		else
		{
			$this->error_403();
		}
	}


    //18/03/19(Mounika)

    public function kitchen_order()
    {
		if($this->session->userdata('kitchen_id'))
		{
			$data['kitchen_order_data'] = $this->select_model->get_kitchen_order($this->session->userdata('kitchen_id'));

        $this->load->view('headers/kitchen_home_header');
        $this->load->view('kitchen/kitchen_order',$data);
        //print_r($data['kitchen_stock_data']);
		$this->load->view('headers/footer');
		}
		else
		{
			$this->error_403();
		}
    }

    public function ajaxCallKitchenOrder()
    {
       
        $insertkitchenorder = array(
            "user_id" => $this->input->post('userid'),
            "kitchen_id" => $this->input->post('kitchenid'),
            "user_table" => $this->input->post('usertable'),
            "product_id" => $this->input->post('rowid'),
            "product_sku" => $this->input->post('sku'),
            "product_name" => $this->input->post('name')
        );
        $insert = $this->insert_model->kitchen_order_update($insertkitchenorder);
        if($insert)
        {
            //echo $insert;
            $update_kitchen_flag = $this->update_model->kitchen_confirm_flag($insertkitchenorder['product_id']);
            if($update_kitchen_flag)
            {
                echo $update_kitchen_flag;
            }
        }
    }

    public function kitchen_attendance()
    {
		if($this->session->userdata('kitchen_id'))
		{

			$get_data = $this->select_model->get_kitchen_data($this->session->userdata('kitchen_id'));
            if($get_data->num_rows() > 0)
            {
                $x = 0;
                $insert_attendance_array = array();
                foreach($get_data->result() as $row)
                {
                    $insert_attendance_array[$x]["kitchen_id"] = $row->kitchen_id;
                    $insert_attendance_array[$x]["employee_id"] = $row->emp_id;
                    $insert_attendance_array[$x]["employee_name"] = $row->emp_name;
                    $insert_attendance_array[$x]["employee_role"] = $row->role;
                    $insert_attendance_array[$x]["set_date"] = date("Y-m-d");  
                    $insert_attendance_array[$x]["attendance_flag"] = 0;            
                    $x++;
                }
            }
            // echo "<pre>";
            // print_r($insert_attendance_array);
            // echo "</pre>";
            $count = 0;
            for($y = 0; $y < count($insert_attendance_array); $y++)
            {
             $get_count = $this->validate_model->get_date_count_on_attendance($insert_attendance_array[$y]['set_date'],$insert_attendance_array[$y]['kitchen_id']);
                if($get_count)
                {
                    $count++;
                }
            }
            //echo $count;
            if($count == 0)
            {
                for($z=0; $z < count($insert_attendance_array); $z++)
                {
                  $insert_to_attendance_table = $this->insert_model->insert_attendance_data($insert_attendance_array[$z]);

                }
            }

            $data['select_current_attendance'] = $this->select_model->get_attendance_data();
            $this->load->view('headers/kitchen_home_header');
            $this->load->view('kitchen/kitchen_attendance',$data);
        //print_r($data['kitchen_stock_data']);
		    $this->load->view('headers/footer');
            
		}
		else
		{
			$this->error_403();
		}
    }

    //28-03-19(Divya)
    function kitchen_delivery_report()
    {
      if($this->session->userdata('kitchen_id'))
      {
        $data['del_data'] = $this->select_model->get_delivery_data($this->session->userdata('kitchen_id'));

          $this->load->view('headers/kitchen_home_header');
          $this->load->view('kitchen/kithen_manage_delivery',$data);
          //print_r($data['kitchen_stock_data']);
          $this->load->view('headers/footer');
      }
      else
      {
        $this->error_403();
      }
    }
     public function ajaxCalldelstatus()
    {
       $update_flag = $this->update_model->update_kitchen_delivery($this->input->post('kit'),$this->input->post('order'),$this->input->post('skuid'));
       if($update_flag)
       {
           echo $update_flag;
       }
    }
    public function ajaxCallAttendance()
    {
       $update_flag = $this->update_model->update_kitchen_attendance($this->input->post('employee_id'),$this->input->post('date'));
       if($update_flag)
       {
           echo $update_flag;
       }
    }
    /*-----------------------delivery hub Orders-------------------------*/
    public function kitchen_delivery_order()
    {
      if($this->session->userdata('kitchen_id'))
        {
            $data['kitchen_user_data'] = $this->select_model->kicthen_admin_id($this->session->userdata('admin_id'));
          $data['del_data'] = $this->select_model->get_kitchen_delivery($this->session->userdata('kitchen_id'));

            $this->load->view('headers/kitchen_home_header');
            $this->load->view('kitchen/kitchen_deliveryhub_order',$data);
            //print_r($data['kitchen_stock_data']);
            $this->load->view('headers/footer');
        }
        else
        {
          $this->error_403();
        }
    }
     public function receive_del_executive()
      {
            $get_affected_rows = $this->update_model->update_delivery_received($this->uri->segment(3));
            
            if($get_affected_rows)
            {
               redirect(base_url()."kitchen/kitchen_delivery_order",'refresh');
            }
        }
    public function delivery_challan_order()
    {
      if($this->session->userdata('kitchen_id'))
        {
            $data['kitchen_user_data'] = $this->select_model->kicthen_admin_id($this->session->userdata('admin_id'));
            $data['del_exe'] = $this->select_model->delivery_exe();
            $data['order_id'] = $this->select_model->get_orderid();  
            $this->load->view('headers/kitchen_home_header',$data);
            $this->load->view('kitchen/orders_dc',$data);
            //print_r($data['kitchen_stock_data']);
            $this->load->view('headers/footer');
        }
        else
        {
          $this->error_403();
        }
    }
    public function fetch_product()
    {
      
      if($this->select_model->fetch_product_values($this->input->post('or_id')))
     {
      $output=$this->select_model->fetch_product_values($this->input->post('or_id'));
      echo json_encode($output);
    }
    else
    {
      echo "Failed";
    }
   
    }

    public function dc_order_data()
    {
      $d=0;
      $count =count($this->input->post("product_name[]"));
      //echo $count;
      //echo $this->input->post("product_name[1]");
      //echo "<script>alert($count);</script>";
      for($k=0; $k < $count ;$k++)
      {
        
        $data = array(
          "kit_id" => $this->session->userdata('kitchen_id'),
          "delivery_emp_id" => $this->input->post('del_executive'),
          "dc_id" => $this->input->post('dc_no'),
          "user_id" => $this->input->post('user_id['.$k.']'),
          "product_name" => $this->input->post('product_name['.$k.']'),
          "product_sku" => $this->input->post('product_sku['.$k.']'),
          "quantity" => $this->input->post('product_quantity['.$k.']'),
          "order_id" => $this->input->post('del_order_id'),
          "main_address" => $this->input->post('product_addr['.$k.']'),
          "branch_address" => $this->input->post('product_braddr['.$k.']'),
          "bundled_flag" => $this->input->post('product_bundled['.$k.']')
         );
      //echo "<pre>";print_r($data);echo "</pre>";
      $insert = $this->insert_model->insert_delivery_order($data);
      $d++;
    }
      
        if($d == $count)
          {
            echo "<script> alert('Inserted Successfully'); </script>";
            echo "<script>window.location.href='".base_url()."kitchen/manage_dc_order';</script>";
           
          }
    }
    public function manage_dc_order()
    {
      if($this->session->userdata('kitchen_id'))
        {
            $data['kitchen_user_data'] = $this->select_model->kicthen_admin_id($this->session->userdata('admin_id'));
            $data['del_order'] = $this->select_model->get_dc_order();
        
            $this->load->view('headers/kitchen_home_header',$data);
            $this->load->view('kitchen/orders_dc',$data);
            //print_r($data['kitchen_stock_data']);
            $this->load->view('headers/footer');
        }
        else
        {
          $this->error_403();
        }
    }
    public function edit_dc_order()
    {
      if($this->session->userdata('kitchen_id'))
        {
          $id = $this->uri->segment(3);
            $data['kitchen_user_data'] = $this->select_model->kicthen_admin_id($this->session->userdata('admin_id'));
              $data['del_exe'] = $this->select_model->delivery_exe();
              $data['del_order_val'] = $this->select_model->get_dc_order_id($id);
            $this->load->view('headers/kitchen_home_header',$data);
            $this->load->view('kitchen/orders_dc',$data);
            //print_r($data['kitchen_stock_data']);
            $this->load->view('headers/footer');
        }
        else
        {
          $this->error_403();
        }
    }
    public function edit_dc_data()
    {
      $data = array(
        "kit_id" => $this->session->userdata('kitchen_id'),
        "delivery_emp_id" => $this->input->post('del_executive'),
        "dc_id" => $this->input->post('dc_no'),
        "user_id" => $this->input->post('user_id'),
        "product_name" => $this->input->post('product_name'),
        "product_sku" => $this->input->post('product_sku'),
        "order_id" => $this->input->post('order_id')
      );
       $get_update = $this->update_model->update_dc_order($this->input->post("dc_no"),$data);
          if($get_update >= 0)
          {
            echo "<script> alert('DC Order updated'); </script>";
            echo "<script>window.location.href='".base_url()."kitchen/manage_dc_order/';</script>";
          }

    }
    public function delete_dc_order()
    {
       $get_affected_rows = $this->delete_model->delete_dc_order($this->uri->segment(3));
            
            if($get_affected_rows)
            {
               redirect(base_url()."kitchen/manage_dc_order",'refresh');
            }
    }

      /**
    * AUTHOR : VEDAVITH RAVULA
    * DATE : 26042019
    * GET ASSIGNED PRODUCTS
    */

    public function get_assigned_orders()
    {
        $this->load->view('headers/kitchen_home_header');
        $kitchen_id = $this->session->userdata('kitchen_id');
        $data['assigned_products'] = $this->select_model->select_assigned_kitchen_products($kitchen_id);
        $this->load->view('kitchen/kitchen_assigned_products',$data);
        $this->load->view('headers/footer');
    }

    public function ajax_call_update_asssigned_quantity()
    {
        $output = $this->update_model->update_kitchen_assigned_product($this->input->post('kitchen_id'),$this->input->post('product_sku'),$this->input->post('quantity'));
        echo $output;
    }


}



/* End of file Kitchen.php */
/* Location: ./application/controllers/Kitchen.php */