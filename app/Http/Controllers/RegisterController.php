<?php

namespace App\Http\Controllers;

use App\Company;
use App\Country;
use App\EmailVerify;
use App\Mail\VerifyUser;
use App\Stock;
use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class RegisterController extends Controller
{
    public function register()
    {
        $gme_total_verify = DB::select("select * from ((SELECT com.company_name, COUNT(distinct st.user_id) AS 'Shareholder_Count', SUM(st.no_shares_own) AS 'Total_Share', COUNT(distinct st.user_id) AS 'verified_count' FROM stocks st , companies com where st.company_id = com.id and st.company_id =1 group by st.company_id ) ab,(SELECT COUNT(id) AS 'total_verify' from stocks WHERE admin_verify = 1 and company_id = 1 ) vc )");
        $amc_total_verify = DB::select("select * from ((SELECT com.company_name, COUNT(distinct st.user_id) AS 'Shareholder_Count', SUM(st.no_shares_own) AS 'Total_Share', COUNT(distinct st.user_id) AS 'verified_count' FROM stocks st , companies com where st.company_id = com.id and st.company_id =2 group by st.company_id ) ab,(SELECT COUNT(id) AS 'total_verify' from stocks WHERE admin_verify = 1 and company_id = 2 ) vc )");
        $companies = Company::all();
        $countries = Country::all();
        return view('account.register', compact('companies', 'countries', 'amc_total_verify',  'gme_total_verify' ));
    }

    public function store(Request $request)
    {
        $rules = [
            'no_shares_own' => 'required|integer',
            'Verify_Share' => 'required',
            'company_id' => 'required',
            'country_list' => 'required',
        ];
        $validator = Validator::make($request->all(), $rules);
        $validator->after(function () use ($request, $validator) {
            $session_id = Session::getId();
            $ownVerify = EmailVerify::where('session_id', $session_id)->where('otp_code', $request->Verify_Share)->where('type', 1)->get()->first();
            if (!$ownVerify) {
                $validator->errors()->add('Verify_Share', 'Error! Invalid One Time Password');
            }
        });

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->getMessageBag()->toArray()
            ], 400);
        } else {
            $user = User::where('email', $request->email)->orWhere('phone_no', $request->phone_no)->get()->first();

            $stock = new Stock();
            $stock->company_id = $request->company_id;
            $stock->user_id = $user->id ?? 0;
            $stock->no_shares_own = $request->no_shares_own;
            $stock->country_list = $request->country_list;
            $stock->brokage_name = $request->brokage_name;
            $stock->date_purchase = $request->date_purchase;
            $stock->verified_string = $request->Verify_Share;
            $stock->save();
            $session_id = Session::getId();
            $emailVerify = EmailVerify::where('session_id', $session_id)->get();
            foreach ($emailVerify as $c) {
                $c->delete();
            }
            $message = "Thanks for Submitting your Share Count. To Ensure Data integrity please Email screenshot of your Brokage app or Webpage or Statement where we clearly read Share quantity. You can hide the account #. See below the acceptable formats.You must send Email from the above Email account " . $user->email . " you have provided. Send Email to trackshortage@gmail.com";
            return $this->successResponse($message);
        }
    }

    public function register_user(Request $request)
    {
        $rules = [
            'phone_no' => 'required',
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required',
        ];
        $validator = Validator::make($request->all(), $rules);
        $validator->after(function () use ($request, $validator) {
            $users_count = User::where('email', $request->email)->orWhere("phone_no", $request->phone_no)->get()->count();
            if ($users_count != 0) {
                $validator->errors()->add('Email_Phone_No', 'Email or Phone no already exists');
            }
        });
        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->getMessageBag()->toArray()
            ], 400);
        } else {
            $user = new User();
            $verify_user = 0;
            if($request->phone_no_verify == 1 && $request->email_verify == 1){
                $verify_user = 1 ;
            }
            $user->first_name = $request->first_name;
            $user->last_name = $request->last_name;
            $user->email = $request->email;
            $user->phone_no = $request->phone_no;
            $user->phone_code = $request->phone_code;
            $user->phone_no_verify = $request->phone_no_verify;
            $user->email_verify = $request->email_verify;
            $user->verified_user = $verify_user;
            $user->save();

            return $this->successResponse('Account created');
        }
    }

}
