<?php 
session_start(); 
include '../koneksi.php';
if( !isset($_SESSION["akun_username"]) ){
  header("Location: ../login.php");
  exit;
}

$menu = mysqli_query($koneksi,"SELECT * from masakan");
 ?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css" crossorigin="anonymous">
     <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
     <link rel="stylesheet" href="css/style.css">
     <!-- <link rel="stylesheet" href="css/bootstrap.css"> -->

    <title>Cheri Cake</title>
    <link rel="shortcut icon" type="image/png" href="../img/cheri.png">
  </head>
  </head>
  <body>


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

<nav class="navbar navbar-expand-lg navbar-light  fixed-top " style="background-color: #f5f5f5;">

        
      <img src="../img/cheri.png" width="50px" style="margin-right:10px; margin-left: 20px;">

  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
    <a class="navbar-brand" href="#" style="font-family: AR BERKLEY; color: maroon;">Cheri Cake</a>
    <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
      <li class="nav-item active">
        <a class="nav-link" href="#menu">Menu </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="history.php">History</a>
      </li>
      <li class="nav-item">
        <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
      </li>
    </ul>
    <form class="form-inline my-2 my-lg-0">
      <input class="form-control" type="search" placeholder="Search" aria-label="Search" >
      <button class="form-control" style="  color: white; "  type="submit"><i style="color: firebrick;" class="fas fa-search"></i></button>
    </form>
    <a class="nav-link" href="keranjang.php">
            <i style="color: #cd5c5c ;" class="fas fa-shopping-cart"></i>
           </a>

    <a href="../logout.php" onclick="return confirm('logout');">
      <i style="color: #cd5c5c ;" class="fa fa-user-circle"></i>
    </a>
                                       
  </div>
</nav>

<!-- ahir navbar

<!-- jumbotroon -->
 <section id="intro" class="clearfix">
    <div class="container d-flex h-100">
      <div class="row justify-content-center align-self-center">
        <div class="col-md-6 intro-info order-md-first order-last" style="margin-right:500px;">
          <h2 class="wow fadeInUp" style="font-family: AR BERKLEY;">Cheri Cake</h2>
          <h5 class="wow fadeInUp" style="font-family: calibri; color: black">Menyediakan berbagai macam kue-kue, mulai dari kue ultah, kue kering dan masih banyak lagi ayo pesan!!</h5>
        </div>
      </div>
    </div>
  </section>
<!-- akhir jumborton -->
<section id="menu">

<!-- tampilan isi arikel berita -->
<div class="container" > 
  <div class="content cf" >
        <h1 style="margin-top: 80px; color:firebrick; font-size: 25px; ">Menu<img src="../img/cheri.png" width="30px" style="margin-right:10px; margin-left: 20px;">
</h1>
    <div class="main">
     <!-- berita -->
  
        <hr>
        <div  style="margin-top: 30px;" class="section-padding">
          <div class="container">
              <div class="row"> 
               <?php   while($row = mysqli_fetch_assoc($menu)) :?>
                  <div class="col-xs-12 col-sm-6 col-md-4">
                    <article class="post-single">
                      <figure class="post-media">
                        <img style="height: 10rem;" src="../img/<?= $row['foto']; ?>" >
                      </figure>
                      <div class="post-body">
                           <h3 class="dark-color">Rp.<?= $row['harga']; ?></h3> 
                           <h4><?=  $row['nama_masakan'];?></h4>
                          <a href="aksi_keranjang.php?id=<?=$row['id_masakan'];?>" class="boxed-btn3">Order Now</a>
                      </div>
                    </article>
                  </div>
                <?php endwhile; ?>
              </div>
            </div>
   
      </div>
      <!-- akhir berita -->
    </div>
    <div class="sidebar">
      <div class="pen">
        <h1 style="color:firebrick; font-size: 25px; margin-top: -25px;">Terlaris</h1>
        <hr>
       
      </div>
      <br>
      <!-- <h1 class="tr">Berita Terbaru</h1>
      <hr>
    <div class="container">
      <div  style="margin-top: 30px;" class="section-padding">
        <div class="container">
          <div class="row"> 
           
              <div class="col">
                <img style="height: 15rem;" src="">
                <h4  class="dark-color"></a></h4>
               <!--  <a href="http://localhost/projek_akhir/masukberita.php?id=<?=$d['ID'];?>" class="read-more">Baca Selengkapnya</a> -->
              </div>
          
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</section>






    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="js/bootstrap.bundle.js" ></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/bootstrap.js"></script>
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>