<?php
  //buat koneksi dengan database mysql
  $dbhost ="localhost";
  $dbuser = "root";
  $dbpass ="";
  $dbname = "kampusku";
  $link = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);
  //test link apakah konek
  if(!$link){
    die("koneksi ke database gagal");
  }
 ?>
