<!-- Modal untuk menambah lokasi baru -->
<div class="modal fade" id="modaltambah_lokasi" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="" method="POST" id="formLokasi">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Lokasi</h5>
                    <button type="button" class="btn-close tombol-tutup-lokasi" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!--Kalau ada error-->
                    <div class="alert alert-danger error-lokasi" role="alert" style="display: none"> <!--display none agar tidak ditampilkan saat pertama kali dan ditampilkan jika dipicu oleh hide() dan show() dari script jquery-->
                    </div>
                    <!--Kalau sukses-->
                    <div class="alert alert-success sukses-lokasi" role="alert" style="display: none">
                    </div>
                    <?= csrf_field(); ?>
                    <div class="row mb-3">
                        <label for="namalokasi">Nama Lokasi</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" name="namalokasi" id="namalokasi">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary tombol-tutup-lokasi" data-bs-dismiss="modal">Tutup</button>
                    <button type="button" class="btn btn-primary" id="tombol-simpan-add-lokasi">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>