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
