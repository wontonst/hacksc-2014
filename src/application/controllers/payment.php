<?php

class Payment extends CI_Controller {

    static $creds = array(
        'USER' => 'yiweizhe_api1.usc.edu',
        'PWD' => '1394318623',
        'SIGNATURE' => 'AiPC9BjkCyDFQXbSkoZcgqH3hpacACuoPmtBdtQ4azaa.BXUPj6Rkgwa',
        'METHOD' => 'SetExpressCheckout',
        'VERSION' => '78',
    );
    static $url = 'https://api-3t.sandbox.paypal.com/nvp'; //'https://api-3t.paypal.com/nvp';

    private static function post($url, $variables) {
        echo http_build_query($variables) . '<br />';
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($variables));
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        return curl_exec($ch);
    }

    public function index($amt) {
        if (isset($amt)) {
            return $this->handleSetExpressCheckout($amt);
        }
        echo 'payment page<br />';
        echo '<a href="index/5">pay $5</a>';
    }

    public function handleSetExpressCheckout($amt) {//start express checkout
        if (!is_numeric($amt)) {
            echo 'Cannot ask to pay for non-numeric value ' . $amt;
            return;
        }
//ask paypal api to generate a token
        $variables = Payment::$creds;
        $variables['PAYMENTREQUEST_0_PAYMENTACTION'] = 'SALE';
        $variables['PAYMENTREQUEST_0_AMT'] = $amt;
        $variables['PAYMENTREQUEST_0_CURRENCYCODE'] = 'USD';
        $variables['cancelUrl'] = 'http://54.83.52.27/index.php/payment/cancel';
        $variables['returnUrl'] = 'http://54.83.52.27/index.php/payment/review';
        $variables['NOSHIPPING'] = 1;
        $variables['PAYMENTREQUEST_0_DESC'] = 'Betty account betting $' . $amt;
        var_dump($variables);
        $resp = Payment::post(Payment::$url, $variables);
        echo $resp;
        $resp = parse_str($resp, $arr);
        var_dump($arr);

//generate link for users to go to paypal
        $url = 'https://www.sandbox.paypal.com/cgi-bin/webscr?cmd=_express-checkout&token=' . $arr['TOKEN'];
        echo '<a href="' . $url . '">Click<a>';
    }

    public function cancel() {
        echo 'Canceled';
    }

    public function review() {//handles getexpresscheckoutdetails and initiates doexpresscheckoutpayment
//receive getexpresscheckoutdetails
        $variables = Payment::$creds;
        $variables['TOKEN'] = $_GET['token'];
        $variables['METHOD'] = 'GetExpressCheckoutDetails';
        var_dump($variables);
        $resp = Payment::post(Payment::$url, $variables);
        echo $resp;
        parse_str($resp, $checkoutdetails);
        var_dump($checkoutdetails);

//initiate doexpresscheckoutpaymnt
        $variables = array_merge(Payment::$creds, $checkoutdetails);
        $variables['METHOD'] = 'DoExpressCheckoutPayment';
        $resp = Payment::post(Payment::$url, $variables);
        echo $resp;
    }

    public function complete() {
        
    }

}
