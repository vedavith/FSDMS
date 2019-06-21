<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

require_once(APPPATH . 'libraries/PayPal-PHP-SDK/paypal/rest-api-sdk-php/sample/bootstrap.php'); // require paypal files


use PayPal\Api\ItemList;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Amount;
use PayPal\Api\PaymentExecution;
use PayPal\Api\RefundRequest;
use PayPal\Api\Sale;

class Paypal extends CI_Controller
{
    public $_api_context;

    function  __construct()
    {
        parent::__construct();

        $this->load->model('insert_model');
    	$this->load->model('update_model');
    	$this->load->model('delete_model');
    	$this->load->model('select_model');
    	$this->load->model('validate_model');
        $this->load->model('paypal_model','paypal');

        /**
         *  SESSION DATA
         */
        $this->user_id = $this->session->userdata('id');
		$this->backend_table = $this->session->userdata('table');
		$this->user_type = $this->session->userdata('type');

        // paypal credentials
        $this->config->load('paypal');

        $this->_api_context = new \PayPal\Rest\ApiContext(
            new \PayPal\Auth\OAuthTokenCredential(
                $this->config->item('client_id'), $this->config->item('secret')
            )
        );
    }

    function index()
    {
        $this->load->view('cart/checkout');
    }


    function create_payment_with_paypal()
    {

        $get_branch_address = "~No Branch";

        $get_product_array = implode(",",$this->input->post('product_array[]'));
        $get_product_sku_array = implode(",",$this->input->post('product_sku_array[]'));
        $get_order_id = implode(",",$this->input->post('order_id[]'));
        $get_unique_order_id = implode(",",$this->input->post('unique_order_id[]'));
        $get_row_id_array = implode(",",$this->input->post('row_id_array[]'));
        $get_address_array = implode("~",$this->input->post('address_array[]'));

        if($this->session->userdata('type') != 'individual')
        {
            $get_branch_address = implode("~",$this->input->post('branch_address_array[]'));
        }

        $get_dates = implode("~",$this->input->post('daterange[]'));

        $set_data_sessions = array(
            "product_array" => $get_product_array,
            "product_order_id" => $get_order_id,
            "product_unique_order_id" => $get_unique_order_id,
            "product_sku_array" => $get_product_sku_array,
            "product_rowid_array" => $get_row_id_array,
            "set_dates" => $get_dates,
            "main_address" => $get_address_array,
            "branch_address" => $get_branch_address
        );
        
        $this->session->set_userdata($set_data_sessions);



        // setup PayPal api context
        $this->_api_context->setConfig($this->config->item('settings'));

        
// ### Payer
// A resource representing a Payer that funds a payment
// For direct credit card payments, set payment method
// to 'credit_card' and add an array of funding instruments.

        $payer['payment_method'] = 'paypal';

// ### Itemized information
// (Optional) Lets you specify item wise
// information
        $item1["name"] = (string)implode(",",$this->input->post('product_array[]'));
        $item1["sku"] = implode(",",$this->input->post('product_sku_array[]'));  // Similar to `item_number` in Classic API
        $item1["description"] = (string)implode(",",$this->input->post('row_id_array[]'));
        $item1["currency"] ="USD";
        $item1["quantity"] =1;
        $item1["price"] = (integer)$this->input->post('details_subtotal');

        $itemList = new ItemList();
        $itemList->setItems(array($item1));

// ### Additional payment details
// Use this optional field to set additional
// payment information such as tax, shipping
// charges etc.
        $details['tax'] = 0;
        $details['subtotal'] = (integer)$this->input->post('details_subtotal');
// ### Amount
// Lets you specify a payment amount.
// You can also specify additional details
// such as shipping, tax.
        $amount['currency'] = "USD";
        $amount['total'] = $details['tax'] + $details['subtotal'];
        $amount['details'] = $details;
// ### Transaction
// A transaction defines the contract of a
// payment - what is the payment for and who
// is fulfilling it.
        $transaction['description'] ='Payment description';
        $transaction['amount'] = $amount;
        $transaction['invoice_number'] = uniqid();
        $transaction['item_list'] = $itemList;

        // ### Redirect urls
// Set the urls that the buyer must be redirected to after
// payment approval/ cancellation.
        $baseUrl = base_url();
        $redirectUrls = new RedirectUrls();
        $redirectUrls->setReturnUrl($baseUrl."paypal/getPaymentStatus")
            ->setCancelUrl($baseUrl."paypal/getPaymentStatus");

// ### Payment
// A Payment Resource; create one using
// the above types and intent set to sale 'sale'
        $payment = new Payment();
        $payment->setIntent("sale")
            ->setPayer($payer)
            ->setRedirectUrls($redirectUrls)
            ->setTransactions(array($transaction));

        try {
            $payment->create($this->_api_context);
        } catch (Exception $ex) {
            // NOTE: PLEASE DO NOT USE RESULTPRINTER CLASS IN YOUR ORIGINAL CODE. FOR SAMPLE ONLY
            ResultPrinter::printError("Created Payment Using PayPal. Please visit the URL to Approve.", "Payment", null, $ex);
            exit(1);
        }
        foreach($payment->getLinks() as $link) {
            if($link->getRel() == 'approval_url') {
                $redirect_url = $link->getHref();
                break;
            }
        }

        if(isset($redirect_url)) {
            /** redirect to paypal **/
            redirect($redirect_url);
        }

        $this->session->set_flashdata('success_msg','Unknown error occurred');
        redirect('paypal/index');

    }


