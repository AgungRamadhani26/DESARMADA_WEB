<!-- Modal untuk menambah user baru-->
<div class="modal fade" id="modaltambah_user" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="" method="POST" id="formUser">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah User</h5>
                    <button type="button" class="btn-close tombol-tutup-user" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!--Kalau ada error-->
                    <div class="alert alert-danger error-user" role="alert" style="display: none"> <!--display none agar tidak ditampilkan saat pertama kali dan ditampilkan jika dipicu oleh hide() dan show() dari script jquery-->
                    </div>
                    <!--Kalau sukses-->
                    <div class="alert alert-success sukses-user" role="alert" style="display: none">
                    </div>
                    <?= csrf_field(); ?>
                    <div class="row mb-3">
                        <label for="username">Username</label>
                        <div class="col-sm-12">
                            <input type="email" class="form-control" name="username" id="username">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="nama">Nama</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" name="nama" id="nama">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="level">Level</label>
                        <div class="col-sm-12">
                            <select class="form-control" name="level" id="level">
                                <option value="">-- Pilih Level --</option>
                                <option value="1">Administrator</option>
                                <option value="2">Karyawan</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="driver">Driver</label>
                        <div class="col-sm-12">
                            <select class="form-control" id="driver">
                                <option value="">-- Pilih Driver --</option>
                                <?php foreach ($driver as $d) : ?>
                                    <option value="<?= $d['id_driver'] ?>"><?= $d['nama'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="password">Password</label>
                        <div class="col-sm-10">
                            <input type="password" class="form-control" name="password" id="password">
                        </div>
                        <div class="col-sm-2 password-container">
                            <button type="button" id="togglePassword">
                                <i class="bi bi-eye-slash-fill" aria-hidden="true"></i>
                            </button>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="konfirpass">Konfirmasi Password</label>
                        <div class="col-sm-10">
                            <input type="password" class="form-control" name="konfirpass" id="konfirpass">
                        </div>
                        <div class="col-sm-2 password-container">
                            <button type="button" id="togglekonfirpass">
                                <i class="bi bi-eye-slash-fill" aria-hidden="true"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary tombol-tutup-user" data-bs-dismiss="modal">Tutup</button>
                    <button type="button" class="btn btn-primary" id="tombol-simpan-add-user">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>