@extends('layouts.app', ['title' => 'KPR | Update Pinjaman' ])
@section('content')
    <div class="card">
        <div class="card-header">
            <h5>Update Data Transaksi Pembayaran KPR TWP AD</h5>
        </div>
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
                    <form id="meninggal" class="d-none"
                        action="{{ route('admin.detaildata.update.meninggal', request()->id) }}" method="POST">
                        @csrf
                    </form>
                    <form id="lunas" class="d-none"
                        action="{{ route('admin.detaildata.update.lunas', request()->id) }}" method="POST">
                        @csrf
                    </form>
                    <div class="col-md-12">
                        @if (session()->has('error_update'))
                            <span>{{ session('error_update') }}</span>
                        @endif
                        <form action="{{ route('admin.detaildata.update.store', request()->id) }}" method="POST">
                            @csrf
                            <div class="table-responsive">
                                {{-- <table class="table table-bordered">
                            <tr class="text-center">
                                <th colspan="12">Tahun {{date('Y')}}</th>
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
                            <tr class="text-center">
                                @for ($i = 0; $i < 12; $i++)
                                    <td>
                                        <input type="checkbox" name="bulan[]" id="{{ $i+1 }}" value="{{ $i+1 }}"
                                            @foreach ($transaksi as $t) {{ date('n', strtotime($t->tanggal)) == $i+1 ? 'checked disabled' : '' }} @endforeach>
                                    </td>
                                @endfor
                            </tr>
                        </table> --}}

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
                                                    @forelse ($transaksi as $z => $t)
                                                        @if (date('n', strtotime($t->tanggal)) == $j && date('Y', strtotime($t->tanggal)) == $years[$i])
                                                            <input type="checkbox" @foreach ($transaksi as $t) {{ date('n', strtotime($t->tanggal)) == $i + 1 ? '' : 'checked disabled' }} @endforeach>
                                                        @break(true)
                                                    @endif

                                                    @if ($z == count($transaksi) - 1)
                                                        @if ($i == count($years) - 1 && $j < date('n', strtotime($kpr->tmt_angsuran)))

                                                        @else
                                                            <input type="checkbox" name="data[{{ $years[$i] }}][]"
                                                                id="{{ $j }}" value="{{ $j }}">
                                                        @break(true)
                                                    @endif
                                            @endif
                                            @empty
                                                @if (!($i == (count($years) - 1) && $j < date('n', strtotime($kpr->
                                                    tmt_angsuran))))
                                                    <input type="checkbox" name="data[{{ $years[$i] }}][]"
                                                        id="{{ $j }}" value="{{ $j }}">
                                        @endif
                    @endforelse
                    </td>
                    @endfor
                    </tr>
                    @endfor
                    </table>


                </div>
                <div class="text-right mt-5">
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
                </form>
            </div>
            @endif
        </div>

        </div>
        </div>
    @endsection

    @push('style')
        <style>
            .borderless td,
            .borderless th {
                border: none;
            }

        </style>
    @endpush
