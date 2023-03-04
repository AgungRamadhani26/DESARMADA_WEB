<?= $this->extend('layout/templete'); ?>

<!--Menampilkan daftar user-->
<?= $this->section('content'); ?>

<aside>
    <article class="card">
        <div class="card-header">
            <!-- Modal trigger button untuk menambah user baru -->
            <button type="button" class="btn badge tambah" data-bs-toggle="modal" data-bs-target="#modaltambah_user">
                <span class="material-icons">add</span>
            </button>
            <center>
                <hr>
                <h5>Jumlah User</h5>
                <hr>
            </center>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table">
                    <tr>
                        <td><span class="fw-bold">Semua</span></td>
                        <td>:</td>
                        <td><?= $jlh_useraktif ?></td>
                    </tr>
                    <tr>
                        <td><span class="fw-bold text-primary">Admin</span></td>
                        <td>:</td>
                        <td><?= $jlh_useraktifadmin ?></td>
                    </tr>
                    <tr>
                        <td><span class="fw-bold text-success">Karyawan</span></td>
                        <td>:</td>
                        <td><?= $jlh_useraktifkaryawan ?></td>
                    </tr>
                </table>
            </div>
        </div>
    </article>
</aside>

<section class="section">
    <div class="card">
        <div class="card-header bg-table">
            <h3>Daftar User</h3>
        </div>
        <div class="card-body">
            <table class="table table-hover" id="table1">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Username</th>
                        <th>Nama</th>
                        <th>Level</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1 ?>
                    <?php foreach ($user as $u) : ?>
                        <tr>
                            <td><?= $i++ ?></td>
                            <td><?= $u['username'] ?></td>
                            <td><?= $u['nama'] ?></td>
                            <td>
                                <span class="fw-bold <?= $u['level'] == '2' ? 'text-success' : 'text-primary';  ?>">
                                    <?= $u['level'] == '2' ? 'Karyawan' : 'Admin';  ?>
                                </span>
                            </td>
                            <td>
                                <button type="button" class="btn badge edit" data-bs-toggle="modal" data-bs-target="#modaledit_user" onclick="edit_user(<?php echo $u['id_user'] ?>)"><span class="material-icons">edit</span></button>
                                <form action="/user/delete_user/<?= $u['id_user'] ?>" method="POST" class="d-inline">
                                    <?= csrf_field(); ?>
                                    <input type="hidden" name="_method" value="DELETE">
                                    <button type="submit" class="btn badge delete" onclick="return confirm('Apakah anda yakin menghapus data user ?');"><span class="material-icons">clear</span></button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</section>

<!--include Modal untuk menambah user baru-->
<?= $this->include('/user/modal_add_user'); ?>
<!--include Modal untuk mengedit user-->
<?= $this->include('/user/modal_edit_user'); ?>

<?= $this->endSection(); ?>