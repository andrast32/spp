<?php 
$item = null;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nis = $_POST['nis'];

    // Menggunakan prepared statement untuk mencegah SQL Injection
    $stmt = $mysqli->prepare("SELECT * FROM siswa JOIN kelas ON siswa.id_kelas = kelas.id_kelas WHERE nis = ?");
    $stmt->bind_param("s", $nis);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $item = $result->fetch_assoc();
    } else {
        echo "
            <script>
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'NIS tidak ditemukan!',
                    showConfirmButton: false,
                    timer: 1500
                }).then(function() {
                    window.location.href = '?bayar=add_bayar';
                });
            </script>";
    }
    $stmt->close();
}
?>

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
                        <form action="" method="post">
                            <div class="form-group">
                                <label for="nis">Masukkan NIS siswa</label>
                                <input type="text" name="nis" id="nis" class="form-control" required>
                                <br>
                                <input type="submit" value="Submit" class="btn btn-info float-right">
                            </div>
                        </form>
                    </div>

                    <?php if ($item): ?>
                        <div class="col-md-6" style="margin: 0 15rem;">
                            <div class="card-body">
                                <div class="card card-widget widget-user">
                                    <div class="widget-user-header" style="background: url('../../template/dist/img/bg.png');">
                                        <h4 class="text-right"><?php echo htmlspecialchars($item['nama_siswa']); ?></h4>
                                        <h4 class="text-right"><?php echo htmlspecialchars($item['kelas']) . ' ' . htmlspecialchars($item['kompetisi_keahlian']) . ' ' . htmlspecialchars($item['indeks']); ?></h4>
                                    </div>
                                    <div class="widget-user-image">
                                        <img src="../../template/dist/img/upload/<?php echo htmlspecialchars($item['foto']); ?>" alt="Avatar" class="img-circle" style="max-width: 80px;">
                                    </div>
                                    <div class="card-footer">
                                        <div class="row">
                                            <div class="col-sm-4 border-right border-left border-bottom border-top">
                                                <div class="description-block">
                                                    <span class="description-text">NIS</span>
                                                    <h5 class="description-header">
                                                        <?php echo htmlspecialchars($item['nis']); ?>
                                                    </h5>
                                                </div>
                                            </div>
                                            <div class="col-sm-4 border-right border-bottom border-top">
                                                <div class="description-block">
                                                    <span class="description-text">Alamat</span>
                                                    <h5 class="description-header">
                                                        <?php echo htmlspecialchars($item["alamat"]); ?>
                                                    </h5>
                                                </div>
                                            </div>
                                            <div class="col-sm-4 border-right border-bottom border-top">
                                                <div class="description-block">
                                                    <span class="description-text">No Telepon</span>
                                                    <h5 class="description-header">
                                                        <?php echo htmlspecialchars($item['no_telp']); ?>
                                                    </h5>
                                                </div>
                                            </div>
                                        </div>
                                        <br>
                                        <button class="btn btn-info float-right" data-toggle="modal" data-target="#modal-bayar-<?php echo htmlspecialchars($item['id_siswa']); ?>">
                                            <i class="fas fa-wallet"></i> Bayar
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <table id="bayar" class="table table-bordered table-hover">
                                <thead class="bg-navy">
                                    <tr align="center">
                                        <th>No</th>
                                        <th>Nama Siswa</th>
                                        <th>Kelas</th>
                                        <th>Pembayaran</th>
                                        <th>Tanggal Bayar</th>
                                        <th>Jumlah Bayar</th>
                                        <th>Kembalian</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    // Menggunakan prepared statement untuk query pembayaran berdasarkan NIS
                                    $stmt_bayar = $mysqli->prepare("
                                        SELECT * FROM bayar
                                            JOIN user ON bayar.id_user = user.id_user
                                            JOIN siswa ON bayar.id_siswa = siswa.id_siswa
                                            JOIN kelas ON bayar.id_kelas = kelas.id_kelas
                                            JOIN spp ON bayar.id_spp = spp.id_spp
                                        WHERE siswa.nis = ?
                                    ");
                                    $stmt_bayar->bind_param("s", $nis);
                                    $stmt_bayar->execute();
                                    $result_bayar = $stmt_bayar->get_result();

                                    $no = 0;

                                    while ($data = $result_bayar->fetch_assoc()) {
                                        $a = $data['nominal'];
                                        $b = $data['jmlh_bayar'];
                                        $kembalian = $a - $b;
                                        $no++;
                                    ?>
                                    <tr align="center">
                                        <td><?php echo $no; ?></td>
                                        <td align="justify"><?php echo htmlspecialchars($data['nama_siswa']); ?></td>
                                        <td align="justify">
                                            <?php echo htmlspecialchars($data['kelas']); ?>
                                            <?php echo htmlspecialchars($data['kompetisi_keahlian']); ?>
                                            <?php echo htmlspecialchars($data['indeks']); ?>
                                        </td>
                                        <td align="justify"><?php echo htmlspecialchars($data['nama_pembayaran']); ?></td>
                                        <td><?php echo htmlspecialchars($data['tgl_bayar']); ?></td>
                                        <td>Rp. <?php echo number_format($data['nominal'], 2, '.', '.'); ?></td>
                                        <td>Rp. <?php echo number_format($kembalian, 2, '.', '.'); ?></td>
                                        <td>
                                            <a href="?bayar=control/print_bukti&id_bayar=<?php echo htmlspecialchars($data['id_bayar']); ?>" class="btn btn-primary">
                                                <i class="fas fa-print"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    <?php 
                                    }
                                    $stmt_bayar->close();
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>

<?php

$siswa = $mysqli->query(" SELECT * FROM siswa, kelas WHERE siswa.id_kelas=kelas.id_kelas");
    
while ($data = mysqli_fetch_array($siswa)) {
?>

<div class="modal fade" id="modal-bayar-<?php echo htmlspecialchars($data['id_siswa']); ?>">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Pembayaran</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <form action="?bayar=control/bayar" method="post" enctype="multipart/form-data">

                    <div class="form-group">
                        <img src="../../template/dist/img/upload/<?php echo $data['foto']?>" alt="Foto siswa" style="margin: 5px 11rem;" width="90">
                        <p style="margin: 0 12.5rem;"><?php echo $data['nama_siswa'] ?></p>
                        <p style="margin: 0 11rem;"><?php echo $data['kelas'] ?> <?php echo $data['kompetisi_keahlian'] ?> <?php echo $data['indeks'] ?></p>
                    </div>

                    <input type="hidden" name="id_user" id="id_user" class="form-control" readonly value="<?php echo htmlspecialchars($_SESSION['id_user']); ?>">
                    <input type="hidden" name="id_siswa" id="id_siswa" class="form-control" value="<?php echo htmlspecialchars($data['id_siswa']); ?>" readonly>
                    <input type="hidden" name="id_kelas" id="id_kelas" class="form-control" value="<?php echo htmlspecialchars($data['id_kelas']); ?>" readonly>

                    <div class="form-group">
                        <label for="tgl_bayar">Tanggal bayar</label>
                        <input type="date" name="tgl_bayar" id="tgl_bayar" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="id_spp">Pembayaran</label>
                        <select name="id_spp" id="id_spp" class="form-control" required>
                            <option value="" disabled selected>Pilih Pembayaran</option>
                            <option value="" disabled>=======================================================</option>
                            <?php
                            $spp = $mysqli->query("SELECT * FROM spp ORDER BY id_spp");
                            while ($s = mysqli_fetch_array($spp)) {
                            ?>
                                <option value="<?php echo htmlspecialchars($s['id_spp']); ?>">
                                    <?php echo htmlspecialchars($s['nama_pembayaran']); ?> | Rp. <?php echo number_format($s['nominal'], 2, '.', '.'); ?>
                                </option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="bln_dibyr">Bulan dibayar</label>
                        <select name="bln_bayar" id="bln_bayar" class="form-control" required>
                            <option value="" disabled selected>Pilih Bulan</option>
                            <option value="" disabled>=======================================================</option>
                            <option value="Januari">Januari</option>
                            <option value="Februari">Februari</option>
                            <option value="Maret">Maret</option>
                            <option value="April">April</option>
                            <option value="Mei">Mei</option>
                            <option value="Juni">Juni</option>
                            <option value="Juli">Juli</option>
                            <option value="Agustus">Agustus</option>
                            <option value="September">September</option>
                            <option value="Oktober">Oktober</option>
                            <option value="November">November</option>
                            <option value="Desember">Desember</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="thn_bayar">Tahun bayar</label>
                        <input type="text" name="thn_bayar" id="thn_bayar" class="form-control" placeholder="Masukan tahun pembayaran" required>
                    </div>

                    <div class="form-group">
                        <label for="jmlh_bayar">Nominal bayar</label>
                        <input type="number" name="jmlh_bayar" id="jmlh_bayar" class="form-control" placeholder="Masukan Nominal pembayaran" required>
                    </div>

                    <div class="modal-footer">
                        <input type="reset" value="Reset" class="btn btn-secondary">
                        <input type="submit" value="Submit" class="btn btn-primary">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php }?>

<?php 
include "controller/notif.php";
?>