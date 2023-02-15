<?= $this->extend('layout/templete'); ?>

<?= $this->section('content'); ?>
<div class="container mb-5">
    <div class="container">
        <div class="container form-kontainer">
            <div class="row">
                <center>
                    <hr />
                    <div class="updateProfile">
                        <h3 class="my-3">Form Pengembalian Kendaraan</h3>
                    </div>
                    <hr />
                    <br>
                    <div class="col-9">
                        <form action="/peminjaman/add_pengembalian/<?= $peminjaman['id_peminjaman'] ?>" method="POST" enctype="multipart/form-data">
                            <?= csrf_field(); ?>
                            <div class="row mb-3">
                                <label for="jenis_kendaraan" class="col-sm-4 col-form-label">Jenis Kendaraaan</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" name="jenis_kendaraan" readonly autofocus value="<?= $kendaraan['jenis_kendaraan'] ?>">
                                    <div class="invalid-feedback">
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="tipe_kendaraan" class="col-sm-4 col-form-label">Tipe Kendaraaan</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" name="tipe_kendaraan" readonly value="<?= $kendaraan['tipe_kendaraan'] ?>">
                                    <div class="invalid-feedback">
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="tgl_kembali" class="col-sm-4 col-form-label">Tanggal Kembali</label>
                                <div class="col-sm-8">
                                    <input type="date" class="form-control <?= (session()->getFlashdata('err_tgl_kembali')) ? 'is-invalid' : ''; ?>" name="tgl_kembali" value="<?= old('tgl_kembali'); ?>">
                                    <div class="invalid-feedback">
                                        <?= session()->getFlashdata('err_tgl_kembali') ?>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="jam_kembali" class="col-sm-4 col-form-label">Jam Kembali</label>
                                <div class="col-sm-8">
                                    <input type="time" class="form-control <?= (session()->getFlashdata('err_jam_kembali')) ? 'is-invalid' : ''; ?>" name="jam_kembali" value="<?= old('jam_kembali'); ?>">
                                    <div class="invalid-feedback">
                                        <?= session()->getFlashdata('err_jam_kembali') ?>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="km_akhir" class="col-sm-4 col-form-label">Km Akhir</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control <?= (session()->getFlashdata('err_km_akhir')) ? 'is-invalid' : ''; ?>" name="km_akhir" value="<?= old('km_akhir'); ?>">
                                    <div class="invalid-feedback">
                                        <?= session()->getFlashdata('err_km_akhir') ?>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="isi_tol" class="col-sm-4 col-form-label">Nilai Pengisian Saldo Tol</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control <?= (session()->getFlashdata('err_isi_tol')) ? 'is-invalid' : ''; ?>" name="isi_tol" value="<?= old('isi_tol') ? old('isi_tol') : 0; ?>">
                                    <div class="invalid-feedback">
                                        <?= session()->getFlashdata('err_isi_tol') ?>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="lampiran_isi_tol" class="col-sm-4 col-form-label">Lampiran Pengisian Saldo Tol (*)</label>
                                <div class="col-sm-6">
                                    <input type="file" class="form-control <?= (session()->getFlashdata('err_lampiran_isi_tol')) ? 'is-invalid' : ''; ?>" id="lampiran_isi_tol" name="lampiran_isi_tol" value="<?= old('lampiran_isi_tol'); ?>" onchange="previewImg_tol()">
                                    <div class="invalid-feedback">
                                        <?= session()->getFlashdata('err_lampiran_isi_tol') ?>
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <img src="" class="img-thumbnail img-preview-tol" alt="">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="isi_bbm" class="col-sm-4 col-form-label">Nilai Pengisian BBM</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control <?= (session()->getFlashdata('err_isi_bbm')) ? 'is-invalid' : ''; ?>" name="isi_bbm" value="<?= old('isi_bbm') ? old('isi_bbm') : 0; ?>">
                                    <div class="invalid-feedback">
                                        <?= session()->getFlashdata('err_isi_bbm') ?>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-5">
                                <label for="lampiran_isi_bbm" class="col-sm-4 col-form-label">Lampiran Pengisian BBM (*)</label>
                                <div class="col-sm-6">
                                    <input type="file" class="form-control <?= (session()->getFlashdata('err_lampiran_isi_bbm')) ? 'is-invalid' : ''; ?>" id="lampiran_isi_bbm" name="lampiran_isi_bbm" value="<?= old('lampiran_isi_bbm'); ?>" onchange="previewImg_bbm()">
                                    <div class="invalid-feedback">
                                        <?= session()->getFlashdata('err_lampiran_isi_bbm') ?>
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <img src="" class="img-thumbnail img-preview-bbm" alt="">
                                </div>
                            </div>
                            <div class="mb-3 row col-sm-4">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </center>
                <div class="mb-3 mt-3 row col-2">
                    <a class="ms-3 btn btn-info" style="font-weight:bold; color:white" href="/dashboard/<?= $kendaraan['jenis_kendaraan'] . '_keluar' ?>"><i class="bi bi-skip-backward-circle-fill"></i> Back</a>
                </div>

            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>