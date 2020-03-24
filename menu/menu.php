<?php 

include "../hal/sidebar.php";
if ($_SESSION['akun_level'] != 1) { header("location:../index.php");}
// $result = mysqli_query($koneksi,"SELECT * FROM masakan");
 ?>
<!DOCTYPE html>
<html>
<head>
  <title>Entri Referensi</title>
  <link href="css/menu.css" rel="stylesheet">

</head>
<body>

<h2 style="">Entri Referensi</h2>
<hr>
<div class="row">
	<div class="col-md-6 mb-3">
		<a href="tambah.php" class="btn " style="background-color:#cd5c5c ; color:white;">[+] Tambah</a>
	</div>


<?php   
$jumlahdata = 6;
$jumlah = count(query("SELECT * FROM masakan "));
$jumlahHalaman = ceil($jumlah / $jumlahdata);
$halamanAktif = (isset($_GET["halaman"]) ) ? $_GET["halaman"] : 1;
// halaman 2 = data 6
 // isi data 17
$awalData = ($jumlahdata * $halamanAktif ) - $jumlahdata;
// $result = mysqli_query($koneksi,"SELECT * FROM masakan order by id desc LIMIT $awalData, $jumlahdata ");
$no = 1 + $awalData;
@$cari = $_POST['cari'];
@$inputan = $_POST['inputan'];
if ($cari) {
  if ($inputan == "") {
    $sql = mysqli_query($koneksi,"SELECT * FROM masakan order by id desc");
  }else if ($inputan != "") {
    $sql = mysqli_query($koneksi,"SELECT * FROM masakan where 
    nama_masakan LIKE '%$inputan%'  order by id_masakan asc ");
  }
}
else{
  $sql = mysqli_query($koneksi,"SELECT * FROM masakan order by id_masakan desc LIMIT $awalData, $jumlahdata ");
}
?>
<?php if ($_SESSION['akun_level'] == 1) {?>

<div class="col-md-6 mb-3">
    <form method="post" action="" >
      <div class="input-group">
        <input type="text" name="inputan"
        placeholder="masukan yang anda cari"
        class="form-control" value="<?= $inputan; ?>">
        <div class="input-group-append">
          <button type="submit" name="cari" value="cari" class="btn " style="color:white; background-color:#cd5c5c ;">
            Search !
          </button>
        </div>
      </div>
    </form>
  </div>
</div>

<?php 
$cek = mysqli_num_rows($sql);
if ($cek < 1) {
echo "<i style='color:red;'>Data Tidak di Temukan<i>";
} ?>

<div class="container">
  <div  style="margin-top: 30px;" class="section-padding">
    <div class="container">
        <div class="row"> 
          <?php while ($d = mysqli_fetch_assoc ($sql)):?>
            <div class="col-xs-12 col-sm-6 col-md-4">
              <article style="padding: 30px;
							    border-radius: 3px;
							    -webkit-box-shadow: 0 0 20px 0 rgba(0, 0, 0, 0.1);
							    box-shadow: 0 0 20px 0 rgba(0, 0, 0, 0.1);
							    margin-bottom: 30px;">
                <figure class="post-media">
                <h5 class="dark-color"><?php echo $d['status_masakan'];?></h5>
                  <img style="height: 13rem; width: 100%;" src="../img/<?php echo $d['foto'];?>">
                </figure>
                <div style="text-align: center;">
                                        <h4 class="dark-color"><?php echo $d['nama_masakan'];?></h4>
                    <h4 class="dark-color" style="color: red; font-size: 100%;"><?php echo $d['harga'];?></h4>
                    
                    <a href="ubah.php?id=<?=$d['id_masakan'];?>" class="btn btn-info btn-sm fa fa-w fa-edit" style="height: 30px;">Ubah</a>

              		<a href="hapus.php?id=<?= $d["id_masakan"]; ?>" onclick="return confirm('yakin?');" class="btn btn-danger btn-sm btn-trash fa fa-w fa-trash" style="height: 30px;">Hapus</a>
                </div>
              </article>
            </div>
          <?php endwhile; ?>
        </div>
      </div>
  </div>
</div>

<!-- tampilan pagination -->
<div class="container wow fadeInUp" style="margin-bottom: 30px;">
  <nav arial-label="Page navigation example">
    <ul class="pagination justify-content-center" >
      <li class="page-item"  >
        <?php if($halamanAktif > 1) : ?>
        <a class="page-link" style="background-color: #f08080;" arial-label="Previous" href="?halaman= <?= $halamanAktif - 1 ?> #portfolio">
          <span aria-hidden="true">&laquo;</span>
        </a>
        <?php endif; ?>
      </li>
      <?php for( $i = 1; $i <= $jumlahHalaman; $i++) : ?>
      <li  class="page-item" ><a style="background-color: #f08080;" class="page-link" href="?halaman=<?= $i; ?> #portfolio"><?= $i; ?></a></li>
      <?php endfor; ?>
      <li class="page-item"  >
        <?php if($halamanAktif < $jumlahHalaman) : ?>
        <a class="page-link" style="background-color: #f08080;" arial-label="Next" href="?halaman= <?= $halamanAktif + 1 ?> #portfolio"> 
        <span aria-hidden="true">&raquo;</span>
        </a>
        <?php endif; ?>
      </li>
    </ul>
  </nav>
</div>

<?php } ?> 

</body>
</html>



<?php include "../hal/footer.php"; ?>