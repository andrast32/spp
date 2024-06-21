<?php 
if (isset($_GET['id_guru']) && is_numeric($_GET['id_guru'])) {
    $id_guru = $_GET['id_guru'];

    $stmt = $mysqli->prepare("DELETE FROM guru WHERE id_guru = ?");
    $stmt->bind_param("i", $id_guru);

    if ($stmt->execute()) {
        echo '
        <script>
            swal.fire({
                icon: "Success",
                title: "Berhasil",
                text: "Guru telah berhasil di hapus!",
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "?guru=data_guru";
                }
        });
        </script>';
    } else {
        echo '
        <script>
            Swal.fire({
                icon: "error",
                title: "Oops...",
                text: "Guru gagal dihapus",
            });
        </script>
        ';
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
                        <h3 class="card-title">Data Guru | 
                            <button class="btn btn-info" data-toggle="modal" data-target="#modal-add">
                                <i class="fas fa-plus"></i>
                            </button>
                        </h3>
                        <a href="?guru=control/lap_guru" class="float-right btn btn-info">
                            <i class="fas fa-file-download"></i>
                        </a>
                    </div>

                    <div class="card-body">
                        <table id="guru" class="table table-bordered table-hover">
                            <thead class="bg-navy">
                                <tr align="center">
                                    <th>No</th>
                                    <th>Nama Guru</th>
                                    <th>Nomor Induk Guru</th>
                                    <th style="width:125px; max-width: 125px;">Alamat</th>
                                    <th>Jenis Kelamin</th>
                                    <th>Mapel</th>
                                    <th>No telp</th>
                                    <th>Action</th>
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
                                        <td align="center">
                                            <button class="btn btn-warning" data-toggle="modal" data-target="#modal-edit-<?php echo $data['id_guru']; ?>">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button class="btn btn-danger" onclick="deleteGuru(<?php echo $data['id_guru']; ?>)">
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

<!-- modal edit guru start -->
<?php 
$guru = $mysqli->query("SELECT * FROM guru ORDER BY id_guru");
while ($data = mysqli_fetch_array($guru)) {
?>
    <div class="modal fade" id="modal-edit-<?php echo $data['id_guru'];?>">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Edit data guru</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="?guru=control/update_guru" method="post">
                        
                        <div class="form-group">
                            <label for="id_user">Id Guru <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="id_guru" id="id_guru" value="<?php echo $data['id_guru']; ?>" readonly required>
                        </div>
                        
                        <div class="form-group">
                            <label for="nama_guru">Nama Guru <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="nama_guru" id="nama_guru" value="<?php echo $data['nama_guru']; ?>" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="nig">Nomor Induk Guru <span class="text-danger">*</span></label>
                            <input type="number" class="form-control" name="nig" id="nig" value="<?php echo $data['nig']; ?>" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="nig">Alamat <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="alamat" id="alamat" value="<?php echo $data['alamat']; ?>" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="jk">Jenis Kelamin <span class="text-danger">*</span></label>
                            <select name="jk" id="jk" class="form-control" required>
                                <option value="" disabled>PILIH JENIS KELAMIN</option>
                                <option value="" disabled>=======================================================</option>
                                <option value="Laki-Laki" <?php if ($data['jk'] == 'Laki-Laki') echo 'Selected' ?>>Laki Laki</option>
                                <option value="Perempuan" <?php if ($data['jk'] == 'Perempuan') echo 'Selected' ?>>Perempuan</option>
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label for="mapel">Guru Mapel <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="mapel" id="mapel" value="<?php echo $data['mapel']; ?>" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="no_hp">Nomor Telpon <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="no_hp" id="no_hp" value="<?php echo $data['no_hp']; ?>" required>
                        </div>

                        <div class="modal-footer">
                            <input type="reset" value="Reset" class="btn btn-primary float-right">
                            <input type="submit" value="Submit" class="btn btn-warning float-right">
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
<?php }?>
<!-- modal edit guru end -->

<!-- modall add guru start -->
<div class="modal add" id="modal-add">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Tambah data guru</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="?guru=control/add_guru" method="post">
                        
                        <div class="form-group">
                            <input type="hidden" class="form-control" name="id_guru" id="id_guru" readonly>
                        </div>
                        
                        <div class="form-group">
                            <label for="nama_guru">Nama Guru <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="nama_guru" id="nama_guru" placeholder="Masukan nama guru" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="nig">Nomor Induk Guru <span class="text-danger">*</span></label>
                            <input type="number" class="form-control" name="nig" id="nig" placeholder="Masukan nomor induk guru" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="nig">Alamat <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="alamat" id="alamat" placeholder="Masukan alamat" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="jk">Jenis Kelamin <span class="text-danger">*</span></label>
                            <select name="jk" id="jk" class="form-control" required>
                                <option value="" disabled selected>PILIH JENIS KELAMIN</option>
                                <option value="" disabled>=======================================================</option>
                                <option value="Laki-Laki">Laki Laki</option>
                                <option value="Perempuan">Perempuan</option>
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label for="mapel">Guru Mapel <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="mapel" id="mapel" placeholder="Masukan guru mata pelajaran" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="no_hp">Nomor Telpon <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="no_hp" id="no_hp" placeholder="Masukan nomor telpon" required>
                        </div>

                        <div class="modal-footer">
                            <input type="reset" value="Reset" class="btn btn-primary float-right">
                            <input type="submit" value="Submit" class="btn btn-warning float-right">
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
<!-- modall add guru end -->

<?php 
include "controller/notif.php";
?>
