<?= $this->extend('layout/templete'); ?>

<?= $this->section('content'); ?>

<div class="row">
    <div class="col-12">
        <div class="card mb-3" style="max-width: 600px;">
            <div class="card-header qr-codeHeader">
                <h3 style="color:white">Generate QR-Code</h3>
            </div>
            <div class="row mt-2 mb-2">
                <div class="col-md-8">
                    <center>
                        <img src="<?= $url_QR_Code ?>" class="img-fluid rounded-start" alt="">
                    </center>
                </div>
                <div class="col-md-4 mt-5">
                    <div class="card-body">
                        <?php
                        $db = \Config\Database::connect();
                        $query = $db->query("SELECT nama_departemen AS lokasi FROM departemen WHERE departemen.id_departemen =" . $kendaraan['id_departemen'] . "");
                        $results = $query->getRowArray();
                        ?>
                        <p style="font-weight:bold">Lokasi : <?= $results['lokasi'] ?></p>
                        <p style="font-weight:bold">No Polisi : <?= $kendaraan['nomor_polisi'] ?></p>
                        <a href="/dashboard/printQR/<?= $kendaraan['nomor_polisi'] ?>" class="btn btn-primary">Print</a>
                    </div>
                </div>
            </div>
            <div class="qr-codeHeader">
                <a class="ms-3" style="font-weight:bold; color:white" href="/dashboard/<?= $kendaraan['jenis_kendaraan'] ?>">Kembali ke daftar <?= $kendaraan['jenis_kendaraan'] ?></a>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>