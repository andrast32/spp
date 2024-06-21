<?php 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['id_user']) && isset($_POST['username']) && isset($_POST['password']) && isset($_POST['nama_user']) && isset($_POST['level'])) {
        $id_user = $_POST['id_user'];
        $username = $_POST['username'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $nama_user = $_POST['nama_user'];
        $level = $_POST['level'];

        $stmt = $mysqli->prepare("INSERT INTO user(id_user, username, password, nama_user, level) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $id_user, $username, $password, $nama_user, $level);

        if ($stmt->execute()) {
            echo "
                <script>
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil',
                        text: 'Petugas berhasil disimpan!',
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
                    text: 'Petugas gagal disimpan!',
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
        // Jika salah satu atau lebih variabel POST tidak tersedia
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