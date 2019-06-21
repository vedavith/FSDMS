<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Validate_model extends CI_Model
{
	function login_validate($data)
	{
		// echo "SELECT COUNT(*) as count FROM user_registration WHERE email_id = '".$data['email_id']."' AND password = '".$data['password']."'";

		$query = $this->db->query("SELECT COUNT(*) as count FROM user_login WHERE email_id = '".$data['email_id']."' AND password = '".$data['password']."' AND active=1");

		//return $query;
		return $query->row()->count;
	}

	/**
	*	Checks for duplicate individual users
	*/
	function validate_individual_registration($email,$phone_number)
	{
		$query = $this->db->query("SELECT COUNT(*) as count FROM individual_user_registration WHERE email = '".$email."' OR phone_number='".$phone_number."'");

		//return $query;
		return $query->row()->count;
	}

	function validate_company_data($company_name,$gstn)
	{
		$query = $this->db->query("SELECT COUNT(*) AS count FROM company_data WHERE company_name = '".$company_name."' AND company_gstn = '".$gstn."'");
		return $query->row()->count;
	}

	function validate_corporate_user($company_name,$employee_id,$email)
	{
		$query = $this->db->query("SELECT COUNT(*) AS count FROM corporate_user_registration WHERE company_name = '".$company_name."' AND rep_employee_id = '".$employee_id."' AND rep_email_id = '".$email."'");
		return $query->row()->count;
	}

	//check duplicate in user login table

	function check_duplicate_login($data)
	{
		$query = $this->db->query("SELECT COUNT(*) as count FROM user_login WHERE email_id = '".$data."'");
		//return $query;
		return $query->row()->count;
	}


	/**
	*	get id of individual user
	*/

	/*function get_id_individual_user($email)
	{
		$query = $this->db->query("SELECT * FROM individual_user_registration WHERE email='".$email."'");
		$get_row_count = $query->num_rows();
		$data[]=array();
		if($get_row_count == 0)
		{
			return 0;
		}
		else
		{

			 $data['id'] = $query->row()->id;
			 $data['table'] = "individual_user_registration";
			 $data['type'] = "individual";
			 return $data;
		}
	}*/

 		/**
         *	get id of individual user
         *       Author : Vedavith Ravula
         *       Refactor : 1
         *       Date : 19022019
         */
        
        /**
         * 
         * @param type $email
         * @return int
         */

	function get_id_individual_user($email)
	{
		$query = $this->db->query("SELECT * FROM individual_user_registration WHERE email='".$email."'");
		$get_row_count = $query->num_rows();
		$data[]=array();
		if($get_row_count == 0)
		{
			return 0;
		}
		else
		{

			$data['id'] = $query->row()->id;
			$data['table'] = "individual_user_registration";
			$data['type'] = "individual";
			 $data['order_id'] = "OI".date('dmYHis'); 
             $data['admin'] = $query->row()->admin;
			return $data;
		}
	}



	//25-2-19(divya)
	function get_id_corporate_representative($email)
	{
		$query = $this->db->query("SELECT * FROM corporate_representative WHERE rep_email_id='".$email."'");
		$get_row_count = $query->num_rows();

		if($get_row_count == 0)
		{
			return 0;
		}
		else
		{
			$data['id'] = $query->row()->id;
			$data['table'] = "corporate_user_registration";
			$data['type'] = "representative";
			$data['order_id'] = "OI".date('dmYHis'); 
			$data['admin'] = "0";
			return $data;
		}
	}
		

	function get_id_corporate_user($email)
	{
		$query = $this->db->query("SELECT * FROM corporate_user_registration WHERE rep_email_id='".$email."'");
		$get_row_count = $query->num_rows();

		if($get_row_count == 0)
		{
			return 0;
		}
		else
		{
			$data['id'] = $query->row()->id;
			$data['table'] = "corporate_user_registration";
			$data['type'] = "coroporate";
			$data['order_id'] = "OI".date('dmYHis'); 
			$data['company'] = $query->row()->company_name;
            $data['admin'] = $query->row()->admin;
			return $data;
		}
	}




	/**
     * Super Admin Registration
     */

    function get_superadmin_data($admin_data)
    {
        $query = $this->db->query("SELECT COUNT(*) AS count FROM superadmin_login WHERE (email ='".$admin_data['user_name']."' OR user_name ='".$admin_data['user_name']."') AND password='".$admin_data['password']."'");
        return $query->row()->count;
    }

    function get_superuser_details($user_name)
    {
        $query = $this->db->query("SELECT * FROM admin_details WHERE user_name='".$user_name."'");
        $get_row_count = $query->num_rows();

        if($get_row_count == 0)
        {
            return 0;
        }
        else
        {
            $data['admin_id'] = $query->row()->id;
            $data['email_id'] = $query->row()->email;
            $data['backend_table'] = "admin_details";
            return $data;
        }
    }

    public function get_category($value)
    {
    	$query = $this->db->query("SELECT COUNT(*) AS count FROM category_master WHERE category='".$value."'");
    	return $query->row()->count;
    }

		/**
		*	Check for Unique Product
		*/

		public function get_product_master($get_product_sku,$get_product_name)
		{
			$query = $this->db->query("SELECT COUNT(*) AS count FROM product_master WHERE product_sku='".$get_product_sku."' OR product_name='".$get_product_name."'");
			return $query->row()->count;
		}

		// public function get_kitchen_user($kitchen_data)
		// {
		// 	$sql = "SELECT COUNT(*) AS count FROM kitchen_master WHERE email_id='".$kitchen_data['email_id']."' AND password = '".$kitchen_data['password']."'";
		// 	$query = $this->db->query($sql);
		// 	return $query->row()->count;
		// }

		//12-02-18(Mounika)
		/*public function get_kitchen_user($kitchen_data)
		{
			$sql = "SELECT *, COUNT(*) AS count FROM kitchen_admin WHERE (email_id='".$kitchen_data['email_id']."' OR user_name = '".$kitchen_data['email_id']."') AND password = '".$kitchen_data['password']."'";
			$query = $this->db->query($sql);
			
			$data['user_id'] = $query->row()->id;
			$data['kitchen_id'] = $query->row()->kitchen_id;
			$data['kitchen_email_id'] = $query->row()->email_id;
			$data['kitchen_user_name'] = $query->row()->user_name;
			$data['count'] = $query->row()->count;
			
			return $data;
			//return $query->row()->count;
		}*/
			// //12-02-18(Mounika)
   //      //refactored on 21032019
   //      public function get_kitchen_user($kitchen_data)
   //      {
   //          $sql = "SELECT *, COUNT(*) AS count FROM kitchen_admin as ka LEFT JOIN kitchen_register as kr ON kr.k_id = ka.kitchen_id WHERE (ka.email_id='".$kitchen_data['email_id']."' OR ka.user_name = '".$kitchen_data['email_id']."') AND ka.password = '".$kitchen_data['password']."'";
   //          $query = $this->db->query($sql);
            
   //          $data['user_id'] = $query->row()->id;
   //          $data['kitchen_id'] = $query->row()->kitchen_id;
   //          $data['kitchen_type'] = $query->row()->kitchen_type;
   //          $data['kitchen_email_id'] = $query->row()->email_id;
   //          $data['kitchen_user_name'] = $query->row()->user_name;
   //          $data['count'] = $query->row()->count;
            
   //          return $data;
   //          //return $query->row()->count;
   //      }


		/**
		*	VALIDATE ON CART
		*	==============
		*	Author : Vedavith Ravula et,al.
		* 	Date : 07-02-2019
		*  Refactor 1 : 10062019
		*/

		//@TODO : CHECK FOR THE ROWID


  
		 public function check_product_rowid($rowid,$uid)
       {
           //$sql = "SELECT COUNT(*) AS count FROM product_cart WHERE rowid='".$rowid."'";
           $sql = "SELECT COUNT(*) AS count FROM product_cart WHERE rowid='".$rowid."' AND unique_order_id='".$uid."'";
           $query = $this->db->query($sql);
           return $query->row()->count;
        }

		
        //7-2-19
		/**
		* Check for unique kicthen Register
		*/
		public function get_kitchen_register($get_kitchen_id,$get_kitchen_name)
		{
			$query = $this->db->query("SELECT COUNT(*) AS count FROM kitchen_register WHERE k_id='".$get_kitchen_id."' OR k_name='".$get_kitchen_name."'");
			return $query->row()->count;
		}

		//8-2-19
		/**
		* Check for unique kicthen admin
		*/
		public function get_kitchen_admin($get_email,$get_user_name)
		{
			$query = $this->db->query("SELECT COUNT(*) AS count FROM kitchen_admin WHERE email_id='".$get_email."' OR user_name='".$get_user_name."'");
			return $query->row()->count;
		}

		//19-2-19
		//check for unique meal plan
		 public function get_meal_plan($value)
   		 {
    	$query = $this->db->query("SELECT COUNT(*) AS count FROM meal_plan_master WHERE meal_plan='".$value."'");
    	return $query->row()->count;
    	}
    	//19-2-19
		//check for unique meal preference
		 public function get_meal_preference($value)
   		 {
    	$query = $this->db->query("SELECT COUNT(*) AS count FROM meal_preference_master WHERE meal_preference='".$value."'");
    	return $query->row()->count;
    	}
    	//19-02-19(Mounika)
        public function get_employee($value)
        {
            $query = $this->db->query("SELECT COUNT(*) AS count FROM kitchen_employee WHERE emp_id='".$value."'");
            return $query->row()->count;
        }
        //21-02-19(divya)
        public function get_branch($value)
        {
        	 $query = $this->db->query("SELECT COUNT(*) AS count FROM branch_data WHERE branch_name='".$value."'");
            return $query->row()->count;
        }
        //21-02-19(divya)
        public function get_representative($value)
        {
        	$query = $this->db->query("SELECT COUNT(*) AS count FROM corporate_representative WHERE rep_email_id='".$value."'");
            return $query->row()->count;
        }
        /**
         *  AUTHOR  :   Mounika Marella
         *  DATE    :   21022019
         */
        public function get_kitchen_product($value)
       {
           $query = $this->db->query("SELECT COUNT(*) AS count FROM kitchen_product_master WHERE product_name='".$value."'");
           return $query->row()->count;
        }
        
        public function get_units($value)
       {
           $query = $this->db->query("SELECT COUNT(*) AS count FROM units_master WHERE units='".$value."'");
           return $query->row()->count;
       }

		//21-02-19(Mounika)
        public function get_role($value)
        {
            $query = $this->db->query("SELECT COUNT(*) AS count FROM emp_role_master WHERE emp_role='".$value."'");
            return $query->row()->count;
        }
		 /*
		*    AUTHOR         :    MOUNIKA MARELLA
		*    DATE         :   22022019
		*/
        public function check_tables($table_name)
        {
            $sql = "SELECT count(TABLE_NAME) AS count FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_NAME = 'insert_inventory_kitchen_".$table_name."' OR TABLE_NAME = 'update_inventory_kitchen_".$table_name."'";
            $query = $this->db->query($sql);
            return $query->row()->count;
        }


	/*================================================================*
		*                     FUNCTIONS CALLED BY AJAX                      *
	*=================================================================*/
		public function ajaxCallValidateSku($table_name,$product_name,$sku)
			  {
			   
			    $sql = "SELECT COUNT(*) AS count FROM insert_inventory_kitchen_".$table_name." WHERE product_sku='".$sku."' AND product_name='".$product_name."'";
			    $query = $this->db->query($sql);
			    return $query->row()->count;
			  }
		//04-03-19
		//check for unique room name
		 public function get_room($value)
   		 {
    	$query = $this->db->query("SELECT COUNT(*) AS count FROM room_master WHERE room_name='".$value."'");
    	return $query->row()->count;
    	}
    	//04-03-19
		//check for unique Grid name
		 public function get_grid($value)
   		 {
    	$query = $this->db->query("SELECT COUNT(*) AS count FROM grid_master WHERE grid_name='".$value."'");
    	return $query->row()->count;
    	}
    	//04-03-19
		//check for unique Bin name
		 public function get_bin($value)
   		 {
    	$query = $this->db->query("SELECT COUNT(*) AS count FROM bin_master WHERE bin_name='".$value."'");
    	return $query->row()->count;
    	}
    	//04-03-19
		//check for unique Store name
		 public function get_store($value)
   		 {
    	$query = $this->db->query("SELECT COUNT(*) AS count FROM store_master WHERE store_name='".$value."'");
    	return $query->row()->count;
    	}
    	//04-03-19
		//check for unique Store manager
		 public function get_store_manager($value)
   		 {
    	$query = $this->db->query("SELECT COUNT(*) AS count FROM store_manager WHERE emp_id='".$value."'");
    	return $query->row()->count;
    	}
    	//check store-room-grid-bin
    	public function get_srgb($val1,$val2,$val3,$val4)
    	{
    		$query = $this->db->query("SELECT COUNT(*) AS count FROM store_mapping WHERE store='".$val1."'AND room='".$val2."'AND grid='".$val3."' AND bin='".$val4."'");
    		return $query->row()->count;
    	}
    	//06-04-19 (ved)
    	/*================================================================*
		 *                     FUNCTIONS CALLED BY AJAX                   *
	 	*================================================================*/

		public function count_inventory_RGB($store_getter,$RGB_getter)
	        {
	            $sql = "SELECT COUNT(*) AS count FROM primary_product_inventory_insert WHERE store_name = '".$store_getter."' AND rgb_combo = '".$RGB_getter."'";
	            $query = $this->db->query($sql);
	            return $query->row()->count;
	        }
	    public function get_kitchen_product_count($kitchen_inventory,$product_sku)
        {   
            $sql = "SELECT COUNT(*) AS count FROM insert_inventory_kitchen_".$kitchen_inventory." WHERE product_sku = '".$product_sku."'";
            $query = $this->db->query($sql);
            return $query->row()->count;
        }
        // Delivery hub validate login
        //13-3-19
        public function get_delivery_user($kitchen_data)
        {
            $sql = "SELECT *, COUNT(*) AS count FROM deliveryhub_admin WHERE (email_id='".$kitchen_data['email_id']."' OR user_name = '".$kitchen_data['email_id']."') AND password = '".$kitchen_data['password']."'";
            $query = $this->db->query($sql);
            
            $data['admin_id'] = $query->row()->id;
            // $data['kitchen_id'] = $query->row()->kitchen_id;
             $data['delivery_id'] = $query->row()->delhub_id;
			 $data['delivery_email_id'] = $query->row()->email_id;
            $data['delivery_user_name'] = $query->row()->user_name;
            $data['delivery_table'] = "deliveryhub_admin";
            $data['count'] = $query->row()->count;
            
            return $data;
            //return $query->row()->count;
        }
        //14-03-19(Divya)
        public function get_del_employee($value)
        {
            $query = $this->db->query("SELECT COUNT(*) AS count FROM delivery_employee WHERE emp_id='".$value."'");
            return $query->row()->count;
        }
        //22-03-2019(Mounika)
        public function get_date_count_on_attendance($date_count,$kitchen_id)
        {
            $sql = "SELECT COUNT(*) AS count FROM kitchen_emp_attendance WHERE set_date = '".$date_count."' AND kitchen_id = '".$kitchen_id."'";
            $query = $this->db->query($sql);
            return $query->row()->count;
        }
        //28-03-2019(Mounika)
		public function get_kitchen_user($kitchen_data)
        {
            $sql = "SELECT *, COUNT(*) AS count,ka.id as admin_id FROM kitchen_admin as ka LEFT JOIN kitchen_register as kr ON kr.k_id = ka.kitchen_id WHERE (ka.email_id='".$kitchen_data['email_id']."' OR ka.user_name = '".$kitchen_data['email_id']."') AND ka.password = '".$kitchen_data['password']."'";
            $query = $this->db->query($sql);
            
            $data['user_id'] = $query->row()->id;
            $data['admin_id'] = $query->row()->admin_id;
            $data['kitchen_id'] = $query->row()->kitchen_id;
            $data['kitchen_type'] = $query->row()->kitchen_type;
            $data['kitchen_email_id'] = $query->row()->email_id;
            $data['kitchen_user_name'] = $query->row()->user_name;
            $data['count'] = $query->row()->count;
            
            return $data;
            //return $query->row()->count;
        }
        //04-04-19(Divya)
        public function get_deliveryhub($value)
        {
            $query = $this->db->query("SELECT COUNT(*) AS count FROM deliveryhub_register WHERE delhub_id='".$value."'");
            return $query->row()->count;
        }
         //05-04-19(Divya)
        public function get_dlhub_admin($email,$user)
        {
            $query = $this->db->query("SELECT COUNT(*) AS count FROM deliveryhub_admin WHERE email_id='".$email."' OR user_name='".$user."'");
            return $query->row()->count;
        }
        //08-04-19(Divya)
        public function get_del_role($value)
        {
            $query = $this->db->query("SELECT COUNT(*) AS count FROM delivery_emp_role WHERE role_name='".$value."'");
            return $query->row()->count;
        }

        /**
         *  AUTHOR : VEDAVITH RAVULA
         *  DATE : 25042019
         */
        public function assigned_kitchen_product_validator($kitchen_id,$product_sku)
        {
            $sql = "SELECT COUNT(*) as count FROM insert_kitchen_assign_product_".$kitchen_id." WHERE product_sku ='".$product_sku."'";
            $query = $this->db->query($sql);
            return $query->row()->count;
        }



}

/* End of file Validate_model.php */
/* Location: ./application/models/Validate_model.php */
?>
