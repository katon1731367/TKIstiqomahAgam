@extends('layouts.main')

@section('container')
    <div class="container py-1 h-100">
        <div class="row">
            <div
                class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">{{ $title }}</h1>

                <div class="col-md-6 d-flex flex-row-reverse">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" id="AddUser"
                        data-bs-target="#formAddUser">
                        Add User
                    </button>
                    <a href="/dashboard/export-users" class="btn btn-success mx-1">Export Excel</a>
                </div>

            </div>
        </div>

        <div id='flash-message'></div>

        <table class="table table-striped table-sm" id="tableUser">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Username</th>
                    <th scope="col">Email</th>
                    <th scope="col">User Level</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
        </table>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="formAddUser" tabindex="-1" aria-labelledby="formAddUserLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="formAddUserLabel">Form Add User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div id="form-errors"></div>
                <div class="modal-body">
                    @csrf

                    <input type="text" id="username-edit" hidden>
                    <div class="form-floating my-1">
                        <input type="text" class="form-control rounded-top" name="name" placeholder="Name" id="name">
                        <label for="name">Nama</label>
                    </div>
                    <div class="form-floating my-1">
                        <input type="text" class="form-control" id="username" placeholder="Username" name="username"
                            id="username">
                        <label for="username">Username</label>
                    </div>
                    <div class="form-floating my-1">
                        <input type="email" class="form-control" id="email" placeholder="name@example.com" name="email"
                            id="email">
                        <label for="email">Email</label>
                    </div>
                    <div class="form-floating my-1">
                        <input type="no_handphone" class="form-control" id="no_handphone" placeholder="08XXXXXXX"
                            name="no_handphone">
                        <label for="no_handphone">No Handphone</label>
                    </div>
                    <div class="form-floating my-1">
                        <input type="password" class="form-control rounded-bottom" name="password" placeholder="Password"
                            id="password">
                        <label for="password">Password</label>
                    </div>
                    <div class="form-floating">
                        <select class="form-select rounded-bottom" name="user_role" id="user_role">
                            <option>Selected</option>
                            @foreach ($user_role as $role)
                                <option value="{{ $role }}">{{ $role }}</option>
                            @endforeach
                        </select>
                        <label for="user_role">Role</label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" id="close" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" id="saveUser" class="btn btn-primary">Save User</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="modalDetailUser" tabindex="-1" aria-labelledby="modalDetailUserLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalDetailUserLabel"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <ol class="list-group list-group-numbered">
                        <li class="list-group-item">
                            <b><span id="name-detail-title"></span></b> :
                            <span id="name-detail-body"></span>
                        </li>
                        <li class="list-group-item">
                            <b><span id="username-detail-title"></span></b> :
                            <span id="username-detail-body"></span>
                        </li>
                        <li class="list-group-item">
                            <b><span id="email-detail-title"></span></b> :
                            <span id="email-detail-body"></span>
                        </li>
                        <li class="list-group-item">
                            <b><span id="no_handphone-detail-title"></span></b> :
                            <span id="no_handphone-detail-body"></span>
                        </li>
                        <li class="list-group-item">
                            <b><span id="user_role-detail-title"></span></b> :
                            <span id="user_role-detail-body"></span>
                        </li>
                    </ol>
                </div>
                <div class="modal-footer">
                    <button type="button" id="close" class="btn btn-primary" data-bs-toggle="modal"
                        id="modalChangePassButton" data-bs-target="#modalChangePass">Change User Password</button>
                    <button type="button" id="close" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="modalChangePass" tabindex="-1" aria-labelledby="modalChangePassLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-truncate" id="modalChangePassLabel"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="form-errors-pass"></div>
                    <div class="form-floating my-1">
                        <input type="password" class="form-control rounded-bottom" name="change_password"
                            placeholder="Password" id="change_password">
                        <label for="password">Password</label>
                    </div>
                    <div class="form-floating my-1">
                        <input type="password" class="form-control rounded-bottom" name="repeat_password"
                            placeholder="Password" id="repeat_password">
                        <label for="repeat-password">Repeat Password</label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" id="savePassword" class="btn btn-primary">Save User Password</button>
                    <button type="button" id="close-change-pass" class="btn btn-secondary"
                        data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    @push('js')
        <script>
            $(document).ready(function() {
                fetchData();
            })

            $(document).on('click', '#AddUser', function() {
                $('#formAddUserLabel').text('Form Add User');
                $('#saveUser').text('Save User');
                $('#password').removeClass('is-invalid').show();
                clearForm();
            });

            $(document).on('click', '#saveUser', function() {
                $('#password').show();
                if ($(this).text() === 'Save Edit') {
                    update();
                } else {
                    create();
                }
            });

            $(document).on('click', '#savePassword', function() {
                changePassword();
            });

            $(document).on('click', '.detail', function() {
                var username = $(this).attr('id');

                $.ajax({
                    url: "/dashboard/users/" + username,
                    type: 'get',
                    data: {
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(res) {
                        $('#modalDetailUserLabel').text('Detail User ' + res.name);
                        $('#modalChangePassLabel').text('Change Password for ' + res.name);

                        $('#name-detail-title').text("Name");
                        $('#name-detail-body').text(res.name);

                        $('#username-detail-title').text("Username");
                        $('#username-detail-body').text(res.username);

                        $('#email-detail-title').text("Email");
                        $('#email-detail-body').text(res.email);

                        $('#no_handphone-detail-title').text("No Handphone");
                        $('#no_handphone-detail-body').text(res.no_handphone);

                        $('#user_role-detail-title').text("User Role");
                        $('#user_role-detail-body').text(res.user_role);
                    }
                })
            });

            $(document).on('click', '.edit', function() {
                var username = $(this).attr('id');

                $('#AddUser').click();
                $('#password').hide();
                $('#saveUser').text('Save Edit')
                $('#formAddUserLabel').text('Form Edit User');
                $.ajax({
                    url: "/dashboard/users/" + username + "/edit",
                    type: 'get',
                    data: {
                        "_token": "{{ csrf_token() }}"
                    },
                    success: function(res) {
                        $('#name').val(res.name);
                        $('#username-edit').val(res.username);
                        $('#username').val(res.username);
                        $('#email').val(res.email);
                        $('#no_handphone').val(res.no_handphone);
                        $('#user_role').val(res.user_role);
                    }
                })
            });

            $(document).on('click', '.delete', function() {
                var username = $(this).attr('id');
                destroy(username);
            });
        </script>

        <script>
            function clearForm() {
                $('#form-user-errors').hide();
                $('#name').removeClass('is-invalid').val(null);
                $('#username').removeClass('is-invalid').val(null);
                $('#password').removeClass('is-invalid').val(null);
                $('#email').removeClass('is-invalid').val(null);
                $('#no_handphone').removeClass('is-invalid').val(null);
                $('#user_role').removeClass('is-invalid').val('select');
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

        <script>
            //crud function
            function fetchData() {
                $('#tableUser').DataTable({
                    serverside: true,
                    responseive: true,
                    ajax: {
                        url: "/dashboard/fetchuser"
                    },
                    columns: [{
                            "data": null,
                            "sortable": true,
                            render: function(data, type, row, meta) {
                                return meta.row + meta.settings._iDisplayStart + 1
                            }
                        },
                        {
                            data: 'name',
                            name: 'name'
                        },
                        {
                            data: 'username',
                            name: 'username'
                        },
                        {
                            data: 'email',
                            name: 'email'
                        },
                        {
                            data: 'user_role',
                            name: 'user_role'
                        },
                        {
                            data: 'aksi',
                            name: 'aksi'
                        }
                    ]
                })
            }

            function create() {
                $('#user_role').val() == 'select' ? $('#user_role').val(null) : $('#user_role').val();
                $.ajax({
                    url: "{{ route('users.store') }}",
                    type: "post",
                    data: {
                        name: $('#name').val(),
                        username: $('#username').val(),
                        email: $('#email').val(),
                        no_handphone: $('#no_handphone').val(),
                        password: $('#password').val(),
                        user_role: $("#user_role option:selected").text(),
                        "_token": "{{ csrf_token() }}"
                    },
                    success: function(res) {
                        if (res.status == 'success') {
                            $('#close').click();
                            $('#tableUser').DataTable().ajax.reload();
                            clearForm();
                            flashMessage(res.status, res.message);
                        } else if (res.status == 'danger') {
                            var errors = res.message;
                            $('.is-invalid').removeClass('is-invalid');

                            errorsHtml = '<div class="alert alert-danger" id="form-user-errors"><ul>';

                            for (var key in errors) {
                                if (errors.hasOwnProperty(key)) {
                                    errorsHtml += '<li>' + errors[key] + '</li>';

                                    if (key == 'user_role') {
                                        $('#user_role').val('select');
                                    }

                                    $('#' + key).addClass('is-invalid');
                                }
                            }

                            errorsHtml += '</ul></div>';

                            $('#form-errors').html(
                                errorsHtml);
                        }
                    }
                });
            }

            function update() {
                $('#password').hide();
                $('#user_role').val() == 'select' ? $('#user_role').val(null) : $('#user_role').val();
                $.ajax({
                    url: "/dashboard/users/" + $('#username-edit').val(),
                    type: "post",
                    data: {
                        _method: 'put',
                        name: $('#name').val(),
                        username: $('#username').val(),
                        email: $('#email').val(),
                        no_handphone: $('#no_handphone').val(),
                        user_role: $("#user_role option:selected").text(),
                        "_token": "{{ csrf_token() }}"
                    },
                    success: function(res) {
                        if (res.status == 'success') {
                            flashMessage(res.status, res.message);
                            $('#close').click();
                            $('#tableUser').DataTable().ajax.reload();
                            clearForm();
                        } else if (res.status == 'danger') {
                            var errors = res.message;
                            $('.is-invalid').removeClass('is-invalid');

                            errorsHtml = '<div class="alert alert-danger" id="form-user-errors"><ul>';

                            for (var key in errors) {
                                if (errors.hasOwnProperty(key)) {
                                    errorsHtml += '<li>' + errors[key] + '</li>';

                                    if (key == 'user_role') {
                                        $('#user_role').val('select');
                                    }

                                    $('#' + key).addClass('is-invalid');
                                }
                            }

                            errorsHtml += '</ul></div>';

                            $('#form-errors').html(
                                errorsHtml);
                        }
                    }
                });
            }

            function destroy(username) {
                $.ajax({
                    url: "/dashboard/users/" + username,
                    type: 'post',
                    data: {
                        _method: 'delete',
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(res) {
                        flashMessage(res.status, res.message)
                        $('#tableUser').DataTable().ajax.reload()
                    }
                })
            }

            function changePassword() {
                $.ajax({
                    url: "/dashboard/users/" + $('#username-detail-body').text() + "/storePassword",
                    type: "post",
                    data: {
                        password: $('#change_password').val(),
                        "repeat_password": $('#repeat_password').val(),
                        "_token": "{{ csrf_token() }}"
                    },
                    success: function(res) {
                        if (res.status == 'success') {
                            $('#close-change-pass').click();
                            $('#tableUser').DataTable().ajax.reload();
                            clearForm();
                            flashMessage(res.status, res.message);
                        } else if (res.status == 'danger') {
                            var errors = res.message;
                            $('.is-invalid').removeClass('is-invalid');

                            errorsHtml = '<div class="alert alert-danger" id="form-user-errors"><ul>';

                            for (var key in errors) {
                                if (errors.hasOwnProperty(key)) {
                                    if (key == "password") {
                                        $('#change_password').addClass('is-invalid');
                                    }
                                    errorsHtml += '<li>' + errors[key] + '</li>';

                                    $('#' + key).addClass('is-invalid');
                                }
                            }

                            errorsHtml += '</ul></div>';

                            $('#form-errors-pass').html(
                                errorsHtml);
                        }
                    }
                });
            }
        </script>
    @endpush
@endsection
