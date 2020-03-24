<?php 
	session_start(); 
	include "../koneksi.php"; 
	$sid = $_SESSION["user"]; 
	// fungsi untuk mendapatkan isi keranjang belanja 
	function isi_keranjang(){        
		$isikeranjang = array();        
		$sid = $_SESSION["user"];
		$koneksi = mysqli_connect("localhost", "root", "", "ujikom_cheri");   
		$sql = mysqli_query($koneksi,"SELECT * FROM keranjang WHERE id_user='$sid'");
		 while ($r=mysqli_fetch_array($sql)) {                
		 	$isikeranjang[] = $r;        
		 }
		  return $isikeranjang; 
		}
		// simpan data pemesanan 
		$tgl_skrg = date("Ymd");

  $text = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
  $pnj = 4;
  $text1 = strlen($text)-1;
  $kode_cek ='';
  for ($i=1; $i<=$pnj; $i++) { 
    $kode_cek .= $text[rand(0, $text1)];
  }

		mysqli_query($koneksi,"INSERT INTO orderd(tanggal,id_user,kode)   VALUES ('$tgl_skrg','$sid','$kode_cek')");

		// function orde(){        
		// $isikeranjang = array();        
		// $sid = $_SESSION["user"];
		// $koneksi = mysqli_connect("localhost", "root", "", "ujikom_cheri");   
		// $sql = mysqli_query($koneksi,"SELECT * FROM orderd WHERE id_user='$sid'");
		//  while ($r=mysqli_fetch_array($sql)) {                
		//  	$orderd[] = $r;        
		//  }
		//   return $orderd; 
		// }
		

		
// mendapatkan nomor orders dari tabel pembelian 
		
// panggil fungsi isi_keranjang dan hitung jumlah produk yang dipesan 
		$isikeranjang = isi_keranjang(); 
		// $or = orde(); 
		$jml          = count($isikeranjang);
	

$sql = mysqli_query($koneksi,"SELECT * FROM orderd WHERE id_user='$sid' AND kode ='$kode_cek'");
$ro = mysqli_fetch_array($sql);
$id = $ro['id_order'];

$ket = $_POST['ket'];



// $sql1 = mysqli_query($koneksi,"SELECT * FROM keranjang WHERE id_user='$sid'");

// $rowd = mysqli_fetch_array($sql1);
// $ket = $rowd['keterangan'];



// simpan data detail pemesanan 
		for ($i = 0; $i < $jml; $i++){  mysqli_query($koneksi,"INSERT INTO detail_order(id_detail_order,id_order,id_masakan,id_user , jumlah,keterangan,status_detail_order,kode) VALUES('','$id',{$isikeranjang[$i]['id_masakan']},'$sid', {$isikeranjang[$i]['jumlah']},'$ket[$i]','belum dibayar','$kode_cek') "); }

// setelah data pemesanan tersimpan, hapus data pemesanan di tabel keranjang 
// for ($i = 0; $i < $jml; $i++) { mysqli_query($koneksi,"DELETE FROM keranjang WHERE id_keranjang = {$isikeranjang[$i]['id_keranjang']}");}

	// echo"Nomor Order: <b>$sid</b><br/><br />";
 

$r=mysqli_query($koneksi,"SELECT * FROM detail_order inner join masakan WHERE id_user='$sid' AND kode = '$kode_cek' AND detail_order.id_masakan=masakan.id_masakan ");
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
    <a class="navbar-brand" href="#" style="font-family: AR BERKLEY; color: maroon;">Checkout</a>                                      
  </div>
</nav>

<div class="container " style=" margin-top: 10%;">
<!-- akhir belanja -->
<table class="table table-striped mb-3"  style="border: 2px  lightgrey">
	<tr>
		<th></th>
		<th>Nama Produk</th>                        
		<th>Qty</th>                                
		<th>Harga</th>
		<th>SubTotal</th>
	</tr>
<?php while($row = mysqli_fetch_array($r)) { 
	$subtotal    = $row['harga']* $row['jumlah'];       
	$total      = $total + $subtotal; ?>
	<tr>
	<td><img src="../img/<?= $row['foto']; ?>" style="width: 100px;" class="card-img" alt="..."></td>
		<td><?= $row["nama_masakan"]; ?></td>
		<td><?= $row["jumlah"]; ?></td>
		<td><?= $row["harga"]; ?></td>
		<td>Rp <?= $subtotal;  ?></td>

	</tr>


<?php } ?>
</table>

<h3>Total Pembayaran : <b style="margin-left: 58%; font-size: 20px;">Rp <?= $total; ?></b></h3>
<!-- <a href='checkout.php'>Checkout</a> -->
<hr>
<!-- <h5><a href="data.php?id=<?=$sid;?>" style="font-size: 25px; text-decoration: none; color: grey;"><input style="border-radius:3px; font-size: 20px; font-family: times new roman;" placeholder="Isi data diri" >></a></h5> -->
<?php 	 ?>

<form method="post" action="data.php?id=<?=$ro['id_order'];?>">

	  <div class="input-group">
        <input  style="margin-left: 71%;"  type="text" name="no_meja"
        placeholder="No Meja"
        class="form-control" required="">
        
      </div>
      <br>
      <div class="input-group">
        <input  style="margin-left: 71%;"  type="text" name="meja"
        placeholder="Keterangan Meja"
        class="form-control" required="">
        
      </div>

<hr>

 <input style="margin-left: 90%; background-color: salmon; border-radius: 3px; padding: 5px; color: white; width:10%;" type="submit"  value="Buat Pesanan">
</form>
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
	

