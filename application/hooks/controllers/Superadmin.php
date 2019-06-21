
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
      $this->load->model('create_model');

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
    //08-05-19
     public function orders_list()
    {
        if($this->session->has_userdata('admin_id'))
        {
            $data['user_data'] = $this->select_model->select_user($this->backend_table,$this->admin_id);
            $data['date_products'] = $this->select_model->select_products_dates();
            $data['get_array'] = $this->select_model->select_product_master(1);
            $this->load->view('headers/superadmin_home_header',$data);
            $this->load->view('superadmin/superadmin_orders',$data);
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
        $get_value = $this->select_model->select_user("category_master",$this->uri->segment(3));
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
                redirect(base_url()."superadmin/update_category/".$this->uri->segment(3),'refresh');
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
            $data['kithen'] = $this->select_model->select_kitchen_register();
            $data['category_master'] = $this->select_model->get_category_master();
            $data['meal_prefer'] = $this->select_model->get_mealprefer_master();
            $data['meal_plan'] = $this->select_model->get_mealplan_master();
              if($this->uri->segment(3) != NULL)
              {
                $data['get_product_by_id'] = $this->select_model->get_product_by_id($this->uri->segment(3));
              }

            if($error != NULL)
            {
              $data['error'] = "PAE";
            }

            $this->load->view('products/new_product',$data);
            $this->load->view('headers/footer');
      }
      else
      {
            $this->error_403();
      }
    }

   //08-05-19(ved changed)
      public function insert_product()
    {
       $this->form_validation->set_rules('meal_type','meal_type','required');
       $this->form_validation->set_rules('meal_plan','meal_plan','required');
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
       //$this->form_validation->set_rules('kithen_id','kithen_id','required');
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
              //'kitchen_id' => $this->input->post('kithen_id'),
              'product_name' => $this->input->post('product_name'),
              'product_sku' => $this->input->post('product_sku'),
              'product_quantity' => $this->input->post('product_quantity'),
              'product_price' => $this->input->post('product_price'),
              'meal_type' => $this->input->post('meal_type'),
              'meal_plan' => $this->input->post('meal_plan'),
              'product_category' => $this->input->post('category'),
              'product_image' => "NULL",
              'is_customizable' => $this->input->post('custom_options')
              );

              $set_is_customizable = NULL;

          if($this->input->post('custom_options') == "custom_yes")
          {
               
          //products seperated by ,
                              $get_customizable_product_array = $this->input->post('customizable_name[]');
                              $get_customizable_product_string = implode(",",$get_customizable_product_array);

                              //sku seperated by ,
                              $get_customizable_product_sku_array = $this->input->post('customizable_sku[]');
                              $get_customizable_product_sku_string = implode(",",$get_customizable_product_sku_array);

                              //prices seperated by ,
                              $get_customizable_price_array = $this->input->post('customizable_price[]');
                              $get_customizable_price_string = implode(",",$get_customizable_price_array);

                            $set_is_customizable = array(
                              'product_category' => $set_product['product_category'],
                              'product_sku' => $set_product['product_sku'],
                              'customizable_product' => $get_customizable_product_string,
                              'customizable_sku' => $get_customizable_product_sku_string,
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
    //08-05-19(ved changed)
    
public function update_product()
    {
      $this->session->set_userdata("product_id",$this->session->userdata('product_id'));
       //$this->form_validation->set_rules('kitchen_id','kitchen_id','required');
       $this->form_validation->set_rules('meal_type','meal_type','required');
       $this->form_validation->set_rules('category','category','required');
       $this->form_validation->set_rules('meal_plan','meal_plan','required');
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
             //'kitchen_id' => $this->input->post('kitchen_id'),
              'product_name' => $this->input->post('product_name'),
              'product_sku' => $this->input->post('product_sku'),
              'product_quantity' => $this->input->post('product_quantity'),
              'product_updated_quantity'=>$this->input->post('product_update_quantity'),
              'product_price' => $this->input->post('product_price'),
              'meal_type' => $this->input->post('meal_type'),
              'meal_plan' => $this->input->post('meal_plan'),
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
                              $get_customizable_product_array = $this->input->post('customizable_name[]');
                              $get_customizable_product_string = implode(",",$get_customizable_product_array);

                              //sku seperated by ,
                              $get_customizable_product_sku_array = $this->input->post('customizable_sku[]');
                              $get_customizable_product_sku_string = implode(",",$get_customizable_product_sku_array);

                              //prices seperated by ,
                              $get_customizable_price_array = $this->input->post('customizable_price[]');
                              $get_customizable_price_string = implode(",",$get_customizable_price_array);

                            $set_is_customizable = array(
                              'product_category' => $set_product['product_category'],
                              'product_sku' => $set_product['product_sku'],
                              'customizable_product' => $get_customizable_product_string,
                              'customizable_sku' => $get_customizable_product_sku_string,
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
             $data['meal_prefer'] = $this->select_model->get_mealprefer_master();
            $data['meal_plan'] = $this->select_model->get_mealplan_master(); 
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
            $this->load->view('kitchen/new_kitchen',$data);
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
                //echo "<script> alert('kitchen data inserted'); </script>";
                //echo "<script>window.location.href='".base_url()."Superadmin/manage_kitchen/';</script>";
              $create_kitchen_inventory = $this->create_model->create_inventory_tables($kitchen_data['k_id']);
                if($create_kitchen_inventory)
                {
                echo "<script> alert('kitchen data inserted'); </script>";
                echo "<script>window.location.href='".base_url()."Superadmin/manage_kitchen/';</script>";
                }
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
        $this->load->view('kitchen/manage_kitchen',$data);
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
            $this->load->view('kitchen/new_kitchen',$data);
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
          $get_drop_count = $this->delete_model->drop_kitchen_dependent_tables($this->uri->segment(3));
            if($get_drop_count >= 0)
            {
              redirect(base_url()."superadmin/manage_kitchen",'refresh');
            }
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
                $this->load->view('kitchen/new_kitchen',$data);
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
            $this->load->view('kitchen/kitchen_admin',$data);
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
        $data["kitchen"] = "kitchen_admin";
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
       if($get_url_value == 3)
      {
      $get_encoded_email = $this->uri->segment(4);
      $get_encoded_pwd = $this->uri->segment(5);
       $data["email_address"] = base64_decode($get_encoded_email);
       $data["pwd"] = base64_decode($get_encoded_pwd);
       $data["corporate_company"] = "Company";
      //$data['kitchen_admin_data'] = $this->select_model->select_kitchen_admin();
       $this->load->view('headers/kitchenheader',$data);
      //$this->load->view('products/create_pwd',$data);
      $this->load->view('products/pwd_create',$data);
      $this->load->view('headers/footer');
      
      }
       if($get_url_value == 4)
      {
      $get_encoded_email = $this->uri->segment(4);
      $get_encoded_pwd = $this->uri->segment(5);
       $data["email_address"] = base64_decode($get_encoded_email);
       $data["pwd"] = base64_decode($get_encoded_pwd);
       $data["representative"] = "representative";
      //$data['kitchen_admin_data'] = $this->select_model->select_kitchen_admin();
       $this->load->view('headers/kitchenheader',$data);
      //$this->load->view('products/create_pwd',$data);
      $this->load->view('products/pwd_create',$data);
      $this->load->view('headers/footer');
      
      }
       if($get_url_value == 5)
      {
      $get_encoded_email = $this->uri->segment(4);
      $get_encoded_pwd = $this->uri->segment(5);
       $data["email_address"] = base64_decode($get_encoded_email);
       $data["pwd"] = base64_decode($get_encoded_pwd);
       $data["deliveryhub"] = "deliveryhub";
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
        $this->load->view('kitchen/manage_kitchen_admin',$data);
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
            $this->load->view('kitchen/kitchen_admin',$data);
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
                $this->load->view('kitchen/kitchen_admin',$data);
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
            $this->load->view('customer/individual_customer',$data);
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
          $this->load->view('customer/manage_individual',$data);
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
            $this->load->view('customer/individual_customer',$data);
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
            $this->load->view('customer/individual_customer',$data);
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
         redirect(base_url()."Superadmin/manage_individual",'refresh');
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
              $data['error'] = "COM";
            }
            
            $this->load->view('headers/superadmin_home_header',$data);
            $this->load->view('customer/corporate_customer',$data);
            $this->load->view('headers/footer');
      }
      else
      {
            $this->error_403();
      }
   
    }

    //14-2-19
    public function corporate_customer_data()
    {

    $this->form_validation->set_rules('company_name','Company Name','required');
    $this->form_validation->set_rules('company_telephone','Telephone','required');
    $this->form_validation->set_rules('company_gstn','GSTN','required');
    $this->form_validation->set_rules('company_address[]','Address','required');
    $this->form_validation->set_rules('company_city','City','required');
    $this->form_validation->set_rules('company_state','State','required');
    $this->form_validation->set_rules('company_title','Title','required');
    $this->form_validation->set_rules('rep_first_name','First Name','required');
    $this->form_validation->set_rules('rep_middle_name','Middle Name','required');
    $this->form_validation->set_rules('rep_last_name','Last Name','required');
    $this->form_validation->set_rules('rep_designation','Designation','required');
    $this->form_validation->set_rules('rep_employee_id','Employee ID','required');
    $this->form_validation->set_rules('rep_email_id','Email ID','required');
    $this->form_validation->set_rules('rep_phone_number','Phone Number','required');
    //$this->form_validation->set_rules('corporate_user_password','User Password','required');
    //$this->form_validation->set_rules('corporate_confirm_password','Confirm Password','required');

    if ($this->form_validation->run())
    {
      $address = implode(",",$this->input->post("company_address"));
       $company_data = array(
          "company_name"=>$this->input->post("company_name"),
          "company_telephone"=>$this->input->post("company_telephone"),
          "company_gstn"=>$this->input->post("company_gstn"),
          "company_address"=>$address,
          "company_city"=>$this->input->post("company_city"),
          "company_state"=>$this->input->post("company_state")
        );

        $representative_data = array(
          "company_name"=>$company_data['company_name'],
          "user_title"=>$this->input->post("company_title"),
          "first_name"=>$this->input->post("rep_first_name"),
          "middle_name"=>$this->input->post("rep_middle_name"),
          "last_name"=>$this->input->post("rep_last_name"),
          "rep_designation"=>$this->input->post("rep_designation"),
          "rep_employee_id"=>$this->input->post("rep_employee_id"),
          "rep_email_id"=>$this->input->post("rep_email_id"),
          "rep_phone_number"=>$this->input->post("rep_phone_number"),
          "admin" =>"1"
        );

        $login_data = array(
          "email_id"=>$representative_data['rep_email_id'],
          "phone_number"=>$representative_data['rep_phone_number'],
          "password"=>$this->input->post("corporate_user_password"),
          "active"=>"0",
          "admin"=>"1"
        );
        

         
        $get_company_count = $this->validate_model->validate_company_data($company_data['company_name'],$company_data['company_gstn']);



        if($get_company_count == 0)
        {
          

          $get_affected = $this->insert_model->insert_company_data($company_data);
         
          if($get_affected == 1)
          {

            echo "<script> alert(inside to validate user) </script>";
            $get_rep_count = $this->validate_model->validate_corporate_user($representative_data['company_name'],$representative_data['rep_employee_id'],$representative_data['rep_email_id']);
            $get_login_count = $this->validate_model->check_duplicate_login($login_data['email_id']);
            //echo $get_rep_count;
            if($get_rep_count == 0 && $get_login_count == 0)
            {
              $get_affected_rows1 = $this->insert_model->insert_corporate_user($representative_data);
              if($get_affected_rows1)
              {
                $get_affected_rows2 = $this->insert_model->insert_login_details($login_data);
                 echo "<script>window.location.href='".base_url()."Superadmin/manage_corporate/';</script>";

               

                if($get_affected_rows2)
              {

              $this->email->from('zenopsysevolve@gmail.com', 'FSDMS Appliacation');
              $this->email->to((string)$login_data['email_id']);
              $this->email->subject('Confirm Registration');
              $message = "<html>";
              $message .= "<body>";
              $message .= "<p> Please, click on the link to confirm the registration on FSDMS </p>";

              $message .= "<p> <b>Email Id : ".$login_data['email_id']."</b></p>";
              $message .= "<p> <b> Password : ".$login_data['password']."</b></p>";
              $message .= "<p><a href='".base_url()."superadmin/confirmation/3/".base64_encode($login_data['email_id'])."/".base64_encode($login_data['password'])."'> Click to Confirm  </a></p>";

              $message .= "</body>";
              $message .= "</html>";
              $this->email->message($message);
              $this->email->send();

              echo $this->email->print_debugger();
              echo "<script>window.location.href='".base_url()."Superadmin/manage_individual/';</script>";
             }

              }
            }
            else
            {
              $this->corporate_customer("COM");
            }
          }
        }
        else
        {

          $this->load->model('insert_model');

          $get_rep_count = $this->validate_model->validate_corporate_user($representative_data['company_name'],$representative_data['rep_employee_id'],$representative_data['rep_email_id']);
          if($get_rep_count == 0)
          {
            $get_affected_rows1 = $this->insert_model->insert_corporate_user($representative_data);
            if($get_affected_rows1)
            {
              $get_affected_rows2 = $this->insert_model->insert_login_details($login_data);
            }
          }
          else
          {
              $this->load->view('headers/loginheader');
              $this->login_error("uae");
              $this->load->view('headers/footer');
          }
        }

        
      }
      else
      {
        $this->corporate_customer();
      }
      
    }

   //15-2-19

    public function manage_corporate()
    {
     if($this->session->has_userdata('admin_id'))
      {
        $data['user_data'] = $this->select_model->select_user($this->backend_table,$this->admin_id);
        $data['corporate_data'] = $this->select_model->select_corporate_customer();

          $this->load->view('headers/superadmin_home_header',$data);
          $this->load->view('customer/manage_corporate',$data);
          $this->load->view('headers/footer');
        }
      else
      {
          $this->error_403();
      }

    }

 //15-2-19
    function edit_corporate()
    {
      if($this->session->has_userdata('admin_id'))
        {
            $data['user_data'] = $this->select_model->select_user($this->backend_table,$this->admin_id);
            $id = base64_decode($this->uri->segment(3));
            $data['corporate_data_id'] = $this->select_model->select_corporate_id($id);
           
            $this->load->view('headers/superadmin_home_header',$data);
            $this->load->view('customer/corporate_customer',$data);
            $this->load->view('headers/footer');
      }
      else
      {
            $this->error_403();
      }
    }
    //15-2-19
    function edit_corporate_data()
    {

    $this->form_validation->set_rules('company_name','Company Name','required');
    $this->form_validation->set_rules('company_telephone','Telephone','required');
    $this->form_validation->set_rules('company_gstn','GSTN','required');
    $this->form_validation->set_rules('company_address[]','Address','required');
    $this->form_validation->set_rules('company_city','City','required');
    $this->form_validation->set_rules('company_state','State','required');
    $this->form_validation->set_rules('company_title','Title','required');
    $this->form_validation->set_rules('rep_first_name','First Name','required');
    $this->form_validation->set_rules('rep_middle_name','Middle Name','required');
    $this->form_validation->set_rules('rep_last_name','Last Name','required');
    $this->form_validation->set_rules('rep_designation','Designation','required');
    $this->form_validation->set_rules('rep_employee_id','Employee ID','required');
    $this->form_validation->set_rules('rep_email_id','Email ID','required');
    $this->form_validation->set_rules('rep_phone_number','Phone Number','required');

    if ($this->form_validation->run())
    {
      $id = $this->input->post("hidden_id");
      $cid = $this->input->post("chidden_id");
      $uid = $this->input->post("uhidden_id");
      $address = implode(',',$this->input->post("company_address"));
      $company_data = array(
          "company_name"=>$this->input->post("company_name"),
          "company_telephone"=>$this->input->post("company_telephone"),
          "company_gstn"=>$this->input->post("company_gstn"),
          "company_address"=>$address,
          "company_city"=>$this->input->post("company_city"),
          "company_state"=>$this->input->post("company_state")
        );

        $representative_data = array(
          "company_name"=>$company_data['company_name'],
          "user_title"=>$this->input->post("company_title"),
          "first_name"=>$this->input->post("rep_first_name"),
          "middle_name"=>$this->input->post("rep_middle_name"),
          "last_name"=>$this->input->post("rep_last_name"),
          "rep_designation"=>$this->input->post("rep_designation"),
          "rep_employee_id"=>$this->input->post("rep_employee_id"),
          "rep_email_id"=>$this->input->post("rep_email_id"),
          "rep_phone_number"=>$this->input->post("rep_phone_number")
        );

        $login_data = array(
         
          "phone_number"=>$this->input->post("rep_phone_number")
         
        );

      if($this->input->post("update"))
        {
            $update_corporate_cus = $this->update_model->update_corporate_user_data($id,$representative_data);
            $update_company_cus = $this->update_model->update_company_data($cid,$company_data);
            $update_coruser_login = $this->update_model->update_corporate_user_login($uid,$login_data);
            if($update_corporate_cus >=0 || $update_company_cus >=0 || $update_coruser_login >=0)
            {
                echo "<script> alert('Updated successfully'); </script>";
                 echo "<script>window.location.href='".base_url()."Superadmin/manage_corporate/';</script>";
            } 

        }
      }
      else
      {
        //$this->corporate_customer();
         if($this->session->has_userdata('admin_id'))
            {
                $data['user_data'] = $this->select_model->select_user($this->backend_table,$this->admin_id);
                $id = $this->input->post("en_email");
                
                 $data['corporate_data_id'] = $this->select_model->select_corporate_id($id);
                $this->load->view('headers/superadmin_home_header',$data);
                $this->load->view('customer/corporate_customer',$data);
                $this->load->view('headers/footer');
          }
          else
          {
                $this->error_403();
          }
          
      }

       
    }

//18-2-19
    function delete_corporate_customer()
    {

      $get_affected_rows = $this->delete_model->delete_corporate_customer($this->uri->segment(3));
      if($get_affected_rows)
      {
         redirect(base_url()."superadmin/manage_corporate",'refresh');
      }
    }
   //19-2-19 
    function create_mealpreference($error=NULL,$data_array=NULL)
    {
      if($this->session->has_userdata('admin_id'))
        {
            $data['user_data'] = $this->select_model->select_user($this->backend_table,$this->admin_id);
             $this->load->view('headers/superadmin_home_header',$data);
          $data['mealprefer_master'] = $this->select_model->get_mealprefer_master();
            //   if(isset($meal_array))
            // {
            //     $data['update'] = 1;
            //     $data['id'] = $meal_array['id'];
            //     $data['meal_plan'] = $meal_array['meal_plan'];
            //  }
            $data['error_handler'] = $error;
            $this->load->view('products/meal_preference',$data);
            $this->load->view('headers/footer');
      }
      else
      {
            $this->error_403();
      }
    }
 //add meal plan data  
    function insert_mealpreference()
    {
      $this->form_validation->set_rules('meal_prefer', 'meal_prefer', 'required');
       if ($this->form_validation->run()) 
       {
          $insert_mealprefer = array(
                "meal_preference"=>$this->input->post("meal_prefer")
          );
           $get_count = $this->validate_model->get_meal_preference($insert_mealprefer['meal_preference']);


           if(!($get_count))
          {
            $get_affected_rows = $this->insert_model->insert_meal_prefer($insert_mealprefer);
            if($get_affected_rows)
            {
                echo "<script> alert('Created Meal Preference'); </script>";
                $this->create_mealpreference();
            }
          }
          else
          {
            //$this->create_category("vae");
            echo "<script> alert('Error(VAMP): Value Already Exists.'); </script>";
            $this->create_mealpreference();
          }
        } 
       else 
       {
           $this->create_mealpreference("Required");
       }

    }

     //update meal perference data
     public function update_mealpreference()
    {
       if($this->session->has_userdata('admin_id'))
        {
            $data['user_data'] = $this->select_model->select_user($this->backend_table,$this->admin_id);
            $data['mealprefer_master'] = $this->select_model->get_mealprefer_master();
   
        $data["get_value"] = $this->select_model->select_user("meal_preference_master",$this->uri->segment(3));
          
          $this->load->view('headers/superadmin_home_header',$data);
          $this->load->view('products/meal_preference',$data);
          $this->load->view('headers/footer');
              

        /*
         *  Update button
         */

        if($this->input->post('meal_update') == "meal_update")
        {

            $this->form_validation->set_rules('update_mealperfer','update_mealprefer','required');
            
            if($this->form_validation->run())
            {
                 $get_update = array(
                    "id" => $this->input->post('update_id'),
                    "meal_preference" => (string)$this->input->post('update_mealperfer')
                );

                $get_update_count = $this->update_model->update_mealprefer_master($get_update);
                if($get_update_count)
                {
                    echo "<script> alert('Updated'); </script>";
                    redirect(base_url()."superadmin/update_mealpreference/".$this->uri->segment(3),'refresh');
                }

            }
            else
            {
                echo "<script> alert('ERROR(UVE) : Update Value Should Not Be Empty'); </script>";
                redirect(base_url()."superadmin/update_mealpreference/".$this->uri->segment(3),'refresh');
            }
         
        }
       }
      else
      {
            $this->error_403();
      }
    }
     //delete meal perference
     public function delete_mealprefer()
      {
            $get_affected_rows = $this->delete_model->delete_mealpref($this->uri->segment(3));
            
            if($get_affected_rows)
            {
               redirect(base_url()."superadmin/create_mealpreference",'refresh');
            }
        }

    //19-2-19 
    //create meal type
    function create_mealplan($error=NULL,$data_array=NULL)
    {
      if($this->session->has_userdata('admin_id'))
        {
            $data['user_data'] = $this->select_model->select_user($this->backend_table,$this->admin_id);
               
           
            
            $this->load->view('headers/superadmin_home_header',$data);
             $data['mealplan_master'] = $this->select_model->get_mealplan_master();
              if(isset($meal_array))
            {
                $data['update'] = 1;
                $data['id'] = $meal_array['id'];
                $data['meal_plan'] = $meal_array['meal_plan'];
             }
            $data['error_handler'] = $error;
            $this->load->view('products/meal_plan',$data);
            $this->load->view('headers/footer');
      }
      else
      {
            $this->error_403();
      }
    }

    //add meal plan data  
    function insert_mealplan_data()
    {
      $this->form_validation->set_rules('meal_plan', 'meal_plan', 'required');
       if ($this->form_validation->run()) 
       {
          $insert_mealplan = array(
                "meal_plan"=>$this->input->post("meal_plan")
          );
           $get_count = $this->validate_model->get_meal_plan($insert_mealplan['meal_plan']);


           if(!($get_count))
          {
            $get_affected_rows = $this->insert_model->insert_meal_plan($insert_mealplan);
            if($get_affected_rows)
            {
                echo "<script> alert('Created Meal Plan'); </script>";
                $this->create_mealplan();
            }
          }
          else
          {
            //$this->create_category("vae");
            echo "<script> alert('Error(VAM): Value Already Exists.'); </script>";
            $this->create_mealplan();
          }
        } 
       else 
       {
           $this->create_mealplan("Required");
       }

    }
      //update meal plan data
     public function update_mealplan()
    {
       if($this->session->has_userdata('admin_id'))
        {
            $data['user_data'] = $this->select_model->select_user($this->backend_table,$this->admin_id);
            $data['mealplan_master'] = $this->select_model->get_mealplan_master();
        $data["get_value"] = $this->select_model->select_user("meal_plan_master",$this->uri->segment(3));
          
          $this->load->view('headers/superadmin_home_header',$data);
          $this->load->view('products/meal_plan',$data);
          $this->load->view('headers/footer');
              

        /*
         *  Update button
         */

        if($this->input->post('meal_update') == "meal_update")
        {

            $this->form_validation->set_rules('update_mealplan','update_mealplan','required');
            
            if($this->form_validation->run())
            {
                 $get_update = array(
                    "id" => $this->input->post('update_id'),
                    "meal_plan" => (string)$this->input->post('update_mealplan')
                );

                $get_update_count = $this->update_model->update_mealplan_master($get_update);
                if($get_update_count)
                {
                    echo "<script> alert('Updated'); </script>";
                    redirect(base_url()."superadmin/update_mealplan/".$this->uri->segment(3),'refresh');
                }

            }
            else
            {
                echo "<script> alert('ERROR(UVE) : Update Value Should Not Be Empty'); </script>";
                redirect(base_url()."superadmin/update_mealplan/".$this->uri->segment(3),'refresh');
            }
         
        }
       }
      else
      {
            $this->error_403();
      }
    }
    //delete meal type
     public function delete_mealplan()
      {
            $get_affected_rows = $this->delete_model->delete_mealplan($this->uri->segment(3));
            
            if($get_affected_rows)
            {
               redirect(base_url()."superadmin/create_mealplan",'refresh');
            }
        }
    //========================Store Manager===================================
    //4-03-19
    //create Store Manager
    function create_store_manager($error=NULL,$data_array=NULL)
    {
       if($this->session->has_userdata('admin_id'))
        {
            $data['user_data'] = $this->select_model->select_user($this->backend_table,$this->admin_id);
             $data['company_data'] = $this->select_model->get_corporate_company();
              $data['store_data'] = $this->select_model->get_store_master();
            // if($error != NULL) 
            // {
            //   $data['error'] = "STR";
            // }
            
            $this->load->view('headers/superadmin_home_header',$data);
            $this->load->view('masters/store_manager',$data);
            $this->load->view('headers/footer');
      }
      else
      {
            $this->error_403();
      }
    }

    //store data 
    function insert_store_manager_data()
    {
       $this->form_validation->set_rules('first_name','first_name','required');
       $this->form_validation->set_rules('last_name','last_name','required');
       $this->form_validation->set_rules('mid_name','mid_name','required');
       $this->form_validation->set_rules('email','email','required');
       $this->form_validation->set_rules('phono_num','phono_num','required');
       $this->form_validation->set_rules('employee_id','employee_id','required');
       $this->form_validation->set_rules('company','company','required');
       $this->form_validation->set_rules('branch','branch','required');
       $this->form_validation->set_rules('store','store','required');
       $this->form_validation->set_rules('address1','address1','required');
       $this->form_validation->set_rules('address2','address2','required');
       $this->form_validation->set_rules('address3','address3','required');
       $this->form_validation->set_rules('state','state','required');
       $this->form_validation->set_rules('city','city','required');
       $this->form_validation->set_rules('zipcode','zipcode','required');
         
        if($this->form_validation->run())
       {
       
        $store_data = array(
          "first_name" => $this->input->post("first_name"),
          "mid_name" => $this->input->post("mid_name"),
          "last_name" => $this->input->post("last_name"),
          "email" => $this->input->post("email"),
          "phone_num" => $this->input->post("phono_num"),
          "emp_id" => $this->input->post("employee_id"),
          "company" => $this->input->post("company"),
          "branch" => $this->input->post("branch"),
          "store" => $this->input->post("store"),
          "address1" => $this->input->post("address1"),
          "address2" => $this->input->post("address2"),
          "address3" => $this->input->post("address3"),
          "state" => $this->input->post("state"),
          "city" => $this->input->post("city"),
          "zipcode" => $this->input->post("zipcode")
          );

          
           $get_count = $this->validate_model->get_store_manager($store_data['emp_id']);


           if(!($get_count))
          {
            $get_affected_rows = $this->insert_model->insert_store_manager($store_data);
            if($get_affected_rows)
            {
                echo "<script> alert('Created Store Manager'); </script>";
                $this->manage_store_manager();
            }
          }
          else
          {
            //$this->create_category("vae");
            echo "<script> alert('Error(STR): Value Already Exists.'); </script>";
            $this->create_store_manager("STR");
          }
        }
        else
        {
          $this->create_store_manager();
        }

    }

    //21-2-19
    public function manage_store_manager()
    {
     if($this->session->has_userdata('admin_id'))
      {
        $data['user_data'] = $this->select_model->select_user($this->backend_table,$this->admin_id);
        $data['store_data'] = $this->select_model->get_store_manager();

          $this->load->view('headers/superadmin_home_header',$data);
          $this->load->view('masters/manage_store_manager',$data);
          $this->load->view('headers/footer');
        }
      else
      {
          $this->error_403();
      }

    }
    //21-02-19 edit store
    function edit_store_manager()
    {
      if($this->session->has_userdata('admin_id'))
        {
            $data['user_data'] = $this->select_model->select_user($this->backend_table,$this->admin_id);
            $id = $this->uri->segment(3);
            $data['store_manager_id'] = $this->select_model->get_store_manager_id("$id");
              $data['company_data'] = $this->select_model->get_corporate_company();
              $data['store_data'] = $this->select_model->get_store_master();
            $this->load->view('headers/superadmin_home_header',$data);
           $this->load->view('masters/store_manager',$data);
            $this->load->view('headers/footer');
      }
      else
      {
            $this->error_403();
      }
    }

    //21-2-19 edit store data
    function edit_store_manager_data()
    {
       $this->form_validation->set_rules('first_name','first_name','required');
       $this->form_validation->set_rules('last_name','last_name','required');
       $this->form_validation->set_rules('mid_name','mid_name','required');
       $this->form_validation->set_rules('email','email','required');
       $this->form_validation->set_rules('phono_num','phono_num','required');
       $this->form_validation->set_rules('employee_id','employee_id','required');
       $this->form_validation->set_rules('company','company','required');
       $this->form_validation->set_rules('branch','branch','required');
       $this->form_validation->set_rules('store','store','required');
       $this->form_validation->set_rules('address1','address1','required');
       $this->form_validation->set_rules('address2','address2','required');
       $this->form_validation->set_rules('address3','address3','required');
       $this->form_validation->set_rules('state','state','required');
       $this->form_validation->set_rules('city','city','required');
       $this->form_validation->set_rules('zipcode','zipcode','required');
            
        if($this->form_validation->run())
       {
         $id = $this->input->post("hidden_id");
     
     
     $store_data = array(
           "first_name" => $this->input->post("first_name"),
          "mid_name" => $this->input->post("mid_name"),
          "last_name" => $this->input->post("last_name"),
          "email" => $this->input->post("email"),
          "phone_num" => $this->input->post("phono_num"),
          "emp_id" => $this->input->post("employee_id"),
          "company" => $this->input->post("company"),
          "branch" => $this->input->post("branch"),
          "store" => $this->input->post("store"),
          "address1" => $this->input->post("address1"),
          "address2" => $this->input->post("address2"),
          "address3" => $this->input->post("address3"),
          "state" => $this->input->post("state"),
          "city" => $this->input->post("city"),
          "zipcode" => $this->input->post("zipcode")
        );
       

      if($this->input->post("update"))
        {
           
            $update_store = $this->update_model->update_store_manager($id,$store_data);
            if($update_store >=0)
            {
                echo "<script> alert('Updated successfully'); </script>";
                 echo "<script>window.location.href='".base_url()."Superadmin/manage_store_manager/';</script>";
            } 

        }
        

        }
        else
        {
          if($this->session->has_userdata('admin_id'))
            {
               $data['user_data'] = $this->select_model->select_user($this->backend_table,$this->admin_id);
            $id = $this->uri->segment(3);
            $data['store_manager_id'] = $this->select_model->get_store_manager_id("$id");
              $data['company_data'] = $this->select_model->get_corporate_company();
              $data['store_data'] = $this->select_model->get_store_master();
            $this->load->view('headers/superadmin_home_header',$data);
           $this->load->view('masters/store_manager',$data);
            $this->load->view('headers/footer');
          }
          else
          {
                $this->error_403();
          }
        }

       
    }

    //21-02-19
    //delete branch
     public function delete_store_manager()
      {
            $get_affected_rows = $this->delete_model->delete_store_manager($this->uri->segment(3));
            
            if($get_affected_rows)
            {
               redirect(base_url()."superadmin/manage_store_manager",'refresh');
            }
        }
   //=========================End store Manager==============================
   //========================Store Master===================================
    //4-03-19
    //create Store Master
    function create_store($error=NULL,$data_array=NULL)
    {
       if($this->session->has_userdata('admin_id'))
        {
            $data['user_data'] = $this->select_model->select_user($this->backend_table,$this->admin_id);
            if($error != NULL)
            {
              $data['error'] = "STR";
            }
            
            $this->load->view('headers/superadmin_home_header',$data);
            $this->load->view('masters/store_master',$data);
            $this->load->view('headers/footer');
      }
      else
      {
            $this->error_403();
      }
    }

    //store data 
    function insert_store_data()
    {
       $this->form_validation->set_rules('store_name','store_name','required');
       $this->form_validation->set_rules('email','email','required');
       $this->form_validation->set_rules('phono_num','phono_num','required');
       $this->form_validation->set_rules('address1','address1','required');
       $this->form_validation->set_rules('address2','address2','required');
       $this->form_validation->set_rules('address3','address3','required');
       $this->form_validation->set_rules('state','state','required');
       $this->form_validation->set_rules('city','city','required');
       $this->form_validation->set_rules('zipcode','zipcode','required');
         
        if($this->form_validation->run())
       {
        $store_data = array(
          "store_name" => $this->input->post("store_name"),
          "email" => $this->input->post("email"),
          "phone_num" => $this->input->post("phono_num"),
          "address1" => $this->input->post("address1"),
          "address2" => $this->input->post("address2"),
          "address3" => $this->input->post("address3"),
          "state" => $this->input->post("state"),
          "city" => $this->input->post("city"),
          "zipcode" => $this->input->post("zipcode")
          );

          
           $get_count = $this->validate_model->get_store($store_data['store_name']);


           if(!($get_count))
          {
            $get_affected_rows = $this->insert_model->insert_store($store_data);
            if($get_affected_rows)
            {
                echo "<script> alert('Created Store'); </script>";
                $this->manage_store();
            }
          }
          else
          {
            //$this->create_category("vae");
            echo "<script> alert('Error(STR): Value Already Exists.'); </script>";
            $this->create_store("STR");
          }
        }
        else
        {
          $this->create_store();
        }

    }

    //21-2-19
    public function manage_store()
    {
     if($this->session->has_userdata('admin_id'))
      {
        $data['user_data'] = $this->select_model->select_user($this->backend_table,$this->admin_id);
        $data['store_data'] = $this->select_model->get_store_master();

          $this->load->view('headers/superadmin_home_header',$data);
          $this->load->view('masters/manage_store',$data);
          $this->load->view('headers/footer');
        }
      else
      {
          $this->error_403();
      }

    }
    //21-02-19 edit store
    function edit_store()
    {
      if($this->session->has_userdata('admin_id'))
        {
            $data['user_data'] = $this->select_model->select_user($this->backend_table,$this->admin_id);
            $id = $this->uri->segment(3);
            $data['store_data_id'] = $this->select_model->select_user("store_master","$id");
             
            $this->load->view('headers/superadmin_home_header',$data);
           $this->load->view('masters/store_master',$data);
            $this->load->view('headers/footer');
      }
      else
      {
            $this->error_403();
      }
    }

    //21-2-19 edit store data
    function edit_store_data()
    {
       $this->form_validation->set_rules('store_name','store_name','required');
       $this->form_validation->set_rules('email','email','required');
       $this->form_validation->set_rules('phono_num','phono_num','required');
       $this->form_validation->set_rules('address1','address1','required');
       $this->form_validation->set_rules('address2','address2','required');
       $this->form_validation->set_rules('address3','address3','required');
       $this->form_validation->set_rules('state','state','required');
       $this->form_validation->set_rules('city','city','required');
       $this->form_validation->set_rules('zipcode','zipcode','required');
            
        if($this->form_validation->run())
       {
         $id = $this->input->post("hidden_store");
     
     
     $store_data = array(
          "store_name" => $this->input->post("store_name"),
          "email" => $this->input->post("email"),
          "phone_num" => $this->input->post("phono_num"),
          "address1" => $this->input->post("address1"),
          "address2" => $this->input->post("address2"),
          "address3" => $this->input->post("address3"),
          "state" => $this->input->post("state"),
          "city" => $this->input->post("city"),
          "zipcode" => $this->input->post("zipcode")
        );
       

      if($this->input->post("update"))
        {
           
            $update_store = $this->update_model->update_store_master($id,$store_data);
            if($update_store >=0)
            {
                echo "<script> alert('Updated successfully'); </script>";
                 echo "<script>window.location.href='".base_url()."Superadmin/manage_store/';</script>";
            } 

        }
        

        }
        else
        {
          if($this->session->has_userdata('admin_id'))
            {
                $data['user_data'] = $this->select_model->select_user($this->backend_table,$this->admin_id);
                $id = $this->input->post("hidden_store");
                $data['store_data_id'] = $this->select_model->select_user("store_master","$id");                
                $this->load->view('headers/superadmin_home_header',$data);
                $this->load->view('masters/store_master',$data);
                $this->load->view('headers/footer');
          }
          else
          {
                $this->error_403();
          }
        }

       
    }

    //21-02-19
    //delete branch
     public function delete_store()
      {
            $get_affected_rows = $this->delete_model->delete_store($this->uri->segment(3));
            
            if($get_affected_rows)
            {
               redirect(base_url()."superadmin/manage_store",'refresh');
            }
        }
   //=========================End store Master==============================
//========================Room Master===================================
    //4-03-19
    //create Room Master
    function create_room($error=NULL,$data_array=NULL)
    {
      if($this->session->has_userdata('admin_id'))
        {
            $data['user_data'] = $this->select_model->select_user($this->backend_table,$this->admin_id);
               
           
            
            $this->load->view('headers/superadmin_home_header',$data);
             $data['get_room'] = $this->select_model->get_room_master();
              if(isset($room_array))
               {
                $data['update'] = 1;
                 $data['id'] = $room_array['id'];
                 $data['room_name'] = $room_array['room_name'];
               }
            $data['error_handler'] = $error;
            $this->load->view('masters/room_master',$data);
            $this->load->view('headers/footer');
      }
      else
      {
            $this->error_403();
      }
    }
     //add Room data  
    function insert_room_data()
    {
      $this->form_validation->set_rules('room_name', 'room_name', 'required');
       if ($this->form_validation->run()) 
       {
          $insert_room = array(
                "room_name"=>$this->input->post("room_name")
          );
           $get_count = $this->validate_model->get_room($insert_room['room_name']);


           if(!($get_count))
          {
            $get_affected_rows = $this->insert_model->insert_room($insert_room);
            if($get_affected_rows)
            {
                echo "<script> alert('Created Room'); </script>";
                $this->create_room();
            }
          }
          else
          {
            //$this->create_room("vae");
            echo "<script> alert('Error(VAM): Value Already Exists.'); </script>";
            $this->create_room();
          }
        } 
       else 
       {
           $this->create_room("Required");
       }

    }

      //update Room data
     public function update_room()
    {
       if($this->session->has_userdata('admin_id'))
        {
            $data['user_data'] = $this->select_model->select_user($this->backend_table,$this->admin_id);
            $data['get_room'] = $this->select_model->get_room_master();
        $data["get_value"] = $this->select_model->select_user("room_master",$this->uri->segment(3));
          
          $this->load->view('headers/superadmin_home_header',$data);
          $this->load->view('masters/room_master',$data);
          $this->load->view('headers/footer');
              

        /*
         *  Update button
         */

        if($this->input->post('room_update') == "room_update")
        {

            $this->form_validation->set_rules('update_room','update_room','required');
            
            if($this->form_validation->run())
            {
                 $get_update = array(
                    "id" => $this->input->post('update_id'),
                    "room_name" => $this->input->post('update_room')
                );

                $get_update_count = $this->update_model->update_room_master($get_update);
                if($get_update_count)
                {
                    echo "<script> alert('Updated'); </script>";
                    redirect(base_url()."superadmin/update_room/".$this->uri->segment(3),'refresh');
                }

            }
            else
            {
                echo "<script> alert('ERROR(UVE) : Update Value Should Not Be Empty'); </script>";
                redirect(base_url()."superadmin/update_room/".$this->uri->segment(3),'refresh');
            }
         
        }
       }
      else
      {
            $this->error_403();
      }
    }
    //delete room
     public function delete_room()
      {
            $get_affected_rows = $this->delete_model->delete_room($this->uri->segment(3));
            
            if($get_affected_rows)
            {
               redirect(base_url()."superadmin/create_room",'refresh');
            }
        }
   //=========================End Room Master==============================
  //========================Grid Master===================================
    //4-03-19
    //create Grid Master
    function create_grid($error=NULL,$data_array=NULL)
    {
      if($this->session->has_userdata('admin_id'))
        {
            $data['user_data'] = $this->select_model->select_user($this->backend_table,$this->admin_id);
               
           
            
            $this->load->view('headers/superadmin_home_header',$data);
             $data['get_grid'] = $this->select_model->get_grid_master();
              if(isset($grid_array))
               {
                $data['update'] = 1;
                 $data['id'] = $grid_array['id'];
                 $data['grid_name'] = $grid_array['grid_name'];
               }
            $data['error_handler'] = $error;
            $this->load->view('masters/grid_master',$data);
            $this->load->view('headers/footer');
      }
      else
      {
            $this->error_403();
      }
    }
     //add Grid data  
    function insert_grid_data()
    {
      $this->form_validation->set_rules('grid_name', 'grid_name', 'required');
       if ($this->form_validation->run()) 
       {
          $insert_grid = array(
                "grid_name"=>$this->input->post("grid_name")
          );
           $get_count = $this->validate_model->get_grid($insert_grid['grid_name']);


           if(!($get_count))
          {
            $get_affected_rows = $this->insert_model->insert_grid($insert_grid);
            if($get_affected_rows)
            {
                echo "<script> alert('Created Grid'); </script>";
                $this->create_grid();
            }
          }
          else
          {
            //$this->create_category("vae");
            echo "<script> alert('Error(VAM): Value Already Exists.'); </script>";
            $this->create_grid();
          }
        } 
       else 
       {
           $this->create_grid("Required");
       }

    }

      //update Grid data
     public function update_grid()
    {
       if($this->session->has_userdata('admin_id'))
        {
            $data['user_data'] = $this->select_model->select_user($this->backend_table,$this->admin_id);
            $data['get_grid'] = $this->select_model->get_grid_master();
        $data["get_value"] = $this->select_model->select_user("grid_master",$this->uri->segment(3));
          
          $this->load->view('headers/superadmin_home_header',$data);
          $this->load->view('masters/grid_master',$data);
          $this->load->view('headers/footer');
              

        /*
         *  Update button
         */

        if($this->input->post('grid_update') == "grid_update")
        {

            $this->form_validation->set_rules('update_grid','update_grid','required');
            
            if($this->form_validation->run())
            {
                 $get_update = array(
                    "id" => $this->input->post('update_id'),
                    "grid_name" => $this->input->post('update_grid')
                );

                $get_update_count = $this->update_model->update_grid_master($get_update);
                if($get_update_count)
                {
                    echo "<script> alert('Updated'); </script>";
                    redirect(base_url()."superadmin/update_grid/".$this->uri->segment(3),'refresh');
                }

            }
            else
            {
                echo "<script> alert('ERROR(UVE) : Update Value Should Not Be Empty'); </script>";
                redirect(base_url()."superadmin/update_grid/".$this->uri->segment(3),'refresh');
            }
         
        }
       }
      else
      {
            $this->error_403();
      }
    }
    //delete Grid
     public function delete_grid()
      {
            $get_affected_rows = $this->delete_model->delete_grid($this->uri->segment(3));
            
            if($get_affected_rows)
            {
               redirect(base_url()."superadmin/create_grid",'refresh');
            }
        }
   //=========================End Grid Master==============================
//========================Bin Master===================================
    //4-03-19
    //create Bin Master
    function create_bin($error=NULL,$data_array=NULL)
    {
      if($this->session->has_userdata('admin_id'))
        {
            $data['user_data'] = $this->select_model->select_user($this->backend_table,$this->admin_id);
               
           
            
            $this->load->view('headers/superadmin_home_header',$data);
             $data['get_bin'] = $this->select_model->get_bin_master();
              if(isset($bin_array))
               {
                $data['update'] = 1;
                 $data['id'] = $bin_array['id'];
                 $data['bin_name'] = $bin_array['bin_name'];
               }
            $data['error_handler'] = $error;
            $this->load->view('masters/bin_master',$data);
            $this->load->view('headers/footer');
      }
      else
      {
            $this->error_403();
      }
    }
     //add bin data  
    function insert_bin_data()
    {
      $this->form_validation->set_rules('bin_name', 'bin_name', 'required');
       if ($this->form_validation->run()) 
       {
          $insert_bin = array(
                "bin_name"=>$this->input->post("bin_name")
          );
           $get_count = $this->validate_model->get_bin($insert_bin['bin_name']);


           if(!($get_count))
          {
            $get_affected_rows = $this->insert_model->insert_bin($insert_bin);
            if($get_affected_rows)
            {
                echo "<script> alert('Created Bin'); </script>";
                $this->create_bin();
            }
          }
          else
          {
            //$this->create_category("vae");
            echo "<script> alert('Error(VAM): Value Already Exists.'); </script>";
            $this->create_bin();
          }
        } 
       else 
       {
           $this->create_bin("Required");
       }

    }

      //update meal plan data
     public function update_bin()
    {
       if($this->session->has_userdata('admin_id'))
        {
            $data['user_data'] = $this->select_model->select_user($this->backend_table,$this->admin_id);
            $data['get_bin'] = $this->select_model->get_bin_master();
        $data["get_value"] = $this->select_model->select_user("bin_master",$this->uri->segment(3));
          
          $this->load->view('headers/superadmin_home_header',$data);
          $this->load->view('masters/bin_master',$data);
          $this->load->view('headers/footer');
              

        /*
         *  Update button
         */

        if($this->input->post('bin_update') == "bin_update")
        {

            $this->form_validation->set_rules('update_bin','update_bin','required');
            
            if($this->form_validation->run())
            {
                 $get_update = array(
                    "id" => $this->input->post('update_id'),
                    "bin_name" => $this->input->post('update_bin')
                );

                $get_update_count = $this->update_model->update_bin_master($get_update);
                if($get_update_count)
                {
                    echo "<script> alert('Updated'); </script>";
                    redirect(base_url()."superadmin/update_bin/".$this->uri->segment(3),'refresh');
                }

            }
            else
            {
                echo "<script> alert('ERROR(UVE) : Update Value Should Not Be Empty'); </script>";
                redirect(base_url()."superadmin/update_bin/".$this->uri->segment(3),'refresh');
            }
         
        }
       }
      else
      {
            $this->error_403();
      }
    }
    //delete bin
     public function delete_bin()
      {
            $get_affected_rows = $this->delete_model->delete_bin($this->uri->segment(3));
            
            if($get_affected_rows)
            {
               redirect(base_url()."superadmin/create_bin",'refresh');
            }
        }
   //=========================End bin Master==============================
   //=======================Store Mapping ==============================
    //4-03-19
    //create Store Mapping
    function store_mapping($error=NULL)
    {
      if($this->session->has_userdata('admin_id'))
        {
            $data['user_data'] = $this->select_model->select_user($this->backend_table,$this->admin_id);
             $this->load->view('headers/superadmin_home_header',$data);
             $data['get_store'] = $this->select_model->get_store_master();
             $data['get_grid'] = $this->select_model->get_grid_master();
             $data['get_room'] = $this->select_model->get_room_master();
              $data['get_bin'] = $this->select_model->get_bin_master();
              // if(isset($bin_array))
              //  {
              //   $data['update'] = 1;
              //    $data['id'] = $bin_array['id'];
              //    $data['bin_name'] = $bin_array['bin_name'];
              //  }
            $data['error_handler'] = $error;
            $this->load->view('masters/mapping_store',$data);
            $this->load->view('headers/footer');
      }
      else
      {
            $this->error_403();
      }
    } 
    //add store Mapping data  
    function store_mapping_data()
    {
      $this->form_validation->set_rules('store', 'store', 'required');
      //$this->form_validation->set_rules('room', 'room', 'required');
      //$this->form_validation->set_rules('grid', 'grid', 'required');
      //$this->form_validation->set_rules('bin', 'bin', 'required');
       if ($this->form_validation->run()) 
       {
          $insert_data = array(
                "store"=>$this->input->post("store"),
                "room"=>$this->input->post("room"),
                "grid"=>$this->input->post("grid"),
                "bin"=>$this->input->post("bin"),
          );
           //$get_count = $this->validate_model->get_bin($insert_bin['bin_name']);
          $get_count = $this->validate_model->get_srgb($insert_data["store"],$insert_data["room"],$insert_data["grid"],$insert_data["bin"]);
          
           if($get_count == 0)
          {
            $get_affected_rows = $this->insert_model->insert_store_mapping($insert_data);
            if($get_affected_rows)
            {
                echo "<script> alert('Created Mapping'); </script>";
               $this->manage_store_mapping();
            }
          }
          else
         {
            
           echo "<script> alert('Error(VAM): Value Already Exists.'); </script>";
           $this->store_mapping();
         }
        } 
       else 
       {
           $this->store_mapping();
       }

    }   
 //05-03-19
    public function manage_store_mapping()
    {
     if($this->session->has_userdata('admin_id'))
      {
        $data['user_data'] = $this->select_model->select_user($this->backend_table,$this->admin_id);
        $data['mapping_data'] = $this->select_model->get_store_mapping();

          $this->load->view('headers/superadmin_home_header',$data);
          $this->load->view('masters/manage_store_mapping',$data);
          $this->load->view('headers/footer');
        }
      else
      {
          $this->error_403();
      }

    }
    //05-03-19 edit store Mapping
    function edit_store_mapping()
    {
      if($this->session->has_userdata('admin_id'))
        {
            $data['user_data'] = $this->select_model->select_user($this->backend_table,$this->admin_id);
            $id = $this->uri->segment(3);
            $data['store_data_id'] = $this->select_model->get_store_mapping_id("$id");
             $data['get_store'] = $this->select_model->get_store_master();
             $data['get_grid'] = $this->select_model->get_grid_master();
             $data['get_room'] = $this->select_model->get_room_master();
            $data['get_bin'] = $this->select_model->get_bin_master();
            $this->load->view('headers/superadmin_home_header',$data);
            $this->load->view('masters/mapping_store',$data);
            $this->load->view('headers/footer');
      }
      else
      {
            $this->error_403();
      }
    }

    //04-03-19 edit mapping data
    function edit_store_mapping_data()
    {
       $this->form_validation->set_rules('store', 'store', 'required');
       
            
        if($this->form_validation->run())
       {
      $id = $this->input->post("map_id");
     
     
          $update_data = array(
                "store"=>$this->input->post("store"),
                "room"=>$this->input->post("room"),
                "grid"=>$this->input->post("grid"),
                "bin"=>$this->input->post("bin"),
          );

       

      if($this->input->post("update"))
        {
           
            $update_mapping = $this->update_model->update_store_map($id,$update_data);
            if($update_mapping >=0)
            {
                echo "<script> alert('Updated successfully'); </script>";
                 echo "<script>window.location.href='".base_url()."Superadmin/manage_store_mapping/';</script>";
            } 

        }
        

        }
        else
        {
          if($this->session->has_userdata('admin_id'))
           {
            $data['user_data'] = $this->select_model->select_user($this->backend_table,$this->admin_id);
            $id = $this->uri->segment(3);
            $data['store_data_id'] = $this->select_model->select_user("store_mapping","$id");
             $data['get_store'] = $this->select_model->get_store_master();
             $data['get_grid'] = $this->select_model->get_grid_master();
             $data['get_room'] = $this->select_model->get_room_master();
            $data['get_bin'] = $this->select_model->get_bin_master();
            $this->load->view('headers/superadmin_home_header',$data);
            $this->load->view('masters/mapping_store',$data);
            $this->load->view('headers/footer');
          }
          else
          {
                $this->error_403();
          }
        }

       
    }
    //delete store Mapping
     public function delete_store_map()
      {
            $get_affected_rows = $this->delete_model->delete_store_mapping($this->uri->segment(3));
            
            if($get_affected_rows)
            {
               redirect(base_url()."superadmin/manage_store_mapping",'refresh');
            }
        }
    //ajax check srgb
      public function ajax_srgb_check()
      {
        $output = $this->validate_model->get_srgb($this->input->post("s_id"),$this->input->post("r_id"),$this->input->post("g_id"),$this->input->post("b_id"));
        echo $output;

      }
   //=======================End Store Mapping============================

  //21-2-19
  // corporate Branchs insert
    function corporate_branch($error = NULL)
    {
      if($this->session->has_userdata('admin_id'))
        {
            $data['user_data'] = $this->select_model->select_user($this->backend_table,$this->admin_id);
            $data['company_data'] = $this->select_model->get_corporate_company();
               if($error != NULL)
             {
               $data['error'] = "BRN";
            }
          
            $this->load->view('headers/superadmin_home_header',$data);
            $this->load->view('customer/corporate_branch',$data);
            $this->load->view('headers/footer');
      }
      else
      {
            $this->error_403();
      }
    }
    //22-2-19
    //corporate branch data 
    function corporate_branch_data()
    {
       $this->form_validation->set_rules('company_name','company_name','required');
       $this->form_validation->set_rules('branch_name','branch_name','required');
       $this->form_validation->set_rules('branch_telephone','branch_telephone','required');
       $this->form_validation->set_rules('branch_gstn','branch_gstn','required');
       $this->form_validation->set_rules('branch_address1','branch_address1','required');
       $this->form_validation->set_rules('branch_address2','branch_address2','required');
       $this->form_validation->set_rules('branch_address3','branch_address3','required');
        $this->form_validation->set_rules('branch_city','branch_city','required');
       $this->form_validation->set_rules('branch_state','branch_state','required');
       $this->form_validation->set_rules('branch_zipcode','branch_zipcode','required');
            
        if($this->form_validation->run())
       {
        $branch_data = array(
          "company_name" => $this->input->post("company_name"),
          "branch_name" => $this->input->post("branch_name"),
          "branch_telephone" => $this->input->post("branch_telephone"),
          "branch_gstn" => $this->input->post("branch_gstn"),
          "branch_address1" => $this->input->post("branch_address1"),
          "branch_address2" => $this->input->post("branch_address2"),
          "branch_address3" => $this->input->post("branch_address3"),
          "branch_city" => $this->input->post("branch_city"),
          "branch_state" => $this->input->post("branch_state"),
          "branch_zipcode" => $this->input->post("branch_zipcode")
          );

           $insert_mealplan = array(
                "meal_plan"=>$this->input->post("meal_plan")
          );
           $get_count = $this->validate_model->get_branch($branch_data['branch_name']);


           if(!($get_count))
          {
            $get_affected_rows = $this->insert_model->insert_corporate_branch($branch_data);
            if($get_affected_rows)
            {
                echo "<script> alert('Created Branch'); </script>";
                $this->corporate_branch();
            }
          }
          else
          {
            //$this->create_category("vae");
            echo "<script> alert('Error(BRN): Value Already Exists.'); </script>";
            $this->corporate_branch("BRN");
          }
        }
        else
        {
          $this->corporate_branch();
        }

    }

    //21-2-19
    public function manage_corporate_branch()
    {
     if($this->session->has_userdata('admin_id'))
      {
        $data['user_data'] = $this->select_model->select_user($this->backend_table,$this->admin_id);
        $data['branch_data'] = $this->select_model->get_corporate_branch();

          $this->load->view('headers/superadmin_home_header',$data);
          $this->load->view('customer/manag_branch',$data);
          $this->load->view('headers/footer');
        }
      else
      {
          $this->error_403();
      }

    }
    //21-02-19 edit branch
    function edit_branch()
    {
      if($this->session->has_userdata('admin_id'))
        {
            $data['user_data'] = $this->select_model->select_user($this->backend_table,$this->admin_id);
            $id = $this->uri->segment(3);
            $data['branch_data_id'] = $this->select_model->select_user("branch_data","$id");
               $data['company_data'] = $this->select_model->get_corporate_company();
            $this->load->view('headers/superadmin_home_header',$data);
            $this->load->view('customer/corporate_branch',$data);
            $this->load->view('headers/footer');
      }
      else
      {
            $this->error_403();
      }
    }

    //21-2-19 edit branch data
    function edit_branch_data()
    {
       $this->form_validation->set_rules('company_name','company_name','required');
       $this->form_validation->set_rules('branch_name','branch_name','required');
       $this->form_validation->set_rules('branch_telephone','branch_telephone','required');
       $this->form_validation->set_rules('branch_gstn','branch_gstn','required');
       $this->form_validation->set_rules('branch_address1','branch_address1','required');
       $this->form_validation->set_rules('branch_address2','branch_address2','required');
       $this->form_validation->set_rules('branch_address3','branch_address3','required');
        $this->form_validation->set_rules('branch_city','branch_city','required');
       $this->form_validation->set_rules('branch_state','branch_state','required');
       $this->form_validation->set_rules('branch_zipcode','branch_zipcode','required');
            
        if($this->form_validation->run())
       {
      $id = $this->input->post("bhidden_id");
     
     
     $branch_data = array(
          "company_name" => $this->input->post("company_name"),
          "branch_name" => $this->input->post("branch_name"),
          "branch_telephone" => $this->input->post("branch_telephone"),
          "branch_gstn" => $this->input->post("branch_gstn"),
          "branch_address1" => $this->input->post("branch_address1"),
          "branch_address2" => $this->input->post("branch_address2"),
          "branch_address3" => $this->input->post("branch_address3"),
          "branch_city" => $this->input->post("branch_city"),
          "branch_state" => $this->input->post("branch_state"),
          "branch_zipcode" => $this->input->post("branch_zipcode")
          );

       

      if($this->input->post("update"))
        {
           
            $update_corp_branch = $this->update_model->update_corp_branch($id,$branch_data);
            if($update_corp_branch >=0)
            {
                echo "<script> alert('Updated successfully'); </script>";
                 echo "<script>window.location.href='".base_url()."Superadmin/manage_corporate_branch/';</script>";
            } 

        }
        

        }
        else
        {
          if($this->session->has_userdata('admin_id'))
            {
                $data['user_data'] = $this->select_model->select_user($this->backend_table,$this->admin_id);
                $id = $this->input->post("bhidden_id");
                $data['branch_data_id'] = $this->select_model->select_user("branch_data","$id");
               $data['company_data'] = $this->select_model->get_corporate_company();
                
                $this->load->view('headers/superadmin_home_header',$data);
                $this->load->view('customer/corporate_branch',$data);
                $this->load->view('headers/footer');
          }
          else
          {
                $this->error_403();
          }
        }

       
    }

    //21-02-19
    //delete branch
     public function delete_corp_branch()
      {
            $get_affected_rows = $this->delete_model->delete_branch($this->uri->segment(3));
            
            if($get_affected_rows)
            {
               redirect(base_url()."superadmin/manage_corporate_branch",'refresh');
            }
        }

    //22-02-19 ajax for branch name
    function fetch_ajax_branch()
    {
        if($this->select_model->get_ajax_branch($this->input->post('r_id')))
      {
        $output=$this->select_model->get_ajax_branch($this->input->post('r_id'));
        //echo json_encode($output);
        echo $output;
      }
      else
      {
        echo "Failed";
      }
    }

    //fetching dropdown
  function fetch_dropdown()
  { 
    if($this->select_model->fetch_dropdown($this->input->post('r_id')))
    {
      echo $this->select_model->fetch_dropdown($this->input->post('r_id'));
    }
    else
    {
      echo "Failed";
    }
  }
    //21-02-19 create representative
    public function corporate_representative($error = NULL)
    {
         if($this->session->has_userdata('admin_id'))
          {
             $data['user_data'] = $this->select_model->select_user($this->backend_table,$this->admin_id);
              $data['company_data'] = $this->select_model->get_corporate_company();
              if($error != NULL)
                 {
                   $data['error'] = "LOGIN";
                   $data['error1'] = "REP";
                }
              
                $this->load->view('headers/superadmin_home_header',$data);
                $this->load->view('customer/corporate_representative',$data);
                $this->load->view('headers/footer');
          }
          else
          {
                $this->error_403();
          }
    } 

    //21-02-19 representative data
    public function corporate_representative_data()
    {
       $this->form_validation->set_rules('company_name','company_name','required');
       $this->form_validation->set_rules('branch_name','branch_name','required');
       $this->form_validation->set_rules('user_title','user_title','required');
       $this->form_validation->set_rules('rep_first_name','rep_first_name','required');
       $this->form_validation->set_rules('rep_middle_name','rep_middle_name','required');
      $this->form_validation->set_rules('rep_last_name','rep_last_name','required');
      $this->form_validation->set_rules('rep_email_id','rep_email_id','required');
      $this->form_validation->set_rules('rep_phone_number','rep_phone_number','required');
      $this->form_validation->set_rules('rep_designation','rep_designation','required');
      $this->form_validation->set_rules('rep_employee_id','rep_employee_id','required');
       $this->form_validation->set_rules('rep_address1','branch_address1','required');
       $this->form_validation->set_rules('rep_address2','rep_address2','required');
       $this->form_validation->set_rules('rep_address3','rep_address3','required');
        $this->form_validation->set_rules('rep_city','rep_city','required');
       $this->form_validation->set_rules('rep_state','rep_state','required');
       $this->form_validation->set_rules('rep_zipcode','rep_zipcode','required');
            
        if($this->form_validation->run())
       {
        $representative_data = array(
            "company_name"=>$this->input->post("company_name"),
            "branch_name"=>$this->input->post("branch_name"),
            "user_title"=>$this->input->post("user_title"),
            "rep_first_name"=>$this->input->post("rep_first_name"),
            "rep_mid_name"=>$this->input->post("rep_middle_name"),
            "rep_last_name"=>$this->input->post("rep_last_name"),
            "rep_email_id"=>$this->input->post("rep_email_id"),
            "rep_phono_no"=>$this->input->post("rep_phone_number"),
            "rep_designation"=>$this->input->post("rep_designation"),
            "rep_employee_id"=>$this->input->post("rep_employee_id"),
            "rep_address1"=>$this->input->post("rep_address1"),
            "rep_address2"=>$this->input->post("rep_address2"),
            "rep_address3"=>$this->input->post("rep_address3"),
            "rep_city"=>$this->input->post("rep_city"),
            "rep_state"=>$this->input->post("rep_state"),
            "rep_zipcode"=>$this->input->post("rep_zipcode")
        );
      $login_data = array(
        "email_id"=>$this->input->post("rep_email_id"),
        "phone_number"=>$this->input->post("rep_phone_number"),
        "password"=>$this->input->post("rep_user_password"),
        "active"=>"0",
        "admin"=>"0"
      );

       $get_representative_count = $this->validate_model->get_representative($representative_data['rep_email_id']);
        $get_login_count = $this->validate_model->check_duplicate_login($login_data['email_id']);


        if($get_representative_count == 0 && $get_login_count == 0)
        {
          

          $get_affected = $this->insert_model->insert_corp_representative($representative_data);
         
          if($get_affected == 1)
          {
            
             $get_affected_rows2 = $this->insert_model->insert_login_details($login_data);

                 echo "<script>window.location.href='".base_url()."Superadmin/manage_representative/';</script>";

               if($get_affected_rows2)
              {

              $this->email->from('zenopsysevolve@gmail.com', 'FSDMS Appliacation');
              $this->email->to((string)$login_data['email_id']);
              $this->email->subject('Confirm Registration');
              $message = "<html>";
              $message .= "<body>";
              $message .= "<p> Please, click on the link to confirm the registration on FSDMS </p>";

              $message .= "<p> <b>Email Id : ".$login_data['email_id']."</b></p>";
              $message .= "<p> <b> Password : ".$login_data['password']."</b></p>";
              $message .= "<p><a href='".base_url()."superadmin/confirmation/4/".base64_encode($login_data['email_id'])."/".base64_encode($login_data['password'])."'> Click to Confirm  </a></p>";

              $message .= "</body>";
              $message .= "</html>";
              $this->email->message($message);
              $this->email->send();

              echo $this->email->print_debugger();
              echo "<script>window.location.href='".base_url()."Superadmin/manage_representative/';</script>";
             }



          }
          else
          {
            echo "<script> alert('Error(LOGIN): Email Already Exists.'); </script>";
            $this->corporate_representative("LOGIN");
          }
        }
        else
        {
            echo "<script> alert('Error(REP): Email Already Exists.'); </script>";
            $this->corporate_representative("REP");
        }
      }
      else
      {
        $this->corporate_representative();
      }

  } 

    //22-02-19 manage representative details
    public function manage_representative()
    {
      if($this->session->has_userdata('admin_id'))
      {
        $data['user_data'] = $this->select_model->select_user($this->backend_table,$this->admin_id);
        $data['representative_data'] = $this->select_model->get_corporate_repre();

          $this->load->view('headers/superadmin_home_header',$data);
          $this->load->view('customer/manage_representative',$data);
          $this->load->view('headers/footer');
        }
      else
      {
          $this->error_403();
      }
    }

    //21-02-19 edit representative
    function edit_representative()
    {
      if($this->session->has_userdata('admin_id'))
        {
            $data['user_data'] = $this->select_model->select_user($this->backend_table,$this->admin_id);
            $id = $this->uri->segment(3);

            $data['represent_data_id'] = $this->select_model->get_representative_id("$id");
            $data['company_data'] = $this->select_model->get_corporate_company();
            $this->load->view('headers/superadmin_home_header',$data);
            $this->load->view('customer/corporate_representative',$data);
            $this->load->view('headers/footer');
      }
      else
      {
            $this->error_403();
      }
    }

    //21-2-19 edit representative data
    function edit_representative_data()
    {
      
       $this->form_validation->set_rules('company_name','company_name','required');
       $this->form_validation->set_rules('branch_name','branch_name','required');
       $this->form_validation->set_rules('user_title','user_title','required');
       $this->form_validation->set_rules('rep_first_name','rep_first_name','required');
       $this->form_validation->set_rules('rep_middle_name','rep_middle_name','required');
      $this->form_validation->set_rules('rep_last_name','rep_last_name','required');
      $this->form_validation->set_rules('rep_email_id','rep_email_id','required');
      $this->form_validation->set_rules('rep_phone_number','rep_phone_number','required');
      $this->form_validation->set_rules('rep_designation','rep_designation','required');
      $this->form_validation->set_rules('rep_employee_id','rep_employee_id','required');
       $this->form_validation->set_rules('rep_address1','branch_address1','required');
       $this->form_validation->set_rules('rep_address2','rep_address2','required');
       $this->form_validation->set_rules('rep_address3','rep_address3','required');
        $this->form_validation->set_rules('rep_city','rep_city','required');
       $this->form_validation->set_rules('rep_state','rep_state','required');
       $this->form_validation->set_rules('rep_zipcode','rep_zipcode','required');
            
        if($this->form_validation->run())
       {
      $id = $this->input->post("rhidden_id");
      $represent_data = array(
           "company_name"=>$this->input->post("company_name"),
            "branch_name"=>$this->input->post("branch_name"),
            "user_title"=>$this->input->post("user_title"),
            "rep_first_name"=>$this->input->post("rep_first_name"),
            "rep_mid_name"=>$this->input->post("rep_middle_name"),
            "rep_last_name"=>$this->input->post("rep_last_name"),
            "rep_email_id"=>$this->input->post("rep_email_id"),
            "rep_phono_no"=>$this->input->post("rep_phone_number"),
            "rep_designation"=>$this->input->post("rep_designation"),
            "rep_employee_id"=>$this->input->post("rep_employee_id"),
            "rep_address1"=>$this->input->post("rep_address1"),
            "rep_address2"=>$this->input->post("rep_address2"),
            "rep_address3"=>$this->input->post("rep_address3"),
            "rep_city"=>$this->input->post("rep_city"),
            "rep_state"=>$this->input->post("rep_state"),
            "rep_zipcode"=>$this->input->post("rep_zipcode")
          );

       

      if($this->input->post("update"))
        {
           
            $update_corp_repres = $this->update_model->update_corp_repres($id,$represent_data);
            if($update_corp_repres >=0)
            {
                echo "<script> alert('Updated successfully'); </script>";
                 echo "<script>window.location.href='".base_url()."Superadmin/manage_representative/';</script>";
            } 

        }
       }
      else
        {
            if($this->session->has_userdata('admin_id'))
            {
                $data['user_data'] = $this->select_model->select_user($this->backend_table,$this->admin_id);
                $id = $this->input->post("rhidden_id");
                 $data['represent_data_id'] = $this->select_model->get_representative_id("$id");
            $data['company_data'] = $this->select_model->get_corporate_company();
                
                $this->load->view('headers/superadmin_home_header',$data);
                $this->load->view('customer/corporate_representative',$data);
                $this->load->view('headers/footer');
          }
          else
          {
                $this->error_403();
          }
        }
       
    }

    //22-02-19
    //delete representative
     public function delete_corp_repres()
      {
            $get_affected_rows = $this->delete_model->delete_repres($this->uri->segment(3));

            
            if($get_affected_rows)
            {
               redirect(base_url()."superadmin/manage_representative",'refresh');
            }
        }
    public function error_403()
    {
        $this->load->view('404');
        $this->load->view('headers/footer');
    }

    public function login_error($error_handler = NULL)
     {
      if($error_handler == "unf")
      {
        $data['error_handle'] = $error_handler;
        //print_r($data);
        $this->load->view('errors/defined/login_error',$data);
      }
      elseif($error_handler == "uae")
      {
        $data['error_handle'] = $error_handler;
        $this->load->view('errors/defined/login_error',$data);
      }
      elseif($error_handler == "eae")
      {
        $data['error_handle'] = $error_handler;
        $this->load->view('errors/defined/login_error',$data);
      }
      else
      {
        $this->load->view('errors/defined/login_error');
      }
     }

        
    /**
    *   Author    :    Mounika Marella. et.al,
    *   Date      :    21022019
    *   Functionality  :    Create - Update - Delete products from master.  Create - Update - Delete Units from master. 
    */
    public function products_master($error=NULL,$data_array=NULL)
    {
         if($this->session->has_userdata('admin_id'))
           {
               $data['user_data'] = $this->select_model->select_user($this->backend_table,$this->admin_id);
               $this->load->view('headers/superadmin_home_header',$data);

               $data['error_handler'] = $error;
               $data['kitchen_product'] = $this->select_model->get_kitchen_products_master();

               if(isset($data_array))
               {
                   $data['update'] = 1;
                   $data['id'] = $data_array['id'];
                   $data['product_name'] = $data_array['product_name'];
               }

               $this->load->view('masters/product_master',$data);
               $this->load->view('headers/footer');
           }
           else
           {
               $this->error_403();
           }
    }

      public function insert_product_master()
      {
           $this->form_validation->set_rules('kitchen_product', 'kitchen_product', 'required');
           if ($this->form_validation->run())
           {
              $insert_kitchen_product = array(
                    "product_name"=>$this->input->post("kitchen_product")
              );

              $get_count = $this->validate_model->get_kitchen_product($insert_kitchen_product['product_name']);

              if(!($get_count))
              {
                $get_affected_rows = $this->insert_model->insert_kitchen_product($insert_kitchen_product);
                if($get_affected_rows)
                {
                    echo "<script> alert('Created Kitchen Product'); </script>";
                    $this->products_master();
                }
              }
              else
              {
                //$this->create_category("vae");
                echo "<script> alert('Error(VAE): Value Already Exists.'); </script>";
                $this->products_master();
              }
           }
           else
           {
               $this->products_master("Required");
           }
      }

    public function update_product_master()
    {
         $data['id']=$this->uri->segment(3);
         $get_value = $this->select_model->select_user("kitchen_product_master",$this->uri->segment(3));
         // print_r($get_value);
         if($get_value->num_rows() > 0)
         {
             $data_array = array();

             foreach($get_value->result() as $kitchen_product)
             {
                 $data_array['update'] = 1;
                 $data_array['id'] = $kitchen_product->id;
                 $data_array['product_name'] = $kitchen_product->product_name;
             }
             $this->products_master(NULL,$data_array);
         }

         /*
          *  Update button
          */

         if($this->input->post('cat_update') == "cat_update")
         {

             $this->form_validation->set_rules('update_kitchen_product','update_kitchen_product','required');

             if($this->form_validation->run())
             {
                  $get_update = array(
                     "id" => $this->input->post('update_id'),
                     "product_name" => (string)$this->input->post('update_kitchen_product')
                 );

                 $get_update_count = $this->update_model->update_kitchen_product_master($get_update);
                 if($get_update_count >= 0)
                 {
                     echo "<script> alert('Updated'); </script>";
                     redirect(base_url()."superadmin/update_product_master/".$this->uri->segment(3),'refresh');
                 }

             }
             else
             {
                 echo "<script> alert('ERROR(UVE) : Update Value Should Not Be Empty'); </script>";
                 redirect(base_url()."superadmin/products_master/".$this->uri->segment(4),'refresh');
             }
         }
    }




    public function delete_product_master()
    {
         //echo($this->uri->segment(4));
         $get_affected_rows = $this->delete_model->delete_kitchen_product($this->uri->segment(3));

         if($get_affected_rows)
         {
            redirect(base_url()."superadmin/products_master",'refresh');
         }
    }
      // =================================================================
      public function units_master($error=NULL,$data_array=NULL)
      {
           if($this->session->has_userdata('admin_id'))
           {
               $data['user_data'] = $this->select_model->select_user($this->backend_table,$this->admin_id);
               $this->load->view('headers/superadmin_home_header',$data);

               $data['error_handler'] = $error;
               $data['units_data'] = $this->select_model->get_units_master();

               if(isset($data_array))
               {
                   $data['update'] = 1;
                   $data['id'] = $data_array['id'];
                   $data['units'] = $data_array['units'];
               }
               $this->load->view('masters/unit_master',$data);
               $this->load->view('headers/footer');
           }
           else
           {
               $this->error_403();
           }
      }

      public function create_units()
      {
           $this->form_validation->set_rules('units', 'units', 'required');
           if ($this->form_validation->run())
           {
              $insert_units = array(
                    "units"=>$this->input->post("units")
              );

              $get_count = $this->validate_model->get_units($insert_units['units']);

              if(!($get_count))
              {
                $get_affected_rows = $this->insert_model->insert_units($insert_units);
                if($get_affected_rows)
                {
                    echo "<script> alert('Created Units'); </script>";
                    $this->units_master();
                }
              }
              else
              {
                //$this->create_category("vae");
                echo "<script> alert('Error(VAE): Value Already Exists.'); </script>";
                $this->units_master();
              }
           }
           else
           {
               $this->units_master("Required");
           }
      }



        public function update_units()
        {
             $data['id']=$this->uri->segment(3);
             $get_value = $this->select_model->select_user("units_master",$this->uri->segment(3));
             // print_r($get_value);
             if($get_value->num_rows() > 0)
             {
                 $data_array = array();

                 foreach($get_value->result() as $units)
                 {
                     $data_array['update'] = 1;
                     $data_array['id'] = $units->id;
                     $data_array['units'] = $units->units;
                 }
                 $this->units_master(NULL,$data_array);
             }

             /*
              *  Update button
              */

             if($this->input->post('cat_update') == "cat_update")
             {

                 $this->form_validation->set_rules('update_units','update_units','required');

                 if($this->form_validation->run())
                 {
                      $set_update = array(
                         "id" => $this->input->post('update_id'),
                         "units" => (string)$this->input->post('update_units')
                     );

                     $get_update_count = $this->update_model->update_units_master($set_update);
                     if($get_update_count >= 0)
                     {
                         echo "<script> alert('Updated'); </script>";
                         redirect(base_url()."superadmin/update_units/".$this->uri->segment(3),'refresh');
                     }

                 }
                 else
                 {
                     echo "<script> alert('ERROR(UVE) : Update Value Should Not Be Empty'); </script>";
                     redirect(base_url()."superadmin/units_master/".$this->uri->segment(4),'refresh');
                 }

             }
        }
        public function delete_units()
        {
             //echo($this->uri->segment(4));
             $get_affected_rows = $this->delete_model->delete_units($this->uri->segment(3));

             if($get_affected_rows)
             {
                redirect(base_url()."superadmin/units_master",'refresh');
             }
        }
     //================================================================== 

  /**
   *  Author  :   Mounika Marella
   *  Date    :   22022019
   */
public function kitchen_inventory($error = null)
{
    $data['user_data'] = $this->select_model->select_user($this->backend_table,$this->admin_id);
    $this->load->view('headers/superadmin_home_header',$data);

    $data['get_kitchen_id'] = $this->select_model->select_kitchen_register();
    $data['get_kitchen_products'] = $this->select_model->get_kitchen_products_master();
    $data['get_units_master'] = $this->select_model->get_units_master();

    if(isset($error))
    {
      $data['error'] = $error;
    }

    $this->load->view('kitchen_inventory/create_inventory',$data);
   
    $this->load->view('headers/footer');
}

public function create_kitchen_inventory()
{
   $this->form_validation->set_rules('kitchen_id','kitchen_id','required');
   $this->form_validation->set_rules('product_name[]','product_name[]','required');
   $this->form_validation->set_rules('units_name[]','units_name[]','required');
   $this->form_validation->set_rules('product_sku[]','product_sku[]','required');
   $this->form_validation->set_rules('quantity[]','quantity[]','required');
   
   if($this->form_validation->run())
   {
      $get_table_name = $this->validate_model->check_tables($this->input->post('kitchen_id'));
      if(!($get_table_name))
      {
       $get_create_return =  $this->create_model->create_inventory_tables($this->input->post('kitchen_id'));
       if($get_create_return)
       {
          for($i = 0; $i < count($this->input->post('product_name[]')); $i++)
          {
            $insert_kitchen_inventory = array(
                "product_name" => $this->input->post('product_name[]')[$i],
                "product_units"=> $this->input->post('units_name[]')[$i],
                "product_sku" => $this->input->post('product_sku[]')[$i],
                "product_quantity" => $this->input->post('quantity[]')[$i]
            );

            $update_kitchen_inventory = array(
                "product_name" => $this->input->post('product_name[]')[$i],
                "product_units"=> $this->input->post('units_name[]')[$i],
                "product_sku" => $this->input->post('product_sku[]')[$i],
                "product_quantity" => $this->input->post('quantity[]')[$i],
                "addordel" => "a"
            );

            $get_insert_product = $this->insert_model->kitchen_inventory_insert($this->input->post('kitchen_id'),$insert_kitchen_inventory);
            if($get_insert_product)
            {
              $get_update_product = $this->insert_model->kitchen_inventory_update($this->input->post('kitchen_id'),$update_kitchen_inventory);

              if($get_update_product)
              {
                echo "<script> alert('Kitchen Inventory Created'); </script>";
                echo "<script>window.location.href='".base_url()."superadmin/kitchen_inventory';</script>";
              }
            }

          }
       }
      }
      else
      {
        for($i = 0; $i < count($this->input->post('product_name[]')); $i++)
          {
            $insert_kitchen_inventory = array(
                "product_name" => $this->input->post('product_name[]')[$i],
                "product_units"=> $this->input->post('units_name[]')[$i],
                "product_sku" => $this->input->post('product_sku[]')[$i],
                "product_quantity" => $this->input->post('quantity[]')[$i]
            );

            $update_kitchen_inventory = array(
                "product_name" => $this->input->post('product_name[]')[$i],
                "product_units"=> $this->input->post('units_name[]')[$i],
                "product_sku" => $this->input->post('product_sku[]')[$i],
                "product_quantity" => $this->input->post('quantity[]')[$i],
                "addordel" => "a"
            );

            $get_insert_product = $this->insert_model->kitchen_inventory_insert($this->input->post('kitchen_id'),$insert_kitchen_inventory);
            if($get_insert_product)
            {
              $get_update_product = $this->insert_model->kitchen_inventory_update($this->input->post('kitchen_id'),$update_kitchen_inventory);

              if($get_update_product)
              {
                echo "<script> alert('Kitchen Product Added'); </script>";
                echo "<script>window.location.href='".base_url()."superadmin/kitchen_inventory';</script>";
              }
            }
          }
      }
   }
   else
   {
    $this->kitchen_inventory();
   }
}



public function manage_kitchen_inventory()
{
    $data['user_data'] = $this->select_model->select_user($this->backend_table,$this->admin_id);
  $this->load->view('headers/superadmin_home_header',$data); 
    $data['get_kitchen_id'] = $this->select_model->select_kitchen_register();
    $data['get_kitchen_products'] = $this->select_model->get_kitchen_products_master();
    $data['get_units_master'] = $this->select_model->get_units_master();

  $this->load->view('kitchen_inventory/manage_kitchen_inventory',$data);
  $this->load->view('headers/footer');

}

/*================================================================*
*                   FUNCTIONS CALLED BY AJAX                      *
*=================================================================*/


  public function ajaxCallCheckSku()
  {
   
    $get_validation = $this->validate_model->ajaxCallValidateSku($this->input->post('ajax_kitchen_id'),$this->input->post('ajax_product_name'),$this->input->post('ajax_sku'));
    echo $get_validation;
  }

 //   DATE      :     27022019 
 public function ajaxCallGetInventory()
 {
   // echo $this->input->post('table_name');
   $get_inventory_data = $this->select_model->ajaxCallGetProducts($this->input->post('table_name'));
   echo $get_inventory_data;
 }

 public function ajaxCallAddQuant()
 {
   $add_stock = array(
          "product_name"=>$this->input->post('ajaxProductName'),
          "product_sku"=>$this->input->post('ajaxProductSku'),
          "product_units"=>$this->input->post('ajaxProductUnits'),
          "product_quantity"=>$this->input->post('ajaxUpdatedQuant'),
          "addordel"=>$this->input->post('ajaxAddFlag')
      );
   $stock = $this->insert_model->kitchen_inventory_update($this->input->post('ajaxTableName'),$add_stock);
          if($stock)
          {
              $get_stock = array(
                  "sku" => $add_stock['product_sku'],
                  "quantity" => $add_stock['product_quantity']
              );
          echo $get_affected = $this->update_model->update_stock_add($this->input->post('ajaxTableName'),$get_stock);
          }
 }

 public function ajaxCallDeductQuant()
 {
   $deduct_stock = array(
              "product_name"=>$this->input->post('ajaxProductName'),
              "product_sku"=>$this->input->post('ajaxProductSku'),
              "product_units"=>$this->input->post('ajaxProductUnits'),
              "product_quantity"=>$this->input->post('ajaxUpdatedQuant'),
              "addordel"=>$this->input->post('ajaxAddFlag')
          );
          $stock = $this->insert_model->kitchen_inventory_update_deduct($this->input->post('ajaxTableName'),$deduct_stock);
          if($stock)
          {
              $get_stock = array(
                  "sku" => $deduct_stock['product_sku'],
                  "quantity" => $deduct_stock['product_quantity']
              );
          echo $get_affected = $this->update_model->update_stock_deduct($this->input->post('ajaxTableName'),$get_stock);
          }

 }

 public function ajaxCallDeleteProduct()
 {
   $delete_product = array(
     "table_name" => $this->input->post('ajaxTableName'),
     "id"=>$this->input->post('ajaxProductId')
   );

   $get_affected = $this->delete_model->delete_kitchen_inventory_product($delete_product);
   if($get_affected)
   {
       echo "<script> alert('Deleted') </script>";
   }
 }



 /*
 * VED date ::06-04-2019
 */
//PRIMARY STOCK MANAGEMENT
public function primary_stock_products()
{
 if($this->session->has_userdata('admin_id'))
 {
   $data['user_data'] = $this->select_model->select_user($this->backend_table,$this->admin_id);
   $this->load->view('headers/superadmin_home_header',$data);
   $data['units_data'] = $this->select_model->get_units_master();
   $this->load->view('stock/create_primary_products',$data);
   $this->load->view('headers/footer');
 }
 else
 {
   $this->error_403();
 }
}

public function insert_primary_stock_products()
{
 $this->form_validation->set_rules('product_name', 'product_name', 'required');
 $this->form_validation->set_rules('product_sku', 'product_sku', 'required');
 $this->form_validation->set_rules('primary_units', 'primary_units', 'required');
 $this->form_validation->set_rules('secondary_units', 'secondary_units', 'required');
 $this->form_validation->set_rules('product_description', 'product_description', 'required');
 if($this->form_validation->run())
 {
   $get_values = array(
     "product_name"=>$this->input->post('product_name'),
     "product_sku"=>$this->input->post('product_sku'),
     "primary_units"=>$this->input->post('primary_units'),
     "secondary_units"=>$this->input->post('secondary_units'),
     "product_description"=>$this->input->post('product_description')
   );
   $get_insert = $this->insert_model->insert_create_primary_stock($get_values);
   if($get_insert)
   {
     echo "<script> alert('Product Created'); </script>";
     $this->primary_stock_products();
   }
 }
 else
 {
   $this->primary_stock_products();
 }
}

public function manage_primary_stock_products()
{
 if($this->session->has_userdata('admin_id'))
 {
   $data['user_data'] = $this->select_model->select_user($this->backend_table,$this->admin_id);
   $this->load->view('headers/superadmin_home_header',$data);
   $data['select_primary_product'] = $this->select_model->select_primary_products(NULL);
   $this->load->view('stock/manage_primary_products',$data);
   $this->load->view('headers/footer');
 }
 else
 {
   $this->error_403();
 }
}

public function update_primary_stock_products()
{
 if($this->session->has_userdata('admin_id'))
 {
   $id = $this->uri->segment(3);
   $data['user_data'] = $this->select_model->select_user($this->backend_table,$this->admin_id);
   $this->load->view('headers/superadmin_home_header',$data);
   $data['units_data'] = $this->select_model->get_units_master();
   $data['get_primary_products'] = $this->select_model->select_primary_products($id);
   $this->load->view('stock/create_primary_products',$data);
   $this->load->view('headers/footer');
 }
 else
 {
   $this->error_403();
 }
}

public function update_primary_stock_products_data()
{
 $this->form_validation->set_rules('product_name', 'product_name', 'required');
 $this->form_validation->set_rules('product_sku', 'product_sku', 'required');
 $this->form_validation->set_rules('primary_units', 'primary_units', 'required');
 $this->form_validation->set_rules('secondary_units', 'secondary_units', 'required');
 $this->form_validation->set_rules('product_description', 'product_description', 'required');
 if($this->form_validation->run())
 {
   $get_values = array(
     "product_name"=>$this->input->post('product_name'),
     "product_sku"=>$this->input->post('product_sku'),
     "primary_units"=>$this->input->post('primary_units'),
     "secondary_units"=>$this->input->post('secondary_units'),
     "product_description"=>$this->input->post('product_description')
   );

   if($this->input->post('update'))
   {
     $get_affected = $this->update_model->update_primary_products($this->input->post("get_product_id"),$get_values);
     if($get_affected >= 0)
     {
       echo "<script> alert('Product Updated'); </script>";
       echo "<script> window.location.href='".base_url()."/superadmin/manage_primary_stock_products'; </script>";
     }
   }
 }
 else
 {
     if($this->session->has_userdata('admin_id'))
     {
       $id = $this->input->post("get_product_id");
       $data['user_data'] = $this->select_model->select_user($this->backend_table,$this->admin_id);
       $this->load->view('headers/superadmin_home_header',$data);
       $data['units_data'] = $this->select_model->get_units_master();
       $data['get_primary_products'] = $this->select_model->select_primary_products($id);
       $this->load->view('stock/create_primary_products',$data);
       $this->load->view('headers/footer');
     }
     else
     {
       $this->error_403();
     }
 }

}

public function delete_primary_stock_products()
{
 $get_affected_rows = $this->delete_model->delete_primary_stock_products($this->uri->segment(3));
 if($get_affected_rows)
 {
   redirect(base_url()."superadmin/manage_primary_stock_products",'refresh');
 }
}


//INSERT PRODUCTS TO STOCK INVENTORY
public function primary_stock_inventory()
{
     if($this->session->has_userdata('admin_id'))
    {
      $data['user_data'] = $this->select_model->select_user($this->backend_table,$this->admin_id);
      $this->load->view('headers/superadmin_home_header',$data);
      $data['get_products'] = $this->select_model->select_primary_products(NULL);
      $data['store_data'] = $this->select_model->get_store_master();
      $this->load->view('stock/primary_stock_inventory',$data);
      $this->load->view('headers/footer');
    }
    else
    {
      $this->error_403();
    }
}

public function insert_primary_stock_inventory()
{
        $this->form_validation->set_rules('product_name', 'product_name', 'required');
     $this->form_validation->set_rules('store_name','store_name','required');
     $this->form_validation->set_rules('grid_combo','grid_combo','required');
      if ($this->form_validation->run())
     {
       $insert_product_stock =  array(
         "product_name" => $this->input->post('product_name'),
         "product_sku" => $this->input->post('product_sku'),
         "primary_units" => $this->input->post('primary_units'),
         "secondary_units" => $this->input->post('secondary_units'),
         "store_name" => $this->input->post('store_name'),
         "rgb_combo" => $this->input->post('grid_combo'),
         "quantity" => $this->input->post('stock_qunatity')
       );
       $get_insert = $this->insert_model->insert_primary_stock_qunatity($insert_product_stock);
       if($get_insert)
       {
         $update_insert_product_stock =  array(
           "product_name" => $insert_product_stock['product_name'],
           "product_sku" => $insert_product_stock['product_sku'],
           "primary_units" => $insert_product_stock['primary_units'],
           "secondary_units" => $insert_product_stock['secondary_units'],
           "store_name" => $insert_product_stock['store_name'],
           "rgb_combo" => $insert_product_stock['rgb_combo'],
           "addordel" => 'a',
           "quantity" =>$insert_product_stock['quantity']
         );
         $get_update_insert = $this->insert_model->update_insert_primary_quantity($update_insert_product_stock);
         if($get_update_insert)
         {
           echo "<script> alert('Quantity Inserted'); </script>";
           $this->primary_stock_inventory();
         }
       }
     }
     else
     {
       $this->primary_stock_inventory();
     } 
 }

public function manage_primary_stock_inventory()
{
       if($this->session->has_userdata('admin_id'))
      {
        $data['user_data'] = $this->select_model->select_user($this->backend_table,$this->admin_id);
       $this->load->view('headers/superadmin_home_header',$data); 
       $data['store_data'] = $this->select_model->get_store_master();
       $this->load->view('stock/manage_primary_stock_inventory',$data);
       $this->load->view('headers/footer');
    
     }
}


/*================================================================*
*                   FUNCTIONS CALLED BY AJAX                      *
*=================================================================*/

public function ajaxGetGridBinCombo()
{
     $get_data = $this->select_model->select_grid_combo($this->input->post('valSetter'));
    echo json_encode($get_data->result());
}

public function ajaxCheckgridAvailability()
{
     $get_data = $this->validate_model->count_inventory_RGB($this->input->post('valSetter'),$this->input->post('comboIdSetter'));
    echo $get_data;

}
//06-03-19
public function ajaxGetGridBinCombo_id()
{
 $get_data = $this->select_model->select_grid_combo_id($this->input->post('valSetter'));
 echo json_encode($get_data->result());
}
    //07-03-19
    public function ajaxGetProductDetails()
    {
        $get_data = $this->select_model->select_stock_inventory($this->input->post('store_name'));
        echo json_encode($get_data->result());
    }
    //07-03-19
    public function ajaxAddPrimaryStock()
    {
      $set_val = array(
          "product_name" => $this->input->post('product_name'),
          "product_sku" => $this->input->post('product_sku'),
          "primary_units" => $this->input->post('primary_units'),
          "secondary_units" => $this->input->post('secondary_units'),
          "store_name" => $this->input->post('store_name'),
          "rgb_combo" => $this->input->post('rgb_combo'),
          "addordel" => $this->input->post('addordel'),
          "quantity" =>$this->input->post('quantity')
      );
      // print_r($set_val);
      $insert_update = $this->insert_model->update_insert_primary_quantity($set_val);
      if($insert_update)
      {
        echo $set_update = $this->update_model->update_primary_stock($set_val['rgb_combo'],$set_val['quantity']);
      }
    }
    //07-03-19
   public function ajaxremovePrimaryStock()
    {
      $set_val = array(
        "product_name" => $this->input->post('product_name'),
        "product_sku" => $this->input->post('product_sku'),
        "primary_units" => $this->input->post('primary_units'),
        "secondary_units" => $this->input->post('secondary_units'),
        "store_name" => $this->input->post('store_name'),
        "rgb_combo" => $this->input->post('rgb_combo'),
        "addordel" => $this->input->post('addordel'),
        "quantity" =>$this->input->post('quantity')
    );
    // print_r($set_val);
    $insert_remove = $this->insert_model->remove_insert_primary_quantity($set_val);
    if($insert_remove)
    {
      echo $set_remove = $this->update_model->remove_primary_stock($set_val['rgb_combo'],$set_val['quantity']);
    }
    }
    public function delete_primary_stock_inventory()
    {
    $get_affected_rows = $this->delete_model->delete_primary_stock_inventory($this->input->post('product_id'));
    if($get_affected_rows)
    {
      redirect(base_url()."superadmin/manage_primary_stock_inventory",'refresh');
    }
    }
//===================================================================
//======================Delivery Challan=============================

//INSERT PRODUCTS TO STOCK INVENTORY
public function delivery_challan()
{
 if($this->session->has_userdata('admin_id'))
 {
   $data['user_data'] = $this->select_model->select_user($this->backend_table,$this->admin_id);
   $this->load->view('headers/superadmin_home_header',$data);
   $data['get_products'] = $this->select_model->select_dc_products(NULL);
   $data['store_data'] = $this->select_model->get_store_master();
   $data['kitchen_id'] = $this->select_model->select_kitchen_register();
   $this->load->view('stock/delivery_challan',$data);
   $this->load->view('headers/footer');
 }
 else
 {
   $this->error_403();
 }
}
public function dc_data()
  {
     
        $data = array(
          "kitchen_id"=>$this->input->post("kitchen_name"),
          "delivery_id"=>$this->input->post("delivery_user"),
          "dc_no"=>$this->input->post("dc_no"),
          "product_name"=>$this->input->post("product_name"),
          "product_sku"=>$this->input->post("product_sku"),
          "product_units"=>$this->input->post("primary_units"),
          "available_quantity"=>$this->input->post("stock_quantity"),
          "product_quantity"=>$this->input->post("dc_quantity"),
          "store_name"=>$this->input->post("store_name"),
          "prod_ploc"=>$this->input->post("grid_id")
          );
        $insert = $this->insert_model->insert_dc_value($data);
        if($insert)
          {
            echo "<script> alert('Inserted Successfully'); </script>";
            $this->manage_delivery_challan();
           
          }

  }
  function manage_delivery_challan()
  {
    if($this->session->has_userdata('admin_id'))
      {
        $data['user_data'] = $this->select_model->select_user($this->backend_table,$this->admin_id);
        $data['dc_challan_data'] = $this->select_model->get_dc_data();
          $this->load->view('headers/superadmin_home_header',$data);
          $this->load->view('stock/manage_delivery_cha',$data);
          $this->load->view('headers/footer');
        }
      else
      {
          $this->error_403();
      }

  }
  public function edit_delivery_challan()
  {
     if($this->session->has_userdata('admin_id'))
     {
       $data['user_data'] = $this->select_model->select_user($this->backend_table,$this->admin_id);
       
       
         $data["get_delivery_data"] = $this->select_model->get_dc_data_id($this->uri->segment(3));
        $data['get_products'] = $this->select_model->select_dc_products(NULL);
       $data['store_data'] = $this->select_model->get_store_master();
       $data['kitchen_id'] = $this->select_model->select_kitchen_register();
       $this->load->view('headers/superadmin_home_header',$data);
       $this->load->view('stock/delivery_challan',$data);
       $this->load->view('headers/footer');
     }
     else
     {
       $this->error_403();
     }
  }
  function edit_delivery_challan_data()
  {
    $id = $this->input->post("dc_hid");
    $data = array(
          "kitchen_id"=>$this->input->post("kitchen_name"),
          "delivery_id"=>$this->input->post("delivery_user"),
          "dc_no"=>$this->input->post("dc_no"),
          "product_name"=>$this->input->post("product_name"),
          "product_sku"=>$this->input->post("product_sku"),
          "product_units"=>$this->input->post("primary_units"),
          "available_quantity"=>$this->input->post("stock_quantity"),
          "product_quantity"=>$this->input->post("dc_quantity"),
          "store_name"=>$this->input->post("store_name"),
          "prod_ploc"=>$this->input->post("grid_id")
          );
      $update = $this->update_model->update_dc($id,$data);
        if($update)
          {
            echo "<script> alert('Update Successfully'); </script>";
            $this->manage_delivery_challan();
           
          }


  }
  //7-03-19
  public function delete_dc()
      {
        $id=$this->input->post("id");
        $data = array(
          "status" => "1"
        );
            $get_affected_rows = $this->update_model->update_dc($id,$data);
            
            if($get_affected_rows)
            {
               redirect(base_url()."superadmin/manage_delivery_challan",'refresh');
            }
        }
    

//=======================End Delivery Challan============================
//=======================Recipt Challan =============================
  function receipt_challan()
  {
    if($this->session->has_userdata('admin_id'))
      {
        $data['user_data'] = $this->select_model->select_user($this->backend_table,$this->admin_id);
       $this->load->view('headers/superadmin_home_header',$data); 
       $data['kitchen_data'] = $this->select_model->select_kitchen_register();
       $this->load->view('stock/recipt_challan',$data);
       $this->load->view('headers/footer');
    
     }
  }
  //08-03-19
    public function ajaxGetReciptDetails()
    {
        $get_data = $this->select_model->select_rc($this->input->post('kitchen_name'));
        echo json_encode($get_data->result());
    }
//=======================End Recipt Challan =========================
//=========================Delivery Manage ======================
//19-03-19
 public function delivery_manage()
 {
  if($this->session->has_userdata('admin_id'))
      {
        $data['user_data'] = $this->select_model->select_user($this->backend_table,$this->admin_id);
       $this->load->view('headers/superadmin_home_header',$data); 
       $data['kitchen_data'] = $this->select_model->select_kitchen_register();
        $data['product_data'] = $this->select_model->select_del_product();
       $this->load->view('deliveryhub/delivery_manage',$data);
       $this->load->view('headers/footer');
    
     }
      else
          {
                $this->error_403();
          }
 }

 function fetch_ajax_product()
  {
    $data = $this->input->post('sku');
    $splittedstring=explode("%",$data);
    
    if($this->select_model->fetch_ajax_productsku($splittedstring[1],$splittedstring[0]))
    {
      
      $output=$this->select_model->fetch_ajax_productsku($splittedstring[1],$splittedstring[0]);
      echo json_encode($output->result());
    }
    else
    {
      echo "Failed";
    }
  }
//20-03-19
 public function delivery_kitchen_data()
 {
  $d=0;
  $count = count($this->input->post("product_sku[]"));
  for($i = 0;$i < $count; $i++){
    $data = array(
      "kit_id" => $this->input->post("delivery_user"),
      "product_sku" => $this->input->post("prod_sku[$i]"),
      "product_name" => $this->input->post("product_name[$i]"),
      "quantity" => $this->input->post("quantity[$i]"),
      "user_id" => $this->input->post("userid[$i]"),
      "user_table" => $this->input->post("user_table[$i]"),
      "order_id" => $this->input->post("order_id[$i]"),
      "row_id" => $this->input->post("rowid[$i]"),
      "unique_order_id" => $this->input->post("unique_id[$i]"),
      "bundled_flag" => $this->input->post("bundle_flag[$i]")
    );
     $insert = $this->insert_model->del_kitchen($data);
     $d++;
   }
    if($d == $count)
          {
            echo "<script> alert('Inserted Successfully'); </script>";
            echo "<script>window.location.href='".base_url()."superadmin/manage_delivery_kitchen';</script>";
          }
 }
 //20-03-19
 function manage_delivery_kitchen()
 {
  if($this->session->has_userdata('admin_id'))
      {
        $data['user_data'] = $this->select_model->select_user($this->backend_table,$this->admin_id);
        $data['del_data'] = $this->select_model->select_del_kitchen();

          $this->load->view('headers/superadmin_home_header',$data);
          $this->load->view('deliveryhub/del_kitchen_manage',$data);
          $this->load->view('headers/footer');
        }
      else
      {
          $this->error_403();
      }
 }
 public function edit_delivery_kitchen()
  {
     if($this->session->has_userdata('admin_id'))
     {
       $data['user_data'] = $this->select_model->select_user($this->backend_table,$this->admin_id);
       
       //$id = $this->uri->segment(3);
        $data['del_data'] = $this->select_model->select_del($this->uri->segment(3));
        
       $data['store_data'] = $this->select_model->get_store_master();
      // $data['kitchen_id'] = $this->select_model->select_kitchen_register();
         $data['kitchen_data'] = $this->select_model->select_kitchen_register();
       //print_r($data);
       $this->load->view('headers/superadmin_home_header',$data);
       $this->load->view('deliveryhub/delivery_manage',$data);
       $this->load->view('headers/footer');
     }
     else
     {
       $this->error_403();
     }
  }
 //delete delivery kitchen order
     public function delete_del_kitchen()
      {
            $get_affected_rows = $this->delete_model->delete_del_kitchen($this->uri->segment(3));
            
            if($get_affected_rows)
            {
               redirect(base_url()."superadmin/manage_delivery_kitchen",'refresh');
            }
        }
 //==================================End Delivery Manage ==================
//==============================Kitchen Employee =========================
// Kitchen employee 
   public function kitchen_employee()
   {
   if($this->session->has_userdata('admin_id'))
      {
          $data['user_data'] = $this->select_model->select_user($this->backend_table,$this->admin_id);
              $data['kitchen_data'] = $this->select_model->get_kitchen_name();
              $data['get_role'] = $this->select_model->get_role_master();
               $this->load->view('headers/superadmin_home_header',$data);
               $this->load->view('kitchen/kitchen_company_employee',$data);
               $this->load->view('headers/footer');
          }
          else
          {
                $this->error_403();
          }
   } 
    //20-2-2019(Mounika)
   function employee()
    {
        $this->form_validation->set_rules('txtkitchen_id', 'txtkitchen_id', 'required');
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
                "kitchen_id"=>$this->input->post("txtkitchen_id"),
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
                "bank_ifsc"=>$this->input->post("txtifsc"),
                "approve" => '1'
          );

          $get_count = $this->validate_model->get_employee($insert_employee['emp_id']);

          if(!($get_count))
          {
            $get_affected_rows = $this->insert_model->insert_kitchen_employee($insert_employee);
            if($get_affected_rows)
            {
                echo "<script> alert('Created Employee'); </script>";
                $this->kitchen_employee();
            }
          }
          else
          {
            //$this->create_category("vae");
            echo "<script> alert('Error(VAE): Value Already Exists.'); </script>";
              $this->kitchen_employee();
                // $this->create_category();
          }
       }
       else
       {
        $this->kitchen_employee();
       }
       
    }  

    //21-03-2019(Divya)
    public function view_employee()
    {
     if($this->session->has_userdata('admin_id'))
      {
        $data['user_data'] = $this->select_model->select_user($this->backend_table,$this->admin_id);
        $data['get_role'] = $this->select_model->get_role_master();
        $data['kitchen_user_employee'] = $this->select_model->get_kitchen_company_emp();
        $this->load->view('headers/superadmin_home_header',$data);
        $this->load->view('kitchen/kit_company_view',$data);
        $this->load->view('headers/footer');
      }
      else
      {
        $this->error_403();
      }
    }  
    //21-03-2019(Divya)
    public function edit_employee()
    {
    if($this->session->userdata('admin_id'))
    {
      $data['user_data'] = $this->select_model->select_user($this->backend_table,$this->admin_id);
      $data['kitchen_data'] = $this->select_model->get_kitchen_name();
        $data['kitchen_emp_data'] = $this->select_model->kitchen_empid($this->uri->segment(3));
        $data['get_role'] = $this->select_model->get_role_master();
        
        $this->load->view('headers/superadmin_home_header',$data);
        $this->load->view('kitchen/kitchen_company_employee',$data);
        $this->load->view('headers/footer');
    }
    else
    {
      $this->error_403();
    }
    }
    //20-2-2019(Mounika)
    public function update_employee()
    {
        $this->form_validation->set_rules('txtkitchen_id', 'txtkitchen_id', 'required');
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
                "kitchen_id"=>$this->input->post("txtkitchen_id"),
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
                "bank_ifsc"=>$this->input->post("txtifsc"),
                "approve" =>'1'
          );

         // print_r($update_employee);

          $get_update = $this->update_model->update_emp_profile($this->input->post("id"),$update_employee);
          if($get_update >= 0)
          {
            echo "<script> alert('Employee profile updated'); </script>";
            echo "<script>window.location.href='".base_url()."superadmin/view_employee';</script>";
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
        $data['kitchen_emp_data'] = $this->select_model->kitchen_empid($this->session->userdata('emp_id'));
        $data['get_role'] = $this->select_model->get_role_master();
         $data['kitchen_data'] = $this->select_model->get_kitchen_name();
       $this->load->view('headers/superadmin_home_header',$data);
        $this->load->view('kitchen/kitchen_employee',$data);
    $this->load->view('headers/footer');
       }
       
    }
   //20-2-2019(Mounika)
    public function delete_employee()
    {
      $data = array(
          "status" => '1'
      );
        $get_affected_rows = $this->update_model->update_emp_status($this->uri->segment(3),$data);

        if($get_affected_rows >=0)
        {
           redirect(base_url()."superadmin/view_employee",'refresh');
        }
    }
     //21-03-2019(Divya)
    public function employee_approve()
    {
     if($this->session->has_userdata('admin_id'))
      {
        $data['user_data'] = $this->select_model->select_user($this->backend_table,$this->admin_id);
        $data['get_role'] = $this->select_model->get_role_master();
        $data['kitchen_user_employee'] = $this->select_model->get_kitchen_approve();
        $this->load->view('headers/superadmin_home_header',$data);
        $this->load->view('kitchen/employee_approve',$data);
        $this->load->view('headers/footer');
      }
      else
      {
        $this->error_403();
      }
    }  
    //20-2-2019(Mounika)
    public function approved_employee()
    {
      $data = array(
          "approve" => '1'
      );
        $get_affected_rows = $this->update_model->update_emp_status($this->uri->segment(3),$data);

        if($get_affected_rows)
        {
           redirect(base_url()."superadmin/employee_approve",'refresh');
        }
    }
