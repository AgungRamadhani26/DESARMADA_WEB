<?= $this->extend('layout/templete'); ?>

<?= $this->section('content'); ?>
<div class="container mb-5">
    <div class="container">
        <div class="container form-kontainer">
            <div class="row">
                <center>
                    <hr />
                    <div class="updateProfile">
                        <div>
                            <h3 class="my-3 profile">Update Profile</h3>
                        </div>
                    </div>
                    <hr />
                    <br>
                    <div class="col-7">
                        <form action="/profile/update_profile/" method="POST">
                            <?= csrf_field(); ?>
                            <div class="row mb-3">
                                <label for="username" class="col-sm-3 col-form-label">Username</label>
                                <div class="col-sm-9">
                                    <input type="email" class="form-control" name="username" autofocus value="<?= session()->get('username') ?>" readonly>
                                    <!--menggunakan ternary operator dimana jika terdapat error pada validasi maka akan menerapkan class is-invalid dari bootstrap jika tidak ada error maka tidak menerapkan kelas tersebut.-->
                                    <div class="invalid-feedback">
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="nama" class="col-sm-3 col-form-label">Nama</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="nama" value="<?= session()->get('nama') ?>" readonly>
                                    <div class="invalid-feedback">
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="password" class="col-sm-3 col-form-label">Password Saat Ini</label>
                                <div class="col-sm-9">
                                    <input type="password" class="form-control <?= (session()->getFlashdata('passkosong')) ? 'is-invalid' : ''; ?>" name="password" value="<?= session()->getFlashdata('password') ?>">
                                    <div class="invalid-feedback">
                                        <?= session()->getFlashdata('passkosong') ?>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="passwordBaru" class="col-sm-3 col-form-label">Password Baru</label>
                                <div class="col-sm-9">
                                    <input type="password" class="form-control <?= (session()->getFlashdata('passbaru_kosong')) ? 'is-invalid' : ''; ?>" name="passwordBaru" value="<?= session()->getFlashdata('passwordBaru') ?>">
                                    <div class="invalid-feedback">
                                        <?= session()->getFlashdata('passbaru_kosong') ?>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="konfirPassBaru" class="col-sm-3 col-form-label">Konfirmasi Password Baru</label>
                                <div class="col-sm-9">
                                    <input type="password" class="form-control <?= (session()->getFlashdata('konfirpass_barukosong')) ? 'is-invalid' : ''; ?>" name="konfirPassBaru" value="<?= session()->getFlashdata('konfirPassBaru') ?>">
                                    <div class="invalid-feedback">
                                        <?= session()->getFlashdata('konfirpass_barukosong') ?>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 row col-sm-4">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </center>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>