<?php

namespace App\Http\Controllers\Client;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ClientCabController extends Controller
{
    public function index(){

        return view('client.index');

    }
}
