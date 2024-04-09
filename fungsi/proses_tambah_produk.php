<?php 
    require '../koneksi.php';

    $namaProduk = htmlspecialchars($_POST['nama_produk']);
    $hargaProduk = htmlspecialchars($_POST['harga_produk']);
    $genderProduk = htmlspecialchars($_POST['gender']);
    $imgProduk = htmlspecialchars($_FILES['img_produk']['name']);

    $query = "INSERT INTO tb_produk VALUES ('', '$namaProduk', '$hargaProduk', '$genderProduk', '$imgProduk')";
    $res = mysqli_query($koneksi, $query);

    if ($res) {
        // echo "Produk berhasil tersimpan";
        header('Location: ../index.php');
        exit;
    } else {
        // echo "Produk gagal tersimpan";
        header('Location: ../index.php');
        exit;
    }

?>