<?php
	require '../config/koneksi.php';
	session_start();

	$idProduk = $_GET['idProd'];
	$imgProduk = $_GET['img'];
	$query = "DELETE FROM tb_produk WHERE id = '$idProduk'";
	$exc = mysqli_query($koneksi, $query);

	if ($exc) {
		if (isset($imgProduk)) {
			unlink('../img_produk/'. $imgProduk);
		}
		
		$_SESSION['notif'] = 'Data produk berhasil terhapus!';
		$_SESSION['status'] = 'success';
		header('Location: ../index.php');
		exit;
	} else {
		$_SESSION['notif'] = 'Data produk gagal terhapus!';
		$_SESSION['status'] = 'danger';
		header('Location: ../index.php');
		exit;
	}

?>