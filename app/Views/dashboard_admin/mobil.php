<?= $this->extend('layout/templete'); ?>

<?= $this->section('content'); ?>

<div class="page-content">
    <section class="row">
        <div class="col-12 col-lg-12">
            <div class="row">

                <div class="col-6 col-lg-3">
                    <div class="card aktif">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <a href="/dashboard_admin/mobil" class="stats-icon purple">
                                        <i class="iconly-boldBookmark"></i>
                                    </a>
                                </div>
                                <div class="col-md-8">
                                    <h6 class="text-muted font-semibold mt-3">Daftar Mobil</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-6 col-lg-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <a href="/dashboard_admin/motor" class="stats-icon blue">
                                        <i class="iconly-boldBookmark"></i>
                                    </a>
                                </div>
                                <div class="col-md-8">
                                    <h6 class="text-muted font-semibold mt-3">Daftar Motor</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-6 col-lg-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <a href="/dashboard_admin/mobil_keluar" class="stats-icon green">
                                        <i class="iconly-boldBookmark"></i>
                                    </a>
                                </div>
                                <div class="col-md-8">
                                    <h6 class="text-muted font-semibold mt-3">Pengembalian Mobil</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-6 col-lg-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <a href="/dashboard_admin/motor_keluar" class="stats-icon red">
                                        <i class="iconly-boldBookmark"></i>
                                    </a>
                                </div>
                                <div class="col-md-8">
                                    <h6 class="text-muted font-semibold mt-2">Pengembalian Motor</h6>
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
                            <h3>Daftar Mobil</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <?php foreach ($mobil as $m) : ?>
                                    <div class="col-md-3">
                                        <div class="card mb-3 cardDashboard">
                                            <img src="/assets/img_kendaraan/<?= $m['gambar']; ?>" alt="" height="190px">
                                            <div class="card-body">
                                                <h5 class="card-title"><?= $m["tipe_kendaraan"]; ?></h5>
                                                <?php
                                                $db = \Config\Database::connect();
                                                $query = $db->query("SELECT nama_departemen AS lokasi FROM departemen WHERE departemen.id_departemen =" . $m['id_departemen'] . "");
                                                $results = $query->getRowArray();
                                                ?>
                                                <p>Lokasi : <?= $results['lokasi'] ?></p>
                                                <p>No Polisi : <?= $m['nomor_polisi'] ?></p>
                                                <p class="fw-bold <?= ($m['pinjam'] == 0 ? 'text-success' : ($m['pinjam'] == 1 ? 'text-danger' : 'text-info')); ?>">
                                                    Status : <?= ($m['pinjam'] == 0 ? 'Tersedia' : ($m['pinjam'] == 1 ? 'Tidak tersedia' : 'Service'));  ?>
                                                </p>
                                                <center>
                                                    <?php
                                                    if ($m['pinjam'] == 0) {
                                                    ?>
                                                        <a href="/peminjaman/pinjam_kendaraan/<?= $m['id_kendaraan'] ?>" class="btn btn-primary">Pinjam</a>
                                                    <?php
                                                    }
                                                    ?>
                                                    <a href="#" class="btn btn-info">Lihat QR</a>
                                                </center>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<?= $this->endSection(); ?>