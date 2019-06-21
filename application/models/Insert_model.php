	<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Insert_model extends CI_Model
	{
		public function insert_individual_details($data)
		{
			$this->db->insert('individual_user_registration', $data);
			return $affected_rows =  $this->db->affected_rows();
		}
		public function insert_login_details($login_data)
		{
			$this->db->insert('user_login', $login_data);
			return $affected = $this->db->affected_rows();
		}

		public function insert_company_data($company_data)
		{
			$this->db->insert('company_data',$company_data);
			return $affected = $this->db->affected_rows();
		}

		public function insert_corporate_user($representative_data)
		{
			$this->db->insert('corporate_user_registration',$representative_data);
			return $affected = $this->db->affected_rows();
		}

		/**
		 *   SUPER ADMIN INSERTS
		 */

		public function insert_admin_data($insert_admin_data)
		{
			$this->db->insert('admin_details', $insert_admin_data);
			return $affected = $this->db->affected_rows();
		}

		public function insert_superadmin($insert_admin_login)
		{
			 $this->db->insert('superadmin_login',$insert_admin_login);
			 return $affected = $this->db->affected_rows();
		}

		public function insert_product_category($insert_product_category)
		{
			$this->db->insert('category_master',$insert_product_category);
			return $affected = $this->db->affected_rows();
		}

		/**
		 *	PRODUCT INSERT
		 */

		 public function create_insert_product($insert_created_product)
		 {
			 $this->db->insert('product_master',$insert_created_product);
			 return $affected = $this->db->affected_rows();
		 }

		 public function create_customizable_product($get_customizable_product)
		 {
			 $this->db->insert('custom_product_master',$get_customizable_product);
			 return $affected = $this->db->affected_rows();
		 }

		public function insert_product_update($get_product_update)
		{
			$this->db->insert('product_update',$get_product_update);
			return $affected = $this->db->affected_rows();
		}
		//29-1-19
		public function insert_product_image($get_images)
		{
			$this->db->insert('product_image',$get_images);
			return $affected = $this->db->affected_rows();
		}

		/**
		*	INSERT TO CART
		*	==============
		*	Author : Vedavith Ravula et,al.
		* 	Date : 07-02-2019
		*/

		public function add_product($get_products)
		{
			$this->db->insert('product_cart',$get_products);
			return $affected = $this->db->affected_rows();
		}

		public function add_optional_product($get_optional_products)
		{
			$this->db->insert('optional_product_cart',$get_optional_products);
			return $affected = $this->db->affected_rows();
		}

		public function set_confirm_cart($set_for_confirmation)
		{
			$this->db->insert('cart_confirmation',$set_for_confirmation);
			return $affected = $this->db->affected_rows();
		}
		
		//7-2-19
		public function insert_kitchen($get_data)
		{
			$this->db->insert('kitchen_register',$get_data);
			return $affected = $this->db->affected_rows();
		}
		//8-2-19
		public function insert_kitchen_admin($get_data)
		{
			$this->db->insert('kitchen_admin',$get_data);
			return $affected = $this->db->affected_rows();
		}
		//19-2-19
		public function insert_meal_plan($get_data)
		{
			$this->db->insert('meal_plan_master',$get_data);
			return $affected = $this->db->affected_rows();
		}
		//19-2-19
		public function insert_meal_prefer($get_data)
		{
			$this->db->insert('meal_preference_master',$get_data);
			return $affected = $this->db->affected_rows();
		}
		//20-2-19(mounika)
		public function insert_kitchen_employee($insert_kitchen_employee)
        {
            $this->db->insert('kitchen_employee',$insert_kitchen_employee);
            return $affected = $this->db->affected_rows();
        }
        //21-2-19(divya)
        public function insert_corporate_branch($insert_branch)
        {
        	 $this->db->insert('branch_data',$insert_branch);
            return $affected = $this->db->affected_rows();
        }
        //21-02-19(divya)
        public function insert_corp_representative($insert_repre)
        {
        	$this->db->insert('corporate_representative',$insert_repre);
        	return $affected = $this->db->affected_rows();
        }
       /**
         * Author   :   Mounika Marella
         * Date     :   21202019
         */

         public function insert_kitchen_product($insert_kitchen_product)
         {            $this->db->insert('kitchen_product_master',$insert_kitchen_product);
            return $affected = $this->db->affected_rows();
         }

         public function insert_units($insert_units)
         {
            $this->db->insert('units_master',$insert_units);
            return $affected = $this->db->affected_rows();
         }
         //21-02-19(Mounika)
        public function insert_emp_role($insert_emp_role)
        {
            $this->db->insert('emp_role_master',$insert_emp_role);
            return $affected = $this->db->affected_rows();
        }
        
       
         /**
         *  Author : Mounika Marella
         *  Date : 22022019
         */

        public function kitchen_inventory_insert($table,$insert_kitchen_inventory)
        {
            $this->db->insert('insert_inventory_kitchen_'.$table,$insert_kitchen_inventory);
           return $affected = $this->db->affected_rows();
        }
        /**
         *  Author : Mounika Marella
         *  Date : 22022019
         */
        public function kitchen_inventory_update($table,$update_kitchen_inventory)
        {
            $this->db->insert('update_inventory_kitchen_'.$table,$update_kitchen_inventory);
           return $affected = $this->db->affected_rows();
        }
        //26-02-19(Mounika)
        public function kitchen_inventory_update_deduct($table,$update_kitchen_inventory)
        {
            $this->db->insert('update_inventory_kitchen_'.$table,$update_kitchen_inventory);
           return $affected = $this->db->affected_rows();
        }
        //28-02-19(divya)
        public function notification($data)
        {
        	$this->db->insert("notifications",$data);
        	return $affected = $this->db->affected_rows();
        }
        //4-03-2019 (divya)
        public function insert_room($data)
        {
        	$this->db->insert("room_master",$data);
        	return $affected = $this->db->affected_rows();
        } 
        //4-03-2019 (divya)
        public function insert_grid($data)
        {
        	$this->db->insert("grid_master",$data);
        	return $affected = $this->db->affected_rows();
        }
         //4-03-2019 (divya)
        public function insert_bin($data)
        {
        	$this->db->insert("bin_master",$data);
        	return $affected = $this->db->affected_rows();
        }
         //4-03-2019 (divya)
        public function insert_store($data)
        {
        	$this->db->insert("store_master",$data);
        	return $affected = $this->db->affected_rows();
        }
         //4-03-2019 (divya)
        public function insert_store_manager($data)
        {
        	$this->db->insert("store_manager",$data);
        	return $affected = $this->db->affected_rows();
        }
        //5-03-2019(divya)
        public function insert_store_mapping($data)
        {
        	$this->db->insert("store_mapping",$data);
        	return $affected = $this->db->affected_rows();
        }
        /*
       *   Author  : Vedavith Ravula
       *   Date    : 04032019
       */

       public function insert_create_primary_stock($get_values)
       {
            $this->db->insert('primary_stock_products',$get_values);
          return $affected = $this->db->affected_rows();
       }
       //06-03-19 (divya)
       public function insert_dc_value($get_values)
       {
            $this->db->insert('DC_stock',$get_values);
          return $affected = $this->db->affected_rows();
       }

            //5-03-19(Mounika)
        public function insert_RC($insert_rc)
        {
           $this->db->insert('RC_stock',$insert_rc);
           return $affected = $this->db->affected_rows();
        }
              /*
           *   Author  : Vedavith Ravula
           *   Date    : 06032019
           */
        public function insert_primary_stock_qunatity($get_insert)
        {
          $this->db->insert('primary_product_inventory_insert',$get_insert);
          return $affected = $this->db->affected_rows();
        }


        public function update_insert_primary_quantity($get_update_insert)
        {
          $this->db->insert('primary_product_inventory_update',$get_update_insert);
          return $affected = $this->db->affected_rows();
        }

        public function remove_insert_primary_quantity($get_remove_insert)
        {
        $this->db->insert('primary_product_inventory_update',$get_remove_insert);
        return $affected = $this->db->affected_rows();
        }
        //13-3-19(mounika)
        public function insert_delivery_employee($insert_delivery_employee)
        {
            $this->db->insert('delivery_employee',$insert_delivery_employee);
            return $affected = $this->db->affected_rows();
        }
        //28-02-19(divya)
        public function del_kitchen($data)
        {
            $this->db->insert("delivery_kitchen_order",$data);
            return $affected = $this->db->affected_rows();
        }
    	//22-03-19(Mounika)

        public function insert_attendance_data($get_attendance)
        {
        $this->db->insert('kitchen_emp_attendance',$get_attendance);
        return $affected = $this->db->affected_rows();
        }

        /*
        *   AUTHOR : VEDAVITH RAVULA
        *   DATE : 29032019
        */

        public function insert_address($set_address)
        {
            $this->db->insert('delivery_address_confirmed',$set_address);
            return $affected = $this->db->affected_rows();
        }

        //04-04-2019 (divya)
        public function insert_deliveryhub($data)
        {
            $this->db->insert('deliveryhub_register',$data);
            return $affected = $this->db->affected_rows();
        }
        //05-04-2019 (divya)
        public function insert_dlhub_admin($data)
        {
            $this->db->insert('deliveryhub_admin',$data);
            return $affected = $this->db->affected_rows();
        }
         //08-04-2019 (divya)
        public function insert_role_del($data)
        {
            $this->db->insert('delivery_emp_role',$data);
            return $affected = $this->db->affected_rows();
        }
         //16-04-2019 (divya)
        public function insert_deliveryhub_exe($data)
        {
            $this->db->insert('deliveryhub_del_order',$data);
            return $affected = $this->db->affected_rows();
        }
        //18-04-19
        public function insert_delivery_order($data)
        {
            $this->db->insert('DC_order',$data);
            return $affected = $this->db->affected_rows();
        }

         /**
        *  AUTHOR : VEDAVITH RAVULA
        *  DATE : 25042019
        */

        public function insert_assigned_kitchen_products($kitchen_id,$assigned_product_array)
        {
               $this->db->insert('insert_kitchen_assign_product_'.$kitchen_id,$assigned_product_array);
               return $affected = $this->db->affected_rows();
        }
          /**
        *  AUTHOR : VEDAVITH RAVULA
        *  DATE : 25042019
        */
        public function insert_date_products($data)
       {
           $this->db->insert('date_products',$data);
           return $affected = $this->db->affected_rows();
       }
       /**
       * AUTHOR : VEDAVITH RAVULA
       * DATE : 10052019
       */

       public function insert_kitchen_assigned_products($data)
       {
           $this->db->insert('kitchen_assigned_products',$data);
           return $affected = $this->db->affected_rows();
       }
       
       //23-05-2019 divya
       public function insert_kitchen_notification($data)
       {
            $this->db->insert('notification_kitchen',$data);
            return $affected = $this->db->affected_rows();
       }
       //13-06-19 

       public function insert_old_data($data)
       {
        $this->db->insert('assigned_date_products',$data);
        return $affected = $this->db->affected_rows();
       }
       //19-06-19 
       public function insert_date_products_old($data)
       {
           $this->db->insert('date_products_json_old',$data);
           return $affected = $this->db->affected_rows();
       }


    }

	/* End of file Insert_model.php */
	/* Location: ./application/models/Insert_model.php */
