@extends('layouts.app', ['title' => 'KPR | Kalkulator'])
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h5>Pinjaman KPR</h5>
                    <hr>
                    <h4>Besar PInjaman</h4>
                    <p>{{ "Rp. " . number_format($besar_pinjaman, 0,',','.') }}</p>
                    
                    <h4>Bunga</h4><p>Bunga {{ $bunga }}%</p>
                    <h4>Jangka Waktu</h4><p>Jangka Waktu(bulan) {{ $jangka }}</p>
                    <h4>NRP User</h4><p>NRP User {{ auth()->user()->nrp }}</p>
                    <h4>Besar Angsuran <p>{{ "Rp. " . number_format($besar_angsuran, 0,',','.') }}</p></h4>
                    
                    <h4>Anuitas <p>{{ $anuitas }}</p></h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <tr>
                                <th class="text-center">Angsuran Ke</th>
                                <th class="text-right">Angsuran Pokok</th>
                                <th class="text-right">Angsuran Bunga</th>
                                <th class="text-right">Sisa Pinjaman Pokok</th>
                            </tr>
                            @php
                                $no = 0;
                            @endphp
                            @foreach ($all['bunga'] as $index => $value)
                            <tr>
                                <td align=center>{{ $no++ }}</td>
                                <td align=right>{{number_format(round($all['pokok'][$index]))}}
                                    </td>
                                <td align=right>{{number_format(round($all['bunga'][$index]))}}</td>
                                <td align=right>{{number_format(round($all['pinjaman'][$index]))}}</td>
                                
                            </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
                <div class="card-footer">
                    <form action="{{ route('pinjaman.store') }}" method="post">
                        @csrf
                        <input type="hidden" value="{{ $besar_pinjaman }}" name="besar_pinjaman">
                        <input type="hidden" value="{{ $bunga }}" name="bunga">
                        <input type="hidden" value="{{ $jangka }}"name="jangka">
                        <input type="hidden" value="{{ $besar_angsuran }}" name="besar_angsuran">
                        <input type="hidden" value="{{ auth()->user()->nrp }}" name="nrp">
                        <input type="hidden" value="{{ $anuitas }}" name="anuitas">
                        <a href="{{route('home')}}" class="btn btn-danger">Back</a>
                        <button type="submit" class="btn btn-primary">Ajukan Pinjaman</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid Ends-->
</div>
@endsection