//=========================================================================
  //======================Deliveryhub employee approve=====================
    //2-04-2019(Divya)
    public function delivery_employee_approve()
    {
     if($this->session->has_userdata('admin_id'))
      {
        $data['user_data'] = $this->select_model->select_user($this->backend_table,$this->admin_id);
        $data['get_role'] = $this->select_model->get_role_master();
        $data['kitchen_user_employee'] = $this->select_model->get_del_emp_approve();
        $this->load->view('headers/superadmin_home_header',$data);
        $this->load->view('deliveryhub/delivery_emp_approve',$data);
        $this->load->view('headers/footer');
      }
      else
      {
        $this->error_403();
      }
    }  
    //2-04-2019(Divya)
    public function approved_del_employee()
    {
      $data = array(
          "approve" => '1'
      );
        $get_affected_rows = $this->update_model->update_del_emp_status($this->uri->segment(3),$data);

        if($get_affected_rows)
        {
           redirect(base_url()."superadmin/delivery_employee_approve",'refresh');
        }
    }
  //=======================================================================
  //=======================Attendance(mounika)============================
public function ajaxCallKitchenAttendance()
   {
     $set_kitchen_id = $this->input->post('kitchen_id');
     $set_date = $this->input->post('date');

     $get_data = $this->select_model->select_kitchen_emp_attendance($set_kitchen_id,$set_date);

     if($get_data->num_rows() > 0)
     {
       echo json_encode($get_data->result());
     }
     else
     {
        echo 0;
     }
   }


   public function ajaxCallUpdateAttendance()
   {
     $set_id = $this->input->post('setId');
     $set_flag = $this->input->post('setFlag');
     $get_affected = $this->update_model->updateAttendance($set_id,$set_flag);
   }

