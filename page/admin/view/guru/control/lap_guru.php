<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col">

                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Data Guru</h3>
                    </div>

                    <div class="card-body">
                        <table id="laporan" class="table table-bordered table-hover">
                            <thead class="bg-navy">
                                <tr align="center">
                                    <th>No</th>
                                    <th>Nama Guru</th>
                                    <th>Nomor Induk Guru</th>
                                    <th style="width:150px; max-width: 150px;">Alamat</th>
                                    <th>Jenis Kelamin</th>
                                    <th>Mapel</th>
                                    <th>No telp</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php 
                                $guru = $mysqli->query("SELECT * FROM guru ORDER BY id_guru");

                                $no = 0;
                                while ($data = mysqli_fetch_array($guru)) {
                                    $no++
                                ?>
                                    <tr>
                                        <td align="center"><?php echo $no; ?></td>
                                        <td><?php echo $data['nama_guru']; ?></td>
                                        <td><?php echo $data['nig']; ?></td>
                                        <td><?php echo $data['alamat']; ?></td>
                                        <td><?php echo $data['jk']; ?></td>
                                        <td><?php echo $data['mapel']; ?></td>
                                        <td><?php echo $data['no_hp']; ?></td>
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