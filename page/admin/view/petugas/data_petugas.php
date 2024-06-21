<?php 
if (isset($_GET['id_user']) && is_numeric($_GET['id_user'])) {
    $id_user = $_GET['id_user'];

    $stmt = $mysqli->prepare("DELETE FROM user WHERE id_user = ?");
    $stmt->bind_param("i", $id_user);

    if ($stmt->execute()) {
        echo '
        <script>
            swal.fire({
                icon: "Success",
                title: "Berhasil",
                text: "Petugas telah berhasil di hapus!",
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "?petugas=data_petugas";
                }
        });
        </script>';
    } else {
        echo '
        <script>
            Swal.fire({
                icon: "error",
                title: "Oops...",
                text: "Petugas gagal dihapus",
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
                            Data Petugas | 
                            <button class="btn btn-info" data-toggle="modal" data-target="#modal-add">
                                <i class="fas fa-plus"></i>
                            </button>
                        </h3>
                    </div>

                    <div class="card-body">
                        <table id="petugas" class="table table-bordered table-hover">
                            <thead class="bg-navy">
                                <tr align="center">
                                    <th>No</th>
                                    <th>Username</th>
                                    <th>Nama Petugas</th>
                                    <th>Level</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php 
                                $user = $mysqli->query("SELECT * FROM user ORDER BY id_user");

                                $no = 0;
                                while ($data = mysqli_fetch_array($user)) {
                                    $no++
                                ?>

                                    <tr>
                                        <td align="center"><?php echo $no; ?></td>
                                        <td><?php echo $data['username']; ?></td>
                                        <td><?php echo $data['nama_user']; ?></td>
                                        <td><?php echo $data['level']; ?></td>
                                        <td align="center">
                                            <button class="btn btn-warning" 
                                                data-toggle="modal" 
                                                data-target="#modal-edit-<?php echo $data['id_user']; ?>">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button class="btn btn-danger" 
                                                onclick="deletePetugas(<?php echo $data['id_user']; ?>)">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </td>
                                    </tr>

                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- modal edit start -->
<?php 
$user = $mysqli->query("SELECT * FROM user ORDER BY id_user");
while ($data = mysqli_fetch_array($user)) {
?>
<div class="modal fade" id="modal-edit-<?php echo $data['id_user'];?>">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Edit data petugas</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="?petugas=control/update_petugas" method="post">

                    <div class="form-group">
                        <label for="id_user">Id User</label>
                        <input class="form-control" type="text" name="id_user" id="id_user" value="<?php echo $data['id_user'];?>" readonly required>
                    </div>

                    <div class="form-group">
                        <label for="nama">Nama</label>
                        <input class="form-control" type="text" name="nama_user" id="nama_user" value="<?php echo $data['nama_user'];?>" required>
                    </div>

                    <div class="form-group">
                        <label for="lavel">Level</label>
                        <select name="level" id="level" class="form-control" required>
                            <option value="" disabled>PILIH LEVEL</option>
                            <option value="" disabled>=======================================================</option>
                            <option value="Admin" <?php if ($data['level'] == 'Admin') echo 'Selected'?> >Admin</option>
                            <option value="Petugas" <?php if ($data['level'] == 'Petugas') echo 'Selected'?> >Petugas</option>
                        </select>
                    </div>

                    <div class="modal-footer">
                        <input type="reset" class="btn btn-primary float-right" value="Reset">
                        <input type="submit" class="btn btn-warning float-right" value="Submit">
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
<?php } ?>
<!-- modal edit end -->

<!-- modal add data start -->
<div class="modal fade" id="modal-add">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Tambah Data Petugas</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="?petugas=control/add_petugas" method="post">

                    <div class="form-group">
                        <input class="form-control" type="hidden" name="id_user" id="id_user" placeholder="masukan id user" readonly>
                    </div>

                    <div class="form-group">
                        <label for="username">Username</label>
                        <input class="form-control" type="text" name="username" id="username" placeholder=" masukan Username">
                    </div>

                    <div class="form-group">
                        <label for="password">Password</label>
                        <input class="form-control" type="password" name="password" id="password" placeholder="Masukan Password">
                    </div>

                    <div class="form-group">
                        <label for="nama">Nama</label>
                        <input class="form-control" type="text" name="nama_user" id="nama_user" placeholder="Masukan Nama User">
                    </div>

                    <div class="form-group">
                        <label for="lavel">Level</label>
                        <select name="level" id="level" class="form-control">
                            <option value="">PILIH LEVEL</option>
                            <option value="">=======================================================</option>
                            <option value="Admin">Admin</option>
                            <option value="Petugas">Petugas</option>
                        </select>
                    </div>

                    <div class="modal-footer">
                        <input type="reset" class="btn btn-primary float-right" value="Reset">
                        <input type="submit" class="btn btn-warning float-right" value="Submit">
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
<!-- modal add data end -->

<?php 
include "controller/notif.php";
?>