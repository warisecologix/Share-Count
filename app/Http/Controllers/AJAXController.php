<?php

namespace App\Http\Controllers;

use App\EmailVerify;
use App\Mail\VerifyUser;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class AJAXController extends Controller
{
    public function phone_number_verification_code(Request $request)
    {
        $user = User::where('phone_no', $request->phone_no)->get()->first();
        if ($user) {
            if (!$user->phone_no_verify) {
                $code = $this->sendTwilioSMS($request->phone_no);
                if ($code == 20429 || $code == 60200) {
                    return response()->json([
                        'message' => "phone_format"
                    ], 200);
                } else if ($code == 200) {
                    return response()->json([
                        'message' => "sms_code_send"
                    ], 200);
                }
            }
            return response()->json([
                'user' => $user,
                'message' => "user"
            ], 200);
        } else {
            $code = $this->sendTwilioSMS($request->phone_no);
            if ($code == 200) {
                return $this->successResponse('OTP code send successfully');
            } else {
                return $this->errorResponse('OTP code not send successfully', $code);
            }
        }
    }

    public function email_verification_code(Request $request)
    {

        $session_id = Session::getId();
        $random_number = mt_rand(1000, 9999);


        //Mail::to($request->email)->send(new VerifyUser($random_number));
        $from = "verification@trackshortage.com";
        $to = $request->email;
        $subject = "Verification mail";
        $message = "Your OTP code is " . $random_number;
        $headers = "Reply-To: Count <verification@trackshortage.com>\r\n";
        $headers .= "Return-Path:  Verification Email <verification@trackshortage.com>\r\n";
        $headers .= "From: Verification Email <verification@trackshortage.com>\r\n";
        $headers .= "Organization: trackshortage\r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-type: text/plain; charset=iso-8859-1\r\n";
        $headers .= "X-Priority: 3\r\n";
        $headers .= "X-Mailer: PHP" . phpversion() . "\r\n";
        mail($to, $subject, $message, $headers);


        $collection = EmailVerify::where('session_id', $session_id)->where('type', 0)->get();
        foreach ($collection as $c) {
            $c->delete();
        }
        $emailVerify = new EmailVerify();
        $emailVerify->otp_code = $random_number;
        $emailVerify->session_id = $session_id;
        $emailVerify->type = 0;
        $emailVerify->save();
        return response()->json([
            'message' => "ok"
        ], 200);

    }

    public function shares_own_verification_code(Request $request)
    {
        $session_id = Session::getId();
        $random_number = Str::random(10);

        //Mail::to($request->email)->send(new VerifyUser($random_number));

        $from = "verification@trackshortage.com";
        $to = $request->email;
        $subject = "Verification mail";
        $message = "Your OTP code is " . $random_number;
        $headers = "Reply-To: Count <verification@trackshortage.com>\r\n";
        $headers .= "Return-Path:  Verification Email <verification@trackshortage.com>\r\n";
        $headers .= "From: Verification Email <verification@trackshortage.com>\r\n";
        $headers .= "Organization: trackshortage\r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-type: text/plain; charset=iso-8859-1\r\n";
        $headers .= "X-Priority: 3\r\n";
        $headers .= "X-Mailer: PHP" . phpversion() . "\r\n";
        mail($to, $subject, $message, $headers);


        $collection = EmailVerify::where('session_id', $session_id)->where('type', 1)->get();
        foreach ($collection as $c) {
            $c->delete();
        }
        $emailVerify = new EmailVerify();
        $emailVerify->otp_code = $random_number;
        $emailVerify->session_id = $session_id;
        $emailVerify->type = 1;
        $emailVerify->save();
        return response()->json([
            'message' => "ok"
        ], 200);

    }

    public function check_phone_number(Request $request)
    {
        $user = User::where('phone_no', $request->phone_no)->get()->first();
        if ($user) {
            return response()->json([
                'user' => $user,
                'message' => "user_exists"
            ], 200);
        }
        else{
            return response()->json([
                'message' => "User not found"
            ], 404);
        }
    }

    public function verify_phone_otp(Request $request)
    {
        $code = $this->verify($request->phone_no, $request->otp);
        if ($code == 200) {
            return $this->successResponse("OTP verify");
        } else {
            return $this->errorResponse("OTP is invalid", $code);
        }
    }

    public function verify_email_otp(Request $request)
    {
        $session_id = Session::getId();
        $emailVerify = EmailVerify::where('session_id', $session_id)->where('type', 0)->where('otp_code', $request->otp)->get()->first();
        if (!$emailVerify) {
            return $this->errorResponse('Invalid OTP code');
        } else {
            return $this->successResponse('OTP verify');
        }
    }

}
