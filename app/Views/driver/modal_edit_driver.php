<!-- Modal untuk menambah driver baru-->
<div class="modal fade" id="modaledit_driver" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="" method="POST" id="formDriver_e">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Driver</h5>
                    <button type="button" class="btn-close tombol-tutup" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!--Kalau ada error-->
                    <div class="alert alert-danger error" role="alert" style="display: none"> <!--display none agar tidak ditampilkan saat pertama kali dan ditampilkan jika dipicu oleh hide() dan show() dari script jquery-->
                    </div>
                    <!--Kalau sukses-->
                    <div class="alert alert-success sukses" role="alert" style="display: none">
                    </div>
                    <?= csrf_field(); ?>
                    <input type="hidden" id="id_driver_e">
                    <div class="row mb-3">
                        <label for="nama">Nama</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" name="nama_e" id="nama_e">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary tombol-tutup" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="tombol-simpan-edit-driver">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>