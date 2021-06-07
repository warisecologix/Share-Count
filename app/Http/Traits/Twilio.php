<?php

namespace App\Http\Traits;

use http\Exception;
use Illuminate\Support\Carbon;
use Twilio\Rest\Client;
use Zend\Diactoros\Request;

trait Twilio
{
    public function sendTwillioSMS($cell_number)
    {
        $token = getenv("TWILIO_AUTH_TOKEN");
        $twilio_sid = getenv("TWILIO_SID");
        $twilio_verify_sid = getenv("TWILIO_VERIFY_SID");
        $twilio = new Client($twilio_sid, $token);
        $twilio->verify->v2->services($twilio_verify_sid)
            ->verifications
            ->create($cell_number, "sms");
    }

    public function verify( $phone_number, $verfication_code)
    {
        $token = getenv("TWILIO_AUTH_TOKEN");
        $twilio_sid = getenv("TWILIO_SID");
        $twilio_verify_sid = getenv("TWILIO_VERIFY_SID");
        $twilio = new Client($twilio_sid, $token);
        $verification = $twilio->verify->v2->services($twilio_verify_sid)
            ->verificationChecks
            ->create($verfication_code, array('to' => $phone_number));

        if ($verification->valid) {
            return true;
        } else {
            return false;
        }

    }

    public function sendTwillioEmail($email){
        $sid = getenv("TWILIO_ACCOUNT_SID");
        $token = getenv("TWILIO_AUTH_TOKEN");
        $twilio_verify_sid = getenv("TWILIO_VERIFY_SID");
        $twilio = new Client($sid, $token);
        $verification = $twilio->verify->v2->services($twilio_verify_sid)
            ->verifications
            ->create($email, "email");
    }

}
