<?php

/*
____  ____  ____  _
/   _\/  __\/  _ \/ \  /|
|  /  |  \/|| / \|| |\ ||
|  \_ |    /| \_/|| | \||
\____/\_/\_\\____/\_/  \|

____  ____  _      _____  ____  ____  _     _     _____ ____
/   _\/  _ \/ \  /|/__ __\/  __\/  _ \/ \   / \   /  __//  __\
|  /  | / \|| |\ ||  / \  |  \/|| / \|| |   | |   |  \  |  \/|
|  \_ | \_/|| | \||  | |  |    /| \_/|| |_/\| |_/\|  /_ |    /
\____/\____/\_/  \|  \_/  \_/\_\\____/\____/\____/\____\\_/\_\

*/


/**
  *  Author : Vedavith Ravula, Divya A, et.Al.
  *  Created : 03052019
  *  =========================================
  *  Refactor 1 : 21052019
  *  -----------------------------------------
  *  Refactor 2 : 23012019
  *  -----------------------------------------
  *  Refactor 3 : 31052019
  *  -----------------------------------------
  *  ! Old conditions are deprecated on 21052019
  *  * Adding New Validations on the date array.
  */

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


  //? Loading Trait DateCal.
 
 // use DateCal;

private function cjob()
{

$from_date_checker = 0;
$to_date_checker = 0;
$from_date_checker_opt = 0;
$to_date_checker_opt = 0;

$dates_array = array();

$first_date = null;

$first_date = date('Y-m-d');

$incr_date = new DateTime($first_date);
$act_date = new DateTime($first_date);
$act_date->modify('+30 day');
$count =  $incr_date->diff($act_date);
$day_count = $count->format('%R%a');
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


//  echo "<pre>";
//  print_r($date_keys_as_values);
//  echo "</pre>";


$get_array = $this->select_model->select_product_master(1);

for($x = 0; $x < count($date_keys_as_values); $x++)
{
  for($y = 0; $y < count($get_array);$y++)
  {
  $dates_array[$date_keys_as_values[$x]][$get_array[$y]] = 0;
  }
}

//  echo "<pre>";
//  print_r($dates_array);
//  echo "</pre>";

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

      
    
    
       if ((!(in_array($get_from_date,$date_keys_as_values)) && !(in_array($get_to_date,$date_keys_as_values))))
       {
         $from_date_checker = 2;
         $to_date_checker = 2;
       }
       elseif ((in_array($get_from_date,$date_keys_as_values)) && !(in_array($get_to_date,$date_keys_as_values)))
       {
         $from_date_checker = 3;
         $to_date_checker = 3;
       }
       elseif (!(in_array($get_from_date,$date_keys_as_values)) && (in_array($get_to_date,$date_keys_as_values)))
       {
         $from_date_checker = 4;
         $to_date_checker = 4;
       }
       elseif (((in_array($get_from_date,$date_keys_as_values)) && (in_array($get_to_date,$date_keys_as_values))))
       {
         $from_date_checker = 1;
         $to_date_checker = 1;
       }

       //*Checking the count $from_date_checker and $to_date_checker
       //? SETTING A BOOL VALUE TO VALIDATE THE CONDITIONS

       $bool = null;
       $condition = null;
       $flag = null;
       $date_arr = null;
       $from_d = null;

       if ((($from_date_checker == 2) && ($to_date_checker == 2 )))
       {
         //*CONDITION 1
         //!DATES DOES NOT BELONG TO THE ARRAY RANGE
         //TODO: IGNORE THE CONDITION AND RETURN FALSE

        // echo "Condition 1 => fdc->2 and tdc->2<br>";
         $condition = 1;
         if ((date('m',strtotime($get_from_date)) < date('m',strtotime(reset($date_keys_as_values))) && (date('m',strtotime($get_to_date)) < date('m',strtotime(end($date_keys_as_values))) )))
         {
           $bool = false;
         }
         elseif ((date('m',strtotime($get_from_date)) == date('m',strtotime(reset($date_keys_as_values))) && ( ( strtotime(reset($date_keys_as_values)) > strtotime($get_from_date)) && (strtotime(end($date_keys_as_values)) < strtotime($get_to_date)) ) ))
         {
          
           //? IF (FROM DATE MONTH == MONTH OF START DATE) && (ARRAY FROM DATE < GIVEN FROM DATE) && (ARRAY TO DATE < GIVEN TO DATE)
          
           //echo "Condition 1-1 => fdc->2 and tdc->2<br>";
           $bool = true;
           $flag = 1;
           $diff_check = strtotime(end($date_keys_as_values)) - strtotime(reset($date_keys_as_values));
           $day_count_check = floor($diff_check/3600/24);

         }
         elseif ((date('m',strtotime($get_from_date)) == date('m',strtotime(reset($date_keys_as_values)))) && ( (strtotime($get_from_date) == strtotime(reset($date_keys_as_values)) && (strtotime($get_to_date) > strtotime(end($date_keys_as_values)) ) ) )  )
         {
         
           //? IF (FROM DATE MONTH == MONTH OF ARRAY START DATE) && (GIVEN FROM DATE == ARRAY FROM DATE) && (GIVEN TO DATE > ARRAY TO DATE)

           //echo "Condition 1-2 => fdc->2 and tdc->2<br>";
           $bool = true;
           $flag = 2;
           $diff_check = strtotime(end($date_keys_as_values)) - strtotime(reset($date_keys_as_values));
           $day_count_check = floor($diff_check/3600/24);
         }
         elseif (((date('m',strtotime($get_from_date) < date('m',strtotime(reset($date_keys_as_values))))) && (date('m',strtotime($get_to_date) == date('m',strtotime(end($date_keys_as_values)))))) && ((in_array($get_to_date,$date_keys_as_values)) ))
         {
          
           //? IF (FROM DATE MONTH < MONTH OF START DATE) && (TO DATE MONTH == MONTH OF START DATE) && (TO DATE IS IN ARRAY)

           //echo "Condition 1-3 => fdc->2 and tdc->2<br>";
           $bool = true;
           $flag = 3;
           $diff_check = strtotime($get_to_date) - strtotime($get_from_date);
           $day_count_check = floor($diff_check/3600/24);
         }
         elseif (((date('m',strtotime($get_to_date) > date('m',strtotime(end($date_keys_as_values))))) && (date('m',strtotime($get_from_date) == date('m',strtotime(reset($date_keys_as_values)))))) && ((in_array($get_from_date,$date_keys_as_values)) ))
         {
          
           //? IF (TO DATE MONTH > MONTH OF END DATE) && (FROM DATE MONTH == MONTH OF FROM DATE) && (FROM DATE IS IN ARRAY)

           //echo "Condition 1-4 => fdc->2 and tdc->2<br>";
           $bool = true;
           $flag = 4;
           $diff_check = strtotime(end($date_keys_as_values)) - strtotime($get_from_date);
           $day_count_check = floor($diff_check/3600/24);
         }

       }
       elseif((($from_date_checker == 3) && ($to_date_checker == 3 )))
       {

         //*CONDITION 2
         //!FROM DATE IS IN ARRAY -- TO DATE IS NOT IN ARRAY
         //TODO: SET THE STARTING DATE TO THE FROM DATE AND GET THE DATE DIFFERENCE

         //echo "Condition 2 => fdc->3 and tdc->3<br>";
         $bool = true;
         $condition = 2;
         $diff_check = strtotime(end($date_keys_as_values)) - strtotime($get_from_date);
         $day_count_check = floor($diff_check/3600/24);
       }
       elseif((($from_date_checker == 4) && ($to_date_checker == 4 )))
       {

         //*CONDITION 3
         //!FROM DATE IS NOT IN ARRAY -- TO DATE IS IN ARRAY
         //TODO: SET THE END DATE TO THE TO DATE AND GET THE DATE DIFFERENCE

         //echo "Condition 3 => fdc->4 and tdc->4<br>";
         $bool = true;
         $condition = 3;
         $diff_check = strtotime($get_to_date) - strtotime(reset($date_keys_as_values));
         $day_count_check = floor($diff_check/3600/24);
       }
       elseif((($from_date_checker == 1) && ($to_date_checker == 1 )))
       {                                                                    
       
         //*CONDITION 4
         //!DATES BELONG TO THE ARRAY RANGE
         //TODO: IF (CHECK WHETHER THE TO AND FROM DATE ARE THE START AND END DATES OF ARRAY) :
         //TODO:    SET START DATE AND END DATE TO THE ARRAY START DATE AND END DATES. TAKE THE DATE DIFFERENCE. 
         //TODO: ELSE :
         //TODO:   IF : FROM DATE > ARRAY START DATE && TO DATE < ARRAY LAST DATE
         //TODO:      GET DATE DIFFRENCE BETWEEN TO DATE AND FROM DATE
         //TODO:   ELSEIF : FROM DATE == START DATE &&  TO DATE < ARRAY LAST DATE
         //TODO:      GET DATE DIFFRENCE BETWEEN TO DATE AND START DATE OF ARRAY
         //TODO:   ELSEIF : FROM DATE > START DATE &&  TO DATE == ARRAY LAST DATE
         //TODO:      GET DATE DIFFRENCE BETWEEN ARRAY END DATE AND FROM DATE

         // echo "Condition 4 => fdc->1 and tdc->1<br>";
         $bool = true;
         $condition = 4;
         if(( strtotime( $get_from_date ) == strtotime( reset($date_keys_as_values) )) && ( strtotime( $get_to_date ) == strtotime( end($date_keys_as_values)) ) )
         {
           $flag = 1;
           $diff_check = strtotime(end($date_keys_as_values)) - strtotime(reset($date_keys_as_values));
           $day_count_check = floor($diff_check/3600/24);
         }
         else
         {
           $from_date_copy = $get_from_date;
           $to_date_copy = $get_to_date;

           if ((strtotime($from_date_copy) > strtotime(reset($date_keys_as_values))) && (strtotime($to_date_copy) < strtotime(end($date_keys_as_values))) )
           {
             $flag = 2;
             $diff_check = strtotime($to_date_copy) - strtotime($from_date_copy);
             $day_count_check = floor($diff_check/3600/24);
           }
           elseif ((strtotime($from_date_copy) == strtotime(reset($date_keys_as_values))) && (strtotime($to_date_copy) < strtotime(end($date_keys_as_values))) )
           {
             $flag = 3;
             $diff_check = strtotime($to_date_copy) - strtotime(reset($date_keys_as_values));
             $day_count_check = floor($diff_check/3600/24);
           }
           elseif ((strtotime($from_date_copy) > strtotime(reset($date_keys_as_values))) && (strtotime($to_date_copy) == strtotime(end($date_keys_as_values))) )
           {
             $flag = 4;
             $diff_check = strtotime(end($date_keys_as_values)) - strtotime($from_date_copy);
             $day_count_check = floor($diff_check/3600/24);
           }
         }
       }


       //? IF $bool IS TRUE. THEN THE DATES ARE IN ARRAY
       if ($bool)
       {
           if ($condition == 1)
           {
             if ($flag == 1)
             {
               $from_d = new DateTime(reset($date_keys_as_values));
             }
             elseif ($flag == 2)
             {
               $from_d = new DateTime(reset($date_keys_as_values));
             }
             elseif ($flag == 3)
             {
               $from_d = new DateTime($get_from_date);
             }
             elseif ($flag == 4)
             {
               $from_d = new DateTime($get_from_date);
             }
           }
           elseif ($condition == 2)
           {
             $from_d = new DateTime($get_from_date);
           }
           elseif ($condition == 3)
           {
             $from_d = new DateTime(reset($date_keys_as_values));
           }
           elseif ($condition == 4)
           {
             if ($flag == 1)
             {
               $from_d = new DateTime(reset($date_keys_as_values));
             }
             elseif ($flag == 2)
             {
               $from_d = new DateTime($get_from_date);
             }
             elseif ($flag == 3)
             {
               $from_d = new DateTime(reset($date_keys_as_values));
             }
             elseif ($flag == 4)
             {
               $from_d = new DateTime($get_from_date);
             }

           }

           for ($i = 0; $i <= $day_count_check; $i++)
           {
             if ($i != 0)
             {
               $from_d->modify('+1 day');
             }
               $last_d = $from_d->format('Y-m-d');
               $init_quantity = $dates_array[$last_d][$get_array[$z]];
               $dates_array[$last_d][$get_array[$z]] = $init_quantity +  $get_quantity;
               $get_from_date = $last_d;
               $date_arr = $last_d;
           }
         }
     }
   }
 }


 /**
  *  AUTHOR : DIVYA A
  *  DATE : 22052019
  */

 for($z = 0; $z < count($get_array); $z++)
{
 $result_object = $this->select_model->get_count_optional($get_array[$z]);
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

      
    
    
       if ((!(in_array($get_from_date,$date_keys_as_values)) && !(in_array($get_to_date,$date_keys_as_values))))
       {
         $from_date_checker = 2;
         $to_date_checker = 2;
       }
       elseif ((in_array($get_from_date,$date_keys_as_values)) && !(in_array($get_to_date,$date_keys_as_values)))
       {
         $from_date_checker = 3;
         $to_date_checker = 3;
       }
       elseif (!(in_array($get_from_date,$date_keys_as_values)) && (in_array($get_to_date,$date_keys_as_values)))
       {
         $from_date_checker = 4;
         $to_date_checker = 4;
       }
       elseif (((in_array($get_from_date,$date_keys_as_values)) && (in_array($get_to_date,$date_keys_as_values))))
       {
         $from_date_checker = 1;
         $to_date_checker = 1;
       }

       //*Checking the count $from_date_checker and $to_date_checker
       //? SETTING A BOOL VALUE TO VALIDATE THE CONDITIONS

       $bool = null;
       $condition = null;
       $flag = null;
       $date_arr = null;
       $from_d = null;

       if ((($from_date_checker == 2) && ($to_date_checker == 2 )))
       {
         //*CONDITION 1
         //!DATES DOES NOT BELONG TO THE ARRAY RANGE
         //TODO: IGNORE THE CONDITION AND RETURN FALSE

        // echo "Condition 1 => fdc->2 and tdc->2<br>";
         $condition = 1;
         if ((date('m',strtotime($get_from_date)) < date('m',strtotime(reset($date_keys_as_values))) && (date('m',strtotime($get_to_date)) < date('m',strtotime(end($date_keys_as_values))) )))
         {
           $bool = false;
         }
         elseif ((date('m',strtotime($get_from_date)) == date('m',strtotime(reset($date_keys_as_values))) && ( ( strtotime(reset($date_keys_as_values)) > strtotime($get_from_date)) && (strtotime(end($date_keys_as_values)) < strtotime($get_to_date)) ) ))
         {
          
           //? IF (FROM DATE MONTH == MONTH OF START DATE) && (ARRAY FROM DATE < GIVEN FROM DATE) && (ARRAY TO DATE < GIVEN TO DATE)
          
           //echo "Condition 1-1 => fdc->2 and tdc->2<br>";
           $bool = true;
           $flag = 1;
           $diff_check = strtotime(end($date_keys_as_values)) - strtotime(reset($date_keys_as_values));
           $day_count_check = floor($diff_check/3600/24);

         }
         elseif ((date('m',strtotime($get_from_date)) == date('m',strtotime(reset($date_keys_as_values)))) && ( (strtotime($get_from_date) == strtotime(reset($date_keys_as_values)) && (strtotime($get_to_date) > strtotime(end($date_keys_as_values)) ) ) )  )
         {
         
           //? IF (FROM DATE MONTH == MONTH OF ARRAY START DATE) && (GIVEN FROM DATE == ARRAY FROM DATE) && (GIVEN TO DATE > ARRAY TO DATE)

           //echo "Condition 1-2 => fdc->2 and tdc->2<br>";
           $bool = true;
           $flag = 2;
           $diff_check = strtotime(end($date_keys_as_values)) - strtotime(reset($date_keys_as_values));
           $day_count_check = floor($diff_check/3600/24);
         }
         elseif (((date('m',strtotime($get_from_date) < date('m',strtotime(reset($date_keys_as_values))))) && (date('m',strtotime($get_to_date) == date('m',strtotime(end($date_keys_as_values)))))) && ((in_array($get_to_date,$date_keys_as_values)) ))
         {
          
           //? IF (FROM DATE MONTH < MONTH OF START DATE) && (TO DATE MONTH == MONTH OF START DATE) && (TO DATE IS IN ARRAY)

           //echo "Condition 1-3 => fdc->2 and tdc->2<br>";
           $bool = true;
           $flag = 3;
           $diff_check = strtotime($get_to_date) - strtotime($get_from_date);
           $day_count_check = floor($diff_check/3600/24);
         }
         elseif (((date('m',strtotime($get_to_date) > date('m',strtotime(end($date_keys_as_values))))) && (date('m',strtotime($get_from_date) == date('m',strtotime(reset($date_keys_as_values)))))) && ((in_array($get_from_date,$date_keys_as_values)) ))
         {
          
           //? IF (TO DATE MONTH > MONTH OF END DATE) && (FROM DATE MONTH == MONTH OF FROM DATE) && (FROM DATE IS IN ARRAY)

           //echo "Condition 1-4 => fdc->2 and tdc->2<br>";
           $bool = true;
           $flag = 4;
           $diff_check = strtotime(end($date_keys_as_values)) - strtotime($get_from_date);
           $day_count_check = floor($diff_check/3600/24);
         }

       }
       elseif((($from_date_checker == 3) && ($to_date_checker == 3 )))
       {

         //*CONDITION 2
         //!FROM DATE IS IN ARRAY -- TO DATE IS NOT IN ARRAY
         //TODO: SET THE STARTING DATE TO THE FROM DATE AND GET THE DATE DIFFERENCE

         //echo "Condition 2 => fdc->3 and tdc->3<br>";
         $bool = true;
         $condition = 2;
         $diff_check = strtotime(end($date_keys_as_values)) - strtotime($get_from_date);
         $day_count_check = floor($diff_check/3600/24);
       }
       elseif((($from_date_checker == 4) && ($to_date_checker == 4 )))
       {

         //*CONDITION 3
         //!FROM DATE IS NOT IN ARRAY -- TO DATE IS IN ARRAY
         //TODO: SET THE END DATE TO THE TO DATE AND GET THE DATE DIFFERENCE

         //echo "Condition 3 => fdc->4 and tdc->4<br>";
         $bool = true;
         $condition = 3;
         $diff_check = strtotime($get_to_date) - strtotime(reset($date_keys_as_values));
         echo $day_count_check = floor($diff_check/3600/24);
       }
       elseif((($from_date_checker == 1) && ($to_date_checker == 1 )))
       {                                                                    
       
         //*CONDITION 4
         //!DATES BELONG TO THE ARRAY RANGE
         //TODO: IF (CHECK WHETHER THE TO AND FROM DATE ARE THE START AND END DATES OF ARRAY) :
         //TODO:    SET START DATE AND END DATE TO THE ARRAY START DATE AND END DATES. TAKE THE DATE DIFFERENCE. 
         //TODO: ELSE :
         //TODO:   IF : FROM DATE > ARRAY START DATE && TO DATE < ARRAY LAST DATE
         //TODO:      GET DATE DIFFRENCE BETWEEN TO DATE AND FROM DATE
         //TODO:   ELSEIF : FROM DATE == START DATE &&  TO DATE < ARRAY LAST DATE
         //TODO:      GET DATE DIFFRENCE BETWEEN TO DATE AND START DATE OF ARRAY
         //TODO:   ELSEIF : FROM DATE > START DATE &&  TO DATE == ARRAY LAST DATE
         //TODO:      GET DATE DIFFRENCE BETWEEN ARRAY END DATE AND FROM DATE

         // echo "Condition 4 => fdc->1 and tdc->1<br>";
         $bool = true;
         $condition = 4;
         if(( strtotime( $get_from_date ) == strtotime( reset($date_keys_as_values) )) && ( strtotime( $get_to_date ) == strtotime( end($date_keys_as_values)) ) )
         {
           $flag = 1;
           $diff_check = strtotime(end($date_keys_as_values)) - strtotime(reset($date_keys_as_values));
           $day_count_check = floor($diff_check/3600/24);
         }
         else
         {
           $from_date_copy = $get_from_date;
           $to_date_copy = $get_to_date;

           if ((strtotime($from_date_copy) > strtotime(reset($date_keys_as_values))) && (strtotime($to_date_copy) < strtotime(end($date_keys_as_values))) )
           {
             $flag = 2;
             $diff_check = strtotime($to_date_copy) - strtotime($from_date_copy);
             $day_count_check = floor($diff_check/3600/24);
           }
           elseif ((strtotime($from_date_copy) == strtotime(reset($date_keys_as_values))) && (strtotime($to_date_copy) < strtotime(end($date_keys_as_values))) )
           {
             $flag = 3;
             $diff_check = strtotime($to_date_copy) - strtotime(reset($date_keys_as_values));
             $day_count_check = floor($diff_check/3600/24);
           }
           elseif ((strtotime($from_date_copy) > strtotime(reset($date_keys_as_values))) && (strtotime($to_date_copy) == strtotime(end($date_keys_as_values))) )
           {
             $flag = 4;
             $diff_check = strtotime(end($date_keys_as_values)) - strtotime($from_date_copy);
             $day_count_check = floor($diff_check/3600/24);
           }
         }
       }


       //? IF $bool IS TRUE. THEN THE DATES ARE IN ARRAY
       if ($bool)
       {
           if ($condition == 1)
           {
             if ($flag == 1)
             {
               $from_d = new DateTime(reset($date_keys_as_values));
             }
             elseif ($flag == 2)
             {
               $from_d = new DateTime(reset($date_keys_as_values));
             }
             elseif ($flag == 3)
             {
               $from_d = new DateTime($get_from_date);
             }
             elseif ($flag == 4)
             {
               $from_d = new DateTime($get_from_date);
             }
           }
           elseif ($condition == 2)
           {
             $from_d = new DateTime($get_from_date);
           }
           elseif ($condition == 3)
           {
             $from_d = new DateTime(reset($date_keys_as_values));
           }
           elseif ($condition == 4)
           {
             if ($flag == 1)
             {
               $from_d = new DateTime(reset($date_keys_as_values));
             }
             elseif ($flag == 2)
             {
               $from_d = new DateTime($get_from_date);
             }
             elseif ($flag == 3)
             {
               $from_d = new DateTime(reset($date_keys_as_values));
             }
             elseif ($flag == 4)
             {
               $from_d = new DateTime($get_from_date);
             }

           }

           for ($i = 0; $i <= $day_count_check; $i++)
           {
             if ($i != 0)
             {
               $from_d->modify('+1 day');
             }
               $last_d = $from_d->format('Y-m-d');
               $init_quantity = $dates_array[$last_d][$get_array[$z]];
               $dates_array[$last_d][$get_array[$z]] = $init_quantity +  $get_quantity;
               $get_from_date = $last_d;
               $date_arr = $last_d;
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

//19-06-19

public function tester()
 {
  $inc =0;
  $create_tester = null;
  $get_array = $this->select_model->select_product_master(1);
  if(!$this->delete_model->drop_assigned_date_products())
  {
    $create_tester = $this->create_model->createTableOldProductList($get_array);
  }
  
  $json_data = $this->select_model->json_tester();
  $json_array = json_decode(json_encode($json_data->result()),true);
//print_r($json_array);
  
  //print_r($get_array);
    if($create_tester)
    {
    array_unshift($get_array,"id");
    //print_r($get_array);

      for($x=0; $x < count($json_array); $x++)
      {
        //   echo "<pre>";
        //   print_r($json_array[$x]);
        //   echo "</pre>";
          $insert_old = $this->insert_model->insert_old_data($json_array[$x]);
          if($insert_old)
          {
            $inc++;
          }
      }
    }
    if($inc)
    {
      return true;
    }

  }
  
public function getJsonSetter()
{
 if($this->tester() && $this->cjob())
   {
     $json = file_get_contents(base_url()."json/product_quantity.json");
     $data_array = json_decode($json,TRUE);
    
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
 //19-06-19
 //Run this function after running getJsonSetter
  public function updater()
  {
    // if($this->tester())
    // {
      $get_array = $this->select_model->select_product_master(1);
      $imploder = array();
      array_pop($get_array);
      for($r = 0; $r < count($get_array); $r++)
      {
                  //a = a - (a-b);

         $imploder[$r] = "dp.".$get_array[$r]." = CAST(dp.".$get_array[$r]." AS SIGNED) - (CAST(old.".$get_array[$r]." AS SIGNED) - CAST(adp.".$get_array[$r]." AS SIGNED))";
      }
      $imploder_string = implode(",",$imploder);
      $updater = $this->update_model->update_date_products_assigned($imploder_string);
      // if($updater >= 0)
      // {
      //   $this->delete_model->drop_assigned_date_products();
      // }
    // }
  }

 public function getJsonSetterOld()
  {
  if($this->cjob())
  {
     $json = file_get_contents(base_url()."json/product_quantity.json");
     $data_array = json_decode($json,TRUE);
    
     $set_array = array();

     $drop_existing_data_product = $this->delete_model->drop_date_products_old();
     if($drop_existing_data_product)
     {
       $get_array = $this->select_model->select_product_master(1);
       $create_tester = $this->create_model->createTableProductListJsonOld($get_array);
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
             $insert_data = $this->insert_model->insert_date_products_old($set_array[$x]);
             if($insert_data)
             {
               $counter=+1;
             }
           }
           // if($this->delete_model->drop_assigned_date_products())
           // {
             if($counter)
             {     
               return true;
             }
           // }
         }

     }
   }
 } 
}

/**
* End of Croncontroler.php file
*/








