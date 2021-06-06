<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AJAXController extends Controller
{
    public function phone_number_verification_code(Request $request){
        $this->sendTwillioSMS($request->phone_number);
        return response()->json([
            "status" => "Ok"
        ]);
    }
    public function email_verification_code(Request $request){
        return response()->json([
            "status" => "Ok"
        ]);
    }
}