public function kitchen_emp_attendance()
  {
         $data['user_data'] = $this->select_model->select_user($this->backend_table,$this->admin_id);
       $this->load->view('headers/superadmin_home_header',$data); 
        $data['kitchen_data'] = $this->select_model->select_kitchen_register();
       $this->load->view('products/kitchen_emp_attendance',$data);
       $this->load->view('headers/footer');  
  }

  public function change_profile()
  {
    if($this->session->userdata('admin_id'))
    {
    $data['user_data'] = $this->select_model->select_user($this->backend_table,$this->admin_id);
        
    $this->load->view('headers/superadmin_home_header',$data);
    $data['super_user_data'] = $this->select_model->get_super_id($this->session->userdata('admin_id'),$this->session->userdata('email_id'));

        $this->load->view('products/change_profile',$data);
    $this->load->view('headers/footer');
    }
    else
    {
      $this->error_403();
    }
  }

  public function edit_profile_data()
  {
    $this->form_validation->set_rules('superadmin_name','superadmin_name','required');
    $this->form_validation->set_rules('old_password','old_password','required');
    $this->form_validation->set_rules('new_password','new_password','required');
    $this->form_validation->set_rules('renew_pass','renew_pass','required');
     
      if($this->form_validation->run())
       {
      
        $user_data = array(
      "id" => $this->input->post("superadmin_id"),
      "user_name" => $this->input->post("superadmin_name"),
      "password" => $this->input->post("renew_pass")
    );
    
    // echo json_encode($user_data);

      $get_update = $this->update_model->update_admin_profile($user_data);
      if($get_update >= 0)
      {
              echo "<script> alert('user profile updated'); </script>";
              echo "<script>window.location.href='".base_url()."superadmin/change_profile/';</script>";
            }
        }
      else
      {
        if($this->session->has_userdata('email_id'))
            {
                $this->change_profile();
            }
            else
            {
                $this->error_403();
            }
      }
  }

