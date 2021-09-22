@extends('layouts.app', ['title' => 'KPR | Verif User Account'])
@section('dashboard', 'KELOLA ACCOUNT')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5>Verifikasi Akun User
                        <div class="float-right">
                            <button class="btn btn-info" id="reload-data" title="Refresh Data"><i
                                    class="fa fa-refresh"></i></button>
                        </div>
                    </h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover" width="100%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Role</th>
                                    <th>Avatar</th>
                                    <th>Name</th>
                                    <th>E-Mail</th>
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
@endsection

@push('style')
    <link rel="stylesheet" href="{{ asset('assets/js/datatable/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}">
    <style>
        .dataTables_scroll {
            overflow: auto;
        }

    </style>
@endpush

@push('datatable')
    <script src="{{ asset('assets/js/datatable/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/js/datatable/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script>
        const dataUrl = '{{ route('admin.account.verifikasi') }}'

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
                        data: "role"
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
