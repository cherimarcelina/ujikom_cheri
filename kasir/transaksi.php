	<?php 
	session_start(); 
	include "../koneksi.php"; 
	$sid = $_SESSION["user"];


	$sql =mysqli_query($koneksi,"SELECT * FROM detail_order inner join masakan WHERE  id_order = '$_GET[id]' AND detail_order.id_masakan=masakan.id_masakan ");
	$order = mysqli_query($koneksi,"SELECT * from user inner join orderd WHERE id_order = '$_GET[id]' AND orderd.id_user=user.id_user ");
	$row_order = mysqli_fetch_assoc($order);
	$id = $row_order['id_user'];


	$total=0;

	while($row = mysqli_fetch_array($sql)) { 
		
		$subtotal    = $row['harga']* $row['jumlah'];       
		$total      = $total + $subtotal;
	}

			

		$hub =0;
	if(isset($_POST['submit'])){
		
	$tgl_skrg = date("Ymd");

	  $text = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
	  $pnj = 4;
	  $text1 = strlen($text)-1;
	  $kode_cek ='';
	  for ($i=1; $i<=$pnj; $i++) { 
	    $kode_cek .= $text[rand(0, $text1)];
	  }

			mysqli_query($koneksi,"INSERT INTO transaksi(id_transaksi,id_user,id_order,tanggal_bayar,total_bayar,kode_bayar)   VALUES ('','$id','$_GET[id]','$tgl_skrg','$total','$kode_cek')");

			mysqli_query($koneksi,"UPDATE orderd Set status_order='Sudah dibayar' where id_order = '$_GET[id]'");
			mysqli_query($koneksi,"UPDATE detail_order Set status_detail_order='Sudah dibayar' where id_order = '$_GET[id]'");
		$total = $_POST['total'];
		$nominal = $_POST['nominal'];

		
		$hub = $nominal - $total;

	}

	 ?>


	 <!DOCTYPE html>
	 <html>
	 <head>
	 	<title>transaksi</title>
	 	<link rel="stylesheet" type="text/css" href="../css/login.css">
	 </head>
	 <body>
	 <div class="login-wrapper">
	 <form action="" class="form"  method="post">
	      

	    	<label for="loginUser" >total bayar</label><br><br>
	        <input type="number" name="total" id="loginUser" value="<?= $total; ?>"><br><br>
	       
	    	<label for="loginPassword"  >Nominal Uang</label><br><br>
	        <input type="number"  name="nominal" id="loginPassword" value="<?= $nominal; ?>">  <input type="submit" name="submit" value="hitung" ><br><br>
	         <p>Kembalian : <?= $hub; ?><b></b></p>
	       
	         <a href="cetak.php">Bayar</a>
	     
	    </form>
	   
	    </div>
	 
	 </body>
	 </html>