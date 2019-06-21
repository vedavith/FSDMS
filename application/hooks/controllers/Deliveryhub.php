
<?php
    //26-2-19(Mounika)
defined('BASEPATH') OR exit('No direct script access allowed');

require_once(APPPATH . 'libraries/delivery/Idelivery.php'); // require deliveryhub interface


class Deliveryhub  extends CI_Controller implements Idelivery
{


  public function __construct()
  {
    parent::__construct();

    $this->load->model('insert_model');
      $this->load->model('update_model');
      $this->load->model('delete_model');
      $this->load->model('select_model');
      $this->load->model('validate_model'); 
      $this->user_id = $this->session->userdata('admin_id');
      $this->backend_table = $this->session->userdata('delivery_table');
  }
  //26-2-19(Mounika)
	public function index($data = null)
	{
		$this->load->view('headers/deliveryhubheader');
		$this->load->view('deliveryhub/deliveryhub_login',$data);
		$this->load->view('headers/footer');
    }
    //26-2-19(Mounika)
	public function deliveryhub_login()
	{
		$this->form_validation->set_rules('user_name','user_name','required');
		$this->form_validation->set_rules('admin_password','password','required');

		if ($this->form_validation->run())
		{
			$data = array(
				'email_id' => $this->input->post('user_name'),
				'password' => $this->input->post('admin_password')
			);

			$data =  $this->validate_model->get_delivery_user($data);
			$this->session->set_userdata($data);

			if($data['count'])
			{
				if($this->session->has_userdata('admin_id'))
				{
					$this->load->view('headers/deliveryhub_home_header',$data);
					// $this->load->view('deliveryhub/deliveryhub_home');
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
   public function deliveryhub_home()
    {
        if($this->session->has_userdata('admin_id'))
        {
            $data['user_data'] = $this->select_model->select_user($this->backend_table,$this->user_id);
            $this->load->view('headers/deliveryhub_home_header',$data);
            $this->load->view('deliveryhub/deliveryhub_home');
            $this->load->view('headers/footer');
        }
        else
        {
            $this->error_403();
        }
    }
    //----------------------------Change Password---------------------------------
    // Mounika
       public function change_password()
       {
       if($this->session->userdata('admin_id'))
       {
       $data['delivery_user_data'] = $this->select_model->delivery_admin_id($this->session->userdata('admin_id'));
           $this->load->view('headers/deliveryhub_home_header');
           $this->load->view('deliveryhub/del_change_password',$data);
       $this->load->view('headers/footer');
       }
       else
       {
         $this->error_403();
       }
     }
   // Mounika
     public function edit_profile_data()
       {
        
          $this->form_validation->set_rules('old_password','old_password','required');
          $this->form_validation->set_rules('new_password','new_password','required');
        $this->form_validation->set_rules('renew_pass','renew_pass','required');
       
         if($this->form_validation->run())
          {
        
           $user_data = array(
          "delhub_id" => $this->input->post("delivery_id"),
         "password" => $this->input->post("renew_pass")
       );
      
        //echo json_encode($user_data);
  
        $get_update = $this->update_model->update_deli_change_pass($this->input->post("delivery_id"),$user_data);
        //$get_update = $this->update_model->update_deli_change_pass($this->input->post("delivery_id"),$user_data);
         if($get_update >= 0)
         {
                 echo "<script> alert('Password Changed'); </script>";
                 echo "<script>window.location.href='".base_url()."deliveryhub/change_password/';</script>";
               }
         }
         else
         {
           if($this->session->has_userdata('delivery_id'))
               {
            $kitchen_id = $this->session->userdata("kitchen_id");
                  $admin_id = $this->session->userdata("admin_id");
           
                   // $data['user_data'] = $this->select_model->select_user($this->backend_table,$this->admin_id);
             
                   $data['delivery_user_data'] = $this->select_model->get_kitchen_admin_details($admin_id,$this->input->post("delivery_id"));
                   $this->load->view('headers/deliveryhub_home_header');
                   $this->load->view('deliveryhub/del_change_password',$data);
                   $this->load->view('headers/footer');
               }
               else
               {
                   $this->error_403();
               }
         }
       }
    //-------------------------End Change password ----------------------------
    // ---------------------- Profile Changes-----------------------------------
       public function profile()
       {
         if($this->session->userdata('admin_id'))
         {
                 //echo $this->session->userdata('admin_id');
           $data['delivery_user_data'] = $this->select_model->delivery_admin_id($this->session->userdata('admin_id'));
    
           $this->load->view('headers/deliveryhub_home_header',$data);
           //$get_user_type = base64_decode( $this->uri->segment(3));
          
             $this->load->view('deliveryhub/delivery_user_profile');
          
             //echo "kitchen admin details";
          
           $this->load->view('headers/footer');
         }
         else
         {
           $this->error_403();
         }
       }

       public function edit_user_data()
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
         "delhub_id" => $this->input->post("delivery_id"),
               "first_name" => $this->input->post("first_name"),
           "last_name" => $this->input->post("last_name"),
           "email_id" =>$this->input->post("email_id"),
               "user_name" => $this->input->post("user_name")
           // "password" => $this->input->post("renew_pass")
           );
               $get_update = $this->update_model->update_deli_change_pass($this->input->post("delivery_id"),$user_data);
          if($get_update)
          {
                 echo "<script> alert('user data updated'); </script>";
                 echo "<script>window.location.href='".base_url()."deliveryhub/profile/';</script>";
               }
           }
         else
         {
           if($this->session->has_userdata('admin_id'))
               {
                 $delivery_id = $this->session->userdata("delivery_id");
                  $user_id = $this->session->userdata("admin_id");
           
                   // $data['user_data'] = $this->select_model->select_user($this->backend_table,$this->admin_id);
             
                   $data['delivery_user_data'] = $this->select_model->get_delivery_admin_details($delivery_id,$user_id);
                   $this->load->view('headers/deliveryhub_home_header');
                   $this->load->view('deliveryhub/delivery_user_profile',$data);
                   $this->load->view('headers/footer');
               }
               else
               {
                   $this->error_403();
               }
         }
       }

       public function delivery_profile()
       {
       if($this->session->userdata('delivery_id'))
       {
         $data['delivery_reg_data'] = $this->select_model->delivery_reg_delid($this->session->userdata('delivery_id'));
  
           $this->load->view('headers/deliveryhub_home_header');
           $this->load->view('deliveryhub/delivery_profile',$data);
       $this->load->view('headers/footer');
       }
       else
       {
         $this->error_403();
       }
     }



  public function edit_delivery_data()
  {
  
  $this->form_validation->set_rules('delivery_name','delivery_name','required');
    $this->form_validation->set_rules('delivery_address1','delivery_address1','required');
    $this->form_validation->set_rules('delivery_address2','delivery_address2','required');
    $this->form_validation->set_rules('delivery_address3','delivery_address3','required');
    $this->form_validation->set_rules('state','state','required');
    $this->form_validation->set_rules('city','city','required');
    $this->form_validation->set_rules('zipcode','zipcode','required');

   if($this->form_validation->run())
    {
  
     $delivery_data = array(
       "delhub_id" => $this->input->post("delivery_id"),
   "delhub_name" => $this->input->post("delivery_name"),
       "dh_address1" => $this->input->post("delivery_address1"),
       "dh_address2" => $this->input->post("delivery_address2"),
       "dh_address3" => $this->input->post("delivery_address3"),
       "state" => $this->input->post("state"),
       "city" => $this->input->post("city"),
       "zipcode" => $this->input->post("zipcode")
     );
     
         $get_update = $this->update_model->update_delivery_regprofile($this->input->post("delivery_id"),$delivery_data);
         if($get_update >= 0)
         {
          
           echo "<script> alert('deliveryhub data updated'); </script>";
           echo "<script>window.location.href='".base_url()."deliveryhub/delivery_profile/';</script>";
         }
         
     }
   else
   {
     if($this->session->has_userdata('delivery_id'))
         {
             $id = $this->input->post("delivery_id");
             // $data['user_data'] = $this->select_model->select_user($this->backend_table,$this->admin_id);
       
             $data['delivery_reg_data'] = $this->select_model->delivery_reg_delid($id);
             $this->load->view('headers/deliveryhub_home_header');
             $this->load->view('deliveryhub/delivery_profile',$data);
             $this->load->view('headers/footer');
         }
         else
         {
             $this->error_403();
         }
   }
}
//-------------------------------------end---------------------------------
	public function delivery_employee()
	{
		 if($this->session->has_userdata('admin_id'))
        {

            $data['user_data'] = $this->select_model->select_user($this->backend_table,$this->user_id);
            $data['delhub_id'] = $this->select_model->get_deliveryhub_data();
            $data['delhub_role'] = $this->select_model->get_del_role_master();
      			$this->load->view('headers/deliveryhub_home_header',$data);
      			 $this->load->view('deliveryhub/delivery_employee',$data);
      			$this->load->view('headers/footer'); 
        }
        else
        {
            $this->error_403();
        }
		
	}
	public function delivery_emploee_data()
	{
		   $this->form_validation->set_rules('txtdelhub_id', 'txtdelhub_id', 'required');
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
       $this->form_validation->set_rules('txtlicence', 'txtlicence', 'required');
       $this->form_validation->set_rules('txtvehicle', 'txtvehicle', 'required');
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
		$insert_employee = array(
                "del_id"=>$this->input->post("txtdelhub_id"),
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
                "lic_no"=>$this->input->post("txtlicence"),
                "vehicle_no"=>$this->input->post("txtvehicle"),
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

          $get_count = $this->validate_model->get_del_employee($insert_employee['emp_id']);

          if(!($get_count))
          {
            $get_affected_rows = $this->insert_model->insert_delivery_employee($insert_employee);
            if($get_affected_rows)
            {
                echo "<script> alert('Created Employee'); </script>";
				$this->delivery_employee();
            }
          }
          else
          {
            //$this->create_category("vae");
            echo "<script> alert('Error(VAE): Value Already Exists.'); </script>";
				$this->delivery_employee();
                // $this->create_category();
          }
      }
       else
       {
        $this->delivery_employee();
       }
       
	}
  //18-3-2019 (divya)
    public function view_employee()
    {
    
       if($this->session->has_userdata('admin_id'))
        {

            $data['user_data'] = $this->select_model->select_user($this->backend_table,$this->user_id);
            $data['delivery_user_employee'] = $this->select_model->select_del_employee();
            $this->load->view('headers/deliveryhub_home_header');
              $this->load->view('deliveryhub/delivery_view_employee',$data);
              $this->load->view('headers/footer');
         }
         else
         {
          $this->error_403();
         }
    
    }
     
    public function edit_employee()
    {
    if($this->session->has_userdata('admin_id'))
        {

            $data['user_data'] = $this->select_model->select_user($this->backend_table,$this->user_id);
        $data['delivery_emp_data'] = $this->select_model->select_user("delivery_employee",$this->uri->segment(3));
        //$data['get_role'] = $this->select_model->get_role_master();
         $data['delhub_id'] = $this->select_model->get_deliveryhub_data();
            $data['delhub_role'] = $this->select_model->get_del_role_master();
        $this->load->view('headers/deliveryhub_home_header');
        $this->load->view('deliveryhub/delivery_employee',$data);
        $this->load->view('headers/footer');
       }
        else
        {
         $this->error_403();
       }
    }
    
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
         $this->form_validation->set_rules('txtlicence', 'txtlicence', 'required');
       $this->form_validation->set_rules('txtvehicle', 'txtvehicle', 'required');
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
                "del_id"=>$this->input->post("txtkitchen_id"),
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
                "lic_no"=>$this->input->post("txtlicence"),
                "vehicle_no"=>$this->input->post("txtvehicle"),
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

          $get_update = $this->update_model->update_emp_deliveryhub($this->input->post("id"),$update_employee);
          if($get_update >= 0)
          {
            echo "<script> alert('Employee profile updated'); </script>";
            echo "<script>window.location.href='".base_url()."deliveryhub/view_employee/';</script>";
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
          $data['delivery_emp_data'] = $this->select_model->select_user("delivery_employee",$this->uri->segment(3));
        //$data['get_role'] = $this->select_model->get_role_master();

        $this->load->view('headers/deliveryhub_home_header',$data);
        $this->load->view('deliveryhub/delivery_employee',$data);
        $this->load->view('headers/footer');
       }
       
    }
     //18-03-2019(Divya)
    public function delete_employee()
    {
        $get_affected_rows = $this->delete_model->delete_del_employee($this->uri->segment(3));

        if($get_affected_rows)
        {
           redirect(base_url()."deliveryhub/view_employee",'refresh');
        }
    }

