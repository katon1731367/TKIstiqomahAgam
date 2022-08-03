@extends('layouts.main_user')
@section('container')
    <h1 class="center">{{ $title }}</h1>
    @foreach ($categoryNews->news as $news)
        <h2><a href="/news/{{ $news->slug }}">{{ $news->title }}</a></h2>
        <h5>By: {{ $news->author }} in <a href="/categories/{{ $news->slug }}">{{ $news->name }}</a></h5>

        {!! $news->excerpt !!}

    @endforeach

@endsection