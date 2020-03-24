<?php
include "../hal/sidebar.php";
if ($_SESSION['akun_level'] != 1) { header("location:../index.php");}

$result = mysqli_query($koneksi, "SELECT * FROM level");
if(isset($_POST["submit"])){
	$nama = $_POST['username'];
	$password = $_POST['password'];
	$namalengkap = $_POST['nama_user'];

	$error=array();
	if (empty($nama)){
		$error['username'] = 'nama harus di isi';
	}if (empty($password)){
		$error['password'] = 'nama harus di isi';
	}if (empty($namalengkap)){
		$error['nama_user'] = 'nama harus di isi';
	}
if (tambah_u($_POST) > 0){

	echo "
		<script>
			alert('data berhasil di tambahkan')
			document.location.href = 'user.php';
		</script>";
}else{
	echo "
		<script>
			alert('data gagal di tambahkan')
			document.location.href = 'user.php';
		</script>";
}
}


?>
<h1>User <small class="text-muted">Tambah</small></h1>
<hr>
<div class="row">
	<div class="col-md-6 mb-3">
		<form  method="post" enctype="multipart/form-data">		
			<div class="card">
				<div class="card-header">
					<h5>Buat User Baru</h5>
				</div> <!-- end card hearder-->
				<div class="card-body">
					<!-- input gmbar --> 
			<label>Username</label>
			<input type="text" name="username" class="form-control" >
			<!-- <p style="color: red;"><?= ($error['username']) ? $error['username'] : '';?></p> -->
			<label>Password</label>
			<input type="password" name="password" class="form-control" >
			<!-- <p style="color: red;"><?=($error['password']) ? $error['password'] : '';?></p> -->
			<label>Nama Pengguna</label>
			<input type="text" name="nama_user" class="form-control" >
			<!-- <p style="color: red;"><?=($error['nama_user']) ? $error['nama_user'] : '';?></p> -->
			<br>
			<label>Hak Akses</label>
			<select name="id_level">
		<?php while($row = mysqli_fetch_assoc($result)) : ?>
			<option value="<?= $row['id_level'] ?>"><?= $row['nama_level'] ?></option>
		   <?php endwhile; ?>
		</select>	

				</div> <!-- end card body-->
				<div class="card-footer">
					<button class="btn btn-primary" type="submit" name="submit"> Post</button>
				</div> <!-- end card footer-->
			</div> <!-- end card-->
		</form>
	</div>
</div>
<?php include "../hal/footer.php";?>