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
		for ($i = 0; $i < $jml; $i++){  mysqli_query($koneksi,"INSERT INTO detail_order(id_detail_order,id_order,id_masakan,id_user , jumlah,keterangan,status_detail_order,kode) VALUES('','$id',{$isikeranjang[$i]['id_masakan']},'$sid', {$isikeranjang[$i]['jumlah']},'$ket[$i]','berhasil dicheckout','$kode_cek') "); }

// setelah data pemesanan tersimpan, hapus data pemesanan di tabel keranjang 
for ($i = 0; $i < $jml; $i++) { mysqli_query($koneksi,"DELETE FROM keranjang WHERE id_keranjang = {$isikeranjang[$i]['id_keranjang']}");}


?>

