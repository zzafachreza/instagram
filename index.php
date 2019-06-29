

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>Hello, world!</title>
  </head>
  <body>
<?php

include_once 'library/linear.php';
include_once 'library/qrlib.php';

?>
  <div class="container">
  	  <h1>Membuat Qr Code dan Barcode Linear</h1>

    <form>
    	
    	<table class="table">
    		<tr>
    			<td>
    				<input autofocus type="text" name="key" class="form-control" placeholder="masukan angka/huruf untuk barcode">
    			</td>
    			<td>
    				<button class="btn btn-success">
    					Generate Barcode
    				</button>
    			</td>
    		</tr>
    		
    	</table>

    </form>
    <hr>
    <?php
// Barcode Batang
    	 if (!empty($_GET['key'])) {
    	 		
    	 		$isi_teks = $_GET['key'];

    	 		// barcode batang

    	 	   	$img      = code128BarCode($isi_teks, 1);
              	ob_start();
              	imagepng($img);
              	$output_img   = ob_get_clean();
				$barcode_linear ='<img width="250" height="60" src="data:image/png;base64,'.base64_encode($output_img).'" />'; 

				// QRCode

				$namafile = "qrcode.png";
				$quality = 'H'; //ada 4 pilihan, L (Low), M(Medium), Q(Good), H(High)
				$ukuran = 5; //batasan 1 paling kecil, 10 paling besar
				$padding = 0;
				$tempdir =''; 
				$qr = QRCode::png($isi_teks,$tempdir.$namafile,$quality,$ukuran,$padding);
				 
				$path = $tempdir.$namafile;
				$type = pathinfo($path, PATHINFO_EXTENSION);
				$data = file_get_contents($path);
				$base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
				 $qrcode = '<img width="100" height="100" src="'.$base64.'" />';


    	 }


    ?>
    <div class="col col-sm-6">
    	<h3>Barcode Linear</h3>
    	<?php echo $barcode_linear ?>
    	<br>
    	<?php echo $isi_teks ?>
    </div>

       <div class="col col-sm-6">
    	<h3>QR Code</h3>
    	<?php echo $qrcode ?>
    	<br>
    	<?php echo $isi_teks ?>
    </div>
    

  </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>