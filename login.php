<?php 
ob_start();
session_start();
if(isset($_SESSION['akun_username'])) header("Location: index.php");
include"koneksi.php";

// proses login

if (isset($_POST["kirim"])) {
	$username = $_POST["username"];
	$password = $_POST["password"];
	$login = mysqli_query($koneksi, "SELECT * From user where username = '$username' and password = '$password'");
// 	if (password_verify('password',$password)) {
// 	echo'login berhasil';
// }

	if (mysqli_num_rows($login)>0) {
		$row_akun = mysqli_fetch_array($login);
		$_SESSION["user"] = $row_akun["id_user"];
		$_SESSION["akun_username"] = $row_akun["username"];
		$_SESSION["akun_password"] = $row_akun["password"];
		$_SESSION["akun_nama"] = $row_akun["nama_user"];
		$_SESSION["akun_level"] = $row_akun["id_level"];

		if ($_SESSION["akun_level"] == "1") {
			header("Location: index.php");
		}else if ($_SESSION["akun_level"] == "5"){
			header("Location: front_end_ujikom/index.php");
		}else{
			header("Location: index.php");
		}

	}else{
		header("Location: login.php?gagal");
	}
}

 ?>


<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	<link rel="stylesheet" type="text/css" href="css/login.css">
	<link rel="shortcut icon" type="image/png" href="img/cheri.png">
</head>
<body style="background: url(img/654621-PP2GN9-768.jpg)no-repeat center ; width: 20%; ">

    <div class="login-wrapper">
    <form action="" class="form"  method="post">
      <img src="img/cheri.png" alt="">
      <?php if(isset($_GET['gagal'])) {?>
      <p style=" color: red; text-align: center; "><i>username/password salah!!</i></p>
      <?php } ?>
      <div class="input-group">
        <input type="text" name="username" id="loginUser" autofocus required>
        <label for="loginUser" >Username</label>
      </div>
      <div class="input-group">
        <input type="password"  name="password" id="loginPassword" required>
        <label for="loginPassword"  >Password</label>
      </div>
      <input type="submit" name="kirim" value="Login" class="submit-btn">
      
    </form> 
    </div>	
</body>
</html>


  
