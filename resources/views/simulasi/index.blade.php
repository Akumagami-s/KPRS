@extends('layouts.basekpr')
@section('content')
<div class="mainContent">
    <div class="container-fluid">
        <div class="wrapperContent">

            <h1 class="nameContent">Kalkulator</h1>
            <div class="row justify-content-center">
                <div class="col">
                    <div class="mb-2">
                        <label for="jmlPinjaman" class="form-label">Jumlah Pinjaman</label>
                        <input type="text" class="form-control" id="jmlPinjaman" aria-describedby="">
                      </div>
                </div>

                <div class="col-12 col-md-4">
                  <div class="mb-2">
                    <label for="angsuran" class="form-label">Lama Angsuran (bulan)</label>
                    <input type="text" class="form-control" id="angsuran" aria-describedby="">
                  </div>
                </div>

                <div class="col-12 col-md-4">
                    <label for="bunga" class="form-label">Bunga</label>
                    <div class="input-group mb-2">
                        <span class="input-group-text" id="basic-addon1">$</span>
                        <input type="text" class="form-control" >
                    </div>
                </div>
            </div>
            <div class="mb-5">
                <label for="jmlPinjaman" class="form-label">Akad</label>
                <input type="date" class="form-control" id="jmlPinjaman" aria-describedby="">
            </div>
            <button type="submit" class="btn btn-success w-100">Hitung</button>

    </div>
  </div>

<footer>
    <p>Copyright 2021 © DITKUAD</p>
</footer>
@endsection
