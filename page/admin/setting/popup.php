<?php 
    $user = $mysqli->query("SELECT * FROM user ORDER BY id_user");
    while ($data = mysqli_fetch_array($user)) {
?>
    <div class="modal add" id="modal-change-username-<?php echo $data['id_user']; ?>">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Ubah Username</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="?setting=fungsi/changeu" method="post">
                        <div class="form-group">
                            <label for="current_username">Username Saat Ini</label>
                            <input type="text" name="current_username" id="current_username" class="form-control" value="<?php echo $data ['username']; ?>" readonly>
                        </div>
                        
                        <div class="form-group">
                            <label for="new_username">Username Baru</label>
                            <input type="text" name="new_username" id="new_username" class="form-control" placeholder="Masukkan username baru" required>
                        </div>
                                    
                        <div class="modal-footer">
                            <input type="reset" value="Reset" class="btn btn-primary float-right">
                            <input type="submit" value="Submit" class="btn btn-warning float-right">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal add" id="modal-change-password-<?php echo $_SESSION['id_user']; ?>">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Ubah Password</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="?setting=fungsi/changep" method="post">
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" name="username" id="username" class="form-control" value="<?php echo $_SESSION['username']; ?>" readonly>
                        </div>

                        <div class="form-group">
                            <label for="current_password">Password Saat Ini</label>
                            <input type="password" name="current_password" id="current_password" class="form-control" placeholder="Masukkan password saat ini" required>
                            <input type="checkbox" onclick="togglePasswordVisibility('current_password')"> Show Password
                        </div>

                        <div class="form-group">
                            <label for="password">Password Baru</label>
                            <input type="password" name="password" id="password" class="form-control" placeholder="Masukkan password baru" required>
                            <input type="checkbox" onclick="togglePasswordVisibility('password')"> Show Password
                        </div>

                        <div class="modal-footer">
                            <input type="reset" value="Reset" class="btn btn-primary float-right">
                            <input type="submit" value="Submit" class="btn btn-warning float-right">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function togglePasswordVisibility(id) {
                var x = document.getElementById(id);
                if (x.type === "password") {
                    x.type = "text";
                } else {
                    x.type = "password";
                }
            }
    </script>

<?php }?>