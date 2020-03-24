<?php 
session_start(); 
	include "../koneksi.php"; 
	$sid = $_SESSION["user"]; 

// mysqli_query($koneksi,"INSERT INTO orderd(tanggal,id_user,kode)   VALUES ('$tgl_skrg','$sid','$kode_cek')");


$tgl_skrg = date("Ymd");
$no = $_POST['no_meja'];
$me = $_POST['meja'];
//cek username sudah ada aatu belum
	// $result = mysqli_query($koneksi, "SELECT no_meja FROM orderd WHERE no_meja = '$no' ");
	// if( mysqli_fetch_assoc($result) ){

	// 	echo "<script>
	// 				alert('meja yang dipilih sudah terpakai!')
	// 				document.location.href = 'checkout.php';;
	// 		  </script>";

	// 		  return false;
	// }
mysqli_query($koneksi,"DELETE from keranjang where id_user = '$sid'");
	
mysqli_query($koneksi,"UPDATE orderd Set no_meja = '$no',tanggal ='$tgl_skrg',id_user='$sid',status_order='belum dibayar', keterangan='$me' where id_order = '$_GET[id]'");


// $sql = mysqli_query($koneksi,"SELECT masakan.harga,detail_order.jumlah,orderd.no_meja,orderd.kode FROM orderd INNER JOIN(detail_order INNER JOIN masakan ON  masakan.id_masakan=detail_order.id_masakan) ON detail_order.id_order=orderd.id_order  ");

$order = mysqli_query($koneksi,"SELECT * from orderd WHERE id_user='$sid' AND id_order = '$_GET[id]' ");
$row_order = mysqli_fetch_assoc($order);
$sql =mysqli_query($koneksi,"SELECT * FROM detail_order inner join masakan WHERE id_user='$sid' AND  id_order = '$_GET[id]' AND detail_order.id_masakan=masakan.id_masakan ");


$total=0;



 ?>

 <!DOCTYPE html>
 <html>
 <head>
 	<title></title>
 	<link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template-->
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <!-- Page level plugin CSS-->
    <link href="../vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../css/sb-admin.css" rel="stylesheet">
 </head>
 <body>


<nav class="navbar navbar-expand-lg navbar-light  fixed-top " style="background-color: #f5f5f5; margin-bottom: 30%;">

        
      <a href="index.php"><img src="../img/cheri.png"  width="50px" style="margin-right:10px; margin-left: 20px;"></a>

  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
   <!--  <a class="navbar-brand" href="#" style="font-family: AR BERKLEY; color: maroon;">Checkout</a> -->                                      
  </div>
</nav>

<div class="container " style=" margin-top: 10%;">
<!-- akhir belanja -->
<table class="table table-striped mb-3"  style="border: 2px  lightgrey">
	<tr>
	
		<th>No Meja</th>                        
		<th>Kode Bayar</th>                             
		<th>Tagihan</th>

	</tr>
	<tr>
	

		<td><?= $row_order["no_meja"]; ?></td>
		<td><?= $row_order["kode"]; ?></td>
	<?php while($row = mysqli_fetch_array($sql)) { 
		$subtotal    = $row['harga']* $row['jumlah'];       
		$total      = $total + $subtotal; ?>
	<?php 	} ?>
	<td>Rp <?= $total;  ?></td>
	</tr>
</table>

 
<!-- <h3>Total Pembayaran : <b style="margin-left: 58%; font-size: 20px;">Rp <?= $total; ?></b></h3> -->
<!-- <a href='checkout.php'>Checkout</a> -->
<hr> 

<a href="history.php" onclick="return confirm('lakukan pembayaran terlebihdahulu sebelum pesanan diproses');" class="btn btn-danger btn-sm btn-trash fa fa-w fa-ok" style="height: 30px;">OK</a>
<!-- <h5><a href="data.php?id=<?=$sid;?>" style="font-size: 25px; text-decoration: none; color: grey;"><input style="border-radius:3px; font-size: 20px; font-family: times new roman;" placeholder="Isi data diri" >></a></h5> -->
<!-- <form method="post" action="data.php">
<input style="margin-left: 71%;" placeholder="No Meja" type="text" name="no_meja[]" >

<hr>


</form> -->
 <br>
 <br>
 <br>


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="js/bootstrap.bundle.js" ></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/bootstrap.js"></script>
    <script src="js/bootstrap.min.js"></script>

 </body>
 </html>

