@extends('layouts.main')

@section('container')
    <div class="container py-1 h-100">
        <div class="row">
            <div
                class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">{{ $title }}</h1>

                <div class="col-md-6 d-flex flex-row-reverse">
                    <a class="btn btn-primary" href="/dashboard/news/create">
                        Tambah Berita
                    </a>
                </div>

            </div>
        </div>

        @if (session()->has('success'))
            <div class="alert alert-success" role="alert">
               {{ session('success') }}
            </div>
        @endif

        <div id='flash-message'></div>

        <table class="table table-striped table-sm" id="tableNews">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Judul Berita</th>
                    <th scope="col">Penulis</th>
                    <th scope="col">Kategori</th>
                    <th scope="col">Terakhir Diubah</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
        </table>
    </div>

    @push('js')
        <script>
            $(document).ready(function() {
                fetchData();
            })

            $(document).on('click', '.delete', function() {
                var slug = $(this).attr('id');
                destroy(slug);
            });
            
            //crud function
            function fetchData() {
                $('#tableNews').DataTable({
                    serverside: true,
                    responseive: true,
                    ajax: {
                        url: "/dashboard/fetchnews"
                    },
                    columns: [{
                            "data": null,
                            "sortable": true,
                            render: function(data, type, row, meta) {
                                return meta.row + meta.settings._iDisplayStart + 1
                            }
                        },
                        {
                            data: 'title',
                            name: 'Judul Berita'
                        },
                        {
                            data: 'user.name',
                            name: 'penulis'
                        },
                        {
                            data: 'category_name',
                            name: 'Kategori'
                        },
                        {
                            data: 'updated_at',
                            name: 'Terakhir Diubah'
                        },
                        {
                            data: 'aksi',
                            name: 'aksi'
                        }
                    ]
                })
            }

            function destroy(slug) {
                $.ajax({
                    url: "/dashboard/news/destroybyajax/" + slug,
                    type: 'post',
                    data: {
                        _method: 'delete',
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(res) {
                        flashMessage(res.status, res.message)
                        $('#tableNews').DataTable().ajax.reload()
                    }
                })
            } 

            function flashMessage(status, message) {
                messageHtml = '<div class="alert alert-' + status + ' alert-dismissible fade show">' + message;

                $('#flash-message').html(
                    messageHtml);

                setTimeout(function() {
                    $('#flash-message').fadeIn('fast');
                }, 1000);
                setTimeout(function() {
                    $('#flash-message').fadeOut('fast');
                }, 10000);
            }

        </script>
    @endpush
@endsection
