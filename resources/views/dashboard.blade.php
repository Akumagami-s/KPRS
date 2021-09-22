@extends('layouts.app', ['title' => 'KPR | Dashboard' ])
@section('dashboard', 'Riwayat Transaksi')
@section('content')
<div class="card">
    <div class="card-header">
        <div class="dropdown" style="display: inline-block;">
            <a href="{{ route('approve.pdf', $kpr->id) }}" class="btn btn-danger" target="_blank">DOWNLOAD <i class="fa fa-print"></i></a>
          <a class="btn btn-danger dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
            Detail Transaction
          </a>
        
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                    <li><a class="dropdown-item" href="{{ Route('detaildata.all', $user->nrp) }}">Transaction
                            Seluruhnya</a></li>
                    <li><a class="dropdown-item" href="{{ Route('detaildata.success', $user->nrp) }}">Transaction
                            Sukses</a></li>
                    <li><a class="dropdown-item" href="{{ Route('detaildata.decline', $user->nrp) }}">Transaction Saldo
                            tidak cukup</a></li>
                </ul>
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
                            <td>Tahap</td>
                            <td>:</td>
                            <td>{{ $kpr->tahap }}</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>Pinjaman</td>
                            <td>:</td>
                            <td>{{ "Rp. " . number_format($kpr->pinjaman, 0,',','.') }}</td>
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
                            <td>{{ "Rp. " . number_format($kpr->jml_angs, 0,',','.') }}</td>
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
                            <td>{{ "Rp. " . number_format($kpr->jml_tunggakan, 0,',','.') }}</td>
                            <td></td>
                        </tr>

                        <tr>
                            <td>Keterangan</td>
                            <td>:</td>
                            <td>{{ $kpr->keterangan }}</td>
                            <td></td>
                        </tr>
                        
                        <tr>
                            <td>Sisa Pinjaman Pokok</td>
                            <td>:</td>
                            <td>{{  "Rp. " . number_format($total_pokok_piutang, 0,',','.') }}</td>
                            <td></td>
                        </tr>

                        <!--<tr>
                            <td>Sisa Pinjaman Bunga</td>
                            <td>:</td>
                            <td>{{  "Rp. " . number_format($total_bunga_piutang, 0,',','.') }}</td>
                            <td></td>
                        </tr>-->
                        
                        <!--<tr>
                            <td>Penerimaan Pokok</td>
                            <td>:</td>
                            <td>{{  "Rp. " . number_format($total_pokok_saldo, 0,',','.') }}</td>
                            <td></td>
                        </tr>

                        <tr>
                            <td>Penerimaan Bunga</td>
                            <td>:</td>
                            <td>{{  "Rp. " . number_format($total_bunga_saldo, 0,',','.') }}</td>
                            <td></td>
                        </tr>-->

                        <!--<tr>
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
                        </tr>-->

                        <tr>
                            <td>Tunggakan Bunga</td>
                            <td>:</td>
                            <td>RP. {{ number_format($kpr->tunggakan_bunga, 0,',','.') }}</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>outstanding(sisa pinjaman pokok + tunggakan bunga)</td>
                            <td>:</td>
                            <td>Rp. {{ number_format($kpr->piutang_pokok + $kpr->tunggakan_bunga, 0,',','.') }}</td>
                            <td></td>
                        </tr>

                    </table>
                </div>
            </div>
            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <tr>
                            <th class="text-center">No</th>
                            <th class="text-center">Tanggal</th>
                            <th class="text-center">Jumlah</th>
                            <th class="text-center">Keterangan</th>
                        </tr>
                        @php 
                            $ceks = 0 ;
                            $date = 0 ;
                            $id = 1;
                        @endphp
                        @foreach ($transaksi as $item)
                        @php 
                            $date = date("m Y", strtotime($item->tanggal));
                        @endphp
                        @if ($date != $ceks || $item->status != '0001')
                            <tr>
                            <td>{{$id}}</td>
                            <td>{{$item->tanggal}}</td>
                            <td>{{ "Rp. " . number_format($jumlah->jml_angs, 0,',','.') }}</td>
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
                            $ceks  = date("m Y", strtotime($item->tanggal)); 
                        @endphp
                        @endforeach
                    </table>
                </div>
            </div>
        </div>

    </div>
</div>

<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
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
                        @for ($i=0; $i < count($years); $i++)
                            <tr class="text-center">
                                <td>{{ $years[$i] }}</td>
                                @for($j = 1; $j <= 12; $j++)
                                    <td>
                                        @foreach ($transaksi as $t)
                                            @if(date('n', strtotime($t->tanggal)) == $j && date('Y', strtotime($t->tanggal)) == $years[$i])
                                                @php 
                                                        echo '<i class="fa fa-check"></i>';
                                                        break;
                                                @endphp
                                            @endif
                                        @endforeach
                                    </td>
                                @endfor
                            </tr>
                        @endfor
                    </table>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection