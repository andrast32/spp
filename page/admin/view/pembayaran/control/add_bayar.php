<?php 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['id_user']) && isset($_POST['id_siswa']) && isset($_POST['id_kelas']) && isset($_POST['tgl_bayar']) && isset($_POST['id_spp']) && isset($_POST['bln_bayar']) && isset($_POST['thn_bayar']) && isset($_POST['jmlh_bayar'])) {

        $id_user        = $_POST ['id_user'];
        $id_siswa       = $_POST ['id_siswa'];
        $id_kelas       = $_POST ['id_kelas'];
        $tgl_bayar      = $_POST ['tgl_bayar'];
        $id_spp         = $_POST ['id_spp'];
        $bln_bayar      = $_POST ['bln_bayar'];
        $thn_bayar      = $_POST ['thn_bayar'];
        $jmlh_bayar       = $_POST ['jmlh_bayar'];

        $stmt = $mysqli->prepare("INSERT INTO bayar(id_user, id_siswa, id_kelas, tgl_bayar, id_spp, bln_bayar, thn_bayar, jmlh_bayar) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssssss", $id_user, $id_siswa, $id_kelas, $tgl_bayar, $id_spp, $bln_bayar, $thn_bayar, $jmlh_bayar);

        if ($stmt->execute()) {
            echo "
                <script>
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil',
                        text: 'Pembayaran berhasil disimpan!',
                        showConfirmButton: false,
                        timer: 1500
                    }).then(function() {
                        window.location.href = '?pembayaran=data_pembayaran';
                    });
                </script>";
        } else {
            // Jika terjadi kesalahan saat eksekusi query
            echo "<script>
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Pembayaran gagal disimpan!',
                    showConfirmButton: false,
                    timer: 1500
                }).then(function() {
                    window.location.href = '?siswa=data_siswa';
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
                window.location.href = '?siswa=data_siswa';
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