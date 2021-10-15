@extends('layouts.basekpr')

@section('css')
    <link rel="stylesheet" href="{{ url('assets/css/pilihrumah.css') }}">
@endsection

@section('content')
<style>
    .namePerumahan {
        white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
    }

    .properti .kategoriProperti {
        height: 520px !important;
    }
</style>




    @if (Auth::user()->role == 0)

        <div class="mainContent">
            <div class="container-fluid">
                <div class="wrapperContent">
                    <h1 class="titleHeaderContent">Dashboard eKPR</h1>

                    <div class="wrapperRekapData">
                        <div class="wrapperContentRekapData">
                            <div class="wrapperRekapDataPerbulan">
                                <h1 class="headerData">Rekap Data Perbulan</h1>

                                <div class="contentData">
                                    <div class="wrapperChart">
                                        <canvas id="chartRekapData"></canvas>
                                    </div>

                                    <div class="wrapperInfoChart">
                                        <div class="label totalPokok">
                                            <h1 class="nameLabel">Total Pokok (IDR)</h1>
                                            <p class="value">Rp.{{ number_format($piutang_pokok, 0, ',', '.') }}
                                            </p>
                                        </div>
                                        <div class="label totalBunga">
                                            <h1 class="nameLabel">Total Bunga (IDR)</h1>
                                            <p class="value">Rp.{{ number_format($piutang_bunga, 0, ',', '.') }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="containerDebitur">
                                <div class="wrapperDebitur">
                                    <div class="debitur debiturBaru">
                                        <div class="contentDebitur">
                                            <h3 class="labelName">Debitur Baru</h3>
                                            <h1 class="value">{{ $debiturbaru }}</h1>
                                            {{-- <p class="month">Agustus 2021</p> --}}
                                        </div>
                                        <div class="wrapperChart">
                                            <canvas id="chartDebiturBaru"></canvas>
                                            <div class="wrapperArrow">
                                                <img src="../assets/img/arrowChart.svg" alt="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="debitur debiturLunas">
                                        <div class="contentDebitur">
                                            <h3 class="labelName">Debitur Lunas</h3>
                                            <h1 class="value">{{ $debiturlunas }} Prajurit</h1>
                                            {{-- <p class="month">Agustus 2021</p> --}}
                                        </div>
                                        <div class="wrapperChart">
                                            <canvas id="chartDebiturLunas"></canvas>
                                            <div class="wrapperArrow">
                                                <img src="../assets/img/arrowChart.svg" alt="">
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="wrapperDebitur">
                                    <div class="debitur debiturMeninggal">
                                        <div class="contentDebitur">
                                            <h3 class="labelName">Debitur Meninggal</h3>
                                            <h1 class="value">{{ $debiturmeninggal }} Prajurit</h1>
                                            {{-- <p class="month">Agustus 2021</p> --}}
                                        </div>
                                        <div class="wrapperChart">
                                            <canvas id="chartDebiturMeninggal"></canvas>
                                            <div class="wrapperArrow">
                                                <img src="../assets/img/arrowChart.svg" alt="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="debitur debiturOutstanding">
                                        <div class="contentDebitur">
                                            <h3 class="labelName">Data Outstanding</h3>
                                            <h1 class="value">
                                                Rp.{{ number_format($rekapoutstanding, 0, ',', '.') }}</h1>
                                            {{-- <p class="month">Agustus 2021</p> --}}
                                        </div>
                                        <div class="wrapperChart">
                                            <canvas id="chartDebiturOutstanding"></canvas>
                                            <div class="wrapperArrow">
                                                <img src="../assets/img/arrowChart.svg" alt="">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="wrapperRekapData rekapMassDebetBRI">
                        <h1 class="titleRekapDataMassdebet">Rekap Data MassDebet BRI & Manual</h1>
                        <div class="wrapperDataMassDebet">
                            <div class="statistic">
                                <div class="wrapperChart wrapperIcon">
                                    <canvas id="chartMassDebetBRITunggakan"></canvas>
                                    <div class="wrapperArrow">
                                        <img src="../assets/img/arrowChart.svg" alt="">
                                    </div>
                                </div>
                                <div class="label">
                                    <h1 class="nameLabel">Total Tunggakan (IDR)</h1>
                                    <p class="value">Rp.{{ number_format($totaltunggakan, 0, ',', '.') }}</p>
                                </div>
                            </div>

                            <div class="statistic">
                                <div class="wrapperChart wrapperIcon">
                                    <img src="../assets/img/debiturLogo.svg" alt="">
                                </div>
                                <div class="label">
                                    <h1 class="nameLabel">Total Debitur</h1>
                                    <p class="value">{{ $user }}</p>
                                </div>
                            </div>

                            <div class="statistic">
                                <div class="wrapperChart wrapperIcon">
                                    <canvas id="chartMassDebetBRIPinjaman"></canvas>
                                    <div class="wrapperArrow">
                                        <img src="../assets/img/arrowChart.svg" alt="">
                                    </div>
                                </div>
                                <div class="label">
                                    <h1 class="nameLabel">Total Pinjaman (IDR)</h1>
                                    <p class="value">Rp.{{ number_format($jumlahpinjaman, 0, ',', '.') }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="wrapperRekapPenerimaan">
                            <h1 class="nameContentSection">Rekap Penerimaan</h1>

                            <div class="wrapperStatistic">
                                <div class="statisticPenerimaan">
                                    <div class="label">
                                        <h1 class="nameLabel">Total Pokok (IDR)</h1>
                                        <p class="value"><span
                                                class="mataUang">Rp.</span>{{ number_format($total_pokok, 0, ',', '.') }}
                                        </p>
                                    </div>
                                    <div class="wrapperChart wrapperIcon">
                                        <canvas id="chartPenerimaanTotalPokokBRI"></canvas>
                                        <div class="wrapperArrow">
                                            <img src="../assets/img/arrowChart.svg" alt="">
                                        </div>
                                    </div>
                                </div>

                                <div class="statisticPenerimaan">
                                    <div class="label">
                                        <h1 class="nameLabel">Total Bunga (IDR)</h1>
                                        <p class="value"><span
                                                class="mataUang">Rp.</span>{{ number_format($total_bunga, 0, ',', '.') }}
                                        </p>
                                    </div>
                                    <div class="wrapperChart wrapperIcon">
                                        <canvas id="chartPenerimaanTotalBungaBRI"></canvas>
                                        <div class="wrapperArrow">
                                            <img src="../assets/img/arrowChart.svg" alt="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="wrapperRekapPiutang">
                            <h1 class="nameContentSection">Rekap Piutang</h1>

                            <div class="wrapperStatistic">
                                <div class="statisticPiutang">
                                    <div class="label">
                                        <h1 class="nameLabel">Total Pokok (IDR)</h1>
                                        <p class="value"><span
                                                class="mataUang">Rp.</span>{{ number_format($piutang_pokok, 0, ',', '.') }}
                                        </p>
                                    </div>
                                    <div class="wrapperChart wrapperIcon">
                                        <canvas id="chartPiutangTotalPokokBRI"></canvas>
                                        <div class="wrapperArrow">
                                            <img src="../assets/img/arrowChart.svg" alt="">
                                        </div>
                                    </div>
                                </div>

                                <div class="statisticPiutang">
                                    <div class="label">
                                        <h1 class="nameLabel">Total Bunga (IDR)</h1>
                                        <p class="value"><span
                                                class="mataUang">Rp.</span>{{ number_format($piutang_bunga, 0, ',', '.') }}
                                        </p>
                                    </div>
                                    <div class="wrapperChart wrapperIcon">
                                        <canvas id="chartPiutangTotalBungaBRI"></canvas>
                                        <div class="wrapperArrow">
                                            <img src="../assets/img/arrowChart.svg" alt="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="wrapperDetailData">
                            <h1 class="nameContentSection">Detail Data</h1>
                            <div class="wrapperTable">
                                <table id="detailDataBRI" class="display table" style="width:100%">
                                    <thead class="headTable">
                                        <tr>
                                            <th>Jangka Waktu</th>
                                            <th>Saldo Pokok</th>
                                            <th>Saldo Bunga</th>
                                            <th>Piutang Pokok</th>
                                            <th>Piutang Bunga</th>
                                        </tr>
                                    </thead>
                                    @foreach ($detail_kpr as $det)
                                        <tbody class="bodyTable">
                                            <tr>
                                                <td>{{ $det->jk_waktu }}</td>
                                                <td> {{ 'Rp.' . number_format($det->pokok, 0, ',', '.') }}</td>
                                                <td> {{ 'Rp.' . number_format($det->bunga, 0, ',', '.') }}</td>
                                                <td>{{ 'Rp.' . number_format($det->piutang_pokok, 0, ',', '.') }}</td>
                                                <td>{{ 'Rp.' . number_format($det->piutang_bunga, 0, ',', '.') }}</td>
                                            </tr>
                                        </tbody>
                                    @endforeach
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="wrapperRekapData rekapMassDebetBTN">
                        <h1 class="titleRekapDataMassdebet">Rekap Data MassDebet BTN</h1>
                        <div class="wrapperDataMassDebet">
                            <div class="statistic">
                                <div class="wrapperChart wrapperIcon">
                                    <canvas id="chartMassDebetBTNTunggakan"></canvas>
                                    <div class="wrapperArrow">
                                        <img src="../assets/img/arrowChart.svg" alt="">
                                    </div>
                                </div>
                                <div class="label">
                                    <h1 class="nameLabel">Total Tunggakan (IDR)</h1>
                                    <p class="value">Rp.{{ number_format($totaltunggakan_btn, 0, ',', '.') }}
                                    </p>
                                </div>
                            </div>

                            <div class="statistic">
                                <div class="wrapperChart wrapperIcon">
                                    <img src="../assets/img/debiturLogo.svg" alt="">
                                    <div class="wrapperArrow">
                                        <img src="../assets/img/arrowChart.svg" alt="">
                                    </div>
                                </div>
                                <div class="label">
                                    <h1 class="nameLabel">Total Debitur</h1>
                                    <p class="value">{{ $user_btn }}</p>
                                </div>
                            </div>

                            <div class="statistic">
                                <div class="wrapperChart wrapperIcon">
                                    <canvas id="chartMassDebetBTNPinjaman"></canvas>
                                    <div class="wrapperArrow">
                                        <img src="../assets/img/arrowChart.svg" alt="">
                                    </div>
                                </div>
                                <div class="label">
                                    <h1 class="nameLabel">Total Pinjaman (IDR)</h1>
                                    <p class="value">Rp.{{ number_format($jumlahpinjaman_btn, 0, ',', '.') }}
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="wrapperRekapPenerimaan">
                            <h1 class="nameContentSection">Rekap Penerimaan</h1>

                            <div class="wrapperStatistic">
                                <div class="statisticPenerimaan">
                                    <div class="label">
                                        <h1 class="nameLabel">Total Pokok (IDR)</h1>
                                        <p class="value"><span
                                                class="mataUang">Rp.</span>{{ number_format($total_pokok_btn, 0, ',', '.') }}
                                        </p>
                                    </div>
                                    <div class="wrapperChart wrapperIcon">
                                        <canvas id="chartPenerimaanTotalPokokBTN"></canvas>
                                        <div class="wrapperArrow">
                                            <img src="../assets/img/arrowChart.svg" alt="">
                                        </div>
                                    </div>
                                </div>

                                <div class="statisticPenerimaan">
                                    <div class="label">
                                        <h1 class="nameLabel">Total Bunga (IDR)</h1>
                                        <p class="value"><span
                                                class="mataUang">Rp.</span>{{ number_format($total_bunga_btn, 0, ',', '.') }}
                                        </p>
                                    </div>
                                    <div class="wrapperChart wrapperIcon">
                                        <canvas id="chartPenerimaanTotalBungaBTN"></canvas>
                                        <div class="wrapperArrow">
                                            <img src="../assets/img/arrowChart.svg" alt="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="wrapperRekapPiutang">
                            <h1 class="nameContentSection">Rekap Piutang</h1>

                            <div class="wrapperStatistic">
                                <div class="statisticPiutang">
                                    <div class="label">
                                        <h1 class="nameLabel">Total Pokok (IDR)</h1>
                                        <p class="value"><span
                                                class="mataUang">Rp.</span>{{ number_format($piutang_pokok_btn, 0, ',', '.') }}
                                        </p>
                                    </div>
                                    <div class="wrapperChart wrapperIcon">
                                        <canvas id="chartPiutangTotalPokokBTN"></canvas>
                                        <div class="wrapperArrow">
                                            <img src="../assets/img/arrowChart.svg" alt="">
                                        </div>
                                    </div>
                                </div>

                                <div class="statisticPiutang">
                                    <div class="label">
                                        <h1 class="nameLabel">Total Bunga (IDR)</h1>
                                        <p class="value"><span
                                                class="mataUang">Rp.</span>{{ number_format($piutang_bunga_btn, 0, ',', '.') }}
                                        </p>
                                    </div>
                                    <div class="wrapperChart wrapperIcon">
                                        <canvas id="chartPiutangTotalBungaBTN"></canvas>
                                        <div class="wrapperArrow">
                                            <img src="../assets/img/arrowChart.svg" alt="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="wrapperDetailData">
                            <h1 class="nameContentSection">Detail Data</h1>
                            <div class="wrapperTable">
                                <table id="detailDataBTN" class="display table" style="width:100%">
                                    <thead class="headTable">
                                        <tr>
                                            <th>Jangka Waktu</th>
                                            <th>Saldo Pokok</th>
                                            <th>Saldo Bunga</th>
                                            <th>Piutang Pokok</th>
                                            <th>Piutang Bunga</th>
                                        </tr>
                                    </thead>
                                    @foreach ($detail_btn as $det)
                                        <tbody class="bodyTable">
                                            <tr>
                                                <td>{{ $det->jk_waktu }}</td>
                                                <td>{{ 'Rp.' . number_format($det->pokok, 0, ',', '.') }}</td>
                                                <td>{{ 'Rp.' . number_format($det->bunga, 0, ',', '.') }}</td>
                                                <td>{{ 'Rp.' . number_format($det->piutang_pokok, 0, ',', '.') }}</td>
                                                <td>{{ 'Rp.' . number_format($det->piutang_bunga, 0, ',', '.') }}</td>
                                            </tr>
                                        </tbody>
                                    @endforeach
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        </div>


    @else



        <div class="mainContent">
            <div class="headHome">
                <h1 class="nameContent">Pilihan Rumah</h1>
                <form action="" class="search">
                    <input type="text" placeholder="Cari property lainnya, berdasarkan keyword & kota" autofocus required
                        oninvalid="this.setCustomValidity('Masukan Nama Property')">
                    <button>
                        <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M0.390638 8.98828V9.37891C0.390638 9.43071 0.370061 9.48039 0.333432 9.51702C0.296804 9.55364 0.247126 9.57422 0.195326 9.57422C0.143525 9.57422 0.093847 9.55364 0.0572188 9.51702C0.0205906 9.48039 1.30517e-05 9.43071 1.30517e-05 9.37891V8.98828C1.30517e-05 8.93648 0.0205906 8.88681 0.0572188 8.85018C0.093847 8.81355 0.143525 8.79297 0.195326 8.79297C0.247126 8.79297 0.296804 8.81355 0.333432 8.85018C0.370061 8.88681 0.390638 8.93648 0.390638 8.98828ZM1.2422 6.38477C1.26892 6.3844 1.29531 6.37869 1.31979 6.36798C1.34428 6.35727 1.36637 6.34176 1.38478 6.32239L1.65236 6.03723C1.68786 5.99941 1.70688 5.94905 1.70524 5.89721C1.7036 5.84537 1.68144 5.7963 1.64363 5.7608C1.60581 5.72531 1.55545 5.70628 1.50361 5.70792C1.45177 5.70956 1.4027 5.73172 1.3672 5.76953L1.09962 6.05469C1.07358 6.08258 1.05624 6.11746 1.04972 6.15506C1.0432 6.19266 1.04779 6.23134 1.06292 6.26638C1.07805 6.30141 1.10307 6.33127 1.13491 6.35229C1.16676 6.37332 1.20404 6.38461 1.2422 6.38477ZM0.835951 6.61133C0.794838 6.58052 0.743585 6.56641 0.692497 6.57185C0.641408 6.57728 0.594271 6.60186 0.56056 6.64063C0.472923 6.75092 0.393913 6.86781 0.324232 6.99024C0.308322 7.02038 0.29963 7.05381 0.298841 7.08789C0.298601 7.11352 0.303504 7.13893 0.313259 7.16263C0.323014 7.18632 0.337423 7.20782 0.355634 7.22585C0.373845 7.24388 0.395487 7.25807 0.41928 7.26759C0.443073 7.2771 0.468533 7.28175 0.494154 7.28125C0.529076 7.28136 0.5634 7.27218 0.593603 7.25465C0.623806 7.23712 0.648803 7.21187 0.666029 7.18149C0.724284 7.07791 0.790913 6.97928 0.865248 6.88657C0.881403 6.86657 0.893461 6.84359 0.900732 6.81894C0.908003 6.79428 0.910345 6.76844 0.907625 6.74288C0.904904 6.71732 0.897174 6.69254 0.884876 6.66997C0.872578 6.6474 0.855953 6.62747 0.835951 6.61133ZM2.04298 5.52735C2.06962 5.52751 2.09601 5.52222 2.12053 5.51181C2.14505 5.5014 2.16718 5.48608 2.18556 5.4668L2.45118 5.17969C2.46877 5.1611 2.48252 5.13923 2.49165 5.11533C2.50077 5.09142 2.5051 5.06595 2.50437 5.04038C2.50365 5.0148 2.49789 4.98961 2.48742 4.96626C2.47695 4.94292 2.46198 4.92186 2.44337 4.9043C2.40456 4.87034 2.35427 4.85247 2.30273 4.85431C2.2512 4.85615 2.20231 4.87758 2.16603 4.91422L1.9004 5.19938C1.88295 5.21708 1.86927 5.23814 1.8602 5.26129C1.85114 5.28444 1.84687 5.3092 1.84767 5.33405C1.84791 5.36035 1.85339 5.38635 1.86378 5.41052C1.87418 5.43469 1.88928 5.45654 1.90822 5.47481C1.94458 5.5092 1.99293 5.52805 2.04298 5.52735ZM0.265638 7.62696C0.214965 7.61839 0.162949 7.62992 0.120642 7.65909C0.0783356 7.68827 0.049074 7.7328 0.0390755 7.78321C0.0152211 7.92262 0.00216149 8.06366 1.30517e-05 8.20508C-0.000286448 8.23081 0.00457134 8.25633 0.0142995 8.28015C0.0240277 8.30397 0.0384292 8.32559 0.0566537 8.34375C0.0742144 8.36236 0.0954112 8.37717 0.118929 8.38725C0.142448 8.39732 0.167786 8.40246 0.193372 8.40235H0.195326C0.246568 8.40163 0.295541 8.38109 0.33196 8.34504C0.368379 8.30898 0.38941 8.26022 0.390638 8.20899C0.392666 8.08983 0.403766 7.97099 0.423841 7.85352C0.428678 7.82822 0.428399 7.80221 0.423021 7.77702C0.417644 7.75184 0.407277 7.72798 0.392532 7.70686C0.377787 7.68575 0.358962 7.6678 0.337168 7.65407C0.315374 7.64035 0.291053 7.63113 0.265638 7.62696ZM4.44351 2.95899C4.47015 2.95919 4.49656 2.95393 4.52108 2.94351C4.54561 2.9331 4.56773 2.91776 4.58609 2.89844L4.85367 2.61328C4.88829 2.5747 4.90711 2.52449 4.9064 2.47266C4.90388 2.42075 4.8815 2.37181 4.8439 2.33594C4.80548 2.30199 4.7555 2.28408 4.70426 2.28589C4.65302 2.28771 4.60443 2.30912 4.56851 2.34571L4.30093 2.63086C4.26643 2.66722 4.24751 2.71561 4.2482 2.76572C4.24816 2.79224 4.25371 2.81846 4.26448 2.84269C4.27525 2.86692 4.291 2.88861 4.3107 2.90635C4.32823 2.92349 4.34901 2.93696 4.37181 2.94598C4.39461 2.95499 4.41898 2.95938 4.44349 2.95887L4.44351 2.95899ZM6.04312 1.24805C6.07018 1.24792 6.09693 1.24231 6.12177 1.23157C6.14661 1.22083 6.16902 1.20517 6.18765 1.18555L6.44156 0.912229C6.45916 0.893591 6.47289 0.87164 6.48194 0.847651C6.49099 0.823662 6.49519 0.798114 6.49428 0.772491C6.49337 0.746867 6.48738 0.72168 6.47665 0.698393C6.46592 0.675105 6.45067 0.654182 6.43179 0.636838C6.39338 0.602875 6.34339 0.584952 6.29215 0.586769C6.2409 0.588587 6.19231 0.610004 6.1564 0.646604L5.90054 0.920041C5.88361 0.938021 5.8704 0.959176 5.86168 0.982287C5.85297 1.0054 5.84891 1.03 5.84976 1.05469C5.84978 1.08103 5.85515 1.1071 5.86556 1.1313C5.87597 1.15549 5.89119 1.17732 5.91031 1.19545C5.9466 1.22873 5.9939 1.24746 6.04314 1.24805H6.04312ZM3.64259 3.81641C3.66936 3.81625 3.69581 3.81062 3.72033 3.79988C3.74485 3.78913 3.76691 3.77349 3.78517 3.75391L4.05275 3.46875C4.08811 3.43062 4.10705 3.38011 4.10548 3.32813C4.10459 3.30263 4.0986 3.27757 4.08787 3.25442C4.07714 3.23127 4.06187 3.21051 4.04298 3.19336C4.00482 3.15912 3.95497 3.14084 3.90373 3.1423C3.85248 3.14375 3.80375 3.16483 3.76759 3.20117L3.50001 3.48633C3.46632 3.52393 3.44756 3.57256 3.44728 3.62305C3.44889 3.6763 3.47133 3.72679 3.50978 3.76367C3.54606 3.79699 3.59334 3.81576 3.64259 3.81641ZM2.84376 4.67188C2.8705 4.67151 2.89689 4.66579 2.92137 4.65505C2.94586 4.64432 2.96795 4.62879 2.98634 4.60938L3.25197 4.32422C3.26963 4.30544 3.28338 4.28334 3.29243 4.2592C3.30148 4.23506 3.30565 4.20936 3.3047 4.1836C3.30381 4.1581 3.29782 4.13304 3.28709 4.10989C3.27635 4.08674 3.26109 4.06598 3.2422 4.04883C3.20377 4.01488 3.15377 3.99698 3.10253 3.99882C3.05128 4.00067 3.0027 4.02212 2.96681 4.05875L2.70118 4.34391C2.68374 4.36162 2.67006 4.38268 2.661 4.40583C2.65193 4.42898 2.64767 4.45373 2.64845 4.47858C2.64844 4.5049 2.6538 4.53096 2.66421 4.55514C2.67462 4.57932 2.68986 4.60112 2.709 4.6192C2.74588 4.65285 2.79394 4.67162 2.84386 4.67188H2.84376ZM5.24415 2.10352C5.27088 2.10315 5.29726 2.09745 5.32174 2.08674C5.34623 2.07603 5.36833 2.06053 5.38673 2.04115L5.65236 1.756C5.66995 1.73741 5.6837 1.71554 5.69283 1.69164C5.70195 1.66773 5.70628 1.64226 5.70555 1.61668C5.70483 1.5911 5.69907 1.56592 5.6886 1.54257C5.67813 1.51922 5.66316 1.49817 5.64455 1.48061C5.60576 1.44663 5.55547 1.42873 5.50394 1.43054C5.4524 1.43236 5.4035 1.45375 5.3672 1.49037L5.10158 1.77553C5.06712 1.81191 5.0482 1.86029 5.04884 1.91039C5.04859 1.93694 5.05404 1.96323 5.06483 1.98749C5.07561 2.01175 5.09147 2.03341 5.11134 2.05102C5.14725 2.0849 5.19479 2.10369 5.24415 2.10352ZM16.7758 23.0645C16.7307 23.0403 16.678 23.0344 16.6287 23.0478C16.5793 23.0612 16.5369 23.0931 16.5103 23.1367C16.5103 23.1387 16.5082 23.1387 16.5082 23.1387C16.4564 23.2293 16.3983 23.3161 16.3344 23.3984C16.3023 23.4389 16.2876 23.4904 16.2934 23.5416C16.2993 23.5929 16.3252 23.6397 16.3656 23.6719C16.4001 23.6992 16.4427 23.7143 16.4867 23.7148C16.5163 23.7149 16.5456 23.7083 16.5724 23.6954C16.5991 23.6826 16.6225 23.6638 16.641 23.6406C16.7175 23.543 16.7867 23.4399 16.848 23.332C16.8658 23.3026 16.8753 23.2688 16.8754 23.2344C16.8751 23.1998 16.8658 23.1659 16.8483 23.1361C16.8308 23.1063 16.8058 23.0816 16.7758 23.0645ZM16.9887 20.75C16.9369 20.7501 16.8873 20.7708 16.8507 20.8074C16.8141 20.844 16.7935 20.8936 16.7934 20.9453V21.3359C16.7934 21.3877 16.814 21.4374 16.8506 21.474C16.8872 21.5107 16.9369 21.5313 16.9887 21.5313C17.0405 21.5313 17.0902 21.5107 17.1268 21.474C17.1634 21.4374 17.184 21.3877 17.184 21.3359V20.9453C17.1841 20.9196 17.1791 20.8942 17.1693 20.8704C17.1596 20.8467 17.1452 20.8251 17.127 20.807C17.1089 20.7888 17.0873 20.7744 17.0635 20.7646C17.0398 20.7549 17.0143 20.7499 16.9886 20.75H16.9887ZM16.9926 21.9219H16.9887C16.9376 21.9221 16.8887 21.9423 16.8522 21.978C16.8158 22.0137 16.7947 22.0623 16.7934 22.1133C16.7914 22.2325 16.7796 22.3514 16.7582 22.4688C16.7527 22.4939 16.7525 22.5199 16.7575 22.5451C16.7626 22.5703 16.7728 22.5942 16.7875 22.6152C16.8167 22.6581 16.8616 22.6876 16.9125 22.6973C16.9248 22.6996 16.9372 22.7009 16.9496 22.7012C16.9951 22.7008 17.0391 22.6847 17.074 22.6555C17.1089 22.6263 17.1326 22.5859 17.141 22.5412C17.1671 22.4026 17.1815 22.2622 17.184 22.1212V22.1154C17.1838 22.0645 17.1636 22.0157 17.1278 21.9796C17.092 21.9434 17.0435 21.9227 16.9927 21.9219H16.9926ZM16.9887 19.5781C16.9369 19.5783 16.8873 19.5989 16.8507 19.6355C16.8141 19.6721 16.7935 19.7217 16.7934 19.7734V20.1641C16.7934 20.2159 16.814 20.2655 16.8506 20.3022C16.8872 20.3388 16.9369 20.3594 16.9887 20.3594C17.0405 20.3594 17.0902 20.3388 17.1268 20.3022C17.1634 20.2655 17.184 20.2159 17.184 20.1641V19.7734C17.1841 19.7478 17.1791 19.7223 17.1693 19.6986C17.1596 19.6748 17.1452 19.6532 17.127 19.6351C17.1089 19.6169 17.0873 19.6025 17.0635 19.5928C17.0398 19.583 17.0143 19.578 16.9886 19.5781H16.9887ZM19.1293 11.1131C19.1557 11.1571 19.1982 11.1891 19.2478 11.2022C19.2975 11.2154 19.3502 11.2086 19.3949 11.1834C19.4394 11.1569 19.4716 11.1141 19.4848 11.064C19.4979 11.014 19.4909 10.9608 19.4653 10.9159C19.3987 10.8006 19.3266 10.6854 19.2522 10.5741C19.2223 10.5321 19.1775 10.5033 19.127 10.4935C19.0765 10.4837 19.0241 10.4936 18.9807 10.5213C18.9542 10.5392 18.9325 10.5634 18.9175 10.5916C18.9025 10.6199 18.8948 10.6514 18.8949 10.6834C18.895 10.7224 18.9066 10.7604 18.9281 10.7928C18.9985 10.9004 19.0669 11.0077 19.1293 11.1132L19.1293 11.1131ZM18.4653 10.1953C18.4837 10.216 18.5062 10.2326 18.5315 10.2441C18.5567 10.2555 18.584 10.2615 18.6117 10.2617C18.6493 10.2617 18.686 10.2508 18.7175 10.2304C18.749 10.2101 18.774 10.181 18.7895 10.1468C18.8049 10.1126 18.8102 10.0747 18.8047 10.0376C18.7991 10.0004 18.783 9.9657 18.7582 9.9375C18.6723 9.83789 18.5805 9.74024 18.4828 9.64258C18.4459 9.60689 18.3965 9.58695 18.3451 9.58695C18.2938 9.58695 18.2444 9.60689 18.2074 9.64258C18.1893 9.66066 18.175 9.68213 18.1652 9.70575C18.1554 9.72938 18.1504 9.7547 18.1504 9.78028C18.1504 9.80585 18.1554 9.83117 18.1652 9.8548C18.175 9.87843 18.1893 9.89989 18.2074 9.91797C18.2992 10.0117 18.3853 10.1035 18.4654 10.1953H18.4653ZM19.7973 12.8299C19.7966 12.8437 19.7979 12.8575 19.8012 12.871C19.8266 12.9921 19.8481 13.1172 19.8656 13.2421C19.8719 13.289 19.8949 13.332 19.9305 13.3633C19.966 13.3945 20.0117 13.4118 20.059 13.412C20.0688 13.412 20.0766 13.41 20.0863 13.41C20.1374 13.4024 20.1835 13.3749 20.2145 13.3337C20.2456 13.2924 20.2592 13.2405 20.2524 13.1893C20.2348 13.0604 20.2113 12.9274 20.184 12.7909C20.1726 12.7408 20.1422 12.6971 20.0992 12.6691C20.0562 12.641 20.004 12.6308 19.9535 12.6405C19.9095 12.6489 19.8697 12.6725 19.8412 12.7071C19.8127 12.7417 19.7972 12.7852 19.7973 12.8301L19.7973 12.8299ZM19.4654 11.7889C19.5142 11.9022 19.5591 12.0213 19.6001 12.1424C19.6136 12.1808 19.6388 12.2139 19.672 12.2374C19.7053 12.2608 19.7449 12.2734 19.7856 12.2733C19.8076 12.2731 19.8294 12.2692 19.8501 12.2617C19.8987 12.2445 19.9386 12.2088 19.9609 12.1623C19.9832 12.1158 19.9862 12.0623 19.9692 12.0136C19.9282 11.8925 19.8794 11.7656 19.8266 11.6367C19.8054 11.5899 19.767 11.553 19.7194 11.5337C19.6718 11.5144 19.6185 11.5142 19.5708 11.5332C19.535 11.5477 19.5044 11.5726 19.4829 11.6046C19.4613 11.6366 19.4497 11.6743 19.4497 11.7129C19.4501 11.739 19.4555 11.7648 19.4654 11.7889L19.4654 11.7889ZM14.0108 11.4088H14.1655C14.3198 11.409 14.4677 11.4704 14.5767 11.5795C14.6858 11.6886 14.7471 11.8366 14.7473 11.9908V12.0423C14.9256 12.0695 15.0961 12.1343 15.2476 12.2324C15.399 12.3305 15.5278 12.4597 15.6254 12.6113C15.6815 12.6972 15.7131 12.7969 15.7166 12.8994C15.7201 13.002 15.6955 13.1035 15.6455 13.1931C15.5952 13.2859 15.5208 13.3635 15.4301 13.4176C15.3394 13.4717 15.2359 13.5003 15.1303 13.5005C15.035 13.5019 14.941 13.4792 14.8568 13.4346C14.7726 13.39 14.701 13.3249 14.6486 13.2453C14.6385 13.2288 14.6242 13.2152 14.6073 13.2057C14.5904 13.1962 14.5713 13.1912 14.5519 13.1912H13.6244C13.6077 13.1913 13.5913 13.195 13.5762 13.2021C13.5611 13.2092 13.5478 13.2195 13.5371 13.2323C13.5264 13.2452 13.5186 13.2601 13.5143 13.2762C13.5101 13.2924 13.5093 13.3092 13.5122 13.3256C13.5201 13.3538 13.5374 13.3784 13.5612 13.3954C13.585 13.4124 13.6139 13.4208 13.6431 13.4191H14.502C14.6838 13.4197 14.8637 13.4568 15.0309 13.5284C15.1981 13.5999 15.3491 13.7043 15.4751 13.8355C15.5933 13.9562 15.6856 14.0997 15.7464 14.2573C15.8072 14.4148 15.8352 14.5832 15.8286 14.752C15.8158 15.0473 15.7011 15.3291 15.504 15.5494C15.3068 15.7697 15.0395 15.9149 14.7473 15.9603V16.0117C14.7472 16.166 14.6859 16.3139 14.5768 16.423C14.4678 16.5322 14.3199 16.5936 14.1656 16.5938H14.0109C13.8566 16.5936 13.7087 16.5322 13.5997 16.423C13.4906 16.3139 13.4293 16.166 13.4291 16.0117V15.9602C13.2508 15.933 13.0802 15.8681 12.9288 15.77C12.7774 15.6718 12.6486 15.5426 12.551 15.3909C12.4948 15.305 12.4633 15.2054 12.4597 15.1029C12.4562 15.0004 12.4807 14.8989 12.5308 14.8093C12.581 14.7165 12.6554 14.6389 12.7461 14.5848C12.8368 14.5307 12.9404 14.502 13.046 14.5019C13.1412 14.5005 13.2353 14.5231 13.3195 14.5677C13.4037 14.6122 13.4753 14.6773 13.5277 14.7569C13.5379 14.7735 13.5521 14.7872 13.569 14.7967C13.5859 14.8062 13.605 14.8112 13.6245 14.8112H14.552C14.5687 14.8111 14.5851 14.8074 14.6002 14.8003C14.6153 14.7932 14.6286 14.7828 14.6393 14.77C14.65 14.7572 14.6578 14.7422 14.662 14.7261C14.6663 14.71 14.6671 14.6932 14.6642 14.6768C14.6563 14.6486 14.639 14.624 14.6152 14.6069C14.5914 14.5899 14.5625 14.5815 14.5333 14.5831H13.6744C13.4925 14.5825 13.3126 14.5453 13.1454 14.4738C12.9782 14.4023 12.827 14.2979 12.701 14.1667C12.5829 14.0461 12.4907 13.9025 12.43 13.745C12.3692 13.5875 12.3413 13.4192 12.3478 13.2505C12.3605 12.9551 12.4752 12.6733 12.6724 12.453C12.8695 12.2326 13.1369 12.0875 13.4291 12.0422V11.9908C13.4292 11.8366 13.4905 11.6886 13.5996 11.5795C13.7086 11.4704 13.8565 11.409 14.0108 11.4088ZM14.1655 11.7994H14.0108C13.9601 11.7995 13.9115 11.8197 13.8757 11.8556C13.8398 11.8915 13.8197 11.9401 13.8197 11.9908V12.2227C13.8197 12.2745 13.7991 12.3241 13.7625 12.3608C13.7259 12.3974 13.6762 12.418 13.6244 12.418C13.3957 12.4179 13.1759 12.5062 13.0107 12.6643C12.8456 12.8225 12.7479 13.0383 12.738 13.2667C12.7338 13.3828 12.7534 13.4985 12.7955 13.6067C12.8376 13.7149 12.9014 13.8134 12.9829 13.8962C13.0724 13.9894 13.1797 14.0636 13.2985 14.1145C13.4173 14.1654 13.5451 14.1919 13.6743 14.1924H14.5332C14.6547 14.191 14.7728 14.2322 14.8671 14.3088C14.9614 14.3854 15.0259 14.4926 15.0494 14.6118C15.0616 14.6842 15.058 14.7584 15.0386 14.8293C15.0193 14.9001 14.9848 14.9659 14.9374 15.0221C14.8901 15.0782 14.831 15.1234 14.7645 15.1544C14.6979 15.1854 14.6254 15.2015 14.5519 15.2016H13.6244C13.5388 15.2018 13.4545 15.18 13.3797 15.1384C13.3048 15.0969 13.2418 15.0369 13.1967 14.9642C13.1797 14.9407 13.1572 14.9218 13.1311 14.9092C13.105 14.8967 13.0762 14.8908 13.0473 14.8923C13.0117 14.892 12.9767 14.9015 12.9462 14.9197C12.9156 14.938 12.8907 14.9643 12.8741 14.9958C12.8581 15.0238 12.85 15.0556 12.8509 15.0878C12.8518 15.1201 12.8615 15.1514 12.8791 15.1785C12.9593 15.3032 13.0697 15.4057 13.1999 15.4766C13.3302 15.5475 13.4762 15.5845 13.6245 15.5842C13.6763 15.5842 13.726 15.6048 13.7626 15.6414C13.7992 15.678 13.8198 15.7277 13.8198 15.7795V16.0117C13.8198 16.0624 13.8399 16.1111 13.8758 16.147C13.9116 16.1828 13.9602 16.2031 14.0109 16.2031H14.1656C14.2163 16.2031 14.2649 16.1829 14.3008 16.147C14.3366 16.1111 14.3567 16.0624 14.3567 16.0117V15.7797C14.3567 15.7279 14.3773 15.6782 14.4139 15.6416C14.4506 15.605 14.5002 15.5844 14.552 15.5844C14.7807 15.5843 15.0005 15.496 15.1656 15.3379C15.3307 15.1798 15.4285 14.964 15.4384 14.7356C15.4425 14.6195 15.4229 14.5038 15.3808 14.3955C15.3387 14.2873 15.2749 14.1887 15.1933 14.106C15.1039 14.0128 14.9965 13.9385 14.8778 13.8876C14.759 13.8367 14.6312 13.8102 14.502 13.8098H13.6431C13.5217 13.8112 13.4036 13.77 13.3093 13.6934C13.215 13.6169 13.1505 13.5098 13.127 13.3906C13.1147 13.3182 13.1183 13.244 13.1377 13.1731C13.157 13.1023 13.1915 13.0365 13.2389 12.9803C13.2863 12.9242 13.3453 12.879 13.4119 12.848C13.4784 12.817 13.551 12.8009 13.6244 12.8008H14.552C14.6376 12.8007 14.7217 12.8224 14.7966 12.8639C14.8714 12.9054 14.9345 12.9652 14.9797 13.0379C14.9967 13.0614 15.0192 13.0803 15.0453 13.0929C15.0715 13.1056 15.1003 13.1115 15.1293 13.1101C15.1648 13.1104 15.1998 13.1009 15.2304 13.0826C15.2609 13.0643 15.2858 13.0381 15.3025 13.0066C15.3184 12.9786 15.3264 12.9467 15.3255 12.9144C15.3246 12.8822 15.3149 12.8508 15.2975 12.8237C15.2172 12.699 15.1068 12.5964 14.9766 12.5255C14.8463 12.4546 14.7003 12.4177 14.5519 12.418C14.5001 12.418 14.4505 12.3974 14.4138 12.3608C14.3772 12.3241 14.3566 12.2745 14.3566 12.2227V11.9907C14.3566 11.94 14.3365 11.8914 14.3006 11.8556C14.2648 11.8197 14.2162 11.7995 14.1655 11.7994ZM14.0646 9.96494C15.0126 9.96482 15.9313 10.2934 16.6641 10.8947C17.397 11.496 17.8987 12.3328 18.0837 13.2626C18.2687 14.1923 18.1256 15.1574 17.6788 15.9935C17.232 16.8296 16.5092 17.4848 15.6334 17.8477C14.7576 18.2105 13.7831 18.2584 12.8759 17.9833C11.9688 17.7082 11.1851 17.127 10.6584 16.3388C10.1317 15.5506 9.89459 14.6042 9.98749 13.6608C10.0804 12.7174 10.4975 11.8354 11.1678 11.165C11.5474 10.7834 11.9988 10.4808 12.496 10.2748C12.9932 10.0688 13.5264 9.96351 14.0646 9.96494ZM16.6852 11.4412C16.1668 10.9228 15.5063 10.5698 14.7873 10.4268C14.0682 10.2838 13.3229 10.3572 12.6456 10.6378C11.9683 10.9183 11.3894 11.3934 10.9821 12.003C10.5748 12.6126 10.3574 13.3292 10.3574 14.0623C10.3574 14.7954 10.5748 15.5121 10.9821 16.1217C11.3894 16.7312 11.9683 17.2063 12.6456 17.4869C13.3229 17.7675 14.0682 17.8409 14.7873 17.6978C15.5063 17.5548 16.1668 17.2018 16.6852 16.6834C17.0324 16.3409 17.3081 15.9328 17.4962 15.4829C17.6844 15.0329 17.7813 14.55 17.7813 14.0623C17.7813 13.5746 17.6844 13.0918 17.4962 12.6418C17.3081 12.1918 17.0324 11.7838 16.6852 11.4412ZM22.6416 22.6408C22.5129 22.7695 22.3601 22.8717 22.192 22.9413C22.0238 23.011 21.8435 23.0469 21.6615 23.0469C21.4795 23.0469 21.2992 23.011 21.131 22.9413C20.9629 22.8717 20.8101 22.7695 20.6814 22.6408L18.2491 20.2082C18.1629 20.1218 18.1145 20.0049 18.1145 19.8829C18.1145 19.7609 18.1629 19.6439 18.2491 19.5576L18.2987 19.508L17.2783 18.4872C17.0037 18.6881 16.7109 18.8627 16.4036 19.0087V22.0703C16.4032 22.5363 16.2179 22.9831 15.8884 23.3127C15.5589 23.6422 15.1122 23.8276 14.6462 23.8281H2.53874C2.07273 23.8276 1.62597 23.6422 1.29647 23.3127C0.966973 22.9831 0.781651 22.5363 0.781165 22.0703V8.23403C0.780888 7.78784 0.950462 7.35827 1.25544 7.03258L7.30544 0.561526C7.46983 0.384358 7.66903 0.243039 7.89056 0.146416C8.11209 0.0497925 8.35119 -5.31277e-05 8.59287 4.24925e-08C8.83456 5.32126e-05 9.07363 0.050004 9.29512 0.146725C9.51661 0.243445 9.71574 0.384853 9.88005 0.562092L11.9986 2.82813C14.0212 2.73408 15.3386 3.09561 15.9075 3.90907C16.0672 4.1394 16.1674 4.40567 16.1991 4.68413C16.2309 4.96259 16.1932 5.24458 16.0895 5.50494C15.9506 5.89486 15.7646 6.2664 15.5358 6.61133L15.9293 7.03237C16.2343 7.35811 16.4039 7.78773 16.4036 8.23399V9.1159C17.1296 9.46081 17.7708 9.96129 18.2817 10.5818C18.7926 11.2023 19.1606 11.9277 19.3597 12.7064C19.5587 13.4852 19.584 14.2981 19.4336 15.0877C19.2832 15.8773 18.9608 16.6241 18.4894 17.2751L19.5104 18.2961L19.5589 18.2476C19.6452 18.1615 19.7621 18.1132 19.884 18.1132C20.0059 18.1132 20.1228 18.1615 20.2091 18.2476L22.6416 20.6804C22.9011 20.9406 23.0469 21.2931 23.0469 21.6606C23.0469 22.0281 22.9011 22.3806 22.6416 22.6408ZM17.6549 10.4714C16.9447 9.76108 16.0398 9.27736 15.0547 9.08137C14.0696 8.88538 13.0484 8.98592 12.1205 9.37028C11.1925 9.75464 10.3993 10.4056 9.84125 11.2407C9.28321 12.0759 8.98535 13.0577 8.98535 14.0622C8.98535 15.0666 9.28321 16.0485 9.84125 16.8836C10.3993 17.7188 11.1925 18.3697 12.1205 18.7541C13.0484 19.1384 14.0696 19.239 15.0547 19.043C16.0398 18.847 16.9447 18.3633 17.6549 17.653C18.1305 17.1837 18.5082 16.6246 18.7659 16.0082C19.0237 15.3918 19.1564 14.7303 19.1564 14.0622C19.1564 13.394 19.0237 12.7325 18.7659 12.1161C18.5082 11.4997 18.1305 10.9406 17.6549 10.4714ZM5.07742 17.3826C5.07756 17.5379 5.13932 17.6869 5.24913 17.7967C5.35895 17.9066 5.50785 17.9684 5.66318 17.9686H10.2394C10.2257 17.9552 10.2116 17.9428 10.1981 17.9293C9.40884 17.138 8.88047 16.1242 8.6839 15.0239C8.48733 13.9237 8.63196 12.7897 9.09839 11.774L8.78769 11.5339L5.07742 14.4015V17.3826ZM9.7056 10.7622L9.0266 10.2375C8.95811 10.1848 8.8741 10.1562 8.78766 10.1562C8.70122 10.1562 8.61722 10.1849 8.54878 10.2377L4.25265 13.5578C4.21206 13.5892 4.17805 13.6283 4.15255 13.6728C4.12706 13.7173 4.11058 13.7664 4.10407 13.8173C4.09755 13.8682 4.10112 13.9198 4.11457 13.9694C4.12803 14.0189 4.1511 14.0652 4.18247 14.1058C4.21385 14.1464 4.25291 14.1804 4.29743 14.2059C4.34195 14.2314 4.39106 14.2479 4.44194 14.2544C4.49283 14.2609 4.5445 14.2574 4.59401 14.2439C4.64352 14.2304 4.68989 14.2074 4.73048 14.176L8.66829 11.1326C8.70245 11.1061 8.74446 11.0917 8.7877 11.0917C8.83094 11.0917 8.87295 11.1061 8.9071 11.1326L9.27853 11.4197C9.40485 11.1905 9.54758 10.9708 9.7056 10.7622ZM10.1981 10.1952C10.7205 9.67141 11.3439 9.25934 12.0305 8.98399H4.68706C4.32459 8.98442 3.97709 9.1286 3.72079 9.3849C3.46449 9.64121 3.32031 9.98871 3.31988 10.3512V17.7734C3.3203 18.1359 3.46448 18.4834 3.72078 18.7397C3.97709 18.996 4.32459 19.1402 4.68706 19.1406H12.0305C11.5462 18.9463 11.0925 18.6831 10.6834 18.3592H5.66318C5.40429 18.3589 5.15611 18.2559 4.97307 18.0728C4.79002 17.8897 4.68707 17.6415 4.68679 17.3826V14.6208C4.51277 14.6664 4.32833 14.6504 4.16474 14.5755C4.00116 14.5007 3.8685 14.3715 3.78926 14.21C3.71002 14.0485 3.68908 13.8646 3.72998 13.6894C3.77088 13.5142 3.87112 13.3586 4.01369 13.2488L8.30999 9.92852C8.44686 9.82303 8.61478 9.76581 8.78758 9.76577C8.96037 9.76573 9.12832 9.82289 9.26523 9.92832L9.95246 10.4596C10.0314 10.3696 10.1124 10.2809 10.1981 10.1952ZM12.3516 3.20567L12.6657 3.5417L12.7788 3.6625C14.3643 3.685 14.9733 4.06723 15.2049 4.38711C15.2834 4.4993 15.334 4.62868 15.3522 4.76441C15.3705 4.90015 15.3559 5.03828 15.3098 5.16723C15.307 5.17523 15.3037 5.18306 15.3 5.19067C14.9117 6.25229 14.3669 6.83498 13.6787 6.9294C11.6654 7.21207 8.93044 3.48018 8.90306 3.44258C8.87665 3.40546 8.83977 3.37707 8.79713 3.36103C8.75449 3.345 8.70803 3.34206 8.66371 3.35259C8.61939 3.36312 8.57922 3.38664 8.54835 3.42013C8.51747 3.45363 8.4973 3.49558 8.4904 3.54061C8.48557 3.5702 8.48669 3.60046 8.4937 3.62961C8.5007 3.65876 8.51346 3.68622 8.53122 3.71037C9.5223 5.08289 11.6755 7.40395 13.4648 7.40395C13.558 7.40356 13.651 7.39693 13.7433 7.3841C14.6085 7.26414 15.2753 6.58492 15.7245 5.36576L15.7279 5.35717C15.8059 5.15717 15.8338 4.94118 15.8094 4.72793C15.785 4.51469 15.7089 4.31062 15.5877 4.13342C15.1296 3.47832 14.0406 3.16301 12.3516 3.20567ZM9.37357 3.31992C9.37355 3.17872 9.33525 3.04016 9.26275 2.91898C9.19024 2.79781 9.08625 2.69856 8.96183 2.63179C8.83741 2.56501 8.69721 2.53322 8.55615 2.53979C8.4151 2.54635 8.27846 2.59103 8.16078 2.66908C8.0431 2.74712 7.94878 2.8556 7.88784 2.98299C7.82691 3.11037 7.80165 3.25189 7.81475 3.39249C7.82785 3.53309 7.87881 3.6675 7.96223 3.78144C8.04564 3.89538 8.15838 3.98457 8.28845 4.03953C8.25697 3.99719 8.23195 3.96295 8.2154 3.93992C8.16724 3.87433 8.13264 3.79979 8.11362 3.72067C8.09461 3.64154 8.09156 3.55942 8.10466 3.4791C8.12373 3.35776 8.17845 3.24482 8.26185 3.15464C8.34526 3.06446 8.45359 3.00111 8.57308 2.97264C8.69257 2.94417 8.81783 2.95187 8.93294 2.99475C9.04805 3.03763 9.14781 3.11377 9.21955 3.21348C9.26642 3.27793 9.31634 3.34453 9.36767 3.41196C9.37144 3.38142 9.3734 3.35069 9.37355 3.31992H9.37357ZM14.9291 5.06973C14.933 5.05702 14.9377 5.04454 14.943 5.03235C14.9665 4.96353 14.9739 4.89021 14.9644 4.81809C14.955 4.74597 14.9291 4.677 14.8886 4.61655C14.7806 4.46715 14.4012 4.14108 13.1576 4.06772L14.6585 5.67319C14.7637 5.47912 14.8542 5.2774 14.929 5.06973H14.9291ZM16.013 19.1737C15.3908 19.4106 14.7304 19.5318 14.0646 19.5313C13.8125 19.531 13.5606 19.5135 13.3109 19.4789C13.3089 19.4794 13.3077 19.4809 13.3059 19.4813C13.1692 19.5145 13.029 19.5313 12.8883 19.5313H4.68714C4.2211 19.5307 3.77429 19.3454 3.44475 19.0158C3.11521 18.6863 2.92985 18.2395 2.92933 17.7734V10.3512C2.92985 9.88513 3.11521 9.43833 3.44475 9.10878C3.77429 8.77924 4.2211 8.59388 4.68714 8.59336H12.8883C13.0317 8.59337 13.1745 8.61084 13.3136 8.64537C13.5624 8.61105 13.8134 8.59367 14.0646 8.59336C14.7304 8.59284 15.3908 8.71403 16.013 8.95096V8.23403C16.0131 7.88671 15.8811 7.55237 15.6437 7.29883L15.2946 6.92522C14.9185 7.3846 14.3839 7.68639 13.7962 7.7711C13.6864 7.78634 13.5756 7.79417 13.4647 7.79453C11.5444 7.79453 9.51595 5.57526 8.63812 4.48908C8.62283 4.48969 8.6079 4.49176 8.59247 4.49176C8.33874 4.49287 8.09145 4.41195 7.88746 4.26105C7.68347 4.11016 7.53371 3.89738 7.4605 3.65444C7.38729 3.4115 7.39457 3.1514 7.48123 2.91292C7.5679 2.67445 7.72931 2.47037 7.94142 2.33111C8.15352 2.19185 8.40495 2.12487 8.65822 2.14016C8.91149 2.15544 9.15305 2.25217 9.34686 2.41593C9.54068 2.57968 9.67638 2.80169 9.73374 3.04886C9.7911 3.29602 9.76704 3.55511 9.66515 3.78748C10.7566 5.11426 12.4796 6.7009 13.6252 6.54254C13.7892 6.51184 13.9455 6.4488 14.0849 6.35708C14.2243 6.26537 14.344 6.14682 14.4372 6.00834L12.4173 3.84793L11.7736 3.16043C11.7724 3.15914 11.7718 3.1575 11.7706 3.15617L9.59414 0.828127C9.46637 0.690173 9.31149 0.580098 9.13919 0.504802C8.96689 0.429505 8.7809 0.390612 8.59287 0.390559C8.40484 0.390505 8.21883 0.429294 8.04649 0.504492C7.87415 0.579691 7.7192 0.689679 7.59136 0.827561L1.54091 7.29905C1.3036 7.55252 1.17162 7.8868 1.17177 8.23403V22.0703C1.17216 22.4328 1.3163 22.7802 1.57256 23.0365C1.82881 23.2928 2.17627 23.437 2.5387 23.4375H14.6461C15.0085 23.437 15.356 23.2928 15.6122 23.0365C15.8685 22.7802 16.0126 22.4327 16.013 22.0703L16.013 19.1737ZM18.5748 19.2318L19.2343 18.5723L18.2461 17.5841C18.1465 17.7023 18.0424 17.818 17.9311 17.9293C17.8205 18.0399 17.7053 18.1441 17.5872 18.2439L18.5748 19.2318ZM22.3654 20.9566L19.9329 18.5238C19.9199 18.5108 19.9023 18.5036 19.884 18.5036C19.8657 18.5036 19.8481 18.5108 19.8351 18.5238L19.7071 18.6517C19.6979 18.679 19.6827 18.7038 19.6626 18.7244L18.7271 19.6602C18.7065 19.6801 18.6818 19.6952 18.6547 19.7043L18.5253 19.8338C18.5123 19.8468 18.505 19.8645 18.505 19.8829C18.505 19.9013 18.5123 19.919 18.5253 19.932L20.9576 22.3646C21.1443 22.5513 21.3975 22.6562 21.6616 22.6562C21.9256 22.6562 22.1788 22.5513 22.3655 22.3645C22.5522 22.1778 22.6571 21.9246 22.6571 21.6606C22.6571 21.3965 22.5522 21.1433 22.3654 20.9566ZM8.78769 20.5078H4.30378C4.25198 20.5078 4.2023 20.5284 4.16568 20.565C4.12905 20.6017 4.10847 20.6513 4.10847 20.7031C4.10847 20.7549 4.12905 20.8046 4.16568 20.8412C4.2023 20.8779 4.25198 20.8984 4.30378 20.8984H8.78769C8.83949 20.8984 8.88917 20.8779 8.9258 20.8412C8.96243 20.8046 8.983 20.7549 8.983 20.7031C8.983 20.6513 8.96243 20.6017 8.9258 20.565C8.88917 20.5284 8.83949 20.5078 8.78769 20.5078ZM3.12452 20.8984H3.59585C3.64765 20.8984 3.69733 20.8779 3.73396 20.8412C3.77059 20.8046 3.79117 20.7549 3.79117 20.7031C3.79117 20.6513 3.77059 20.6017 3.73396 20.565C3.69733 20.5284 3.64765 20.5078 3.59585 20.5078H3.12452C3.07272 20.5078 3.02305 20.5284 2.98642 20.565C2.94979 20.6017 2.92921 20.6513 2.92921 20.7031C2.92921 20.7549 2.94979 20.8046 2.98642 20.8412C3.02305 20.8779 3.07272 20.8984 3.12452 20.8984ZM8.78769 21.4844H7.83169C7.77989 21.4844 7.73022 21.505 7.69359 21.5416C7.65696 21.5782 7.63638 21.6279 7.63638 21.6797C7.63638 21.7315 7.65696 21.7812 7.69359 21.8178C7.73022 21.8544 7.77989 21.875 7.83169 21.875H8.78769C8.83949 21.875 8.88917 21.8544 8.9258 21.8178C8.96243 21.7812 8.983 21.7315 8.983 21.6797C8.983 21.6279 8.96243 21.5782 8.9258 21.5416C8.88917 21.505 8.83949 21.4844 8.78769 21.4844ZM7.12376 21.4844H3.12452C3.07272 21.4844 3.02305 21.505 2.98642 21.5416C2.94979 21.5782 2.92921 21.6279 2.92921 21.6797C2.92921 21.7315 2.94979 21.7812 2.98642 21.8178C3.02305 21.8544 3.07272 21.875 3.12452 21.875H7.12376C7.17556 21.875 7.22524 21.8544 7.26187 21.8178C7.2985 21.7812 7.31908 21.7315 7.31908 21.6797C7.31908 21.6279 7.2985 21.5782 7.26187 21.5416C7.22524 21.505 7.17556 21.4844 7.12376 21.4844ZM10.5452 20.7031C10.5452 20.7549 10.5657 20.8046 10.6024 20.8412C10.639 20.8779 10.6887 20.8984 10.7405 20.8984H14.4509C14.5027 20.8984 14.5523 20.8779 14.589 20.8412C14.6256 20.8046 14.6462 20.7549 14.6462 20.7031C14.6462 20.6513 14.6256 20.6017 14.589 20.565C14.5523 20.5284 14.5027 20.5078 14.4509 20.5078H10.7405C10.6887 20.5078 10.639 20.5284 10.6024 20.565C10.5657 20.6017 10.5452 20.6513 10.5452 20.7031ZM9.56886 20.8984H9.95949C10.0113 20.8984 10.061 20.8779 10.0976 20.8412C10.1342 20.8046 10.1548 20.7549 10.1548 20.7031C10.1548 20.6513 10.1342 20.6017 10.0976 20.565C10.061 20.5284 10.0113 20.5078 9.95949 20.5078H9.56886C9.51706 20.5078 9.46738 20.5284 9.43075 20.565C9.39413 20.6017 9.37355 20.6513 9.37355 20.7031C9.37355 20.7549 9.39413 20.8046 9.43075 20.8412C9.46738 20.8779 9.51706 20.8984 9.56886 20.8984ZM14.4509 21.4844H13.6698C13.618 21.4844 13.5683 21.505 13.5317 21.5416C13.495 21.5782 13.4745 21.6279 13.4745 21.6797C13.4745 21.7315 13.495 21.7812 13.5317 21.8178C13.5683 21.8544 13.618 21.875 13.6698 21.875H14.4509C14.5027 21.875 14.5523 21.8544 14.589 21.8178C14.6256 21.7812 14.6462 21.7315 14.6462 21.6797C14.6462 21.6279 14.6256 21.5782 14.589 21.5416C14.5523 21.505 14.5027 21.4844 14.4509 21.4844ZM12.8887 21.4844H9.56886C9.51706 21.4844 9.46738 21.505 9.43075 21.5416C9.39413 21.5782 9.37355 21.6279 9.37355 21.6797C9.37355 21.7315 9.39413 21.7812 9.43075 21.8178C9.46738 21.8544 9.51706 21.875 9.56886 21.875H12.8887C12.9405 21.875 12.9902 21.8544 13.0268 21.8178C13.0634 21.7812 13.084 21.7315 13.084 21.6797C13.084 21.6279 13.0634 21.5782 13.0268 21.5416C12.9902 21.505 12.9405 21.4844 12.8887 21.4844Z"
                                fill="white" />
                        </svg>
                    </button>
                </form>
            </div>
            <div class="wrapperPilihRumah">
                <div class="propertiWrapper terpopuler">
                @foreach (DB::table('rumah')->get() as $item)

                <a href="{{ route('detailRumah',['id'=>$item->id]) }}" class="properti">
                    <img src="{{$item->GAMBAR}}" style="height: 336px" alt="" class="fotoProperti">
                    <div class="informationProperti">
                        <p class="namePT">{{$item->NAMA_DEV}}</p>
                        <h1 class="namePerumahan">{{$item->NAMA_PROPER}}</h1>

                        <div class="detailInformation">
                            <p class="locationProperti">{{$item->ALAMAT}}</p>
                            <h1 class="price">Rp {{ number_format($item->HARGA, 2, ',', '.') }}</h1>
                        </div>
                    </div>
                </a>
                @endforeach
                    <div style=" height: 520px" class="properti kategoriProperti">
                        <h1 class="nameKategori">Properti Terpopuler BTN Properti</h1>
                        <p class="promotiontext">Temukan properti-properti populer BTN Properti pilihan Pengunjung.</p>

                        <a href="{{ route('selengkapnya') }}" class="morePropertButton">
                            Lihat Selengkapnya
                        </a>
                    </div>
                </div>

                <div class="propertiWrapper terbaru">
                    <div style=" height: 520px" class="properti kategoriProperti">
                        <h1 class="nameKategori">Properti Terbaru BTN Properti </h1>
                        <p class="promotiontext">Temukan properti terbaru BTN Properti dari developer-developer pilihan
                            Bank BTN</p>

                        <a href="{{ route('selengkapnya') }}" class="morePropertButton">
                            Lihat Selengkapnya
                        </a>
                    </div>
                    @foreach (DB::table('rumah')->get() as $item)

                    <a href="{{ route('detailRumah',['id'=>$item->id]) }}" class="properti">
                        <img src="{{$item->GAMBAR}}" style="height: 336px" alt="" class="fotoProperti">
                        <div class="informationProperti">
                            <p class="namePT">{{$item->NAMA_DEV}}</p>
                            <h1 class="namePerumahan">{{$item->NAMA_PROPER}}</h1>

                            <div class="detailInformation">
                                <p class="locationProperti">{{$item->ALAMAT}}</p>
                                <h1 class="price">Rp {{ number_format($item->HARGA, 2, ',', '.') }}</h1>
                            </div>
                        </div>
                    </a>
                    @endforeach

                </div>

                <div class="propertiWrapper subsidi">
                    @foreach (DB::table('rumah')->get() as $item)

                    <a href="{{ route('detailRumah',['id'=>$item->id]) }}" class="properti">
                        <img src="{{$item->GAMBAR}}" style="height: 336px" alt="" class="fotoProperti">
                        <div class="informationProperti">
                            <p class="namePT">{{$item->NAMA_DEV}}</p>
                            <h1 class="namePerumahan">{{$item->NAMA_PROPER}}</h1>

                            <div class="detailInformation">
                                <p class="locationProperti">{{$item->ALAMAT}}</p>
                                <h1 class="price">Rp {{ number_format($item->HARGA, 2, ',', '.') }}</h1>
                            </div>
                        </div>
                    </a>
                    @endforeach
                    <div style=" height: 520px" class="properti kategoriProperti">
                        <h1 class="nameKategori">Properti Subsidi BTN Properti</h1>
                        <p class="promotiontext">Temukan properti-properti bersubsidi dukungan pemerintah untuk MBR.</p>

                        <a href="{{ route('selengkapnya') }}" class="morePropertButton">
                            Lihat Selengkapnya
                        </a>
                    </div>
                </div>

                <div class="pilihanBank">
                    <div class="kategoriProperti">
                        <h1 class="nameKategori">4D Pilihan Bank BTN</h1>
                        <p class="promotiontext">Temukan properti pilihan Bank BTN lengkap dengan fitur 4D</p>

                        <div class="icon">
                            <svg width="182" height="182" viewBox="0 0 182 182" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M174.92 151.424L142.233 132.514V78.2782L95.2409 51.0692V15.0332H86.9417V51.0692L39.7673 78.2782V132.696L7.08008 151.424L11.3207 158.668L44.0079 139.758L91.0003 166.967L137.993 139.758L170.68 158.668L174.92 151.424ZM129.693 80.5714L91.0003 103.012L52.3071 80.5714L91.0003 58.3128L129.693 80.5714ZM95.2409 110.256L133.934 87.815V132.514L95.2409 154.955V110.256ZM48.0665 87.815L86.7597 110.256V154.955L48.0665 132.514V87.815Z"
                                    fill="white" />
                            </svg>
                        </div>
                    </div>
                    <div class="wrapperPropertiPilihan">
                        <div class="propertiPilihan">
                            <h1 class="nameProperti">Tamana Melati Premier</h1>
                            <img src="./assets/img/komplekImages1.svg" alt="" class="imagesProperti">
                            <div class="wrapperInformation">
                                <div class="propertiInformation">
                                    <h1 class="nameInformationProperti">Tamana Melati Premier</h1>
                                    <p class="textInformation">Taman Melati Premier Menghadirkan hunian yang nyaman, asri,
                                        dan akrab membuat anda selalu ingin kembali ke rumah utama anda, kembali menikmati
                                        kehangatan keluarga bersama. The truly Home Sweet Home</p>
                                    <a class="viewMorePropertiPilihan" href="#">Lihat Properti</a>
                                </div>
                            </div>
                        </div>

                        <div class="propertiPilihan">
                            <h1 class="nameProperti">Tamana Melati Premier</h1>
                            <img src="./assets/img/komplek2.svg" alt="" class="imagesProperti">
                            <div class="wrapperInformation">
                                <div class="propertiInformation">
                                    <h1 class="nameInformationProperti">Tamana Melati Premier</h1>
                                    <p class="textInformation">Taman Melati Premier Menghadirkan hunian yang nyaman, asri,
                                        dan akrab membuat anda selalu ingin kembali ke rumah utama anda, kembali menikmati
                                        kehangatan keluarga bersama. The truly Home Sweet Home</p>
                                    <a class="viewMorePropertiPilihan" href="#">Lihat Properti</a>
                                </div>
                            </div>
                        </div>

                        <div class="propertiPilihan">
                            <h1 class="nameProperti">Tamana Melati Premier</h1>
                            <img src="./assets/img/komplekImages1.svg" alt="" class="imagesProperti">
                            <div class="wrapperInformation">
                                <div class="propertiInformation">
                                    <h1 class="nameInformationProperti">Tamana Melati Premier</h1>
                                    <p class="textInformation">Taman Melati Premier Menghadirkan hunian yang nyaman, asri,
                                        dan akrab membuat anda selalu ingin kembali ke rumah utama anda, kembali menikmati
                                        kehangatan keluarga bersama. The truly Home Sweet Home</p>
                                    <a class="viewMorePropertiPilihan" href="#">Lihat Properti</a>
                                </div>
                            </div>
                        </div>

                        <div class="propertiPilihan">
                            <h1 class="nameProperti">Tamana Melati Premier</h1>
                            <img src="./assets/img/komplekImages1.svg" alt="" class="imagesProperti">
                            <div class="wrapperInformation">
                                <div class="propertiInformation">
                                    <h1 class="nameInformationProperti">Tamana Melati Premier</h1>
                                    <p class="textInformation">Taman Melati Premier Menghadirkan hunian yang nyaman, asri,
                                        dan akrab membuat anda selalu ingin kembali ke rumah utama anda, kembali menikmati
                                        kehangatan keluarga bersama. The truly Home Sweet Home</p>
                                    <a class="viewMorePropertiPilihan" href="#">Lihat Properti</a>
                                </div>
                            </div>
                        </div>

                        <div class="propertiPilihan">
                            <h1 class="nameProperti">Tamana Melati Premier</h1>
                            <img src="./assets/img/komplekImages1.svg" alt="" class="imagesProperti">
                            <div class="wrapperInformation">
                                <div class="propertiInformation">
                                    <h1 class="nameInformationProperti">Tamana Melati Premier</h1>
                                    <p class="textInformation">Taman Melati Premier Menghadirkan hunian yang nyaman, asri,
                                        dan akrab membuat anda selalu ingin kembali ke rumah utama anda, kembali menikmati
                                        kehangatan keluarga bersama. The truly Home Sweet Home</p>
                                    <a class="viewMorePropertiPilihan" href="#">Lihat Properti</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    @endif




    {{-- @endif --}}
    <footer>
        <p>Copyright 2021 © DITKUAD</p>
    </footer>
@endsection


@section('js')

<script src="{{ url('assets/vendors/slick/slick.min.js') }}"></script>
    <script>
        $('.propertiWrapper').slick({
            infinite: false,
            slidesToShow: 4,
            slidesToScroll: 1,
            arrows: false,
            dots: false,
            responsive: [{
                breakpoint: 1400,
                settings: {
                    slidesToShow: 2.1,
                    slidesToScroll: 1
                }
            }]
        });




        $('.wrapperPropertiPilihan').slick({
            infinite: false,
            slidesToShow: 4,
            slidesToScroll: 1,
            arrows: false,
            dots: false,
            responsive: [{
                    breakpoint: 1900,
                    settings: {
                        slidesToShow: 3.1,
                        slidesToScroll: 1
                    }
                },
                {
                    breakpoint: 1400,
                    settings: {
                        slidesToShow: 2.1,
                        slidesToScroll: 1
                    }
                },
                {
                    breakpoint: 1200,
                    settings: {
                        slidesToShow: 1.2,
                        slidesToScroll: 1
                    }
                }
            ]
        });
    </script>

    @if (Auth::user()->role == 0)
        <script src="{{ url('assets/vendors/chart.js') }}"></script>
        <script>
            const rekapDataKPR = {
                labels: [
                    'bunga',
                    'pokok'
                ],
                datasets: [{
                    label: 'uhuy',
                    data: [25, 75],
                    backgroundColor: [
                        '#7334FF', '#FF832A'
                    ],
                    hoverOffset: 4
                }]
            };

            const configRekapDataKPR = {
                type: 'doughnut',
                data: rekapDataKPR,
                options: {
                    plugins: {
                        legend: {
                            display: false
                        },
                    }
                }
            };
            var rekapDataKPRChart = new Chart(
                document.getElementById('chartRekapData'),
                configRekapDataKPR
            );



            const dataDebiturBaru = {
                labels: [
                    'Value',
                    'apa'
                ],
                datasets: [{
                    label: 'uhuy',
                    data: [85, 15],
                    backgroundColor: [
                        '#7334FF', '#eee'
                    ],
                    hoverOffset: 4
                }]
            };

            const configDebiturBaru = {
                type: 'doughnut',
                data: dataDebiturBaru,
                options: {
                    plugins: {
                        legend: {
                            display: false
                        },
                    }
                }
            };
            var chartDebiturBaru = new Chart(
                document.getElementById('chartDebiturBaru'),
                configDebiturBaru
            );



            const dataDebiturLunas = {
                labels: [
                    'Value',
                    'apa'
                ],
                datasets: [{
                    label: 'uhuy',
                    data: [15, 85],
                    backgroundColor: [
                        '#DC3545', '#eee'
                    ],
                    hoverOffset: 4
                }]
            };

            const configDebiturLunas = {
                type: 'doughnut',
                data: dataDebiturLunas,
                options: {
                    plugins: {
                        legend: {
                            display: false
                        },
                    }
                }
            };
            var chartDebiturLunas = new Chart(
                document.getElementById('chartDebiturLunas'),
                configDebiturLunas
            );





            const dataDebiturMeninggal = {
                labels: [
                    'Value',
                    'apa'
                ],
                datasets: [{
                    label: 'uhuy',
                    data: [8, 92],
                    backgroundColor: [
                        '#FF832A', '#eee'
                    ],
                    hoverOffset: 4
                }]
            };

            const configDebiturMeninggal = {
                type: 'doughnut',
                data: dataDebiturMeninggal,
                options: {
                    plugins: {
                        legend: {
                            display: false
                        },
                    }
                }
            };
            var chartDebiturMeninggal = new Chart(
                document.getElementById('chartDebiturMeninggal'),
                configDebiturMeninggal
            );





            const dataDebiturOutstanding = {
                labels: [
                    'Value',
                    'apa'
                ],
                datasets: [{
                    label: 'uhuy',
                    data: [15, 85],
                    backgroundColor: [
                        '#A2A846', '#eee'
                    ],
                    hoverOffset: 4
                }]
            };

            const configDebiturOutstanding = {
                type: 'doughnut',
                data: dataDebiturOutstanding,
                options: {
                    plugins: {
                        legend: {
                            display: false
                        },
                    }
                }
            };
            var chartDebiturOutstanding = new Chart(
                document.getElementById('chartDebiturOutstanding'),
                configDebiturOutstanding
            );

            const rekapDataMassDebetBRITunggakan = {
                labels: [
                    'Value',
                    'apa'
                ],
                datasets: [{
                    label: 'uhuy',
                    data: [85, 15],
                    backgroundColor: [
                        '#FF832A', '#eee'
                    ],
                    hoverOffset: 4
                }]
            };

            const configDataMassDebetBRITunggakan = {
                type: 'doughnut',
                data: rekapDataMassDebetBRITunggakan,
                options: {
                    plugins: {
                        legend: {
                            display: false
                        },
                    }
                }
            };
            var chartMassDebetTunggakan = new Chart(
                document.getElementById('chartMassDebetBRITunggakan'),
                configDataMassDebetBRITunggakan
            );


            const rekapDataMassDebetBRIPinjaman = {
                labels: [
                    'Value',
                    'apa'
                ],
                datasets: [{
                    label: 'uhuy',
                    data: [85, 15],
                    backgroundColor: [
                        '#A2A846', '#eee'
                    ],
                    hoverOffset: 4
                }]
            };

            const configDataMassDebetBRIPinjaman = {
                type: 'doughnut',
                data: rekapDataMassDebetBRIPinjaman,
                options: {
                    plugins: {
                        legend: {
                            display: false
                        },
                    }
                }
            };
            var chartMassDebetPinjaman = new Chart(
                document.getElementById('chartMassDebetBRIPinjaman'),
                configDataMassDebetBRIPinjaman
            );


            const rekapDataMassDebetBTNTunggakan = {
                labels: [
                    'Value',
                    'apa'
                ],
                datasets: [{
                    label: 'uhuy',
                    data: [85, 15],
                    backgroundColor: [
                        '#FF832A', '#eee'
                    ],
                    hoverOffset: 4
                }]
            };

            const configDataMassDebetBTNTunggakan = {
                type: 'doughnut',
                data: rekapDataMassDebetBTNTunggakan,
                options: {
                    plugins: {
                        legend: {
                            display: false
                        },
                    }
                }
            };
            var chartMassDebetBTNTunggakan = new Chart(
                document.getElementById('chartMassDebetBTNTunggakan'),
                configDataMassDebetBTNTunggakan
            );


            const rekapDataMassDebetBTNPinjaman = {
                labels: [
                    'Value',
                    'apa'
                ],
                datasets: [{
                    label: 'uhuy',
                    data: [85, 15],
                    backgroundColor: [
                        '#A2A846', '#eee'
                    ],
                    hoverOffset: 4
                }]
            };

            const configDataMassDebetBTNPinjaman = {
                type: 'doughnut',
                data: rekapDataMassDebetBTNPinjaman,
                options: {
                    plugins: {
                        legend: {
                            display: false
                        },
                    }
                }
            };
            var chartMassDebetBTNPinjaman = new Chart(
                document.getElementById('chartMassDebetBTNPinjaman'),
                configDataMassDebetBTNPinjaman
            );

            //Penerimaan Rekap
            const dataPenerimaanTotalPokokBRI = {
                labels: [
                    'Value',
                    'apa'
                ],
                datasets: [{
                    label: 'uhuy',
                    data: [85, 15],
                    backgroundColor: [
                        '#7334FF', '#eee'
                    ],
                    hoverOffset: 4
                }]
            };

            const configPenerimaanTotalPokokBRI = {
                type: 'doughnut',
                data: dataPenerimaanTotalPokokBRI,
                options: {
                    plugins: {
                        legend: {
                            display: false
                        },
                    }
                }
            };
            var chartPenerimaanTotalPokokBRI = new Chart(
                document.getElementById('chartPenerimaanTotalPokokBRI'),
                configPenerimaanTotalPokokBRI
            );


            const dataPenerimaanTotalPokokBTN = {
                labels: [
                    'Value',
                    'apa'
                ],
                datasets: [{
                    label: 'uhuy',
                    data: [85, 15],
                    backgroundColor: [
                        '#7334FF', '#eee'
                    ],
                    hoverOffset: 4
                }]
            };

            const configPenerimaanTotalPokokBTN = {
                type: 'doughnut',
                data: dataPenerimaanTotalPokokBTN,
                options: {
                    plugins: {
                        legend: {
                            display: false
                        },
                    }
                }
            };
            var chartPenerimaanTotalPokokBTN = new Chart(
                document.getElementById('chartPenerimaanTotalPokokBTN'),
                configPenerimaanTotalPokokBTN
            );




            const dataPenerimaanTotalBungaBRI = {
                labels: [
                    'Value',
                    'apa'
                ],
                datasets: [{
                    label: 'uhuy',
                    data: [85, 15],
                    backgroundColor: [
                        '#DC3545', '#eee'
                    ],
                    hoverOffset: 4
                }]
            };

            const configPenerimaanTotalBungaBRI = {
                type: 'doughnut',
                data: dataPenerimaanTotalBungaBRI,
                options: {
                    plugins: {
                        legend: {
                            display: false
                        },
                    }
                }
            };
            var chartPenerimaanTotalBungaBRI = new Chart(
                document.getElementById('chartPenerimaanTotalBungaBRI'),
                configPenerimaanTotalBungaBRI
            );

            const dataPenerimaanTotalBungaBTN = {
                labels: [
                    'Value',
                    'apa'
                ],
                datasets: [{
                    label: 'uhuy',
                    data: [85, 15],
                    backgroundColor: [
                        '#DC3545', '#eee'
                    ],
                    hoverOffset: 4
                }]
            };

            const configPenerimaanTotalBungaBTN = {
                type: 'doughnut',
                data: dataPenerimaanTotalBungaBTN,
                options: {
                    plugins: {
                        legend: {
                            display: false
                        },
                    }
                }
            };
            var chartPenerimaanTotalBungaBTN = new Chart(
                document.getElementById('chartPenerimaanTotalBungaBTN'),
                configPenerimaanTotalBungaBTN
            );

            //Piutang Rekap
            const dataPiutangTotalPokokBRI = {
                labels: [
                    'Value',
                    'apa'
                ],
                datasets: [{
                    label: 'uhuy',
                    data: [85, 15],
                    backgroundColor: [
                        '#7334FF', '#eee'
                    ],
                    hoverOffset: 4
                }]
            };

            const configPiutangTotalPokokBRI = {
                type: 'doughnut',
                data: dataPiutangTotalPokokBRI,
                options: {
                    plugins: {
                        legend: {
                            display: false
                        },
                    }
                }
            };
            var chartPiutangTotalPokokBRI = new Chart(
                document.getElementById('chartPiutangTotalPokokBRI'),
                configPiutangTotalPokokBRI
            );


            const dataPiutangTotalPokokBTN = {
                labels: [
                    'Value',
                    'apa'
                ],
                datasets: [{
                    label: 'uhuy',
                    data: [85, 15],
                    backgroundColor: [
                        '#7334FF', '#eee'
                    ],
                    hoverOffset: 4
                }]
            };

            const configPiutangTotalPokokBTN = {
                type: 'doughnut',
                data: dataPiutangTotalPokokBTN,
                options: {
                    plugins: {
                        legend: {
                            display: false
                        },
                    }
                }
            };
            var chartPiutangTotalPokokBTN = new Chart(
                document.getElementById('chartPiutangTotalPokokBTN'),
                configPiutangTotalPokokBTN
            );

            const dataPiutangTotalBungaBRI = {
                labels: [
                    'Value',
                    'apa'
                ],
                datasets: [{
                    label: 'uhuy',
                    data: [85, 15],
                    backgroundColor: [
                        '#DC3545', '#eee'
                    ],
                    hoverOffset: 4
                }]
            };

            const configPiutangTotalBungaBRI = {
                type: 'doughnut',
                data: dataPiutangTotalBungaBRI,
                options: {
                    plugins: {
                        legend: {
                            display: false
                        },
                    }
                }
            };
            var chartPiutangTotalBungaBRI = new Chart(
                document.getElementById('chartPiutangTotalBungaBRI'),
                configPiutangTotalBungaBRI
            );


            const dataPiutangTotalBungaBTN = {
                labels: [
                    'Value',
                    'apa'
                ],
                datasets: [{
                    label: 'uhuy',
                    data: [85, 15],
                    backgroundColor: [
                        '#DC3545', '#eee'
                    ],
                    hoverOffset: 4
                }]
            };

            const configPiutangTotalBungaBTN = {
                type: 'doughnut',
                data: dataPiutangTotalBungaBTN,
                options: {
                    plugins: {
                        legend: {
                            display: false
                        },
                    }
                }
            };
            var chartPiutangTotalBungaBTN = new Chart(
                document.getElementById('chartPiutangTotalBungaBTN'),
                configPiutangTotalBungaBTN
            );
        </script>


        <script src="https://cdn.jsdelivr.net/npm/@mojs/core"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/noty/3.1.4/noty.min.js"
                integrity="sha512-lOrm9FgT1LKOJRUXF3tp6QaMorJftUjowOWiDcG5GFZ/q7ukof19V0HKx/GWzXCdt9zYju3/KhBNdCLzK8b90Q=="
                crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script>
            $(document).ready(function() {
                setTimeout(function() {
                    fetch("/kpr/getnotify", {
                            method: 'GET',
                        }).then((response) => response.json())
                        .then((data) => {
                            for (let i = 0; i < data.length; i++) {
                                new Noty({
                                    type: 'success',
                                    text: data[i].judul,
                                    theme: 'metroui',
                                    timeout: 2000,
                                    animation: {
                                        open: function(promise) {
                                            var n = this;
                                            var Timeline = new mojs.Timeline();
                                            var body = new mojs.Html({
                                                el: n.barDom,
                                                x: {
                                                    500: 0,
                                                    delay: 0,
                                                    duration: 500,
                                                    easing: 'elastic.out'
                                                },
                                                isForce3d: true,
                                                onComplete: function() {
                                                    promise(function(resolve) {
                                                        resolve();
                                                    })
                                                }
                                            });

                                            var parent = new mojs.Shape({
                                                parent: n.barDom,
                                                width: 200,
                                                height: n.barDom.getBoundingClientRect()
                                                    .height,
                                                radius: 0,
                                                x: {
                                                    [150]: -150
                                                },
                                                duration: 1.2 * 500,
                                                isShowStart: true
                                            });

                                            n.barDom.style['overflow'] = 'visible';
                                            parent.el.style['overflow'] = 'hidden';

                                            var burst = new mojs.Burst({
                                                parent: parent.el,
                                                count: 10,
                                                top: n.barDom.getBoundingClientRect()
                                                    .height + 75,
                                                degree: 90,
                                                radius: 75,
                                                angle: {
                                                    [-90]: 40
                                                },
                                                children: {
                                                    fill: '#EBD761',
                                                    delay: 'stagger(500, -50)',
                                                    radius: 'rand(8, 25)',
                                                    direction: -1,
                                                    isSwirl: true
                                                }
                                            });

                                            var fadeBurst = new mojs.Burst({
                                                parent: parent.el,
                                                count: 2,
                                                degree: 0,
                                                angle: 75,
                                                radius: {
                                                    0: 100
                                                },
                                                top: '90%',
                                                children: {
                                                    fill: '#EBD761',
                                                    pathScale: [.65, 1],
                                                    radius: 'rand(12, 15)',
                                                    direction: [-1, 1],
                                                    delay: .8 * 500,
                                                    isSwirl: true
                                                }
                                            });

                                            Timeline.add(body, burst, fadeBurst, parent);
                                            Timeline.play();
                                        },
                                        close: function(promise) {
                                            var n = this;
                                            new mojs.Html({
                                                el: n.barDom,
                                                x: {
                                                    0: 500,
                                                    delay: 10,
                                                    duration: 500,
                                                    easing: 'cubic.out'
                                                },
                                                skewY: {
                                                    0: 10,
                                                    delay: 10,
                                                    duration: 500,
                                                    easing: 'cubic.out'
                                                },
                                                isForce3d: true,
                                                onComplete: function() {
                                                    promise(function(resolve) {
                                                        resolve();
                                                    })
                                                }
                                            }).play();
                                        }
                                    }
                                }).show();


                            }
                            // Push.create(data[0]);

                        });


                }, 1000);


            });
        </script>
        <script>
            var ctx = document.getElementById('myBarGraph').getContext('2d');
            var chart = new Chart(ctx, {
                // The type of chart we want to create
                type: 'bar',
                // The data for our dataset
                data: {
                    labels: ["Admin", "Belum Verifikasi", "User Terverifikasi", "Pengelola"],
                    datasets: [{
                        label: 'Status Verifikasi User',
                        backgroundColor: {!! json_encode($chart->colours) !!},
                        data: {!! json_encode($chart->dataset) !!},
                    }, ]
                },
                // Configuration options go here
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true,
                                callback: function(value) {
                                    if (value % 1 === 0) {
                                        return value;
                                    }
                                }
                            },
                            scaleLabel: {
                                display: false
                            }
                        }]
                    },
                    legend: {
                        labels: {
                            // This more specific font property overrides the global property
                            fontColor: '#122C4B',
                            fontFamily: "'Muli', sans-serif",
                            padding: 25,
                            boxWidth: 25,
                            fontSize: 14,
                        }
                    },
                    layout: {
                        padding: {
                            left: 10,
                            right: 10,
                            top: 0,
                            bottom: 10
                        }
                    }
                }
            });
        </script>
    @endif

@endsection
