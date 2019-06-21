<?php 

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Create_model extends CI_Model
{
	
	public function __construct()
	{
                parent::__construct();
                $this->load->dbforge();
	}

public function create_inventory_tables($table_name)
        {

                $fields = array(
                        array(
       'id' => array(
               'type' => 'INT',
               'constraint' => 11,
               'unsigned' => TRUE,
               'auto_increment' => TRUE
       ),
       'product_name' => array(
               'type' => 'VARCHAR',
               'constraint' => '100',
               'default' => 'NULL'
       ),
        'product_sku' => array(
               'type' => 'VARCHAR',
               'constraint' => '100',
               'default' => 'NULL'
       ),
       'product_units' => array(
               'type' =>'VARCHAR',
               'constraint' => '100',
               'default' => 'NULL',
       ),
       'product_quantity' => array(
               'type' => 'TEXT',
               'null' => TRUE,
       )
   ),
                        array(
       'id' => array(
               'type' => 'INT',
               'constraint' => 11,
               'unsigned' => TRUE,
               'auto_increment' => TRUE
       ),
       'product_name' => array(
               'type' => 'VARCHAR',
               'constraint' => '100',
               'default' => 'NULL'
       ),
        'product_sku' => array(
               'type' => 'VARCHAR',
               'constraint' => '100',
               'default' => 'NULL'
       ),
       'product_units' => array(
               'type' =>'VARCHAR',
               'constraint' => '100',
               'default' => 'NULL'
       ),
       'product_quantity' => array(
               'type' => 'VARCHAR',
               'constraint' => '100',
               'default' => 'NULL'
       ),
       'addordel' => array(
               'type' => 'VARCHAR',
               'constraint' => '100',
       )

   )
);

               $table_names = array("insert_inventory_kitchen_","update_inventory_kitchen_");

                $get_value = null;

                for($i = 0; $i < count($table_names); $i++)
                {
                        $this->dbforge->add_field($fields[$i]);
                        $this->dbforge->add_field("timestamp timestamp(6) NULL  DEFAULT CURRENT_TIMESTAMP(6)");
                        $this->dbforge->add_key('id', TRUE);
                        $get_value = $this->dbforge->create_table($table_names[$i].$table_name, FALSE);
               }
       // CHANGE FROM HERE                
       //CREATING THE insert_kitchen_assign_product table
       $field_data = array(
               'id' => array(
                       'type' => 'INT',
                       'constraint' => 11,
                       'unsigned' => TRUE,
                       'auto_increment' => TRUE
               ),
               'product_name' => array(
                       'type' => 'VARCHAR',
                       'constraint' => '100',
                       'default' => 'NULL'
               ),
                'product_sku' => array(
                       'type' => 'VARCHAR',
                       'constraint' => '100',
                       'default' => 'NULL'
               ),
                'bundled_flag' => array(
                       'type' => 'VARCHAR',
                       'constraint' => '225',
                       'default' => 'NULL'
               ),
               'estimated_units' => array(
                       'type' =>'VARCHAR',
                       'constraint' => '100',
                       'default' => 'NULL',
               )
       );      

                        $this->dbforge->add_field($field_data);
                        $this->dbforge->add_key('id', TRUE);
                        $get_value = $this->dbforge->create_table("insert_kitchen_assign_product_".$table_name, FALSE);


                return $get_value;
        }
    //07-05-19 
    public function createTableProductList($sku_array)
       {
               $field_data = array();

               $field_data['id'] = array(
                       'type' => 'INT',
                       'constraint' => 11,
                       'unsigned' => TRUE,
                       'auto_increment' => TRUE
               );

               for($i = 0; $i < count($sku_array); $i++)
               {
                      $coloumn_name = (string)$sku_array[$i];
                      $field_data[$coloumn_name] = array(
                       'type' => 'INT',
                       'constraint' => 11,
                       'unsigned' => TRUE,
                      );
               }
              
              // $field_data['order_flag'] = array(
              //          'type' => 'INT',
              //          'constraint' => 11,
              //          'unsigned' => TRUE
              //  );
               // echo "<pre>";
               // print_r($field_data);
               // echo "</pre>";

               $this->dbforge->add_field($field_data);
               $this->dbforge->add_field("date date NULL");
               $this->dbforge->add_key('id',TRUE);
               $get_value = $this->dbforge->create_table("date_products",FALSE);
               return $get_value;

       }
       //19-05-19
        public function createTableOldProductList($sku_array)
       {
               $field_data = array();

               $field_data['id'] = array(
                       'type' => 'INT',
                       'constraint' => 11,
                       'unsigned' => TRUE,
                       'auto_increment' => TRUE
               );

               for($i = 0; $i < count($sku_array); $i++)
               {
                      $coloumn_name = (string)$sku_array[$i];
                      $field_data[$coloumn_name] = array(
                       'type' => 'INT',
                       'constraint' => 11,
                       'unsigned' => TRUE,
                      );
               }
              
              // $field_data['order_flag'] = array(
              //          'type' => 'INT',
              //          'constraint' => 11,
              //          'unsigned' => TRUE
              //  );
               // echo "<pre>";
               // print_r($field_data);
               // echo "</pre>";

               $this->dbforge->add_field($field_data);
               $this->dbforge->add_field("date date NULL");
               $this->dbforge->add_key('id',TRUE);
               $get_value = $this->dbforge->create_table("assigned_date_products",FALSE);
               return $get_value;

       }
       //19-06-19
       public function createTableProductListJsonOld($sku_array)
       {
               $field_data = array();

               $field_data['id'] = array(
                       'type' => 'INT',
                       'constraint' => 11,
                       'unsigned' => TRUE,
                       'auto_increment' => TRUE
               );

               for($i = 0; $i < count($sku_array); $i++)
               {
                      $coloumn_name = (string)$sku_array[$i];
                      $field_data[$coloumn_name] = array(
                       'type' => 'INT',
                       'constraint' => 11,
                       'unsigned' => TRUE,
                      );
               }
              $this->dbforge->add_field($field_data);
               $this->dbforge->add_field("date date NULL");
               $this->dbforge->add_key('id',TRUE);
               $get_value = $this->dbforge->create_table("date_products_json_old",FALSE);
               return $get_value;

       }

}

/* End of file Create_model.php */
/* Location: ./application/models/Create_model.php */