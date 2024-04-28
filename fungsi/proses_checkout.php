<?php 
	require '../config/koneksi.php';
	session_start();

	$dataKeranjang = $_POST;
	$total = $_POST['total_hide'];

	foreach ($dataKeranjang as $data => $qty) {
		if ($qty > 1) {
			$arr = explode("_", $data);
			$id_keranjang = $arr[1];

			$sql = "UPDATE tb_keranjang SET qty = '$qty' WHERE id = '$id_keranjang'";
			mysqli_query($koneksi, $sql);
		}
	}

	if (empty($total)) {
		$_SESSION['notif'] = 'Perlu data jumlah!';
		$_SESSION['status'] = 'warning';

		header('Location: ../index.php?page=keranjang');
		exit;
	} 
	else {
		$_SESSION['total_belanja'] = $_POST['total_hide'];
		header('Location: ../index.php?page=checkout');
		exit;
	}

?>