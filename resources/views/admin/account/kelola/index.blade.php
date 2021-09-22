@extends('layouts.app', ['title' => 'KPR | Kelola Account'])
@section('dashboard', 'KELOLA ACCOUNT')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="justify-content-between">
                        <button class="btn btn-info" id="reload-data"><i class="fa fa-refresh"></i></button>
                        {{-- <form action="{{ route('admin.account.search.pengelola') }}" method="GET">
                        @csrf
                        <div class="d-flex justify-content-end">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="input-group">
                                        <input class="form-control" id="validationTooltip02" type="search" name="query" placeholder="Search" required="">
                                        <div class="valid-tooltip">Looks good!</div>
                                        <button class="btn btn-secondary ml-2">Search</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form> --}}
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover" width="100%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Avatar</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>NRP</th>
                                    <th>Password</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- add data modal --}}
    <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel2">Add New Account</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">×</span></button>
                </div>
                <form action="{{ route('admin.account.register.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-form-label" for="avatar">Image (Nullable):</label>
                                    <input class="form-control" type="file" name="avatar" id="avatar">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-form-label" for="name">Name:</label>
                                    <input class="form-control" type="text" name="name" id="name" placeholder="your name"
                                        required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-form-label" for="email">E-Mail:</label>
                                    <input class="form-control" type="email" name="email" id="email"
                                        placeholder="your email" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-form-label" for="role">Role:</label>
                                    <select name="role" id="role" class="form-control custom-select" required>
                                        <option disabled selected>Select Role</option>
                                        <option value="admin">Admin</option>
                                        <option value="customer">Customer</option>
                                        <option value="boss">Boss</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-form-label" for="username">Username:</label>
                                    <input class="form-control" type="text" name="username" id="username"
                                        placeholder="username" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-form-label" for="password">Password:</label>
                                    <input class="form-control" type="password" name="password" id="password"
                                        placeholder="********" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-light for-light" type="button" data-dismiss="modal">Close</button>
                        <button class="btn btn-secondary for-dark" type="button" data-dismiss="modal">Close</button>
                        <button class="btn btn-primary" type="submit">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection


@push('style')
    <link rel="stylesheet" href="{{ asset('assets/js/datatable/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}">
    <style>
        .dataTables_scroll {
            overflow: auto;
        }

    </style>
@endpush

@push('script')
    <script>
        function deleteUser(id) {
            Swal.fire({
                title: 'Apakah Anda Yakin?',
                text: "Anda tidak akan bisa mengembalikan data!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, hapus ini!'
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: "Sedang menghapus User",
                        showConfirmButton: false,
                        timer: 2300,
                        timerProgressBar: true,
                        onOpen: () => {
                            document.getElementById(`DeleteUser${id}`).submit();
                            Swal.showLoading();
                        }
                    });
                }
            })
        }
    </script>
@endpush

@push('datatable')
    <script src="{{ asset('assets/js/datatable/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/js/datatable/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script>
        const dataUrl = '{{ route('admin.account.pengelola') }}'
        const csrf = '{{ csrf_token() }}'

        jQuery(function($) {
            const table = $("table").DataTable({
                responsive: true,
                serverSide: true,
                processing: true,
                ajax: {
                    url: dataUrl,
                    type: "get",
                    error: (response) => {
                        console.log(response);
                    },
                },
                searching: true,
                columns: [{
                        data: null,
                        sortable: false,
                        searchable: false,
                        render: function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        },
                    },
                    {
                        data: "avatar",
                        sortable: null,
                        searchable: null
                    },
                    {
                        data: "name"
                    },
                    {
                        data: "email"
                    },
                    {
                        data: "nrp"
                    },
                    {
                        data: "password",
                        sortable: null,
                        searchable: null
                    },
                    {
                        data: "action",
                        sortable: false,
                        searchable: false,
                    },
                ],
            });

            const reload = () => table.ajax.reload();

            $('.dataTable').wrap('<div class="dataTables_scroll" />');

            $("#reload-data").click(function() {
                reload()
            })
        });
    </script>
@endpush
