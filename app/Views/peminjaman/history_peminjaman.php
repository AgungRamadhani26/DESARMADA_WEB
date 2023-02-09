<?= $this->extend('layout/templete'); ?>

<!--Menampilkan daftar history-->
<?= $this->section('content'); ?>

<section class="section">

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3>Daftar History Peminjaman</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-8">
                            <a href="#" class="aktiff">Semua History &emsp;</a>
                            <a href="#" class="">History Mobil &emsp;</a>
                            <a href="#" class="">History Motor</a>
                        </div>
                        <div class="col-4">
                            <a href="#" class="btn btn-success btn-sm position-absolute bottom-50 end-10 mb-1">Export Data Excel</a>
                            <a href="#" class="btn btn-success btn-sm position-absolute top-50 end-10 mt-1">Export Data PDF</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header bg-light">
            <h4>Hiatory Peminjaman (Semua)</h4>
        </div>
        <div class="card-body">
            <table class="table table-hover" id="table1">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Action</th>
                        <th>Jenis Kendaraan</th>
                        <th>Tipe Kendaraaan</th>
                        <th>Nomor Polisi</th>
                        <th>Tanggal Pinjam</th>
                        <th>Jam Pinjam</th>
                        <th>Tanggal Kembali</th>
                        <th>Jam Kembali</th>
                        <th>Km Awal</th>
                        <th>Km Akhir</th>
                        <th>Total Km</th>
                        <th>Pengisian Tol</th>
                        <th>Pengisian BBM</th>
                        <th>Peminjam</th>
                        <th>Keperluan</th>
                        <th>Kota Tujuan</th>
                        <th>Driver</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1 ?>
                    <?php foreach ($history as $h) : ?>
                        <tr>
                            <td><?= $i++ ?></td>
                            <td>
                                <a href="" class="btn btn-outline-danger btn-sm"><i class="bi bi-trash3-fill"></i> Hapus</a>
                            </td>
                            <td><?= $h['jenis_kendaraan'] ?></td>
                            <td><?= $h['tipe_kendaraan'] ?></td>
                            <td><?= $h['nomor_polisi'] ?></td>
                            <td><?= $h['tgl_peminjaman'] ?></td>
                            <td><?= $h['jam_peminjaman'] ?></td>
                            <td><?= $h['tgl_kembali'] ?></td>
                            <td><?= $h['jam_kembali'] ?></td>
                            <td><?= $h['km_awal'] ?></td>
                            <td><?= $h['km_akhir'] ?></td>
                            <td><?= 'belum di set' ?></td>
                            <td><?= 'belum di set' ?></td>
                            <td><?= 'belum di set' ?></td>
                            <td><?= 'belum diset' ?></td>
                            <td><?= $h['keperluan'] ?></td>
                            <td><?= $h['tujuan'] ?></td>
                            <td><?= $h['driver'] ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</section>

<?= $this->endSection(); ?>