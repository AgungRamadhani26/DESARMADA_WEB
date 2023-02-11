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
                                <div class="col-md-4">
                                    <a href="/dashboard/mobil" class="stats-icon purple">
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
                                    <a href="/dashboard/motor" class="stats-icon blue">
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
                    <div class="card aktif">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <a href="/dashboard/mobil_keluar" class="stats-icon green">
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
                                    <a href="/dashboard/motor_keluar" class="stats-icon red">
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
                            <h3>Armada Mobil Keluar</h3>
                        </div>
                        <div class="card-body">
                            <table class="table table-hover" id="table1">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Action</th>
                                        <th>Tipe Kendaraan</th>
                                        <th>Lokasi</th>
                                        <th>Nomor Polisi</th>
                                        <th>Tanggal Pinjam</th>
                                        <th>Jam Pinjam</th>
                                        <th>Peminjam</th>
                                        <th>Keperluan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1 ?>
                                    <?php foreach ($mobil_dipinjam as $mbl) : ?>
                                        <tr>
                                            <td><?= $i++ ?></td>
                                            <td>
                                                <a href="/peminjaman/kembalikan_kendaraan/<?= $mbl['id_peminjaman'] ?>" style="border-radius: 2rem" class="btn btn-outline-primary btn-sm"><i class="bi bi-arrow-return-right"></i> Kembalikan</a>
                                            </td>
                                            <td><?= $mbl['tipe_k_mobil'] ?></td>
                                            <td><?= $mbl['nama_dep_Mobil'] ?></td>
                                            <td><?= $mbl['nopol_mobil'] ?></td>
                                            <?php
                                            $tgl_pinjam = $mbl['tgl_pinjam_mobil'];
                                            $tgl_pinjam1 = strtotime($tgl_pinjam);
                                            $tgl_pinjam2 = date('d-m-Y', $tgl_pinjam1);
                                            ?>
                                            <td><?= $tgl_pinjam2 ?></td>
                                            <?php
                                            $jam_pinjam = $mbl['jam_pinjam_mobil'];
                                            $jam_pinjam1 = strtotime($jam_pinjam);
                                            $jam_pinjam2 = date('H:i', $jam_pinjam1);
                                            ?>
                                            <td><?= $jam_pinjam2 ?></td>
                                            <td><?= $mbl['peminjam'] ?></td>
                                            <td><?= $mbl['keperluan'] ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
</div>

<?= $this->endSection(); ?>