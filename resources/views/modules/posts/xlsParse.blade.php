@extends('posts::layouts.master')

@section('content')

парсинг xls
<br/>
    <form action="/posts/parseXLSdo" class="form-horizontal" method="post" enctype="multipart/form-data">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" name="_method" value="POST">

        <div class="form-group">
            <label for="picture" class="control-label col-md-2 required">Загрузка картинки</label>


            <p> <input type="file" name ="picture" id ="picture"></p>


        </div>


       <input type="submit">


    </form>


@stop
