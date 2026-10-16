
<?php
$host = "localhost";
$user = "root";
$pass = "";
$db = "perpustakaan_digital";

$koneksi = mysqli_connect($host, $user, $pass, $db, 3306);

if (!$koneksi) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}

mysqli_set_charset($koneksi, "utf8mb4");
?>
