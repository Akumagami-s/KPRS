@extends('layouts.app', ['title' => 'KPR | Pinjaman Approve' ])
@section('dashboard', 'DATA KPR')
@section('content')

    <div class="row">
        <div class="col-md-12">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <a class="nav-link active text-primary" id="lunas-tab" data-toggle="tab" href="#lunas" role="tab"
                        aria-controls="lunas" aria-selected="true">Lunas</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link text-primary" id="meninggal-tab" data-toggle="tab" href="#meninggal" role="tab"
                        aria-controls="meninggal" aria-selected="false">Meninggal</a>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="lunas" role="tabpanel" aria-labelledby="lunas-tab">
                    <div class="card">
                        <div class="card-header">
                            <h5>Data Pinjaman <span class="badge badge-success">Lunas</span></h5>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover table-bordered" id="table-lunas" width="100%">
                                    <thead>
                                        <tr>
                                            <th>No</th>
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
                <div class="tab-pane fade" id="meninggal" role="tabpanel" aria-labelledby="meninggal-tab">
                    <div class="card">
                        <div class="card-header b-l-primary border-3">
                            <h5>Data Pinjaman <span class="badge badge-secondary">Meninggal</span></h5>
                            <div class="d-flex justify-content-end pt-1">
                                <div class="input-group">

                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover table-bordered" id="table-meninggal" width="100%">
                                    <thead>
                                        <tr>
                                            <th>No</th>
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
            const tableLunas = $("#table-lunas").DataTable({
                responsive: true,
                serverSide: true,
                processing: true,
                ordering: false,
                ajax: {
                    url: dataUrl,
                    type: "post",
                    data: {
                        status: '4',
                        _token: csrf,
                    },
                    error: response => console.log(response),
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

            const tableMeninggal = $("#table-meninggal").DataTable({
                responsive: true,
                serverSide: true,
                processing: true,
                ordering: false,
                ajax: {
                    url: dataUrl,
                    type: "post",
                    data: {
                        status: '5',
                        _token: csrf,
                    },
                    error: response => console.log(response),
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

            const reloadLunas = () => tableLunas.ajax.reload();
            const reloadMeninggal = () => tableMeninggal.ajax.reload();

            $("#lunas-tab").click(function() {
                reloadLunas();
            });
            $("#meninggal-tab").click(function() {
                reloadMeninggal();
            });

            $('.dataTable').wrap('<div class="dataTables_scroll" />');
        });
    </script>
@endpush
