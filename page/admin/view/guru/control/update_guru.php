<?php 
if (isset($_POST['id_guru'], $_POST['nama_guru'], $_POST['nig'], $_POST['alamat'], $_POST['jk'], $_POST['mapel'], $_POST['no_hp'])) {

    $id_guru    = $_POST['id_guru'];
    $nama_guru  = $_POST['nama_guru'];
    $nig        = $_POST['nig'];
    $alamat     = $_POST['alamat'];
    $jk         = $_POST['jk'];
    $mapel      = $_POST['mapel'];
    $no_hp      = $_POST['no_hp'];

    $stmt = $mysqli->prepare("UPDATE guru SET nama_guru = ?, nig = ?, alamat = ?, jk = ?, mapel = ?, no_hp =? WHERE id_guru = ?");

    $stmt->bind_param("sssssss", $nama_guru, $nig, $alamat, $jk, $mapel, $no_hp, $id_guru);

    if ($stmt->execute()) {
        echo "
            <script>
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil',
                    text: 'Guru berhasil diubah!',
                    showConfirmButton: false,
                    timer: 1500
                }).then(function() {
                    window.location.href = '?guru=data_guru';
                });
            </script>";
    } else {
        // Jika terjadi kesalahan saat eksekusi query
        echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Guru gagal diubah!',
                showConfirmButton: false,
                timer: 1500
            }).then(function() {
                window.location.href = '?guru=data_guru';
            });
        </script>";
    }
    // Tutup statement
    $stmt->close();
} else {
// Jika tidak semua data diterima melalui metode POST
echo "<script>
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Data tidak lengkap!',
            showConfirmButton: false,
                timer: 1500
            }).then(function() {
                window.location.href = '?guru=data_guru';
        });
    </script>";
}
?>