<!-- id user tersembunyi -->
<div style="display: none;" id="id_user"><?= $id_user; ?></div>

<section class="section">
    <div class="section-title">
        <h2>Produk Kami</h2>
        <p>The Best Produk</p>
    </div>
    <div class="wadah fitur-public">
        <?php 
            require 'koneksi.php'; 

            $query = "SELECT a.*, (SELECT 1 FROM tb_keranjang WHERE id_produk = a.id LIMIT 1) sudah_dikeranjang FROM 
            tb_produk a";
            $res = mysqli_query($koneksi, $query);

            while ($produk = mysqli_fetch_assoc($res)) :
                $idProduk = $produk['id'];
                $dikeranjang = $produk['sudah_dikeranjang'];

                if ($dikeranjang) {
                    $statusBtn = 'secondary';
                    $ket = 'Keluarkan dari Keranjang';
                } else {
                    $statusBtn = 'success';
                    $ket = 'Tambahkan Keranjang';
                }

                $btnMasukKeranjang = '<button class="btn btn-'. $statusBtn .' w-100 mt-2 btn-keranjang" 
                id="item_keranjang_'. $idProduk .'">'. $ket .'</button>';

                $btnKeranjang = $is_login ? $btnMasukKeranjang : '<a class="btn btn-success w-100 mt-2" href="index.php?page=login">Tambahkan Keranjang</a>';
        ?>
            <div class="list-produk">
                <div class="nama-produk">
                    <h4><?= $produk['nama_produk']; ?></h4>
                </div>
                <div class="gambar-produk img-thumbnail">
                    <center>
                        <img src="assets/img/<?= $produk['upload_produk']; ?>" alt="produk">
                    </center>
                </div>
                <div class="tombol-keranjang">
                    <?= $btnKeranjang ?>
                </div>
            </div>
        <?php 
            endwhile;
        ?>
    </div>
    <?php
        if ($id_rule == 1) {
    ?>
        <div class="wadah fitur-admin">
            <h3 class="black">Fitur Admin | Tambah Produk</h3>
            <form method="post" enctype="multipart/form-data" action="fungsi/proses_tambah_produk.php">
                <div>
                    <label for="nama_produk" class="form-label">Nama Produk</label>
                    <input type="text" class="form-control" minlength="10" maxlength="30" id="nama_produk" name="nama_produk" required>
                    <div class="kecil miring abu mb-2" id="notif">
                        Masukan 10 s.d 30 huruf atau angka tanpa special karakter
                    </div>
                </div>
                <div>
                    <label for="harga_produk" class="form-label">Harga</label>
                    <input type="number" class="form-control mb-2" min="5000" max="999000" name="harga_produk" required>
                </div>
                <div>
                    <label for="gender" class="form-label">Gender</label>
                        <div class="mb-4">
                            <div>
                                <input type="radio" name="gender" value="pria"> Pria
                            </div>
                            <div>
                                <input type="radio" name="gender" value="wanita"> Wanita
                            </div>
                        </div>
                    </div>
                <div>
                    <label for="image_produk" class="form-label">Image Produk</label>
                    <input type="file" class="form-control mb-4" accept=".jpg" name="img_produk" required>
                </div>
                <div>
                    <button class="btn btn-success w-100" type="submit">Tambah Produk</button>
                </div>
            </form>
        </div>
    <?php
        }
    ?>
</section>
