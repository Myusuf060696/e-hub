<?php
  session_start();
  session_destroy();
  header('location:../index.php');
?>
<!-- Menghapus Semua Session -->

<?php
  // session_start();
  // unset($_SESSION['Username']);
  // unset($_SESSION['Nama']);
  // header("location: index.php");
?>