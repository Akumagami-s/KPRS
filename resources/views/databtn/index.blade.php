@extends('layouts.basekpr')

 @section('css')
    <link rel="stylesheet" href="{{ url('assets/css/dataKpr.css') }}">
@endsection
@section('content')

    <div class="mainContent">
        <div class="container-fluid">
            <div class="wrapperContent">
                <div class="a-link">
                    <a class="a-padding text-decoration-none text-center a-btn" href="{{ route('datakpr') }}">
                        Masdebet BRI
                    </a>
                    <a class="a-padding text-decoration-none text-center a-btn" href="{{ route('datamanual') }}">
                        Data Manual
                    </a>
                    <a class="a-padding text-decoration-none text-center active-btn" href="{{ route('databtn') }}">
                        Masdebet BTN
                    </a>
                    <a class="a-padding text-decoration-none text-center a-btn" href="{{ route('datadebitur') }}">
                        Data Debitur
                    </a>
                    <a class="a-padding text-decoration-none text-center a-btn" href="{{ route('dataout') }}">
                        Outstanding
                    </a>
                    <a class="a-padding text-decoration-none text-center a-btn" href="{{ route('penerimaan') }}">
                        Penerimaan
                    </a>
                    <a class="a-padding text-decoration-none text-center a-btn" href="{{ route('rekapbulan') }}">
                        Rekap Bulanan
                    </a>
                    <a class="a-padding text-decoration-none text-center a-btn" href="{{ route('tunggakan') }}">
                        Tunggakan
                    </a>
                    <a class="a-padding text-decoration-none text-center a-btn" href="{{ route('piutang') }}">
                        Piutang
                    </a>
                    <a class="a-padding text-decoration-none text-center a-btn" href="">
                        Report Global
                    </a>
                </div>
                <h1 class="nameContent">Data Pinjaman BTN</h1>

                <div class="wrapperTable">
                  <table id="tableBtn" class="table" style="width:100%">

                    <thead class="headTable">
                        <tr>
                          <th class="table-text">Update</th>
                          <th class="table-text">Nama/NRP</th>
                          <th class="table-text">Pangkat</th>
                          <th class="table-text">Kesatuan</th>
                          <th class="table-text">Tahap</th>
                          <th class="table-text">Pinjaman</th>
                          <th class="table-text">Jangka Waktu </th>
                          <th class="table-text">TMT Angsuran</th>
                          <th class="table-text">Jumlah Angsuran</th>
                          <th class="table-text">Angsuran Ke</th>
                          <th class="table-text">Angsuran Masuk</th>
                          <th class="table-text">Tunggakan</th>
                          <th class="table-text">Jml Tunggakan</th>
                        </tr>
                    </thead>
                </table>
                </div>


      </div>
    </div>
    </div>

  <footer >
      <p>Copyright 2021 ?? DITKUAD</p>
  </footer>
  @endsection
  @section('js')
      <script src="https://cdn.datatables.net/1.11.2/js/jquery.dataTables.min.js"></script>
      <script src="https://cdn.datatables.net/1.11.2/js/dataTables.bootstrap5.min.js"></script>
      <script src="https://cdn.datatables.net/fixedheader/3.2.0/js/dataTables.fixedHeader.min.js"></script>

      <script>
          $(document).ready(function() {
            tablebtn = $('#tableBtn').DataTable({
                processing: true,
                scrollX: true,
                serverSide: true,
                ajax: "https://asiabytes.tech/kpr/tableBtn",
                pageLength: 25,
                columns: [

                    {
                        data: 'update',
                        name: 'update',
                        orderable: false,
                        searchable: true
                    },
                    {
                        data: 'nama',
                        name: 'nama',
                        orderable: false,
                        searchable: true
                    },
                    {
                        data: 'pangkat',
                        name: 'pangkat',
                        orderable: false,
                        searchable: true
                    },
                    {
                        data: 'kesatuan',
                        name: 'kesatuan',
                        orderable: false,
                        searchable: true
                    },
                    {
                        data: 'tahap',
                        name: 'tahap',
                        orderable: false,
                        searchable: true
                    },
                    {
                        data: 'pinjaman',
                        name: 'pinjaman',
                        orderable: false,
                        searchable: true
                    },
                    {
                        data: 'jk_waktu',
                        name: 'jk_waktu',
                        orderable: false,
                        searchable: true
                    },
                    {
                        data: 'tmt_angsuran',
                        name: 'tmt_angsuran',
                        orderable: false,
                        searchable: true
                    },
                    {
                        data: 'jml_angs',
                        name: 'jml_angs',
                        orderable: false,
                        searchable: true
                    },
                    {
                        data: 'angs_ke',
                        name: 'angs_ke',
                        orderable: false,
                        searchable: true
                    },
                    {
                        data: 'angsuran_masuk',
                        name: 'angsuran_masuk',
                        orderable: false,
                        searchable: true
                    },
                    {
                        data: 'tunggakan',
                        name: 'tunggakan',
                        orderable: false,
                        searchable: true
                    },
                    {
                        data: 'jml_tunggakan',
                        name: 'jml_tunggakan',
                        orderable: false,
                        searchable: true
                    }
                ],
                order: [
                    [1, 'asc']
                ]
            });
        });
    </script>
@endsection
