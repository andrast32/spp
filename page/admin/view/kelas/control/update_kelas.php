<?php 
if (isset($_POST['id_kelas'], $_POST['kelas'], $_POST['indeks'], $_POST['kompetisi_keahlian'], $_POST['id_guru'])) {

    $id_kelas           = $_POST['id_kelas'];
    $kelas              = $_POST['kelas'];
    $indeks             = $_POST['indeks'];
    $kompetisi_keahlian = $_POST['kompetisi_keahlian'];
    $id_guru            = $_POST['id_guru'];

    $stmt = $mysqli->prepare("UPDATE kelas SET kelas = ?, indeks = ?, kompetisi_keahlian = ?, id_guru = ? WHERE id_kelas = ?");
    $stmt->bind_param("sssss", $kelas, $indeks, $kompetisi_keahlian, $id_guru, $id_kelas);

    if ($stmt->execute()) {
        echo "
            <script>
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil',
                    text: 'Kelas berhasil diubah!',
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
                text: 'Kelas gagal diubah!',
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
// Jika tidak semua data diterima melalui metode POST
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
?>