<?= $this->extend('layout/templete'); ?>

<!--Menampilkan daftar driver-->
<?= $this->section('content'); ?>

<aside>
    <article class="card">
        <div class="card-header">
            <!-- Modal trigger button untuk menambah driver baru -->
            <button type="button" class="btn badge tambah" data-bs-toggle="modal" data-bs-target="#modaltambah_driver">
                <span class="material-icons">add</span>
            </button>
            <center>
                <hr>
                <h5>Jumlah Driver</h5>
                <hr>
            </center>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table">
                    <tr>
                        <td><span class="fw-bold">Semua</span></td>
                        <td>:</td>
                        <td><?= $jlh_driver ?></td>
                    </tr>
                </table>
            </div>
        </div>
    </article>
</aside>

<section class="section">
    <div class="card">
        <div class="card-header bg-table">
            <h3>Daftar Driver</h3>
        </div>
        <div class="card-body">
            <table class="table table-hover" id="table1">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1 ?>
                    <?php foreach ($driver as $d) : ?>
                        <tr>
                            <td><?= $i++ ?></td>
                            <td><?= $d['nama'] ?></td>
                            <td>
                                <button type="button" class="btn badge edit" data-bs-toggle="modal" data-bs-target="#modaledit_driver" onclick="edit_driver(<?php echo $d['id_driver'] ?>)"><span class="material-icons">edit</span></button>
                                <form action="/driver/delete_driver/<?= $d['id_driver'] ?>" method="POST" class="d-inline">
                                    <?= csrf_field(); ?>
                                    <input type="hidden" name="_method" value="DELETE">
                                    <button type="submit" class="btn badge delete" onclick="return confirm('Apakah anda yakin menghapus data driver ?');"><span class="material-icons">clear</span></button>
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