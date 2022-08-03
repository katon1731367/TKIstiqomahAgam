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
                            <h6 class="card-title"><b>{{0}}</b> Ruang</h6>
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
                            <h6 class="card-title"><b>{{ 0 }}</b> Guru</h6>
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
                            <h6 class="card-title"><b>{{ 0 }}</b> Siswa
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
                                <h6 class="card-title text-truncates"><b>{{ $sales_person_count }}</b> Prestasi</h6>
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
                            <h6 class="card-title"> <b>{{ $customer_count }}</b> Message</h6>
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
                    <h5 class="card-header"></h5>
                    <div class="card-body">
                        <h3>Sales Stage</h3>
                        <hr class="my-3">
                        <div class="row">
                        </div>
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
                                        <th scope="col">Company</th>
                                        <th scope="col">Sales</th>
                                        <th scope="col">Date Of Contact</th>
                                        <th scope="col">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {{-- @foreach ($recent as $r)
                                    @php
                                        $date = explode(' ', $r->date_of_contact);
                                        $date = $date[0];
                                    @endphp
                                    <tr>
                                        <th scope="row">{{ $loop->iteration }}</th>
                                        <td>{{ $r->company_name }}</td>
                                        <td>{{ $r->name }}</td>
                                        <td>{{ $date }}</td>
                                        <td>{{ $r->status }}</td>
                                    </tr>
                                    @endforeach --}}
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
