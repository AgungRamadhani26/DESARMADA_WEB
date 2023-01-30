<?= $this->extend('layout/templete'); ?>

<?= $this->section('content'); ?>
<div class="container mb-5">
    <div class="container">
        <div class="container form-kontainer">
            <div class="row">
                <center>
                    <hr />
                    <hr />
                    <h1 class="my-3">Form Peminjaman Kendaraan</h1>
                    <hr />
                    <hr />
                    <br>
                    <div class="col-7">
                        <form action="" method="POST" enctype="multipart/form-data">
                            <?= csrf_field(); ?>
                            <div class="row mb-3">
                                <label for="jenis_kendaraan" class="col-sm-3 col-form-label">Jenis Kendaraaan</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="jenis_kendaraan" disabled autofocus value="">
                                    <!--menggunakan ternary operator dimana jika terdapat error pada validasi maka akan menerapkan class is-invalid dari bootstrap jika tidak ada error maka tidak menerapkan kelas tersebut.-->
                                    <div class="invalid-feedback">
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="tipe_kendaraan" class="col-sm-3 col-form-label">Tipe Kendaraaan</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="tipe_kendaraan" disabled value="">
                                    <div class="invalid-feedback">
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="nomor_polisi" class="col-sm-3 col-form-label">Nomor Polisi</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="nomor_polisi" disabled value="">
                                    <div class="invalid-feedback">
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="km" class="col-sm-3 col-form-label">Km Awal</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="km" disabled value="">
                                    <div class="invalid-feedback">
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="tgl_pinjam" class="col-sm-3 col-form-label">Tanggal Pinjam</label>
                                <div class="col-sm-9">
                                    <input class="form-control" type="date" name="tgl_pinjam">
                                    <div class="invalid-feedback">
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="" class="col-sm-3 col-form-label">Jam Pinjam</label>
                                <div class="col-sm-9">
                                    <input type="time" class="form-control" id="" name="" value="">
                                    <div class="invalid-feedback">
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="keperluan" class="col-sm-3 col-form-label">Keperluan</label>
                                <div class="col-sm-9">
                                    <textarea class="form-control" rows="3" name="keperluan" value=""></textarea>
                                    <div class="invalid-feedback">
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="" class="col-sm-3 col-form-label">Driver</label>
                                <div class="col-sm-9">
                                    <select class="form-control" name="driver">
                                        <option value="">-- Pilih Driver --</option>
                                        <option>Ale</option>
                                    </select>
                                    <div class="invalid-feedback">
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="tujuan" class="col-sm-3 col-form-label">Kota Tujuan</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="tujuan" value="">
                                    <div class="invalid-feedback">
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