@extends('posts::layouts.master')

@section('content')
    <link rel="stylesheet" href="modules/posts/css/style_posts.css" type="text/css" charset="utf-8" />

	<input type="hidden" name="_token" value="{{ csrf_token() }}">
	введите url для парсинга
	<br/>
	<input type="text" id = "url">

	<br/>
    какой элемент вытищить:
    <br/>
    <select id="parseType">
        <option value="a">Ссылки</option>
        <option value="img">Картинки</option>
    </select>
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
               // console.log($( "#parseType" ).val());
                $.ajax({
                        url: "posts/parse",
                        type: "POST",
                    	data:{url: $('#url').val(), type: $( "#parseType" ).val()},
                    	success: function(msg){
                            var result = document.getElementById("result");
                            result.innerHTML = '<div class="wrapper_body"> ' +
                                                   '<div class="cbm_wrap "> ' +
                                                           '<p>' +  msg['mass'] +
                                                           '</p> ' +
                                                        '<br />' +
                                                    '</div> ' +
                                                '</div>';

                          //  console.log(msg['mass']);
                        }

                    }
                );

            } );


        })
	</script>
@stop