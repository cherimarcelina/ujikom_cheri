<?php 
include "../hal/sidebar.php";
$sid = $_SESSION["user"]; 
// if( !isset($_SESSION["akun_username"]) ){
//   header("Location: ../login.php");
//   exit;
// }

$order = mysqli_query($koneksi,"SELECT * from transaksi inner join orderd WHERE status_order = 'Sudah dibayar' AND transaksi.id_order=orderd.id_order order by orderd.id_order desc");
// $row_order = mysqli_fetch_array($order);

 ?>



<!-- navbar -->
<!--  <header id="header">

<nav class="navbar  navbar-expand-lg navbar-light fixed-top" id="mainNav" style="background-color: #8b0000; font-family: calibri; ">

<a class="nav-link js-scroll-trigger" href="index.php"> -->
        
      <!-- <img src="images/mpi.png" width="50px" style="margin-right:10px; margin-left: 20px;"> -->
<!-- </a>
          <b style="color: white;">Cheri Cake</b> -->
<!-- 
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button> -->
<!-- 
  <form class="form-inline" action="" method="post" style="margin-left: 45%;">
    <input style="background-color: #fff;" class="form-control mr-sm-2"  type="text" name="inputan" size="40" autofocus placeholder="masukan pencarian..." autocomplete="on">
    <button style="border-radius: 10px; background-color: maroon; color: white; "  type="submit" name="cari" value="cari">Search</button>
  </form>
</nav>
</header> -->


<!-- tampilan isi arikel berita -->
<div class="container"> 
  <div class="content cf">
        <h1 style="color:firebrick; font-size: 25px; ">Riwayat<img src="../img/cheri.png" width="30px" style="margin-right:10px; margin-left: 20px;">
</h1>
    <div class="container " style=" margin-top: 5%;">


<!-- akhir belanja -->
<table class="table table-striped mb-3"  style="border: 2px  lightgrey">
	<tr>
		
	       
		<th>Kode Bayar</th>
		<th>Total</th> 
		<th>Tanggal</th>
		<th>Status</th> 
		<th style="text-align: center;">Aksi</th>                           
		

	</tr>
	<?php while($row_order = mysqli_fetch_array($order)) {?> 
	<tr>
		
		
		<td><?= $row_order["kode_bayar"]; ?></td>
		<td><?= $row_order["total_bayar"]; ?></td>
		<td><?= $row_order["tanggal"]; ?></td>
		<td style="	color: red;"	><?= $row_order["status_order"]; ?></td>
		
		<td style="text-align: center;">
			<a class="btn btn-success btn-sm faw fas fa-print " href="../print.php?id=<?=$row_order['id_order'];?>" target="_blank" style="height: 30px;"></a>
		</td>
	
	</tr>
	<?php 	} ?>
</table>


<?php include '../hal/footer.php';
 ?>