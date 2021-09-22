@extends('layouts.app', ['title' => 'KPR | SANDBOX'])
@section('dashboard', 'SANDBOX')
@section('content')
    @isset($acc)
        <div class="container">
            <center>
                <h3>Ini akun sandbox anda </h3>
                <h1>{{ $acc->nama }}</h1>
                <div class="alert alert-warning w-80" role="alert">
                    Pembuatan akun KPR asli mungkin memerlukan waktu lama karena membutuhkan approvement dari admin terlebih
                    dahulu
                </div>

                <br>
                <a href="{{ route('sandbox.datapinjam') }}" class="btn btn-outline-info">Bayar</a>
            </center>

        @else
            <center>
                <h2>Anda belum memiliki akun KPR Sandbox</h2>

                <h3>Buat ?</h3>
            </center>

            <form action="{{ route('sandbox.createKpr') }}" method="post">
                @csrf
                <input type="text" name="pinjaman" placeholder="Berapa peminjamannya ?" class="form-control">
                <input type="text" name="jangka" placeholder="Berapa jangka waktunya  ?" class="form-control">


                <button class="btn btn-outline-success" type="submit">kirim</button>
            </form>

        @endisset
    </div>

    @isset($all)
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped">
                    <tr>
                        <th style="text-align: center">Angsuran ke</th>
                        <th style="text-align: center">Angsuran Pokok</th>
                        <th style="text-align: center">Angsuran Bunga</th>
                        <th style="text-align: center">Besar Angsuran</th>
                        <th style="text-align: center">Sisa Pinjaman Pokok</th>
                        <th style="text-align: center">status</th>
                    </tr>
                    @php
                        $no = 0;
                    @endphp
                    @foreach ($all['bunga'] as $index => $value)
                        <tr>
                            <td style="text-align: center;">{{ $no++ }}</td>
                            <td style="text-align: center;">{{ number_format($all['pokok'][$index], 2, ',', '.') }}</td>
                            <td style="text-align: center;">{{ number_format($all['bunga'][$index], 2, ',', '.') }}</td>
                            <td style="text-align: center;">{{ 'Rp. ' . number_format($besar_angsuran, 2, ',', '.') }}</td>
                            <td style="text-align: center;">{{ number_format($all['pinjaman'][$index], 2, ',', '.') }}</td>
                            <td style="text-align: center;"></td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    @endisset




@endsection
