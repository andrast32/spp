<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            Data pembayaran
                        </h3>
                        <a href="?pembayaran=control/lap_bayar" class="float-right btn btn-info">
                            <i class="fas fa-file-download"></i>
                        </a>
                    </div>

                    <div class="card-body">
                        <table id="bayar" class="table table-bordered table-hover">
                            <thead class="bg-navy">
                                <tr align="center">
                                    <th>No</th>
                                    <th>Nama siswa</th>
                                    <th>kelas</th>
                                    <th>Pembayaran</th>
                                    <th>Tanggal bayar</th>
                                    <th>Jumlah bayar</th>
                                    <th>Kembalian</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php 
                                    $bayar = $mysqli->query("
                                        SELECT * FROM bayar
                                            JOIN user ON bayar.id_user = user.id_user
                                            JOIN siswa ON bayar.id_siswa = siswa.id_siswa
                                            JOIN kelas ON bayar.id_kelas = kelas.id_kelas
                                            JOIN spp ON bayar.id_spp = spp.id_spp
                                    ");

                                    $no = 0;
                                    
                                    while ($data = mysqli_fetch_array($bayar)) {

                                        $a = $data['nominal'];
                                        $b = $data['jmlh_bayar'];
                                        $kembalian = $a - $b;
                                        $no++
                                ?>
                                    <tr align="center">
                                        <td><?php echo $no?></td>
                                        <td align="justify"><?php echo $data['nama_siswa'] ?></td>
                                        <td align="justify">
                                            <?php echo $data['kelas'] ?>
                                            <?php echo $data['kompetisi_keahlian'] ?>
                                            <?php echo $data['indeks'] ?>
                                        </td>
                                        <td align="justify"><?php echo $data['nama_pembayaran'] ?></td>
                                        <td><?php echo $data['tgl_bayar'] ?></td>
                                        <td>Rp. <?php echo number_format($data['nominal'], 2, '.', '.')?></td>
                                        <td>Rp. <?php echo number_format($kembalian, 2, '.', '.')?></td>
                                        <td>
                                            <a href="?pembayaran=control/print_bukti&id_bayar=<?php echo $data['id_bayar']?>" class="btn btn-primary">
                                                <i class="fas fa-print"></i>
                                            </a>
                                        </td>
                                    </tr>
                                <?php }?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>