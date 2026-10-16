<?php
include 'koneksi.php';


$id = isset($_GET['id']) ? $_GET['id'] : '';


$query = mysqli_query($koneksi, "SELECT * FROM penerbit WHERE id_penerbit = '$id'");
$data = mysqli_fetch_assoc($query);


if (isset($_POST['update'])) {
    $nama_penerbit = $_POST['nama_penerbit'];
    $wilayah_asal  = $_POST['wilayah_asal'];
    $nama_sales    = $_POST['nama_sales'];
    $telepon_sales = $_POST['telepon_sales'];
    $email_sales   = $_POST['email_sales'];
    $alamat        = $_POST['alamat'];

    
    $update = mysqli_query($koneksi, "UPDATE penerbit SET 
        nama_penerbit = '$nama_penerbit', 
        wilayah_asal = '$wilayah_asal', 
        nama_sales = '$nama_sales', 
        telepon_sales = '$telepon_sales', 
        email_sales = '$email_sales', 
        alamat = '$alamat' 
        WHERE id_penerbit = '$id'");

    if ($update) {
        header("Location: index.php"); 
        exit();
    } else {
        echo "<script>alert('Gagal mengupdate data!');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Penerbit - Perpustakaan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="index.php">Perpustakaan Digital</a>
            <div class="navbar-nav ms-auto">
                <a class="nav-link" href="index.php">Kembali ke Data</a>
            </div>
        </div>
    </nav>

    <div class="container mt-4 mb-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">Formulir Edit Data Penerbit & Supplier</h5>
                    </div>
                    <div class="card-body">
                        <form action="" method="POST">
                            
                            <div class="mb-3">
                                <label for="nama_penerbit" class="form-label">Nama Penerbit / Supplier</label>
                                <input type="text" class="form-control" id="nama_penerbit" name="nama_penerbit" value="<?= isset($data['nama_penerbit']) ? $data['nama_penerbit'] : ''; ?>" required>
                            </div>

                            <div class="mb-3">
                                <label for="wilayah_asal" class="form-label">Wilayah Asal</label>
                                <input type="text" class="form-control" id="wilayah_asal" name="wilayah_asal" value="<?= isset($data['wilayah_asal']) ? $data['wilayah_asal'] : ''; ?>" required>
                            </div>

                            <div class="mb-3">
                                <label for="nama_sales" class="form-label">Nama Kontak Sales</label>
                                <input type="text" class="form-control" id="nama_sales" name="nama_sales" value="<?= isset($data['nama_sales']) ? $data['nama_sales'] : ''; ?>">
                            </div>

                            <div class="mb-3">
                                <label for="telepon_sales" class="form-label">Nomor Telepon / WhatsApp</label>
                                <input type="tel" class="form-control" id="telepon_sales" name="telepon_sales" value="<?= isset($data['telepon_sales']) ? $data['telepon_sales'] : ''; ?>">
                            </div>

                            <div class="mb-3">
                                <label for="email_sales" class="form-label">Email Sales</label>
                                <input type="email" class="form-control" id="email_sales" name="email_sales" value="<?= isset($data['email_sales']) ? $data['email_sales'] : ''; ?>">
                            </div>

                            <div class="mb-3">
                                <label for="alamat" class="form-label">Alamat Lengkap</label>
                                <textarea class="form-control" id="alamat" name="alamat" rows="3"><?= isset($data['alamat']) ? $data['alamat'] : ''; ?></textarea>
                            </div>

                            <div class="d-flex justify-content-between">
                                <a href="index.php" class="btn btn-secondary">Batal</a>
                                <button type="submit" name="update" class="btn btn-primary">Simpan Perubahan</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>