@extends('articles.app')
@section('main-content')
    <div class="container">
        {{-- <form action="/articles/{{ $article->id }}" method="post" enctype="multipart/form-data"> --}}

        <form action="{{ route('articles.update', $article->id) }}}" method="POST" enctype="multipart/form-data">

            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="title">Judul</label>
                <input type="text" class="form-control" required="required" name="title" value="{{ $article->title }}"><br>
            </div>
            <div class="form-group">
                <label for="content">Content</label>
                <input type="text" class="form-control" required="required" name="content"
                    value={{ $article->content }}><br>
            </div>
            <div class="form-group"><label for="image">Featured Image</label>
                <input type="file" class="form-control" required="required" name="image"
                    value="{{ $article->featured_image }}">
            </div><br>
            <img src="{{ asset('storage/' . $article->featured_image) }}" alt="">
            <button type="submit" class="btn btn-primary float right">Ubat Data</button>
        </form>
    </div>
@endsection
