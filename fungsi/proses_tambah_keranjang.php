<?php  
	require '../koneksi.php';

	$id_user = $_GET['iduser'];
	$id_produk = $_GET['idproduk'];
	$mode = $_GET['mode'];

	if ($mode == '') {
		$sql = "INSERT INTO tb_keranjang VALUES ('', '$id_user', '$id_produk', '')";
		$query = mysqli_query($koneksi, $sql);

		echo '<script>
			alert("sukses");
		</script>';
	} 
	else if ($mode == 'hapus') {
		$sql = "DELETE FROM tb_keranjang WHERE id_user = '$id_user' AND id_produk = '$id_produk'";
		$query = mysqli_query($koneksi, $sql);

		echo '<script>
			alert("dikeluarkan");
		</script>';
	}

?>