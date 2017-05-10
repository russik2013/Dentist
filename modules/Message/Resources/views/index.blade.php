@extends('message::layouts.master')

@section('content')
	<link href="modules/message/css/style_message.css" rel="stylesheet" type="text/css" />
	<input type="hidden" name="_token" value="{{ csrf_token() }}">
	введите логин
	<br/>
	<input type="text" id = "login">

	<br/>
	введите пароль
	<br/>
	<input type="password" id = "password">
	<br/> <br/>
	<a class="button7" id = "enter">Выполнить</a>

	<p id = "result"></p>



	<script src="//ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
	<script>
        $().ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $('#enter').click( function () {
                // console.log($( "#login" ).val());
               //  console.log($( "#password" ).val());
                $.ajax({
                        url: "message/message",
                        type: "POST",
                        data:{login: $( "#login" ).val(), password: $( "#password" ).val()},
                        success: function(msg){

                            var result = document.getElementById("result");
                            result.innerHTML ='<table> ' +
													 msg['mass'] +
								              '</table>';

                        }

                    }
                );

            } );


        })
	</script>


@stop