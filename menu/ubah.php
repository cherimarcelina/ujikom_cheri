<?php
include "../hal/sidebar.php";
if ($_SESSION['akun_level'] != 1) { header("location:../index.php");}


$id = $_GET['id'];
$menu = query_m("SELECT * FROM masakan where id_masakan = $id ")[0];
if(isset($_POST['submit'])){
	if(ubah_m($_POST)>0){
	echo "
		<script>
			alert('data berhasil di ubah')
			document.location.href = 'menu.php';
		</script>";
	} else {
		echo "
		<script>
			alert('data gagal di ubah')
			document.location.href = 'menu.php';
		</script>";
	}
}
?>


<div class="row">
	<div class="col-md-6 mb-3">
		<form form method="post" action="" enctype="multipart/form-data">
			<div class="card">
			<div class="card-header">
					<h5>Ubah Menu</h5>
			</div> <!-- end card hearder-->
			<div class="card-body">
					<!-- input gmbar --> 
			<div class="form-group form-label-group">
			<input type="hidden" name="id" value="<?= $menu["id_masakan"]; ?>">
			<input type="hidden" name="gambarLama" value="<?= $menu["foto"]; ?>">
			<img src="../img/<?=$menu['foto'];?>" style="width:90%;">
			<input type="file" name="foto">
			</div>
			<!-- input code masakan -->
			<div class="form-group form-label-group">
			<input type="text" class="form-control" name="nama_masakan" value="<?=$menu['nama_masakan'];?>">
			<label>Nama Masakan</label>
			</div>
			<!-- input code harga -->
			<div class="form-group form-label-group">
			<input type="text" class="form-control" name="harga" value="<?=$menu['harga'];?>">
			<label>Harga</label>
			</div>
			<!-- input code status -->
			<div class="form-group form-label-group">
			<input type="text" class="form-control" name="status_masakan" value="<?=$menu['status_masakan'];?>">
			<label>Status Masakan</label>
			</div>
				</div> <!-- end card body-->
				<div class="card-footer">
		<button class="btn btn-primary" type="submit" name="submit">Ubah</button>
				</div> <!-- end card footer-->
			</div> <!-- end card-->
		</form>
	</div>
</div>
<?php
require "../hal/footer.php";
?>
