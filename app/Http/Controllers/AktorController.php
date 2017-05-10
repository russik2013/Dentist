<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;

class AktorController extends Controller
{
    public function checkUser(Request $request){

        if (Auth::attempt(['username' => $request->username, 'password' => $request->password])) {
           // Аутентификация прошла...
          //  if($role = Auth::user()->hasRole('admin'))
         //       return redirect()->intended('admin');
          //  if($role = Auth::user()->hasRole('client'))
         //       return redirect()->intended('client');
                return redirect()->intended('/');
        }else{
            return back()->withInput()->withErrors(array('login_error' => 'Не верные данные'));
        }

        //dd($request);

    }
}
