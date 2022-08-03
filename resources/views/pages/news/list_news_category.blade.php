@extends('layouts.main_user')
@section('container')

    <h1 class="center">{{ $title }}</h1>

    @foreach ($listCategoryNews as $item)
        <h2><a href="/categories/{{ $item->slug }}">{{ $item->name }}</a></h2>
    @endforeach

@endsection