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
            return response()->json([
                'user' => $user,
                'message' => "user"
            ],200);
        } else {
            $this->sendTwillioSMS($request->phone_no);
            return response()->json([
                "status" => "ok"
            ],200);
        }

    }

    public function email_verification_code(Request $request)
    {
        return response()->json([
            "status" => "Ok"
        ]);
    }
}
