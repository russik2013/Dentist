<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 10.05.2017
 * Time: 17:41
 */

?>
<link href="{{asset('dantist/table.css')}}" rel="stylesheet">

@extends('layouts.app')

@section('content')
    <div class="center">
        <span class="letter">All clients</span>
<table>

    @foreach($clients as $item)

        <tr>
            <td>{{$item->name}}</td>
        </tr>

    @endforeach

</table>
    </div>
@endsection
