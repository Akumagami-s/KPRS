@extends('layouts.basekpr')

 @section('css')
    <link rel="stylesheet" href="{{ url('assets/css/dataKpr.css') }}">
@endsection
@section('content')

    <div class="mainContent">
        <div class="container-fluid">
            <div class="wrapperContent">
                @include('component.navtabs')

                <h1 class="nameContent">Data Piutang</h1>

                <div class="wrapperTable">
                  <table id="tablePiutang" class="table" style="width:100%">

                    <thead class="headTable">
                        <tr>
                          <th class="table-text">Nama/NRP</th>
                          <th class="table-text">Pangkat</th>
                          <th class="table-text">Kesatuan</th>
                          <th class="table-text">Piutang Pokok</th>
                          <th class="table-text">Piutang Bunga</th>
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
            tablepiutang = $('#tablePiutang').DataTable({
                processing: true,
                scrollX: true,
                serverSide: true,
                ajax: "https://asiabytes.tech/kpr/tablePiutang",
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
                    }
                ],
                order: [
                    [1, 'asc']
                ]
            });
        });
    </script>
@endsection
