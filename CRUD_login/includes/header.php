<?php
$current_page = basename($_SERVER['PHP_SELF']);

function get_active_class($page_name, $current) {
    return ($page_name == $current) ? 'active' : '';
}
?>

<header>
    <div class="header-content"> 
        
        <div class="logo-container">
            <a href="index.php">
                <img src="../img/logo.png" alt="Logo Nihil Studio" class="logo">
            </a>
        </div>

        <nav>
            <a href="index.php" class="<?= get_active_class('index.php', $current_page) ?>">Beranda</a>
            <a href="about.php" class="<?= get_active_class('about.php', $current_page) ?>">Tentang Kami</a>
            <a href="gallery.php" class="<?= get_active_class('gallery.php', $current_page) ?>">Galeri</a>
            <a href="services.php" class="<?= get_active_class('services.php', $current_page) ?>">Layanan</a> 
            <a href="create.php" class="<?= get_active_class('create.php', $current_page) ?>">Pesan Sekarang</a>
            <a href="../index.php" class="btn btn-logout">Logout</a>
        </nav>

    </div> 
</header>