<!DOCTYPE html>
<html lang="en">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="keywords" content="KPR">
  <meta name="author" content="pixelstrap">
  <link rel="icon" href="{{ asset('assets/images/logo-tni.png') }}" type="image/x-icon">
  <link rel="shortcut icon" href="{{asset ('assets/images/logo-tni.png')}}" type="image/x-icon">
  <title>KPR Swakelola TNI AD</title>
  <!-- Google font-->
  <link href="https://fonts.googleapis.com/css?family=Rubik:400,400i,500,500i,700,700i&amp;display=swap"
    rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i,900&amp;display=swap"
    rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="{{asset ('assets/css/fontawesome.css')}}">
  <!-- ico-font-->
  <link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/icofont.css')}}">
  <!-- Themify icon-->
  <link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/themify.css')}}">
  <!-- Flag icon-->
  <link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/flag-icon.css')}}">
  <!-- Feather icon-->
  <link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/feather-icon.css')}}">
  <!-- Plugins css start-->
  <link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/animate.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/owlcarousel.css')}}">
  <!-- Plugins css Ends-->
  <!-- Bootstrap css-->
  <link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/bootstrap.css')}}">
  <!-- App css-->
  <link rel="stylesheet" type="text/css" href="{{asset('assets/css/style.css')}}">
  <link id="color" rel="stylesheet" href="{{asset('assets/css/color-1.css')}}" media="screen">
  <!-- Responsive css-->
  <link rel="stylesheet" type="text/css" href="{{asset('assets/css/responsive.css')}}">

  <style>
    html {
        scroll-behavior: smooth;
    }

    body {
        background: #224914;
    }

    .image_full {
        display:block;
    }

    .image_mobile {
        display:none;
    }

    @media screen and (max-width: 480px) {
        #header {
            height: 80px;
        }

        .logo-mobile {
            margin-top: -10px;
            height: 60px !important;
        }

        #toggle-navbar {
            background: #FFFFFF;
        }
    }

    @media screen and (min-width: 480px) {
        #header {
            height: 100px;
        }

        .logo-mobile {
            height: 70px !important;
        }
    }

    @media (min-width: 768px) and (max-width: 768px) {
        .image_mobile{
            margin-top: 400px;
        }
    }

    @media screen and (max-width: 768px) {
        .image_full{
            display:none;
        }

        .image_mobile{
            display:block;
        }
    }

    @media screen and (min-width: 768px) {
        #header {
            height: 100px;
        }

        #toggle-navbar {
            background: #305744;
        }
    }

    @media screen and (min-width: 1200px) {
        #header {
            height: 85px;
        }
    }
</style>
<script>
    window.onscroll = () => addShadow();

    function addShadow() {
        const header = document.getElementById("header");

        if (document.body.scrollTop > 10 || document.documentElement.scrollTop > 10) {
            header.style.boxShadow = "0 3px 4px rgba(0, 0, 0, .15)";
        } else {
            header.style.boxShadow = "none";
        }
    }
</script>
</head>

