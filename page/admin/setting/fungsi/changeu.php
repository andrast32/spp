<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['current_username']) && isset($_POST['new_username'])) {
        
        $current_username = $_POST['current_username'];
        $new_username = $_POST['new_username'];

        $host = "localhost";
        $username = "root";
        $password = "";
        $database = "db_spp";

        $mysqli = new mysqli($host, $username, $password, $database);

        if ($mysqli->connect_error) {
            die("Koneksi Ke database gagal :" . $mysqli->connect_error);
        }

        // Cek apakah username baru sudah ada
        $stmt = $mysqli->prepare("SELECT * FROM user WHERE username = ?");
        $stmt->bind_param("s", $new_username);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            echo "<script>
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Username baru sudah digunakan!',
                    showConfirmButton: false,
                    timer: 1500
                }).then(function() {
                    window.location.href = 'change_user.php';
                });
            </script>";
        } else {
            // Update username
            $stmt = $mysqli->prepare("UPDATE user SET username = ? WHERE username = ?");
            $stmt->bind_param("ss", $new_username, $current_username);

            if ($stmt->execute()) {
                echo "<script>
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil',
                        text: 'Username berhasil diubah!',
                        showConfirmButton: false,
                        timer: 1500
                    }).then(function() {
                        window.location.href = 'index.php';
                    });
                </script>";
            } else {
                echo "<script>
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Username gagal diubah!',
                        showConfirmButton: false,
                        timer: 1500
                    }).then(function() {
                        window.location.href = 'index.php';
                    });
                </script>";
            }
        }
        $stmt->close();
        $mysqli->close();
    } else {
        echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Data tidak lengkap!',
                showConfirmButton: false,
                timer: 1500
            }).then(function() {
                window.location.href = 'index.php';
            });
        </script>";
    }
} else {
    echo "<script>
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Metode pengiriman data salah!',
        });
    </script>";
}
?>
