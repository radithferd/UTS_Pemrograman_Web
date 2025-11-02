<?php include 'koneksi.php'; ?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Pesanan - Nihil Studio</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="order.css">
</head>
<body class="p-4">
    <div class="container">
        <h1 class="mb-4">Daftar Pesanan Nihil Studio</h1>
        <a href="create.php" class="btn btn-primary mb-3">Tambah Pesanan</a>
        <a href="index.php" class="btn btn-primary mb-3">Kembali</a>

        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>Nama</th>
                    <th>Layanan</th>
                    <th>Email</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            
            <tbody>
                <?php
                    $stmt = pg_query($conn, "SELECT * FROM pesanan ORDER BY id_pesanan DESC");

                    while ($row = pg_fetch_assoc($stmt)) {
                        echo "<tr>
                                    <td>{$row['nama']}</td>
                                    <td>{$row['layanan']}</td>
                                    <td>{$row['email']}</td>
                                    <td>
                                        <a href='edit.php?id={$row['id_pesanan']}' class='btn btn-warning btn-sm'>Ubah</a>
                                        <a href='delete.php?id={$row['id_pesanan']}' class='btn btn-danger btn-sm' onclick='return confirm(\"Yakin ingin menghapus?\")'>Hapus</a>
                                    </td>
                                  </tr>";
                    }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
