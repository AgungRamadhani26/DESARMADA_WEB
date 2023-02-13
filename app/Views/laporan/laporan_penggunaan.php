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
                                        <?php foreach ($bulan as $b) : ?>
                                            <option value="<?= $b['id_bulan'] ?>"><?= $b['nama_bulan'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6 mb-4">
                                <div class="input-group mb-2">
                                    <label class="input-group-text" for="inputGroupSelect01">Sampai</label>
                                    <select class="form-select" id="inputGroupSelect01" name="bulan_akhir">
                                        <?php foreach ($bulan as $b) : ?>
                                            <option value="<?= $b['id_bulan'] ?>"><?= $b['nama_bulan'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-1">
                                <div class="input-group mb-3">
                                    <label class="input-group-text" for="inputGroupSelect01">Tahun</label>
                                    <select class="form-select" id="inputGroupSelect01" name="tahun">
                                        <option value="2021">2021</option>
                                        <option value="2022">2022</option>
                                        <option value="2023">2023</option>
                                        <option value="2024">2024</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6 mb-1">
                                <button type="submit" class="btn btn-primary btn-sm"><i class="bi bi-search"></i> Cari</button>
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
                                        <th>Kendaraan</th>
                                        <th>Januari</th>
                                        <th>Februari</th>
                                        <th>Maret</th>
                                        <th>April</th>
                                        <th>Mei</th>
                                        <th>Juni</th>
                                        <th>Juli</th>
                                        <th>Agustus</th>
                                        <th>September</th>
                                        <th>Oktober</th>
                                        <th>November</th>
                                        <th>Desember</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Michael Right</td>
                                    </tr>
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