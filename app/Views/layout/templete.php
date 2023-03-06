<!DOCTYPE html>
<html lang="en">

<head>
    <?= $this->include('layout/link_dan_library'); ?>
</head>

<body>
    <!--Header Tampilan-->
    <?= $this->include('layout/header'); ?>

    <!--Load file sidebar-->
    <?php
    if (session()->get('level') == 1) {
        echo $this->include('layout/sidebar_admin');
    } elseif (session()->get('level') == 2) {
        echo $this->include('layout/sidebar_user');
    }
    ?>

    <!--Footer Tampilan-->
    <?= $this->include('layout/footer'); ?>

    <?= $this->include('layout/link_dan_library1'); ?>

</body>

</html>