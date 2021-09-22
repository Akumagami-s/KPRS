@extends('layouts.app', ['title' => 'KPR | Pengajuan Pinjaman'])
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Konfirmasi Pengajuan</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" width="100%">
                                <thead>
                                    <tr>
                                        <th class="text-left">#</th>
                                        <th class="text-left">Status</th>
                                        <th class="text-left">Nama</th>
                                        <th class="text-left">Pangkat</th>
                                        <th class="text-left">NRP</th>
                                        <th class="text-left">Kesatuan</th>
                                        <th class="text-left">Pinjaman</th>
                                        <th class="text-left">Jangka Waktu</th>
                                        <th class="text-left">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Container-fluid Ends-->
    </div>
@endsection
@push('script')
    <script>
        function confirmationUser(id) {
            Swal.fire({
                title: 'Apakah Anda Yakin!',
                text: "Konfirmasi user ini untuk pengajuan?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, konfirmasi!'
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: "Sedang konfirmasi pengajuan...",
                        showConfirmButton: false,
                        timer: 2300,
                        timerProgressBar: true,
                        onOpen: () => {
                            document.getElementById(`ConfirmationUser${id}`).submit();
                            Swal.showLoading();
                        }
                    });
                }
            })
        }
    </script>
@endpush

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
        const dataUrl = '{{ route('admin.pengajuan.index') }}'

        jQuery(function($) {
            const table = $("table").DataTable({
                responsive: true,
                serverSide: true,
                processing: true,
                ordering: false,
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
                        data: "status"
                    },
                    {
                        data: "nama"
                    },
                    {
                        data: "pangkat"
                    },
                    {
                        data: "nrp"
                    },
                    {
                        data: "kesatuan"
                    },
                    {
                        data: "pinjaman"
                    },
                    {
                        data: "jk_waktu"
                    },
                    {
                        data: "aksi"
                    },
                ],
            });

            const reload = () => table.ajax.reload();

            $('.dataTable').wrap('<div class="dataTables_scroll" />');
        });
    </script>
@endpush