<body class="landing-page font-roboto" id="body">
  <!-- page-wrapper Start-->
  <div class="page-wrapper landing-page">
    <!-- Page Body Start -->
    <div class="landing-home" id="dashboards">
      <div class="container-fluid">
        <div class="sticky-header">
          <header id="header">
            <nav class="navbar navbar-b navbar-trans navbar-expand-xl fixed-top nav-padding" id="sidebar-menu"><a
                class="navbar-brand p-0" href="{{ route('index') }}"><img class="logo-mobile" src="{{ asset('assets/images/fixlogo.png') }}" alt="logoWeb"></a>
              <button class="navbar-toggler" id="toggle-navbar" style="padding: 7px" type="button" data-toggle="collapse"
                data-target="#navbarDefault" aria-controls="navbarDefault" aria-expanded="false"
                aria-label="Toggle navigation"><span></span><span></span><span></span></button>
              <div class="navbar-collapse justify-content-start collapse hidenav" id="navbarDefault">
                <ul class="navbar-nav navbar_nav_modify ml-5" id="scroll-spy">
                  <li class="nav-item mr-4"><a class="nav-link" href="/kpr/home">Home</a></li>
                  <li class="nav-item mr-4"><a class="nav-link" href="#tentangkami">Tentang
                      Kami</a></li>
                  <li class="nav-item mr-4"><a class="nav-link" href="#kontakkami">Hubungi
                      Kami</a></li>

                </ul>
              </div>
            </nav>
          </header>
        </div>
        <div class="row" id="#dashboards">
          <div class="col-md-6">
            <div class="content">
              <div class="font-light" style="margin-bottom: 100px;">
                <h1 class="display-4">PERUMAHAN TNI AD</h1>
                <h1 class="display-6">Aspirasi Guna Kesejahteraan</h1>
                <h1 class="display-6">Prajurit TNI AD</h1>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="wow fadeIn mt-2">
                <img class="image_full" style="width:100%;margin-left:80px; margin-top:-20px"
                src="{{asset('assets/images/rumahawan.png')}}" alt="rumah">
                <img class="image_mobile" style="width:100%;margin-left:20px;"
                src="{{asset('assets/images/Rumahbaru.png')}}" alt="rumah">
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
    <section class="cuba-demo-section font-weight-bold" id="tentangkami" style="background-color: white;">
      <div class="container">
        <div class="row p-5">
          <div class="col-sm-5">

            <h1 class="display-6">Lebih Dari 12 tahun
              melayani lebih
              dari 17.000 Perumahan
              Prajurit TNI Angkatan Darat</h1>


          </div>
          <div class="col-sm-5 offset-sm-2">

            <h4 class="font-weight-light">Sejak tahun 2009 Kredit Pemilikan Rumah Swakelola Rumah TNI AD telah tersebar hampir diseluruh
              Indonesia dengan proses yang memudahkan prajurit untuk memiliki rumah untuk kesejahteraan dan masa depan
              setiap prajurit TNI AD</h4>
          </div>
        </div>
      </div>
    </section>
    <section class="section-space cuba-demo-section font-weight-bold" id="layout" style="background-color: white;">
      <div class="container">
        <div class="row">
          <div class="col-sm-4 wow pulse">
            <div class="cuba-demo-content mt50">
              <div class="couting">
                <h1 class="display-3">Rp. 2T</h1>
                <p style="font-size:16px; font-weight-light;">Penyaluran Dana KPR Swakelola</p>
              </div>
            </div>
          </div>
          <div class="col-sm-4 wow pulse">
            <div class="cuba-demo-content mt50">
              <div class="couting">
                <h1 class="display-3">17K+</h1>
                <p style="font-size:16px; font-weight-light;">Prajurit memiliki perumahan</p>
              </div>
            </div>
          </div>
          <div class="col-sm-4 wow pulse">
            <div class="cuba-demo-content mt50">
              <div class="couting">
                <h1 class="display-3">30+</h1>
                <p style="font-size:16px; font-weight-light;">Lokasi perumahan tersebar diseluruh Indonesia</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <section class="cuba-demo-section" id="kontakkami" style="background-color: white;">
          <div class="row mx-2">
              <div class="col-sm-5 font-weight-bold">
                <p>Alamat Kantor: <br>
                  Dr. Wahidin I No 6, Ps Baru, Kecamatan Sawah Besar,
                  Kota Jakarta Pusat, Daerah khusus Ibukota Jakarta 10710</p>
              </div>

              <div class="col-sm-4 pt-5 offset-md-3">
                <p>Copyright @2021 Ditkuad TNI AD - All Right Reserved</p>
              </div>

          </div>

    </section>
    <!-- latest jquery-->
    <script src="{{ asset('assets/js/jquery-3.5.1.min.js')}}"></script>
    <!-- Bootstrap js-->
    <script src="{{ asset('assets/js/bootstrap/popper.min.js')}}"></script>
    <script src="{{ asset('assets/js/bootstrap/bootstrap.js')}}"></script>
    <!-- feather icon js-->
    <script src="{{ asset('assets/js/icons/feather-icon/feather.min.js')}}"></script>
    <script src="{{ asset('assets/js/icons/feather-icon/feather-icon.js')}}"></script>
    <!-- Sidebar jquery-->
    <script src="{{ asset('assets/js/config.js')}}"></script>
    <!-- Plugins JS start-->
    <script src="{{ asset('assets/js/owlcarousel/owl.carousel.js')}}"></script>
    <script src="{{ asset('assets/js/animation/wow/wow.min.js')}}"></script>
    <script src="{{ asset('assets/js/landing_sticky.js')}}"></script>
    <script src="{{ asset('assets/js/landing.js')}}"></script>
    <!-- Plugins JS Ends-->
    <!-- Theme js-->
    <script src="{{ asset('assets/js/script.js')}}"></script>
    <!-- login js-->
    <!-- Plugin used-->
    <script>
        $('.navbar-collapse a').click(function(){
            $(".navbar-collapse").collapse('hide');
        });
    </script>
</body>

</html>
