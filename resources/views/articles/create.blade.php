@extends('articles.app');
@section('main-content')
    ;
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">

    <div class="container">
        <form action="/articles" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="title">Title : </label>
                <input type="text" class="form-control" required="required" name="title">
                <br>
                <label for="content">Content : </label>
                <textarea name="content" id="" cols="30" rows="10" type="text" class="form-control"
                    required="required"></textarea>
                <br>
                <label for="image">Feature Image: </label>
                <input type="file" class="form-control" required="required" name="image">
                <br>
                <button type="submit" name="submit" class="btn btn-primary float-right">Simpan</button>
            </div>
        </form>
    </div>
@endsection
