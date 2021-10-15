@extends('layouts.basekpr')

 @section('css')
    <link rel="stylesheet" href="{{ url('assets/css/dataKpr.css') }}">
@endsection
@section('content')

    <div class="mainContent">
        <div class="container-fluid">
            <div class="wrapperContent">
                @include('component.navtabs')

                <h1 class="nameContent">Data Bulanan</h1>

                <div class="wrapperTable">
                  <table id="tableCari" class="table" style="width:100%">

                    <thead class="headTable">
                        <tr>
                          <th class="table-text">Nama/NRP</th>
                          <th class="table-text">Pangkat</th>
                          <th class="table-text">Kesatuan</th>
                          <th class="table-text">Tahap</th>
                          <th class="table-text">Pinjaman</th>
                          <th class="table-text">Jangka Waktu</th>
                          <th class="table-text">TMT Angsuran</th>
                          <th class="table-text">Jumlah Angsuran</th>
                          <th class="table-text">Angsuran Ke</th>
                          <th class="table-text">Angsuran Masuk</th>
                          <th class="table-text">Tunggakan</th>
                          <th class="table-text">Tunggakan Pokok</th>
                          <th class="table-text">Tunggakan Bunga</th>
                          <th class="table-text">Jml Tunggakan</th>
                          <th class="table-text">Rekening</th>
                          <th class="table-text">Bunga</th>
                          <th class="table-text">Pokok</th>
                          <th class="table-text">Sisa Pinjaman Pokok</th>
                          <th class="table-text">Inisial Bunga</th>
                          <th class="table-text">Inisial Pokok</th>
                          <th class="table-text">Hutang pokok</th>
                          <th class="table-text">Hutang Bunga</th>
                          <th class="table-text">Outstanding</th>
                        </tr>
                    </thead>
                </table>
                </div>


          </div>
      </div>
    </div>

  <footer >
      <p>Copyright 2021 © DITKUAD</p>
  </footer>
@endsection
@section('js')
    <script src="https://cdn.datatables.net/1.11.2/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.2/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/fixedheader/3.2.0/js/dataTables.fixedHeader.min.js"></script>

    <script>
        $(document).ready(function() {
            tablecari = $('#tableCari').DataTable({
                processing: true,
                scrollX: true,
                serverSide: true,
                ajax: "{{ route('admin.detaildata.carirekap') }}",
                pageLength: 25,
                columns: [

                    {
                        data: 'nama',
                        name: 'nama',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'pangkat',
                        name: 'pangkat',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'kesatuan',
                        name: 'kesatuan',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'tahap',
                        name: 'tahap',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'pinjaman',
                        name: 'pinjaman',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'jk_waktu',
                        name: 'jk_waktu',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'tmt_angsuran',
                        name: 'tmt_angsuran',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'jml_angs',
                        name: 'jml_angs',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'angs_ke',
                        name: 'angs_ke',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'angsuran_masuk',
                        name: 'angsuran_masuk',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'tunggakan',
                        name: 'tunggakan',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'jml_tunggakan',
                        name: 'jml_tunggakan',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'rekening',
                        name: 'rekening',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'rek_bri',
                        name: 'rek_bri',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'rek_btn',
                        name: 'rek_btn',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'pokok',
                        name: 'pokok',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'bunga',
                        name: 'bunga',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'inisial_pokok',
                        name: 'inisial_pokok',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'inisial_bunga',
                        name: 'inisial_bunga',
                        orderable: false,
                        searchable: false
                    },

                    {
                        data: 'piutang_pokok',
                        name: 'piutang_pokok',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'piutang_bunga',
                        name: 'piutang_bunga',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'outstanding',
                        name: 'outstanding',
                        orderable: false,
                        searchable: false
                    }
                ],
                order: [
                    [1, 'asc']
                ]
            });
        });
    </script>
@endsection
