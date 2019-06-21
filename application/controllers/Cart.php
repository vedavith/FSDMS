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

	private function product_cart()
	{
		// print_r($_SESSION);
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
			

			$data['cart_products_on_id'] = $this->select_model->proc_call_cart_prod_on_id($this->user_id);

			$this->load->view('headers/userheader',$data);
			$this->load->view('cart/cart',$data);		
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
		// echo "<code>";
		// print_r($get_options);
		// // echo count($get_options);
		// echo "</code>";


		for($i=0;$i < count($get_options); $i++)
		{
			
			$get_custom_products_array = explode("/",$get_options[$i]);
			// print_r($get_custom_products_array);
			$products  = "product : ".$get_custom_products_array[0]."<br>";
			$products .= "SKU : ".$get_custom_products_array[2]."<br>";
			$products .= "Quantity : ".$get_custom_products_array[5]."<br>";
			$products .= "Product GST : ".$get_custom_products_array[3]."<br>";
			$products .= "Product Price : ".$get_custom_products_array[4]."<br>";
			$products .= "Total : ".$get_custom_products_array[1]."<br>";
			$options_array[$i] = $products;
		}

		// echo "<code>";
		//  print_r($options_array);
		//  echo "</code>";

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
		
		 echo "<pre>";
		 print_r($this->cart->contents());
		 echo "</pre>";

		foreach ($this->cart->contents() as $items) 
		{
			//$set_order_id = $order_id;
//! Add gst and product sub total fields to product cart
			$product_array['user_id'] = $this->user_id;
			$product_array['user_table'] = $this->backend_table;
			$product_array['order_id'] = 	$this->session->userdata("order_id");
			$product_array['unique_order_id'] = "UID".date('dmYHis');
			$product_array['rowid'] = $items['rowid'];
			$product_array['product_sku'] = $items['id'];
			$product_array['product_name'] = $items['name'];
			$product_array['product_gst'] = $this->input->post('product_gst');
			$product_array['product_subtotal'] = $this->input->post('product_subtotal');
			$product_array['price'] = $items['price'];
			$product_array['quantity'] = $items['qty'];
			$product_array['bundled_flag'] = $this->input->post('bundle_flag');
			


			//print_r($product_array); 	

			//@TODO : VALIDATE PRODUCT CART
			$get_rowid_count = $this->validate_model->check_product_rowid($product_array['rowid'],$product_array['unique_order_id']);

			//echo "row count : ".$get_rowid_count;
			
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
				// print_r($product_array);
				$get_insert_to_product_cart = $this->insert_model->add_product($product_array);
			
				// print_r($get_insert_to_product_cart);

				// echo "<code>";
				// print_r($items['options']);
				// echo "</code>";

				if((!empty($items['options'])) && ($set_update_flag == 0))
				{
					for($j = 0 ; $j < count($items['options']); $j++)
					{
						$exploaded_array = explode("<br>",$items['options'][$j]);
						$option_product_array['user_id'] = $this->user_id;
						$option_product_array['user_table'] = $this->backend_table;
						$option_product_array['order_id'] = $product_array['order_id'];	
						$option_product_array['unique_order_id'] = $product_array['unique_order_id'];					
						$option_product_array['rowid'] = $items['rowid'];
						
				
						// echo "<pre>";
					   	// print_r($exploaded_array);
					   	// echo "</pre>";

						$product = preg_split('/ : /',$exploaded_array[0],-1);
						$sku = preg_split('/ : /',$exploaded_array[1],-1);
						$quantity = preg_split('/ : /',$exploaded_array[2],-1);
						$product_gst = preg_split('/ : /',$exploaded_array[3],-1);
						$product_price = preg_split('/ : /',$exploaded_array[4],-1);
						$total = preg_split('/ : /',$exploaded_array[5],-1);
						
						$explode_quantity = explode("<br>",$quantity[1]);

//! Add gst and product sub total fields to optional product cart		

						$option_product_array['product_name'] = $product[1];
						$option_product_array['product_sku'] = $sku[1];
						$option_product_array['product_gst'] = $product_gst[1];
						$option_product_array['product_subtotal'] = $product_price[1];
						$option_product_array['price'] = $total[1];
						$option_product_array['quantity'] = $quantity[1];
						$option_product_array['bundled_flag'] = $this->input->post('bundle_flag');

						// print_r($option_product_array);
					
						$get_insert_to_optional_product_cart = $this->insert_model->add_optional_product($option_product_array);
					}
				}
			}

 // !Add product gst and product sub total fields to cart_confirmation table

			$confirmation_array['user_id'] = $this->user_id;
			$confirmation_array['user_table'] = $this->backend_table;
			$confirmation_array['order_id'] = $product_array['order_id'];
			$confirmation_array['unique_order_id'] = $product_array['unique_order_id'];
			$confirmation_array['product_id'] = $items['rowid'];
			$confirmation_array['product_sku'] = $items['id'];
			$confirmation_array['product_gst'] = $product_array['product_gst'];
			$confirmation_array['product_subtotal'] = $product_array['product_subtotal'];
			$confirmation_array['main_product_price'] = $this->input->post('main_product_price');
			$confirmation_array['optional_product_price'] = $this->input->post('optional_product_price');
			$confirmation_array['price'] = $product_array['price'];
			$confirmation_array['quantity'] = $product_array['quantity'];
			$confirmation_array['confirm_flag'] = 0;
			$confirmation_array['bundled_flag'] = $this->input->post('bundle_flag');

		}

		// echo "<pre>";
		// print_r($confirmation_array);
		// echo "</pre>";
		
		$get_insert_cart_confirmation = $this->insert_model->set_confirm_cart($confirmation_array);

		$remove_item_from_session = array(
			'rowid' => $items['rowid'],
			'qty' => 0
		);
		$this->cart->update($remove_item_from_session);

	}

	//!OLD CODE DEPRECATED ON 28052019
	/**
	 * AUTHOR : VEDAVITH RAVULA
	 * DATE : 11062019
	 * -------------------------
	 * REFACTOR 2_1 : 11062019
	 * -------------------------
	 */
	
	public function update()
	{
		$uid = $this->input->post('uid');
		//! Quantity Value Can be deprecated not using in update methods
		$quant = $this->input->post('quantity');

		//? FALG HAS 2 VALUES incr AND decr ?
		
		$flag = $this->input->post('flag');
		
			$get_product_cart_updater = $this->update_model->update_cart($this->input->post('uid'),$flag);
			if($get_product_cart_updater)
			{
				$get_confirm_cart_updater = $this->update_model->update_cart_confirmation($this->input->post('uid'),$this->input->post('quantity'));
				if($get_confirm_cart_updater)
				{
					echo $get_confirm_cart_updater;
				}
			}
	}

	public function remove()
	{
			 $get_product_cart_delete = $this->delete_model->delete_cart_product($this->input->post('uid'));
			 if($get_product_cart_delete)
			 {
				 $delete_from_cart_confirmation = $this->delete_model->delete_confirm_cart($this->input->post('uid'));
				 if($delete_from_cart_confirmation)
				 {
						echo $delete_from_cart_confirmation;
				 }
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