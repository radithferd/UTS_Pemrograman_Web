<?php
    include '../koneksi.php';

    if (!isset($_GET['id'])) {
        die("ID tidak ditemukan!");
    }

    $id = $_GET['id'];

    pg_prepare($conn, "delete_pesanan", "DELETE FROM pesanan WHERE id_pesanan = $1");
    $exec = pg_execute($conn, "delete_pesanan", array($id));

    echo "<script>window.location='Pesanan.php';</script>";

?>
