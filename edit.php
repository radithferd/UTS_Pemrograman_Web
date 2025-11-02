<?php
include 'koneksi.php';

if (!isset($_GET['id'])) {
    die("ID tidak ditemukan!");
}

$id = $_GET['id'];


$stmt = pg_prepare($conn, "get_pesanan", "SELECT * FROM pesanan WHERE id_pesanan = $1");
$data = pg_execute($conn, "get_pesanan", array($id));

if (!$data) {
    die("Data tidak ditemukan!");
} else {
    $user = pg_fetch_assoc($data);
}

?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Edit Pesanan</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="order.css">
</head>

<body class="p-4">
    <div class="container">
        <h2 class="mb-4">Edit Data Pesanan</h2>

        <form method="POST">
            <input type="hidden" name="id" value="<?php echo $user['id_pesanan']; ?>">
            <div class="mb-3">
                <label class="form-label">Nama</label>
                <input type="text" name="nama" value="<?php echo htmlspecialchars($user['nama']); ?>" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Layanan</label>
                <input type="text" name="layanan" value="<?php echo htmlspecialchars($user['layanan']); ?>" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" class="form-control" required>
            </div>
            <button type="submit" name="update" class="btn btn-primary">Update</button>
            <a href="index.php" class="btn btn-secondary">Kembali</a>
        </form>

        <?php
        if (isset($_POST['update'])) {
            $nama = $_POST['nama'];
            $layanan = $_POST['layanan'];
            $email = $_POST['email'];
            $id = $_POST['id'];

            $update = pg_prepare($conn, "update_pesanan", "UPDATE pesanan SET nama = $1, layanan = $2, email = $3 WHERE id_pesanan = $4");
            $result = pg_execute($conn, "update_pesanan", array($nama, $layanan, $email, $id));

            if ($result) {
                pg_affected_rows($result);
                echo "<script>window.location='Pesanan.php';</script>";
            }
        }
        ?>
    </div>
</body>

</html>