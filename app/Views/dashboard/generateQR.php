<?= $this->extend('layout/templete'); ?>

<?= $this->section('content'); ?>

<div class="row">
    <div class="col-12">
        <div class="card mb-3" style="max-width: 600px;">
            <div class="card-header qr-codeHeader">
                <h2>Generate QR-Code</h2>
            </div>
            <div class="row">
                <div class="col-md-8">
                    <img src="/assets/img_kendaraan/<?= $mobil['gambar'] ?>" class="img-fluid rounded-start" alt="">
                </div>
                <div class="col-md-4">
                    <div class="card-body">
                        <?php
                        $db = \Config\Database::connect();
                        $query = $db->query("SELECT nama_departemen AS lokasi FROM departemen WHERE departemen.id_departemen =" . $mobil['id_departemen'] . "");
                        $results = $query->getRowArray();
                        ?>
                        <p style="font-weight:bold">Lokasi : <?= $results['lokasi'] ?></p>
                        <p style="font-weight:bold">No Polisi : <?= $mobil['nomor_polisi'] ?></p>
                        <a href="" class="btn btn-primary">Cetak</a>
                    </div>
                </div>
            </div>
            <div class="qr-codeHeader">
                <a class="ms-3" style="font-weight:bold" href="/dashboard/mobil">Kembali ke daftar mobil</a>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>