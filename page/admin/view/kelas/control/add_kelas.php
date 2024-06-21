<?php 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['id_kelas']) && isset($_POST['kelas']) && isset($_POST['indeks']) && isset($_POST['kompetisi_keahlian']) && isset ($_POST['id_guru'])) {
        
        $id_kelas           = $_POST['id_kelas'];
        $kelas              = $_POST['kelas'];
        $indeks             = $_POST['indeks'];
        $kompetisi_keahlian = $_POST['kompetisi_keahlian'];
        $id_guru            = $_POST['id_guru'];

        $stmt = $mysqli->prepare("INSERT INTO kelas(id_kelas, kelas, indeks, kompetisi_keahlian, id_guru) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $id_kelas, $kelas, $indeks, $kompetisi_keahlian, $id_guru);

        if ($stmt->execute()) {
            echo "
                <script>
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil',
                        text: 'Kelas berhasil disimpan!',
                        showConfirmButton: false,
                        timer: 1500
                    }).then(function() {
                        window.location.href = '?kelas=data_kelas';
                    });
                </script>";
        } else {
            // Jika terjadi kesalahan saat eksekusi query
            echo "<script>
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Kelas gagal disimpan!',
                    showConfirmButton: false,
                    timer: 1500
                }).then(function() {
                    window.location.href = '?kelas=data_kelas';
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
                window.location.href = '?kelas=data_kelas';
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