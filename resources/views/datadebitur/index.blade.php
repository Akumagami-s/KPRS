@extends('layouts.basekpr')
@section('css')
    <link rel="stylesheet" href="{{ url('assets/css/kelolaUser.css') }}">
    <link rel="stylesheet" href="{{ url('assets/css/dataKpr.css') }}">
@endsection
@section('content')
<div class="mainContent">
    <div class="container-fluid">
        <div class="wrapperContent">
            @include('component.navtabs')

              <h1 class="nameContent">Data Debitur</h1>

              <div class="wrapperMainData">
                <div class="wrapperData">
                      <div class="nav nav-tabs" id="nav-tab" role="tablist">
                        <button class="nav-link active"
                          id="dataDebitur-tab"
                          data-bs-toggle="tab"
                          data-bs-target="#dataDebitur"
                          type="button" role="tab"
                          aria-controls="dataDebitur"
                          aria-selected="false">
                          Data Debitur
                        </button>

                        <button class="nav-link"
                          id="debiturBaru-tab"
                          data-bs-toggle="tab"
                          data-bs-target="#debiturBaru"
                          type="button" role="tab"
                          aria-controls="debiturBaru"
                          aria-selected="false">
                          Debitur Baru
                        </button>

                        <button class="nav-link"
                          id="debiturLunas-tab"
                          data-bs-toggle="tab"
                          data-bs-target="#debiturLunas"
                          type="button" role="tab"
                          aria-controls="debiturLunas"
                          aria-selected="false">
                          Debitur Lunas
                        </button>

                        <button class="nav-link"
                          id="debiturMeninggal-tab"
                          data-bs-toggle="tab"
                          data-bs-target="#debiturMeninggal"
                          type="button" role="tab"
                          aria-controls="debiturMeninggal"
                          aria-selected="false">
                          Debitur Meninggal
                        </button>
                      </div>

                      <div class="tab-content" id="nav-tabContent">

                        <div class="tab-pane fade show active"
                          id="dataDebitur"
                          role="tabpanel"
                          aria-labelledby="dataDebitur-tab">

                          <div class="wrapperTable">
                            <table id="tableDataDebitur" class="table" style="width:100%">

                                <thead class="headTable">
                                    <tr>
                                        <th>Update</th>
                                        <th>Nama/NRP</th>
                                        <th>Pangkat</th>
                                        <th>Kesatuan</th>
                                        <th>Tahap</th>
                                        <th>Pinjaman</th>
                                        <th>Jangka Waktu </th>
                                        <th>TMT Angsuran</th>
                                        <th>Jumlah Angsuran</th>
                                        <th>Angsuran Ke</th>
                                        <th>Angsuran Masuk</th>
                                        <th>Tunggakan</th>
                                        <th>Jml Tunggakan</th>
                                    </tr>
                                </thead>
                          </table>
                          </div>

                        </div>

                        <div class="tab-pane fade"
                          id="debiturBaru"
                          role="tabpanel"
                          aria-labelledby="debiturBaru-tab">

                          <div class="wrapperTable">
                            <table id="tableDebiturBaru" class="table" style="width:100%">
                                <thead class="headTable">
                                    <tr>
                                        <th>Update</th>
                                        <th>Nama/NRP</th>
                                        <th>Pangkat</th>
                                        <th>Kesatuan</th>
                                        <th>Tahap</th>
                                        <th>Pinjaman</th>
                                        <th>Jangka Waktu </th>
                                        <th>TMT Angsuran</th>
                                        <th>Jumlah Angsuran</th>
                                        <th>Angsuran Ke</th>
                                        <th>Angsuran Masuk</th>
                                        <th>Tunggakan</th>
                                        <th>Jml Tunggakan</th>
                                    </tr>
                                </thead>
                          </table>
                          </div>

                        </div>

                        <div class="tab-pane fade"
                          id="debiturLunas"
                          role="tabpanel"
                          aria-labelledby="debiturLunas-tab">

                          <div class="wrapperTable">
                            <table id="tableDebiturLunas" class="table" style="width:100%">
                                <thead class="headTable">
                                    <tr>
                                        <th>Update</th>
                                        <th>Nama/NRP</th>
                                        <th>Pangkat</th>
                                        <th>Kesatuan</th>
                                        <th>Tahap</th>
                                        <th>Pinjaman</th>
                                        <th>Jangka Waktu </th>
                                        <th>TMT Angsuran</th>
                                        <th>Jumlah Angsuran</th>
                                        <th>Angsuran Ke</th>
                                        <th>Angsuran Masuk</th>
                                        <th>Tunggakan</th>
                                        <th>Jml Tunggakan</th>
                                    </tr>
                                </thead>
                          </table>
                          </div>

                        </div>

                        <div class="tab-pane fade"
                          id="debiturMeninggal"
                          role="tabpanel"
                          aria-labelledby="debiturMeninggal-tab">

                          <div class="wrapperTable">
                            <table id="tableDebiturMeninggal" class="table" style="width:100%">
                                <thead class="headTable">
                                    <tr>
                                      <th>Update</th>
                                      <th>Nama/NRP</th>
                                      <th>Pangkat</th>
                                      <th>Kesatuan</th>
                                      <th>Tahap</th>
                                      <th>Pinjaman</th>
                                      <th>Jangka Waktu </th>
                                      <th>TMT Angsuran</th>
                                      <th>Jumlah Angsuran</th>
                                      <th>Angsuran Ke</th>
                                      <th>Angsuran Masuk</th>
                                      <th>Tunggakan</th>
                                      <th>Jml Tunggakan</th>
                                    </tr>
                                </thead>
                          </table>
                          </div>

                        </div>

                      </div>
                </div>
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
          debitur = $('#tableDataDebitur').DataTable({
                processing: true,
                scrollX: true,
                serverSide: true,
                ajax: "https://asiabytes.tech/kpr/tableDataDebitur",
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
                    }
                ],
                order: [
                    [1, 'asc']
                ]
            });
            debiturbaru = $('#tableDebiturBaru').DataTable({
                processing: true,
                scrollX: true,
                serverSide: true,
                ajax: "https://asiabytes.tech/kpr/tableDebiturBaru",
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
                    }
                ],
                order: [
                    [1, 'asc']
                ]
            });
            tabledebiturlunas = $('#tableDebiturLunas').DataTable({
                processing: true,
                scrollX: true,
                serverSide: true,
                ajax: "https://asiabytes.tech/kpr/tableDebiturLunas",
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
                    }
                ],
                order: [
                    [1, 'asc']
                ]
            });
            tablemeninggal = $('#tableDebiturMeninggal').DataTable({
                processing: true,
                scrollX: true,
                serverSide: true,
                ajax: "https://asiabytes.tech/kpr/tableDebiturMeninggal",
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
                    }
                ],
                order: [
                    [1, 'asc']
                ]
            });
        });
    </script>
@endsection
