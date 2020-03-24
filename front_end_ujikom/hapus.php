<?php 
session_start(); 
include "../koneksi.php"; 
$sid = $_SESSION["user"];

$sql = mysqli_query($koneksi,"SELECT id_masakan FROM keranjang WHERE id_masakan='$_GET[id]' AND id_user='$sid'");
$ketemu=mysqli_num_rows($sql);
if ($ketemu > 0){                            
  	mysqli_query($koneksi," DELETE FROM keranjang  WHERE id_user ='$sid' AND id_masakan ='$_GET[id]'");
  }       
	
	header("Location: keranjang.php");

 ?>