    public function getPaymentStatus()
    {

        // paypal credentials

        /** Get the payment ID before session clear **/
        $payment_id = $this->input->get("paymentId") ;
        $PayerID = $this->input->get("PayerID") ;
        $token = $this->input->get("token") ;
        /** clear the session payment ID **/

        if (empty($PayerID) || empty($token)) {
            $this->session->set_flashdata('success_msg','Payment failed');
            redirect('paypal/index');
        }

        $payment = Payment::get($payment_id,$this->_api_context);


        /** PaymentExecution object includes information necessary **/
        /** to execute a PayPal account payment. **/
        /** The payer_id is added to the request query parameters **/
        /** when the user is redirected from paypal back to your site **/
        $execution = new PaymentExecution();
        $execution->setPayerId($this->input->get('PayerID'));

        /**Execute the payment **/
        $result = $payment->execute($execution,$this->_api_context);



        //  DEBUG RESULT, remove it later **/
        if ($result->getState() == 'approved') {
            $trans = $result->getTransactions();

            // item info
            $Subtotal = $trans[0]->getAmount()->getDetails()->getSubtotal();
            $Tax = $trans[0]->getAmount()->getDetails()->getTax();

            $payer = $result->getPayer();
            // payer info //
            $PaymentMethod =$payer->getPaymentMethod();
            $PayerStatus =$payer->getStatus();
            $PayerMail =$payer->getPayerInfo()->getEmail();

            $relatedResources = $trans[0]->getRelatedResources();
            $sale = $relatedResources[0]->getSale();
            // sale info //
            $saleId = $sale->getId();
            $CreateTime = $sale->getCreateTime();
            $UpdateTime = $sale->getUpdateTime();
            $State = $sale->getState();
            $Total = $sale->getAmount()->getTotal();
            /** it's all right **/
            /** Here Write your database logic like that insert record or value in database if you want **/
            $this->paypal->create($Total,$Subtotal,$Tax,$PaymentMethod,$PayerStatus,$PayerMail,$saleId,$CreateTime,$UpdateTime,$State);
            $this->session->set_flashdata('success_msg','Payment success');
            redirect('paypal/success');
        }
        $this->session->set_flashdata('success_msg','Payment failed');
        redirect('paypal/cancel');
    }

