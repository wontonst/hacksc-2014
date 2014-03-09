<?php

class Payment extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper('url');
}
    static $creds = array(
        'USER' => 'yiweizhe_api1.usc.edu',
        'PWD' => '1394318623',
        'SIGNATURE' => 'AiPC9BjkCyDFQXbSkoZcgqH3hpacACuoPmtBdtQ4azaa.BXUPj6Rkgwa',
        'METHOD' => 'SetExpressCheckout',
        'VERSION' => '78',
    );
    static $url = 'https://api-3t.sandbox.paypal.com/nvp'; //'https://api-3t.paypal.com/nvp';

    private static function post($url, $variables) {
//        echo http_build_query($variables) . '<br />';
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($variables));
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        return curl_exec($ch);
    }

    public function index() {
        $url= $this->handleSetExpressCheckout($this->input->post('amt'), $this->input->post('id'), $this->input->post('outcome_id'));
//echo $url;return;
        //TODO: KATE NEEDS TO HANDLE REVIEW SCREEN WHICH COMES BACK FROM PAYPAL
redirect($url);
    }

    /**
     * this starts the transaction
     * @param float $amt dollar amount to bid
     * @return string paypal url
     */
    public function handleSetExpressCheckout($amt, $id, $outcome_id) {//start express checkout
        if (!is_numeric($amt)) {
            echo 'Cannot ask to pay for non-numeric value ' . $amt;
            return;
        }

        $append = '?id=' . $id . '&outcome_id=' . $outcome_id;
        $return = 'http://54.83.52.27/index.php/payment/review' . $append;
        $cancel = 'http://54.83.52.27/index.php/payment/cancel' . $append;
        //ask paypal api to generate a token
        $variables = Payment::$creds;
        $variables['PAYMENTREQUEST_0_PAYMENTACTION'] = 'SALE';
        $variables['PAYMENTREQUEST_0_AMT'] = $amt;
        $variables['PAYMENTREQUEST_0_CURRENCYCODE'] = 'USD';
        $variables['cancelUrl'] = $cancel;
        $variables['returnUrl'] = $return;
        $variables['NOSHIPPING'] = 1;
        $variables['PAYMENTREQUEST_0_DESC'] = 'Betty account betting $' . $amt;
        //var_dump($variables);
        $resp = Payment::post(Payment::$url, $variables);
        //echo $resp;
        $resp = parse_str($resp, $arr);

        //var_dump($arr);
        //generate link for users to go to paypal
        $url = 'https://www.sandbox.paypal.com/cgi-bin/webscr?cmd=_express-checkout&token=' . $arr['TOKEN'];
        return $url; //DIRECT USER TO THIS URL
    }

    public function cancel() {
        echo 'Canceled';
    }

    public function review() {//handles getexpresscheckoutdetails and initiates doexpresscheckoutpayment
        //receive getexpresscheckoutdetails
        $variables = Payment::$creds;
        $variables['TOKEN'] = $_GET['token'];
        $variables['METHOD'] = 'GetExpressCheckoutDetails';
        $variables['id'] = $_GET['id'];
        $variables['outcome_id'] = $_GET['outcome_id'];
        //var_dump($variables);
        $resp = Payment::post(Payment::$url, $variables);
        //echo $resp;
        parse_str($resp, $checkoutdetails);
        //var_dump($checkoutdetails);
        //initiate doexpresscheckoutpaymnt
        $variables = array_merge(Payment::$creds, $checkoutdetails);
        $variables['METHOD'] = 'DoExpressCheckoutPayment';
$variables['id']= $this->input->get('id');
$variables['outcome_id']=$this->input->get('outcome_id');
        //TODO KATE NEEDS TO DISPLAY $variables AND CALL COMPLETE WITH THE VARIABLES PASSED AS GET
        //echo $resp;
$data=array(
'raw'=>$variables,
'review'=>true,
'checked'=>true,
'message'=>'',
'review_get'=>http_build_query($variables),
);
$this->load->view('welcome_message',$data);
    }

    public function complete() {
        $variables = $this->input->get();
//var_dump($variables);
        $resp = Payment::post(Payment::$url, $variables);
$data=array(
'raw'=>$variables,
'checked'=>true,
'message'=>'',
'complete'=>true,
);
//redirect('/');
//$this->load->view('welcome_message',$data);
        //TODO KATE NEEDS COMPLETED PAYMENT SCREEN
        //TODO JACK NEEDS TO ADD TO BIDS TABLE
    }

}
