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

        $data = DB::select("SELECT
        com.company_name,
            COUNT(distinct st.user_id) AS 'Shareholder_Count',
            SUM(st.no_shares_own) AS 'Total_Share',
            COUNT(distinct st.user_id) AS 'verified_count'
    FROM
        stocks st
    INNER JOIN companies com ON st.company_id = com.id
    INNER JOIN users us ON st.user_id = us.id
    GROUP BY com.company_name");

        $companies = Company::all();
        $countries = Country::all();
        return view('account.register', compact('companies', 'countries', 'data'));
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
                $validator->errors()->add('Verify_Share', 'Invalid verify shared own code');
            }
        });

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->getMessageBag()->toArray()
            ], 400);
        } else {
            $user = User::where('phone_no', $request->email)->get()->first();
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
            return $this->successResponse('Your stock has been added');
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
        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->getMessageBag()->toArray()
            ], 400);
        } else {
            $user = new User();
            $user->first_name = $request->first_name;
            $user->last_name = $request->last_name;
            $user->email = $request->email;
            if ($request->verify_phone_number_code != null) {
                $user->phone_no_verify = 1;
            }
            $user->phone_no = $request->phone_no;
            $user->phone_no_verify	 = 1;
            $user->verified_user	 = 1;
            $user->email_verify	 = 1;
            $user->save();
            return $this->successResponse('Account created');
        }
    }

}
