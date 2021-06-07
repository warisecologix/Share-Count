<?php

namespace App\Http\Controllers;

use App\EmailVerify;
use App\Mail\VerifyUser;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class AJAXController extends Controller
{
    public function phone_number_verification_code(Request $request)
    {

        $user = User::where('phone_no', $request->phone_no)->get()->first();
        if ($user) {
            if (!$user->phone_no_verify) {
                $this->sendTwillioSMS($request->phone_no);

            }
            return response()->json([
                'user' => $user,
                'message' => "user"
            ], 200);
        } else {
            $this->sendTwillioSMS($request->phone_no);
            return response()->json([
                'message' => "code"
            ], 200);
        }

    }

    public function email_verification_code(Request $request)
    {
        $session_id = Session::getId();
        $random_number = mt_rand(1000, 9999);
        Mail::to($request->email)->send(new VerifyUser($random_number));
        $collection =  EmailVerify::where('session_id', $session_id)->get();
        foreach($collection as $c) {
            $c->delete();
        }
        $emailVerify = new EmailVerify();
        $emailVerify->otp_code = $random_number;
        $emailVerify->session_id = $session_id;
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
    }


}
