<?php

namespace App\Http\Controllers;

use App\Country;
use App\Stock;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    public function register()
    {
        $stocks = Stock::all();
        $countries = Country::all();
        return view('account.register', compact('stocks', 'countries'));
    }

    public function store(Request $request)
    {

        $rules = [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required',
            'phone_number' => 'required',
            'share_own' => 'required|integer',
            'brokage_name' => 'required',
            'stock_id' => 'required|integer',
            'country_id' => 'required|integer',
            'image' => 'required|mimes:jpg,jpeg,png,bmp|max:4096',
        ];
        $validator = Validator::make($request->all(), $rules);
        $validator->after(function () use ($request, $validator) {
            $email_count = User::where('email', $request->email)->where('stock_id', $request->stock_id)->get()->count();
            if ($email_count > 0) {
                $validator->errors()->add('email', 'Email already exists');
            }
            $cell_count = User::where('phone_number', $request->phone_number)->where('stock_id', $request->stock_id)->get()->count();
            if ($cell_count > 0) {
                $validator->errors()->add('phone_number', 'Phone no already exists');
            }
        });

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator);
        } else {
            $image = $this->uploadMediaFile($request,'image', 'brokage_app');
            $user = new User();
            $user->first_name = $request->first_name;
            $user->last_name = $request->last_name;
            $user->email = $request->email;
            $user->phone_number = $request->phone_number;
            $user->share_own = $request->share_own;
            $user->purchase_date = $request->purchase_date == null ? null : $request->purchase_date  ;
            $user->brokage_name = $request->brokage_name;
            $user->stock_id = $request->stock_id;
            $user->country_id = $request->country_id;
            $user->image = $image;
            $user->save();
            return redirect()->route('register')->with('success_message', 'Account successfully created.');

        }
    }
}
