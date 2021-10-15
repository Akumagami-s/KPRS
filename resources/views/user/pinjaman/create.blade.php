@extends('layouts.app', ['title' => 'KPR | User Pinjam'])
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <a href="{{ route('userpinjam.index') }}" class="btn btn-danger">BACK</a>
                </div>
                @if(request()->is('lihat/jmlangs'))
                <form action="{{ route('userpinjam.store') }}" method="post">
                    @csrf
                    <input type="hidden" name="rumah_id" value="{{ request('rumah_id') }}">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nama">Nama</label>
                                    <input type="text" name="nama" id="nama" value="{{ auth()->user()->name }}"
                                        class="form-control @error('nama') is-invalid @enderror" readonly>
                                    @error('nama')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nrp">NRP</label>
                                    <input type="text" name="nrp" value="{{ auth()->user()->nrp }}" id="nrp"
                                        class="form-control @error('nrp') is-invalid @enderror" readonly>
                                    @error('nrp')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="ktp">No KTP</label>
                                    <input type="text" name="ktp" value="{{ request('ktp') }}" id="ktp"
                                        class="form-control @error('ktp') is-invalid @enderror" readonly>
                                    @error('ktp')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="alamat">Alamat Debitur</label>
                                    <input type="text" name="alamat" value="{{ request('alamat') }}" id="alamat"
                                        class="form-control @error('alamat') is-invalid @enderror" readonly>
                                    @error('alamat')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="pangkat">Pangkat</label>
                                    <input type="text" name="pangkat" value="{{ request('pangkat') }}" id="pangkat"
                                        class="form-control @error('pangkat') is-invalid @enderror" readonly>
                                    @error('pangkat')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <!--<div class="col-md-6">-->
                            <!--    <div class="form-group">-->
                            <!--        <label for="corps">Corps</label>-->
                            <!--        <input type="text" name="corps" value="{{ request('corps') }}" id="corps"-->
                            <!--            class="form-control @error('corps') is-invalid @enderror" readonly>-->
                            <!--        @error('corps')-->
                            <!--            <div class="invalid-feedback">{{ $message }}</div>-->
                            <!--        @enderror-->
                            <!--    </div>-->
                            <!--</div>-->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="pinjaman">Pinjaman</label>
                                    <input type="text" name="pinjaman" value="{{ request('pinjaman') }}" id="pinjaman"
                                        class="form-control" readonly>
                                    {{-- @error('pinjaman')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror --}}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="jk_waktu">Jangka Waktu</label>
                                    <input type="text" name="jk_waktu" value="{{ request('jk_waktu') }}" id="jk_waktu" class="form-control" readonly>
                                    @error('jk_waktu')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="kesatuan">Kesatuan</label>
                                    <input type="text" name="kesatuan" value="{{ request('kesatuan') }}" id="kesatuan"
                                        class="form-control @error('kesatuan') is-invalid @enderror" readonly>
                                    @error('kesatuan')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="kotama">Kotama</label>
                                    <input type="text" name="kotama" value="{{ request('kotama') }}" id="kotama"
                                        class="form-control @error('kotama') is-invalid @enderror" readonly>
                                    @error('kotama')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="rekening">Rekening</label>
                                    <input type="text" name="rekening" value="{{ request('rekening') }}" id="rekening"
                                        class="form-control @error('rekening') is-invalid @enderror" readonly>
                                    @error('rekening')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nama_bank">Nama Bank</label>
                                    <input type="text" name="nama_bank" value="{{ request('nama_bank') }}" id="nama_bank"
                                        class="form-control @error('nama_bank') is-invalid @enderror" readonly>
                                    @error('nama_bank')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="jml_angs">Besar Angsuran</label>
                                    <input type="text" name="jml_angs" value="{{ $jml_angs }}" id="jml_angs" class="form-control" readonly>
                                </div>
                            </div>
                            <table class="table table-striped">
                                <tr>
                                    <th>Angsuran ke</th>
                                    <th>Angsuran Pokok</th>
                                    <th>Angsuran Bunga</th>
                                    <th>Besar Angsuran</th>
                                    <th>Sisa Pinjaman Pokok</th>
                                </tr>
                                @php
                                    $no = 0;
                                @endphp
                                @foreach ($all['bunga'] as $index => $value)
                                <tr>
                                    <td style="text-align: right;">{{ $no++ }}</td>
                                    <td style="text-align: right;">{{number_format(round($all['pokok'][$index]))}}</td>
                                    <td style="text-align: right;">{{number_format(round($all['bunga'][$index]))}}</td>
                                    <td style="text-align: right;">{{ "Rp. " . number_format($jml_angs, 0,',','.') }}</td>
                                    <td style="text-align: right;">{{number_format(round($all['pinjaman'][$index]))}}</td>
                                </tr>
                                @endforeach
                            </table>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Kirim</button>
                    </div>
                </form>
                @else
                <form action="{{ route('lihat.jmlangs') }}" method="get">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nama">Nama</label>
                                    <input type="text" name="nama" id="nama" value="{{ auth()->user()->name }}"
                                        class="form-control @error('nama') is-invalid @enderror" readonly required>
                                    @error('nama')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nrp">NRP</label>
                                    <input type="text" name="nrp" value="{{ auth()->user()->nrp }}" id="nrp"
                                        class="form-control @error('nrp') is-invalid @enderror" readonly required>
                                    @error('nrp')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="ktp">No KTP</label>
                                    <input type="text" name="ktp" id="ktp" minlength="16" maxlength="16" onkeypress="return hanyaAngka(event)"
                                        class="form-control @error('ktp') is-invalid @enderror" required>
                                    @error('ktp')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="alamat">Alamat Debitur</label>
                                    <input type="text" name="alamat" id="alamat"
                                        class="form-control @error('alamat') is-invalid @enderror" required>
                                    @error('alamat')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            {{-- @if(!empty(auth()->user()->pangkat)) --}}
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="pangkat">Pangkat</label>
                                    <input type="text" name="pangkat" value="{{ auth()->user()->pangkat }}" id="pangkat"
                                        class="form-control @error('pangkat') is-invalid @enderror" readonly required>
                                    @error('pangkat')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                  </select>
                                </div>
                            </div>
                            <!--<div class="col-md-6">-->
                            <!--    <div class="form-group">-->
                            <!--        <label for="corps">Corps</label>-->
                            <!--        <select class="form-control custom-select" name="corps" id="corps" required>-->
                            <!--        <option disabled selected>Pilih Corps</option>-->
                            <!--        @foreach($corp as $value)-->
                            <!--            <option value="{{ $value['corps'] }}"-->
                            <!--                {{ old('corps')== $value['corps'] ? 'selected' : '' }}>-->
                            <!--                {{ $value['corps'] }}-->
                            <!--            </option>-->
                            <!--        @endforeach-->
                            <!--        @error('corps')-->
                            <!--            <span class="invalid-feedback">-->
                            <!--                <strong>{{ $message }}</strong>-->
                            <!--            </span>-->
                            <!--        @enderror-->
                            <!--      </select>-->
                            <!--    </div>-->
                            <!--</div>-->
                            {{-- @endif --}}
                            @if(request()->routeIs('userpinjam.rumah', request()->id))
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="pinjaman">Pinjaman</label>
                                    <input type="text" name="pinjaman" id="pinjaman"
                                        class="form-control" value="{{ "Rp. " . number_format($rumah->harga, 0,',','.') }}" readonly>
                                    {{-- @error('pinjaman')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror --}}
                                </div>
                            </div>
                            @else
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="pinjaman">Pinjaman</label>
                                    <input type="text" name="pinjaman" id="pinjaman"
                                        class="form-control" required>
                                    {{-- @error('pinjaman')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror --}}
                                </div>
                            </div>
                            @endif
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="jk_waktu">Jangka Waktu (Tahun)</label>
                                    <select name="jk_waktu" id="jk_waktu"
                                        class="form-control @error('jk_waktu') is-invalid @enderror custom-select" required>
                                        <option disabled selected>Pilih Jangka Waktu</option>
                                        <option value="12">1</option>
                                        <option value="24">2</option>
                                        <option value="36">3</option>
                                        <option value="48">4</option>
                                        <option value="60">5</option>
                                        <option value="72">6</option>
                                        <option value="84">7</option>
                                        <option value="96">8</option>
                                        <option value="108">9</option>
                                        <option value="120">10</option>
                                        <option value="132">11</option>
                                        <option value="144">12</option>
                                        <option value="156">13</option>
                                        <option value="168">14</option>
                                        <option value="180">15</option>
                                    </select>
                                    @error('jk_waktu')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            {{-- <div class="col-md-6">
                                <div class="form-group">
                                    <label for="jml_angs">Besar Angsuran</label>
                                    <input type="text" name="jml_angs" id="jml_angs" class="form-control" readonly>
                                </div>
                            </div> --}}
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="kesatuan">Kesatuan</label>
                                    <select name="kesatuan" id="kesatuan-select2" class="form-control @error('kesatuan') is-invalid @enderror"></select>
                                    @error('kesatuan')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="kotama">Kotama</label>
                                    <select class="form-control custom-select" name="kotama" id="kotama" required>
                                    <option disabled selected>Pilih Kotama</option>
                                    @foreach($kotama as $value)
                                        <option value="{{ $value['kotama'] }}"
                                            {{ old('kotama')== $value['kotama'] ? 'selected' : '' }}>
                                            {{ $value['kotama'] }}
                                        </option>
                                    @endforeach
                                  </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="rekening">Rekening</label>
                                    <input type="number" name="rekening" id="rekening"
                                        class="form-control @error('rekening') is-invalid @enderror" required>
                                    @error('rekening')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <!--<div class="col-md-6">-->
                            <!--    <div class="form-group">-->
                            <!--        <label for="nama_bank">Nama Bank</label>-->
                            <!--        <input type="text" name="nama_bank" id="nama_bank"-->
                            <!--            class="form-control @error('nama_bank') is-invalid @enderror" required>-->
                            <!--        @error('nama_bank')-->
                            <!--            <div class="invalid-feedback">{{ $message }}</div>-->
                            <!--        @enderror-->
                            <!--    </div>-->
                            <!--</div>-->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nama_bank">Nama Bank</label>
                                    <select name="nama_bank" id="nama_bank" class="form-control @error('nama_bank') is-invalid @enderror" required>
                                        <option disabled selected>Pilih Bank</option>
                                        <option value="BCA">BCA</option>
                                        <option value="BRI">BRI</option>
                                        <option value="BNI">BNI</option>
                                        <option value="Mandiri">Mandiri</option>
                                        <option value="BTN">BTN</option>
                                        <option value="BJB">BJB</option>
                                    </select>
                                    @error('nama_bank')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Next</button>
                    </div>
                </form>
                @endif
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        var rupiah = document.getElementById("pinjaman");
        rupiah.addEventListener("keyup", function(e) {
            // tambahkan 'Rp.' pada saat form di ketik
            // gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
            rupiah.value = formatRupiah(this.value, "Rp. ");
        });

        /* Fungsi formatRupiah */
        function formatRupiah(angka, prefix) {
            var number_string = angka.replace(/[^,\d]/g, "").toString(),
                split = number_string.split(","),
                sisa = split[0].length % 3,
                rupiah = split[0].substr(0, sisa),
                ribuan = split[0].substr(sisa).match(/\d{3}/gi);

            // tambahkan titik jika yang di input sudah menjadi angka ribuan
            if (ribuan) {
                separator = sisa ? "." : "";
                rupiah += separator + ribuan.join(".");
            }

            rupiah = split[1] != undefined ? rupiah + "," + split[1] : rupiah;
            return prefix == undefined ? rupiah : rupiah ? "Rp. " + rupiah : "";
        }

        function hanyaAngka(e){
            let charCode = (e.which) ? e.which : e.keyCode
            if (charCode > 32 && (charCode < 48 || charCode > 57)) {
                return false
            }
            return true
        }

    </script>
@endpush

@push('style')
    <link href="{{ asset('vendor/select2/css/select2.min.css') }}" rel="stylesheet" />
    <style>
        .select2 {
            width: 100%!important;
        }
    </style>
@endpush

@push('datatable')
    <script src="{{ asset('vendor/select2/js/select2.min.js') }}"></script>
    <script>
        let CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content')
        $('#kesatuan-select2').select2({
            placeholder: 'Kesatuan',
            ajax: {
                url: '{{ route('userpinjam.data-kesatuan') }}',
                type: 'post',
                data: params => ({
                    kesatuan: params.term,
                    _token: '{{ csrf_token() }}'
                }),
                processResults: res => ({
                    results: res
                }),
                cache: true
            }
        })

        $("#kotama").select2({placeholder: 'Kotama'})
    </script>
@endpush
