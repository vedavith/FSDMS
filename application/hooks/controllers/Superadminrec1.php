
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Superadmin extends CI_Controller
{
    public function __construct()
    {
      parent::__construct();
       $this->load->helper('url'); 
      $this->load->model('insert_model');
      $this->load->model('update_model');
      $this->load->model('delete_model');
      $this->load->model('select_model');
      $this->load->model('validate_model');

      /**
       * SESSION DATA FOR SUPERADMIN HOME
       */

      $this->admin_id = $this->session->userdata('admin_id');
      $this->backend_table = $this->session->userdata('backend_table');
        
    }

    public function index()
    {
        $get_count =  $this->select_model->select_superadmin_count();
        if($get_count == 0)
        {
            $this->superuser_register();
        }
        else
        {
            $this->login();
        }
    }

    public function superuser_register()
    {
        $this->load->view('headers/superadminheader');
        $this->load->view('superadmin/superadmin_registration');
        $this->load->view('headers/footer');
    }

    public function login($data = NULL)
    {
        $this->load->view('headers/superadminheader');
        $this->load->view('superadmin/superadmin_login',$data);
        $this->load->view('headers/footer');
    }

    public function superadmin_registration()
    {
        $this->form_validation->set_rules('first_name','First Name','required');
  	    $this->form_validation->set_rules('last_name','Last Name','required');
  	    $this->form_validation->set_rules('user_name','User Name','required');
  	    $this->form_validation->set_rules('email_id','Email ID','required');
        $this->form_validation->set_rules('phone_number','Phone Number','required');
        $this->form_validation->set_rules('admin_password','Password','required');
        $this->form_validation->set_rules('confirm_admin_password','Confirm Password','required');

        if ($this->form_validation->run())
        {
            $insert_admin_data = array(
                "first_name"=>$this->input->post('first_name'),
                "last_name"=>$this->input->post('last_name'),
                "user_name"=>$this->input->post('user_name'),
                "email"=>$this->input->post('email_id'),
                "phone_number"=>$this->input->post('phone_number')
            );

            // echo "<pre>";
            // print_r($insert_admin_data);
            // echo "</pre>";

            $insert_admin_login = array(
                "user_name"=>$insert_admin_data['user_name'],
                "email"=>$insert_admin_data['email'],
                "password"=>$this->input->post('admin_password'),
                "phone_number"=>$insert_admin_data['phone_number']
            );

            // echo "<pre>";
            // print_r($insert_admin_login);
            // echo "</pre>";

           $admin_data = $this->insert_model->insert_admin_data($insert_admin_data);
           if($admin_data)
           {
               $admin_login = $this->insert_model->insert_superadmin($insert_admin_login);
               if($admin_login)
               {
                   $get_affected_rows = $this->update_model->update_superadmin_count();
                   if($get_affected_rows)
                   {
                    redirect(base_url()."Superadmin");
                   }
               }
           }
        }
        else
        {
            $this->superuser_register();
        }
    }

    public function superadmin_login()
    {
        $this->form_validation->set_rules("user_name","User Name","required");
        $this->form_validation->set_rules("admin_password","Password","required");
        if($this->form_validation->run())
        {
            $get_admin = array(
                "user_name" => $this->input->post("user_name"),
                "password" => $this->input->post("admin_password")
            );

            $get_count = $this->validate_model->get_superadmin_data($get_admin);
            if($get_count == 1)
            {
                $get_data = $this->validate_model->get_superuser_details($get_admin['user_name']);
                $this->session->set_userdata($get_data);
                redirect(base_url()."Superadmin/home");
            }
            else
            {
                $data['error_handler'] = "User Not Found";
                $this->login($data);
            }
        }
        else
        {
             $this->login();
        }
    }

    public function home()
    {
        if($this->session->has_userdata('admin_id'))
        {
            $data['user_data'] = $this->select_model->select_user($this->backend_table,$this->admin_id);
            $this->load->view('headers/superadmin_home_header',$data);
            $this->load->view('superadmin/superadmin_home');
            $this->load->view('headers/footer');
        }
        else
        {
            $this->error_403();
        }
    }

   // @todo
   // If possible Try to move category and product to 2 diffrent controllers

    /**
    *   CATEGORY INSERT - UPDATE - DELETE
    */

    public function create_category($error=NULL,$data_array=NULL)
    {
        if($this->session->has_userdata('admin_id'))
        {
            $data['user_data'] = $this->select_model->select_user($this->backend_table,$this->admin_id);
            $this->load->view('headers/superadmin_home_header',$data);

            $data['error_handler'] = $error;
            $data['category_master'] = $this->select_model->get_category_master();

            if(isset($data_array))
            {
                $data['update'] = 1;
                $data['id'] = $data_array['id'];
                $data['category_name'] = $data_array['category_name'];
            }

            $this->load->view('products/new_category',$data);
            $this->load->view('headers/footer');
        }
        else
        {
            $this->error_403();
        }
    }

    public function insert_category()
    {
       $this->form_validation->set_rules('category', 'Category', 'required');
       if ($this->form_validation->run())
       {
          $insert_category = array(
                "category"=>$this->input->post("category")
          );

          $get_count = $this->validate_model->get_category($insert_category['category']);

          if(!($get_count))
          {
            $get_affected_rows = $this->insert_model->insert_product_category($insert_category);
            if($get_affected_rows)
            {
                echo "<script> alert('Created Category'); </script>";
                $this->create_category();
            }
          }
          else
          {
            //$this->create_category("vae");
            echo "<script> alert('Error(VAE): Value Already Exists.'); </script>";
            $this->create_category();
          }
       }
       else
       {
           $this->create_category("Required");
       }
    }

    public function update_category()
    {
        $data['id']=$this->uri->segment(3);
        $get_value = $this->select_model->select_user("category_master",$this->uri->segment(4));
        // print_r($get_value);
        if($get_value->num_rows() > 0)
        {
            $data_array = array();

            foreach($get_value->result() as $category)
            {
                $data_array['update'] = 1;
                $data_array['id'] = $category->id;
                $data_array['category_name'] = $category->category;
            }
            $this->create_category(NULL,$data_array);
        }

        /*
         *  Update button
         */

        if($this->input->post('cat_update') == "cat_update")
        {

            $this->form_validation->set_rules('update_category','update_category','required');

            if($this->form_validation->run())
            {
                 $get_update = array(
                    "id" => $this->input->post('update_id'),
                    "category" => (string)$this->input->post('update_category')
                );

                $get_update_count = $this->update_model->update_category_master($get_update);
                if($get_update_count)
                {
                    echo "<script> alert('Updated'); </script>";
                    redirect(base_url()."superadmin/update_category/".$this->uri->segment(3),'refresh');
                }

            }
            else
            {
                echo "<script> alert('ERROR(UVE) : Update Value Should Not Be Empty'); </script>";
                redirect(base_url()."superadmin/create_products/".$this->uri->segment(4),'refresh');
            }

        }
    }

    public function delete_category()
    {
        $get_affected_rows = $this->delete_model->delete_category($this->uri->segment(3));

        if($get_affected_rows)
        {
           redirect(base_url()."superadmin/create_category",'refresh');
        }
    }

    /**
     *  PRODUCT INSERT - UPDATE - DELETE
     */

    //31-1-19
   
    public function create_products($error = NULL, $id = NULL)
    {
        if($this->session->has_userdata('admin_id'))
        {
            $data['user_data'] = $this->select_model->select_user($this->backend_table,$this->admin_id);
            $this->load->view('headers/superadmin_home_header',$data);
            $data['category_master'] = $this->select_model->get_category_master();
              
              if($this->uri->segment(3) != NULL)
              {
                $data['get_product_by_id'] = $this->select_model->get_product_by_id($this->uri->segment(3));
              }

            if($error != NULL)
            {
              $data['error'] = "PAE";
            }

            $data['prd_data']=$this->select_model->get_productyes_data();

            $this->load->view('products/new_product',$data);
            $this->load->view('headers/footer');
      }
      else
      {
            $this->error_403();
      }
    }

    function fetch_dropdown_prdid()
   {
    echo "<script> alert('hi'); </script>";
    if($this->select_model->fetch_dropdown_prdprice($this->input->post('prdid')))
    {
      echo $this->select_model->fetch_dropdown_prdprice($this->input->post('prdid'));
    }
    else
    {
      echo "Failed";
    }
   }
   
    public function insert_product()
    {
       $this->form_validation->set_rules('meal_type','meal_type','required');
       $this->form_validation->set_rules('category','category','required');
       
       if(isset($_FILES['userfile']['name']))
       {
          $file_count = count($_FILES['userfile']['name']);

         $actual_count = 5;
         $expected_count = 0;
         for($c = 0; $c < $file_count; $c++)
         {
            if($_FILES['userfile']['name'][$c] != "")
            {
              $expected_count++;
            }
         }

      if($expected_count != $actual_count)
       {
        $this->form_validation->set_rules('userfile[]', 'userimage', 'required');
       } 

       }
       $this->form_validation->set_rules('product_name','product_name','required');
       $this->form_validation->set_rules('product_sku','product_sku','required');
       $this->form_validation->set_rules('product_quantity','product_quantity','required');
       $this->form_validation->set_rules('product_price','product_price','required');
       //$this->form_validation->set_rules('userfile','userfile','required');

       if($this->input->post('custom_options') == "custom_yes")
       {
         $this->form_validation->set_rules('customizable_options[]','custom options','required');
         $this->form_validation->set_rules('customizable_price[]','custom price','required');
       }


       if ($this->form_validation->run())
       {
           $files = $_FILES;
           if(!empty($_FILES['userfile']['name'])){
               
              $count = count($_FILES['userfile']['name']);
              for($i=0; $i<$count; $i++)
                {
               
                $_FILES['userfile']['name']= time().$files['userfile']['name'][$i];
                $_FILES['userfile']['type']= $files['userfile']['type'][$i];
                $_FILES['userfile']['tmp_name']= $files['userfile']['tmp_name'][$i];
                $_FILES['userfile']['error']= $files['userfile']['error'][$i];
                $_FILES['userfile']['size']= $files['userfile']['size'][$i];
                $config['upload_path'] = './uploads/';
                $config['allowed_types'] = 'gif|jpg|png|jpeg';
                $config['max_size'] = '';
                $config['remove_spaces'] = true;
                $config['overwrite'] = false;
                $config['max_width'] = '';
                $config['max_height'] = '';
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                $this->upload->do_upload();
                $fileName = "uploads/".$_FILES['userfile']['name'];
                $images[] = $fileName;
               }
             $fileName = $images;
            if($fileName!='' ){
          
              $filename1 = $fileName;
               $i=0;
              foreach($filename1 as $file){
              $img[$i]=$file;
              $i++;
           }
          for($j=0;$j<5;$j++){
            if($i<5){
              $img[$i] = '';
              $i++;
            }
           }

           
           $set_images = array(
              'product_sku' => $this->input->post('product_sku'),
              'image1' => $img[0],
              'image2' => $img[1],
              'image3' => $img[2],
              'image4' => $img[3],
              'image5' => $img[4]
           ); 
          // Get form values.
          $set_product = array(
              'product_name' => $this->input->post('product_name'),
              'product_sku' => $this->input->post('product_sku'),
              'product_quantity' => $this->input->post('product_quantity'),
              'product_price' => $this->input->post('product_price'),
              'meal_type' => $this->input->post('meal_type'),
              'product_category' => $this->input->post('category'),
              'product_image' => "NULL",
              'is_customizable' => $this->input->post('custom_options')
              );

              $set_is_customizable = NULL;

          if($this->input->post('custom_options') == "custom_yes")
          {
               
          //products seperated by ,
            $get_customizable_product_array = $this->input->post('customizable_options[]');
            $get_customizable_product_string = implode(",",$get_customizable_product_array);

            //prices seperated by ,
            $get_customizable_price_array = $this->input->post('customizable_price[]');
            $get_customizable_price_string = implode(",",$get_customizable_price_array);

            $set_is_customizable = array(
              'product_category' => $set_product['product_category'],
              'product_sku' => $set_product['product_sku'],
              'customizable_product' => $get_customizable_product_string,
              'custom_product_price' => $get_customizable_price_string
            );
          }

          $get_count_validate = $this->validate_model->get_product_master($set_product['product_sku'],$set_product['product_name']);
          if ($get_count_validate == 0)
          {
            $get_affected = $this->insert_model->create_insert_product($set_product);
            $insert_images = $this->insert_model->insert_product_image($set_images);
            if($set_product['is_customizable'] == 'custom_yes')
            {
              $get_affected = $this->insert_model->create_customizable_product($set_is_customizable);
            }

            if ($get_affected != 0)
            {
              echo "<script> alert('Created Product'); </script>";
              echo "<script>window.location.href='".base_url()."Superadmin/create_products/';</script>";
            }
          }
          else
          {
           $this->create_products("PAE");
          }
        }
      }
    

       }
       else
       {
           $this->create_products();
       }
    }

    public function manage_product()
    {
      if($this->session->has_userdata('admin_id'))
      {
        $data['user_data'] = $this->select_model->select_user($this->backend_table,$this->admin_id);
        $this->load->view('headers/superadmin_home_header',$data);
        $data['product_data'] = $this->select_model->get_products_data();
        $this->load->view('products/manage_product',$data);
        $this->load->view('headers/footer');
      }
      else
      {
        $this->error_403();
      }
    } 


    //6-2-19
    public function update_product()
    {
      $this->session->set_userdata("product_id",$this->session->userdata('product_id'));
    
       $this->form_validation->set_rules('meal_type','meal_type','required');
       $this->form_validation->set_rules('category','category','required');
       $this->form_validation->set_rules('product_name','product_name','required');
       $this->form_validation->set_rules('product_sku','product_sku','required');
       $this->form_validation->set_rules('product_quantity','product_quantity','required');
       $this->form_validation->set_rules('product_price','product_price','required');
       $this->form_validation->set_rules('pic1','pic1','required');
       $this->form_validation->set_rules('pic2','pic2','required');
       $this->form_validation->set_rules('pic3','pic3','required');
       $this->form_validation->set_rules('pic4','pic4','required');
       $this->form_validation->set_rules('pic5','pic5','required');
    
      if($this->input->post('custom_options') == "custom_yes")     
         {
          $this->form_validation->set_rules('customizable_options[]','custom
          options','required');
          $this->form_validation->set_rules('customizable_price[]','custom
          price','required');       
       }
      if ($this->form_validation->run())
       {
          if($this->input->post('product_update') == "product_update")
          {
              $img1 = $this->input->post("pic1");
              $img2 = $this->input->post("pic2");
              $img3 = $this->input->post("pic3");
              $img4 = $this->input->post("pic4");
              $img5 = $this->input->post("pic5");
              $files = $_FILES;
              $_FILES['userfile']['name']=$files['userfile']['name'];
              $_FILES['userfile']['tmp_name']= $files['userfile']['tmp_name'];
              $_FILES['userafile']['name']= $files['userafile']['name'];
              $_FILES['userafile']['tmp_name']= $files['userafile']['tmp_name'];
              $_FILES['userbfile']['name']= $files['userbfile']['name'];
              $_FILES['userbfile']['tmp_name']= $files['userbfile']['tmp_name'];
              $_FILES['usercfile']['name']= $files['usercfile']['name'];
              $_FILES['usercfile']['tmp_name']= $files['usercfile']['tmp_name'];
              $_FILES['userdfile']['name']= $files['userdfile']['name'];
              $_FILES['userdfile']['tmp_name']= $files['userdfile']['tmp_name'];
                $config['upload_path'] = './uploads/';
                $config['allowed_types'] = 'gif|jpg|png|jpeg';
                $config['max_size'] = '800000';
                $config['remove_spaces'] = true;
                $config['overwrite'] = false;
                $config['max_width'] = '1024';
                $config['max_height'] = '768';
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                $this->upload->do_upload();

                $fileName = "uploads/".$_FILES['userfile']['name'];
                $fileName2 = "uploads/".$_FILES['userafile']['name'];
                $fileName3 = "uploads/".$_FILES['userbfile']['name'];
                $fileName4 = "uploads/".$_FILES['usercfile']['name'];
                $fileName5 = "uploads/".$_FILES['userdfile']['name'];


                  if($fileName=="" || $fileName == "uploads/")
                    {
                    $file1 = $img1;     
                     }
                   else
                    {
                      $file1 = $fileName;
                    }
                    if($fileName2=="" || $fileName2 == "uploads/")
                    {
                    $file2 = $img2;     
                     }
                   else
                    {
                      $file2 = $fileName2;
                    }
                     if($fileName3=="" || $fileName3 == "uploads/")
                    {
                    $file3 = $img3;     
                     }
                   else
                    {
                      $file3 = $fileName3;
                    }
                     if($fileName4=="" || $fileName4 == "uploads/" )
                    {
                    $file4 = $img4;     
                     }
                   else
                    {
                      $file4 = $fileName4;
                    }
                     if($fileName5=="" || $fileName5 == "uploads/")
                    {
                    $file5 = $img5;     
                     }
                   else
                    {
                      $file5 = $fileName5;
                    }
           $sku_id = $this->input->post('product_sku');
           $set_images = array(
             'image1' => $file1,
             'image2' => $file2,
             'image3' =>$file3,
             'image4' => $file4,
             'image5' => $file5
           ); 
       // Get form values.
          $get_product_id = $this->input->post('product_id');
          $set_product = array(
              'product_name' => $this->input->post('product_name'),
              'product_sku' => $this->input->post('product_sku'),
              'product_quantity' => $this->input->post('product_quantity'),
              'product_updated_quantity'=>$this->input->post('product_update_quantity'),
              'product_price' => $this->input->post('product_price'),
              'meal_type' => $this->input->post('meal_type'),
              'product_category' => $this->input->post('category'),
              'product_image' => "NULL",
              'is_customizable' => $this->input->post('custom_options')
              );
              $update_product = $this->update_model->update_product_on_id($get_product_id,$set_product);
             $upload_image = $this->update_model->update_images($sku_id,$set_images);
              //echo $update_product;
              if($update_product >= 0)
              {
                $insert_quant_update = array(
                "product_sku"=>$set_product['product_sku'],
                "product_name"=>$set_product['product_name'],
                "product_category"=>$set_product['product_category'],
                "product_updated_quantity"=>$set_product['product_updated_quantity']
                );
                // print_r($insert_quant_update);
                
                $get_affected = $this->insert_model->insert_product_update($insert_quant_update);
          echo "<script> alert('Product Updated'); </script>";
          
                if($get_affected >= 0)
                {
                  $set_is_customizable = NULL;
                  
                    if($this->input->post('custom_options') == "custom_yes")
                    {
                //products seperated by ,
              $get_customizable_product_array = $this->input->post('customizable_options[]');
                    $get_customizable_product_string = implode(",",$get_customizable_product_array);

                    //prices seperated by ,
                    $get_customizable_price_array = $this->input->post('customizable_price[]');
                    $get_customizable_price_string = implode(",",$get_customizable_price_array);

                    $set_is_customizable = array(
                      'product_category' => $set_product['product_category'],
                      'product_sku' => $set_product['product_sku'],
                      'customizable_product' => $get_customizable_product_string,
                      'custom_product_price' => $get_customizable_price_string
                    );
                    
                    // print_r($set_is_customizable);
                    
                    $get_affected = $this->delete_model->delete_custom_product($set_product['product_sku']);
                    if($get_affected >= 0)
                    {
                $get_affected_insert = $this->insert_model->create_customizable_product($set_is_customizable);
                if($get_affected_insert >= 0)
                {
                  echo "<script> alert('Custom Products Updated'); </script>";
                }
              }
          }
          else
          {
            $get_affected = $this->delete_model->delete_custom_product($set_product['product_sku']);
            if($get_affected)
            {
              echo "<script> alert('Product Updated'); </script>";
            }
          }
          echo "<script> window.location.href='".base_url()."superadmin/manage_product'; </script>";
        }
      } 
      
        }
       

       }
       else
       {

        if($this->session->has_userdata('admin_id'))
        {
            $data['user_data'] = $this->select_model->select_user($this->backend_table,$this->admin_id);
            $this->load->view('headers/superadmin_home_header',$data);
            $data['category_master'] = $this->select_model->get_category_master();
              
              if($this->session->userdata("product_id") != NULL)
              {
                $data['get_product_by_id'] = $this->select_model->get_product_by_id($this->session->userdata("product_id"));
              }

            

            $this->load->view('products/new_product',$data);
            $this->load->view('headers/footer');
        }
     }
    }



    public function delete_product()
    {
      $get_affected_rows = $this->delete_model->delete_product($this->uri->segment(3));
      if($get_affected_rows)
      {
         redirect(base_url()."superadmin/manage_product",'refresh');
      }
    }


    //7-2-2019 create kitchen
    public function create_kitchen($error = NULL)
    {
      if($this->session->has_userdata('admin_id'))
        {
            $data['user_data'] = $this->select_model->select_user($this->backend_table,$this->admin_id);
            if($error != NULL)
            {
              $data['error'] = "KTE";
            }
            $this->load->view('headers/superadmin_home_header',$data);
            $this->load->view('products/new_kitchen',$data);
            $this->load->view('headers/footer');
      }
      else
      {
            $this->error_403();
      }
    }

   
    //7-2-2019 insert kitchen values (add kitchen type 12-2-19)
    public function insert_kitchen_data()
    {
       $this->form_validation->set_rules('kitchen_id','kitchen_id','required');
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
          "kitchen_type" => $this->input->post("kitchen_type"),
          "k_address1" => $this->input->post("kitchen_address1"),
          "k_address2" => $this->input->post("kitchen_address2"),
          "k_address3" => $this->input->post("kitchen_address3"),
          "state" => $this->input->post("state"),
          "city" => $this->input->post("city"),
          "zipcode" => $this->input->post("zipcode")
        );

         if($this->input->post('insert'))
         { 
           $get_count_validate = $this->validate_model->get_kitchen_register($kitchen_data['k_id'],$kitchen_data['k_name']);
            if ($get_count_validate == 0)
            {
             $get_insert = $this->insert_model->insert_kitchen($kitchen_data);
              if($get_insert)
              {
                echo "<script> alert('kitchen data inserted'); </script>";
                echo "<script>window.location.href='".base_url()."Superadmin/manage_kitchen/';</script>";
              }
            }
            else
            {
              $this->create_kitchen("KTE");
            }
          }     
      }
      else
      {
        $this->create_kitchen();
      }
    }
    //7-2-19
    public function manage_kitchen()
    {
      if($this->session->has_userdata('admin_id'))
      {
        $data['user_data'] = $this->select_model->select_user($this->backend_table,$this->admin_id);
        $this->load->view('headers/superadmin_home_header',$data);
        $data['kitchen_data'] = $this->select_model->select_kitchen_register();
        $this->load->view('products/manage_kitchen',$data);
        $this->load->view('headers/footer');
      }
      else
      {
        $this->error_403();
      }
    } 

    //7-2-19
    public function edit_kitchen_register()
    { 
       if($this->session->has_userdata('admin_id'))
        {
           $id = $this->uri->segment(3);
            $data['user_data'] = $this->select_model->select_user($this->backend_table,$this->admin_id);
           
            $data['kicthen_reg_id'] = $this->select_model->kicthen_reg_id($id);
            $this->load->view('headers/superadmin_home_header',$data);
            $this->load->view('products/new_kitchen',$data);
            $this->load->view('headers/footer');
      }
      else
      {
            $this->error_403();
      }
    }

    //7-2-19
    function delete_kitchen_reg()
    {

      $get_affected_rows = $this->delete_model->delete_kitchen_reg($this->uri->segment(3));
      if($get_affected_rows)
      {
         redirect(base_url()."superadmin/manage_kitchen",'refresh');
      }
    }
   

    //7-2-19 (add kitchen_type 12-2-19)
    function edit_kitchen_data()
    {
      $this->form_validation->set_rules('kitchen_id','kitchen_id','required');
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
          "kitchen_type" => $this->input->post("kitchen_type"),
          "k_address1" => $this->input->post("kitchen_address1"),
          "k_address2" => $this->input->post("kitchen_address2"),
          "k_address3" => $this->input->post("kitchen_address3"),
          "state" => $this->input->post("state"),
          "city" => $this->input->post("city"),
          "zipcode" => $this->input->post("zipcode")
        );
         
            if($this->input->post('update'))
           {
          
            $get_update = $this->update_model->update_kitchen_register($this->input->post("khidden_id"),$kitchen_data);
             if($get_update)
             {
              
              echo "<script> alert('kitchen data updated'); </script>";
              echo "<script>window.location.href='".base_url()."Superadmin/manage_kitchen/';</script>";
              }
             }
        }
      else
      {
        if($this->session->has_userdata('admin_id'))
            {
                $id = $this->input->post("khidden_id");
                $data['user_data'] = $this->select_model->select_user($this->backend_table,$this->admin_id);
           
                $data['kicthen_reg_id'] = $this->select_model->kicthen_reg_id($id);
                $this->load->view('headers/superadmin_home_header',$data);
                $this->load->view('products/new_kitchen',$data);
                $this->load->view('headers/footer');
            }
            else
            {
                $this->error_403();
            }
      }
    }

    //8-2-19
    public function create_kitchen_admin($error = NULL)
    {
      if($this->session->has_userdata('admin_id'))
        {
            $data['user_data'] = $this->select_model->select_user($this->backend_table,$this->admin_id);
            if($error != NULL)
            {
              $data['error'] = "KAD";
            }
            $data['kitchen_ids'] = $this->select_model->select_kitchen_register();
            $this->load->view('headers/superadmin_home_header',$data);
            $this->load->view('products/kitchen_admin',$data);
            $this->load->view('headers/footer');
      }
      else
      {
            $this->error_403();
      }
    }

    //8-2-19
    public function insert_kitchen_admin()
    {
      $this->form_validation->set_rules('kitchen_id','kitchen_id','required');
      $this->form_validation->set_rules('first_name','first_name','required');
      $this->form_validation->set_rules('last_name','last_name','required');
      $this->form_validation->set_rules('email','email','required');
      $this->form_validation->set_rules('user_name','user_name','required');
      //$this->form_validation->set_rules('password','password','required');
      
      if($this->form_validation->run())
       {
        
         $kitchen_admin_data = array(
          "kitchen_id" => $this->input->post("kitchen_id"),
          "first_name" => $this->input->post("first_name"),
          "last_name" => $this->input->post("last_name"),
          "email_id" => $this->input->post("email"),
          "user_name" => $this->input->post("user_name"),
          "password" => $this->input->post("password")
         
        );

         if($this->input->post('insert'))
         { 
           $get_count_validate = $this->validate_model->get_kitchen_admin($kitchen_admin_data['email_id'],$kitchen_admin_data['user_name']);
            if ($get_count_validate == 0)
            {
             $get_insert = $this->insert_model->insert_kitchen_admin($kitchen_admin_data);
              if($get_insert)
              {

                $this->email->from('zenopsysevolve@gmail.com', 'FSDMS Appliacation');
                $this->email->to((string)$kitchen_admin_data['email_id']);
                $this->email->subject('Confirm Registration');
                $message = "<html>";
                $message .= "<body>";
                $message .= "<p> Please, click on the link to confirm the registration on FSDMS </p>";
                $message .= "<p> <b>Email Id : ".$kitchen_admin_data['email_id']."</b></p>";
                $message .= "<p> <b>User Name : ".$kitchen_admin_data['user_name']."</b></p>";
                $message .= "<p> <b> Password : ".$kitchen_admin_data['password']."</b></p>";
                $message .= "<p><a href='".base_url()."superadmin/confirmation/1/".base64_encode($kitchen_admin_data['email_id'])."/".base64_encode($kitchen_admin_data['password'])."'> Click to Confirm  </a></p>";
                $message .= "</body>";
                $message .= "</html>";
                $this->email->message($message);
                $this->email->send();

                echo $this->email->print_debugger();
                  //redirect(base_url()."superadmin/confirmation/1");


               
              }
               echo "<script> Mail has send to this email id ,Please check and click link. </script>";
              echo "<script>window.location.href='".base_url()."Superadmin/manage_kitchen_admin/';</script>";
              
            }
            else
            {
              $this->create_kitchen_admin("KAD");
            }
          }     
      }
      else
      {
        $this->create_kitchen_admin();
      }
    }

      //11-2-19 email sending 
    public function confirmation()
    {
      
      $get_url_value = $this->uri->segment(3);
      if($get_url_value == 1)
      {
      $get_encoded_email = $this->uri->segment(4);
      $get_encoded_pwd = $this->uri->segment(5);
       $data["email_address"] = base64_decode($get_encoded_email);
       $data["pwd"] = base64_decode($get_encoded_pwd);
      $data['kitchen_admin_data'] = $this->select_model->select_kitchen_admin();

       $this->load->view('headers/kitchenheader');
      //$this->load->view('products/create_pwd',$data);
      $this->load->view('products/pwd_create',$data);
      $this->load->view('headers/footer');
      
      }
      if($get_url_value == 2)
      {
      $get_encoded_email = $this->uri->segment(4);
      $get_encoded_pwd = $this->uri->segment(5);
       $data["email_address"] = base64_decode($get_encoded_email);
       $data["pwd"] = base64_decode($get_encoded_pwd);
       $data["individual_user"] = "customer";
      //$data['kitchen_admin_data'] = $this->select_model->select_kitchen_admin();
       $this->load->view('headers/kitchenheader',$data);
      //$this->load->view('products/create_pwd',$data);
      $this->load->view('products/pwd_create',$data);
      $this->load->view('headers/footer');
      
      }
    }


    //11-2-19
    function create_password()
    {
      //$this->form_validation->set_rules('email','email','required');
     //$this->form_validation->set_rules('password','password','required');
     // $this->form_validation->set_rules('new_pwd','new_pwd','required');
     //$this->form_validation->set_rules('retype_password','retype_password','required');
      
      
     // if($this->form_validation->run())
      // {

          $oldpwd = $this->input->post("con_password");
          $email = $this->input->post("email");
          $olduserpwd = $this->input->post("password");
          $newpwd = $this->input->post("new_pwd");
          $conpwd = $this->input->post("re_pwd");
          $status = "1";
         if($oldpwd == $olduserpwd)
         {

          if($newpwd == $conpwd)
          {
            $updated = $this->update_model->update_kitchenadmin_login($email,$newpwd);
             
               
              redirect(base_url()."kitchen/");
            
         }
        
        }
        
     // }
       // else{
       //  redirect(base_url()."superadmin/create_kitchen_admin");
       // }
     }
    //8-2-19
    public function manage_kitchen_admin()
    {
      if($this->session->has_userdata('admin_id'))
      {
        $data['user_data'] = $this->select_model->select_user($this->backend_table,$this->admin_id);
        $this->load->view('headers/superadmin_home_header',$data);
        $data['kitchen_admin_data'] = $this->select_model->select_kitchen_admin();
        $this->load->view('products/manage_kitchen_admin',$data);
        $this->load->view('headers/footer');
      }
      else
      {
        $this->error_403();
      }
    } 

    //8-2-19
    public function edit_kitchen_admin($error =NULL)
    { 
       if($this->session->has_userdata('admin_id'))
        {
           $id = $this->uri->segment(3);
            $data['user_data'] = $this->select_model->select_user($this->backend_table,$this->admin_id);
            $data['kitchen_ids'] = $this->select_model->select_kitchen_register();
            $data['kicthen_admin_id'] = $this->select_model->kicthen_admin_id($id);
            $this->load->view('headers/superadmin_home_header',$data);
            $this->load->view('products/kitchen_admin',$data);
            $this->load->view('headers/footer');
      }
      else
      {
            $this->error_403();
      }
    }
    //11-2-19
    function edit_kitchen_admin_data()
    {
     $this->form_validation->set_rules('kitchen_id','kitchen_id','required');
      $this->form_validation->set_rules('first_name','first_name','required');
      $this->form_validation->set_rules('last_name','last_name','required');
      $this->form_validation->set_rules('email','email','required');
      $this->form_validation->set_rules('user_name','user_name','required');
      //$this->form_validation->set_rules('password','password','required');

      if($this->form_validation->run())
       {
      
       $kitchen_admin_data = array(
          "kitchen_id" => $this->input->post("kitchen_id"),
          "first_name" => $this->input->post("first_name"),
          "last_name" => $this->input->post("last_name"),
          "email_id" => $this->input->post("email"),
          "user_name" => $this->input->post("user_name")
          //"password" => $this->input->post("password")
         );
            if($this->input->post('update'))
           {
          
            $get_update = $this->update_model->update_kitchen_admin($this->input->post("khidden_id"),$kitchen_admin_data);
             if($get_update)
             {
              
              echo "<script> alert('kitchen admin data updated'); </script>";
              echo "<script>window.location.href='".base_url()."Superadmin/manage_kitchen_admin/';</script>";
              }
             }
        }
      else
      {
        if($this->session->has_userdata('admin_id'))
            {
                $id = $this->input->post("khidden_id");
                $data['user_data'] = $this->select_model->select_user($this->backend_table,$this->admin_id);
                $data['kitchen_ids'] = $this->select_model->select_kitchen_register();
                $data['kicthen_admin_id'] = $this->select_model->kicthen_admin_id($id);
                $this->load->view('headers/superadmin_home_header',$data);
                $this->load->view('products/kitchen_admin',$data);
                $this->load->view('headers/footer');
            }
            else
            {
                $this->error_403();
            }
      }
    }

     //11-2-19
    function delete_kitchen_admin()
    {

      $get_affected_rows = $this->delete_model->delete_kitchen_admin($this->uri->segment(3));
      if($get_affected_rows)
      {
         redirect(base_url()."superadmin/manage_kitchen_admin",'refresh');
      }
    }

    //12-2-19
   public function individual_customer($error = NULL)
    {

      if($this->session->has_userdata('admin_id'))
        {
            $data['user_data'] = $this->select_model->select_user($this->backend_table,$this->admin_id);
            if($error != NULL)
            {
              $data['error'] = "ICD";
            }
            
            $this->load->view('headers/superadmin_home_header',$data);
            $this->load->view('products/individual_customer',$data);
            $this->load->view('headers/footer');
      }
      else
      {
            $this->error_403();
      }
   
    }
    //13-2-19
    public function individual_customer_data()
    {
      $this->form_validation->set_rules('first_name', 'First Name', 'required');
      $this->form_validation->set_rules('middle_name', 'Middle Name', 'required');
      $this->form_validation->set_rules('last_name', 'Last Name', 'required');
      $this->form_validation->set_rules('email_id', 'Email Id', 'required');
      //$this->form_validation->set_rules('user_password', 'Password', 'required');
      $this->form_validation->set_rules('phone_number', 'Phone Number', 'required|max_length[10]');
      $this->form_validation->set_rules('dob', 'Date Of Birth', 'required');
      $this->form_validation->set_rules('blood_group', 'Blood Group', 'required');
      $this->form_validation->set_rules('meal_type', 'Meal Type', 'required');
      $this->form_validation->set_rules('address[]', 'Address', 'required');
       //$this->form_validation->set_rules('address[1]', 'Address', 'required');
        //$this->form_validation->set_rules('address[2]', 'Address', 'required');
      $this->form_validation->set_rules('city', 'City', 'required');
      $this->form_validation->set_rules('state', 'State', 'required');
      
      if ($this->form_validation->run())
      {
        $address = implode(",",$this->input->post("address"));

        $individual_data = array(
           

          "user_title"=>$this->input->post("title"),
          "first_name"=>$this->input->post("first_name"),
          "middle_name"=>$this->input->post("middle_name"),
          "last_name"=>$this->input->post("last_name"),
          "email"=>$this->input->post("email_id"),
          "phone_number"=>$this->input->post("phone_number"),
          "dob"=>$this->input->post("dob"),
          "blood_group"=>$this->input->post("blood_group"),
          "meal_type"=>$this->input->post("meal_type"),
          "address"=> $address,
          "city"=>$this->input->post("city"),
          "state"=>$this->input->post("state")      
        );

        $login_data = array(
          "email_id"=>$this->input->post("email_id"),
          "phone_number"=>$this->input->post("phone_number"),
          "password" => $this->input->post("user_password"),
          "active"=>"0"
        );
         $get_count_validate = $this->validate_model->validate_individual_registration($individual_data['email'],$individual_data['phone_number']);
         $get_login_count = $this->validate_model->check_duplicate_login($individual_data['email']);
          if ($get_count_validate == 0 && $get_login_count == 0)
          {



             $insert_individual_cus = $this->insert_model->insert_individual_details($individual_data);
              $insert_login_details = $this->insert_model->insert_login_details($login_data);
           
              if($insert_login_details)
              {

              $this->email->from('zenopsysevolve@gmail.com', 'FSDMS Appliacation');
              $this->email->to((string)$login_data['email_id']);
              $this->email->subject('Confirm Registration');
              $message = "<html>";
              $message .= "<body>";
              $message .= "<p> Please, click on the link to confirm the registration on FSDMS </p>";

              $message .= "<p> <b>Email Id : ".$login_data['email_id']."</b></p>";
              $message .= "<p> <b> Password : ".$login_data['password']."</b></p>";
              $message .= "<p><a href='".base_url()."superadmin/confirmation/2/".base64_encode($login_data['email_id'])."/".base64_encode($login_data['password'])."'> Click to Confirm  </a></p>";

              $message .= "</body>";
              $message .= "</html>";
              $this->email->message($message);
              $this->email->send();

              echo $this->email->print_debugger();
              echo "<script>window.location.href='".base_url()."Superadmin/manage_individual/';</script>";
             }



            if($insert_individual_cus)
            {
                echo "<script> alert('inserted successfully'); </script>";
                 echo "<script>window.location.href='".base_url()."Superadmin/manage_individual/';</script>";
            } 
          }
          else
          {
              $this->individual_customer("ICD");
          }
      }
      else
      {
        $this->individual_customer();
      }
    }
    //14-2-19
    function individual_password()
    {
        $oldpwd = $this->input->post("con_password");
        $email = $this->input->post("email");
        $olduserpwd = $this->input->post("password");
        $newpwd = $this->input->post("new_pwd");
        $conpwd = $this->input->post("re_pwd");
        //$status = "1";
        if($oldpwd == $olduserpwd)
         {

          if($newpwd == $conpwd)
          {
            $updated = $this->update_model->update_indiv_login($email,$newpwd);
             redirect(base_url()."login/");
          }
        
        }
    }
    //13-2-19 
    public function manage_individual()
    {
     if($this->session->has_userdata('admin_id'))
      {
           $data['user_data'] = $this->select_model->select_user($this->backend_table,$this->admin_id);
          $data['individual_data'] = $this->select_model->select_individual_customer();
          $this->load->view('headers/superadmin_home_header',$data);
          $this->load->view('products/manage_individual',$data);
          $this->load->view('headers/footer');
        }
      else
      {
          $this->error_403();
      }

    }
    //13-2-19
    function edit_individual()
    {
      if($this->session->has_userdata('admin_id'))
        {
            $data['user_data'] = $this->select_model->select_user($this->backend_table,$this->admin_id);
            $id = $this->uri->segment(3);
            $data['indiv_data_id'] = $this->select_model->select_individual_id($id);
            
            $this->load->view('headers/superadmin_home_header',$data);
            $this->load->view('products/individual_customer',$data);
            $this->load->view('headers/footer');
      }
      else
      {
            $this->error_403();
      }
    }

    //13-2-19
    function edit_individual_data()
    {
      $this->form_validation->set_rules('first_name', 'First Name', 'required');
      $this->form_validation->set_rules('middle_name', 'Middle Name', 'required');
      $this->form_validation->set_rules('last_name', 'Last Name', 'required');
      $this->form_validation->set_rules('email_id', 'Email Id', 'required');
     
      $this->form_validation->set_rules('phone_number', 'Phone Number', 'required|max_length[10]');
      $this->form_validation->set_rules('dob', 'Date Of Birth', 'required');
      $this->form_validation->set_rules('blood_group', 'Blood Group', 'required');
      $this->form_validation->set_rules('meal_type', 'Meal Type', 'required');
      $this->form_validation->set_rules('address[]', 'Address', 'required');
      $this->form_validation->set_rules('city', 'City', 'required');
      $this->form_validation->set_rules('state', 'State', 'required');
      
      if ($this->form_validation->run())
      {
        $id = $this->input->post("hidden_id");
        $address = implode(",",$this->input->post("address"));

        $individual_data = array(
          "user_title"=>$this->input->post("title"),
          "first_name"=>$this->input->post("first_name"),
          "middle_name"=>$this->input->post("middle_name"),
          "last_name"=>$this->input->post("last_name"),
          "email"=>$this->input->post("email_id"),
          "phone_number"=>$this->input->post("phone_number"),
          "dob"=>$this->input->post("dob"),
          "blood_group"=>$this->input->post("blood_group"),
          "meal_type"=>$this->input->post("meal_type"),
          "address"=> $address,
          "city"=>$this->input->post("city"),
          "state"=>$this->input->post("state")      
        );

       if($this->input->post("update"))
        {
            $update_individual_cus = $this->update_model->update_individual_user_data($id,$individual_data);
            
            if($update_individual_cus)
            {
                echo "<script> alert('Updated successfully'); </script>";
                 echo "<script>window.location.href='".base_url()."Superadmin/manage_individual/';</script>";
            } 

        }
      }
      else
      {
        if($this->session->has_userdata('admin_id'))
        {
            $data['user_data'] = $this->select_model->select_user($this->backend_table,$this->admin_id);
            $id = $this->input->post("hidden_id");
             $data['indiv_data_id'] = $this->select_model->select_individual_id($id);
            
            $this->load->view('headers/superadmin_home_header',$data);
            $this->load->view('products/individual_customer',$data);
            $this->load->view('headers/footer');
      }
      else
      {
            $this->error_403();
      }
    }
  }
   //13-2-19
    function delete_individual_customer()
    {

      $get_affected_rows = $this->delete_model->delete_individual_customer($this->uri->segment(3));
      if($get_affected_rows)
      {
         redirect(base_url()."superadmin/manage_individual",'refresh');
      }
    }
    
    //12-2-19
    public function corporate_customer($error = NULL)
    {
      
      if($this->session->has_userdata('admin_id'))
        {
            $data['user_data'] = $this->select_model->select_user($this->backend_table,$this->admin_id);
            if($error != NULL)
            {
              $data['error'] = "KAD";
            }
            
            $this->load->view('headers/superadmin_home_header',$data);
            $this->load->view('products/corporate_customer',$data);
            $this->load->view('headers/footer');
      }
      else
      {
            $this->error_403();
      }
   
    }

    public function error_403()
    {
        $this->load->view('404');
        $this->load->view('headers/footer');
    }



    /**
     * KIll SESSIONS
     * ===============
     */

        public function logout()
        {
            $this->session->sess_destroy();
            redirect(base_url()."superadmin");
        }

}

/* End of file Superadmin.php */
