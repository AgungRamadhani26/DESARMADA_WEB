<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aplikasi Peminjaman Kendaraan</title>
    <!--Load bootstrap 5 dan icon bootstrap-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <!--Load Google Font-->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <!--Load asset dari foder public-->
    <link rel="stylesheet" href="/assets/css/bootstrap.css">
    <link rel="stylesheet" href="/assets/vendors/iconly/bold.css">
    <link rel="stylesheet" href="/assets/vendors/perfect-scrollbar/perfect-scrollbar.css">
    <link rel="stylesheet" href="/assets/vendors/bootstrap-icons/bootstrap-icons.css">
    <link rel="stylesheet" href="/assets/css/app.css">
    <link rel="shortcut icon" href="/assets/images/favicon.svg" type="image/x-icon">
    <!--Load datatable dari folder public-->
    <link rel="stylesheet" href="/assets/vendors/simple-datatables/style.css">
    <!--Load CSS tambahan dari folder public-->
    <link rel="stylesheet" href="/assets/css/tambahan.css">
    <!--Js untuk google recapcha-->
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</head>

<body>
    <!--Header Tampilan-->
    <header>
        <?php $date = date('Y-m-d');
        $datenow = date('d F Y', strtotime($date)); ?>
        <div>Tanggal : <?= $datenow; ?></div>
        <div class="header-content">
            <img src="/assets/images/img_tampilan/logo.png" width="100" />
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

    <!--Load script bootstrap 5-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <!--Load script dari folder public-->
    <script src="/assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="/assets/js/bootstrap.bundle.min.js"></script>
    <script src="/assets/js/main.js"></script>
    <!--Load script datatable dari folder public-->
    <script src="/assets/vendors/simple-datatables/simple-datatables.js"></script>
    <!--Load Jquery-->
    <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
    <!--Untuk sweetalert-->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!--Untuk autonumeric pada input bbm dan saldo tol-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/autonumeric/4.6.0/autoNumeric.min.js" integrity="sha512-6j+LxzZ7EO1Kr7H5yfJ8VYCVZufCBMNFhSMMzb2JRhlwQ/Ri7Zv8VfJ7YI//cg9H5uXT2lQpb14YMvqUAdGlcg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/autonumeric/4.6.0/autoNumeric.js" integrity="sha512-/lbeISSLChIunUcgNvSFJSC+LFCZg08JHFhvDfDWDlY3a/NYb/NPKOcfDte3aA6E3mxm9a3sdxvkktZJSCpxGw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        new AutoNumeric('#isi_tol', {
            decimalPlaces: '0',
            decimalCharacter: ',',
            digitGroupSeparator: '.'
        });

        new AutoNumeric('#isi_bbm', {
            decimalPlaces: '0',
            decimalCharacter: ',',
            digitGroupSeparator: '.'
        });
    </script>
    <script>
        <?php if (session()->getFlashdata('swal_icon')) { ?>
            Swal.fire({
                icon: '<?= session()->getFlashdata('swal_icon') ?>',
                title: '<?= session()->getFlashdata('swal_title') ?>',
                text: '<?= session()->getFlashdata('swal_text') ?>',
            })
        <?php } ?>
    </script>
    <!--Script untuk menjalankan datatable-->
    <!--Simple Datatable-->
    <script>
        let table1 = document.querySelector('#table1');
        let dataTable = new simpleDatatables.DataTable(table1);
    </script>
    <!--Jquery script-->
    <script src="/assets/ajax.js"></script>
</body>

</html>