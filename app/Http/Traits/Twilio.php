<?php

namespace App\Http\Traits;

use App\Constant\TwilioConstant;
use Twilio\Exceptions\TwilioException;
use Twilio\Rest\Client;

trait Twilio
{
    private $TWILIO_AUTH_TOKEN = '';
    private $TWILIO_SID = '';
    private $TWILIO_VERIFY_SID = '';

    public function __construct()
    {
        $this->TWILIO_AUTH_TOKEN = TwilioConstant::TWILIO_AUTH_TOKEN;
        $this->TWILIO_SID = TwilioConstant::TWILIO_SID;
        $this->TWILIO_VERIFY_SID = TwilioConstant::TWILIO_VERIFY_SID;
    }

    public function sendTwilioSMS($cell_number)
    {
        try {
            $twilio = new Client($this->TWILIO_SID, $this->TWILIO_AUTH_TOKEN);
            $twilio->verify->v2->services($this->TWILIO_VERIFY_SID)
                ->verifications
                ->create($cell_number, "sms");
            return 200;
        } catch (TwilioException $e) {
//            echo "Get code " . $e->getCode() ."<br>";
//            echo "Get Message ". $e->getMessage() ;
//            die();
            return $e->getCode();
        }
    }

    public function verify($phone_number, $verfication_code)
    {
        $twilio = new Client($this->TWILIO_SID, $this->TWILIO_AUTH_TOKEN);
        $verification = $twilio->verify->v2->services($this->TWILIO_VERIFY_SID)
            ->verificationChecks
            ->create($verfication_code, array('to' => $phone_number));
        if ($verification->valid) {
            return true;
        } else {
            return false;
        }
    }
}
