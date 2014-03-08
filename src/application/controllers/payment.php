<?php

class Payment extends CI_Controller {

    static $creds = array(
        'USER' => 'yiweizhe_api1.usc.edu',
        'PWD' => '1394318623',
        'SIGNATURE' => 'AiPC9BjkCyDFQXbSkoZcgqH3hpacACuoPmtBdtQ4azaa.BXUPj6Rkgwa',
        'METHOD' => 'SetExpressCheckout',
        'VERSION' => '78',
        'PAYMENTREQUEST_0_CURRENCYCODE' => 'USD',
        'cancelUrl' => 'http://54.83.52.27/index.php/payment/index/cancel',
        'returnUrl' => 'http://54.83.52.27/index.php/payment/index/complete',
    );

    private static function post($url, $variables) {
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
            handleSetExpressCheckout($amt);
        }
        echo 'payment page<br />';
        echo '<a href="payment/index/5">pay $5</a>';
    }

    public function handleSetExpressCheckout($amt) {
        if (!is_numeric($amt)) {
            echo 'Cannot ask to pay for non-numeric value ' . $amt;
            return;
        }
        $url = 'https://api-3t.sandbox.paypal.com/nvp'; //'https://api-3t.paypal.com/nvp';
        $variables = $this->creds;
        $variables['PAYMENTREQUEST_0_PAYMENTACTION'] = 'SALE';
        $variables['SALE&PAYMENTREQUEST_0_AMT'] = $amt;

        $resp = Payment::post($url, $variables);
        echo $resp;
        $url = 'https://www.sandbox.paypal.com/cgi-bin/webscr?cmd=_express-checkout&token=tokenValue';
        return;
    }

    public function cancel() {
        return 'Canceled';
    }

    public function complete() {
        return 'Completed';
    }

}
