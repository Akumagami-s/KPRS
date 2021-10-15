<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>eKPR | Dashboard</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!--Bootstrap Asset-->
    <link rel="stylesheet" href="{{ url('assets/vendors/bootstrap/css/bootstrap.min.css') }}">
    <!--Ebaltab Css-->
    <link rel="stylesheet" href="{{ url('assets/css/kelolaUser.css') }}">
    <link rel="stylesheet" href="{{ url('assets/css/mastereBaltab.css') }}">
    <link rel="stylesheet" href="{{ url('assets/css/dashboardEkpr.css') }}">
    <!--unicons-->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <!--Component-->
    <link rel="stylesheet" href="{{ url('assets/component/navbar.css') }}">
    <link rel="stylesheet" href="{{ url('assets/css/app.css') }}">
    <!--slick Css-->
    <link rel="stylesheet" href="{{ url('assets/vendors/slick/slick.css') }}">
    <link rel="stylesheet" href="{{ url('assets/vendors/slick/slick-theme.css') }}">

    <!--Data Table-->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.2/css/dataTables.bootstrap5.min.css">

</head>

<body>
    @include('sweetalert::alert')
    <div id="mainHeader">

        <!--Navbar-->
        <nav class="navbar navbar-light ">
            <div class="container-fluid">
                <a class="navbar-brand" href={{ url()->previous() }}>
                    <img src="../assets/img/tni_logo.png" alt="">
                    <div class="brand-title">
                        <h1>SISFOBETA 4.0</h1>
                        <p>SISTEM INFORMASI BENDAHARA TWP AD ONLINE</p>
                    </div>
                </a>

                <div class="userControl">
                    <div class="notification">
                        <div class="dropdown">

                            <button class="btnNotification" type="button" id="notification" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                <ion-icon name="notifications-outline"></ion-icon>
                                <div id="numberNotif" class="numberNotif">1
                                    {{-- {{ DB::table('notifikasi')->where('nrp', Auth::user()->nrp)->where('is_read', 0)->count() }} --}}
                                </div>
                            </button>

                            <ul class="dropdown-menu" aria-labelledby="notification">
                                <li>
                                    <a class="dropdown-item" href="#">
                                        <div class="iconMassage">
                                            <ion-icon name="chatbubble-ellipses"></ion-icon>
                                        </div>
                                        <div class="wrapperMessage">
                                            <div class="messageName">
                                                <h1>Selamat Datang Di SISFOBETA 4.0</h1>
                                            </div>
                                            <div class="messageContent">
                                                <p>aplikasi yang terintegrasi untuk memudahkan prajurit di seluruh
                                                    Indonesia dimanapun dan kapanpun untuk mendapatkan informasi iuran
                                                    twp, baltab , dan kpr secara online dan up to date</p>
                                            </div>
                                        </div>
                                        <div class="messageTime">
                                            <span>19.30</span>
                                        </div>
                                    </a>
                                </li>

                            </ul>
                        </div>
                    </div>

                    <div class="searchBox">
                        <ion-icon name="search" class="searchIcon"></ion-icon>
                        <input class="searchInput" type="search" name="search" placeholder="Search">
                    </div>
                    <div class="dropdown profil">
                        <button class="dropdown-toggle" type="button" id="profilDropdown" data-bs-toggle="dropdown">
                            @if (!is_null(Auth::user()->thumb))
                                <img style="min-width:40px;min-height:40px;max-width:40px;max-height:40px;" src="{{ Auth::user()->thumb }}" alt="">

                            @else
                                <img style="min-width:40px;min-height:40px;max-width:40px;max-height:40px;" src="https://img2.pngdownload.id/20180618/hjz/kisspng-computer-icons-user-profile-business-san-giovanni-in-persiceto-5b281350950f79.9650402715293530406106.jpg"
                                    alt="">
                            @endif
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="profilDropdown">
                            <li><a class="dropdown-item" href="https://asiabytes.tech/profile">Profil</a></li>
                            <li><button class="dropdown-item" href="https://asiabytes.tech/logoutUser">Logout</button>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>

        <div class="pembungkus">
            <div class="menu">
                <a class="nav-link ekprDashboard active" href="https://asiabytes.tech/kpr/home" aria-selected="true">

                    <svg width="45" height="45" viewBox="0 0 45 45" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M44.5484 21.3627L41.3328 18.1499L23.6381 0.470604C23.01 -0.156868 21.9917 -0.156868 21.3636 0.470604L3.66878 18.1499L0.451582 21.3644C-0.165598 22.0029 -0.147972 23.0203 0.491075 23.637C1.11447 24.2385 2.10273 24.2385 2.72614 23.637L3.19581 23.1644V43.3928C3.19581 44.2804 3.91601 45 4.80445 45H40.194C41.0824 45 41.8026 44.2804 41.8026 43.3928V23.1644L42.2739 23.6354C42.9129 24.252 43.9312 24.2343 44.5484 23.5959C45.1505 22.973 45.1505 21.9855 44.5484 21.3627ZM27.3251 41.7856H17.6734V28.9279H27.3251V41.7856ZM38.5853 41.7856H30.5423V27.3207C30.5423 26.433 29.8221 25.7135 28.9336 25.7135H16.0648C15.1763 25.7135 14.4561 26.433 14.4561 27.3207V41.7856H6.41309V19.95L22.4992 3.87786L38.5853 19.95V41.7856Z">
                    </svg>
                    <p>Dashboard</p>
                </a>


                {{-- @if (Auth::user()->role <= 1) --}}


                <a style="display:none;" class="nav-link ekprDataKPR" href="{{ route('datakpr') }}" aria-selected="true">

                    <svg width="35" height="45" viewBox="0 0 35 45" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M32.7174 0H2.28261C1.022 0 0 0.915816 0 2.04545V42.9544C0 43.7407 0.502935 44.4574 1.29378 44.7981C2.08463 45.1387 3.02324 45.043 3.70848 44.5517L17.5 34.6649L31.2915 44.5517C31.7042 44.8476 32.2087 44.9999 32.7177 44.9999C33.0537 44.9999 33.3918 44.9335 33.7062 44.7981C34.4971 44.4576 35 43.7409 35 42.9544V2.04545C35 0.915816 33.978 0 32.7174 0ZM30.4348 38.6985L18.9259 30.4482C18.5091 30.1494 18.0045 29.9999 17.5 29.9999C16.9955 29.9999 16.4909 30.1494 16.0741 30.4482L4.56522 38.6985V4.0909H30.4348V38.6985Z"
                            fill="#08850D" />
                    </svg>
                    <p>Data KPR</p>
                </a>

                <a style="display:none;" class="nav-link ekprManagementRumah" href="{{ route('datarumah') }}" aria-selected="true">

                    <svg width="45" height="45" viewBox="0 0 45 45" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M44.5484 21.3627L41.3328 18.1499L23.6381 0.470604C23.01 -0.156868 21.9917 -0.156868 21.3636 0.470604L3.66878 18.1499L0.451582 21.3644C-0.165598 22.0029 -0.147972 23.0203 0.491075 23.637C1.11447 24.2385 2.10273 24.2385 2.72614 23.637L3.19581 23.1644V43.3928C3.19581 44.2804 3.91601 45 4.80445 45H40.194C41.0824 45 41.8026 44.2804 41.8026 43.3928V23.1644L42.2739 23.6354C42.9129 24.252 43.9312 24.2343 44.5484 23.5959C45.1505 22.973 45.1505 21.9855 44.5484 21.3627ZM27.3251 41.7856H17.6734V28.9279H27.3251V41.7856ZM38.5853 41.7856H30.5423V27.3207C30.5423 26.433 29.8221 25.7135 28.9336 25.7135H16.0648C15.1763 25.7135 14.4561 26.433 14.4561 27.3207V41.7856H6.41309V19.95L22.4992 3.87786L38.5853 19.95V41.7856Z"
                            fill="#08850D" />
                    </svg>
                    <p>Management Rumah</p>
                </a>

                <a style="display:none;" class="nav-link ekprPengajuan" href="{{ route('pengajuan') }}" aria-selected="true">

                    <svg width="45" height="45" viewBox="0 0 45 45" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M17.8125 28.125H6.5625C6.045 28.125 5.625 27.705 5.625 27.1875C5.625 26.67 6.045 26.25 6.5625 26.25H17.8125C18.33 26.25 18.75 26.67 18.75 27.1875C18.75 27.705 18.33 28.125 17.8125 28.125Z"
                            fill="#08850D" />
                        <path
                            d="M15.9375 33.75H6.5625C6.045 33.75 5.625 33.33 5.625 32.8125C5.625 32.295 6.045 31.875 6.5625 31.875H15.9375C16.455 31.875 16.875 32.295 16.875 32.8125C16.875 33.33 16.455 33.75 15.9375 33.75Z"
                            fill="#08850D" />
                        <path
                            d="M15.9375 13.125C13.8694 13.125 12.1875 11.4431 12.1875 9.375C12.1875 7.30687 13.8694 5.625 15.9375 5.625C18.0056 5.625 19.6875 7.30687 19.6875 9.375C19.6875 11.4431 18.0056 13.125 15.9375 13.125ZM15.9375 7.5C14.9044 7.5 14.0625 8.34188 14.0625 9.375C14.0625 10.4081 14.9044 11.25 15.9375 11.25C16.9706 11.25 17.8125 10.4081 17.8125 9.375C17.8125 8.34188 16.9706 7.5 15.9375 7.5Z"
                            fill="#08850D" />
                        <path
                            d="M22.5 22.5C21.9825 22.5 21.5625 22.08 21.5625 21.5625V19.6875C21.5625 18.1369 20.3006 16.875 18.75 16.875H13.125C11.5744 16.875 10.3125 18.1369 10.3125 19.6875V21.5625C10.3125 22.08 9.8925 22.5 9.375 22.5C8.8575 22.5 8.4375 22.08 8.4375 21.5625V19.6875C8.4375 17.1037 10.5412 15 13.125 15H18.75C21.3337 15 23.4375 17.1037 23.4375 19.6875V21.5625C23.4375 22.08 23.0175 22.5 22.5 22.5Z"
                            fill="#08850D" />
                        <path
                            d="M17.8125 39.375H4.6875C2.10375 39.375 0 37.2713 0 34.6875V4.6875C0 2.10375 2.10375 0 4.6875 0H27.1875C29.7713 0 31.875 2.10375 31.875 4.6875V16.05C31.875 16.5675 31.455 16.9875 30.9375 16.9875C30.42 16.9875 30 16.5675 30 16.05V4.6875C30 3.13687 28.7381 1.875 27.1875 1.875H4.6875C3.13688 1.875 1.875 3.13687 1.875 4.6875V34.6875C1.875 36.2381 3.13688 37.5 4.6875 37.5H17.8125C18.33 37.5 18.75 37.92 18.75 38.4375C18.75 38.955 18.33 39.375 17.8125 39.375Z"
                            fill="#08850D" />
                        <path
                            d="M32.8125 45C26.0925 45 20.625 39.5325 20.625 32.8125C20.625 26.0925 26.0925 20.625 32.8125 20.625C39.5325 20.625 45 26.0925 45 32.8125C45 39.5325 39.5325 45 32.8125 45ZM32.8125 22.5C27.1256 22.5 22.5 27.1256 22.5 32.8125C22.5 38.4994 27.1256 43.125 32.8125 43.125C38.4994 43.125 43.125 38.4994 43.125 32.8125C43.125 27.1256 38.4994 22.5 32.8125 22.5Z"
                            fill="#08850D" />
                        <path
                            d="M30.9375 37.4999C30.69 37.4999 30.45 37.4005 30.2737 37.2262L26.5237 33.4762C26.1581 33.1105 26.1581 32.5162 26.5237 32.1505C26.8894 31.7849 27.4837 31.7849 27.8494 32.1505L30.8906 35.1918L36.7931 28.4455C37.1344 28.0537 37.7269 28.0143 38.1169 28.3574C38.5069 28.6987 38.5462 29.2912 38.205 29.6812L31.6425 37.1812C31.4719 37.3762 31.2262 37.4924 30.9675 37.4999C30.9581 37.4999 30.9469 37.4999 30.9375 37.4999Z"
                            fill="#08850D" />
                    </svg>
                    <p>Pengajuan</p>
                </a>

                <a class="nav-link ekprSimulasi" href="{{ route('simulasi') }}" aria-selected="true">

                    <svg width="45" height="45" viewBox="0 0 45 45" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <g clip-path="url(#clip0)">
                            <path
                                d="M16.9 22.5396H8.03809C7.67395 22.5396 7.37891 22.8347 7.37891 23.1987C7.37891 23.5628 7.67395 23.8579 8.03809 23.8579H16.9C17.2641 23.8579 17.5592 23.5628 17.5592 23.1987C17.5592 22.8347 17.2641 22.5396 16.9 22.5396Z"
                                fill="#08850D" />
                            <path
                                d="M16.9 28.2888H8.03809C7.67395 28.2888 7.37891 28.584 7.37891 28.948C7.37891 29.312 7.67395 29.6072 8.03809 29.6072H16.9C17.2641 29.6072 17.5592 29.312 17.5592 28.948C17.5592 28.584 17.2641 28.2888 16.9 28.2888Z"
                                fill="#08850D" />
                            <path
                                d="M16.9 34.0381H8.03809C7.67395 34.0381 7.37891 34.3332 7.37891 34.6973C7.37891 35.0613 7.67395 35.3564 8.03809 35.3564H16.9C17.2641 35.3564 17.5592 35.0613 17.5592 34.6973C17.5592 34.3332 17.2641 34.0381 16.9 34.0381Z"
                                fill="#08850D" />
                            <path
                                d="M24.2925 27.4678H25.6915C26.0557 27.4678 26.3507 27.1726 26.3507 26.8086C26.3507 26.4446 26.0557 26.1494 25.6915 26.1494H24.2925C23.9283 26.1494 23.6333 26.4446 23.6333 26.8086C23.6333 27.1726 23.9284 27.4678 24.2925 27.4678Z"
                                fill="#08850D" />
                            <path
                                d="M29.9415 26.1494H28.5425C28.1783 26.1494 27.8833 26.4446 27.8833 26.8086C27.8833 27.1726 28.1783 27.4678 28.5425 27.4678H29.9415C30.3057 27.4678 30.6007 27.1726 30.6007 26.8086C30.6007 26.4446 30.3056 26.1494 29.9415 26.1494Z"
                                fill="#08850D" />
                            <path
                                d="M34.1915 26.1494H32.7925C32.4283 26.1494 32.1333 26.4446 32.1333 26.8086C32.1333 27.1726 32.4283 27.4678 32.7925 27.4678H34.1915C34.5557 27.4678 34.8507 27.1726 34.8507 26.8086C34.8507 26.4446 34.5557 26.1494 34.1915 26.1494Z"
                                fill="#08850D" />
                            <path
                                d="M38.4419 26.1494H37.043C36.6788 26.1494 36.3838 26.4446 36.3838 26.8086C36.3838 27.1726 36.6788 27.4678 37.043 27.4678H38.4419C38.8061 27.4678 39.1011 27.1726 39.1011 26.8086C39.1011 26.4446 38.806 26.1494 38.4419 26.1494Z"
                                fill="#08850D" />
                            <path
                                d="M24.2925 30.8955H25.6915C26.0557 30.8955 26.3507 30.6004 26.3507 30.2363C26.3507 29.8723 26.0557 29.5771 25.6915 29.5771H24.2925C23.9283 29.5771 23.6333 29.8723 23.6333 30.2363C23.6333 30.6004 23.9284 30.8955 24.2925 30.8955Z"
                                fill="#08850D" />
                            <path
                                d="M29.9415 29.5771H28.5425C28.1783 29.5771 27.8833 29.8723 27.8833 30.2363C27.8833 30.6004 28.1783 30.8955 28.5425 30.8955H29.9415C30.3057 30.8955 30.6007 30.6004 30.6007 30.2363C30.6007 29.8723 30.3056 29.5771 29.9415 29.5771Z"
                                fill="#08850D" />
                            <path
                                d="M34.1915 29.5771H32.7925C32.4283 29.5771 32.1333 29.8723 32.1333 30.2363C32.1333 30.6004 32.4283 30.8955 32.7925 30.8955H34.1915C34.5557 30.8955 34.8507 30.6004 34.8507 30.2363C34.8507 29.8723 34.5557 29.5771 34.1915 29.5771Z"
                                fill="#08850D" />
                            <path
                                d="M38.4419 29.5771H37.043C36.6788 29.5771 36.3838 29.8723 36.3838 30.2363C36.3838 30.6004 36.6788 30.8955 37.043 30.8955H38.4419C38.8061 30.8955 39.1011 30.6004 39.1011 30.2363C39.1011 29.8723 38.806 29.5771 38.4419 29.5771Z"
                                fill="#08850D" />
                            <path
                                d="M24.2925 34.3232H25.6915C26.0557 34.3232 26.3507 34.0281 26.3507 33.6641C26.3507 33.3 26.0557 33.0049 25.6915 33.0049H24.2925C23.9283 33.0049 23.6333 33.3 23.6333 33.6641C23.6333 34.0281 23.9284 34.3232 24.2925 34.3232Z"
                                fill="#08850D" />
                            <path
                                d="M29.9415 33.0049H28.5425C28.1783 33.0049 27.8833 33.3 27.8833 33.6641C27.8833 34.0281 28.1783 34.3232 28.5425 34.3232H29.9415C30.3057 34.3232 30.6007 34.0281 30.6007 33.6641C30.6007 33.3 30.3056 33.0049 29.9415 33.0049Z"
                                fill="#08850D" />
                            <path
                                d="M34.1915 33.0049H32.7925C32.4283 33.0049 32.1333 33.3 32.1333 33.6641C32.1333 34.0281 32.4283 34.3232 32.7925 34.3232H34.1915C34.5557 34.3232 34.8507 34.0281 34.8507 33.6641C34.8507 33.3 34.5557 33.0049 34.1915 33.0049Z"
                                fill="#08850D" />
                            <path
                                d="M38.4419 33.0049H37.043C36.6788 33.0049 36.3838 33.3 36.3838 33.6641C36.3838 34.0281 36.6788 34.3232 37.043 34.3232H38.4419C38.8061 34.3232 39.1011 34.0281 39.1011 33.6641C39.1011 33.3 38.806 33.0049 38.4419 33.0049Z"
                                fill="#08850D" />
                            <path
                                d="M9.49229 15.9751C9.18784 15.7758 8.77915 15.8613 8.57981 16.1658C8.38048 16.4705 8.46591 16.8791 8.77062 17.0783C9.73549 17.7096 10.3869 17.884 11.2516 17.9237V18.8111C11.2516 19.1751 11.5466 19.4703 11.9108 19.4703C12.2749 19.4703 12.57 19.1751 12.57 18.8111V17.8744C14.2431 17.5785 15.2201 16.2138 15.4343 14.9397C15.7053 13.328 14.8616 11.9266 13.285 11.3693C13.0277 11.2783 12.7904 11.1912 12.57 11.1069V7.42055C13.2115 7.54605 13.5956 7.8745 13.6264 7.90148C13.894 8.14459 14.3083 8.12666 14.554 7.86035C14.8009 7.59272 14.784 7.17568 14.5164 6.92889C14.4742 6.88995 13.7511 6.23965 12.57 6.08566V5.29175C12.57 4.92771 12.2749 4.63257 11.9108 4.63257C11.5466 4.63257 11.2516 4.92771 11.2516 5.29175V6.13638C11.1219 6.16283 10.9891 6.19614 10.8534 6.23701C9.81872 6.54867 9.04546 7.43505 8.83522 8.55029C8.64415 9.56437 8.96706 10.5408 9.67818 11.0985C10.0728 11.408 10.5672 11.6913 11.2516 11.9926V16.6051C10.6106 16.5703 10.1967 16.4359 9.49229 15.9751ZM12.57 12.5136C12.6597 12.5462 12.7513 12.579 12.8457 12.6123C14.2848 13.121 14.1958 14.355 14.1342 14.7212C14.0097 15.4621 13.4774 16.2515 12.57 16.5199V12.5136ZM10.4917 10.061C10.1694 9.80836 10.0311 9.32294 10.1308 8.79436C10.2238 8.30086 10.5624 7.70145 11.2336 7.49921C11.2396 7.49736 11.2455 7.49596 11.2516 7.4942V10.5339C10.9411 10.3738 10.6928 10.2188 10.4917 10.061Z"
                                fill="#08850D" />
                            <path
                                d="M36.9991 41.1209C36.635 41.1209 36.34 41.416 36.34 41.78V42.2514C36.34 43.04 35.6984 43.6816 34.9097 43.6816H5.21833C4.4296 43.6816 3.78809 43.04 3.78809 42.2514V2.7486C3.78809 1.95996 4.4296 1.31836 5.21833 1.31836H28.2815C28.3512 1.31836 28.4199 1.32513 28.4879 1.33506V6.84694C28.4879 8.12813 29.5302 9.17042 30.8114 9.17042H36.3233C36.3332 9.23845 36.34 9.307 36.34 9.3767V12.5235C36.34 12.8876 36.635 13.1827 36.9991 13.1827C37.3633 13.1827 37.6583 12.8876 37.6583 12.5235V9.3767C37.6583 8.62321 37.2975 7.87544 36.8672 7.44776C36.5967 7.17715 30.2323 0.812109 30.2251 0.805078L30.2101 0.790225C30.2096 0.789697 30.209 0.789082 30.2084 0.788555L30.208 0.788203C30.2062 0.786445 30.2045 0.784775 30.2026 0.78293C29.7072 0.299004 29.024 0 28.2815 0H5.21833C3.70274 0 2.46973 1.23302 2.46973 2.7486V42.2513C2.46973 43.7669 3.70274 44.9999 5.21833 44.9999H34.9096C36.4252 44.9999 37.6582 43.7669 37.6582 42.2513V41.78C37.6583 41.416 37.3632 41.1209 36.9991 41.1209ZM29.8063 2.2507C30.2973 2.74175 34.7446 7.18884 35.4077 7.85206H30.8113C30.257 7.85206 29.8062 7.40118 29.8062 6.84694V2.2507H29.8063Z"
                                fill="#08850D" />
                            <path
                                d="M40.2417 14.957H22.4925C21.2308 14.957 20.2041 15.9836 20.2041 17.2454V19.463C20.2041 19.8271 20.4992 20.1222 20.8633 20.1222C21.2274 20.1222 21.5225 19.8271 21.5225 19.463V17.2454C21.5225 16.7106 21.9576 16.2754 22.4925 16.2754H40.2417C40.7765 16.2754 41.2116 16.7105 41.2116 17.2454V37.073C41.2116 37.6078 40.7765 38.043 40.2417 38.043H22.4925C21.9576 38.043 21.5225 37.6079 21.5225 37.073V22.5447C21.5225 22.1807 21.2274 21.8855 20.8633 21.8855C20.4992 21.8855 20.2041 22.1807 20.2041 22.5447V37.073C20.2041 38.3347 21.2308 39.3614 22.4925 39.3614H40.2417C41.5034 39.3614 42.53 38.3348 42.53 37.073V17.2454C42.53 15.9836 41.5035 14.957 40.2417 14.957Z"
                                fill="#08850D" />
                            <path
                                d="M39.1007 19.3182C39.1007 18.6752 38.5776 18.1521 37.9346 18.1521H24.7995C24.1565 18.1521 23.6333 18.6752 23.6333 19.3182V22.6918C23.6333 23.3348 24.1564 23.858 24.7995 23.858H37.9346C38.5775 23.858 39.1007 23.3348 39.1007 22.6918V19.3182ZM37.7824 22.5396H24.9517V19.4705H37.7823V22.5396H37.7824Z"
                                fill="#08850D" />
                        </g>
                        <defs>
                            <clipPath id="clip0">
                                <rect width="45" height="45" fill="white" />
                            </clipPath>
                        </defs>
                    </svg>
                    <p>Simulasi KPR</p>
                </a>

                <a class="nav-link ekprSandbox" href="{{ route('Sandbox') }}" aria-selected="true">

                    <svg width="45" height="45" viewBox="0 0 45 45" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M42.0117 0H2.98828C1.34068 0 0 1.39517 0 3.10976V31.4634C0 33.178 1.34068 34.5732 2.98828 34.5732H17.7539V38.2317H17.4023C14.3008 38.2317 11.7773 40.8577 11.7773 44.0854C11.7773 44.5906 12.1708 45 12.6562 45H32.3438C32.8292 45 33.2227 44.5906 33.2227 44.0854C33.2227 40.8577 30.6992 38.2317 27.5977 38.2317H27.2461V34.5732H42.0117C43.6593 34.5732 45 33.178 45 31.4634V3.10976C45 1.39517 43.6593 0 42.0117 0ZM31.3643 43.1707H13.6361C14.035 41.3908 15.5724 40.061 17.4023 40.061H27.5977C29.4279 40.061 30.9653 41.3908 31.3643 43.1707ZM25.4883 38.2317H19.5117V34.5732H25.4883V38.2317ZM43.2422 31.4634C43.2422 32.1694 42.6901 32.7439 42.0117 32.7439H2.98828C2.30988 32.7439 1.75781 32.1694 1.75781 31.4634V29.0854H37.0898C37.5753 29.0854 37.9688 28.6759 37.9688 28.1707C37.9688 27.6655 37.5753 27.2561 37.0898 27.2561H1.75781V3.10976C1.75781 2.40377 2.30988 1.82927 2.98828 1.82927H42.0117C42.6901 1.82927 43.2422 2.40377 43.2422 3.10976V31.4634Z"
                            fill="#08850D" />
                        <path
                            d="M22.5041 29.9082H22.4959C22.0104 29.9082 21.6211 30.3176 21.6211 30.8228C21.6211 31.328 22.0187 31.7375 22.5041 31.7375C22.9896 31.7375 23.383 31.328 23.383 30.8228C23.383 30.3176 22.9896 29.9082 22.5041 29.9082Z"
                            fill="#08850D" />
                        <path
                            d="M40.606 27.2559C40.3746 27.2559 40.148 27.3538 39.9845 27.5238C39.8201 27.6939 39.7271 27.93 39.7271 28.1705C39.7271 28.4109 39.8201 28.6471 39.9845 28.8172C40.148 28.9872 40.3746 29.0851 40.606 29.0851C40.837 29.0851 41.0639 28.9872 41.2274 28.8172C41.3908 28.6471 41.4849 28.4109 41.4849 28.1705C41.4849 27.93 41.3908 27.6939 41.2274 27.5238C41.0639 27.3538 40.837 27.2559 40.606 27.2559Z"
                            fill="#08850D" />
                        <path
                            d="M29.0741 5.48183C28.9093 5.31033 28.6858 5.21387 28.4527 5.21387C28.2196 5.21387 27.9961 5.31033 27.8313 5.48183L20.157 13.4681L17.1467 10.3358C16.9819 10.1643 16.7584 10.0679 16.5253 10.0679C16.2922 10.0679 16.0687 10.1643 15.9039 10.3358L11.966 14.4338C11.6227 14.7911 11.6227 15.3702 11.966 15.7275L19.5352 23.6044C19.7 23.7759 19.9239 23.8724 20.157 23.8724C20.3898 23.8724 20.6136 23.7759 20.7784 23.6044L33.012 10.8735C33.3553 10.5162 33.3553 9.9371 33.012 9.57982L29.0741 5.48183ZM20.157 21.6644L13.8302 15.0808L16.5253 12.2762L19.5356 15.4085C19.8785 15.7654 20.4351 15.7654 20.7784 15.4085L28.4527 7.42221L31.1478 10.2268L20.157 21.6644Z"
                            fill="#08850D" />
                    </svg>
                    <p>SandBox</p>
                </a>
                {{-- @endif --}}

                <a class="nav-link ekprLokasi" href="" aria-selected="true">

                    <svg width="45" height="45" viewBox="0 0 45 45" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M28.0932 12.287C28.093 11.1808 27.7648 10.0994 27.1502 9.17967C26.5355 8.25994 25.6619 7.54313 24.6399 7.11989C23.6178 6.69666 22.4932 6.586 21.4083 6.80191C20.3234 7.01782 19.3268 7.5506 18.5447 8.33288C17.7625 9.11516 17.2299 10.1118 17.0142 11.1968C16.7984 12.2818 16.9092 13.4064 17.3326 14.4284C17.7559 15.4505 18.4728 16.324 19.3926 16.9386C20.3124 17.5531 21.3938 17.8812 22.5 17.8812C23.9829 17.8794 25.4047 17.2894 26.4532 16.2406C27.5018 15.1919 28.0916 13.77 28.0932 12.287ZM18.2315 12.287C18.2317 11.4428 18.4821 10.6176 18.9512 9.9157C19.4204 9.21384 20.087 8.66684 20.867 8.34387C21.647 8.02091 22.5052 7.93649 23.3331 8.10128C24.1611 8.26607 24.9216 8.67267 25.5185 9.26967C26.1153 9.86668 26.5218 10.6273 26.6864 11.4553C26.8511 12.2833 26.7665 13.1415 26.4434 13.9214C26.1203 14.7014 25.5732 15.368 24.8713 15.837C24.1694 16.306 23.3441 16.5563 22.5 16.5563C21.3682 16.555 20.2831 16.1048 19.4829 15.3044C18.6827 14.504 18.2326 13.4188 18.2315 12.287Z"
                            fill="#08850D" />
                        <path
                            d="M44.9561 44.1014L39.5563 29.9447C39.5084 29.8193 39.4236 29.7115 39.3131 29.6354C39.2026 29.5593 39.0716 29.5185 38.9375 29.5185H28.7177C28.7802 29.4166 28.8423 29.3178 28.9047 29.2156C32.837 22.7051 34.8159 17.0098 34.7875 12.2904C34.7881 9.03134 33.494 5.90554 31.1899 3.60064C28.8859 1.29574 25.7607 0.000552323 22.5017 1.76609e-07C19.2428 -0.00055197 16.1171 1.29358 13.8123 3.5977C11.5074 5.90182 10.2123 9.02718 10.2117 12.2863C10.1834 17.0098 12.1622 22.7058 16.0945 29.2156C16.157 29.319 16.219 29.4178 16.2815 29.5185H6.06178C5.92761 29.5185 5.79662 29.5593 5.68611 29.6354C5.57561 29.7115 5.49081 29.8193 5.44292 29.9447L0.0438838 44.1014C0.00541387 44.2017 -0.0080573 44.3098 0.00463426 44.4165C0.0173258 44.5232 0.0557984 44.6252 0.116728 44.7136C0.177657 44.8021 0.259211 44.8744 0.354343 44.9243C0.449475 44.9742 0.555324 45.0002 0.662744 45H44.3373C44.4447 45.0002 44.5505 44.9742 44.6457 44.9243C44.7408 44.8744 44.8223 44.8021 44.8833 44.7136C44.9442 44.6252 44.9827 44.5232 44.9954 44.4165C45.0081 44.3098 44.9946 44.2017 44.9561 44.1014ZM11.5369 12.2874C11.5371 10.8476 11.821 9.42204 12.3721 8.09198C12.9233 6.76192 13.7311 5.55345 14.7493 4.53557C15.7674 3.51769 16.9762 2.71033 18.3064 2.1596C19.6366 1.60886 21.0622 1.32552 22.5019 1.32577C23.9416 1.32602 25.3671 1.60985 26.6971 2.16104C28.0272 2.71224 29.2356 3.52002 30.2534 4.53825C31.2713 5.55648 32.0786 6.76523 32.6293 8.09548C33.18 9.42572 33.4633 10.8514 33.4631 12.2912C33.5199 21.7005 24.7234 33.3056 22.5 36.0885C20.2766 33.3067 11.4797 21.7046 11.5369 12.2874ZM21.9954 37.5647C22.0576 37.6378 22.135 37.6965 22.2221 37.7368C22.3092 37.7771 22.404 37.7979 22.5 37.7979C22.596 37.7979 22.6908 37.7771 22.7779 37.7368C22.865 37.6965 22.9424 37.6378 23.0046 37.5647C24.7632 35.4222 26.3937 33.1776 27.8873 30.8425H38.4806L39.3285 33.0663L18.6275 40.429L11.2489 30.8414H17.1119C18.6058 33.1768 20.2365 35.4219 21.9954 37.5647ZM18.6044 41.842H18.6082L30.9578 37.4511L35.7478 43.6752H13.4537L18.6044 41.842ZM6.51864 30.8414H9.57698L17.3144 40.8957L9.5009 43.6748H1.62415L6.51864 30.8414ZM37.4212 43.6752L32.27 36.9821L39.8024 34.3033L43.3766 43.6752H37.4212Z"
                            fill="#08850D" />
                    </svg>
                    <p>Lokasi</p>
                </a>


            </div>
        </div>
        <!--End Navbar-->
    </div>

    <!--Main Menu-->

    <!--End Main Menu-->

    <!--jQuery-->
    <script src="{{ url('assets/vendors/jquery/jquery.min.js') }}"></script>
    <!--Bootstrap Asset-->
    <script src="{{ url('assets/vendors/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!--Chart Js-->
    <script src="{{ url('assets/vendors/chart.js') }}"></script>
    <script src="{{ url('assets/js/chartjs/ui-chart.js') }}"></script>
    <!--DataTable-->
    <script src="https://cdn.datatables.net/1.11.2/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.2/js/dataTables.bootstrap5.min.js"></script>
    <!--Ion Icon-->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <!--Slick Js-->
    <script src="{{ url('assets/vendors/slick/slick.min.js') }}"></script>
    <!--Ekpr Js-->
    <script src="{{ url('assets/js/dataRumah.js') }}"></script>
    <script src="{{ url('assets/js/dashboard-ekpr.js') }}"></script>
    <script src="{{ url('assets/js/pengajuanKpr.js') }}"></script>
    <script src="{{ url('assets/js/simulasiKpr.js') }}"></script>
    {{-- <script src="{{ url('assets/js/dataKpr.js') }}"></script> --}}

    <script>
        $(document).scroll(function() {
            $('.pembungkus').toggleClass('onScrolled', $(this).scrollTop() > 170);
        });
    </script>

</body>

</html>
