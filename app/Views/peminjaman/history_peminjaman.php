<?= $this->extend('layout/templete'); ?>

<!--Menampilkan daftar history-->
<?= $this->section('content'); ?>

<section class="section">
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
                            <td><?=  ?></td>
                            <td><?=  ?></td>
                            <td><?=  ?></td>
                            <td><?=  ?></td>
                            <td><?=  ?></td>
                            <td><?=  ?></td>
                            <td><?=  ?></td>
                            <td><?=  ?></td>
                            <td><?=  ?></td>
                            <td><?=  ?></td>
                            <td><?=  ?></td>
                            <td><?=  ?></td>
                            <td><?=  ?></td>
                            <td><?=  ?></td>
                            <td><?=  ?></td>
                            <td><?=  ?></td>
                            <td><?=  ?></td>
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