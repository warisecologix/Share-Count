<?php

namespace App\Http\Controllers;

use App\Company;
use App\EmailVerify;
use App\Http\Traits\UserLoginLogsTrait;
use App\Stock;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    use UserLoginLogsTrait;

    public function register()
    {
        $companies = Company::all();
        return view('account.register', compact('companies'));
    }

    public function faq()
    {
        return view('account.faq');
    }

    public function store(Request $request)
    {
        $rules = [
            'no_shares_own' => 'required|integer',
            'company_id' => 'required',
            'country_list' => 'required',
        ];
        $customMessages = [
            'no_shares_own.required' => 'The no of share purchased field is required.'
        ];
        $validator = Validator::make($request->all(), $rules, $customMessages);
        $validator->after(function () use ($request, $validator) {
            $session_id = Session::getId();
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
            $stock->verified_string ="";
            $stock->save();
            $this->store_user_login_logs($request, $user, $stock);
            $session_id = Session::getId();
            $emailVerify = EmailVerify::where('session_id', $session_id)->get();
            foreach ($emailVerify as $c) {
                $c->delete();
            }
            $message = "Thanks for Submitting your Share Count. To Ensure Data integrity please Email screenshot of your Brokage app or Webpage or Statement where we clearly read Share quantity. You can hide the account #. See below the acceptable formats.You must send Email from the above Email account <b>$user->email</b> you have provided. Send Email to <b id='working_email'><a href='mailto:trackshortage@gmail.com'>trackshortage@gmail.com</a></b>";
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
            if ($request->phone_no_verify == 1 && $request->email_verify == 1) {
                $verify_user = 1;
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
