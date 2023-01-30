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
                    <div class="card aktif">
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
                            <h3>Armada Mobil Keluar</h3>
                        </div>
                        <div class="card-body">
                            <table class="table table-striped table-hover" id="table1">
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