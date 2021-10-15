@extends('layouts.basekpr')
@section('content')

    <style>
        .borderless td,
        .borderless th {
            border: none;
        }

    </style>


    <div class="mainContent">
        <div class="wrapperDetailProperti">
            <div class="wrapperImagesProperti">

                <div class="card">

                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <table class="table borderless mb-3">
                                    <tbody>
                                        <tr>
                                            <td>Nama</td>
                                            <td>:</td>
                                            <td>{{ $kpr->nama }}</td>

                                        </tr>
                                        <tr>
                                            <td>NRP</td>
                                            <td>:</td>
                                            <td>{{ $kpr->nrp }}</td>

                                        </tr>
                                        <tr>
                                            <td>No Rekening</td>
                                            <td>:</td>
                                            <td>{{ $kpr->rekening }}</td>

                                        </tr>
                                        <tr>
                                            <td>Nama Bank</td>
                                            <td>:</td>
                                            <td>{{ $kpr->nama_bank }}</td>
                                        </tr>

                                        <tr>
                                            <td>TMT Angsuran</td>
                                            <td>:</td>
                                            <td>{{ $kpr->tmt_angsuran }}</td>
                                        </tr>
                                        <tr>
                                            <td>Jumlah Pinjaman</td>
                                            <td>:</td>
                                            <td>Rp. {{number_format($kpr->pinjaman, 2, ',', '.')}}</td>
                                        </tr>
                                        <tr>
                                            <td>Jumlah Angsuran</td>
                                            <td>:</td>
                                            <td>Rp. {{number_format($kpr->jml_angs, 2, ',', '.')}}</td>
                                        </tr>
                                        {{-- <tr>
                                        <td>NRP</td>
                                        <td>:</td>
                                        <td>{{ $kpr->nrp }}</td>
                                    </tr> --}}
                                        @if ($kpr->status == 4)
                                            <tr>
                                                <td>Status</td>
                                                <td>:</td>
                                                <td>Lunas</td>
                                            </tr>
                                        @elseif($kpr->status == 5)
                                            <tr>
                                                <td>Status</td>
                                                <td>:</td>
                                                <td>Meninggal</td>
                                            </tr>
                                        @endif
                                        <tr>
                                            <td></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            @if ($kpr->status != 4 && $kpr->status != 5)
                                <!--<div class="col-md-6">-->
                                <!--    <a type="button" href="#" onclick="document.getElementById('lunas').submit();" class="btn btn-primary">Lunas</a>-->
                                <!--    <a type="button" href="#" onclick="document.getElementById('meninggal').submit();" class="btn btn-danger">Meninggal</a>-->
                                <!--</div>-->
                                <form id="meninggal" class="d-none" action="" method="POST">
                                    @csrf
                                </form>
                                <form id="lunas" class="d-none" action="" method="POST">
                                    @csrf
                                </form>
                                <div class="col-md-12">
                                    @if (session()->has('error_update'))
                                        <span>{{ session('error_update') }}</span>
                                    @endif
                                    <form id="form" action="{{ route('sandbox.bayarPost') }}" method="POST">
                                        @csrf
                                        <div class="table-responsive">

                                            <table class="table table-bordered">
                                                <tr class="text-center">
                                                    <th rowspan="2">TAHUN</th>
                                                    <th colspan="12">BULAN ANGSURAN</th>
                                                </tr>
                                                <tr class="text-center">
                                                    <th>JAN</th>
                                                    <th>FEB</th>
                                                    <th>MAR</th>
                                                    <th>APR</th>
                                                    <th>MEI</th>
                                                    <th>JUN</th>
                                                    <th>JUL</th>
                                                    <th>AGS</th>
                                                    <th>SEPT</th>
                                                    <th>OKT</th>
                                                    <th>NOP</th>
                                                    <th>DES</th>
                                                </tr>


                                                @for ($i = 0; $i < count($years); $i++)
                                                    <tr class="text-center">
                                                        <td>{{ $years[$i] }}</td>
                                                        @for ($j = 1; $j <= 12; $j++)
                                                            <td>
                                                                @if ($j < 10)
                                                                @if (date($years[$i].'-'.'0'.$j) >= date("Y-m", strtotime($kpr->tmt_angsuran)) && date($years[$i].'-'.'0'.$j) <= $akhir)

                                                                @if (in_array($years[$i].'-'.$j,$trx))

                                                                <input type="checkbox" class="check" checked disabled>
                                                                @else
                                                                <input type="checkbox" class="check" name="data[{{ $years[$i] }}][]" id="{{ $j }}" value="{{ $j }}" data-date="{{ $j . '/' . $years[$i] }}" disabled>

                                                                @endif
                                                                @endif

                                                                @else
                                                                @if (date($years[$i].'-'.$j) >= date("Y-m", strtotime($kpr->tmt_angsuran)) && date($years[$i].'-'.$j) <= $akhir)

                                                                @if (in_array($years[$i].'-'.$j,$trx))

                                                                <input type="checkbox" class="check" checked disabled>
                                                                @else
                                                                <input type="checkbox" class="check" name="data[{{ $years[$i] }}][]" id="{{ $j }}" value="{{ $j }}" data-date="{{ $j . '/' . $years[$i] }}" disabled>

                                                                @endif
                                                                @endif


                                                                @endif


                                </td>
                                @endfor
                                </tr>
                                @endfor
                                </table>


                            </div>

                            </form>

                            <div class="text-right mt-5">
                                {{-- <button id="btn-submit" class=" btn btn-primary">Bayar </button> --}}
                            </div>
                        </div>
                        @endif
                    </div>

                </div>
            </div>

        </div>
        </div>
        </div>
    @endsection



    @section('js')

        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>


        <script>
            var norek = @json($kpr->rekening);
            var besar_angsuran = @json($besar_angsuran);
            $('#btn-submit').on('click', function(e) {

                e.preventDefault();

                var form = $('#form');
                const swalWithBootstrapButtons = Swal.mixin({
                    customClass: {
                        confirmButton: 'btn btn-success',
                        cancelButton: 'btn btn-danger'
                    },
                    buttonsStyling: true
                })

                var arr = [];
                $('input.check:checkbox:checked').each(function() {
                    arr.push($(this).attr('data-date'));
                });

                var textnya = "Kamu akan membayar pinjaman :";
                var jml = 0;
                for (let i = 0; i < arr.length; i++) {
                    if (arr[i] != null) {
                        textnya += "<br> " + arr[i];
                        jml++;
                    }

                }
                textnya += "<br><br> dengan no rekening :" + norek;
                textnya += "<br> Total : " + besar_angsuran * jml;



                swalWithBootstrapButtons.fire({
                    title: 'Apakah anda yakin ?',

                    icon: 'warning',
                    html: textnya,
                    showCancelButton: true,
                    confirmButtonText: 'Ya lanjutkan!',
                    cancelButtonText: 'Tidak , batalkan!',
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Terkirim...',
                            showConfirmButton: false,
                            timer: 2000,
                            text: 'Pembayaran anda sedang diproses !',

                        })

                        setTimeout(function() {
                            form.submit();
                        }, 3000);
                    } else if (
                        /* Read more about handling dismissals below */
                        result.dismiss === Swal.DismissReason.cancel
                    ) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            showConfirmButton: false,
                            timer: 2000,
                            text: 'Pembayaran anda gagal !',

                        })
                    }
                })
            });
        </script>
    @endsection
