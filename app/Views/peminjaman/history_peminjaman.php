<?= $this->extend('layout/templete'); ?>

<!--Menampilkan daftar history-->
<?= $this->section('content'); ?>

<section class="section">

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Basic Buttons</h4>
                </div>
                <div class="card-body">
                    <div class="buttons">
                        <a href="#" class="btn btn-secondary">Secondary</a>
                        <a href="#" class="btn btn-secondary">Secondary</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header bg-light">
            <h3>Daftar History Peminjaman</h3>
        </div>
        <div class="card-body">
            <table class="table table-striped" id="table1">
                <thead>
                    <tr>
                        <th>No</th>
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
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1 ?>
                    <?php foreach ($history as $h) : ?>
                        <tr>
                            <td><?= $i++ ?></td>
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
                            <td><?= 'belum diset' ?></td>
                            <td>
                                <button type="button" class="btn badge bg-danger">Hapus</button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</section>

<?= $this->endSection(); ?>