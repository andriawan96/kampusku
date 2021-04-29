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
        $nim            = htmlentities(strip_tags(trim($_POST["nim"])));
        $nama           = htmlentities(strip_tags(trim($_POST["nama"])));
        $tempat_lahir   = htmlentities(strip_tags(trim($_POST["tempat_lahir"])));
        $fakultas       = htmlentities(strip_tags(trim($_POST["fakultas"])));
        $jurusan        = htmlentities(strip_tags(trim($_POST["jurusan"])));
        $ipk            = htmlentities(strip_tags(trim($_POST["ipk"])));
        $tgl            = htmlentities(strip_tags(trim($_POST["tgl"])));
        $bln            = htmlentities(strip_tags(trim($_POST["bln"])));
        $thn            = htmlentities(strip_tags(trim($_POST["thn"])));

        // siapkan variabel untuk menampung pesan error
        $pesan_error="";
        // cek apakah "nim" sudah diisi atau tidak
        if(empty($nim)){
            $pesan_error .= "Nim belum diisi <br>";
        }
        // NIM harus angka dengan 8 digit
        elseif(!preg_match("/^[0-9]{8}$/",$nim)){
            $pesan_error .= "Nim harus berupa  8 digit angka <br>";
        }
        //cek ke databse, apakah sudah ada nomor NIM yang sama
        //filter data $nim 
        $nim = mysqli_real_escape_string($link,$nim);
        $query = "SELECT * FROM mahasiswa WHERE nim='$nim'";
        $hasil_query = mysqli_query($link, $query);

        
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
                <select name="bln" id="">
                        <?php
                            foreach($arr_bln as $key => $value){
                                if($key==$bln){
                                    echo "<option value=\"{$key}\" selected>{$value}</option>";
                                }else{
                                    echo "<option value=\"{$key}\">{$value}</option>";
                                }
                            }
                        ?>
                </select>
                <select name="thn">
                    <?php
                        for($i = 1990; $i <= 2005; $i++){
                            if($i==$thn){
                                echo "<option value = $i selected>";
                            }else{
                                echo "<option value = $i>";
                            }
                            echo "$i </option>";
                        }
                    ?>
                </select>
        </p>
        <p>
            <label for="fakultas">Fakultas : </label>
               <select name="fakultas" id="fakultas">
                    <option value="Kedokteran" <?php echo $select_kedokteran?>>Kedokteran </option>
                    <option value="FMIPA" <?php echo $select_fmipa ?>>FMIPA </option>
                    <option value="Ekonomi" <?php $select_ekonomi ?>>Ekonomi </option>
                    <option value="Teknik" <?php $select_teknik ?>>Teknik </option>
                    <option value="Sastra" <?php $select_sastra ?>>Sastra </option>
                    <option value="FASILKOM" <?php echo $select_fasilkom ?>>Fasilkom </option>
               </select>
        </p>
        <p>
            <label for="jurusan">jurusan : </label>
            <input type="text" name="jurusan" id="jurusan" value="<?php echo $jurusan ?>">
        </p>
        <p>
          <label for="ipk">IPK </label>
          <input type="text" name="ipk" id="ipk" value="<?php echo $ipk ?>" placeholder="Contoh: 2.75">
          (angka desimal dipisah dengan karakter titik ".")
        </p>
    </fieldset>
    <br>
    <p>
        <input type="submit" name="submit" value="Tambah Data">
    </p>
</form>
    <div id="footer">
        Copyright <?php echo date("Y"); ?>X Andriawan
    </div>
</div>