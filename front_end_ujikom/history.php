<?php 
session_start(); 
$sid = $_SESSION["user"]; 
include "../koneksi.php";
//jalankan perintah inner join dari tabel keranjang dan produk 
$sql = mysqli_query($koneksi,"SELECT * FROM detail_order u inner join masakan l WHERE id_user='$sid' AND u.id_masakan=l.id_masakan");
// $r = mysqli_fetch_assoc($sql);
$total = 0;
// $row = mysqli_fetch_array($sql);
// $id = $row['id_masakan'];

// $result = mysqli_query($koneksi, "SELECT * FROM keranjang  where id_masakan ='$id' and id_user ='$sid'");
// 	if(isset($_POST['submit'])){
// 	$user = $_POST['ket'];
	
// 	// $pas = $_POST['password'];
// 	mysqli_query($koneksi,"UPDATE keranjang SET keterangan = '$user' WHERE id_masakan ='$id' and id_user='$sid'");
// 	if (mysqli_affected_rows($koneksi) > 0){
// 	echo "
// 		";
// 	} 
// }

 ?>
 <!DOCTYPE html>
 <html>
 <head>
 	<title>Keranjang</title>
 	<link rel="shortcut icon" type="image/png" href="../img/cheri.png">
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
    <a class="navbar-brand" href="#" style="font-family: AR BERKLEY; color: maroon;">History Belanja</a>                                      
  </div>
</nav>
<form method="POST" action="checkout.php" enctype="multipart/form-data">
	<tr>
<!-- akhir belanja -->
<!-- belanja -->
<div class="container " style=" margin-top: 10%;">
<div class="card shadow mb-4">
<div class="header ppy-3">
	<h5 class="m-0 font-weight-bold text-secondary text-center"><b>History</b> Belanja</h5>
</div>
<!-- akhir belanja -->
<div class="card-body">
<div class="table-responsive">
<a href="index.php" style="color: salmon; text-decoration: none;">[<]</a>
<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
<thead>
	<tr>
		<th></th>
		<th>Nama Masakan</th>
		<th>Sub Total</th> 
		<th>Status</th>
		<th>Aksi</th>
	</tr>
</thead>
<tfoot>
<!-- <a  href='index.php' style="margin-bottom: 20px;" class="fa fa-w fa-plus btn btn-danger">Tambah Lagi</a> -->
<br>
<tbody>
<?php while($row = mysqli_fetch_array($sql)) { 
	$subtotal    = $row['harga']* $row['jumlah'];       
	$total      = $total + $subtotal; ?>
	<tr>
	<form method="POST" action="checkout.php?id=<?=$row['id_masakan'];?>" enctype="multipart/form-data">

	
	<!-- <td><a class="btn btn-danger btn-sm btn-trash fa fa-w fa-check" style="margin-left: 8px;" href="keranjang.php?<?=$id = $row['id_masakan'];?>"></a></td> -->
	<td><img src="../img/<?= $row['foto']; ?>" style="width: 100px;" class="card-img" alt="..."></td>
		<td><?= $row["nama_masakan"]; ?></td>
		<td><?= $row["jumlah"]; ?></td>
		<td style="color: red; font-style: italic;"><?= $row["status_detail_order"]; ?></td>
		<td>Rp <?= $subtotal;  ?></td>
		
	</tr>


<?php } ?>
</tbody>
</tfoot>
</table>
<div class="total">
<h3 style="margin-left: 74%; font-size: 20px;">Total Belanja : <b>Rp <?= $total; ?></b></h3>
</div>
<!-- <a href='checkout.php'>Checkout</a> -->
<hr>

 
</div>
</div>


 	</form>
 

</div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="js/bootstrap.bundle.js" ></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/bootstrap.js"></script>
    <script src="js/bootstrap.min.js"></script>

 </body>
 </html>

 <div class="container"></div>