<!-- Modal untuk menambah kendaraan baru-->
<div class="modal fade" id="modaltambah_kendaraan" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="" method="POST" enctype="multipart/form-data" id="formKendaraan">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Kendaraan</h5>
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
                    <div class="row mb-3">
                        <label for="jeniskendaraan">Jenis Kendaraan</label>
                        <div class="col-sm-12">
                            <select class="form-control" id="jeniskendaraan">
                                <option value="">-- Pilih Jenis Kendaraan --</option>
                                <option value="mobil">Mobil</option>
                                <option value="motor">Motor</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="tipekendaraan">Tipe Kendaraan</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="tipekendaraan">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="nopol">Nomor Polisi</label>
                        <div style="color: red; font-size: 13px;">*Tuliskan tanpa spasi, contoh: BK1234AB</div>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="nopol">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="lokasi">Lokasi</label>
                        <div class="col-sm-12">
                            <select class="form-control" id="lokasi">
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
                            <input type="number" class="form-control" id="kmawal">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="gambar">Gambar</label>
                        <div style="color: red; font-size: 13px;">*Ukuran maksimal gambar 1 mb</div>
                        <div class="col-sm-3">
                            <img src="" class="img-thumbnail img-preview">
                        </div>
                        <div class="col-sm-9">
                            <div class="input-group">
                                <input class="form-control" type="file" id="gambar" onchange="previewImg()">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary tombol-tutup-kendaraan" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="tombol-simpan-add-kendaraan">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>