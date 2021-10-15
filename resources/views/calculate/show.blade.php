@extends('layouts.basekpr')
@section('content')

<style>
    tr:hover {
        transition: 1s;
        background: #889788;
    }
</style>

    <div class="mainContent">
        <div class="container-fluid">
            <div class="wrapperContent">
                <h1 class="titleHeaderContent">Kalkulator eKPR</h1>



                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5>Simulasi KPR</h5>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped">
                                            <tr>
                                                <th style="text-align: center;">Angsuran ke</th>
                                                <th style="text-align: center;">Angsuran Pokok</th>
                                                <th style="text-align: center;">Angsuran Bunga</th>
                                                <th style="text-align: center;">Besar Angsuran</th>
                                                <th style="text-align: center;">Sisa Pinjaman Pokok</th>
                                            </tr>
                                            @php
                                                $no = 0;
                                            @endphp
                                            @foreach ($all['bunga'] as $index => $value)
                                                <tr>
                                                    <td style="text-align: center;">{{ $no++ }}</td>
                                                    <td style="text-align: center;">
                                                        {{ number_format($all['pokok'][$index], 2, ',', '.') }}</td>
                                                    <td style="text-align: center;">
                                                        {{ number_format($all['bunga'][$index], 2, ',', '.') }}</td>
                                                    <td style="text-align: center;">
                                                        {{ 'Rp. ' . number_format($besar_angsuran, 2, ',', '.') }}</td>
                                                    <td style="text-align: center;">
                                                        {{ number_format(round($all['pinjaman'][$index], -3), 2, ',', '.') }}
                                                    </td>
                                                    {{-- <td style="text-align: center;">{{ $all['pokok'][$index] }}</td>
                                            <td style="text-align: center;">{{ $all['bunga'][$index] }}</td>
                                            <td style="text-align: center;">{{ "Rp. " . $besar_angsuran }}</td>
                                            <td style="text-align: center;">{{ $all['pinjaman'][$index] }}</td> --}}
                                                </tr>
                                            @endforeach
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Container-fluid Ends-->
                </div>
            </div>
        </div>
    </div>
@endsection
