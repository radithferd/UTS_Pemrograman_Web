<?php
session_start();
include 'koneksi.php'; // koneksi PostgreSQL, pastikan variabelnya $conn

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = pg_escape_string($conn, $_POST['username']);
    $password = pg_escape_string($conn, $_POST['password']);

    $query = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
    $result = pg_query($conn, $query);

    if ($result && pg_num_rows($result) === 1) {
        $row = pg_fetch_assoc($result);
        $_SESSION['username'] = $row['username'];
        $_SESSION['full_name'] = $row['full_name'];

        if ($row['username'] === 'admin') {
            header('Location: CRUD_login/pesanan.php');
        } else {
            header('Location: CRUD_login/create.php');
        }

        exit;
    } else {
        $error = "Username atau password salah!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Nihil Studio</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="login.css" rel="stylesheet">
</head>

<body>
    <div class="d-flex flex-column flex-md-row min-vh-100 w-100 m-0">
        <!-- Bagian kiri -->
        <div class="col-md-6 bg-side d-flex flex-column justify-content-center text-white">
            <a href="index.php" class="text-white mb-4 text-decoration-none">&larr; Kembali Ke Beranda</a>
            <h1 class="fw-bold">Desain Kreatif.<br>Cetak Berkualitas.<br>Hasil Profesional.</h1>
            <p class="mt-3">
                Kami membantu Anda mewujudkan ide menjadi karya nyata melalui layanan desain dan percetakan yang inovatif dan terpercaya.
            </p>
        </div>

        <!-- Bagian kanan -->
        <div class="col-md-6 d-flex align-items-center justify-content-center bg-white">
            <div class="login-box w-75" style="max-width: 400px;">
                <h2 class="fw-bold mb-3">Selamat Datang!</h2>
                <p class="text-muted mb-4">Masuk untuk melakukan konfirmasi pesanan.</p>

                <?php if ($error): ?>
                    <div class="alert alert-danger py-2" role="alert">
                        <?= $error ?>
                    </div>
                <?php endif; ?>

                <form method="POST" action="">
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" name="username" class="form-control rounded-3" id="username" required placeholder="Masukkan Username">
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" name="password" class="form-control rounded-3" id="password" required placeholder="Masukkan Password">
                    </div>

                    <button type="submit" class="btn btn-dark w-100 rounded-pill py-2">Masuk</button>

                    <p class="text-center mt-4">
                        Belum punya akun? <a href="register.php" class="text-decoration-none">Daftar di sini!</a>
                    </p>
                </form>
            </div>
        </div>
    </div>
</body>

</html>