    function success()
    {
        $data['user_data'] = $this->select_model->select_user($this->backend_table,$this->user_id);
        $this->load->view('headers/userheader',$data);
        $this->load->view('content/success');
        $get_order_id = $this->session->userdata('product_order_id');
        $get_unique_order_id = $this->session->userdata('product_unique_order_id');
        $get_sku = $this->session->userdata('product_sku_array');
        $get_rowid = $this->session->userdata('product_rowid_array');
        $get_dates = $this->session->userdata('set_dates');
        $get_main_address = $this->session->userdata('main_address');
        $get_branch_address = $this->session->userdata('branch_address');


        $get_user_id = $this->user_id;
        
        $arraySku = explode(",",$get_sku);
        $arrayOrderId = explode(",",$get_order_id);
        $arrayUniqueOrderId = explode(",",$get_unique_order_id);
        $arrayRowid = explode(",",$get_rowid);
        $arrayDates = explode("~",$get_dates);
        $arrayMainAddress = explode("~",$get_main_address);
        $arrayBranchAddress = explode("~",$get_branch_address);

        //echo "<script> alert('".json_encode($arrayDates)."'); </script>";

        $get_update_counts = 0;

        for($x = 0; $x < count($arraySku); $x++)
        {
            // echo "Inside for"."<br>";
            // echo $arraySku[$x]." ".$arrayRowid[$x]." ".$arrayOrderId[$x]." ".$get_user_id;

            $set_update_on_sku_rowid_userid = $this->update_model->set_flag_product_cart($arraySku[$x],$arrayRowid[$x],$arrayOrderId[$x],$arrayUniqueOrderId[$x],$get_user_id);
            echo "<script> alert('".$set_update_on_sku_rowid_userid."'); </script>";
            if($set_update_on_sku_rowid_userid)
            {
                $get_dates = explode(" - ",$arrayDates[$x]);                
                $from_date = date_create($get_dates[0]);
                $to_date = date_create($get_dates[1]);

                $str_from_date = date_format($from_date,"Y-m-d");
                // echo $str_from_date;
                $str_to_date = date_format($to_date,"Y-m-d");
                // echo $str_to_date;


                echo "<script>alert('".$arraySku[$x],$arrayRowid[$x],$arrayOrderId[$x],$get_user_id,$str_from_date,$str_to_date."');</script>";

                $get_affected_cart_confirmation = $this->update_model->set_flag_cart_confirmation($arraySku[$x],$arrayRowid[$x],$arrayOrderId[$x],$arrayUniqueOrderId[$x],$get_user_id,$str_from_date,$str_to_date);

                if($get_affected_cart_confirmation)
                {

                    $branch_address = NULL;
                    if(count($arrayBranchAddress) == 2)
                    {
                        $branch_address = $arrayBranchAddress[1];
                    }
                    else
                    {
                        $branch_address = $arrayBranchAddress[0];
                    }
                    $set_address = array(
                        "order_id" => $arrayOrderId[$x],
                        "unique_order_id" => $arrayUniqueOrderId[$x],
                        "user_id" => $this->user_id,
                        "user_type" => $this->backend_table,
                        "main_address" => $arrayMainAddress[$x],
                        "branch_address" => $branch_address
                    );

                    print_r($set_address);
                    $set_insert_address = $this->insert_model->insert_address($set_address);
                    if($set_insert_address)
                    {
                        //remove the items from the cart.
                        $remove_item = $this->delete_model->remove_cart_data($set_address['unique_order_id']);
                        if($remove_item)
                        {
                            echo "<script> alert('Removed From Cart'); </script>";
                        }
                    }
                    $get_update_counts++;
                }
            }
        }
        
        if($get_update_counts)
        {
            echo "<script> alert('Redirecting To Home'); </script>";
            echo "<script>setTimeout(function(){window.location.href='".base_url()."home';},5000);</script>";
        }

        $this->load->view('headers/footer');
    }
    function cancel(){
        $this->load->view("content/cancel");
    }

    function load_refund_form(){
        $this->load->view('content/Refund_payment_form');
    }

    function refund_payment(){
        $refund_amount = $this->input->post('refund_amount');
        $saleId = $this->input->post('sale_id');
        $paymentValue =  (string) round($refund_amount,2); ;

// ### Refund amount
// Includes both the refunded amount (to Payer)
// and refunded fee (to Payee). Use the $amt->details
// field to mention fees refund details.
        $amt = new Amount();
        $amt->setCurrency('USD')
            ->setTotal($paymentValue);

// ### Refund object
        $refundRequest = new RefundRequest();
        $refundRequest->setAmount($amt);

// ###Sale
// A sale transaction.
// Create a Sale object with the
// given sale transaction id.
        $sale = new Sale();
        $sale->setId($saleId);
        try {
            // Refund the sale
            // (See bootstrap.php for more on `ApiContext`)
            $refundedSale = $sale->refundSale($refundRequest, $this->_api_context);
        } catch (Exception $ex) {
            // NOTE: PLEASE DO NOT USE RESULTPRINTER CLASS IN YOUR ORIGINAL CODE. FOR SAMPLE ONLY
            ResultPrinter::printError("Refund Sale", "Sale", null, $refundRequest, $ex);
            exit(1);
        }

// NOTE: PLEASE DO NOT USE RESULTPRINTER CLASS IN YOUR ORIGINAL CODE. FOR SAMPLE ONLY
        ResultPrinter::printResult("Refund Sale", "Sale", $refundedSale->getId(), $refundRequest, $refundedSale);

        return $refundedSale;
    }
}