//=================================================================
//-------------------------CREATE Delivery Hub --------------------
    public function create_deliveryhub($error = NULL)
    {
      if($this->session->has_userdata('admin_id'))
          {
            $data['user_data'] = $this->select_model->select_user($this->backend_table,$this->admin_id);

            if($error != NULL)
            {
              $data['error'] = "DELHUB";
            }
             $this->load->view('headers/superadmin_home_header',$data);
               $this->load->view('deliveryhub/new_delivery_hub',$data);
               $this->load->view('headers/footer');
          }
          else
          {
                $this->error_403();
          }
    }
    public function insert_deliveryhub_data()
    {
      $this->form_validation->set_rules('delhub_id','delhub_id','required');
      $this->form_validation->set_rules('delhub_name','delhub_name','required');
       $this->form_validation->set_rules('delhub_address1','delhub_address1','required');
       $this->form_validation->set_rules('delhub_address2','delhub_address2','required');
       $this->form_validation->set_rules('delhub_address3','delhub_address3','required');
      $this->form_validation->set_rules('state','state','required');
      $this->form_validation->set_rules('city','city','required');
      $this->form_validation->set_rules('zipcode','zipcode','required');
       if($this->form_validation->run())
       {
      
        $data = array(
          "delhub_id" => $this->input->post("delhub_id"),
          "delhub_name" => $this->input->post("delhub_name"),
          "dh_address1" => $this->input->post("delhub_address1"),
          "dh_address2" => $this->input->post("delhub_address2"),
          "dh_address3" => $this->input->post("delhub_address3"),
                "state" => $this->input->post("state"),
                "city"  => $this->input->post("city"),
              "zipcode" => $this->input->post("zipcode")
           );
      
         $get_count = $this->validate_model->get_deliveryhub($data['delhub_id']);

          if(!($get_count))
          {
            $get_affected_rows = $this->insert_model->insert_deliveryhub($data);
            if($get_affected_rows)
            {
                echo "<script> alert('Created DeliveryHub '); </script>";
                $this->manage_deliveryhub();
            }
          }
          else
          {
            //$this->create_category("vae");
            echo "<script> alert('Error(DELHUB): Value Already Exists.'); </script>";
              $this->create_deliveryhub("DELHUB");
                // $this->create_category();
          }
       }
       else
       {
        $this->create_deliveryhub();
       }

    }
     public function manage_deliveryhub()
    {
      if($this->session->has_userdata('admin_id'))
          {
            $data['user_data'] = $this->select_model->select_user($this->backend_table,$this->admin_id);
            $data['del_data'] = $this->select_model->get_deliveryhub_data();
             $this->load->view('headers/superadmin_home_header',$data);
               $this->load->view('deliveryhub/new_delivery_hub',$data);
               $this->load->view('headers/footer');
          }
          else
          {
                $this->error_403();
          }
    }
    public function edit_deliveryhub()
    {
      if($this->session->has_userdata('admin_id'))
          {
            $data['user_data'] = $this->select_model->select_user($this->backend_table,$this->admin_id);
            $data['delhub_reg_id'] = $this->select_model->select_delhub_id($this->uri->segment(3));
             $this->load->view('headers/superadmin_home_header',$data);
               $this->load->view('deliveryhub/new_delivery_hub',$data);
               $this->load->view('headers/footer');
          }
          else
          {
                $this->error_403();
          }
    }
    public function edit_deliveryhub_data()
    {
      $this->form_validation->set_rules('delhub_id','delhub_id','required');
      $this->form_validation->set_rules('delhub_name','delhub_name','required');
       $this->form_validation->set_rules('delhub_address1','delhub_address1','required');
       $this->form_validation->set_rules('delhub_address2','delhub_address2','required');
       $this->form_validation->set_rules('delhub_address3','delhub_address3','required');
      $this->form_validation->set_rules('state','state','required');
      $this->form_validation->set_rules('city','city','required');
      $this->form_validation->set_rules('zipcode','zipcode','required');
       if($this->form_validation->run())
       {
      
        $data = array(
          "delhub_id" => $this->input->post("delhub_id"),
          "delhub_name" => $this->input->post("delhub_name"),
          "dh_address1" => $this->input->post("delhub_address1"),
          "dh_address2" => $this->input->post("delhub_address2"),
          "dh_address3" => $this->input->post("delhub_address3"),
                "state" => $this->input->post("state"),
                "city"  => $this->input->post("city"),
              "zipcode" => $this->input->post("zipcode")
           );
         $id = $this->input->post('hid_id');
        
            $get_affected_rows = $this->update_model->update_deliveryhub($id,$data);
           if($get_affected_rows >= 0)
            {
                echo "<script> alert('Updated Successfully'); </script>";
                echo "<script>window.location.href='".base_url()."superadmin/manage_deliveryhub';</script>";
              }
        }
         
      
       else
       {
        if($this->session->has_userdata('admin_id'))
          {
            $data['user_data'] = $this->select_model->select_user($this->backend_table,$this->admin_id);
            $data['delhub_reg_id'] = $this->select_model->select_delhub_id($this->input->post('hid_id'));
             $this->load->view('headers/superadmin_home_header',$data);
               $this->load->view('deliveryhub/new_delivery_hub',$data);
               $this->load->view('headers/footer');
          }
          else
          {
                $this->error_403();
          }
       }

    }
     //delete deliveryhub
     public function delete_deliveryhub()
      {
            $get_affected_rows = $this->delete_model->delete_del_hub($this->uri->segment(3));
            
            if($get_affected_rows)
            {
               redirect(base_url()."superadmin/manage_deliveryhub",'refresh');
            }
        }
