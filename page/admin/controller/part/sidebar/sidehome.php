<!-- untuk home -->

<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
        <img src="../../template/dist/img/logo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">SMK Harapan Bunda</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="../../template/dist/img/user.png" class="img-circle elevation-2" alt="User Image" style="filter: invert(1);">
            </div>
            <div class="info">
                <a href="#" class="d-block"><?php echo $_SESSION['level']; ?> | <?php echo $_SESSION['nama_user']; ?></a>
            </div>
        </div>


        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                with font-awesome or any other icon font library -->

                <li class="nav-item">
                    <a href="index.php" class="nav-link active">
                        <i class="nav-icon fas fa-home"></i>
                        <p>
                            Home
                        </p>
                    </a>
                </li>
                <li class="nav-item menu">
                    <a href="#" class="nav-link">
                        <i class="nav-icon far fa-copy"></i>
                        <p>
                            Data
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">

                        <li class="nav-item">
                            <a href="?pembayaran=data_pembayaran" class="nav-link">
                                <i class="fas fa-file-invoice-dollar nav-icon"></i>
                                <p>Data pembayaran</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="?spp=data_spp" class="nav-link">
                                <i class="far fa-file-alt nav-icon"></i>
                                <p>Data SPP</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="?siswa=data_siswa" class="nav-link">
                                <i class="far fa-user nav-icon"></i>
                                <p>Data Siswa</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="?petugas=data_petugas" class="nav-link">
                                <i class="fas fa-user-cog nav-icon"></i>
                                <p>Data Petugas</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="?guru=data_guru" class="nav-link">
                                <i class="fas fa-user-graduate nav-icon"></i>
                                <p>Data Guru</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="?kelas=data_kelas" class="nav-link">
                                <i class="fas fa-users nav-icon"></i>
                                <p>Data Kelas</p>
                            </a>
                        </li>

                    </ul>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>