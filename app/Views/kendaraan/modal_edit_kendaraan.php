<!-- Modal untuk mengedit kendaraan-->
<div class="modal fade" id="modaledit_kendaraan" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="" method="POST" enctype="multipart/form-data" id="formKendaraan_e">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Kendaraan</h5>
                    <button type="button" class="btn-close tombol-tutup-kendaraan" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!--Kalau ada error-->
                    <div class="alert alert-danger error-kendaraan" role="alert" style="display: none"> <!--display none agar tidak ditampilkan saat pertama kali dan ditampilkan jika dipicu oleh hide() dan show() dari script jquery-->
                    </div>
                    <!--Kalau sukses-->
                    <div class="alert alert-success sukses-kendaraan" role="alert" style="display: none">
                    </div>
                    <?= csrf_field(); ?>
                    <input type="hidden" id="id_kendaraan_e">
                    <input type="hidden" id="gambarlama_e">
                    <div class="row mb-3">
                        <label for="jeniskendaraan">Jenis Kendaraan</label>
                        <div class="col-sm-12">
                            <select class="form-control" id="jeniskendaraan_e">
                                <option value="">-- Pilih Jenis Kendaraan --</option>
                                <option value="mobil">Mobil</option>
                                <option value="motor">Motor</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="tipekendaraan">Tipe Kendaraan</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="tipekendaraan_e">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="nopol">Nomor Polisi</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="nopol_e">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="lokasi">Lokasi</label>
                        <div class="col-sm-12">
                            <select class="form-control" id="lokasi_e">
                                <option value="">-- Pilih Lokasi --</option>
                                <?php foreach ($lokasi as $l) : ?>
                                    <option value="<?= $l['id_departemen'] ?>"><?= $l['nama_departemen'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="kmawal">KM Awal</label>
                        <div class="col-sm-12">
                            <input type="number" class="form-control" id="kmawal_e">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="gambar">Gambar</label>
                        <div class="col-sm-3">
                            <img src="" class="img-thumbnail img-preview_e" id="img-preview_e">
                        </div>
                        <div class="col-sm-9">
                            <div class="input-group">
                                <input class="form-control" type="file" id="gambar_e" onchange="previewImg_e()">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary tombol-tutup-kendaraan" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="tombol-simpan-edit-kendaraan">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>