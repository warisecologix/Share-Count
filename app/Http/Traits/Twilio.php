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
        $token = "178acce54f2866d23c83d95a3a7f40af";
        $twilio_sid = "ACaa40d46ee008345dfa4a0da2eb35b6a3";
        $twilio_verify_sid = "VA22bdec3cc683aedd9a8eb3ab5eeabd94";
        try {
            $twilio = new Client($twilio_sid, $token);
            $twilio->verify->v2->services($twilio_verify_sid)
                ->verifications
                ->create($cell_number, "sms");

            return 200;

        } catch (TwilioException $e) {
            //  echo "<pre>";
            // print_r($e->getMessage( ) );
            // die();
            return $e->getCode();
        }


    }

    public function verify($phone_number, $verfication_code)
    {
        $token = "178acce54f2866d23c83d95a3a7f40af";
        $twilio_sid = "ACaa40d46ee008345dfa4a0da2eb35b6a3";
        $twilio_verify_sid = "VA22bdec3cc683aedd9a8eb3ab5eeabd94";
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
        $token = "178acce54f2866d23c83d95a3a7f40af";
        $twilio_sid = "ACaa40d46ee008345dfa4a0da2eb35b6a3";
        $twilio_verify_sid = "VA22bdec3cc683aedd9a8eb3ab5eeabd94";
        $twilio = new Client($twilio_sid, $token);
        $verification = $twilio->verify->v2->services($twilio_verify_sid)
            ->verifications
            ->create($email, "email");
    }

}
