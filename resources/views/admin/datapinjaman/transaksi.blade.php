@extends('layouts.app', ['title' => 'KPR | Detail Transaction' ])
@section('content')
    <div class="card">
        <div class="card-header">
            <a href="{{ URL::previous() }}" class="btn btn-danger">Back</a>
        </div>
        <div class="card-body">
            <center>
                <h3><strong>{{ $text }}</strong></h3>
            </center>
            <br>
            <div class="row">
                <div class="col-md-12">
                    <table class="table borderless mb-3">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tanggal</th>
                                <th>Jumlah</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
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
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
@endsection
