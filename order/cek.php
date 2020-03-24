<?php 
include "../hal/sidebar.php";
$sid = $_SESSION["user"]; 
// if( !isset($_SESSION["akun_username"]) ){
//   header("Location: ../login.php");
//   exit;
// }

$order = mysqli_query($koneksi,"SELECT * from user inner join orderd WHERE status_order = 'belum dibayar' AND id_order = '$_GET[id]' AND orderd.id_user=user.id_user ");
$row_order = mysqli_fetch_assoc($order);
$sql =mysqli_query($koneksi,"SELECT * FROM detail_order inner join masakan WHERE  id_order = '$_GET[id]' AND detail_order.id_masakan=masakan.id_masakan ");

if(isset($_POST['submit'])){
		
			mysqli_query($koneksi,"UPDATE detail_order Set status_detail_order='Selesai' where id_order = '$_GET[id]'");

			

	}
	header('location: order.php');


$total=0;

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
        <h1 style="color:firebrick; font-size: 25px; ">Daftar Pesanan<img src="../img/cheri.png" width="30px" style="margin-right:10px; margin-left: 20px;">
</h1>
<div class="container " style=" margin-top: 5%;">


		<p>Nama           : <?= $row_order ["nama_user"];  ?></p>
		<p>No Meja        : <?= $row_order ["no_meja"];  ?></p>
		<p>Daftar Pesanan :</p>

    		
<!-- akhir belanja -->
<table class="table table-striped mb-3"  style="border: 2px  lightgrey">
	<tr>
		
		<th>Nama Produk</th>                        
		<th>Qty</th>                                
		<th>Harga</th>
		<th>SubTotal</th>                           
		

	</tr>
	<?php while($row = mysqli_fetch_array($sql)) { 
	$subtotal    = $row['harga']* $row['jumlah'];       
	$total      = $total + $subtotal; ?>
	<tr>

		<td><?= $row["nama_masakan"]; ?></td>
		<td><?= $row["jumlah"]; ?></td>
		<td><?= $row["harga"]; ?></td>
		<td>Rp <?= $subtotal;  ?></td>

	</tr>


<?php } ?>
	
</table>
<hr>
<h5>Total Pembayaran : <b style="margin-left: 55%; font-size: 20px;">Rp <?= $total; ?></b></h5>
<hr>
<div>
	 <form action="" class="form"  method="post">
<!-- <a href="transaksi.php?id=<?= $row_order["id_order"]; ?>"style="margin-left: 94%;  background-color: maroon; border-radius: 3px; padding: 7px; text-decoration: none; color: white; width:10%;">Diterima</a> -->
 <input style="margin-left: 90%; background-color: salmon; border-radius: 3px; padding: 5px; color: white; width:10%;" type="submit" name="submit"  value="Diterima">
</form>
<a href="kasir.php" style="float: left;  text-decoration: none; font-size: 100%; color: salmon;"> [<]</a>
</div>

<?php include '../hal/footer.php';
 ?>