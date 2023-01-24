<div id="app">
    <div id="sidebar" class="active">
        <div class="sidebar-wrapper active">
            <div class="sidebar-header">
                <div class="d-flex justify-content-between">
                    <a href="">
                        <div>
                            <i class="bi bi-person-circle"></i>
                            Profile
                        </div>
                    </a>

                    <div class="toggler">
                        <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                    </div>
                </div>
            </div>
            <!--Menu-menu yang ada di sidebar-->
            <div class="sidebar-menu">
                <ul class="menu" id="menu">
                    <li class="sidebar-item">
                        <a href="/DashboardAdmin" class='sidebar-link'>
                            <i class="bi bi-grid-fill"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>

                    <li class="sidebar-item has-sub">
                        <a href="" class='sidebar-link'>
                            <i class="bi bi-car-front-fill"></i>
                            <span>Kendaraan</span>
                        </a>
                        <ul class="submenu">
                            <li class="submenu-item">
                                <a href="/kendaraan/daftar_kendaraan">Daftar Kendaraan</a>
                            </li>
                            <li class="submenu-item ">
                                <a href="">Servis Kendaraan</a>
                            </li>
                        </ul>
                    </li>

                    <li class="sidebar-item">
                        <a href="/peminjaman/history_peminjaman" class='sidebar-link'>
                            <i class="bi bi-clock-fill"></i>
                            <span>History Peminjaman</span>
                        </a>
                    </li>

                    <li class="sidebar-item">
                        <a href="/lokasi/daftar_lokasi" class='sidebar-link'>
                            <i class="bi bi-map-fill"></i>
                            <span>Lokasi</span>
                        </a>
                    </li>

                    <li class="sidebar-item">
                        <a href="/driver/daftar_driver" class='sidebar-link'>
                            <i class="bi bi-hexagon-fill"></i>
                            <span>Driver</span>
                        </a>
                    </li>

                    <li class="sidebar-item has-sub">
                        <a href="" class='sidebar-link'>
                            <i class="bi bi-pen-fill"></i>
                            <span>Laporan</span>
                        </a>
                        <ul class="submenu">
                            <li class="submenu-item ">
                                <a href="">Laporan Penggunaan</a>
                            </li>
                            <li class="submenu-item ">
                                <a href="">Laporan Servis</a>
                            </li>
                        </ul>
                    </li>

                    <li class="sidebar-item active">
                        <a href="/user/daftar_user" class='sidebar-link'>
                            <i class="bi bi-people-fill"></i>
                            <span>User</span>
                        </a>
                    </li>
                </ul>
            </div>
            <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
        </div>
    </div>

    <!--Konten Utama-->
    <div id="main">
        <div class="mb-3">
            <a href="#" class="burger-btn d-block d-xl-none">
                <i class="bi bi-justify fs-3"></i>
            </a>
        </div>
        <!--Load konten yang ada-->
        <?= $this->renderSection('content'); ?>
    </div>
</div>