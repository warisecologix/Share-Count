<?php

namespace App\Http\Controllers;

use App\Country;
use App\Stock;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function register(){
        $stocks = Stock::all();
        $countries = Country::all();
        return view('account.register', compact('stocks', 'countries'));
    }
    public function store(Request $request){

    }
}
