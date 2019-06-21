<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cart extends CI_Controller 
{
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

		/**
		*	ENCRYPTION ALGORITHM
		*/

		$key = $this->encryption->create_key(16);
        $config['encryption_key'] = bin2hex($key);
       	$this->encryption->initialize(
        array(
                'cipher' => 'aes-256',
                'mode' => 'ctr',
                'key' => $config['encryption_key']
        	));
	}

	public function index()
	{
		$this->product_cart();
	}

	public function product_cart()
	{
		// print_r($_SESSION);
		if($this->session->has_userdata('id'))
		{		
			// print_r($this->cart->contents());
			$data['user_data'] = $this->select_model->select_user($this->backend_table,$this->user_id);
			$this->load->view('headers/userheader',$data);
			$this->load->view('cart/cart');		
			$this->load->view('headers/footer');
		}
		else
		{
			$this->error_403();
		}	
	}

	public function add()
	{
		
		/**
		*   --> GET POST VALUES FROM AJAX POST.
		*	--> INSERT INTO CART
		*/	


		$get_options = $this->input->post('options');
		$products = null;
		$options_array = array();
		// print_r($get_options);

		for($i=0;$i < count($get_options); $i++)
		{
			$get_custom_products_array = explode("/",$get_options[$i]);
			// print_r($get_custom_products_array);
			$options_array[$i] = $products = "product:".$get_custom_products_array[0]." Price:".$get_custom_products_array[1]." SKU:".$get_custom_products_array[2]." Quantity:".$get_custom_products_array[3]."<br>";
		}

		// print_r($options_array);

		$product_data = array(
			'id' => $this->input->post('product_id'),
			'qty' => $this->input->post('quantity'),
			'price' => $this->input->post('product_price'),
			'name' => $this->input->post('product_name'),
			'options' => $options_array
		);

		$product_array = array();
		$option_product_array = array();
		$confirmation_array = array();

		$this->cart->insert($product_data);

		//WRITE AN INSERT INTO CART TABLE

		$set_update_flag = 0;
		// echo $this->session->userdata('order_id');
		// define("ORDERID",  "OI".date("dmYHis"));
		foreach ($this->cart->contents() as $items) 
		{
			$set_order_id = $order_id;
			$product_array['user_id'] = $this->user_id;
			$product_array['user_table'] = $this->backend_table;
			$product_array['order_id'] = 	$this->session->userdata("order_id");
			$product_array['unique_order_id'] = "UID".date('dmYHis');
			$product_array['rowid'] = $items['rowid'];
			$product_array['product_sku'] = $items['id'];
			$product_array['product_name'] = $items['name'];
			$product_array['price'] = $items['price'];
			$product_array['quantity'] = $items['qty'];
			$product_array['bundled_flag'] = $this->input->post('bundle_flag');
			


			//print_r($product_array);

			//@TODO : VALIDATE PRODUCT CART
			$get_rowid_count = $this->validate_model->check_product_rowid($product_array['rowid']);

			echo "row count : ".$get_rowid_count;
			
			if($get_rowid_count > 0)
			{
				$get_update_same_rowid = $this->update_model->update_cart($product_array['rowid'],$product_array['quantity']);
				if($get_update_same_rowid)
				{
					$set_update_flag++;
				}
			}
			else
			{
				$get_insert_to_product_cart = $this->insert_model->add_product($product_array);

				if((!empty($items['options'])) && ($set_update_flag == 0))
				{
					for($j = 0 ; $j < count($items['options']); $j++)
					{
						$exploaded_array = explode(" ",$items['options'][$j]);
						$option_product_array['user_id'] = $this->user_id;
						$option_product_array['user_table'] = $this->backend_table;
						$option_product_array['order_id'] = $product_array['order_id'];	
						$option_product_array['unique_order_id'] = $product_array['unique_order_id'];					
						$option_product_array['rowid'] = $items['rowid'];
						
						$product = preg_split('/:/',$exploaded_array[0],-1);
						$price = preg_split('/:/',$exploaded_array[1],-1);
						$sku = preg_split('/:/',$exploaded_array[2],-1);
						$quantity = preg_split('/:/',$exploaded_array[3],-1);
	
						$option_product_array['product_name'] = $product[1];
						$option_product_array['product_sku'] = $sku[1];
						$option_product_array['price'] = $price[1];
						$option_product_array['quantity'] = $quantity[1];
						$option_product_array['bundled_flag'] = $this->input->post('bundle_flag');

					
						$get_insert_to_optional_product_cart = $this->insert_model->add_optional_product($option_product_array);
					}
				}
			}

			$confirmation_array['user_id'] = $this->user_id;
			$confirmation_array['user_table'] = $this->backend_table;
			$confirmation_array['order_id'] = $product_array['order_id'];
			$confirmation_array['unique_order_id'] = $product_array['unique_order_id'];
			$confirmation_array['product_id'] = $items['rowid'];
			$confirmation_array['product_sku'] = $items['id'];
			$confirmation_array['confirm_flag'] = 0;
			$confirmation_array['bundled_flag'] = $this->input->post('bundle_flag');

		}
		$get_insert_cart_confirmation = $this->insert_model->set_confirm_cart($confirmation_array);

	}

	public function update()
	{
		$product_update = array(
			'rowid' => $this->input->post('rowid'),
			'qty' => $this->input->post('qty')
		);
		$get_updater = $this->cart->update($product_update);
		if($get_updater)
		{
			$get_product_cart_updater = $this->update_model->update_cart($product_update['rowid'],$product_update['qty']);
		}

	}

	public function remove()
	{
		$product_data = array(
			'rowid' => $this->input->post('rowid'),
			'qty' => 0
		);

		 $get_delete_updater = $this->cart->update($product_data);
		 if($get_delete_updater)
		 {
		 	$get_product_cart_delete = $this->delete_model->delete_cart_product($product_data['rowid']);
		 }

	}

	/**
 	*  Author  : Vedavith Ravula
 	*  Date    : 08-02-2019
 	*/

    public function checkout($error=NULL)
    {

    	if($this->session->has_userdata('id'))
			{	
				$this->cart->destroy();
				$data['user_data'] = $this->select_model->select_user($this->backend_table,$this->user_id);
				$this->load->view('headers/userheader',$data);
				
				//@TODO : GET PRODUCT DETAILS 
				//@TODO : GET OPTIONAL PRODUCT DETAILS
				//@TODO : GET ADDRESS USING USER ID AND USER TABLE
				
						$get_user_id = $this->user_id;
						$get_user_type = $this->user_type;
						$set_confirmation = 0;

						$data['show_product_cart'] = $this->select_model->get_product_list_on_user_id($get_user_id,$get_user_type,$set_confirmation);
						$data['show_optional_product'] = $this->select_model->get_optional_list_on_user_id($get_user_id,$get_user_type,$set_confirmation);
						$data['get_address'] = $this->select_model->get_user_address($this->user_type, $this->user_id);
						if($this->session->userdata('type') !=  'individual')
						{
							$data['get_branch_data'] = $this->select_model->get_company_branch_address($this->user_type, $this->user_id);
						}

						$this->load->view('cart/checkout',$data);
						$this->load->view('headers/footer');
			}
			else
			{
				$this->error_403();
			}	
		}

		/**
		 * AJAX CALLS
		 */

		 public function ajaxCallDeleteProduct()
		 {
			 $get_affected = $this->delete_model->delete_confirm_cart($this->input->post('id_setter'));
			 if($get_affected)
			 {
				echo $get_affected;
			 }
		 }

		/*
		 *		ERROR 403 
		 */
		public function error_403()
	  {
		  $this->load->view('404');
		  $this->load->view('headers/footer');
	  }

}

/* End of file Cart.php */
/* Location: ../application/controllers/Cart.php */