    //------------------------------Grid Master--------------------------------
    //8-04-19
    //create Role Master
    public function create_role($error=NULL,$data_array=NULL)
    {
      if($this->session->has_userdata('admin_id'))
        {
            $data['user_data'] = $this->select_model->select_user($this->backend_table,$this->user_id);
               
           
            
            $this->load->view('headers/deliveryhub_home_header',$data);
             $data['get_role'] = $this->select_model->get_del_role_master();
              if(isset($role_array))
               {
                $data['update'] = 1;
                 $data['id'] = $role_array['id'];
                 $data['role_name'] = $role_array['role_name'];
               }

            //$data['error_handler'] = $error;
            if($error != NULL)
            {
              $data['error'] = "DROLE";
            }
            $this->load->view('masters/role_del_emp',$data);
            $this->load->view('headers/footer');
      }
      else
      {
            $this->error_403();
      }
    }
     //add Grid data  
    function insert_role_data()
    {
      $this->form_validation->set_rules('role_name', 'role_name', 'required');
       if ($this->form_validation->run()) 
       {
          $insert_role = array(
                "role_name"=>$this->input->post("role_name")
          );
           $get_count = $this->validate_model->get_del_role($insert_role['role_name']);


           if(!($get_count))
          {
            $get_affected_rows = $this->insert_model->insert_role_del($insert_role);
            if($get_affected_rows)
            {
                echo "<script> alert('Created Role'); </script>";
                $this->create_role();
            }
          }
          else
          {
            //$this->create_category("vae");
            echo "<script> alert('Error(VAM): Value Already Exists.'); </script>";
            $this->create_role("DROLE");
          }
        } 
       else 
       {
           $this->create_role("Required");
       }

    }

