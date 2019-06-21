
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Update_model extends CI_Model
{

	public function update_user_login($email)
	{
		$this->db->set('active', '1', FALSE);
		$this->db->where('email_id', $email);
		$this->db->update('user_login');

		return $get_affected_rows = $this->db->affected_rows();
	}

	public function update_individual_user_data($id,$data)
	{
		$this->db->where('id', $id);
		$this->db->update('individual_user_registration', $data);

		return $get_affected_rows = $this->db->affected_rows();
	}
/**
 * Update status of superadmin count.
 */
	public function update_superadmin_count()
	{
		$this->db->set('login_count', 'login_count + 1', FALSE);
		$this->db->where('id','1');
		$this->db->update('admin_login_count');

		return $get_affected_rows = $this->db->affected_rows();
	}


	public function update_category_master($get_update)
	{

		$this->db->set("category",(string)$get_update['category']);
		$this->db->where('id',$get_update['id']);
		$this->db->update('category_master');

		return $get_affected_rows = $this->db->affected_rows();
	}


	//28-12-18
	public function update_corporate_user_data($id,$data)
	{
		$this->db->where('id', $id);
		$this->db->update('corporate_user_registration', $data);

		return $get_affected_rows = $this->db->affected_rows();
	}
	public function update_company_data($id,$data)
	{
		$this->db->where('id', $id);
		$this->db->update('company_data', $data);

		return $get_affected_rows = $this->db->affected_rows();

	}
	
	/**
	* PRODUCT UPDATE
	*/
	
	public function update_product_on_id($id,$data)
	{
		//$sql = "UPDATE `product_master` SET kitchen_id ='".$data['kitchen_id']."',product_quantity = product_quantity +".$data['product_updated_quantity'].", `product_name` ='".$data['product_name']."', `product_sku` = '".$data['product_sku']."', `product_price` = '".$data['product_price']."', `meal_type` = '".$data['meal_type']."',`meal_plan` = '".$data['meal_plan']."', `product_category` = '".$data['product_category']."', `product_image` = 'NULL', `is_customizable` = '".$data['is_customizable']."' WHERE `id` = '".$id."'";
    // changes on 2-05-19(divya)
    //$sql = "UPDATE `product_master` SET product_quantity = product_quantity +".$data['product_updated_quantity'].", `product_name` ='".$data['product_name']."', `product_sku` = '".$data['product_sku']."', `product_price` = '".$data['product_price']."', `meal_type` = '".$data['meal_type']."',`meal_plan` = '".$data['meal_plan']."', `product_category` = '".$data['product_category']."', `is_customizable` = '".$data['is_customizable']."' WHERE `id` = '".$id."'";

     $sql = "UPDATE `product_master` SET product_quantity = product_quantity +".$data['product_updated_quantity'].", `product_name` ='".$data['product_name']."', `product_sku` = '".$data['product_sku']."',`product_gst` = '".$data['product_gst']."',`product_sub_total` = '".$data['product_sub_total']."', `product_price` = '".$data['product_price']."', `meal_type` = '".$data['meal_type']."',`meal_plan` = '".$data['meal_plan']."', `product_category` = '".$data['product_category']."', `is_customizable` = '".$data['is_customizable']."' WHERE `id` = '".$id."'";
		
		$this->db->query($sql);
		
		return $get_affected_rows = $this->db->affected_rows();
	}
	//29-1-19
	public function update_images($id,$data)
	{
	$sql = "UPDATE product_image SET image1='".$data['image1']."',image2='".$data['image2']."',image3='".$data['image3']."',image4='".$data['image4']."',image5='".$data['image5']."' WHERE product_sku='".$id."'";

	$this->db->query($sql);
		
		return $get_images_rows = $this->db->affected_rows();
	}

	/**
	*	UPDATE TO CART
	*	==============
	*	Author : Vedavith Ravula.
	* 	Date : 07-02-2019
    // public function update_cart($rowid,$quantity)
  // {
  //  $this->db->set('quantity',$quantity,FALSE);
  //  $this->db->where('rowid', $rowid);
  //  $this->db->update('product_cart');
  //  return $get_affected_rows = $this->db->affected_rows();
  // }
  * ----------------------
  * REFACTOR 1:  17-05-2019
  *-------------------------

	*/


    public function update_cart($unique_order_id,$quantity_type)
    {
       if($quantity_type == "incr")
       {
         $this->db->set('quantity','quantity + 1',FALSE);
       }
       else
       {
         $this->db->set('quantity','quantity - 1',FALSE);
       }
     
      $this->db->set('price','(product_subtotal * quantity)+((product_subtotal * quantity)*(product_gst)/100)', FALSE);
      $this->db->where('unique_order_id', $unique_order_id);
      $this->db->update('product_cart');
      $this->db->last_query();
      return $get_affected_rows = $this->db->affected_rows();
    }


 /**
  *  UPDATE CART CONFIRMATION
  * ==========================
  * AUTHOR : Vedavith Ravula
  * DATE : 28052019
  * ==========================
  //? ON UPDATING CART THE OPTIONAL PRODUCT CART SHOULD ALSO BE UPDATED ?//
  */

 public function update_cart_confirmation($unique_order_id,$quantity_type)
 {
   if($quantity_type == "incr")
   {
     $this->db->set('quantity','quantity + 1',FALSE);
   }
   else
   {
     $this->db->set('quantity','quantity - 1',FALSE);
   }
   $this->db->set('price','(main_product_price * quantity) + optional_product_price', FALSE);
   $this->db->where('unique_order_id', $unique_order_id);
   $this->db->update('cart_confirmation');
   return $get_affected_rows = $this->db->affected_rows();
 }




	//13-2-19(Mounika)
	public function update_kitchen_regprofile($id,$data)
    {
        $this->db->where('k_id',$id);
          $this->db->update('kitchen_register',$data);
          return $affected_rows =  $this->db->affected_rows();
	}
	public function update_kit_ser_profile($id,$data)
    {
        $this->db->where('kitchen_id',$id);
          $this->db->update('kitchen_admin',$data);
          return $affected_rows =  $this->db->affected_rows();
    }
    //7-2-19
	public function update_kitchen_register($id,$data)
	{
		$this->db->where('id',$id);
  		$this->db->update('kitchen_register',$data);
  		return $affected_rows =  $this->db->affected_rows();
  	}
  	//8-2-19
  	public function update_kitchen_admin($id,$data)
  	{
  		$this->db->where('id',$id);
  		$this->db->update('kitchen_admin',$data);
  		return $affected_rows =  $this->db->affected_rows();
  	}
  	//11-2-19
  	public function update_kitchenadmin_login($email,$pwd)
	{
		$this->db->set('status', '1', FALSE);
		$this->db->set('password', $pwd);
		$this->db->where('email_id', $email);
		$this->db->update('kitchen_admin');

		return $get_affected_rows = $this->db->affected_rows();
	}

	
	 //14-2-19(divya)
	 public function update_indiv_login($email,$pwd)
	{
		$this->db->set('active', '1', FALSE);
		$this->db->set('password', $pwd);
		$this->db->where('email_id', $email);
		$this->db->update('user_login');

		return $get_affected_rows = $this->db->affected_rows();
	}
	//18-2-19(divya)
	public function update_corporate_user_login($id,$phone)
	{
		$this->db->set('phone_number',$phone['phone_number']);
		$this->db->where('id', $id);
		$this->db->update('user_login');
		return $get_affected_rows = $this->db->affected_rows();
	}
	//19-2-19(divya)
	public function update_mealplan_master($get_update)
	{

		$this->db->set("meal_plan",$get_update['meal_plan']);
		$this->db->where('id',$get_update['id']);
		$this->db->update('meal_plan_master');

		return $get_affected_rows = $this->db->affected_rows();
	}
	//19-2-19(divya)
	public function update_mealprefer_master($get_update)
	{

		$this->db->set("meal_preference",$get_update['meal_preference']);
		$this->db->where('id',$get_update['id']);
		$this->db->update('meal_preference_master');

		return $get_affected_rows = $this->db->affected_rows();
	}
	//20-2-19(Mounika)

    public function update_emp_profile($id,$data)
    {
        $this->db->where('id',$id);
          $this->db->update('kitchen_employee',$data);
          return $affected_rows =  $this->db->affected_rows();
    }


    //20-2-19(divya)
	public function update_corp_branch($id,$data)
    {
        $this->db->where('id',$id);
        $this->db->update('branch_data',$data);
        return $affected_rows =  $this->db->affected_rows();
    }
    //20-2-19(divya)
	public function update_corp_repres($id,$data)
    {
        $this->db->where('id',$id);
        $this->db->update('corporate_representative',$data);
        return $affected_rows =  $this->db->affected_rows();
    }
    /**
     * Author   :   Mounika Marella
     * Date     :   21022019
     */

     public function update_kitchen_product_master($get_update)
     {
        $this->db->set("product_name",(string)$get_update['product_name']);
        $this->db->where('id',$get_update['id']);
        $this->db->update('kitchen_product_master');

        return $get_affected_rows = $this->db->affected_rows();
     }

     public function update_units_master($get_update)
     {
        $this->db->set("units",(string)$get_update['units']);
        $this->db->where('id',$get_update['id']);
        $this->db->update('units_master');

        return $get_affected_rows = $this->db->affected_rows();
     }
     //21-02-19(Mounika)
    public function update_role_master($get_update)
    {

        $this->db->set("emp_role",(string)$get_update['emp_role']);
        $this->db->where('id',$get_update['id']);
        $this->db->update('emp_role_master');

        return $get_affected_rows = $this->db->affected_rows();
    }
	//25-02-19(Mounika)
    public function update_stock_add($table,$get_stock)
    {
        $this->db->set('product_quantity','product_quantity + '.(int)$get_stock['quantity'],FALSE);
        $this->db->where('product_sku',$get_stock['sku']);
        $this->db->update('insert_inventory_kitchen_'.$table);

        //  $sql="UPDATE insert_inventory_kitchen_$table SET product_quantity=product_quantity+".$get_stock['quantity']." WHERE product_sku = '".$get_stock['sku']."'";
        //  $query = $this->db->query($sql);
        return $get_affected_rows = $this->db->affected_rows();
    }
    //12-06-19(divya)

    public function update_stock_add_primary($get_stock)
    {
        $this->db->set('quantity','quantity - '.(int)$get_stock['quantity'],FALSE);
        $this->db->where('product_sku',$get_stock['product_sku']);
        $this->db->update('primary_product_inventory_insert');
        return $get_affected_rows = $this->db->affected_rows();
    }


     //26-02-19(Mounika)
    public function update_stock_deduct($table,$get_stock)
    {
        $this->db->set('product_quantity','product_quantity - '.(int)$get_stock['quantity'],FALSE);
        $this->db->where('product_sku',$get_stock['sku']);
        $this->db->update('insert_inventory_kitchen_'.$table);

        //  $sql="UPDATE insert_inventory_kitchen_$table SET product_quantity=product_quantity+".$get_stock['quantity']." WHERE product_sku = '".$get_stock['sku']."'";
        //  $query = $this->db->query($sql);
        return $get_affected_rows = $this->db->affected_rows();
    }
    //1-3-19(divya)
	public function update_notification($get_update)
	{

		$this->db->set("message",$get_update['message']);
		$this->db->set("time_stamp",$get_update['time_stamp']);
		$this->db->where('id',$get_update['id']);
		$this->db->update('notifications');

		return $get_affected_rows = $this->db->affected_rows();
	}
	//4-03-19(divya)
	public function update_room_master($get_update)
	{

		$this->db->set("room_name",$get_update['room_name']);
		$this->db->where('id',$get_update['id']);
		$this->db->update('room_master');

		return $get_affected_rows = $this->db->affected_rows();
	}
	//4-03-19(divya)
	public function update_grid_master($get_update)
	{

		$this->db->set("grid_name",$get_update['grid_name']);
		$this->db->where('id',$get_update['id']);
		$this->db->update('grid_master');

		return $get_affected_rows = $this->db->affected_rows();
	}
	//4-03-19(divya)
	public function update_bin_master($get_update)
	{

		$this->db->set("bin_name",$get_update['bin_name']);
		$this->db->where('id',$get_update['id']);
		$this->db->update('bin_master');

		return $get_affected_rows = $this->db->affected_rows();
	}
	//4-03-19(divya)
	public function update_store_master($id,$data)
	{

		$this->db->where('id',$id);
        $this->db->update('store_master',$data);
        return $affected_rows =  $this->db->affected_rows();
	}
	//4-03-19(divya)
	public function update_store_manager($id,$data)
	{
		$this->db->where('id',$id);
        $this->db->update('store_manager',$data);
        return $affected_rows =  $this->db->affected_rows();
	}
	//5-03-19(divya)
	public function update_store_map($id,$data)
	{
		$this->db->where('id',$id);
        $this->db->update('store_mapping',$data);
        return $affected_rows =  $this->db->affected_rows();
	}
	 /*
       *   Author  : Vedavith Ravula
       *   Date    : 04032019
       */
	public function update_dc($id,$data)
    {
        $this->db->where('id',$id);
       $this->db->update('DC_stock',$data);
       return $affected_rows =  $this->db->affected_rows();
   }
   //5-03-19(Mounika)
    public function update_acceptflag($get_update)
    {

        $this->db->set("Accept_flag",1);
        $this->db->where('id',$get_update);
        $this->db->update('DC_stock');

        return $get_affected_rows = $this->db->affected_rows();
    }
/*
       *   Author  : Vedavith Ravula
       *   Date    : 04032019
       */

    public function update_primary_products($id,$data)
    {
        $this->db->where('id',$id);
       $this->db->update('primary_stock_products',$data);
       return $affected_rows =  $this->db->affected_rows();
   }
    
   /**
    * Author  : Vedavith Ravula
    * Data    : 06032019
    */
    public function update_primary_stock($rgb_combo,$quantity)
    {
        $this->db->set('quantity','quantity + '.(int)$quantity,FALSE);
        $this->db->where('rgb_combo',$rgb_combo);
        $this->db->update('primary_product_inventory_insert');
        return $get_affected_rows = $this->db->affected_rows();
    }
    public function remove_primary_stock($rgb_combo,$quantity)
    {
        $this->db->set('quantity','quantity - '.(int)$quantity,FALSE);
        $this->db->where('rgb_combo',$rgb_combo);
        $this->db->update('primary_product_inventory_insert');
        return $get_affected_rows = $this->db->affected_rows();
    }
    public function update_pwd_user($id,$data)
    {
      $this->db->where('email_id',$id);
       $this->db->update('user_login',$data);
       return $affected_rows =  $this->db->affected_rows();
    }
    //21-3-19
     public function update_emp_status($id,$data)
    {
      $this->db->where('id',$id);
       $this->db->update('kitchen_employee',$data);
       return $affected_rows =  $this->db->affected_rows();
    }
    //22-3-19(Mounika)
    public function update_kitchen_attendance($emp_id,$date)
    {
        $this->db->set('attendance_flag','1');
        $this->db->where('employee_id',$emp_id);
        $this->db->where('set_date',$date);
        $this->db->update('kitchen_emp_attendance');
        return $get_affected_rows = $this->db->affected_rows();
    }
    //27-3-19(divya)
    public function update_kitchen_delivery($kit_id,$date,$sku)
    {
        $this->db->set('status','1');
        $this->db->where('kit_id',$kit_id);
        $this->db->where('order_id',$date);
        $this->db->where('product_sku',$sku);
        $this->db->update('delivery_kitchen_order');
        return $get_affected_rows = $this->db->affected_rows();
    }
    //28-03-19
	 public function updateAttendance($id,$flag)
    {

        $this->db->set('attendance_flag',$flag);
        $this->db->where('id',$id);
        
        $this->db->update('kitchen_emp_attendance');
        return $get_affected_rows = $this->db->affected_rows();

    }
    //27-03-19(Mounika)
    public function update_admin_profile($user_data)
    {
        $sql = "UPDATE superadmin_login JOIN admin_details ON superadmin_login.email = admin_details.email SET superadmin_login.user_name = '".$user_data['user_name']."', admin_details.user_name = '".$user_data['user_name']."', superadmin_login.password = '".$user_data['password']."' WHERE superadmin_login.id = ".$user_data['id']."";
        return $query = $this->db->query($sql);

    }
    //2-04-19
     public function update_del_emp_status($id,$data)
    {
      $this->db->where('emp_id',$id);
       $this->db->update('delivery_employee',$data);
       return $affected_rows =  $this->db->affected_rows();
    }

       /**
      *  AUTHOR  :   Vedavith Ravula
      *  DATE    :   22032019
      *  REFACTOR:   01-22032019
      */


    public function get_user_address($user_type,$user_id)
    {
     if($user_type == 'individual')
     {
       $sql = "SELECT address,city,state FROM individual_user_registration WHERE id='".$user_id."'";
       $query = $this->db->query($sql);
       return $query;
     }
     else
     {
       $sql = "SELECT *, cd.company_address AS address, cd.company_city AS city, cd.company_state AS state
       FROM corporate_user_registration AS cur
       LEFT JOIN
       company_data AS cd ON cd.company_name = cur.company_name
       WHERE cur.id='".$user_id."'";
       $query = $this->db->query($sql);
       return $query;
     }
   }

   public function get_company_branch_address($user_type,$user_id)
   {
    $sql = "SELECT bd.branch_address1 AS branch_address1, bd.branch_address2 AS branch_address2, bd.branch_address3 AS branch_address3,bd.branch_city AS branch_city,bd.branch_state AS branch_state
     FROM corporate_user_registration AS cur
     LEFT JOIN
     company_data AS cd ON cd.company_name = cur.company_name
     LEFT JOIN
     branch_data AS bd ON bd.company_name = cd.id
     WHERE cur.id='".$user_id."'";
     $query = $this->db->query($sql);
     return $query;
   }

   /**
    *  AUTHOR : Vedavith Ravula
    *  DATE : 22032019
    *   REFACTOR: 01-22032019
    */

   public function set_flag_product_cart($sku,$rowid,$order_id,$unique_order_id,$user_id)
   {
    $this->db->set('confirm_flag','1');
    $this->db->where('product_sku',$sku);
    $this->db->where('rowid',$rowid);
    $this->db->where('order_id',$order_id);
    $this->db->where('unique_order_id',$unique_order_id);
    $this->db->where('user_id',$user_id);
    $this->db->update('product_cart');
    return $affected_rows = $this->db->affected_rows();
    
   }

   public function set_flag_cart_confirmation($sku,$rowid,$order_id,$unique_order_id,$user_id,$from_date,$to_date)
   {
    $this->db->set('from_date',$from_date);
    $this->db->set('to_date',$to_date);
    $this->db->set('confirm_flag','1');
    $this->db->where('product_sku',$sku);
    $this->db->where('product_id',$rowid);
    $this->db->where('order_id',$order_id);
    $this->db->where('unique_order_id',$unique_order_id);
    $this->db->where('user_id',$user_id);
    $this->db->update('cart_confirmation');
    // echo $this->db->last_query();
    return $affected_rows = $this->db->affected_rows();
   }

  //1-04-19(Divya)
   public function update_emp_deliveryhub($id,$data)
    {
        $this->db->where('id',$id);
          $this->db->update('delivery_employee',$data);
          return $affected_rows =  $this->db->affected_rows();
    }
    public function update_deliveryhub($id,$data)
    {
      $this->db->where('id',$id);
      $this->db->update('deliveryhub_register',$data);
      return $affected_rows = $this->db->affected_rows();
   }
   //05-04-19
   public function update_dlhub_admin($id,$data)
    {
      $this->db->where('id',$id);
      $this->db->update('deliveryhub_admin',$data);
      return $affected_rows = $this->db->affected_rows();
   }
   //05-04-19(divya)
   public function update_delivery($email,$pwd)
  {
    $this->db->set('status', '1', FALSE);
    $this->db->set('password', $pwd);
    $this->db->where('email_id', $email);
    $this->db->update('deliveryhub_admin');

    return $get_affected_rows = $this->db->affected_rows();
  }
  //08-04-19(divya)
  public function update_del_role_master($get_update)
  {

    $this->db->set("role_name",$get_update['role_name']);
    $this->db->where('id',$get_update['id']);
    $this->db->update('delivery_emp_role');

    return $get_affected_rows = $this->db->affected_rows();
  }
  //10-04-19(Mounika)
 public function update_deli_change_pass($id,$data)
   {
       $this->db->where('delhub_id',$id);
         $this->db->update('deliveryhub_admin',$data);
         return $affected_rows =  $this->db->affected_rows();
   }
//12-04-19(Mounika)
   public function update_delivery_regprofile($id,$data)
   {
       $this->db->where('delhub_id',$id);
         $this->db->update('deliveryhub_register',$data);
         return $affected_rows =  $this->db->affected_rows();
    }
    //16-4-19(Divya)
    public function update_delivery_accept($id)
    {
      $this->db->set('accept', '1', FALSE);
      $this->db->where('id', $id);
      $this->db->update('delivery_kitchen_order');
      return $get_affected_rows = $this->db->affected_rows();
    }
     public function update_delivery_received($id)
    {
      $this->db->set('status', '1', FALSE);
      $this->db->where('id', $id);
      $this->db->update('deliveryhub_del_order');
      return $get_affected_rows = $this->db->affected_rows();
    }
    //19-04-2019
    public function update_dc_order($id,$data)
    {
      $this->db->where('dc_id',$id);
      $this->db->update('DC_order',$data);
      return $affected_rows = $this->db->affected_rows();
    }
    /**
    * AUTHOR : VEDAVITH RAVULA
    * DATE : 26042019
    */

   public function update_kitchen_assigned_product($kitchen_id,$product_sku,$estimated_units)
   {
     $this->db->set('estimated_units',$estimated_units);
     $this->db->where('product_sku',$product_sku);
     $this->db->update("insert_kitchen_assign_product_".$kitchen_id);
     return $affected_rows = $this->db->affected_rows();
   }
    /**
   * AUTHOR : VEDAVITH RAVULA
   * DATE : 10052019
   */

    public function update_date_products($data,$bool)
    {
     $sku = $data['product_sku'];
     $quant = $data['quantity'];
     $date = $data['date'];
     if($bool == TRUE)
     {
         $this->db->set($sku, $sku .'-'.(int)$quant,FALSE);
      }
     else
     {
        $this->db->set($sku, $sku .'+'.(int)$quant,FALSE);
     }
     $this->db->where('date',$date);
     $this->db->update("date_products");
     return $affected_rows = $this->db->affected_rows();
    }

   public function update_assigned_product_status($updater)
   {
    $this->db->set('order_flag','1');
    $this->db->where('kitchen_id',$updater['kitchen_id']);
    $this->db->where('product_sku',$updater['product_sku']);
    $this->db->where('date',$updater['date']);
    $this->db->update('kitchen_assigned_products');
    return $affected_rows = $this->db->affected_rows(); 
   }
  //24-05-2019
   public function update_notify($id)
   {
     $this->db->set('notify_flag','1');
     $this->db->where('id',$id);
     $this->db->update('notification_kitchen');
    return $affected_rows = $this->db->affected_rows(); 
   }
    
     //13-06-19
   public function update_date_products_assigned($imploder_string)
   {
     echo $sql = "UPDATE date_products AS dp INNER JOIN assigned_date_products AS adp ON dp.id = adp.id INNER JOIN date_products_json_old AS old SET ".$imploder_string.";";
     $query = $this->db->query($sql);
     return $affected_rows = $this->db->affected_rows();
   }

}



/* End of file Update_model.php */
/* Location: ./application/models/Update_model.php */