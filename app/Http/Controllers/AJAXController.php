<?php

namespace App\Http\Controllers;

use App\EmailVerify;
use App\Mail\VerifyUser;
use App\User;
use App\UserStockLogs;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class AJAXController extends Controller
{
    public function check_verification(Request $request)
    {


        $user = User::where('phone_no', $request->phone_no)->get()->first();
        if ($user) {
            if ($user->phone_no_verify == 0) {
                $code = $this->sendTwilioSMS($request->phone_no);
                if ($code == 200) {
                    return $this->successResponse('Please Check your phone for One Time Passcode to verify your phone', $user, 200, 'user_found_code_send');
                } else {
                    return $this->errorResponse('OTP code not send, invalid phone number', $code, $user, "user_found_code_not_send");
                }
            } else {
                return $this->successResponse('User found', $user, 200, "user_found_cell_verified");
            }
        } else {
            $code = $this->sendTwilioSMS($request->phone_no);
            if ($code == 200) {
                return $this->successResponse('Please Check your phone for One Time Passcode to verify your phone', '', 200, "user_not_found_code_send");
            } else {
                return $this->errorResponse('OTP code not send, invalid phone number', $code, '', 'user_not_found_code_not_send');
            }
        }
    }

    public function email_verification_code(Request $request)
    {
        $user = User::where('email', $request->email)->get()->first();
        if ($user) {
            if ($user->email_verify == 0 || $user->email_verify == 1) {
                $this->code_send($request->email);
                return $this->successResponse('Please Check your email for One Time Passcode to verify your email', $user, 200, 'user_found_code_send');
            } else {
                return $this->successResponse('User found', $user, 200, "user_found_email_verified");
            }
        } else {
            $this->code_send($request->email);
            return $this->successResponse('Please Check your email for One Time Passcode to verify your email', '', 200, 'user_not_found_code_send');
        }
    }

    private function code_send($email)
    {
        $session_id = Session::getId();
        $random_number = mt_rand(100000, 999999);
        $from = "verification@trackshortage.com";
        $to = $email;
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
    }

    public function shares_own_verification_code(Request $request)
    {
        $session_id = Session::getId();
        $random_number = mt_rand(100000, 999999);

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
        } else {
            return response()->json([
                'message' => "User not found"
            ], 404);
        }
    }

    public function verify_phone_otp(Request $request)
    {
        $code = $this->verify($request->phone_no, $request->otp);
        if ($code == 200) {
            $user = User::where('phone_no', $request->phone_no)->get()->first();
            if($user){
                $user->phone_no_verify = 1;
                if($user->phone_no_verify == 1 && $user->email_verify == 1){
                    $user->verified_user = 1;
                }
                $user->save();
            }
            return $this->successResponse("Success! Thanks for verifying your Phone");
        } else if ($code == 199) {
            return $this->errorResponse("Error! Invalid One Time Password", $code, '', 'phone_number_not_verify');
        } else {
            return $this->errorResponse("Error! Invalid One Time Password", $code);
        }
    }

    public function verify_email_otp(Request $request)
    {
        $session_id = Session::getId();
        $emailVerify = EmailVerify::where('session_id', $session_id)->where('type', 0)->where('otp_code', $request->otp)->get()->first();
        if (!$emailVerify) {
            return $this->errorResponse('Invalid OTP code');
        } else {
            return $this->successResponse('Success! Thanks for verifying your Email');
        }
    }

    public function load_stat()
    {
        $gme_data = DB::select("select * from ((SELECT com.company_name, COUNT(distinct st.user_id) AS 'Shareholder_Count', SUM(st.no_shares_own) AS 'Total_Share', COUNT(distinct st.user_id) AS 'verified_count' FROM stocks st , companies com where st.company_id = com.id and st.company_id =1 group by st.company_id ) ab,(SELECT COUNT(id) AS 'total_verify' from stocks WHERE admin_verify = 1 and company_id = 1 ) vc )");
        $amc_data = DB::select("select * from ((SELECT com.company_name, COUNT(distinct st.user_id) AS 'Shareholder_Count', SUM(st.no_shares_own) AS 'Total_Share', COUNT(distinct st.user_id) AS 'verified_count' FROM stocks st , companies com where st.company_id = com.id and st.company_id =2 group by st.company_id ) ab,(SELECT COUNT(id) AS 'total_verify' from stocks WHERE admin_verify = 1 and company_id = 2 ) vc )");


        if($gme_data){
            $gme_data = $gme_data[0];
        }
        if($amc_data){
            $amc_data = $amc_data[0];
        }
        return response()->json([
            "gme_share_holder_count" => $gme_data->Shareholder_Count ?? "-",
            "gme_verified_members" => $gme_data->verified_count ?? "-",
            "gme_total_shares" => $gme_data->Total_Share ?? "-",
            "gme_verified_shares" => $gme_data->total_verify ?? "-",
            "amc_share_holder_count" => $amc_data->Shareholder_Count ?? "-",
            "amc_verified_members" => $amc_data->verified_count ?? "-",
            "amc_total_shares" => $amc_data->Total_Share ?? "-",
            "amc_verified_shares" => $amc_data->total_verify ?? "-",
        ]);
    }
}
