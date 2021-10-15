@extends('layouts.app', ['title' => 'KPR | Pinjaman'])
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    @if(!$detail_kpr)
                        <a href="{{ route('home') }}" class="btn btn-primary"><i class="fa fa-plus"></i> Ajukan Pinjaman</a>
                    @endif
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <tr>
                                <th class="text-left">#</th>
                                <th class="text-left">Status</th>
                                <th class="text-left">Nama</th>
                                <th class="text-left">Pangkat</th>
                                <th class="text-left">NRP</th>
                                <th class="text-left">Kesatuan</th>
                                <th class="text-left">Pinjaman</th>
                                <th class="text-left">Jangka Waktu</th>
                            </tr>
                            @php
                                $no = 1;
                            @endphp
                            @foreach($detail_kpr as $det)
                            <tr>
                                <th>{{ $no++ . '.' }}</th>
                                <td>{!! $det->StatusPinjam !!}</td>
                                <td>{{ $det->nama }}</td>
                                <td>{{ $det->pangkat }}</td>
                                <td>
                                    <span class="badge badge-light">{{ $det->nrp }}</span>
                                </td>
                                <td>{{ $det->kesatuan }}</td>
                                <td>{{ "Rp." . number_format($det->pinjaman, 0,',','.') }}</td>
                                <td>{{ $det->jk_waktu }}</td>
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
@endsection
