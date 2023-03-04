<!DOCTYPE html>
<html lang="en">

<head>
    <?= $this->include('layout/link_dan_library'); ?>
</head>

<body>
    <!--Header Tampilan-->
    <header>
        <?php $date = date('Y-m-d');
        $datenow = date('d F Y', strtotime($date)); ?>
        <div class="row">
            <div class="col-3"></div>
            <div class="col-7">
                <center>
                    Tanggal : <?= $datenow; ?>
                </center>
            </div>
            <div class="col-2">
                <div class="dropdown">
                    <a class=" <?= $url == 'profile' ? 'active' : '' ?>" style="color: white;" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                        <span class="material-icons">person</span> <?= session()->get('nama'); ?>
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                        <li><a class="dropdown-item" href="/profile/lihat_profile"><i class="bi bi-person-circle"></i> Profile</a></li>
                        <li><a class="dropdown-item" href="/logout"><i class="bi bi-box-arrow-right"></i> Logout</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </header>

    <!--Load file sidebar-->
    <?php
    if (session()->get('level') == 1) {
        echo $this->include('layout/sidebar_admin');
    } elseif (session()->get('level') == 2) {
        echo $this->include('layout/sidebar_user');
    }
    ?>

    <!--Footer Tampilan-->
    <footer>
        2023 &copy; Aplikasi Monitoring Operational Armada DESNET
    </footer>

    <?= $this->include('layout/link_dan_library1'); ?>

</body>

</html>