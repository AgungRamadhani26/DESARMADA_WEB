<?= $this->extend('layout/templete'); ?>

<!--Menampilkan daftar kendaraan-->
<?= $this->section('content'); ?>

<section class="section">
    <div class="card">
        <div class="card-header bg-light">
            <h3>Daftar Kendaraan</h3>
            <div>
                <!-- Modal trigger button untuk menambah kendaraan baru -->
                <button type="button" class="btn badge bg-primary" data-bs-toggle="modal" data-bs-target="#modaltambah_kendaraan">
                    Tambah
                </button>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-striped table-hover" id="table1">
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
                            <td><?= $k['gambar']; ?></td>
                            <td><?= $k['jenis_kendaraan'] ?></td>
                            <td><?= $k['tipe_kendaraan'] ?></td>
                            <td><?= $k['id_departemen'] ?></td>
                            <td><?= $k['nomor_polisi'] ?></td>
                            <td>
                                <span class="fw-bold <?= ($k['pinjam'] == 0 ? 'text-success' : ($k['pinjam'] == 1 ? 'text-danger' : 'text-info')); ?>">
                                    <?= ($k['pinjam'] == 0 ? 'Tersedia' : ($k['pinjam'] == 1 ? 'Tidak tersedia' : 'Service'));  ?>
                                </span>
                            </td>
                            <td>
                                <button type="button" class="btn badge bg-warning" data-bs-toggle="modal" data-bs-target="#modaledit_kendaraan" onclick="edit_lokasi(<?php echo $k['id_kendaraan'] ?>)">Edit</button>
                                <form action="/kendaraan/delete_kendaraan/<?= $k['id_kendaraan'] ?>" method="POST" class="d-inline">
                                    <?= csrf_field(); ?>
                                    <input type="hidden" name="_method" value="DELETE">
                                    <button type="button" class="btn badge bg-danger" onclick="return confirm('Apakah anda yakin ?');">Hapus</button>
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