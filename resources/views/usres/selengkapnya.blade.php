@extends('layouts.basekpr')


@section('css')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
        integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
        crossorigin="" />
    <!--Ebaltab Css-->
    <link rel="stylesheet" href="{{ url('assets/css/properti-selengkapnya.css') }}">
@endsection

@section('content')
    <div class="mainContent">
        <div class="widgetAction">
            <form action="">
                <div class="wrapperForm kota">
                    <label for="kota">Kota</label>
                    <input type="text" id="kota">
                </div>

                <div class="wrapperForm hargaMinimal">
                    <label for="harga-min">Harga Minimal</label>
                    <input type="number" id="harga-min">
                </div>

                <div class="wrapperForm hargaMaximal">
                    <label for="harga-max">Harga Maximal</label>
                    <input type="number" id="harga-max">
                </div>

                <div class="wrapperForm tipeProperti">
                    <label for="tipeProperti">Tipe Properti</label>
                    <select class="form-tipeProperti" id="tipeProperti">
                        <option value="1">Apartemen</option>
                        <option value="2">Two</option>
                        <option value="3">Three</option>
                    </select>
                </div>

                <div class="wrapperForm kamarTidur">
                    <label for="kamarTidur">Kamar Tidur</label>
                    <select class="form-kamarTidur " id="kamarTidur">
                        <option selected>1</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                    </select>
                </div>

                <button class="cari">Cari</button>

            </form>
        </div>

        <div class="daftarPropertiContainer">
            <div class=" dropdown">
                <button class="btn filter dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    <svg width="26" height="26" viewBox="0 0 26 26" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M9.13584 12.8333C9.58845 13.4245 9.45315 12.9319 9.45315 24.716C9.45315 25.7705 10.786 26.3741 11.7255 25.7433C15.7397 23.0114 16.5418 22.7749 16.5418 21.497C16.5418 12.9097 16.4309 13.3926 16.8591 12.8333L23.3778 4.82422H2.61719L9.13584 12.8333Z"
                            fill="white" />
                        <path
                            d="M25.8396 0.653048C25.6067 0.250352 25.1498 0 24.6469 0H1.34679C0.260706 0 -0.378344 1.10586 0.244672 1.90938C0.249791 1.9171 0.173954 1.8234 1.37661 3.30078H24.6171C25.6419 2.04176 26.327 1.49779 25.8396 0.653048Z"
                            fill="white" />
                    </svg>
                    Urutkan
                </button>
                <ul class="dropdown-menu filter-menu" aria-labelledby="dropdownMenuButton1">
                    <li><a class="dropdown-item" href="#">Action</a></li>
                    <li><a class="dropdown-item" href="#">Another action</a></li>
                    <li><a class="dropdown-item" href="#">Something else here</a></li>
                </ul>
            </div>
            <div class="wrapperDaftarProperti">
                <div class="listDaftarProperti">




                        @foreach (DB::table('rumah')->get() as $item)
                        <div class="properti">
                        <div class="imagesProperti">
                            <img src="{{$item->GAMBAR}}" alt="">
                        </div>
                        <div class="detailProperti">
                            <div class="informationOfProperty">
                                <div class="tipeAndNamePerumahaan">
                                    <h1 class="tipeRumah">Tipe <span>36</span></h1>
                                    <a href="{{ route('detailRumah', ['id'=>$item->id]) }}" class="namaPerumahan">UTAMA GARDEN BINTARO</a>
                                </div>
                                <h1 class="hargaProperti">Rp <span>{{number_format($item->HARGA, 2, ',', '.')}}</span></h1>
                            </div>
                            <p class="location">{{$item->ALAMAT}} </p>
                            <p class="totalKavling"><span>30</span> Kavling Tersedia</p>
                            <p class="informationDeveloper">Oleh : <a href="#" class="nameDeveloper">{{$item->NAMA_DEV}}</a></p>

                            <div class="informationDetailProperty">
                                <div class="fasilitasProperti">
                                    <p class="luasTanah">LT : <span>{{$item->LA,"m"}}<sup>2</sup></span></p>
                                    <p class="luasBangunan">LB : <span>{{$item->LB,"m"}}<sup>2</sup></span></p>
                                    <div class="totalKamar">
                                        <svg width="25" height="25" viewBox="0 0 25 25" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M24.3795 12.1337H24.0254C23.6618 12.1337 23.3243 12.2478 23.0468 12.442V11.6388C23.0468 10.7219 22.3009 9.97593 21.3839 9.97593H18.3052C18.1029 9.97593 17.939 10.1399 17.939 10.3421C17.939 10.5444 18.1029 10.7083 18.3052 10.7083H21.3839C21.8969 10.7083 22.3144 11.1257 22.3144 11.6388V14.2398H9.15132V11.6388C9.15132 11.1257 9.5687 10.7083 10.0818 10.7083H16.5962C16.7984 10.7083 16.9624 10.5444 16.9624 10.3421C16.9624 10.1399 16.7984 9.97593 16.5962 9.97593H5.83154C6.12554 9.56445 6.24048 9.02964 6.09971 8.5041C6.04736 8.30874 5.84644 8.19282 5.65117 8.24512C5.45581 8.29746 5.33989 8.49829 5.39219 8.69365C5.53755 9.23603 5.2145 9.79556 4.67212 9.94087C4.12944 10.0863 3.57021 9.76313 3.4249 9.2208L2.7207 6.59268C2.57534 6.05029 2.89839 5.49077 3.44082 5.34546C3.98447 5.19985 4.54238 5.52183 4.68799 6.06553L4.94624 7.02935C4.99858 7.22471 5.19956 7.34062 5.39478 7.28833C5.59014 7.23599 5.70605 7.03516 5.65376 6.83979L5.39551 5.87598C5.14507 4.94141 4.18608 4.3875 3.25127 4.63799C3.04507 4.69326 2.85435 4.78364 2.68569 4.9041V4.72617C2.68569 3.78271 1.91812 3.01514 0.974658 3.01514H0.620605C0.278369 3.01509 0 3.29351 0 3.63564V21.3643C0 21.7064 0.278369 21.9848 0.620508 21.9848H2.06509C2.40723 21.9848 2.6856 21.7064 2.6856 21.3643V17.9875H3.10024C3.30249 17.9875 3.46645 17.8236 3.46645 17.6213C3.46645 17.4191 3.30249 17.2551 3.10024 17.2551H2.6856V14.9722H22.3143V17.2551H4.80933C4.60708 17.2551 4.44312 17.4191 4.44312 17.6213C4.44312 17.8236 4.60708 17.9875 4.80933 17.9875H22.3144V21.3643C22.3144 21.7064 22.5927 21.9848 22.9349 21.9848H24.3794C24.7216 21.9848 25 21.7064 25 21.3643V12.7542C25 12.4121 24.7216 12.1337 24.3795 12.1337ZM8.14478 10.7083H8.7042C8.52417 10.9741 8.4189 11.2944 8.4189 11.6388V14.2398H7.21436V11.6388C7.21436 11.1257 7.63174 10.7083 8.14478 10.7083ZM2.71743 9.4104C2.78457 9.66094 2.90313 9.88428 3.05864 10.0721C2.92573 10.1195 2.80059 10.1834 2.68564 10.2613V9.29185L2.71743 9.4104ZM1.95322 21.2524H0.732422V3.74751H0.974609C1.51421 3.74751 1.95322 4.18652 1.95322 4.72612V21.2524ZM2.68564 11.6388C2.68564 11.1257 3.10303 10.7083 3.61611 10.7083H6.76724C6.58716 10.9741 6.48193 11.2943 6.48193 11.6388V14.2398H2.68564V11.6388ZM24.2676 21.2524H23.0468V13.8448C23.0468 13.3052 23.4858 12.8662 24.0254 12.8662H24.2676V21.2524Z"
                                                fill="black" />
                                        </svg>
                                        <p class="valueKamar">3</p>
                                    </div>
                                    <div class="totalKamarMandi">
                                        <svg width="25" height="25" viewBox="0 0 25 25" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <g clip-path="url(#clip0)">
                                                <path
                                                    d="M3.95963 0C4.65 0 5.20963 0.559635 5.20963 1.25V1.66667H14.3763C15.5263 1.66802 16.4583 2.6 16.4596 3.75V5.83333H17.293C17.9833 5.83333 18.543 6.39297 18.543 7.08333V8.51875C20.3579 9.63745 21.4621 11.618 21.4596 13.75V14.2433C21.9573 14.4193 22.2908 14.8889 22.293 15.4167V16.25C22.293 16.4801 22.1064 16.6667 21.8763 16.6667H8.54297C8.31286 16.6667 8.1263 16.4801 8.1263 16.25V15.4167C8.12849 14.8889 8.46198 14.4193 8.95963 14.2433V13.75C8.95719 12.0908 9.61708 10.4993 10.793 9.32875C11.1197 9.01365 11.4835 8.73927 11.8763 8.51167V7.08333C11.8763 6.39297 12.4359 5.83333 13.1263 5.83333H13.9596V4.58333C13.9596 4.35323 13.7731 4.16667 13.543 4.16667H5.20963V5C5.20963 5.69036 4.65 6.25 3.95963 6.25H2.70963V0H3.95963ZM8.95963 15.4167V15.8333H21.4596V15.4167C21.4596 15.1866 21.2731 15 21.043 15H9.3763C9.1462 15 8.95963 15.1866 8.95963 15.4167ZM11.3801 9.91917C10.3618 10.9337 9.79057 12.3126 9.79297 13.75V14.1667H20.6263V13.75C20.6277 11.8673 19.6336 10.1242 18.0126 9.16667H12.4038C12.0311 9.37162 11.6869 9.62458 11.3801 9.91917ZM13.1263 6.66667C12.8962 6.66667 12.7096 6.85323 12.7096 7.08333V8.33333H17.7096V7.08333C17.7096 6.85323 17.5231 6.66667 17.293 6.66667H13.1263ZM5.20963 3.33333H13.543C14.2333 3.33333 14.793 3.89297 14.793 4.58333V5.83333H15.6263V3.75C15.6263 3.05964 15.0667 2.5 14.3763 2.5H5.20963V3.33333ZM3.54297 5.41667H3.95963C4.18974 5.41667 4.3763 5.2301 4.3763 5V1.25C4.3763 1.0199 4.18974 0.833333 3.95963 0.833333H3.54297V5.41667Z"
                                                    fill="black" />
                                                <path
                                                    d="M15.2083 17.5C15.4384 17.5 15.625 17.6866 15.625 17.9167V19.5833C15.625 19.8134 15.4384 20 15.2083 20C14.9782 20 14.7917 19.8134 14.7917 19.5833V17.9167C14.7917 17.6866 14.9782 17.5 15.2083 17.5Z"
                                                    fill="black" />
                                                <path
                                                    d="M15.2083 20.8334C15.4384 20.8334 15.625 21.0199 15.625 21.25V22.9167C15.625 23.1468 15.4384 23.3334 15.2083 23.3334C14.9782 23.3334 14.7917 23.1468 14.7917 22.9167V21.25C14.7917 21.0199 14.9782 20.8334 15.2083 20.8334Z"
                                                    fill="black" />
                                                <path
                                                    d="M10.2083 19.1667C10.4384 19.1667 10.625 19.3533 10.625 19.5834V21.2501C10.625 21.4802 10.4384 21.6667 10.2083 21.6667C9.97823 21.6667 9.79166 21.4802 9.79166 21.2501V19.5834C9.79166 19.3533 9.97823 19.1667 10.2083 19.1667Z"
                                                    fill="black" />
                                                <path
                                                    d="M13.5423 19.1667C13.7724 19.1667 13.959 19.3533 13.959 19.5834V21.2501C13.959 21.4802 13.7724 21.6667 13.5423 21.6667C13.3122 21.6667 13.1257 21.4802 13.1257 21.2501V19.5834C13.1257 19.3533 13.3122 19.1667 13.5423 19.1667Z"
                                                    fill="black" />
                                                <path
                                                    d="M16.8744 19.1667C17.1045 19.1667 17.291 19.3533 17.291 19.5834V21.2501C17.291 21.4802 17.1045 21.6667 16.8744 21.6667C16.6442 21.6667 16.4577 21.4802 16.4577 21.2501V19.5834C16.4577 19.3533 16.6442 19.1667 16.8744 19.1667Z"
                                                    fill="black" />
                                                <path
                                                    d="M20.2083 19.1667C20.4384 19.1667 20.625 19.3533 20.625 19.5834V21.2501C20.625 21.4802 20.4384 21.6667 20.2083 21.6667C19.9782 21.6667 19.7917 21.4802 19.7917 21.2501V19.5834C19.7917 19.3533 19.9782 19.1667 20.2083 19.1667Z"
                                                    fill="black" />
                                                <path
                                                    d="M18.5423 17.5C18.7724 17.5 18.959 17.6866 18.959 17.9167V19.5833C18.959 19.8134 18.7724 20 18.5423 20C18.3122 20 18.1257 19.8134 18.1257 19.5833V17.9167C18.1257 17.6866 18.3122 17.5 18.5423 17.5Z"
                                                    fill="black" />
                                                <path
                                                    d="M11.8743 17.5C12.1045 17.5 12.291 17.6866 12.291 17.9167V19.5833C12.291 19.8134 12.1045 20 11.8743 20C11.6442 20 11.4577 19.8134 11.4577 19.5833V17.9167C11.4577 17.6866 11.6442 17.5 11.8743 17.5Z"
                                                    fill="black" />
                                                <path
                                                    d="M11.8743 20.8334C12.1045 20.8334 12.291 21.0199 12.291 21.25V22.9167C12.291 23.1468 12.1045 23.3334 11.8743 23.3334C11.6442 23.3334 11.4577 23.1468 11.4577 22.9167V21.25C11.4577 21.0199 11.6442 20.8334 11.8743 20.8334Z"
                                                    fill="black" />
                                                <path
                                                    d="M18.5423 20.8334C18.7724 20.8334 18.959 21.0199 18.959 21.25V22.9167C18.959 23.1468 18.7724 23.3334 18.5423 23.3334C18.3122 23.3334 18.1257 23.1468 18.1257 22.9167V21.25C18.1257 21.0199 18.3122 20.8334 18.5423 20.8334Z"
                                                    fill="black" />
                                                <path
                                                    d="M16.8744 22.5C17.1045 22.5 17.291 22.6866 17.291 22.9167V24.5833C17.291 24.8134 17.1045 25 16.8744 25C16.6442 25 16.4577 24.8134 16.4577 24.5833V22.9167C16.4577 22.6866 16.6442 22.5 16.8744 22.5Z"
                                                    fill="black" />
                                                <path
                                                    d="M13.5423 22.5C13.7724 22.5 13.959 22.6866 13.959 22.9167V24.5833C13.959 24.8134 13.7724 25 13.5423 25C13.3122 25 13.1257 24.8134 13.1257 24.5833V22.9167C13.1257 22.6866 13.3122 22.5 13.5423 22.5Z"
                                                    fill="black" />
                                            </g>
                                            <defs>
                                                <clipPath id="clip0">
                                                    <rect width="25" height="25" fill="white"
                                                        transform="matrix(-1 0 0 1 25 0)" />
                                                </clipPath>
                                            </defs>
                                        </svg>
                                        <p class="valueKamarMandi">3</p>
                                    </div>
                                </div>
                                {{-- <div class="totalKPRdanBunga">
                                    <div class="kpr">
                                        <h1>KPR Mulai Dari :
                                            <span class="valueKPR">2.059.245/<span
                                                    class="dateKPR">Bulan</span></span>
                                        </h1>
                                    </div>
                                    <div class="sukuBunga">
                                        <h1>Suku Bunga :
                                            <span class="valueSukuBunga">6.75%</span>
                                        </h1>
                                    </div>
                                </div> --}}
                            </div>
                        </div>
                    </div>
                        @endforeach


                </div>
                <div class="wrapperMaps">
                    <div id="mapid"></div>
                </div>
            </div>

        </div>


    </div>

    <footer>
        <p>Copyright 2021 ?? DITKUAD</p>
    </footer>
@endsection

@section('js')
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
        integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
        crossorigin="">
    </script>

<script>

    function showPosition(position) {

        var mymap = L.map('mapid').setView([position.coords.latitude, position.coords.longitude], 13);
        var marker = L.marker([position.coords.latitude, position.coords.longitude]).addTo(mymap);

        L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
            attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, Imagery ?? <a href="https://www.mapbox.com/">Mapbox</a>',
            maxZoom: 30,
            id: 'mapbox/streets-v11',
            tileSize: 512,
            zoomOffset: -1,
            accessToken: 'sk.eyJ1Ijoic2lzZm9iZXRhIiwiYSI6ImNrdG16MDl1ajIwMzMycG82eTJ1aWdvYTEifQ.fwK1xs-4cZUel35Nn4Aupw'
        }).addTo(mymap);
    }
</script>

<script>
    $(document).ready(function() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(showPosition);
        } else {
            x.innerHTML = "Geolocation is not supported by this browser.";
        }
    });
</script>
@endsection
