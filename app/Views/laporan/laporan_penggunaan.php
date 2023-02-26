<?= $this->extend('layout/templete'); ?>

<?= $this->section('content'); ?>

<section class="section">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Pilih rentang waktu</h4>
                </div>
                <div class="card-body">
                    <form action="/laporan/cari_laporan" method="GET">
                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <div class="input-group mb-2">
                                    <label class="input-group-text" for="inputGroupSelect01">Bulan</label>
                                    <select class="form-select" id="inputGroupSelect01" name="bulan_awal">
                                        <option value="01" <?php if (session()->getFlashdata('bulan_awal') == "01") {
                                                                echo 'selected="true"';
                                                            } ?>>Januari</option>
                                        <option value="02" <?php if (session()->getFlashdata('bulan_awal') == "02") {
                                                                echo 'selected="true"';
                                                            } ?>>Februari</option>
                                        <option value="03" <?php if (session()->getFlashdata('bulan_awal') == "03") {
                                                                echo 'selected="true"';
                                                            } ?>>Maret</option>
                                        <option value="04" <?php if (session()->getFlashdata('bulan_awal') == "04") {
                                                                echo 'selected="true"';
                                                            } ?>>April</option>
                                        <option value="05" <?php if (session()->getFlashdata('bulan_awal') == "05") {
                                                                echo 'selected="true"';
                                                            } ?>>Mei</option>
                                        <option value="06" <?php if (session()->getFlashdata('bulan_awal') == "06") {
                                                                echo 'selected="true"';
                                                            } ?>>Juni</option>
                                        <option value="07" <?php if (session()->getFlashdata('bulan_awal') == "07") {
                                                                echo 'selected="true"';
                                                            } ?>>Juli</option>
                                        <option value="08" <?php if (session()->getFlashdata('bulan_awal') == "08") {
                                                                echo 'selected="true"';
                                                            } ?>>Agustus</option>
                                        <option value="09" <?php if (session()->getFlashdata('bulan_awal') == "09") {
                                                                echo 'selected="true"';
                                                            } ?>>September</option>
                                        <option value="10" <?php if (session()->getFlashdata('bulan_awal') == "10") {
                                                                echo 'selected="true"';
                                                            } ?>>Oktober</option>
                                        <option value="11" <?php if (session()->getFlashdata('bulan_awal') == "11") {
                                                                echo 'selected="true"';
                                                            } ?>>November</option>
                                        <option value="12" <?php if (session()->getFlashdata('bulan_awal') == "12") {
                                                                echo 'selected="true"';
                                                            } ?>>Desember</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6 mb-4">
                                <div class="input-group mb-2">
                                    <label class="input-group-text" for="inputGroupSelect01">Sampai</label>
                                    <select class="form-select" id="inputGroupSelect01" name="bulan_akhir">
                                        <option value="12" <?php if (session()->getFlashdata('bulan_akhir') == "12") {
                                                                echo 'selected="true"';
                                                            } ?>>Desember</option>
                                        <option value="11" <?php if (session()->getFlashdata('bulan_akhir') == "11") {
                                                                echo 'selected="true"';
                                                            } ?>>November</option>
                                        <option value="10" <?php if (session()->getFlashdata('bulan_akhir') == "10") {
                                                                echo 'selected="true"';
                                                            } ?>>Oktober</option>
                                        <option value="09" <?php if (session()->getFlashdata('bulan_akhir') == "09") {
                                                                echo 'selected="true"';
                                                            } ?>>September</option>
                                        <option value="08" <?php if (session()->getFlashdata('bulan_akhir') == "08") {
                                                                echo 'selected="true"';
                                                            } ?>>Agustus</option>
                                        <option value="07" <?php if (session()->getFlashdata('bulan_akhir') == "07") {
                                                                echo 'selected="true"';
                                                            } ?>>Juli</option>
                                        <option value="06" <?php if (session()->getFlashdata('bulan_akhir') == "06") {
                                                                echo 'selected="true"';
                                                            } ?>>Juni</option>
                                        <option value="05" <?php if (session()->getFlashdata('bulan_akhir') == "05") {
                                                                echo 'selected="true"';
                                                            } ?>>Mei</option>
                                        <option value="04" <?php if (session()->getFlashdata('bulan_akhir') == "04") {
                                                                echo 'selected="true"';
                                                            } ?>>April</option>
                                        <option value="03" <?php if (session()->getFlashdata('bulan_akhir') == "03") {
                                                                echo 'selected="true"';
                                                            } ?>>Maret</option>
                                        <option value="02" <?php if (session()->getFlashdata('bulan_akhir') == "02") {
                                                                echo 'selected="true"';
                                                            } ?>>Februari</option>
                                        <option value="01" <?php if (session()->getFlashdata('bulan_akhir') == "01") {
                                                                echo 'selected="true"';
                                                            } ?>>Januari</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-1">
                                <div class="input-group mb-3">
                                    <label class="input-group-text" for="inputGroupSelect01">Tahun</label>
                                    <select class="form-select" id="inputGroupSelect01" name="tahun">
                                        <option value="2023" <?php if (session()->getFlashdata('tahun') == "2023") {
                                                                    echo 'selected="true"';
                                                                } ?>>2023</option>
                                        <option value="2024" <?php if (session()->getFlashdata('tahun') == "2024") {
                                                                    echo 'selected="true"';
                                                                } ?>>2024</option>
                                        <option value="2025" <?php if (session()->getFlashdata('tahun') == "2025") {
                                                                    echo 'selected="true"';
                                                                } ?>>2025</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6 mb-1">
                                <button type="submit" class="btn badge biru"><span class="material-icons">search</span></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="row" id="table-bordered">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3>Laporan Penggunaan</h3>
                </div>
                <div class="card-content">
                    <!-- table bordered -->
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered mb-0 table-hover">
                                <thead>
                                    <tr>
                                        <th style="color:white; background-color:rgba(67,94,190,255)" rowspan="2">Bulan</th>
                                        <?php foreach ($kendaraanTabel as $kt) : ?>
                                            <th style="color:white; background-color:rgba(67,94,190,255)"><?= $kt['tipe_kendaraan'] ?></th>
                                        <?php endforeach; ?>

                                    </tr>
                                    <tr>
                                        <?php foreach ($kendaraanTabel as $kt) : ?>
                                            <th style="color:black; background-color:#f2f7ff"><?= $kt['nomor_polisi'] ?></th>
                                        <?php endforeach; ?>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($bulanTabel as $bt) : ?>
                                        <tr>
                                            <td style="color:black; background-color:#f2f7ff; font-weight:bold"><?= $bt['nama_bulan'] ?></td>
                                            <?php foreach ($laporan as $lp) : ?>

                                                <?php if ($lp['month'] == $bt['id_bulan']) {
                                                    echo '<input id="bulan_' . $lp['nopol'] . '_' . $bt['nama_bulan'] . '" type="hidden" value="' . $lp['total'] . '">';
                                                    echo '<td>' . $lp['total'] . '</td>';
                                                } else {
                                                    echo '<input id="bulan_' . $lp['nopol'] . '_' . $bt['nama_bulan'] . '" type="hidden" value="0">';
                                                    echo '<td></td>';
                                                }
                                                ?>
                                            <?php endforeach; ?>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3>Grafik Penggunaan</h3>
                </div>
                <div class="card-content">
                    <div class="card-body">
                        <figure class="highcharts-figure">
                            <div id="container"></div>
                        </figure>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    $(function() {
        var bulan = <?= json_encode($bulanGrafik) ?>;
        var nopol = <?= json_encode($nopolGR) ?>;
        var km = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];

        var data = [];

        // grupkan data berdasarkan nopol
        for (var i = 0; i < nopol.length; i++) {
            km[i] = [];
            for (var j = 0; j < bulan.length; j++) {
                km[i].push(parseInt($('#bulan_' + nopol[i] + '_' + bulan[j]).val()));
            }

        }

        for (var i = 0; i < nopol.length; i++) {
            data.push({
                name: nopol[i],
                data: km[i]
            });
        }

        var chart = Highcharts.chart('container', {

            title: {
                text: 'Data Peminjaman Mobil',
                align: 'center'
            },

            subtitle: {
                text: 'Data KM',
                align: 'center'
            },

            yAxis: {
                title: {
                    text: 'KM'
                }
            },

            xAxis: {
                // categories: 
                categories: <?= json_encode($bulanGrafik) ?>
            },

            legend: {
                layout: 'vertical',
                align: 'right',
                verticalAlign: 'middle'
            },

            plotOptions: {
                line: {
                    dataLabels: {
                        enabled: true
                    },
                    enableMouseTracking: true
                }
            },

            series: data,

            responsive: {
                rules: [{
                    condition: {
                        maxWidth: 500
                    },
                    chartOptions: {
                        legend: {
                            layout: 'horizontal',
                            align: 'center',
                            verticalAlign: 'bottom'
                        }
                    }
                }]
            }

        });
    });
</script>
<?= $this->endSection(); ?>