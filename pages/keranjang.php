<?php  
    require 'koneksi.php';

    $sql = "SELECT a.id AS id_keranjang, a.qty, b.nama_produk, b.harga FROM tb_keranjang a JOIN 
    tb_produk b ON a.id_produk = b.id";
    $query = mysqli_query($koneksi, $sql);
    
?>

<section class="section section-keranjang">
    <div class="section-title">
        <h2>Keranjang</h2>
        <p>Keranjang belanja anda</p>
    </div>
    <div class="section-desc w-75 m-auto">
        <form action="index.php?page=checkout" method="post">
            <table class="table">
                <tr>
                    <th>No</th>
                    <th>Nama Produk</th>
                    <th>Harga</th>
                    <th>Qty</th>
                    <th style="text-align: right;">Jumlah</th>
                </tr>
                <?php  
                    $no = 0;
                    while ($data = mysqli_fetch_assoc($query)) :
                    $no++;

                    $id_keranjang = $data['id_keranjang'];
                    $jumlah = $data['harga'] * $data['qty'];
                    $inputQty = '<input type="number" value="'. $data['qty'] .'" class="form-control qty" 
                    id="qty_'. $id_keranjang .'" name="qty_'. $id_keranjang .'">';
                ?>
                    <tr>
                        <td><?= $no; ?></td>
                        <td><?= $data['nama_produk']; ?></td>
                        <td id="harga_<?= $id_keranjang; ?>"><?= $data['harga']; ?></td>
                        <td><?= $inputQty; ?></td>
                        <td id="jumlah_<?= $id_keranjang; ?>" style="text-align: right;"><?= $jumlah; ?></td>
                    </tr>
                <?php  
                    endwhile;
                ?>
                <tr>
                    <td colspan="4">Total</td>
                    <td id="total" style="text-align: right;">0</td>
                </tr>
            </table>

            <input hidden="hidden" name="total_hide" id="total_hide">

            <button class="btn btn-success w-100" onclick="return confirm('Yakin ingin checkout?')" type="submit">Checkout</button>
        </form>

    </div>
</section>