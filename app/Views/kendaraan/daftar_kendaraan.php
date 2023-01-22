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
            <table class="table table-striped" id="table1">
                <thead>
                    <tr>
                        <th>No</th>
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
                                <button type="button" class="btn badge bg-warning">Edit</button>
                                <button type="button" class="btn badge bg-danger">Hapus</button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</section>

<!--include Modal untuk menambah kendaraan baru-->
<?= $this->include('kendaraan/add_kendaraan'); ?>

<?= $this->endSection(); ?>