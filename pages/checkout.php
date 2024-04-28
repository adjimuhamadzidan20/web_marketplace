<section class="section">
    <div class="section-title">
        <h2>Checkout</h2>
        <p>Silahkan anda membayar sesuai invoice</p>
    </div>
    <div class="section-check">
    	<div class="row">
    		<div class="col col-md-7 wadah m-auto invoice-check">
    			<div class="text-center text-uppercase">
		    		Total Pembayaran
		    	</div>
		    	<div class="text-center">
		    		<?php  
		    			if (isset($_SESSION['total_belanja'])) {
		    		?>
		    			<b>Rp. <?= number_format($_SESSION['total_belanja'], 0);?></b>
		    		<?php  
		    			}
		    		?>
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
    	</div>
    </div>
</section>