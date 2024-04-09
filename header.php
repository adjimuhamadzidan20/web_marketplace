<div class="logo">
    <h3>LSHOPPING</h3>
</div>
<nav class="navbar">
    <ul>
        <li><a href="index.php">Beranda</a></li>
        <li><a href="index.php?page=produk">Produk</a></li>
        <li><a href="index.php?page=keranjang">Keranjang <span class="badge" id="jumlah_item"><?= $item_keranjang; ?></span></a></li>
        <li><a href="index.php?page=tokokami">Toko Kami</a></li>
        <li>
            <?php 
                if ($is_login) {
            ?>
                <a href="logout.php" onclick="return confirm('Yakin ingin keluar?')">Logout</a>
            <?php
                } else {
            ?>
                <a href="index.php?page=login">Login</a>
            <?php } ?>
        </li>
    </ul>
</nav>