<div class="logo">
    <span>LSHOPPING</span>
</div>

<!-- navbar desktop -->
<nav class="navbar">
    <div class="menu-desktop">
        <ul>
            <?php  
                if ($id_rule == 0) {
            ?>  
                <li><a href="index.php">Beranda</a></li>
                <li><a href="index.php?page=produk">Produk</a></li>
                <li><a href="index.php?page=tokokami">Toko Kami</a></li>
            <?php  
                } else if ($id_rule == 1){
            ?>
                <li><?= $nama_user; ?> <span class="badge"><?= $sebagai; ?></span></li>
                <li><a href="index.php?page=produk">Produk</a></li>
            <?php  
                } else {
            ?>
                <li><?= $nama_user; ?> <span class="badge"><?= $sebagai; ?></span></li>
                <li><a href="index.php">Beranda</a></li>
                <li><a href="index.php?page=produk">Produk</a></li>
                <li><a href="index.php?page=keranjang">Keranjang <span class="badge" id="jumlah_item"><?= $item_keranjang; ?></span></a></li>
                <li><a href="index.php?page=tokokami">Toko Kami</a></li>
            <?php 
                } 
            ?>

            <li>
                <?php 
                    if ($is_login) {
                ?>
                    <a href="logout.php">Logout</a>
                <?php
                    } else {
                ?>
                    <a href="index.php?page=login">Login</a>
                <?php } ?>
            </li>
        </ul>
    </div>

    <div class="ikon-hamburger">
        <div class="garis-1"></div>
        <div class="garis-2"></div>
        <div class="garis-3"></div>
    </div>

</nav>

<div class="menu-mobile">
    <ul>
        <?php  
            if ($id_rule == 0) {
        ?>  
            <li><a href="index.php">Beranda</a></li>
            <li><a href="index.php?page=produk">Produk</a></li>
            <li><a href="index.php?page=tokokami">Toko Kami</a></li>
        <?php  
            } else if ($id_rule == 1){
        ?>
            <li><?= $nama_user; ?> <span class="badge"><?= $sebagai; ?></span></li>
            <li><a href="index.php?page=produk">Produk</a></li>
        <?php  
            } else {
        ?>
            <li><?= $nama_user; ?> <span class="badge"><?= $sebagai; ?></span></li>
            <li><a href="index.php">Beranda</a></li>
            <li><a href="index.php?page=produk">Produk</a></li>
            <li><a href="index.php?page=keranjang">Keranjang <span class="badge" id="jumlah_item"><?= $item_keranjang; ?></span></a></li>
            <li><a href="index.php?page=tokokami">Toko Kami</a></li>
        <?php 
            } 
        ?>

        <li>
            <?php 
                if ($is_login) {
            ?>
                <a href="logout.php">Logout</a>
            <?php
                } else {
            ?>
                <a href="index.php?page=login">Login</a>
            <?php } ?>
        </li>
    </ul>    
</div>

