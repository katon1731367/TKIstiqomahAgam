@extends('layouts.main')

@section('container')
    <div class="container py-1 h-100">
        <div class="row">
            <div
                class="d-flex justify-content-center flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h1">{{ $title }}</h1>
            </div>
            <div class="row">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3">
                    <div class="news-info">
                        <h2 class="h4">Ditulis oleh: {{ $news->user->name }}</h2>
                        <h2 class="h6">Terakhir diperbaharui: {{ $news->updated_at }}</h2>
                        <h2 class="h6">Category: {{ $news->category->name }}</h2>
                    </div>

                    <div class="list-button">
                        <a class='btn btn-primary'href='/dashboard/news'>
                            <img src="{{ asset('svg/arrow-left-circle.svg') }}" style="width: 1em" class="mb-1">
                            <b>Kembali ke Berita</b>
                        </a>
                        @if ($news->category_id == 1)
                            <a class='btn btn-primary'href='/dashboard/achievement'>
                                <b>Kembali ke List</b>
                            </a>
                        @elseif($news->category_id == 2)
                            <a class='btn btn-primary'href='/dashboard/facility'>
                                <b>Kembali ke List</b>
                            </a>
                        @elseif($news->category_id == 3)
                            <a class='btn btn-primary'href='/dashboard/extracurricular'>
                                <b>Kembali ke List</b>
                            </a>
                        @endif
                        <form method="POST" action="/dashboard/news/{{ $news->slug }}" class="d-inline">
                            @method('delete')
                            @csrf
                            <button class="btn btn-danger border-0"
                                onclick="return confirm('Hapus berita "{{ $news->title }}"')">
                                <img src="{{ asset('svg/x-circle.svg') }}" style="width: 1em" class="mb-1">
                                <b>Hapus</b>
                            </button>
                        </form>
                        <a class='btn btn-warning'href='/dashboard/news/{{ $news->slug }}/edit'>
                            <img src="{{ asset('svg/edit.svg') }}" style="width: 1em" class="mb-1">
                            <b>Edit</b>
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-lg-8">
                @if (empty($news->news_image))
                    <div style="max-height: 350px; overflow: hidden;">
                        <img src="https://source.unsplash.com/1200x400?school" alt="{{ $news->title }}"
                            class="img-fluid mb-3">
                    </div>
                @else
                    <div style="max-height: 350px; overflow: hidden;">
                        <img src="{{ asset('storage/' . $news->news_image) }}" alt="{{ $news->title }}"
                            class="img-fluid mt-3">
                    </div>
                @endif

                {!! $news->body !!}
            </div>
        </div>
    @endsection
