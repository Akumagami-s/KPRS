@extends('layouts.base')

@section('content')


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
                                        <p class="value">Rp.{{ number_format($piutang_pokok, 0, ',', '.') }}</p>
                                    </div>
                                    <div class="label totalBunga">
                                        <h1 class="nameLabel">Total Bunga (IDR)</h1>
                                        <p class="value">Rp.{{ number_format($piutang_bunga, 0, ',', '.') }}</p>
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
                                        <h1 class="value">{{ $debiturlunas }}</h1>
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
                                        <h1 class="value">agussssssss</h1>
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
                                        <h1 class="value">{{ $rekapoutstanding ?? '' }}</h1>
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
                                <p class="value">Rp.{{ number_format($totaltunggakan_btn, 0, ',', '.') }}</p>
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
                                <p class="value">Rp.{{ number_format($jumlahpinjaman_btn, 0, ',', '.') }}</p>
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
    {{-- @endif --}}
    <footer>
        <p>Copyright 2021 © DITKUAD</p>
    </footer>
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


@endsection
@push('script')
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
@endpush
