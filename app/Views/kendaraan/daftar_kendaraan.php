<?= $this->extend('layout/templete'); ?>

<!--Menampilkan daftar kendaraan-->
<?= $this->section('content'); ?>

<aside>
    <article class="card">
        <div class="card-header">
            <h5>Status Kendaraan</h5>
            <hr>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table">
                    <tr>
                        <td><span class="fw-bold">Semua</span></td>
                        <td>:</td>
                        <td><?= $jlh_kendaraan ?></td>
                    </tr>
                    <tr>
                        <td><span class="fw-bold text-success">Tersedia</span></td>
                        <td>:</td>
                        <td><?= $jlh_kendaraanTersedia ?></td>
                    </tr>
                    <tr>
                        <td><span class="fw-bold text-danger">Tidak Tersedia</span></td>
                        <td>:</td>
                        <td><?= $jlh_kendaraanTdkTersedia ?></td>
                    </tr>
                    <tr>
                        <td><span class="fw-bold text-info">Servis</span></td>
                        <td>:</td>
                        <td><?= $jlh_kendaraanServis ?></td>
                    </tr>
                </table>
            </div>
        </div>
    </article>
</aside>

<section class="section">
    <div class="card">
        <div class="card-header bg-table">
            <h3>Daftar Kendaraan</h3>
            <div>
                <!-- Modal trigger button untuk menambah kendaraan baru -->
                <button type="button" class="btn badge tambah" data-bs-toggle="modal" data-bs-target="#modaltambah_kendaraan">
                    <i class="bi bi-plus-square-fill"></i> Tambah
                </button>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-hover" id="table1">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Gambar</th>
                        <th>Jenis Kendaraan</th>
                        <th>Tipe Kendaraan</th>
                        <th>Lokasi</th>
                        <th>Nomor Polisi</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1 ?>
                    <?php foreach ($kendaraan as $k) : ?>
                        <tr>
                            <td><?= $i++ ?></td>
                            <td><img src="/assets/img_kendaraan/<?= $k['gambar']; ?>" alt="" class="gambar"></td>
                            <td><?= $k['jenis_kendaraan'] ?></td>
                            <td><?= $k['tipe_kendaraan'] ?></td>
                            <?php
                            $db = \Config\Database::connect();
                            $query = $db->query("SELECT nama_departemen AS loc FROM departemen WHERE departemen.id_departemen =" . $k['id_departemen'] . "");
                            $results = $query->getRowArray();
                            ?>
                            <td><?= $results['loc'] ?></td>
                            <td><?= $k['nomor_polisi'] ?></td>
                            <td>
                                <span class="fw-bold <?= ($k['pinjam'] == 0 ? 'text-success' : ($k['pinjam'] == 1 ? 'text-danger' : 'text-info')); ?>">
                                    <?= ($k['pinjam'] == 0 ? 'Tersedia' : ($k['pinjam'] == 1 ? 'Tidak tersedia' : 'Service'));  ?>
                                </span>
                            </td>
                            <td>
                                <button type="button" class="btn badge edit" data-bs-toggle="modal" data-bs-target="#modaledit_kendaraan" onclick="edit_kendaraan(<?php echo $k['id_kendaraan'] ?>)"><i class="bi bi-pencil-square"></i> Edit</button>
                                <form action="/kendaraan/delete_kendaraan/<?= $k['id_kendaraan'] ?>" method="POST" class="d-inline">
                                    <?= csrf_field(); ?>
                                    <input type="hidden" name="_method" value="DELETE">
                                    <button type="submit" class="btn badge delete" onclick="return confirm('Apakah anda yakin ?');"><i class="bi bi-trash3-fill"></i> Hapus</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</section>

<!--include Modal untuk menambah kendaraan baru-->
<?= $this->include('kendaraan/modal_add_kendaraan'); ?>
<!--include Modal untuk mengedit kendaraan-->
<?= $this->include('kendaraan/modal_edit_kendaraan'); ?>

<?= $this->endSection(); ?>