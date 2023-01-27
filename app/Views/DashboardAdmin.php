<?= $this->extend('layout/templete'); ?>

<?= $this->section('content'); ?>

<div>
    <h1>Lorem ipsum dolor sit amet consectetur adipisicing elit. Et quasi voluptatum, sunt voluptas quod magnam! Exercitationem enim officia, autem voluptate inventore labore. Veritatis id commodi esse! Fugit id odit velit.</h1>
    <?php
    echo date("Y-m-d H:i:s");
    ?>
</div>

<?= $this->endSection(); ?>