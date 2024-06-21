<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['username']) && isset($_POST['current_password']) && isset($_POST['password'])) {
        
        $username = $_POST['username'];
        $current_password = $_POST['current_password'];
        $password = $_POST['password'];

        try {
            // Buat koneksi PDO
            $pdo = new PDO('mysql:host=localhost; dbname=db_spp', 'root', '');
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Cek apakah password saat ini benar
            $stmt = $pdo->prepare("SELECT password FROM user WHERE username = ?");
            $stmt->execute([$username]);
            $stored_password = $stmt->fetchColumn();

            if ($stored_password === false || !password_verify($current_password, $stored_password)) {
                echo "<script>
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Password saat ini salah!',
                        showConfirmButton: false,
                        timer: 1500
                    }).then(function() {
                        window.location.href = 'index.php';
                    });
                </script>";
            } else {
                // Hash password baru
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);

                // Update password
                $stmt = $pdo->prepare("UPDATE user SET password = ? WHERE username = ?");
                if ($stmt->execute([$hashed_password, $username])) {
                    echo "<script>
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: 'Password berhasil diubah!',
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
                            text: 'Password gagal diubah!',
                            showConfirmButton: false,
                            timer: 1500
                        }).then(function() {
                            window.location.href = 'index.php';
                        });
                    </script>";
                }
            }
        } catch (PDOException $e) {
            echo "<script>
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Terjadi kesalahan pada server!',
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
