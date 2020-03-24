<?php
include "../hal/sidebar.php";
if ($_SESSION['akun_level'] != 1) { header("location:../index.php");}

$id = $_GET['id'];
$conn = mysqli_connect('localhost','root','','ujikom_cheri');
$level = mysqli_query($conn, "SELECT * FROM level");
$result = mysqli_query($conn, "SELECT * FROM user  where id_user='$id' ");
	if(isset($_POST['submit'])){
	$user = $_POST['username'];
	$nama = $_POST['nama_user'];
	$level = $_POST['id_level'];
	// $pas = $_POST['password'];
	mysqli_query($conn,"UPDATE user SET username = '$user', nama_user = '$nama', id_level='$level' WHERE id_user ='$id'");
	if (mysqli_affected_rows($conn) > 0){
	echo "
		<script>
			alert('data berhasil di ubah')
			document.location.href = 'user.php';
		</script>";
	} else {
		echo "
		<script>
			alert('data gagal di ubah')
			document.location.href = 'user.php';
		</script>";
	}
}

?>

<div class="row">
	<div class="col-md-6 mb-3">
		<form form method="post" action="" enctype="multipart/form-data">
			<div class="card">
			<div class="card-header">
					<h5>Ubah User</h5>
			</div> <!-- end card hearder-->
			<div class="card-body">
				<?php $row = mysqli_fetch_assoc($result)?>
			<!-- input code user -->
			<div class="form-group form-label-group">
			<input type="text" class="form-control" name="nama_user" value="<?=$row['nama_user'];?>">
			<label>Nama Pengguna</label>
			</div>
			<!-- input code nameuser -->
			<div class="form-group form-label-group">
			<input type="text" class="form-control" name="username" value="<?=$row['username'];?>">
			<label>Username</label>
			</div>

			<!-- <div class="form-group form-label-group">
			<input type="password" class="form-control" name="password" value="<?=$row['username'];?>">
			<label>password</label>
			</div> -->

			
			<label name="id_level">Hak Akses</label>
			<select style="width: 100%; height: 25px;" name="id_level" class="form_login">

		<?php while($d = mysqli_fetch_assoc($level)) : ?>
			<option value="<?= $d['id_level'] ?>"><?= $d['nama_level'] ?></option>
		<?php endwhile; ?>
		</select>
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
