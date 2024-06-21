<?php 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['id_spp']) && isset($_POST['nama_pembayaran']) && isset($_POST['nominal'])) {
        $id_spp             = $_POST['id_spp'];
        $nama_pembayaran    = $_POST['nama_pembayaran'];
        $nominal            = $_POST['nominal'];

        $stmt = $mysqli->prepare("INSERT INTO spp(id_spp, nama_pembayaran, nominal) VALUES(?, ?, ?)");
        $stmt->bind_param("sss", $id_spp, $nama_pembayaran, $nominal);

        if ($stmt->execute()) {
            echo "
                <script>
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil',
                        text: 'SPP berhasil disimpan!',
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
                    text: 'SPP gagal disimpan!',
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
        // Jika salah satu atau lebih variabel POST tidak tersedia
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
} else {
    // Jika tidak semua data diterima melalui metode POST
    echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Data tidak lengkap!',
            });
        </script>";
}
?>