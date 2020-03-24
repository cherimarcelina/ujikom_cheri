<?php 
session_start(); 
include "../koneksi.php"; 
$sid = $_SESSION["user"];

$sql = mysqli_query($koneksi,"SELECT id_masakan FROM keranjang WHERE id_masakan='$_GET[id]' AND id_user='$sid'");
$ketemu=mysqli_num_rows($sql);
if ($ketemu > 0){                            
  	mysqli_query($koneksi," UPDATE keranjang  SET jumlah = jumlah - 1 WHERE id_user ='$sid' AND id_masakan ='$_GET[id]'");
  }       
	
	header("Location: keranjang.php");


 ?>
 

<!-- coba -->
<!-- <?php while($row = mysqli_fetch_array($sql)) { 
	$subtotal    = $row['harga']* $row['jumlah'];       
	$total      = $total + $subtotal; ?>
	<table style="border: 5px;">
	
<div class="card mb-3">
  <div class="row ">
    <div class="col-md-4">
      <img src="../img/<?= $row['foto']; ?>" style="width: 50%;" class="card-img" alt="...">
    </div>
    <div class="col-md-8">
      <div class="card-body">
        <h5 class="card-title"><?= $row["nama_masakan"]; ?></h5>
        <p class="card-text"></p>
        <p class="card-text">Rp <?= $subtotal;  ?></p>
        <a class="btn btn-dark btn-sm btn-trash fa fa-w fa-minus" style="text-decoration:none;  float: left; " href="hapus_keranjang.php?id=<?=$row['id_masakan'];?>"></a>
		<p style="float: left;" class="btn btn-sm btn-trash"><?= $row["jumlah"]; ?></p>
		<a class="btn btn-dark btn-sm btn-trash fa fa-w fa-plus" style="text-decoration:none; float: left;" href="aksi_keranjang.php?id=<?=$row['id_masakan'];?>"></a>
      </div>
    </div>
    <a class="btn btn-danger btn-sm btn-trash fa fa-w fa-trash" style="margin-left: 96%;" href="hapus.php?id=<?=$row['id_masakan'];?>"></a>
  </div>
</div>
</td>
<hr>
</table>
<?php } ?>
</div> -->