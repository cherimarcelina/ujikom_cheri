<?php
include "../hal/sidebar.php";
if ($_SESSION['akun_level'] != 1) { header("location:../index.php");}


if(isset($_POST["submit"])){
if (tambah($_POST) > 0){

	echo "
		<script>
			alert('data berhasil di tambahkan')
			document.location.href = 'menu.php';
		</script>";
}else{
	echo "
		<script>
			alert('data gagal di tambahkan')
			document.location.href = 'menu.php';
		</script>";
}
}
?>
<h1>Menu <small class="text-muted">Tambah</small></h1>
<hr>
<div class="row">
	<div class="col-md-6 mb-3">
		<form  method="post" enctype="multipart/form-data">		
			<div class="card">
				<div class="card-header">
					<h5>Buat Menu Baru</h5>
				</div> <!-- end card hearder-->
			<div class="card-body">
					<!-- input gmbar --> 
					<div class="form-group form-label-group">
						<input type="file" name="foto" required>
						<label>Gambar</label>
					</div>
					<!-- input code produk -->
					<div class="form-group form-label-group">
						<input type="" name="nama_masakan" class="form-control" required>
						<label>Nama Masakan</label>
					</div>
					<!-- input code harga -->
					<div class="form-group form-label-group">
						<input type="number" name="harga" class="form-control" value="Rp." required>
						<label>Harga</label>
					</div>
					<!-- input code status -->
					<div class="form-group form-label-group">
						<input type="" name="status_masakan" class="form-control" required value="Tersedia">
						<label>Status Masakan</label>
					</div>
			<br>
				</div> <!-- end card body-->
				<div class="card-footer">
					<button class="btn btn-primary" type="submit" name="submit"> Post</button>
				</div> <!-- end card footer-->
			</div> <!-- end card-->
		</form>
	</div>
</div>
<?php include "../hal/footer.php";?>