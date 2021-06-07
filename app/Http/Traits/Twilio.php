<?php

namespace App\Http\Traits;

use App\User;
use http\Exception;
use Illuminate\Support\Carbon;
use Twilio\Rest\Client;
use Zend\Diactoros\Request;

trait Twilio
{
    public function sendTwillioSMS($cell_number)
    {
        $token = "c734a4b941cdee7ddc8b727c457673e9";
        $twilio_sid = "ACbabb2f4738eb24d6a04422af30f8cbba";
        $twilio_verify_sid = "VAfc2fbe34e571b79bb607cc9c71af2683";
        $twilio = new Client($twilio_sid, $token);
        $twilio->verify->v2->services($twilio_verify_sid)
            ->verifications
            ->create($cell_number, "sms");
    }

    public function verify($phone_number, $verfication_code)
    {
        $token = "c734a4b941cdee7ddc8b727c457673e9";
        $twilio_sid = "ACbabb2f4738eb24d6a04422af30f8cbba";
        $twilio_verify_sid = "VAfc2fbe34e571b79bb607cc9c71af2683";
        $twilio = new Client($twilio_sid, $token);
        $verification = $twilio->verify->v2->services($twilio_verify_sid)
            ->verificationChecks
            ->create($verfication_code, array('to' => $phone_number));
        if ($verification->valid) {
            return true;
        } else {
            return  false;
        }
    }

    public function sendTwillioEmail($email)
    {
        $token = "c734a4b941cdee7ddc8b727c457673e9";
        $twilio_sid = "ACbabb2f4738eb24d6a04422af30f8cbba";
        $twilio_verify_sid = "VAfc2fbe34e571b79bb607cc9c71af2683";
        $twilio = new Client($twilio_sid, $token);
        $verification = $twilio->verify->v2->services($twilio_verify_sid)
            ->verifications
            ->create($email, "email");
    }

}
