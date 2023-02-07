<div id="app">
    <div id="sidebar" class="active">
        <div class="sidebar-wrapper active TopSide">
            <div class="sidebar-header">
                <div class="d-flex justify-content-between">
                    <ul>
                        <a href="/profile/lihat_profile">
                            <center>
                                <i class="bi bi-person-circle"></i>
                                <h3 class="<?= $url == '/profile/lihat_profile' ? 'profile' : '' ?>">Profile</h3>
                            </center>
                        </a>
                    </ul>
                    <div class="toggler">
                        <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                    </div>
                </div>
            </div>
            <!--Menu-menu yang ada di sidebar-->
            <div class="sidebar-menu">
                <ul class="menu" id="menu">
                    <li class="sidebar-title">
                        <h5 style="color: rgb(72,92,188)">Beranda</h5>
                    </li>
                    <li class="sidebar-item <?= $url == '/dashboard/mobil' ? 'active' : '' ?>">
                        <a href="/dashboard/mobil" class='sidebar-link'>
                            <i class="bi bi-grid-fill"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>

                    <li class="sidebar-item <?= $url == '/peminjaman/history_peminjaman' ? 'active' : '' ?>">
                        <a href="/peminjaman/history_peminjaman" class='sidebar-link'>
                            <i class="bi bi-clock-fill"></i>
                            <span>History Peminjaman</span>
                        </a>
                    </li>
                </ul>
            </div>
            <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
        </div>
    </div>

    <!--Konten Utama-->
    <div id="main">
        <div>
            <a href="#" class="burger-btn d-block d-xl-none">
                <i class="bi bi-justify fs-3"></i>
            </a>
        </div>
        <!--Load konten yang ada-->
        <?= $this->renderSection('content'); ?>
    </div>
</div>