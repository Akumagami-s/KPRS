@extends('layouts.basekpr')
@section('content')
    <div class="mainContent">
        <div class="container-fluid">
            <div class="wrapperContent">

                <div class="nav nav-tabs tabsButton" id="nav-tab" role="tablist">

                    <button class="nav-link active" id="dataRumah-tab-menu" data-bs-toggle="tab"
                        data-bs-target="#dataRumah-tab" type="button" role="tab" aria-controls="dataRumah-tab"
                        aria-selected="true">Data Rumah</button>

                    <button class="nav-link" id="dataFaslitas-tab-menu" data-bs-toggle="tab"
                        data-bs-target="#dataFaslitas-tab" type="button" role="tab" aria-controls="dataFaslitas-tab"
                        aria-selected="true">Data Faslitas</button>

                </div>

                <div class="tab-content" id="nav-tabContent">

                    <div class="tab-pane fade show active" id="dataRumah-tab" role="tabpanel"
                        aria-labelledby="dataRumah-tab-menu">

                        <h1 class="nameContent">Data Rumah</h1>

                        <div class="wrapperTable">
                            <table id="tableDataRumah" class="table" style="width:100%">

                                <button type="button" class="btn btn-primary btnModal" data-bs-toggle="modal"
                                    data-bs-target="#kategori">
                                    Tambah
                                </button>

                                <div class="modal fade" id="kategori" tabindex="-1" aria-labelledby="kategoriLabel"
                                    aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">

                                            <div class="modal-header">
                                                <h5 class="modal-title" id="kategoriLabel">Tambah Data Rumah</h5>
                                            </div>

                                            <div class="modal-body">
                                                <form action="">
                                                    <!-- Data Rumah -->
                                                    <h4 class="text-danger">Gambar Rumah</h4>
                                                    <div class="mainForm columnForm">
                                                        <div class="actionForm first">
                                                            <label for="">Gambar 1 </label>
                                                            <input class="form-control" type="file" id="formFile">
                                                        </div>
                                                        <div class="d-flex bd-highlight">
                                                            <div class="p-2 flex-fill bd-highlight">
                                                                <div class="actionForm two">
                                                                    <label for="">Gambar 2</label>
                                                                    <input class="form-control" type="file" id="formFile">
                                                                </div>
                                                            </div>
                                                            <div class="p-2 flex-fill bd-highlight">
                                                                <div class="actionForm two">
                                                                    <label for="">Gambar 3</label>
                                                                    <input class="form-control" type="file" id="formFile">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="d-flex bd-highlight">
                                                            <div class="p-2 flex-fill bd-highlight">
                                                                <div class="actionForm two">
                                                                    <label for="">Gambar 4</label>
                                                                    <input class="form-control" type="file" id="formFile">
                                                                </div>
                                                            </div>
                                                            <div class="p-2 flex-fill bd-highlight">
                                                                <div class="actionForm two">
                                                                    <label for="">Gambar 5</label>
                                                                    <input class="form-control" type="file" id="formFile">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <hr>

                                                        <!-- Spesifikasi Rumah -->
                                                        <h4 class="text-danger">Spesifikasi Rumah</h4>
                                                        <div class="mainForm columnForm">
                                                            <div class="actionForm first">
                                                                <label for="">Nama Perumahan</label>
                                                                <input class="form-control" type="text" id="formtext">
                                                            </div>
                                                            <div class="d-flex bd-highlight">
                                                                <div class="p-2 flex-fill bd-highlight">
                                                                    <div class="actionForm two">
                                                                        <label for="">Luas Tanah(M²)</label>
                                                                        <input class="form-control" type="text"
                                                                            id="formtext">
                                                                    </div>
                                                                </div>
                                                                <div class="p-2 flex-fill bd-highlight">
                                                                    <div class="actionForm two">
                                                                        <label for="">
                                                                            Luas Bangunan(M²)</label>
                                                                        <input class="form-control" type="text"
                                                                            id="formtext">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="d-flex bd-highlight">
                                                                <div class="p-2 flex-fill bd-highlight">
                                                                    <div class="actionForm two">
                                                                        <label for="">Deskripsi</label>
                                                                        <textarea class="form-control ms-2"
                                                                            placeholder="Leave a comment here"
                                                                            id="floatingTextarea2"
                                                                            style="height: 100px"></textarea>
                                                                    </div>
                                                                </div>
                                                                <div class="p-2 flex-fill bd-highlight">
                                                                    <div class="actionForm two">
                                                                        <label for="">Alamat Perumahan</label>
                                                                        <textarea class="form-control ms-2"
                                                                            placeholder="Leave a comment here"
                                                                            id="floatingTextarea2"
                                                                            style="height: 100px"></textarea>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="d-flex bd-highlight">
                                                                <div class="p-2 flex-fill bd-highlight">
                                                                    <div class="actionForm two">
                                                                        <label for="">
                                                                            Fasilitas</label>
                                                                        <input class="form-control" type="text"
                                                                            id="formtext"
                                                                            placeholder="Pilih : Garasi, Listrik, Air">
                                                                    </div>
                                                                </div>
                                                                <div class="p-2 flex-fill bd-highlight">
                                                                    <div class="actionForm two">
                                                                        <label for="">
                                                                            Harga</label>
                                                                        <input class="form-control" type="text"
                                                                            id="formtext">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <hr>
                                                            <h4 class="text-danger">Kordinar Lokasi Rumah</h4>
                                                            <iframe
                                                                src="https://www.google.com/maps/d/embed?mid=1DHV2_3ZBOiOOuGh18lSw2U4vv9k&hl=en"
                                                                width="640" height="480" class="w-100"></iframe>
                                                            <div class="d-flex bd-highlight">
                                                                <div class="p-2 flex-fill bd-highlight">
                                                                    <div class="actionForm two">
                                                                        <label for="">
                                                                            Lat</label>
                                                                        <input class="form-control" type="text"
                                                                            id="formtext">
                                                                    </div>
                                                                </div>
                                                                <div class="p-2 flex-fill bd-highlight">
                                                                    <div class="actionForm two">
                                                                        <label for="">
                                                                            Lng</label>
                                                                        <input class="form-control" type="text"
                                                                            id="formtext">
                                                                    </div>
                                                                </div>
                                                                <div class="p-2 flex-fill bd-highlight">
                                                                    <div class="actionForm two">
                                                                        <label for="">Link</label>
                                                                        <textarea class="form-control ms-2"
                                                                            placeholder="Leave a comment here"
                                                                            id="floatingTextarea2"
                                                                            style="height: 100px"></textarea>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                        </div>

                                                        <div class="buttonActionForm">

                                                        </div>
                                                </form>
                                            </div>

                                            <div class="modal-footer actionButton">
                                                <button class="btn saveBtn d-flex align-items-center" type="save">
                                                    <img src="../assets/img/saveIcon.svg" alt="">
                                                    Simpan
                                                </button>
                                                <button class="btn deleteBtn d-flex align-items-center"
                                                    data-bs-dismiss="modal" type="batal">
                                                    Batal
                                                </button>
                                            </div>

                                        </div>
                                    </div>
                                </div>


                                <thead class="headTable">
                                    <tr>
                                        <th>#</th>
                                        <th>Nama Perumahan</th>
                                        <th>Deskripsi</th>
                                        <th>Gambar </th>
                                        <th>Alamat</th>
                                        <th>Luas Tanah</th>
                                        <th>Luas Bangunan</th>
                                        <th>Fasilitas</th>
                                        <th>Harga</th>
                                        <th>Status</th>
                                        <th>Lat</th>
                                        <th>Long</th>
                                        <th>Link</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="bodyTable">
                                    @foreach (DB::table('rumah')->get() as $rumah)
                                        <tr>
                                            <td>{{ $rumah->id }}</td>
                                            <td>{{ $rumah->nama_rumah }}</td>
                                            <td>{{ $rumah->deskripsi }}</td>
                                            <td>{{ $rumah->gambar_id }}</td>
                                            <td>{{ $rumah->alamat }}</td>
                                            <td>{{ $rumah->luas_tanah }}</td>
                                            <td>{{ $rumah->luas_bangunan }}</td>
                                            <td>{{ $rumah->fasilitas }}</td>
                                            <td>{{ $rumah->harga }}</td>
                                            <td>{{ $rumah->status }}</td>
                                            <td>{{ $rumah->lat }}</td>
                                            <td>{{ $rumah->lng }}</td>
                                            <td>{{ $rumah->link }}</td>
                                            <td>
                                                <div class="action">
                                                    <a href="editDataPrajurit.html"><img src="../assets/img/editIcon.svg"
                                                            alt=""></a>
                                                    <a href="#"><img src="../assets/img/deleteIcon.svg" alt=""></a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="dataFaslitas-tab" role="tabpanel"
                        aria-labelledby="dataFaslitas-tab-menu">

                        <h1 class="nameContent">Data Fasilitas</h1>

                        <div class="wrapperTable">
                            <table id="tableDataFaslitas" class="table" style="width:100%">

                                <button type="button" class="btn btn-primary btnModal" data-bs-toggle="modal"
                                    data-bs-target="#fasilitas">
                                    Tambah
                                </button>

                                <div class="modal fade" id="fasilitas" tabindex="-1" aria-labelledby="fasilitasLabel"
                                    aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">

                                            <div class="modal-header">
                                                <h5 class="modal-title" id="fasilitasLabel">Tambah Fasilitas</h5>
                                            </div>

                                            <div class="modal-body">
                                                <form action="">
                                                    <div class="mainForm columnForm">
                                                        <div class="actionForm first">
                                                            <label for="">Nama Fasilitas</label>
                                                            <input class="form-control" type="text" id="formtext">
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>

                                            <div class="modal-footer actionButton">
                                                <button class="btn saveBtn d-flex align-items-center" type="save">
                                                    <img src="../assets/img/saveIcon.svg" alt="">
                                                    Simpan
                                                </button>
                                                <button class="btn deleteBtn d-flex align-items-center"
                                                    data-bs-dismiss="modal" type="batal">
                                                    Batal
                                                </button>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                                <thead class="headTable">
                                    <tr>
                                        <th>#</th>
                                        <th>Fasilitas</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody class="bodyTable">
                                    <tr>
                                        <td>1</td>
                                        <td>1</td>
                                        <td>
                                            <div class="action">
                                                <a href="editDataPrajurit.html"><img src="../assets/img/editIcon.svg"
                                                        alt=""></a>
                                                <a href="#"><img src="../assets/img/deleteIcon.svg" alt=""></a>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>


                </div>

            </div>
        </div>
    </div>

    <footer>
        <p>Copyright 2021 © DITKUAD</p>
    </footer>
@endsection
