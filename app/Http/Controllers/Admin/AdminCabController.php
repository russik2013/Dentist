<?php

namespace App\Http\Controllers\Admin;

use App\Models\Role;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AdminCabController extends Controller
{
    public function index(){


        return view('admin.index');

    }
    public function allClients(){

        $clients = User::leftJoin('users_roles', 'users.id', '=', 'users_roles.user_id')->
            where('users_roles.role_id','=',2)->get();

        return view('admin.clients',compact('clients'));

    }
}
