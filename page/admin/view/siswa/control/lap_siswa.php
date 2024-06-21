<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            Data Siswa
                        </h3>
                    </div>

                    <div class="card-body">
                        <table id="laporan" class="table table-bordered table-hover">
                            <thead class="bg-navy">
                                <tr align="center">
                                    <th>No</th>
                                    <th>Nis</th>
                                    <th style="width: 150px; max-width: 150px;">Nama Siswa</th>
                                    <th style="width: 125px; max-width: 125px;">Kelas</th>
                                    <th style="width: 125px; max-width: 125px;">Alamat</th>
                                    <th>No Telp</th>
                                    <th>Jenis Kelamin</th>
                                    <th>Foto</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php 
                                    $siswa = $mysqli->query("SELECT * FROM siswa, kelas WHERE siswa.id_kelas=kelas.id_kelas");

                                    $no = 0;
                                    while ($data =  mysqli_fetch_array($siswa)) {
                                        $no++
                                ?>
                                    <tr>
                                        <td align="center"><?php echo $no?></td>
                                        <td align="center"><?php echo $data ['nis'] ?></td>
                                        <td><?php echo $data ['nama_siswa']?></td>
                                        <td>
                                            <?php echo $data ['kelas'] ?> 
                                            <?php echo $data ['kompetisi_keahlian'] ?>
                                            <?php echo $data ['indeks'] ?>
                                        </td>
                                        <td><?php echo $data ['alamat'] ?></td>
                                        <td><?php echo $data ['no_telp'] ?></td>
                                        <td><?php echo $data ['jk'] ?></td>
                                        <td align="center"><img src="../../template/dist/img/upload/<?php echo $data['foto']?>" alt="Foto siswa" width="90"></td>
                                        
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