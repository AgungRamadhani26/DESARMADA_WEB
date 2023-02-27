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
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-3">
                                    <a href="/dashboard/motor" class="stats-icon blue">
                                        <i class="iconly-boldBookmark"></i>
                                    </a>
                                </div>
                                <div class="col-md-9">
                                    <h6 class="text-muted font-semibold">Daftar Motor</h6>
                                    <h6 class="font-extrabold mb-0 text-success">Motor Tersedia: <?= $jlh_mtrTersedia ?></h6>
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
                                    <h6 class="text-muted font-semibold mt-0">Pengembalian Mobil</h6>
                                    <h6 class="font-extrabold mb-0 text-info">Belum Kembali: <?= $jlh_mblBLM_Kembali['jumlah'] ?></h6>
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
                                    <a href="/dashboard/motor_keluar" class="stats-icon red">
                                        <i class="iconly-boldBookmark"></i>
                                    </a>
                                </div>
                                <div class="col-md-9">
                                    <h6 class="font-bold">Pengembalian Motor</h6>
                                    <h6 class="font-extrabold mb-0 text-white">Belum Kembali: <?= $jlh_mtrBLM_Kembali['jumlah'] ?></h6>
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
                            <h3>Armada Motor Keluar</h3>
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
                                    <?php foreach ($motor_dipinjam as $mtr) : ?>
                                        <tr>
                                            <td><?= $i++ ?></td>
                                            <td>
                                                <a href="/peminjaman/kembalikan_kendaraan/<?= $mtr['id_peminjaman'] ?>" class="btn btn-success btn-sm"><span class="material-icons">reply</span>Kembalikan</a>
                                            </td>
                                            <td><?= $mtr['tipe_k_motor'] ?></td>
                                            <td><?= $mtr['nama_dep_Motor'] ?></td>
                                            <td><?= $mtr['nopol_motor'] ?></td>
                                            <?php
                                            $tgl_pinjam = $mtr['tgl_pinjam_motor'];
                                            $tgl_pinjam1 = strtotime($tgl_pinjam);
                                            $tgl_pinjam2 = date('d-m-Y', $tgl_pinjam1);
                                            ?>
                                            <td><?= $tgl_pinjam2 ?></td>
                                            <?php
                                            $jam_pinjam = $mtr['jam_pinjam_motor'];
                                            $jam_pinjam1 = strtotime($jam_pinjam);
                                            $jam_pinjam2 = date('H:i', $jam_pinjam1);
                                            ?>
                                            <td><?= $jam_pinjam2 ?></td>
                                            <td><?= $mtr['peminjam'] ?></td>
                                            <td><?= $mtr['keperluan'] ?></td>
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