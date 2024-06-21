<?php 
if (isset($_GET['id_siswa']) && is_numeric($_GET['id_siswa'])) {
    $id_siswa = $_GET['id_siswa'];

    // Mengambil nama file foto sebelum menghapus data siswa
    $stmt_select = $mysqli->prepare("SELECT foto FROM siswa WHERE id_siswa = ?");
    $stmt_select->bind_param("i", $id_siswa);
    $stmt_select->execute();
    $stmt_select->bind_result($foto);
    $stmt_select->fetch();
    $stmt_select->close();

    // Menghapus data siswa
    $stmt_delete = $mysqli->prepare("DELETE FROM siswa WHERE id_siswa = ?");
    $stmt_delete->bind_param("i", $id_siswa);

    if ($stmt_delete->execute()) {
        // Menghapus file foto jika data siswa berhasil dihapus
        $foto_path = "../../template/dist/img/upload/" . $foto;
        if (file_exists($foto_path)) {
            unlink($foto_path);
        }

        echo '
        <script>
            swal.fire({
                icon: "Success",
                title: "Berhasil",
                text: "Siswa telah berhasil dihapus!",
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "?siswa=data_siswa";
                }
        });
        </script>';
    } else {
        echo '
        <script>
            Swal.fire({
                icon: "error",
                title: "Oops...",
                text: "Siswa gagal dihapus",
            });
        </script>
        ';
    }

    $stmt_delete->close();
}
?>


