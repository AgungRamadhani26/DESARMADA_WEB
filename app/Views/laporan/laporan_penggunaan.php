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
                    <form action="/laporan/cari_laporan" method="POST">
                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <div class="input-group mb-2">
                                    <label class="input-group-text" for="inputGroupSelect01">Bulan</label>
                                    <select class="form-select" id="inputGroupSelect01" name="bulan_awal">
                                        <option value="01">Januari</option>
                                        <option value="02">Februari</option>
                                        <option value="03">Maret</option>
                                        <option value="04">April</option>
                                        <option value="05">Mei</option>
                                        <option value="06">Juni</option>
                                        <option value="07">Juli</option>
                                        <option value="08">Agustus</option>
                                        <option value="09">September</option>
                                        <option value="10">Oktober</option>
                                        <option value="11">November</option>
                                        <option value="12">Desember</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6 mb-4">
                                <div class="input-group mb-2">
                                    <label class="input-group-text" for="inputGroupSelect01">Sampai</label>
                                    <select class="form-select" id="inputGroupSelect01" name="bulan_akhir">
                                        <option value="12">Desember</option>
                                        <option value="11">November</option>
                                        <option value="10">Oktober</option>
                                        <option value="09">September</option>
                                        <option value="08">Agustus</option>
                                        <option value="07">Juli</option>
                                        <option value="06">Juni</option>
                                        <option value="05">Mei</option>
                                        <option value="04">April</option>
                                        <option value="03">Maret</option>
                                        <option value="02">Februari</option>
                                        <option value="01">Januari</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-1">
                                <div class="input-group mb-3">
                                    <label class="input-group-text" for="inputGroupSelect01">Tahun</label>
                                    <select class="form-select" id="inputGroupSelect01" name="tahun">
                                        <option value="2023">2023</option>
                                        <option value="2024">2024</option>
                                        <option value="2025">2025</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6 mb-1">
                                <button type="submit" class="btn btn-primary btn-md"><i class="bi bi-search"></i> Cari</button>
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
                                        <th style="color:white; background-color:burlywood" rowspan="2">Bulan</th>
                                        <?php foreach ($kendaraanTabel as $kt) : ?>
                                            <th style="color:white; background-color:burlywood"><?= $kt['tipe_kendaraan'] ?></th>
                                        <?php endforeach; ?>

                                    </tr>
                                    <tr>
                                        <?php foreach ($kendaraanTabel as $kt) : ?>
                                            <th style="color:black; background-color:cadetblue"><?= $kt['nomor_polisi'] ?></th>
                                        <?php endforeach; ?>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($bulanTabel as $bt) : ?>
                                        <tr>
                                            <td style="color:black; background-color:cadetblue; font-weight:bold"><?= $bt['nama_bulan'] ?></td>
                                            <?php foreach ($laporan as $lp) : ?>

                                                <?php if ($lp['month'] == $bt['id_bulan']) {
                                                    echo '<td>' . $lp['total'] . '</td>';
                                                } else {
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
</section>

<?= $this->endSection(); ?>