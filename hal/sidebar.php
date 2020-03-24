<?php 
include "../koneksi.php";
session_start();


if( !isset($_SESSION["akun_username"]) ){
  header("Location: ../login.php");
  exit;
}

 ?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Aplikasi Kasir</title>
    <link rel="shortcut icon" type="image/png" href="../img/cheri.png">

    <!-- Bootstrap core CSS-->
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template-->
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <!-- Page level plugin CSS-->
    <link href="../vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../css/sb-admin.css" rel="stylesheet">

  </head>

<body id="page-top" style="font-family: Century ">
<nav class="navbar navbar-expand navbar-dark static-top" style="background-color:#cd5c5c ;">
      <img src="../img/cheri.png" width="50px" style="margin-right:10px; margin-left: 5px;">
      <a class="navbar-brand mr-1" style="color: #f5f5f5; font-family: AR BERKLEY;" href="../index.php">Cheri Cake</a>

      <button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
        <i class="fas fa-bars" style="color: #f5f5f5;"></i>
      </button>

      <!-- Navbar Search -->
      <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
      </form>

      <!-- Navbar -->
     <ul class="navbar-nav ml-auto ml-md-12" >
        <li class="nav-item dropdown no-arrow" >
          <a style="color: #f5f5f5;"class="nav-link dropdown-toggle" href="logout.php" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-user-circle fa-fw" style="color: #f5f5f5;"></i>
             <?= $_SESSION['akun_nama']; ?>
          </a>
          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
            <a class="dropdown-item" href="../logout.php" data-toggle="modal" data-target="#logoutModal" style="color: grey;">Logout</a>
          </div>            
        </li>
      </ul>

    </nav>
   
    <div id="wrapper"  >
     <!-- Sidebar -->

     <ul class="sidebar navbar-nav" style="background-color: #ffe4e1 ; ">
    
        <li class="nav-item active">
          <a class="nav-link" href="../index.php">
            <i style="color: #cd5c5c ;" class="fas fa-fw fa-tachometer-alt"></i>
            <span style="color: #cd5c5c ;">Dashboard</span>
          </a>
        </li>
         <?php if ($_SESSION['akun_level'] == 1) {?>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"  style="color: #cd5c5c ;" >
            <i style="color: #cd5c5c ;" class="fas fa-fw fa-users"></i>
            <span style="color: #cd5c5c ;">USER</span>
          </a>
          <div class="dropdown-menu" aria-labelledby="pagesDropdown" style="background-color:#cd5c5c ; ">
            <a class="dropdown-item" href="../user/user.php" style="color: maroon ; ">Data Pengguna</a>
            <a class="dropdown-item" href="../front_end_ujikom/index.php" target="_blank"style="color: maroon ;">Halaman Pelanggan</a>
            <a class="dropdown-item" href="../register.php"style="color: maroon ;">Register</a>
            
          </div>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../menu/menu.php">
            <i style="color: #cd5c5c ;"class="fas fa-fw fa-plus-square"></i>
            <span style="color: #cd5c5c ;">Entri Referensi</span></a>
        </li>
         <?php } ?>
         <?php if ($_SESSION['akun_level'] == 1|| $_SESSION['akun_level'] == 4 || $_SESSION['akun_level'] == 3  ) {?>
        <li class="nav-item">
          <a class="nav-link" href="../front_end_ujikom/index.php" target="_blank">
            <i style="color: #cd5c5c ;" class="fas fa-shopping-cart"></i>
            <span style="color: #cd5c5c ;">Order</span></a>
        </li>
        <?php } ?>

        <?php if ($_SESSION['akun_level'] == 1|| $_SESSION['akun_level'] == 4 ) {?>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"  style="color: #cd5c5c ;" >
            <i style="color: #cd5c5c ;" class="fas fa-shopping-cart"></i>
            <span style="color: #cd5c5c ;">Entri Order</span></a>
          </a>
          <div class="dropdown-menu" aria-labelledby="pagesDropdown" style="background-color:#cd5c5c ; ">
            <a class="dropdown-item"  href="../order/order.php" style="color: maroon ; ">Pesanan</a>
            <a class="dropdown-item" href="../order/cetak.php" style="color: maroon ;">Riwayat Order</a>
         
          </div>
        </li>
        <?php } ?>

        <?php if ($_SESSION['akun_level'] == 1|| $_SESSION['akun_level'] == 3 ) {?>
  
         <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"  style="color: #cd5c5c ;" >
            <i style="color: #cd5c5c ;"class="fas fa fa-w fa-edit"></i>
            <span style="color: #cd5c5c ;">Entri Transaksi</span>
          </a>
          <div class="dropdown-menu" aria-labelledby="pagesDropdown" style="background-color:#cd5c5c ; ">
            <a class="dropdown-item"  href="../kasir/kasir.php" style="color: maroon ; ">Bayar</a>
            <a class="dropdown-item" href="../kasir/cetak.php" style="color: maroon ;">Report Transaksi</a>
         
          </div>
        </li>
          <?php } ?>

        <?php if ($_SESSION['akun_level'] == 1|| $_SESSION['akun_level'] == 2 || $_SESSION['akun_level'] == 3 || $_SESSION['akun_level'] == 4  ) {?>
        <li class="nav-item">
          <a class="nav-link" href="../order/order.php">
            <i style="color: #cd5c5c ;" class="fas fa-list-alt"></i>
            <span style="color: #cd5c5c ;"style="color: #cd5c5c ;">Generet Laporan</span></a>
        </li>
        <?php } ?>
      </ul>
  <div id="content-wrapper">
<div class="container-fluid">
  <!-- akhri side bar -->

