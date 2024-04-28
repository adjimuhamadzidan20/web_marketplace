<?php  
	session_start();
	require 'config/koneksi.php';
	
	$username = "";
	if (isset($_SESSION['log_username'])) {
		$username = $_SESSION['log_username'];
	}
	
	if ($username == "") {
        $id_user = '';
        $is_login = '';
        $id_rule = 0;
        $sebagai = 'pengunjung';
        $nama_user = '';
        $item_keranjang = 0;
    } 
    else {
        $query = "SELECT a.*, (SELECT COUNT(1) FROM tb_keranjang WHERE id_user = a.id) item_keranjang FROM tb_user a 
        WHERE a.username = '$username'";
        $res = mysqli_query($koneksi, $query) or die(mysqli_error($koneksi));
        $barisData = mysqli_num_rows($res);
        $data = mysqli_fetch_assoc($res);

        if ($barisData == 0) {
            die('data username tidak ada');
        } else {
			$id_user = $data['id'];
			$is_login = 1;
			$id_rule = $data['id_role'];
			$sebagai = $data['id_role'] == 1 ? 'Admin' : 'Pembeli';
			$nama_user = $data['nama_user'];
			$item_keranjang = $data['item_keranjang'];
		}
    }

?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>LSHOPPING</title>

	<link rel="stylesheet" href="vendor/bootstrap-5.3.1-dist/css/bootstrap.min.css">
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="css/simplelindo.css">
</head>

<body>
	<header id="header">
    	<?php include('header.php'); ?>
    </header>
		
    <main>
		<?php 
			require 'config/routing.php'; 
		?>
	</main>
	
    <footer>
    	<div id="footer">
    		<center>LSHOPPING - <?php echo date("Y"); ?></center>
    	</div>
	</footer>

	<script src="vendor/jquery/jquery-3.6.0.js"></script>
	<script src="vendor/bootstrap-5.3.1-dist/js/bootstrap.bundle.min.js"></script>
	<script>
		// validasi input nama produk
		$('#nama_produk').keyup(function () {
			let inputProduk = $('#nama_produk').val();

			if (inputProduk.length >= 10) {
				$('#notif').text('Panjang karakter valid')
			} else {
				$('#notif').text('Masukan 10 s.d 30 huruf atau angka tanpa special karakter')
			}
		})

		$(function() {
			let jumlahItem = parseInt($('#jumlah_item').text()); // ambil jumlah item keranjang yg tertampung
			let id_user = $('#id_user').text(); // ambil id user

			// fungsi button keranjang
			$('.btn-keranjang').click(function() {
				// console.log($(this).prop('id'));
				let btn_id = $(this).prop('id');
				let id_num = btn_id.split('_');
				let id_produk = id_num[2];

				let capt = $(this).text();
				let linkAjaxUrl = '';

				// jika klik tambah keranjang
				if (capt == 'Tambahkan Keranjang') {
					jumlahItem++;
					$(this).text('Keluarkan dari keranjang');
					$(this).removeClass('btn-success');
					$(this).addClass('btn-secondary');

					// insert ke database
					linkAjaxUrl = `fungsi/proses_tambah_keranjang.php?iduser=${id_user}&idproduk=${id_produk}`;

				} 
				// jika ingin batal tambah
				else {
					jumlahItem--;
					$(this).text('Tambahkan Keranjang');
					$(this).addClass('btn-success');
					$(this).removeClass('btn-secondary');

					// delete dari database
					linkAjaxUrl = `fungsi/proses_tambah_keranjang.php?iduser=${id_user}&idproduk=${id_produk}&mode=hapus`;
				}

				// operasi database ajax
				$.ajax({
					url: linkAjaxUrl
				})

				// console.log(id_produk, jumlahItem, capt);
				$('#jumlah_item').text(jumlahItem); // menampilkan jumlah item keranjang
			})
		})

		$(function() {
			// fungsi input qty
			$('.qty').change(function() {
				let btn_id = $(this).prop('id');
				let id_num = btn_id.split('_');
				let id_keranjang = id_num[1];

				let harga = $('#harga_' +  id_keranjang).text();
				let qty = $('#qty_' +  id_keranjang).val();

				// mencegah input minus -1
				if (qty == 0) {
					$('#qty_' + id_keranjang).val(1);
					return;
				}

				let total = harga * qty;
				$('#jumlah_' +  id_keranjang).text(total);

				// console.log(id_keranjang, harga, qty, total);
				let classQty = document.getElementsByClassName('qty');
				// console.log(classQty);

				// hitung jumlah total
				let totalJum = 0;
				for (var i = 0; i < classQty.length; i++) {
					console.log();
					let arr = classQty[i].id.split('_');
					let idKrj = arr[1];

					let satuan = parseInt($('#harga_'+ idKrj).text());
					let qty = classQty[i].value;
					totalJum += satuan * qty;

					// console.log(satuan, qty);
					$('#total').text(totalJum);
					$('#total_hide').val(totalJum);
				}
			});

			// jumlah total awal
			$('.qty').change();	
		})

		// nav mobile responsive
		$('.ikon-hamburger').click(function() {
			$('.menu-mobile').slideToggle(300);
		})
	</script>
</body>
</html>