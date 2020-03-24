<?php 
include 'koneksi.php';
session_start();
if( !isset($_SESSION["akun_username"]) ){
  header("Location: login.php");
  exit;
}
$result = mysqli_query($koneksi, "SELECT * FROM level");

if( isset($_POST["submit"]) ){

	if( registrasi($_POST) > 0){
		echo "<script>
					alert('user baru berhasil di tambahkan!');
					document.location.href = 'user/user.php';
				</script>";
	}else{
   		echo mysqli_error($koneksi);
   }
}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Halaman Registrasi</title>
	<link rel="stylesheet"  href="css/login.css">
	<style>.a {
		display: block;
	}

	</style>
</head>
<body style="background: url(img/654621-PP2GN9-768.jpg)no-repeat center ; width: 20%; ">

<div class="login-wrapper">
	
	<form action="" class="form" method="post">
	 <img src="img/cheri.png" alt="">
			<div class="input-group">
			
			<input type="text" name="username" class="form_login" required>
			<label >Username</label>
			</div>

			<div class="input-group">
			
			<input type="password" name="password" class="form_login" required>
			<label >Password</label>
			</div>

			<div class="input-group">
			
			<input type="text" name="nama_user" class="form_login" required>
			<label >Nama Pengguna</label>
			</div>

			<div class="input-group">
			<label width="100%" name="id_level" >Hak Akses</label>
			</div>
			<br>
			<br>
			<select  style="width: 100%; height: 25px; color: maroon;" name="id_level" class="form_login" required>

		<?php while($row = mysqli_fetch_assoc($result)) : ?>
			<option  value="<?= $row['id_level'] ?>"><?= $row['nama_level'] ?></option>
		<?php endwhile; ?>
		</select>
<br>
			<br>

		
 
			<input type="submit" name="submit" class="submit-btn" value="Kirim!">
 
			<br/>
		</form>
	</div>

</body>
</html>