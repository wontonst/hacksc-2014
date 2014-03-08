<?php

class Payment extends CI_Controller {

    static $creds = array(
        'USER' => 'yiweizhe_api1.usc.edu',
        'PWD' => '1394318623',
        'SIGNATURE' => 'AiPC9BjkCyDFQXbSkoZcgqH3hpacACuoPmtBdtQ4azaa.BXUPj6Rkgwa',
        'METHOD' => 'SetExpressCheckout',
        'VERSION' => '78',
        'PAYMENTREQUEST_0_CURRENCYCODE' => 'USD',
        'cancelUrl' => '/payment/cancel',
        'returnUrl' => '/payment/complete',
    );

    private static function generateURL($base) {
        $url = $base . '?';
        foreach (Payment::$creds as $k => $v) {
            $url.=$k . '=' . $v . '&';
        }
        return $url;
    }

    public function index($amt) {
        if (isset($amt)) {
            if (!is_numeric($amt)) {
                echo 'Cannot ask to pay for non-numeric value ' . $amt;
                return;
            }
            $url = 'https://api-3t.sandbox.paypal.com/nvp';//'https://api-3t.paypal.com/nvp';
            $url = Payment::generateURL($url) . 'PAYMENTREQUEST_0_PAYMENTACTION=SALE&PAYMENTREQUEST_0_AMT=' . $amt;
            echo 'url: ' . $url . '<a href="' . $url . '">click</a>';
            
            return;
        }
        echo 'payment page<br />';
        echo '<a href="payment/index/5">pay $5</a>';

        $url = 'https://www.sandbox.paypal.com/cgi-bin/webscr?cmd=_express-checkout&token=tokenValue';
    }

    public function cancel() {
        return 'Canceled';
    }

    public function complete() {
        return 'Completed';
    }

}
