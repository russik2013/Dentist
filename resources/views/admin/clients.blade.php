<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 10.05.2017
 * Time: 17:41
 */

?>
<link href="{{asset('dantist/table.css')}}" rel="stylesheet">
<script src="{{asset('dantist/js/jquery-1.10.2.min.js')}}"></script>

@extends('layouts.app')

@section('content')
    <div class="center">
        <span class="letter">All clients</span>
<table>

    @foreach($clients as $item)

        <tr>
            <td id = '{{$item->id}}'>{{$item->name}}</td>
        </tr>

    @endforeach

</table>
    </div>


    <script type="text/javascript">

        $(document).ready(function(){

            $('table tr').click(function(){

                //alert($('td:first-child', this).attr('id'));
                document.location.href = '/clientInfo/'+$('td:first-child', this).attr('id'); /* второй вариант, именно переход */
            });

        });

    </script>



@endsection
