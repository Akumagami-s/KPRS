@extends('layouts.app', ['title' => 'KPR | Data Bulanan' ])
@section('dashboard', 'DATA Bulanan')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header b-l-primary border-3">
                    <h5>Data Bulanan</h5>

                    <div class="d-flex justify-content-end pt-4">
                        <div class="input-group">

                        </div>
                    </div>
                </div>
                <div class="pull-right">
                    <a onclick="getAlert();" class="btn btn-primary" href="{{ route('admin.detaildata.RekapBulanan', ['bulan'=>$_GET['month'], 'tahun'=>$_GET['year']]) }}">Expot</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered" width="100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Pangkat</th>
                                    <th>NRP</th>
                                    <th>Kesatuan</th>
                                    <th>Kotama</th>
                                    <th>Tahap</th>
                                    <th>Pinjaman</th>
                                    <th>Jangka waktu</th>
                                    <th>TMT Angsuran</th>
                                    <th>Jml angsuran</th>
                                    <th>Angsuran ke</th>
                                    <th>Angsuran masuk</th>
                                    <th>Tunggakan</th>
                                    <th>Jml tunggakan</th>
                                    <th>tunggakan Pokok</th>
                                    <th>tunggakan Bunga</th>
                                    <th>Ket.</th>
                                    <th>Rekening</th>
                                    <th>Rek.BRI</th>
                                    <th>Rek.BTN</th>
                                    <th>Bunga</th>
                                    <th>Pokok</th>
                                    <th>Sisa Pinjaman Pokok</th>
                                    <th>Inisial Bunga</th>
                                    <th>Inisial Pokok</th>
                                    <th>Hutang Pokok</th>
                                    <th>Hutang Bunga</th>
                                    <th>Outstanding</th>
                                </tr>
                            </thead>
                            <tbody>
                                @include('sweetalert::alert')
                            </tbody>
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
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('assets/js/datatable/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/js/datatable/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script>
        const search = '{{ request()->search}}'
        const dataUrl = '{{ route('admin.detaildata.carirekap') }}'
        const csrf = '{{ csrf_token() }}'

        var bulan = @json($_GET['month']);
        var tahun = @json($_GET['year']);


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

                        _token: csrf,
                        bulan : bulan,
                        tahun : tahun
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
                        data: "tunggakan_pokok"
                    },
                    {
                        data: "tunggakan_bunga"
                    },
                    {
                        data: "keterangan"
                    },
                    {
                        data: "rekening"
                    },
                    {
                        data: "rek_bri"
                    },
                    {
                        data: "rek_btn"
                    },
                    {
                        data: "bunga"
                    },
                    {
                        data: "pokok"
                    },
                    {
                        data: "sisa_pinjaman_pokok"
                    },
                    {
                        data: "inisial_bunga"
                    },
                    {
                        data: "inisial_pokok"
                    },
                    {
                        data: "piutang_pokok"
                    },
                    {
                        data: "piutang_bunga"
                    },
                    {
                        data: "outstanding"
                    },
                ],
            });

            const reload = () => table.ajax.reload();

            $('.dataTable').wrap('<div class="dataTables_scroll" />');
        });
    </script>
    <script src="https://cdn.jsdelivr.net/sweetalert2/5.3.8/sweetalert2.js"></script>
    <script>
        function getAlert(){
            {
               Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: 'Sedang Mengunduh File Excel',
                showConfirmButton: false,
                timer: 17000
                })
            }
        }
            //             const showLoading = function() {
                //   swal({
                    //     title: 'Now loading',
//     allowEscapeKey: false,
//     allowOutsideClick: false,
//     timer: 2000,
//     onOpen: () => {
//       swal.showLoading();
//     }
//   }).then(
//     () => {},
//     (dismiss) => {
//       if (dismiss === 'timer') {
//         console.log('closed by timer!!!!');
//         swal({
//           title: 'Finished!',
//           type: 'success',
//           timer: 2000,
//           showConfirmButton: false
//         })
//       }
//     }
//   )
// };
//         }
//showLoading();

// document.getElementById("fire")
//   .addEventListener('click', (event) => {
//     showLoading();
//   });
    </script>
@endpush
