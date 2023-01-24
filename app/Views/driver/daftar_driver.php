<?= $this->extend('layout/templete'); ?>

<!--Menampilkan daftar driver-->
<?= $this->section('content'); ?>

<section class="section">
    <div class="card">
        <div class="card-header bg-light">
            <h3>Daftar Driver</h3>
            <div>
                <!-- Modal trigger button untuk menambah driver baru -->
                <button type="button" class="btn badge bg-primary" data-bs-toggle="modal" data-bs-target="#modaltambah_driver">
                    Tambah
                </button>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-striped table-hover" id="table1">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1 ?>
                    <?php foreach ($driver as $d) : ?>
                        <tr>
                            <td><?= $i++ ?></td>
                            <td><?= $d['nama'] ?></td>
                            <td>
                                <button type="button" class="btn badge bg-warning" data-bs-toggle="modal" data-bs-target="#modaledit_driver" onclick="edit_driver(<?php echo $d['id_driver'] ?>)">Edit</button>
                                <form action="/driver/delete_driver/<?= $d['id_driver'] ?>" method="POST" class="d-inline">
                                    <?= csrf_field(); ?>
                                    <input type="hidden" name="_method" value="DELETE">
                                    <button type="submit" class="btn badge bg-danger" onclick="return confirm('Apakah anda yakin ?');">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</section>

<!--include Modal untuk menambah driver baru-->
<?= $this->include('driver/modal_add_driver'); ?>
<!--include Modal untuk mengedit driver-->
<?= $this->include('driver/modal_edit_driver'); ?>

<?= $this->endSection(); ?>