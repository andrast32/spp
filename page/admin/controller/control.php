<?php 
error_reporting(error_reporting() & ~E_NOTICE );
include "../../controller/koneksi.php";

if(isset($_GET['siswa'])) {
  include "controller/part/sidebar/sidesi.php";
  include("view/siswa/".$_GET['siswa'].".php");
}

elseif(isset($_GET['kelas'])) {
  include "controller/part/sidebar/sidek.php";
  include("view/kelas/".$_GET['kelas'].".php");
}

elseif(isset($_GET['petugas'])) {
  include "controller/part/sidebar/sideu.php";
  include("view/petugas/".$_GET['petugas'].".php");
}

elseif(isset($_GET['guru'])) {
  include "controller/part/sidebar/sideg.php";
  include("view/guru/".$_GET['guru'].".php");
}

elseif(isset($_GET['spp'])) {
  include "controller/part/sidebar/sidesp.php";
  include("view/spp/".$_GET['spp'].".php");
}

elseif(isset($_GET['pembayaran'])) {
  include "controller/part/sidebar/sidep.php";
  include("view/pembayaran/".$_GET['pembayaran'].".php");
}

elseif(isset($_GET['setting'])) {
  include "controller/part/sidebar/sidehome.php";
  include ("setting/".$_GET['setting'].".php");
}

else {
  include "controller/part/sidebar/sidehome.php";
  include "controller/home.php";
}
?>