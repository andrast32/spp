<?php 
error_reporting(error_reporting() & ~E_NOTICE );
include "../../controller/koneksi.php";

if(isset($_GET['bayar'])) {
  include "controller/part/sidebar/side.php";
  include("view/bayar/".$_GET['bayar'].".php");
}

elseif(isset($_GET['setting'])) {
  include "controller/part/sidebar/sidehome.php";
  include "setting/".$_GET['setting'].".php";
}

else {
  include "controller/part/sidebar/sidehome.php";
  include "controller/home.php";
}
?>