<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            Data Siswa | 
                            <button class="btn btn-info" data-toggle="modal" data-target="#modal-add">
                                <i class="fas fa-plus"></i>
                            </button>
                        </h3>
                        <a href="?siswa=control/lap_siswa" class="float-right btn btn-info">
                            <i class="fas fa-file-download"></i>
                        </a>
                    </div>

                    <div class="card-body">
                        <table id="siswa" class="table table-bordered table-hover">
                            <thead class="bg-navy">
                                <tr align="center">
                                    <th>No</th>
                                    <th>Nis</th>
                                    <th style="width: 150px; max-width: 150px;">Nama Siswa</th>
                                    <th style="width: 125px; max-width: 125px;">Kelas</th>
                                    <th>No Telp</th>
                                    <th>Jenis Kelamin</th>
                                    <th>Foto</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php 
                                    $siswa = $mysqli->query("
                                    SELECT * FROM siswa
                                    join kelas ON siswa.id_kelas = kelas.id_kelas");

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
                                        <td><?php echo $data ['no_telp'] ?></td>
                                        <td><?php echo $data ['jk'] ?></td>
                                        <td align="center">
                                            <img src="../../template/dist/img/upload/<?php echo $data['foto']?>" alt="Foto siswa" width="90">
                                        </td>
                                        <td align="center">

                                            <button class="btn btn-info" data-toggle="modal" data-target="#modal-bayar-<?php echo $data['id_siswa'] ?>">
                                                <i class="fas fa-wallet"></i>
                                            </button> 

                                            <button class="btn btn-warning" data-toggle="modal" data-target="#modal-edit-<?php echo $data['id_siswa'] ?>">
                                                <i class="fas fa-edit"></i>
                                            </button> 

                                            <button class="btn btn-danger" onclick="deleteSiswa(<?php echo $data ['id_siswa'] ?>)">
                                                <i class="fas fa-trash"></i>
                                            </button>
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

<?php 
    $siswa = $mysqli->query("
    SELECT * FROM siswa
    join kelas ON siswa.id_kelas = kelas.id_kelas");
    
    while ($data =  mysqli_fetch_array($siswa)) {
?>
<div class="modal fade" id="modal-edit-<?php echo $data['id_siswa']?>">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Edit siswa</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <form action="?siswa=control/update_siswa" method="post" enctype="multipart/form-data">
                    
                    <div class="form-group">
                        <label for="id_siswa">ID Siswa <span class="text-danger">*</span></label>
                        <input type="text" name="id_siswa" id="id_siswa" class="form-control" value="<?php echo $data['id_siswa']; ?>" readonly>
                    </div>

                    <div class="form-group">
                        <label for="nis">NIS <span class="text-danger">*</span></label>
                        <input type="number" name="nis" id="nis" class="form-control" value="<?php echo $data['nis']; ?>" placeholder="Masukkan NIS" required>
                    </div>

                    <div class="form-group">
                        <label for="nama_siswa">Nama Siswa <span class="text-danger">*</span></label>
                        <input type="text" name="nama_siswa" id="nama_siswa" class="form-control" value="<?php echo $data['nama_siswa']; ?>" placeholder="Masukkan nama siswa" required>
                    </div>

                    <div class="form-group">
                        <label for="id_kelas">Kelas <span class="text-danger">*</span></label>
                        <select name="id_kelas" id="id_kelas" class="form-control" required>
                            <option value="" disabled>Pilih Kelas</option>
                            <option value="" disabled>=======================================================</option>
                            <option option value="<?php echo $data['id_kelas']; ?>" selected>
                                <?php echo $data['kelas'] . ' ' . $data['kompetisi_keahlian'] . ' ' . $data['indeks']; ?>
                            </option>
                            <option value="" disabled>=======================================================</option>
                            <?php 
                                $kelas = $mysqli->query("SELECT * FROM kelas ORDER BY id_kelas");
                                while ($k = mysqli_fetch_array($kelas)) {
                            ?>
                                <option value="<?php echo $k['id_kelas']; ?>">
                                    <?php echo $k['kelas'] . ' ' . $k['kompetisi_keahlian'] . ' ' . $k['indeks']; ?>
                                </option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="alamat">Alamat <span class="text-danger">*</span></label>
                        <input type="text" name="alamat" id="alamat" class="form-control" value="<?php echo $data['alamat']; ?>" placeholder="Masukkan alamat" required>
                    </div>

                    <div class="form-group">
                        <label for="no_telp">Nomor Telepon <span class="text-danger">*</span></label>
                        <input type="text" name="no_telp" id="no_telp" class="form-control" value="<?php echo $data['no_telp']; ?>" placeholder="Masukkan nomor telepon" required>
                    </div>

                    <div class="form-group">
                        <label for="jk">Jenis Kelamin <span class="text-danger">*</span></label>
                        <select name="jk" id="jk" class="form-control" required>
                            <option value="" disabled>Pilih Jenis Kelamin</option>
                            <option value="Laki-Laki" <?php echo $data['jk'] == 'Laki-Laki' ? 'selected' : ''; ?>>Laki-Laki</option>
                            <option value="Perempuan" <?php echo $data['jk'] == 'Perempuan' ? 'selected' : ''; ?>>Perempuan</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="foto">Foto</label>
                        <br>
                        <input type="file" name="foto" id="foto" class="form-control">
                        <br>
                        <p class="text-info">Foto Sebelum di edit</p>
                        <img src="../../template/dist/img/upload/<?php echo $data['foto']; ?>" alt="Foto siswa sebelum di edit" width="150" style="margin-top: 10px;">
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

<div class="modal fade" id="modal-add">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Add Siswa</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="?siswa=control/add_siswa" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="id_siswa" id="id_siswa">

                    <div class="form-group">
                        <label for="nis">NIS <span class="text-danger">*</span></label>
                        <input type="number" name="nis" id="nis" class="form-control" placeholder="Masukan NIS" required>
                    </div>

                    <div class="form-group">
                        <label for="nama_siswa">Nama Siswa <span class="text-danger">*</span></label>
                        <input type="text" name="nama_siswa" id="nama_siswa" placeholder="Masukan nama siswa" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="id_kelas">Kelas <span class="text-danger">*</span></label>
                        <select name="id_kelas" id="id_kelas" class="form-control" required>
                            <option value="" disabled selected>PILIH WALI KELAS</option>
                            <option value="" disabled>=======================================================</option>

                            <?php 
                                $kelas = $mysqli->query("SELECT * FROM kelas ORDER BY id_kelas");
                                while ($data = mysqli_fetch_array($kelas)) {
                            ?>
                                <option value="<?php echo $data['id_kelas']?>">
                                    <?php echo $data['kelas'] ?> <?php echo $data['kompetisi_keahlian'] ?> <?php echo $data['indeks'] ?>
                                </option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="alamat">Alamat <span class="text-danger">*</span></label>
                        <input type="text" name="alamat" id="alamat" class="form-control" required placeholder="Masukan alamat">
                    </div>

                    <div class="form-group">
                        <label for="no_telp">Nomor Telepon <span class="text-danger">*</span></label>
                        <input type="text" name="no_telp" id="no_telp" class="form-control" required placeholder="Masukan nomor telepon">
                    </div>

                    <div class="form-group">
                        <label for="jk">Jenis Kelamin <span class="text-danger">*</span></label>
                        <select name="jk" id="jk" class="form-control" required>
                            <option value="" disabled selected>PILIH JENIS KELAMIN</option>
                            <option value="" disabled>=======================================================</option>
                            <option value="Laki-Laki">Laki-Laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="foto">Foto <span class="text-danger">*</span></label>
                        <input type="file" name="foto" id="foto" class="form-control" required>
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
                <form action="?pembayaran=control/add_bayar" method="post" enctype="multipart/form-data">

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