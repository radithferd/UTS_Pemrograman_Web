<?php
    $host = "localhost";
    $port = "5432";
    $dbname = "db_nihil_studio";
    $user = "postgres";
    $password = "12345678";

    try {
        $conn = new PDO("pgsql:host=$host;port=$port;dbname=$dbname", $user, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        die("Koneksi gagal: " . $e->getMessage());
    }
?>