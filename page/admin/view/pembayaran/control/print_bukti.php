<?php
$print = $mysqli->query("
                            SELECT * FROM bayar,user,siswa,kelas,spp WHERE bayar.id_user=user.id_user and bayar.id_siswa=siswa.id_siswa and bayar.id_kelas=kelas.id_kelas and bayar.id_spp=spp.id_spp and bayar.id_bayar='$_GET[id_bayar]'
                        ");

$p = mysqli_fetch_array($print)

?>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <!-- Main content -->
            <div class="invoice p-3 mb-3">
                <!-- title row -->
                <div class="row">
                    <div class="col-12">
                        <h4>
                            <img src="../../template/dist/img/logo.png" alt="logo" style="max-width: 40px;"> KWITANSI PEMBAYARAN SPP.
                            <?php
                            $date = date('d-m-Y');
                            ?>
                            <small class="float-right"><?php echo $date; ?> </small>
                        </h4>
                    </div>
                    <!-- /.col -->
                </div>
                <!-- info row -->
                <div class="row invoice-info">
                    <div class="col-sm-4 invoice-col">
                        From :
                        <address>
                            <strong>SMK HARAPAN BANGSA.</strong><br>
                            San Francisco, CA 94107<br>
                            Phone: (804) 123-5432<br>
                            Email: info@almasaeedstudio.com<br>
                            Petugas : <?php echo $p['nama_user'] ?>
                        </address>
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-4 invoice-col">
                        To :
                        <address>
                            <strong><?php echo $p['nama_siswa'] ?></strong><br>
                            <?php echo $p['nis'] ?> <br>
                            <?php echo $p['alamat'] ?><br>
                            <?php echo $p['kelas'] ?> <?php echo $p['kompetisi_keahlian'] ?> <?php echo $p['indeks'] ?><br>
                            No_telp: <?php echo $p['no_telp'] ?><br>
                        </address>
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-4 invoice-col">
                        <b>Invoice</b> #<?php echo $p['id_spp'] ?> <br>
                        <br>
                        <b>ID Pembayaran:</b> <?php echo $p['id_bayar'] ?><br>
                        <b>Tanggal Bayar:</b> <?php echo $p['tgl_bayar'] ?><br>
                        <b>ID Siswa:</b> <?php echo $p['id_siswa'] ?>
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->

                <!-- Table row -->
                <div class="row">
                    <div class="col-12 table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Serial </th>
                                    <th>Description</th>
                                    <th>Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><?php echo $p['id_spp'] ?></td>
                                    <td><?php echo $p['nama_pembayaran'] ?></td>
                                    <td>Rp. <?php echo number_format($p['nominal'], 2, '.', '.'); ?></td>

                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->

                <div class="row">
                    <!-- accepted payments column -->
                    <div class="col-6">

                    </div>
                    <!-- /.col -->
                    <div class="col-6">

                        <div class="table-responsive">
                            <table class="table">
                                <?php
                                $a = $p['nominal'];
                                $b = $p['jmlh_bayar'];
                                $kembalian = $a - $b;
                                ?>
                                <tr>
                                    <th style="width:50%">Subtotal:</th>
                                    <td>Rp. <?php echo number_format($p['nominal'], 2, '.', '.'); ?></td>
                                </tr>
                                <tr>
                                    <th>Jumlah Bayar</th>
                                    <td>Rp. <?php echo number_format($p['jmlh_bayar'], 2, '.', '.'); ?></td>
                                </tr>
                                <tr>
                                    <th>Kembalian :</th>
                                    <td>Rp. <?php echo number_format($kembalian, 2, '.', '.'); ?></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->


            </div>
            <!-- /.invoice -->
        </div><!-- /.col -->
    </div><!-- /.row -->
</div><!-- /.container-fluid -->
<script>
    window.addEventListener("load", window.print());
</script>