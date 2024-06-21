<?php 
if (isset($_POST['id_spp'], $_POST['nama_pembayaran'], $_POST['nominal'])) {
    $id_spp             = $_POST['id_spp'];
    $nama_pembayaran    = $_POST['nama_pembayaran'];
    $nominal            = $_POST['nominal'];

    $stmt = $mysqli->prepare("UPDATE spp SET nama_pembayaran = ?, nominal = ? WHERE id_spp = ?");
    $stmt->bind_param("sss", $nama_pembayaran, $nominal, $id_spp);

    if ($stmt->execute()) {
        echo "
            <script>
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil',
                    text: 'SPP berhasil diubah!',
                    showConfirmButton: false,
                    timer: 1500
                }).then(function() {
                    window.location.href = '?spp=data_spp';
                });
            </script>";
    } else {
        // Jika terjadi kesalahan saat eksekusi query
        echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'SPP gagal diubah!',
                showConfirmButton: false,
                timer: 1500
            }).then(function() {
                window.location.href = '?spp=data_spp';
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
                window.location.href = '?spp=data_spp';
        });
    </script>";
}
?>