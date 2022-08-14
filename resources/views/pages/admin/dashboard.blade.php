@extends('layouts.main')

@section('container')
    <div class="container py-1 h-100">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Welcome back, {{ auth()->user()->name }}</h1>
        </div>

        <div class="row">
            <div class="col-lg-2">
                <div class="card" id="total-pipeline" style="height: 7em; overflow:auto">
                    <div class="card-body">
                        <div class="row justify-content-center mb-2">
                            <img class="img-fluid" src="{{ asset('svg/target.svg') }}" style="width: 3em">
                        </div>
                        <div class="row text-center">
                            <h6 class="card-title"><b>{{ $room_count }}</b> Ruang</h6>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-2">
                <div class="card" style="height: 7em; overflow:auto">
                    <div class="card-body">
                        <div class="row justify-content-center mb-2">
                            <img class="img-fluid" src="{{ asset('svg/check-circle.svg') }}" style="width: 3em">
                        </div>
                        <div class="row text-center">
                            <h6 class="card-title"><b>{{ $teacher_count }}</b> Guru</h6>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-2">
                <div class="card" style="height: 7em; overflow:auto">
                    <div class="card-body">
                        <div class="row justify-content-center mb-2">
                            <img class="img-fluid" src="{{ asset('svg/x-circle.svg') }}" style="width: 3em">
                        </div>
                        <div class="row text-center">
                            <h6 class="card-title"><b>{{ $student_count }}</b> Siswa
                            </h6>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-2">
                <div class="card" style="height: 7em; overflow:auto">
                    <div class="card-body">
                        <div class="row justify-content-center mb-2">
                            <img class="img-fluid" src="{{ asset('svg/users.svg') }}" style="width: 3em">
                        </div>
                        <div class="row text-center">
                            <h6 class="card-title text-truncates"><b>{{ $achievement_count }}</b> Prestasi</h6>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-2">
                <div class="card" style="height: 7em; overflow:auto">
                    <div class="card-body">
                        <div class="row justify-content-center mb-2">
                            <img class="img-fluid" src="{{ asset('svg/users.svg') }}" style="width: 3em">
                        </div>
                        <div class="row text-center">
                            <h6 class="card-title"> <b>{{ $message_count }}</b> Message</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- devider --}}
        <hr>

        <div class="row">
            <div class="col-sm-5">
                <div class="card">
                    <h5 class="card-header">Berita</h5>
                    <div class="card-body">
                        <ul class="list-group">
                            <li class="list-group-item">Total Berita : <b>{{ $news_count }}</b></li>
                            <li class="list-group-item">Prestasi : <b>{{ $achievement_count }}</b></li>
                            <li class="list-group-item">Fasilitas : <b>{{ $facility_count }}</b></li>
                            <li class="list-group-item">Ekstrakulikuler : <b>{{ $extracurricular_count }}</b></li>
                            <li class="list-group-item">Program Unggulan : <b>{{ $featuredprogram_count }}</b></li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-sm-7">
                <div class="card">
                    <h5 class="card-header mb-2">Pesan Terakhir</h5>
                    <div class="card-body">
                        <div class="overflow-auto" style="height: 300px;">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Nama</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Tanggal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($recentContactMessage as $recent)
                                        @php
                                            $date = explode(' ', $recent->created_at);
                                            $date = $date[0];
                                        @endphp
                                        <tr>
                                            <th scope="row">{{ $loop->iteration }}</th>
                                            <td>{{ $recent->name }}</td>
                                            <td>{{ $recent->email }}</td>
                                            <td>{{ $date }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
