<?php 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['id_guru']) && isset($_POST['nama_guru']) && isset($_POST['nig']) && isset($_POST['alamat']) && isset($_POST['jk']) && isset($_POST['mapel']) && isset ($_POST['no_hp'])) {

        $id_guru    = $_POST['id_guru'];
        $nama_guru  = $_POST['nama_guru'];
        $nig        = $_POST['nig'];
        $alamat     = $_POST['alamat'];
        $jk         = $_POST['jk'];
        $mapel      = $_POST['mapel'];
        $no_hp      = $_POST['no_hp'];

        $stmt = $mysqli->prepare("INSERT INTO guru(id_guru, nama_guru, nig, alamat, jk, mapel, no_hp) VALUES(?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssss", $id_guru, $nama_guru, $nig, $alamat, $jk, $mapel, $no_hp);
        
        if ($stmt->execute()) {
            echo "
                <script>
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil',
                        text: 'Guru berhasil disimpan!',
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
                    text: 'Guru gagal disimpan!',
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
        // Jika salah satu atau lebih variabel POST tidak tersedia
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