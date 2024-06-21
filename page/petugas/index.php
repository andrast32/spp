<?php 
include "../../controller/koneksi.php";

include "controller/part/head.php";
include "setting/popup.php";
include "controller/part/navbar.php";
?>

<div class="content-wrapper">
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">SMK HARAPAN BUNDA</h1>
        </div>
      </div>
    </div>
  </div>

  <section class="content">
    <?php 
    include "controller/control.php";
    ?>
  </section>

</div>

<?php 
include "controller/part/footer.php";
include "controller/part/script.php";
?>