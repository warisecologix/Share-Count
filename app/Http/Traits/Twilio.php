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
        $token = "6a810ef558b4da6f465a62236ed496a1";
        $twilio_sid = "ACbabb2f4738eb24d6a04422af30f8cbba";
        $twilio_verify_sid = "VAdf6cbd828eee8a2b60575af81e6a5408";
        $twilio = new Client($twilio_sid, $token);
        $twilio->verify->v2->services($twilio_verify_sid)
            ->verifications
            ->create($cell_number, "sms");
    }

    public function verify($phone_number, $verfication_code)
    {
        $token = "6a810ef558b4da6f465a62236ed496a1";
        $twilio_sid = "ACbabb2f4738eb24d6a04422af30f8cbba";
        $twilio_verify_sid = "VAdf6cbd828eee8a2b60575af81e6a5408";
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
        $token = "6a810ef558b4da6f465a62236ed496a1";
        $twilio_sid = "ACbabb2f4738eb24d6a04422af30f8cbba";
        $twilio_verify_sid = "VAdf6cbd828eee8a2b60575af81e6a5408";
        $twilio = new Client($twilio_sid, $token);
        $verification = $twilio->verify->v2->services($twilio_verify_sid)
            ->verifications
            ->create($email, "email");
    }

}
