<!-- Modal untuk mengedit lokasi -->
<div class="modal fade" id="modaledit_lokasi" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="" method="POST" id="formLokasi_e">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Lokasi</h5>
                    <button type="button" class="btn-close tombol-tutup-lokasi" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!--Kalau ada error-->
                    <div class="alert alert-danger error-lokasi_e" role="alert" style="display: none"> <!--display none agar tidak ditampilkan saat pertama kali dan ditampilkan jika dipicu oleh hide() dan show() dari script jquery-->
                    </div>
                    <!--Kalau sukses-->
                    <div class="alert alert-success sukses-lokasi_e" role="alert" style="display: none">
                    </div>
                    <?= csrf_field(); ?>
                    <input type="hidden" id="id_lokasi_e">
                    <div class="row mb-3">
                        <label for="namalokasi">Nama Lokasi</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" name="namalokasi" id="namalokasi_e">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary tombol-tutup-lokasi" data-bs-dismiss="modal">Tutup</button>
                    <button type="button" class="btn btn-primary" id="tombol-simpan-edit-lokasi">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>