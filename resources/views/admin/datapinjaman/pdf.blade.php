<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bukti Angsuran KPR Swakelola BP TWP AD | {{ $kpr->pangkat }} {{ $kpr->nama }} </title>

    <link rel=”stylesheet” href=”https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css” />
</head>
<style>
    .footer {
        position: fixed;
        left: 0;
        bottom: 0;
        width: 100%;
        text-align: center;
    }

</style>

<body>

    <div class="container-fluid">
        <div class="container-fluid">
            <div class="d-flex justify-content-start">
                <div class="col-md-2">
                    <img src="{{ asset('assets/images/logo/tni.png') }}" alt=""
                        style="width: 100px; object-fit: cover">
                </div>
                <div class="col-md-1" style="text-align: center;margin-top : -150px">
                    <strong>
                        <font color="#232a31">PT. Bank Tabungan Negara Persero (Tbk.)</font>
                    </strong>
                    <br>
                    </br>
                    <br style="margin : 0px;">
                    <font color="#232a31">Menara Bank BTN Jl. Gajah Mada No. 1, Jakarta 10130</font> </br>
                    <br style="margin : 0px;">
                    <font color="#232a31">Telp/Fax : 021 633 6789 / 021 633 6719 </font> </br>
                    <br style="margin : 0px;">
                    <font color="#232a31">Contact Center : 1500 286 </font> </br>
                    <p style="margin : 0px;">
                        <font color="#232a31">E-mail : btncontactcenter@btn.co.id, cc : nsld@btn.co.id </font>
                    </p>
                    <br></br>
                    <strong>
                        <font color="#232a31">KPR BTN TNI AD dan KPR BTN TNI AD Take Over Swakelola
                        </font>
                        <br>
                        <font color="#232a31">
                            Kerjasama antara Bank BTN dan TNI AD
                        </font>
                    </strong>
                </div>
                <div class="col-md-2" style="margin-left : 550px;margin-top: -130px">
                    <img src="{{ asset('assets/images/logo/btn.jpg') }}" alt=""
                        style="width: 150px; object-fit: cover;">
                </div>
            </div>
        </div>
        <hr style="margin-top: 50px;">
        <div class="row">
            <div class="col-md-6">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <tr>
                            <td>
                                <font color="#232a31">Nama
                            </td>
                            <td>
                                <font color="#232a31">:
                            </td>
                            <td>
                                <font color="#232a31">{{ $kpr->nama }}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <font color="#232a31">Pangkat
                            </td>
                            <td>
                                <font color="#232a31">:
                            </td>
                            <td>
                                <font color="#232a31">{{ $kpr->pangkat }}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <font color="#232a31">NRP
                            </td>
                            <td>
                                <font color="#232a31">:
                            </td>
                            <td>
                                <font color="#232a31">{{ $kpr->nrp }}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <font color="#232a31">Kesatuan
                            </td>
                            <td>
                                <font color="#232a31">:
                            </td>
                            <td>
                                <font color="#232a31">{{ $kpr->kesatuan }}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <font color="#232a31">Pinjaman
                            </td>
                            <td>
                                <font color="#232a31">:
                            </td>
                            <td>
                                <font color="#232a31">{{ 'Rp. ' . number_format($kpr->pinjaman, 0, ',', '.') }}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <font color="#232a31">Jangka Waktu
                            </td>
                            <td>
                                <font color="#232a31">:
                            </td>
                            <td>
                                <font color="#232a31">{{ $kpr->jk_waktu }}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <font color="#232a31">Bulan angsuran
                            </td>
                            <td>
                                <font color="#232a31">:
                            </td>
                            <td>
                                <font color="#232a31">{{ $kpr->tmt_angsuran }}
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <font color="#232a31">Tahap
                            </td>
                            <td>
                                <font color="#232a31">:
                            </td>
                            <td>
                                <font color="#232a31">{{ $kpr->tahap }}
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <font color="#232a31">Jumlah angsuran
                            </td>
                            <td>
                                <font color="#232a31">:
                            </td>
                            <td>
                                <font color="#232a31">{{ 'Rp. ' . number_format($kpr->jml_angs, 0, ',', '.') }}
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <font color="#232a31">angsuran ke
                            </td>
                            <td>
                                <font color="#232a31">:
                            </td>
                            <td>
                                <font color="#232a31">{{ $kpr->angs_ke }}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <font color="#232a31">Angsuran masuk
                            </td>
                            <td>
                                <font color="#232a31">:
                            </td>
                            <td>
                                <font color="#232a31">{{ $kpr->angsuran_masuk }}
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <font color="#232a31">Tunggakan
                            </td>
                            <td>
                                <font color="#232a31">:
                            </td>
                            <td>
                                <font color="#232a31">{{ $kpr->tunggakan }}
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <font color="#232a31">Jumlah tunggakan
                            </td>
                            <td>
                                <font color="#232a31">:
                            </td>
                            <td>
                                <font color="#232a31">{{ 'Rp. ' . number_format($kpr->jml_tunggakan, 0, ',', '.') }}
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <font color="#232a31">Keterangan
                            </td>
                            <td>
                                <font color="#232a31">:
                            </td>
                            <td>
                                <font color="#232a31">{{ $kpr->keterangan }}
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <font color="#232a31">Sisa Pinjaman Pokok
                            </td>
                            <td>
                                <font color="#232a31">:
                            </td>
                            <td>
                                <font color="#232a31">Rp. {{ number_format(round(end($all['pinjaman']))) }}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <font color="#232a31">status
                            </td>
                            <td>
                                <font color="#232a31">:
                            </td>
                            <td>
                                <font color="#232a31">{{ $kpr->status }}
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <font color="#232a31">
                                    <font color="#232a31">Total Pokok
                            </td>
                            <td>
                                <font color="#232a31">:
                            </td>
                            <td>
                                <font color="#232a31">{{ 'Rp. ' . number_format($total_pokok_saldo, 0, ',', '.') }}
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <font color="#232a31">Total Bunga
                            </td>
                            <td>
                                <font color="#232a31">:
                            </td>
                            <td>
                                <font color="#232a31">{{ 'Rp. ' . number_format($total_bunga_saldo, 0, ',', '.') }}
                            </td>
                        </tr>
                        <tr>
                            <td>Total Transaksi Mass Debet</td>
                            <td>:</td>
                            <td>{{ $massdebat }}</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>Total Transaksi Manual</td>
                            <td>:</td>
                            <td>{{ $kpr->angs_masuk_manual }}</td>
                            <td></td>
                        </tr>

                        <tr>
                            <td>
                                <font color="#232a31">Piutang Pokok
                            </td>
                            <td>
                                <font color="#232a31">:
                            </td>
                            <td>
                                <font color="#232a31">{{ 'Rp. ' . number_format($total_pokok_piutang, 0, ',', '.') }}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <font color="#232a31">Piutang Bunga
                            </td>
                            <td>
                                <font color="#232a31">:
                            </td>
                            <td>
                                <font color="#232a31">{{ 'Rp. ' . number_format($total_bunga_piutang, 0, ',', '.') }}
                            </td>
                        </tr>
                    </table>
                </div>

            </div>
            <div class="col-md-12">
                <div class="table-responsive">
                    <table border="1" width="100%" cellspacing="0" cellpadding="10" class="table table-striped">
                        <tr>
                            <th class="text-center">No</th>
                            <th class="text-center">Tanggal</th>
                            <th class="text-center">Jumlah</th>
                            <th class="text-center">Keterangan</th>
                        </tr>
                        @php
                            $ceks = 0;
                            $date = 0;
                            $id = 1;
                        @endphp
                        @foreach ($transaksi as $item)
                            @php
                                $date = date('m Y', strtotime($item->tanggal));
                            @endphp
                            @if ($date != $ceks || $item->status != '0001')
                                <tr>
                                    <td>{{ $id }}</td>
                                    <td>{{ $item->tanggal }}</td>
                                    <td>{{ 'Rp. ' . number_format($jumlah->jml_angs, 0, ',', '.') }}</td>
                                    @if ($item->status == '0001')
                                        <td>Transaction Successful</td>
                                    @endif
                                    @if ($item->status != '0001')
                                        <td>Saldo Tidak Cukup</td>
                                    @endif
                                </tr>
                                @php
                                    $id++;
                                @endphp
                            @endif
                            @php
                                $ceks = date('m Y', strtotime($item->tanggal));
                            @endphp
                        @endforeach
                    </table>
                </div>
            </div>
            <!--<div class="col-md-12">
                <div class="table-responsive">
                    <table border="1" width="100%" cellspacing="0" cellpadding="10" class="table table-striped">
                        <tr>
                            <th><font color="#232a31">Angsuran ke</th>
                            <th><font color="#232a31">Pokok</th>
                            <th><font color="#232a31">Bunga</th>
                            <th><font color="#232a31">Besar Angsuran</th>
                            <th><font color="#232a31">Sisa Pinjaman Pokok</th>
                        </tr>
                        @php
                            $no = 0;
                        @endphp
                        @foreach ($all['bunga'] as $index => $value)
                        <tr>
                            <td style="text-align : right;"><font color="#232a31">{{ $no++ }}</td>
                            <td style="text-align : right;"><font color="#232a31">{{ number_format(round($all['pokok'][$index])) }}</td>
                            <td style="text-align : right;"><font color="#232a31">{{ number_format(round($all['bunga'][$index])) }}</td>
                            <td style="text-align: right;"><font color="#232a31">{{ number_format($all['besar_angsuran'][$index]) }}</td>
                            <td style="text-align : right;"><font color="#232a31">{{ number_format(round($all['pinjaman'][$index])) }}</td>
                        </tr>
                        @endforeach
                    </table>
                </div>
            </div>-->
        </div>
    </div>
    <footer class="footer">
        <hr>
        <strong>
            <font color="#232a31">Print : {{ $tanggal }}
        </strong>
    </footer>
    <script src=”https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js”></script>
    <script src=”https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js”></script>
</body>

</html>
