<?php
include 'koneksi.php'; // pastikan file koneksi PostgreSQL kamu benar

$success = '';
$error = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = pg_escape_string($conn, $_POST['username']);
    $full_name = pg_escape_string($conn, $_POST['full_name']);
    $password = pg_escape_string($conn, $_POST['password']);
    $confirm_password = pg_escape_string($conn, $_POST['confirm_password']);

    // Validasi konfirmasi password
    if ($password !== $confirm_password) {
        $error = "Password dan konfirmasi password tidak cocok!";
    } else {
        // Cek apakah username sudah ada
        $check = pg_query($conn, "SELECT * FROM users WHERE username = '$username'");
        if (pg_num_rows($check) > 0) {
            $error = "Username sudah digunakan, silakan pilih yang lain!";
        } else {
            // Simpan ke database tanpa hash (sesuai permintaanmu)
            $query = "INSERT INTO users (username, full_name, password) VALUES ('$username', '$full_name', '$password')";
            $result = pg_query($conn, $query);

            if ($result) {
                $success = "Akun berhasil dibuat! Anda akan diarahkan ke halaman login...";
                echo "<script>
                    setTimeout(() => {
                        window.location.href = 'login.php';
                    }, 2000);
                </script>";
            } else {
                $error = "Gagal membuat akun. Silakan coba lagi.";
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar | Nihil Studio</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="login.css" rel="stylesheet">
</head>
<body>
    <div class="d-flex flex-column flex-md-row min-vh-100 w-100 m-0">
        <div class="col-md-6 bg-side d-flex flex-column justify-content-center text-white">
            <a href="index.php" class="text-white mb-4 text-decoration-none">&larr; Kembali Ke Beranda</a>
            <h1 class="fw-bold">Desain Kreatif.<br>Cetak Berkualitas.<br>Hasil Profesional.</h1>
            <p class="mt-3">
                Kami membantu Anda mewujudkan ide menjadi karya nyata melalui layanan desain dan percetakan yang inovatif dan terpercaya.
            </p>
        </div>

        <div class="col-md-6 d-flex align-items-center justify-content-center bg-white">
            <div class="login-box w-75" style="max-width: 400px;">
                <h2 class="fw-bold mb-3">Buat Akun Baru</h2>
                <p class="text-muted mb-4">Daftar untuk melakukan konfirmasi pesanan.</p>

                <?php if ($error): ?>
                    <div class="alert alert-danger py-2"><?= $error ?></div>
                <?php endif; ?>
                <?php if ($success): ?>
                    <div class="alert alert-success py-2"><?= $success ?></div>
                <?php endif; ?>

                <form method="POST" action="">
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" name="username" class="form-control rounded-3" id="username" required minlength="3" maxlength="100" placeholder="Masukkan Username">
                    </div>

                    <div class="mb-3">
                        <label for="full_name" class="form-label">Nama Lengkap</label>
                        <input type="text" name="full_name" class="form-control rounded-3" id="full_name" maxlength="200" placeholder="Masukkan Nama Lengkap">
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" name="password" class="form-control rounded-3" id="password" required placeholder="Masukkan Password">
                    </div>

                    <div class="mb-3">
                        <label for="confirm_password" class="form-label">Konfirmasi Password</label>
                        <input type="password" name="confirm_password" class="form-control rounded-3" id="confirm_password" required placeholder="Masukkan Ulang Password">
                    </div>

                    <button type="submit" class="btn btn-dark w-100 rounded-pill py-2">Daftar</button>

                    <p class="text-center mt-4">
                        Sudah punya akun? <a href="login.php" class="text-decoration-none">Masuk di sini!</a>
                    </p>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
