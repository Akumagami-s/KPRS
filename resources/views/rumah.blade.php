@extends('layouts.app', ['title' => 'KPR | Pilihan Rumah'])
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card mx-3">
            <div class="card-header">
                <div class="d-flex justify-content-between mb-4">
                    <span>
                        <h5>
                            Pilihan Rumah
                        </h5>
                    </span>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                        @forelse ( $rumahs as $rumah )
                    <div class="col-xl-3 col-sm-6 xl-4">
                        <div class="card">
                            <div class="product-box">
                                <div class="product-img"><img class="img-fluid" src="{{asset('gambar_rumah/'. $rumah->gambar->gambar_satu)}}"
                                        style="object-fit: contain; object-position: center; width: 100%; max-height: 160px">
                                    <div class="product-hover">
                                        <ul>
                                            <li>
                                                <a class="btn" href="{{route('show', $rumah->id)}}"><i class="icon-eye"></i></a>
                                            </li>
                                            {{-- <li>
                                                <a class="btn" href="{{ route('userpinjam.rumah', $rumah->id) }}"><i class="fa fa-plus"></i></a>
                                            </li> --}}
                                        </ul>
                                    </div>
                                </div>
                                <div class="product-details">
                                    <h4 class="nama-rumah" onclick="document.location.href='{{ route('show', $rumah->id) }}'">{{ $rumah->nama_rumah }}</h4>
                                    <p> {{ $rumah->alamat }}</p>
                                    <div class="product-price">{{ "Rp. " . number_format($rumah->harga, 0,',','.') }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                        @empty
                        <span>Tidak ada rumah yang tersedia</span>
                        @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('style')
    <style>
        .nama-rumah:hover {
            text-decoration: underline;
            cursor: pointer;
        }
    </style>
@endpush
