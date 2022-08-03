@extends('layouts.main')

@section('container')
    <div class="container py-1 h-100">
        <div class="row">
            <div
                class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">{{ $title }}</h1>
            </div>
        </div>

        <div class="col-lg-8">
            <form method="POST" action="/dashboard/news">
                @csrf

                {{-- Input Judul Berita --}}
                <div class="form-group mb-3">
                    <label for="title"><b>Judul Berita</b></label>
                    <input type="text" class="form-control @error('title') is-invalid @enderror" id="title"
                        name="title" autofocus value="{{ old('title') }}">
                    @error('title')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                {{-- Input Slug dan User-id --}}
                <div class="form-group mb-3">
                    <label for="slug"><b>Slug</b></label>
                    <input type="text" class="form-control @error('slug') is-invalid @enderror" id="slug"
                        name="slug" value="{{ old('slug') }}" readonly>
                    @error('slug')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                {{-- Input Categori-Id --}}
                <div class="form-group mb-3">
                    <label for="body"><b>Category</b></label>
                    <select class="form-control @error('category_id') is-invalid @enderror" name="category_id">
                        @foreach ($categories_news as $category)
                            @if (old('category_id') == $category->id)
                                <option value="{{ $category->id }}" selected>{{ $category->name }}</option>
                            @else
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>

                {{-- Input Body --}}
                <div class="form-group mb-3">
                    <label for="body" class="form-label @error('body') is-invalid @enderror"><b>Body</b></label>
                    <input id="body" type="hidden" name="body" value="{{ old('body') }}">
                    <trix-editor input="body"></trix-editor>
                    @error('body')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="row">
                    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3">
                        <div class="btn-back">
                            <a class='btn btn-secondary'href='/dashboard/news'>
                                <img src="{{ asset('svg/file.svg') }}" style="width: 1em" class="mb-1">
                                <b>Kembali ke list</b>
                            </a>
                        </div>

                        <button class='btn btn-primary' type="submit" class="btn btn-primary mb-3"><b>Submit</b></button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        const title = document.querySelector('#title');
        const slug = document.querySelector('#slug');

        title.addEventListener('change', function() {
            fetch('/dashboard/newscheckslug?title=' + title.value)
                .then(response => response.json())
                .then(data => slug.value = data.slug);
        })

        document.addEventListener('trix-file-accept', function(e) {
            e.preventDefault();
        })
    </script>
@endsection
