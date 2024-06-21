<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['id_siswa']) && isset($_POST['nis']) && isset($_POST['nama_siswa']) && isset($_POST['id_kelas']) && isset($_POST['alamat']) && isset($_POST['no_telp']) && isset($_POST['jk']) && isset($_FILES['foto'])) {

        $id_siswa       = $_POST['id_siswa'];
        $nis            = $_POST['nis'];
        $nama_siswa     = $_POST['nama_siswa'];
        $id_kelas       = $_POST['id_kelas'];
        $alamat         = $_POST['alamat'];
        $no_telp        = $_POST['no_telp'];
        $jk             = $_POST['jk'];
        $foto           = $_FILES['foto']['name'];
        $tempFoto       = $_FILES['foto']['tmp_name'];

        // Insert data siswa
        $stmt = $mysqli->prepare("INSERT INTO siswa(id_siswa, nis, nama_siswa, id_kelas, alamat, no_telp, jk, foto) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssssss", $id_siswa, $nis, $nama_siswa, $id_kelas, $alamat, $no_telp, $jk, $foto);

        if ($stmt->execute()) {
            $id_siswa = $mysqli->insert_id; // Mendapatkan ID siswa yang baru diinputkan

            $newFotoName = $id_siswa . '.' . pathinfo($foto, PATHINFO_EXTENSION);
            $target = "../../template/dist/img/upload/" . $newFotoName;

            if (move_uploaded_file($tempFoto, $target)) {
                // Update nama file foto di database
                $stmt = $mysqli->prepare("UPDATE siswa SET foto = ? WHERE id_siswa = ?");
                $stmt->bind_param("si", $newFotoName, $id_siswa);
                $stmt->execute();

                echo "
                <script>
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil',
                        text: 'Siswa berhasil disimpan!',
                        showConfirmButton: false,
                        timer: 1500
                    }).then(function() {
                        window.location.href = '?siswa=data_siswa';
                    });
                </script>";
            } else {
                echo "<script>
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Gagal mengunggah foto!',
                        showConfirmButton: false,
                        timer: 1500
                    }).then(function() {
                        window.location.href = '?siswa=data_siswa';
                    });
                </script>";
            }
        } else {
            echo "<script>
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Siswa gagal disimpan!',
                    showConfirmButton: false,
                    timer: 1500
                }).then(function() {
                    window.location.href = '?siswa=data_siswa';
                });
            </script>";
        }
        $stmt->close();
    } else {
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
    echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Metode tidak valid!',
            });
        </script>";
}
?>
