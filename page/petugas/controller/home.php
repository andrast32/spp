<?php 
$jumlah_s = $mysqli->query("SELECT * FROM siswa");
$s = mysqli_num_rows($jumlah_s);

$jumlah_p = $mysqli->query("SELECT * FROM bayar");
$p = mysqli_num_rows($jumlah_p);

$jumlah_k = $mysqli->query("SELECT * FROM kelas");
$k = mysqli_num_rows($jumlah_k);

$jumlah_g = $mysqli->query("SELECT * FROM guru");
$g = mysqli_num_rows($jumlah_g);
?>

<div class="container-fluid">
    <div class="row">
        
        <div class="col-lg-3 col-6">
            <div class="small-box bg-info">
                <div class="inner">
                    <h3><?php echo $s?></h3>

                    <p>Siswa</p>
                </div>

                <div class="icon">
                    <i class="ion ion-university"></i>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-6">
            <div class="small-box bg-success">
                <div class="inner">
                    <h3><?php echo $k?></h3>

                    <p>Kelas</p>
                </div>

                <div class="icon">
                    <i class="fas fa-university"></i>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-6">
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3><?php echo $p?></h3>

                    <p>Pembayaran</p>
                </div>

                <div class="icon">
                    <i class="fas fa-wallet"></i>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-6">
            <div class="small-box bg-danger">
                <div class="inner">
                    <h3> <?php echo $g ?> </h3>

                    <p>Guru</p>
                </div>

                <div class="icon">
                    <i class="fas fa-users"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">

            <div class="col-md-6">
                <div class="card-body">
                    <div class="card card-widget widget-user">

                        <div class="widget-user-header" style="background: url('../../template/dist/img/bg.png');">
                            <h4 class="text-right">SMK HARAPAN BUNDA</h4>
                            <h4 class="text-right">AKREDITASI A++</h4>
                        </div>
                        <div class="widget-user-image">
                            <img src="../../template/dist/img/logo.png" alt="Avatar" class="img-circle">
                        </div>
                        <div class="card-footer">
                            <div class="row">

                                <div class="col-sm-4 border-right">
                                    <div class="description-block">
                                        <h5 class="description-header">
                                            <?php echo $s?>
                                        </h5>
                                        <span class="description-text">Siswa</span>
                                    </div>
                                </div>
                                
                                <div class="col-sm-4 border-right">
                                    <div class="description-block">
                                        <h5 class="description-header">
                                            <?php echo $k?>
                                        </h5>
                                        <span class="description-text">Kelas</span>
                                    </div>
                                </div>
                                <div class="col-sm-4 border-right">
                                    <div class="description-block">
                                        <h5 class="description-header">
                                            <?php echo $g?>
                                        </h5>
                                        <span class="description-text">Guru</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card card-warning">
                    <div class="card-body">
                        <div id="foto" class="carousel slide" data-ride="carousel">
                            <ol class="carousel-indicators">
                                <li data-target="#foto" data-slide-to="0" class="active"></li>
                                <li data-target="#foto" data-slide-to="1"></li>
                                <li data-target="#foto" data-slide-to="2"></li>
                            </ol>
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <img src="../../template/dist/img/1.jpg" alt="first" class="d-block w-100">
                                </div>
                                <div class="carousel-item">
                                    <img src="../../template/dist/img/2.jpg" alt="secconds" class="d-block w-100">
                                </div>
                                <div class="carousel-item">
                                    <img src="../../template/dist/img/3.jpg" alt="thrid" class="d-block w-100">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>