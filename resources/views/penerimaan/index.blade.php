@extends('layouts.basekpr')

 @section('css')
    <link rel="stylesheet" href="{{ url('assets/css/dataKpr.css') }}">
@endsection
@section('content')

    <div class="mainContent">
        <div class="container-fluid">
            <div class="wrapperContent">
                @include('component.navtabs')

                <h1 class="nameContent">Data Penerimaan</h1>

                  <div class="wrapperTable">
                    <table id="tablePenerimaan" class="table" style="width:100%">

                      <thead class="headTable">
                          <tr>
                            <th class="table-text">Nama/NRP</th>
                            <th class="table-text">Pangkat</th>
                            <th class="table-text">Kesatuan</th>
                            <th class="table-text">Penerimaan Pokok</th>
                            <th class="table-text">Penerimaan Bunga</th>
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
            tablepenerimaan = $('#tablePenerimaan').DataTable({
                processing: true,
                scrollX: true,
                serverSide: true,
                ajax: "https://asiabytes.tech/kpr/tablePenerimaan",
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
                    }
                ],
                order: [
                    [1, 'asc']
                ]
            });
        });
    </script>
@endsection
