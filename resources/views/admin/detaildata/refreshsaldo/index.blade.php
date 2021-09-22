@extends('layouts.app', ['title' => 'KPR | Refresh Saldo'])
@section('dashboard', 'SALDO')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Refresh Saldo</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('refresh.saldo') }}" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <select class="form-control custom-select" name="tahun" id="">
                                            @foreach ($years as $key => $value)
                                                <option value="{{ $value }}">{{ $value }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <button class="btn btn-block btn-primary ">Refresh</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Container-fluid Ends-->
    </div>
@endsection
