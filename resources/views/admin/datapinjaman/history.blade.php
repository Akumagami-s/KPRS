@extends('layouts.app', ['title' => 'KPR | History Pinjaman' ])
@section('content')
    <div class="card">
        <div class="card-header">
            <a href="{{ route('admin.detaildata.show', $kpr_id) }}" class="btn btn-danger">Back</a>
            <div class="dropdown" style="display: inline-block;">
                <a class="btn btn-danger dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                    data-bs-toggle="dropdown" aria-expanded="false">
                    Detail Transaction
                </a>

                <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                    <li><a class="dropdown-item" href="{{ Route('admin.detaildata.all', $user->nrp) }}">Transaction
                            Seluruhnya</a></li>
                    <li><a class="dropdown-item" href="{{ Route('admin.detaildata.success', $user->nrp) }}">Transaction
                            Sukses</a></li>
                    <li><a class="dropdown-item" href="{{ Route('admin.detaildata.decline', $user->nrp) }}">Transaction
                            Saldo tidak cukup</a></li>
                </ul>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <table class="table borderless mb-3">
                        <thead>
                            <tr>
                                <td>
                                    <h5>Riwayat Pembayaran KPR</h5>
                                </td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Nama</td>
                                <td>:</td>
                                <td>{{ $user->nama }}</td>
                            </tr>
                            <tr>
                                <td>NRP</td>
                                <td>:</td>
                                <td>{{ $user->nrp }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
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
                            @for ($i = 0; $i < count($years); $i++)
                                <tr class="text-center">
                                    <td>{{ $years[$i] }}</td>
                                    @for ($j = 1; $j <= 12; $j++)
                                        <td>
                                            @foreach ($transaksi as $t)
                                                @if (date('n', strtotime($t->tanggal)) == $j && date('Y', strtotime($t->tanggal)) == $years[$i])
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

        <br>
        <br>
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
    </div>



@endsection
