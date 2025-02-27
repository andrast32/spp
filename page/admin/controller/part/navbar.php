    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-black navbar-dark">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
        </ul>

        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">

            <!-- Notifications Dropdown Menu -->
            <li class="nav-item dropdown">
                <a class="nav-link" data-toggle="dropdown" href="#">
                    <i class="far fa-user"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">

                    <span class="dropdown-item dropdown-header">Hello <?php echo $_SESSION['username']; ?> </span>

                    <button class="dropdown-item"
                            data-toggle="modal" 
                            data-target="#modal-change-username-<?php echo $_SESSION['id_user']; ?>">
                        <i class="fas fa-user-edit mr-1"></i> Change Username
                    </button>

                    <button class="dropdown-item"
                            data-toggle="modal" 
                            data-target="#modal-change-password-<?php echo $_SESSION['id_user']; ?>">
                        <i class="fas fa-user-edit mr-1"></i> Change Password
                    </button>

                    <div class="dropdown-divider"></div>
                    <a href="controller/logout.php" class="dropdown-item">
                        <i class="fas fa-power-off mr-2"></i> logout
                    </a>
                    
                </div>
            </li>
        </ul>
    </nav>
    <!-- /.navbar -->