@extends('layouts.app', ['title' => 'KPR | Data Rumah'])
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <a href="{{ route('admin.rumah.index') }}" class="btn btn-danger">BACK</a>
                </div>
                <form action="{{ route('admin.rumah.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="row my-2 mb-4">
                            <div class="col-md-12">
                                <h4><i class="fa fa-picture-o" style="color: salmon;"></i> Gambar Rumah - [Opsional]</h4>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="gambar_satu">Gambar Satu</label>
                                    <input type="file" name="gambar_satu" id="gambar_satu"
                                        class="form-control @error('gambar_satu') is-invalid @enderror">
                                    @error('gambar_satu')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="gambar_kedua">Gambar Dua</label>
                                    <input type="file" name="gambar_kedua" id="gambar_kedua"
                                        class="form-control @error('gambar_kedua') is-invalid @enderror">
                                    @error('gambar_kedua')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="gambar_ketiga">Gambar Tiga</label>
                                    <input type="file" name="gambar_ketiga" id="gambar_ketiga"
                                        class="form-control @error('gambar_ketiga') is-invalid @enderror">
                                    @error('gambar_ketiga')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="gambar_keempat">Gambar Empat</label>
                                    <input type="file" name="gambar_keempat" id="gambar_keempat"
                                        class="form-control @error('gambar_keempat') is-invalid @enderror">
                                    @error('gambar_keempat')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="gambar_kelima">Gambar Lima</label>
                                    <input type="file" name="gambar_kelima" id="gambar_kelima"
                                        class="form-control @error('gambar_kelima') is-invalid @enderror">
                                    @error('gambar_kelima')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row my-4">
                            <div class="col-md-12">
                                <h4><i class="fa fa-home" style="color: green"></i> Spesifikasi Rumah</h4>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="nama_rumah">Nama Perumahan</label>
                                    <input type="text" name="nama_rumah" id="nama_rumah"
                                        class="form-control @error('nama_rumah') is-invalid @enderror" required>
                                    @error('nama_rumah')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="luas_tanah">Luas Tanah(M²)</label>
                                    <input type="number" name="luas_tanah" id="luas_tanah"
                                        class="form-control @error('luas_tanah') is-invalid @enderror" required>
                                    @error('luas_tanah')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="luas_bangunan">Luas Bangunan(M²)</label>
                                    <input type="number" name="luas_bangunan" id="luas_bangunan"
                                        class="form-control @error('luas_bangunan') is-invalid @enderror" required>
                                    @error('luas_bangunan')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="deskripsi">Deskripsi</label>
                                    <textarea name="deskripsi" id="deskripsi"
                                        class="form-control @error('deskripsi') is-invalid @enderror" required></textarea>
                                    @error('deskripsi')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="alamat">Alamat Perumahan</label>
                                    <textarea name="alamat" id="alamat"
                                        class="form-control @error('alamat') is-invalid @enderror" required></textarea>
                                    @error('alamat')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="select2-dropdwn">
                                    <div class="col-form-label">Fasilitas:</div>
                                    <select name="fasilitas_id[]" style="width: 100%;" class="select2 col-sm-12"
                                        multiple="multiple" required>
                                        @foreach ($fasilitas as $row)
                                            <option value="{{ $row->id }}">{{ $row->nama_fasilitas }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="harga">Harga</label>
                                    <input type="text" name="harga" id="harga"
                                        class="form-control @error('harga') is-invalid @enderror" required>
                                    @error('harga')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <hr>
                            <div class="row my-4">
                                <div class="col-md-12">
                                    <h4><i class="fa fa-map" style="color: dodgerblue"></i> Koordinat Lokasi Rumah</h4>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div id="googleMap" style="width:100%;height:380px;"></div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="lat">Lat</label>
                                    <input class="form-control @error('lat') is-invalid @enderror" readonly name="lat"
                                        id="lat">
                                    @error('lat')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="lng">Lng</label>
                                    <input class="form-control @error('lng') is-invalid @enderror" readonly name="lng"
                                        id="lng">
                                    @error('lng')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="link">Link</label>
                                    <textarea class="form-control @error('link') is-invalid @enderror" readonly name="link"
                                        id="link"></textarea>
                                    @error('link')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <h1 class="dark">
                                    <a href="" id="btn-link" target="_blank" class="btn btn-success"><i
                                            class="fa fa-map" style="color: white"></i> Cek Di Google Maps</a>
                                </h1>
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
<script src="https://maps.googleapis.com/maps/api/js"></script>
@push('script')

    <script>
        let marker;

        function taruhMarker(peta, posisiTitik) {
            if (marker) {
                // pindahkan marker
                marker.setPosition(posisiTitik);
                let lat = document.getElementById('lat').value = posisiTitik.lat()
                let lng = document.getElementById('lng').value = posisiTitik.lng()
                document.getElementById('btn-link').href =
                    `https://www.google.co.id/maps/dir//${lat},${lng}/@${lat},${lng},20z`
                document.getElementById('link').value =
                    `https://www.google.co.id/maps/dir//${lat},${lng}/@${lat},${lng},20z`
            } else {
                // buat marker baru
                marker = new google.maps.Marker({
                    position: posisiTitik,
                    map: peta,
                    animation: google.maps.Animation.DROP
                });
                let lat = document.getElementById('lat').value = posisiTitik.lat()
                let lng = document.getElementById('lng').value = posisiTitik.lng()
                document.getElementById('btn-link').href =
                    `https://www.google.co.id/maps/dir//${lat},${lng}/@${lat},${lng},20z`
                document.getElementById('link').value =
                    `https://www.google.co.id/maps/dir//${lat},${lng}/@${lat},${lng},20z`
            }

        }

        function initialize() {
            let propertiPeta = {
                center: new google.maps.LatLng(-6.601562, 106.805111),
                zoom: 15,
                mapTypeId: google.maps.MapTypeId.ROADMAP
            };

            let peta = new google.maps.Map(document.getElementById("googleMap"), propertiPeta);
            google.maps.event.addListener(peta, 'click', function(event) {
                taruhMarker(this, event.latLng);
            });
        }
        // event jendela di-load
        google.maps.event.addDomListener(window, 'load', initialize);
        $(".select2").select2({
            placeholder: "-- Pilih Fasilitas --"
        });

        var rupiah = document.getElementById("harga");
        rupiah.addEventListener("keyup", function(e) {
            rupiah.value = formatRupiah(this.value, "Rp. ");
        });

        function formatRupiah(angka, prefix) {
            var number_string = angka.replace(/[^,\d]/g, "").toString(),
                split = number_string.split(","),
                sisa = split[0].length % 3,
                rupiah = split[0].substr(0, sisa),
                ribuan = split[0].substr(sisa).match(/\d{3}/gi);
            if (ribuan) {
                separator = sisa ? "." : "";
                rupiah += separator + ribuan.join(".");
            }
            rupiah = split[1] != undefined ? rupiah + "," + split[1] : rupiah;
            return prefix == undefined ? rupiah : rupiah ? "Rp. " + rupiah : "";
        }
    </script>
@endpush
