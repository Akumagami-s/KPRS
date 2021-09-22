@extends('layouts.app', ['title' => 'KPR | Pinjaman Approve' ])
@section('content')
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-md-12">
                    <form action="{{ route('admin.detaildata.history', $kpr->nrp) }}" method="get">
                        <a href="{{ route('admin.detaildata.pinjam', 'approve') }}" class="btn btn-danger">Back</a>
                        <a href="{{ route('admin.detaildata.approve.pdf', $kpr->id) }}" class="btn btn-danger"
                            target="_blank">DOWNLOAD <i class="fa fa-print"></i></a>
                        <input type="hidden" name="kpr_id" value="{{ $kpr->id }}">
                        <button type="submit" class="btn btn-danger mt-1">Riwayat Transaksi <i
                                class="fa fa-history"></i></button>
                    </form>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <tr>
                                <td>Nama</td>
                                <td>:</td>
                                <td colspan="2">{{ $kpr->nama }}</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>Pangkat</td>
                                <td>:</td>
                                <td colspan="2">{{ $kpr->pangkat }}</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>NRP</td>
                                <td>:</td>
                                <td>{{ $kpr->nrp }}</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>Kesatuan</td>
                                <td>:</td>
                                <td>{{ $kpr->kesatuan }}</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>Kotama</td>
                                <td>:</td>
                                <td>{{ $kpr->kotama }}</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>Alamat</td>
                                <td>:</td>
                                <td>{{ $kpr->alamat }}</td>
                                <td></td>
                            </tr>
                            @if ($kpr->status == 3)
                                <tr>
                                    <td>No Rekening</td>
                                    <td>:</td>
                                    <td>{{ $kpr->rek_btn }}</td>
                                    <td></td>
                                </tr>
                            @else
                                <tr>
                                    <td>No Rekening</td>
                                    <td>:</td>
                                    <td>{{ $kpr->rek_bri }}</td>
                                    <td></td>
                                </tr>
                            @endif

                            <tr>
                                <td>Nama Bank</td>
                                <td>:</td>
                                <td>{{ $kpr->nama_bank }}</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>Tahap</td>
                                <td>:</td>
                                <td>{{ $kpr->tahap }}</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>Pinjaman</td>
                                <td>:</td>
                                <td>{{ 'Rp. ' . number_format($kpr->pinjaman, 0, ',', '.') }}</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>Jangka Waktu</td>
                                <td>:</td>
                                <td>{{ $kpr->jk_waktu }}</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>Bulan angsuran</td>
                                <td>:</td>
                                <td>{{ $kpr->tmt_angsuran }}</td>
                                <td></td>
                            </tr>


                            <tr>
                                <td>Jumlah angsuran</td>
                                <td>:</td>
                                <td>{{ 'Rp. ' . number_format($kpr->jml_angs, 0, ',', '.') }}</td>
                                <td></td>
                            </tr>

                            <tr>
                                <td>angsuran ke</td>
                                <td>:</td>
                                <td>{{ $kpr->angs_ke }}</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>Angsuran masuk</td>
                                <td>:</td>
                                <td>{{ $kpr->angsuran_masuk }}</td>
                                <td></td>
                            </tr>

                            <tr>
                                <td>Tunggakan</td>
                                <td>:</td>
                                <td>{{ $kpr->tunggakan }}</td>
                                <td></td>
                            </tr>

                            <tr>
                                <td>Jumlah Tunggakan</td>
                                <td>:</td>
                                <td>{{ 'Rp. ' . number_format($kpr->jml_tunggakan, 0, ',', '.') }}</td>
                                <td></td>
                            </tr>

                            <tr>
                                <td>Keterangan</td>
                                <td>:</td>
                                <td>{{ $kpr->keterangan }}</td>
                                <td></td>
                            </tr>

                            <tr>
                                <td>Piutang Pokok</td>
                                <td>:</td>
                                <td>{{ 'Rp. ' . number_format($total_pokok_piutang, 0, ',', '.') }}</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>Tunggakan Bunga</td>
                                <td>:</td>
                                <td>{{ 'Rp. ' . number_format($tunggakan_bunga, 0, ',', '.') }}</td>
                                <td></td>
                            </tr>
                            <!--<tr>
                                <td>Penerimaan Pokok</td>
                                <td>:</td>
                                <td>{{ 'Rp. ' . number_format($total_pokok_saldo, 0, ',', '.') }}</td>
                                <td></td>
                            </tr>

                            <tr>
                                <td>Penerimaan Bunga</td>
                                <td>:</td>
                                <td>{{ 'Rp. ' . number_format($total_bunga_saldo, 0, ',', '.') }}</td>
                                <td></td>
                            </tr>-->

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
                            <!--<tr>-->
                            <!--    <td>Tunggakan Bunga</td>-->
                            <!--    <td>:</td>-->
                            <!--    <td>RP. {{ number_format($kpr->tunggakan_bunga, 0, ',', '.') }}</td>-->
                            <!--    <td></td>-->
                            <!--</tr>-->
                            <!--<tr>-->
                            <!--    <td>Outstanding</td>-->
                            <!--    <td>:</td>-->
                            <!--    <td>Rp. {{ number_format($kpr->piutang_pokok + $kpr->tunggakan_bunga, 0, ',', '.') }}</td>-->
                            <!--    <td></td>-->
                            <!--</tr>-->
                            <!--<tr>-->
                            <!--    <td>Piutang Pokok</td>-->
                            <!--    <td>:</td>-->
                            <!--    <td>{{ 'Rp. ' . number_format($total_pokok_piutang, 0, ',', '.') }}</td>-->
                            <!--    <td></td>-->
                            <!--</tr>-->
                            <!--<tr>-->
                            <!--    <td>Piutang Bunga</td>-->
                            <!--    <td>:</td>-->
                            <!--    <td>{{ 'Rp. ' . number_format($total_bunga_piutang, 0, ',', '.') }}</td>-->
                            <!--    <td></td>-->
                            <!--</tr>-->
                        </table>
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h5>Simulasi KPR</h5>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <tr>
                                        <th>Angsuran ke</th>
                                        <th>Angsuran Pokok</th>
                                        <th>Angsuran Bunga</th>
                                        <th>Besar Angsuran</th>
                                        <th>Sisa Pinjaman Pokok</th>
                                    </tr>
                                    @php
                                        $no = 0;
                                    @endphp
                                    @foreach ($all['bunga'] as $index => $value)
                                        <tr>
                                            <td style="text-align: right;">{{ $no++ }}</td>
                                            <td style="text-align: right;">
                                                {{ number_format($all['pokok'][$index], 2, ',', '.') }}</td>
                                            <td style="text-align: right;">
                                                {{ number_format($all['bunga'][$index], 2, ',', '.') }}</td>
                                            <td style="text-align: right;">
                                                {{ 'Rp. ' . number_format($besar_angsuran, 2, ',', '.') }}</td>
                                            <td style="text-align: right;">
                                                {{ number_format($all['pinjaman'][$index], 2, ',', '.') }}</td>
                                        </tr>
                                    @endforeach
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
