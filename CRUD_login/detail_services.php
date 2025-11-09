<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Detail Services | Nihil Studio</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="style.css">
  <link rel="icon" type="image/png" href="img/logo.png">  
</head>

<body>

  <?php 
    include 'includes/header.php'; 
    include 'koneksi.php';

    $stmt = $conn->query("SELECT * FROM layanan ORDER BY id_layanan ASC");
    $layanan = $stmt->fetchAll(PDO::FETCH_ASSOC);
  ?>

  <section class="detail-layanan">
    <h1>Detail Layanan</h1>
    <p class="subjudul">Berikut merupakan daftar layanan lengkap beserta deskripsi dan informasi terkait dari Nihil Studio.</p>

    <div class="tabel-layanan-container">
      <table class="tabel-layanan">
        <thead>
          <tr>
            <th>No</th>
            <th>Nama Layanan</th>
            <th>Deskripsi</th>
            <th>Harga (Rp)</th>
            <th>Durasi (hari)</th>
          </tr>
        </thead>
        <tbody>
          <?php 
            $no = 1;
            foreach ($layanan as $data): 
          ?>
          <tr>
            <td><?= $no++; ?></td>
            <td><?= htmlspecialchars($data['nama_layanan']); ?></td>
            <td><?= htmlspecialchars($data['deskripsi']); ?></td>
            <td><?= isset($data['harga']) ? number_format($data['harga'], 0, ',', '.') : '-'; ?></td>
            <td><?= htmlspecialchars($data['pengerjaan']); ?></td>
          </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>

    <div class="back-btn-container">
      <a href="services.php" class="back-btn">Kembali ke Layanan</a>
    </div>
  </section>

  <?php include 'includes/footer.php'; ?>

</body>
</html>