      //update Grid data
     public function update_role()
    {
       if($this->session->has_userdata('admin_id'))
        {
            $data['user_data'] = $this->select_model->select_user($this->backend_table,$this->user_id);
            $data['get_role'] = $this->select_model->get_del_role_master();
        $data["get_value"] = $this->select_model->select_user("delivery_emp_role",$this->uri->segment(3));
          
          $this->load->view('headers/deliveryhub_home_header',$data);
          $this->load->view('masters/role_del_emp',$data);
          $this->load->view('headers/footer');
              

        /*
         *  Update button
         */

        if($this->input->post('role_update') == "role_update")
        {

            $this->form_validation->set_rules('update_role','update_role','required');
            
            if($this->form_validation->run())
            {
                 $get_update = array(
                    "id" => $this->input->post('update_id'),
                    "role_name" => $this->input->post('update_role')
                );

                $get_update_count = $this->update_model->update_del_role_master($get_update);
                if($get_update_count)
                {
                    echo "<script> alert('Updated'); </script>";
                    redirect(base_url()."deliveryhub/update_role/".$this->uri->segment(3),'refresh');
                }

            }
            else
            {
                echo "<script> alert('ERROR(UVE) : Update Value Should Not Be Empty'); </script>";
                redirect(base_url()."deliveryhub/update_role/".$this->uri->segment(3),'refresh');
            }
         
        }
       }
      else
      {
            $this->error_403();
      }
    }
    //delete Grid
     public function delete_role()
      {
            $get_affected_rows = $this->delete_model->delete_role_del($this->uri->segment(3));
            
            if($get_affected_rows)
            {
               redirect(base_url()."deliveryhub/create_role",'refresh');
            }
        }
   //----------------------------End Grid Master-------------------
  //----------------------ORDER Schedule---------------------------
    public function deliveryhub_order()
    {
      if($this->session->has_userdata('admin_id'))
        {
            $data['user_data'] = $this->select_model->select_user($this->backend_table,$this->user_id);
             $data['delivery_user_employee'] = $this->select_model->get_order_delivery();
             $data['del_exe'] = $this->select_model->delivery_exe();
          $this->load->view('headers/deliveryhub_home_header',$data);
          $this->load->view('deliveryhub/deliveryhub_orders',$data);
          $this->load->view('headers/footer');
              
        }
      else
      {
            $this->error_403();
      }
    }
    public function deliveryorder_ajax()
    {
      $insert_order_data = array(

        "kit_id" =>$this->input->post('kit'),
        "product_sku" =>$this->input->post('sku'),
        "product_name" =>$this->input->post('product_name'),
        "quanity" =>$this->input->post('qunatity'),
        "user_id" =>$this->input->post('user_id'),
        "user_table" => $this->input->post('usertable'),
        "order_id" =>$this->input->post('order_id'),
        "row_id" =>$this->input->post('row_id'),
        "emp_id" =>$this->input->post('emp_id'),
        "unique_order_id" => $this->input->post('unique_id'),
        "main_address" => $this->input->post('address'),
        "branch_address" => $this->input->post('braddress'),
        "bundled_flag" => $this->input->post('bundled_flag')
         );
        $insert = $this->insert_model->insert_deliveryhub_exe($insert_order_data);
        if($insert)
        {
            $update_order = $this->update_model->update_delivery_accept($this->input->post('delid'));
            if($update_order)
            {
                echo "success";
            }
        }
    }

    public function orders_receipt_challan()
    {
      if($this->session->has_userdata('admin_id'))
        {
            $data['user_data'] = $this->select_model->select_user($this->backend_table,$this->user_id);
             $data['order_data'] = $this->select_model->get_dc_order();
             
          $this->load->view('headers/deliveryhub_home_header',$data);
          $this->load->view('deliveryhub/delivered_order_rc',$data);
          $this->load->view('headers/footer');
              
        }
      else
      {
            $this->error_403();
      }
    }
   
  //----------------------end Order Schedule-----------------------------------
   public function error_403()
    {
      $this->load->view('404');
      $this->load->view('headers/footer');
    }
	public function logout()
    {
            $this->session->sess_destroy();
            redirect(base_url()."deliveryhub");
	}

}