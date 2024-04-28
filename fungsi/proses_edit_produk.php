<?php  
	require '../config/koneksi.php';
	session_start();

	$idProduk = $_POST['id_produk'];
	$namaProduk = htmlspecialchars($_POST['nama_produk']);
  $hargaProduk = htmlspecialchars($_POST['harga_produk']);
  $genderProduk = htmlspecialchars($_POST['gender']);

  $namaImgProduk = $_FILES['img_produk']['name'];
  $lokasiFolder = $_FILES['img_produk']['tmp_name'];
  $sizeImgProduk = $_FILES['img_produk']['size'];
  $errorFile = $_FILES['img_produk']['error'];

  $imgLama = $_POST['img_produk_lama'];
  $sizeImg = 2048000;
  $extFile = pathinfo($namaImgProduk, PATHINFO_EXTENSION);

  if ($errorFile == 4) {
  	$query = "UPDATE tb_produk SET nama_produk = '$namaProduk', harga = '$hargaProduk', gender = '$genderProduk', 
  	upload_produk = '$imgLama' WHERE id = '$idProduk'";
  	$res = mysqli_query($koneksi, $query);

  	if ($res) {
      $_SESSION['notif'] = 'Produk berhasil terubah!';
      $_SESSION['status'] = 'success';
      header('Location: ../index.php');
      exit;
    } else {
      $_SESSION['notif'] = 'Produk gagal terubah!';
      $_SESSION['status'] = 'danger';
      header('Location: ../index.php');
      exit;
    }
  }
  else {
  	if ($sizeImgProduk > $sizeImg) {
	    $_SESSION['notif'] = 'Ukuran foto produk lebih dari 2MB!';
      $_SESSION['status'] = 'warning';
	    header('Location: ../index.php');
	    exit;
	  } else {
      $namaFileRandom = uniqid();
      $namaFile = $namaFileRandom .'.'. $extFile;
      move_uploaded_file($lokasiFolder, '../img_produk/'. $namaFile);

	    $query = "UPDATE tb_produk SET nama_produk = '$namaProduk', harga = '$hargaProduk', gender = '$genderProduk', 
  		upload_produk = '$namaFile' WHERE id = '$idProduk'";
	    $res = mysqli_query($koneksi, $query);

	    if ($res) {
        if (isset($imgLama)) {
          unlink('../img_produk/'. $imgLama);
        }
        
        $_SESSION['notif'] = 'Produk berhasil terubah!';
        $_SESSION['status'] = 'success';
        header('Location: ../index.php');
        exit;
	    } else {
        $_SESSION['notif'] = 'Produk gagal terubah!';
        $_SESSION['status'] = 'danger';
        header('Location: ../index.php');
        exit;
	    }
	  }
  }
  
?>