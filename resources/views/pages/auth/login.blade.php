@extends('layouts.main_login')

@section('container')
    <section class="vh-100" style="background-color: #508bfc;">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                    <div class="card shadow-3-strong" style="border-radius: 1rem;">
                        <div class="card-body p-5 text-center">

                            <img src="{{ asset('svg/logo-2.svg') }}" alt="" class="img-thumbnail"/>
                            <hr class="mb-1">
                            <p class="mb-3">Sign into your account</p>

                            @if (session()->has('loginError'))
                                <div class="alert alert-danger alert-dismissible fade show">
                                    {{ session('loginError') }}
                                    <button class="btn-close" type="button" data-bs-dismiss='alert'
                                        aria-label="Close"></button>
                                </div>
                            @elseif (session()->has('logout'))
                                <div class="alert alert-success alert-dismissible fade show" id="logout">
                                    {{ session('logout') }}
                                    <button class="btn-close" type="button" data-bs-dismiss='alert'
                                        aria-label="Close"></button>
                                </div>
                            @endif

                            <form action="/login" method="POST">
                                @csrf
                                <div class="form-floating mb-2">
                                    <input type="text"
                                        class="form-control
                  @error('username')
                      is-invalid
                  @enderror"
                                        name="username" placeholder="name@example.com" value="{{ old('username') }}"
                                        autofocus autocomplete="off">
                                    <label for="username">Username</label>
                                    @error('username')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="form-floating mb-2">
                                    <input type="password" class="form-control @error('password') is-invalid @enderror"
                                        name="password" placeholder="Password">
                                    <label for="password">Password</label>
                                    @error('password')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <button class="w-100 btn btn-lg btn-primary" type="submit">Login</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    {{-- @push('js')

    @endpush --}}
@endsection
