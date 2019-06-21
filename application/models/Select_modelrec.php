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
           $query = $this->db->query("SELECT * FROM `company_data`as c,corporate_user_registration as cr where c.`company_name`=cr.`company_name`and cr.id=$id" );
           return $query;

       }
    public function get_products_data()
    {
      //changes in 1-2-19
      $sql = "SELECT pm.id as id, pi.image1 as image,cm.category as category,pm.product_name as name,pm.product_sku as sku,pm.product_price as price, pm.product_quantity as quantity, pm.is_customizable as custom FROM product_master as pm INNER JOIN category_master as cm ON pm.product_category = cm.id INNER JOIN product_image as pi ON pm.product_sku = pi.`product_sku`;";

     $query = $this->db->query($sql);
      return $query;
    }

    public function get_productyes_data()
    {
      $sql="select * from product_master where is_customizable='custom_no'";
      $query=$this->db->query($sql);
      return $query;
    }

    public function fetch_dropdown_prdprice($prdid)
   {
     //echo "<script> alert('hiheee'); </script>";
     $prdid=explode("_",$prdid);
     $id=$prdid['0'];
     $sku=$prdid['1'];
     $prdname=$prdid['2'];
    $this->db->where("id",$id);
    $query=$this->db->get("product_master");
    $output = '<option value="">Select Price</option>';
    foreach($query->result() as $row)
    {
    $price=explode(",",$row->product_price);
    }
    $n=sizeof($price);
    for($i=0;$i<$n;$i++)
    {
     $output .= '<option value="'.$price[$i].'">'.$price[$i].'</option>';
    }
    return $output;
   }
   

    public function get_product_by_id($set_id)
    {
      //$sql = "SELECT pm.id as id, pm.product_image as image, pm.product_name as name, pm.product_category as category,pm.meal_type as meal,pm.product_sku as sku, pm.product_price as price, pm.product_quantity as quantity, pm.is_customizable as custom, cm.customizable_product as custom_product, cm.custom_product_price as custom_product_price FROM product_master as pm LEFT JOIN custom_product_master as cm ON pm.product_category = cm.product_category WHERE pm.id =".$set_id.";";
      //29-1-19 add images
      $sql = "SELECT pm.id as id, pm.product_name as name, pm.product_category as category,pm.meal_type as meal,pm.product_sku as sku, pm.product_price as price, pm.product_quantity as quantity, pm.is_customizable as custom, cm.customizable_product as custom_product, cm.custom_product_price as custom_product_price,pi.image1,pi.image2,pi.image3,pi.image4,pi.image5 FROM product_master as pm LEFT JOIN custom_product_master as cm ON pm.product_category = cm.product_category LEFT JOIN product_image as pi ON pi.product_sku = pm.product_sku where pm.id=".$set_id.";";
      $query = $this->db->query($sql);
      return $query;
    }

    //@TODO: Refactoring Needed with get_products_data() and select_products()

    public function select_all_products()
    {
      $sql = "SELECT pm.id as id, pm.product_image as image, pm.product_name as name,cmm.category as category_name, pm.product_category as category_id,pm.meal_type as meal,pm.product_sku as sku, pm.product_price as price, pm.product_quantity as quantity, pm.is_customizable as custom, cm.customizable_product as custom_product, cm.custom_product_price as custom_product_price FROM product_master as pm LEFT JOIN custom_product_master as cm ON pm.product_category = cm.product_category LEFT JOIN category_master as cmm ON pm.product_category = cmm.id WHERE 1;";
     
      $query = $this->db->query($sql);
      return $query;
    }

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
    //8-2-19
    function kicthen_admin_id($id)
    {
      $query = $this->db->query("SELECT * FROM `kitchen_admin` WHERE id='$id'");
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
    //12-2-19(Mounika)
    function kitchen_admin_id($id)
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


}

/* End of file Select_model.php */
