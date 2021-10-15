



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ebaltab | Menu</title>
    <!--Bootstrap Asset-->
    <link rel="stylesheet" href="{{ url('assets/vendors/bootstrap/css/bootstrap.min.css') }}">
    <!--Ekpr Css-->
    <link rel="stylesheet" href="{{ url('assets/css/kelolaUser.css') }}">
    <link rel="stylesheet" href="{{ url('assets/css/dataKpr.css') }}">
    <!--uni cons-->
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

    <div class="mainContent">
        <div class="container-fluid">
            <div class="wrapperContent">

              <div class="a-link">
                  <a class="a-padding text-decoration-none text-center active-btn" href="dataKpr.html">
                    Masdebet BRI
                  </a>
                  <a class="a-padding text-decoration-none text-center a-btn" href="dataManual.html">
                    Data Manual
                  </a>
                  <a class="a-padding text-decoration-none text-center a-btn" href="masdebetBTN.html">
                    Masdebet BTN
                  </a>
                  <a class="a-padding text-decoration-none text-center a-btn" href="debitur.html">
                    Data Debitur
                  </a>
                  <a class="a-padding text-decoration-none text-center a-btn" href="outstanding.html">
                    Outstanding
                  </a>
                  <a class="a-padding text-decoration-none text-center a-btn" href="penerimaan.html">
                    Penerimaan
                  </a>
                  <a class="a-padding text-decoration-none text-center a-btn" href="bulanan.html">
                    Rekap Bulanan
                  </a>
                  <a class="a-padding text-decoration-none text-center a-btn" href="tunggakan.html">
                    Tunggakan
                  </a>
                  <a class="a-padding text-decoration-none text-center a-btn" href="piutang.html">
                    Piutang
                  </a>
                  <a class="a-padding text-decoration-none text-center a-btn" href="">
                    Report Global
                  </a>
              </div>

                  <h1 class="nameContent">Data Pinjaman Verified</h1>

                  <div class="wrapperTable">
                    <table id="tableBri" class="table" style="width:100%">

                      <thead class="headTable">
                          <tr>
                            <th class="table-text">No</th>
                            <th class="table-text">Update</th>
                            <th class="table-text">NRP</th>
                            <th class="table-text">Nama</th>
                            <th class="table-text">Pangkat</th>
                            <th class="table-text">Kesatuan</th>
                            <th class="table-text">Kotama</th>
                            <th class="table-text">Tahap</th>
                            <th class="table-text">Pinjaman</th>
                            <th class="table-text">Jangka Waktu </th>
                            <th class="table-text">TMT Angsuran</th>
                            <th class="table-text">Jumlah Angsuran</th>
                            <th class="table-text">Angsuran Ke</th>
                            <th class="table-text">Angsuran Masuk</th>
                            <th class="table-text">Tunggakan</th>
                            <th class="table-text">Jml Tunggakan</th>
                            <th class="table-text">Ket</th>
                          </tr>
                      </thead>
                      <tbody class="bodyTable">
                          <tr>
                            <td>00</td>
                            <td>00</td>
                            <td>00</td>
                            <td>00</td>
                            <td>00</td>
                            <td>00</td>
                            <td>00</td>
                            <td>00</td>
                            <td>00</td>
                            <td>00</td>
                            <td>00</td>
                            <td>00</td>
                            <td>00</td>
                            <td>00</td>
                            <td>00</td>
                            <td>00</td>
                            <td>00</td>
                          </tr>

                      </tbody>
                  </table>

            </div>
        </div>
      </div>
    </div>

    <footer >
        <p>Copyright 2021 © DITKUAD</p>
    </footer>


    <!--jQuery-->
    <script src="{{ url('assets/vendors/jquery/jquery.min.js') }}"></script>
    <!--Bootstrap Asset-->
    <script src="{{ url('assets/vendors/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!--DataTable-->
    <script src="https://cdn.datatables.net/1.11.2/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.2/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/fixedheader/3.2.0/js/dataTables.fixedHeader.min.js"></script>
    <!--Slick Js-->
    <!--Ion Icon-->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <!--dataPrajurit Js-->
    <script src="{{ url('assets/vendors/slick/slick.min.js') }}"></script>
    <script src="{{ url('assets/js/dataKpr.js') }}"></script>

</body>
</html>
