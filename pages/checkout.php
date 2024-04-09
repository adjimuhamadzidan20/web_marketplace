<?php 
	require 'koneksi.php';

	// echo '<pre>';
	// 	var_dump($_POST);
	// echo '</pre>';

	$dataKeranjang = $_POST;

	foreach ($dataKeranjang as $data => $qty) {
		if ($qty > 1) {
			$arr = explode("_", $data);
			$id_keranjang = $arr[1];

			$sql = "UPDATE tb_keranjang SET qty = '$qty' WHERE id = '$id_keranjang'";
			mysqli_query($koneksi, $sql);
		}
	}

	$total = $_POST['total_hide'] or die('Perlu data total');

?>

<section class="section">
    <div class="section-title">
        <h2>Checkout</h2>
        <p>Silahkan anda membayar sesuai invoice</p>
    </div>
    <div class="section-desc wadah w-50 m-auto">
    	<div class="text-center text-uppercase">
    		Total Pembayaran
    	</div>
    	<div class="text-center">
    		<b>Rp. <?= number_format($total,0); ?></b>
    	</div>
    	<hr>
    	<div class="text-left">
    		<ul type="square">
    			<li>Metode Pembayaran Melalui Transfer</li>
    			<li>No. Rek 123444511</li>
    			<li>Bank BNI</li>
    			<li>Atas Nama LShopping Kota Bekasi</li>
    		</ul>
    	</div>
    	<hr>
    	<button class="btn btn-success w-100" onclick="window.print()">Cetak Invoice</button>
    </div>
</section>