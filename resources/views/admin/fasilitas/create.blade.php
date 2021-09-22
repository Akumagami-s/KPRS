@extends('layouts.app', ['title' => 'KPR | Data Fasilitas'])
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <a href="{{ route('admin.fasilitas.index') }}" class="btn btn-danger">BACK</a>
                </div>
                <form action="{{ route('admin.fasilitas.store') }}" method="POST">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="nama_fasilitas">Nama Fasilitas</label>
                                    <input type="text" name="nama_fasilitas" id="nama_fasilitas"
                                        class="form-control @error('nama_fasilitas') is-invalid @enderror" required>
                                    @error('nama_fasilitas')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
