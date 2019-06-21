<?php
class Croncontroller extends CI_Controller
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
    $this->load->helper('file');
  }
 
//3-05-19
public function cjob()
{
 $from_date_checker = 0;
 $to_date_checker = 0;
 $from_date_checker_opt = 0;
 $to_date_checker_opt = 0;

 $dates_array = array();
 $check_date = date('Y-m-01');
 $check_date_obj = new DateTime($check_date);
 $check_date_obj->modify('+7 day');
 $check_week_date = $check_date_obj->format('Y-m-d');

 if($check_week_date == date('Y-m-d'))
 {
  $first_date = date('Y-m-d');
  $check_date = $first_date;
 }
 else
 {
  $first_date = date('Y-m-01');
}
 $incr_date = new DateTime($first_date);
 $act_date = new DateTime($first_date);


 $act_date->modify('+7 day');
 $week_date = $act_date->format('Y-m-d');

 $diff = strtotime($week_date) - strtotime($first_date);
 $day_count = floor($diff/3600/24);
 for($i = 0; $i <= $day_count; $i++)
 {
   if($i == 0)
   {
     $array_date =  $first_date;
     $dates_array[$array_date] = null;
   }
   else
   {
     $str_count = '+1 day';
     date_modify($incr_date,$str_count);
     $array_date = date_format($incr_date,'Y-m-d');
     $dates_array[$array_date] = null;
   }
 }

 $date_keys_as_values = array_keys($dates_array);


 // echo "<pre>";
 // print_r($date_keys_as_values);
 // echo "</pre>";


 $get_array = $this->select_model->select_product_master(1);

 for($x = 0; $x < count($date_keys_as_values); $x++)
 {
   for($y = 0; $y < count($get_array);$y++)
   {
   $dates_array[$date_keys_as_values[$x]][$get_array[$y]] = 0;
   }
 }

 // echo "<pre>";
 // print_r($dates_array);
 // echo "</pre>";

 for($z = 0; $z < count($get_array); $z++)
 {
 $result_object = $this->select_model->get_count_primary($get_array[$z]);
 //$result_optional = $this->select_model->get_count_optional($get_array[$z]);

      // echo "<pre>";
      //  print_r($result_object->result());
      //  echo "</pre>";
 if(!empty($result_object->result()))
 {
 
   foreach($result_object->result() as $result)
   {
      $get_from_date = $result->from_date;
      $get_to_date = $result->to_date;
      $get_quantity = (int)$result->quantity;

     for($a = 0; $a < count($date_keys_as_values); $a++)
     {
      
       if($date_keys_as_values[$a] == $get_from_date)
       {
          $from_date_checker =+ 1;
       }
       if($date_keys_as_values[$a] == $get_to_date)
       {
          $to_date_checker =+ 1;
       }
     }

     // echo $from_date_checker."<br>";
     // echo $to_date_checker."<br>";

       if( (($from_date_checker > 0) && ($to_date_checker > 0)) )
       { 
         $diff_check = strtotime($get_to_date) - strtotime($get_from_date);
         $day_count_check = floor($diff_check/3600/24);
         for($c=0; $c <= $day_count_check; $c++)
         {
               $from_d = new DateTime($get_from_date);
               if( $c != 0)
               {
                 $from_d->modify('+1 day');
               }

               $last_d = $from_d->format('Y-m-d');
               $init_quantity = $dates_array[$last_d][$get_array[$z]];
                $dates_array[$last_d][$get_array[$z]] = $init_quantity +  $get_quantity;
               $get_from_date = $last_d;
             
         }

       }
       elseif( (($from_date_checker > 0) && ($to_date_checker <= 0)) )
       {
          $get_last_date = end($date_keys_as_values);
          $diff_check = strtotime($get_to_date) - strtotime($get_last_date);
          $day_count_check = floor($diff_check/3600/24);
          for($c=0; $c <= $day_count_check; $c++)
          {
                $from_d = new DateTime($get_from_date);
                if( $c != 0)
               {
                 $from_d->modify('+1 day');
               }
                $last_d = $from_d->format('Y-m-d');
                $init_quantity = $dates_array[$last_d][$get_array[$z]];
                $dates_array[$last_d][$get_array[$z]] = $init_quantity + $get_quantity;
                $get_from_date = $last_d;
              
          }
       
       }
       elseif( (($from_date_checker <= 0)&&($to_date_checker <= 0)) )
       {
         $first_date_range = date_create((string)reset($date_keys_as_values));
        $last_date_range = date_create((string)end($date_keys_as_values));
        
         $given_from_date = $get_from_date;
         $given_from_date_obj = date_create((string)$given_from_date);

        $given_to_date = $get_to_date;
        $given_to_date_obj = date_create((string)$given_to_date);

       $diff_from = date_diff($given_from_date_obj,$first_date_range) ;
      $from_date_diff = $diff_from->format('%R%a');

        $diff_to = date_diff($given_to_date_obj,$last_date_range) ;
        $to_date_diff = $diff_to->format('%R%a');

       if($from_date_diff > 0 && $to_date_diff <= 0)
       {
         $start_date = reset($date_keys_as_values);
         $end_date = end($date_keys_as_values);

         $diff_check = strtotime($end_date) - strtotime($start_date);
         $day_count_check = floor($diff_check/3600/24);
         for($c=0; $c <= $day_count_check; $c++)
          {
                $from_obj = new DateTime($start_date);
                if( $c != 0)
               {
                 $from_obj->modify('+1 day');
               }
                $last_obj = $from_obj->format('Y-m-d');
                $init_quantity = $dates_array[$last_obj][$get_array[$z]];
                $dates_array[$last_obj][$get_array[$z]] =$init_quantity + $get_quantity;
                $dates_array[$last_obj][$get_array[$z]];
                $start_date = $last_obj;
              
          }
        }
       
       }
       
   }
 }

 }

 // echo "<pre>";
 //  print_r($dates_array);
 //  echo "</pre>";

for($z = 0; $z < count($get_array); $z++)
 {
 
 $result_optional = $this->select_model->get_count_optional($get_array[$z]);
  if(!empty($result_optional->result()))
 {
  foreach($result_optional->result() as $resultoptional)
   {
    $opt_from_date = $resultoptional->from_date;
    $opt_to_date = $resultoptional->to_date;
    $opt_quantity = $resultoptional->opt_quantity;

    for($a = 0; $a < count($date_keys_as_values); $a++)
     {
      
       if($date_keys_as_values[$a] == $opt_from_date)
       {
          $from_date_checker_opt =+ 1;
       }
       if($date_keys_as_values[$a] == $opt_to_date)
       {
          $to_date_checker_opt =+ 1;
       }
     }

     //  echo $from_date_checker_opt."<br>";
     // echo $to_date_checker_opt."<br>";
     if( (($from_date_checker_opt > 0) && ($to_date_checker_opt > 0)) )
       { 
         $diff_check_opt = strtotime($opt_to_date) - strtotime($opt_from_date);
         $day_count_check_opt = floor($diff_check_opt/3600/24);
         for($s=0; $s <= $day_count_check_opt; $s++)
         {
               $from_opt = new DateTime($opt_from_date);
               if( $s != 0)
               {
                 $from_opt->modify('+1 day');
               }

               $last_opt = $from_opt->format('Y-m-d');
              $quant_count = $dates_array[$last_opt][$get_array[$z]];
               $dates_array[$last_opt][$get_array[$z]] = $quant_count + $opt_quantity;
                $dates_array[$last_opt][$get_array[$z]];
               $opt_from_date = $last_opt;

             
         }

       }

    elseif( (($from_date_checker_opt > 0) && ($to_date_checker_opt <= 0)) )
       {
          $get_last_date_opt = end($date_keys_as_values);
          $diff_check_opt = strtotime($opt_to_date) - strtotime($get_last_date_opt);
          $day_count_check_opt = floor($diff_check_opt/3600/24);
          for($t=0; $t <= $day_count_check_opt; $t++)
          {
                $from_opt = new DateTime($opt_from_date);
                if( $t != 0)
               {
                 $from_opt->modify('+1 day');
               }
                $last_opt = $from_opt->format('Y-m-d');
                $quant_count = $dates_array[$last_opt][$get_array[$z]];
                $dates_array[$last_opt][$get_array[$z]] = $quant_count + $opt_quantity;
                $opt_from_date = $last_opt;
              
          }
       
       }

       elseif( (($from_date_checker_opt <= 0)&&($to_date_checker_opt <= 0)) )
       {
         $first_date_range = date_create((string)reset($date_keys_as_values));
        $last_date_range = date_create((string)end($date_keys_as_values));
        
         $given_from_date = $opt_from_date;
         $given_from_date_obj = date_create((string)$given_from_date);

        $given_to_date = $opt_to_date;
        $given_to_date_obj = date_create((string)$given_to_date);

       $diff_from = date_diff($given_from_date_obj,$first_date_range) ;
      $from_date_diff = $diff_from->format('%R%a');

        $diff_to = date_diff($given_to_date_obj,$last_date_range) ;
        $to_date_diff = $diff_to->format('%R%a');

       if($from_date_diff > 0 && $to_date_diff <= 0)
       {
         $start_date = reset($date_keys_as_values);
         $end_date = end($date_keys_as_values);

         $diff_check = strtotime($end_date) - strtotime($start_date);
         $day_count_check = floor($diff_check/3600/24);
         for($c=0; $c <= $day_count_check; $c++)
          {
                $from_obj = new DateTime($start_date);
                if( $c != 0)
               {
                 $from_obj->modify('+1 day');
               }
                $last_obj = $from_obj->format('Y-m-d');
                $quant_count = $dates_array[$last_obj][$get_array[$z]];
                $dates_array[$last_obj][$get_array[$z]] =$quant_count + $get_quantity;
               
                $start_date = $last_obj;
              
          }
        }
       
       }


   }

 }
}
  // echo "<pre>";
  // print_r($dates_array);
  // echo "</pre>";

 $data =  json_encode($dates_array);
 if(write_file('./json/product_quantity.json', $data))
 {
   return true;
 }
}

public function getJsonSetter()
{
  if($this->cjob())
  {
   $json = file_get_contents(base_url()."json/product_quantity.json");
   $data_array = json_decode($json,TRUE);
  
   //@todo:
   //before drop download the table to json.

   $set_array = array();

   $drop_existing_data_product = $this->delete_model->drop_date_products();
   if($drop_existing_data_product)
   {
     $get_array = $this->select_model->select_product_master(1);
     $create_tester = $this->create_model->createTableProductList($get_array);
     if($create_tester)
     {
       $count = 0;
       foreach($data_array as $key =>$value)
       {
         $set_array[$count] = $value;
         $set_array[$count]['date'] = $key;
         $count++;
       }
       $counter = 0;
       for($x = 0; $x < count($set_array); $x++)
       {
         $insert_data = $this->insert_model->insert_date_products($set_array[$x]);
         if($insert_data)
         {
           $counter=+1;
         }
       }
       if($counter)
       {
         return true;
       }
     }
   }
  }
}  
}
/**
* End of Croncontroler.php file
*/





