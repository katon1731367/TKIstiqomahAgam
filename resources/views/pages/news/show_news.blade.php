@extends('layouts.main_user')
@section('container')

    <h1 class="center">{{ $post->title }}</h1>
    <h5 class="mb-5">News Category: {{ $post->category->name }}</h5>

    <h5>By: {{ $post->author }}</h5>

    {!! $post->body !!}

    <a href="/news">Back to List</a>
@endsection