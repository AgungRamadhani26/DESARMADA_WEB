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
                            <!--menggunakan ternary operator dimana jika terdapat error pada validasi maka akan menerapkan class is-invalid dari bootstrap jika tidak ada error maka tidak menerapkan kelas tersebut-->
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="nama">Nama</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" name="nama" id="nama">
                            <!--menggunakan ternary operator dimana jika terdapat error pada validasi maka akan menerapkan class is-invalid dari bootstrap jika tidak ada error maka tidak menerapkan kelas tersebut-->
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
                            <!--menggunakan ternary operator dimana jika terdapat error pada validasi maka akan menerapkan class is-invalid dari bootstrap jika tidak ada error maka tidak menerapkan kelas tersebut-->
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
                            <!--menggunakan ternary operator dimana jika terdapat error pada validasi maka akan menerapkan class is-invalid dari bootstrap jika tidak ada error maka tidak menerapkan kelas tersebut-->
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="password">Password</label>
                        <div class="col-sm-12">
                            <input type="password" class="form-control" name="password" id="password">
                            <!--menggunakan ternary operator dimana jika terdapat error pada validasi maka akan menerapkan class is-invalid dari bootstrap jika tidak ada error maka tidak menerapkan kelas tersebut-->
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="konfirpass">Konfirmasi Password</label>
                        <div class="col-sm-12">
                            <input type="password" class="form-control" name="konfirpass" id="konfirpass">
                            <!--menggunakan ternary operator dimana jika terdapat error pada validasi maka akan menerapkan class is-invalid dari bootstrap jika tidak ada error maka tidak menerapkan kelas tersebut-->
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary tombol-tutup-user" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="tombol-simpan-add-user">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>