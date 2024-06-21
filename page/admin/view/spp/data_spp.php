<?php 
if (isset($_GET['id_spp']) && is_numeric($_GET['id_spp'])) {
    $id_spp = $_GET['id_spp'];

    $stmt = $mysqli->prepare("DELETE FROM spp WHERE id_spp = ?");
    $stmt->bind_param("i", $id_spp);

    if ($stmt->execute()) {
        echo '
        <script>
            swal.fire({
                icon: "Success",
                title: "Berhasil",
                text: "Spp telah berhasil di hapus!",
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "?spp=data_spp";
                }
        });
        </script>';
    } else {
        echo '
        <script>
            Swal.fire({
                icon: "error",
                title: "Oops...",
                text: "Spp gagal dihapus",
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
                            Data SPP | 
                            <button class="btn btn-info" data-toggle="modal" data-target="#modal-add">
                                <i class="fas fa-plus"></i>
                            </button>
                        </h3>
                    </div>

                    <div class="card-body">
                        <table id="spp" class="table table-bordered table-hover">
                            <thead class="bg-navy">
                                <tr align="center">
                                    <th>No</th>
                                    <th>Nama Pembayaran</th>
                                    <th>Nominal</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php 
                                    $spp = $mysqli->query("SELECT * FROM spp ORDER BY id_spp");

                                    $no = 0;
                                    while ($data = mysqli_fetch_array($spp)) {
                                        $no++
                                ?>

                                    <tr>
                                        <td align="center"><?php echo $no ?></td>
                                        <td><?php echo $data['nama_pembayaran'] ?></td>
                                        <td>Rp. <?php echo number_format($data['nominal'], 2, '.', '.') ?></td>
                                        <td align="center">
                                            <button class="btn btn-warning" data-toggle="modal" data-target="#modal-edit-<?php echo $data['id_spp'] ?>">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button class="btn btn-danger" onclick="deleteSpp(<?php echo $data['id_spp']?>)">
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
$spp = $mysqli->query("SELECT * FROM spp ORDER BY id_spp");
while ($data = mysqli_fetch_array($spp)) {
?>
<div class="modal fade" id="modal-edit-<?php echo $data['id_spp']?>">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Edit data SPP</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="?spp=control/update_spp" method="post">

                <div class="form-group">
                    <label for="id_spp">Id SPP</label>
                    <input type="text" name="id_spp" id="id_spp" class="form-control" value="<?php echo $data['id_spp']?>" readonly required>
                </div>

                <div class="form-group">
                    <label for="nama_pembayaran">Nama Pembayaran</label>
                    <input type="text" name="nama_pembayaran" id="nama_pembayaran" class="form-control" value="<?php echo $data['nama_pembayaran']?>" required>
                </div>

                <div class="form-group">
                    <label for="nominal">Harga</label>
                    <input type="number" name="nominal" id="nominal" class="form-control" value="<?php echo $data['nominal']?>" required>
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

<div class="modal add" id="modal-add">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Tambah data SPP</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="?spp=control/add_spp" method="post">

                <div class="form-group">
                    <input type="hidden" name="id_spp" id="id_spp" class="form-control" placeholder="Tambah Id spp" readonly required>
                </div>

                <div class="form-group">
                    <label for="nama_pembayaran">Nama Pembayaran</label>
                    <input type="text" name="nama_pembayaran" id="nama_pembayaran" class="form-control" placeholder="Masukan nama pembayaran" required>
                </div>

                <div class="form-group">
                    <label for="nominal">Harga</label>
                    <input type="number" name="nominal" id="nominal" class="form-control" placeholder="Masukan Harga" required>
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
include "controller/notif.php"
?>