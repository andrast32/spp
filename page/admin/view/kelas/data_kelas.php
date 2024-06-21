<?php 
if (isset($_GET['id_kelas']) && is_numeric($_GET['id_kelas'])) {
    $id_kelas = $_GET['id_kelas'];

    $stmt = $mysqli->prepare("DELETE FROM kelas WHERE id_kelas = ?");
    $stmt->bind_param("i", $id_kelas);

    if ($stmt->execute()) {
        echo '
        <script>
            swal.fire({
                icon: "Success",
                title: "Berhasil",
                text: "Kelas telah berhasil di hapus!",
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "?kelas=data_kelas";
                }
        });
        </script>';
    } else {
        echo '
        <script>
            Swal.fire({
                icon: "error",
                title: "Oops...",
                text: "Kelas gagal dihapus",
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
                        <h3 class="card-title">
                            Data Kelas | 
                            <button class="btn btn-info" data-toggle="modal" data-target="#modal-add">
                                <i class="fas fa-plus"></i>
                            </button>
                        </h3>
                    </div>

                    <div class="card-body">
                        <table id="kelas" class="table table-bordered table-hover">
                            <thead class="bg-navy">
                                <tr align="center">
                                    <th>No</th>
                                    <th>Kelas</th>
                                    <th>Kompetensi keahlian</th>
                                    <th>Indeks kelas</th>
                                    <th>Wali kelas</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php 
                                    $kelas = $mysqli->query("SELECT * FROM kelas,guru WHERE kelas.id_guru=guru.id_guru");

                                    $no = 0;
                                    while ($data = mysqli_fetch_array($kelas)) {
                                        $no++
                                ?>

                                    <tr align="center">
                                        <td><?php echo $no?></td>
                                        <td><?php echo $data['kelas']?></td>
                                        <td align="justify"><?php echo $data['kompetisi_keahlian']?></td>
                                        <td><?php echo $data['indeks']?></td>
                                        <td align="justify">
                                            <button class="btn" data-toggle="modal" data-target="#modal-tampil-<?php echo $data['id_guru']?>">
                                                <?php echo $data['nama_guru']?>
                                            </button>
                                        </td>
                                        <td>
                                            <button class="btn btn-warning" data-toggle="modal" data-target="#modal-edit-<?php echo $data['id_kelas'] ?>">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button class="btn btn-danger" onclick="deleteKelas(<?php echo $data['id_kelas']?>)">
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
    $kelas = $mysqli->query("SELECT * FROM kelas,guru WHERE kelas.id_guru=guru.id_guru");
    while ($data = mysqli_fetch_array($kelas)) {
?>

<div class="modal fade" id="modal-edit-<?php echo $data['id_kelas']?>">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Edit kelas</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-label="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="?kelas=control/update_kelas" method="post">

                    <div class="form-group">
                        <label for="id_kelas">Id kelas <span class="text-danger">*</span></label>
                        <input type="text" name="id_kelas" id="id_kelas" class="form-control" value="<?php echo $data['id_kelas']?>" readonly required>
                    </div>

                    <div class="form-group">
                        <label for="kelas">Kelas <span class="text-danger">*</span></label>
                        <input type="number" name="kelas" id="kelas" class="form-control" value="<?php echo $data['kelas']?>" required>
                    </div>

                    <div class="form-group">
                        <label for="kompetisi_keahlian">Kompetisi keahlian <span class="text-danger">*</span></label>
                        <select name="kompetisi_keahlian" id="kompetisi_keahlian" class="form-control" required>
                            <option value="" disabled>PILIH KOMPETISI KEAHLIAN</option>
                            <option value="" disabled>=======================================================</option>
                            <option value="Animasi" <?php if ($data['kompetisi_keahlian'] == 'Animasi') echo 'Selected'?> >Animasi</option>
                            <option value="Akuntansi" <?php if ($data['kompetisi_keahlian'] == 'Akuntansi') echo 'Selected'?> >Akuntansi</option>
                            <option value="Desain Komunikasi Visual" <?php if ($data['kompetisi_keahlian'] == 'Desain Komunikasi Visual') echo 'Selected'?> >Desain Komunikasi Visual</option>
                            <option value="Rekayasa Perangkat Lunak" <?php if ($data['kompetisi_keahlian'] == 'Rekayasa Perangkat Lunak') echo 'Selected'?> >Rekayasa Perangkat Lunak</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="indeks">Indeks kelas <span class="text-danger">*</span></label>
                        <select name="indeks" id="indeks" class="form-control" required>
                            <option value="" disabled>PILIH INDEKS KELAS</option>
                            <option value="" disabled>=======================================================</option>
                            <option value="A" <?php if ($data['indeks'] == 'A') echo 'Selected'?> >A</option>
                            <option value="B" <?php if ($data['indeks'] == 'B') echo 'Selected'?> >B</option>
                            <option value="C" <?php if ($data['indeks'] == 'C') echo 'Selected'?> >C</option>
                            <option value="D" <?php if ($data['indeks'] == 'D') echo 'Selected'?> >D</option>
                            <option value="E" <?php if ($data['indeks'] == 'E') echo 'Selected'?> >E</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="id_guru">Wali Kelas <span class="text-danger">*</span></label>
                        <select name="id_guru" id="id_guru" class="form-control" required>
                            <option value="" disabled>PILIH WALI KELAS</option>
                            <option value="" disabled>=======================================================</option>
                            <option value="" disabled class="bg-info"><?php echo $data['nama_guru']?></option>
                            <option value="" disabled>=======================================================</option>
                            <?php 
                                $guru = $mysqli->query("SELECT * FROM guru ORDER BY id_guru");
                                while ($data = mysqli_fetch_array($guru)) {
                                    ?>
                                <option value="<?php echo $data['id_guru']?>"><?php echo $data['nama_guru'] ?></option>
                            <?php }?>
                        </select>
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

<div class="modal fade" id="modal-add">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Add kelas</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-label="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="?kelas=control/add_kelas" method="post">

                    <div class="form-group">
                        <input type="hidden" name="id_kelas" id="id_kelas" class="form-control" placeholder="Masukan id kelas">
                    </div>

                    <div class="form-group">
                        <label for="kelas">Kelas <span class="text-danger">*</span></label>
                        <input type="number" name="kelas" id="kelas" class="form-control" placeholder="Masukan Kelas" required>
                    </div>

                    <div class="form-group">
                        <label for="kompetisi_keahlian">Kompetisi keahlian <span class="text-danger">*</span></label>
                        <select name="kompetisi_keahlian" id="kompetisi_keahlian" class="form-control" required>
                            <option value="" disabled selected>PILIH KOMPETISI KEAHLIAN</option>
                            <option value="" disabled>=======================================================</option>
                            <option value="Animasi" >Animasi</option>
                            <option value="Akuntansi">Akuntansi</option>
                            <option value="Desain Komunikasi Visual">Desain Komunikasi Visual</option>
                            <option value="Rekayasa Perangkat Lunak">Rekayasa Perangkat Lunak</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="indeks">Indeks kelas <span class="text-danger">*</span></label>
                        <select name="indeks" id="indeks" class="form-control" required>
                            <option value="" disabled selected>PILIH INDEKS KELAS</option>
                            <option value="" disabled>=======================================================</option>
                            <option value="A">A</option>
                            <option value="B">B</option>
                            <option value="C">C</option>
                            <option value="D">D</option>
                            <option value="E">E</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="id_guru">Wali Kelas <span class="text-danger">*</span></label>
                        <select name="id_guru" id="id_guru" class="form-control" required>
                            <option value="" disabled selected>PILIH WALI KELAS</option>
                            <option value="" disabled>=======================================================</option>
                            <?php 
                                $guru = $mysqli->query("SELECT * FROM guru ORDER BY id_guru");
                                while ($data = mysqli_fetch_array($guru)) {
                                    ?>
                                <option value="<?php echo $data['id_guru']?>"><?php echo $data['nama_guru'] ?></option>
                            <?php }?>
                        </select>
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

<?php 
    $guru = $mysqli->query("SELECT * FROM guru WHERE id_guru");
    while ($data = mysqli_fetch_array($guru)) {
?>

    <div class="modal fade" id="modal-tampil-<?php echo $data['id_guru']?>">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Wali Kelas</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="card card-widget widget-user">
                        <div class="widget-user-header" style="background: url('../../template/dist/img/bg.png');">
                            <h4 class="text-right"><?php echo $data['nama_guru'] ?></h4>
                            <h4 class="text-right"><?php echo $data['nig'] ?></h4>
                        </div>

                        <div class="widget-user-image">
                            <img src="../../template/dist/img/user.png" alt="Avatar" class="img-circle">
                        </div>

                        <div class="card-footer">
                            <div class="row">

                                <div class="col-sm-4 border-right">
                                    <div class="description-block">
                                        <span class="description-text">Guru</span>
                                        <h5 class="description-header">
                                            <?php echo $data ['mapel']?>
                                        </h5>
                                    </div>
                                </div>
                                
                                <div class="col-sm-4 border-right">
                                    <div class="description-block">
                                        <span class="description-text">Alamat</span>
                                        <h5 class="description-header">
                                            <?php echo $data['alamat']?>
                                        </h5>
                                    </div>
                                </div>

                                <div class="col-sm-4 border-right">
                                    <div class="description-block">
                                        <span class="description-text">No telpon</span>
                                        <h5 class="description-header">
                                            <?php echo $data['no_hp']?>
                                        </h5>
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>
            </div>
        </div>
    </div>
</div>

<?php }?>