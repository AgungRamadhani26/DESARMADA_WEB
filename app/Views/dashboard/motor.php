<?= $this->extend('layout/templete'); ?>

<?= $this->section('content'); ?>

<div class="page-content">
    <section class="row">
        <div class="col-12 col-lg-12">
            <div class="row">

                <div class="col-6 col-lg-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-3">
                                    <a href="/dashboard/mobil" class="stats-icon purple">
                                        <i class="iconly-boldBookmark"></i>
                                    </a>
                                </div>
                                <div class="col-md-9">
                                    <h6 class="text-muted font-semibold">Daftar Mobil</h6>
                                    <h6 class="font-extrabold mb-0 text-success">Mobil Tersedia: <?= $jlh_mblTersedia ?></h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-6 col-lg-3">
                    <div class="card aktif">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-3">
                                    <a href="/dashboard/motor" class="stats-icon blue">
                                        <i class="iconly-boldBookmark"></i>
                                    </a>
                                </div>
                                <div class="col-md-9">
                                    <h6 class="font-bold">Daftar Motor</h6>
                                    <h6 class="font-extrabold mb-0 text-white">Motor Tersedia: <?= $jlh_mtrTersedia ?></h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-6 col-lg-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-3">
                                    <a href="/dashboard/mobil_keluar" class="stats-icon green">
                                        <i class="iconly-boldBookmark"></i>
                                    </a>
                                </div>
                                <div class="col-md-9">
                                    <h6 class="text-muted font-semibold">Pengembalian Mobil</h6>
                                    <h6 class="font-extrabold mb-0 text-info">Belum Kembali: <?= $jlh_mblBLM_Kembali['jumlah'] ?></h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-6 col-lg-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-3">
                                    <a href="/dashboard/motor_keluar" class="stats-icon red">
                                        <i class="iconly-boldBookmark"></i>
                                    </a>
                                </div>
                                <div class="col-md-9">
                                    <h6 class="text-muted font-semibold mt-0">Pengembalian Motor</h6>
                                    <h6 class="font-extrabold mb-0 text-info">Belum Kembali: <?= $jlh_mtrBLM_Kembali['jumlah'] ?></h6>
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
                            <h3>Daftar Motor</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <?php foreach ($sepedaMotor as $sm) : ?>
                                    <div class="col-md-3">
                                        <div class="card mb-3 cardDashboard">
                                            <img src="/assets/img_kendaraan/<?= $sm['gambar']; ?>" alt="" height="190px">
                                            <div class="card-body">
                                                <h5 class="card-title"><?= $sm["tipe_kendaraan"]; ?></h5>
                                                <?php
                                                $db = \Config\Database::connect();
                                                $query = $db->query("SELECT nama_departemen AS lokasi FROM departemen WHERE departemen.id_departemen =" . $sm['id_departemen'] . "");
                                                $results = $query->getRowArray();
                                                ?>
                                                <p>Lokasi : <?= $results['lokasi'] ?></p>
                                                <p>No Polisi : <?= $sm['nomor_polisi'] ?></p>
                                                <p class="fw-bold <?= ($sm['pinjam'] == 0 ? 'text-success' : ($sm['pinjam'] == 1 ? 'text-danger' : 'text-primary')); ?>">
                                                    Status : <?= ($sm['pinjam'] == 0 ? 'Tersedia' : ($sm['pinjam'] == 1 ? 'Tidak tersedia' : 'Servis'));  ?>
                                                </p>
                                                <center>
                                                    <?php
                                                    if ($sm['pinjam'] == 0) {
                                                    ?>
                                                        <a href="/peminjaman/pinjam_kendaraan/<?= $sm['id_kendaraan'] ?>" class="btn btn-primary btn-sm"><span class="material-icons">post_add</span>Pinjam</a>
                                                    <?php
                                                    }
                                                    ?>
                                                    <?php
                                                    if (session()->get('level') == 1) {
                                                    ?>
                                                        <a href="/dashboard/generateQR/<?= $sm['nomor_polisi'] ?>" class="btn btn-info btn-sm"><span class="material-icons">qr_code_2</span>Lihat QR</a>
                                                    <?php
                                                    }
                                                    ?>
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