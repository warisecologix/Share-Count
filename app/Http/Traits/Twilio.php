<?php

namespace App\Http\Traits;

use App\User;
use http\Exception;
use Illuminate\Support\Carbon;
use Twilio\Exceptions\TwilioException;
use Twilio\Rest\Client;
use Zend\Diactoros\Request;

trait Twilio
{
    public function sendTwillioSMS($cell_number)
    {
        $token = "b93a8fe26e4ea1a5a3d1207bf7ff3168";
        $twilio_sid = "AC8e518cb8b8ecdda7a912198659957091";
        $twilio_verify_sid = "VA27c3032c0b1a38818f4178fbd4410e2f";
        try {
            $twilio = new Client($twilio_sid, $token);
            $twilio->verify->v2->services($twilio_verify_sid)
                ->verifications
                ->create($cell_number, "sms");
            return 200;
        } catch (TwilioException $e) {
            return $e->getCode();
        }


    }

    public function verify($phone_number, $verfication_code)
    {
        $token = "b93a8fe26e4ea1a5a3d1207bf7ff3168";
        $twilio_sid = "AC8e518cb8b8ecdda7a912198659957091";
        $twilio_verify_sid = "VA27c3032c0b1a38818f4178fbd4410e2f";
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

    public function sendTwillioEmail($email)
    {
        $token = "b93a8fe26e4ea1a5a3d1207bf7ff3168";
        $twilio_sid = "AC8e518cb8b8ecdda7a912198659957091";
        $twilio_verify_sid = "VA27c3032c0b1a38818f4178fbd4410e2f";
        $twilio = new Client($twilio_sid, $token);
        $verification = $twilio->verify->v2->services($twilio_verify_sid)
            ->verifications
            ->create($email, "email");
    }

}
