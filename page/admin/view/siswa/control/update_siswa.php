<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['id_siswa']) && isset($_POST['nis']) && isset($_POST['nama_siswa']) && isset($_POST['id_kelas']) && isset($_POST['alamat']) && isset($_POST['no_telp']) && isset($_POST['jk'])) {

        $id_siswa       = $_POST['id_siswa'];
        $nis            = $_POST['nis'];
        $nama_siswa     = $_POST['nama_siswa'];
        $id_kelas       = $_POST['id_kelas'];
        $alamat         = $_POST['alamat'];
        $no_telp        = $_POST['no_telp'];
        $jk             = $_POST['jk'];
        $foto           = isset($_FILES['foto']) ? $_FILES['foto']['name'] : '';
        $tempFoto       = isset($_FILES['foto']) ? $_FILES['foto']['tmp_name'] : '';

        // Update query
        $stmt = $mysqli->prepare("UPDATE siswa SET nis=?, nama_siswa=?, id_kelas=?, alamat=?, no_telp=?, jk=? WHERE id_siswa=?");
        $stmt->bind_param("ssssssi", $nis, $nama_siswa, $id_kelas, $alamat, $no_telp, $jk, $id_siswa);

        if ($stmt->execute()) {
            // Check if a new photo is uploaded
            if ($foto) {
                $newFotoName = $id_siswa . '.' . pathinfo($foto, PATHINFO_EXTENSION);
                $target = "../../template/dist/img/upload/" . $newFotoName;

                // Move the uploaded file
                if (move_uploaded_file($tempFoto, $target)) {
                    // Update the photo name in the database
                    $stmt = $mysqli->prepare("UPDATE siswa SET foto = ? WHERE id_siswa = ?");
                    $stmt->bind_param("si", $newFotoName, $id_siswa);
                    $stmt->execute();
                }
            }
            echo "
            <script>
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil',
                    text: 'Siswa berhasil diperbarui!',
                    showConfirmButton: false,
                    timer: 1500
                }).then(function() {
                    window.location.href = '?siswa=data_siswa';
                });
            </script>";
        } else {
            echo "
            <script>
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Siswa gagal diperbarui!',
                    showConfirmButton: false,
                    timer: 1500
                }).then(function() {
                    window.location.href = '?siswa=data_siswa';
                });
            </script>";
        }
        // Close the statement
        $stmt->close();
    } else {
        echo "
        <script>
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
    echo "
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Data tidak lengkap!',
        });
    </script>";
}
?>
