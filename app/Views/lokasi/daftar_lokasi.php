<?= $this->extend('layout/templete'); ?>

<!--Menampilkan daftar lokasi-->
<?= $this->section('content'); ?>

<section class="section">
    <div class="card">
        <div class="card-header bg-table">
            <h3>Daftar Lokasi</h3>
            <div>
                <!-- Modal trigger button untuk menambah lokasi baru -->
                <button type="button" class="btn badge tambah" data-bs-toggle="modal" data-bs-target="#modaltambah_lokasi">
                    <i class="bi bi-plus-square-fill"></i> Tambah
                </button>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-hover" id="table1">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Lokasi</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1 ?>
                    <?php foreach ($lokasi as $l) : ?>
                        <tr>
                            <td><?= $i++ ?></td>
                            <td><?= $l['nama_departemen'] ?></td>
                            <td>
                                <button type="button" class="btn badge edit" data-bs-toggle="modal" data-bs-target="#modaledit_lokasi" onclick="edit_lokasi(<?php echo $l['id_departemen'] ?>)"><i class="bi bi-pencil-square"></i> Edit</button>
                                <form action="/lokasi/delete_lokasi/<?= $l['id_departemen'] ?>" method="POST" class="d-inline">
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

<!--include Modal untuk menambah lokasi baru-->
<?= $this->include('lokasi/modal_add_lokasi'); ?>
<!--include Modal untuk mengedit lokasi-->
<?= $this->include('lokasi/modal_edit_lokasi'); ?>

<?= $this->endSection(); ?>