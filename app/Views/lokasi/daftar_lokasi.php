<?= $this->extend('layout/templete'); ?>

<!--Menampilkan daftar lokasi-->
<?= $this->section('content'); ?>

<div class="row">
    <div class="col-9">
        <section class="section">
            <div class="card">
                <div class="card-header bg-table">
                    <h3>Daftar Lokasi</h3>
                </div>
                <div class="card-body">
                    <table class="table table-hover" id="table1">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Lokasi</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1 ?>
                            <?php foreach ($lokasi as $l) : ?>
                                <tr>
                                    <td><?= $i++ ?></td>
                                    <td><?= $l['nama_departemen'] ?></td>
                                    <td>
                                        <button type="button" class="btn badge edit" data-bs-toggle="modal" data-bs-target="#modaledit_lokasi" onclick="edit_lokasi(<?php echo $l['id_departemen'] ?>)"><span class="material-icons">edit</span></button>
                                        <form action="/lokasi/delete_lokasi/<?= $l['id_departemen'] ?>" method="POST" class="d-inline">
                                            <?= csrf_field(); ?>
                                            <input type="hidden" name="_method" value="DELETE">
                                            <button type="submit" class="btn badge delete" onclick="return confirm('Apakah anda yakin ?');"><span class="material-icons">clear</span></button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>

        <div class="card">
            <div class="card-header">
                <h3>Grafik Jumlah Kendaraan</h3>
            </div>
            <div class="card-content">
                <div class="card-body">
                    <figure class="highcharts-figure">
                        <div id="Grafik_jlh_kendaraan"></div>
                    </figure>
                </div>
            </div>
        </div>
    </div>

    <div class="col-3">
        <article class="card">
            <div class="card-header">
                <!-- Modal trigger button untuk menambah lokasi baru -->
                <button type="button" class="btn badge tambah" data-bs-toggle="modal" data-bs-target="#modaltambah_lokasi">
                    <span class="material-icons">add</span>
                </button>
                <center>
                    <hr>
                    <h5>Jumlah Lokasi</h5>
                    <hr>
                </center>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table">
                        <tr>
                            <td><span class="fw-bold">Semua</span></td>
                            <td>:</td>
                            <td><?= $jlh_lokasi ?></td>
                        </tr>
                    </table>
                </div>
            </div>
        </article>

        <article class="card">
            <div class="card-header">
                <h5>Jumlah kendaraan di Setiap Lokasi</h5>
                <hr>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id=tabel_jumlah_kendaraan>
                        <thead>
                            <tr style="color:white; background-color:rgba(67,94,190,255)">
                                <th rowspan="2">
                                    <center>Lokasi</center>
                                </th>
                                <th colspan="2">
                                    <center>Jenis Kendaraan</center>
                                </th>
                            </tr>
                            <tr style="color:black; background-color:#f2f7ff">
                                <th>
                                    <center>Mobil</center>
                                </th>
                                <th>
                                    <center>Motor</center>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($jumlahMobilMotor as $jmm) : ?>
                                <tr>
                                    <th style="color:black; background-color:#f2f7ff"><?= $jmm['nama_dp'] ?></tH>
                                    <td><?= $jmm['jumlah_mobil'] ?></td>
                                    <td><?= $jmm['jumlah_motor'] ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </article>
    </div>
</div>

<!--include Modal untuk menambah lokasi baru-->
<?= $this->include('lokasi/modal_add_lokasi'); ?>
<!--include Modal untuk mengedit lokasi-->
<?= $this->include('lokasi/modal_edit_lokasi'); ?>

<script>
    $(function() {
        var jumlahMobilGR1 = <?= json_encode($jumlahMobilGR) ?>;
        //parsing jumlahMobilGR1 ke array of integer
        var jumlahMobilGR = jumlahMobilGR1.map(Number);

        var jumlahMotorGR1 = <?= json_encode($jumlahMotorGR) ?>;
        //parsing jumlahMotorGR1 ke array integer of integer
        var jumlahMotorGR = jumlahMotorGR1.map(Number);


        Highcharts.chart('Grafik_jlh_kendaraan', {
            chart: {
                type: 'column'
            },
            title: {
                text: 'Jumlah kendaraan di setiap lokasi'
            },
            xAxis: {
                categories: <?= json_encode($lokasiGR) ?>
            },
            credits: {
                enabled: false
            },
            series: [{
                name: 'Mobil',
                data: jumlahMobilGR
            }, {
                name: 'Motor',
                data: jumlahMotorGR
            }]
        });
    });
</script>

<?= $this->endSection(); ?>