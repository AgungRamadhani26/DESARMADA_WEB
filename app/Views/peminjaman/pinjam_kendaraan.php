<?= $this->extend('layout/templete'); ?>

<?= $this->section('content'); ?>
<div class="container mb-5">
    <div class="container">
        <div class="container form-kontainer">
            <div class="row">
                <center>
                    <hr />
                    <div class="pinjam-kembali">
                        <h3 class="my-3">Form Peminjaman Kendaraan</h3>
                    </div>
                    <hr />
                    <br>
                    <div class="col-7">
                        <form action="/peminjaman/add_pinjam/<?= $kendaraan['id_kendaraan'] ?>" method="POST" enctype="multipart/form-data">
                            <?= csrf_field(); ?>
                            <div class="row mb-3">
                                <label for="jenis_kendaraan" class="col-sm-3 col-form-label">Jenis Kendaraaan</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="jenis_kendaraan" readonly autofocus value="<?= $kendaraan['jenis_kendaraan'] ?>">
                                    <!--menggunakan ternary operator dimana jika terdapat error pada validasi maka akan menerapkan class is-invalid dari bootstrap jika tidak ada error maka tidak menerapkan kelas tersebut.-->
                                    <div class="invalid-feedback">
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="tipe_kendaraan" class="col-sm-3 col-form-label">Tipe Kendaraaan</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="tipe_kendaraan" readonly value="<?= $kendaraan['tipe_kendaraan'] ?>">
                                    <div class="invalid-feedback">
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="nomor_polisi" class="col-sm-3 col-form-label">Nomor Polisi</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="nomor_polisi" readonly value="<?= $kendaraan['nomor_polisi'] ?>">
                                    <div class="invalid-feedback">
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="km" class="col-sm-3 col-form-label">Km Awal</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="km" readonly value="<?= $kendaraan['km'] ?>">
                                    <div class="invalid-feedback">
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="tgl_pinjam" class="col-sm-3 col-form-label">Tanggal Pinjam</label>
                                <div class="col-sm-9">
                                    <input type="date" class="form-control <?= (session()->getFlashdata('tgl_pinjam_kosong')) ? 'is-invalid' : ''; ?>" name="tgl_pinjam" value="<?= old('tgl_pinjam'); ?>">
                                    <div class="invalid-feedback">
                                        <?= session()->getFlashdata('tgl_pinjam_kosong') ?>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="jam_pinjam" class="col-sm-3 col-form-label">Jam Pinjam</label>
                                <div class="col-sm-9">
                                    <input type="time" class="form-control <?= (session()->getFlashdata('jam_pinjam_kosong')) ? 'is-invalid' : ''; ?>" name="jam_pinjam" value="<?= old('jam_pinjam'); ?>">
                                    <div class="invalid-feedback">
                                        <?= session()->getFlashdata('jam_pinjam_kosong') ?>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="keperluan" class="col-sm-3 col-form-label">Keperluan</label>
                                <div class="col-sm-9">
                                    <textarea class="form-control <?= (session()->getFlashdata('keperluan_kosong')) ? 'is-invalid' : ''; ?>" rows="3" name="keperluan"><?= old('keperluan'); ?></textarea>
                                    <div class="invalid-feedback">
                                        <?= session()->getFlashdata('keperluan_kosong') ?>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="" class="col-sm-3 col-form-label">Driver</label>
                                <div class="col-sm-9">
                                    <select class="form-control" name="driver">
                                        <?php foreach ($driverr as $d) : ?>
                                            <?php
                                            $selected = ($d['id_driver'] == session()->get('id_driver')) ? 'selected' : '';
                                            ?>
                                            <option value="<?= $d['nama'] ?>" <?php echo $selected ?>><?= $d['nama'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <div class="invalid-feedback">
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-5">
                                <label for="tujuan" class="col-sm-3 col-form-label">Kota Tujuan</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control <?= (session()->getFlashdata('tujuan_kosong')) ? 'is-invalid' : ''; ?>" name="tujuan" value="<?= old('tujuan'); ?>">
                                    <div class="invalid-feedback">
                                        <?= session()->getFlashdata('tujuan_kosong') ?>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 row col-sm-4">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </center>
                <div class="mb-3 mt-3 row col-2">
                    <a class="ms-3 btn btn-info" style="font-weight:bold; color:white" href="/dashboard/<?= $kendaraan['jenis_kendaraan'] ?>"><i class="bi bi-skip-backward-circle-fill"></i> Back</a>
                </div>

            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>