//-------------------------END CREATE Delivery Hub -------------------------
   
//--------------------------Create Delivery Admin--------------------------
//05-04-2019
public function create_deliveryhub_admin($error = NULL)
    {
      if($this->session->has_userdata('admin_id'))
          {
            $data['user_data'] = $this->select_model->select_user($this->backend_table,$this->admin_id);
            $data['get_delhub'] = $this->select_model->get_deliveryhub_data();
            if($error != NULL)
            {
              $data['error'] = "DHADMIN";
            }
             $this->load->view('headers/superadmin_home_header',$data);
               $this->load->view('deliveryhub/deliveryhub_admin',$data);
               $this->load->view('headers/footer');
          }
          else
          {
                $this->error_403();
          }
    }
 public function insert_dlhub_admin_data()
    {
      $this->form_validation->set_rules('delhub_id','delhub_id','required');
      $this->form_validation->set_rules('first_name','first_name','required');
       $this->form_validation->set_rules('last_name','last_name','required');
       $this->form_validation->set_rules('email','email','required');
       $this->form_validation->set_rules('user_name','user_name','required');
      
       if($this->form_validation->run())
       {
          $data = array(
          "delhub_id" => $this->input->post("delhub_id"),
          "first_name" => $this->input->post("first_name"),
          "last_name" => $this->input->post("last_name"),
          "email_id" => $this->input->post("email"),
          "user_name" => $this->input->post("user_name"),
          "password"  => $this->input->post("password")  
           );
      if($this->input->post('insert'))
         {
         $get_count = $this->validate_model->get_dlhub_admin($data['email_id'],$data['user_name']);

          if($get_count == 0)
          {
            $get_affected_rows = $this->insert_model->insert_dlhub_admin($data);
            if($get_affected_rows)
            {
              

                $this->email->from('zenopsysevolve@gmail.com', 'FSDMS Appliacation');
                $this->email->to((string)$data['email_id']);
                $this->email->subject('Confirm Registration');
                $message = "<html>";
                $message .= "<body>";
                $message .= "<p> Please, click on the link to confirm the registration on FSDMS </p>";
                $message .= "<p> <b>Email Id : ".$data['email_id']."</b></p>";
                $message .= "<p> <b>User Name : ".$data['user_name']."</b></p>";
                $message .= "<p> <b> Password : ".$data['password']."</b></p>";
                $message .= "<p><a href='".base_url()."superadmin/confirmation/5/".base64_encode($data['email_id'])."/".base64_encode($data['password'])."'> Click to Confirm  </a></p>";
                $message .= "</body>";
                $message .= "</html>";
                $this->email->message($message);
                $this->email->send();

                echo $this->email->print_debugger();
                  //redirect(base_url()."superadmin/confirmation/1");
              }
                echo "<script> alert('Created DeliveryHub Admin '); </script>";
                $this->manage_deliveryhub_admin();
           
          }
          else
          {
           
            echo "<script> alert('Error(DHADMIN): Value Already Exists.'); </script>";
              $this->create_deliveryhub_admin("DHADMIN");
              
          }
        }
        }
        else
        {
          $this->create_deliveryhub_admin();
        }
      

    }
     public function manage_deliveryhub_admin()
    {
      if($this->session->has_userdata('admin_id'))
          {
            $data['user_data'] = $this->select_model->select_user($this->backend_table,$this->admin_id);
            $data['dlhub_data'] = $this->select_model->get_deliveryhub_admin();
             $this->load->view('headers/superadmin_home_header',$data);
               $this->load->view('deliveryhub/deliveryhub_admin',$data);
               $this->load->view('headers/footer');
          }
          else
          {
                $this->error_403();
          }
    }
   public function edit_deliveryhub_admin()
    {

      if($this->session->has_userdata('admin_id'))
          {
            $data['user_data'] = $this->select_model->select_user($this->backend_table,$this->admin_id);
             $data['get_delhub'] = $this->select_model->get_deliveryhub_data();
            $data['delhub_admin_id'] = $this->select_model->select_user('deliveryhub_admin',$this->uri->segment(3));
             $this->load->view('headers/superadmin_home_header',$data);
               $this->load->view('deliveryhub/deliveryhub_admin',$data);
               $this->load->view('headers/footer');
          }
          else
          {
                $this->error_403();
          }
    }
    public function edit_delhub_admin_data()
    {
       $this->form_validation->set_rules('delhub_id','delhub_id','required');
      $this->form_validation->set_rules('first_name','first_name','required');
       $this->form_validation->set_rules('last_name','last_name','required');
       $this->form_validation->set_rules('email','email','required');
       $this->form_validation->set_rules('user_name','user_name','required');
      
       if($this->form_validation->run())
       {
         $data = array(
            "delhub_id" => $this->input->post("delhub_id"),
            "first_name" => $this->input->post("first_name"),
            "last_name" => $this->input->post("last_name"),
            "email_id" => $this->input->post("email"),
            "user_name" => $this->input->post("user_name")
             );
           $id = $this->input->post('hid_id');
          
              $get_affected_rows = $this->update_model->update_dlhub_admin($id,$data);
             if($get_affected_rows >= 0)
              {
                  echo "<script> alert('Updated Successfully'); </script>";
                  echo "<script>window.location.href='".base_url()."superadmin/manage_deliveryhub_admin';</script>";
              }
          }
          else
          {
               if($this->session->has_userdata('admin_id'))
              {
                $data['user_data'] = $this->select_model->select_user($this->backend_table,$this->admin_id);
                 $data['get_delhub'] = $this->select_model->get_deliveryhub_data();
                $data['delhub_admin_id'] = $this->select_model->select_user('deliveryhub_admin',$this->input->post("hid_id"));
                 $this->load->view('headers/superadmin_home_header',$data);
                   $this->load->view('deliveryhub/deliveryhub_admin',$data);
                   $this->load->view('headers/footer');
              }
              else
              {
                    $this->error_403();
              }
          }
    
    }

     public function delete_dlhub_admin()
      {
            $get_affected_rows = $this->delete_model->delete_dlhub_admin($this->uri->segment(3));
            
            if($get_affected_rows)
            {
               redirect(base_url()."superadmin/manage_deliveryhub_admin",'refresh');
            }
        }
    //04-4-19
    function delivery_password()
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
            $updated = $this->update_model->update_delivery($email,$newpwd);
             redirect(base_url()."deliveryhub/");
          }
        
        }
    }
