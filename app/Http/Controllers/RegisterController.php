<?php

namespace App\Http\Controllers;

use App\Country;
use App\Image;
use App\Stock;
use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

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
            'verify_email_code' => 'required',
            'phone_number' => 'required',
            'verify_phone_number_code' => 'required',
            'share_own' => 'required|integer',
            'brokage_name' => 'required',
            'stock_id' => 'required|integer',
            'country_id' => 'required|integer',
        ];
        $validator = Validator::make($request->all(), $rules);
        $validator->after(function () use ($request, $validator) {
            $email_count = User::where('email', $request->email)->where('stock_id', $request->stock_id)->get()->count();
            if ($email_count != 0) {
                $validator->errors()->add('email', 'Email already exists');
            }
            $cell_count = User::where('phone_number', $request->phone_number)->where('stock_id', $request->stock_id)->get()->count();
//            if ($cell_count != 0) {
//                $validator->errors()->add('phone_number', 'Phone no already exists');
//            }
//            if(!$this->verify($request->phone_number, $request->verify_phone_number_code)){
//                $validator->errors()->add('verify_phone_number_code', 'SMS code is invalid');
//            }
        });

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->getMessageBag()->toArray()
            ], 400);
        } else {
            $user = new User();
            $image_64 = $request->image;
            $extension = explode('/', explode(':', substr($image_64, 0, strpos($image_64, ';')))[1])[1];
            $replace = substr($image_64, 0, strpos($image_64, ',') + 1);
            $image = str_replace($replace, '', $image_64);
            $image = str_replace(' ', '+', $image);
            $imageName = Str::random(10) . '.' . $extension;
            Storage::disk('public')->put($imageName, base64_decode($image));
            $user->image = $imageName ?? "Image";
            $user->first_name = $request->first_name;
            $user->last_name = $request->last_name;
            $user->email = $request->email;
            $user->phone_number = $request->phone_number;
            $user->share_own = $request->share_own;
            $user->purchase_date = $request->purchase_date == null ? null : $request->purchase_date;
            $user->brokage_name = $request->brokage_name;
            $user->stock_id = $request->stock_id;
            $user->country_id = $request->country_id;
            $user->save();

            return response()->json([
                'success' => 'User Created'
            ], 200);
        }
    }

}
