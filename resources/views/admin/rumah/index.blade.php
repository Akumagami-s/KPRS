@extends('layouts.app', ['title' => 'KPR | Data Rumah'])
@section('dashboard', 'DATA RUMAH')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    @include('layouts.partials.error')
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('admin.rumah.create') }}" class="btn btn-primary btn-md">Add</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Status</th>
                                    <th>Nama Perumahan</th>
                                    <th>Deskripsi</th>
                                    <th>Gambar Satu</th>
                                    <th>Gambar Dua</th>
                                    <th>Gambar Tiga</th>
                                    <th>Gambar Empat</th>
                                    <th>Gambar Lima</th>
                                    {{-- @if ($home)
                                        @if ($home->gambar->gambar_satu)
                                            <th>Gambar Satu</th>
                                        @endif
                                        @if ($home->gambar->gambar_kedua)
                                            <th>Gambar Kedua</th>
                                        @endif
                                        @if ($home->gambar->gambar_ketiga)
                                            <th>Gambar Ketiga</th>
                                        @endif
                                        @if ($home->gambar->gambar_keempat)
                                            <th>Gambar Keempat</th>
                                        @endif
                                        @if ($home->gambar->gambar_kelima)
                                            <th>Gambar Kelima</th>
                                        @endif
                                    @endif --}}
                                    <th>Alamat</th>
                                    <th>Luas Tanah</th>
                                    <th>Luas Bangunan</th>
                                    <th>Fasilitas</th>
                                    <th>Harga</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            @forelse ($data as $rumah)
                                <tbody>
                                    <tr>
                                        <th>{{ $loop->iteration + $data->firstItem() - 1 . '.' }}</th>
                                        <td>{!! $rumah->StatusRumah !!}</td>
                                        <td>{{ $rumah->nama_rumah }}</td>
                                        @if ($rumah->deskripsi)
                                            <td>
                                                {{ \Str::limit($rumah->deskripsi, 60) }}
                                            </td>
                                        @else
                                            <td style="text-align: center;">
                                                <b class="badge badge-pill badge-light"> - </b>
                                            </td>
                                        @endif
                                        @if ($rumah->gambar->gambar_satu)
                                            <td>
                                                <img src="{{ asset('gambar_rumah/' . $rumah->gambar->gambar_satu) }}"
                                                    style="width: 60px; height: 60px; object-fit: cover; object-position: center;"
                                                    alt="thumbnail">
                                            </td>
                                        @else
                                            <td style="text-align: center;">
                                                <b class="badge badge-pill badge-light"> - </b>
                                            </td>
                                        @endif
                                        @if ($rumah->gambar->gambar_kedua)
                                            <td>
                                                <img src="{{ asset('gambar_rumah/' . $rumah->gambar->gambar_kedua) }}"
                                                    style="width: 60px; height: 60px; object-fit: cover; object-position: center;"
                                                    alt="thumbnail">
                                            </td>
                                        @else
                                            <td style="text-align: center;">
                                                <b class="badge badge-pill badge-light"> - </b>
                                            </td>
                                        @endif
                                        @if ($rumah->gambar->gambar_ketiga)
                                            <td>
                                                <img src="{{ asset('gambar_rumah/' . $rumah->gambar->gambar_ketiga) }}"
                                                    style="width: 60px; height: 60px; object-fit: cover; object-position: center;"
                                                    alt="thumbnail">
                                            </td>
                                        @else
                                            <td style="text-align: center;">
                                                <b class="badge badge-pill badge-light"> - </b>
                                            </td>
                                        @endif
                                        @if ($rumah->gambar->gambar_keempat)
                                            <td>
                                                <img src="{{ asset('gambar_rumah/' . $rumah->gambar->gambar_keempat) }}"
                                                    style="width: 60px; height: 60px; object-fit: cover; object-position: center;"
                                                    alt="thumbnail">
                                            </td>
                                        @else
                                            <td style="text-align: center;">
                                                <b class="badge badge-pill badge-light"> - </b>
                                            </td>
                                        @endif
                                        @if ($rumah->gambar->gambar_kelima)
                                            <td>
                                                <img src="{{ asset('gambar_rumah/' . $rumah->gambar->gambar_kelima) }}"
                                                    style="width: 60px; height: 60px; object-fit: cover; object-position: center;"
                                                    alt="thumbnail">
                                            </td>
                                        @else
                                            <td style="text-align: center;">
                                                <b class="badge badge-pill badge-light"> - </b>
                                            </td>
                                        @endif
                                        <td>{{ $rumah->alamat }}</td>
                                        <td>{{ $rumah->luas_tanah }}</td>
                                        <td>{{ $rumah->luas_bangunan }}</td>
                                        <td>{{ $rumah->fasilitas()->get()->implode('nama_fasilitas', ', ') }}</td>
                                        <td>{{ 'Rp. ' . number_format($rumah->harga, 0, ',', '.') }}</td>
                                        <td>
                                            <a href="{{ route('admin.rumah.edit', $rumah->id) }}" style="float: left;"
                                                class="mr-1"><i class="fa fa-pencil-square-o"
                                                    style="color: rgb(0, 241, 12);"></i></a>
                                            <button type="submit" onclick="deleteRumah('{{ $rumah->id }}')"
                                                style="background-color: transparent; border: none;"><i
                                                    class="icon-trash" style="color: red;"></i></button>
                                            <form action="{{ route('admin.rumah.destroy', $rumah->id) }}" method="post"
                                                id="DeleteRumah{{ $rumah->id }}">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                            <script>
                                                function deleteRumah(id) {
                                                    Swal.fire({
                                                        title: 'Apakah Anda Yakin?',
                                                        text: "Anda tidak akan bisa mengembalikan data!",
                                                        icon: 'warning',
                                                        showCancelButton: true,
                                                        confirmButtonColor: '#3085d6',
                                                        cancelButtonColor: '#d33',
                                                        confirmButtonText: 'Ya, hapus ini!'
                                                    }).then((result) => {
                                                        if (result.isConfirmed) {
                                                            Swal.fire({
                                                                title: "Sedang menghapus Rumah",
                                                                showConfirmButton: false,
                                                                timer: 2300,
                                                                timerProgressBar: true,
                                                                onOpen: () => {
                                                                    document.getElementById(
                                                                        `DeleteRumah${id}`).submit();
                                                                    Swal.showLoading();
                                                                }
                                                            });
                                                        }
                                                    })
                                                }
                                            </script>
                                        </td>
                                    </tr>
                                </tbody>
                            @empty
                                <tbody>
                                    <tr>
                                        <th colspan="15" style="color: red; text-align: center;">Data Empty!</th>
                                    </tr>
                                </tbody>
                            @endforelse
                        </table>
                    </div>
                </div>
                <div class="card-footer">
                    {{ $data->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
