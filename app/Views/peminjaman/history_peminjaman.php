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
                            <a href="/peminjaman/history_peminjaman" class="aktiff">Semua History &emsp;</a>
                            <a href="/peminjaman/history_peminjaman_mobil" class="">History Mobil &emsp;</a>
                            <a href="/peminjaman/history_peminjaman_motor" class="">History Motor</a>
                        </div>
                        <div class="col-4">
                            <a href="/peminjaman/eksport_all_exc" class="btn btn-success btn-sm position-absolute bottom-50 end-10 mb-1"><i class="bi bi-file-earmark-spreadsheet-fill"></i> Export Data Excel</a>
                            <a href="#" class="btn btn-success btn-sm position-absolute top-50 end-10 mt-1"><i class="bi bi-file-earmark-pdf-fill"></i> Export Data PDF</a>
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
                        <?php
                        if (session()->get('level') == 1) {
                        ?>
                            <th>Action</th>
                        <?php
                        }
                        ?>
                        <th>Jenis Kendaraan</th>
                        <th>Tipe Kendaraan</th>
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
                    <?php
                    $i = 1 ?>
                    <?php foreach ($history as $h) : ?>
                        <tr>
                            <?php
                            //Untuk tanggal pinjam
                            $tgl_pinjam = $h['tgl_peminjaman'];
                            $tgl_pinjam1 = strtotime($tgl_pinjam);
                            $tgl_pinjam2 = date('d-m-Y', $tgl_pinjam1);
                            //Untuk jam pinjam
                            $jam_pinjam = $h['jam_peminjaman'];
                            $jam_pinjam1 = strtotime($jam_pinjam);
                            $jam_pinjam2 = date('H:i', $jam_pinjam1);
                            //Untuk tanggal kembali
                            if ($h['tgl_kembali'] != NULL) {
                                $tgl_kembali = $h['tgl_kembali'];
                                $tgl_kembali1 = strtotime($tgl_kembali);
                                $tgl_kembali2 = date('d-m-Y', $tgl_kembali1);
                            } else {
                                $tgl_kembali2 = '';
                            }
                            //Untuk jam kembali
                            if ($h['jam_kembali'] != NULL) {
                                $jam_kembali = $h['jam_kembali'];
                                $jam_kembali1 = strtotime($jam_kembali);
                                $jam_kembali2 = date('H:i', $jam_kembali1);
                            } else {
                                $jam_kembali2 = '';
                            }
                            //Untuk total KM
                            if ($h['km_akhir'] != NULL) {
                                $total_km = $h['km_akhir'] - $h['km_awal'];
                            } else {
                                $total_km = 0;
                            }
                            //Untuk pengisian tol
                            if ($h['saldo_tol_akhir'] == NULL) {
                                $pengisian_tol = 0;
                                $tol = '/assets/images/img_tampilan/NoImage.png';
                            } else {
                                $pengisian_tol = $h['saldo_tol_akhir'] - $h['saldo_tol_awal'];
                                $tol = '/assets/img_lampiran_tol/' . $h['lampiran_tol'];
                            }
                            //Untuk pengisian BBM
                            if (($h['hargabbm'] != NULL) || ($h['hargabbm'] != 0)) {
                                $bbm = '/assets/img_lampiran_bbm/' . $h['lampiran_bbm'];
                            } else {
                                $bbm = '/assets/images/img_tampilan/NoImage.png';
                            }
                            ?>
                            <!--Menampilkan historynya-->
                            <td><?= $i++ ?></td>
                            <?php
                            if (session()->get('level') == 1) {
                            ?>
                                <td>
                                    <a href="" class="btn btn-outline-danger btn-sm"><i class="bi bi-trash3-fill"></i> Hapus</a>
                                </td>
                            <?php
                            }
                            ?>
                            <td><?= $h['jenis_kendaraan'] ?></td>
                            <td><?= $h['tipe_kendaraan'] ?></td>
                            <td><?= $h['nomor_polisi'] ?></td>
                            <td><?= $tgl_pinjam2 ?></td>
                            <td><?= $jam_pinjam2 ?></td>
                            <td><?= $tgl_kembali2 ?></td>
                            <td><?= $jam_kembali2 ?></td>
                            <td><?= $h['km_awal'] ?></td>
                            <td><?= $h['km_akhir'] ?></td>
                            <td><?= $total_km ?></td>
                            <td><a href="<?= $tol ?>" target="_blank"><?= idr($pengisian_tol) ?></a></td>
                            <td><a href="<?= $bbm ?>" target="_blank"><?= idr($h['hargabbm']) ?></a></td>
                            <td><?= $h['nama'] ?></td>
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