//---------------------------End Delivery Admin---------------------

  
/**
     * AUTHOR : VEDAVITH RAVULA
     * DATE : 26042019
     */

  

    public function ajax_call_get_kitchen_assigned_products()
    {
      $output = $this->select_model->select_assigned_kitchen_products($this->input->post('kitchen_id'));
      echo json_encode($output->result());
    }

    public function ajax_call_delete_assigned_product()
    {
      $output =$this->delete_model->delete_kitchen_assigned_product($this->input->post('kitchen_id'),$this->input->post('product_sku'));
      return $output;
    }


   /**
    * ASSIGNING PRODUCTS TO KITCHEN
    * =============================
    *  AUTHOR : VEDAVITH RAVULA
    *  DATE : 25042019
    *
    */

    public function assign_kitchen_products()
    {
      $data['user_data'] = $this->select_model->select_user($this->backend_table,$this->admin_id);
      $this->load->view('headers/superadmin_home_header',$data);
      $data['get_kitchen'] = $this->select_model->select_kitchen_register();
      $data['get_all_products'] = $this->select_model->select_product_master();
      $this->load->view('products/kitchen_assign_products',$data);
      $this->load->view('headers/footer');
    }



    //ajax_call

    public function ajax_call_product_on_sku()
    {
       $output = $this->select_model->get_ajax_product_name($this->input->post('product_sku'));
       echo json_encode($output->result());

    }

    public function insert_assign_kitchen_products()
    {
      $kitchen_id = $this->input->post('kitchen_id');
      for($i = 0; $i < count($this->input->post('product_name[]')); $i++)
      {
         $assigned_product_array = array(
           "product_name" => $this->input->post('product_name[]')[$i],
            "product_sku" => $this->input->post('product_sku[]')[$i],
            "custom_products" => $this->input->post('sub_product_name[]')[$i],
           "estimated_units" => 0
         );

         $validator = $this->validate_model->assigned_kitchen_product_validator($kitchen_id, $this->input->post('product_sku[]')[$i]);
         if($validator)
         {
           echo "<script> alert('Warning : ".$this->input->post('product_sku[]')[$i]." Already Exists'); </script>";
         }
         else
         {
           $insert_assigned_product_array = $this->insert_model->insert_assigned_kitchen_products($kitchen_id,$assigned_product_array);
           if($insert_assigned_product_array)
           {
             echo "<script> alert('Added Products To Kitchen'); </script>";
           }
         }
      }
      redirect(base_url()."superadmin/assign_kitchen_products",'refresh');
    }

    public function manage_assign_kitchen_product()
    {
       $data['user_data'] = $this->select_model->select_user($this->backend_table,$this->admin_id);
      $this->load->view('headers/superadmin_home_header',$data);
      $data['get_kitchen_id'] = $this->select_model->select_kitchen_register();
      $this->load->view('products/manage_kitchen_assign_products',$data);
      $this->load->view('headers/footer');
    }


