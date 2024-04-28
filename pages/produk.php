<!-- id user tersembunyi -->
<div style="display: none;" id="id_user"><?= $id_user; ?></div>

<section class="section">
    <div class="section-title">
        <h2>Produk Kami</h2>
        <p>The Best Produk</p>
    </div>

    <!-- notif alert -->
    <?php  
        if (isset($_SESSION['notif']) && isset($_SESSION['status'])) {
    ?>
        <div class="alert alert-<?= $_SESSION['status']; ?>" role="alert">
           <?= $_SESSION['notif']; ?>
        </div>
    <?php        
        }
        unset($_SESSION['notif']);
        unset($_SESSION['status']);
    ?>

    <!-- form tambah produk (admin) -->
    <?php
        if ($id_rule == 1) {
    ?>
        <div class="wadah fitur-admin">
            <button class="btn btn-success" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                Tambah Data Produk
            </button>

            <div class="collapse" id="collapseExample">
                <h4 class="black pt-3">Tambah Produk Baru</h4>
                <form method="post" enctype="multipart/form-data" action="fungsi/proses_tambah_produk.php">
                    <div>
                        <label for="nama_produk" class="form-label">Nama Produk</label>
                        <input type="text" class="form-control" minlength="10" maxlength="30" id="nama_produk" name="nama_produk" placeholder="Nama produk baru" required>
                        <div class="kecil miring abu mb-2" id="notif">
                            Masukan 10 s.d 30 huruf atau angka tanpa special karakter
                        </div>
                    </div>
                    <div>
                        <label for="harga_produk" class="form-label">Harga</label>
                        <input type="number" class="form-control mb-2" min="5000" max="999000" name="harga_produk" placeholder="Masukkan harga" required>
                    </div>
                    <div>
                        <label for="gender_produk" class="form-label">Gender</label>
                            <div class="mb-4">
                                <select name="gender" id="gender_produk" class="form-control">
                                    <option value="">-- Pilih jenis gender --</option>
                                    <option value="pria">Pria</option>
                                    <option value="wanita">Wanita</option>
                                    <option value="keduanya">Keduanya</option>
                                </select>
                            </div>
                        </div>
                    <div>
                        <label for="image_produk" class="form-label">Image Produk</label>
                        <input type="file" class="form-control" accept=".jpg" name="img_produk" id="image_produk" required>
                        <div class="kecil miring abu mb-4">
                            *Ukuran foto/gambar max 2MB
                        </div>
                    </div>
                    <div>
                        <button class="btn btn-success w-100" type="submit">Tambah Produk</button>
                    </div>
                </form>
            </div>
        </div>
    <?php
        }
    ?>

    <div class="wadah fitur-public">
        <?php 
            require 'config/koneksi.php'; 

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
                <div class="gambar-produk img-thumbnail mb-2">
                    <center>
                        <img src="img_produk/<?= $produk['upload_produk']; ?>" alt="produk">
                    </center>
                </div>
                 <div class="nama-produk">
                    <h4><?= $produk['nama_produk']; ?></h4>
                    <p>Rp. <?= $produk['harga']; ?></p>
                </div>
                <div class="tombol-keranjang">
                    <?php 
                        if ($id_rule == 0 || $id_rule == 2) {
                            echo $btnKeranjang;
                        } else {
                    ?>
                        <button type="button" class="btn btn-success w-100 mt-2" data-bs-toggle="modal" data-bs-target="#editProduk<?= $produk['id']; ?>">Edit Produk</button>
                        <button type="button" class="btn btn-success w-100 mt-2" data-bs-toggle="modal" data-bs-target="#hapusProduk<?= $produk['id']; ?>">Hapus Produk</button>
                    <?php  
                        }
                    ?>

                    <!-- modal hapus produk -->
                    <div class="modal fade" id="hapusProduk<?= $produk['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Hapus Produk</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                          <div class="modal-body">
                            Anda yakin ingin menghapus <?= $produk['nama_produk']; ?>?
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <a href="fungsi/proses_hapus_produk.php?idProd=<?= $produk['id']; ?>&img=<?= $produk['upload_produk']; ?>" class="btn btn-success">Hapus produk</a>
                          </div>
                        </div>
                      </div>
                    </div>

                    <!-- modal edit produk -->
                    <div class="modal fade" id="editProduk<?= $produk['id']; ?>">
                      <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h4 class="modal-title">Edit Data Produk</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <form method="post" action="fungsi/proses_edit_produk.php" enctype="multipart/form-data">
                            <div class="modal-body">
                              <div class="card-body">
                                <input type="text" class="form-control" name="id_produk" hidden="hidden" value="<?= $produk['id']; ?>">
                                <input type="text" class="form-control" name="img_produk_lama" hidden="hidden" value="<?= $produk['upload_produk']; ?>">
                                <div>
                                    <label for="produk_nama" class="form-label">Nama Produk</label>
                                    <input type="text" class="form-control" minlength="10" maxlength="30" name="nama_produk" id="produk-nama" placeholder="Nama produk baru" value="<?= $produk['nama_produk']; ?>" required>
                                    <div class="kecil miring abu mb-2" id="notif">
                                        Masukan 10 s.d 30 huruf atau angka tanpa special karakter
                                    </div>
                                </div>
                                <div>
                                    <label for="produk_harga" class="form-label">Harga</label>
                                    <input type="number" class="form-control mb-2" min="5000" max="999000" name="harga_produk" id="produk-harga" placeholder="Masukkan harga" value="<?= $produk['harga']; ?>" required>
                                </div>
                                <div>
                                    <label for="produk_gender" class="form-label">Gender</label>
                                        <div class="mb-4">
                                            <select class="form-control" name="gender" id="produk-gender" required>
                                                <option value="<?= $produk['gender']; ?>" class="text-capitalize"><?= $produk['gender']; ?></option>
                                                <option value="pria">Pria</option>
                                                <option value="wanita">Wanita</option>
                                                <option value="keduanya">Keduanya</option>
                                            </select>
                                        </div>
                                    </div>
                                <div>
                                    <label for="produk_gambar" class="form-label">Image Produk</label>
                                    <input type="file" class="form-control" accept=".jpg" name="img_produk" id="produk-gambar" value="<?= $produk['upload_produk']; ?>">
                                    <div class="kecil miring abu mb-4">
                                        *Ukuran foto/gambar max 2MB
                                    </div>
                                </div>
                                <div>
                                    <button class="btn btn-success w-100 mb-2" type="submit">Edit Produk</button>
                                </div>
                              </div>
                            </div>
                          </form>
                        </div>
                      </div>
                      <!-- /.modal-dialog -->
                    </div>
                    <!-- /.modal -->

                </div>
            </div>
        <?php 
            endwhile;
        ?>
    </div>

</section>
