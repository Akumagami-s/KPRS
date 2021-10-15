@extends('layouts.app', ['title' => 'KPR | Pinjaman Approve' ])
@section('dashboard', 'DATA KPR')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header b-l-primary border-3">
                    <h5>Data Pinjaman <span class="badge badge-secondary">BTN</span></h5>
                    <div class="d-flex justify-content-end pt-1">
                        <div class="input-group">

                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered" width="100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Update</th>
                                    <th>NRP</th>
                                    <th>Nama</th>
                                    <th>Pangkat</th>
                                    <th>Kesatuan</th>
                                    <th>Kotama</th>
                                    <th>Tahap</th>
                                    <th>Pinjaman</th>
                                    <th>Jangka Waktu</th>
                                    <th>TMT Angsuran</th>
                                    <th>Jumlah angsuran</th>
                                    <th>Angsuran ke</th>
                                    <th>Angsuran Masuk</th>
                                    <th>Tunggakan</th>
                                    <th>Jml Tunggakan</th>
                                    <th>Ket.</th>
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
        const pinjam = '{{ request()->pinjam }}'
        const dataUrl = '{{ route('admin.detaildata.datatables', request()->pinjam) }}'
        const csrf = '{{ csrf_token() }}'

        jQuery(function($) {
            const table = $("table").DataTable({
                responsive: true,
                serverSide: true,
                processing: true,
                ordering: false,
                ajax: {
                    url: dataUrl,
                    type: "post",
                    data: {
                        _token: csrf
                    },
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
                        data: "update"
                    },
                    {
                        data: "nrp"
                    },
                    {
                        data: "nama"
                    },
                    {
                        data: "pangkat"
                    },
                    {
                        data: "kesatuan"
                    },
                    {
                        data: "kotama"
                    },
                    {
                        data: "tahap"
                    },
                    {
                        data: "pinjaman"
                    },
                    {
                        data: "jk_waktu"
                    },
                    {
                        data: "tmt_angsuran"
                    },
                    {
                        data: "jml_angs"
                    },
                    {
                        data: "angs_ke"
                    },
                    {
                        data: "angsuran_masuk"
                    },
                    {
                        data: "tunggakan"
                    },
                    {
                        data: "jml_tunggakan"
                    },
                    {
                        data: "keterangan"
                    },
                ],
            });

            const reload = () => table.ajax.reload();

            $('.dataTable').wrap('<div class="dataTables_scroll" />');
        });
    </script>
@endpush