//=========================Notification =========================
  public function create_notification()
  {
     if($this->session->has_userdata('admin_id'))
          {
             $data['user_data'] = $this->select_model->select_user($this->backend_table,$this->admin_id);
              $data['notify_data'] = $this->select_model->get_notification();
               $this->load->view('headers/superadmin_home_header',$data);
               $this->load->view('products/notification',$data);
               $this->load->view('headers/footer');
          }
          else
          {
                $this->error_403();
          }
  } 
  public function notification_data()
  {
        $data = array(
          "message" => $this->input->post("message"),
          "time_stamp" => $this->input->post("date_insert")
          );
        $insert = $this->insert_model->notification($data);
        if($insert)
          {
            echo "<script> alert('Inserted Successfully'); </script>";
            echo "<script>window.location.href='".base_url()."superadmin/manage_notification';</script>";
          }

  }
  public function manage_notification()
  {
    if($this->session->has_userdata('admin_id'))
      {
        $data['user_data'] = $this->select_model->select_user($this->backend_table,$this->admin_id);
        $data['notify_data'] = $this->select_model->get_notification();

          $this->load->view('headers/superadmin_home_header',$data);
          $this->load->view('products/notification',$data);
          $this->load->view('headers/footer');
        }
      else
      {
          $this->error_403();
      }

  }
  //update meal perference data
     public function update_notification()
    {
       if($this->session->has_userdata('admin_id'))
        {
            $data['user_data'] = $this->select_model->select_user($this->backend_table,$this->admin_id);
            
        $data['notify_data'] = $this->select_model->get_notification();
        $data["get_value"] = $this->select_model->select_user("notifications",$this->uri->segment(3));
          
          $this->load->view('headers/superadmin_home_header',$data);
          $this->load->view('products/notification',$data);
          $this->load->view('headers/footer');
              

        /*
         *  Update button
         */

        if($this->input->post('note_update') == "note_update")
        {

            $this->form_validation->set_rules('update_message','update_message','required');
            
            if($this->form_validation->run())
            {
                 $get_update = array(
                    "id" => $this->input->post('update_id'),
                    "message" => $this->input->post('update_message'),
                    "time_stamp" => $this->input->post('update_date')
                );


                $get_update_count = $this->update_model->update_notification($get_update);
                if($get_update_count)
                {
                    echo "<script> alert('Updated'); </script>";
                    redirect(base_url()."superadmin/update_notification/".$this->uri->segment(3),'refresh');
                }

            }
            else
            {
                echo "<script> alert('ERROR(UVE) : Update Value Should Not Be Empty'); </script>";
                redirect(base_url()."superadmin/update_notification/".$this->uri->segment(3),'refresh');
            }
         
        }
       }
      else
      {
            $this->error_403();
      }
    }
    //1-03-19
    //delete Notification
     public function delete_notify()
      {
            $get_affected_rows = $this->delete_model->delete_note($this->uri->segment(3));
            
            if($get_affected_rows)
            {
               redirect(base_url()."superadmin/manage_notification",'refresh');
            }
        }


     public function show_count()
     {
      $get_array = $this->select_model->select_product_master(1);
      $array_primary_count = array();
      for($i = 0; $i < count($get_array);$i++)
      {
         $get_primary_count[$get_array[$i]] = 0;
      }

      for($j = 0; $j < count($get_array);$j++)
      {
        $get_count_prime = $this->select_model->get_count_primary($get_array[$j]);
        $get_count_optional = $this->select_model->get_count_optional($get_array[$j]);

        $array_primary_count[$get_array[$j]] = $get_count_prime + $get_count_optional;
      }

      echo "<pre>";
      print_r($array_primary_count);
      echo "</pre>";


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
