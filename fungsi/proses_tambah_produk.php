<?php 
    require '../config/koneksi.php';
    session_start();

    $namaProduk = htmlspecialchars($_POST['nama_produk']);
    $hargaProduk = htmlspecialchars($_POST['harga_produk']);
    $genderProduk = htmlspecialchars($_POST['gender']);

    $namaImgProduk = $_FILES['img_produk']['name'];
    $lokasiFolder = $_FILES['img_produk']['tmp_name'];
    $sizeImgProduk = $_FILES['img_produk']['size'];
    $sizeImg = 2048000;
    $extFile = pathinfo($namaImgProduk, PATHINFO_EXTENSION);

    if ($sizeImgProduk > $sizeImg) {
        $_SESSION['notif'] = 'Ukuran foto produk lebih dari 2MB!';
        header('Location: ../index.php');
        exit;
        
    } else {
        $namaFileRandom = uniqid();
        $namaFile = $namaFileRandom .'.'. $extFile;
        move_uploaded_file($lokasiFolder, '../img_produk/'. $namaFile);

        $query = "INSERT INTO tb_produk VALUES ('', '$namaProduk', '$hargaProduk', '$genderProduk', '$namaFile')";
        $res = mysqli_query($koneksi, $query);

        if ($res) {
            $_SESSION['notif'] = 'Produk berhasil tersimpan!';
            $_SESSION['status'] = 'success';
            header('Location: ../index.php');
            exit;
        } else {
            $_SESSION['notif'] = 'Produk gagal tersimpan!';
            $_SESSION['status'] = 'danger';
            header('Location: ../index.php');
            exit;
        }
    }
    

?>