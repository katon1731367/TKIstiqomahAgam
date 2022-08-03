@extends('layouts.main_user')
@section('container')

    <h1 class="center">Berita</h1>

    @foreach ($posts as $post)
        <h2><a href="/news/{{ $post->slug }}">{{ $post->title }}</a></h2>
        <h5>By: {{ $post->author }} in <a href="/categories/{{ $post->category->slug }}">{{ $post->category->name }}</a></h5>

        {!! $post->excerpt !!}

    @endforeach

@endsection