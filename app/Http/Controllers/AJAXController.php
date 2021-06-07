<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

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
        $user = User::where('email', $request->email)->get()->first();
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

    public function check_phone_number(Request $request)
    {
        $user = User::where('phone_no', $request->phone_no)->get()->first();
        if ($user) {
            if ($user->phone_no_verify == 0) {
//                $this->sendTwillioSMS($request->phone_no);
            }
            return response()->json([
                'user' => $user,
                'message' => "user_exists"
            ], 200);
        }
    }


}
