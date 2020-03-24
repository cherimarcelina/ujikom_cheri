<?php
require_once __DIR__ . '/vendor/autoload.php';
$mpdf = new \Mpdf\Mpdf();
session_start(); 
$sid = $_SESSION["user"]; 
include "koneksi.php";
$order = mysqli_query($koneksi,"SELECT * from user inner join orderd WHERE id_order = '$_GET[id]' AND orderd.id_user=user.id_user ");
$row_order = mysqli_fetch_assoc($order);
//jalankan perintah inner join dari tabel keranjang dan produk 
$sql = mysqli_query($koneksi,"SELECT * FROM detail_order u inner join masakan l WHERE id_order='$_GET[id]' AND u.id_masakan=l.id_masakan");
$total = 0;

$html='<!DOCTYPE html>
 <html>
 <head>
 
 </head>
 <body>


<!-- belanja -->
<div class="container " style=" margin-top: 10%;">
<div class="card shadow mb-4">
<!-- akhir belanja -->
<div class="card-body">
<div class="table-responsive">
<p>Nama           : '.$row_order["nama_user"].'</p>
		<p>No Meja        : '.$row_order["no_meja"].'</p>
		<p>Daftar Pesanan :</p>
<table border="1" cellpadding="10" cellspacing="0">
<thead>
	<tr>
		<th>Nama Masakan</th><th>Harga</th><th>Qty</th><th>Sub Total</th>
	</tr>
</thead>
<tfoot>
<br>
<tbody>
';
while($row = mysqli_fetch_array($sql)) { 
	$subtotal    = $row['harga']* $row['jumlah'];       
	$total      = $total + $subtotal;

	$html .= '<tr>
				<td>'.$row["nama_masakan"].'</td>
				<td>'.$row["harga"].'</td>
				<td>'.$row["jumlah"].'</td>
				<td>'.$subtotal.'</td>
				

				</tr>';
}
$html .= '
</tbody>
</tfoot>
</table>
<div class="total">
<h3 style="font-size: 20px;">Total Belanja : <b>Rp '.$total.'</b></h3>
</div>
</div>

 </body>
 </html>';
$mpdf->WriteHTML($html);

$html='';
$mpdf->Output();
?>

