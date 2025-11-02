<?php include 'koneksi.php'; ?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Pesanan</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="order.css">
</head>
<body class="p-4">
    <div class="container">
        <h2 class="mb-4">Tambah Pesanan Baru</h2>

        <form method="POST">
            <div class="mb-3">
                <label class="form-label">Nama</label>
                <input type="text" name="nama" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Layanan</label>
                <input type="text" name="layanan" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control" required>
            </div>
            <button type="submit" name="submit" class="btn btn-success">Simpan</button>
            <a href="Pesanan.php" class="btn btn-secondary">Kembali</a>
        </form>

        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $nama = $_POST['nama'];
            $layanan = $_POST['layanan'];
            $email = $_POST['email'];
                
            $stmt = pg_prepare($conn, "insert_user", "INSERT INTO pesanan (nama, layanan, email) VALUES ($1, $2, $3)");
            $result = pg_execute($conn, "insert_user", array($nama, $layanan, $email));
            if (!$result) {
                die("Gagal menyimpan data!");
            }
            echo "<script> window.location='Pesanan.php';</script>";
        }
        ?>
    </div>
</body>
</html>
