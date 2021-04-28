<?php
    //periksa apakah user sudah login, cek kehadiran dengan session name
    //jika tidak ada, redirect ke login.php
    session_start();
    if(!isset($_SESSION["nama"])){
        header("Location: login.php");
    }
    // buka koneksi dengan MySQL
    include("connection.php");
    //cek apakah form telah di submit
    if(!isset($_POST["submit"])){
        //form telah di submit, proses data
        //ambil semua nilai form

    }
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Sistem Informasi Mahasiswa</title>
  <link href="style.css" rel="stylesheet" >
  <link rel="icon" href="favicon.png" type="image/png" >
</head>
<body>
<div class="container">
<div id="header">
  <h1 id="logo">Sistem Informasi <span>Kampusku</span></h1>
  <p id="tanggal"><?php echo date("d M Y"); ?></p>
</div>
<hr>
  <nav>
  <ul>
    <li><a href="tampil_mahasiswa.php">Tampil</a></li>
    <li><a href="tambah_mahasiswa.php">Tambah</a>
    <li><a href="edit_mahasiswa.php">Edit</a>
    <li><a href="hapus_mahasiswa.php">Hapus</a></li>
    <li><a href="logout.php">Logout</a>
  </ul>
  </nav>
  <form id="search" action="tampil_mahasiswa.php" method="get">
    <p>
      <label for="nim">Nama : </label>
      <input type="text" name="nama" id="nama" placeholder="search..." >
      <input type="submit" name="submit" value="Search">
    </p>
  </form>
<h2>Tambah Data Mahasiswa</h2>
<?php
    //tampilkan error jika ada
    if($pesan_error !== ""){
        echo "<div class=\"error\">$pesan_error</div>";
    }
?>
<form id="form_mahasiswa" action="form_mahasiswa.php" method="post">
    <fieldset>
        <legend>Mahasiswa Baru</legend>
        <p>
            <label for="nim">NIM : </label>
            <input type="text" name="nim" id="nim" value="<?php echo $nim ?>"
            placeholder="Contoh: 12345678">
            (8 digit angka)
        </p>
        <p>
            <label for="nama">Nama : </label>
            <input type="text" name="nama" id="nama" value="<?php echo $nama ?>">
        </p>
        <p>
            <label for="tempat_lahir">Tempat Lahir : </label>
            <input type="text" name="tempat_lahir" id="tempat_lahir"
            value="<?php echo $tempat_lahir ?>">
        </p>
        <p>
            <label for="tgl" >Tanggal Lahir : </label>
                <select name="tgl" id="tgl">
                    <?php 
                        for($i=1; Si <= 31;$i++){
                            if($i==$tgl){
                                echo "<option value = $i selected>";
                            }else{
                                echo "<option value = $i >";
                            }
                            echo str_pad($i,2,"0",STR_PAD_LEFT);
                            echo "</option>";
                        }
                    ?>
                </select>
        </p>
    </fieldset>
</form>