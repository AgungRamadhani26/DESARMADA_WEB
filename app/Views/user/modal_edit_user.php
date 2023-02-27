<!-- Modal untuk mengedit user-->
<div class="modal fade" id="modaledit_user" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="" method="POST" id="formUser_e">
                <div class="modal-header">
                    <h5 class="modal-title">Edit User</h5>
                    <button type="button" class="btn-close tombol-tutup-user" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!--Kalau ada error-->
                    <div class="alert alert-danger error-user_e" role="alert" style="display: none"> <!--display none agar tidak ditampilkan saat pertama kali dan ditampilkan jika dipicu oleh hide() dan show() dari script jquery-->
                    </div>
                    <!--Kalau sukses-->
                    <div class="alert alert-success sukses-user_e" role="alert" style="display: none">
                    </div>
                    <?= csrf_field(); ?>
                    <input type="hidden" id="id_user_e">
                    <div class="row mb-3">
                        <label for="username">Username</label>
                        <div class="col-sm-12">
                            <input type="email" class="form-control" name="username" id="username_e">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="nama">Nama</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" name="nama" id="nama_e">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="level">Level</label>
                        <div class="col-sm-12">
                            <select class="form-control" name="level" id="level_e">
                                <option value="">-- Pilih Level --</option>
                                <option value="1">Administrator</option>
                                <option value="2">Karyawan</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="driver">Driver</label>
                        <div class="col-sm-12">
                            <select class="form-control" id="driver_e">
                                <option value="">-- Pilih Driver --</option>
                                <?php foreach ($driver as $d) : ?>
                                    <option value="<?= $d['id_driver'] ?>"><?= $d['nama'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary tombol-tutup-user" data-bs-dismiss="modal">Tutup</button>
                    <button type="button" class="btn btn-primary" id="tombol-simpan-edit-user">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>