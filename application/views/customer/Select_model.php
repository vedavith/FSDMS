<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Select_model extends CI_Model
{
    /**
     * First Super Admin Check
     */

     public function select_superadmin_count()
     {
         $query = $this->db->query("SELECT * FROM admin_login_count");
         return $query->row()->login_count;
     }

     public function select_user($backend_table,$id)
     {
        $query = $this->db->query("SELECT * FROM ".$backend_table." WHERE id = ".$id);
        return $query;
     }

    public function get_category_master()
    {
        $query = $this->db->query("SELECT * FROM category_master");
        return $query;
    }
    //28-12-18
       public function select_corporate_user($id)
       {
           $query = $this->db->query("SELECT * FROM `company_data`as c,corporate_user_registration as cr where c.`company_name`=cr.`company_name`and cr.`id`=$id" );
           return $query;

       }
    public function get_products_data()
    {
      //$sql = "SELECT pm.id as id, pm.product_image as image,cm.category as category,pm.product_name as name,pm.product_sku as sku,pm.product_price as price, pm.product_quantity as quantity, pm.is_customizable as custom FROM product_master as pm INNER JOIN category_master as cm ON pm.product_category = cm.id;";
      //changes in 1-2-19
      $sql = "SELECT pm.id as id, pi.image1 as image,cm.category as category,pm.product_name as name,pm.product_sku as sku,pm.product_price as price,pm.meal_plan,pm.meal_type, pm.product_quantity as quantity, pm.is_customizable as custom FROM product_master as pm INNER JOIN category_master as cm ON pm.product_category = cm.id INNER JOIN product_image as pi ON pm.product_sku = pi.`product_sku`;";
      $query = $this->db->query($sql);
      return $query;
    }

    public function get_product_by_id($set_id)
    {
      //$sql = "SELECT pm.id as id, pm.product_image as image, pm.product_name as name, pm.product_category as category,pm.meal_type as meal,pm.product_sku as sku, pm.product_price as price, pm.product_quantity as quantity, pm.is_customizable as custom, cm.customizable_product as custom_product, cm.custom_product_price as custom_product_price FROM product_master as pm LEFT JOIN custom_product_master as cm ON pm.product_category = cm.product_category WHERE pm.id =".$set_id.";";
      
      //$sql = "SELECT pm.kitchen_id,pm.id as id, pm.product_name as name, pm.product_category as category,pm.meal_type as meal,pm.product_sku as sku, pm.product_price as price, pm.product_quantity as quantity, pm.is_customizable as custom,pm.meal_plan, cm.customizable_product as custom_product, cm.custom_product_price as custom_product_price,pi.image1,pi.image2,pi.image3,pi.image4,pi.image5 FROM product_master as pm LEFT JOIN custom_product_master as cm ON cm.product_sku = pm.product_sku LEFT JOIN product_image as pi ON pi.product_sku = pm.product_sku where pm.id=".$set_id.";";
      $sql = "SELECT pm.id as id, pm.product_name as name, pm.product_category as category,pm.meal_type as meal,pm.product_sku as sku, pm.product_price as price, pm.product_quantity as quantity, pm.is_customizable as custom,pm.meal_plan, cm.customizable_product as custom_product, cm.custom_product_price as custom_product_price,pi.image1,pi.image2,pi.image3,pi.image4,pi.image5 FROM product_master as pm LEFT JOIN custom_product_master as cm ON cm.product_sku = pm.product_sku LEFT JOIN product_image as pi ON pi.product_sku = pm.product_sku where pm.id=".$set_id.";";
      $query = $this->db->query($sql);
      return $query;
    }

    //@TODO: Refactoring Needed with get_products_data() and select_products()

    public function select_all_products()
    {
      // $sql = "SELECT pm.id as id, pm.product_image as image, pm.product_name as name,cmm.category as category_name, pm.product_category as category_id,pm.meal_type as meal,pm.product_sku as sku, pm.product_price as price, pm.product_quantity as quantity, pm.is_customizable as custom, cm.customizable_product as custom_product, cm.custom_product_price as custom_product_price FROM product_master as pm LEFT JOIN custom_product_master AS cm ON pm.product_sku = cm.product_sku LEFT JOIN category_master as cmm ON pm.product_category = cmm.id WHERE 1;";
      // $query = $this->db->query($sql);
      // return $query;
      //$sql = "SELECT pm.id as id, pm.product_image as image, pm.product_name as name,cmm.category as category_name, pm.product_category as category_id,pm.meal_type as meal,pm.product_sku as sku, pm.product_price as price, pm.product_quantity as quantity, pm.is_customizable as custom, cm.customizable_product as custom_product, cm.customizable_sku AS custom_sku, cm.custom_product_price as custom_product_price FROM product_master as pm LEFT JOIN custom_product_master AS cm ON pm.product_sku = cm.product_sku LEFT JOIN category_master as cmm ON pm.product_category = cmm.id WHERE 1;";
      $sql ="SELECT
pm.id AS id,
img.image1 AS image,
pm.product_name AS name,
cmm.category AS category_name,
pm.product_category AS category_id,
pm.meal_type AS meal,
pm.product_sku AS sku,
pm.product_price AS price,
pm.product_quantity AS quantity,
pm.is_customizable AS custom,
cm.customizable_product AS custom_product,
cm.customizable_sku AS custom_sku,
cm.custom_product_price AS custom_product_price
FROM
product_master AS pm
LEFT JOIN
custom_product_master AS cm ON pm.product_sku = cm.product_sku
LEFT JOIN
category_master AS cmm ON pm.product_category = cmm.id
   LEFT JOIN
 product_image AS img ON img.product_sku = pm.product_sku
WHERE
1";
$query = $this->db->query($sql);
return $query;
}
     
    //11-3-19(divya)
    function get_password_data($email)
    {
      $query = $this->db->query("SELECT * FROM `user_login` WHERE `email_id`='$email' ");
      return $query;
    }
    //12-2-19(Mounika)
    function kicthen_admin_id($id)
    {
      $query = $this->db->query("SELECT * FROM `kitchen_admin` WHERE id='$id'");
      return $query;
    }
    //Author : Vedavith(13022019)
    function get_kitchen_admin_details($kitchen_id,$user_id)
    {
      $sql = "SELECT * FROM `kitchen_admin` WHERE kitchen_id='".$kitchen_id."' AND id='".$user_id."'";
      $query = $this->db->query($sql);
      return $query;
    }

    //13-2-19(Mounika)
    function kicthen_reg_kitchid($id)
    {
      $query = $this->db->query("SELECT * FROM `kitchen_register` WHERE k_id='$id'");
      return $query;
    }
    /**
   *  PRODUCT SELECT
   * =================
   * Author : Vedavith Ravula
   * Created Date : 08-02-2019
   * --------------------------
   * Author : Vedavith Ravula
   * Refactor-1 : 12-02-2019
   * --------------------------
   * Author : Vedavith Ravula
   * Refactor-2 : 17-05-2019
   * ------------------------
   */

  public function get_product_list_on_user_id($get_user_id,$get_user_type,$set_confirmation)
  {
        
        $set_table = null;

        if($get_user_type == "individual")
        {
          $set_table = "individual_user_registration";
        }
        else
        {
          $set_table = "corporate_user_registration";
        }

        // $sql = "SELECT pc.rowid AS rowid, pc.product_sku AS sku, pc.product_name AS name, pc.price AS price,pc.quantity AS quantity FROM cart_confirmation AS cc LEFT JOIN ".$set_table." AS ipm ON ipm.id = '".$get_user_id."' LEFT JOIN product_cart AS pc ON pc.rowid = cc.product_id WHERE cc.confirm_flag = ".$set_confirmation.";";
        
        // $sql = "SELECT pc.order_id AS order_id, pc.unique_order_id AS unique_order_id, pc.rowid AS rowid, pc.product_sku AS sku, pc.product_name AS name, pc.price AS price,pc.quantity AS quantity FROM cart_confirmation AS cc LEFT JOIN ".$set_table." AS ipm ON ipm.id = '".$get_user_id."' LEFT JOIN product_cart AS pc ON pc.rowid = cc.product_id WHERE cc.confirm_flag = ".$set_confirmation." AND cc.user_id='".$get_user_id."';";
        $sql = "SELECT pc.order_id AS order_id, pc.unique_order_id AS unique_order_id, pc.rowid AS rowid, pc.product_sku AS sku, pc.product_name AS name, pc.price AS price,pc.quantity AS quantity FROM cart_confirmation AS cc LEFT JOIN ".$set_table." AS ipm ON ipm.id = '".$get_user_id."' LEFT JOIN product_cart AS pc ON pc.unique_order_id = cc.unique_order_id WHERE cc.confirm_flag = ".$set_confirmation." AND pc.user_id='".$get_user_id."';";

        $query = $this->db->query($sql);
        return $query;
  }

  public function get_optional_list_on_user_id($get_user_id,$get_user_type,$set_confirmation)
  {
     $set_table = null;

    if($get_user_type == "individual")
    {
      $set_table = "individual_user_registration";
    }
    else
    {
      $set_table = "corporate_user_registration";
    }

    //$sql = "SELECT opc.rowid AS optional_rowid,opc.product_name AS optional_name,opc.price AS optional_price,opc.quantity AS optional_quantity FROM cart_confirmation AS cc LEFT JOIN ".$set_table." AS ipm ON ipm.id = '".$get_user_id."' LEFT JOIN optional_product_cart AS opc ON opc.rowid = cc.product_id WHERE cc.confirm_flag = '".$set_confirmation."';";
    $sql = "SELECT opc.rowid AS optional_rowid,opc.product_name AS optional_name,opc.price AS optional_price,opc.quantity AS optional_quantity FROM cart_confirmation AS cc LEFT JOIN ".$set_table." AS ipm ON ipm.id = '".$get_user_id."' LEFT JOIN optional_product_cart AS opc ON opc.unique_order_id = cc.unique_order_id WHERE cc.confirm_flag = '".$set_confirmation."' AND opc.user_id='".$get_user_id."';";

    $query = $this->db->query($sql);
    return $query;
  }  
  
  
   public function select_product_count_on_id($id)
  {
    $count = array();
    $sql = "SELECT count(*) as count FROM product_cart WHERE user_id='".$id."' AND confirm_flag=0";
    $query = $this->db->query($sql);
    $count['cart_count'] = $query->row()->count;
    return $count;
  }
  

  // public function get_address_on_user_id()
  // {
  //   echo "inside select_user_address_id_function";
  //   return true;
  // }

  //31-1-2019
    function select_custom_prod()
    {
      $query = $this->db->query("SELECT * FROM `product_master` WHERE `is_customizable`= 'custom_no'");
      return $query;
    }
   //7-2-2019 
    function select_kitchen_register()
    {
      $query = $this->db->query("SELECT * FROM kitchen_register");
      return $query;
    }
    //7-2-19
    function kicthen_reg_id($id)
    {
      $query = $this->db->query("SELECT * FROM `kitchen_register` WHERE id='$id'");
      return $query;
    }
   //8-2-19
    function select_kitchen_admin()
    {
       $query = $this->db->query("SELECT * FROM kitchen_admin");
      return $query;
    }
    
    //13-2-19
     function select_individual_customer()
    {
       $query = $this->db->query("SELECT * FROM individual_user_registration");
      return $query;
    }
     //13-2-19
     function select_individual_id($id)
    {
       $query = $this->db->query("SELECT * FROM individual_user_registration WHERE id='$id'");
      return $query;
    }
     //15-2-19(divya)
    function select_corporate_customer()
    {
      $query = $this->db->query("SELECT cr.*,cd.`id` as com_id, cd.`company_name`,cd.`company_telephone`,cd.`company_gstn`,cd.`company_address`,cd.`company_city`,cd.`company_state` FROM `corporate_user_registration` as cr left join company_data as cd on cr.`company_name`= cd.`company_name`");
      return $query;
    }
    //18-2-19
    function select_corporate_id($id)
    {
       $query = $this->db->query("SELECT cr.*,cd.`id` as com_id, cd.`company_name`,cd.`company_telephone`,cd.`company_gstn`,cd.`company_address`,cd.`company_city`,cd.`company_state`,us.`id` as user_id FROM `corporate_user_registration` as cr left join company_data as cd on cr.`company_name`= cd.`company_name` left join user_login as us on us.`email_id` = cr.`rep_email_id` where cr.`rep_email_id`='$id'");
      return $query;
    }
    //19-2-19
     public function get_mealplan_master()
    {
        $query = $this->db->query("SELECT * FROM meal_plan_master");
        return $query;
    }
     //19-2-19
     public function get_mealprefer_master()
    {
        $query = $this->db->query("SELECT * FROM meal_preference_master");
        return $query;
    }  
    //19-2-19(Mounika)
    public function get_employee()
    {
        $query = $this->db->query("SELECT * FROM kitchen_employee");
        return $query;
    }
    //20-2-19(Mounika)
    function kitchen_empid($id)
    {
      $query = $this->db->query("SELECT * FROM `kitchen_employee` WHERE id='$id'");
      return $query;
    }
    //21-02-19(divya)
    function get_corporate_company()
    {
       $query = $this->db->query("SELECT * FROM company_data");
        return $query;
    }
   
    //21-2-19(divya)
    function get_corporate_branch()
    {
      $query = $this->db->query("SELECT cp.company_name as company,br.* FROM branch_data as br left join company_data as cp on br.company_name = cp.id ");
      return $query;
    }
    //21-2-19(divya)
    function get_corporate_repre()
    {
      $query = $this->db->query("SELECT cp.company_name as company,br.branch_name as branch,re.* FROM corporate_representative as re LEFT JOIN branch_data as br on re.branch_name = br.id left join company_data as cp on re.company_name = cp.id");
      return $query;
    }
    //22-02-19 ajax fetch branch details
    function get_ajax_branch($id)
     {
      //$this->db->where("company_name",$id);
      $query=$this->db->query("SELECT id,branch_name FROM `branch_data` WHERE `company_name`='$id'");
      if($query->num_rows() > 0)
        {
            $data_array = array();
            $x = 0;

             //return $query->row();
           // foreach($query->result() as $test)
           // {
           //    $data_array[$x] = $test->branch_name;
           //    $x++;
           // }
           return json_encode($query->result());
        }
        else
        {
             return false;
        }
     }

     //25-2-19
    function fetch_dropdown($id)
     {
      $this->db->where("company_name",$id);
      $query=$this->db->get("branch_data");
      $output = '<option value="">Select Branch</option>';
      //if(empty($query->result()))
     // {
     //   $output = '<option value="0">No Branch</option>';
     // }
      //else
     // {
        foreach($query->result() as $row)
        {
         $output .= '<option value="'.$row->id.'">'.$row->branch_name.'</option>';
        }
     // }
    
      return $output;
     }
     //25-02-19 get representative data
     function get_representative_id($id)
     {
      $query = $this->db->query("SELECT cp.company_name as company,br.branch_name as branch,re.* FROM corporate_representative as re LEFT JOIN branch_data as br on re.branch_name = br.id left join company_data as cp on br.company_name = cp.id where re.id='$id'");
      return $query;
     }
   /**
    *  Author  :   Mounika Marella et.al,
    *  Date    :   21022019
    */
   function get_kitchen_products_master()
   {
    $sql = "SELECT * FROM kitchen_product_master";
    $query = $this->db->query($sql);
    return $query;
   }

   function get_units_master()
   {
    $sql = "SELECT * FROM units_master";
    $query = $this->db->query($sql);
    return $query;
   }
//21-2-19(Mounika)
    public function get_role($id)
    {
       $query = $this->db->query("SELECT * FROM emp_role_master WHERE id = '$id'");
       return $query;
    }
    //21-2-19(Mounika)
   public function get_role_master()
   {
       $query = $this->db->query("SELECT * FROM emp_role_master");
       return $query;
   }
  //21-02-19(mounika)
  public function get_kitchen_data($kitchen_id)
  {
    $sql ="SELECT em.emp_role as role,k.* FROM kitchen_employee as k LEFT JOIN `emp_role_master` as em on k.emp_role = em.id WHERE k.kitchen_id = '$kitchen_id' AND approve = '1' AND status = '0'";
  
    //$query = $this->db->query("SELECT em.emp_role as role,k.* FROM kitchen_employee as k LEFT JOIN `emp_role_master` as em on k.emp_role = em.id");
    $query = $this->db->query($sql);

    return $query;
  }
  
//25-2-19(Mounika)
  public function get_kicthen_stock($table_name)
  {
    $sql = "SELECT * FROM insert_inventory_kitchen_$table_name";
      $query = $this->db->query($sql);
      return $query;
  }
  //27-2-19(divya)
    function get_cor_repres($company)
    { 
      $query = $this->db->query("SELECT cp.company_name as company,br.branch_name as branch,re.* FROM corporate_representative as re LEFT JOIN branch_data as br on re.branch_name = br.id left join company_data as cp on br.company_name = cp.id where cp.company_name = '$company'");

  //$query = $this->db->query("SELECT cp.company_name as company,re.branch_name as branch,re.* FROM corporate_representative as re  left join company_data as cp on re.company_name = cp.id where cp.company_name = '$company'");
      return $query;
    }
     //27-2-19(divya)
    function get_cor_branch($company)
    {
      $query = $this->db->query("SELECT cp.company_name as company,br.* FROM branch_data as br left join company_data as cp on br.company_name = cp.id where cp.company_name = '$company'");
      return $query;
    }
    //27-02-19
   public function ajaxCallGetProducts($table_name)
    {
      $table = $table_name;
      $sql = "SELECT * FROM insert_inventory_kitchen_$table";
      $query = $this->db->query($sql);
      if($query->num_rows() > 0)
      {
        return json_encode($query->result());
      }
    }
     //28-2-19
     public function get_notification()
    {
        $query = $this->db->query("SELECT * FROM notifications");
        return $query;
    }
     //04-03-19
     public function get_room_master()
    {
        $query = $this->db->query("SELECT * FROM room_master");
        return $query;
    } 
    //04-03-19
     public function get_grid_master()
    {
        $query = $this->db->query("SELECT * FROM grid_master");
        return $query;
    } 
    //04-03-19
     public function get_bin_master()
    {
        $query = $this->db->query("SELECT * FROM bin_master");
        return $query;
    } 
    //04-03-19
     public function get_store_master()
    {
        $query = $this->db->query("SELECT * FROM store_master");
        return $query;
    } 
     //04-03-19
     public function get_store_manager()
    {
        $query = $this->db->query("SELECT sm.*,c.company_name,b.branch_name,s.store_name FROM `store_manager` as sm left join company_data as c on sm.company=c.id left join branch_data as b on b.id = sm.branch left join store_master as s on s.id = sm.store ");
        return $query;
    } 
    //04-03-19
     public function get_store_manager_id($id)
    {
        $query = $this->db->query("SELECT sm.*,c.company_name,b.branch_name,s.store_name FROM store_manager as sm left join company_data as c on sm.company=c.id left join branch_data as b on b.id = sm.branch left join store_master as s on s.id = sm.store where sm.id = '$id' ");
        return $query;
    } 
    //05-03-19
    public function get_store_mapping()
    {
      $query = $this->db->query("SELECT sm.*,s.store_name,r.room_name,g.grid_name,b.bin_name FROM store_mapping as sm LEFT JOIN store_master as s on s.id= sm.store LEFT JOIN room_master as r on r.id = sm.room LEFT JOIN grid_master as g on g.id = sm.grid LEFT JOIN bin_master as b on b.id = sm.bin");
       return $query;
    }
     //05-03-19
    public function get_store_mapping_id($id)
    {
      $query = $this->db->query("SELECT sm.*,s.store_name,r.room_name,g.grid_name,b.bin_name FROM store_mapping as sm LEFT JOIN store_master as s on s.id= sm.store LEFT JOIN room_master as r on r.id = sm.room LEFT JOIN grid_master as g on g.id = sm.grid LEFT JOIN bin_master as b on b.id = sm.bin where sm.id='$id'");
       return $query;
    }
    //06-03-2019 (ved)
    public function select_primary_products($id = NULL)
   {
     if($id)
     {
       $sql = "SELECT * FROM primary_stock_products WHERE id='".$id."'";
       $query = $this->db->query($sql);
       return $query;
     }
     else
     {
       $sql = "SELECT * FROM primary_stock_products";
       $query = $this->db->query($sql);
       return $query;
     }
   }

   // public function store_master_get_data()
   // {
   //   $sql = "SELECT * FROM db_fsdms.store_master;";
   //   $query = $this->db->query($sql);
   //   return $query;
   // }

   public function select_grid_combo($get_store)
   {
       $sql = "SELECT
     sm.*, s.store_name, r.room_name, g.grid_name, b.bin_name FROM store_mapping AS sm
         LEFT JOIN
     store_master AS s ON s.id = sm.store
         LEFT JOIN
     room_master AS r ON r.id = sm.room
         LEFT JOIN
     grid_master AS g ON g.id = sm.grid
         LEFT JOIN
     bin_master AS b ON b.id = sm.bin
         WHERE
         s.store_name = '".$get_store."'";
     $query = $this->db->query($sql);
     return $query;
     }
    //06-03-2019 (divya)
    public function select_dc_products($id = NULL)
   {
     if($id)
     {
       //$sql = "SELECT * FROM primary_product_inventory_insert WHERE id='".$id."'";
      $sql = "SELECT sm.*,pm.*, sm.id as grid_add, s.store_name, r.room_name, g.grid_name, b.bin_name FROM store_mapping AS sm LEFT JOIN store_master AS s ON s.id = sm.store LEFT JOIN room_master AS r ON r.id = sm.room LEFT JOIN grid_master AS g ON g.id = sm.grid LEFT JOIN bin_master AS b ON b.id = sm.bin LEFT JOIN primary_product_inventory_insert as pm on pm.rgb_combo = sm.id WHERE pm.id ='".$id."' ";
       $query = $this->db->query($sql);
       return $query;
     }
     else
     {
       //$sql = "SELECT * FROM primary_product_inventory_insert";
      $sql = "SELECT sm.*,pm.*, sm.id as grid_add, s.store_name, r.room_name, g.grid_name, b.bin_name FROM store_mapping AS sm LEFT JOIN store_master AS s ON s.id = sm.store LEFT JOIN room_master AS r ON r.id = sm.room LEFT JOIN grid_master AS g ON g.id = sm.grid LEFT JOIN bin_master AS b ON b.id = sm.bin LEFT JOIN primary_product_inventory_insert as pm on pm.rgb_combo = sm.id";
       $query = $this->db->query($sql);
       return $query;
     }
   }

   public function select_grid_combo_id($get_store)
   {
       $sql = "SELECT
     sm.*, s.store_name, r.room_name, g.grid_name, b.bin_name FROM store_mapping AS sm
         LEFT JOIN
     store_master AS s ON s.id = sm.store
         LEFT JOIN
     room_master AS r ON r.id = sm.room
         LEFT JOIN
     grid_master AS g ON g.id = sm.grid
         LEFT JOIN
     bin_master AS b ON b.id = sm.bin
         WHERE
         sm.id = '".$get_store."'";
     $query = $this->db->query($sql);
     return $query;
     }
     //6-03-19
     function get_dc_data()
     {
       $query = $this->db->query("SELECT sm.*,pm.*,dc.*,dc.id as dc_id, sm.id as grid_add, s.store_name, r.room_name, g.grid_name, b.bin_name FROM store_mapping AS sm LEFT JOIN store_master AS s ON s.id = sm.store LEFT JOIN room_master AS r ON r.id = sm.room LEFT JOIN grid_master AS g ON g.id = sm.grid LEFT JOIN bin_master AS b ON b.id = sm.bin LEFT JOIN primary_product_inventory_insert as pm on pm.rgb_combo = sm.id LEFT JOIN DC_stock as dc on dc.`product_sku`=pm.product_sku where dc.status = '0' ");
       return $query;
    }
    //7-03-19
    function get_dc_data_id($id)
    {
      $query = $this->db->query("SELECT dc.*,sm.*,dc.id as dc_id, s.store_name, r.room_name, g.grid_name, b.bin_name FROM store_mapping AS sm LEFT JOIN store_master AS s ON s.id = sm.store LEFT JOIN room_master AS r ON r.id = sm.room LEFT JOIN grid_master AS g ON g.id = sm.grid LEFT JOIN bin_master AS b ON b.id = sm.bin LEFT JOIN DC_stock as dc on dc.prod_ploc = sm.id WHERE dc.id ='$id'");
      return $query;
    }
    //06-03-19
    public function kitchen_dc($kitchen_id)
    {
      $query = $this->db->query("SELECT * FROM `DC_stock` WHERE accept_flag=0 AND kitchen_id ='".$kitchen_id."'");
      return $query;
    }
    public function select_stock_inventory($store_name)
    {
      $sql = "SELECT
      pi.*,pi.id as prod_id,sm.*, s.store_name, r.room_name, g.grid_name, b.bin_name FROM store_mapping AS sm
      LEFT JOIN
      store_master AS s ON s.id = sm.store
      LEFT JOIN
      room_master AS r ON r.id = sm.room
      LEFT JOIN
      grid_master AS g ON g.id = sm.grid
      LEFT JOIN
      bin_master AS b ON b.id = sm.bin
      LEFT JOIN
      primary_product_inventory_insert as pi ON pi.rgb_combo = sm.id WHERE pi.store_name = '".$store_name."'";
      $query = $this->db->query($sql);
      return $query;
    }
    //8-03-19 
    public function select_rc($k_id)
    {
      $query = $this->db->query("SELECT * FROM `RC_stock` WHERE kitchen_id='".$k_id."'");
      return $query; 
    }
    //18-03-19
    function select_del_product()
    {
      //$query = $this->db->query("SELECT * FROM product_cart WHERE confirm_flag='1'");
        $query = $this->db->query("SELECT product_sku,rowid,order_id,unique_order_id FROM `product_cart` UNION SELECT product_sku,rowid,order_id,unique_order_id from optional_product_cart");
       return $query;
    }
    //19-03-19 
    function select_del_kitchen()
    {
      $query = $this->db->query("SELECT * FROM delivery_kitchen_order");
      return $query;
    }
    function select_del_kitchen_status()
    {
      $query = $this->db->query("SELECT * FROM delivery_kitchen_order where status = 0");
      return $query;
    }

    //22/03/19(Mounika)
     public function get_kitchen_attendance()
     {
         $query = $this->db->query("SELECT * FROM kitchen_employee");
         return $query;
     }
     //22/03/19(Mounika)

     public function get_attendance_data()
     {
         $query = $this->db->query("SELECT * FROM kitchen_emp_attendance WHERE attendance_flag = '0'");
         return $query;
     }
     //23/05/19(Divya)
     public function get_attendance_data_id($kitchen_id)
     {
         $query = $this->db->query("SELECT * FROM kitchen_emp_attendance WHERE attendance_flag = '0' AND kitchen_id = '$kitchen_id'");
         return $query;
     }
    
    //20-03-19
    function select_del($id)
    {
      $query = $this->db->query("SELECT * FROM delivery_kitchen_order WHERE id='$id'");
      return $query;
    }
    //21-03-19
    function get_kitchen_name()
    {
      $query = $this->db->query("SELECT * FROM `kitchen_register` WHERE `kitchen_type`='company'");
      return $query;
    }
    //21-03-19(divya)
    public function get_kitchen_company_emp()
    {
      $query = $this->db->query("SELECT em.emp_role as role,k.*,kr.k_name FROM kitchen_employee as k LEFT JOIN `emp_role_master` as em on k.emp_role = em.id LEFT JOIN `kitchen_register`as kr on k.kitchen_id = kr.k_id  where k.approve = 1 AND k.status = 0");
      return $query;
    }
    //21-03-19(divya)
    public function get_kitchen_approve()
    {
      $query = $this->db->query("SELECT em.emp_role as role,k.*,kr.k_name FROM kitchen_employee as k LEFT JOIN `emp_role_master` as em on k.emp_role = em.id LEFT JOIN `kitchen_register`as kr on k.kitchen_id = kr.k_id  where k.approve = 0 AND k.status=0");
      return $query;
    }
  //ajax fetch emp details
   public function fetch_ajax_productsku($id,$sku)
   {
     //$query = $this->db->query("SELECT `user_id`,`rowid`,`product_sku`,`product_name`,`quantity` FROM `product_cart` where `rowid`='$id' AND `product_sku`='$sku' AND `confirm_flag`=1 UNION SELECT `user_id`,`rowid`,`product_sku`,`product_name`,`quantity`from optional_product_cart where `rowid`='$id' AND `product_sku`='$sku'");
      //$sql = "SELECT `user_id`,`order_id`,`rowid`,`product_sku`,`product_name`,`quantity` FROM `product_cart` where `rowid`='$id' AND `product_sku`='$sku' AND `confirm_flag`=1 UNION SELECT `user_id`,`order_id`,`rowid`,`product_sku`,`product_name`,`quantity`from optional_product_cart where `rowid`='$id' AND `product_sku`='$sku'";
    //25-03-19
     $sql = "SELECT `user_id`,`user_table`,`order_id`,`rowid`,`unique_order_id`,`product_sku`,`product_name`,`quantity`,bundled_flag FROM `product_cart` where `order_id`='$id' AND `product_sku`='$sku' AND `confirm_flag`=1 UNION SELECT `user_id`,`user_table`,`order_id`,`rowid`,`unique_order_id`,`product_sku`,`product_name`,`quantity`,bundled_flag from optional_product_cart where `order_id`='$id' AND `product_sku`='$sku'";
         $query =$this->db->query($sql);
        return $query; 
     }  
     public function get_delivery_data($kid)
     {
        $query = $this->db->query("SELECT * FROM delivery_kitchen_order WHERE status = 0 AND kit_id='".$kid."'");
        return $query;
     }

      //25/03/19(Mounika)

      public function select_kitchen_emp_attendance($kitchen_id,$date)
      {
      $sql = "SELECT * FROM kitchen_emp_attendance WHERE kitchen_id='".$kitchen_id."' AND set_date = '".$date."'";
      return $query = $this->db->query($sql);
      }
      //27/03/19(Mounika)
      public function get_super_id($id,$email)
      {
      $sql = "SELECT * FROM superadmin_login WHERE email ='".$email."'";
      return $query = $this->db->query($sql);
      }


    //TEST
    /**
    * Author : Vedavith Ravula
    * Date : 20032019
    */
    public function get_data_tester()
    {
      echo $sql = "SELECT pc.rowid AS main_rowid,pc.product_name AS main_prod_name,pc.product_sku AS main_sku,opc.rowid AS optional_rowid,opc.product_name AS optional_product_name, opc.product_sku AS optional_sku FROM product_cart AS pc LEFT JOIN optional_product_cart AS opc ON pc.rowid = opc.rowid";
      $query = $this->db->query($sql);
      return $query;
    }


    /**
    * Author : VEDAVITH RAVULA
    * Date : 29022019
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
    * Author : VEDAVITH RAVULA
    * Date : 04-04-2019
    */
      public function select_product_on_sku($get_sku)
   {
   $sql ="SELECT
    pm.id AS id,
    img.image1 AS image1,
    img.image2 AS image2,
    img.image3 AS image3,
    img.image4 AS image4,
    img.image5 AS image5,
    pm.product_name AS name,
    cmm.category AS category_name,
    pm.product_category AS category_id,
    pm.meal_type AS meal,
    pm.product_sku AS sku,
    pm.product_price AS price,
    pm.product_quantity AS quantity,
    pm.is_customizable AS custom,
    cm.customizable_product AS custom_product,
    cm.customizable_sku AS custom_sku,
    cm.custom_product_price AS custom_product_price
FROM
    product_master AS pm
        LEFT JOIN
    custom_product_master AS cm ON pm.product_sku = cm.product_sku
        LEFT JOIN
    category_master AS cmm ON pm.product_category = cmm.id
        LEFT JOIN
    product_image AS img ON img.product_sku = pm.product_sku
WHERE
    pm.product_sku = '".$get_sku."'";
    $query = $this->db->query($sql);
    return $query;
   }


    //2-04-19(divya)
    public function select_del_employee()
      {
         //$query = $this->db->query("SELECT * FROM delivery_employee where approve ='1'");
        $query = $this->db->query("SELECT de.*,dr.role_name,drg.delhub_name FROM `delivery_employee`as de LEFT JOIN delivery_emp_role as dr ON dr.`id`= de.`emp_role` LEFT JOIN deliveryhub_register as drg ON drg.delhub_id = de.del_id WHERE de.`approve`='1'");
      return $query;
      }

    public function get_del_emp_approve()
    {
      $query = $this->db->query("SELECT de.*,dr.role_name,drg.delhub_name FROM `delivery_employee`as de LEFT JOIN delivery_emp_role as dr ON dr.`id`= de.`emp_role` LEFT JOIN deliveryhub_register as drg ON drg.delhub_id = de.del_id WHERE de.approve = 0 AND de.status=0");
      return $query;
    }
    //04-04-2019 (divya)
    public function get_deliveryhub_data()
    {
      $query = $this->db->query("SELECT * FROM deliveryhub_register");
      return $query;
    }
     //04-04-19
    public function select_delhub_id($id)
    {
      $query = $this->db->query("SELECT * FROM deliveryhub_register WHERE id='$id'");
      return $query;
    }
    //05-04-19
    public function get_deliveryhub_admin()
    {
      $query = $this->db->query("SELECT dr.`delhub_name`,da.* FROM deliveryhub_register as dr LEFT JOIN `deliveryhub_admin` as da ON dr.`delhub_id` = da.`delhub_id` where da.`status`='1' ");
      return $query;
    }
     //08-04-19(Divya)
   public function get_del_role_master()
   {
       $query = $this->db->query("SELECT * FROM delivery_emp_role");
       return $query;
   }
   //09-04-19(divya)
   public function get_order_delivery()
   {
     $query = $this->db->query("SELECT dk.*,kr.*,dk.id as del_id,dl.main_address AS main_address,dl.branch_address FROM `delivery_kitchen_order` as dk LEFT JOIN kitchen_register as kr ON kr.k_id = dk.kit_id LEFT JOIN
    delivery_address_confirmed AS dl ON dl.unique_order_id = dk.unique_order_id where dk.accept ='0'");
     return $query;
   }
   //10-04-19(Mounika)
  public function delivery_admin_id($id)
  {
    $query = $this->db->query("SELECT * FROM `deliveryhub_admin` WHERE id='$id'");
    return $query;
  }
//11-04-19(Mounika)
   public function get_delivery_admin_details($admin_id,$user_id)
   {
     $sql = "SELECT * FROM `deliveryhub_admin` WHERE delhub_id='".$admin_id."' AND id='".$user_id."'";
     $query = $this->db->query($sql);
     return $query;
   }
//12-04-19(Mounika)
   public function delivery_reg_delid($id)
   {
     $query = $this->db->query("SELECT * FROM `deliveryhub_register` WHERE delhub_id='$id'");
     return $query;
   }
   //15-04-19 (divya)
   public function delivery_exe()
   {
    $query = $this->db->query("SELECT id,emp_name FROM delivery_employee");
    return $query;
   }
   
/**
   *  PRODUCT COUNT SELECT
   * =================
   * Author : Vedavith Ravula
   * Created Date : 15-04-2019
   * --------------------------
   */

 public function get_product_list_on_user_id_count($get_user_id,$get_user_type,$set_confirmation)
 {
      
       $set_table = null;

       if($get_user_type == "individual")
       {
         $set_table = "individual_user_registration";
       }
       else
       {
         $set_table = "corporate_user_registration";
       }
      
       $sql = "SELECT COUNT(*) AS counter FROM cart_confirmation AS cc LEFT JOIN ".$set_table." AS ipm ON ipm.id = '".$get_user_id."' LEFT JOIN product_cart AS pc ON pc.rowid = cc.product_id WHERE cc.confirm_flag = ".$set_confirmation." AND cc.user_id='".$get_user_id."';";
      
       $query = $this->db->query($sql);

       $data['checkout_counter'] = $query->row()->counter;
       return $data;
   }
   //16-04-19
  public function get_kitchen_delivery($kid)
  {
       $query = $this->db->query("SELECT dk.*,kr.*,dk.id as del_id,de.emp_name FROM `deliveryhub_del_order` as dk LEFT JOIN kitchen_register as kr ON kr.k_id = dk.kit_id LEFT JOIN delivery_employee as de ON de.id = dk.emp_id  where dk.status ='0' and dk.kit_id ='".$kid."'");
       return $query;
  }
  //19-04-19
   public function get_dc_order()
  {
    $query = $this->db->query("SELECT * FROM DC_order");
    return $query;
  }
  public function get_dc_order_id($id)
  {
    $query = $this->db->query("SELECT * FROM DC_order WHERE dc_id ='$id'");
    return $query;
  }
  public function get_orderid()
  {
    $query = $this->db->query("SELECT `order_id` FROM `deliveryhub_del_order` group by`order_id` ");
    return $query;
  }
  public function fetch_product_values($id)
  {
    
// $query1 =$this->db->query("SELECT count(product_name) as count FROM `deliveryhub_del_order` WHERE `order_id`= '$id'"); 
//   $count = $query1->row()->count;
 $query = $this->db->query("SELECT * FROM `deliveryhub_del_order` WHERE `order_id`= '$id' ");

 // $output = '<option value="">Select Branch</option>';

 //  foreach($query->result() as $row)
 //  {

 //   $output .= '<option value="'.$row->id.'">'.$row->product_name.'</option>';
 //  }
  // return $output;
  
    return $query->result(); 
   }
   /**
  *  AUTHOR : VEDAVITH RAVULA
  *  DATE : 25042019
  *  ==========================
  *  Refactor 1 : 21052019
  */

 public function select_product_master($bool_val=NULL)
 {
   $arr = array();
   $sql = "SELECT * FROM product_master ORDER BY product_master.is_customizable DESC ";
   $query = $this->db->query($sql);
   if($bool_val == 1)
   {
    $i = 0;
    foreach($query->result() as $row)
    {
      $arr[$i] = $row->product_sku;
      $i++;
    }
    return $arr;
   }
   else
   {
    return $query;
   }
 }

 public function get_ajax_product_name($product_sku)
 {
   //$sql = "SELECT * FROM product_master WHERE product_sku = '".$product_sku."'";
   $sql = "SELECT pm.product_name as product_name, cp.customizable_product as custom_product,cp.customizable_sku as customize_sku  FROM `product_master` as pm Left join custom_product_master as cp on pm.`product_sku`= cp.`product_sku` WHERE pm.`product_sku` ='".$product_sku."' ";
   $query = $this->db->query($sql);
   //return $query->row()->product_name;
   return $query;
 }
 /**
  * AUTHOR : VEDAVITH RAVULA
  * DATE : 26042019
  */
 public function select_assigned_kitchen_products($kitchen_id)
 {
   $sql = "SELECT * FROM insert_kitchen_assign_product_".$kitchen_id;
   return $query = $this->db->query($sql);
 }

public function get_count_primary($product_sku)
{
  $sql = "SELECT * FROM cart_confirmation WHERE product_sku = '".$product_sku."';";
  $query = $this->db->query($sql);
  return $query;
  // $quantity_count = 0;
  // foreach($query->result() as $row)
  // {
  //   (integer)$quantity_count = $row->quantity;
  // }
  // return $quantity_count;
}

public function get_count_optional($product_sku)
{
  //$sql = "SELECT * FROM optional_product_cart WHERE product_sku = '".$product_sku."';";
  $sql ="SELECT *,op.`quantity` as opt_quantity FROM `cart_confirmation`as cc LEFT JOIN optional_product_cart as op on cc.`unique_order_id`= op.`unique_order_id` WHERE op.`product_sku`='".$product_sku."'; ";

  $query = $this->db->query($sql);
  return $query;
  //  $quantity_count = 0;
  // foreach($query->result() as $row)
  // {
  //   $explode_quant = explode("<br>",$row->quantity);
  //   $quantity_count = $quantity_count + $explode_quant[0];
  // }

  // return $quantity_count;

}
//08-05-19
public function select_products_dates()
{
   $query = $this->db->query("SELECT * FROM date_products");
    return $query;
}


 //09-05-19
    function fetch_product_sku($id)
     {
      
      $query=$this->db->query("SELECT * FROM insert_kitchen_assign_product_".$id."");
      // $output = '<option value="">Select product sku</option>';
      
      //   foreach($query->result() as $row)
      //   {
      //    $output .= '<option value="'.$row->id.'">'.$row->product_sku.'</option>';
      //   }
     
    
      // return $output;
      return $query;
     }
     
     
    // ! DEPRECATED
    //  /**
    //  * AUTHOR : VEDAVITH RAVULA
    //  * DATE : 10052019
    //  */
    //  function fetch_product_quantity($sku,$date)
    //  {
    //   $sql = "SELECT ".$sku." as quantity FROM date_products where date='".$date."'";
    //   $query = $this->db->query($sql);
    //   if(!empty($query->row()))
    //   {
    //   return $query->row()->quantity;
    //   }
    //   else
    //   {
    //     return "Please, Select valid date";
    //   }
    //  }
     
     
    /**
     * AUTHOR : VEDAVITH RAVULA
     * DATE : 10052019
     * -------------------------
     * Refactor 1 : 02062019
     * -------------------------
     * * Added $from_date and $to_date to the function. *
     * * Changed the query - Added between constraint   *
     * -------------------------
     */

     function fetch_product_quantity($sku,$from_date,$to_date)
     {
      $sql = "SELECT ".$sku." AS quantity,date as dates FROM date_products WHERE date BETWEEN '".$from_date."' AND '".$to_date."';";
      $query = $this->db->query($sql);
      if(!empty($query->row()))
      {
        return $query;
      }
      else
      {
        return "Please, Select valid date";
      }
     }

     // divya
     public function fetch_assign_product($data)
     {
       $sql = "SELECT * FROM kitchen_assigned_products WHERE kitchen_id='".$data."' ";
       $query = $this->db->query($sql);
       return $query;
     }

     /**
       * AUTHOR : VEDAVITH RAVULA
       * DATE : 13052019
       */
       public function select_assigned_count($kitchen_id)
       {
            //$sql = "SELECT product_sku AS sku, SUM(assigned_orders) AS sum, date AS assigned_date FROM kitchen_assigned_products WHERE kitchen_id = '".$kitchen_id."' AND  order_flag = 0 group by date";

          //31-5-2019
             $sql = "SELECT product_sku AS sku, sum(assigned_orders) AS sum, date AS assigned_date FROM kitchen_assigned_products WHERE kitchen_id = '".$kitchen_id."' AND  order_flag = 0 AND date='".date('Y-m-d')."' GROUP BY product_sku,date";
            $query = $this->db->query($sql);
            return $query;  
       }

       //16-05-2019 divya
       public function fetch_product_orders($kit,$date)
       {
        $sql ="SELECT sum(assigned_orders) as count,product_sku,kitchen_id,date,time_stamp FROM kitchen_assigned_products WHERE kitchen_id='".$kit."' and date='".$date."' GROUP BY product_sku ";
        $query = $this->db->query($sql);
        return $query;
       }  
       /**
       *  PRODUCT SELECT
       * =================
       * Author : Vedavith Ravula
       * Created Date : 17-05-2019
      
       */
       public function proc_call_cart_prod_on_id($user_id)
        {
          $sql1 = " DROP VIEW product_concat";
          $sql2 = "CALL select_cart_products(".$user_id .");";
          $this->db->trans_start();
          $this->db->query($sql1);
          $query = $this->db->query($sql2);
          $this->db->trans_complete();
          return $query;
        }

      //21-05-19 divya
      public function select_kitchen_current_data()
      {
         $sql ="SELECT * FROM `kitchen_assigned_products` WHERE `date`=CURRENT_DATE and order_flag = 1  ";
        $query = $this->db->query($sql);
        return $query;

      }
       //22-05-19 (divya)
      public function fetch_kitchen_notification($id)
      { 
          $sql ="SELECT count(message) as sum FROM notification_kitchen WHERE kitchen_id = '".$id."' AND notify_flag='0'";
          $query = $this->db->query($sql);
          $count =0;
          foreach($query->result() as $row)
          {
            $count = $row->sum;
          }
          return $count;
      }
       public function fetch_kitchen_notification_message($id)
      {
          $sql ="SELECT * FROM notification_kitchen WHERE kitchen_id = '".$id."' AND notify_flag ='0' and kit_flag='0'";
          $query = $this->db->query($sql);
          return $query;
      }
      public function receive_kitchen_notification_message($id)
      {
          $sql ="SELECT * FROM notification_kitchen WHERE kitchen_id = '".$id."' AND notify_flag ='0' and kit_flag='send'";
          $query = $this->db->query($sql);
          return $query;
      }
      // //28-05-19
      // public function orderid_select($sku)
      // {
      //   $order = array();
      // $sql = "SELECT unique_order_id from cart_confirmation WHERE product_sku = '".$sku."'";
      //   $query = $this->db->query($sql);
      //     if(!empty($query->result()))
      //     {
      //       $i=0;
      //       foreach($query->result() as $row)
      //     {
            
      //        $order[$i]= $row->unique_order_id;
      //        $i++;
      //     }

      //     }
      //     return $order;
      // }


    //31-5-2019 ved
    public function select_kitchen_assigned_data($products,$date)
     {
       $product_array = array();

       $this->db->trans_start();
       for($i = 0; $i < count($products); $i++)
       {
         $sql = "SELECT * FROM kitchen_assigned_products WHERE product_sku = '".$products[$i]."' AND date ='".$date."'";
         $query = $this->db->query($sql);
         $j = 0;
         foreach($query->result() as $row)
         {
           $product_array[$products[$i]][$j] = $row;
           $j++;
         }
       }
       $this->db->trans_complete();

       return json_encode($product_array);
     }
       /**
      * AUTHOR : VEDAVITH RAVULA
      * DATE : 04062019
      * -------------------------
      */

     public function select_order_id($user_id)
     {
       $sql = "SELECT * FROM cart_confirmation WHERE user_id = '".$user_id."' GROUP BY order_id";
       $query = $this->db->query($sql);
       return $query;
     }

     public function get_orders_order_id($setOrderId)
     {
       $data_array = array();

       $sql = "select
       cart_confirmation.product_sku as `sku`,
       cart_confirmation.price as `price`,
       cart_confirmation.quantity as `quantity`,
       optional_product_cart.unique_order_id as `unique_order_id`,
       GROUP_CONCAT(optional_product_cart.product_sku) as `optional_sku`,
       GROUP_CONCAT(optional_product_cart.product_name) as `optional_name`,
       GROUP_CONCAT(optional_product_cart.quantity) as `optional_quantity`
     from
       cart_confirmation,
       optional_product_cart
     where
       cart_confirmation.unique_order_id = optional_product_cart.unique_order_id and cart_confirmation.order_id = '".$setOrderId."'
     group by
       cart_confirmation.id;";
       $x = 0;
       $query = $this->db->query($sql);
       foreach($query->result() as $row)
       {
         $data_array[$x] = $row;
         $x++;
       }
       return json_encode($data_array);
     }

     
}

/* End of file Select_model.php */
