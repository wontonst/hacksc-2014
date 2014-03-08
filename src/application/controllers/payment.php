<?php

class Payment extends CI_Controller {

    private $creds = array(
        'USER' => 'platfo_1255077030_biz_api1.gmail.com',
        'PWD' => '1255077037',
        'SIGNATURE' => 'Abg0gYcQyxQvnf2HDJkKtA-p6pqhA1k-KTYE0Gcy1diujFio4io5Vqjf',
        'METHOD' => 'SetExpressCheckout',
        'VERSION' => '78',
        'PAYMENTREQUEST_0_CURRENCYCODE' => 'USD',
        'cancelUrl' => '/payment/cancel',
        'returnUrl' => '/payment/complete',
    );

    private function generateURL($base) {
        $url = $base . '?';
        foreach ($creds as $k => $v) {
            $url.=$k . '=' . $v . '&';
        }
        return $url;
    }

    public function index() {
        
    }

    public function id($amount) {
        if (!is_int($amount)) {
            throw new Exception('Cannot ask to pay for noninteger value ' . $amount);
        }
        $url = 'https://api-3t.paypal.com/nvp';
        $url = Payment::generateURL($url) . 'PAYMENTREQUEST_0_PAYMENTACTION=SALE&PAYMENTREQUEST_0_AMT=' . $amount;
        echo $url;
    }

    public function cancel() {
        return 'Canceled';
    }

    public function complete() {
        return 'Completed';
    }

}
