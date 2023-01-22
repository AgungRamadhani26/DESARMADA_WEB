<!-- Modal untuk menambah kendaraan baru-->
<div class="modal fade" id="modaltambah_kendaraan" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="/kendaraan/tambah_kendaraan" method="POST" enctype="multipart/form-data">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Kendaraan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <?= csrf_field(); ?>
                    <div class="row mb-3">
                        <label for="jeniskendaraan">Jenis Kendaraan</label>
                        <div class="col-sm-12">
                            <select class="form-control">
                                <option value="">-- Pilih Jenis Kendaraan --</option>
                                <option value="mobil">Mobil</option>
                                <option value="motor">Motor</option>
                            </select>
                            <!--menggunakan ternary operator dimana jika terdapat error pada validasi maka akan menerapkan class is-invalid dari bootstrap jika tidak ada error maka tidak menerapkan kelas tersebut-->
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="tipekendaraan">Tipe Kendaraan</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control">
                            <!--menggunakan ternary operator dimana jika terdapat error pada validasi maka akan menerapkan class is-invalid dari bootstrap jika tidak ada error maka tidak menerapkan kelas tersebut-->
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="nopol">Nomor Polisi</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control">
                            <!--menggunakan ternary operator dimana jika terdapat error pada validasi maka akan menerapkan class is-invalid dari bootstrap jika tidak ada error maka tidak menerapkan kelas tersebut-->
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="lokasi">Lokasi</label>
                        <div class="col-sm-12">
                            <select class="form-control">
                                <option value="">-- Pilih Lokasi --</option>
                                <option value="1">Semarang</option>
                                <option value="2">Makassar</option>
                                <option value="3">Yogyakarta</option>
                                <option value="2">Tegal</option>
                            </select>
                            <!--menggunakan ternary operator dimana jika terdapat error pada validasi maka akan menerapkan class is-invalid dari bootstrap jika tidak ada error maka tidak menerapkan kelas tersebut-->
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="kmawal">KM Awal</label>
                        <div class="col-sm-12">
                            <input type="number" class="form-control">
                            <!--menggunakan ternary operator dimana jika terdapat error pada validasi maka akan menerapkan class is-invalid dari bootstrap jika tidak ada error maka tidak menerapkan kelas tersebut-->
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="gambar">Gambar</label>
                        <div class="col-sm-3">
                            <img src="/assets/images/faces/1.jpg" class="img-thumbnail img-preview">
                        </div>
                        <div class="col-sm-9">
                            <div class="input-group">
                                <input class="form-control" type="file">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>