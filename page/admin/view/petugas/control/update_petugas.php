<?php 
if (isset($_POST['id_user'], $_POST['nama_user'], $_POST['level'])) {

    $id_user = $_POST['id_user'];
    $nama_user = $_POST['nama_user'];
    $level = $_POST['level'];

    $stmt = $mysqli->prepare("UPDATE user SET nama_user = ?, level = ? WHERE id_user = ?");

    $stmt->bind_param("sss", $nama_user, $level, $id_user);

    if ($stmt->execute()) {
        echo "
            <script>
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil',
                    text: 'Petugas berhasil diubah!',
                    showConfirmButton: false,
                    timer: 1500
                }).then(function() {
                    window.location.href = '?petugas=data_petugas';
                });
            </script>";
    } else {
        // Jika terjadi kesalahan saat eksekusi query
        echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Petugas gagal diubah!',
                showConfirmButton: false,
                timer: 1500
            }).then(function() {
                window.location.href = '?petugas=data_petugas';
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
                window.location.href = '?petugas=data_petugas';
        });
    </script>";
}
?>